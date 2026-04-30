<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CheckDosenTeams extends BaseCommand
{
    protected $group       = 'Custom';
    protected $name        = 'check:dosen-teams';
    protected $description = 'Checks teams for a specific lecturer';

    public function run(array $params)
    {
        $lecturerId = $params[0] ?? 3;
        $db = \Config\Database::connect();
        
        $builder = $db->table('pmw_proposals p');
        $builder->select('p.*, pa.lecturer_id, pa.mentor_id, pm.nama as ketua_nama');
        $builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id');
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->where('pa.lecturer_id', $lecturerId);
        $builder->where('p.status', 'approved');

        $results = $builder->get()->getResultArray();

        CLI::write("Teams for Lecturer ID: " . $lecturerId, 'yellow');
        CLI::write("Count: " . count($results), 'green');
        
        foreach ($results as $row) {
            CLI::write("ID: {$row['id']} | Nama Usaha: {$row['nama_usaha']} | Status: {$row['status']} | Ketua: {$row['ketua_nama']}");
        }
    }
}
