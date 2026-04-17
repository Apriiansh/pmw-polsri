<?php

namespace App\Models\Proposal;

use CodeIgniter\Model;

class PmwProposalAssignmentModel extends Model
{
    protected $table            = 'pmw_proposal_assignments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'proposal_id',
        'lecturer_id',
        'mentor_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Relationships
    public function getByProposal($proposalId)
    {
        return $this->where('proposal_id', $proposalId)->first();
    }
}
