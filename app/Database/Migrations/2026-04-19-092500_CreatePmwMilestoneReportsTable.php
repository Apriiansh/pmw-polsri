<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePmwMilestoneReportsTable extends Migration
{
    public function up()
    {
        // Create pmw_report_schedules table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'period_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['kemajuan', 'akhir'],
            ],
            'start_date' => [
                'type' => 'DATE',
            ],
            'end_date' => [
                'type' => 'DATE',
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('period_id', 'pmw_periods', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_report_schedules');

        // Create pmw_reports table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'proposal_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'schedule_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['kemajuan', 'akhir'],
            ],
            'file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['submitted', 'approved', 'rejected', 'revision'],
                'default' => 'submitted',
            ],
            'dosen_note' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'dosen_verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'submitted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('schedule_id', 'pmw_report_schedules', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_reports');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_reports');
        $this->forge->dropTable('pmw_report_schedules');
    }
}
