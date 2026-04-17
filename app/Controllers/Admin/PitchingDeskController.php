<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\PmwDocumentModel;
use CodeIgniter\HTTP\ResponseInterface;

class PitchingDeskController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];

    /**
     * List of proposals already approved by lecturer, ready for final admin validation
     */
    public function index()
    {
        $proposalModel = new PmwProposalModel();
        
        $statusFilter = $this->request->getGet('status');
        $proposals = $proposalModel->getProposalsForAdminPitching($statusFilter);
        
        // Stats for Admin Pitching stage
        $allProposals = $proposalModel->getProposalsForAdminPitching();
        $stats = [
            'total'     => count($allProposals),
            'pending'   => count(array_filter($allProposals, fn($p) => $p['admin_status'] === 'pending')),
            'approved'  => count(array_filter($allProposals, fn($p) => $p['admin_status'] === 'approved')),
            'revision'  => count(array_filter($allProposals, fn($p) => $p['admin_status'] === 'revision')),
            'rejected'  => count(array_filter($allProposals, fn($p) => $p['admin_status'] === 'rejected')),
        ];

        return view('admin/pitching/validation', [
            'title'           => 'Validasi Akhir Pitching | PMW Polsri',
            'proposals'       => $proposals,
            'stats'           => $stats,
            'statusFilter'    => $statusFilter,
        ]);
    }

    /**
     * Detail and Final Validation
     */
    public function detail(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $memberModel = new \App\Models\Proposal\PmwProposalMemberModel();
        $documentModel = new \App\Models\PmwDocumentModel();
        
        $proposal = $proposalModel->getProposalForValidation($id);
        
        if (!$proposal || $proposal['dosen_status'] !== 'approved') {
            return redirect()->to('admin/pitching-desk')->with('error', 'Proposal belum divalidasi dosen atau tidak ditemukan');
        }

        $members = $memberModel->getByProposalId($id);
        $documents = $documentModel->getProposalDocs($id);
        
        $docsByKey = [];
        foreach ($documents as $doc) {
            if (!empty($doc['doc_key'])) {
                $docsByKey[$doc['doc_key']] = $doc;
            }
        }

        return view('admin/pitching/validation_detail', [
            'title'     => 'Validasi Final Pitching | PMW Polsri',
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
        
        if (!$proposal || $proposal['dosen_status'] !== 'approved') {
            return redirect()->to('admin/pitching-desk')->with('error', 'Akses ditolak');
        }

        $status = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');

        if (!in_array($status, ['approved', 'rejected', 'revision'])) {
            return redirect()->back()->with('error', 'Status tidak valid');
        }

        $updateData = [
            'admin_status'  => $status,
            'admin_catatan' => $catatan ?: null,
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        if ($selectionModel->where('proposal_id', $id)->set($updateData)->update()) {
            return redirect()->to('admin/pitching-desk')->with('message', 'Validasi final berhasil disimpan');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan validasi');
    }
}
