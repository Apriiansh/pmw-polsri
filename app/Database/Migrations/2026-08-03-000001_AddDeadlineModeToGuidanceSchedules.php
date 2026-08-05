<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeadlineModeToGuidanceSchedules extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_guidance_schedules', [
            'deadline_mode' => [
                'type'       => 'ENUM',
                'constraint' => ['days', 'session_date'],
                'default'    => 'days',
                'null'       => false,
                'after'      => 'deadline_days',
                'comment'    => 'Mode batas waktu pengisian logbook: days (X hari setelah sesi) atau session_date (hari sesi itu juga)',
            ],
            'deadline_time' => [
                'type'    => 'TIME',
                'null'    => true,
                'default' => null,
                'after'   => 'deadline_mode',
                'comment' => 'Jam batas pengisian logbook pada hari sesi (dipakai saat deadline_mode = session_date)',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_guidance_schedules', ['deadline_mode', 'deadline_time']);
    }
}
