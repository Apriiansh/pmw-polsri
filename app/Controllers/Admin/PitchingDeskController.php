<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\PmwDocumentModel;
use App\Services\PmwPitchingAssessmentService;
use CodeIgniter\HTTP\ResponseInterface;

class PitchingDeskController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];

    /**
     * List of proposals with multi-penilai aggregation
     */
    public function index()
    {
        $proposalModel = new PmwProposalModel();

        $statusFilter   = $this->request->getGet('status');
        $kategoriFilter = $this->request->getGet('kategori');

        $proposals = $proposalModel->getProposalsForAdminPitching($statusFilter, $kategoriFilter);

        $allProposals = $proposalModel->getProposalsForAdminPitching(null, $kategoriFilter);
        $stats = [
            'total'      => count($allProposals),
            'submitted'  => count(array_filter($allProposals, fn($p) => !empty($p['student_submitted_at']))),
            'assessed'   => count(array_filter($allProposals, fn($p) => ($p['assessment_count'] ?? 0) > 0)),
            'finalized'  => count(array_filter($allProposals, fn($p) => !empty($p['penilaian_final_at']))),
        ];

        return view('admin/pitching/validation', [
            'title'           => 'Validasi Pitching Desk | PMW Polsri',
            'proposals'       => $proposals,
            'stats'           => $stats,
            'statusFilter'    => $statusFilter,
            'kategoriFilter'  => $kategoriFilter,
        ]);
    }

    /**
     * Detail with aggregation panel + admin assessment form + edit penilai
     */
    public function detail(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $memberModel = new PmwProposalMemberModel();
        $documentModel = new PmwDocumentModel();
        $assessmentService = new PmwPitchingAssessmentService();

        $proposal = $proposalModel->getProposalForValidation($id);

        if (!$proposal) {
            return redirect()->to('admin/pitching-desk')->with('error', 'Proposal tidak ditemukan');
        }

        $members = $memberModel->getByProposalId($id);
        $documents = $documentModel->getProposalDocs($id);

        $docsByKey = [];
        foreach ($documents as $doc) {
            if (!empty($doc['doc_key'])) {
                $docsByKey[$doc['doc_key']] = $doc;
            }
        }

        $assessments = $assessmentService->getAssessmentsForProposal($id);
        $aggregation = $assessmentService->getAggregation($id);
        $totalPenilai = $assessmentService->getTotalPenilaiCount();
        $canPenilaiAssess = $assessmentService->canPenilaiAssess($id);

        return view('admin/pitching/validation_detail', [
            'title'            => 'Validasi Pitching Desk | PMW Polsri',
            'proposal'         => $proposal,
            'members'          => $members,
            'docsByKey'        => $docsByKey,
            'assessments'      => $assessments,
            'aggregation'      => $aggregation,
            'totalPenilai'     => $totalPenilai,
            'canPenilaiAssess' => $canPenilaiAssess,
        ]);
    }

    /**
     * Admin submits their own assessment (100% weight)
     */
    public function submitAdminAssessment(int $id)
    {
        $service = new PmwPitchingAssessmentService();

        $status = $this->request->getPost('status');
        $persentaseNilai = (float) $this->request->getPost('persentase_nilai');
        $catatan = $this->request->getPost('catatan');

        if (empty($status) || !in_array($status, ['approved', 'rejected'])) {
            return redirect()->back()->withInput()->with('error', 'Status penilaian harus dipilih.');
        }
        if ($persentaseNilai < 0 || $persentaseNilai > 100) {
            return redirect()->back()->withInput()->with('error', 'Nilai harus antara 0-100.');
        }
        if (empty($catatan)) {
            return redirect()->back()->withInput()->with('error', 'Catatan wajib diisi.');
        }

        $result = $service->submitAdminAssessment($id, user()->id, [
            'status'           => $status,
            'persentase_nilai' => $persentaseNilai,
            'catatan'          => $catatan,
        ]);

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->to('admin/pitching-desk/' . $id)
            ->with('message', 'Penilaian admin (100%) berhasil dikirim dan difinalisasi.');
    }

    /**
     * Admin edits a penilai's assessment
     */
    public function editPenilaiAssessment(int $id)
    {
        $service = new PmwPitchingAssessmentService();

        $assessmentId = (int) $this->request->getPost('assessment_id');
        $status = $this->request->getPost('status');
        $persentaseNilai = (float) $this->request->getPost('persentase_nilai');
        $catatan = $this->request->getPost('catatan');

        if (!$assessmentId) {
            return redirect()->back()->with('error', 'ID penilaian tidak valid.');
        }
        if (empty($status) || !in_array($status, ['approved', 'rejected'])) {
            return redirect()->back()->with('error', 'Status penilaian harus dipilih.');
        }
        if ($persentaseNilai < 0 || $persentaseNilai > 100) {
            return redirect()->back()->with('error', 'Nilai harus antara 0-100.');
        }

        $result = $service->editPenilaiAssessment($assessmentId, user()->id, [
            'status'           => $status,
            'persentase_nilai' => $persentaseNilai,
            'catatan'          => $catatan,
        ]);

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->to('admin/pitching-desk/' . $id)
            ->with('message', 'Penilaian penilai berhasil diperbarui.');
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
