<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePmwAnnouncementsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'period_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'phase_number' => ['type' => 'INT', 'constraint' => 2, 'default' => 5],
            'title'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'content'      => ['type' => 'TEXT', 'null' => true],
            'is_published' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'published_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['period_id', 'phase_number']);
        $this->forge->addForeignKey('period_id', 'pmw_periods', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pmw_announcements');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_announcements');
    }
}
