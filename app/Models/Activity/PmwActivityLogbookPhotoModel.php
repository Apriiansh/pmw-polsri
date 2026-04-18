<?php

namespace App\Models\Activity;

use CodeIgniter\Model;

class PmwActivityLogbookPhotoModel extends Model
{
    protected $table            = 'pmw_activity_logbook_photos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'logbook_id',
        'uploader_role',
        'file_path',
        'original_name',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get photos by logbook ID and optionally role
     */
    public function getByLogbook(int $logbookId, ?string $role = null): array
    {
        $builder = $this->where('logbook_id', $logbookId);
        if ($role) {
            $builder->where('uploader_role', $role);
        }
        return $builder->findAll();
    }
}
