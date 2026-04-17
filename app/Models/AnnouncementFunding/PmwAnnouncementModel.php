<?php

namespace App\Models\AnnouncementFunding;

use App\Entities\PmwAnnouncement;
use CodeIgniter\Model;

class PmwAnnouncementModel extends Model
{
    protected $table            = 'pmw_announcements';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwAnnouncement::class;

    protected $allowedFields = [
        'period_id',
        'phase_number',
        'title',
        'content',
        'is_published',
        'published_at',
        'training_date',
        'training_location',
        'training_details',
        'sk_file_path',
        'sk_original_name',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findByPeriodAndPhase(int $periodId, int $phaseNumber): ?PmwAnnouncement
    {
        return $this->where('period_id', $periodId)
            ->where('phase_number', $phaseNumber)
            ->first();
    }
}
