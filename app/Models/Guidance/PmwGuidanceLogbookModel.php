<?php

namespace App\Models\Guidance;

use CodeIgniter\Model;
use App\Entities\Guidance\PmwGuidanceLogbook;

class PmwGuidanceLogbookModel extends Model
{
    protected $table            = 'pmw_guidance_logbooks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwGuidanceLogbook::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'schedule_id',
        'material_explanation',
        'video_url',
        'photo_activity',
        'assignment_file',
        'nota_file',
        'nota_items',
        'nominal_konsumsi',
        'status',
        'verification_note',
        'verified_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getBySchedule(int $scheduleId)
    {
        return $this->where('schedule_id', $scheduleId)->first();
    }
}
