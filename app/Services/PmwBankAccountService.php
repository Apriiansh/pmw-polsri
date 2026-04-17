<?php

namespace App\Services;

use App\Models\AnnouncementFunding\PmwBankAccountModel;
use CodeIgniter\Database\Exceptions\DataException;
use Config\Services;

class PmwBankAccountService
{
    private PmwBankAccountModel $model;

    public function __construct()
    {
        $this->model = new PmwBankAccountModel();
    }

    public function getOrCreate(int $proposalId, int $periodId): \App\Entities\PmwBankAccount
    {
        $existing = $this->model->findByProposal($proposalId);
        if ($existing) {
            return $existing;
        }

        $data = [
            'proposal_id' => $proposalId,
            'period_id' => $periodId,
            'bank_name' => '',
            'account_holder_name' => '',
            'account_number' => '',
            'branch_office' => '',
            'bank_book_scan' => null,
            'description' => '',
        ];

        $id = $this->model->insert($data);
        if (!$id) {
            throw new DataException('Gagal membuat data rekening.');
        }

        return $this->model->find($id);
    }

    public function save(int $proposalId, int $periodId, array $data): bool
    {
        $existing = $this->model->findByProposal($proposalId);

        $saveData = [
            'bank_name' => $data['bank_name'] ?? '',
            'account_holder_name' => $data['account_holder_name'] ?? '',
            'account_number' => $data['account_number'] ?? '',
            'branch_office' => $data['branch_office'] ?? '',
            'description' => $data['description'] ?? '',
        ];

        if ($existing) {
            return $this->model->update($existing->id, $saveData);
        }

        $saveData['proposal_id'] = $proposalId;
        $saveData['period_id'] = $periodId;
        return (bool) $this->model->insert($saveData);
    }

    public function uploadBankBook(int $proposalId, $file): string
    {
        if (!$file || !$file->isValid()) {
            throw new \RuntimeException('File tidak valid.');
        }

        if ($file->getMimeType() !== 'application/pdf') {
            throw new \RuntimeException('File harus berformat PDF.');
        }

        if ($file->getSize() > 5 * 1024 * 1024) {
            throw new \RuntimeException('Ukuran file maksimal 5MB.');
        }

        $existing = $this->model->findByProposal($proposalId);
        if (!$existing) {
            throw new \RuntimeException('Data rekening tidak ditemukan.');
        }

        $uploadPath = WRITEPATH . 'uploads/pmw/bank_accounts/' . $existing->id . '/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Delete old file if exists
        if (!empty($existing->bank_book_scan)) {
            $oldPath = WRITEPATH . $existing->bank_book_scan;
            if (is_file($oldPath)) {
                unlink($oldPath);
            }
        }

        $newName = $file->getRandomName();
        $file->move($uploadPath, $newName);

        $relativePath = 'uploads/pmw/bank_accounts/' . $existing->id . '/' . $newName;

        $this->model->update($existing->id, ['bank_book_scan' => $relativePath]);

        return $relativePath;
    }

    public function findByProposal(int $proposalId): ?\App\Entities\PmwBankAccount
    {
        return $this->model->findByProposal($proposalId);
    }

    public function hasCompleteData(int $proposalId): bool
    {
        $record = $this->model->findByProposal($proposalId);
        if (!$record) {
            return false;
        }

        return !empty($record->bank_name)
            && !empty($record->account_holder_name)
            && !empty($record->account_number)
            && !empty($record->branch_office);
    }
}
