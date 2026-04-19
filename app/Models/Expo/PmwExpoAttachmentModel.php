<?php

namespace App\Models\Expo;

use CodeIgniter\Model;
use App\Entities\Expo\PmwExpoAttachment;

class PmwExpoAttachmentModel extends Model
{
    protected $table            = 'pmw_expo_attachments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwExpoAttachment::class;
    protected $allowedFields    = [
        'submission_id',
        'title',
        'file_path',
        'file_type',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getBySubmission(int $submissionId)
    {
        return $this->where('submission_id', $submissionId)->findAll();
    }
}
