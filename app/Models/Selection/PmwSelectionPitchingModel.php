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
        'status',
        'catatan',
        'persentase_nilai',
        'penilaian_final_at',
        'penilaian_final_by',
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

    public function getWithAggregation(int $proposalId): ?object
    {
        $db = \Config\Database::connect();

        $row = $db->table('pmw_selection_pitching sp')
            ->select('
                sp.*,
                (SELECT COUNT(*) FROM pmw_pitching_assessments WHERE proposal_id = sp.proposal_id AND submitted_at IS NOT NULL) as assessment_count,
                (SELECT ROUND(AVG(persentase_nilai), 2) FROM pmw_pitching_assessments WHERE proposal_id = sp.proposal_id AND submitted_at IS NOT NULL) as assessment_avg
            ')
            ->where('sp.proposal_id', $proposalId)
            ->get()
            ->getRow();

        return $row ?: null;
    }
}
