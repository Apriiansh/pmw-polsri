<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNotaItemsToLogbooks extends Migration
{
    public function up()
    {
        // Add nota_items JSON column to replace the single nota_title/qty/price columns
        $this->db->query("ALTER TABLE pmw_guidance_logbooks ADD COLUMN nota_items TEXT NULL AFTER nota_file");

        // Drop the old single-nota columns (data migration: pack into JSON first if needed)
        // We'll drop them cleanly since the table is empty in dev
        $this->db->query("ALTER TABLE pmw_guidance_logbooks DROP COLUMN nota_title");
        $this->db->query("ALTER TABLE pmw_guidance_logbooks DROP COLUMN nota_qty");
        $this->db->query("ALTER TABLE pmw_guidance_logbooks DROP COLUMN nota_price");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE pmw_guidance_logbooks DROP COLUMN nota_items");

        $this->db->query("ALTER TABLE pmw_guidance_logbooks ADD COLUMN nota_title VARCHAR(255) NULL AFTER nota_file");
        $this->db->query("ALTER TABLE pmw_guidance_logbooks ADD COLUMN nota_qty INT NULL DEFAULT 1 AFTER nota_title");
        $this->db->query("ALTER TABLE pmw_guidance_logbooks ADD COLUMN nota_price DECIMAL(15,2) NULL DEFAULT 0 AFTER nota_qty");
    }
}
