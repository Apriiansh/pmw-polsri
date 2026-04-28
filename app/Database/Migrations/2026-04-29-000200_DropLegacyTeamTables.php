<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropLegacyTeamTables extends Migration
{
    public function up()
    {
        // Drop FK dari tabel lain yang referensi pmw_teams
        $this->forge->dropForeignKey('pmw_mentoring_logs', 'pmw_mentoring_logs_team_id_foreign');
        $this->forge->dropForeignKey('pmw_products', 'pmw_products_team_id_foreign');
        $this->forge->dropForeignKey('pmw_documents', 'pmw_documents_team_id_foreign');

        // Drop kedua tabel legacy (team_members dulu karena FK ke pmw_teams)
        $this->forge->dropTable('pmw_team_members', true);
        $this->forge->dropTable('pmw_teams', true);
    }

    public function down()
    {
        // Recreate pmw_teams
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pmw_teams');

        // Recreate pmw_team_members
        $this->forge->addField([
            'team_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'user_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'role'       => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey(['team_id', 'user_id'], true);
        $this->forge->addForeignKey('team_id', 'pmw_teams', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_team_members');
    }
}
