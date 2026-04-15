<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MahasiswaController extends BaseController
{
    public function proposal()
    {
        return view('dashboard/placeholder', ['title' => 'Proposal Kami']);
    }

    public function mentoring()
    {
        return view('dashboard/placeholder', ['title' => 'Log Mentoring']);
    }

    public function bimbingan()
    {
        return view('dashboard/placeholder', ['title' => 'Log Bimbingan']);
    }

    public function laporanKemajuan()
    {
        return view('dashboard/placeholder', ['title' => 'Laporan Kemajuan']);
    }

    public function laporanAkhir()
    {
        return view('dashboard/placeholder', ['title' => 'Laporan Akhir']);
    }
}
