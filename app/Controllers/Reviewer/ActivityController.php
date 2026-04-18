<?php

namespace App\Controllers\Reviewer;

use App\Controllers\BaseController;
use App\Models\Activity\PmwActivityScheduleModel;
use App\Models\Activity\PmwActivityLogbookModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\PmwPeriodModel;
use App\Services\PmwActivityService;
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

    public function index(): string
    {
        $scheduleModel = new PmwActivityScheduleModel();
        $schedules     = $scheduleModel->getAllSchedulesWithProposal();

        return view('reviewer/activity/index', [
            'title'     => 'Monitoring Kegiatan | PMW Polsri',
            'schedules' => $schedules,
        ]);
    }

    public function detail(int $scheduleId): string
    {
        $scheduleModel = new PmwActivityScheduleModel();
        $schedule      = $scheduleModel->find($scheduleId);

        if (!$schedule) {
            return redirect()->to('reviewer/kegiatan')->with('error', 'Jadwal tidak ditemukan.');
        }

        $proposal = $this->proposalModel->find($schedule->proposal_id);
        $logbookModel = new PmwActivityLogbookModel();
        $logbook      = $logbookModel->getBySchedule($scheduleId);

        return view('reviewer/activity/detail', [
            'title'     => 'Detail Monitoring | PMW Polsri',
            'schedule'  => $schedule,
            'proposal'  => $proposal,
            'logbook'   => $logbook,
        ]);
    }

    public function submitReview(int $scheduleId): ResponseInterface
    {
        try {
            $data = [
                'summary' => $this->request->getPost('summary'),
            ];
            $photo = $this->request->getFile('photo');

            $this->activityService->submitReview($scheduleId, auth()->id(), $data, $photo);

            return redirect()->back()->with('success', 'Monitoring kunjungan berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

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
            'reviewer'   => $logbook->reviewer_photo,
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
