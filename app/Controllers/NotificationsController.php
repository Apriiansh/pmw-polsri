<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotificationModel;

class NotificationsController extends BaseController
{
    protected $helpers = ['url', 'pmw'];

    /**
     * Display all notifications page
     */
    public function index()
    {
        $user = auth()->user();
        $notificationModel = new NotificationModel();

        $userId = $user->inGroup('admin') ? null : (int) $user->id;
        $notifications = $notificationModel->getForUser($userId, 50);

        return view('notifications/index', [
            'title'         => 'Notifikasi | PMW Polsri',
            'header_title'  => 'Notifikasi',
            'header_subtitle' => 'Daftar semua notifikasi sistem',
            'notifications' => $notifications,
        ]);
    }

    /**
     * Mark notification as read
     */
    public function markAsRead(int $id)
    {
        $notificationModel = new NotificationModel();
        $notification = $notificationModel->find($id);

        if (!$notification) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Notifikasi tidak ditemukan',
            ]);
        }

        $user = auth()->user();
        $userId = $user->inGroup('admin') ? null : (int) $user->id;

        // Only allow marking own notifications or admin notifications
        if ($notification['user_id'] !== $userId && !$user->inGroup('admin')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized',
            ]);
        }

        $result = $notificationModel->markAsRead($id);

        return $this->response->setJSON([
            'success' => $result,
            'message' => $result ? 'Notifikasi ditandai dibaca' : 'Gagal',
        ]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        $user = auth()->user();
        $notificationModel = new NotificationModel();

        $userId = $user->inGroup('admin') ? null : (int) $user->id;
        $result = $notificationModel->markAllAsRead($userId);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Semua notifikasi ditandai dibaca',
        ]);
    }

    /**
     * Get unread count (for AJAX polling)
     */
    public function unreadCount()
    {
        $user = auth()->user();
        $notificationModel = new NotificationModel();

        $userId = $user->inGroup('admin') ? null : (int) $user->id;
        $count = $notificationModel->countUnread($userId);

        return $this->response->setJSON([
            'count' => $count,
        ]);
    }

    /**
     * Get recent notifications (for AJAX)
     */
    public function recent()
    {
        $user = auth()->user();
        $notificationModel = new NotificationModel();

        $userId = $user->inGroup('admin') ? null : (int) $user->id;
        $notifications = $notificationModel->getUnread($userId, 5);

        // Format for response
        $formatted = array_map(function ($n) {
            return [
                'id'      => $n['id'],
                'title'   => $n['title'],
                'message' => $n['message'],
                'link'    => $n['link'],
                'type'    => $n['type'],
                'time'    => time_elapsed_string($n['created_at']),
            ];
        }, $notifications);

        return $this->response->setJSON([
            'notifications' => $formatted,
            'count'         => count($notifications),
        ]);
    }
}
