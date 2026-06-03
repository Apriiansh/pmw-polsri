<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePmwPitchingAssessments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'proposal_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'penilai_user_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'status'           => ['type' => 'ENUM', 'constraint' => ['approved', 'rejected']],
            'catatan'          => ['type' => 'TEXT', 'null' => true],
            'persentase_nilai' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
            'submitted_at'     => ['type' => 'DATETIME', 'null' => true],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey(['proposal_id', 'penilai_user_id']);
        $this->forge->addKey('proposal_id');
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', '', 'CASCADE');
        $this->forge->addForeignKey('penilai_user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('pmw_pitching_assessments');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_pitching_assessments');
    }
}
