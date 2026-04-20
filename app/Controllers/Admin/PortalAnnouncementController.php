<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PortalAnnouncementModel;
use CodeIgniter\HTTP\ResponseInterface;

class PortalAnnouncementController extends BaseController
{
    protected $announcementModel;

    public function __construct()
    {
        $this->announcementModel = new PortalAnnouncementModel();
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
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title'        => $this->request->getPost('title'),
            'slug'         => $this->request->getPost('slug'),
            'category'     => $this->request->getPost('category'),
            'type'         => $this->request->getPost('type'),
            'content'      => $this->request->getPost('content'),
            'date'         => $this->request->getPost('date'),
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
        ];

        $this->announcementModel->insert($data);

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
            'announcement' => $announcement
        ]);
    }

    public function update($id)
    {
        $announcement = $this->announcementModel->find($id);
        if (!$announcement) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = $this->announcementModel->getValidationRules();
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title'        => $this->request->getPost('title'),
            'slug'         => $this->request->getPost('slug'),
            'category'     => $this->request->getPost('category'),
            'type'         => $this->request->getPost('type'),
            'content'      => $this->request->getPost('content'),
            'date'         => $this->request->getPost('date'),
            'is_published' => $this->request->getPost('is_published') ? 1 : 0,
        ];

        $this->announcementModel->update($id, $data);

        return redirect()->to(base_url('admin/portal-announcements'))->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->announcementModel->delete($id);
        return redirect()->to(base_url('admin/portal-announcements'))->with('success', 'Pengumuman berhasil dihapus.');
    }
}
