<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdatePmwDocumentTypes extends Migration
{
    public function up()
    {
        // Update ENUM values for 'type' column in 'pmw_documents'
        $this->forge->modifyColumn('pmw_documents', [
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['proposal', 'laporan_awal', 'laporan_akhir', 'nota', 'dokumentasi_alat', 'pitching', 'perjanjian'],
                'default'    => 'proposal',
            ],
        ]);

        // Fix existing data where type became empty due to missing enum value 'pitching'
        $db = \Config\Database::connect();
        $db->table('pmw_documents')
            ->where('doc_key', 'pitching_ppt')
            ->where('type', '')
            ->update(['type' => 'pitching']);
    }

    public function down()
    {
        // Revert ENUM values (might cause data loss for 'pitching' and 'perjanjian' types)
        $this->forge->modifyColumn('pmw_documents', [
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['proposal', 'laporan_awal', 'laporan_akhir', 'nota', 'dokumentasi_alat'],
                'default'    => 'proposal',
            ],
        ]);
    }
}
