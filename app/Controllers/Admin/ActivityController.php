<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Activity\PmwActivityScheduleModel;
use App\Models\Activity\PmwActivityLogbookModel;
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
     * Admin dashboard - list all schedules
     */
    public function index(): string
    {
        $scheduleModel = new PmwActivityScheduleModel();
        
        // All individual schedules for validation
        $schedules = $scheduleModel->getAllSchedulesWithProposal();

        // Master schedules (Global Events)
        // Grouping by batch_id (new) or fall back to combination for legacy records
        $masterSchedules = $scheduleModel->select('
                batch_id, 
                activity_category, 
                activity_date, 
                location, 
                notes, 
                status,
                COUNT(*) as team_count
            ')
            ->groupBy('batch_id, activity_category, activity_date, location, notes, status')
            ->orderBy('activity_date', 'DESC')
            ->findAll();

        // Stats
        $stats = [
            'total'     => count($schedules),
            'planned'   => count(array_filter($schedules, fn($s) => $s->status === 'planned')),
            'ongoing'   => count(array_filter($schedules, fn($s) => $s->status === 'ongoing')),
            'completed' => count(array_filter($schedules, fn($s) => $s->status === 'completed')),
        ];

        return view('admin/activity/index', [
            'title'           => 'Manajemen Kegiatan Wirausaha | PMW Polsri',
            'schedules'       => $schedules,
            'masterSchedules' => $masterSchedules,
            'stats'           => $stats,
        ]);
    }

    /**
     * Create schedule for all qualified teams
     */
    public function createSchedule(): ResponseInterface
    {
        try {
            $data = $this->request->getPost();
            $activePeriod = $this->periodModel->where('is_active', true)->first();

            if (!$activePeriod) {
                return redirect()->back()->with('error', 'Tidak ada periode aktif yang ditemukan.');
            }

            $count = $this->activityService->createBatchSchedules((int)$activePeriod['id'], $data);

            return redirect()->back()->with('success', "Jadwal kegiatan berhasil dibuat untuk $count tim.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Detail page for verification
     */
    public function detail(int $scheduleId): string
    {
        $scheduleModel = new PmwActivityScheduleModel();
        $schedule      = $scheduleModel->find($scheduleId);

        if (!$schedule) {
            return redirect()->to('admin/kegiatan')->with('error', 'Jadwal tidak ditemukan.');
        }

        $proposal = $this->proposalModel->find($schedule->proposal_id);

        $logbookModel = new PmwActivityLogbookModel();
        $logbook      = $logbookModel->getBySchedule($scheduleId);

        return view('admin/activity/detail', [
            'title'     => 'Detail Kegiatan | PMW Polsri',
            'schedule'  => $schedule,
            'proposal'  => $proposal,
            'logbook'   => $logbook,
        ]);
    }

    /**
     * Admin final verification
     */
    public function verify(int $logbookId): ResponseInterface
    {
        try {
            $status = $this->request->getPost('status');
            $note   = $this->request->getPost('admin_note');

            $this->activityService->verifyByAdmin($logbookId, $status, $note);

            // Send notification to student
            $logbookModel = new PmwActivityLogbookModel();
            $logbook      = $logbookModel->getLogbookWithSchedule($logbookId);
            if ($logbook) {
                $notifModel = new NotificationModel();
                $notifModel->createActivityVerificationNotification(
                    (int)$logbook['leader_user_id'] ?? 0,
                    $logbook['activity_category'],
                    $status === 'approved' ? 'approved' : 'revision',
                    'admin'
                );
            }

            return redirect()->back()->with('success', 'Verifikasi final berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Submit visit documentation (by Admin)
     */
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

    /**
     * Delete schedule batch
     */
    public function deleteSchedule(int $scheduleId): ResponseInterface
    {
        try {
            $this->activityService->deleteSchedule($scheduleId);
            return redirect()->to('admin/kegiatan')->with('success', 'Jadwal kegiatan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Delete batch of schedules
     */
    public function deleteBatch(): ResponseInterface
    {
        try {
            $batchId = $this->request->getPost('batch_id');
            $scheduleModel = new PmwActivityScheduleModel();

            $builder = $scheduleModel->builder();
            if (!empty($batchId)) {
                $builder->where('batch_id', $batchId);
            } else {
                // Fallback for legacy records
                $builder->where('activity_category', $this->request->getPost('activity_category'))
                        ->where('activity_date', $this->request->getPost('activity_date'))
                        ->where('location', $this->request->getPost('location'));
            }

            $schedules = $builder->get()->getResult();
            foreach ($schedules as $s) {
                $this->activityService->deleteSchedule((int)$s->id);
            }

            return redirect()->to('admin/kegiatan')->with('success', 'Batch jadwal kegiatan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update batch of schedules
     */
    public function updateBatch(): ResponseInterface
    {
        try {
            $batchId = $this->request->getPost('batch_id');
            $data = [
                'activity_category' => $this->request->getPost('activity_category'),
                'activity_date'     => $this->request->getPost('activity_date'),
                'location'          => $this->request->getPost('location'),
                'notes'             => $this->request->getPost('notes'),
                'status'            => $this->request->getPost('status'),
            ];

            $scheduleModel = new PmwActivityScheduleModel();
            $builder = $scheduleModel->builder();
            
            if (!empty($batchId)) {
                $builder->where('batch_id', $batchId);
            } else {
                // Fallback for legacy records
                $builder->where('activity_category', $this->request->getPost('old_category'))
                        ->where('activity_date', $this->request->getPost('old_date'))
                        ->where('location', $this->request->getPost('old_location'));
            }

            $builder->update($data);

            return redirect()->to('admin/kegiatan')->with('success', 'Batch jadwal kegiatan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Serve files
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
