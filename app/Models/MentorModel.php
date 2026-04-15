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
}
