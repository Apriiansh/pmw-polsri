<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $announcementModel = new \App\Models\PortalAnnouncementModel();
        $galleryModel = new \App\Models\PortalGalleryModel();

        $latestAnnouncements = $announcementModel->where('is_published', 1)
            ->orderBy('date', 'DESC')
            ->limit(3)
            ->findAll();

        $galleries = $galleryModel->where('is_published', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        return view('public/home', [
            'title'               => 'Beranda',
            'latestAnnouncements' => $latestAnnouncements,
            'galleries'           => $galleries,
            'meta_description'    => 'Program Mahasiswa Wirausaha (PMW) Politeknik Negeri Sriwijaya - Mengembangkan jiwa kewirausahaan mahasiswa melalui pendanaan, mentoring, dan pelatihan intensif.',
            'meta_keywords'       => 'PMW Polsri, Wirausaha Mahasiswa, Politeknik Negeri Sriwijaya, Startup Mahasiswa, Inkubator Bisnis Palembang'
        ]);
    }
}
