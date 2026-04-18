<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddReviewerFieldsToActivityLogbooks extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_activity_logbooks', [
            'reviewer_photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'photo_supervisor_visit',
            ],
            'reviewer_summary' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'reviewer_photo',
            ],
            'reviewer_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'reviewer_summary',
            ],
            'reviewer_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'reviewer_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_activity_logbooks', ['reviewer_photo', 'reviewer_summary', 'reviewer_id', 'reviewer_at']);
    }
}
