<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFinalizationToSelectionPitching extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_selection_pitching', [
            'penilaian_final_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'persentase_nilai',
            ],
            'penilaian_final_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'penilaian_final_at',
            ],
        ]);

        $this->forge->addForeignKey('penilaian_final_by', 'users', 'id', '', 'SET NULL');
        $this->forge->addKey('penilaian_final_at');
    }

    public function down()
    {
        $this->forge->dropForeignKey('pmw_selection_pitching', 'pmw_selection_pitching_penilaian_final_by_foreign');
        $this->forge->dropColumn('pmw_selection_pitching', 'penilaian_final_at');
        $this->forge->dropColumn('pmw_selection_pitching', 'penilaian_final_by');
    }
}
