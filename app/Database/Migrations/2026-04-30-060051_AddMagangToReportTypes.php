<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMagangToReportTypes extends Migration
{
    public function up()
    {
        // Update pmw_report_schedules table
        $this->db->query("ALTER TABLE pmw_report_schedules MODIFY COLUMN type ENUM('kemajuan', 'akhir', 'magang') NOT NULL");

        // Update pmw_reports table
        $this->db->query("ALTER TABLE pmw_reports MODIFY COLUMN type ENUM('kemajuan', 'akhir', 'magang') NOT NULL");
    }

    public function down()
    {
        // Revert pmw_report_schedules table
        $this->db->query("ALTER TABLE pmw_report_schedules MODIFY COLUMN type ENUM('kemajuan', 'akhir') NOT NULL");

        // Revert pmw_reports table
        $this->db->query("ALTER TABLE pmw_reports MODIFY COLUMN type ENUM('kemajuan', 'akhir') NOT NULL");
    }
}
