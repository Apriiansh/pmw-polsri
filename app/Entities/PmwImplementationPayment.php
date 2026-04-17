<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Entity for Implementation Payment Proofs (Bukti Pembayaran)
 *
 * @property int    $id
 * @property int    $proposal_id
 * @property int    $period_id
 * @property string $payment_title
 * @property string $file_path
 * @property string $original_name
 * @property string $created_at
 */
class PmwImplementationPayment extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at'];
    protected $casts   = [
        'id'            => 'integer',
        'proposal_id'   => 'integer',
        'period_id'     => 'integer',
        'payment_title' => 'string',
        'file_path'     => 'string',
        'original_name' => 'string',
    ];
}
