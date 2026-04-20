<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenamePushSubscriptionColumns extends Migration
{
    public function up()
    {
        $fields = [
            'key_p256dh' => [
                'name' => 'p256dh',
                'type' => 'TEXT',
            ],
            'key_auth' => [
                'name' => 'auth',
                'type' => 'TEXT',
            ],
        ];
        $this->forge->modifyColumn('push_subscriptions', $fields);

        // Drop content_encoding because it's usually fixed to aes128gcm in modern push
        $this->forge->dropColumn('push_subscriptions', 'content_encoding');
    }

    public function down()
    {
        $fields = [
            'p256dh' => [
                'name' => 'key_p256dh',
                'type' => 'TEXT',
            ],
            'auth' => [
                'name' => 'key_auth',
                'type' => 'TEXT',
            ],
        ];
        $this->forge->modifyColumn('push_subscriptions', $fields);
        $this->forge->addColumn('push_subscriptions', [
            'content_encoding' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'aes128gcm']
        ]);
    }
}
