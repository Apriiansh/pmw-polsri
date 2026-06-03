<?php

namespace App\Services;

use App\Models\PmwPitchingAssessmentModel;
use App\Models\Selection\PmwSelectionPitchingModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\NotificationModel;

class PmwPitchingAssessmentService
{
    protected $assessmentModel;
    protected $selectionModel;
    protected $proposalModel;
    protected $notificationModel;

    public function __construct()
    {
        $this->assessmentModel   = new PmwPitchingAssessmentModel();
        $this->selectionModel    = new PmwSelectionPitchingModel();
        $this->proposalModel     = new PmwProposalModel();
        $this->notificationModel = new NotificationModel();
    }

    public function submitAssessment(int $proposalId, int $penilaiUserId, array $data): array
    {
        $existing = $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('penilai_user_id', $penilaiUserId)
            ->first();

        $payload = [
            'proposal_id'       => $proposalId,
            'penilai_user_id'   => $penilaiUserId,
            'status'            => $data['status'],
            'catatan'           => $data['catatan'] ?? null,
            'persentase_nilai'  => (float) $data['persentase_nilai'],
            'submitted_at'      => date('Y-m-d H:i:s'),
        ];

        if ($existing) {
            $this->assessmentModel->update($existing['id'], $payload);
        } else {
            $this->assessmentModel->insert($payload);
        }

        $this->recomputeAverage($proposalId);

        return ['success' => true];
    }

    public function recomputeAverage(int $proposalId): void
    {
        $selection = $this->selectionModel
            ->where('proposal_id', $proposalId)
            ->first();

        if (!$selection) return;

        $avgRow = $this->assessmentModel
            ->selectAvg('persentase_nilai', 'avg_score')
            ->where('proposal_id', $proposalId)
            ->where('submitted_at IS NOT NULL')
            ->first();

        $avgScore = $avgRow['avg_score'] ?? null;
        if ($avgScore === null) return;

        $count = $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('submitted_at IS NOT NULL')
            ->countAllResults();

        $finalStatus = $avgScore >= 80 ? 'approved' : 'rejected';
        $finalCatatan = sprintf(
            'Otomatis: rata-rata %.2f%% dari %d penilai',
            $avgScore,
            $count
        );

        $this->selectionModel->update($selection['id'], [
            'persentase_nilai' => $avgScore,
            'status'           => $finalStatus,
            'catatan'          => $finalCatatan,
        ]);
    }

    public function finalizeAssessment(int $proposalId, int $adminUserId): void
    {
        $selection = $this->selectionModel
            ->where('proposal_id', $proposalId)
            ->first();

        if (!$selection) return;
        if ($selection['penilaian_final_at'] !== null) return;

        $this->selectionModel->update($selection['id'], [
            'penilaian_final_at' => date('Y-m-d H:i:s'),
            'penilaian_final_by' => $adminUserId,
        ]);

        $this->notifyFinal($proposalId, $selection['status'], $selection['catatan']);
    }

    public function getAssessmentsForProposal(int $proposalId): array
    {
        return $this->assessmentModel
            ->select('
                pmw_pitching_assessments.*,
                users.username as penilai_username,
                pmw_penilai.nama as penilai_nama,
                pmw_penilai.expertise as penilai_expertise
            ')
            ->join('users', 'users.id = pmw_pitching_assessments.penilai_user_id', 'left')
            ->join('pmw_penilai', 'pmw_penilai.user_id = users.id', 'left')
            ->where('proposal_id', $proposalId)
            ->orderBy('submitted_at', 'DESC')
            ->findAll();
    }

    public function getAggregation(int $proposalId): array
    {
        $assessments = $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('submitted_at IS NOT NULL')
            ->findAll();

        $count = count($assessments);
        $sum   = array_sum(array_column($assessments, 'persentase_nilai'));
        $avg   = $count > 0 ? $sum / $count : null;

        $approved = count(array_filter($assessments, fn($a) => $a['status'] === 'approved'));
        $rejected = count(array_filter($assessments, fn($a) => $a['status'] === 'rejected'));

        return compact('count', 'avg', 'approved', 'rejected');
    }

    public function hasSubmitted(int $proposalId, int $penilaiUserId): bool
    {
        return $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('penilai_user_id', $penilaiUserId)
            ->where('submitted_at IS NOT NULL')
            ->countAllResults() > 0;
    }

    public function countAssessments(int $proposalId): int
    {
        return $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('submitted_at IS NOT NULL')
            ->countAllResults();
    }

    public function getMyAssessment(int $proposalId, int $penilaiUserId): ?array
    {
        return $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('penilai_user_id', $penilaiUserId)
            ->first();
    }

    public function getTotalPenilaiCount(): int
    {
        $db = \Config\Database::connect();
        return $db->table('auth_groups_users')
            ->where('group', 'penilai')
            ->countAllResults();
    }

    protected function notifyFinal(int $proposalId, string $status, string $catatan): void
    {
        $proposal = $this->proposalModel->find($proposalId);
        if ($proposal && !empty($proposal['leader_user_id'])) {
            $this->notificationModel->createPitchingValidationNotification(
                (int) $proposal['leader_user_id'],
                $proposalId,
                $proposal['nama_usaha'] ?? 'Tanpa Nama',
                $status === 'approved' ? 'approved' : 'rejected',
                $catatan
            );
        }
    }
}
