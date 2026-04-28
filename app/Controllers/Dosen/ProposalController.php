<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\LecturerModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\PmwDocumentModel;
use App\Models\Selection\PmwSelectionProposalModel;
use App\Models\NotificationModel;

class ProposalController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];

    /**
     * List proposals assigned to this lecturer awaiting proposal validation
     */
    public function index()
    {
        $proposalModel  = new PmwProposalModel();
        $lecturerUserId = auth()->id();

        $statusFilter = $this->request->getGet('status');
        $proposals    = $proposalModel->getProposalsForLecturerProposal($lecturerUserId, $statusFilter);

        $allProposals = $proposalModel->getProposalsForLecturerProposal($lecturerUserId);
        $stats = [
            'total'    => count($allProposals),
            'pending'  => count(array_filter($allProposals, fn($p) => ($p['proposal_dosen_status'] ?? 'pending') === 'pending')),
            'approved' => count(array_filter($allProposals, fn($p) => ($p['proposal_dosen_status'] ?? '') === 'approved')),
            'revision' => count(array_filter($allProposals, fn($p) => ($p['proposal_dosen_status'] ?? '') === 'revision')),
            'rejected' => count(array_filter($allProposals, fn($p) => ($p['proposal_dosen_status'] ?? '') === 'rejected')),
        ];

        return view('dosen/proposal/validation', [
            'title'        => 'Validasi Proposal | PMW Polsri',
            'proposals'    => $proposals,
            'stats'        => $stats,
            'statusFilter' => $statusFilter,
        ]);
    }

    /**
     * Show detail and validation form for a proposal
     */
    public function detail(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $memberModel   = new PmwProposalMemberModel();
        $documentModel = new PmwDocumentModel();

        $proposal = $proposalModel->getProposalWithSelectionForDosen($id);

        $lecturer = (new LecturerModel())->where('user_id', auth()->id())->first();
        if (!$proposal || ($proposal['dosen_user_id'] ?? null) != auth()->id()) {
            return redirect()->to('dosen/proposal-validation')
                ->with('error', 'Akses ditolak atau proposal tidak ditemukan');
        }

        $members   = $memberModel->getByProposalId($id);
        $documents = $documentModel->getProposalDocs($id);

        $docsByKey = [];
        foreach ($documents as $doc) {
            if (!empty($doc['doc_key'])) {
                $docsByKey[$doc['doc_key']] = $doc;
            }
        }

        return view('dosen/proposal/validation_detail', [
            'title'    => 'Detail Validasi Proposal | PMW Polsri',
            'proposal' => $proposal,
            'members'  => $members,
            'docsByKey' => $docsByKey,
        ]);
    }

    /**
     * Process validation action from lecturer
     */
    public function validateAction(int $id)
    {
        $proposalModel  = new PmwProposalModel();
        $selectionModel = new PmwSelectionProposalModel();

        $proposal = $proposalModel->getProposalWithSelectionForDosen($id);
        if (!$proposal || ($proposal['dosen_user_id'] ?? null) != auth()->id()) {
            return redirect()->to('dosen/proposal-validation')->with('error', 'Akses ditolak');
        }

        $status  = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');

        if (!in_array($status, ['approved', 'rejected', 'revision'])) {
            return redirect()->back()->with('error', 'Status tidak valid');
        }

        $updateData = [
            'dosen_status'  => $status,
            'dosen_catatan' => $catatan ?: null,
        ];

        $selectionModel->upsert($id, $updateData);

        $notificationModel = new NotificationModel();
        $notificationModel->createValidationResultNotification(
            (int) $proposal['leader_user_id'],
            $id,
            $proposal['nama_usaha'] ?? 'Tanpa Nama',
            $status,
            $catatan
        );

        return redirect()->to('dosen/proposal-validation')
            ->with('message', 'Validasi proposal berhasil disimpan');
    }

    /**
     * Download/view a document
     */
    public function viewDoc(int $id)
    {
        $documentModel = new PmwDocumentModel();
        $doc = $documentModel->find($id);

        if (!$doc) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $proposalModel = new PmwProposalModel();
        $proposal      = $proposalModel->getProposalWithSelectionForDosen((int) $doc['proposal_id']);

        if (!$proposal || ($proposal['dosen_user_id'] ?? null) != auth()->id()) {
            return redirect()->to('dosen/proposal-validation')->with('error', 'Akses ditolak');
        }

        $path = WRITEPATH . $doc['file_path'];
        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('File tidak ditemukan');
        }

        if ($this->request->getGet('inline')) {
            $file = new \CodeIgniter\Files\File($path);
            return $this->response
                ->setHeader('Content-Type', $file->getMimeType())
                ->setHeader('Content-Disposition', 'inline; filename="' . $doc['original_name'] . '"')
                ->setBody(file_get_contents($path));
        }

        return $this->response->download($path, null)->setFileName($doc['original_name']);
    }
}
