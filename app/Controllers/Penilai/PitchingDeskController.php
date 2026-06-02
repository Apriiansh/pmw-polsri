<?php

namespace App\Controllers\Penilai;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\PmwDocumentModel;
use CodeIgniter\HTTP\ResponseInterface;

class PitchingDeskController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];

    /**
     * List of proposals already approved by lecturer, ready for final validation
     */
    public function index()
    {
        $proposalModel = new PmwProposalModel();

        $statusFilter   = $this->request->getGet('status') ?? 'pending';
        $kategoriFilter = $this->request->getGet('kategori');

        $proposals = $proposalModel->getProposalsForAdminPitching($statusFilter, $kategoriFilter);

        // Stats
        $allProposals = $proposalModel->getProposalsForAdminPitching(null, $kategoriFilter);
        $stats = [
            'total'     => count($allProposals),
            'pending'   => count(array_filter($allProposals, fn($p) => $p['pitching_admin_status'] === 'pending' && empty($p['student_submitted_at']))),
            'submitted' => count(array_filter($allProposals, fn($p) => $p['pitching_admin_status'] === 'pending' && !empty($p['student_submitted_at']))),
            'approved'  => count(array_filter($allProposals, fn($p) => $p['pitching_admin_status'] === 'approved')),
            'revision'  => count(array_filter($allProposals, fn($p) => $p['pitching_admin_status'] === 'revision')),
            'rejected'  => count(array_filter($allProposals, fn($p) => $p['pitching_admin_status'] === 'rejected')),
        ];

        return view('penilai/pitching/validation', [
            'title'           => 'Validasi Pitching Desk | PMW Polsri',
            'proposals'       => $proposals,
            'stats'           => $stats,
            'statusFilter'    => $statusFilter,
            'kategoriFilter'  => $kategoriFilter,
        ]);
    }

    /**
     * Detail and Final Validation
     */
    public function detail(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $memberModel = new PmwProposalMemberModel();
        $documentModel = new PmwDocumentModel();

        $proposal = $proposalModel->getProposalForValidation($id);

        if (!$proposal) {
            return redirect()->to('penilai/pitching-desk')->with('error', 'Proposal tidak ditemukan');
        }

        $members = $memberModel->getByProposalId($id);
        $documents = $documentModel->getProposalDocs($id);

        $docsByKey = [];
        foreach ($documents as $doc) {
            if (!empty($doc['doc_key'])) {
                $docsByKey[$doc['doc_key']] = $doc;
            }
        }

        return view('penilai/pitching/validation_detail', [
            'title'     => 'Detail Validasi Pitching | PMW Polsri',
            'proposal'  => $proposal,
            'members'   => $members,
            'docsByKey' => $docsByKey,
        ]);
    }

    /**
     * Final validation process
     */
    public function validateAction(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $selectionModel = new \App\Models\Selection\PmwSelectionPitchingModel();

        $proposal = $proposalModel->getProposalForValidation($id);

        if (!$proposal) {
            return redirect()->to('penilai/pitching-desk')->with('error', 'Akses ditolak');
        }

        $status  = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');
        $persentaseNilai = $this->request->getPost('persentase_nilai');

        // Validate catatan: wajib diisi (min 5 char agar tidak cuma titik)
        $rules = [
            'catatan' => 'required|min_length[5]|max_length[1000]',
        ];
        if (!$this->validateData(['catatan' => $catatan], $rules)) {
            return redirect()->back()->withInput()->with('error', 'Catatan validasi wajib diisi (minimal 5 karakter) agar mahasiswa mendapat umpan balik yang jelas.');
        }

        if (!in_array($status, ['approved', 'rejected', 'revision'])) {
            return redirect()->back()->with('error', 'Status tidak valid');
        }

        $updateData = [
            'status'           => $status,
            'catatan'          => $catatan,
            'persentase_nilai' => ($persentaseNilai !== null && $persentaseNilai !== '')
                ? (float) $persentaseNilai
                : null,
            'updated_at'       => date('Y-m-d H:i:s'),
        ];

        if ($selectionModel->where('proposal_id', $id)->set($updateData)->update()) {
            $notifModel = new \App\Models\NotificationModel();
            $notifModel->createPitchingValidationNotification(
                (int) $proposal['leader_user_id'],
                $id,
                $proposal['nama_usaha'] ?? 'Tanpa Nama',
                $status,
                $catatan
            );

            return redirect()->to('penilai/pitching-desk')->with('message', 'Validasi pitching berhasil disimpan');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan validasi');
    }

    /**
     * View/Download documents (PPT/PDF)
     */
    public function viewDoc(int $id)
    {
        $documentModel = new PmwDocumentModel();
        $doc = $documentModel->find($id);

        if (!$doc) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Dokumen tidak ditemukan');
        }

        $proposalModel = new PmwProposalModel();
        $proposal = $proposalModel->find($doc['proposal_id']);
        if (!$proposal) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Proposal tidak ditemukan');
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
