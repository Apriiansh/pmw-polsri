<?php

namespace App\Models\Expo;

use CodeIgniter\Model;
use App\Entities\Expo\PmwExpoSchedule;

class PmwExpoScheduleModel extends Model
{
    protected $table            = 'pmw_expo_schedules';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwExpoSchedule::class;
    protected $allowedFields    = [
        'period_id',
        'event_name',
        'event_date',
        'location',
        'description',
        'submission_deadline',
        'is_closed',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getActiveSchedule(int $periodId)
    {
        return $this->where('period_id', $periodId)->first();
    }
}
