<?php

namespace App\Services;

use App\Entities\PmwTrainingReport;
use App\Models\AnnouncementFunding\PmwTrainingPhotoModel;
use App\Models\AnnouncementFunding\PmwTrainingReportModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class PmwTrainingReportService
{
    private PmwTrainingReportModel $reportModel;
    private PmwTrainingPhotoModel $photoModel;

    public function __construct()
    {
        $this->reportModel = new PmwTrainingReportModel();
        $this->photoModel = new PmwTrainingPhotoModel();
    }

    public function getOrCreate(int $proposalId, int $periodId): PmwTrainingReport
    {
        $existing = $this->reportModel->findByProposal($proposalId);
        if ($existing) {
            return $existing;
        }

        $data = [
            'proposal_id' => $proposalId,
            'period_id'   => $periodId,
            'summary'     => '',
        ];

        $id = $this->reportModel->insert($data);
        if (!$id) {
            throw new \RuntimeException('Gagal membuat data laporan pembekalan.');
        }

        return $this->reportModel->find($id);
    }

    public function save(int $proposalId, int $periodId, string $summary): bool
    {
        $existing = $this->reportModel->findByProposal($proposalId);

        if ($existing) {
            return $this->reportModel->update($existing->id, ['summary' => $summary]);
        }

        return (bool) $this->reportModel->insert([
            'proposal_id' => $proposalId,
            'period_id'   => $periodId,
            'summary'     => $summary,
        ]);
    }

    public function uploadPhotos(int $reportId, array $files): array
    {
        $uploadedPaths = [];
        $maxPhotos = 5;

        // Check existing photos count
        $existingPhotos = $this->photoModel->findByReportId($reportId);
        $remainingSlots = $maxPhotos - count($existingPhotos);

        if ($remainingSlots <= 0) {
            throw new \RuntimeException('Maksimal 5 foto yang diperbolehkan.');
        }

        $filesToProcess = array_slice($files, 0, $remainingSlots);

        foreach ($filesToProcess as $file) {
            if (!$file instanceof UploadedFile || !$file->isValid()) {
                continue;
            }

            $ext = strtolower((string) $file->getClientExtension());
            $allowedExt = ['jpg', 'jpeg', 'png'];
            if (!in_array($ext, $allowedExt, true)) {
                throw new \RuntimeException('Format foto harus JPG atau PNG.');
            }

            if ($file->getSize() > 2 * 1024 * 1024) {
                throw new \RuntimeException('Ukuran foto maksimal 2MB.');
            }

            $targetDir = 'uploads/pmw/training_photos/' . $reportId;
            $absTargetDir = WRITEPATH . $targetDir;
            if (!is_dir($absTargetDir)) {
                mkdir($absTargetDir, 0775, true);
            }

            $randomName = $file->getRandomName();
            if (!$file->move($absTargetDir, $randomName)) {
                throw new \RuntimeException('Gagal menyimpan foto ke server.');
            }

            $path = $targetDir . '/' . $randomName;

            $this->photoModel->insert([
                'report_id'      => $reportId,
                'file_path'      => $path,
                'original_name'  => $file->getClientName(),
            ]);

            $uploadedPaths[] = $path;
        }

        return $uploadedPaths;
    }

    public function deletePhoto(int $photoId): bool
    {
        /** @var \App\Entities\PmwTrainingPhoto|null $photo */
        $photo = $this->photoModel->find($photoId);
        if (!$photo) {
            return false;
        }

        if (!empty($photo->file_path)) {
            $abs = WRITEPATH . $photo->file_path;
            if (is_file($abs)) {
                @unlink($abs);
            }
        }

        return $this->photoModel->delete($photoId);
    }

    public function getPhotos(int $reportId): array
    {
        return $this->photoModel->findByReportId($reportId);
    }

    public function findByProposal(int $proposalId): ?PmwTrainingReport
    {
        return $this->reportModel->findByProposal($proposalId);
    }

    public function hasCompleteData(int $proposalId): bool
    {
        $report = $this->reportModel->findByProposal($proposalId);
        if (!$report) {
            return false;
        }

        $photos = $this->photoModel->findByReportId($report->id);

        return !empty($report->summary) && count($photos) > 0;
    }
}
