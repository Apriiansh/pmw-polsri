<?php

namespace App\Models\Selection;

use CodeIgniter\Model;

class PmwSelectionImplementasiModel extends Model
{
    protected $table            = 'pmw_selection_implementasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'proposal_id',
        'student_submitted_at',
        'dosen_status',
        'dosen_catatan',
        'dosen_verified_at',
        'admin_status',
        'admin_catatan',
        'admin_verified_at'
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
