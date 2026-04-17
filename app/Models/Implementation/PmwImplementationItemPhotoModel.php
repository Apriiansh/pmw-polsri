<?php

namespace App\Models\Implementation;

use App\Entities\PmwImplementationItemPhoto;
use CodeIgniter\Model;

class PmwImplementationItemPhotoModel extends Model
{
    protected $table            = 'pmw_implementation_item_photos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PmwImplementationItemPhoto::class;
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'item_id',
        'photo_title',
        'file_path',
        'original_name',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    /**
     * Get photos by item ID
     */
    public function getByItemId(int $itemId): array
    {
        return $this->where('item_id', $itemId)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }

    /**
     * Delete photo and its file
     */
    public function deletePhoto(int $photoId): bool
    {
        $photo = $this->find($photoId);
        
        if (!$photo) {
            return false;
        }

        // Delete physical file
        $filePath = WRITEPATH . $photo->file_path;
        if (is_file($filePath)) {
            @unlink($filePath);
        }

        return $this->delete($photoId);
    }
}
