<?php

namespace App\Services;

use App\Models\Implementation\PmwImplementationItemModel;
use App\Models\Implementation\PmwImplementationItemPhotoModel;
use App\Models\Implementation\PmwImplementationPaymentModel;
use App\Models\Implementation\PmwImplementationKonsumsiModel;
use App\Models\Proposal\PmwProposalModel;
use Config\Database;

class PmwImplementasiService
{
    protected $itemModel;
    protected $photoModel;
    protected $paymentModel;
    protected $konsumsiModel;
    protected $proposalModel;

    public function __construct()
    {
        $this->itemModel     = new PmwImplementationItemModel();
        $this->photoModel    = new PmwImplementationItemPhotoModel();
        $this->paymentModel  = new PmwImplementationPaymentModel();
        $this->konsumsiModel = new PmwImplementationKonsumsiModel();
        $this->proposalModel = new PmwProposalModel();
    }

    /**
     * Save new item (komponen)
     */
    public function saveItem(int $proposalId, int $periodId, array $data): int
    {
        $itemData = [
            'proposal_id'      => $proposalId,
            'period_id'        => $periodId,
            'item_title'       => $data['item_title'],
            'item_description' => $data['item_description'] ?? null,
            'category'         => $data['category'] ?? null,
            'qty'              => $data['qty'] ?? 1,
            'price'            => $data['price'] ?? 0,
        ];

        return $this->itemModel->insert($itemData);
    }

    /**
     * Update item
     */
    public function updateItem(int $itemId, array $data): bool
    {
        $updateData = [
            'item_title'       => $data['item_title'] ?? null,
            'item_description' => $data['item_description'] ?? null,
            'category'         => $data['category'] ?? null,
            'qty'              => $data['qty'] ?? null,
            'price'            => $data['price'] ?? null,
        ];

        // Remove null values
        $updateData = array_filter($updateData, fn($v) => $v !== null);

        return $this->itemModel->update($itemId, $updateData);
    }

    /**
     * Delete item and all its photos
     */
    public function deleteItem(int $itemId): bool
    {
        $db = Database::connect();
        $db->transStart();

        try {
            // Delete all photos first
            $photos = $this->photoModel->where('item_id', $itemId)->findAll();
            foreach ($photos as $photo) {
                $this->photoModel->deletePhoto($photo->id);
            }

            // Delete item
            $this->itemModel->delete($itemId);

            $db->transComplete();
            return true;
        } catch (\Exception $e) {
            $db->transRollback();
            return false;
        }
    }

    /**
     * Upload photo for an item
     */
    public function uploadItemPhoto(int $itemId, $file, string $photoTitle): array
    {
        if (!$file || !$file->isValid()) {
            return ['success' => false, 'message' => 'File tidak valid'];
        }

        // Validate: image only
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return ['success' => false, 'message' => 'File harus JPG/PNG'];
        }

        // Validate: max 2MB
        if ($file->getSize() / 1024 / 1024 > 2) {
            return ['success' => false, 'message' => 'Ukuran file maksimal 2MB'];
        }

        // Create directory
        $targetDir = 'uploads/pmw/implementasi/items/' . $itemId;
        $absTargetDir = WRITEPATH . $targetDir;

        if (!is_dir($absTargetDir)) {
            mkdir($absTargetDir, 0775, true);
        }

        // Generate filename
        $timestamp = date('Ymd_His');
        $extension = $file->getClientExtension();
        $safeTitle = url_title($photoTitle ?: 'photo', '-', true);
        $newName = "{$safeTitle}-{$timestamp}.{$extension}";

        if ($file->move($absTargetDir, $newName)) {
            $path = $targetDir . '/' . $newName;

            $photoId = $this->photoModel->insert([
                'item_id'       => $itemId,
                'photo_title'   => $photoTitle,
                'file_path'     => $path,
                'original_name' => $file->getClientName(),
            ]);

            return [
                'success'  => true,
                'photo_id' => $photoId,
                'path'     => $path,
            ];
        }

