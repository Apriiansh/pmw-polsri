<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\AnnouncementFunding\PmwBankAccountModel;
use App\Models\PmwPeriodModel;
use App\Models\PmwDocumentModel;
use App\Models\Guidance\PmwGuidanceLogbookModel;
use App\Models\Activity\PmwActivityLogbookModel;
use App\Models\Milestone\PmwReportModel;
use App\Models\Selection\PmwSelectionFinalizationModel;
use CodeIgniter\API\ResponseTrait;

class FinalizationController extends BaseController
{
    use ResponseTrait;

    protected $proposalModel;
    protected $memberModel;
    protected $bankAccountModel;
    protected $periodModel;
    protected $documentModel;
    protected $guidanceLogbookModel;
    protected $activityLogbookModel;
    protected $reportModel;
    protected $finalizationModel;

    public function __construct()
    {
        $this->proposalModel = new PmwProposalModel();
        $this->memberModel = new PmwProposalMemberModel();
        $this->bankAccountModel = new PmwBankAccountModel();
        $this->periodModel = new PmwPeriodModel();
        $this->documentModel = new PmwDocumentModel();
        $this->guidanceLogbookModel = new PmwGuidanceLogbookModel();
        $this->activityLogbookModel = new PmwActivityLogbookModel();
        $this->reportModel = new PmwReportModel();
        $this->finalizationModel = new PmwSelectionFinalizationModel();
    }

    /**
     * List all teams eligible for finalization
     */
    public function index()
    {
        $periodFilter = $this->request->getGet('period');
        $search = $this->request->getGet('search');

        $db = \Config\Database::connect();
        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.id as proposal_id',
            'p.nama_usaha',
            'p.kategori_wirausaha',
            'p.kategori_usaha',
            'p.total_rab',
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'per.name as period_name',
            'per.year as period_year',
            'sp.admin_status as pitching_status',
            'sf.admin_status as final_status',
            'sf.updated_at as finalized_at',
            '(SELECT COUNT(*) FROM pmw_guidance_schedules gs 
              JOIN pmw_guidance_logbooks gl ON gl.schedule_id = gs.id 
              WHERE gs.proposal_id = p.id AND gs.type = "bimbingan" AND gl.status = "approved") as total_bimbingan',
            '(SELECT COUNT(*) FROM pmw_guidance_schedules gs 
              JOIN pmw_guidance_logbooks gl ON gl.schedule_id = gs.id 
              WHERE gs.proposal_id = p.id AND gs.type = "mentoring" AND gl.status = "approved") as total_mentoring',
            '(SELECT COUNT(*) FROM pmw_activity_schedules pas 
              JOIN pmw_activity_logbooks pal ON pal.schedule_id = pas.id 
              WHERE pas.proposal_id = p.id AND pal.status = "approved") as total_kegiatan',
            '(SELECT status FROM pmw_reports WHERE proposal_id = p.id AND type = "kemajuan" ORDER BY created_at DESC LIMIT 1) as kemajuan_status',
            '(SELECT status FROM pmw_reports WHERE proposal_id = p.id AND type = "akhir" ORDER BY created_at DESC LIMIT 1) as akhir_status',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        $builder->join('pmw_selection_pitching sp', 'sp.proposal_id = p.id', 'left');
        $builder->join('pmw_selection_finalization sf', 'sf.proposal_id = p.id', 'left');

        // Only teams that passed pitching
        $builder->where('sp.admin_status', 'approved');

        if ($periodFilter) {
            $builder->where('p.period_id', $periodFilter);
        }
        if ($search) {
            $builder->groupStart()
                ->like('p.nama_usaha', $search)
                ->orLike('pm.nama', $search)
                ->groupEnd();
        }

        $builder->orderBy('sf.admin_status', 'ASC'); // Pending/null first
        $builder->orderBy('per.year', 'DESC');

        $teams = $builder->get()->getResultArray();
        $periods = $this->periodModel->findAll();

        return view('admin/finalisasi/index', [
            'title' => 'Finalisasi Dana Tahap II | PMW Polsri',
            'header_title' => 'Finalisasi Dana Tahap II',
            'header_subtitle' => 'Penetapan kelolosan akhir untuk pendanaan tahap kedua',
            'teams' => $teams,
            'periods' => $periods,
            'periodFilter' => $periodFilter,
            'search' => $search
        ]);
    }

    /**
     * Show detail for finalization
     */
    public function detail(int $id)
    {
        $proposal = $this->proposalModel->getProposalForValidation($id);
        if (!$proposal) {
            return redirect()->to('admin/finalisasi')->with('error', 'Tim tidak ditemukan');
        }

        // Verify eligibility: Must have passed pitching
        $db = \Config\Database::connect();
        $pitching = $db->table('pmw_selection_pitching')->where('proposal_id', $id)->get()->getRowArray();
        if (!$pitching || $pitching['admin_status'] !== 'approved') {
            return redirect()->to('admin/finalisasi')->with('error', 'Tim belum melewati tahap Pitching Desk');
        }

        $data = [
            'title' => 'Audit Finalisasi | PMW Polsri',
            'header_title' => 'Audit Finalisasi',
            'header_subtitle' => $proposal['nama_usaha'],
            'proposal' => $proposal,
            'members' => $this->memberModel->getByProposalId($id),
            'bankAccount' => $this->bankAccountModel->findByProposal($id),
            'documents' => $this->documentModel->getProposalDocs($id),
            'guidanceLogs' => $this->guidanceLogbookModel->select('pmw_guidance_logbooks.*, gs.type, gs.schedule_date, gs.topic')
                ->join('pmw_guidance_schedules gs', 'gs.id = pmw_guidance_logbooks.schedule_id')
                ->where('gs.proposal_id', $id)
                ->orderBy('gs.schedule_date', 'DESC')
                ->findAll(),
            'activityLogs' => $this->activityLogbookModel->select('pmw_activity_logbooks.*, pas.activity_category, pas.activity_date')
                ->join('pmw_activity_schedules pas', 'pas.id = pmw_activity_logbooks.schedule_id')
                ->where('pas.proposal_id', $id)
                ->orderBy('pas.activity_date', 'DESC')
                ->findAll(),
            'milestoneReports' => $this->reportModel->where('proposal_id', $id)->findAll(),
            'finalization' => $this->finalizationModel->where('proposal_id', $id)->first()
        ];

        return view('admin/finalisasi/detail', $data);
    }

    /**
     * Process finalization action
     */
    public function validateAction()
    {
        $id = $this->request->getPost('proposal_id');
        $status = $this->request->getPost('status');
        $notes = $this->request->getPost('admin_notes');

        if (!in_array($status, ['approved', 'rejected'])) {
            return $this->fail('Status tidak valid');
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            // Check existing
            $existing = $this->finalizationModel->where('proposal_id', $id)->first();
            $adminId = user_id();

            $data = [
                'proposal_id' => $id,
                'admin_status' => $status,
                'admin_catatan' => $notes,
                'admin_id' => $adminId,
                'admin_verified_at' => date('Y-m-d H:i:s')
            ];

            if ($existing) {
                $this->finalizationModel->update($existing['id'], $data);
            } else {
                $this->finalizationModel->insert($data);
            }

            $db->transCommit();

            // TODO: In the future, trigger notification to student here

            return redirect()->to('admin/finalisasi')->with('success', 'Status finalisasi tim berhasil diperbarui');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
