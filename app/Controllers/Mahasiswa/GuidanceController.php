<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Guidance\PmwGuidanceScheduleModel;
use App\Models\Guidance\PmwGuidanceLogbookModel;
use App\Models\PmwPeriodModel;
use App\Services\PmwGuidanceService;
use CodeIgniter\HTTP\ResponseInterface;

class GuidanceController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];
    protected $guidanceService;
    protected $proposalModel;
    protected $periodModel;

    public function __construct()
    {
        $this->guidanceService = new PmwGuidanceService();
        $this->proposalModel   = new PmwProposalModel();
        $this->periodModel     = new PmwPeriodModel();
    }

    /**
     * Dashboard Bimbingan & Mentoring for Student
     */
    public function index(): string|ResponseInterface
    {
        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();
        
        if (!$activePeriod) {
            return redirect()->to('dashboard')->with('error', 'Periode aktif tidak ditemukan.');
        }

        // Get proposal
        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);
        
        if (!$proposal) {
            return redirect()->to('dashboard')->with('error', 'Proposal tidak ditemukan atau Anda bukan ketua tim.');
        }

        $scheduleModel = new PmwGuidanceScheduleModel();
        $schedules = $scheduleModel->getSchedulesByProposal($proposal['id']);

        return view('mahasiswa/guidance/index', [
            'title'     => 'Logbook Bimbingan & Mentoring | PMW Polsri',
            'proposal'  => $proposal,
            'schedules' => $schedules,
        ]);
    }

    /**
     * Submit logbook for a schedule
     */
    public function submitLogbook(int $scheduleId): ResponseInterface
    {
        try {
            $data = $this->request->getPost();
            $files = [
                'photo_activity'  => $this->request->getFile('photo_activity'),
                'assignment_file' => $this->request->getFile('assignment_file'),
                'nota_file'       => $this->request->getFile('nota_file'),
            ];

            // Filter out empty files
            $files = array_filter($files, fn($f) => $f && $f->isValid());

            $this->guidanceService->submitLogbook($scheduleId, $data, $files);

            return redirect()->back()->with('success', 'Logbook berhasil dikirim.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Securely serve student's guidance files
     */
    public function viewFile(string $type, int $logbookId): ResponseInterface
    {
        $logbookModel = new PmwGuidanceLogbookModel();
        $logbook = $logbookModel->find($logbookId);

        if (!$logbook) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        // TODO: Add security check to ensure student belongs to the team
        
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
