<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeAnnouncementContentToJson extends Migration
{
    public function up()
    {
        // Clear existing HTML data that would fail JSON validation
        $this->db->query('UPDATE portal_announcements SET content = NULL');

        $this->forge->modifyColumn('portal_announcements', [
            'content' => [
                'type' => 'JSON',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('portal_announcements', [
            'content' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
    }
}
