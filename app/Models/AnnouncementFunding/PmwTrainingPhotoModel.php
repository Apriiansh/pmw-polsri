<?php

namespace App\Models\AnnouncementFunding;

use App\Entities\PmwTrainingPhoto;
use CodeIgniter\Model;

class PmwTrainingPhotoModel extends Model
{
    protected $table            = 'pmw_training_photos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwTrainingPhoto::class;

    protected $allowedFields = [
        'report_id',
        'file_path',
        'original_name',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    public function findByReportId(int $reportId): array
    {
        return $this->where('report_id', $reportId)
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    public function deleteByReportId(int $reportId): void
    {
        $this->where('report_id', $reportId)->delete();
    }
}
