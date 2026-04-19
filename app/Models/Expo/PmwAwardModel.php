<?php

namespace App\Models\Expo;

use CodeIgniter\Model;
use App\Entities\Expo\PmwAward;

class PmwAwardModel extends Model
{
    protected $table            = 'pmw_awards';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwAward::class;
    protected $allowedFields    = [
        'proposal_id',
        'category_id',
        'rank',
        'notes',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getWinnersByCategory(int $categoryId)
    {
        return $this->select('pmw_awards.*, p.nama_usaha, pm.nama as ketua_nama')
                    ->join('pmw_proposals p', 'p.id = pmw_awards.proposal_id')
                    ->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left')
                    ->where('category_id', $categoryId)
                    ->orderBy('rank', 'ASC')
                    ->findAll();
    }

    public function getTeamAwards(int $proposalId)
    {
        return $this->select('pmw_awards.*, pac.name as category_name')
                    ->join('pmw_award_categories pac', 'pac.id = pmw_awards.category_id')
                    ->where('proposal_id', $proposalId)
                    ->findAll();
    }
}
