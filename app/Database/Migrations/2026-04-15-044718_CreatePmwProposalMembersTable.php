<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePmwProposalMembersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'proposal_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['ketua', 'anggota'],
                'null'       => false,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'nim' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'jurusan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'prodi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'semester' => [
                'type'       => 'INT',
                'constraint' => 2,
                'null'       => true,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('proposal_id');
        $this->forge->addKey(['proposal_id', 'role']);

        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('pmw_proposal_members');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_proposal_members');
    }
}
