<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCertificateToExpoSubmissions extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_expo_submissions', [
            'certificate_path' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'after'      => 'summary'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_expo_submissions', 'certificate_path');
    }
}
