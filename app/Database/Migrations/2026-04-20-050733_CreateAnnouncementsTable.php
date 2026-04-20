<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAnnouncementsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'category'     => ['type' => 'VARCHAR', 'constraint' => 50], // Penting, Info, Jadwal, Prestasi, Umum
            'type'         => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'normal'], // urgent, normal, success, warning
            'content'      => ['type' => 'TEXT', 'null' => true],
            'date'         => ['type' => 'DATE', 'null' => true],
            'is_published' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('portal_announcements');
    }

    public function down()
    {
        $this->forge->dropTable('portal_announcements');
    }
}
