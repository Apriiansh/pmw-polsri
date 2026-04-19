<?php

namespace App\Entities\Expo;

use CodeIgniter\Entity\Entity;

class PmwExpoSubmission extends Entity
{
    protected $dates = ['submitted_at', 'created_at', 'updated_at'];
    protected $casts = [
        'proposal_id' => 'integer',
    ];
}
