<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\PmwReportService;
use App\Services\PmwBoothcampDocService;
use App\Models\PmwDocumentModel;
use App\Models\PmwPeriodModel;
use App\Models\Proposal\PmwProposalModel;
use CodeIgniter\API\ResponseTrait;

class MilestoneReportController extends BaseController
{
    use ResponseTrait;

    protected $reportService;
    protected $boothcampService;
    protected $periodModel;
    protected $proposalModel;

    public function __construct()
    {
        $this->reportService = new PmwReportService();
        $this->boothcampService = new PmwBoothcampDocService();
        $this->periodModel = new PmwPeriodModel();
        $this->proposalModel = new PmwProposalModel();
    }

    public function index()
    {
        $activePeriod = $this->periodModel->where('is_active', 1)->first();
        if (!$activePeriod) {
            return redirect()->back()->with('error', 'Tidak ada periode aktif.');
        }

        $schedules = (new \App\Models\Milestone\PmwReportScheduleModel())
                        ->where('period_id', $activePeriod['id'])
                        ->findAll();
        
        $formattedSchedules = [];
        foreach ($schedules as $s) {
            $formattedSchedules[$s['type']] = $s;
        }

        // Get all proposals that passed implementation selection
        $proposals = $this->proposalModel->getProposalsForSchedule($activePeriod['id']);
        
        // Get all submissions
        $reportModel = new \App\Models\Milestone\PmwReportModel();
        $submissions = $reportModel->whereIn('proposal_id', array_column($proposals, 'id') ?: [0])->findAll();
        
        $formattedSubmissions = [];
        foreach ($submissions as $sub) {
            $formattedSubmissions[$sub['proposal_id']][$sub['type']] = $sub;
        }

        $boothcampDocs = $this->boothcampService->getDocsForProposals(array_column($proposals, 'id'));

        return view('admin/laporan_pmw', [
            'title' => 'Laporan Milestone',
            'schedules' => $formattedSchedules,
            'proposals' => $proposals,
            'submissions' => $formattedSubmissions,
            'boothcampDocs' => $boothcampDocs,
            'activePeriod' => $activePeriod
        ]);
    }

    public function saveSchedule()
    {
        $rules = [
            'type' => 'required|in_list[kemajuan,magang,akhir]',
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date',
            'period_id' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Data jadwal tidak valid.')->withInput();
        }

        try {
            $this->reportService->saveSchedule($this->request->getPost());
            return redirect()->back()->with('success', 'Jadwal laporan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * View PDF file
     */
    public function viewFile($reportId)
    {
        $reportModel = new \App\Models\Milestone\PmwReportModel();
        $report = $reportModel->find($reportId);

        if (!$report || !$this->canViewReport((int) $report['proposal_id'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $filePath = WRITEPATH . 'uploads/' . $report['file_path'];
        if (!is_file($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response->setHeader('Content-Type', 'application/pdf')
                             ->setBody(file_get_contents($filePath));
    }

    /**
     * View dokumen pendukung (Dokumentasi Boothcamp) berdasarkan ID pmw_documents.
     */
    public function viewDocument($documentId)
    {
        $document = (new PmwDocumentModel())->find((int) $documentId);

        if (!$document
            || $document['doc_key'] !== PmwBoothcampDocService::DOC_KEY
            || !$this->canViewReport((int) $document['proposal_id'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $filePath = WRITEPATH . ltrim($document['file_path'], '/\\');
        if (!is_file($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response->setHeader('Content-Type', 'application/pdf')
                             ->setBody(file_get_contents($filePath));
    }

    private function canViewReport(int $proposalId): bool
    {
        $user = auth()->user();
        if (!$user) {
            return false;
        }

        $groups = $user->getGroups();

        if (in_array('admin', $groups, true)) {
            return true;
        }

        if (in_array('mahasiswa', $groups, true)) {
            $proposal = (new \App\Models\Proposal\PmwProposalModel())->find($proposalId);
            return $proposal && (int) $proposal['leader_user_id'] === (int) $user->id;
        }

        if (in_array('dosen', $groups, true)) {
            $lecturer = (new \App\Models\LecturerModel())->where('user_id', $user->id)->first();
            if (!$lecturer) {
                return false;
            }

            return (new \App\Models\Proposal\PmwProposalAssignmentModel())
                ->where('proposal_id', $proposalId)
                ->where('lecturer_id', $lecturer['id'])
                ->first() !== null;
        }

        return false;
    }
}
