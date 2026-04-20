<?php

namespace App\Models;

use CodeIgniter\Model;

class PortalAnnouncementModel extends Model
{
    protected $table            = 'portal_announcements';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'slug', 'category', 'type', 'content', 'date', 'is_published'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'title'    => 'required|min_length[5]|max_length[255]',
        'slug'     => 'required|is_unique[portal_announcements.slug,id,{id}]',
        'category' => 'required',
        'content'  => 'required',
    ];
}
