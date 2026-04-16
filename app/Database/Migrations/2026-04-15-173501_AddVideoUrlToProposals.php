<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVideoUrlToProposals extends Migration
{
    public function up()
    {
        if (!$this->db->fieldExists('video_url', 'pmw_proposals')) {
            $fields = [
                'video_url' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'after'      => 'detail_keterangan'
                ],
            ];
            $this->forge->addColumn('pmw_proposals', $fields);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_proposals', 'video_url');
    }
}
