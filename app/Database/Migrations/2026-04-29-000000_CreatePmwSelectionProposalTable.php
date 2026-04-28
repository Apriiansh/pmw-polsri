<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePmwSelectionProposalTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'proposal_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'student_submitted_at' => ['type' => 'DATETIME', 'null' => true],
            'dosen_status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default'    => 'pending',
            ],
            'admin_status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'rejected', 'revision'],
                'default'    => 'pending',
            ],
            'dosen_catatan' => ['type' => 'TEXT', 'null' => true],
            'admin_catatan'  => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_selection_proposal');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_selection_proposal');
    }
}
