<?php

namespace App\Controllers;

use App\Models\PmwPeriodModel;
use App\Models\PortalAnnouncementModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Guidance\PmwGuidanceLogbookModel;
use App\Models\Activity\PmwActivityLogbookModel;
use App\Models\LecturerModel;
use App\Models\MentorModel;
use App\Models\ReviewerModel;
use App\Models\NotificationModel;

class Dashboard extends BaseController
{
    protected $periodModel;
    protected $proposalModel;
    protected $activePeriod;

    public function __construct()
    {
        $this->periodModel = new PmwPeriodModel();
        $this->proposalModel = new PmwProposalModel();
        $this->activePeriod = $this->periodModel->getActive();
    }

    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->to('login');
        }

        $groups = $user->getGroups();
        $mainRole = $groups[0] ?? 'visitor';
        $userId = $user->id;

        // Fetch real notifications and announcements for the updates section
        $notificationModel = new NotificationModel();
        $announcementModel = new PortalAnnouncementModel();

        $unreadNotifications = $notificationModel->getUnread($userId, 5);
        $recentAnnouncements = $announcementModel->where('is_published', 1)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->find();

        $updates = [];
        $updatesRaw = [];

        // Map Announcements
        foreach ($recentAnnouncements as $ann) {
            $updatesRaw[] = [
                'type' => 'announcement',
                'title' => $ann['title'],
                'desc' => strip_tags(mb_strimwidth($ann['content'], 0, 80, "...")),
                'time' => date('d M Y', strtotime($ann['created_at'])),
                '_ts'  => strtotime($ann['created_at']),
                'icon' => 'fa-bullhorn',
                'color' => 'text-violet-500 bg-violet-50',
                'url' => 'pengumuman/' . $ann['slug']
            ];
        }

        // Map Notifications
        foreach ($unreadNotifications as $notif) {
            $updatesRaw[] = [
                'type' => 'notification',
                'title' => $notif['title'],
                'desc' => $notif['message'],
                'time' => $this->timeAgo($notif['created_at']),
                '_ts'  => strtotime($notif['created_at']),
                'icon' => 'fa-bell',
                'color' => 'text-sky-500 bg-sky-50',
                'url' => $notif['link'] ?: 'notifications'
            ];
        }

        // Sort by newest first, take top 5
        usort($updatesRaw, fn($a, $b) => $b['_ts'] - $a['_ts']);
        $updates = array_slice($updatesRaw, 0, 5);

        $data = $this->getRoleData($mainRole, $userId);
        $data['title'] = 'Dashboard | PMW Polsri';
        $data['mainRole'] = $mainRole;
        $data['activePeriod'] = $this->activePeriod;
        $data['updates'] = $updates;

        return view('dashboard/index', $data);
    }

    private function timeAgo($timestamp)
    {
        $time = strtotime($timestamp);
        $diff = time() - $time;
        
        if ($diff < 60) return 'Baru saja';
        if ($diff < 3600) return round($diff / 60) . ' menit lalu';
        if ($diff < 86400) return round($diff / 3600) . ' jam lalu';
        return date('d M Y', $time);
    }

    private function getRoleData(string $role, int $userId): array
    {
        return match ($role) {
            'admin'     => $this->getAdminData(),
            'mahasiswa' => $this->getMahasiswaData($userId),
            'reviewer'  => $this->getReviewerData($userId),
            'dosen'     => $this->getDosenData($userId),
            'mentor'    => $this->getMentorData($userId),
            default     => $this->getDefaultData(),
        };
    }

    private function getAdminData(): array
    {
        $periodId = $this->activePeriod['id'] ?? 0;
        
        // Stats Calculation
        $totalProposals = $this->proposalModel->where('period_id', $periodId)->countAllResults();
        $approvedProposals = $this->proposalModel->where('period_id', $periodId)->where('status', 'approved')->countAllResults();
        $totalBudget = $this->proposalModel->where('period_id', $periodId)->where('status', 'approved')->selectSum('total_rab')->first()['total_rab'] ?? 0;
        
        $successRate = $totalProposals > 0 ? round(($approvedProposals / $totalProposals) * 100, 1) : 0;

        // Map pitching desk antrean for view
        $db = \Config\Database::connect();
        $rawPitching = $db->table('pmw_proposals p')
            ->select([
                'p.id', 'p.nama_usaha', 'p.kategori_wirausaha', 'p.created_at',
                'pm.nama as ketua_nama',
                'sp.admin_status as pitching_admin_status',
                'sp.student_submitted_at',
            ])
            ->join('pmw_selection_pitching sp', 'sp.proposal_id = p.id')
            ->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left')
            ->where('sp.student_submitted_at IS NOT NULL')
            ->whereIn('sp.admin_status', ['pending', 'revision'])
            ->orderBy('sp.student_submitted_at', 'ASC')
            ->limit(5)
            ->get()->getResultArray();

        $mappedProposals = array_map(function($p) {
            $statusLabel = match($p['pitching_admin_status']) {
                'revision' => 'Revisi',
                default    => 'Review',
            };
            return [
                'id'       => 'PTK-' . str_pad($p['id'], 3, '0', STR_PAD_LEFT),
                'team'     => $p['nama_usaha'] ?: ($p['ketua_nama'] ?? '-'),
                'category' => ucfirst($p['kategori_wirausaha'] ?? '-'),
                'progress' => 40,
                'status'   => $statusLabel,
                'date'     => date('d M Y', strtotime($p['student_submitted_at'])),
            ];
        }, $rawPitching);

        return [
            'header_title'    => 'Overview Analytics',
            'header_subtitle' => 'Sistem Informasi PMW Polsri &bull; Periode ' . ($this->activePeriod['year'] ?? date('Y')),
            'stats' => [
                [
                    'title' => 'Total Estimasi Pendanaan', 
                    'value' => 'Rp ' . number_format($totalBudget, 0, ',', '.'), 
                    'icon' => 'fa-wallet', 
                    'trend' => 'Periode Aktif', 
                    'trend_up' => null, 
                    'bg' => 'bg-sky-50', 
                    'icon_color' => 'text-sky-500', 
                    'span' => 'col-span-1 md:col-span-2'
                ],
                [
                    'title' => 'Tim Lolos Seleksi', 
                    'value' => $approvedProposals, 
                    'icon' => 'fa-users-gear', 
                    'trend' => 'Terverifikasi', 
                    'trend_up' => true, 
                    'bg' => 'bg-teal-50', 
                    'icon_color' => 'text-teal-500', 
                    'span' => 'col-span-1'
                ],
                [
                    'title' => 'Butuh Review', 
                    'value' => $db->table('pmw_selection_pitching')->where('student_submitted_at IS NOT NULL')->where('admin_status', 'pending')->countAllResults(), 
                    'icon' => 'fa-clock-rotate-left', 
                    'trend' => 'Antrean Pitching', 
                    'trend_up' => false, 
                    'bg' => 'bg-emerald-50', 
                    'icon_color' => 'text-emerald-500', 
                    'span' => 'col-span-1'
                ],
            ],
            'proposals' => $mappedProposals,
            'quickActions' => [
                ['url' => 'admin/pitching-desk', 'icon' => 'fa-file-shield', 'label' => 'Antrean Pitching', 'style' => 'btn-outline'],
                ['url' => 'admin/users', 'icon' => 'fa-users-gear', 'label' => 'Manajemen User', 'style' => 'btn-accent'],
                ['url' => 'admin/cms', 'icon' => 'fa-newspaper', 'label' => 'Kelola Konten (CMS)', 'style' => 'btn-primary'],
            ],
            'tableTitle'    => 'Antrean Pitching Desk',
            'tableSubtitle' => 'Tim yang sudah kirim berkas administrasi & desk evaluation',
        ];
    }

    private function getTeamProgress($proposalId): array
    {
        $db = \Config\Database::connect();
        $progress = 10;
        $stage = 'Proposal';

        // 2. Pitching
        $pitching = $db->table('pmw_selection_pitching')
            ->where('proposal_id', $proposalId)
            ->where('admin_status', 'approved')
            ->get()->getRowArray();
        if ($pitching) {
            $progress = 25;
            $stage = 'Pitching';
        }

        // 3. Perjanjian (Finalization)
        $final = $db->table('pmw_selection_finalization')
            ->where('proposal_id', $proposalId)
            ->where('admin_status', 'approved')
            ->get()->getRowArray();
        if ($final) {
            $progress = 40;
            $stage = 'Perjanjian';
        }

        // 4. Pembekalan
        $training = $db->table('pmw_training_reports')
            ->where('proposal_id', $proposalId)
            ->get()->getRowArray();
        if ($training) {
            $progress = 55;
            $stage = 'Pembekalan';
        }

        // 5. Implementasi
        $impl = $db->table('pmw_selection_implementasi')
            ->where('proposal_id', $proposalId)
            ->where('admin_status', 'approved')
            ->get()->getRowArray();
        if ($impl) {
            $progress = 70;
            $stage = 'Implementasi';
        }

        // 6. Bimbingan & Mentoring (Check activity logbooks)
        $activities = $db->table('pmw_activity_logbooks al')
            ->join('pmw_activity_schedules pas', 'pas.id = al.schedule_id')
            ->where('pas.proposal_id', $proposalId)
            ->countAllResults();
        if ($activities > 0) {
            $progress = 85;
            $stage = 'Kegiatan Wirausaha';
        }

        // 7. Awarding Expo
        $expo = $db->table('pmw_expo_submissions')
            ->where('proposal_id', $proposalId)
            ->get()->getRowArray();
        if ($expo) {
            $progress = 100;
            $stage = 'Awarding Expo';
        }

        return ['stage' => $stage, 'progress' => $progress];
    }

    private function getMahasiswaData(int $userId): array
    {
        // Use active period if available
        $periodId = $this->activePeriod['id'] ?? 0;
        $proposal = $this->proposalModel->findByPeriodAndLeader($periodId, $userId);
        
        // Progress Calculation
        $teamProgress = $proposal ? $this->getTeamProgress($proposal['id']) : ['stage' => 'Proposal', 'progress' => 10];
        $statusLabel = $proposal ? match($proposal['status']) {
            'approved' => 'Disetujui',
            'submitted', 'draft' => 'Review',
            'revision' => 'Revisi',
            default => 'Ditolak'
        } : 'Review';

        // Get counts for Bimbingan & Mentoring (Submitted or Approved)
        $db = \Config\Database::connect();
        $bimbinganCount = 0;
        $mentoringCount = 0;
        
        if ($proposal) {
            $bimbinganCount = $db->table('pmw_guidance_logbooks gl')
                ->join('pmw_guidance_schedules gs', 'gs.id = gl.schedule_id')
                ->where('gs.proposal_id', $proposal['id'])
                ->where('gs.type', 'bimbingan')
                ->whereIn('gl.status', ['pending', 'approved'])
                ->countAllResults();

            $mentoringCount = $db->table('pmw_guidance_logbooks gl')
                ->join('pmw_guidance_schedules gs', 'gs.id = gl.schedule_id')
                ->where('gs.proposal_id', $proposal['id'])
                ->where('gs.type', 'mentoring')
                ->whereIn('gl.status', ['pending', 'approved'])
                ->countAllResults();
        }

        $mappedProposals = [];
        if ($proposal) {
            $mappedProposals[] = [
                'id'       => 'PMW-' . str_pad($proposal['id'], 3, '0', STR_PAD_LEFT),
                'team'     => $proposal['nama_usaha'] ?: '(Belum diisi)',
                'category' => ucfirst($proposal['kategori_wirausaha'] ?? '-'),
                'progress' => $teamProgress['progress'],
                'status'   => $statusLabel,
                'date'     => date('d M Y', strtotime($proposal['created_at']))
            ];
        }

        return [
            'header_title'    => 'Dashboard Tim ' . ($proposal['nama_usaha'] ?? 'Saya'),
            'header_subtitle' => 'Pantau progres dan kelola kegiatan tim Anda',
            'stats' => [
                ['title' => 'Tahapan Saat Ini', 'value' => $teamProgress['stage'], 'icon' => 'fa-bars-progress', 'trend' => $teamProgress['progress'] . '% Selesai', 'trend_up' => true, 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500', 'span' => 'col-span-2 md:col-span-1 lg:col-span-2'],
                ['title' => 'Dosen', 'value' => $bimbinganCount . 'x', 'icon' => 'fa-chalkboard-user', 'trend' => 'Bimbingan', 'trend_up' => null, 'bg' => 'bg-indigo-50', 'icon_color' => 'text-indigo-500', 'span' => 'col-span-1'],
                ['title' => 'Mentor', 'value' => $mentoringCount . 'x', 'icon' => 'fa-user-tie', 'trend' => 'Mentoring', 'trend_up' => null, 'bg' => 'bg-amber-50', 'icon_color' => 'text-amber-500', 'span' => 'col-span-1'],
            ],
            'proposals' => $mappedProposals,
            'quickActions' => [
                ['url' => 'mahasiswa/pitching-desk', 'icon' => 'fa-file-shield', 'label' => 'Pitching Desk', 'style' => 'btn-outline'],
                ['url' => 'mahasiswa/bimbingan', 'icon' => 'fa-chalkboard-user', 'label' => 'Catat Bimbingan', 'style' => 'btn-primary'],
                ['url' => 'mahasiswa/mentoring', 'icon' => 'fa-user-tie', 'label' => 'Catat Mentoring', 'style' => 'btn-accent'],
            ],
            'tableTitle'    => 'Status PMW',
            'tableSubtitle' => 'Ringkasan progres keseluruhan program wirausaha',
        ];
    }

    private function getDosenData(int $userId): array
    {
        $lecturerModel = new LecturerModel();
        $lecturer = $lecturerModel->getByUserId($userId);
        
        $rawProposals = [];
        $pendingLogs = 0;
        $totalTeams = 0;
        $totalRab = 0;
        $bestStage = 'Proposal';
        $bestProgress = 10;

        if ($lecturer) {
            $rawProposals = $this->proposalModel->getProposalsByLecturer($lecturer['id']);
            $totalTeams = count($rawProposals);
            
            $db = \Config\Database::connect();
            foreach ($rawProposals as $p) {
                $totalRab += ($p['total_rab'] ?? 0);
                
                // Track best progress
                $pProgress = $this->getTeamProgress($p['id']);
                if ($pProgress['progress'] > $bestProgress) {
                    $bestProgress = $pProgress['progress'];
                    $bestStage = $pProgress['stage'];
                }

                $pendingLogs += $db->table('pmw_guidance_logbooks gl')
                    ->join('pmw_guidance_schedules gs', 'gs.id = gl.schedule_id')
                    ->where('gs.proposal_id', $p['id'])
                    ->where('gl.status', 'pending')
                    ->countAllResults();
            }
        }

        $mappedProposals = array_map(function($p) {
            $pProgress = $this->getTeamProgress($p['id']);
            $statusLabel = match($p['status']) {
                'approved' => 'Disetujui',
                'submitted', 'draft' => 'Review',
                'revision' => 'Revisi',
                default => 'Ditolak'
            };

            return [
                'id'       => 'TIM-' . str_pad($p['id'], 3, '0', STR_PAD_LEFT),
                'team'     => $p['nama_usaha'],
                'leader'   => $p['ketua_nama'] ?? '-',
                'category' => $p['kategori_usaha'] ?? 'Umum',
                'progress' => $pProgress['progress'],
                'status'   => $statusLabel,
                'date'     => $pProgress['stage']
            ];
        }, array_slice($rawProposals, 0, 5));

        return [
            'header_title'    => 'Dashboard Dosen Pembimbing',
            'header_subtitle' => 'Monitoring dan validasi mahasiswa bimbingan',
            'stats' => [
                ['title' => 'Progress Terjauh', 'value' => $bestStage, 'icon' => 'fa-map-location-dot', 'trend' => $bestProgress . '% Selesai', 'trend_up' => true, 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500', 'span' => 'col-span-1'],
                ['title' => 'Logbook Pending', 'value' => $pendingLogs, 'icon' => 'fa-clipboard-question', 'trend' => 'Perlu validasi', 'trend_up' => null, 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500', 'span' => 'col-span-1'],
                ['title' => 'Total RAB Bimbingan', 'value' => 'Rp ' . number_format($totalRab, 0, ',', '.'), 'icon' => 'fa-wallet', 'trend' => $totalTeams . ' Tim Aktif', 'trend_up' => null, 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500', 'span' => 'col-span-1 md:col-span-2'],
            ],
            'proposals' => $mappedProposals,
            'quickActions' => [
                ['url' => 'dosen/monitoring', 'icon' => 'fa-users-viewfinder', 'label' => 'Monitoring Tim', 'style' => 'btn-accent'],
                ['url' => 'dosen/validasi', 'icon' => 'fa-signature', 'label' => 'Validasi Logbook', 'style' => 'btn-outline'],
            ],
            'tableTitle'    => 'Daftar Tim Bimbingan',
            'tableSubtitle' => 'Progress tim yang berada di bawah bimbingan Anda',
        ];
    }

    private function getReviewerData(int $userId): array
    {
        // Simple mock for now as reviewer assignment is complex
        return [
            'header_title'    => 'Dashboard Penilaian',
            'header_subtitle' => 'Kelola penilaian proposal mahasiswa',
            'stats' => [
                ['title' => 'Proposal Pending', 'value' => '0', 'icon' => 'fa-clipboard-list', 'trend' => 'Menunggu', 'trend_up' => null, 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500', 'span' => 'col-span-1'],
                ['title' => 'Sudah Dinilai', 'value' => '0', 'icon' => 'fa-clipboard-check', 'trend' => 'Bulan ini', 'trend_up' => null, 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500', 'span' => 'col-span-1'],
            ],
            'proposals' => [],
            'activities' => [],
            'quickActions' => [
                ['url' => 'reviewer/penilaian-proposal', 'icon' => 'fa-clipboard-check', 'label' => 'Nilai Proposal', 'style' => 'btn-accent'],
            ],
            'tableTitle'    => 'Antrean Penilaian',
            'tableSubtitle' => 'Proposal yang menunggu review Anda',
        ];
    }

    private function getMentorData(int $userId): array
    {
        $mentorModel = new MentorModel();
        $mentor = $mentorModel->where('user_id', $userId)->first();
        
        $rawProposals = [];
        $totalTeams = 0;
        $totalRab = 0;
        $bestStage = 'Proposal';
        $bestProgress = 10;

        if ($mentor) {
            $rawProposals = $this->proposalModel->getProposalsByMentor($mentor['id']);
            $totalTeams = count($rawProposals);
            foreach ($rawProposals as $p) {
                $totalRab += ($p['total_rab'] ?? 0);
                
                // Track best progress
                $pProgress = $this->getTeamProgress($p['id']);
                if ($pProgress['progress'] > $bestProgress) {
                    $bestProgress = $pProgress['progress'];
                    $bestStage = $pProgress['stage'];
                }
            }
        }

        $mappedProposals = array_map(function($p) {
            $pProgress = $this->getTeamProgress($p['id']);
            $statusLabel = match($p['status']) {
                'approved' => 'Disetujui',
                'submitted', 'draft' => 'Review',
                'revision' => 'Revisi',
                default => 'Ditolak'
            };

            return [
                'id'       => 'TIM-' . str_pad($p['id'], 3, '0', STR_PAD_LEFT),
                'team'     => $p['nama_usaha'],
                'leader'   => $p['ketua_nama'] ?? '-',
                'category' => $p['kategori_usaha'] ?? 'Umum',
                'progress' => $pProgress['progress'],
                'status'   => $statusLabel,
                'date'     => $pProgress['stage']
            ];
        }, array_slice($rawProposals, 0, 5));

        return [
            'header_title'    => 'Dashboard Mentor',
            'header_subtitle' => 'Bimbingan dan pendampingan tim kewirausahaan',
            'stats' => [
                ['title' => 'Progress Terjauh', 'value' => $bestStage, 'icon' => 'fa-map-location-dot', 'trend' => $bestProgress . '% Selesai', 'trend_up' => true, 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500', 'span' => 'col-span-1'],
                ['title' => 'Total RAB Tim', 'value' => 'Rp ' . number_format($totalRab, 0, ',', '.'), 'icon' => 'fa-wallet', 'trend' => 'Estimasi', 'trend_up' => null, 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500', 'span' => 'col-span-1 md:col-span-2'],
                ['title' => 'Periode Program', 'value' => ($this->activePeriod['year'] ?? date('Y')), 'icon' => 'fa-calendar-check', 'trend' => $totalTeams . ' Tim Dampingan', 'trend_up' => null, 'bg' => 'bg-violet-50', 'icon_color' => 'text-violet-500', 'span' => 'col-span-1'],
            ],
            'proposals' => $mappedProposals,
            'quickActions' => [
                ['url' => 'mentor/monitoring', 'icon' => 'fa-users-viewfinder', 'label' => 'Monitoring Tim', 'style' => 'btn-accent'],
            ],
            'tableTitle'    => 'Daftar Tim Mentor',
            'tableSubtitle' => 'Progress tim yang Anda dampingi',
        ];
    }

    private function getDefaultData(): array
    {
        return $this->getAdminData();
    }
}
