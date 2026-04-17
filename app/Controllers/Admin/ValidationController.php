<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PmwDocumentModel;
use App\Models\NotificationModel;
use CodeIgniter\HTTP\ResponseInterface;

class ValidationController extends BaseController
{
    protected $helpers = ['form', 'url', 'text', 'pmw'];

    /**
     * Tahap 2 - Seleksi Administrasi
     * Admin memvalidasi kelengkapan dokumen proposal
     */
    public function seleksiAdministrasi()
    {
        $proposalModel = new \App\Models\Proposal\PmwProposalModel();
        
        $statusFilter = $this->request->getGet('status');
        $proposals = $proposalModel->getWithDetails($statusFilter);
        
        // Stats
        $allProposals = $proposalModel->getWithDetails(null);
        $stats = [
            'total'     => count(array_filter($allProposals, fn($p) => $p['status'] !== 'draft')),
            'submitted' => count(array_filter($allProposals, fn($p) => $p['status'] === 'submitted')),
            'revision'  => count(array_filter($allProposals, fn($p) => $p['status'] === 'revision')),
            'approved'  => count(array_filter($allProposals, fn($p) => $p['status'] === 'approved')),
            'rejected'  => count(array_filter($allProposals, fn($p) => $p['status'] === 'rejected')),
        ];

        return view('admin/administrasi/seleksi', [
            'title'           => 'Seleksi Administrasi | PMW Polsri',
            'header_title'    => 'Seleksi Administrasi',
            'header_subtitle' => 'Tahap 2 - Validasi kelengkapan dokumen proposal',
            'proposals'       => $proposals,
            'stats'           => $stats,
            'statusFilter'    => $statusFilter,
        ]);
    }

    /**
     * Detail proposal untuk seleksi administrasi
     */
    public function detailProposal(int $id)
    {
        $proposalModel = new \App\Models\Proposal\PmwProposalModel();
        $memberModel = new \App\Models\Proposal\PmwProposalMemberModel();
        $documentModel = new PmwDocumentModel();

        $proposal = $proposalModel->getProposalForValidation($id);
        if (!$proposal) {
            return redirect()->to('admin/administrasi/seleksi')->with('error', 'Proposal tidak ditemukan');
        }

        $members = $memberModel->getByProposalId($id);
        $documents = $documentModel->getProposalDocs($id);

        // Add email to ketua member
        foreach ($members as &$member) {
            if ($member['role'] === 'ketua' && !empty($proposal['ketua_email'])) {
                $member['email'] = $proposal['ketua_email'];
            }
        }
        unset($member);
        
        // Organize documents by key
        $docsByKey = [];
        foreach ($documents as $doc) {
            if (!empty($doc['doc_key'])) {
                $docsByKey[$doc['doc_key']] = $doc;
            }
        }

        $requiredDocs = [
            'proposal_utama' => 'Proposal Utama',
            'biodata' => 'Biodata Tim',
            'surat_pernyataan_ketua' => 'Surat Pernyataan Ketua',
            'surat_kesediaan_dosen' => 'Surat Kesediaan Dosen',
            'ktm' => 'Kartu Tanda Mahasiswa (KTM)',
        ];

        return view('admin/administrasi/seleksi_detail', [
            'title'           => 'Detail Proposal | PMW Polsri',
            'header_title'    => 'Detail Proposal',
            'header_subtitle' => 'Validasi kelengkapan dokumen',
            'proposal'        => $proposal,
            'members'         => $members,
            'docsByKey'       => $docsByKey,
            'requiredDocs'    => $requiredDocs,
        ]);
    }

    /**
     * Validasi administrasi proposal
     */
    public function validasiAdministrasi(int $id)
    {
        $proposalModel = new \App\Models\Proposal\PmwProposalModel();
        $proposal = $proposalModel->find($id);
        
        if (!$proposal) {
            return redirect()->to('admin/administrasi/seleksi')->with('error', 'Proposal tidak ditemukan');
        }

        $newStatus = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');

        if (!in_array($newStatus, ['approved', 'revision', 'rejected'])) {
            return redirect()->back()->with('error', 'Status tidak valid');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $updateData = [
            'status'     => $newStatus,
            'catatan'    => $catatan ?: null,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // If revision, reset submitted_at so mahasiswa can resubmit
        if ($newStatus === 'revision') {
            $updateData['submitted_at'] = null;
        }

        $proposalModel->update($id, $updateData);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal memperbarui status proposal');
        }

        // Send notification to mahasiswa
        $notificationModel = new NotificationModel();
        $notificationModel->createValidationResultNotification(
            (int) $proposal['leader_user_id'],
            $id,
            $proposal['nama_usaha'] ?? 'Tanpa Nama',
            $newStatus,
            $catatan
        );

        $statusText = [
            'approved' => 'disetujui',
            'revision' => 'diminta revisi',
            'rejected' => 'ditolak',
        ];

        return redirect()->to('admin/administrasi/seleksi')
            ->with('success', "Proposal berhasil {$statusText[$newStatus]}");
    }

    /**
     * Hapus proposal (hanya jika status rejected)
     */
    public function hapusProposal(int $id)
    {
        $proposalModel = new \App\Models\Proposal\PmwProposalModel();
        $proposal = $proposalModel->find($id);
        
        if (!$proposal) {
            return redirect()->to('admin/administrasi/seleksi')->with('error', 'Proposal tidak ditemukan');
        }

        if ($proposal['status'] !== 'rejected') {
            return redirect()->back()->with('error', 'Hanya proposal dengan status rejected yang dapat dihapus');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Delete documents files first
            $documentModel = new PmwDocumentModel();
            $documents = $documentModel->where('proposal_id', $id)->findAll();
            foreach ($documents as $doc) {
                if (!empty($doc['file_path'])) {
                    $absPath = WRITEPATH . $doc['file_path'];
                    if (is_file($absPath)) {
                        unlink($absPath);
                    }
                }
            }

            // CASCADE will handle pmw_proposal_members and pmw_documents
            $proposalModel->delete($id);

            $db->transComplete();

            return redirect()->to('admin/administrasi/seleksi')->with('message', 'Proposal berhasil dihapus');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal menghapus proposal: ' . $e->getMessage());
        }
    }

    /**
     * Download dokumen proposal (admin access)
     */
    public function downloadDoc(int $docId)
    {
        $documentModel = new PmwDocumentModel();
        $doc = $documentModel->find($docId);

        if (!$doc || empty($doc['file_path'])) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan');
        }

        $absPath = WRITEPATH . $doc['file_path'];
        if (!is_file($absPath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di server');
        }

        // Handle inline preview
        if ($this->request->getGet('inline')) {
            $mimeType = mime_content_type($absPath);
            return $this->response
                ->setHeader('Content-Type', $mimeType)
                ->setHeader('Content-Disposition', 'inline; filename="' . esc($doc['original_name'], 'url') . '"')
                ->setBody(file_get_contents($absPath));
        }

        return $this->response->download($absPath, null)
            ->setFileName($doc['original_name'] ?? basename($absPath));
    }
}
