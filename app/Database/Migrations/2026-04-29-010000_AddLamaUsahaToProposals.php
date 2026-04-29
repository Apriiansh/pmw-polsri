<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLamaUsahaToProposals extends Migration
{
    public function up(): void
    {
        $this->db->query("ALTER TABLE pmw_proposals ADD COLUMN lama_usaha_tahun INT UNSIGNED NULL DEFAULT NULL AFTER detail_keterangan");
        $this->db->query("ALTER TABLE pmw_proposals ADD COLUMN lama_usaha_bulan INT UNSIGNED NULL DEFAULT NULL AFTER lama_usaha_tahun");
    }

    public function down(): void
    {
        $this->db->query("ALTER TABLE pmw_proposals DROP COLUMN lama_usaha_bulan");
        $this->db->query("ALTER TABLE pmw_proposals DROP COLUMN lama_usaha_tahun");
    }
}
