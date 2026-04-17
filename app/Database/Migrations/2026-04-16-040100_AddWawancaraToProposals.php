<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWawancaraToProposals extends Migration
{
    public function up()
    {
        $fields = [
            'wawancara_status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default'    => 'pending',
                'after'      => 'pitching_admin_catatan'
            ],
            'wawancara_catatan' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'wawancara_status'
            ],
        ];

        $this->forge->addColumn('pmw_proposals', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_proposals', ['wawancara_status', 'wawancara_catatan']);
    }
}
