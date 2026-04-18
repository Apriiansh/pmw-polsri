<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDualValidationToImplementasi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_selection_implementasi', [
            'student_submitted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'proposal_id',
            ],
            'dosen_status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'approved', 'revision', 'rejected'],
                'default'    => 'pending',
                'after'      => 'student_submitted_at',
            ],
            'dosen_catatan' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'dosen_status',
            ],
            'dosen_verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'dosen_catatan',
            ],
            'admin_verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'admin_catatan',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_selection_implementasi', [
            'student_submitted_at',
            'dosen_status',
            'dosen_catatan',
            'dosen_verified_at',
            'admin_verified_at'
        ]);
    }
}
