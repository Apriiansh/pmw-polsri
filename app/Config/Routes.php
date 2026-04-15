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
    });

    // Mahasiswa Routes
    $routes->group('mahasiswa', ['filter' => 'group:mahasiswa'], static function ($routes) {
        $routes->get('proposal', 'Mahasiswa\\Proposal\\ProposalController::index');
        $routes->get('proposal/create', 'Mahasiswa\\Proposal\\ProposalController::create');
        $routes->get('proposal/edit/(:num)', 'Mahasiswa\\Proposal\\ProposalController::edit/$1');
        $routes->post('proposal/save', 'Mahasiswa\\Proposal\\ProposalController::save');
        $routes->post('proposal/upload/(:num)', 'Mahasiswa\\Proposal\\ProposalController::uploadDoc/$1');
        $routes->post('proposal/submit/(:num)', 'Mahasiswa\\Proposal\\ProposalController::submit/$1');
        $routes->get('proposal/doc/(:num)', 'Mahasiswa\\Proposal\\ProposalController::downloadDoc/$1');
        $routes->get('mentoring', 'MahasiswaController::mentoring');
        $routes->get('bimbingan', 'MahasiswaController::bimbingan');
        $routes->get('laporan-kemajuan', 'MahasiswaController::laporanKemajuan');
        $routes->get('laporan-akhir', 'MahasiswaController::laporanAkhir');
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
