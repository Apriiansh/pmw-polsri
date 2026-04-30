<?php
// Fix NULL uploader_role to 'student'
define('FCPATH', __DIR__ . DIRECTORY_PATH_SEPARATOR . 'public' . DIRECTORY_PATH_SEPARATOR);
require 'app/Config/Paths.php';
$paths = new Config\Paths();
require $paths->systemDirectory . '/bootstrap.php';

$db = \Config\Database::connect();
$affected = $db->table('pmw_activity_logbook_photos')
    ->where('uploader_role IS NULL')
    ->update(['uploader_role' => 'student']);

echo "Fixed $affected photo records.\n";
