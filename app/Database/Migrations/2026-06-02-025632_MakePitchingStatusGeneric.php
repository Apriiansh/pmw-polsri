<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakePitchingStatusGeneric extends Migration
{
    public function up()
    {
        // Rename admin_status -> status
        $this->forge->modifyColumn('pmw_selection_pitching', [
            'admin_status' => [
                'name'       => 'status',
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default'    => 'pending',
            ],
        ]);

        // Rename admin_catatan -> catatan
        $this->forge->modifyColumn('pmw_selection_pitching', [
            'admin_catatan' => [
                'name' => 'catatan',
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        // Tambah kolom persentase_nilai
        $this->forge->addColumn('pmw_selection_pitching', [
            'persentase_nilai' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => true,
                'after'      => 'catatan',
            ],
        ]);
    }

    public function down()
    {
        // Drop persentase_nilai
        $this->forge->dropColumn('pmw_selection_pitching', 'persentase_nilai');

        // Revert catatan -> admin_catatan
        $this->forge->modifyColumn('pmw_selection_pitching', [
            'catatan' => [
                'name' => 'admin_catatan',
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        // Revert status -> admin_status
        $this->forge->modifyColumn('pmw_selection_pitching', [
            'status' => [
                'name'       => 'admin_status',
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default'    => 'pending',
            ],
        ]);
    }
}
