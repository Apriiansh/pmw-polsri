<?php

require_once 'app/Config/Paths.php';
$paths = new Config\Paths();
require_once $paths->systemDirectory . '/bootstrap.php';

$db = \Config\Database::connect();
$proposal = $db->table('pmw_proposals')
    ->where('nama_usaha', 'Panda Koko')
    ->get()
    ->getRowArray();

if (!$proposal) {
    echo "Proposal 'Panda Koko' not found.\n";
} else {
    echo "Proposal ID: " . $proposal['id'] . "\n";
    echo "Status: " . $proposal['status'] . "\n";
    
    $assignment = $db->table('pmw_proposal_assignments')
        ->where('proposal_id', $proposal['id'])
        ->get()
        ->getRowArray();
        
    if (!$assignment) {
        echo "No assignment found for this proposal.\n";
    } else {
        echo "Lecturer ID: " . ($assignment['lecturer_id'] ?? 'NULL') . "\n";
        echo "Mentor ID: " . ($assignment['mentor_id'] ?? 'NULL') . "\n";
    }
}
