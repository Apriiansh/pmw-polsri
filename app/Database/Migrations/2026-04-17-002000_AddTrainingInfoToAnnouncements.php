<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTrainingInfoToAnnouncements extends Migration
{
    public function up()
    {
        $fields = [
            'training_date' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'content',
            ],
            'training_location' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'training_date',
            ],
            'training_details' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'training_location',
            ],
            'sk_file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'training_details',
            ],
            'sk_original_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'sk_file_path',
            ],
        ];

        $this->forge->addColumn('pmw_announcements', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_announcements', [
            'training_date',
            'training_location',
            'training_details',
            'sk_file_path',
            'sk_original_name',
        ]);
    }
}
