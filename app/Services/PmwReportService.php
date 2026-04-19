<?php

namespace App\Services;

use App\Models\Milestone\PmwReportScheduleModel;
use App\Models\Milestone\PmwReportModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\NotificationModel;
use Exception;

class PmwReportService
{
    protected $scheduleModel;
    protected $reportModel;
    protected $proposalModel;
    protected $notificationModel;

    public function __construct()
    {
        $this->scheduleModel = new PmwReportScheduleModel();
        $this->reportModel = new PmwReportModel();
        $this->proposalModel = new PmwProposalModel();
        $this->notificationModel = new NotificationModel();
    }

    /**
     * Create or update a report schedule
     */
    public function saveSchedule(array $data)
    {
        // Check if schedule for this type and period already exists
        $existing = $this->scheduleModel->where('type', $data['type'])
                                        ->where('period_id', $data['period_id'])
                                        ->first();

        if ($existing) {
            return $this->scheduleModel->update($existing['id'], $data);
        }

        return $this->scheduleModel->insert($data);
    }

    /**
     * Submit a report (Mahasiswa)
     */
    public function submitReport(int $proposalId, int $scheduleId, array $data, $file)
    {
        $schedule = $this->scheduleModel->find($scheduleId);
        if (!$schedule) {
            throw new Exception("Jadwal laporan tidak ditemukan.");
        }

        // Check if within date range
        $today = date('Y-m-d');
        if ($today < $schedule['start_date'] || $today > $schedule['end_date']) {
            throw new Exception("Pengumpulan laporan saat ini sedang ditutup.");
        }

        $existing = $this->reportModel->where('proposal_id', $proposalId)
                                      ->where('type', $schedule['type'])
                                      ->first();

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/milestone_reports', $newName);
            $data['file_path'] = 'milestone_reports/' . $newName;
        }

        $data['submitted_at'] = date('Y-m-d H:i:s');
        $data['status'] = 'submitted';

        if ($existing) {
            // If already approved, can't update unless it's a specific requirement
            if ($existing['status'] === 'approved') {
                throw new Exception("Laporan Anda sudah disetujui dan tidak dapat diubah.");
            }
            return $this->reportModel->update($existing['id'], $data);
        }

        $data['proposal_id'] = $proposalId;
        $data['schedule_id'] = $scheduleId;
        $data['type'] = $schedule['type'];

        $result = $this->reportModel->insert($data);

        // Notify Dosen Pendamping
        $db = \Config\Database::connect();
        $assignment = $db->table('pmw_proposal_assignments pa')
                        ->select('l.user_id')
                        ->join('pmw_lecturers l', 'l.id = pa.lecturer_id')
                        ->where('pa.proposal_id', $proposalId)
                        ->get()
                        ->getRow();

        if ($assignment && $assignment->user_id) {
            $proposal = $this->proposalModel->find($proposalId);
            $this->notificationModel->send(
                $assignment->user_id,
                'Laporan Milestone Baru',
                "Tim " . ($proposal['nama_usaha'] ?? 'Tanpa Nama') . " telah mengunggah Laporan " . ucfirst($schedule['type']) . ".",
                'dosen/milestone',
                'milestone_submitted'
            );
        }

        return $result;
    }

    /**
     * Verify a report (Dosen)
     */
    public function verifyReport(int $reportId, array $data)
    {
        $report = $this->reportModel->find($reportId);
        if (!$report) {
            throw new Exception("Laporan tidak ditemukan.");
        }

        $data['dosen_verified_at'] = date('Y-m-d H:i:s');
        
        $result = $this->reportModel->update($reportId, $data);

        // Notify Student Leader
        $proposal = $this->proposalModel->find($report['proposal_id']);
        if ($proposal && $proposal['leader_user_id']) {
            $statusLabel = $data['status'] === 'approved' ? 'DISETUJUI' : ($data['status'] === 'revision' ? 'PERLU REVISI' : 'DITOLAK');
            $this->notificationModel->send(
                $proposal['leader_user_id'],
                'Status Laporan Milestone',
                "Laporan " . ucfirst($report['type']) . " Anda telah " . $statusLabel . " oleh Dosen Pendamping.",
                'mahasiswa/milestone',
                'milestone_verified'
            );
        }

        return $result;
    }

    /**
     * Get reports for a proposal (all types)
     */
    public function getProposalReports(int $proposalId)
    {
        $reports = $this->reportModel->where('proposal_id', $proposalId)->findAll();
        $formatted = [];
        foreach ($reports as $report) {
            $formatted[$report['type']] = $report;
        }
        return $formatted;
    }
}
