<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdatePmwAuthTables extends Migration
{
    public function up()
    {
        // 1. Add foto column to pmw_profiles
        $this->forge->addColumn('pmw_profiles', [
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'socio_economic',
            ],
        ]);

        // 2. Add business columns to pmw_teams
        $this->forge->addColumn('pmw_teams', [
            'nama_usaha' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'status',
            ],
            'jenis_usaha' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'nama_usaha',
            ],
            'pitching_category' => [
                'type' => 'ENUM',
                'constraint' => ['pemula', 'berkembang'],
                'null' => true,
                'after' => 'jenis_usaha',
            ],
        ]);
    }

    public function down()
    {
        // Remove columns from pmw_profiles
        $this->forge->dropColumn('pmw_profiles', 'foto');

        // Remove columns from pmw_teams
        $this->forge->dropColumn('pmw_teams', ['nama_usaha', 'jenis_usaha', 'pitching_category']);
    }
}
