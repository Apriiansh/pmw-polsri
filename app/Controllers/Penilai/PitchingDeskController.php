<?php

namespace App\Controllers\Penilai;

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
     * List of proposals for penilai assessment
     */
    public function index()
    {
        $proposalModel = new PmwProposalModel();
        $assessmentService = new PmwPitchingAssessmentService();

        $statusFilter   = $this->request->getGet('status');
        $kategoriFilter = $this->request->getGet('kategori');

        $proposals = $proposalModel->getProposalsForPenilai(auth()->user()->id, $statusFilter, $kategoriFilter);

        $allProposals = $proposalModel->getProposalsForPenilai(auth()->user()->id, null, $kategoriFilter);
        $mySubmitted = count(array_filter($allProposals, fn($p) => $p['has_submitted']));
        $stats = [
            'total'     => count($allProposals),
            'submitted' => count(array_filter($allProposals, fn($p) => !empty($p['student_submitted_at']))),
            'my_submitted' => $mySubmitted,
            'pending'   => count($allProposals) - $mySubmitted,
        ];

        return view('penilai/pitching/validation', [
            'title'           => 'Penilaian Pitching Desk | PMW Polsri',
            'proposals'       => $proposals,
            'stats'           => $stats,
            'statusFilter'    => $statusFilter,
            'kategoriFilter'  => $kategoriFilter,
        ]);
    }

    /**
     * Detail with assessment form
     */
    public function detail(int $id)
    {
        $proposalModel = new PmwProposalModel();
        $memberModel = new PmwProposalMemberModel();
        $documentModel = new PmwDocumentModel();
        $assessmentService = new PmwPitchingAssessmentService();

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

        $myAssessment = $assessmentService->getMyAssessment($id, auth()->user()->id);

        return view('penilai/pitching/validation_detail', [
            'title'        => 'Detail Penilaian Pitching | PMW Polsri',
            'proposal'     => $proposal,
            'members'      => $members,
            'docsByKey'    => $docsByKey,
            'myAssessment' => $myAssessment,
        ]);
    }

    /**
     * Submit penilai assessment via service
     */
    public function validateAction(int $id)
    {
        $rules = [
            'status'           => 'required|in_list[approved,rejected]',
            'catatan'          => 'required|min_length[5]|max_length[1000]',
            'persentase_nilai' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
        ];

        if (!$this->validateData($this->request->getPost(), $rules)) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal. Pastikan status, catatan (min 5 karakter), dan nilai sudah diisi.');
        }

        $service = new PmwPitchingAssessmentService();
        $service->submitAssessment(
            (int) $id,
            auth()->user()->id,
            [
                'status'           => $this->request->getPost('status'),
                'catatan'          => $this->request->getPost('catatan'),
                'persentase_nilai' => $this->request->getPost('persentase_nilai'),
            ]
        );

        return redirect()->to('penilai/pitching-desk')
            ->with('message', 'Nilai berhasil disimpan');
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
