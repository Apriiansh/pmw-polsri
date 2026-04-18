<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Activity\PmwActivityScheduleModel;
use App\Models\Activity\PmwActivityLogbookModel;
use App\Models\Activity\PmwActivityLogbookPhotoModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\PmwPeriodModel;
use App\Services\PmwActivityService;
use App\Models\NotificationModel;
use CodeIgniter\HTTP\ResponseInterface;

class ActivityController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];
    protected $activityService;
    protected $proposalModel;
    protected $periodModel;

    public function __construct()
    {
        $this->activityService = new PmwActivityService();
        $this->proposalModel   = new PmwProposalModel();
        $this->periodModel     = new PmwPeriodModel();
    }

    /**
     * Mahasiswa dashboard - view schedules
     */
    public function index(): string|ResponseInterface
    {
        $user         = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return redirect()->to('dashboard')->with('error', 'Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return redirect()->to('dashboard')->with('error', 'Proposal tidak ditemukan atau Anda bukan ketua tim.');
        }

        // Check if proposal is approved in implementasi
        if (!$this->isImplementasiApproved($proposal['id'])) {
            return redirect()->to('dashboard')->with('error', 'Fitur ini hanya tersedia setelah tahap implementasi di-approve.');
        }

        $scheduleModel = new PmwActivityScheduleModel();
        $schedules     = $scheduleModel->getSchedulesByProposal($proposal['id']);

        // Attach logbook and gallery to each schedule
        $logbookModel = new PmwActivityLogbookModel();
        $photoModel   = new PmwActivityLogbookPhotoModel();
        foreach ($schedules as $schedule) {
            $schedule->logbook = $logbookModel->getBySchedule($schedule->id);
            if ($schedule->logbook) {
                $schedule->logbook->gallery = $photoModel->getByLogbook((int)$schedule->logbook->id);
            } else {
                $schedule->logbook_gallery = [];
            }
        }

        // Stats
        $statsTotal    = count($schedules);
        $statsLogbook  = count(array_filter($schedules, fn($s) => $s->logbook !== null));
        $statsVerified = count(array_filter($schedules, fn($s) => $s->logbook && $s->logbook->status === 'approved'));

        return view('mahasiswa/activity', [
            'title'         => 'Logbook Kegiatan Wirausaha | PMW Polsri',
            'proposal'      => $proposal,
            'schedules'     => $schedules,
            'statsTotal'    => $statsTotal,
            'statsLogbook'  => $statsLogbook,
            'statsVerified' => $statsVerified,
        ]);
    }

    /**
     * Submit logbook
     */
    public function submitLogbook(int $scheduleId): ResponseInterface
    {
        try {
            $data  = $this->request->getPost();
            
            // Handle multiple activity photos
            $files = [
                'photo_activity'         => $this->request->getFileMultiple('photo_activity'),
                'photo_supervisor_visit' => $this->request->getFile('photo_supervisor_visit'),
            ];

            // Filter out missing/invalid files
            if (isset($files['photo_activity'])) {
                $files['photo_activity'] = array_filter($files['photo_activity'], fn($f) => $f && $f->isValid() && !$f->hasMoved());
            }
            if (isset($files['photo_supervisor_visit'])) {
                if (!$files['photo_supervisor_visit'] || !$files['photo_supervisor_visit']->isValid() || $files['photo_supervisor_visit']->hasMoved()) {
                    unset($files['photo_supervisor_visit']);
                }
            }

            $status = $data['status'] ?? 'draft';
            $this->activityService->submitLogbook($scheduleId, $data, $files);

            // Send notification to verifier (Dosen) ONLY if not draft
            if ($status !== 'draft') {
                $scheduleModel = new PmwActivityScheduleModel();
                $schedule      = $scheduleModel->find($scheduleId);
                if ($schedule) {
                    /** @var array $proposal */
                    $proposal = $this->proposalModel->find($schedule->proposal_id);
                    if ($proposal) {
                        $notifModel = new NotificationModel();
                        $notifModel->createActivitySubmissionNotification(
                            (int)$proposal['leader_user_id'],
                            $schedule->activity_category,
                            $proposal['nama_usaha'] ?? 'Tim'
                        );
                    }
                }
            }

            $successMsg = ($status === 'draft') ? 'Draft logbook berhasil disimpan.' : 'Logbook berhasil dikirim untuk verifikasi.';
            return redirect()->back()->with('success', $successMsg);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * View file
     */
    public function viewFile(string $fileType, int $logbookId): ResponseInterface
    {
        $logbookModel = new PmwActivityLogbookModel();
        $logbook      = $logbookModel->find($logbookId);

        if (!$logbook) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        $scheduleModel = new PmwActivityScheduleModel();
        $schedule      = $scheduleModel->find($logbook->schedule_id);

        if (!$schedule) {
            return $this->response->setStatusCode(404)->setBody('Jadwal tidak ditemukan.');
        }

        /** @var array|null $proposal */
        $proposal = $this->proposalModel->find($schedule->proposal_id);
        if (!$proposal || (int)($proposal['leader_user_id'] ?? 0) !== (int)auth()->id()) {
            return $this->response->setStatusCode(403)->setBody('Akses ditolak.');
        }

        $filePath = match ($fileType) {
            'photo'      => $logbook->photo_activity,
            'supervisor' => $logbook->photo_supervisor_visit,
            'reviewer'   => $logbook->reviewer_photo,
            default      => ''
        };

        if (empty($filePath)) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        $absPath = WRITEPATH . 'uploads/' . $filePath;
        if (!is_file($absPath)) {
            return $this->response->setStatusCode(404)->setBody('File fisik tidak ditemukan.');
        }

        $mimeType = mime_content_type($absPath) ?: 'application/octet-stream';
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($absPath) . '"')
            ->setBody(file_get_contents($absPath));
    }

    /**
     * View gallery file
     */
    public function viewGalleryFile(int $photoId): ResponseInterface
    {
        $photoModel = new PmwActivityLogbookPhotoModel();
        $photo      = $photoModel->find($photoId);

        if (!$photo) {
            return $this->response->setStatusCode(404)->setBody('Foto tidak ditemukan.');
        }

        // Access check (must be owner of the logbook)
        $logbookModel = new PmwActivityLogbookModel();
        $logbook      = $logbookModel->find($photo->logbook_id);
        
        $scheduleModel = new PmwActivityScheduleModel();
        $schedule      = $scheduleModel->find($logbook->schedule_id);
        
        $proposal = $this->proposalModel->find($schedule->proposal_id);
        if (!$proposal || (int)($proposal['leader_user_id'] ?? 0) !== (int)auth()->id()) {
            return $this->response->setStatusCode(403)->setBody('Akses ditolak.');
        }

        $absPath = WRITEPATH . 'uploads/' . $photo->file_path;
        if (!is_file($absPath)) {
            return $this->response->setStatusCode(404)->setBody('File fisik tidak ditemukan.');
        }

        $mimeType = mime_content_type($absPath) ?: 'application/octet-stream';
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($absPath) . '"')
            ->setBody(file_get_contents($absPath));
    }

    /**
     * Delete gallery photo
     */
    public function deletePhoto(int $photoId): ResponseInterface
    {
        try {
            $photoModel = new PmwActivityLogbookPhotoModel();
            $photo      = $photoModel->find($photoId);

            if (!$photo) {
                throw new \Exception("Foto tidak ditemukan.");
            }

            // Access check
            $logbookModel = new PmwActivityLogbookModel();
            $logbook      = $logbookModel->find($photo->logbook_id);
            $scheduleModel = new PmwActivityScheduleModel();
            $schedule      = $scheduleModel->find($logbook->schedule_id);
            $proposal      = $this->proposalModel->find($schedule->proposal_id);

            if (!$proposal || (int)($proposal['leader_user_id'] ?? 0) !== (int)auth()->id()) {
                throw new \Exception("Akses ditolak.");
            }

            // Delete physical file
            $absPath = WRITEPATH . 'uploads/' . $photo->file_path;
            if (is_file($absPath)) {
                unlink($absPath);
            }

            // Delete record
            $photoModel->delete($photoId);

            return $this->response->setJSON(['success' => true]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()])->setStatusCode(400);
        }
    }

    /**
     * Check if implementasi is approved
     */
    private function isImplementasiApproved(int $proposalId): bool
    {
        $db = \Config\Database::connect();
        $selection = $db->table('pmw_selection_implementasi')
            ->where('proposal_id', $proposalId)
            ->where('admin_status', 'approved')
            ->get()
            ->getRow();

        return $selection !== null;
    }
}
