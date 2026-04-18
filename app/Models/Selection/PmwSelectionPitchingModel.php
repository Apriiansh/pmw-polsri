<?php

namespace App\Models\Selection;

use CodeIgniter\Model;

class PmwSelectionPitchingModel extends Model
{
    protected $table            = 'pmw_selection_pitching';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'proposal_id',
        'student_submitted_at',
        'dosen_status',
        'admin_status',
        'dosen_catatan',
        'admin_catatan'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getByProposal($proposalId)
    {
        return $this->where('proposal_id', $proposalId)->first();
    }
}
