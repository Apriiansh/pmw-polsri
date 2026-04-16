<?php
/**
 * Migration for Pitching Desk Validation Stage
 */
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPitchingValidationToProposals extends Migration
{
    public function up()
    {
        $fields = [
            'pitching_dosen_status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default'    => 'pending',
                'after'      => 'video_url'
            ],
            'pitching_admin_status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default'    => 'pending',
                'after'      => 'pitching_dosen_status'
            ],
            'pitching_dosen_catatan' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'pitching_admin_status'
            ],
            'pitching_admin_catatan' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'pitching_dosen_catatan'
            ],
        ];
        $this->forge->addColumn('pmw_proposals', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_proposals', [
            'pitching_dosen_status',
            'pitching_admin_status',
            'pitching_dosen_catatan',
            'pitching_admin_catatan'
        ]);
    }
}
