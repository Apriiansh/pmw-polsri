<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Services\PmwAnnouncementService;
use App\Services\PmwPhaseAccessService;
use App\Services\PmwSelectionService;
use App\Services\PmwTrainingReportService;

class TrainingController extends BaseController
{
    private const PHASE_NUMBER = 6;

    public function index()
    {
        $phaseAccess = new PmwPhaseAccessService();
        $announcementService = new PmwAnnouncementService();
        $selectionService = new PmwSelectionService();
        $trainingReportService = new PmwTrainingReportService();
        $proposalModel = new PmwProposalModel();

        $activePeriod = $phaseAccess->getActivePeriod();
        if (!$activePeriod) {
            return view('mahasiswa/pembekalan/index', [
                'title'           => 'Pembekalan',
                'activePeriod'    => null,
                'phase'           => null,
                'isPhaseOpen'     => false,
                'isPassed'        => false,
                'announcement'    => null,
                'proposal'        => null,
                'trainingReport'  => null,
                'photos'          => [],
                'hasCompleteData' => false,
            ]);
        }

        // Get Phase 5 announcement for training info
        $announcementPhase5 = $announcementService->getOrCreatePhaseAnnouncement((int) $activePeriod['id'], 5);

        $phase = $phaseAccess->getPhaseForActivePeriod(self::PHASE_NUMBER);
        $isPhaseOpen = $phaseAccess->isPhaseOpen($phase);

        $user = auth()->user();
        $isPassed = ($user) ? $selectionService->leaderPassedStage1((int) $activePeriod['id'], (int) $user->id) : false;

        $proposal = null;
        $trainingReport = null;
        $photos = [];
        $hasCompleteData = false;

        if ($user && $activePeriod && $isPassed) {
            $proposal = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);
            if ($proposal) {
                $trainingReport = $trainingReportService->getOrCreate((int) $proposal['id'], (int) $activePeriod['id']);
                $photos = $trainingReportService->getPhotos($trainingReport->id);
                $hasCompleteData = $trainingReportService->hasCompleteData((int) $proposal['id']);
            }
        }

        return view('mahasiswa/pembekalan/index', [
            'title'           => 'Pembekalan',
            'activePeriod'    => $activePeriod,
            'phase'           => $phase,
            'isPhaseOpen'     => $isPhaseOpen,
            'isPassed'        => $isPassed,
            'announcement'    => $announcementPhase5,
            'proposal'        => $proposal,
            'trainingReport'  => $trainingReport,
            'photos'          => $photos,
            'hasCompleteData' => $hasCompleteData,
        ]);
    }

    public function save()
    {
        $phaseAccess = new PmwPhaseAccessService();
        $selectionService = new PmwSelectionService();
        $trainingReportService = new PmwTrainingReportService();
        $proposalModel = new PmwProposalModel();

        $activePeriod = $phaseAccess->getActivePeriod();
        if (!$activePeriod) {
            return redirect()->back()->with('error', 'Periode aktif tidak ditemukan.');
        }

        $phase = $phaseAccess->getPhaseForActivePeriod(self::PHASE_NUMBER);
        if (!$phaseAccess->isPhaseOpen($phase)) {
            return redirect()->back()->with('error', 'Input laporan pembekalan hanya bisa dilakukan saat Tahap 6 dibuka.');
        }

        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('error', 'Silakan login terlebih dahulu.');
        }

        $isPassed = $selectionService->leaderPassedStage1((int) $activePeriod['id'], (int) $user->id);
        if (!$isPassed) {
            return redirect()->back()->with('error', 'Anda belum lolos Tahap I.');
        }

        $proposal = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);
        if (!$proposal) {
            return redirect()->back()->with('error', 'Data proposal tidak ditemukan.');
        }

        $summary = $this->request->getPost('summary');
        if (empty($summary)) {
            return redirect()->back()->with('error', 'Ringkasan pembekalan wajib diisi.')->withInput();
        }

        // Save or get training report
        $trainingReport = $trainingReportService->getOrCreate((int) $proposal['id'], (int) $activePeriod['id']);

        // Update summary
        $trainingReportService->save((int) $proposal['id'], (int) $activePeriod['id'], $summary);

        // Handle photo uploads
        $files = $this->request->getFiles();
        if (!empty($files['photos'])) {
            try {
                $trainingReportService->uploadPhotos($trainingReport->id, $files['photos']);
            } catch (\Throwable $e) {
                return redirect()->back()->with('error', 'Upload foto: ' . $e->getMessage())->withInput();
            }
        }

        return redirect()->to('mahasiswa/pembekalan')->with('success', 'Laporan pembekalan berhasil disimpan.');
    }

    public function deletePhoto(int $photoId)
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $phaseAccess = new PmwPhaseAccessService();
        $selectionService = new PmwSelectionService();
        $trainingReportService = new PmwTrainingReportService();
        $proposalModel = new PmwProposalModel();

        $activePeriod = $phaseAccess->getActivePeriod();
        if (!$activePeriod) {
            return $this->response->setJSON(['success' => false, 'message' => 'Periode aktif tidak ditemukan.']);
        }

        $user = auth()->user();
        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'Silakan login terlebih dahulu.']);
        }

        $isPassed = $selectionService->leaderPassedStage1((int) $activePeriod['id'], (int) $user->id);
        if (!$isPassed) {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses ditolak.']);
        }

        $proposal = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);
        if (!$proposal) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data proposal tidak ditemukan.']);
        }

        $ok = $trainingReportService->deletePhoto($photoId);

        return $this->response->setJSON([
            'success' => $ok,
            'message' => $ok ? 'Foto berhasil dihapus.' : 'Gagal menghapus foto.',
        ]);
    }

    public function downloadPhoto(int $photoId)
    {
        $phaseAccess = new PmwPhaseAccessService();
        $selectionService = new PmwSelectionService();
        $trainingReportService = new PmwTrainingReportService();
        $proposalModel = new PmwProposalModel();

        $activePeriod = $phaseAccess->getActivePeriod();
        if (!$activePeriod) {
            return redirect()->back()->with('error', 'Periode aktif tidak ditemukan.');
        }

        $user = auth()->user();
        if (!$user) {
            return redirect()->back()->with('error', 'Silakan login terlebih dahulu.');
        }

        $isPassed = $selectionService->leaderPassedStage1((int) $activePeriod['id'], (int) $user->id);
        if (!$isPassed) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        $proposal = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);
        if (!$proposal) {
            return redirect()->back()->with('error', 'Data proposal tidak ditemukan.');
        }

        $trainingReport = $trainingReportService->findByProposal((int) $proposal['id']);
        if (!$trainingReport) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }

        $photos = $trainingReportService->getPhotos($trainingReport->id);
        $photo = null;
        foreach ($photos as $p) {
            if ($p->id === $photoId) {
                $photo = $p;
                break;
            }
        }

        if (!$photo || empty($photo->file_path)) {
            return redirect()->back()->with('error', 'Foto tidak ditemukan.');
        }

        $absPath = WRITEPATH . $photo->file_path;
        if (!is_file($absPath)) {
            return redirect()->back()->with('error', 'File foto tidak ditemukan di server.');
        }

        return $this->response->download($absPath, null)
            ->setFileName($photo->original_name ?? basename($absPath));
    }
}
