<?php

namespace App\Models\Proposal;

use CodeIgniter\Model;

class PmwProposalModel extends Model
{
    protected $table            = 'pmw_proposals';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields = [
        'period_id',
        'leader_user_id',
        'lecturer_id',
        'kategori_usaha',
        'nama_usaha',
        'kategori_wirausaha',
        'detail_keterangan',
        'video_url',
        'total_rab',
        'status',
        'catatan',
        'pitching_dosen_status',
        'pitching_admin_status',
        'pitching_dosen_catatan',
        'pitching_admin_catatan',
        'submitted_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'period_id'       => 'required|integer',
        'leader_user_id'  => 'required|integer',
        'lecturer_id'     => 'permit_empty|integer',
        'kategori_usaha'  => 'permit_empty|max_length[100]',
        'nama_usaha'      => 'permit_empty|max_length[255]',
        'kategori_wirausaha' => 'required|in_list[pemula,berkembang]',
        'detail_keterangan' => 'permit_empty',
        'video_url'       => 'permit_empty|valid_url|max_length[255]',
        'total_rab'       => 'permit_empty|decimal',
        'status'          => 'required|in_list[draft,submitted,revision,approved,rejected]',
        'catatan'         => 'permit_empty|string',
        'pitching_dosen_status' => 'required|in_list[pending,approved,rejected,revision]',
        'pitching_admin_status' => 'required|in_list[pending,approved,rejected,revision]',
        'pitching_dosen_catatan' => 'permit_empty|string',
        'pitching_admin_catatan' => 'permit_empty|string',
    ];

    public function findByPeriodAndLeader(int $periodId, int $leaderUserId): ?array
    {
        return $this->where('period_id', $periodId)
            ->where('leader_user_id', $leaderUserId)
            ->first();
    }

    /**
     * Get proposals with details for seleksi administrasi
     */
    public function getWithDetails(?string $statusFilter = null): array
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.*',
            'pr.nama as ketua_nama',
            'pr.nim as ketua_nim',
            'pr.jurusan as ketua_jurusan',
            'pr.prodi as ketua_prodi',
            'l.nama as dosen_nama',
            'l.nip as dosen_nip',
            'per.name as period_name',
            'per.year as period_year',
            '(SELECT COUNT(*) FROM pmw_proposal_members pm WHERE pm.proposal_id = p.id) as member_count',
            '(SELECT COUNT(*) FROM pmw_documents d WHERE d.proposal_id = p.id AND d.type = "proposal") as doc_count',
        ]);
        $builder->join('pmw_profiles pr', 'pr.user_id = p.leader_user_id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = p.lecturer_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        
        if ($statusFilter && in_array($statusFilter, ['submitted', 'revision', 'approved', 'rejected'])) {
            $builder->where('p.status', $statusFilter);
        }
        
        $builder->orderBy('p.submitted_at', 'DESC');
        $builder->orderBy('p.created_at', 'DESC');
        
        return $builder->get()->getResultArray();
    }

    /**
     * Get proposal detail for validation
     */
    public function getProposalForValidation(int $id): ?array
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.*',
            'pr.nama as ketua_nama',
            'pr.nim as ketua_nim',
            'pr.jurusan as ketua_jurusan',
            'pr.prodi as ketua_prodi',
            'pr.phone as ketua_phone',
            'a.secret as ketua_email',
            'l.nama as dosen_nama',
            'l.nip as dosen_nip',
            'l.jurusan as dosen_jurusan',
            'l.prodi as dosen_prodi',
            'l.phone as dosen_phone',
            'per.name as period_name',
            'per.year as period_year',
        ]);
        $builder->join('pmw_profiles pr', 'pr.user_id = p.leader_user_id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = p.lecturer_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        $builder->join('auth_identities a', 'a.user_id = p.leader_user_id AND a.type = "email_password"', 'left');
        $builder->where('p.id', $id);
        
        return $builder->get()->getRowArray();
    }
    
    /**
     * Get proposals for a specific lecturer (Phase 3 Validation)
     */
    public function getProposalsForLecturerPitching(int $lecturerUserId, ?string $statusFilter = null): array
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.*',
            'pr.nama as ketua_nama',
            'pr.nim as ketua_nim',
            'l.nama as dosen_nama',
            'per.name as period_name',
            'per.year as period_year',
            '(SELECT id FROM pmw_documents WHERE proposal_id = p.id AND doc_key = "pitching_ppt" LIMIT 1) as pitching_ppt_id'
        ]);
        $builder->join('pmw_profiles pr', 'pr.user_id = p.leader_user_id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = p.lecturer_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        
        $builder->where('l.user_id', $lecturerUserId);
        $builder->where('p.status', 'approved'); // Only proposals that passed Phase 2
        
        if ($statusFilter) {
            $builder->where('p.pitching_dosen_status', $statusFilter);
        }
        
        $builder->orderBy('p.updated_at', 'DESC');
        
        return $builder->get()->getResultArray();
    }

    /**
     * Get proposals for Admin (Phase 3 Validation)
     * Only shows proposals already approved by their respective lecturers
     */
    public function getProposalsForAdminPitching(?string $statusFilter = null): array
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.*',
            'pr.nama as ketua_nama',
            'pr.nim as ketua_nim',
            'l.nama as dosen_nama',
            'per.name as period_name',
            'per.year as period_year',
            '(SELECT id FROM pmw_documents WHERE proposal_id = p.id AND doc_key = "pitching_ppt" LIMIT 1) as pitching_ppt_id'
        ]);
        $builder->join('pmw_profiles pr', 'pr.user_id = p.leader_user_id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = p.lecturer_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        
        $builder->where('p.status', 'approved');
        $builder->where('p.pitching_dosen_status', 'approved'); 
        
        if ($statusFilter) {
            $builder->where('p.pitching_admin_status', $statusFilter);
        }
        
        $builder->orderBy('p.updated_at', 'DESC');
        
        return $builder->get()->getResultArray();
    }
}
