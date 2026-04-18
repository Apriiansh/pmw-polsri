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
 * @property string|null $admin_summary
 * @property string|null $admin_photo
 * @property string|null $admin_at
 * @property string|null $reviewer_photo
 * @property string|null $reviewer_summary
 * @property int|null $reviewer_id
 * @property string|null $reviewer_at
 * @property string $created_at
 * @property string $updated_at
 */
class PmwActivityLogbook extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'dosen_verified_at', 'mentor_verified_at', 'admin_verified_at', 'admin_at', 'reviewer_at'];
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
        'admin_summary'          => 'string',
        'admin_photo'            => 'string',
        'reviewer_photo'         => 'string',
        'reviewer_summary'       => 'string',
        'reviewer_id'            => 'integer',
    ];
}
