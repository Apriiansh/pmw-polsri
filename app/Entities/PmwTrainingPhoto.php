<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PmwTrainingPhoto extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'id'            => 'integer',
        'report_id'     => 'integer',
        'file_path'     => 'string',
        'original_name' => 'string',
    ];
}
