<?php

namespace App\Models\Implementation;

use App\Entities\PmwImplementationItem;
use CodeIgniter\Model;

class PmwImplementationItemModel extends Model
{
    protected $table            = 'pmw_implementation_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwImplementationItem::class;
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'proposal_id',
        'period_id',
        'item_title',
        'item_description',
        'price',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all items with photos for a proposal
     */
    public function getItemsWithPhotos(int $proposalId): array
    {
        $db = \Config\Database::connect();
        
        $items = $this->where('proposal_id', $proposalId)
                      ->orderBy('created_at', 'ASC')
                      ->findAll();
        
        $photoModel = new PmwImplementationItemPhotoModel();
        
        foreach ($items as &$item) {
            $item->photos = $photoModel->where('item_id', $item->id)
                                       ->orderBy('created_at', 'ASC')
                                       ->findAll();
        }
        
        return $items;
    }

    /**
     * Get total price of all items for a proposal
     */
    public function getTotalPrice(int $proposalId): float
    {
        $result = $this->selectSum('price', 'total')
                       ->where('proposal_id', $proposalId)
                       ->first();
        
        return (float) ($result->total ?? 0);
    }

    /**
     * Count items for a proposal
     */
    public function countItems(int $proposalId): int
    {
        return $this->where('proposal_id', $proposalId)->countAllResults();
    }
}
