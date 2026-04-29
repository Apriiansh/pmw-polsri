<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeadlineDaysToGuidanceSchedules extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_guidance_schedules', [
            'deadline_days' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'default'    => 5,
                'after'      => 'topic',
                'comment'    => 'Batas waktu pengisian logbook oleh mahasiswa (dalam hari)',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_guidance_schedules', 'deadline_days');
    }
}
