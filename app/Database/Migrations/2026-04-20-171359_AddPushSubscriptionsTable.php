<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPushSubscriptionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'endpoint' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'key_p256dh' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'key_auth' => [
                'type'       => 'TEXT',
                'null'       => false,
            ],
            'content_encoding' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'aes128gcm',
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
        $this->forge->createTable('push_subscriptions');
    }

    public function down()
    {
        $this->forge->dropTable('push_subscriptions');
    }
}
