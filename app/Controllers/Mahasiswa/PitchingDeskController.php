<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\LecturerModel;
use App\Models\ProfileModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\Proposal\PmwProposalAssignmentModel;
use App\Models\PmwDocumentModel;
use App\Models\PmwPeriodModel;
use App\Models\PmwScheduleModel;
use CodeIgniter\HTTP\ResponseInterface;

class PitchingDeskController extends BaseController
{
    protected $helpers = ['form', 'url', 'text', 'pmw'];

    private const PHASE_NUMBER_PITCHING = 1;

    private const PITCHING_DOC_KEYS = [
        'biodata',
        'ktm',
        'surat_pernyataan_ketua',
    ];

    private const PITCHING_DOC_KEYS_BERKEMBANG = [
        'biodata',
        'ktm',
        'surat_pernyataan_ketua',
        'cashflow',
    ];

    /**
     * Tahap 1 - Administrasi & Desk Evaluation
     */
    public function index()
    {
        $user = auth()->user();
        $proposalModel = new PmwProposalModel();
        $documentModel = new PmwDocumentModel();
        $periodModel   = new PmwPeriodModel();
        $scheduleModel = new PmwScheduleModel();
        $memberModel   = new PmwProposalMemberModel();
        $profileModel  = new ProfileModel();

        $activePeriod = $periodModel->getActive();

        // Ambil proposal milik user ini (apapun statusnya)
        $proposal = $proposalModel->select([
            'pmw_proposals.*',
            'pm.nama as ketua_nama',
            'sp.admin_status as pitching_admin_status',
            'sp.admin_catatan as pitching_admin_catatan',
            'sp.student_submitted_at',
        ])
            ->join('pmw_proposal_members pm', 'pm.proposal_id = pmw_proposals.id AND pm.role = "ketua"', 'left')
            ->join('pmw_selection_pitching sp', 'sp.proposal_id = pmw_proposals.id', 'left')
            ->where('pmw_proposals.leader_user_id', $user->id)
            ->orderBy('pmw_proposals.created_at', 'DESC')
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
        $members = [];
        if ($proposal) {
            $documents = $documentModel->where('proposal_id', $proposal['id'])->findAll();
            foreach ($documents as $doc) {
                if (!empty($doc['doc_key'])) {
                    $docsByKey[$doc['doc_key']] = $doc;
                }
            }
            $members = $memberModel->getByProposalId((int) $proposal['id']);
        }

        // Profile ketua untuk isian default
        $profile = $profileModel->where('user_id', $user->id)->first();

        return view('mahasiswa/pitching_desk', [
            'title'           => 'Administrasi & Desk Evaluation | PMW Polsri',
            'header_title'    => 'Administrasi & Desk Evaluation',
            'header_subtitle' => 'Pengajuan awal dan kelengkapan administrasi',
            'proposal'        => $proposal,
            'isSubmitted'     => !empty($proposal['student_submitted_at']),
            'activePeriod'    => $activePeriod,
            'phase'           => $phase,
            'isPhaseOpen'     => $isPhaseOpen,
            'docsByKey'       => $docsByKey,
            'members'         => $members,
            'profile'         => $profile,
        ]);
    }

