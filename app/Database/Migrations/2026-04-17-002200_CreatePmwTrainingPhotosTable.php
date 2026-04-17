<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePmwTrainingPhotosTable extends Migration
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
            'report_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'original_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('report_id', 'pmw_training_reports', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_training_photos');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_training_photos');
    }
}
