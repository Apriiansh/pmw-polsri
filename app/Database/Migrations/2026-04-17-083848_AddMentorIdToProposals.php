<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMentorIdToProposals extends Migration
{
    public function up()
    {
        $fields = [
            'mentor_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'lecturer_id',
            ],
        ];
        $this->forge->addColumn('pmw_proposals', $fields);
        $this->forge->addForeignKey('mentor_id', 'pmw_mentors', 'id', 'SET NULL', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('pmw_proposals', 'pmw_proposals_mentor_id_foreign');
        $this->forge->dropColumn('pmw_proposals', 'mentor_id');
    }
}
