<?php

use CodeIgniter\Boot;
use Config\Paths;

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 */

// Konfigurasi Path untuk cPanel opsimpmw
// File ini berada di /home/opsimpmw/public_html/index.php
// Aplikasi berada di /home/opsimpmw/pmw-app/
require __DIR__ . '/../pmw-app/app/Config/Paths.php';

$paths = new Paths();

// LOAD THE FRAMEWORK BOOTSTRAP FILE
require $paths->systemDirectory . '/Boot.php';

exit(Boot::bootWeb($paths));

