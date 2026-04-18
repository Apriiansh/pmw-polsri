<?php

namespace App\Models\Activity;

use CodeIgniter\Model;
use App\Entities\Activity\PmwActivityLogbook;

class PmwActivityLogbookModel extends Model
{
    protected $table            = 'pmw_activity_logbooks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwActivityLogbook::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'schedule_id',
        'activity_description',
        'photo_activity',
        'video_url',
        'photo_supervisor_visit',
        'reviewer_photo',
        'reviewer_summary',
        'reviewer_id',
        'reviewer_at',
        'status',
        'dosen_status',
        'dosen_note',
        'dosen_verified_at',
        'mentor_status',
        'mentor_note',
        'mentor_verified_at',
        'admin_note',
        'admin_verified_at',
        'admin_summary',
        'admin_photo',
        'admin_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get logbook by schedule
     */
    public function getBySchedule(int $scheduleId)
    {
        return $this->where('schedule_id', $scheduleId)->first();
    }

    /**
     * Get logbook with schedule info
     */
    public function getLogbookWithSchedule(int $logbookId)
    {
        return $this->select('pmw_activity_logbooks.*, pas.activity_category, pas.activity_date, pas.activity_time, pas.location, p.nama_usaha, p.leader_user_id')
                    ->join('pmw_activity_schedules pas', 'pas.id = pmw_activity_logbooks.schedule_id')
                    ->join('pmw_proposals p', 'p.id = pas.proposal_id')
                    ->where('pmw_activity_logbooks.id', $logbookId)
                    ->first();
    }

    /**
     * Get pending logbooks for dosen (status = pending or revision)
     */
    public function getPendingForDosen(array $proposalIds)
    {
        if (empty($proposalIds)) {
            return [];
        }
        return $this->select('pmw_activity_logbooks.*, pas.activity_category, pas.activity_date, p.nama_usaha')
                    ->join('pmw_activity_schedules pas', 'pas.id = pmw_activity_logbooks.schedule_id')
                    ->join('pmw_proposals p', 'p.id = pas.proposal_id')
                    ->whereIn('pas.proposal_id', $proposalIds)
                    ->groupStart()
                        ->where('pmw_activity_logbooks.status', 'pending')
                        ->orWhere('pmw_activity_logbooks.status', 'revision')
                    ->groupEnd()
                    ->orderBy('pas.activity_date', 'DESC')
                    ->findAll();
    }

    /**
     * Get history logbooks for mentor (status = approved_by_mentor or approved)
     */
    public function getPendingForMentor(array $proposalIds)
    {
        if (empty($proposalIds)) {
            return [];
        }
        return $this->select('pmw_activity_logbooks.*, pas.activity_category, pas.activity_date, p.nama_usaha')
                    ->join('pmw_activity_schedules pas', 'pas.id = pmw_activity_logbooks.schedule_id')
                    ->join('pmw_proposals p', 'p.id = pas.proposal_id')
                    ->whereIn('pas.proposal_id', $proposalIds)
                    ->where('pmw_activity_logbooks.status', 'approved_by_dosen')
                    ->orderBy('pas.activity_date', 'DESC')
                    ->findAll();
    }

    /**
     * Get history logbooks for dosen
     */
    public function getHistoryForDosen(array $proposalIds)
    {
        if (empty($proposalIds)) return [];
        return $this->select('pmw_activity_logbooks.*, pas.activity_category, pas.activity_date, p.nama_usaha')
                    ->join('pmw_activity_schedules pas', 'pas.id = pmw_activity_logbooks.schedule_id')
                    ->join('pmw_proposals p', 'p.id = pas.proposal_id')
                    ->whereIn('pas.proposal_id', $proposalIds)
                    ->whereIn('pmw_activity_logbooks.status', ['approved_by_dosen', 'approved_by_mentor', 'approved'])
                    ->orderBy('pmw_activity_logbooks.updated_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get history logbooks for mentor
     */
    public function getHistoryForMentor(array $proposalIds)
    {
        if (empty($proposalIds)) return [];
        return $this->select('pmw_activity_logbooks.*, pas.activity_category, pas.activity_date, p.nama_usaha')
                    ->join('pmw_activity_schedules pas', 'pas.id = pmw_activity_logbooks.schedule_id')
                    ->join('pmw_proposals p', 'p.id = pas.proposal_id')
                    ->whereIn('pas.proposal_id', $proposalIds)
                    ->whereIn('pmw_activity_logbooks.status', ['approved_by_mentor', 'approved'])
                    ->orderBy('pmw_activity_logbooks.updated_at', 'DESC')
                    ->findAll();
    }
}
