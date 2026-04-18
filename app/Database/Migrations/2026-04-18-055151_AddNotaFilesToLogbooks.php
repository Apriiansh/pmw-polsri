<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNotaFilesToLogbooks extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_guidance_logbooks', [
            'nota_files' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'nota_file',
                'comment'    => 'Stored as JSON array of file paths',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_guidance_logbooks', 'nota_files');
    }
}
