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
     * Check if team leader passed Wawancara (Stage 2)
     */
    public function leaderPassedWawancara(int $periodId, int $leaderUserId): bool
    {
        $db = Database::connect();

        $row = $db->table('pmw_proposals p')
            ->select('sw.admin_status')
            ->join('pmw_selection_wawancara sw', 'sw.proposal_id = p.id', 'inner')
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
            'sw.admin_status as wawancara_status',
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'pm.jurusan as ketua_jurusan',
            'pm.prodi as ketua_prodi',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_selection_wawancara sw', 'sw.proposal_id = p.id', 'inner');
        $builder->where('p.period_id', $periodId);
        $builder->where('sw.admin_status', 'approved');
        $builder->orderBy('p.nama_usaha', 'ASC');

        return $builder->get()->getResultArray();
    }

    public function updateWawancaraStatus(int $proposalId, string $status): bool
    {
        $db = Database::connect();

        return $db->table('pmw_selection_wawancara')
            ->where('proposal_id', $proposalId)
            ->update([
                'admin_status' => $status,
                'updated_at'   => date('Y-m-d H:i:s')
            ]);
    }
}
