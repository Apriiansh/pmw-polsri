<?php

namespace App\Models\Implementation;

use App\Entities\PmwImplementationPayment;
use CodeIgniter\Model;

class PmwImplementationPaymentModel extends Model
{
    protected $table            = 'pmw_implementation_payments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwImplementationPayment::class;
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'proposal_id',
        'period_id',
        'payment_title',
        'link_pembelian',
        'file_path',
        'original_name',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    /**
     * Get payments by proposal ID
     */
    public function getByProposalId(int $proposalId): array
    {
        return $this->where('proposal_id', $proposalId)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }

    /**
     * Delete payment and its file
     */
    public function deletePayment(int $paymentId): bool
    {
        $payment = $this->find($paymentId);
        
        if (!$payment) {
            return false;
        }

        // Delete physical file
        $filePath = WRITEPATH . $payment->file_path;
        if (is_file($filePath)) {
            @unlink($filePath);
        }

        return $this->delete($paymentId);
    }

    /**
     * Count payments for a proposal
     */
    public function countPayments(int $proposalId): int
    {
        return $this->where('proposal_id', $proposalId)->countAllResults();
    }
}
