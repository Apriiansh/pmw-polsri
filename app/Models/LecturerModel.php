<?php

namespace App\Models;

use CodeIgniter\Model;

class LecturerModel extends Model
{
    protected $table = 'pmw_lecturers';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'nip',
        'nama',
        'jurusan',
        'prodi',
        'expertise',
        'phone',
        'bio',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'user_id' => 'required|numeric',
        'nama'    => 'required|min_length[3]|max_length[100]',
        'nip'     => 'permit_empty|max_length[30]',
        'jurusan' => 'permit_empty|max_length[100]',
        'prodi'   => 'permit_empty|max_length[100]',
        'expertise' => 'permit_empty|max_length[255]',
        'phone'   => 'permit_empty|max_length[20]',
    ];

    /**
     * Get lecturer by user ID
     */
    public function getByUserId(int $userId): ?array
    {
        return $this->where('user_id', $userId)->first();
    }
}
