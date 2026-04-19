<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\PmwReportService;
use App\Models\PmwPeriodModel;
use App\Models\Proposal\PmwProposalModel;
use CodeIgniter\API\ResponseTrait;

class MilestoneReportController extends BaseController
{
    use ResponseTrait;

    protected $reportService;
    protected $periodModel;
    protected $proposalModel;

    public function __construct()
    {
        $this->reportService = new PmwReportService();
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

        return view('admin/laporan_pmw', [
            'title' => 'Laporan Milestone',
            'schedules' => $formattedSchedules,
            'proposals' => $proposals,
            'submissions' => $formattedSubmissions,
            'activePeriod' => $activePeriod
        ]);
    }

    public function saveSchedule()
    {
        $rules = [
            'type' => 'required|in_list[kemajuan,akhir]',
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

        if (!$report) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $filePath = WRITEPATH . 'uploads/' . $report['file_path'];
        if (!file_exists($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response->setHeader('Content-Type', 'application/pdf')
                             ->setBody(file_get_contents($filePath));
    }
}
