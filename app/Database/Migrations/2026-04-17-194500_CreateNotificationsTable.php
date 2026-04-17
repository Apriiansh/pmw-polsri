<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'message' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'data_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'is_read' => [
                'type'    => 'BOOLEAN',
                'default' => false,
                'null'    => false,
            ],
            'read_at' => [
                'type' => 'DATETIME',
                'null' => true,
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
        $this->forge->addKey('user_id');
        $this->forge->addKey('type');
        $this->forge->addKey('is_read');
        $this->forge->addKey('created_at');

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'SET_NULL');

        $this->forge->createTable('pmw_notifications');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_notifications');
    }
}
