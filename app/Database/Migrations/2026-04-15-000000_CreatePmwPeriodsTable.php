<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePmwPeriodsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'year' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'is_active' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('year');
        $this->forge->addKey('is_active');
        $this->forge->createTable('pmw_periods');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_periods');
    }
}
