<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DosenController extends BaseController
{
    public function monitoring()
    {
        return view('dashboard/placeholder', ['title' => 'Monitoring Tim']);
    }

    public function validasi()
    {
        return view('dashboard/placeholder', ['title' => 'Validasi Bimbingan (Logbook)']);
    }
}
