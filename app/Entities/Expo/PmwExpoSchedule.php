<?php

namespace App\Entities\Expo;

use CodeIgniter\Entity\Entity;

class PmwExpoSchedule extends Entity
{
    protected $dates = ['event_date', 'submission_deadline', 'created_at', 'updated_at'];
    protected $casts = [
        'period_id' => 'integer',
        'is_closed' => 'boolean',
    ];
}
