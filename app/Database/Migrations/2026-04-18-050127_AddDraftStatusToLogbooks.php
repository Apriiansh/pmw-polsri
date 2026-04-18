<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDraftStatusToLogbooks extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE pmw_guidance_logbooks MODIFY COLUMN status ENUM('draft', 'pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending'");
    }

    public function down()
    {
        // To rollback, we change back to original but need to handle potential 'draft' values
        $this->db->query("UPDATE pmw_guidance_logbooks SET status = 'pending' WHERE status = 'draft'");
        $this->db->query("ALTER TABLE pmw_guidance_logbooks MODIFY COLUMN status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending'");
    }
}
