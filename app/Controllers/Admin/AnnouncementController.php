<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\PmwAnnouncementService;
use App\Services\PmwPhaseAccessService;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\IncomingRequest;

/**
 * @property IncomingRequest $request
 */
class AnnouncementController extends BaseController
{
    use ResponseTrait;

    private const PHASE_NUMBER = 5;

    public function index()
    {
        $phaseAccess = new PmwPhaseAccessService();
        $announcementService = new PmwAnnouncementService();

        $activePeriod = $phaseAccess->getActivePeriod();
        $phase = null;
        $isPhaseOpen = false;

        $announcement = null;

        $passedTeams = [];
        $bankAccounts = [];

        if ($activePeriod) {
            $phase = $phaseAccess->getPhaseForActivePeriod(self::PHASE_NUMBER);
            $isPhaseOpen = $phaseAccess->isPhaseOpen($phase);

            $announcement = $announcementService->getOrCreatePhaseAnnouncement((int) $activePeriod['id'], self::PHASE_NUMBER);
            
            $selectionService = new \App\Services\PmwSelectionService();
            $bankAccountModel = new \App\Models\AnnouncementFunding\PmwBankAccountModel();
            
            $passedTeams = $selectionService->getPassedStage1Teams((int) $activePeriod['id']);
            $dbBankAccs = $bankAccountModel->findByPeriod((int) $activePeriod['id']);
            foreach ($dbBankAccs as $ba) {
                $bankAccounts[$ba->proposal_id] = $ba;
            }
        }

        return view('admin/pengumuman', [
            'title'           => 'Pengumuman Kelolosan Dana Tahap I | PMW Polsri',
            'activePeriod'    => $activePeriod,
            'phase'           => $phase,
            'isPhaseOpen'     => $isPhaseOpen,
            'announcement'    => $announcement,
            'passedTeams'     => $passedTeams,
            'bankAccounts'    => $bankAccounts,
        ]);
    }

    public function save(int $announcementId)
    {
        $service = new PmwAnnouncementService();

        $data = [
            'title'              => (string) $this->request->getPost('title'),
            'content'            => (string) $this->request->getPost('content'),
            'training_date'      => $this->request->getPost('training_date') ?: null,
            'training_location'  => (string) $this->request->getPost('training_location'),
            'training_details'   => (string) $this->request->getPost('training_details'),
        ];

        $ok = $service->updateAnnouncement($announcementId, $data);

        if ($ok) {
            return redirect()->back()->with('success', 'Pengumuman berhasil disimpan.');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan pengumuman.');
    }

    public function uploadSk(int $announcementId)
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $file = $this->request->getFile('sk_file');
        if (!$file) {
            return $this->respond(['success' => false, 'message' => 'File tidak ditemukan.']);
        }

        $service = new PmwAnnouncementService();

        try {
            $path = $service->uploadSkFile($announcementId, $file);
            return $this->respond([
                'success' => true,
                'message' => 'File SK berhasil diunggah.',
                'path'    => $path,
                'filename' => $file->getClientName()
            ]);
        } catch (\Throwable $e) {
            return $this->respond(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function deleteSk(int $announcementId)
    {
        if (!$this->request->is('ajax')) {
            return redirect()->back();
        }

        $service = new PmwAnnouncementService();

        $ok = $service->deleteSkFile($announcementId);

        return $this->respond(['success' => $ok, 'message' => $ok ? 'File SK dihapus.' : 'Gagal menghapus file SK.']);
    }

    public function downloadSk(int $announcementId)
    {
        $service = new PmwAnnouncementService();
        $announcement = $service->getAnnouncementById($announcementId);

        if (!$announcement || empty($announcement->sk_file_path)) {
            return redirect()->back()->with('error', 'File SK tidak ditemukan.');
        }

        $absPath = WRITEPATH . $announcement->sk_file_path;
        if (!is_file($absPath)) {
            return redirect()->back()->with('error', 'File SK tidak ditemukan di server.');
        }

        return $this->response->download($absPath, null)
            ->setFileName($announcement->sk_original_name ?? basename($absPath));
    }

    public function publish(int $announcementId)
    {
        $service = new PmwAnnouncementService();
        $selectionService = new \App\Services\PmwSelectionService();
        $notifModel = new \App\Models\NotificationModel();

        if ($service->publishAnnouncement($announcementId)) {
            // Get announcement to find the period
            $announcement = $service->getAnnouncementById($announcementId);
            
            if ($announcement) {
                // Broadcast to all teams that passed Stage 1 (Wawancara) in this period
                $teams = $selectionService->getPassedStage1Teams((int)$announcement->period_id);
                
                $db = \Config\Database::connect();
                foreach ($teams as $team) {
                    $prop = $db->table('pmw_proposals')->select('leader_user_id')->where('id', $team['id'])->get()->getRow();
                    if ($prop) {
                        $notifModel->createAnnouncementPublishedNotification((int)$prop->leader_user_id);
                    }
                }
            }

            return redirect()->back()->with('success', 'Pengumuman berhasil dipublish.');
        }

        return redirect()->back()->with('error', 'Gagal mempublish pengumuman.');
    }

    public function downloadTeamBankBook(int $bankAccountId)
    {
        $bankAccountModel = new \App\Models\AnnouncementFunding\PmwBankAccountModel();
        $bankAccount = $bankAccountModel->find($bankAccountId);

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

}
