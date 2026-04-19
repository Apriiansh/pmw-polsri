<?php

namespace App\Services;

use App\Models\Expo\PmwExpoScheduleModel;
use App\Models\Expo\PmwAwardCategoryModel;
use App\Models\Expo\PmwExpoSubmissionModel;
use App\Models\Expo\PmwExpoAttachmentModel;
use App\Models\Expo\PmwAwardModel;
use App\Models\Proposal\PmwProposalModel;
use CodeIgniter\Files\File;

class PmwExpoService
{
    protected $scheduleModel;
    protected $categoryModel;
    protected $submissionModel;
    protected $attachmentModel;
    protected $awardModel;
    protected $proposalModel;
    protected $notificationModel;

    public function __construct()
    {
        $this->scheduleModel   = new PmwExpoScheduleModel();
        $this->categoryModel   = new PmwAwardCategoryModel();
        $this->submissionModel = new PmwExpoSubmissionModel();
        $this->attachmentModel = new PmwExpoAttachmentModel();
        $this->awardModel      = new PmwAwardModel();
        $this->proposalModel   = new PmwProposalModel();
        $this->notificationModel = new \App\Models\NotificationModel();
    }

    /**
     * Create or Update Expo Schedule
     */
    public function saveSchedule(int $periodId, array $data)
    {
        $existing = $this->scheduleModel->where('period_id', $periodId)->first();
        
        $payload = [
            'period_id'           => $periodId,
            'event_name'          => $data['event_name'],
            'event_date'          => $data['event_date'],
            'location'            => $data['location'],
            'description'         => $data['description'],
            'submission_deadline' => $data['submission_deadline'],
        ];

        if ($existing) {
            $this->scheduleModel->update($existing->id, $payload);
        } else {
            $this->scheduleModel->insert($payload);
        }

        // Notify students about the expo schedule
        $this->notificationModel->createExpoScheduleNotification($periodId, $data['event_name'], $data['event_date']);

        return true;
    }

    /**
     * Toggle Expo Status (Open/Closed)
     */
    public function toggleStatus(int $periodId)
    {
        $schedule = $this->scheduleModel->where('period_id', $periodId)->first();
        if (!$schedule) throw new \Exception('Jadwal expo belum dibuat.');

        return $this->scheduleModel->update($schedule->id, ['is_closed' => !$schedule->is_closed]);
    }

    /**
     * Manage Award Categories
     */
    public function saveCategory(int $periodId, array $data, ?int $categoryId = null)
    {
        $payload = [
            'period_id' => $periodId,
            'name'      => $data['name'],
            'max_rank'  => $data['max_rank'],
        ];

        if ($categoryId) {
            return $this->categoryModel->update($categoryId, $payload);
        } else {
            return $this->categoryModel->insert($payload);
        }
    }

    /**
     * Delete Category
     */
    public function deleteCategory(int $categoryId)
    {
        return $this->categoryModel->delete($categoryId);
    }

    /**
     * Submit Student Documentation
     */
    public function submitDocumentation(int $proposalId, array $data, array $files)
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $existing = $this->submissionModel->getByProposal($proposalId);
            
            $submissionData = [
                'proposal_id'  => $proposalId,
                'summary'      => $data['summary'],
                'submitted_at' => date('Y-m-d H:i:s'),
            ];

            if ($existing) {
                $this->submissionModel->update($existing->id, $submissionData);
                $submissionId = $existing->id;
            } else {
                $submissionId = $this->submissionModel->insert($submissionData);
            }

