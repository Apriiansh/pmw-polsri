<?php

namespace App\Entities\Expo;

use CodeIgniter\Entity\Entity;

class PmwAward extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'proposal_id' => 'integer',
        'category_id' => 'integer',
        'rank'        => 'integer',
    ];
}
