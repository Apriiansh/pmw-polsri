<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\LecturerModel;
use App\Models\ProfileModel;
use App\Models\PmwDocumentModel;
use App\Models\PmwPeriodModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\PmwScheduleModel;
use App\Models\Proposal\PmwProposalAssignmentModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;

class ProposalController extends BaseController
{
    private const PHASE_NUMBER_PROPOSAL = 1;

    private const REQUIRED_DOC_KEYS = [
        'proposal_utama',
        'biodata',
        'surat_pernyataan_ketua',
        'surat_kesediaan_dosen',
        'ktm',
    ];

    public function index()
    {
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

        // Jika sudah ada draft/proposal, langsung ke form edit
        if ($proposal) {
            return redirect()->to("mahasiswa/proposal/edit/{$proposal['id']}");
        }

        return view('mahasiswa/proposal/index', [
            'title'        => 'Proposal Kami',
            'activePeriod' => $activePeriod,
            'phase1'       => $phase1,
            'isPhaseOpen'  => $isPhaseOpen,
            'proposal'     => $proposal,
        ]);
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
        return view('mahasiswa/proposal/form', $ctx);
    }

    public function edit(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $proposal = $proposalModel->find($id);
        if (! $proposal) {
            return redirect()->to('mahasiswa/proposal')->with('error', 'Proposal tidak ditemukan');
        }

        $this->guardOwner((int) $proposal['leader_user_id']);

        $ctx = $this->buildFormContext($proposal);
        return view('mahasiswa/proposal/form', $ctx);
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
            'lecturer_id'        => $isFinal ? 'required|integer' : 'permit_empty|integer',
            'kategori_usaha'     => $isFinal ? 'required|max_length[100]' : 'permit_empty|max_length[100]',
            'nama_usaha'         => $isFinal ? 'required|max_length[255]' : 'permit_empty|max_length[255]',
            'kategori_wirausaha' => $isFinal ? 'required|in_list[pemula,berkembang]' : 'permit_empty|in_list[pemula,berkembang]',
            'total_rab'          => 'permit_empty|decimal',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $members = $this->request->getPost('members');
        if (! is_array($members)) {
            $members = [];
        }

        $anggota = array_values(array_filter($members, static fn($m) => is_array($m) && (($m['role'] ?? '') === 'anggota')));
        
        // Final submission requires exactly 3-4 members (total 4-5 people including leader)
        if ($isFinal) {
            if (count($anggota) < 3 || count($anggota) > 4) {
                return redirect()->back()->withInput()->with('error', 'Jumlah anggota harus berjumlah 3 sampai 4 orang (Total 4-5 orang termasuk ketua) untuk pengiriman final.');
            }
        } else {
            // Draft allows zero or more, but cap at 4 to prevent UI/UX breakage
            if (count($anggota) > 4) {
                return redirect()->back()->withInput()->with('error', 'Jumlah anggota maksimal adalah 4 orang (Total 5 orang termasuk ketua).');
            }
        }

        $proposalModel   = new PmwProposalModel();
        $memberModel     = new PmwProposalMemberModel();
        $profileModel    = new ProfileModel();
        $assignmentModel = new PmwProposalAssignmentModel();

        // Validasi: ambil data ketua tim dari user yang sedang login
        $profile = $profileModel->where('user_id', $user->id)->first();
        if (! $profile) {
            return redirect()->back()->withInput()->with('error', 'Profil mahasiswa tidak ditemukan. Lengkapi profil terlebih dahulu.');
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $existing = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);

            $proposalData = [
                'period_id'      => (int) $activePeriod['id'],
                'leader_user_id' => (int) $user->id,
                'kategori_usaha' => (string) $this->request->getPost('kategori_usaha'),
                'nama_usaha'     => (string) $this->request->getPost('nama_usaha'),
                'kategori_wirausaha' => (string) $this->request->getPost('kategori_wirausaha'),
                'detail_keterangan'  => (string) $this->request->getPost('detail_keterangan'),
                'total_rab'      => $this->request->getPost('total_rab') ?: null,
                'status'         => 'draft',
            ];

            if ($existing) {
                $proposalId = (int) $existing['id'];
                if (! $proposalModel->update($proposalId, $proposalData)) {
                    throw new \RuntimeException('Gagal menyimpan proposal');
                }
                $memberModel->where('proposal_id', $proposalId)->delete();
            } else {
                $proposalId = (int) $proposalModel->insert($proposalData, true);
                if (! $proposalId) {
                    throw new \RuntimeException('Gagal membuat proposal');
                }

                // Initialize Selection Tables for new proposal
                $db->table('pmw_selection_pitching')->insert(['proposal_id' => $proposalId]);
                $db->table('pmw_selection_wawancara')->insert(['proposal_id' => $proposalId]);
                $db->table('pmw_selection_implementasi')->insert(['proposal_id' => $proposalId]);
            }

            // Sync Assignments (Lecturer & Mentor)
            $existingAssignment = $assignmentModel->where('proposal_id', $proposalId)->first();
            $assignmentData = [
                'proposal_id' => $proposalId,
                'lecturer_id' => $this->request->getPost('lecturer_id') ?: null,
            ];

            if ($existingAssignment) {
                $assignmentModel->update($existingAssignment->id, $assignmentData);
            } else {
                $assignmentModel->insert($assignmentData);
            }

            // Simpan data Ketua Tim ke pmw_proposal_members (ambil dari profile user login)
            $memberModel->insert([
                'proposal_id' => $proposalId,
                'role'        => 'ketua',
                'nama'        => $profile['nama'] ?? ($user->username ?? 'Ketua'),
                'nim'         => $profile['nim'] ?? null,
                'jurusan'     => $profile['jurusan'] ?? null,
                'prodi'       => $profile['prodi'] ?? null,
                'semester'    => $profile['semester'] ?? null,
                'phone'       => $profile['phone'] ?? null,
                'email'       => $user->getEmail(),
            ]);

            foreach ($anggota as $m) {
                $memberModel->insert([
                    'proposal_id' => $proposalId,
                    'role'        => 'anggota',
                    'nama'        => (string) ($m['nama'] ?? ''),
                    'nim'         => (string) ($m['nim'] ?? ''),
                    'jurusan'     => (string) ($m['jurusan'] ?? ''),
                    'prodi'       => (string) ($m['prodi'] ?? ''),
                    'semester'    => (int) ($m['semester'] ?? 0),
                    'phone'       => (string) ($m['phone'] ?? ''),
                    'email'       => (string) ($m['email'] ?? ''),
                ]);
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
        }

        $lecturers = $lecturerModel->orderBy('nama', 'ASC')->findAll();

        return [
            'title'        => 'Proposal Kami',
            'activePeriod' => $activePeriod,
            'phase1'       => $phase1,
            'isPhaseOpen'  => $isPhaseOpen,
            'proposal'     => $proposal,
            'isEdit'       => $proposal !== null,
            'profile'      => $profile,
            'members'      => $members,
            'docsByKey'    => $docsByKey,
            'requiredDocKeys' => self::REQUIRED_DOC_KEYS,
            'lecturers'    => $lecturers,
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
