<?php

require_once 'app/Config/Paths.php';
$paths = new Config\Paths();
require_once $paths->systemDirectory . '/bootstrap.php';

$db = \Config\Database::connect();
$lecturerId = 3;

$builder = $db->table('pmw_proposals p');
$builder->select('p.*, pa.lecturer_id, pa.mentor_id, pm.nama as ketua_nama');
$builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id');
$builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
$builder->where('pa.lecturer_id', $lecturerId);
$builder->where('p.status', 'approved');

$results = $builder->get()->getResultArray();

echo "Count: " . count($results) . "\n";
foreach ($results as $row) {
    echo "ID: " . $row['id'] . " | Nama Usaha: " . $row['nama_usaha'] . " | Status: " . $row['status'] . "\n";
}
