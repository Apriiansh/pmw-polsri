<?php

namespace App\Services;

use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalMemberModel;
use App\Models\Proposal\PmwProposalAssignmentModel;
use App\Models\Guidance\PmwGuidanceLogbookModel;
use App\Models\Activity\PmwActivityLogbookModel;
use App\Models\Milestone\PmwReportModel;
use App\Models\PmwDocumentModel;
use App\Models\AnnouncementFunding\PmwBankAccountModel;

class PmwMonitoringService
{
    protected $proposalModel;
    protected $memberModel;
    protected $assignmentModel;
    protected $guidanceLogbookModel;
    protected $activityLogbookModel;
    protected $reportModel;
    protected $documentModel;
    protected $bankAccountModel;

    public function __construct()
    {
        $this->proposalModel = new PmwProposalModel();
        $this->memberModel = new PmwProposalMemberModel();
        $this->assignmentModel = new PmwProposalAssignmentModel();
        $this->guidanceLogbookModel = new PmwGuidanceLogbookModel();
        $this->activityLogbookModel = new PmwActivityLogbookModel();
        $this->reportModel = new PmwReportModel();
        $this->documentModel = new PmwDocumentModel();
        $this->bankAccountModel = new PmwBankAccountModel();
    }

    /**
     * Get list of teams for a specific lecturer
     */
    public function getTeamsByLecturer(int $lecturerId)
    {
        return $this->proposalModel->select([
                'pmw_proposals.id as proposal_id',
                'pmw_proposals.nama_usaha',
                'pmw_proposals.kategori_usaha',
                'pmw_proposals.kategori_wirausaha',
                'pmw_proposals.status',
                'pm.nama as ketua_nama',
                'pm.nim as ketua_nim',
                '(SELECT COUNT(*) FROM pmw_guidance_schedules gs 
                  JOIN pmw_guidance_logbooks gl ON gl.schedule_id = gs.id 
                  WHERE gs.proposal_id = pmw_proposals.id AND gs.type = "bimbingan" AND gl.status = "approved") as total_bimbingan',
                '(SELECT COUNT(*) FROM pmw_guidance_schedules gs 
                  JOIN pmw_guidance_logbooks gl ON gl.schedule_id = gs.id 
                  WHERE gs.proposal_id = pmw_proposals.id AND gs.type = "mentoring" AND gl.status = "approved") as total_mentoring',
                '(SELECT COUNT(*) FROM pmw_activity_schedules pas 
                  JOIN pmw_activity_logbooks pal ON pal.schedule_id = pas.id 
                  WHERE pas.proposal_id = pmw_proposals.id AND pal.status = "approved") as total_kegiatan',
                '(SELECT status FROM pmw_reports WHERE proposal_id = pmw_proposals.id AND type = "kemajuan" ORDER BY created_at DESC LIMIT 1) as kemajuan_status',
                '(SELECT status FROM pmw_reports WHERE proposal_id = pmw_proposals.id AND type = "akhir" ORDER BY created_at DESC LIMIT 1) as akhir_status',
            ])
            ->join('pmw_proposal_members pm', 'pm.proposal_id = pmw_proposals.id AND pm.role = "ketua"', 'left')
            ->join('pmw_proposal_assignments pa', 'pa.proposal_id = pmw_proposals.id')
            ->where('pa.lecturer_id', $lecturerId)
            ->findAll();
    }

    /**
     * Get list of teams for a specific mentor
     */
    public function getTeamsByMentor(int $mentorId)
    {
        return $this->proposalModel->select([
                'pmw_proposals.id as proposal_id',
                'pmw_proposals.nama_usaha',
                'pmw_proposals.kategori_usaha',
                'pmw_proposals.kategori_wirausaha',
                'pmw_proposals.status',
                'pm.nama as ketua_nama',
                'pm.nim as ketua_nim',
                '(SELECT COUNT(*) FROM pmw_guidance_schedules gs 
                  JOIN pmw_guidance_logbooks gl ON gl.schedule_id = gs.id 
                  WHERE gs.proposal_id = pmw_proposals.id AND gs.type = "bimbingan" AND gl.status = "approved") as total_bimbingan',
                '(SELECT COUNT(*) FROM pmw_guidance_schedules gs 
                  JOIN pmw_guidance_logbooks gl ON gl.schedule_id = gs.id 
                  WHERE gs.proposal_id = pmw_proposals.id AND gs.type = "mentoring" AND gl.status = "approved") as total_mentoring',
                '(SELECT COUNT(*) FROM pmw_activity_schedules pas 
                  JOIN pmw_activity_logbooks pal ON pal.schedule_id = pas.id 
                  WHERE pas.proposal_id = pmw_proposals.id AND pal.status = "approved") as total_kegiatan',
                '(SELECT status FROM pmw_reports WHERE proposal_id = pmw_proposals.id AND type = "kemajuan" ORDER BY created_at DESC LIMIT 1) as kemajuan_status',
                '(SELECT status FROM pmw_reports WHERE proposal_id = pmw_proposals.id AND type = "akhir" ORDER BY created_at DESC LIMIT 1) as akhir_status',
            ])
            ->join('pmw_proposal_members pm', 'pm.proposal_id = pmw_proposals.id AND pm.role = "ketua"', 'left')
            ->join('pmw_proposal_assignments pa', 'pa.proposal_id = pmw_proposals.id')
            ->where('pa.mentor_id', $mentorId)
            ->findAll();
    }

    /**
     * Get comprehensive summary for a single team
     */
    public function getTeamSummary(int $proposalId)
    {
        $proposal = $this->proposalModel->getProposalForValidation($proposalId);
        if (!$proposal) return null;

        return [
            'proposal' => $proposal,
            'members' => $this->memberModel->getByProposalId($proposalId),
            'bankAccount' => $this->bankAccountModel->findByProposal($proposalId),
            'documents' => $this->documentModel->getProposalDocs($proposalId),
            'guidanceLogs' => $this->guidanceLogbookModel->select('pmw_guidance_logbooks.*, gs.type, gs.schedule_date, gs.topic')
                ->join('pmw_guidance_schedules gs', 'gs.id = pmw_guidance_logbooks.schedule_id')
                ->where('gs.proposal_id', $proposalId)
                ->orderBy('gs.schedule_date', 'DESC')
                ->findAll(),
            'activityLogs' => $this->activityLogbookModel->select('pmw_activity_logbooks.*, pas.activity_category, pas.activity_date')
                ->join('pmw_activity_schedules pas', 'pas.id = pmw_activity_logbooks.schedule_id')
                ->where('pas.proposal_id', $proposalId)
                ->orderBy('pas.activity_date', 'DESC')
                ->findAll(),
            'milestoneReports' => $this->reportModel->where('proposal_id', $proposalId)->findAll(),
            'assignment' => $this->assignmentModel->where('proposal_id', $proposalId)->first()
        ];
    }
}
