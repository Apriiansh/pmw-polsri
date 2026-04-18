<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddActivityLogbookPhotosTable extends Migration
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
            'logbook_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'original_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->addForeignKey('logbook_id', 'pmw_activity_logbooks', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_activity_logbook_photos');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_activity_logbook_photos');
    }
}
