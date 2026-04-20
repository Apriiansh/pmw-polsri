<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $announcementModel = new \App\Models\PortalAnnouncementModel();
        $latestAnnouncements = $announcementModel->where('is_published', 1)
            ->orderBy('date', 'DESC')
            ->limit(3)
            ->findAll();

        return view('public/home', [
            'title'               => 'Beranda',
            'latestAnnouncements' => $latestAnnouncements,
            'meta_description'    => 'Program Mahasiswa Wirausaha (PMW) Politeknik Negeri Sriwijaya - Mengembangkan jiwa kewirausahaan mahasiswa melalui pendanaan, mentoring, dan pelatihan intensif.',
            'meta_keywords'       => 'PMW Polsri, Wirausaha Mahasiswa, Politeknik Negeri Sriwijaya, Startup Mahasiswa, Inkubator Bisnis Palembang'
        ]);
    }
}
