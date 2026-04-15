<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MentorController extends BaseController
{
    public function monitoring()
    {
        return view('dashboard/placeholder', ['title' => 'Mahasiswa Mentoring']);
    }

    public function validasi()
    {
        return view('dashboard/placeholder', ['title' => 'Validasi Mentoring']);
    }
}
