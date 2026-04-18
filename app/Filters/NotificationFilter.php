<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\NotificationModel;

class NotificationFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! $request instanceof \CodeIgniter\HTTP\IncomingRequest) {
            return;
        }

        $notifId = $request->getGet('notif');
        
        if ($notifId && auth()->loggedIn()) {
            $notificationModel = new NotificationModel();
            $notification = $notificationModel->find($notifId);
            
            if ($notification) {
                $user = auth()->user();
                $userId = $user->inGroup('admin') ? null : (int)$user->id;
                
                // Only mark as read if it belongs to the user (or it's an admin notification)
                if ($notification['user_id'] === $userId || $user->inGroup('admin')) {
                    $notificationModel->markAsRead((int)$notifId);
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
