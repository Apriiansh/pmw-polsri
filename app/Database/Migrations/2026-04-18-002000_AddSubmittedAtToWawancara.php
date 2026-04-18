<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSubmittedAtToWawancara extends Migration
{
    public function up()
    {
        $fields = [
            'student_submitted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'proposal_id',
            ],
        ];
        $this->forge->addColumn('pmw_selection_wawancara', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_selection_wawancara', 'student_submitted_at');
    }
}
