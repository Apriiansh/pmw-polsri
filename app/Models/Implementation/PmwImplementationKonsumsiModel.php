<?php

namespace App\Models\Implementation;

use App\Entities\PmwImplementationKonsumsi;
use CodeIgniter\Model;

class PmwImplementationKonsumsiModel extends Model
{
    protected $table            = 'pmw_implementation_konsumsi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwImplementationKonsumsi::class;
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'proposal_id',
        'period_id',
        'konsumsi_title',
        'file_path',
        'original_name',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get konsumsi by proposal ID
     */
    public function getByProposalId(int $proposalId): array
    {
        return $this->where('proposal_id', $proposalId)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }

    /**
     * Delete konsumsi and its file
     */
    public function deleteKonsumsi(int $konsumsiId): bool
    {
        $konsumsi = $this->find($konsumsiId);
        
        if (!$konsumsi) {
            return false;
        }

        // Delete physical file
        $filePath = WRITEPATH . $konsumsi->file_path;
        if (is_file($filePath)) {
            @unlink($filePath);
        }

        return $this->delete($konsumsiId);
    }
}
