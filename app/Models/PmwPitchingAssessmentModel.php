<?php

namespace App\Models;

use CodeIgniter\Model;

class PmwPitchingAssessmentModel extends Model
{
    protected $table         = 'pmw_pitching_assessments';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'proposal_id', 'penilai_user_id', 'status',
        'is_admin_assessment', 'catatan', 'edited_by_admin',
        'persentase_nilai', 'submitted_at',
    ];

    protected $validationRules = [
        'proposal_id'      => 'required|is_natural_no_zero',
        'penilai_user_id'  => 'required|is_natural_no_zero',
        'status'           => 'required|in_list[approved,rejected]',
        'persentase_nilai' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
        'catatan'          => 'permit_empty|max_length[1000]',
    ];
}
