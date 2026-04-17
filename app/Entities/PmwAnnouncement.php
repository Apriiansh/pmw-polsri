<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PmwAnnouncement extends Entity
{
    protected $dates = ['published_at', 'training_date', 'created_at', 'updated_at'];
    protected $casts = [
        'id'                 => 'integer',
        'period_id'          => 'integer',
        'phase_number'       => 'integer',
        'is_published'       => 'boolean',
        'training_date'      => 'datetime',
        'training_location'  => 'string',
        'training_details'   => 'string',
        'sk_file_path'       => 'string',
        'sk_original_name'   => 'string',
    ];
}
