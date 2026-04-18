<?php

namespace App\Models\Activity;

use CodeIgniter\Model;
use App\Entities\Activity\PmwActivitySchedule;

class PmwActivityScheduleModel extends Model
{
    protected $table            = 'pmw_activity_schedules';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwActivitySchedule::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'proposal_id',
        'period_id',
        'batch_id',
        'activity_category',
        'activity_date',
        'activity_time',
        'location',
        'status',
        'notes',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get schedules by proposal with optional status filter
     */
    public function getSchedulesByProposal(int $proposalId, ?string $status = null)
    {
        $builder = $this->where('proposal_id', $proposalId);
        if ($status) {
            $builder->where('status', $status);
        }
        return $builder->orderBy('activity_date', 'DESC')
                       ->orderBy('activity_time', 'DESC')
                       ->findAll();
    }

    /**
     * Get all schedules with proposal info (for admin)
     */
    public function getAllSchedulesWithProposal()
    {
        return $this->select('pmw_activity_schedules.*, p.nama_usaha, pm.nama as ketua_nama, pal.status as logbook_status, pal.reviewer_summary, pal.reviewer_photo, pal.reviewer_at')
                    ->join('pmw_proposals p', 'p.id = pmw_activity_schedules.proposal_id')
                    ->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left')
                    ->join('pmw_activity_logbooks pal', 'pal.schedule_id = pmw_activity_schedules.id', 'left')
                    ->orderBy('activity_date', 'DESC')
                    ->findAll();
    }

    /**
     * Get schedules by period
     */
    public function getSchedulesByPeriod(int $periodId)
    {
        return $this->where('period_id', $periodId)
                    ->orderBy('activity_date', 'DESC')
                    ->findAll();
    }
}
