<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSubmittedAtToLogbooks extends Migration
{
    public function up()
    {
        $fields = [
            'submitted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'status'
            ],
        ];
        $this->forge->addColumn('pmw_guidance_logbooks', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_guidance_logbooks', 'submitted_at');
    }
}
