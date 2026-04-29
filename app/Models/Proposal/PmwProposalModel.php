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
        'kategori_usaha',
        'nama_usaha',
        'kategori_wirausaha',
        'detail_keterangan',
        'video_url',
        'total_rab',
        'status',
        'catatan',
        'submitted_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Callbacks
    protected $afterInsert = ['initializeProposalStages'];

    protected $validationRules = [
        'period_id'       => 'required|integer',
        'leader_user_id'  => 'required|integer',
        'kategori_usaha'  => 'permit_empty|max_length[100]',
        'nama_usaha'      => 'permit_empty|max_length[255]',
        'kategori_wirausaha' => 'required|in_list[pemula,berkembang]',
        'detail_keterangan' => 'permit_empty',
        'video_url'       => 'permit_empty|valid_url|max_length[255]',
        'total_rab'       => 'permit_empty|decimal',
        'status'          => 'required|in_list[draft,submitted,revision,approved,rejected]',
        'catatan'         => 'permit_empty|string',
    ];

    public function findByPeriodAndLeader(int $periodId, int $leaderUserId): ?array
    {
        return $this->select([
                'pmw_proposals.*',
                'pm.nama as ketua_nama',
                'pm.nim as ketua_nim',
                'l.nama as dosen_nama',
                'm.nama as mentor_nama',
                'sp.admin_status as pitching_admin_status',
                'sp.admin_catatan as pitching_admin_catatan',
                'pj.admin_status as perjanjian_status',
                'pj.created_at as perjanjian_submitted_at',
                'pj.admin_catatan as perjanjian_catatan',
                'si.admin_status as implementasi_status',
                'si.admin_catatan as implementasi_catatan'
            ])
            ->join('pmw_proposal_members pm', 'pm.proposal_id = pmw_proposals.id AND pm.role = "ketua"', 'left')
            ->join('pmw_proposal_assignments pa', 'pa.proposal_id = pmw_proposals.id', 'left')
            ->join('pmw_lecturers l', 'l.id = pa.lecturer_id', 'left')
            ->join('pmw_mentors m', 'm.id = pa.mentor_id', 'left')
            ->join('pmw_selection_pitching sp', 'sp.proposal_id = pmw_proposals.id', 'left')
            ->join('pmw_perjanjian pj', 'pj.proposal_id = pmw_proposals.id', 'left')
            ->join('pmw_selection_implementasi si', 'si.proposal_id = pmw_proposals.id', 'left')
            ->where('pmw_proposals.period_id', $periodId)
            ->where('pmw_proposals.leader_user_id', $leaderUserId)
            ->first();
    }

    public function getProposalByUserId(int $userId): ?array
    {
        return $this->select('pmw_proposals.*, pm.nama as ketua_nama, pm.nim as ketua_nim')
            ->join('pmw_proposal_members pm', 'pm.proposal_id = pmw_proposals.id AND pm.role = "ketua"', 'left')
            ->where('pmw_proposals.leader_user_id', $userId)
            ->orderBy('pmw_proposals.created_at', 'DESC')
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
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'pm.jurusan as ketua_jurusan',
            'pm.prodi as ketua_prodi',
            'l.nama as dosen_nama',
            'l.nip as dosen_nip',
            'per.name as period_name',
            'per.year as period_year',
            'sp.admin_status as pitching_admin_status',
            'spr.dosen_status as proposal_dosen_status',
            'spr.admin_status as proposal_admin_status',
            '(SELECT COUNT(*) FROM pmw_proposal_members pm2 WHERE pm2.proposal_id = p.id) as member_count',
            '(SELECT COUNT(*) FROM pmw_documents d WHERE d.proposal_id = p.id AND d.type = "proposal") as doc_count',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = pa.lecturer_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        $builder->join('pmw_selection_pitching sp', 'sp.proposal_id = p.id', 'left');
        $builder->join('pmw_selection_proposal spr', 'spr.proposal_id = p.id', 'left');
        
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
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'pm.jurusan as ketua_jurusan',
            'pm.prodi as ketua_prodi',
            'pm.phone as ketua_phone',
            'pm.email as ketua_email',
            'l.nama as dosen_nama',
            'l.nip as dosen_nip',
            'l.jurusan as dosen_jurusan',
            'l.prodi as dosen_prodi',
            'l.phone as dosen_phone',
            'm.nama as mentor_nama',
            'm.company as mentor_company',
            'per.name as period_name',
            'per.year as period_year',
            // Add selection statuses
            'sp.admin_status as pitching_admin_status',
            'sp.admin_catatan as pitching_admin_catatan',
            'sp.student_submitted_at',
            'spr.dosen_status as proposal_dosen_status',
            'spr.dosen_catatan as proposal_dosen_catatan',
            'spr.admin_status as proposal_admin_status',
            'spr.admin_catatan as proposal_admin_catatan',
            'spr.student_submitted_at as proposal_submitted_at',
            'pj.admin_status as perjanjian_status',
            'pj.student_submitted_at as perjanjian_submitted_at',
            'pa.lecturer_id',
            'pa.mentor_id',
            'pj.admin_catatan as perjanjian_catatan',
            'si.admin_status as implementasi_status',
            'si.admin_catatan as implementasi_catatan',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = pa.lecturer_id', 'left');
        $builder->join('pmw_mentors m', 'm.id = pa.mentor_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        
        // Joined selection tables
        $builder->join('pmw_selection_pitching sp', 'sp.proposal_id = p.id', 'left');
        $builder->join('pmw_selection_proposal spr', 'spr.proposal_id = p.id', 'left');
        $builder->join('pmw_perjanjian pj', 'pj.proposal_id = p.id', 'left');
        $builder->join('pmw_selection_implementasi si', 'si.proposal_id = p.id', 'left');

        $builder->where('p.id', $id);
        
        return $builder->get()->getRowArray();
    }
    
    /**
     * Get proposals for a specific lecturer to validate (Phase 2 Proposal Validation)
     */
    public function getProposalsForLecturerProposal(int $lecturerUserId, ?string $statusFilter = null): array
    {
        $db = \Config\Database::connect();

        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.*',
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'l.nama as dosen_nama',
            'per.name as period_name',
            'per.year as period_year',
            'spr.dosen_status as proposal_dosen_status',
            'spr.admin_status as proposal_admin_status',
            'spr.student_submitted_at',
            'pa.lecturer_id',
            '(SELECT id FROM pmw_documents WHERE proposal_id = p.id AND doc_key = "proposal_utama" LIMIT 1) as proposal_doc_id',
            '(SELECT id FROM pmw_documents WHERE proposal_id = p.id AND doc_key = "surat_kesediaan_dosen" LIMIT 1) as surat_dosen_doc_id',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = pa.lecturer_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        $builder->join('pmw_selection_proposal spr', 'spr.proposal_id = p.id', 'left');

        $builder->where('l.user_id', $lecturerUserId);
        $builder->where('spr.student_submitted_at IS NOT NULL');

        if ($statusFilter) {
            $builder->where('spr.dosen_status', $statusFilter);
        }

        $builder->orderBy('spr.student_submitted_at', 'DESC');

        return $builder->get()->getResultArray();
    }

    /**
     * Get proposal detail with selection_proposal data for dosen validation
     */
    public function getProposalWithSelectionForDosen(int $id): ?array
    {
        $db = \Config\Database::connect();

        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.*',
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'pm.jurusan as ketua_jurusan',
            'pm.prodi as ketua_prodi',
            'pm.phone as ketua_phone',
            'pm.email as ketua_email',
            'l.nama as dosen_nama',
            'l.nip as dosen_nip',
            'l.user_id as dosen_user_id',
            'per.name as period_name',
            'per.year as period_year',
            'pa.lecturer_id',
            'spr.id as selection_id',
            'spr.dosen_status as proposal_dosen_status',
            'spr.admin_status as proposal_admin_status',
            'spr.dosen_catatan as proposal_dosen_catatan',
            'spr.admin_catatan as proposal_admin_catatan',
            'spr.student_submitted_at',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = pa.lecturer_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        $builder->join('pmw_selection_proposal spr', 'spr.proposal_id = p.id', 'left');

        $builder->where('p.id', $id);

        return $builder->get()->getRowArray() ?: null;
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
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'l.nama as dosen_nama',
            'per.name as period_name',
            'per.year as period_year',
            'sp.admin_status as pitching_admin_status',
            'sp.student_submitted_at',
            'pa.lecturer_id',
            '(SELECT id FROM pmw_documents WHERE proposal_id = p.id AND doc_key = "pitching_ppt" LIMIT 1) as pitching_ppt_id'
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = pa.lecturer_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        $builder->join('pmw_selection_pitching sp', 'sp.proposal_id = p.id', 'left');
        
        $builder->where('l.user_id', $lecturerUserId);
        $builder->where('sp.student_submitted_at IS NOT NULL');
        
        if ($statusFilter) {
            $builder->where('sp.admin_status', $statusFilter);
        }
        
        $builder->orderBy('p.updated_at', 'DESC');
        
        return $builder->get()->getResultArray();
    }

    /**
     * Get proposals for Admin Pitching Desk validation
     */
    public function getProposalsForAdminPitching(?string $statusFilter = null): array
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.*',
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'per.name as period_name',
            'per.year as period_year',
            'sp.admin_status as pitching_admin_status',
            'sp.student_submitted_at',
            '(SELECT id FROM pmw_documents WHERE proposal_id = p.id AND doc_key = "pitching_ppt" LIMIT 1) as pitching_ppt_id'
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        $builder->join('pmw_selection_pitching sp', 'sp.proposal_id = p.id', 'left');
        
        $builder->where('sp.student_submitted_at IS NOT NULL');
        
        if ($statusFilter) {
            $builder->where('sp.admin_status', $statusFilter);
        }
        
        $builder->orderBy('p.updated_at', 'DESC');
        
        return $builder->get()->getResultArray();
    }

    /**
     * Get proposals (with implementasi status) for a specific lecturer
     */
    public function getProposalsForLecturerImplementasi(int $lecturerUserId, ?string $statusFilter = null): array
    {
        $db = \Config\Database::connect();

        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.id', 'p.nama_usaha', 'p.kategori_wirausaha as kategori', 'p.updated_at',
            'pm.nama as ketua_nama', 'pm.nim as ketua_nim',
            'l.nama as dosen_nama',
            'per.name as period_name', 'per.year as period_year',
            'si.id as si_id',
            'si.student_submitted_at',
            'si.dosen_status',
            'si.admin_status as implementasi_admin_status',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = pa.lecturer_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        $builder->join('pmw_selection_implementasi si', 'si.proposal_id = p.id', 'left');
        $builder->join('pmw_perjanjian pj', 'pj.proposal_id = p.id', 'left');

        $builder->where('l.user_id', $lecturerUserId);
        // Only teams that passed perjanjian (i.e., qualified for implementasi)
        $builder->where('pj.admin_status', 'approved');
        // Only show proposals where student has submitted
        $builder->where('si.student_submitted_at IS NOT NULL', null, false);

        if ($statusFilter) {
            $builder->where('si.dosen_status', $statusFilter);
        }

        $builder->orderBy('si.student_submitted_at', 'DESC');

        return $builder->get()->getResultArray();
    }

    /**
     * Get all proposals assigned to a specific lecturer
     */
    public function getProposalsByLecturer(int $lecturerId, string $status = 'approved'): array
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table . ' p');
        $builder->select('p.*, pa.lecturer_id, pa.mentor_id, pm.nama as ketua_nama');
        $builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id');
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->where('pa.lecturer_id', $lecturerId);
        
        if ($status) {
            $builder->where('p.status', $status);
        }

        return $builder->get()->getResultArray();
    }

    /**
     * Get all proposals assigned to a specific mentor
     */
    public function getProposalsByMentor(int $mentorId, string $status = 'approved'): array
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table . ' p');
        $builder->select('p.*, pa.lecturer_id, pa.mentor_id, pm.nama as ketua_nama');
        $builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id');
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->where('pa.mentor_id', $mentorId);

        if ($status) {
            $builder->where('p.status', $status);
        }

        return $builder->get()->getResultArray();
    }

    /**
     * Get proposals approved in implementasi for activity scheduling
     */
    public function getProposalsForSchedule(int $periodId): array
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table . ' p');
        $builder->select('p.*, p.kategori_wirausaha as category, pm.nama as ketua_nama');
        $builder->join('pmw_selection_implementasi psi', 'psi.proposal_id = p.id');
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->where('p.period_id', $periodId);
        $builder->where('psi.admin_status', 'approved');
        $builder->where('p.status', 'approved');
        $builder->orderBy('p.nama_usaha', 'ASC');

        return $builder->get()->getResultArray();
    }

    protected function initializeProposalStages(array $data)
    {
        if (isset($data['id'])) {
            $proposalId = $data['id'];
            
            // Use query builder to avoid model loops
            $db = \Config\Database::connect();
            
            // Initialize Assignments
            $db->table('pmw_proposal_assignments')->insert([
                'proposal_id' => $proposalId,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ]);
            
            // Initialize Pitching Selection
            $db->table('pmw_selection_pitching')->insert([
                'proposal_id'  => $proposalId,
                'admin_status' => 'pending',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]);
            
            // Initialize Perjanjian Selection
            $db->table('pmw_perjanjian')->insert([
                'proposal_id'  => $proposalId,
                'admin_status' => 'pending',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]);
            
            // Initialize Implementasi Selection
            $db->table('pmw_selection_implementasi')->insert([
                'proposal_id'  => $proposalId,
                'admin_status' => 'pending',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]);
        }
        return $data;
    }
}
