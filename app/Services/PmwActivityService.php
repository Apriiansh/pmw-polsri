<?php

namespace App\Services;

use App\Models\Activity\PmwActivityScheduleModel;
use App\Models\Activity\PmwActivityLogbookModel;
use App\Models\Activity\PmwActivityLogbookPhotoModel;
use App\Models\Proposal\PmwProposalModel;
use Exception;

class PmwActivityService
{
    protected $scheduleModel;
    protected $logbookModel;
    protected $photoModel;
    protected $proposalModel;

    public function __construct()
    {
        $this->scheduleModel = new PmwActivityScheduleModel();
        $this->logbookModel  = new PmwActivityLogbookModel();
        $this->photoModel    = new PmwActivityLogbookPhotoModel();
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

        $batchId = 'ACT-' . strtoupper(bin2hex(random_bytes(4)));
        foreach ($proposals as $proposal) {
            $this->scheduleModel->insert([
                'proposal_id'       => $proposal['id'],
                'period_id'         => $periodId,
                'batch_id'          => $batchId,
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

        // Handle File Uploads (Single ones: Supervisor Visit)
        if (isset($files['photo_supervisor_visit']) && $files['photo_supervisor_visit']->isValid() && !$files['photo_supervisor_visit']->hasMoved()) {
            // Delete old file if exists
            if ($existing && !empty($existing->photo_supervisor_visit)) {
                $oldPath = WRITEPATH . 'uploads/' . $existing->photo_supervisor_visit;
                if (is_file($oldPath)) {
                    unlink($oldPath);
                }
            }
            $newName = $files['photo_supervisor_visit']->getRandomName();
            $files['photo_supervisor_visit']->move(WRITEPATH . 'uploads/activity/supervisor', $newName);
            $logbookData['photo_supervisor_visit'] = 'activity/supervisor/' . $newName;
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            if ($existing) {
                // Update - preserve approval statuses (do not reset)
                if ($existing->status === 'revision' && $status !== 'draft') {
                    $logbookData['status'] = 'pending';
                }
                $this->logbookModel->update($existing->id, $logbookData);
                $logbookId = $existing->id;
            } else {
                // Insert new
                $logbookData['dosen_status']  = 'pending';
                $logbookData['mentor_status'] = 'pending';
                $logbookId = $this->logbookModel->insert($logbookData);
            }

            // Handle Multiple Activity Photos
            if (isset($files['photo_activity'])) {
                $activityPhotos = is_array($files['photo_activity']) ? $files['photo_activity'] : [$files['photo_activity']];
                
                $isFirst = true;
                foreach ($activityPhotos as $photo) {
                    if ($photo->isValid() && !$photo->hasMoved()) {
                        $newName = $photo->getRandomName();
                        $photo->move(WRITEPATH . 'uploads/activity/photos', $newName);
                        $savedPath = 'activity/photos/' . $newName;

                        // Save to photos table
                        $this->photoModel->insert([
                            'logbook_id'    => $logbookId,
                            'file_path'     => $savedPath,
                            'original_name' => $photo->getClientName(),
                        ]);

                        // Set the first one as primary in main table for compatibility
                        if ($isFirst && (!$existing || empty($existing->photo_activity))) {
                            $this->logbookModel->update($logbookId, ['photo_activity' => $savedPath]);
                        }
                        $isFirst = false;
                    }
                }
            }

            $db->transComplete();
            return $db->transStatus();
        } catch (Exception $e) {
            $db->transRollback();
            throw $e;
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
        // 1. Delete Gallery Photos
        $photos = $this->photoModel->getByLogbook((int)$logbook->id);
        foreach ($photos as $photo) {
            $path = WRITEPATH . 'uploads/' . $photo->file_path;
            if (is_file($path)) {
                unlink($path);
            }
            $this->photoModel->delete($photo->id);
        }

        // 2. Delete Single Files (Legacy/Internal)
        $fileFields = ['photo_activity', 'photo_supervisor_visit', 'reviewer_photo', 'admin_photo'];
        foreach ($fileFields as $field) {
            if (!empty($logbook->$field)) {
                $path = WRITEPATH . 'uploads/' . $logbook->$field;
                if (is_file($path)) {
                    unlink($path);
                }
            }
        }

        // 3. Delete Multiple Photos (Gallery)
        $photoModel = new PmwActivityLogbookPhotoModel();
        $photos     = $photoModel->getByLogbook($logbook->id);
        foreach ($photos as $photo) {
            $path = WRITEPATH . 'uploads/' . $photo->file_path;
            if (is_file($path)) {
                unlink($path);
            }
        }
        $photoModel->where('logbook_id', $logbook->id)->delete();
    }

    /**
     * Submit visit documentation (by Admin or Reviewer)
     */
    public function submitReview(int $scheduleId, int $userId, array $data, ?array $photos): bool
    {
        $logbook = $this->logbookModel->getBySchedule($scheduleId);
        
        // Ensure logbook exists or create one (draft)
        if (!$logbook) {
            $logbookId = $this->logbookModel->insert([
                'schedule_id' => $scheduleId,
                'status'      => 'draft',
            ]);
            $logbook = $this->logbookModel->find($logbookId);
        }

        // Determine role based on current auth user
        $role = auth()->user()->inGroup('admin', 'superadmin') ? 'admin' : 'reviewer';
        
        $updateData = [];
        if ($role === 'admin') {
            $updateData = [
                'admin_summary' => $data['summary'],
                'admin_at'      => date('Y-m-d H:i:s'),
            ];
            $uploadPath = 'activity/admin';
        } else {
            $updateData = [
                'reviewer_summary' => $data['summary'],
                'reviewer_id'      => $userId,
                'reviewer_at'      => date('Y-m-d H:i:s'),
            ];
            $uploadPath = 'activity/reviewer';
        }

        // Update Logbook Text Data
        $this->logbookModel->update($logbook->id, $updateData);

        // Handle Multiple Photos Upload
        if (!empty($photos)) {
            $photoModel = new PmwActivityLogbookPhotoModel();
            foreach ($photos as $photo) {
                if ($photo->isValid() && !$photo->hasMoved()) {
                    $newName = $photo->getRandomName();
                    $photo->move(WRITEPATH . 'uploads/' . $uploadPath, $newName);
                    
                    $photoModel->insert([
                        'logbook_id'    => $logbook->id,
                        'uploader_role' => $role,
                        'file_path'     => $uploadPath . '/' . $newName,
                        'original_name' => $photo->getClientName(),
                    ]);
                }
            }
        }

        return true;
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
