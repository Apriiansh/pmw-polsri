<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLinkPembelianToImplementationPayments extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pmw_implementation_payments', [
            'link_pembelian' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'payment_title',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pmw_implementation_payments', 'link_pembelian');
    }
}
