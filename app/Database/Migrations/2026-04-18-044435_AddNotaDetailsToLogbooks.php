<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNotaDetailsToLogbooks extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_guidance_logbooks', [
            'nota_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'nota_file',
            ],
            'nota_qty' => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 1,
                'after'    => 'nota_title',
            ],
            'nota_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
                'after'      => 'nota_qty',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_guidance_logbooks', ['nota_title', 'nota_qty', 'nota_price']);
    }
}
