<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAdminMonitoringFieldsToActivityLogbooks extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_activity_logbooks', [
            'admin_photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'reviewer_at',
            ],
            'admin_summary' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'admin_photo',
            ],
            'admin_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'admin_summary',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_activity_logbooks', ['admin_photo', 'admin_summary', 'admin_at']);
    }
}
