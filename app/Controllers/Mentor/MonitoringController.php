<?php

namespace App\Controllers\Mentor;

use App\Controllers\BaseController;
use App\Services\PmwMonitoringService;
use App\Models\MentorModel;

class MonitoringController extends BaseController
{
    protected $monitoringService;
    protected $mentorModel;

    public function __construct()
    {
        $this->monitoringService = new PmwMonitoringService();
        $this->mentorModel = new MentorModel();
    }

    /**
     * Dashboard Monitoring for Mentor
     */
    public function index()
    {
        $mentor = $this->mentorModel->getByUserId(user_id());
        if (!$mentor) {
            return redirect()->to('dashboard')->with('error', 'Profil mentor tidak ditemukan');
        }

        $teams = $this->monitoringService->getTeamsByMentor($mentor['id']);

        $data = [
            'title' => 'Monitoring Tim | PMW Polsri',
            'header_title' => 'Monitoring Tim Mentoring',
            'header_subtitle' => 'Pantau kemajuan bisnis seluruh tim yang Anda bimbing',
            'teams' => $teams,
            'mentor' => $mentor
        ];

        return view('mentor/monitoring/index', $data);
    }

    /**
     * Detail Progress for a single team
     */
    public function detail(int $proposalId)
    {
        $mentor = $this->mentorModel->getByUserId(user_id());
        $summary = $this->monitoringService->getTeamSummary($proposalId);

        if (!$summary || $summary['assignment']['mentor_id'] != $mentor['id']) {
            return redirect()->to('mentor/monitoring')->with('error', 'Tim tidak ditemukan atau Anda tidak memiliki akses');
        }

        $data = array_merge($summary, [
            'title' => 'Detail Monitoring | ' . $summary['proposal']['nama_usaha'],
            'header_title' => 'Monitoring Detail',
            'header_subtitle' => $summary['proposal']['nama_usaha'],
        ]);

        return view('mentor/monitoring/detail', $data);
    }
}
