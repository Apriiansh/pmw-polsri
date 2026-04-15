<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewerModel extends Model
{
    protected $table = 'pmw_reviewers';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nama',
        'nidn',
        'nip',
        'institution',
        'expertise',
        'phone',
        'bio',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'user_id'     => 'required|numeric',
        'nama'        => 'required|min_length[3]|max_length[100]',
        'nidn'        => 'permit_empty|max_length[30]',
        'nip'         => 'permit_empty|max_length[30]',
        'institution' => 'permit_empty|max_length[150]',
        'expertise'   => 'permit_empty|max_length[255]',
        'phone'       => 'permit_empty|max_length[20]',
    ];

    /**
     * Get reviewer by user ID
     */
    public function getByUserId(int $userId): ?array
    {
        return $this->where('user_id', $userId)->first();
    }
}
