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
$routes->get('sitemap.xml', 'Sitemap::index');

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

        // Teams / Peserta Management
        $routes->get('teams', 'AdminController::teams');
        $routes->get('teams/(:num)', 'AdminController::teamDetail/$1');

        // Tahap 2 - Seleksi Administrasi
        $routes->get('validasi', 'Admin\\ValidationController::seleksiAdministrasi'); // Alias for notifications
        $routes->group('administrasi', static function ($routes) {
            $routes->get('seleksi', 'Admin\\ValidationController::seleksiAdministrasi');
            $routes->get('seleksi/(:num)', 'Admin\\ValidationController::detailProposal/$1');
            $routes->post('seleksi/(:num)/validasi', 'Admin\\ValidationController::validasiAdministrasi/$1');
            $routes->get('seleksi/(:num)/hapus', 'Admin\\ValidationController::hapusProposal/$1');
            $routes->get('seleksi/doc/(:num)', 'Admin\\ValidationController::downloadDoc/$1');
        });

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
        $routes->get('pitching-desk/doc/(:num)', 'Admin\\PitchingDeskController::viewDoc/$1');

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
        $routes->get('pengumuman/rekening/(:num)/download', 'Admin\\AnnouncementController::downloadTeamBankBook/$1');

        // Tahap 7 - Implementasi List Perjanjian (Admin Verification)
        $routes->get('implementasi', 'Admin\\ImplementasiController::index');
        $routes->get('implementasi/detail/(:num)', 'Admin\\ImplementasiController::detail/$1');
        $routes->post('implementasi/verify/(:num)', 'Admin\\ImplementasiController::verify/$1');
        $routes->get('implementasi/photo/(:num)', 'Admin\\ImplementasiController::viewPhoto/$1');
        $routes->get('implementasi/payment/(:num)', 'Admin\\ImplementasiController::viewPayment/$1');
        $routes->get('implementasi/konsumsi/(:num)', 'Admin\\ImplementasiController::viewKonsumsi/$1');

        // Tahap 9 - Kegiatan Wirausaha (Activity)
        $routes->get('kegiatan', 'Admin\\ActivityController::index');
        $routes->post('kegiatan/schedule', 'Admin\\ActivityController::createSchedule');
        $routes->get('kegiatan/detail/(:num)', 'Admin\\ActivityController::detail/$1');
        $routes->post('kegiatan/verify/(:num)', 'Admin\\ActivityController::verify/$1');
        $routes->post('kegiatan/review/(:num)', 'Admin\\ActivityController::submitReview/$1');
        $routes->post('kegiatan/delete/(:num)', 'Admin\\ActivityController::deleteSchedule/$1');
        $routes->post('kegiatan/delete-batch', 'Admin\\ActivityController::deleteBatch');
        $routes->post('kegiatan/update-batch', 'Admin\\ActivityController::updateBatch');
        $routes->post('kegiatan/quick-update-status', 'Admin\\ActivityController::quickUpdateStatus');
        $routes->get('kegiatan/file/(:segment)/(:num)', 'Admin\\ActivityController::viewFile/$1/$2');
        $routes->get('kegiatan/gallery/(:num)', 'Admin\\ActivityController::viewGalleryFile/$1');

        // Milestone Reports
        $routes->get('milestone', 'Admin\\MilestoneReportController::index');
        $routes->post('milestone/schedule', 'Admin\\MilestoneReportController::saveSchedule');
        $routes->get('milestone/view/(:num)', 'Admin\\MilestoneReportController::viewFile/$1');
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
        $routes->post('pitching-desk/submit', 'Mahasiswa\\PitchingDeskController::submit');
        $routes->get('pitching-desk/doc/(:num)', 'Mahasiswa\\PitchingDeskController::viewDoc/$1');
        // Tahap 8 - Bimbingan (oleh Dosen Pendamping)
        $routes->get('bimbingan', 'Mahasiswa\\GuidanceController::bimbingan');
        $routes->post('bimbingan/logbook/(:num)', 'Mahasiswa\\GuidanceController::submitLogbook/$1');
        $routes->get('bimbingan/file/(:segment)/(:num)', 'Mahasiswa\\GuidanceController::viewFile/$1/$2');

        // Tahap 8 - Mentoring (oleh Mentor Praktisi)
        $routes->get('mentoring', 'Mahasiswa\\GuidanceController::mentoring');
        $routes->post('mentoring/logbook/(:num)', 'Mahasiswa\\GuidanceController::submitLogbook/$1');
        $routes->get('mentoring/file/(:segment)/(:num)', 'Mahasiswa\\GuidanceController::viewFile/$1/$2');

        // Tahap 9 - Kegiatan Wirausaha
        $routes->get('kegiatan', 'Mahasiswa\\ActivityController::index');
        $routes->post('kegiatan/logbook/(:num)', 'Mahasiswa\\ActivityController::submitLogbook/$1');
        $routes->get('kegiatan/file/(:segment)/(:num)', 'Mahasiswa\\ActivityController::viewFile/$1/$2');
        $routes->get('kegiatan/gallery/(:num)', 'Mahasiswa\\ActivityController::viewGalleryFile/$1');
        $routes->delete('kegiatan/photo/(:num)', 'Mahasiswa\\ActivityController::deletePhoto/$1');

        // Milestone Reports
        $routes->get('milestone', 'Mahasiswa\\MilestoneReportController::index');
        $routes->post('milestone/submit', 'Mahasiswa\\MilestoneReportController::submit');
        $routes->get('milestone/view/(:num)', 'Admin\\MilestoneReportController::viewFile/$1'); // Share view logic

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

        // Tahap 7 - Implementasi List Perjanjian
        $routes->get('implementasi', 'Mahasiswa\\ImplementasiController::index');
        $routes->post('implementasi/item', 'Mahasiswa\\ImplementasiController::saveItem');
        $routes->put('implementasi/item/(:num)', 'Mahasiswa\\ImplementasiController::updateItem/$1');
        $routes->post('implementasi/item/(:num)/photo', 'Mahasiswa\\ImplementasiController::uploadItemPhoto/$1');
        $routes->delete('implementasi/item/(:num)', 'Mahasiswa\\ImplementasiController::deleteItem/$1');
        $routes->delete('implementasi/photo/(:num)', 'Mahasiswa\\ImplementasiController::deletePhoto/$1');
        $routes->post('implementasi/payment', 'Mahasiswa\\ImplementasiController::uploadPaymentProof');
        $routes->put('implementasi/payment/(:num)', 'Mahasiswa\\ImplementasiController::updatePayment/$1');
        $routes->delete('implementasi/payment/(:num)', 'Mahasiswa\\ImplementasiController::deletePayment/$1');
        $routes->post('implementasi/konsumsi', 'Mahasiswa\\ImplementasiController::uploadKonsumsi');
        $routes->put('implementasi/konsumsi/(:num)', 'Mahasiswa\\ImplementasiController::updateKonsumsi/$1');
        $routes->delete('implementasi/konsumsi/(:num)', 'Mahasiswa\\ImplementasiController::deleteKonsumsi/$1');
        $routes->post('implementasi/reset', 'Mahasiswa\\ImplementasiController::resetAll');
        $routes->post('implementasi/submit', 'Mahasiswa\\ImplementasiController::submit');
        $routes->get('implementasi/photo/(:num)', 'Mahasiswa\\ImplementasiController::viewPhoto/$1');
        $routes->get('implementasi/payment/(:num)', 'Mahasiswa\\ImplementasiController::viewPayment/$1');
        $routes->get('implementasi/konsumsi/(:num)', 'Mahasiswa\\ImplementasiController::viewKonsumsi/$1');
    });

    // Reviewer Routes
    $routes->group('reviewer', ['filter' => 'group:reviewer'], static function ($routes) {
        $routes->get('penilaian-proposal', 'ReviewerController::penilaianProposal');
        $routes->get('penilaian-laporan', 'ReviewerController::penilaianLaporan');

        // Tahap 9 - Verifikasi Kegiatan Wirausaha
        $routes->group('kegiatan', ['namespace' => 'App\Controllers\Reviewer'], function($routes) {
            $routes->get('/', 'ActivityController::index');
            $routes->get('detail/(:num)', 'ActivityController::detail/$1');
            $routes->post('review/(:num)', 'ActivityController::submitReview/$1');
            $routes->get('file/(:segment)/(:num)', 'ActivityController::viewFile/$1/$2');
            $routes->get('gallery/(:num)', 'ActivityController::viewGalleryFile/$1');
        });
    });

    // Dosen Routes
    $routes->group('dosen', ['filter' => 'group:dosen'], static function ($routes) {
        $routes->get('monitoring', 'DosenController::monitoring');
        $routes->get('validasi', 'DosenController::validasi');
        $routes->get('pitching-desk', 'Dosen\\PitchingDeskController::index');
        $routes->get('pitching-desk/(:num)', 'Dosen\\PitchingDeskController::detail/$1');
        $routes->post('pitching-desk/(:num)/validate', 'Dosen\\PitchingDeskController::validateAction/$1');
        $routes->get('pitching-desk/doc/(:num)', 'Dosen\\PitchingDeskController::viewDoc/$1');

        // Tahap 7 - Validasi Implementasi
        $routes->get('implementasi', 'Dosen\\ImplementasiController::index');
        $routes->get('implementasi/(:num)', 'Dosen\\ImplementasiController::detail/$1');
        $routes->post('implementasi/(:num)/validate', 'Dosen\\ImplementasiController::validateAction/$1');
        $routes->get('implementasi/photo/(:num)', 'Dosen\\ImplementasiController::viewPhoto/$1');
        $routes->get('implementasi/payment/(:num)', 'Dosen\\ImplementasiController::viewPayment/$1');
        $routes->get('implementasi/konsumsi/(:num)', 'Dosen\\ImplementasiController::viewKonsumsi/$1');

        // Tahap 8 - Manajemen Jadwal Bimbingan
        $routes->get('bimbingan', 'Dosen\\GuidanceController::index');
        $routes->post('bimbingan/schedule', 'Dosen\\GuidanceController::createSchedule');
        $routes->post('bimbingan/verify/(:num)', 'Dosen\\GuidanceController::verify/$1');
        $routes->get('bimbingan/file/(:segment)/(:num)', 'Dosen\\GuidanceController::viewFile/$1/$2');

        // Tahap 9 - Verifikasi Kegiatan Wirausaha
        $routes->get('kegiatan', 'Dosen\\ActivityController::index');
        $routes->post('kegiatan/verify/(:num)', 'Dosen\\ActivityController::verify/$1');
        $routes->get('kegiatan/file/(:any)/(:num)', 'Dosen\\ActivityController::viewFile/$1/$2');
        $routes->get('kegiatan/gallery/(:num)', 'Dosen\\ActivityController::viewGalleryFile/$1');

        // Milestone Reports
        $routes->get('milestone', 'Dosen\\MilestoneReportController::index');
        $routes->post('milestone/verify', 'Dosen\\MilestoneReportController::verify');
        $routes->get('milestone/view/(:num)', 'Admin\\MilestoneReportController::viewFile/$1'); // Share view logic
    });

    // Mentor Routes
    $routes->group('mentor', ['filter' => 'group:mentor'], static function ($routes) {
        // Tahap 8 - Manajemen Jadwal Mentoring
        $routes->get('mentoring', 'Mentor\\GuidanceController::index');
        $routes->post('mentoring/schedule', 'Mentor\\GuidanceController::createSchedule');
        $routes->post('mentoring/verify/(:num)', 'Mentor\\GuidanceController::verify/$1');
        $routes->get('mentoring/file/(:segment)/(:num)', 'Mentor\\GuidanceController::viewFile/$1/$2');

        // Tahap 9 - Verifikasi Kegiatan Wirausaha
        $routes->get('kegiatan', 'Mentor\\ActivityController::index');
        $routes->post('kegiatan/verify/(:num)', 'Mentor\\ActivityController::verify/$1');
        $routes->get('kegiatan/file/(:any)/(:num)', 'Mentor\\ActivityController::viewFile/$1/$2');
        $routes->get('kegiatan/gallery/(:num)', 'Mentor\\ActivityController::viewGalleryFile/$1');
    });

    // Notifications Routes - All authenticated users
    $routes->get('notifications', 'NotificationsController::index');
    $routes->post('notifications/mark-read/(:num)', 'NotificationsController::markAsRead/$1');
    $routes->post('notifications/mark-all-read', 'NotificationsController::markAllAsRead');
    $routes->get('notifications/unread-count', 'NotificationsController::unreadCount');
    $routes->get('notifications/recent', 'NotificationsController::recent');

    // Dev Tools
    $routes->get('dev/ui', 'Dev\UI::index');
});

// Shield Auth Routes (bawaan)
service('auth')->routes($routes);
