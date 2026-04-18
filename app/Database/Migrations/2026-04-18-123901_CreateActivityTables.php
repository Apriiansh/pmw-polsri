<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateActivityTables extends Migration
{
    public function up()
    {
        // Create pmw_activity_schedules table
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
            'period_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'activity_category' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'activity_date' => [
                'type' => 'DATE',
            ],
            'activity_time' => [
                'type' => 'TIME',
                'null' => true,
            ],
            'location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['planned', 'ongoing', 'completed', 'cancelled'],
                'default' => 'planned',
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
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('period_id', 'pmw_periods', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_activity_schedules');

        // Create pmw_activity_logbooks table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'schedule_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'activity_description' => [
                'type' => 'TEXT',
            ],
            'photo_activity' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'video_url' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'photo_supervisor_visit' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'pending', 'approved_by_dosen', 'approved_by_mentor', 'approved', 'revision'],
                'default' => 'draft',
            ],
            'dosen_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'revision'],
                'default' => 'pending',
            ],
            'dosen_note' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'dosen_verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'mentor_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'revision'],
                'default' => 'pending',
            ],
            'mentor_note' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'mentor_verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'admin_note' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'admin_verified_at' => [
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
        $this->forge->addForeignKey('schedule_id', 'pmw_activity_schedules', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_activity_logbooks');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_activity_logbooks');
        $this->forge->dropTable('pmw_activity_schedules');
    }
}
