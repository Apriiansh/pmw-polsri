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
        return view('public/tahapan', [
            'title' => 'Tahapan Program',
            'meta_description' => 'Alur dan tahapan Program Mahasiswa Wirausaha Polsri mulai dari pendaftaran, seleksi, hingga awarding dan expo.',
            'meta_keywords' => 'Tahapan PMW, Seleksi PMW Polsri, Jadwal PMW 2026, Pitching Desk'
        ]);
    }

    /**
     * Halaman Galeri Kegiatan
     */
    public function galeri(): string
    {
        return view('public/galeri', [
            'title' => 'Galeri Kegiatan',
            'meta_description' => 'Dokumentasi kegiatan Program Mahasiswa Wirausaha Polsri, termasuk sesi mentoring, bazaar, dan malam penganugerahan.',
            'meta_keywords' => 'Foto PMW Polsri, Dokumentasi Wirausaha, Kegiatan Mahasiswa Polsri'
        ]);
    }

    /**
     * Halaman Pengumuman
     */
    public function pengumuman(): string
    {
        return view('public/pengumuman', [
            'title' => 'Pengumuman',
            'meta_description' => 'Dapatkan informasi terbaru, jadwal seleksi, dan pengumuman kelolosan dana Program Mahasiswa Wirausaha Polsri.',
            'meta_keywords' => 'Pengumuman PMW Polsri, Hasil Seleksi PMW, Berita Wirausaha Kampus'
        ]);
    }
}
