<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Guidance\PmwGuidanceScheduleModel;
use App\Models\Guidance\PmwGuidanceLogbookModel;
use App\Services\PmwGuidanceService;
use App\Models\LecturerModel;
use CodeIgniter\HTTP\ResponseInterface;

class GuidanceController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];
    protected $guidanceService;
    protected $proposalModel;
    protected $lecturerModel;

    public function __construct()
    {
        $this->guidanceService = new PmwGuidanceService();
        $this->proposalModel   = new PmwProposalModel();
        $this->lecturerModel   = new LecturerModel();
    }

    /**
     * Dashboard Bimbingan for Dosen
     */
    public function index(): string
    {
        $lecturer = $this->lecturerModel->getByUserId(auth()->id());
        
        // Get teams assigned to this lecturer
        $teams = $this->proposalModel->getProposalsByLecturer((int) $lecturer['id']);

        $scheduleModel = new PmwGuidanceScheduleModel();
        $schedules     = $scheduleModel->getSchedulesByCreator(auth()->id());

        // Attach logbook entry to each schedule
        $logbookModel = new PmwGuidanceLogbookModel();
        foreach ($schedules as $schedule) {
            $schedule->logbook = $logbookModel->getBySchedule($schedule->id);
        }

        // Attach members to each team
        $memberModel = new \App\Models\Proposal\PmwProposalMemberModel();
        foreach ($teams as &$team) {
            $team['members'] = $memberModel->getByProposalId((int) $team['id']);
        }

        return view('dosen/guidance', [
            'title'     => 'Manajemen Bimbingan | PMW Polsri',
            'teams'     => $teams,
            'schedules' => $schedules,
            'lecturer'  => $lecturer,
        ]);
    }

    /**
     * Create bimbingan schedule
     */
    public function createSchedule(): ResponseInterface
    {
        try {
            $data = $this->request->getPost();
            $data['type'] = 'bimbingan'; // Fixed for Dosen
            
            $this->guidanceService->createSchedule(auth()->id(), $data);
            
            // Send Notification
            $proposal = $this->proposalModel->find($data['proposal_id']);
            if ($proposal) {
                $notifModel = new \App\Models\NotificationModel();
                $timeStr = ($data['schedule_date'] ?? '') . ' ' . ($data['schedule_time'] ?? '');
            $notifModel->createGuidanceScheduleNotification(
                    (int)$proposal['leader_user_id'],
                    $timeStr,
                    'Lokasi sesuai kesepakatan',
                    'bimbingan'
                );
            }
            
            return redirect()->back()->with('success', 'Jadwal bimbingan berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Verify logbook entry
     */
    public function verify(int $logbookId): ResponseInterface
    {
        try {
            $status = $this->request->getPost('status');
            $note = $this->request->getPost('verification_note');
            
            $this->guidanceService->verifyLogbook($logbookId, $status, $note);
            
            // Send Notification
            $db = \Config\Database::connect();
            $logbook = $db->table('pmw_guidance_logbooks gl')
                ->select('gl.status, gs.schedule_date, p.leader_user_id')
                ->join('pmw_guidance_schedules gs', 'gs.id = gl.schedule_id')
                ->join('pmw_proposals p', 'p.id = gs.proposal_id')
                ->where('gl.id', $logbookId)
                ->get()
                ->getRow();

            if ($logbook) {
                $notifModel = new \App\Models\NotificationModel();
                $notifModel->createGuidanceVerificationNotification(
                    (int)$logbook->leader_user_id,
                    $logbook->schedule_date,
                    $status === 'approved' ? 'verified' : 'pending',
                    'bimbingan'
                );
            }

            return redirect()->back()->with('success', 'Verifikasi bimbingan berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Securely serve bimbingan files
     */
    public function viewFile(string $type, int $logbookId): ResponseInterface
    {
        $logbookModel = new PmwGuidanceLogbookModel();
        $logbook = $logbookModel->find($logbookId);

        if (!$logbook) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        $filePath = match ($type) {
            'photo'      => $logbook->photo_activity,
            'assignment' => $logbook->assignment_file,
            'nota'       => (function() use ($logbook) {
                $specificPath = $this->request->getGet('path');
                if ($specificPath) {
                    $notaFiles = json_decode($logbook->nota_files ?? '[]', true) ?? [];
                    if (in_array($specificPath, $notaFiles)) {
                        return $specificPath;
                    }
                }
                return $logbook->nota_file;
            })(),
            default      => ''
        };

        if (empty($filePath)) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        $absPath = WRITEPATH . 'uploads/' . $filePath;

        if (!is_file($absPath)) {
            return $this->response->setStatusCode(404)->setBody('File fisik tidak ditemukan.');
        }

        $mimeType = mime_content_type($absPath);
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($absPath) . '"')
            ->setBody(file_get_contents($absPath));
    }
}
