<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $user = auth()->user();
        $groups = $user ? $user->getGroups() : [];
        $mainRole = $groups[0] ?? 'visitor';

        // Role-specific data preparation
        $roleData = $this->getRoleData($mainRole);

        $data = [
            'title'           => 'Dashboard | PMW Polsri',
            'header_title'    => $roleData['header_title'],
            'header_subtitle' => $roleData['header_subtitle'],
            'mainRole'        => $mainRole,
            'stats'           => $roleData['stats'],
            'proposals'       => $roleData['proposals'] ?? null,
            'activities'      => $roleData['activities'] ?? null,
            'quickActions'    => $roleData['quickActions'] ?? [],
            'tableTitle'      => $roleData['tableTitle'] ?? 'Data Terbaru',
            'tableSubtitle'   => $roleData['tableSubtitle'] ?? '',
        ];

        return view('dashboard/index', $data);
    }

    private function getRoleData(string $role): array
    {
        return match ($role) {
            'admin' => $this->getAdminData(),
            'mahasiswa' => $this->getMahasiswaData(),
            'reviewer' => $this->getReviewerData(),
            'dosen' => $this->getDosenData(),
            'mentor' => $this->getMentorData(),
            default => $this->getDefaultData(),
        };
    }

    private function getAdminData(): array
    {
        return [
            'header_title'    => 'Overview Analytics',
            'header_subtitle' => 'Sistem Informasi PMW Polsri &bull; Periode 2026',
            'stats' => [
                ['title' => 'Total Anggaran Pendanaan', 'value' => 'Rp 450.000.000', 'icon' => 'fa-wallet', 'trend' => '+12.5%', 'trend_up' => true, 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500', 'span' => 'col-span-1 md:col-span-2'],
                ['title' => 'Tim Aktif', 'value' => '124', 'icon' => 'fa-users-gear', 'trend' => '+4 Unit', 'trend_up' => true, 'bg' => 'bg-teal-50', 'icon_color' => 'text-teal-500', 'span' => 'col-span-1'],
                ['title' => 'Success Rate', 'value' => '78%', 'icon' => 'fa-chart-pie', 'trend' => '+2.1%', 'trend_up' => true, 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500', 'span' => 'col-span-1'],
                ['title' => 'Proposal Masuk', 'value' => '58', 'icon' => 'fa-file-circle-plus', 'trend' => 'Semester ini', 'trend_up' => null, 'bg' => 'bg-violet-50', 'icon_color' => 'text-violet-500', 'span' => 'col-span-1'],
                ['title' => 'Proposal Disetujui', 'value' => '45', 'icon' => 'fa-file-circle-check', 'trend' => '77,6%', 'trend_up' => true, 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500', 'span' => 'col-span-1'],
            ],
            'proposals' => [
                ['id' => 'PMW-26-001', 'team' => 'TechNova Solutions', 'category' => 'Teknologi Digital', 'progress' => 100, 'status' => 'Disetujui', 'date' => '12 Apr 2026'],
                ['id' => 'PMW-26-002', 'team' => 'EcoBite Culinary', 'category' => 'Kuliner Kreatif', 'progress' => 45, 'status' => 'Review', 'date' => '10 Apr 2026'],
                ['id' => 'PMW-26-003', 'team' => 'AgroSmart Polsri', 'category' => 'Agrobisnis', 'progress' => 100, 'status' => 'Disetujui', 'date' => '08 Apr 2026'],
            ],
            'activities' => [
                ['icon' => 'fa-file-circle-check', 'color' => 'text-emerald-500 bg-emerald-50', 'text' => 'TechNova Solutions disetujui', 'time' => '2 menit lalu'],
                ['icon' => 'fa-comment-dots', 'color' => 'text-sky-500 bg-sky-50', 'text' => 'Komentar baru pada EcoBite', 'time' => '15 menit lalu'],
                ['icon' => 'fa-rotate', 'color' => 'text-yellow-500 bg-yellow-50', 'text' => 'KriyaLokal diminta revisi', 'time' => '1 jam lalu'],
                ['icon' => 'fa-user-plus', 'color' => 'text-violet-500 bg-violet-50', 'text' => 'Mentor baru ditambahkan', 'time' => '3 jam lalu'],
            ],
            'quickActions' => [
                ['url' => 'admin/users', 'icon' => 'fa-users-gear', 'label' => 'Manajemen User', 'style' => 'btn-accent'],
                ['url' => 'admin/pmw-system', 'icon' => 'fa-calendar-days', 'label' => 'Atur Jadwal PMW', 'style' => 'btn-outline'],
                ['url' => 'admin/laporan', 'icon' => 'fa-file-export', 'label' => 'Ekspor Laporan', 'style' => 'btn-ghost'],
            ],
            'tableTitle'    => 'Proposal Proyek Terbaru',
            'tableSubtitle' => 'Data pengajuan mahasiswa aktif',
        ];
    }

    private function getMahasiswaData(): array
    {
        return [
            'header_title'    => 'Dashboard Tim Saya',
            'header_subtitle' => 'Pantau progress dan status proposal tim Anda',
            'stats' => [
                ['title' => 'Status Proposal', 'value' => 'Review', 'icon' => 'fa-file-invoice', 'trend' => 'Tahap 3', 'trend_up' => null, 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500', 'span' => 'col-span-1 md:col-span-2'],
                ['title' => 'Progress Tim', 'value' => '65%', 'icon' => 'fa-chart-pie', 'trend' => 'On Track', 'trend_up' => true, 'bg' => 'bg-teal-50', 'icon_color' => 'text-teal-500', 'span' => 'col-span-1'],
                ['title' => 'Bimbingan', 'value' => '4x', 'icon' => 'fa-chalkboard-user', 'trend' => 'dari 8x', 'trend_up' => null, 'bg' => 'bg-violet-50', 'icon_color' => 'text-violet-500', 'span' => 'col-span-1'],
                ['title' => 'Mentoring', 'value' => '2x', 'icon' => 'fa-handshake-angle', 'trend' => 'dari 6x', 'trend_up' => null, 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500', 'span' => 'col-span-1'],
                ['title' => 'Deadline', 'value' => '12d', 'icon' => 'fa-calendar-days', 'trend' => 'Pitching Desk', 'trend_up' => false, 'bg' => 'bg-rose-50', 'icon_color' => 'text-rose-500', 'span' => 'col-span-1'],
            ],
            'proposals' => [
                ['id' => 'PROP-001', 'team' => 'Pitching Deck', 'category' => 'Dokumen', 'progress' => 100, 'status' => 'Submitted', 'date' => '10 Apr 2026'],
                ['id' => 'LOG-002', 'team' => 'Log Bimbingan #4', 'category' => 'Bimbingan', 'progress' => 75, 'status' => 'Tervalidasi', 'date' => '08 Apr 2026'],
                ['id' => 'NOTA-003', 'team' => 'Nota Pembelian Alat', 'category' => 'Pendanaan', 'progress' => 50, 'status' => 'Pending', 'date' => '05 Apr 2026'],
            ],
            'activities' => [
                ['icon' => 'fa-circle-check', 'color' => 'text-emerald-500 bg-emerald-50', 'text' => 'Bimbingan ke-4 tervalidasi Dosen', 'time' => '2 jam lalu'],
                ['icon' => 'fa-clock', 'color' => 'text-yellow-500 bg-yellow-50', 'text' => 'Deadline Pitching: 12 hari lagi', 'time' => 'Reminder'],
                ['icon' => 'fa-comment', 'color' => 'text-sky-500 bg-sky-50', 'text' => 'Feedback baru dari Reviewer', 'time' => '1 hari lalu'],
                ['icon' => 'fa-upload', 'color' => 'text-violet-500 bg-violet-50', 'text' => 'Upload Pitching Deck berhasil', 'time' => '2 hari lalu'],
            ],
            'quickActions' => [
                ['url' => 'mahasiswa/proposal', 'icon' => 'fa-file-invoice', 'label' => 'Kelola Proposal', 'style' => 'btn-accent'],
                ['url' => 'mahasiswa/bimbingan', 'icon' => 'fa-chalkboard-user', 'label' => 'Catat Bimbingan', 'style' => 'btn-outline'],
                ['url' => 'mahasiswa/laporan-kemajuan', 'icon' => 'fa-chart-pie', 'label' => 'Upload Laporan', 'style' => 'btn-ghost'],
            ],
            'tableTitle'    => 'Riwayat Dokumen Tim',
            'tableSubtitle' => 'Dokumen yang telah diupload tim Anda',
        ];
    }

    private function getReviewerData(): array
    {
        return [
            'header_title'    => 'Dashboard Penilaian',
            'header_subtitle' => 'Kelola penilaian proposal dan laporan mahasiswa',
            'stats' => [
                ['title' => 'Proposal Pending', 'value' => '12', 'icon' => 'fa-clipboard-list', 'trend' => 'Menunggu', 'trend_up' => null, 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500', 'span' => 'col-span-1'],
                ['title' => 'Sudah Dinilai', 'value' => '28', 'icon' => 'fa-clipboard-check', 'trend' => 'Bulan ini', 'trend_up' => true, 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500', 'span' => 'col-span-1'],
                ['title' => 'Rata-rata Nilai', 'value' => '82.5', 'icon' => 'fa-star', 'trend' => '+3.2', 'trend_up' => true, 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500', 'span' => 'col-span-1'],
                ['title' => 'Laporan Pending', 'value' => '5', 'icon' => 'fa-file-circle-exclamation', 'trend' => 'Monev 1', 'trend_up' => null, 'bg' => 'bg-violet-50', 'icon_color' => 'text-violet-500', 'span' => 'col-span-1'],
            ],
            'proposals' => [
                ['id' => 'PMW-26-015', 'team' => 'GreenTech Innovators', 'category' => 'Teknologi Digital', 'progress' => 0, 'status' => 'Belum Dinilai', 'date' => '12 Apr 2026'],
                ['id' => 'PMW-26-016', 'team' => 'FoodFusion StartUp', 'category' => 'Kuliner Kreatif', 'progress' => 0, 'status' => 'Belum Dinilai', 'date' => '11 Apr 2026'],
                ['id' => 'PMW-26-017', 'team' => 'CraftMaster ID', 'category' => 'Industri Kreatif', 'progress' => 85, 'status' => 'Dinilai', 'date' => '10 Apr 2026'],
            ],
            'activities' => [
                ['icon' => 'fa-clipboard-check', 'color' => 'text-emerald-500 bg-emerald-50', 'text' => 'Selesai menilai CraftMaster ID', 'time' => '30 menit lalu'],
                ['icon' => 'fa-clock', 'color' => 'text-yellow-500 bg-yellow-50', 'text' => '2 proposal baru menunggu penilaian', 'time' => '2 jam lalu'],
                ['icon' => 'fa-star', 'color' => 'text-sky-500 bg-sky-50', 'text' => 'Nilai rata-rata naik 3.2 poin', 'time' => 'Hari ini'],
            ],
            'quickActions' => [
                ['url' => 'reviewer/penilaian-proposal', 'icon' => 'fa-clipboard-check', 'label' => 'Nilai Proposal', 'style' => 'btn-accent'],
                ['url' => 'reviewer/penilaian-laporan', 'icon' => 'fa-file-circle-check', 'label' => 'Nilai Laporan', 'style' => 'btn-outline'],
            ],
            'tableTitle'    => 'Daftar Penilaian Pending',
            'tableSubtitle' => 'Proposal dan laporan yang perlu dinilai',
        ];
    }

    private function getDosenData(): array
    {
        return [
            'header_title'    => 'Dashboard Dosen Pembimbing',
            'header_subtitle' => 'Monitoring dan validasi mahasiswa bimbingan',
            'stats' => [
                ['title' => 'Mahasiswa Bimbingan', 'value' => '8', 'icon' => 'fa-users', 'trend' => '5 tim aktif', 'trend_up' => null, 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500', 'span' => 'col-span-1'],
                ['title' => 'Logbook Pending', 'value' => '3', 'icon' => 'fa-clipboard-question', 'trend' => 'Perlu validasi', 'trend_up' => null, 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500', 'span' => 'col-span-1'],
                ['title' => 'Total Validasi', 'value' => '24', 'icon' => 'fa-check-double', 'trend' => 'Bulan ini', 'trend_up' => true, 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500', 'span' => 'col-span-1'],
                ['title' => 'Progress Rata2', 'value' => '72%', 'icon' => 'fa-chart-line', 'trend' => 'On Track', 'trend_up' => true, 'bg' => 'bg-teal-50', 'icon_color' => 'text-teal-500', 'span' => 'col-span-1'],
            ],
            'proposals' => [
                ['id' => 'TIM-001', 'team' => 'TechNova Solutions', 'category' => 'Progress 85%', 'progress' => 85, 'status' => 'Aktif', 'date' => 'Last: 2 hari lalu'],
                ['id' => 'TIM-002', 'team' => 'EcoBite Culinary', 'category' => 'Progress 45%', 'progress' => 45, 'status' => 'Butuh Validasi', 'date' => '3 logbook pending'],
                ['id' => 'TIM-003', 'team' => 'AgroSmart Polsri', 'category' => 'Progress 100%', 'progress' => 100, 'status' => 'Selesai', 'date' => 'Lolos Monev 1'],
            ],
            'activities' => [
                ['icon' => 'fa-check-circle', 'color' => 'text-emerald-500 bg-emerald-50', 'text' => 'Validasi logbook TechNova', 'time' => '1 jam lalu'],
                ['icon' => 'fa-exclamation-circle', 'color' => 'text-yellow-500 bg-yellow-50', 'text' => '3 logbook EcoBite menunggu', 'time' => '3 jam lalu'],
                ['icon' => 'fa-user-graduate', 'color' => 'text-sky-500 bg-sky-50', 'text' => 'Mahasiswa baru: GreenTech', 'time' => 'Kemarin'],
            ],
            'quickActions' => [
                ['url' => 'dosen/monitoring', 'icon' => 'fa-users-viewfinder', 'label' => 'Monitoring Tim', 'style' => 'btn-accent'],
                ['url' => 'dosen/validasi', 'icon' => 'fa-signature', 'label' => 'Validasi Logbook', 'style' => 'btn-outline'],
            ],
            'tableTitle'    => 'Status Mahasiswa Bimbingan',
            'tableSubtitle' => 'Progress dan logbook tim yang Anda bimbing',
        ];
    }

    private function getMentorData(): array
    {
        return [
            'header_title'    => 'Dashboard Mentor',
            'header_subtitle' => 'Monitoring dan validasi mahasiswa mentoring',
            'stats' => [
                ['title' => 'Mahasiswa Mentoring', 'value' => '5', 'icon' => 'fa-users', 'trend' => '3 tim aktif', 'trend_up' => null, 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500', 'span' => 'col-span-1'],
                ['title' => 'Logbook Pending', 'value' => '2', 'icon' => 'fa-clipboard-question', 'trend' => 'Perlu validasi', 'trend_up' => null, 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500', 'span' => 'col-span-1'],
                ['title' => 'Total Validasi', 'value' => '18', 'icon' => 'fa-check-double', 'trend' => 'Bulan ini', 'trend_up' => true, 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500', 'span' => 'col-span-1'],
                ['title' => 'Sesi Minggu Ini', 'value' => '3', 'icon' => 'fa-calendar-check', 'trend' => 'Terjadwal', 'trend_up' => null, 'bg' => 'bg-violet-50', 'icon_color' => 'text-violet-500', 'span' => 'col-span-1'],
            ],
            'proposals' => [
                ['id' => 'MTR-001', 'team' => 'FoodFusion StartUp', 'category' => 'Kuliner', 'progress' => 60, 'status' => 'Butuh Validasi', 'date' => '2 log pending'],
                ['id' => 'MTR-002', 'team' => 'CraftMaster ID', 'category' => 'Kreatif', 'progress' => 90, 'status' => 'Aktif', 'date' => 'Progress bagus'],
                ['id' => 'MTR-003', 'team' => 'DigitalBiz Team', 'category' => 'Digital', 'progress' => 30, 'status' => 'Perlu Perhatian', 'date' => 'Lambat progress'],
            ],
            'activities' => [
                ['icon' => 'fa-handshake', 'color' => 'text-emerald-500 bg-emerald-50', 'text' => 'Sesi mentoring CraftMaster', 'time' => '2 jam lalu'],
                ['icon' => 'fa-clock', 'color' => 'text-yellow-500 bg-yellow-50', 'text' => '2 logbook menunggu validasi', 'time' => '5 jam lalu'],
                ['icon' => 'fa-calendar-plus', 'color' => 'text-sky-500 bg-sky-50', 'text' => 'Jadwal sesi minggu depan', 'time' => 'Baru'],
            ],
            'quickActions' => [
                ['url' => 'mentor/monitoring', 'icon' => 'fa-briefcase', 'label' => 'Monitoring Tim', 'style' => 'btn-accent'],
                ['url' => 'mentor/validasi', 'icon' => 'fa-check-double', 'label' => 'Validasi Logbook', 'style' => 'btn-outline'],
            ],
            'tableTitle'    => 'Status Mahasiswa Mentoring',
            'tableSubtitle' => 'Progress dan logbook tim yang Anda mentor',
        ];
    }

    private function getDefaultData(): array
    {
        return $this->getAdminData();
    }
}
