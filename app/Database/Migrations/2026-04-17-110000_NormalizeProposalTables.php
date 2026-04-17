<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NormalizeProposalTables extends Migration
{
    public function up()
    {
        // 1. Create table pmw_proposal_assignments
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
            'lecturer_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'mentor_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_proposal_assignments');

        // 2. Create table pmw_selection_pitching
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
            'dosen_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default' => 'pending',
            ],
            'admin_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default' => 'pending',
            ],
            'dosen_catatan' => ['type' => 'TEXT', 'null' => true],
            'admin_catatan' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_selection_pitching');

        // 3. Create table pmw_selection_wawancara
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
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default' => 'pending',
            ],
            'catatan' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_selection_wawancara');

        // 4. Create table pmw_selection_implementasi
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
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default' => 'pending',
            ],
            'catatan' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_selection_implementasi');

        // 5. Data Migration
        $db = \Config\Database::connect();
        
        // Assignments
        $db->query("INSERT INTO pmw_proposal_assignments (proposal_id, lecturer_id, mentor_id, created_at, updated_at) 
                    SELECT id, lecturer_id, mentor_id, created_at, updated_at FROM pmw_proposals");
        
        // Pitching
        $db->query("INSERT INTO pmw_selection_pitching (proposal_id, dosen_status, admin_status, dosen_catatan, admin_catatan, created_at, updated_at) 
                    SELECT id, pitching_dosen_status, pitching_admin_status, pitching_dosen_catatan, pitching_admin_catatan, created_at, updated_at FROM pmw_proposals");
        
        // Wawancara
        $db->query("INSERT INTO pmw_selection_wawancara (proposal_id, status, catatan, created_at, updated_at) 
                    SELECT id, wawancara_status, wawancara_catatan, created_at, updated_at FROM pmw_proposals");
        
        // Implementasi
        $db->query("INSERT INTO pmw_selection_implementasi (proposal_id, status, catatan, created_at, updated_at) 
                    SELECT id, implementasi_status, implementasi_catatan, created_at, updated_at FROM pmw_proposals");

        // 6. Drop columns from pmw_proposals
        // We use raw queries here because Forge can be sensitive about indices and foreign keys
        // during dropColumn operations in some MySQL versions.
        $db->query("SET FOREIGN_KEY_CHECKS=0");
        
        $columnsToDrop = [
            'lecturer_id',
            'mentor_id',
            'pitching_dosen_status',
            'pitching_admin_status',
            'pitching_dosen_catatan',
            'pitching_admin_catatan',
            'wawancara_status',
            'wawancara_catatan',
            'implementasi_status',
            'implementasi_catatan',
        ];

        foreach ($columnsToDrop as $column) {
            // Check if column exists before dropping (safety)
            if ($db->fieldExists($column, 'pmw_proposals')) {
                // Try to drop foreign key if it exists (by convention)
                try {
                    $db->query("ALTER TABLE pmw_proposals DROP FOREIGN KEY pmw_proposals_{$column}_foreign");
                } catch (\Exception $e) { /* ignore if not found */ }
                
                // Try to drop index if it exists (by convention)
                try {
                    $db->query("ALTER TABLE pmw_proposals DROP INDEX pmw_proposals_{$column}_foreign");
                } catch (\Exception $e) { /* ignore if not found */ }

                $db->query("ALTER TABLE pmw_proposals DROP COLUMN $column");
            }
        }
        
        $db->query("SET FOREIGN_KEY_CHECKS=1");
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $db->query("SET FOREIGN_KEY_CHECKS=0");

        // 1. Add columns back to pmw_proposals
        $this->forge->addColumn('pmw_proposals', [
            'lecturer_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'leader_user_id',
            ],
            'mentor_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'lecturer_id',
            ],
            'pitching_dosen_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default' => 'pending',
                'after' => 'video_url',
            ],
            'pitching_admin_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default' => 'pending',
                'after' => 'pitching_dosen_status',
            ],
            'pitching_dosen_catatan' => ['type' => 'TEXT', 'null' => true, 'after' => 'pitching_admin_status'],
            'pitching_admin_catatan' => ['type' => 'TEXT', 'null' => true, 'after' => 'pitching_dosen_catatan'],
            'wawancara_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default' => 'pending',
                'after' => 'pitching_admin_catatan',
            ],
            'wawancara_catatan' => ['type' => 'TEXT', 'null' => true, 'after' => 'wawancara_status'],
            'implementasi_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default' => 'pending',
                'after' => 'wawancara_catatan',
            ],
            'implementasi_catatan' => ['type' => 'TEXT', 'null' => true, 'after' => 'implementasi_status'],
        ]);

        // Restore foreign keys manually to ensure correct names and constraints
        try {
            $db->query("ALTER TABLE pmw_proposals ADD CONSTRAINT pmw_proposals_lecturer_id_foreign FOREIGN KEY (lecturer_id) REFERENCES pmw_lecturers(id) ON DELETE RESTRICT ON UPDATE CASCADE");
        } catch (\Exception $e) {}
        try {
            $db->query("ALTER TABLE pmw_proposals ADD CONSTRAINT pmw_proposals_mentor_id_foreign FOREIGN KEY (mentor_id) REFERENCES pmw_mentors(id) ON DELETE SET NULL ON UPDATE CASCADE");
        } catch (\Exception $e) {}

        // 2. Restore Data
        $db->query("UPDATE pmw_proposals p JOIN pmw_proposal_assignments a ON p.id = a.proposal_id SET p.lecturer_id = a.lecturer_id, p.mentor_id = a.mentor_id");
        $db->query("UPDATE pmw_proposals p JOIN pmw_selection_pitching s ON p.id = s.proposal_id 
                    SET p.pitching_dosen_status = s.dosen_status, p.pitching_admin_status = s.admin_status, 
                        p.pitching_dosen_catatan = s.dosen_catatan, p.pitching_admin_catatan = s.admin_catatan");
        $db->query("UPDATE pmw_proposals p JOIN pmw_selection_wawancara s ON p.id = s.proposal_id SET p.wawancara_status = s.status, p.wawancara_catatan = s.catatan");
        $db->query("UPDATE pmw_proposals p JOIN pmw_selection_implementasi s ON p.id = s.proposal_id SET p.implementasi_status = s.status, p.implementasi_catatan = s.catatan");

        // 3. Drop new tables
        $this->forge->dropTable('pmw_proposal_assignments');
        $this->forge->dropTable('pmw_selection_pitching');
        $this->forge->dropTable('pmw_selection_wawancara');
        $this->forge->dropTable('pmw_selection_implementasi');

        $db->query("SET FOREIGN_KEY_CHECKS=1");
    }
}
