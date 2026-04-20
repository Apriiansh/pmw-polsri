<?php

namespace App\Models;

use CodeIgniter\Model;

class CmsContentModel extends Model
{
    protected $table            = 'cms_content';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['key', 'content', 'type', 'group', 'label', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get content by key
     */
    public function getByKey(string $key)
    {
        return $this->where('key', $key)->first();
    }

    /**
     * Get all content by group
     */
    public function getByGroup(string $group)
    {
        return $this->where('group', $group)->findAll();
    }
}
