<?php

namespace App\Entities\Guidance;

use CodeIgniter\Entity\Entity;

class PmwGuidanceSchedule extends Entity
{
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'id'            => 'integer',
        'proposal_id'   => 'integer',
        'user_id'       => 'integer',
        'deadline_days' => 'integer',
    ];
}
