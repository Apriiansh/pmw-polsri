<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGuidanceTables extends Migration
{
    public function up()
    {
        // ─── GUIDANCE SCHEDULES ──────────────────────────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'proposal_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'user_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'comment'  => 'Creator: Dosen or Mentor',
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['bimbingan', 'mentoring'],
            ],
            'schedule_date' => [
                'type' => 'DATE',
            ],
            'schedule_time' => [
                'type' => 'TIME',
            ],
            'topic' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['planned', 'ongoing', 'completed', 'cancelled'],
                'default'    => 'planned',
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
        $this->forge->addKey('proposal_id');
        $this->forge->addKey('user_id');
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'RESTRICT', 'CASCADE');
        $this->forge->createTable('pmw_guidance_schedules');

        // ─── GUIDANCE LOGBOOKS ─────────────────────────────────────────────
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'schedule_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'material_explanation' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'video_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'photo_activity' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'File path for activity photo',
            ],
            'assignment_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'File path for assignment/tasks',
            ],
            'nota_file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'File path for consumption note',
            ],
            'nominal_konsumsi' => [
                'type'     => 'INT',
                'default'  => 0,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected'],
                'default'    => 'pending',
            ],
            'verification_note' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'verified_at' => [
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
        $this->forge->addUniqueKey('schedule_id');
        $this->forge->addForeignKey('schedule_id', 'pmw_guidance_schedules', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_guidance_logbooks');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_guidance_logbooks');
        $this->forge->dropTable('pmw_guidance_schedules');
    }
}
