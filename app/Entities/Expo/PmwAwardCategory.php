<?php

namespace App\Entities\Expo;

use CodeIgniter\Entity\Entity;

class PmwAwardCategory extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'period_id' => 'integer',
        'max_rank'  => 'integer',
    ];
}
