<?php

namespace App\Entities\Activity;

use CodeIgniter\Entity\Entity;

/**
 * Entity for Activity Logbooks
 *
 * @property int $id
 * @property int $schedule_id
 * @property string $activity_description
 * @property string|null $photo_activity
 * @property string|null $video_url
 * @property string|null $photo_supervisor_visit
 * @property string $status
 * @property string $dosen_status
 * @property string|null $dosen_note
 * @property string|null $dosen_verified_at
 * @property string $mentor_status
 * @property string|null $mentor_note
 * @property string|null $mentor_verified_at
 * @property string|null $admin_note
 * @property string|null $admin_verified_at
 * @property string $created_at
 * @property string $updated_at
 */
class PmwActivityLogbook extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'dosen_verified_at', 'mentor_verified_at', 'admin_verified_at'];
    protected $casts   = [
        'id'                     => 'integer',
        'schedule_id'            => 'integer',
        'activity_description'   => 'string',
        'photo_activity'         => 'string',
        'video_url'              => 'string',
        'photo_supervisor_visit' => 'string',
        'status'                 => 'string',
        'dosen_status'           => 'string',
        'dosen_note'             => 'string',
        'mentor_status'          => 'string',
        'mentor_note'            => 'string',
        'admin_note'             => 'string',
    ];
}
