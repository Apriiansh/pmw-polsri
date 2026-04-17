<?php

namespace App\Services;

use Config\Database;

class PmwSelectionService
{
    public function leaderPassedStage1(int $periodId, int $leaderUserId): bool
    {
        $db = Database::connect();

        $row = $db->table('pmw_proposals')
            ->select('wawancara_status')
            ->where('period_id', $periodId)
            ->where('leader_user_id', $leaderUserId)
            ->get()
            ->getRowArray();

        return ($row && ($row['wawancara_status'] ?? null) === 'approved');
    }

    public function getPassedStage1Teams(int $periodId): array
    {
        $db = Database::connect();

        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.id',
            'p.nama_usaha',
            'p.kategori_wirausaha',
            'p.wawancara_status',
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'pm.jurusan as ketua_jurusan',
            'pm.prodi as ketua_prodi',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->where('p.period_id', $periodId);
        $builder->where('p.wawancara_status', 'approved');
        $builder->orderBy('p.nama_usaha', 'ASC');

        return $builder->get()->getResultArray();
    }
}
