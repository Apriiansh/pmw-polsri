<?php

namespace App\Services;

use App\Entities\PmwAnnouncement;
use App\Models\AnnouncementFunding\PmwAnnouncementModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class PmwAnnouncementService
{
    private PmwAnnouncementModel $announcementModel;

    public function __construct()
    {
        $this->announcementModel = new PmwAnnouncementModel();
    }

    public function getOrCreatePhaseAnnouncement(int $periodId, int $phaseNumber = 5): PmwAnnouncement
    {
        $existing = $this->announcementModel->findByPeriodAndPhase($periodId, $phaseNumber);
        if ($existing) {
            return $existing;
        }

        $id = $this->announcementModel->insert([
            'period_id'    => $periodId,
            'phase_number' => $phaseNumber,
            'title'        => 'Pengumuman Kelolosan Dana Tahap I',
            'content'      => null,
            'is_published' => 0,
            'published_at' => null,
        ], true);

        /** @var PmwAnnouncement|null $created */
        $created = $this->announcementModel->find((int) $id);
        if (!$created) {
            throw new \RuntimeException('Gagal membuat data pengumuman.');
        }

        return $created;
    }

    public function updateAnnouncement(int $announcementId, array $data): bool
    {
        $allowed = [
            'title',
            'content',
            'training_date',
            'training_location',
            'training_details',
        ];

        $payload = array_intersect_key($data, array_flip($allowed));

        return $this->announcementModel->update($announcementId, $payload);
    }

    public function uploadSkFile(int $announcementId, UploadedFile $file): string
    {
        if (!$file->isValid()) {
            throw new \RuntimeException('File tidak valid.');
        }

        $ext = strtolower((string) $file->getClientExtension());
        if ($ext !== 'pdf') {
            throw new \RuntimeException('File SK harus berformat PDF.');
        }

        if ($file->getSize() > 5 * 1024 * 1024) {
            throw new \RuntimeException('Ukuran file SK maksimal 5MB.');
        }

        /** @var PmwAnnouncement|null $announcement */
        $announcement = $this->announcementModel->find($announcementId);
        if (!$announcement) {
            throw new \RuntimeException('Pengumuman tidak ditemukan.');
        }

        // Delete old file if exists
        if (!empty($announcement->sk_file_path)) {
            $oldPath = WRITEPATH . $announcement->sk_file_path;
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }
        }

        $targetDir = 'uploads/pmw/sk';
        $absTargetDir = WRITEPATH . $targetDir;
        if (!is_dir($absTargetDir)) {
            mkdir($absTargetDir, 0775, true);
        }

        $randomName = $file->getRandomName();
        if (!$file->move($absTargetDir, $randomName)) {
            throw new \RuntimeException('Gagal menyimpan file SK ke server.');
        }

        $path = $targetDir . '/' . $randomName;

        $this->announcementModel->update($announcementId, [
            'sk_file_path'     => $path,
            'sk_original_name' => $file->getClientName(),
        ]);

        return $path;
    }

    public function deleteSkFile(int $announcementId): bool
    {
        /** @var PmwAnnouncement|null $announcement */
        $announcement = $this->announcementModel->find($announcementId);
        if (!$announcement) {
            return false;
        }

        if (!empty($announcement->sk_file_path)) {
            $abs = WRITEPATH . $announcement->sk_file_path;
            if (is_file($abs)) {
                @unlink($abs);
            }
        }

        return $this->announcementModel->update($announcementId, [
            'sk_file_path'     => null,
            'sk_original_name' => null,
        ]);
    }

    public function getAnnouncementById(int $id): ?PmwAnnouncement
    {
        return $this->announcementModel->find($id);
    }

    public function publishAnnouncement(int $announcementId): bool
    {
        return $this->announcementModel->update($announcementId, [
            'is_published' => 1,
            'published_at' => date('Y-m-d H:i:s'),
        ]);
    }

}
