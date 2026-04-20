<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\AnnouncementAttachment;

class AnnouncementAttachmentModel extends Model
{
    protected $table            = 'announcement_attachments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = AnnouncementAttachment::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'announcement_id',
        'file_path',
        'file_name',
        'file_type',
        'file_size'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
