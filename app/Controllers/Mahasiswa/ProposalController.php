<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\LecturerModel;
use App\Models\ProfileModel;
use App\Models\PmwDocumentModel;
use App\Models\PmwPeriodModel;
use App\Models\PmwScheduleModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalAssignmentModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\NotificationModel;
use App\Models\Selection\PmwSelectionProposalModel;
use App\Models\Proposal\PmwRabItemModel;

class ProposalController extends BaseController
{
    private const PHASE_NUMBER_PROPOSAL = 2;

    private const REQUIRED_DOC_KEYS = [
        'proposal_utama',
        'surat_kesediaan_dosen',
    ];

    public function index()
    {
        $this->checkAndFlashNotifications();

        $periodModel   = new PmwPeriodModel();
        $scheduleModel = new PmwScheduleModel();
        $proposalModel = new PmwProposalModel();

        $activePeriod = $periodModel->getActive();
        $phase1 = null;
        $isPhaseOpen = false;

        if ($activePeriod) {
            $phase1 = $scheduleModel->getByPeriodAndPhase((int) $activePeriod['id'], self::PHASE_NUMBER_PROPOSAL);
            $isPhaseOpen = $this->isPhaseOpen($phase1);
        }

        $user = auth()->user();
        $proposal = null;
        if ($activePeriod && $user) {
            $proposal = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);
        }

        // Gate: hanya bisa akses jika pitching_admin_status = approved
        if ($proposal && ($proposal['pitching_admin_status'] ?? '') !== 'approved') {
            return redirect()->to('mahasiswa/pitching-desk')
                ->with('info', 'Selesaikan Tahap 1 (Administrasi & Desk Evaluation) terlebih dahulu sebelum mengakses Business Plan.');
        }

        // Jika sudah ada draft/proposal, langsung ke form edit
        if ($proposal) {
            return redirect()->to("mahasiswa/proposal/edit/{$proposal['id']}");
        }

        // Jika belum ada proposal sama sekali dan pitching belum ada
        if (!$proposal && $activePeriod && $user) {
            return redirect()->to('mahasiswa/pitching-desk')
                ->with('info', 'Selesaikan Tahap 1 (Administrasi & Desk Evaluation) terlebih dahulu.');
        }

