<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePmwProposalsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'period_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'leader_user_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'lecturer_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'kategori_usaha' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'nama_usaha' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'kategori_wirausaha' => [
                'type'       => 'ENUM',
                'constraint' => ['pemula', 'berkembang'],
                'default'    => 'pemula',
                'null'       => false,
            ],
            'total_rab' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'submitted', 'revision', 'approved', 'rejected'],
                'default'    => 'draft',
                'null'       => false,
            ],
            'submitted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('period_id');
        $this->forge->addKey('leader_user_id');
        $this->forge->addUniqueKey(['period_id', 'leader_user_id']);

        $this->forge->addForeignKey('period_id', 'pmw_periods', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('leader_user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('lecturer_id', 'pmw_lecturers', 'id', 'RESTRICT', 'CASCADE');

        $this->forge->createTable('pmw_proposals');
    }

    public function down()
    {
        $this->forge->dropTable('pmw_proposals');
    }
}
