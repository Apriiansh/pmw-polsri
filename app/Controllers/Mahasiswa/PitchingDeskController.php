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
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid']);
        }

        // Validate file
        $allowedTypes = ['application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'];
        if (!in_array($file->getMimeType(), $allowedTypes) && !in_array($file->getClientExtension(), ['ppt', 'pptx'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Format file harus PPT atau PPTX']);
        }

        if ($file->getSize() > 20 * 1024 * 1024) { // 20MB max
            return $this->response->setJSON(['success' => false, 'message' => 'Ukuran file maksimal 20MB']);
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
     * Upload Video Usaha (only for Berkembang)
     */
    public function uploadVideo()
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

        if ($proposal['kategori_wirausaha'] !== 'berkembang') {
            return $this->response->setJSON(['success' => false, 'message' => 'Hanya untuk kategori Berkembang']);
        }

        $file = $this->request->getFile('video_file');
        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid']);
        }

        // Validate video file
        $allowedExts = ['mp4', 'mov', 'avi', 'mkv', 'webm'];
        if (!in_array(strtolower($file->getClientExtension()), $allowedExts)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Format video harus MP4, MOV, AVI, MKV, atau WEBM']);
        }

        if ($file->getSize() > 100 * 1024 * 1024) { // 100MB max
            return $this->response->setJSON(['success' => false, 'message' => 'Ukuran video maksimal 100MB']);
        }

        // Upload file
        $newName = $file->getRandomName();
        $uploadPath = 'uploads/proposals/' . $proposal['id'] . '/pitching';

        if (!is_dir(WRITEPATH . $uploadPath)) {
            mkdir(WRITEPATH . $uploadPath, 0755, true);
        }

        if ($file->move(WRITEPATH . $uploadPath, $newName)) {
            // Remove old video if exists
            $existingDoc = $documentModel->where('proposal_id', $proposal['id'])
                ->where('doc_key', 'pitching_video')
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
                'doc_key'       => 'pitching_video',
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
                'message' => 'Video berhasil diunggah',
                'filename' => $file->getClientName()
            ]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengunggah file']);
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
