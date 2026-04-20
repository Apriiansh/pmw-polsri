<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PortalAnnouncementModel;
use App\Models\AnnouncementAttachmentModel;
use CodeIgniter\HTTP\ResponseInterface;

class PortalAnnouncementController extends BaseController
{
    protected $announcementModel;
    protected $attachmentModel;

    public function __construct()
    {
        $this->announcementModel = new PortalAnnouncementModel();
        $this->attachmentModel = new AnnouncementAttachmentModel();
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

    public function edit($id): string
    {
        $announcement = $this->announcementModel->find($id);
        if (!$announcement) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/portal_announcements/edit', [
            'title'        => 'Edit Pengumuman',
            'announcement' => $announcement,
            'attachments'  => $this->attachmentModel->where('announcement_id', $id)->findAll()
        ]);
    }

    public function update($id)
    {
        $announcement = $this->announcementModel->find($id);
        if (!$announcement) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = $this->announcementModel->getValidationRules();
        $rules['slug'] = "required|is_unique[portal_announcements.slug,id,{$id}]";
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

        log_message('debug', 'Announcement Content received: ' . $data['content']);

        $this->announcementModel->update($id, $data);

        // Handle New Attachments
        $files = $this->request->getFileMultiple('attachments');
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads/announcements/' . $id, $newName);

                    $this->attachmentModel->insert([
                        'announcement_id' => $id,
                        'file_path'       => 'uploads/announcements/' . $id . '/' . $newName,
                        'file_name'       => $file->getClientName(),
                        'file_type'       => $file->getClientMimeType(),
                        'file_size'       => $file->getSize(),
                    ]);
                }
            }
        }

        return redirect()->to(base_url('admin/portal-announcements'))->with('success', 'Pengumuman berhasil diperbarui.');
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
}
