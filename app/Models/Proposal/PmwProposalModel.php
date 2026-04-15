<?php

namespace App\Models\Proposal;

use CodeIgniter\Model;

class PmwProposalModel extends Model
{
    protected $table            = 'pmw_proposals';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'period_id',
        'leader_user_id',
        'lecturer_id',
        'kategori_usaha',
        'nama_usaha',
        'kategori_wirausaha',
        'detail_keterangan',
        'total_rab',
        'status',
        'submitted_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'period_id'       => 'required|integer',
        'leader_user_id'  => 'required|integer',
        'lecturer_id'     => 'permit_empty|integer',
        'kategori_usaha'  => 'permit_empty|max_length[100]',
        'nama_usaha'      => 'permit_empty|max_length[255]',
        'kategori_wirausaha' => 'required|in_list[pemula,berkembang]',
        'detail_keterangan' => 'permit_empty',
        'total_rab'       => 'permit_empty|decimal',
        'status'          => 'required|in_list[draft,submitted,revision,approved,rejected]',
    ];

    public function findByPeriodAndLeader(int $periodId, int $leaderUserId): ?array
    {
        return $this->where('period_id', $periodId)
            ->where('leader_user_id', $leaderUserId)
            ->first();
    }
}
