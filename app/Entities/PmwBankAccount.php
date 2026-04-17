<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int|null $id
 * @property int|null $proposal_id
 * @property int|null $period_id
 * @property string|null $bank_name
 * @property string|null $account_holder_name
 * @property string|null $account_number
 * @property string|null $branch_office
 * @property string|null $bank_book_scan
 * @property string|null $description
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class PmwBankAccount extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'id' => 'integer',
        'proposal_id' => 'integer',
        'period_id' => 'integer',
    ];
}
