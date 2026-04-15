<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCatatanToProposals extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_proposals', [
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'status'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_proposals', 'catatan');
    }
}
