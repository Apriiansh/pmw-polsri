<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFotoToProposalMembersMigration extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_proposal_members', [
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'email',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_proposal_members', 'foto');
    }
}
