<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterColumnStatusUsahaToKategoriWirausaha extends Migration
{
    public function up()
    {
        // Rename column from status_usaha to kategori_wirausaha and change values
        $this->forge->modifyColumn('pmw_proposals', [
            'status_usaha' => [
                'name'       => 'kategori_wirausaha',
                'type'       => 'ENUM',
                'constraint' => ['pemula', 'berkembang'],
                'default'    => 'pemula',
                'null'       => false,
            ],
        ]);
    }

    public function down()
    {
        // Revert back to status_usaha with old values
        $this->forge->modifyColumn('pmw_proposals', [
            'kategori_wirausaha' => [
                'name'       => 'status_usaha',
                'type'       => 'ENUM',
                'constraint' => ['baru', 'sudah_berjalan'],
                'default'    => 'baru',
                'null'       => false,
            ],
        ]);
    }
}
