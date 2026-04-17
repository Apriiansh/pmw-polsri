<?php

namespace App\Models\AnnouncementFunding;

use App\Entities\PmwBankAccount;
use CodeIgniter\Model;

class PmwBankAccountModel extends Model
{
    protected $table = 'pmw_bank_accounts';
    protected $primaryKey = 'id';
    protected $returnType = PmwBankAccount::class;
    protected $allowedFields = [
        'proposal_id',
        'period_id',
        'bank_name',
        'account_holder_name',
        'account_number',
        'branch_office',
        'bank_book_scan',
        'description',
    ];
    protected $useTimestamps = true;

    public function findByProposal(int $proposalId): ?PmwBankAccount
    {
        return $this->where('proposal_id', $proposalId)
            ->first();
    }

    public function findByPeriod(int $periodId): array
    {
        return $this->where('period_id', $periodId)
            ->findAll();
    }
}
