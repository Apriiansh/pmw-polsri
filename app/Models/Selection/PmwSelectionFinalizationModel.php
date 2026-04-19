<?php

namespace App\Models\Selection;

use CodeIgniter\Model;

class PmwSelectionFinalizationModel extends Model
{
    protected $table            = 'pmw_selection_finalization';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'proposal_id',
        'admin_status',
        'admin_catatan',
        'admin_verified_at',
        'admin_id'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get finalization status for a proposal
     */
    public function getByProposal($proposalId)
    {
        return $this->where('proposal_id', $proposalId)->first();
    }
}
