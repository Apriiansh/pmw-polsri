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

    public function __construct()
    {
        $this->scheduleModel   = new PmwExpoScheduleModel();
        $this->categoryModel   = new PmwAwardCategoryModel();
        $this->submissionModel = new PmwExpoSubmissionModel();
        $this->attachmentModel = new PmwExpoAttachmentModel();
        $this->awardModel      = new PmwAwardModel();
        $this->proposalModel   = new PmwProposalModel();
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
            return $this->scheduleModel->update($existing->id, $payload);
        } else {
            return $this->scheduleModel->insert($payload);
        }
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
            if (!empty($files['attachments'])) {
                foreach ($files['attachments'] as $index => $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move(WRITEPATH . 'uploads/expo', $newName);
                        
                        $this->attachmentModel->insert([
                            'submission_id' => $submissionId,
                            'title'         => $data['attachment_titles'][$index] ?? 'Lampiran',
                            'file_path'     => 'expo/' . $newName,
                            'file_type'     => strpos($file->getMimeType(), 'image') !== false ? 'image' : 'document',
                        ]);
                    }
                }
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

        return $this->awardModel->insert([
            'proposal_id' => $data['proposal_id'],
            'category_id' => $data['category_id'],
            'rank'        => $data['rank'],
            'notes'       => $data['notes'] ?? '',
        ]);
    }

    /**
     * Delete Winner
     */
    public function deleteWinner(int $awardId)
    {
        return $this->awardModel->delete($awardId);
    }
}
