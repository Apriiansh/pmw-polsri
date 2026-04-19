<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PmwPeriodModel;
use App\Models\Expo\PmwExpoScheduleModel;
use App\Models\Expo\PmwAwardCategoryModel;
use App\Models\Expo\PmwExpoSubmissionModel;
use App\Models\Expo\PmwExpoAttachmentModel;
use App\Services\PmwExpoService;
use CodeIgniter\HTTP\ResponseInterface;

class ExpoController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];
    protected $expoService;
    protected $periodModel;

    public function __construct()
    {
        $this->expoService = new PmwExpoService();
        $this->periodModel = new PmwPeriodModel();
    }

    /**
     * Expo Dashboard & Settings
     */
    public function index(): string
    {
        $activePeriod = $this->periodModel->where('is_active', true)->first();
        if (!$activePeriod) {
            return "Periode aktif tidak ditemukan.";
        }

        $scheduleModel = new PmwExpoScheduleModel();
        $categoryModel = new PmwAwardCategoryModel();
        $submissionModel = new PmwExpoSubmissionModel();

        $schedule   = $scheduleModel->getActiveSchedule((int)$activePeriod['id']);
        $categories = $categoryModel->getCategoriesByPeriod((int)$activePeriod['id']);
        $submissions = $submissionModel->getAllSubmissionsWithDetails((int)$activePeriod['id']);

        return view('admin/expo/index', [
            'title'       => 'Awarding & Expo PMW | Polsri',
            'period'      => $activePeriod,
            'schedule'    => $schedule,
            'categories'  => $categories,
            'submissions' => $submissions,
        ]);
    }

    /**
     * Save Expo Schedule
     */
    public function saveSchedule(): ResponseInterface
    {
        try {
            $activePeriod = $this->periodModel->where('is_active', true)->first();
            $data = $this->request->getPost();
            
            $this->expoService->saveSchedule((int)$activePeriod['id'], $data);
            
            return redirect()->back()->with('success', 'Jadwal Expo berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Toggle Expo Status
     */
    public function toggleStatus(): ResponseInterface
    {
        try {
            $activePeriod = $this->periodModel->where('is_active', true)->first();
            $this->expoService->toggleStatus((int)$activePeriod['id']);
            
            return redirect()->back()->with('success', 'Status Expo berhasil diubah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Save Category
     */
    public function saveCategory(): ResponseInterface
    {
        try {
            $activePeriod = $this->periodModel->where('is_active', true)->first();
            $data = $this->request->getPost();
            $categoryId = $this->request->getPost('id');
            
            $this->expoService->saveCategory((int)$activePeriod['id'], $data, $categoryId ? (int)$categoryId : null);
            
            return redirect()->back()->with('success', 'Kategori award berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete Category
     */
    public function deleteCategory(int $id): ResponseInterface
    {
        try {
            $this->expoService->deleteCategory($id);
            return redirect()->back()->with('success', 'Kategori award berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * View Submission Detail
     */
    public function submissionDetail(int $id): string
    {
        $submissionModel = new PmwExpoSubmissionModel();
        $attachmentModel = new PmwExpoAttachmentModel();
        $proposalModel   = new \App\Models\Proposal\PmwProposalModel();
        $memberModel     = new \App\Models\Proposal\PmwProposalMemberModel();
        $awardModel      = new \App\Models\Expo\PmwAwardModel();
        
        $submission = $submissionModel->select('pmw_expo_submissions.*, p.nama_usaha, pm.nama as ketua_nama, pm.nim as ketua_nim')
                                      ->join('pmw_proposals p', 'p.id = pmw_expo_submissions.proposal_id')
                                      ->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left')
                                      ->find($id);
        
        if (!$submission) {
            return "Dokumentasi tidak ditemukan.";
        }

        $proposal    = $proposalModel->getProposalForValidation((int)$submission->proposal_id);
        $members     = $memberModel->where('proposal_id', $submission->proposal_id)->findAll();
        $attachments = $attachmentModel->getBySubmission($id);
        $awards      = $awardModel->getTeamAwards((int)$submission->proposal_id);

        return view('admin/expo/submission_detail', [
            'title'       => 'Detail Dokumentasi Expo | PMW Polsri',
            'submission'  => $submission,
            'proposal'    => $proposal,
            'members'     => $members,
            'attachments' => $attachments,
            'awards'      => $awards,
        ]);
    }

    /**
     * Upload Certificate
     */
    public function uploadCertificate(): ResponseInterface
    {
        try {
            $submissionId = $this->request->getPost('submission_id');
            $file = $this->request->getFile('certificate');

            $this->expoService->saveCertificate((int)$submissionId, $file);

            return redirect()->back()->with('success', 'Sertifikat berhasil diunggah.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete Certificate
     */
    public function deleteCertificate(int $id): ResponseInterface
    {
        try {
            $this->expoService->deleteCertificate($id);
            return redirect()->back()->with('success', 'Sertifikat berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * View/Download Certificate
     */
    public function viewCertificate(int $id): ResponseInterface
    {
        $submissionModel = new \App\Models\Expo\PmwExpoSubmissionModel();
        $submission = $submissionModel->find($id);

        if (!$submission || !$submission->certificate_path) {
            return $this->response->setStatusCode(404)->setBody("Sertifikat tidak ditemukan.");
        }

        $absPath = WRITEPATH . 'uploads/' . $submission->certificate_path;

        if (!is_file($absPath)) {
            return $this->response->setStatusCode(404)->setBody("File fisik tidak ditemukan.");
        }

        $mimeType = mime_content_type($absPath) ?: 'application/pdf';
        
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="Sertifikat_' . $submission->id . '"')
            ->setBody(file_get_contents($absPath));
    }

    /**
     * View/Download Attachment
     */
    public function viewAttachment(int $id): ResponseInterface
    {
        $attachmentModel = new \App\Models\Expo\PmwExpoAttachmentModel();
        $attachment = $attachmentModel->find($id);

        if (!$attachment) {
            return $this->response->setStatusCode(404)->setBody("Lampiran tidak ditemukan.");
        }

        $absPath = WRITEPATH . 'uploads/' . $attachment->file_path;

        if (!is_file($absPath)) {
            return $this->response->setStatusCode(404)->setBody("File fisik tidak ditemukan.");
        }

        $mimeType = mime_content_type($absPath) ?: 'application/octet-stream';
        
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . esc($attachment->title) . '"')
            ->setBody(file_get_contents($absPath));
    }
}