            // Handle Attachments
            if (!empty($data['attachment_titles'])) {
                foreach ($data['attachment_titles'] as $index => $title) {
                    $attachmentId = $data['attachment_ids'][$index] ?? null;
                    $file         = $files['attachments'][$index] ?? null;

                    if ($attachmentId) {
                        // Update existing
                        $updateData = ['title' => $title];

                        if ($file && $file->isValid() && !$file->hasMoved()) {
                            // Replace file
                            $existingAtt = $this->attachmentModel->find($attachmentId);
                            if ($existingAtt) {
                                @unlink(WRITEPATH . 'uploads/' . $existingAtt->file_path);
                            }

                            $mimeType = $file->getMimeType();
                            $newName  = $file->getRandomName();
                            $file->move(WRITEPATH . 'uploads/expo', $newName);
                            
                            $updateData['file_path'] = 'expo/' . $newName;
                            $updateData['file_type'] = strpos($mimeType, 'image') !== false ? 'image' : 'document';
                        }

                        $this->attachmentModel->update($attachmentId, $updateData);
                    } else {
                        // New attachment
                        if ($file && $file->isValid() && !$file->hasMoved()) {
                            $mimeType = $file->getMimeType();
                            $newName  = $file->getRandomName();
                            $file->move(WRITEPATH . 'uploads/expo', $newName);
                            
                            $this->attachmentModel->insert([
                                'submission_id' => $submissionId,
                                'title'         => $title ?: 'Lampiran',
                                'file_path'     => 'expo/' . $newName,
                                'file_type'     => strpos($mimeType, 'image') !== false ? 'image' : 'document',
                            ]);
                        }
                    }
                }
            }

            // Trigger Notification to Admin
            $proposal = $this->proposalModel->find($proposalId);
            if ($proposal) {
                $this->notificationModel->createExpoSubmissionNotification($proposalId, $proposal['nama_usaha']);
            }

            $db->transCommit();
            return $submissionId;
        } catch (\Exception $e) {
            $db->transRollback();
            throw $e;
        }
    }

    /**
     * Assign Award Winner
     */
    public function assignWinner(array $data)
    {
        // Check if rank is already taken for this category
        $existing = $this->awardModel->where('category_id', $data['category_id'])
                                     ->where('rank', $data['rank'])
                                     ->first();
        if ($existing) {
            throw new \Exception("Peringkat {$data['rank']} sudah diisi untuk kategori ini.");
        }

        $awardId = $this->awardModel->insert([
            'proposal_id' => $data['proposal_id'],
            'category_id' => $data['category_id'],
            'rank'        => $data['rank'],
            'notes'       => $data['notes'] ?? '',
        ]);

        // Notify the winner
        $proposal = $this->proposalModel->find($data['proposal_id']);
        $category = $this->categoryModel->find($data['category_id']);
        if ($proposal && $category) {
            $this->notificationModel->createExpoAwardNotification(
                (int)$proposal['leader_user_id'],
                $category->name,
                (int)$data['rank']
            );
        }

        return $awardId;
    }

    /**
     * Delete Winner
     */
    public function deleteWinner(int $awardId)
    {
        return $this->awardModel->delete($awardId);
    }

    /**
     * Save/Update Certificate for a submission
     */
    public function saveCertificate(int $submissionId, $file)
    {
        if (!$file->isValid() || $file->hasMoved()) {
            throw new \Exception('File sertifikat tidak valid.');
        }

        $newName = $file->getRandomName();
        $file->move(WRITEPATH . 'uploads/certificates', $newName);

        $this->submissionModel->update($submissionId, [
            'certificate_path' => 'certificates/' . $newName
        ]);

        // Notify student about certificate
        $submission = $this->submissionModel->select('pmw_expo_submissions.*, p.leader_user_id, p.nama_usaha')
                                            ->join('pmw_proposals p', 'p.id = pmw_expo_submissions.proposal_id')
                                            ->find($submissionId);
        if ($submission && $submission->leader_user_id) {
            $this->notificationModel->createExpoCertificateNotification(
                (int)$submission->leader_user_id,
                $submission->nama_usaha
            );
        }

        return true;
    }

    /**
     * Delete Certificate
     */
    public function deleteCertificate(int $submissionId)
    {
        $submission = $this->submissionModel->find($submissionId);
        if ($submission && $submission->certificate_path) {
            @unlink(WRITEPATH . 'uploads/' . $submission->certificate_path);
        }

        return $this->submissionModel->update($submissionId, [
            'certificate_path' => null
        ]);
    }
}
