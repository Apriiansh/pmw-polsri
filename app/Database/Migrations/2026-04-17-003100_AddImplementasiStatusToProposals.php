<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImplementasiStatusToProposals extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_proposals', [
            'implementasi_status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'revision', 'rejected'],
                'default'    => 'pending',
                'null'       => false,
                'after'      => 'wawancara_catatan',
            ],
            'implementasi_catatan' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'implementasi_status',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_proposals', 'implementasi_status');
        $this->forge->dropColumn('pmw_proposals', 'implementasi_catatan');
    }
}
