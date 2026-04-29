<?php

namespace App\Services;

use Config\Database;

class PmwSelectionService
{
    /**
     * Check if team leader passed Administrasi (Stage 1)
     */
    public function leaderPassedAdministrasi(int $periodId, int $leaderUserId): bool
    {
        $db = Database::connect();

        $row = $db->table('pmw_proposals p')
            ->select('p.status')
            ->where('p.period_id', $periodId)
            ->where('p.leader_user_id', $leaderUserId)
            ->get()
            ->getRowArray();

        return ($row && ($row['status'] ?? null) === 'approved');
    }

    /**
     * Check if team leader passed Perjanjian (Stage 3)
     */
    public function leaderPassedPerjanjian(int $periodId, int $leaderUserId): bool
    {
        $db = Database::connect();

        $row = $db->table('pmw_proposals p')
            ->select('pj.admin_status')
            ->join('pmw_perjanjian pj', 'pj.proposal_id = p.id', 'inner')
            ->where('p.period_id', $periodId)
            ->where('p.leader_user_id', $leaderUserId)
            ->get()
            ->getRowArray();

        return ($row && ($row['admin_status'] ?? null) === 'approved');
    }

    public function getPassedStage1Teams(int $periodId): array
    {
        $db = Database::connect();

        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.id',
            'p.nama_usaha',
            'p.kategori_wirausaha',
            'pj.admin_status as perjanjian_status',
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'pm.jurusan as ketua_jurusan',
            'pm.prodi as ketua_prodi',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_perjanjian pj', 'pj.proposal_id = p.id', 'inner');
        $builder->where('p.period_id', $periodId);
        $builder->where('pj.admin_status', 'approved');
        $builder->orderBy('p.nama_usaha', 'ASC');

        return $builder->get()->getResultArray();
    }

    public function updatePerjanjianStatus(int $proposalId, string $status, bool $updateSubmittedAt = false): bool
    {
        $db = Database::connect();

        $data = [
            'admin_status' => $status,
            'updated_at'   => date('Y-m-d H:i:s')
        ];

        if ($updateSubmittedAt) {
            $data['student_submitted_at'] = date('Y-m-d H:i:s');
        }

        return $db->table('pmw_perjanjian')
            ->where('proposal_id', $proposalId)
            ->update($data);
    }
}
