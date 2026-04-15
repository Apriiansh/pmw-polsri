<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLecturersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nip'         => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'nama'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'jurusan'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'prodi'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'expertise'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'phone'       => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'bio'         => ['type' => 'TEXT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_lecturers');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_lecturers');
    }
}
