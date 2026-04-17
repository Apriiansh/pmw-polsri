<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Entity for Implementation Item Photos (Foto Barang)
 *
 * @property int    $id
 * @property int    $item_id
 * @property string $photo_title
 * @property string $file_path
 * @property string $original_name
 * @property string $created_at
 */
class PmwImplementationItemPhoto extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at'];
    protected $casts   = [
        'id'            => 'integer',
        'item_id'       => 'integer',
        'photo_title'   => 'string',
        'file_path'     => 'string',
        'original_name' => 'string',
    ];
}
