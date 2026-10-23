<?php

namespace App\Services;

use App\Models\PmwDocumentModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use RuntimeException;

class PmwBoothcampDocService
{
    public const DOC_KEY  = 'boothcamp_documentation';
    public const DOC_TYPE = 'laporan_akhir';
    public const MAX_SIZE = 5 * 1024 * 1024;

    private PmwDocumentModel $docModel;

    public function __construct()
    {
        $this->docModel = new PmwDocumentModel();
    }

    public function getDoc(int $proposalId): ?array
    {
        return $this->docModel->getProposalDocByKey($proposalId, self::DOC_KEY);
    }

    public function hasDoc(int $proposalId): bool
    {
        return $this->getDoc($proposalId) !== null;
    }

    /**
     * Ambil dokumentasi boothcamp untuk banyak proposal sekaligus.
     *
     * @param int[] $proposalIds
     * @return array<int, array>
     */
    public function getDocsForProposals(array $proposalIds): array
    {
        $ids = array_values(array_unique(array_map('intval', $proposalIds)));
        if ($ids === []) {
            return [];
        }

        $rows = $this->docModel
            ->whereIn('proposal_id', $ids)
            ->where('doc_key', self::DOC_KEY)
            ->findAll();

        $map = [];
        foreach ($rows as $row) {
            $map[(int) $row['proposal_id']] = $row;
        }

        return $map;
    }

    public function store(int $proposalId, int $uploaderId, UploadedFile $file): array
    {
        if (!$file->isValid()) {
            throw new RuntimeException('Berkas tidak valid: ' . $file->getErrorString());
        }

        if (strtolower((string) $file->getClientExtension()) !== 'pdf'
            || $file->getMimeType() !== 'application/pdf') {
            throw new RuntimeException('Format berkas harus PDF.');
        }

        if ($file->getSize() > self::MAX_SIZE) {
            throw new RuntimeException('Ukuran berkas maksimal 5MB.');
        }

        $existing  = $this->getDoc($proposalId);
        $targetDir = WRITEPATH . 'uploads/pmw/boothcamp/' . $proposalId;

        if (!is_dir($targetDir) && !mkdir($targetDir, 0775, true) && !is_dir($targetDir)) {
            throw new RuntimeException('Folder penyimpanan tidak dapat dibuat.');
        }

        $newName = $file->getRandomName();
        if (!$file->move($targetDir, $newName)) {
            throw new RuntimeException('Gagal menyimpan berkas: ' . $file->getErrorString());
        }

        $newPath = 'uploads/pmw/boothcamp/' . $proposalId . '/' . $newName;

        $data = [
            'team_id'       => null,
            'proposal_id'   => $proposalId,
            'uploader_id'   => $uploaderId,
            'type'          => self::DOC_TYPE,
            'doc_key'       => self::DOC_KEY,
            'file_path'     => $newPath,
            'original_name' => $file->getClientName(),
            'status'        => 'submitted',
            'version'       => $existing ? ((int) ($existing['version'] ?? 1)) + 1 : 1,
        ];

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $ok = $existing
                ? $this->docModel->update((int) $existing['id'], $data)
                : $this->docModel->insert($data);

            if ($ok === false || $db->transStatus() === false) {
                throw new RuntimeException('Gagal menyimpan data dokumen.');
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();

            if (is_file(WRITEPATH . $newPath)) {
                @unlink(WRITEPATH . $newPath);
            }

            throw $e;
        }

        if ($existing && !empty($existing['file_path'])) {
            $oldAbs = WRITEPATH . $existing['file_path'];
            if (is_file($oldAbs)) {
                @unlink($oldAbs);
            }
        }

        return $this->getDoc($proposalId) ?? $data;
    }
}
