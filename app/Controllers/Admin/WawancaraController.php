<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\PmwDocumentModel;
use CodeIgniter\HTTP\ResponseInterface;

class WawancaraController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];

    /**
     * List of proposals ready for implementation agreement validation
     */
    public function index()
    {
        $db = \Config\Database::connect();

        $statusFilter = $this->request->getGet('status');

        // Custom query to get proposals in Phase 4
        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.*',
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'l.nama as dosen_nama',
            'per.name as period_name',
            'per.year as period_year',
            '(SELECT id FROM pmw_documents WHERE proposal_id = p.id AND doc_key = "bukti_perjanjian" LIMIT 1) as bukti_perjanjian_id'
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_lecturers l', 'l.id = p.lecturer_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');

        // Filter: Must be approved in Pitching Desk
        $builder->where('p.pitching_dosen_status', 'approved');
        $builder->where('p.pitching_admin_status', 'approved');

        if ($statusFilter) {
            $builder->where('p.wawancara_status', $statusFilter);
        }

        $builder->orderBy('p.updated_at', 'DESC');
        $proposals = $builder->get()->getResultArray();

        // Stats
        $statsBuilder = $db->table('pmw_proposals');
        $statsBuilder->select('wawancara_status, COUNT(*) as count');
        $statsBuilder->where('pitching_dosen_status', 'approved');
        $statsBuilder->where('pitching_admin_status', 'approved');
        $statsBuilder->groupBy('wawancara_status');
        $rawStats = $statsBuilder->get()->getResultArray();

        $stats = [
            'total'     => 0,
            'pending'   => 0,
            'approved'  => 0,
            'revision'  => 0,
            'rejected'  => 0,
        ];

        foreach ($rawStats as $rs) {
            $stats[$rs['wawancara_status']] = (int)$rs['count'];
            $stats['total'] += (int)$rs['count'];
        }

        return view('admin/perjanjian/index', [
            'title'           => 'Validasi Perjanjian Implementasi | PMW Polsri',
            'proposals'       => $proposals,
            'stats'           => $stats,
            'statusFilter'    => $statusFilter,
        ]);
    }

    /**
     * Detail and Validation
     */
    public function detail(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $memberModel = new PmwProposalMemberModel();
        $documentModel = new PmwDocumentModel();

        $proposal = $proposalModel->getProposalForValidation($id);

        if (!$proposal || $proposal['pitching_admin_status'] !== 'approved') {
            return redirect()->to('admin/perjanjian')->with('error', 'Proposal belum layak masuk tahap perjanjian atau tidak ditemukan');
        }

        $members = $memberModel->getByProposalId($id);
        $documents = $documentModel->getProposalDocs($id);

        $docsByKey = [];
        foreach ($documents as $doc) {
            if (!empty($doc['doc_key'])) {
                $docsByKey[$doc['doc_key']] = $doc;
            }
        }

        return view('admin/perjanjian/detail', [
            'title'     => 'Detail Perjanjian Implementasi | PMW Polsri',
            'proposal'  => $proposal,
            'members'   => $members,
            'docsByKey' => $docsByKey,
        ]);
    }

    /**
     * Validation process
     */
    public function validateAction(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $proposal = $proposalModel->find($id);

        if (!$proposal || $proposal['pitching_admin_status'] !== 'approved') {
            return redirect()->to('admin/perjanjian')->with('error', 'Akses ditolak');
        }

        $status = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');

        if (!in_array($status, ['approved', 'rejected', 'revision'])) {
            return redirect()->back()->with('error', 'Status tidak valid');
        }

        $updateData = [
            'wawancara_status'  => $status,
            'wawancara_catatan' => $catatan ?: null,
            'updated_at'        => date('Y-m-d H:i:s'),
        ];

        if ($proposalModel->update($id, $updateData)) {
            return redirect()->to('admin/perjanjian')->with('message', 'Validasi perjanjian berhasil disimpan');
        }

        return redirect()->back()->with('error', 'Gagal menyimpan validasi');
    }

    /**
     * Download or Preview Document
     */
    public function downloadDoc(int $docId)
    {
        $documentModel = new PmwDocumentModel();
        $doc = $documentModel->find($docId);

        if (!$doc) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan');
        }

        $absPath = WRITEPATH . $doc['file_path'];
        if (!is_file($absPath)) {
            return redirect()->back()->with('error', 'File fisik tidak ditemukan');
        }

        // Inline preview for PDF
        if ($this->request->getGet('inline') === '1') {
            return $this->response->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $doc['original_name'] . '"')
                ->setBody(file_get_contents($absPath));
        }

        return $this->response->download($absPath, null)->setFileName($doc['original_name'] ?? basename($absPath));
    }
}
