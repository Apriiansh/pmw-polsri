<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PortalGalleryModel;

class GalleryController extends BaseController
{
    protected $galleryModel;

    public function __construct()
    {
        $this->galleryModel = new PortalGalleryModel();
    }

    /**
     * Tampilan Utama Manajemen Galeri (CMS Style)
     */
    public function index()
    {
        $pageFilter   = $this->request->getGet('page') ?? 'galeri';
        $activeGroup  = $this->request->getGet('group') ?? 'all';
        $category     = $this->request->getGet('category') ?? 'all';

        $query = $this->galleryModel->orderBy('sort_order', 'ASC')
                                  ->orderBy('created_at', 'DESC');

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $data = [
            'title'       => 'Manajemen Galeri Visual',
            'galleries'   => $query->findAll(),
            'pageFilter'  => $pageFilter,
            'activeGroup' => $activeGroup,
            'category'    => $category,
            'categories'  => ['Mentoring', 'Pitching', 'Bazaar', 'Awarding', 'Workshop', 'Dokumentasi', 'Produk Binaan']
        ];

        return view('admin/gallery/index', $data);
    }

    public function create()
    {
        return view('admin/gallery/create', [
            'title'      => 'Tambah Foto Baru',
            'categories' => ['Mentoring', 'Pitching', 'Bazaar', 'Awarding', 'Workshop', 'Dokumentasi', 'Produk Binaan']
        ]);
    }

    public function store()
    {
        $sourceType = $this->request->getPost('source_type');
        
        $rules = [
            'title'    => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
        ];

        if ($sourceType === 'link') {
            $rules['external_url'] = 'required|valid_url';
        } else {
            $rules['image'] = 'uploaded[image]|max_size[image,5120]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imageUrl = '';
        if ($sourceType === 'link') {
            $imageUrl = $this->request->getPost('external_url');
        } else {
            $image = $this->request->getFile('image');
            $newName = $image->getRandomName();
            if (!is_dir(FCPATH . 'uploads/gallery')) mkdir(FCPATH . 'uploads/gallery', 0777, true);
            $image->move(FCPATH . 'uploads/gallery', $newName);
            $imageUrl = 'uploads/gallery/' . $newName;
        }

        $this->galleryModel->save([
            'title'       => $this->request->getPost('title'),
            'category'    => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
            'image_url'   => $imageUrl,
            'is_published'=> $this->request->getPost('is_published') ?? 1,
            'sort_order'  => $this->request->getPost('sort_order') ?? 0,
        ]);

        return redirect()->to('admin/gallery')->with('success', 'Foto berhasil dipublikasikan.');
    }

    public function edit($id)
    {
        $gallery = $this->galleryModel->find($id);
        if (!$gallery) {
            return redirect()->to('admin/gallery')->with('error', 'Data galeri tidak ditemukan.');
        }

        return view('admin/gallery/edit', [
            'title'      => 'Edit Dokumentasi',
            'gallery'    => $gallery,
            'categories' => ['Mentoring', 'Pitching', 'Bazaar', 'Awarding', 'Workshop', 'Dokumentasi', 'Produk Binaan']
        ]);
    }

    public function update($id)
    {
        $gallery = $this->galleryModel->find($id);
        if (!$gallery) return redirect()->to('admin/gallery');

        $sourceType = $this->request->getPost('source_type');
        $rules = [
            'title'    => 'required|min_length[3]|max_length[255]',
            'category' => 'required',
        ];

        $image = $this->request->getFile('image');
        if ($sourceType === 'link') {
            $rules['external_url'] = 'required|valid_url';
        } elseif ($image && $image->isValid()) {
            $rules['image'] = 'uploaded[image]|max_size[image,5120]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id'          => $id,
            'title'       => $this->request->getPost('title'),
            'category'    => $this->request->getPost('category'),
            'description' => $this->request->getPost('description'),
            'is_published'=> $this->request->getPost('is_published') ?? 1,
            'sort_order'  => $this->request->getPost('sort_order') ?? 0,
        ];

        if ($sourceType === 'link') {
            // If switching from local to link, cleanup old file
            if (!filter_var($gallery['image_url'], FILTER_VALIDATE_URL)) {
                if (file_exists(FCPATH . $gallery['image_url'])) unlink(FCPATH . $gallery['image_url']);
            }
            $data['image_url'] = $this->request->getPost('external_url');
        } else {
            if ($image && $image->isValid() && !$image->hasMoved()) {
                // Cleanup old file if it was a local file
                if (!filter_var($gallery['image_url'], FILTER_VALIDATE_URL)) {
                    if (file_exists(FCPATH . $gallery['image_url'])) unlink(FCPATH . $gallery['image_url']);
                }

                $newName = $image->getRandomName();
                $image->move(FCPATH . 'uploads/gallery', $newName);
                $data['image_url'] = 'uploads/gallery/' . $newName;
            }
        }

        $this->galleryModel->save($data);
        return redirect()->to('admin/gallery')->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $gallery = $this->galleryModel->find($id);
        if ($gallery) {
            // Hanya hapus file jika itu file lokal (bukan URL eksternal)
            if (!filter_var($gallery['image_url'], FILTER_VALIDATE_URL)) {
                if (file_exists(FCPATH . $gallery['image_url'])) {
                    unlink(FCPATH . $gallery['image_url']);
                }
            }
            $this->galleryModel->delete($id);
        }

        return redirect()->to('admin/gallery')->with('success', 'Foto telah dihapus.');
    }
}
