<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class AnnouncementAttachment extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id'              => 'integer',
        'announcement_id' => 'integer',
        'file_size'       => 'integer',
    ];

    public function getUrl()
    {
        return base_url($this->attributes['file_path']);
    }

    public function isImage()
    {
        return strpos($this->attributes['file_type'], 'image') !== false;
    }

    public function getIcon()
    {
        if ($this->isImage()) return 'fa-file-image text-emerald-500';
        if (strpos($this->attributes['file_type'], 'pdf') !== false) return 'fa-file-pdf text-rose-500';
        if (strpos($this->attributes['file_type'], 'zip') !== false) return 'fa-file-archive text-amber-500';
        return 'fa-file text-slate-400';
    }
}
