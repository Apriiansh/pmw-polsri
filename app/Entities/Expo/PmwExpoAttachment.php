<?php

namespace App\Entities\Expo;

use CodeIgniter\Entity\Entity;

class PmwExpoAttachment extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'submission_id' => 'integer',
    ];
}
