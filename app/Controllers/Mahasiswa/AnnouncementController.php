<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Services\PmwAnnouncementService;
use App\Services\PmwBankAccountService;
use App\Services\PmwPhaseAccessService;
use App\Services\PmwSelectionService;

class AnnouncementController extends BaseController
{
    private const PHASE_NUMBER = 4;

    public function index()
    {
        $phaseAccess = new PmwPhaseAccessService();
        $announcementService = new PmwAnnouncementService();
        $selectionService = new PmwSelectionService();
        $bankAccountService = new PmwBankAccountService();
        $proposalModel = new PmwProposalModel();

        $activePeriod = $phaseAccess->getActivePeriod();
        if (!$activePeriod) {
            return view('mahasiswa/pengumuman/index', [
                'title'        => 'Pengumuman Kelolosan Dana Tahap I',
                'activePeriod' => null,
                'phase'        => null,
                'isPhaseOpen'  => false,
                'isPassed'     => false,
                'announcement' => null,
                'passedTeams'  => [],
                'proposal'     => null,
                'bankAccount'  => null,
                'hasBankData'  => false,
            ]);
        }

        $phase = $phaseAccess->getPhaseForActivePeriod(self::PHASE_NUMBER);
        $isPhaseOpen = $phaseAccess->isPhaseOpen($phase);

        $announcement = $announcementService->getOrCreatePhaseAnnouncement((int) $activePeriod['id'], self::PHASE_NUMBER);
        $passedTeams = $selectionService->getPassedStage1Teams((int) $activePeriod['id']);

        $user = auth()->user();
        $isPassed = ($user) ? $selectionService->leaderPassedPerjanjian((int) $activePeriod['id'], (int) $user->id) : false;

        // Get proposal for the current user
        $proposal = null;
        $bankAccount = null;
        $hasBankData = false;
        if ($user && $activePeriod) {
            $proposal = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);
            if ($proposal) {
                $bankAccount = $bankAccountService->findByProposal((int) $proposal['id']);
                $hasBankData = $bankAccountService->hasCompleteData((int) $proposal['id']);
            }
        }

