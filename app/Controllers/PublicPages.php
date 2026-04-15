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
            'title' => 'Beranda'
        ]);
    }

    /**
     * Halaman Tentang PMW
     */
    public function tentang(): string
    {
        return view('public/tentang', [
            'title' => 'Tentang PMW'
        ]);
    }

    /**
     * Halaman Tahapan Program
     */
    public function tahapan(): string
    {
        return view('public/tahapan', [
            'title' => 'Tahapan Program'
        ]);
    }

    /**
     * Halaman Galeri Kegiatan
     */
    public function galeri(): string
    {
        return view('public/galeri', [
            'title' => 'Galeri Kegiatan'
        ]);
    }

    /**
     * Halaman Pengumuman
     */
    public function pengumuman(): string
    {
        return view('public/pengumuman', [
            'title' => 'Pengumuman'
        ]);
    }
}
