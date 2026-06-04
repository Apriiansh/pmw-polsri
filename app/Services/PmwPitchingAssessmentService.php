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
        if ($this->adminHasAssessment($proposalId)) {
            return ['success' => false, 'message' => 'Admin sudah menilai proposal ini. Penilai tidak bisa lagi mengirim penilaian.'];
        }

        $existing = $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('penilai_user_id', $penilaiUserId)
            ->where('is_admin_assessment', 0)
            ->first();

        $payload = [
            'proposal_id'       => $proposalId,
            'penilai_user_id'   => $penilaiUserId,
            'is_admin_assessment' => 0,
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

    public function submitAdminAssessment(int $proposalId, int $adminUserId, array $data): array
    {
        $selection = $this->selectionModel
            ->where('proposal_id', $proposalId)
            ->first();

        if (!$selection) {
            return ['success' => false, 'message' => 'Data pitching tidak ditemukan.'];
        }

        if ($selection->penilaian_final_at !== null) {
            return ['success' => false, 'message' => 'Proposal ini sudah difinalisasi.'];
        }

        $existing = $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('penilai_user_id', $adminUserId)
            ->where('is_admin_assessment', 1)
            ->first();

        $payload = [
            'proposal_id'       => $proposalId,
            'penilai_user_id'   => $adminUserId,
            'is_admin_assessment' => 1,
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

        $score = (float) $data['persentase_nilai'];
        $status = $score >= 80 ? 'approved' : 'rejected';
        $catatan = $data['catatan'] ?? '';

        $this->selectionModel->update($selection->id, [
            'persentase_nilai'  => $score,
            'status'            => $status,
            'catatan'           => $catatan,
            'penilaian_final_at' => date('Y-m-d H:i:s'),
            'penilaian_final_by' => $adminUserId,
        ]);

        $this->notifyFinal($proposalId, $status, $catatan);

        return ['success' => true];
    }

    public function editPenilaiAssessment(int $assessmentId, int $adminUserId, array $data): array
    {
        $assessment = $this->assessmentModel->find($assessmentId);
        if (!$assessment) {
            return ['success' => false, 'message' => 'Penilaian tidak ditemukan.'];
        }

        if ((int) $assessment['is_admin_assessment'] === 1) {
            return ['success' => false, 'message' => 'Tidak bisa mengedit penilaian admin lewat sini.'];
        }

        $this->assessmentModel->update($assessmentId, [
            'persentase_nilai'  => (float) $data['persentase_nilai'],
            'status'            => $data['status'],
            'catatan'           => $data['catatan'] ?? null,
            'edited_by_admin'   => 1,
        ]);

        $this->recomputeAverage((int) $assessment['proposal_id']);

        return ['success' => true];
    }

    public function recomputeAverage(int $proposalId): void
    {
        $selection = $this->selectionModel
            ->where('proposal_id', $proposalId)
            ->first();

        if (!$selection) return;

        // If admin has an assessment, don't recompute from penilai
        if ($this->adminHasAssessment($proposalId)) return;

        $avgRow = $this->assessmentModel
            ->selectAvg('persentase_nilai', 'avg_score')
            ->where('proposal_id', $proposalId)
            ->where('is_admin_assessment', 0)
            ->where('submitted_at IS NOT NULL')
            ->first();

        $avgScore = $avgRow['avg_score'] ?? null;
        if ($avgScore === null) return;

        $count = $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('is_admin_assessment', 0)
            ->where('submitted_at IS NOT NULL')
            ->countAllResults();

        $finalStatus = $avgScore >= 80 ? 'approved' : 'rejected';

        $this->selectionModel->update($selection->id, [
            'persentase_nilai' => $avgScore,
            'status'           => $finalStatus,
        ]);
    }

    public function finalizeAssessment(int $proposalId, int $adminUserId, ?string $catatan = null): void
    {
        $selection = $this->selectionModel
            ->where('proposal_id', $proposalId)
            ->first();

        if (!$selection) return;
        if ($selection->penilaian_final_at !== null) return;

        $finalCatatan = $catatan ?? $selection->catatan ?? '';

        $this->selectionModel->update($selection->id, [
            'penilaian_final_at' => date('Y-m-d H:i:s'),
            'penilaian_final_by' => $adminUserId,
            'catatan'            => $finalCatatan,
        ]);

        $this->notifyFinal($proposalId, $selection->status, $finalCatatan);
    }

    public function getAssessmentsForProposal(int $proposalId): array
    {
        $db = \Config\Database::connect();
        return $this->assessmentModel
            ->select('
                pmw_pitching_assessments.*,
                users.username as penilai_username,
                pmw_penilai.nama as penilai_nama,
                pmw_penilai.expertise as penilai_expertise
            ')
            ->join('users', 'users.id = pmw_pitching_assessments.penilai_user_id', 'left')
            ->join('pmw_penilai', 'pmw_penilai.user_id = users.id', 'left')
            ->where('pmw_pitching_assessments.proposal_id', $proposalId)
            ->orderBy('pmw_pitching_assessments.is_admin_assessment', 'DESC')
            ->orderBy('pmw_pitching_assessments.submitted_at', 'DESC')
            ->findAll();
    }

    public function getAggregation(int $proposalId): array
    {
        $assessments = $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('submitted_at IS NOT NULL')
            ->findAll();

        $penilaiAssessments = array_filter($assessments, fn($a) => (int) $a['is_admin_assessment'] === 0);
        $adminAssessment = current(array_filter($assessments, fn($a) => (int) $a['is_admin_assessment'] === 1)) ?: null;

        $count = count($penilaiAssessments);
        $sum   = array_sum(array_column($penilaiAssessments, 'persentase_nilai'));
        $avg   = $count > 0 ? $sum / $count : null;

        $approved = count(array_filter($assessments, fn($a) => $a['status'] === 'approved'));
        $rejected = count(array_filter($assessments, fn($a) => $a['status'] === 'rejected'));

        $adminScore = $adminAssessment ? (float) $adminAssessment['persentase_nilai'] : null;
        $hasAdminAssessment = $adminAssessment !== null;

        return compact('count', 'avg', 'approved', 'rejected', 'adminScore', 'hasAdminAssessment');
    }

    public function hasSubmitted(int $proposalId, int $penilaiUserId): bool
    {
        return $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('penilai_user_id', $penilaiUserId)
            ->where('is_admin_assessment', 0)
            ->where('submitted_at IS NOT NULL')
            ->countAllResults() > 0;
    }

    public function countAssessments(int $proposalId): int
    {
        return $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('is_admin_assessment', 0)
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

    public function canPenilaiAssess(int $proposalId): bool
    {
        return !$this->adminHasAssessment($proposalId);
    }

    public function adminHasAssessment(int $proposalId): bool
    {
        return $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('is_admin_assessment', 1)
            ->where('submitted_at IS NOT NULL')
            ->countAllResults() > 0;
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
