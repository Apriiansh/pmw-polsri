<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class PushSubscriptionController extends BaseController
{
    use ResponseTrait;

    public function subscribe()
    {
        $json = $this->request->getJSON();
        
        if (!$json || !isset($json->endpoint)) {
            return $this->fail('Invalid subscription data');
        }

        $db = \Config\Database::connect();
        $builder = $db->table('push_subscriptions');

        // Check if already exists
        $existing = $builder->where('endpoint', $json->endpoint)->get()->getRow();

        $data = [
            'endpoint'   => $json->endpoint,
            'p256dh'     => $json->keys->p256dh,
            'auth'       => $json->keys->auth,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($existing) {
            $builder->where('id', $existing->id)->update($data);
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $builder->insert($data);
        }

        return $this->respondCreated(['success' => true, 'message' => 'Berhasil mendaftarkan perangkat.']);
    }

    public function unsubscribe()
    {
        $json = $this->request->getJSON();
        
        if (!$json || !isset($json->endpoint)) {
            return $this->fail('Invalid subscription data');
        }

        $db = \Config\Database::connect();
        $db->table('push_subscriptions')->where('endpoint', $json->endpoint)->delete();

        return $this->respondDeleted(['success' => true, 'message' => 'Unsubscribed successfully']);
    }
}
