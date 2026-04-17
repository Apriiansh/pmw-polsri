<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PmwImplementationKonsumsi extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id'          => 'integer',
        'proposal_id' => 'integer',
        'period_id'   => 'integer',
    ];
}
