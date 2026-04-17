<?php

namespace App\Entities\Guidance;

use CodeIgniter\Entity\Entity;

class PmwGuidanceLogbook extends Entity
{
    protected $dates = ['verified_at', 'created_at', 'updated_at'];
    protected $casts = [
        'id'               => 'integer',
        'schedule_id'      => 'integer',
        'nominal_konsumsi' => 'integer',
    ];
}
