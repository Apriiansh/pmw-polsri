<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterProposalLecturerNullable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('pmw_proposals', [
        'lecturer_id' => [
            'type'       => 'INT',
            'constraint' => 10,
            'unsigned'   => true,
            'null'       => true,
        ],
    ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('pmw_proposals', [
        'lecturer_id' => [
            'type'       => 'INT',
            'constraint' => 10,
            'unsigned'   => true,
            'null'       => false,
        ],
    ]);
    }
}
