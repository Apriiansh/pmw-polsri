<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\PmwDocumentModel;
use App\Models\PmwPeriodModel;
use App\Models\PmwScheduleModel;
use CodeIgniter\HTTP\ResponseInterface;

class PitchingDeskController extends BaseController
{
    protected $helpers = ['form', 'url', 'text', 'pmw'];

    private const PHASE_NUMBER_PITCHING = 3;

    /**
     * Tahap 3 - Pitching Desk
     * Mahasiswa dengan proposal approved mengikuti pitching desk
     */
    public function index()
    {
        $user = auth()->user();
        $proposalModel = new PmwProposalModel();
        $documentModel = new PmwDocumentModel();
        $periodModel = new PmwPeriodModel();
        $scheduleModel = new PmwScheduleModel();

        // Get active period
        $activePeriod = $periodModel->getActive();

        // Get proposal with status approved for this user
        $proposal = $proposalModel->where('leader_user_id', $user->id)
            ->where('status', 'approved')
            ->first();

        // Check phase schedule
        $phase = null;
        $isPhaseOpen = false;
        if ($activePeriod) {
            $phase = $scheduleModel->getByPeriodAndPhase((int) $activePeriod['id'], self::PHASE_NUMBER_PITCHING);
            $isPhaseOpen = $this->isPhaseOpen($phase);
        }

        // Get existing documents
        $docsByKey = [];
        if ($proposal) {
            $documents = $documentModel->where('proposal_id', $proposal['id'])->findAll();
            foreach ($documents as $doc) {
                if (!empty($doc['doc_key'])) {
                    $docsByKey[$doc['doc_key']] = $doc;
                }
            }
        }

        return view('mahasiswa/pitching_desk', [
            'title'           => 'Pitching Desk | PMW Polsri',
            'header_title'    => 'Pitching Desk',
            'header_subtitle' => 'Tahap 3 - Presentasi proposal di depan reviewer',
            'proposal'        => $proposal,
            'activePeriod'    => $activePeriod,
            'phase'           => $phase,
            'isPhaseOpen'     => $isPhaseOpen,
            'docsByKey'       => $docsByKey,
        ]);
    }

    /**
     * Upload PPT for pitching desk
     */
    public function uploadPpt()
    {
        $user = auth()->user();
        $proposalModel = new PmwProposalModel();
        $documentModel = new PmwDocumentModel();

        $proposal = $proposalModel->where('leader_user_id', $user->id)
            ->where('status', 'approved')
            ->first();

        if (!$proposal) {
            return $this->response->setJSON(['success' => false, 'message' => 'Proposal tidak ditemukan']);
        }

        $file = $this->request->getFile('ppt_file');
        if (!$file || !$file->isValid()) {
            $errorMsg = $file ? $file->getErrorString() . ' (' . $file->getError() . ')' : 'File tidak terlampir';
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid: ' . $errorMsg]);
        }

        // Validate file
        $allowedTypes = [
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/pdf',
            'application/zip',
            'application/octet-stream'
        ];
        $clientMime = $file->getMimeType();
        $clientExt = strtolower($file->getClientExtension());

        if (!in_array($clientExt, ['ppt', 'pptx', 'pdf']) && !in_array($clientMime, $allowedTypes)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Format file harus PPT, PPTX, atau PDF']);
        }

        if ($file->getSize() > 10 * 1024 * 1024) { // 10MB max
            return $this->response->setJSON(['success' => false, 'message' => 'Ukuran file maksimal 10MB']);
        }

        // Upload file
        $newName = $file->getRandomName();
        $uploadPath = 'uploads/proposals/' . $proposal['id'] . '/pitching';

        if (!is_dir(WRITEPATH . $uploadPath)) {
            mkdir(WRITEPATH . $uploadPath, 0755, true);
        }

        if ($file->move(WRITEPATH . $uploadPath, $newName)) {
            // Remove old PPT if exists
            $existingDoc = $documentModel->where('proposal_id', $proposal['id'])
                ->where('doc_key', 'pitching_ppt')
                ->first();
            if ($existingDoc && !empty($existingDoc['file_path'])) {
                $oldPath = WRITEPATH . $existingDoc['file_path'];
                if (is_file($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Save document record
            $docData = [
                'proposal_id'   => $proposal['id'],
                'doc_key'       => 'pitching_ppt',
                'original_name' => $file->getClientName(),
                'file_path'     => $uploadPath . '/' . $newName,
                'type'          => 'pitching',
                'created_at'    => date('Y-m-d H:i:s'),
            ];

            if ($existingDoc) {
                $documentModel->update($existingDoc['id'], $docData);
            } else {
                $documentModel->insert($docData);
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'PPT berhasil diunggah',
                'filename' => $file->getClientName()
            ]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengunggah file']);
    }

    /**
     * Update Video URL (only for Berkembang)
     */
    public function updateVideoUrl()
    {
        $user = auth()->user();
        $proposalModel = new PmwProposalModel();

        $proposal = $proposalModel->where('leader_user_id', $user->id)
            ->where('status', 'approved')
            ->first();

        if (!$proposal) {
            return $this->response->setJSON(['success' => false, 'message' => 'Proposal tidak ditemukan']);
        }

        if ($proposal['kategori_wirausaha'] !== 'berkembang') {
            return $this->response->setJSON(['success' => false, 'message' => 'Hanya untuk kategori Berkembang']);
        }

        $videoUrl = $this->request->getPost('video_url');

        if (empty($videoUrl)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Link video tidak boleh kosong']);
        }

        // Basic domain validation (YouTube or Google Drive)
        $isYoutube = strpos($videoUrl, 'youtube.com') !== false || strpos($videoUrl, 'youtu.be') !== false;
        $isGDrive = strpos($videoUrl, 'drive.google.com') !== false || strpos($videoUrl, 'google.com/drive') !== false || strpos($videoUrl, 'drive.google.com/file/') !== false;

        if (!$isYoutube && !$isGDrive) {
            return $this->response->setJSON(['success' => false, 'message' => 'Link harus berupa YouTube atau Google Drive']);
        }

        $proposalModel->update($proposal['id'], [
            'video_url' => $videoUrl,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Link video berhasil disimpan'
        ]);
    }

    /**
     * Update detail keterangan (only for Berkembang)
     */
    public function updateDetail()
    {
        $user = auth()->user();
        $proposalModel = new PmwProposalModel();

        $proposal = $proposalModel->where('leader_user_id', $user->id)
            ->where('status', 'approved')
            ->first();

        if (!$proposal) {
            return $this->response->setJSON(['success' => false, 'message' => 'Proposal tidak ditemukan']);
        }

        if ($proposal['kategori_wirausaha'] !== 'berkembang') {
            return $this->response->setJSON(['success' => false, 'message' => 'Hanya untuk kategori Berkembang']);
        }

        $detailKeterangan = $this->request->getPost('detail_keterangan');

        $proposalModel->update($proposal['id'], [
            'detail_keterangan' => $detailKeterangan,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Detail keterangan berhasil diperbarui'
        ]);
    }

    private function isPhaseOpen(?array $phase): bool
    {
        if (!$phase) return false;
        $now = date('Y-m-d H:i:s');
        return $now >= $phase['start_date'] && $now <= $phase['end_date'];
    }
}
