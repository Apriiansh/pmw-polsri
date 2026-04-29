<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePmwProposalRabItems extends Migration
{
    public function up(): void
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
            'nama_item' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'qty' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 1,
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'unit',
            ],
            'harga_satuan' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
            ],
            'urutan' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
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
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('pmw_proposal_rab_items');
    }

    public function down(): void
    {
        $this->forge->dropTable('pmw_proposal_rab_items', true);
    }
}
