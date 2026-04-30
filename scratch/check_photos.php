<?php
require 'app/Config/Paths.php';
$paths = new Config\Paths();
require $paths->systemDirectory . '/bootstrap.php';

$db = \Config\Database::connect();
$results = $db->table('pmw_activity_logbook_photos')
    ->where('uploader_role IS NULL')
    ->get()
    ->getResult();

echo "Found " . count($results) . " photos with NULL uploader_role\n";
foreach ($results as $row) {
    echo "ID: {$row->id}, Logbook: {$row->logbook_id}, Path: {$row->file_path}\n";
}
