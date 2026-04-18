<?php

namespace App\Controllers\Mahasiswa;

use App\Controllers\BaseController;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalAssignmentModel;
use App\Models\Guidance\PmwGuidanceScheduleModel;
use App\Models\Guidance\PmwGuidanceLogbookModel;
use App\Models\PmwPeriodModel;
use App\Models\NotificationModel;
use App\Services\PmwGuidanceService;
use CodeIgniter\HTTP\ResponseInterface;

class GuidanceController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];
    protected $guidanceService;
    protected $proposalModel;
    protected $periodModel;

    public function __construct()
    {
        $this->guidanceService = new PmwGuidanceService();
        $this->proposalModel   = new PmwProposalModel();
        $this->periodModel     = new PmwPeriodModel();
    }

    /**
     * Logbook Bimbingan — jadwal dari Dosen Pendamping (type='bimbingan')
     */
    public function bimbingan(): string|ResponseInterface
    {
        return $this->renderGuidancePage('bimbingan');
    }

    /**
     * Logbook Mentoring — jadwal dari Mentor Praktisi (type='mentoring')
     */
    public function mentoring(): string|ResponseInterface
    {
        return $this->renderGuidancePage('mentoring');
    }

    /**
     * Core renderer shared by bimbingan() and mentoring().
     * Filters schedules by type and passes contextual labels to the view.
     */
    private function renderGuidancePage(string $type): string|ResponseInterface
    {
        $user         = auth()->user();
        $activePeriod = $this->periodModel->where('is_active', true)->first();

        if (!$activePeriod) {
            return redirect()->to('dashboard')->with('error', 'Periode aktif tidak ditemukan.');
        }

        $proposal = $this->proposalModel->findByPeriodAndLeader($activePeriod['id'], $user->id);

        if (!$proposal) {
            return redirect()->to('dashboard')->with('error', 'Proposal tidak ditemukan atau Anda bukan ketua tim.');
        }

        $scheduleModel = new PmwGuidanceScheduleModel();
        $schedules     = $scheduleModel->getSchedulesByProposal($proposal['id'], $type);

        // Attach logbook entry to each schedule
        $logbookModel = new PmwGuidanceLogbookModel();
        foreach ($schedules as $schedule) {
            $schedule->logbook = $logbookModel->getBySchedule($schedule->id);
        }

        // Context-aware labels for the view
        $context = $type === 'bimbingan'
            ? [
                'title'          => 'Logbook Bimbingan PMW',
                'subtitle'       => 'Tahap 8 — Pantau jadwal dan isi logbook sesi bimbingan Dosen Pendamping',
                'heading_accent' => 'Bimbingan',
                'icon'           => 'fa-chalkboard-user',
                'color'          => 'sky',
                'person_label'   => 'Dosen Pendamping',
                'person_key'     => 'dosen_nama',
                'person_desc'    => 'Memberikan arahan akademik dan teknis selama program PMW.',
                'route_logbook'  => 'mahasiswa/bimbingan/logbook',
                'route_file'     => 'mahasiswa/bimbingan/file',
                'empty_msg'      => 'Belum ada jadwal bimbingan dari Dosen Pendamping.',
            ]
            : [
                'title'          => 'Logbook Mentoring PMW',
                'subtitle'       => 'Tahap 8 — Pantau jadwal dan isi logbook sesi mentoring Mentor Praktisi',
                'heading_accent' => 'Mentoring',
                'icon'           => 'fa-handshake-angle',
                'color'          => 'amber',
                'person_label'   => 'Mentor Praktisi',
                'person_key'     => 'mentor_nama',
                'person_desc'    => 'Memberikan panduan praktis dunia industri dan kewirausahaan.',
                'route_logbook'  => 'mahasiswa/mentoring/logbook',
                'route_file'     => 'mahasiswa/mentoring/file',
                'empty_msg'      => 'Belum ada jadwal mentoring dari Mentor Praktisi.',
            ];

        // Compute summary stats
        $statsTotal    = count($schedules);
        $statsLogbook  = 0;
        $statsVerified = 0;
        foreach ($schedules as $s) {
            if ($s->logbook) {
                $statsLogbook++;
                if ($s->logbook->status === 'approved') {
                    $statsVerified++;
                }
            }
        }

        return view('mahasiswa/guidance/index', [
            'title'         => $context['title'] . ' | PMW Polsri',
            'proposal'      => $proposal,
            'schedules'     => $schedules,
            'type'          => $type,
            'context'       => $context,
            'statsTotal'    => $statsTotal,
            'statsLogbook'  => $statsLogbook,
            'statsVerified' => $statsVerified,
        ]);
    }

    /**
     * Submit or update a logbook entry for a given schedule.
     * Notifies the responsible Dosen/Mentor upon submission.
     */
    public function submitLogbook(int $scheduleId): ResponseInterface
    {
        try {
            $data  = $this->request->getPost();
            $files = [
                'photo_activity'  => $this->request->getFile('photo_activity'),
                'assignment_file' => $this->request->getFile('assignment_file'),
                'nota_file'       => $this->request->getFile('nota_file'),
            ];

            // Filter out missing/invalid files
            $files = array_filter($files, fn($f) => $f && $f->isValid() && !$f->hasMoved());

            $this->guidanceService->submitLogbook($scheduleId, $data, $files);

            // Notify the verifier (Dosen or Mentor)
            $scheduleModel = new PmwGuidanceScheduleModel();
            $schedule      = $scheduleModel->find($scheduleId);
            if ($schedule) {
                $proposal = $this->proposalModel->find($schedule->proposal_id);
                if ($proposal) {
                    $type     = $schedule->type; // 'bimbingan' or 'mentoring'
                    $teamName = $proposal['nama_usaha'] ?? 'Tim';
                    $date     = $schedule->schedule_date;

                    $notifModel = new NotificationModel();

                    if ($type === 'bimbingan') {
                        // Notify the assigned Dosen
                        $assignmentModel = new PmwProposalAssignmentModel();
                        $assignment      = $assignmentModel->where('proposal_id', $schedule->proposal_id)->first();
                        if ($assignment) {
                            $lecturerModel = new \App\Models\LecturerModel();
                            $lecturer      = $lecturerModel->find($assignment['lecturer_id'] ?? $assignment->lecturer_id ?? 0);
                            if ($lecturer && ($lecturer['user_id'] ?? null)) {
                                $notifModel->createLogbookSubmissionNotification(
                                    (int)$lecturer['user_id'],
                                    (string)$teamName,
                                    $date,
                                    'bimbingan'
                                );
                            }
                        }
                    } else {
                        // Notify the assigned Mentor
                        $db = \Config\Database::connect();
                        $mentor = $db->table('pmw_mentors m')
                            ->join('pmw_proposal_mentors pm', 'pm.mentor_id = m.id')
                            ->where('pm.proposal_id', $schedule->proposal_id)
                            ->get()->getRowArray();
                        if ($mentor && ($mentor['user_id'] ?? null)) {
                            $notifModel->createLogbookSubmissionNotification(
                                (int)$mentor['user_id'],
                                (string)$teamName,
                                $date,
                                'mentoring'
                            );
                        }
                    }
                }
            }

            return redirect()->back()->with('success', 'Logbook berhasil dikirim.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Securely serve logbook files. Only the team leader can access their own files.
     */
    public function viewFile(string $fileType, int $logbookId): ResponseInterface
    {
        $logbookModel = new PmwGuidanceLogbookModel();
        $logbook      = $logbookModel->find($logbookId);

        if (!$logbook) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        $scheduleModel = new PmwGuidanceScheduleModel();
        $schedule      = $scheduleModel->find(is_array($logbook) ? ($logbook['schedule_id'] ?? 0) : $logbook->schedule_id);

        if (!$schedule) {
            return $this->response->setStatusCode(404)->setBody('Jadwal tidak ditemukan.');
        }

        $proposal = $this->proposalModel->find(is_array($schedule) ? ($schedule['proposal_id'] ?? 0) : $schedule->proposal_id);
        if (!$proposal || (int)($proposal['leader_user_id'] ?? 0) !== (int)auth()->id()) {
            return $this->response->setStatusCode(403)->setBody('Akses ditolak.');
        }

        $filePath = match ($fileType) {
            'photo'      => is_array($logbook) ? ($logbook['photo_activity'] ?? '') : $logbook->photo_activity,
            'assignment' => is_array($logbook) ? ($logbook['assignment_file'] ?? '') : $logbook->assignment_file,
            'nota'       => is_array($logbook) ? ($logbook['nota_file'] ?? '') : $logbook->nota_file,
            default      => ''
        };

        if (empty($filePath)) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        $absPath = WRITEPATH . 'uploads/' . $filePath;

        if (!is_file($absPath)) {
            return $this->response->setStatusCode(404)->setBody('File fisik tidak ditemukan.');
        }

        $mimeType = mime_content_type($absPath) ?: 'application/octet-stream';
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($absPath) . '"')
            ->setBody(file_get_contents($absPath));
    }
}
