<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddInstagramUrlToProposals extends Migration
{
    public function up(): void
    {
        $this->db->query("ALTER TABLE pmw_proposals ADD COLUMN instagram_url VARCHAR(255) NULL DEFAULT NULL AFTER lama_usaha_bulan");
    }

    public function down(): void
    {
        $this->db->query("ALTER TABLE pmw_proposals DROP COLUMN instagram_url");
    }
}
