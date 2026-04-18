<?php

namespace App\Services;

use App\Models\Activity\PmwActivityScheduleModel;
use App\Models\Activity\PmwActivityLogbookModel;
use App\Models\Proposal\PmwProposalModel;
use Exception;

class PmwActivityService
{
    protected $scheduleModel;
    protected $logbookModel;
    protected $proposalModel;

    public function __construct()
    {
        $this->scheduleModel = new PmwActivityScheduleModel();
        $this->logbookModel  = new PmwActivityLogbookModel();
        $this->proposalModel = new PmwProposalModel();
    }

    /**
     * Create activity schedules for all qualified teams in a period
     */
    public function createBatchSchedules(int $periodId, array $data): int
    {
        $proposals = $this->proposalModel->getProposalsForSchedule($periodId);
        if (empty($proposals)) {
            throw new Exception("Belum ada tim yang lolos seleksi implementasi pada periode ini.");
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $count = 0;
        $notifModel = new \App\Models\NotificationModel();

        foreach ($proposals as $proposal) {
            $this->scheduleModel->insert([
                'proposal_id'       => $proposal['id'],
                'period_id'         => $periodId,
                'activity_category' => $data['activity_category'],
                'activity_date'     => $data['activity_date'],
                'activity_time'     => $data['activity_time'] ?? null,
                'location'          => $data['location'] ?? null,
                'status'            => 'planned',
                'notes'             => $data['notes'] ?? null,
            ]);

            // Notification
            $notifModel->createActivityScheduleNotification(
                (int)$proposal['leader_user_id'],
                $data['activity_category'],
                $data['activity_date']
            );

            $count++;
        }

        $db->transComplete();
        return $count;
    }

    /**
     * Create activity schedule (by Admin)
     */
    public function createSchedule(array $data): int
    {
        $proposal = $this->proposalModel->find($data['proposal_id']);
        if (!$proposal) {
            throw new Exception("Proposal tidak ditemukan.");
        }

        return $this->scheduleModel->insert([
            'proposal_id'       => $data['proposal_id'],
            'period_id'         => $proposal['period_id'],
            'activity_category' => $data['activity_category'],
            'activity_date'     => $data['activity_date'],
            'activity_time'     => $data['activity_time'] ?? null,
            'location'          => $data['location'] ?? null,
            'status'            => 'planned',
            'notes'             => $data['notes'] ?? null,
        ]);
    }

    /**
     * Submit or update logbook (by Mahasiswa)
     */
    public function submitLogbook(int $scheduleId, array $data, array $files): bool
    {
        $schedule = $this->scheduleModel->find($scheduleId);
        if (!$schedule) {
            throw new Exception("Jadwal kegiatan tidak ditemukan.");
        }

        $existing = $this->logbookModel->getBySchedule($scheduleId);

        $logbookData = [
            'schedule_id'          => $scheduleId,
            'activity_description' => $data['activity_description'],
            'video_url'            => $data['video_url'] ?? null,
        ];

        // Handle status
        $status = $data['status'] ?? 'draft';
        $logbookData['status'] = $status;

        // Handle File Uploads
        $uploadMap = [
            'photo_activity'         => 'activity/photos',
            'photo_supervisor_visit' => 'activity/supervisor',
        ];

        foreach ($uploadMap as $key => $folder) {
            if (isset($files[$key]) && $files[$key]->isValid() && !$files[$key]->hasMoved()) {
                // Delete old file if exists
                if ($existing && !empty($existing->$key)) {
                    $oldPath = WRITEPATH . 'uploads/' . $existing->$key;
                    if (is_file($oldPath)) {
                        unlink($oldPath);
                    }
                }
                $newName = $files[$key]->getRandomName();
                $files[$key]->move(WRITEPATH . 'uploads/' . $folder, $newName);
                $logbookData[$key] = $folder . '/' . $newName;
            }
        }

        if ($existing) {
            // Update - preserve approval statuses (do not reset)
            // Only update status to pending if it was revision
            if ($existing->status === 'revision' && $status !== 'draft') {
                $logbookData['status'] = 'pending';
            }
            return $this->logbookModel->update($existing->id, $logbookData);
        } else {
            // Insert new
            $logbookData['dosen_status']  = 'pending';
            $logbookData['mentor_status'] = 'pending';
            return $this->logbookModel->insert($logbookData);
        }
    }

    /**
     * Verify by Dosen (first tier)
     */
    public function verifyByDosen(int $logbookId, string $status, ?string $note): bool
    {
        $logbook = $this->logbookModel->find($logbookId);
        if (!$logbook) {
            throw new Exception("Logbook tidak ditemukan.");
        }

        $updateData = [
            'dosen_status'      => $status,
            'dosen_note'        => $note,
            'dosen_verified_at' => date('Y-m-d H:i:s'),
        ];

        // Update main status based on dosen decision
        if ($status === 'approved') {
            $updateData['status'] = 'approved_by_dosen';
        } elseif ($status === 'revision') {
            $updateData['status'] = 'revision';
        }

        return $this->logbookModel->update($logbookId, $updateData);
    }

    /**
     * Verify by Mentor (second tier)
     */
    public function verifyByMentor(int $logbookId, string $status, ?string $note): bool
    {
        $logbook = $this->logbookModel->find($logbookId);
        if (!$logbook) {
            throw new Exception("Logbook tidak ditemukan.");
        }

        // Check if already approved by dosen
        if ($logbook->dosen_status !== 'approved') {
            throw new Exception("Logbook belum di-approve oleh Dosen Pendamping.");
        }

        $updateData = [
            'mentor_status'      => $status,
            'mentor_note'        => $note,
            'mentor_verified_at' => date('Y-m-d H:i:s'),
        ];

        // Update main status based on mentor decision
        if ($status === 'approved') {
            $updateData['status'] = 'approved_by_mentor';
        } elseif ($status === 'revision') {
            $updateData['status'] = 'revision';
        }

        return $this->logbookModel->update($logbookId, $updateData);
    }

    /**
     * Verify by Admin (final tier)
     */
    public function verifyByAdmin(int $logbookId, string $status, ?string $note): bool
    {
        $logbook = $this->logbookModel->find($logbookId);
        if (!$logbook) {
            throw new Exception("Logbook tidak ditemukan.");
        }

        // Check if already approved by mentor
        if ($logbook->mentor_status !== 'approved') {
            throw new Exception("Logbook belum di-approve oleh Mentor.");
        }

        $updateData = [
            'admin_note'        => $note,
            'admin_verified_at' => date('Y-m-d H:i:s'),
        ];

        // Final status
        if ($status === 'approved') {
            $updateData['status'] = 'approved';
        } elseif ($status === 'revision') {
            $updateData['status'] = 'revision';
        }

        return $this->logbookModel->update($logbookId, $updateData);
    }

    /**
     * Delete schedule and its logbook
     */
    public function deleteSchedule(int $scheduleId): bool
    {
        $schedule = $this->scheduleModel->find($scheduleId);
        if (!$schedule) {
            throw new Exception("Jadwal tidak ditemukan.");
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Delete logbook and its files
            $logbook = $this->logbookModel->getBySchedule($scheduleId);
            if ($logbook) {
                $this->deleteLogbookFiles($logbook);
                $this->logbookModel->delete($logbook->id);
            }

            // Delete schedule
            $this->scheduleModel->delete($scheduleId);

            $db->transComplete();
            return true;
        } catch (\Exception $e) {
            $db->transRollback();
            throw $e;
        }
    }

    /**
     * Delete logbook files
     */
    private function deleteLogbookFiles($logbook): void
    {
        $fileFields = ['photo_activity', 'photo_supervisor_visit'];
        foreach ($fileFields as $field) {
            if (!empty($logbook->$field)) {
                $path = WRITEPATH . 'uploads/' . $logbook->$field;
                if (is_file($path)) {
                    unlink($path);
                }
            }
        }
    }

    /**
     * Get full activity data for a proposal
     */
    public function getFullData(int $proposalId): array
    {
        $schedules = $this->scheduleModel->getSchedulesByProposal($proposalId);

        foreach ($schedules as $schedule) {
            $schedule->logbook = $this->logbookModel->getBySchedule($schedule->id);
        }

        return [
            'schedules' => $schedules,
            'total'     => count($schedules),
        ];
    }
}
