<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Activity\PmwActivityScheduleModel;
use App\Models\Activity\PmwActivityLogbookModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\PmwPeriodModel;
use App\Services\PmwActivityService;
use App\Models\NotificationModel;
use CodeIgniter\HTTP\ResponseInterface;

class ActivityController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];
    protected $activityService;
    protected $proposalModel;
    protected $periodModel;

    public function __construct()
    {
        $this->activityService = new PmwActivityService();
        $this->proposalModel   = new PmwProposalModel();
        $this->periodModel     = new PmwPeriodModel();
    }

    /**
     * Admin dashboard - list all schedules
     */
    public function index(): string
    {
        $scheduleModel = new PmwActivityScheduleModel();
        $schedules     = $scheduleModel->getAllSchedulesWithProposal();

        // Stats
        $stats = [
            'total'     => count($schedules),
            'planned'   => count(array_filter($schedules, fn($s) => $s->status === 'planned')),
            'ongoing'   => count(array_filter($schedules, fn($s) => $s->status === 'ongoing')),
            'completed' => count(array_filter($schedules, fn($s) => $s->status === 'completed')),
        ];

        // Get approved proposals for schedule creation dropdown
        $activePeriod = $this->periodModel->where('is_active', true)->first();
        $proposals    = [];
        if ($activePeriod) {
            $proposals = $this->proposalModel->getProposalsForSchedule($activePeriod['id']);
        }

        return view('admin/activity/index', [
            'title'     => 'Manajemen Kegiatan Wirausaha | PMW Polsri',
            'schedules' => $schedules,
            'stats'     => $stats,
            'proposals' => $proposals,
        ]);
    }

    /**
     * Create schedule
     */
    public function createSchedule(): ResponseInterface
    {
        try {
            $data = $this->request->getPost();
            $this->activityService->createSchedule($data);

            // Send notification to student
            $proposal = $this->proposalModel->find($data['proposal_id']);
            if ($proposal) {
                $notifModel = new NotificationModel();
                $notifModel->createActivityScheduleNotification(
                    (int)$proposal['leader_user_id'],
                    $data['activity_category'],
                    $data['activity_date']
                );
            }

            return redirect()->back()->with('success', 'Jadwal kegiatan berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Detail page for verification
     */
    public function detail(int $scheduleId): string
    {
        $scheduleModel = new PmwActivityScheduleModel();
        $schedule      = $scheduleModel->find($scheduleId);

        if (!$schedule) {
            return redirect()->to('admin/kegiatan')->with('error', 'Jadwal tidak ditemukan.');
        }

        $proposal = $this->proposalModel->find($schedule->proposal_id);

        $logbookModel = new PmwActivityLogbookModel();
        $logbook      = $logbookModel->getBySchedule($scheduleId);

        return view('admin/activity/detail', [
            'title'     => 'Detail Kegiatan | PMW Polsri',
            'schedule'  => $schedule,
            'proposal'  => $proposal,
            'logbook'   => $logbook,
        ]);
    }

    /**
     * Admin final verification
     */
    public function verify(int $logbookId): ResponseInterface
    {
        try {
            $status = $this->request->getPost('status');
            $note   = $this->request->getPost('admin_note');

            $this->activityService->verifyByAdmin($logbookId, $status, $note);

            // Send notification to student
            $logbookModel = new PmwActivityLogbookModel();
            $logbook      = $logbookModel->getLogbookWithSchedule($logbookId);
            if ($logbook) {
                $notifModel = new NotificationModel();
                $notifModel->createActivityVerificationNotification(
                    (int)$logbook['leader_user_id'] ?? 0,
                    $logbook['activity_category'],
                    $status === 'approved' ? 'approved' : 'revision',
                    'admin'
                );
            }

            return redirect()->back()->with('success', 'Verifikasi final berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete schedule
     */
    public function deleteSchedule(int $scheduleId): ResponseInterface
    {
        try {
            $this->activityService->deleteSchedule($scheduleId);
            return redirect()->to('admin/kegiatan')->with('success', 'Jadwal kegiatan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Serve files
     */
    public function viewFile(string $type, int $logbookId): ResponseInterface
    {
        $logbookModel = new PmwActivityLogbookModel();
        $logbook = $logbookModel->find($logbookId);

        if (!$logbook) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        $filePath = match ($type) {
            'photo'     => $logbook->photo_activity,
            'supervisor' => $logbook->photo_supervisor_visit,
            default     => ''
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
