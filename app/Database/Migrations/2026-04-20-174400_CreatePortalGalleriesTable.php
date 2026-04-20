<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePortalGalleriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'category'    => ['type' => 'VARCHAR', 'constraint' => 50], // Mentoring, Pitching, dll
            'description' => ['type' => 'TEXT', 'null' => true],
            'image_url'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'is_published'=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'sort_order'  => ['type' => 'INT', 'default' => 0],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('portal_galleries');
    }

    public function down()
    {
        $this->forge->dropTable('portal_galleries');
    }
}
