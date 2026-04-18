<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSubmittedAtToPitching extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_selection_pitching', [
            'student_submitted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'proposal_id'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_selection_pitching', 'student_submitted_at');
    }
}
