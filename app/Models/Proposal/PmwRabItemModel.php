<?php

namespace App\Models\Proposal;

use CodeIgniter\Model;

class PmwRabItemModel extends Model
{
    protected $table            = 'pmw_proposal_rab_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'proposal_id',
        'nama_item',
        'qty',
        'satuan',
        'harga_satuan',
        'urutan',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getByProposal(int $proposalId): array
    {
        return $this->where('proposal_id', $proposalId)
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }

    public function syncItems(int $proposalId, array $items): void
    {
        $this->where('proposal_id', $proposalId)->delete();

        foreach ($items as $index => $item) {
            $nama = trim($item['nama_item'] ?? '');
            if ($nama === '') {
                continue;
            }

            $qty          = (float) ($item['qty'] ?? 1);
            $hargaSatuan  = (float) ($item['harga_satuan'] ?? 0);

            $this->insert([
                'proposal_id'  => $proposalId,
                'nama_item'    => $nama,
                'qty'          => $qty,
                'satuan'       => trim($item['satuan'] ?? 'unit') ?: 'unit',
                'harga_satuan' => $hargaSatuan,
                'urutan'       => $index,
            ]);
        }
    }

    public function getTotalByProposal(int $proposalId): float
    {
        $db  = \Config\Database::connect();
        $row = $db->query(
            "SELECT SUM(qty * harga_satuan) as total FROM {$this->table} WHERE proposal_id = ?",
            [$proposalId]
        )->getRowArray();

        return (float) ($row['total'] ?? 0);
    }
}
