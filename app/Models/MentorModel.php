<?php

namespace App\Models;

use CodeIgniter\Model;

class MentorModel extends Model
{
    protected $table = 'pmw_mentors';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama',
        'company',
        'position',
        'expertise',
        'phone',
        'email',
        'bio',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'user_id'  => 'required|numeric',
        'nama'     => 'required|min_length[3]|max_length[100]',
        'company'  => 'permit_empty|max_length[150]',
        'position' => 'permit_empty|max_length[100]',
        'expertise' => 'permit_empty|max_length[255]',
        'phone'    => 'permit_empty|max_length[20]',
        'email'    => 'permit_empty|valid_email|max_length[100]',
    ];

    /**
     * Get mentor by user ID
     */
    public function getByUserId(int $userId): ?array
    {
        return $this->where('user_id', $userId)->first();
    }

    /**
     * Get mentors who are not yet assigned to any proposal
     */
    public function getAvailable(): array
    {
        return $this->select('pmw_mentors.*')
            ->join('pmw_proposal_assignments', 'pmw_proposal_assignments.mentor_id = pmw_mentors.id', 'left')
            ->where('pmw_proposal_assignments.mentor_id', null)
            ->orderBy('nama', 'ASC')
            ->findAll();
    }

    /**
     * Get all mentors with assignment status
     */
    public function getAllWithAssignmentStatus(): array
    {
        return $this->select('pmw_mentors.*, pa.proposal_id as assigned_proposal_id')
            ->join('pmw_proposal_assignments pa', 'pa.mentor_id = pmw_mentors.id', 'left')
            ->orderBy('nama', 'ASC')
            ->findAll();
    }
}
