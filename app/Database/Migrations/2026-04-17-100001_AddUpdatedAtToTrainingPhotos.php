<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUpdatedAtToTrainingPhotos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_training_photos', [
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'created_at',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_training_photos', 'updated_at');
    }
}
