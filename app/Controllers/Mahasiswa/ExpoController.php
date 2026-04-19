<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\PmwPeriodModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Expo\PmwExpoScheduleModel;
use App\Models\Expo\PmwExpoSubmissionModel;
use App\Models\Expo\PmwExpoAttachmentModel;
use App\Models\Expo\PmwAwardModel;
use App\Services\PmwExpoService;
use CodeIgniter\HTTP\ResponseInterface;

class ExpoController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];
    protected $expoService;
    protected $periodModel;
    protected $proposalModel;

    public function __construct()
    {
        $this->expoService   = new PmwExpoService();
        $this->periodModel   = new PmwPeriodModel();
        $this->proposalModel = new PmwProposalModel();
    }

    /**
     * Student Expo Page
     */
    public function index(): string|ResponseInterface
    {
        $user = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();
        
        if (!$activePeriod) {
            return redirect()->to('dashboard')->with('error', 'Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);
        
        if (!$proposal) {
            return redirect()->to('dashboard')->with('error', 'Proposal tidak ditemukan atau Anda bukan ketua tim.');
        }

        // Check Eligibility (Lolos Tahap 2)
        $db = \Config\Database::connect();
        $finalization = $db->table('pmw_selection_finalization')
                           ->where('proposal_id', $proposal['id'])
                           ->get()->getRow();

        if (!$finalization || $finalization->admin_status !== 'approved') {
            return view('mahasiswa/expo_locked', [
                'title'    => 'Expo & Awarding | PMW Polsri',
                'proposal' => $proposal,
            ]);
        }

        $scheduleModel   = new PmwExpoScheduleModel();
        $submissionModel = new PmwExpoSubmissionModel();
        $attachmentModel = new PmwExpoAttachmentModel();
        $awardModel      = new PmwAwardModel();

        $schedule    = $scheduleModel->getActiveSchedule((int)$activePeriod['id']);
        $submission  = $submissionModel->getByProposal($proposal['id']);
        $attachments = $submission ? $attachmentModel->getBySubmission($submission->id) : [];
        $awards      = $awardModel->getTeamAwards($proposal['id']);

        return view('mahasiswa/expo', [
            'title'       => 'Expo & Awarding | PMW Polsri',
            'proposal'    => $proposal,
            'schedule'    => $schedule,
            'submission'  => $submission,
            'attachments' => $attachments,
            'awards'      => $awards,
        ]);
    }

    /**
     * Submit Documentation
     */
    public function submit(): ResponseInterface
    {
        try {
            $user         = auth()->user();
            $activePeriod = $this->periodModel->where('is_active', true)->first();
            $proposal     = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

            // Check if Expo is closed or deadline passed
            $scheduleModel = new PmwExpoScheduleModel();
            $schedule = $scheduleModel->getActiveSchedule((int)$activePeriod['id']);
            
            if ($schedule && ($schedule->is_closed || ($schedule->submission_deadline && strtotime($schedule->submission_deadline) < time()))) {
                return redirect()->back()->with('error', 'Batas waktu pengumpulan telah berakhir atau sesi telah ditutup.');
            }

            $data = $this->request->getPost();
            $files = [
                'attachments' => $this->request->getFileMultiple('attachments')
            ];

            $this->expoService->submitDocumentation($proposal['id'], $data, $files);

            return redirect()->back()->with('success', 'Dokumentasi Expo berhasil dikirim.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
