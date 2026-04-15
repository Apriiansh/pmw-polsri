<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPmwDocumentsAddProposalColumns extends Migration
{
    public function up()
    {
        $fields = [
            'proposal_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
                'after'    => 'team_id',
            ],
            'doc_key' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
                'after'      => 'type',
            ],
        ];

        $this->forge->addColumn('pmw_documents', $fields);

        $this->forge->modifyColumn('pmw_documents', [
            'team_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('proposal_id');
        $this->forge->addKey(['proposal_id', 'doc_key']);
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('pmw_documents', 'pmw_documents_proposal_id_foreign');
        $this->forge->dropColumn('pmw_documents', ['proposal_id', 'doc_key']);

        $this->forge->modifyColumn('pmw_documents', [
            'team_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
        ]);
    }
}
