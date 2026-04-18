<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleToActivityLogbookPhotos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_activity_logbook_photos', [
            'uploader_role' => [
                'type'       => 'ENUM',
                'constraint' => ['student', 'admin', 'reviewer'],
                'default'    => 'student',
                'after'      => 'logbook_id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_activity_logbook_photos', 'uploader_role');
    }
}
