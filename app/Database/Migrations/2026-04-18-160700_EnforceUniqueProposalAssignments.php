<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EnforceUniqueProposalAssignments extends Migration
{
    public function up()
    {
        // Adding unique constraints to lecturer_id and mentor_id
        // This ensures one lecturer/mentor can only be assigned to one team (proposal)
        // NULL values are allowed multiple times in MySQL unique indexes
        
        $this->forge->addUniqueKey('lecturer_id', 'unique_lecturer_assignment');
        $this->forge->addUniqueKey('mentor_id', 'unique_mentor_assignment');
        
        // Use process to alter the table since addUniqueKey usually works during table creation
        // but for existing tables we might need to manually call the alter or use a trick.
        // Actually, forge->processIndexes('table') is what we need if we want to add keys later.
        // But CI4 Forge doesn't have processIndexes for adding keys to existing tables easily in all versions.
        // The most reliable way for an existing table in CI4 is raw SQL or drop/recreate keys.
        
        $this->db->query("ALTER TABLE pmw_proposal_assignments ADD UNIQUE INDEX unique_lecturer_assignment (lecturer_id)");
        $this->db->query("ALTER TABLE pmw_proposal_assignments ADD UNIQUE INDEX unique_mentor_assignment (mentor_id)");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE pmw_proposal_assignments DROP INDEX unique_lecturer_assignment");
        $this->db->query("ALTER TABLE pmw_proposal_assignments DROP INDEX unique_mentor_assignment");
    }
}
