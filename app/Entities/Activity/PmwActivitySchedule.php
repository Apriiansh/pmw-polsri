<?php

namespace App\Entities\Activity;

use CodeIgniter\Entity\Entity;

/**
 * Entity for Activity Schedules
 *
 * @property int $id
 * @property int $proposal_id
 * @property int $period_id
 * @property string $activity_category
 * @property string $activity_date
 * @property string|null $activity_time
 * @property string|null $location
 * @property string $status
 * @property string|null $notes
 * @property string $created_at
 * @property string $updated_at
 */
class PmwActivitySchedule extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id'                => 'integer',
        'proposal_id'       => 'integer',
        'period_id'         => 'integer',
        'activity_category' => 'string',
        'activity_date'     => 'date',
        'activity_time'     => 'string',
        'location'          => 'string',
        'status'            => 'string',
        'notes'             => 'string',
    ];
}
