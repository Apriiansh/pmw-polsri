<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Override dengan Custom PMW Auth Routes - MUST BE BEFORE Shield routes to take precedence
$routes->get('register', 'AuthController::register', ['as' => 'register']);
$routes->post('register', 'AuthController::attemptRegister');
$routes->get('login', 'AuthController::login', ['as' => 'login']);
$routes->post('login', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');
$routes->post('logout', 'AuthController::logout');


// Public Pages
$routes->get('tentang', 'PublicPages::tentang');
$routes->get('tahapan', 'PublicPages::tahapan');
$routes->get('galeri', 'PublicPages::galeri');
$routes->get('pengumuman', 'PublicPages::pengumuman');

$routes->group('', ['filter' => 'session'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    
    // Admin Routes
    $routes->group('admin', ['filter' => 'group:admin'], static function ($routes) {
        // User Management
        $routes->get('users', 'AdminController::users');
        $routes->get('users/create', 'AdminController::createUser');
        $routes->post('users/store', 'AdminController::storeUser');
        $routes->get('users/edit/(:num)', 'AdminController::editUser/$1');
        $routes->post('users/update/(:num)', 'AdminController::updateUser/$1');
        $routes->get('users/toggle-status/(:num)', 'AdminController::toggleUserStatus/$1');
        $routes->get('users/delete/(:num)', 'AdminController::deleteUser/$1');

        // Tahap 2 - Seleksi Administrasi
        $routes->get('seleksi-administrasi', 'Admin\\ValidationController::seleksiAdministrasi');
        $routes->get('seleksi-administrasi/(:num)', 'Admin\\ValidationController::detailProposal/$1');
        $routes->post('seleksi-administrasi/(:num)/validasi', 'Admin\\ValidationController::validasiAdministrasi/$1');
        $routes->get('seleksi-administrasi/(:num)/hapus', 'Admin\\ValidationController::hapusProposal/$1');
        $routes->get('seleksi-administrasi/doc/(:num)', 'Admin\\ValidationController::downloadDoc/$1');

        $routes->get('cms', 'AdminController::cms');

        // PMW System - Master Jadwal
        $routes->get('pmw-system', 'AdminController::pmwSystem');
        $routes->post('pmw-system/period', 'AdminController::storePeriod');
        $routes->post('pmw-system/period/activate/(:num)', 'AdminController::activatePeriod/$1');
        $routes->post('pmw-system/period/deactivate/(:num)', 'AdminController::deactivatePeriod/$1');
        $routes->get('pmw-system/period/delete/(:num)', 'AdminController::deletePeriod/$1');
        $routes->post('pmw-system/schedule', 'AdminController::updateSchedule');

        $routes->get('laporan', 'AdminController::laporan');
        // Legacy alias
        $routes->get('rekap', 'AdminController::laporan');

        // Tahap 3 - Pitching Desk Validation
        $routes->get('pitching-desk', 'Admin\\PitchingDeskController::index');
        $routes->get('pitching-desk/(:num)', 'Admin\\PitchingDeskController::detail/$1');
        $routes->post('pitching-desk/(:num)/validate', 'Admin\\PitchingDeskController::validateAction/$1');

        // Tahap 4 - Wawancara Perjanjian (Perjanjian Implementasi)
        $routes->get('perjanjian', 'Admin\\WawancaraController::index');
        $routes->get('perjanjian/(:num)', 'Admin\\WawancaraController::detail/$1');
        $routes->post('perjanjian/(:num)/validate', 'Admin\\WawancaraController::validateAction/$1');
        $routes->get('perjanjian/doc/(:num)', 'Admin\\WawancaraController::downloadDoc/$1');

        // Tahap 5 - Pengumuman Kelolosan Dana Tahap I
        $routes->get('pengumuman', 'Admin\\AnnouncementController::index');
        $routes->post('pengumuman/(:num)/save', 'Admin\\AnnouncementController::save/$1');
        $routes->post('pengumuman/(:num)/publish', 'Admin\\AnnouncementController::publish/$1');
        $routes->post('pengumuman/(:num)/upload-sk', 'Admin\\AnnouncementController::uploadSk/$1');
        $routes->post('pengumuman/(:num)/delete-sk', 'Admin\\AnnouncementController::deleteSk/$1');
        $routes->get('pengumuman/(:num)/sk', 'Admin\\AnnouncementController::downloadSk/$1');
    });

    // Mahasiswa Routes
    $routes->group('mahasiswa', ['filter' => 'group:mahasiswa'], static function ($routes) {
        $routes->get('proposal', 'Mahasiswa\\ProposalController::index');
        $routes->get('proposal/create', 'Mahasiswa\\ProposalController::create');
        $routes->get('proposal/edit/(:num)', 'Mahasiswa\\ProposalController::edit/$1');
        $routes->post('proposal/save', 'Mahasiswa\\ProposalController::save');
        $routes->post('proposal/upload/(:num)', 'Mahasiswa\\ProposalController::uploadDoc/$1');
        $routes->post('proposal/submit/(:num)', 'Mahasiswa\\ProposalController::submit/$1');
        $routes->get('proposal/doc/(:num)', 'Mahasiswa\\ProposalController::downloadDoc/$1');
        $routes->get('proposal/reset/(:num)', 'Mahasiswa\\ProposalController::reset/$1');
        // Tahap 3 - Pitching Desk
        $routes->get('pitching-desk', 'Mahasiswa\\PitchingDeskController::index');
        $routes->post('pitching-desk/upload-ppt', 'Mahasiswa\\PitchingDeskController::uploadPpt');
        $routes->post('pitching-desk/update-video-url', 'Mahasiswa\\PitchingDeskController::updateVideoUrl');
        $routes->post('pitching-desk/update-detail', 'Mahasiswa\\PitchingDeskController::updateDetail');
        $routes->get('mentoring', 'MahasiswaController::mentoring');
        $routes->get('bimbingan', 'MahasiswaController::bimbingan');
        $routes->get('laporan-kemajuan', 'MahasiswaController::laporanKemajuan');
        $routes->get('laporan-akhir', 'MahasiswaController::laporanAkhir');

        // Tahap 4 - Perjanjian Implementasi
        $routes->get('perjanjian', 'Mahasiswa\\WawancaraController::index');
        $routes->post('perjanjian/upload', 'Mahasiswa\\WawancaraController::upload');
        $routes->get('perjanjian/doc/(:num)', 'Mahasiswa\\WawancaraController::downloadDoc/$1');

        // Tahap 5 - Pengumuman Kelolosan Dana Tahap I
        $routes->get('pengumuman', 'Mahasiswa\\AnnouncementController::index');
        $routes->get('pengumuman/sk', 'Mahasiswa\\AnnouncementController::downloadSk');
        $routes->get('pengumuman/rekening', 'Mahasiswa\\AnnouncementController::bankAccount');
        $routes->post('pengumuman/rekening/save', 'Mahasiswa\\AnnouncementController::saveBankAccount');
        $routes->get('pengumuman/rekening/download', 'Mahasiswa\\AnnouncementController::downloadBankBook');

        // Tahap 6 - Pembekalan
        $routes->get('pembekalan', 'Mahasiswa\\TrainingController::index');
        $routes->post('pembekalan/save', 'Mahasiswa\\TrainingController::save');
        $routes->post('pembekalan/photo/(:num)/delete', 'Mahasiswa\\TrainingController::deletePhoto/$1');
        $routes->get('pembekalan/photo/(:num)', 'Mahasiswa\\TrainingController::downloadPhoto/$1');
    });

    // Reviewer Routes
    $routes->group('reviewer', ['filter' => 'group:reviewer'], static function ($routes) {
        $routes->get('penilaian-proposal', 'ReviewerController::penilaianProposal');
        $routes->get('penilaian-laporan', 'ReviewerController::penilaianLaporan');
    });

    // Dosen Routes
    $routes->group('dosen', ['filter' => 'group:dosen'], static function ($routes) {
        $routes->get('monitoring', 'DosenController::monitoring');
        $routes->get('validasi', 'DosenController::validasi');
        
        // Tahap 3 - Pitching Desk Validation
        $routes->get('pitching-desk', 'Dosen\\PitchingDeskController::index');
        $routes->get('pitching-desk/(:num)', 'Dosen\\PitchingDeskController::detail/$1');
        $routes->post('pitching-desk/(:num)/validate', 'Dosen\\PitchingDeskController::validateAction/$1');
        $routes->get('pitching-desk/doc/(:num)', 'Admin\\ValidationController::downloadDoc/$1');
    });

    // Mentor Routes
    $routes->group('mentor', ['filter' => 'group:mentor'], static function ($routes) {
        $routes->get('monitoring', 'MentorController::monitoring');
        $routes->get('validasi', 'MentorController::validasi');
    });

    // Dev Tools
    $routes->get('dev/ui', 'Dev\UI::index');
});

// Shield Auth Routes (bawaan)
service('auth')->routes($routes);
