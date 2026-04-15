<?php

namespace App\Controllers\Dev;

use App\Controllers\BaseController;

class UI extends BaseController
{
    public function index()
    {
        $data = [
            'title'           => 'UI Style Guide | PMW Polsri',
            'header_title'    => 'Design System Showcase',
            'header_subtitle' => 'Koleksi komponen UI standar untuk proyek PMW.',
        ];

        return view('dev/ui_gallery', $data);
    }
}
