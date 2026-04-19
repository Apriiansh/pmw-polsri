<?php

namespace App\Models\Expo;

use CodeIgniter\Model;
use App\Entities\Expo\PmwExpoSubmission;

class PmwExpoSubmissionModel extends Model
{
    protected $table            = 'pmw_expo_submissions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwExpoSubmission::class;
    protected $allowedFields    = [
        'proposal_id',
        'summary',
        'submitted_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getByProposal(int $proposalId)
    {
        return $this->where('proposal_id', $proposalId)->first();
    }

    public function getAllSubmissionsWithDetails(int $periodId)
    {
        return $this->select('pmw_expo_submissions.*, p.nama_usaha, pm.nama as ketua_nama, pm.nim as ketua_nim')
                    ->join('pmw_proposals p', 'p.id = pmw_expo_submissions.proposal_id')
                    ->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left')
                    ->where('p.period_id', $periodId)
                    ->orderBy('pmw_expo_submissions.submitted_at', 'DESC')
                    ->findAll();
    }
}