        return ['success' => false, 'message' => 'Gagal memindahkan file'];
    }

    /**
     * Upload payment proof
     */
    public function uploadPaymentProof(int $proposalId, int $periodId, $file, string $paymentTitle): array
    {
        if (!$file || !$file->isValid()) {
            return ['success' => false, 'message' => 'File tidak valid'];
        }

        // Validate: image only
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return ['success' => false, 'message' => 'File harus JPG/PNG'];
        }

        // Validate: max 2MB
        if ($file->getSize() / 1024 / 1024 > 2) {
            return ['success' => false, 'message' => 'Ukuran file maksimal 2MB'];
        }

        // Create directory
        $targetDir = 'uploads/pmw/implementasi/payments/' . $proposalId;
        $absTargetDir = WRITEPATH . $targetDir;

        if (!is_dir($absTargetDir)) {
            mkdir($absTargetDir, 0775, true);
        }

        // Generate filename
        $timestamp = date('Ymd_His');
        $extension = $file->getClientExtension();
        $safeTitle = url_title($paymentTitle ?: 'payment', '-', true);
        $newName = "{$safeTitle}-{$timestamp}.{$extension}";

        if ($file->move($absTargetDir, $newName)) {
            $path = $targetDir . '/' . $newName;

            $paymentId = $this->paymentModel->insert([
                'proposal_id'   => $proposalId,
                'period_id'     => $periodId,
                'payment_title' => $paymentTitle,
                'file_path'     => $path,
                'original_name' => $file->getClientName(),
            ]);

            return [
                'success'    => true,
                'payment_id' => $paymentId,
                'path'       => $path,
            ];
        }

        return ['success' => false, 'message' => 'Gagal memindahkan file'];
    }

    /**
     * Update payment proof title
     */
    public function updatePayment(int $paymentId, array $data): bool
    {
        $updateData = [
            'payment_title' => $data['payment_title'] ?? null,
        ];

        // Remove null values
        $updateData = array_filter($updateData, fn($v) => $v !== null);

        return $this->paymentModel->update($paymentId, $updateData);
    }

    /**
     * Upload konsumsi proof
     */
    public function uploadKonsumsiProof(int $proposalId, int $periodId, $file, string $konsumsiTitle): array
    {
        if (!$file || !$file->isValid()) {
            return ['success' => false, 'message' => 'File tidak valid'];
        }

        // Validate: image only
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return ['success' => false, 'message' => 'File harus JPG/PNG'];
        }

        // Validate: max 2MB
        if ($file->getSize() / 1024 / 1024 > 2) {
            return ['success' => false, 'message' => 'Ukuran file maksimal 2MB'];
        }

        // Create directory
        $targetDir = 'uploads/pmw/implementasi/konsumsi/' . $proposalId;
        $absTargetDir = WRITEPATH . $targetDir;

        if (!is_dir($absTargetDir)) {
            mkdir($absTargetDir, 0775, true);
        }

        // Generate filename
        $timestamp = date('Ymd_His');
        $extension = $file->getClientExtension();
        $safeTitle = url_title($konsumsiTitle ?: 'konsumsi', '-', true);
        $newName = "{$safeTitle}-{$timestamp}.{$extension}";

        if ($file->move($absTargetDir, $newName)) {
            $path = $targetDir . '/' . $newName;

            $konsumsiId = $this->konsumsiModel->insert([
                'proposal_id'    => $proposalId,
                'period_id'      => $periodId,
                'konsumsi_title' => $konsumsiTitle,
                'file_path'      => $path,
                'original_name'  => $file->getClientName(),
            ]);

            return [
                'success'     => true,
                'konsumsi_id' => $konsumsiId,
                'path'        => $path,
            ];
        }

        return ['success' => false, 'message' => 'Gagal memindahkan file'];
    }

    /**
     * Update konsumsi proof title
     */
    public function updateKonsumsi(int $konsumsiId, array $data): bool
    {
        $updateData = [
            'konsumsi_title' => $data['konsumsi_title'] ?? null,
        ];

        // Remove null values
        $updateData = array_filter($updateData, fn($v) => $v !== null);

        return $this->konsumsiModel->update($konsumsiId, $updateData);
    }

    /**
     * Reset all implementation data for a proposal (if rejected)
     */
    public function resetAll(int $proposalId): bool
    {
        $db = Database::connect();
        $db->transStart();

        try {
            // 1. Delete all payments
            $payments = $this->paymentModel->where('proposal_id', $proposalId)->findAll();
            foreach ($payments as $payment) {
                $this->paymentModel->deletePayment($payment->id);
            }

            // 2. Delete all items (will cascade delete photos)
            $items = $this->itemModel->where('proposal_id', $proposalId)->findAll();
            foreach ($items as $item) {
                // Delete photos for this item
                $photos = $this->photoModel->where('item_id', $item->id)->findAll();
                foreach ($photos as $photo) {
                    $this->photoModel->deletePhoto($photo->id);
                }
                // Delete item
                $this->itemModel->delete($item->id);
            }

            // 3. Delete all konsumsi
            $konsumsis = $this->konsumsiModel->where('proposal_id', $proposalId)->findAll();
            foreach ($konsumsis as $konsumsi) {
                $this->konsumsiModel->deleteKonsumsi($konsumsi->id);
            }

            // 4. Reset implementation selection status
            $db->table('pmw_selection_implementasi')
                ->where('proposal_id', $proposalId)
                ->update([
                    'admin_status'  => 'pending',
                    'admin_catatan' => null,
                    'updated_at'    => date('Y-m-d H:i:s')
                ]);

            $db->transComplete();
            return true;
        } catch (\Exception $e) {
            $db->transRollback();
            return false;
        }
    }

    /**
     * Get all data for a proposal
     */
    public function getFullData(int $proposalId): array
    {
        return [
            'items'    => $this->itemModel->getItemsWithPhotos($proposalId),
            'payments' => $this->paymentModel->getByProposalId($proposalId),
            'konsumsi' => $this->konsumsiModel->getByProposalId($proposalId),
            'total'    => $this->itemModel->getTotalPrice($proposalId),
        ];
    }

    /**
     * Check if proposal can be edited
     * 
     * @param int $proposalId
     * @param bool $isPhaseOpen Whether the official phase is currently open
     * @return bool
     */
    public function canEdit(int $proposalId, bool $isPhaseOpen = true): bool
    {
        $db = Database::connect();
        $selection = $db->table('pmw_selection_implementasi')
            ->where('proposal_id', $proposalId)
            ->get()
            ->getRow();
        
        if (!$selection) {
            // If no selection record yet, can only edit if phase is open
            return $isPhaseOpen; 
        }

        // 1. HARD STOP: If admin already approved or rejected, no more edits whatsoever
        if (in_array($selection->admin_status, ['approved', 'rejected'])) {
            return false;
        }

        // 2. REVISION OVERRIDE: If Dosen or Admin requested a revision, 
        // student CAN edit regardless of the official phase schedule.
        $isRevision = ($selection->dosen_status === 'revision' || $selection->admin_status === 'revision');
        if ($isRevision) {
            return true;
        }

        // 3. PENDING LOCK: If student has already submitted and it's pending review, 
        // they cannot edit until a revision is requested.
        if (!empty($selection->student_submitted_at)) {
            return false;
        }

        // 4. DRAFT MODE: If not submitted yet, can only edit if the official phase is still open
        return $isPhaseOpen;
    }
}
