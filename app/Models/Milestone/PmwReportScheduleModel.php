<?php

namespace App\Models\Milestone;

use CodeIgniter\Model;

class PmwReportScheduleModel extends Model
{
    protected $table            = 'pmw_report_schedules';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'period_id',
        'type',
        'start_date',
        'end_date',
        'is_active',
        'notes'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get active schedule for a specific type and period
     */
    public function getActiveSchedule($type, $periodId)
    {
        return $this->where('type', $type)
                    ->where('period_id', $periodId)
                    ->where('is_active', 1)
                    ->first();
    }
}
