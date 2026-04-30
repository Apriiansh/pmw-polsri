<?php
// Simple DB check script
define('FCPATH', __DIR__ . '/public/');
require 'vendor/autoload.php';
require 'app/Config/Paths.php';
$paths = new Config\Paths();
require $paths->systemDirectory . '/bootstrap.php';

$db = \Config\Database::connect();
$proposal = $db->table('pmw_proposals')
    ->like('nama_usaha', 'Panda Koko')
    ->get()
    ->getRow();

if (!$proposal) {
    echo "Panda Koko NOT FOUND in pmw_proposals table.\n";
    // Check all proposals just in case
    $all = $db->table('pmw_proposals')->select('nama_usaha')->limit(10)->get()->getResult();
    echo "Sample Proposals in DB:\n";
    foreach($all as $a) echo "- {$a->nama_usaha}\n";
} else {
    echo "FOUND: ID {$proposal->id} | Name: {$proposal->nama_usaha} | Status: {$proposal->status}\n";
    $pa = $db->table('pmw_proposal_assignments')->where('proposal_id', $proposal->id)->get()->getRow();
    if ($pa) {
        echo "Assigned to Lecturer ID: " . ($pa->lecturer_id ?: 'NONE') . "\n";
    } else {
        echo "No assignment record found.\n";
    }
}
