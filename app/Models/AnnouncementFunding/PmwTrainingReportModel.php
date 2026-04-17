<?php

namespace App\Models\AnnouncementFunding;

use App\Entities\PmwTrainingReport;
use CodeIgniter\Model;

class PmwTrainingReportModel extends Model
{
    protected $table            = 'pmw_training_reports';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwTrainingReport::class;

    protected $allowedFields = [
        'proposal_id',
        'period_id',
        'summary',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function findByProposal(int $proposalId): ?PmwTrainingReport
    {
        return $this->where('proposal_id', $proposalId)
            ->first();
    }

    public function findByPeriod(int $periodId): array
    {
        return $this->where('period_id', $periodId)
            ->findAll();
    }
}
