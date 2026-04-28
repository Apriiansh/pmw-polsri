<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropDosenColumnsFromSelectionPitching extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('pmw_selection_pitching', ['dosen_status', 'dosen_catatan']);
    }

    public function down()
    {
        $this->forge->addColumn('pmw_selection_pitching', [
            'dosen_status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default'    => 'pending',
                'after'      => 'student_submitted_at',
            ],
            'dosen_catatan' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'dosen_status',
            ],
        ]);
    }
}
