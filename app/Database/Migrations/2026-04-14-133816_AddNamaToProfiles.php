<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNamaToProfiles extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_profiles', [
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'after'      => 'user_id',
                'null'       => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_profiles', 'nama');
    }
}
