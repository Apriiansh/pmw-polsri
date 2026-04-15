<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePmwTables extends Migration
{
    public function up()
    {
        // 1. TEAMS - The core grouping entity
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'team_name'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'lead_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true], // User ID of the leader
            'dosen_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'mentor_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'category'    => ['type' => 'ENUM', 'constraint' => ['kewirausahaan', 'digital', 'industri_kreatif', 'jasa'], 'default' => 'kewirausahaan'],
            'phase'       => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Pendaftaran'], // Current workflow phase
            'status'      => ['type' => 'ENUM', 'constraint' => ['aktif', 'lolos', 'tidak_lolos', 'selesai'], 'default' => 'aktif'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pmw_teams');

        // 2. PROFILES - Extended student data
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nim'            => ['type' => 'VARCHAR', 'constraint' => 20],
            'jurusan'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'prodi'          => ['type' => 'VARCHAR', 'constraint' => 100],
            'semester'       => ['type' => 'INT', 'constraint' => 2],
            'phone'          => ['type' => 'VARCHAR', 'constraint' => 20],
            'gender'         => ['type' => 'ENUM', 'constraint' => ['L', 'P']],
            'bio'            => ['type' => 'TEXT', 'null' => true],
            'socio_economic' => ['type' => 'JSON', 'null' => true], // Extra data
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('nim');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_profiles');

        // 3. TEAM MEMBERS - Mapping users to teams
        $this->forge->addField([
            'team_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'user_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'role'       => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'member'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey(['team_id', 'user_id'], true);
        $this->forge->addForeignKey('team_id', 'pmw_teams', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_team_members');

        // 4. DOCUMENTS - Registry for Proposals, LPJ, Notas
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'team_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'uploader_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'type'        => ['type' => 'ENUM', 'constraint' => ['proposal', 'laporan_awal', 'laporan_akhir', 'nota', 'dokumentasi_alat']],
            'file_path'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'original_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'status'      => ['type' => 'ENUM', 'constraint' => ['submitted', 'pending_review', 'verified', 'rejected'], 'default' => 'submitted'],
            'version'     => ['type' => 'INT', 'constraint' => 5, 'default' => 1],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('team_id', 'pmw_teams', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_documents');

        // 5. MENTORING LOGS
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'team_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'student_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'supervisor_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true], // Dosen or Mentor
            'activity_date'  => ['type' => 'DATE'],
            'description'    => ['type' => 'TEXT'],
            'verify_status'  => ['type' => 'ENUM', 'constraint' => ['pending', 'verified', 'rejected'], 'default' => 'pending'],
            'verified_at'    => ['type' => 'DATETIME', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('team_id', 'pmw_teams', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_mentoring_logs');

        // 6. ASSESSMENTS - Reviewer grading
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'document_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'reviewer_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'score'       => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'feedback'    => ['type' => 'TEXT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('document_id', 'pmw_documents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('reviewer_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_assessments');

        // 7. PRODUCTS - Showcasing results
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'team_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'product_name'=> ['type' => 'VARCHAR', 'constraint' => 255],
            'description' => ['type' => 'TEXT'],
            'image_path'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'      => ['type' => 'ENUM', 'constraint' => ['draft', 'published'], 'default' => 'draft'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('team_id', 'pmw_teams', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_products');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_products');
        $this->forge->dropTable('pmw_assessments');
        $this->forge->dropTable('pmw_mentoring_logs');
        $this->forge->dropTable('pmw_documents');
        $this->forge->dropTable('pmw_team_members');
        $this->forge->dropTable('pmw_profiles');
        $this->forge->dropTable('pmw_teams');
    }
}
