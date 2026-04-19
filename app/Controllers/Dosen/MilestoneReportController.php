<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Services\PmwReportService;
use App\Models\Proposal\PmwProposalModel;
use App\Models\LecturerModel;
use Exception;

class MilestoneReportController extends BaseController
{
    protected $reportService;
    protected $proposalModel;
    protected $lecturerModel;

    public function __construct()
    {
        $this->reportService = new PmwReportService();
        $this->proposalModel = new PmwProposalModel();
        $this->lecturerModel = new LecturerModel();
    }

    public function index()
    {
        $userId = auth()->id();
        $lecturer = $this->lecturerModel->where('user_id', $userId)->first();
        
        if (!$lecturer) {
            return redirect()->to('dashboard')->with('error', 'Profil dosen tidak ditemukan.');
        }

        // Get active period
        $periodModel = new \App\Models\PmwPeriodModel();
        $activePeriod = $periodModel->getActive();

        // Get proposals mentored by this lecturer
        $proposals = $this->proposalModel->getProposalsByLecturer($lecturer['id']);

        if (empty($proposals)) {
            return view('dosen/laporan_pmw', [
                'title' => 'Laporan Milestone',
                'proposals' => [],
                'schedules' => [],
                'reports' => []
            ]);
        }

        // Get schedules for active period
        $scheduleModel = new \App\Models\Milestone\PmwReportScheduleModel();
        $schedules = $activePeriod ? $scheduleModel->where('period_id', $activePeriod['id'])->findAll() : [];
        $schedMap = [];
        foreach ($schedules as $s) {
            $schedMap[$s['type']] = $s;
        }

        // Get reports for these proposals
        $reportModel = new \App\Models\Milestone\PmwReportModel();
        $reports = $reportModel->whereIn('proposal_id', array_column($proposals, 'id'))->findAll();
        
        // Group reports by proposal and type
        $reportMap = [];
        foreach ($reports as $r) {
            $reportMap[$r['proposal_id']][$r['type']] = $r;
        }

        // Enrich proposals with ketua_nama
        foreach ($proposals as &$p) {
            $ketua = (new \App\Models\Proposal\PmwProposalMemberModel())
                        ->where('proposal_id', $p['id'])
                        ->where('role', 'ketua')
                        ->first();
            $p['ketua_nama'] = $ketua ? $ketua['nama'] : '-';
        }

        return view('dosen/laporan_pmw', [
            'title' => 'Laporan Milestone',
            'proposals' => $proposals,
            'schedules' => $schedMap,
            'reports' => $reportMap
        ]);
    }

    public function verify()
    {
        $reportId = $this->request->getPost('report_id');
        $status = $this->request->getPost('status');
        $note = $this->request->getPost('dosen_note');

        try {
            $this->reportService->verifyReport($reportId, [
                'status' => $status,
                'dosen_note' => $note
            ]);
            return redirect()->back()->with('success', 'Verifikasi laporan berhasil disimpan.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
