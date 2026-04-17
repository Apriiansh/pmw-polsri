<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StandardizeSelectionFields extends Migration
{
    public function up()
    {
        // Standardize pmw_selection_wawancara
        $this->forge->modifyColumn('pmw_selection_wawancara', [
            'status' => [
                'name' => 'admin_status',
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'revision', 'rejected'],
                'default' => 'pending'
            ],
            'catatan' => [
                'name' => 'admin_catatan',
                'type' => 'TEXT',
                'null' => true
            ]
        ]);

        // Standardize pmw_selection_implementasi
        $this->forge->modifyColumn('pmw_selection_implementasi', [
            'status' => [
                'name' => 'admin_status',
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'revision', 'rejected'],
                'default' => 'pending'
            ],
            'catatan' => [
                'name' => 'admin_catatan',
                'type' => 'TEXT',
                'null' => true
            ]
        ]);
    }

    public function down()
    {
        // Revert pmw_selection_wawancara
        $this->forge->modifyColumn('pmw_selection_wawancara', [
            'admin_status' => [
                'name' => 'status',
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'revision', 'rejected'],
                'default' => 'pending'
            ],
            'admin_catatan' => [
                'name' => 'catatan',
                'type' => 'TEXT',
                'null' => true
            ]
        ]);

        // Revert pmw_selection_implementasi
        $this->forge->modifyColumn('pmw_selection_implementasi', [
            'admin_status' => [
                'name' => 'status',
                'type' => 'ENUM',
                'constraint' => ['pending', 'approved', 'revision', 'rejected'],
                'default' => 'pending'
            ],
            'admin_catatan' => [
                'name' => 'catatan',
                'type' => 'TEXT',
                'null' => true
            ]
        ]);
    }
}
