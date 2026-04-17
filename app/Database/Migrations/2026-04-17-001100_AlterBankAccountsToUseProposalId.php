<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterBankAccountsToUseProposalId extends Migration
{
    public function up()
    {
        // Drop old table and recreate with proposal_id instead of team_id
        $this->forge->dropTable('pmw_bank_accounts', true);

        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'proposal_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'period_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'bank_name' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'account_holder_name' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => false],
            'account_number' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
            'branch_office' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'bank_book_scan' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'description' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['proposal_id']);
        $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('period_id', 'pmw_periods', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_bank_accounts');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_bank_accounts');
    }
}
