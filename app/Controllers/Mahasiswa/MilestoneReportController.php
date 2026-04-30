<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Services\PmwReportService;
use App\Models\PmwPeriodModel;
use App\Models\Proposal\PmwProposalModel;
use Exception;

class MilestoneReportController extends BaseController
{
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
        $userId = auth()->id();
        $proposal = $this->proposalModel->getProposalByUserId($userId);

        if (!$proposal) {
            return view('errors/html/error_404', ['message' => 'Anda belum memiliki proposal yang terdaftar.']);
        }

        // Check if passed implementation
        $db = \Config\Database::connect();
        $selection = $db->table('pmw_selection_implementasi')
                        ->where('proposal_id', $proposal['id'])
                        ->where('admin_status', 'approved')
                        ->get()
                        ->getRow();

        if (!$selection) {
            return redirect()->to('dashboard')->with('error', 'Fitur ini hanya tersedia untuk tim yang lolos seleksi implementasi.');
        }

        $activePeriod = $this->periodModel->where('is_active', 1)->first();
        if (!$activePeriod) {
            return redirect()->to('dashboard')->with('error', 'Periode aktif tidak ditemukan.');
        }

        $schedules = (new \App\Models\Milestone\PmwReportScheduleModel())
                        ->where('period_id', $activePeriod['id'])
                        ->findAll();
        
        $formattedSchedules = [];
        foreach ($schedules as $s) {
            $formattedSchedules[$s['type']] = $s;
        }

        $reports = $this->reportService->getProposalReports($proposal['id']);

        // Filter 'magang' for Pemula only
        if ($proposal['kategori_wirausaha'] !== 'pemula') {
            unset($formattedSchedules['magang']);
            unset($reports['magang']);
        }

        return view('mahasiswa/laporan_pmw', [
            'title' => 'Laporan Milestone',
            'proposal' => $proposal,
            'schedules' => $formattedSchedules,
            'reports' => $reports
        ]);
    }

    public function submit()
    {
        $scheduleId = $this->request->getPost('schedule_id');
        $proposalId = $this->request->getPost('proposal_id');
        $notes = $this->request->getPost('notes');
        $file = $this->request->getFile('file_report');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Berkas laporan wajib diunggah.');
        }

        // Validate file size (5MB) and type (PDF)
        $validationRules = [
            'file_report' => [
                'rules' => 'uploaded[file_report]|max_size[file_report,5120]|mime_in[file_report,application/pdf]',
                'errors' => [
                    'max_size' => 'Ukuran berkas terlalu besar. Maksimal adalah 5MB.',
                    'mime_in'  => 'Format berkas harus PDF.',
                    'uploaded' => 'Berkas laporan wajib diunggah.'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->with('error', $this->validator->getError('file_report'));
        }

        try {
            $this->reportService->submitReport($proposalId, $scheduleId, ['notes' => $notes], $file);
            return redirect()->back()->with('success', 'Laporan berhasil diunggah.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
