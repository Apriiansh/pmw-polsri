<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Services\PmwMonitoringService;
use App\Models\LecturerModel;

class MonitoringController extends BaseController
{
    protected $monitoringService;
    protected $lecturerModel;

    public function __construct()
    {
        $this->monitoringService = new PmwMonitoringService();
        $this->lecturerModel = new LecturerModel();
    }

    /**
     * Dashboard Monitoring for Dosen
     */
    public function index()
    {
        $lecturer = $this->lecturerModel->getByUserId(user_id());
        if (!$lecturer) {
            return redirect()->to('dashboard')->with('error', 'Profil dosen tidak ditemukan');
        }

        $teams = $this->monitoringService->getTeamsByLecturer($lecturer['id']);

        $data = [
            'title' => 'Monitoring Tim | PMW Polsri',
            'header_title' => 'Monitoring Tim Pendampingan',
            'header_subtitle' => 'Pantau kemajuan seluruh tim yang Anda dampingi',
            'teams' => $teams,
            'lecturer' => $lecturer
        ];

        return view('dosen/monitoring/index', $data);
    }

    /**
     * Detail Progress for a single team
     */
    public function detail(int $proposalId)
    {
        $lecturer = $this->lecturerModel->getByUserId(user_id());
        $summary = $this->monitoringService->getTeamSummary($proposalId);

        if (!$summary || $summary['assignment']['lecturer_id'] != $lecturer['id']) {
            return redirect()->to('dosen/monitoring')->with('error', 'Tim tidak ditemukan atau Anda tidak memiliki akses');
        }

        $data = array_merge($summary, [
            'title' => 'Detail Monitoring | ' . $summary['proposal']['nama_usaha'],
            'header_title' => 'Monitoring Detail',
            'header_subtitle' => $summary['proposal']['nama_usaha'],
        ]);

        return view('dosen/monitoring/detail', $data);
    }
}
