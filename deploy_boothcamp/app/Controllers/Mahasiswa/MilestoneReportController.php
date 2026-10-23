<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Services\PmwReportService;
use App\Services\PmwBoothcampDocService;
use App\Models\PmwPeriodModel;
use App\Models\Proposal\PmwProposalModel;
use Exception;

class MilestoneReportController extends BaseController
{
    protected $reportService;
    protected $periodModel;
    protected $proposalModel;
    protected $boothcampDocService;

    public function __construct()
    {
        $this->reportService = new PmwReportService();
        $this->periodModel = new PmwPeriodModel();
        $this->proposalModel = new PmwProposalModel();
        $this->boothcampDocService = new PmwBoothcampDocService();
    }

    public function index()
    {
        $userId = auth()->id();
        $proposal = $this->proposalModel->getProposalByUserId($userId);

        if (!$proposal) {
            return view('errors/html/error_404', ['message' => 'Anda belum memiliki proposal yang terdaftar.']);
        }

        // Cukup sudah pernah submit implementasi (ada record), tidak perlu tunggu validasi admin
        $db = \Config\Database::connect();
        $selection = $db->table('pmw_selection_implementasi')
                        ->where('proposal_id', $proposal['id'])
                        ->get()
                        ->getRow();

        if (!$selection) {
            return redirect()->to('dashboard')->with('error', 'Fitur ini hanya tersedia untuk tim yang sudah mengisi data Implementasi List Perjanjian.');
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

        // Semua kategori (pemula & berkembang) dapat mengakses laporan magang

        return view('mahasiswa/laporan_pmw', [
            'title' => 'Laporan Milestone',
            'proposal' => $proposal,
            'schedules' => $formattedSchedules,
            'reports' => $reports,
            'boothcampDoc' => $this->boothcampDocService->getDoc((int) $proposal['id']),
        ]);
    }

    public function submit()
    {
        $userId = (int) auth()->id();

        // proposal selalu diambil dari sesi, bukan dari hidden input
        $proposal = $this->proposalModel->getProposalByUserId($userId);
        if (!$proposal) {
            return redirect()->back()->with('error', 'Proposal tidak ditemukan.');
        }

        $proposalId = (int) $proposal['id'];

        // guard yang sama dengan index(), supaya POST langsung tidak bisa bypass
        $db = \Config\Database::connect();
        $selection = $db->table('pmw_selection_implementasi')
                        ->where('proposal_id', $proposalId)
                        ->get()
                        ->getRow();

        if (!$selection) {
            return redirect()->back()->with('error', 'Fitur ini hanya tersedia untuk tim yang sudah mengisi data Implementasi List Perjanjian.');
        }

        $activePeriod = $this->periodModel->where('is_active', 1)->first();
        if (!$activePeriod || (int) $proposal['period_id'] !== (int) $activePeriod['id']) {
            return redirect()->back()->with('error', 'Proposal Anda tidak termasuk periode aktif.');
        }

        // schedule_id dari form hanya diterima kalau milik periode aktif
        $scheduleId = (int) $this->request->getPost('schedule_id');
        $schedule = (new \App\Models\Milestone\PmwReportScheduleModel())->find($scheduleId);

        if (!$schedule || (int) $schedule['period_id'] !== (int) $activePeriod['id']) {
            return redirect()->back()->with('error', 'Jadwal laporan tidak valid.');
        }

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

    public function uploadBoothcamp()
    {
        $userId = (int) auth()->id();

        $proposal = $this->proposalModel->getProposalByUserId($userId);
        if (!$proposal) {
            return redirect()->back()->with('error', 'Proposal tidak ditemukan.');
        }

        $proposalId = (int) $proposal['id'];

        $db = \Config\Database::connect();
        $selection = $db->table('pmw_selection_implementasi')
                        ->where('proposal_id', $proposalId)
                        ->get()
                        ->getRow();

        if (!$selection) {
            return redirect()->back()->with('error', 'Fitur ini hanya tersedia untuk tim yang sudah mengisi data Implementasi List Perjanjian.');
        }

        $activePeriod = $this->periodModel->where('is_active', 1)->first();
        if (!$activePeriod || (int) $proposal['period_id'] !== (int) $activePeriod['id']) {
            return redirect()->back()->with('error', 'Proposal Anda tidak termasuk periode aktif.');
        }

        $file = $this->request->getFile('boothcamp_file');
        if (!$file instanceof \CodeIgniter\HTTP\Files\UploadedFile || !$file->isValid()) {
            return redirect()->back()->with('error', 'Berkas dokumentasi wajib diunggah.')->withInput();
        }

        try {
            $this->boothcampDocService->store($proposalId, $userId, $file);
            return redirect()->back()->with('success', 'Dokumentasi Boothcamp berhasil disimpan.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
}
