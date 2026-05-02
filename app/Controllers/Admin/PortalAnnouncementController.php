<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PortalAnnouncementModel;
use App\Models\AnnouncementAttachmentModel;
use App\Models\PushSubscriptionModel;
use CodeIgniter\HTTP\ResponseInterface;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class PortalAnnouncementController extends BaseController
{
    protected $announcementModel;
    protected $attachmentModel;
    protected $pushModel;

    public function __construct()
    {
        $this->announcementModel = new PortalAnnouncementModel();
        $this->attachmentModel = new AnnouncementAttachmentModel();
        $this->pushModel = new PushSubscriptionModel();
    }

    public function index(): string
    {
        $data = [
            'title'         => 'Manajemen Pengumuman Portal',
            'announcements' => $this->announcementModel->orderBy('date', 'DESC')->findAll(),
        ];

        return view('admin/portal_announcements/index', $data);
    }

    public function create(): string
    {
        return view('admin/portal_announcements/create', [
            'title' => 'Tambah Pengumuman Baru'
        ]);
    }

    public function store()
    {
        $rules = $this->announcementModel->getValidationRules();
        // Map validation rule 'content' to form field 'announcement_content'
        $rules['announcement_content'] = $rules['content'];
        unset($rules['content']);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get HTML directly from Quill (simple!)
        $data = [
            'title'        => $this->request->getPost('title'),
            'slug'         => $this->request->getPost('slug'),
            'category'     => $this->request->getPost('category'),
            'type'         => $this->request->getPost('type'),
            'content'      => $this->request->getPost('announcement_content'),
            'date'         => $this->request->getPost('date'),
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
        ];

        log_message('debug', 'New Announcement Content: ' . $data['content']);

        $announcementId = $this->announcementModel->insert($data);

        // Send Push Notification if requested
        if ($this->request->getPost('send_push')) {
            $this->sendPushNotification($data);
        }

        // Handle Attachments
        $files = $this->request->getFileMultiple('attachments');
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads/announcements/' . $announcementId, $newName);

                    $this->attachmentModel->insert([
                        'announcement_id' => $announcementId,
                        'file_path'       => 'uploads/announcements/' . $announcementId . '/' . $newName,
                        'file_name'       => $file->getClientName(),
                        'file_type'       => $file->getClientMimeType(),
                        'file_size'       => $file->getSize(),
                    ]);
                }
            }
        }

        return redirect()->to(base_url('admin/portal-announcements'))->with('success', 'Pengumuman berhasil ditambahkan.');
    }


    public function deleteAttachment($id)
    {
        $attachment = $this->attachmentModel->find($id);
        if ($attachment) {
            if (is_file(FCPATH . $attachment->file_path)) {
                unlink(FCPATH . $attachment->file_path);
            }
            $this->attachmentModel->delete($id);
            return $this->response->setJSON(['success' => true]);
        }
        return $this->response->setJSON(['success' => false], 404);
    }

    public function delete($id)
    {
        $attachments = $this->attachmentModel->where('announcement_id', $id)->findAll();
        foreach ($attachments as $attachment) {
            if (is_file(FCPATH . $attachment->file_path)) {
                unlink(FCPATH . $attachment->file_path);
            }
        }
        
        // Delete directory if empty
        $dir = FCPATH . 'uploads/announcements/' . $id;
        if (is_dir($dir)) {
            @rmdir($dir);
        }

        $this->announcementModel->delete($id);
        return redirect()->to(base_url('admin/portal-announcements'))->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function sendPushManual($id)
    {
        $announcement = $this->announcementModel->find($id);
        if (!$announcement) {
            return redirect()->back()->with('error', 'Pengumuman tidak ditemukan.');
        }

        $this->sendPushNotification($announcement);
        return redirect()->back()->with('success', 'Notifikasi berhasil dikirim ulang ke semua subscriber.');
    }

    private function sendPushNotification($data)
    {
        $subscriptions = $this->pushModel->findAll();
        if (empty($subscriptions)) return;

        $auth = [
            'VAPID' => [
                'subject'    => 'mailto:uptpkk_kewirausahaan@polsri.ac.id',
                'publicKey'  => env('webpush.publicKey'),
                'privateKey' => env('webpush.privateKey'),
            ],
        ];

        // Temporarily suppress notices for WebPush (BCMath/GMP warning)
        $oldErrorReporting = error_reporting();
        error_reporting($oldErrorReporting & ~E_USER_NOTICE);
        
        $webPush = new WebPush($auth);
        
        error_reporting($oldErrorReporting); // Restore error reporting
        
        $payload = json_encode([
            'title' => 'Pengumuman: ' . $data['title'],
            'body'  => 'Ada informasi terbaru di portal PMW Polsri. Cek sekarang!',
            'url'   => base_url('pengumuman/' . $data['slug']),
            'icon'  => base_url('assets/img/logo-polsri.png'), // Pastikan path logo benar
        ]);

        foreach ($subscriptions as $sub) {
            $webPush->queueNotification(
                Subscription::create([
                    'endpoint' => $sub['endpoint'],
                    'keys'     => [
                        'p256dh' => $sub['p256dh'],
                        'auth'   => $sub['auth'],
                    ],
                ]),
                $payload
            );
        }

        // Send all notifications in the queue
        foreach ($webPush->flush() as $report) {
            $endpoint = $report->getEndpoint();
            if (!$report->isSuccess()) {
                // If notification fails because subscription is expired/invalid, delete it
                if ($report->isSubscriptionExpired()) {
                    $this->pushModel->where('endpoint', $endpoint)->delete();
                }
                log_message('error', "Push Notification failed for {$endpoint}: {$report->getReason()}");
            }
        }
    }
}
