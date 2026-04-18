<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddQtyToImplementationItems extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_implementation_items', [
            'qty' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
                'after'      => 'item_description'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_implementation_items', 'qty');
    }
}
