<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAdminAssessmentToPitchingAssessments extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_pitching_assessments', [
            'is_admin_assessment' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 0,
                'after'      => 'penilai_user_id',
            ],
            'edited_by_admin' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 0,
                'after'      => 'catatan',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_pitching_assessments', 'is_admin_assessment');
        $this->forge->dropColumn('pmw_pitching_assessments', 'edited_by_admin');
    }
}
