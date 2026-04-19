<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table = 'pmw_profiles';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'user_id',
        'nama',
        'nim',
        'jurusan',
        'prodi',
        'semester',
        'phone',
        'foto',
        'gender',
        'bio',
        'socio_economic',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'user_id' => 'required|numeric',
        'nama' => 'required|min_length[3]|max_length[100]',
        'nim' => 'required|min_length[5]|max_length[20]|is_unique[pmw_profiles.nim]',
        'jurusan' => 'permit_empty|max_length[100]',
        'prodi' => 'permit_empty|max_length[100]',
        'semester' => 'permit_empty|integer',
        'phone' => 'permit_empty|max_length[20]',
        'foto' => 'permit_empty|max_length[255]',
        'gender' => 'permit_empty|in_list[L,P]',
    ];
}
