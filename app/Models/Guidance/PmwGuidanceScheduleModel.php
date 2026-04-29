<?php

namespace App\Models\Guidance;

use CodeIgniter\Model;
use App\Entities\Guidance\PmwGuidanceSchedule;

class PmwGuidanceScheduleModel extends Model
{
    protected $table            = 'pmw_guidance_schedules';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwGuidanceSchedule::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'proposal_id',
        'user_id',
        'type',
        'schedule_date',
        'schedule_time',
        'topic',
        'deadline_days',
        'status',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getSchedulesByProposal(int $proposalId, ?string $type = null)
    {
        $builder = $this->where('proposal_id', $proposalId);
        if ($type) {
            $builder->where('type', $type);
        }
        return $builder->orderBy('schedule_date', 'DESC')
                       ->orderBy('schedule_time', 'DESC')
                       ->findAll();
    }

    public function getSchedulesByCreator(int $userId)
    {
        return $this->select('pmw_guidance_schedules.*, p.nama_usaha, pm.nama as ketua_nama')
                    ->join('pmw_proposals p', 'p.id = pmw_guidance_schedules.proposal_id')
                    ->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left')
                    ->where('user_id', $userId)
                    ->orderBy('schedule_date', 'DESC')
                    ->findAll();
    }
}
