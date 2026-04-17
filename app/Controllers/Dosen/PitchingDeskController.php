<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\PmwDocumentModel;
use CodeIgniter\HTTP\ResponseInterface;

class PitchingDeskController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];

    /**
     * List of proposals for lecturer to validate (Phase 3)
     */
    public function index()
    {
        $proposalModel = new PmwProposalModel();
        $lecturerUserId = auth()->id();

        $statusFilter = $this->request->getGet('status');
        $proposals = $proposalModel->getProposalsForLecturerPitching($lecturerUserId, $statusFilter);

        // Stats for this lecturer
        $allProposals = $proposalModel->getProposalsForLecturerPitching($lecturerUserId);
        $stats = [
            'total'     => count($allProposals),
            'pending'   => count(array_filter($allProposals, fn($p) => $p['pitching_dosen_status'] === 'pending')),
            'approved'  => count(array_filter($allProposals, fn($p) => $p['pitching_dosen_status'] === 'approved')),
            'revision'  => count(array_filter($allProposals, fn($p) => $p['pitching_dosen_status'] === 'revision')),
            'rejected'  => count(array_filter($allProposals, fn($p) => $p['pitching_dosen_status'] === 'rejected')),
        ];

        return view('dosen/pitching/validation', [
            'title'           => 'Validasi Pitching Desk | PMW Polsri',
            'proposals'       => $proposals,
            'stats'           => $stats,
            'statusFilter'    => $statusFilter,
        ]);
    }

    /**
     * Show detail and validation form
     */
    public function detail(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $memberModel = new PmwProposalMemberModel();
        $documentModel = new PmwDocumentModel();

        $proposal = $proposalModel->getProposalForValidation($id);

        // Security check: ensure this lecturer is assigned to this proposal
        $lecturer = (new \App\Models\LecturerModel())->where('user_id', auth()->id())->first();
        if (!$proposal || $proposal['lecturer_id'] != $lecturer['id']) {
            return redirect()->to('dosen/pitching-desk')->with('error', 'Akses ditolak atau proposal tidak ditemukan');
        }

        $members = $memberModel->getByProposalId($id);
        $documents = $documentModel->getProposalDocs($id);

        $docsByKey = [];
        foreach ($documents as $doc) {
            if (!empty($doc['doc_key'])) {
                $docsByKey[$doc['doc_key']] = $doc;
            }
        }

        return view('dosen/pitching/validation_detail', [
            'title'     => 'Detail Validasi Pitching | PMW Polsri',
            'proposal'  => $proposal,
            'members'   => $members,
            'docsByKey' => $docsByKey,
        ]);
    }

    /**
     * Process validation from lecturer
     */
    public function validateAction(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $selectionModel = new \App\Models\Selection\PmwSelectionPitchingModel();
        
        $lecturer = (new \App\Models\LecturerModel())->where('user_id', auth()->id())->first();

        // Security check: ensure this lecturer is assigned to this proposal via assignments table
        $proposal = $proposalModel->getProposalForValidation($id);
        if (!$proposal || $proposal['lecturer_id'] != $lecturer['id']) {
            return redirect()->to('dosen/pitching-desk')->with('error', 'Akses ditolak');
        }

        $status = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');

        if (!in_array($status, ['approved', 'rejected', 'revision'])) {
            return redirect()->back()->with('error', 'Status tidak valid');
        }

        $updateData = [
            'dosen_status'  => $status,
            'dosen_catatan' => $catatan ?: null,
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // If lecturer approves, set admin status to pending if it was previously something else
        if ($status === 'approved') {
            $updateData['admin_status'] = 'pending';
        }

        // Update selection pitching table
        if ($selectionModel->where('proposal_id', $id)->set($updateData)->update()) {
            return redirect()->to('dosen/pitching-desk')->with('message', 'Proposal berhasil divalidasi');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan validasi');
    }

}
