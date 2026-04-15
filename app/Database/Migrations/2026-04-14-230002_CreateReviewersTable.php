<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReviewersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'nidn'        => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'nip'         => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'institution' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'expertise'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phone'       => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'bio'         => ['type' => 'TEXT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_reviewers');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_reviewers');
    }
}
