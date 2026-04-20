<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PublicPages extends BaseController
{
    /**
     * Halaman Utama / Landing Page
     */
    public function index(): string
    {
        return view('public/home', [
            'title' => 'Beranda',
            'meta_description' => 'Program Mahasiswa Wirausaha (PMW) Politeknik Negeri Sriwijaya - Mengembangkan jiwa kewirausahaan mahasiswa melalui pendanaan, mentoring, dan pelatihan intensif.',
            'meta_keywords' => 'PMW Polsri, Wirausaha Mahasiswa, Politeknik Negeri Sriwijaya, Startup Mahasiswa, Inkubator Bisnis Palembang'
        ]);
    }

    /**
     * Halaman Tentang PMW
     */
    public function tentang(): string
    {
        return view('public/tentang', [
            'title' => 'Tentang PMW',
            'meta_description' => 'Pelajari lebih lanjut tentang Visi, Misi, dan Tujuan Program Mahasiswa Wirausaha (PMW) di Politeknik Negeri Sriwijaya.',
            'meta_keywords' => 'Visi Misi PMW Polsri, Sejarah PMW Polsri, Program Kewirausahaan Kampus'
        ]);
    }

    /**
     * Halaman Tahapan Program
     */
    public function tahapan(): string
    {
        $periodModel = new \App\Models\PmwPeriodModel();
        $scheduleModel = new \App\Models\PmwScheduleModel();

        $activePeriod = $periodModel->where('is_active', 1)->first();
        $schedules = [];

        if ($activePeriod) {
            $schedules = $scheduleModel->where('period_id', $activePeriod['id'])
                ->orderBy('phase_number', 'ASC')
                ->findAll();
        }

        return view('public/tahapan', [
            'title'            => 'Tahapan Program',
            'activePeriod'     => $activePeriod,
            'schedules'        => $schedules,
            'meta_description' => 'Alur dan tahapan Program Mahasiswa Wirausaha Polsri mulai dari pendaftaran, seleksi, hingga awarding dan expo.',
            'meta_keywords'    => 'Tahapan PMW, Seleksi PMW Polsri, Jadwal PMW 2026, Pitching Desk'
        ]);
    }

    /**
     * Halaman Galeri Kegiatan
     */
    public function galeri(): string
    {
        $galleryModel = new \App\Models\PortalGalleryModel();
        $galleries = $galleryModel->where('is_published', 1)
                                 ->orderBy('sort_order', 'ASC')
                                 ->orderBy('created_at', 'DESC')
                                 ->findAll();

        return view('public/galeri', [
            'title'            => 'Galeri Kegiatan',
            'galleries'        => $galleries,
            'meta_description' => 'Dokumentasi kegiatan Program Mahasiswa Wirausaha Polsri, termasuk sesi mentoring, bazaar, dan malam penganugerahan.',
            'meta_keywords'    => 'Foto PMW Polsri, Dokumentasi Wirausaha, Kegiatan Mahasiswa Polsri'
        ]);
    }

    public function pengumuman(): string
    {
        $announcementModel = new \App\Models\PortalAnnouncementModel();
        
        $category = $this->request->getGet('category');
        $query = $announcementModel->where('is_published', 1);

        if ($category && $category !== 'Semua') {
            $query->where('category', $category);
        }

        $announcements = $query->orderBy('date', 'DESC')->findAll();

        return view('public/pengumuman', [
            'title'            => 'Pengumuman',
            'announcements'    => $announcements,
            'currentCategory'  => $category ?? 'Semua',
            'meta_description' => 'Dapatkan informasi terbaru, jadwal seleksi, dan pengumuman kelolosan dana Program Mahasiswa Wirausaha Polsri.',
            'meta_keywords'    => 'Pengumuman PMW Polsri, Hasil Seleksi PMW, Berita Wirausaha Kampus'
        ]);
    }

    /**
     * Halaman Detail Pengumuman
     */
    public function detail(string $slug): string
    {
        $announcementModel = new \App\Models\PortalAnnouncementModel();
        $attachmentModel = new \App\Models\AnnouncementAttachmentModel();

        $announcement = $announcementModel->where('slug', $slug)
            ->where('is_published', 1)
            ->first();

        if (!$announcement) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $attachments = $attachmentModel->where('announcement_id', $announcement['id'])->findAll();

        return view('public/pengumuman_detail', [
            'title'            => $announcement['title'],
            'announcement'    => $announcement,
            'attachments'     => $attachments,
            'meta_description' => strip_tags(substr($announcement['content'], 0, 160)),
            'meta_keywords'    => $announcement['category'] . ', PMW Polsri, Pengumuman'
        ]);
    }
}
