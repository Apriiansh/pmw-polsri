<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ReviewerController extends BaseController
{
    public function penilaianProposal()
    {
        return view('dashboard/placeholder', ['title' => 'Penilaian Proposal']);
    }

    public function penilaianLaporan()
    {
        return view('dashboard/placeholder', ['title' => 'Penilaian Laporan']);
    }
}
