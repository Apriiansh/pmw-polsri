<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategoryToImplementationItems extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_implementation_items', [
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'after'      => 'item_description',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_implementation_items', 'category');
    }
}
