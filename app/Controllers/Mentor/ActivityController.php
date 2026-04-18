<?php

namespace App\Controllers\Mentor;

use App\Controllers\BaseController;
use App\Models\Activity\PmwActivityScheduleModel;
use App\Models\Activity\PmwActivityLogbookModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\MentorModel;
use App\Services\PmwActivityService;
use App\Models\NotificationModel;
use CodeIgniter\HTTP\ResponseInterface;

class ActivityController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];
    protected $activityService;
    protected $proposalModel;
    protected $mentorModel;

    public function __construct()
    {
        $this->activityService = new PmwActivityService();
        $this->proposalModel   = new PmwProposalModel();
        $this->mentorModel     = new MentorModel();
    }

    /**
     * Mentor dashboard
     */
    public function index(): string
    {
        $mentor = $this->mentorModel->getByUserId(auth()->id());
        if (!$mentor) {
            return redirect()->to('dashboard')->with('error', 'Data mentor tidak ditemukan.');
        }

        // Get proposals assigned to this mentor
        $proposals = $this->proposalModel->getProposalsByMentor((int) $mentor['id']);
        $proposalIds = array_column($proposals, 'id');

        // Get pending logbooks for these proposals (status = approved_by_dosen)
        $logbookModel = new PmwActivityLogbookModel();
        $pendingLogbooks = $logbookModel->getPendingForMentor($proposalIds);

        // Stats
        $stats = [
            'total'     => count($pendingLogbooks),
            'pending'   => count($pendingLogbooks),
        ];

        return view('mentor/activity/index', [
            'title'           => 'Verifikasi Kegiatan Wirausaha | PMW Polsri',
            'proposals'       => $proposals,
            'pendingLogbooks' => $pendingLogbooks,
            'stats'           => $stats,
        ]);
    }

    /**
     * Mentor verification
     */
    public function verify(int $logbookId): ResponseInterface
    {
        try {
            $status = $this->request->getPost('status');
            $note   = $this->request->getPost('mentor_note');

            $this->activityService->verifyByMentor($logbookId, $status, $note);

            // Send notification to student
            $logbookModel = new PmwActivityLogbookModel();
            $logbook      = $logbookModel->getLogbookWithSchedule($logbookId);
            if ($logbook) {
                $notifModel = new NotificationModel();
                $notifModel->createActivityVerificationNotification(
                    (int)$logbook['leader_user_id'] ?? 0,
                    $logbook['activity_category'],
                    $status === 'approved' ? 'approved_by_mentor' : 'revision',
                    'mentor'
                );
            }

            return redirect()->back()->with('success', 'Verifikasi berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * View file
     */
    public function viewFile(string $type, int $logbookId): ResponseInterface
    {
        $logbookModel = new PmwActivityLogbookModel();
        $logbook = $logbookModel->find($logbookId);

        if (!$logbook) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        $filePath = match ($type) {
            'photo'     => $logbook->photo_activity,
            'supervisor' => $logbook->photo_supervisor_visit,
            default     => ''
        };

        if (empty($filePath)) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        $absPath = WRITEPATH . 'uploads/' . $filePath;
        if (!is_file($absPath)) {
            return $this->response->setStatusCode(404)->setBody('File fisik tidak ditemukan.');
        }

        $mimeType = mime_content_type($absPath);
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($absPath) . '"')
            ->setBody(file_get_contents($absPath));
    }
}
