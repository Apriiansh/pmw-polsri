<?php

namespace App\Services;

use App\Models\Guidance\PmwGuidanceScheduleModel;
use App\Models\Guidance\PmwGuidanceLogbookModel;
use App\Models\Proposal\PmwProposalModel;
use Exception;

class PmwGuidanceService
{
    protected $scheduleModel;
    protected $logbookModel;
    protected $proposalModel;

    public function __construct()
    {
        $this->scheduleModel = new PmwGuidanceScheduleModel();
        $this->logbookModel = new PmwGuidanceLogbookModel();
        $this->proposalModel = new PmwProposalModel();
    }

    /**
     * Create a bimbingan/mentoring schedule.
     */
    public function createSchedule(int $creatorId, array $data)
    {
        $proposalId = $data['proposal_id'];
        $type = $data['type'];

        // Validate assignment
        $proposal = $this->proposalModel->find($proposalId);
        if (!$proposal) throw new Exception("Proposal tidak ditemukan.");

        // Check if creator is the assigned lecturer/mentor
        // Assuming user_id is the identity from users table, 
        // we need to check if this user is linked to the lecturer/mentor assigned to the proposal.
        // For simplicity in this logic, we assume the controller passes the correct creatorId 
        // but we'll add a layer of check here if needed.

        return $this->scheduleModel->insert([
            'proposal_id'   => $proposalId,
            'user_id'       => $creatorId,
            'type'          => $type,
            'schedule_date' => $data['schedule_date'],
            'schedule_time' => $data['schedule_time'],
            'topic'         => $data['topic'],
            'status'        => 'planned',
        ]);
    }

    /**
     * Submit logbook report from Student.
     */
    public function submitLogbook(int $scheduleId, array $data, array $files)
    {
        $schedule = $this->scheduleModel->find($scheduleId);
        if (!$schedule) throw new Exception("Jadwal tidak ditemukan.");

        // Check if logbook already exists
        $existing = $this->logbookModel->getBySchedule($scheduleId);
        
        // Process flexible nota items from POST arrays
        $notaTitles = $data['nota_title']  ?? [];
        $notaQtys   = $data['nota_qty']    ?? [];
        $notaPrices = $data['nota_price']  ?? [];

        $notaItems = [];
        $totalKonsumsi = 0;

        foreach ($notaTitles as $i => $title) {
            $qty   = (int)   ($notaQtys[$i]   ?? 1);
            $price = (float) ($notaPrices[$i] ?? 0);
            $subtotal = $qty * $price;

            if (!empty(trim($title))) {
                $notaItems[] = [
                    'title'    => trim($title),
                    'qty'      => $qty,
                    'price'    => $price,
                    'subtotal' => $subtotal,
                ];
                $totalKonsumsi += $subtotal;
            }
        }

        $logbookData = [
            'schedule_id'          => $scheduleId,
            'material_explanation' => $data['material_explanation'],
            'video_url'            => $data['video_url'] ?? null,
            'nota_items'           => !empty($notaItems) ? json_encode($notaItems) : null,
            'nominal_konsumsi'     => $totalKonsumsi,
            'status'               => $data['status'] ?? 'pending',
        ];

        // Handle File Uploads
        $uploadMap = [
            'photo_activity'  => 'guidance/photos',
            'assignment_file' => 'guidance/assignments',
            'nota_file'       => 'guidance/notes',
        ];

        foreach ($uploadMap as $key => $folder) {
            if (isset($files[$key]) && $files[$key]->isValid() && !$files[$key]->hasMoved()) {
                $newName = $files[$key]->getRandomName();
                $files[$key]->move(WRITEPATH . 'uploads/' . $folder, $newName);
                $logbookData[$key] = $folder . '/' . $newName;
            }
        }

        if ($existing) {
            return $this->logbookModel->update($existing->id, $logbookData);
        } else {
            return $this->logbookModel->insert($logbookData);
        }
    }

    /**
     * Verify logbook entry.
     */
    public function verifyLogbook(int $logbookId, string $status, ?string $note)
    {
        $logbook = $this->logbookModel->find($logbookId);
        if (!$logbook) throw new Exception("Logbook tidak ditemukan.");

        $updateData = [
            'status'            => $status,
            'verification_note' => $note,
            'verified_at'       => date('Y-m-d H:i:s'),
        ];

        $success = $this->logbookModel->update($logbookId, $updateData);

        if ($success && $status === 'approved') {
            // Update schedule status to completed
            $this->scheduleModel->update($logbook->schedule_id, ['status' => 'completed']);
        } elseif ($success && $status === 'rejected') {
            // Keep schedule ongoing or revert
            $this->scheduleModel->update($logbook->schedule_id, ['status' => 'ongoing']);
        }

        return $success;
    }

    /**
     * Get details for a schedule including logbook.
     */
    public function getScheduleDetail(int $id)
    {
        $schedule = $this->scheduleModel->find($id);
        if ($schedule) {
            $schedule->logbook = $this->logbookModel->getBySchedule($id);
        }
        return $schedule;
    }
}
