<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Entity for Implementation Items (Barang)
 *
 * @property int    $id
 * @property int    $proposal_id
 * @property int    $period_id
 * @property string $item_title
 * @property string $item_description
 * @property float  $price
 * @property string $created_at
 * @property string $updated_at
 */
class PmwImplementationItem extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'id'               => 'integer',
        'proposal_id'      => 'integer',
        'period_id'        => 'integer',
        'item_title'       => 'string',
        'item_description' => 'string',
        'price'            => 'float',
    ];
}
