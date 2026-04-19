<?php

namespace App\Models\Expo;

use CodeIgniter\Model;
use App\Entities\Expo\PmwAwardCategory;

class PmwAwardCategoryModel extends Model
{
    protected $table            = 'pmw_award_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwAwardCategory::class;
    protected $allowedFields    = [
        'period_id',
        'name',
        'max_rank',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getCategoriesByPeriod(int $periodId)
    {
        return $this->where('period_id', $periodId)->orderBy('name', 'ASC')->findAll();
    }
}