        return view('mahasiswa/pengumuman/index', [
            'title'        => 'Pengumuman Kelolosan Dana Tahap I',
            'activePeriod' => $activePeriod,
            'phase'        => $phase,
            'isPhaseOpen'  => $isPhaseOpen,
            'isPassed'     => $isPassed,
            'announcement' => $announcement,
            'passedTeams'  => $passedTeams,
            'proposal'     => $proposal,
            'bankAccount'  => $bankAccount,
            'hasBankData'  => $hasBankData,
        ]);
    }

    public function bankAccount()
    {
        $phaseAccess = new PmwPhaseAccessService();
        $selectionService = new PmwSelectionService();
        $bankAccountService = new PmwBankAccountService();
        $proposalModel = new PmwProposalModel();

        $activePeriod = $phaseAccess->getActivePeriod();
        if (!$activePeriod) {
            return redirect()->to('mahasiswa/pengumuman')->with('error', 'Periode aktif tidak ditemukan.');
        }

        $phase = $phaseAccess->getPhaseForActivePeriod(self::PHASE_NUMBER);
        $isPhaseOpen = $phaseAccess->isPhaseOpen($phase);

        if (!$isPhaseOpen) {
            return redirect()->to('mahasiswa/pengumuman')->with('error', 'Input data rekening hanya bisa dilakukan saat Tahap 5 dibuka.');
        }

        $user = auth()->user();
        if (!$user) {
            return redirect()->to('mahasiswa/pengumuman')->with('error', 'Silakan login terlebih dahulu.');
        }

        $isPassed = $selectionService->leaderPassedPerjanjian((int) $activePeriod['id'], (int) $user->id);
        if (!$isPassed) {
            return redirect()->to('mahasiswa/pengumuman')->with('error', 'Anda belum lolos Tahap I.');
        }

        $proposal = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);
        if (!$proposal) {
            return redirect()->to('mahasiswa/pengumuman')->with('error', 'Data proposal tidak ditemukan.');
        }

        $bankAccount = $bankAccountService->getOrCreate((int) $proposal['id'], (int) $activePeriod['id']);

        return view('mahasiswa/pengumuman/bank_account', [
            'title'         => 'Input Data Rekening | PMW Polsri',
            'activePeriod'  => $activePeriod,
            'phase'         => $phase,
            'isPhaseOpen'   => $isPhaseOpen,
            'proposal'      => $proposal,
            'bankAccount'   => $bankAccount,
        ]);
    }

    public function saveBankAccount()
    {
        $phaseAccess = new PmwPhaseAccessService();
        $selectionService = new PmwSelectionService();
        $bankAccountService = new PmwBankAccountService();
        $proposalModel = new PmwProposalModel();

        $activePeriod = $phaseAccess->getActivePeriod();
        if (!$activePeriod) {
            return redirect()->back()->with('error', 'Periode aktif tidak ditemukan.');
        }

        $phase = $phaseAccess->getPhaseForActivePeriod(self::PHASE_NUMBER);
        if (!$phaseAccess->isPhaseOpen($phase)) {
            return redirect()->back()->with('error', 'Input data rekening hanya bisa dilakukan saat Tahap 5 dibuka.');
        }

        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('error', 'Silakan login terlebih dahulu.');
        }

        $isPassed = $selectionService->leaderPassedPerjanjian((int) $activePeriod['id'], (int) $user->id);
        if (!$isPassed) {
            return redirect()->back()->with('error', 'Anda belum lolos Tahap I.');
        }

        $proposal = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);
        if (!$proposal) {
            return redirect()->back()->with('error', 'Data proposal tidak ditemukan.');
        }

        $data = [
            'bank_name'           => $this->request->getPost('bank_name'),
            'account_holder_name' => $this->request->getPost('account_holder_name'),
            'account_number'      => $this->request->getPost('account_number'),
            'branch_office'       => $this->request->getPost('branch_office'),
            'description'         => $this->request->getPost('description'),
        ];

        // Validate required fields
        if (empty($data['bank_name']) || empty($data['account_holder_name']) || 
            empty($data['account_number']) || empty($data['branch_office'])) {
            return redirect()->back()->with('error', 'Semua field wajib diisi kecuali deskripsi.')->withInput();
        }

        // Save bank account data
        $bankAccountService->save((int) $proposal['id'], (int) $activePeriod['id'], $data);

        // Handle file upload
        $file = $this->request->getFile('bank_book_scan');
        if ($file && $file->isValid()) {
            try {
                $bankAccountService->uploadBankBook((int) $proposal['id'], $file);
            } catch (\Throwable $e) {
                return redirect()->back()->with('error', 'File buku rekening: ' . $e->getMessage())->withInput();
            }
        }

        return redirect()->to('mahasiswa/pengumuman/rekening')->with('success', 'Data rekening berhasil disimpan.');
    }

    public function downloadBankBook()
    {
        $phaseAccess = new PmwPhaseAccessService();
        $selectionService = new PmwSelectionService();
        $bankAccountService = new PmwBankAccountService();
        $proposalModel = new PmwProposalModel();

        $activePeriod = $phaseAccess->getActivePeriod();
        if (!$activePeriod) {
            return redirect()->back()->with('error', 'Periode aktif tidak ditemukan.');
        }

        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('error', 'Silakan login terlebih dahulu.');
        }

        $isPassed = $selectionService->leaderPassedPerjanjian((int) $activePeriod['id'], (int) $user->id);
        if (!$isPassed) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $proposal = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);
        if (!$proposal) {
            return redirect()->back()->with('error', 'Data proposal tidak ditemukan.');
        }

        $bankAccount = $bankAccountService->findByProposal((int) $proposal['id']);
        if (!$bankAccount || empty($bankAccount->bank_book_scan)) {
            return redirect()->back()->with('error', 'File buku rekening tidak ditemukan.');
        }

        $absPath = WRITEPATH . $bankAccount->bank_book_scan;
        if (!is_file($absPath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di server.');
        }

        return $this->response->download($absPath, null)
            ->setFileName(basename($absPath));
    }

    public function downloadSk()
    {
        $phaseAccess = new PmwPhaseAccessService();
        $announcementService = new PmwAnnouncementService();
        $selectionService = new PmwSelectionService();

        $activePeriod = $phaseAccess->getActivePeriod();
        if (!$activePeriod) {
            return redirect()->back()->with('error', 'Periode aktif tidak ditemukan.');
        }

        $user = auth()->user();
        if (!$user || !$selectionService->leaderPassedPerjanjian((int) $activePeriod['id'], (int) $user->id)) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $announcement = $announcementService->getOrCreatePhaseAnnouncement((int) $activePeriod['id'], self::PHASE_NUMBER);
        if ((int) $announcement->is_published !== 1) {
            return redirect()->back()->with('error', 'Pengumuman belum dipublish.');
        }

        if (empty($announcement->sk_file_path)) {
            return redirect()->back()->with('error', 'File SK tidak ditemukan.');
        }

        $absPath = WRITEPATH . $announcement->sk_file_path;
        if (!is_file($absPath)) {
            return redirect()->back()->with('error', 'File SK tidak ditemukan di server.');
        }

        return $this->response->download($absPath, null)
            ->setFileName($announcement->sk_original_name ?? basename($absPath));
    }
}
