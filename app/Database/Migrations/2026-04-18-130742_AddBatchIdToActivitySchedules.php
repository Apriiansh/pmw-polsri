<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddBatchIdToActivitySchedules extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_activity_schedules', [
            'batch_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'period_id'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_activity_schedules', 'batch_id');
    }
}
