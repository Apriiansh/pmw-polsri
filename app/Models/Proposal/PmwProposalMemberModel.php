<?php

namespace App\Models\Proposal;

use CodeIgniter\Model;

class PmwProposalMemberModel extends Model
{
    protected $table            = 'pmw_proposal_members';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'proposal_id',
        'role',
        'nama',
        'nim',
        'jurusan',
        'prodi',
        'semester',
        'phone',
        'email',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'proposal_id' => 'required|integer',
        'role'        => 'required|in_list[ketua,anggota]',
        'nama'        => 'required|max_length[100]',
        'nim'         => 'permit_empty|max_length[20]',
    ];

    public function getByProposalId(int $proposalId): array
    {
        return $this->where('proposal_id', $proposalId)
            ->orderBy("FIELD(role, 'ketua', 'anggota')", '', false)
            ->findAll();
    }
}
