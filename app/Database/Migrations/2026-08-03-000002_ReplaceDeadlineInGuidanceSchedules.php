<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ReplaceDeadlineInGuidanceSchedules extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_guidance_schedules', [
            'deadline_date' => [
                'type'       => 'DATE',
                'null'       => true,
                'default'    => null,
                'after'      => 'schedule_time',
                'comment'    => 'Tanggal batas pengisian logbook oleh mahasiswa',
            ],
        ]);

        $this->forge->modifyColumn('pmw_guidance_schedules', [
            'deadline_time' => [
                'type'    => 'TIME',
                'null'    => true,
                'default' => null,
                'after'   => 'deadline_date',
                'comment' => 'Jam batas pengisian logbook oleh mahasiswa',
            ],
        ]);

        $db = \Config\Database::connect();

        $db->query("UPDATE pmw_guidance_schedules SET deadline_date = DATE_ADD(schedule_date, INTERVAL IFNULL(deadline_days, 5) DAY), deadline_time = COALESCE(deadline_time, '23:59:00')");

        $this->forge->dropColumn('pmw_guidance_schedules', ['deadline_days', 'deadline_mode']);
    }

    public function down()
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
            'deadline_mode' => [
                'type'       => 'ENUM',
                'constraint' => ['days', 'session_date'],
                'default'    => 'days',
                'null'       => false,
                'after'      => 'deadline_days',
                'comment'    => 'Mode batas waktu pengisian logbook',
            ],
        ]);

        $this->forge->dropColumn('pmw_guidance_schedules', ['deadline_date']);
    }
}