    /**
     * Simpan Draft identitas usaha + anggota tim
     */
    public function saveDraft()
    {
        $user = auth()->user();
        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'Sesi tidak valid']);
        }

        $periodModel   = new PmwPeriodModel();
        $proposalModel = new PmwProposalModel();
        $memberModel   = new PmwProposalMemberModel();
        $assignmentModel = new PmwProposalAssignmentModel();
        $profileModel  = new ProfileModel();

        $activePeriod = $periodModel->getActive();
        if (!$activePeriod) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak ada periode PMW yang aktif']);
        }

        $isFinal = (string) $this->request->getPost('is_final_submit') === '1';

        // Validasi field wajib saat final submit
        if ($isFinal) {
            $namaUsaha = trim((string) $this->request->getPost('nama_usaha'));
            $kategoriUsaha = trim((string) $this->request->getPost('kategori_usaha'));
            $kategoriWirausaha = trim((string) $this->request->getPost('kategori_wirausaha'));
            if (empty($namaUsaha) || empty($kategoriUsaha) || empty($kategoriWirausaha)) {
                return $this->response->setJSON(['success' => false, 'message' => 'Nama usaha, kategori usaha, dan kategori wirausaha wajib diisi']);
            }
        }

        $profile = $profileModel->where('user_id', $user->id)->first();
        if (!$profile) {
            return $this->response->setJSON(['success' => false, 'message' => 'Profil mahasiswa tidak ditemukan. Lengkapi profil terlebih dahulu.']);
        }

        $members = $this->request->getPost('members');
        if (!is_array($members)) {
            $members = [];
        }
        $anggota = array_values(array_filter($members, static fn($m) => is_array($m) && (($m['role'] ?? '') === 'anggota')));

        $kategoriWirausaha = trim((string) $this->request->getPost('kategori_wirausaha'));
        $isBerkembang = $kategoriWirausaha === 'berkembang';

        if (count($anggota) > 4) {
            return $this->response->setJSON(['success' => false, 'message' => 'Jumlah anggota maksimal 4 orang (total 5 termasuk ketua)']);
        }

        if ($isFinal) {
            if ($isBerkembang && count($anggota) < 1) {
                return $this->response->setJSON(['success' => false, 'message' => 'Kategori Berkembang: minimal 1 anggota (total minimal 2 orang)']);
            }

            // Validasi prodi berbeda jika tim >= 2 orang
            $totalMembers = count($anggota) + 1; // +1 ketua
            if ($totalMembers >= 2) {
                $profile = $profileModel->where('user_id', $user->id)->first();
                $prodiList = array_column($anggota, 'prodi');
                $ketuaProdi = $profile['prodi'] ?? '';
                $allProdi = array_filter(array_merge([$ketuaProdi], $prodiList));
                if (count($allProdi) !== count(array_unique($allProdi))) {
                    return $this->response->setJSON(['success' => false, 'message' => 'Jika tim terdiri dari 2 orang atau lebih, setiap anggota harus berasal dari program studi yang berbeda']);
                }
            }
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $existing = $proposalModel->findByPeriodAndLeader((int) $activePeriod['id'], (int) $user->id);

            $lamaUsahaTahun = $this->request->getPost('lama_usaha_tahun');
            $lamaUsahaBulan = $this->request->getPost('lama_usaha_bulan');

            $proposalData = [
                'period_id'          => (int) $activePeriod['id'],
                'leader_user_id'     => (int) $user->id,
                'kategori_usaha'     => (string) $this->request->getPost('kategori_usaha'),
                'nama_usaha'         => (string) $this->request->getPost('nama_usaha'),
                'kategori_wirausaha' => (string) $this->request->getPost('kategori_wirausaha'),
                'detail_keterangan'  => (string) $this->request->getPost('detail_keterangan'),
                'lama_usaha_tahun'   => $lamaUsahaTahun !== null && $lamaUsahaTahun !== '' ? (int) $lamaUsahaTahun : null,
                'lama_usaha_bulan'   => $lamaUsahaBulan !== null && $lamaUsahaBulan !== '' ? (int) $lamaUsahaBulan : null,
                'instagram_url'      => (string) $this->request->getPost('instagram_url') ?: null,
                'status'             => $existing ? ($existing['status'] ?? 'draft') : 'draft',
            ];

            if ($existing) {
                $proposalId = (int) $existing['id'];
                $proposalModel->update($proposalId, $proposalData);
                $memberModel->where('proposal_id', $proposalId)->delete();
            } else {
                // Saat insert, model akan trigger initializeProposalStages via afterInsert callback
                $proposalId = (int) $proposalModel->insert($proposalData, true);
                if (!$proposalId) {
                    throw new \RuntimeException('Gagal membuat proposal');
                }
            }

            // Simpan data Ketua Tim
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

            return $this->response->setJSON([
                'success'     => true,
                'proposal_id' => $proposalId,
                'message'     => 'Draft berhasil disimpan',
            ]);
        } catch (\Throwable $e) {
            $db->transRollback();
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    /**
     * Upload PPT for pitching desk
     */
    public function uploadPpt()
    {
        $user = auth()->user();
        $proposalModel = new PmwProposalModel();
        $documentModel = new PmwDocumentModel();

        $proposal = $proposalModel->select('pmw_proposals.*')
            ->where('pmw_proposals.leader_user_id', $user->id)
            ->orderBy('pmw_proposals.created_at', 'DESC')
            ->first();

        if (!$proposal) {
            return $this->response->setJSON(['success' => false, 'message' => 'Simpan draft identitas usaha terlebih dahulu']);
        }

        $file = $this->request->getFile('ppt_file');
        if (!$file || !$file->isValid()) {
            $errorMsg = $file ? $file->getErrorString() . ' (' . $file->getError() . ')' : 'File tidak terlampir';
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid: ' . $errorMsg]);
        }

        $allowedTypes = [
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/pdf',
            'application/zip',
            'application/octet-stream',
        ];
        $clientExt = strtolower($file->getClientExtension());
        $clientMime = $file->getMimeType();

        if (!in_array($clientExt, ['ppt', 'pptx', 'pdf']) && !in_array($clientMime, $allowedTypes)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Format file harus PPT, PPTX, atau PDF']);
        }

        if ($file->getSize() > 10 * 1024 * 1024) {
            return $this->response->setJSON(['success' => false, 'message' => 'Ukuran file maksimal 10MB']);
        }

        $newName    = $file->getRandomName();
        $uploadPath = 'uploads/proposals/' . $proposal['id'] . '/pitching';

        if (!is_dir(WRITEPATH . $uploadPath)) {
            mkdir(WRITEPATH . $uploadPath, 0755, true);
        }

        if ($file->move(WRITEPATH . $uploadPath, $newName)) {
            $existingDoc = $documentModel->where('proposal_id', $proposal['id'])
                ->where('doc_key', 'pitching_ppt')
                ->first();

            if ($existingDoc && !empty($existingDoc['file_path'])) {
                $oldPath = WRITEPATH . $existingDoc['file_path'];
                if (is_file($oldPath)) {
                    unlink($oldPath);
                }
            }

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
                'success'  => true,
                'message'  => 'PPT berhasil diunggah',
                'filename' => $file->getClientName(),
            ]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengunggah file']);
    }

    /**
     * Upload dokumen PDF pitching (biodata, KTM, pernyataan, surat dosen)
     */
    public function uploadPitchingDoc()
    {
        $user = auth()->user();
        $proposalModel = new PmwProposalModel();
        $documentModel = new PmwDocumentModel();

        $proposal = $proposalModel->select('pmw_proposals.*')
            ->where('pmw_proposals.leader_user_id', $user->id)
            ->orderBy('pmw_proposals.created_at', 'DESC')
            ->first();

        if (!$proposal) {
            return $this->response->setJSON(['success' => false, 'message' => 'Simpan draft identitas usaha terlebih dahulu']);
        }

        $docKey = (string) $this->request->getPost('doc_key');
        $allAllowedKeys = array_unique(array_merge(self::PITCHING_DOC_KEYS, self::PITCHING_DOC_KEYS_BERKEMBANG));
        if (!in_array($docKey, $allAllowedKeys, true)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tipe dokumen tidak valid']);
        }

        $file = $this->request->getFile('file');
        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid']);
        }

        if (strtolower($file->getClientExtension()) !== 'pdf') {
            return $this->response->setJSON(['success' => false, 'message' => 'Format file harus PDF']);
        }

        if ($file->getSize() > 5 * 1024 * 1024) {
            return $this->response->setJSON(['success' => false, 'message' => 'Ukuran file maksimal 5MB']);
        }

        $newName    = $file->getRandomName();
        $uploadPath = 'uploads/proposals/' . $proposal['id'] . '/pitching';

        if (!is_dir(WRITEPATH . $uploadPath)) {
            mkdir(WRITEPATH . $uploadPath, 0755, true);
        }

        if ($file->move(WRITEPATH . $uploadPath, $newName)) {
            $existingDoc = $documentModel->where('proposal_id', $proposal['id'])
                ->where('doc_key', $docKey)
                ->first();

            if ($existingDoc && !empty($existingDoc['file_path'])) {
                $oldPath = WRITEPATH . $existingDoc['file_path'];
                if (is_file($oldPath)) {
                    unlink($oldPath);
                }
            }

            $docData = [
                'proposal_id'   => $proposal['id'],
                'doc_key'       => $docKey,
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
                'success'  => true,
                'message'  => 'Dokumen berhasil diunggah',
                'filename' => $file->getClientName(),
                'doc_key'  => $docKey,
            ]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengunggah file']);
    }

    /**
     * Update Video URL (berlaku untuk semua kategori)
     */
    public function updateVideoUrl()
    {
        $user = auth()->user();
        $proposalModel = new PmwProposalModel();

        $proposal = $proposalModel->select('pmw_proposals.*')
            ->where('pmw_proposals.leader_user_id', $user->id)
            ->orderBy('pmw_proposals.created_at', 'DESC')
            ->first();

        if (!$proposal) {
            return $this->response->setJSON(['success' => false, 'message' => 'Simpan draft identitas usaha terlebih dahulu']);
        }

        $videoUrl = $this->request->getPost('video_url');

        if (empty($videoUrl)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Link video tidak boleh kosong']);
        }

        $isYoutube = strpos($videoUrl, 'youtube.com') !== false || strpos($videoUrl, 'youtu.be') !== false;
        $isGDrive  = strpos($videoUrl, 'drive.google.com') !== false || strpos($videoUrl, 'google.com/drive') !== false;

        if (!$isYoutube && !$isGDrive) {
            return $this->response->setJSON(['success' => false, 'message' => 'Link harus berupa YouTube atau Google Drive']);
        }

        $proposalModel->update($proposal['id'], [
            'video_url'  => $videoUrl,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Link video berhasil disimpan']);
    }

    /**
     * Update detail keterangan (berlaku untuk semua kategori)
     */
    public function updateDetail()
    {
        $user = auth()->user();
        $proposalModel = new PmwProposalModel();

        $proposal = $proposalModel->select('pmw_proposals.*')
            ->where('pmw_proposals.leader_user_id', $user->id)
            ->orderBy('pmw_proposals.created_at', 'DESC')
            ->first();

        if (!$proposal) {
            return $this->response->setJSON(['success' => false, 'message' => 'Simpan draft identitas usaha terlebih dahulu']);
        }

        $detailKeterangan = $this->request->getPost('detail_keterangan');

        $proposalModel->update($proposal['id'], [
            'detail_keterangan' => $detailKeterangan,
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Detail keterangan berhasil diperbarui']);
    }

    /**
     * Submit pitching materials (Kirim untuk divalidasi Dosen)
     */
    public function submit()
    {
        $user = auth()->user();
        $proposalModel = new PmwProposalModel();
        $documentModel = new PmwDocumentModel();
        $pitchingModel = new \App\Models\Selection\PmwSelectionPitchingModel();
        $notificationModel = new \App\Models\NotificationModel();

        $proposal = $proposalModel->select([
            'pmw_proposals.*',
            'pm.nama as ketua_nama',
            'pa.lecturer_id',
        ])
            ->join('pmw_proposal_members pm', 'pm.proposal_id = pmw_proposals.id AND pm.role = "ketua"', 'left')
            ->join('pmw_proposal_assignments pa', 'pa.proposal_id = pmw_proposals.id', 'left')
            ->where('pmw_proposals.leader_user_id', $user->id)
            ->orderBy('pmw_proposals.created_at', 'DESC')
            ->first();

        if (!$proposal) {
            return $this->response->setJSON(['success' => false, 'message' => 'Simpan draft identitas usaha terlebih dahulu']);
        }

        // Validasi nama usaha & kategori sudah terisi
        if (empty($proposal['nama_usaha']) || empty($proposal['kategori_usaha'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Lengkapi identitas usaha dan anggota tim terlebih dahulu']);
        }

        // Validasi PPT
        $ppt = $documentModel->where('proposal_id', $proposal['id'])
            ->where('doc_key', 'pitching_ppt')
            ->first();

        if (!$ppt) {
            return $this->response->setJSON(['success' => false, 'message' => 'Harap unggah file PPT terlebih dahulu']);
        }

        $isBerkembang = $proposal['kategori_wirausaha'] === 'berkembang';
        $requiredDocKeys = $isBerkembang ? self::PITCHING_DOC_KEYS_BERKEMBANG : self::PITCHING_DOC_KEYS;

        // Validasi dokumen PDF wajib
        $docLabels = [
            'biodata'                => 'Biodata Tim',
            'ktm'                    => 'KTM Gabungan',
            'surat_pernyataan_ketua' => 'Surat Pernyataan Ketua',
            'cashflow'               => 'Cashflow / Bukti Transaksi (wajib untuk Berkembang)',
        ];
        foreach ($requiredDocKeys as $key) {
            $doc = $documentModel->where('proposal_id', $proposal['id'])->where('doc_key', $key)->first();
            if (!$doc) {
                return $this->response->setJSON(['success' => false, 'message' => 'Harap unggah ' . ($docLabels[$key] ?? $key)]);
            }
        }

        // Validasi video: wajib untuk Berkembang, opsional untuk Pemula
        if ($isBerkembang && empty($proposal['video_url'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Harap isi link video perkenalan usaha (wajib untuk kategori Berkembang)']);
        }

        // Update submission status di pmw_selection_pitching
        $pitchingRecord = $pitchingModel->where('proposal_id', $proposal['id'])->first();
        $data = [
            'student_submitted_at' => date('Y-m-d H:i:s'),
            'admin_status'         => 'pending',
        ];

        if ($pitchingRecord) {
            $pitchingModel->update($pitchingRecord->id, $data);
        } else {
            $data['proposal_id'] = $proposal['id'];
            $pitchingModel->insert($data);
        }

        $notificationModel->createPitchingSubmissionNotification(
            (int) $proposal['id'],
            $proposal['nama_usaha'] ?? 'Tanpa Nama',
            $proposal['ketua_nama'] ?? 'Ketua'
        );

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Bahan pitching berhasil dikirim! Silakan tunggu validasi.',
        ]);
    }

    private function isPhaseOpen(?array $phase): bool
    {
        if (!$phase) return false;
        $now = date('Y-m-d');
        return isset($phase['start_date'], $phase['end_date'])
            && $now >= $phase['start_date']
            && $now <= $phase['end_date'];
    }

    /**
     * View/Download documents
     */
    public function viewDoc(int $id)
    {
        $documentModel = new PmwDocumentModel();
        $doc = $documentModel->find($id);

        if (!$doc) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Dokumen tidak ditemukan');
        }

        $user = auth()->user();
        $proposalModel = new PmwProposalModel();
        $proposal = $proposalModel->find($doc['proposal_id']);

        if (!$proposal || (int) $proposal['leader_user_id'] !== (int) $user->id) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Akses ditolak');
        }

        $path = WRITEPATH . $doc['file_path'];
        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('File tidak ditemukan di server');
        }

        $inline = $this->request->getGet('inline');

        if ($inline) {
            $file = new \CodeIgniter\Files\File($path);
            $mime = $file->getMimeType();

            return $this->response
                ->setHeader('Content-Type', $mime)
                ->setHeader('Content-Disposition', 'inline; filename="' . $doc['original_name'] . '"')
                ->setBody(file_get_contents($path));
        }

        return $this->response->download($path, null)->setFileName($doc['original_name']);
    }
}
