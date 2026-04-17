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
        $teams = $this->proposalModel->where('lecturer_id', $lecturer['id'])
                                     ->where('status', 'approved')
                                     ->findAll();

        $scheduleModel = new PmwGuidanceScheduleModel();
        $schedules = $scheduleModel->getSchedulesByCreator(auth()->id());

        return view('dosen/guidance/index', [
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

        $filePath = '';
        if ($type === 'photo') $filePath = $logbook->photo_activity;
        elseif ($type === 'assignment') $filePath = $logbook->assignment_file;
        elseif ($type === 'nota') $filePath = $logbook->nota_file;

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