        return view('mahasiswa/proposal', [
            'title'        => 'Proposal Kami',
            'activePeriod' => $activePeriod,
            'phase1'       => $phase1,
            'isPhaseOpen'  => $isPhaseOpen,
            'proposal'     => $proposal,
        ]);
    }

    /**
     * Check for unread notifications and flash as toast messages
     */
    private function checkAndFlashNotifications(): void
    {
        $user = auth()->user();
        if (!$user) return;

        $notificationModel = new NotificationModel();
        $unread = $notificationModel->getUnread((int) $user->id, 3);

        foreach ($unread as $notif) {
            $type = match ($notif['type']) {
                'proposal_approved' => 'success',
                'proposal_rejected' => 'error',
                'proposal_revision' => 'warning',
                default => 'info',
            };

            // Flash as toast notification
            session()->setFlashdata($type, $notif['message']);

            // Mark as read so it won't show again
            $notificationModel->markAsRead((int) $notif['id']);
        }
    }

    public function create()
    {
        $periodModel  = new PmwPeriodModel();
        $proposalModel = new PmwProposalModel();
        $activePeriod = $periodModel->getActive();
        $user = auth()->user();

        // Cegah duplikat: jika sudah punya proposal, redirect ke edit
        if ($activePeriod && $user) {
            $existing = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);
            if ($existing) {
                return redirect()->to("mahasiswa/proposal/edit/{$existing['id']}");
            }
        }

        $ctx = $this->buildFormContext(null);
        return view('mahasiswa/proposal', $ctx);
    }

    public function edit(int $id)
    {
        $this->checkAndFlashNotifications();

        $proposalModel = new PmwProposalModel();
        $proposal = $proposalModel->getProposalForValidation($id);
        if (! $proposal) {
            return redirect()->to('mahasiswa/proposal')->with('error', 'Proposal tidak ditemukan');
        }

        $this->guardOwner((int) $proposal['leader_user_id']);

        // Gate: pitching harus sudah admin approved
        if (($proposal['pitching_admin_status'] ?? '') !== 'approved') {
            return redirect()->to('mahasiswa/pitching-desk')
                ->with('info', 'Selesaikan Tahap 1 (Administrasi & Desk Evaluation) terlebih dahulu.');
        }

        $ctx = $this->buildFormContext($proposal);
        return view('mahasiswa/proposal', $ctx);
    }

    public function save()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect()->to('login');
        }

        $periodModel = new PmwPeriodModel();
        $activePeriod = $periodModel->getActive();
        if (! $activePeriod) {
            return redirect()->back()->withInput()->with('error', 'Tidak ada periode PMW yang aktif');
        }

        $isFinal = (string) $this->request->getPost('is_final_submit') === '1';

        $rules = [
            'lecturer_id' => $isFinal ? 'required|integer' : 'permit_empty|integer',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $proposalModel   = new PmwProposalModel();
        $assignmentModel = new PmwProposalAssignmentModel();

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $existing = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);

            if (!$existing) {
                throw new \RuntimeException('Selesaikan Tahap 1 (Administrasi & Desk Evaluation) terlebih dahulu.');
            }

            $proposalId = (int) $existing['id'];

            // Sync RAB items
            $rabModel = new PmwRabItemModel();
            $rabItems = $this->request->getPost('rab_items') ?? [];
            $rabModel->syncItems($proposalId, is_array($rabItems) ? $rabItems : []);
            $totalRab = $rabModel->getTotalByProposal($proposalId);

            // Update proposal (RAB total dihitung otomatis dari rincian)
            $proposalData = [
                'total_rab' => $totalRab ?: null,
                'status'    => 'draft',
            ];

            if (! $proposalModel->update($proposalId, $proposalData)) {
                throw new \RuntimeException('Gagal menyimpan proposal');
            }

            // Sync Assignments (Lecturer)
            $lecturerId = $this->request->getPost('lecturer_id');
            $existingAssignment = $assignmentModel->where('proposal_id', $proposalId)->first();
            $assignmentData = [
                'proposal_id' => $proposalId,
                'lecturer_id' => $lecturerId ?: null,
            ];

            if ($existingAssignment) {
                $assignmentModel->update($existingAssignment->id, $assignmentData);
            } else {
                $assignmentModel->insert($assignmentData);
            }

            $db->transCommit();

            // Handle file uploads after successful database transaction 
            try {
                $this->handleFileUploads($proposalId);
            } catch (\Exception $e) {
                return redirect()->to('mahasiswa/proposal/edit/' . $proposalId)->with('message', 'Draft proposal berhasil disimpan, namun beberapa dokumen gagal diunggah: ' . $e->getMessage());
            }

            // Check if user wants to finalize submission
            if ($this->request->getPost('is_final_submit') === '1') {
                try {
                    $this->finalizeSubmission($proposalId);
                    return redirect()->to('mahasiswa/proposal')->with('message', 'Proposal berhasil dikirim final');
                } catch (\Exception $e) {
                    return redirect()->to('mahasiswa/proposal/edit/' . $proposalId)->with('error', 'Draft tersimpan, namun gagal mengirim: ' . $e->getMessage());
                }
            }

            return redirect()->to('mahasiswa/proposal/edit/' . $proposalId)->with('message', 'Draft proposal berhasil disimpan');
        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function uploadDoc(int $proposalId)
    {
        $proposalModel = new PmwProposalModel();
        $proposal = $proposalModel->find($proposalId);
        if (! $proposal) {
            return redirect()->back()->with('error', 'Proposal tidak ditemukan');
        }

        $this->guardOwner((int) $proposal['leader_user_id']);

        $docKey = (string) $this->request->getPost('doc_key');
        if (! in_array($docKey, self::REQUIRED_DOC_KEYS, true)) {
            return redirect()->back()->with('error', 'Tipe dokumen tidak valid');
        }

        $file = $this->request->getFile('file');
        if (! $file || ! $file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid');
        }

        if (strtolower((string) $file->getClientExtension()) !== 'pdf') {
            return redirect()->back()->with('error', 'Format file harus PDF');
        }

        if ($file->getSize() > 5 * 1024 * 1024) {
            return redirect()->back()->with('error', 'Ukuran file maksimal 5MB');
        }

        $user = auth()->user();

        $documentModel = new PmwDocumentModel();
        $existing = $documentModel->getProposalDocByKey($proposalId, $docKey);

        $newName = $file->getRandomName();
        $targetDir = WRITEPATH . 'uploads/pmw/proposals/' . $proposalId;

        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        $file->move($targetDir, $newName);
        $path = 'uploads/pmw/proposals/' . $proposalId . '/' . $newName;

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            if ($existing) {
                $documentModel->update((int) $existing['id'], [
                    'proposal_id'    => $proposalId,
                    'uploader_id'    => $user->id,
                    'type'           => 'proposal',
                    'doc_key'        => $docKey,
                    'file_path'      => $path,
                    'original_name'  => $file->getClientName(),
                    'status'         => 'submitted',
                    'version'        => ((int) ($existing['version'] ?? 1)) + 1,
                ]);
            } else {
                $documentModel->insert([
                    'team_id'        => null,
                    'proposal_id'    => $proposalId,
                    'uploader_id'    => $user->id,
                    'type'           => 'proposal',
                    'doc_key'        => $docKey,
                    'file_path'      => $path,
                    'original_name'  => $file->getClientName(),
                    'status'         => 'submitted',
                    'version'        => 1,
                ]);
            }

            $db->transCommit();

            if ($existing && ! empty($existing['file_path'])) {
                $oldAbs = WRITEPATH . $existing['file_path'];
                if (is_file($oldAbs)) {
                    unlink($oldAbs);
                }
            }

            return redirect()->back()->with('message', 'Dokumen berhasil diupload');
        } catch (\Throwable $e) {
            $db->transRollback();

            $abs = WRITEPATH . $path;
            if (is_file($abs)) {
                unlink($abs);
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function submit(int $id)
    {
        try {
            $this->finalizeSubmission($id);
            return redirect()->to('mahasiswa/proposal')->with('message', 'Proposal berhasil dikirim');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function reset(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $proposal = $proposalModel->find($id);

        if (!$proposal) {
            return redirect()->to('mahasiswa/proposal')->with('error', 'Proposal tidak ditemukan');
        }

        try {
            $this->guardOwner((int)$proposal['leader_user_id']);
        } catch (\Exception $e) {
            return redirect()->to('mahasiswa/proposal')->with('error', 'Akses ditolak');
        }

        // Only allowed if rejected (as per user request)
        if ($proposal['status'] !== 'rejected') {
            return redirect()->back()->with('error', 'Hanya proposal yang ditolak yang dapat dibuat ulang.');
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            // 1. Delete Documents (and physical files)
            $documentModel = new PmwDocumentModel();
            $docs = $documentModel->where('proposal_id', $id)->findAll();
            foreach ($docs as $doc) {
                if (!empty($doc['file_path'])) {
                    $abs = WRITEPATH . $doc['file_path'];
                    if (is_file($abs)) {
                        @unlink($abs);
                    }
                }
                $documentModel->delete($doc['id']);
            }

            // 2. Delete Physical Folder if empty or generally cleanup
            $folderName = "proposal_{$id}";
            $targetDir = WRITEPATH . 'uploads/pmw/proposals/' . $folderName;
            if (is_dir($targetDir)) {
                $this->deleteDirectory($targetDir);
            }

            // 3. Delete Members
            $memberModel = new PmwProposalMemberModel();
            $memberModel->where('proposal_id', $id)->delete();

            // 4. Delete Proposal
            $proposalModel->delete($id);

            $db->transCommit();
            return redirect()->to('mahasiswa/proposal/create')->with('message', 'Proposal berhasil dihapus. Silakan buat proposal baru.');
        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal mereset proposal: ' . $e->getMessage());
        }
    }

    /**
     * Helper to recursively delete a directory
     */
    private function deleteDirectory(string $dir): bool
    {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        return rmdir($dir);
    }


    private function finalizeSubmission(int $id): void
    {
        $periodModel   = new PmwPeriodModel();
        $scheduleModel = new PmwScheduleModel();
        $proposalModel = new PmwProposalModel();
        $documentModel = new PmwDocumentModel();

        $proposal = $proposalModel->find($id);
        if (! $proposal) {
            throw new \RuntimeException('Proposal tidak ditemukan');
        }

        $this->guardOwner((int) $proposal['leader_user_id']);

        $activePeriod = $periodModel->getActive();
        if (! $activePeriod || (int) $activePeriod['id'] !== (int) $proposal['period_id']) {
            throw new \RuntimeException('Periode aktif tidak sesuai');
        }

        $phase1 = $scheduleModel->getByPeriodAndPhase((int) $activePeriod['id'], self::PHASE_NUMBER_PROPOSAL);
        if (! $this->isPhaseOpen($phase1)) {
            throw new \RuntimeException('Pengajuan proposal sedang ditutup sesuai jadwal');
        }

        foreach (self::REQUIRED_DOC_KEYS as $key) {
            $doc = $documentModel->getProposalDocByKey((int) $proposal['id'], $key);
            if (! $doc) {
                throw new \RuntimeException('Dokumen belum lengkap: ' . $key);
            }
        }

        $proposalModel->update((int) $proposal['id'], [
            'status'       => 'submitted',
            'submitted_at' => date('Y-m-d H:i:s'),
        ]);

        // Upsert pmw_selection_proposal record
        $selectionModel = new PmwSelectionProposalModel();
        $selectionModel->upsert((int) $proposal['id'], [
            'student_submitted_at' => date('Y-m-d H:i:s'),
            'dosen_status'         => 'pending',
            'admin_status'         => 'pending',
        ]);

        // Create notification for admins
        $notificationModel = new NotificationModel();
        $memberModel = new PmwProposalMemberModel();
        $ketua = $memberModel->where('proposal_id', $id)
                             ->where('role', 'ketua')
                             ->first();

        $notificationModel->createProposalNotification(
            $id,
            $proposal['nama_usaha'] ?? 'Tanpa Nama',
            $ketua['nama'] ?? 'Ketua Tim'
        );

        // Kirim notifikasi ke dosen pendamping yang di-assign
        $assignmentModel = new PmwProposalAssignmentModel();
        $assignment = $assignmentModel->where('proposal_id', $id)->first();
        if ($assignment && $assignment->lecturer_id) {
            $lecturerModel = new \App\Models\LecturerModel();
            $lecturer = $lecturerModel->find($assignment->lecturer_id);
            if ($lecturer && !empty($lecturer['user_id'])) {
                $notificationModel->createProposalDosenNotification(
                    (int) $lecturer['user_id'],
                    $id,
                    $proposal['nama_usaha'] ?? 'Tanpa Nama',
                    $ketua['nama'] ?? 'Ketua Tim'
                );
            }
        }
    }

    public function downloadDoc(int $docId)
    {
        $documentModel = new PmwDocumentModel();
        $proposalModel = new PmwProposalModel();

        $doc = $documentModel->find($docId);
        if (! $doc || empty($doc['proposal_id'])) {
            return redirect()->to('mahasiswa/proposal')->with('error', 'Dokumen tidak ditemukan');
        }

        $proposal = $proposalModel->find((int) $doc['proposal_id']);
        if (! $proposal) {
            return redirect()->to('mahasiswa/proposal')->with('error', 'Proposal tidak ditemukan');
        }

        $this->guardOwner((int) $proposal['leader_user_id']);

        $abs = WRITEPATH . $doc['file_path'];
        if (! is_file($abs)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        // Handle inline preview for modal
        if ($this->request->getGet('inline')) {
            $file = new \CodeIgniter\Files\File($abs);
            $mime = $file->getMimeType();
            
            return $this->response
                ->setHeader('Content-Type', $mime)
                ->setHeader('Content-Disposition', 'inline; filename="' . $doc['original_name'] . '"')
                ->setBody(file_get_contents($abs));
        }

        return $this->response->download($abs, null)->setFileName($doc['original_name'] ?? basename($abs));
    }

    private function buildFormContext(?array $proposal): array
    {
        $periodModel   = new PmwPeriodModel();
        $scheduleModel = new PmwScheduleModel();
        $memberModel     = new PmwProposalMemberModel();
        $assignmentModel = new PmwProposalAssignmentModel();
        $documentModel   = new PmwDocumentModel();
        $lecturerModel   = new LecturerModel();
        $profileModel    = new ProfileModel();

        $activePeriod = $periodModel->getActive();
        $phase1 = null;
        $isPhaseOpen = false;
        if ($activePeriod) {
            $phase1 = $scheduleModel->getByPeriodAndPhase((int) $activePeriod['id'], self::PHASE_NUMBER_PROPOSAL);
            $isPhaseOpen = $this->isPhaseOpen($phase1);
        }

        $user = auth()->user();
        $profile = null;
        if ($user) {
            $profile = $profileModel->where('user_id', (int) $user->id)->first();
            // Debug: log if profile not found
            if (!$profile) {
                log_message('warning', 'ProposalController: Profile not found for user_id=' . $user->id);
            }
        }

        $members = [];
        $docsByKey = [];
        $proposalSelection = null;
        $rabItems = [];

        if ($proposal) {
            // Fetch Assignment info (Lecturer)
            $assignment = $assignmentModel->where('proposal_id', (int) $proposal['id'])->first();
            if ($assignment) {
                // Manually inject lecturer_id into the proposal array for the view
                $proposal['lecturer_id'] = $assignment->lecturer_id ?? null;
            }

            $members = $memberModel->getByProposalId((int) $proposal['id']);
            $docs = $documentModel->getProposalDocs((int) $proposal['id']);
            foreach ($docs as $d) {
                if (! empty($d['doc_key'])) {
                    $docsByKey[$d['doc_key']] = $d;
                }
            }

            $selectionModel = new PmwSelectionProposalModel();
            $proposalSelection = $selectionModel->getByProposal((int) $proposal['id']);

            $rabModel = new PmwRabItemModel();
            $rabItems = $rabModel->getByProposal((int) $proposal['id']);
        }

        $lecturers = $lecturerModel->getAllWithAssignmentStatus();

        return [
            'title'             => 'Proposal Kami',
            'activePeriod'      => $activePeriod,
            'phase1'            => $phase1,
            'isPhaseOpen'       => $isPhaseOpen,
            'proposal'          => $proposal,
            'proposalSelection' => $proposalSelection,
            'isEdit'            => $proposal !== null,
            'profile'           => $profile,
            'members'           => $members,
            'docsByKey'         => $docsByKey,
            'requiredDocKeys'   => self::REQUIRED_DOC_KEYS,
            'lecturers'         => $lecturers,
            'rabItems'          => $rabItems,
        ];
    }

    private function handleFileUploads(int $proposalId): void
    {
        $documentModel = new PmwDocumentModel();
        $proposalModel = new PmwProposalModel();
        $user = auth()->user();

        $proposal = $proposalModel->find($proposalId);
        $slug = url_title($proposal['nama_usaha'] ?? 'proposal', '-', true);

        // Use a simpler, stable folder name
        $folderName = "proposal_{$proposalId}";
        $targetDir = WRITEPATH . 'uploads/pmw/proposals/' . $folderName;

        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        foreach (self::REQUIRED_DOC_KEYS as $key) {
            $file = $this->request->getFile($key);

            if ($file && $file->isValid() && ! $file->hasMoved()) {
                // Validation
                if (strtolower((string) $file->getClientExtension()) !== 'pdf') {
                    throw new \RuntimeException("Format file {$key} harus PDF");
                }
                if ($file->getSize() > 5 * 1024 * 1024) {
                    throw new \RuntimeException("Ukuran file {$key} maksimal 5MB");
                }

                $existing = $documentModel->getProposalDocByKey($proposalId, $key);

                // Best Practice Naming: slug-key-timestamp.extension
                $timestamp = date('Ymd_His');
                $extension = $file->getClientExtension();
                $newName = "{$slug}-{$key}-{$timestamp}.{$extension}";

                // Move and Update
                $file->move($targetDir, $newName);
                $path = 'uploads/pmw/proposals/' . $folderName . '/' . $newName;

                if ($existing) {
                    // Physical cleanup of the old file
                    $oldPath = WRITEPATH . $existing['file_path'];
                    if (is_file($oldPath)) {
                        @unlink($oldPath);
                    }

                    $documentModel->update((int) $existing['id'], [
                        'proposal_id'    => $proposalId,
                        'uploader_id'    => $user->id,
                        'type'           => 'proposal',
                        'doc_key'        => $key,
                        'file_path'      => $path,
                        'original_name'  => $file->getClientName(),
                        'status'         => 'submitted',
                        'version'        => ((int) ($existing['version'] ?? 1)) + 1,
                    ]);
                } else {
                    $documentModel->insert([
                        'proposal_id'    => $proposalId,
                        'uploader_id'    => $user->id,
                        'type'           => 'proposal',
                        'doc_key'        => $key,
                        'file_path'      => $path,
                        'original_name'  => $file->getClientName(),
                        'status'         => 'submitted',
                        'version'        => 1,
                    ]);
                }
            }
        }
    }

    private function isPhaseOpen(?array $phase): bool
    {
        if (! $phase) {
            return false;
        }

        if (empty($phase['is_active'])) {
            return false;
        }

        if (empty($phase['start_date']) || empty($phase['end_date'])) {
            return false;
        }

        $today = date('Y-m-d');

        return $today >= $phase['start_date'] && $today <= $phase['end_date'];
    }

    private function guardOwner(int $leaderUserId): void
    {
        $user = auth()->user();
        if (! $user || (int) $user->id !== $leaderUserId) {
            throw PageNotFoundException::forPageNotFound();
        }
    }
}
