<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use App\Models\LecturerModel;
use App\Models\MentorModel;
use App\Models\ReviewerModel;
use App\Models\PmwPeriodModel;
use App\Models\PmwScheduleModel;
use App\Models\PmwDocumentModel;
use App\Models\Guidance\PmwGuidanceLogbookModel;
use App\Models\Activity\PmwActivityLogbookModel;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class AdminController extends BaseController
{
    protected $helpers = ['form', 'url', 'text', 'pmw', 'cms'];

    /**
     * User list page
     */
    public function users()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        // Get groups and profile data for each user
        foreach ($users as $user) {
            $user->groups = $user->getGroups();
            $mainGroup = $user->groups[0] ?? '';

            // Load role-specific profile data
            switch ($mainGroup) {
                case 'mahasiswa':
                    $profileModel = new ProfileModel();
                    $user->profile = $profileModel->where('user_id', $user->id)->first();
                    break;
                case 'dosen':
                    $lecturerModel = new LecturerModel();
                    $user->profile = $lecturerModel->where('user_id', $user->id)->first();
                    break;
                case 'mentor':
                    $mentorModel = new MentorModel();
                    $user->profile = $mentorModel->where('user_id', $user->id)->first();
                    break;
                case 'reviewer':
                    $reviewerModel = new ReviewerModel();
                    $user->profile = $reviewerModel->where('user_id', $user->id)->first();
                    break;
                default:
                    $user->profile = null;
            }
        }

        $data = [
            'title'           => 'Manajemen User | PMW Polsri',
            'header_title'    => 'Manajemen User',
            'header_subtitle' => 'Kelola pengguna sistem dan assign role',
            'users'           => $users,
        ];

        return view('admin/users/manage', $data);
    }

    /**
     * Add new user form
     */
    public function createUser()
    {
        $data = [
            'title'           => 'Tambah User | PMW Polsri',
            'header_title'    => 'Tambah User Baru',
            'header_subtitle' => 'Buat akun pengguna baru dengan role spesifik',
            'roles'           => $this->getAvailableRoles(),
            'jurusanList'     => getJurusanList(),
            'prodiList'       => getProdiList(),
        ];

        return view('admin/users/form', $data);
    }

    /**
     * Edit user form
     */
    public function editUser($id)
    {
        $userModel = new UserModel();
        $user = $userModel->findById($id);

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User tidak ditemukan');
        }

        $userGroups = $user->getGroups();
        $role = $userGroups[0] ?? '';
        $profileData = null;

        // Load role-specific profile data
        switch ($role) {
            case 'mahasiswa':
                $profileModel = new ProfileModel();
                $profileData = $profileModel->where('user_id', $id)->first();
                break;
            case 'dosen':
                $lecturerModel = new LecturerModel();
                $profileData = $lecturerModel->where('user_id', $id)->first();
                break;
            case 'mentor':
                $mentorModel = new MentorModel();
                $profileData = $mentorModel->where('user_id', $id)->first();
                break;
            case 'reviewer':
                $reviewerModel = new ReviewerModel();
                $profileData = $reviewerModel->where('user_id', $id)->first();
                break;
        }

        $data = [
            'title'           => 'Edit User | PMW Polsri',
            'header_title'    => 'Edit User',
            'header_subtitle' => 'Update data dan role pengguna',
            'user'            => $user,
            'roles'           => $this->getAvailableRoles(),
            'userGroups'      => $userGroups,
            'profileData'     => $profileData,
            'jurusanList'     => getJurusanList(),
            'prodiList'       => getProdiList(),
        ];

        return view('admin/users/form', $data);
    }

    /**
     * Store new user
     */
    public function storeUser()
    {
        $role = $this->request->getPost('role');

        // Base rules
        $rules = [
            'username' => 'required|min_length[3]|max_length[30]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|min_length[8]',
            'role'     => 'required|in_list[admin,mahasiswa,dosen,mentor,reviewer]',
            'nama'     => 'required|min_length[3]|max_length[100]',
        ];

        // Role specific profile rules
        if ($role === 'mahasiswa') {
            $rules['nim']      = 'required|min_length[5]|max_length[20]|is_unique[pmw_profiles.nim]';
            $rules['jurusan']  = 'required';
            $rules['prodi']    = 'required';
        } elseif ($role === 'mentor') {
            $rules['company']  = 'required|max_length[150]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $users = auth()->getProvider();
            $user = new User([
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'active'   => true,
            ]);

            if (!$users->save($user)) {
                $db->transRollback();
                return redirect()->back()->withInput()->with('error', 'Gagal membuat user: ' . implode(', ', $users->errors()));
            }

            // Assign role
            $userId = $users->getInsertID();
            $savedUser = $users->findById($userId);
            $savedUser->addGroup($role);

            // Create role-specific profile
            $this->createRoleProfile($userId, $role, $this->request->getPost());

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem saat menyimpan data.');
            }

            return redirect()->to('admin/users')->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Update existing user
     */
    public function updateUser($id)
    {
        $userModel = new UserModel();
        $user = $userModel->findById($id);

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User tidak ditemukan');
        }

        $role = $this->request->getPost('role');

        $rules = [
            'username' => "required|min_length[3]|max_length[30]|is_unique[users.username,id,{$id}]",
            'email'    => 'required|valid_email',
            'role'     => 'required|in_list[admin,mahasiswa,dosen,mentor,reviewer]',
            'nama'     => 'required|min_length[3]|max_length[100]',
        ];

        // Only validate password if provided
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[8]';
        }

        // Role specific profile rules
        if ($role === 'mahasiswa') {
            $profileModel = new ProfileModel();
            $existingProfile = $profileModel->where('user_id', $id)->first();
            $profileId = $existingProfile['id'] ?? '';
            $rules['nim']      = "required|min_length[5]|max_length[20]|is_unique[pmw_profiles.nim,id,{$profileId}]";
            $rules['jurusan']  = 'required';
            $rules['prodi']    = 'required';
        } elseif ($role === 'mentor') {
            $rules['company']  = 'required|max_length[150]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Update user data
            $user->username = $this->request->getPost('username');

            if ($this->request->getPost('password')) {
                $user->password = $this->request->getPost('password');
            }

            if (!$userModel->save($user)) {
                $db->transRollback();
                return redirect()->back()->withInput()->with('error', 'Gagal update user');
            }

            // Update role - remove all and add new
            $newRole = $this->request->getPost('role');
            $currentGroups = $user->getGroups();
            $oldRole = $currentGroups[0] ?? '';

            if ($newRole !== $oldRole) {
                foreach ($currentGroups as $group) {
                    $user->removeGroup($group);
                }
                $user->addGroup($newRole);
            }

            // Update or create role-specific profile
            $this->updateRoleProfile($id, $newRole, $oldRole, $this->request->getPost());

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan sistem saat mengupdate data.');
            }

            return redirect()->to('admin/users')->with('success', 'User berhasil diupdate');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Delete user and all related auth data
     */
    public function deleteUser($id)
    {
        $userModel = new UserModel();
        $user = $userModel->findById($id);

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User tidak ditemukan');
        }

        // Prevent self-deletion
        if ($user->id === auth()->user()->id) {
            return redirect()->to('admin/users')->with('error', 'Tidak bisa menghapus diri sendiri');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Get user roles before deletion
            $groups = $user->getGroups();
            $mainRole = $groups[0] ?? null;

            // Delete role-specific profile
            if ($mainRole) {
                $this->deleteOldProfile($user->id, $mainRole);
            }

            // Delete auth identities (password, email, etc.)
            $db->table('auth_identities')->where('user_id', $user->id)->delete();

            // Delete auth groups (roles)
            $db->table('auth_groups_users')->where('user_id', $user->id)->delete();

            // Delete auth permissions
            $db->table('auth_permissions_users')->where('user_id', $user->id)->delete();

            // Delete remember tokens
            $db->table('auth_remember_tokens')->where('user_id', $user->id)->delete();

            // Delete user
            $userModel->delete($user->id);

            $db->transComplete();

            return redirect()->to('admin/users')->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->to('admin/users')->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }

    /**
     * Toggle user active status
     */
    public function toggleUserStatus($id)
    {
        $userModel = new UserModel();
        $user = $userModel->findById($id);

        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User tidak ditemukan');
        }

        // Prevent self-deactivation
        if ($user->id === auth()->user()->id) {
            return redirect()->to('admin/users')->with('error', 'Tidak bisa mengubah status diri sendiri');
        }

        $newStatus = !$user->active;
        $userModel->update($id, ['active' => $newStatus]);

        $message = $newStatus ? 'User berhasil diaktifkan' : 'User berhasil dinonaktifkan';
        return redirect()->to('admin/users')->with('success', $message);
    }

    /**
     * Get available roles from config
     */
    private function getAvailableRoles(): array
    {
        $authGroups = config('AuthGroups');
        return $authGroups->groups;
    }

    public function settings()
    {
        return view('dashboard/placeholder', ['title' => 'Pengaturan System']);
    }

    public function rekap()
    {
        return view('dashboard/placeholder', ['title' => 'Rekap Data']);
    }

    public function cms()
    {
        $group = $this->request->getGet('group') ?: 'all';
        $pageFilter = $this->request->getGet('page') ?: 'all';
        $cmsModel = new \App\Models\CmsContentModel();
        
        if ($group === 'all') {
            if ($pageFilter !== 'all') {
                $contents = $cmsModel->groupStart()
                    ->where('group', $pageFilter)
                    ->orLike('group', $pageFilter . '_', 'after')
                    ->groupEnd()
                    ->orderBy('group', 'ASC')
                    ->findAll();
            } else {
                $contents = $cmsModel->orderBy('group', 'ASC')->findAll();
            }
        } else {
            $contents = $cmsModel->where('group', $group)->findAll();
        }
        
        // Define logical order for groups based on public page layout
        $groupOrder = [
            // Home Page
            'home_hero'            => 1,
            'home_features'        => 2,
            'home_workflow'        => 3,
            'home_gallery'         => 4,
            'home_stats'           => 5,
            'home_announcements'   => 6,
            'home_cta'             => 7,
            
            // Tahapan Page
            'tahapan_hero'         => 10,
            'tahapan_flow'         => 11,
            'tahapan_cta'          => 12,
            
            // Tentang Page
            'tentang_hero'         => 20,
            'tentang_vision'       => 21,
            'tentang_objectives'   => 22,
            'tentang_cta'          => 23,
            'pengumuman_hero'      => 40,
        ];

        // Group contents by their group field
        $groupedContents = [];
        foreach ($contents as $content) {
            $groupedContents[$content['group']][] = $content;
        }

        // Sort grouped contents based on our defined logical order
        uksort($groupedContents, function($a, $b) use ($groupOrder) {
            $orderA = $groupOrder[$a] ?? 999;
            $orderB = $groupOrder[$b] ?? 999;
            return $orderA <=> $orderB;
        });
        
        $data = [
            'title'           => 'Manajemen Konten (CMS) | PMW Polsri',
            'header_title'    => 'Manajemen Konten',
            'header_subtitle' => 'Kelola konten dinamis halaman publik',
            'groupedContents' => $groupedContents,
            'activeGroup'     => $group,
            'pageFilter'      => $pageFilter,
            'groups'          => [
                'home_hero'            => 'Beranda: Hero',
                'home_features'        => 'Beranda: Fitur',
                'home_workflow'        => 'Beranda: Alur',
                'home_gallery'         => 'Beranda: Galeri (Preview)',
                'home_stats'           => 'Beranda: Statistik',
                'home_announcements'   => 'Beranda: Pengumuman',
                'home_cta'             => 'Beranda: Kontak & CTA',
                'tahapan_hero'         => 'Tahapan: Hero',
                'tahapan_flow'         => 'Tahapan: Alur Pendaftaran',
                'tahapan_cta'          => 'Tahapan: CTA',
                'tentang_hero'         => 'Tentang: Hero',
                'tentang_vision'       => 'Tentang: Visi & Misi',
                'tentang_objectives'   => 'Tentang: Tujuan Program',
                'tentang_cta'          => 'Tentang: CTA',
                'pengumuman_hero'      => 'Pengumuman: Hero',
            ]
        ];

        return view('admin/cms/index', $data);
    }

    /**
     * Save CMS content updates
     */
    public function saveCms()
    {
        $cmsModel = new \App\Models\CmsContentModel();
        $group = $this->request->getPost('group');
        $inputs = $this->request->getPost('cms'); // Array of [key => content]
        
        if (!$group || !is_array($inputs)) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            foreach ($inputs as $key => $content) {
                // Find existing
                $existing = $cmsModel->where('key', $key)->first();
                if (!$existing) continue;

                $updateData = [];

                // Handle based on type
                if ($existing['type'] === 'json') {
                    $newContent = is_array($content) ? json_encode($content) : $content;
                    $oldContent = $existing['content'];

                    // Cleanup images within JSON if they are removed
                    if (!empty($oldContent)) {
                        preg_match_all('/uploads\/cms\/[a-zA-Z0-9._-]+/', $oldContent, $oldMatches);
                        preg_match_all('/uploads\/cms\/[a-zA-Z0-9._-]+/', $newContent, $newMatches);
                        
                        $oldPaths = array_unique($oldMatches[0] ?? []);
                        $newPaths = array_unique($newMatches[0] ?? []);
                        $removedPaths = array_diff($oldPaths, $newPaths);
                        
                        foreach ($removedPaths as $path) {
                            $fullPath = WRITEPATH . $path;
                            if (is_file($fullPath)) @unlink($fullPath);
                        }
                    }

                    $updateData['content'] = $newContent;
                } else if ($existing['type'] === 'image') {
                    // Image logic: Check for upload first
                    $file = $this->request->getFile("cms_file.{$key}");
                    if ($file && $file->isValid() && !$file->hasMoved()) {
                        $uploadDir = WRITEPATH . 'uploads/cms';
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                            file_put_contents($uploadDir . '/.htaccess', "deny from all\n");
                        }
                        
                        // Delete old local file if exists
                        if (!empty($existing['content']) && !str_starts_with($existing['content'], 'http')) {
                            $oldPath = WRITEPATH . $existing['content'];
                            if (is_file($oldPath)) @unlink($oldPath);
                        }

                        $newName = $file->getRandomName();
                        $file->move($uploadDir, $newName);
                        $updateData['content'] = 'uploads/cms/' . $newName;
                    } else {
                        // If no file, use the text input (URL/Link)
                        $updateData['content'] = $content;
                    }
                } else {
                    $updateData['content'] = $content;
                }

                // Cleanup old file if content changed and it was a local file
                if ($existing['type'] === 'image' && $updateData['content'] !== $existing['content']) {
                    if (!empty($existing['content']) && !str_starts_with($existing['content'], 'http')) {
                        $oldPath = WRITEPATH . $existing['content'];
                        // Only delete if the new content is also different (avoid deleting if same file)
                        if (is_file($oldPath)) @unlink($oldPath);
                    }
                }

                $cmsModel->update($existing['id'], $updateData);
            }

            $db->transComplete();

            // Invalidate Cache
            if ($group === 'all') {
                // Broad clear for all known public groups
                $targetGroups = [
                    'home_hero', 'home_features', 'home_workflow', 'home_gallery', 'home_announcements', 'home_cta', 'home_stats',
                    'tahapan_hero', 'tahapan_flow', 'tahapan_cta',
                    'tentang_hero', 'tentang_vision', 'tentang_objectives', 'tentang_cta',
                    'pengumuman_hero',
                    'general'
                ];
                foreach ($targetGroups as $tg) {
                    cache()->delete("cms_group_{$tg}");
                }
            } else {
                cache()->delete("cms_group_{$group}");
            }

            $page = $this->request->getPost('page') ?: 'all';
            return redirect()->to("admin/cms?group={$group}&page={$page}")->with('success', 'Konten berhasil diperbarui');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Upload CMS image via AJAX (Instant)
     */
    public function uploadCmsImage()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Direct access not allowed']);
        }

        $file = $this->request->getFile('image');
        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid']);
        }

        // Validate type (images only)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg', 'image/gif', 'image/svg+xml'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Format file tidak didukung. Gunakan JPG, PNG, WEBP, atau SVG.']);
        }

        // Validate size (max 2MB)
        if ($file->getSize() > 2 * 1024 * 1024) {
            return $this->response->setJSON(['success' => false, 'message' => 'Ukuran file maksimal 2MB']);
        }

        $uploadDir = WRITEPATH . 'uploads/cms';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
            file_put_contents($uploadDir . '/.htaccess', "deny from all\n");
        }

        $newName = $file->getRandomName();
        $file->move($uploadDir, $newName);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Gambar berhasil diunggah',
            'path' => 'uploads/cms/' . $newName,
            'url' => base_url('admin/cms/image/' . $newName)
        ]);
    }

    /**
     * View CMS image (serve file securely)
     */
    public function viewCmsImage($filename)
    {
        $filePath = WRITEPATH . 'uploads/cms/' . $filename;
        if (!file_exists($filePath)) {
            return $this->response->setStatusCode(404);
        }

        $mimeType = mime_content_type($filePath);
        return $this->response
            ->setContentType($mimeType)
            ->setBody(file_get_contents($filePath));
    }

    public function pmwSystem()
    {
        $periodModel = new PmwPeriodModel();
        $scheduleModel = new PmwScheduleModel();

        // Get all periods
        $periods = $periodModel->orderBy('year', 'DESC')->findAll();

        // Get active period
        $activePeriod = $periodModel->getActive();

        // Get schedules for active period or empty array
        $schedules = [];
        if ($activePeriod) {
            $schedules = $scheduleModel->getByPeriodId($activePeriod['id']);
        }

        return view('admin/pmw_system', [
            'title'           => 'PMW Schedule',
            'header_subtitle' => 'Manajemen Jadwal & Periode PMW',
            'periods'         => $periods,
            'activePeriod'    => $activePeriod,
            'schedules'       => $schedules,
        ]);
    }

    /**
     * Store new PMW period
     */
    public function storePeriod()
    {
        $periodModel = new PmwPeriodModel();
        $scheduleModel = new PmwScheduleModel();

        $rules = [
            'name'        => 'required|min_length[3]|max_length[100]',
            'year'        => 'required|integer|greater_than[2000]',
            'description' => 'permit_empty|max_length[500]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $periodData = [
                'name'        => $this->request->getPost('name'),
                'year'        => $this->request->getPost('year'),
                'is_active'   => false, // Default inactive
                'description' => $this->request->getPost('description'),
            ];

            $periodId = $periodModel->insert($periodData);

            if (!$periodId) {
                $db->transRollback();
                return redirect()->back()->withInput()->with('error', 'Gagal membuat periode');
            }

            // Create default schedules for this period
            $scheduleModel->createDefaultSchedules($periodId);

            $db->transComplete();

            return redirect()->to('admin/pmw-system')->with('success', 'Periode PMW berhasil dibuat');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Update schedule for a period
     */
    public function updateSchedule()
    {
        $scheduleModel = new PmwScheduleModel();

        $periodId = $this->request->getPost('period_id');
        $schedules = $this->request->getPost('schedules');

        if (!$periodId || !is_array($schedules)) {
            return redirect()->back()->with('error', 'Data tidak valid');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            foreach ($schedules as $scheduleId => $scheduleData) {
                $updateData = [
                    'phase_name'  => $scheduleData['phase_name'] ?: null,
                    'start_date'  => $scheduleData['start_date'] ?: null,
                    'end_date'    => $scheduleData['end_date'] ?: null,
                    'description' => $scheduleData['description'] ?: null,
                    'is_active'   => isset($scheduleData['is_active']) ? true : false,
                ];

                $scheduleModel->update($scheduleId, $updateData);
            }

            $db->transComplete();

            return redirect()->to('admin/pmw-system')->with('success', 'Jadwal berhasil diupdate');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Activate a period
     */
    public function activatePeriod($id)
    {
        $periodModel = new PmwPeriodModel();

        $period = $periodModel->find($id);
        if (!$period) {
            return redirect()->back()->with('error', 'Periode tidak ditemukan');
        }

        // Debug: cek apakah ID valid
        log_message('debug', 'Activating period ID: ' . $id);
        log_message('debug', 'Period data: ' . print_r($period, true));

        $result = $periodModel->activate((int)$id);

        // Debug: cek hasil update
        log_message('debug', 'Activate result: ' . ($result ? 'true' : 'false'));
        log_message('debug', 'Errors: ' . print_r($periodModel->errors(), true));

        if ($result) {
            return redirect()->to('admin/pmw-system')->with('success', 'Periode berhasil diaktifkan');
        }

        return redirect()->back()->with('error', 'Gagal mengaktifkan periode: ' . implode(', ', $periodModel->errors()));
    }

    /**
     * Deactivate a period (set is_active = false)
     */
    public function deactivatePeriod($id)
    {
        $periodModel = new PmwPeriodModel();

        $period = $periodModel->find($id);
        if (!$period) {
            return redirect()->back()->with('error', 'Periode tidak ditemukan');
        }

        if (!$period['is_active']) {
            return redirect()->back()->with('error', 'Periode ini sudah tidak aktif');
        }

        if ($periodModel->update($id, ['is_active' => false])) {
            return redirect()->to('admin/pmw-system')->with('success', 'Periode berhasil dinonaktifkan. Tidak ada periode aktif saat ini.');
        }

        return redirect()->back()->with('error', 'Gagal menonaktifkan periode');
    }

    /**
     * Delete a period
     */
    public function deletePeriod($id)
    {
        $periodModel = new PmwPeriodModel();

        $period = $periodModel->find($id);
        if (!$period) {
            return redirect()->back()->with('error', 'Periode tidak ditemukan');
        }

        // Prevent deleting active period
        if ($period['is_active']) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus periode yang aktif');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Schedules will be deleted by CASCADE
            $periodModel->delete($id);
            $db->transComplete();

            return redirect()->to('admin/pmw-system')->with('success', 'Periode berhasil dihapus');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function laporan()
    {
        return view('dashboard/placeholder', ['title' => 'Laporan PMW - Rekap Data']);
    }

    /**
     * Create role-specific profile
     */
    private function createRoleProfile(int $userId, string $role, array $data): void
    {
        switch ($role) {
            case 'mahasiswa':
                $profileModel = new ProfileModel();
                $profileModel->insert([
                    'user_id'  => $userId,
                    'nama'     => $data['nama'] ?? $data['username'],
                    'nim'      => $data['nim'] ?? '',
                    'jurusan'  => $data['jurusan'] ?? '',
                    'prodi'    => $data['prodi'] ?? '',
                    'semester' => $data['semester'] ?? 1,
                    'phone'    => $data['phone'] ?? '',
                    'gender'   => $data['gender'] ?? 'L',
                ]);
                break;

            case 'dosen':
                $lecturerModel = new LecturerModel();
                $lecturerModel->insert([
                    'user_id'   => $userId,
                    'nip'       => $data['nip'] ?? '',
                    'nama'      => $data['nama'] ?? $data['username'],
                    'jurusan'   => $data['jurusan'] ?? '',
                    'prodi'     => $data['prodi'] ?? '',
                    'expertise' => $data['dosen_expertise'] ?? $data['expertise'] ?? '',
                    'phone'     => $data['phone'] ?? '',
                    'bio'       => $data['dosen_bio'] ?? $data['bio'] ?? '',
                ]);
                break;

            case 'mentor':
                $mentorModel = new MentorModel();
                $mentorModel->insert([
                    'user_id'   => $userId,
                    'nama'      => $data['nama'] ?? $data['username'],
                    'company'   => $data['company'] ?? '',
                    'position'  => $data['position'] ?? '',
                    'expertise' => $data['mentor_expertise'] ?? $data['expertise'] ?? '',
                    'phone'     => $data['phone'] ?? '',
                    'email'     => $data['email_secondary'] ?? '',
                    'bio'       => $data['mentor_bio'] ?? $data['bio'] ?? '',
                ]);
                break;

            case 'reviewer':
                $reviewerModel = new ReviewerModel();
                $reviewerModel->insert([
                    'user_id'     => $userId,
                    'nama'        => $data['nama'] ?? $data['username'],
                    'nidn'        => $data['nidn'] ?? '',
                    'nip'         => $data['nip'] ?? '',
                    'institution' => $data['institution'] ?? '',
                    'expertise'   => $data['reviewer_expertise'] ?? $data['expertise'] ?? '',
                    'phone'       => $data['phone'] ?? '',
                    'bio'         => $data['reviewer_bio'] ?? $data['bio'] ?? '',
                ]);
                break;

            case 'admin':
                // Create minimal profile for admin to store name
                $profileModel = new ProfileModel();
                $profileModel->insert([
                    'user_id' => $userId,
                    'nama'    => $data['nama'] ?? $data['username'],
                    'nim'     => 'ADMIN-' . $userId, // Admin doesn't have NIM, use placeholder
                    'jurusan' => 'ADMIN',
                    'prodi'   => 'ADMIN',
                    'phone'   => $data['phone'] ?? '',
                ]);
                break;
        }
    }

    /**
     * Update role-specific profile
     */
    private function updateRoleProfile(int $userId, string $newRole, string $oldRole, array $data): void
    {
        // If role changed, delete old profile and create new
        if ($newRole !== $oldRole) {
            $this->deleteOldProfile($userId, $oldRole);
            $this->createRoleProfile($userId, $newRole, $data);
            return;
        }

        // Same role, just update
        switch ($newRole) {
            case 'mahasiswa':
                $profileModel = new ProfileModel();
                $existing = $profileModel->where('user_id', $userId)->first();
                $profileData = [
                    'user_id'  => $userId,
                    'nama'     => $data['nama'] ?? $data['username'],
                    'nim'      => $data['nim'] ?? $data['username'],
                    'jurusan'  => $data['jurusan'] ?? '',
                    'prodi'    => $data['prodi'] ?? '',
                    'semester' => $data['semester'] ?? 1,
                    'phone'    => $data['phone'] ?? '',
                    'gender'   => $data['gender'] ?? 'L',
                ];
                if ($existing) {
                    $profileModel->update($existing['id'], $profileData);
                } else {
                    $profileModel->insert($profileData);
                }
                break;

            case 'dosen':
                $lecturerModel = new LecturerModel();
                $existing = $lecturerModel->where('user_id', $userId)->first();
                $profileData = [
                    'user_id'   => $userId,
                    'nip'       => $data['nip'] ?? '',
                    'nama'      => $data['nama'] ?? $data['username'],
                    'jurusan'   => $data['jurusan'] ?? '',
                    'prodi'     => $data['prodi'] ?? '',
                    'expertise' => $data['dosen_expertise'] ?? $data['expertise'] ?? '',
                    'phone'     => $data['phone'] ?? '',
                    'bio'       => $data['dosen_bio'] ?? $data['bio'] ?? '',
                ];
                if ($existing) {
                    $lecturerModel->update($existing['id'], $profileData);
                } else {
                    $lecturerModel->insert($profileData);
                }
                break;

            case 'mentor':
                $mentorModel = new MentorModel();
                $existing = $mentorModel->where('user_id', $userId)->first();
                $profileData = [
                    'user_id'   => $userId,
                    'nama'      => $data['nama'] ?? $data['username'],
                    'company'   => $data['company'] ?? '',
                    'position'  => $data['position'] ?? '',
                    'expertise' => $data['mentor_expertise'] ?? $data['expertise'] ?? '',
                    'phone'     => $data['phone'] ?? '',
                    'email'     => $data['email_secondary'] ?? '',
                    'bio'       => $data['mentor_bio'] ?? $data['bio'] ?? '',
                ];
                if ($existing) {
                    $mentorModel->update($existing['id'], $profileData);
                } else {
                    $mentorModel->insert($profileData);
                }
                break;

            case 'reviewer':
                $reviewerModel = new ReviewerModel();
                $existing = $reviewerModel->where('user_id', $userId)->first();
                $profileData = [
                    'user_id'     => $userId,
                    'nama'        => $data['nama'] ?? $data['username'],
                    'nidn'        => $data['nidn'] ?? '',
                    'nip'         => $data['nip'] ?? '',
                    'institution' => $data['institution'] ?? '',
                    'expertise'   => $data['reviewer_expertise'] ?? $data['expertise'] ?? '',
                    'phone'       => $data['phone'] ?? '',
                    'bio'         => $data['reviewer_bio'] ?? $data['bio'] ?? '',
                ];
                if ($existing) {
                    $reviewerModel->update($existing['id'], $profileData);
                } else {
                    $reviewerModel->insert($profileData);
                }
                break;

            case 'admin':
                $profileModel = new ProfileModel();
                $existing = $profileModel->where('user_id', $userId)->first();
                $profileData = [
                    'user_id' => $userId,
                    'nama'    => $data['nama'] ?? $data['username'],
                    'phone'   => $data['phone'] ?? '',
                ];
                if ($existing) {
                    $profileModel->update($existing['id'], $profileData);
                } else {
                    $profileData['nim'] = 'ADMIN-' . $userId;
                    $profileData['jurusan'] = 'ADMIN';
                    $profileData['prodi'] = 'ADMIN';
                    $profileModel->insert($profileData);
                }
                break;
        }
    }

    /**
     * Delete old profile when role changes
     */
    private function deleteOldProfile(int $userId, string $role): void
    {
        switch ($role) {
            case 'mahasiswa':
                $profileModel = new ProfileModel();
                $existing = $profileModel->where('user_id', $userId)->first();
                if ($existing) {
                    $profileModel->delete($existing['id']);
                }
                break;
            case 'dosen':
                $lecturerModel = new LecturerModel();
                $existing = $lecturerModel->where('user_id', $userId)->first();
                if ($existing) {
                    $lecturerModel->delete($existing['id']);
                }
                break;
            case 'mentor':
                $mentorModel = new MentorModel();
                $existing = $mentorModel->where('user_id', $userId)->first();
                if ($existing) {
                    $mentorModel->delete($existing['id']);
                }
                break;
            case 'reviewer':
                $reviewerModel = new ReviewerModel();
                $existing = $reviewerModel->where('user_id', $userId)->first();
                if ($existing) {
                    $reviewerModel->delete($existing['id']);
                }
                break;
        }
    }

    /**
     * Display all teams/participants with their proposals and related data
     */
    public function teams()
    {
        $proposalModel = new \App\Models\Proposal\PmwProposalModel();
        $memberModel = new \App\Models\Proposal\PmwProposalMemberModel();
        $bankAccountModel = new \App\Models\AnnouncementFunding\PmwBankAccountModel();
        $periodModel = new PmwPeriodModel();

        // Get filter parameters
        $periodFilter = $this->request->getGet('period');
        $search = $this->request->getGet('search');

        // Build query - Only show teams that have passed pitching desk (approved by admin)
        $db = \Config\Database::connect();
        $builder = $db->table('pmw_proposals p');
        $builder->select([
            'p.id as proposal_id',
            'p.nama_usaha',
            'p.kategori_wirausaha',
            'p.kategori_usaha',
            'p.total_rab',
            'p.leader_user_id',
            'pm.nama as ketua_nama',
            'pm.nim as ketua_nim',
            'pm.jurusan as ketua_jurusan',
            'pm.prodi as ketua_prodi',
            'pm.phone as ketua_phone',
            'pm.email as ketua_email',
            'l.nama as dosen_nama',
            'l.nip as dosen_nip',
            'm.nama as mentor_nama',
            'per.name as period_name',
            'per.year as period_year',
            'per.id as period_id',
            '(SELECT COUNT(*) FROM pmw_proposal_members pm2 WHERE pm2.proposal_id = p.id) as member_count',
            '(SELECT GROUP_CONCAT(CONCAT(role, ":", nama) SEPARATOR "|") FROM pmw_proposal_members pm3 WHERE pm3.proposal_id = p.id) as members_list',
            '(SELECT COUNT(*) FROM pmw_guidance_schedules gs 
              JOIN pmw_guidance_logbooks gl ON gl.schedule_id = gs.id 
              WHERE gs.proposal_id = p.id AND gs.type = "bimbingan" AND gl.status = "approved") as total_bimbingan',
            '(SELECT COUNT(*) FROM pmw_guidance_schedules gs 
              JOIN pmw_guidance_logbooks gl ON gl.schedule_id = gs.id 
              WHERE gs.proposal_id = p.id AND gs.type = "mentoring" AND gl.status = "approved") as total_mentoring',
            '(SELECT COUNT(*) FROM pmw_activity_schedules pas 
              JOIN pmw_activity_logbooks pal ON pal.schedule_id = pas.id 
              WHERE pas.proposal_id = p.id AND pal.status = "approved") as total_kegiatan',
            'sp.admin_status as pitching_admin_status',
            'sp.student_submitted_at',
            '(SELECT status FROM pmw_reports WHERE proposal_id = p.id AND type = "kemajuan" ORDER BY created_at DESC LIMIT 1) as kemajuan_status',
            '(SELECT status FROM pmw_reports WHERE proposal_id = p.id AND type = "akhir" ORDER BY created_at DESC LIMIT 1) as akhir_status',
        ]);
        $builder->join('pmw_proposal_members pm', 'pm.proposal_id = p.id AND pm.role = "ketua"', 'left');
        $builder->join('pmw_proposal_assignments pa', 'pa.proposal_id = p.id', 'left');
        $builder->join('pmw_lecturers l', 'l.id = pa.lecturer_id', 'left');
        $builder->join('pmw_mentors m', 'm.id = pa.mentor_id', 'left');
        $builder->join('pmw_periods per', 'per.id = p.period_id', 'left');
        $builder->join('pmw_selection_pitching sp', 'sp.proposal_id = p.id', 'left');

        // Only show teams that have passed pitching desk (approved by admin)
        $builder->where('sp.admin_status', 'approved');

        // Apply filters
        if ($periodFilter) {
            $builder->where('p.period_id', $periodFilter);
        }
        if ($search) {
            $builder->groupStart()
                ->like('p.nama_usaha', $search)
                ->orLike('pm.nama', $search)
                ->orLike('pm.nim', $search)
                ->groupEnd();
        }

        $builder->orderBy('per.year', 'DESC');
        $builder->orderBy('per.name', 'DESC');
        $builder->orderBy('sp.student_submitted_at', 'DESC');

        $teams = $builder->get()->getResultArray();

        // Get bank accounts for each proposal
        foreach ($teams as &$team) {
            $team['bank_account'] = $bankAccountModel->findByProposal((int) $team['proposal_id']);
        }

        // Get all periods for filter dropdown
        $periods = $periodModel->findAll();

        // Stats - recalculated for teams in funding phase
        $stats = [
            'total' => count($teams),
            'with_mentor' => count(array_filter($teams, fn($t) => !empty($t['mentor_nama']))),
            'with_bank' => count(array_filter($teams, fn($t) => !empty($t['bank_account']))),
            'total_bimbingan' => array_sum(array_column($teams, 'total_bimbingan')),
            'total_mentoring' => array_sum(array_column($teams, 'total_mentoring')),
            'total_kegiatan' => array_sum(array_column($teams, 'total_kegiatan')),
        ];

        return view('admin/teams/index', [
            'title'           => 'Data TIM Peserta | PMW Polsri',
            'header_title'    => 'Data TIM Peserta',
            'header_subtitle' => 'TIM peserta yang telah lolos pitching desk (Dana 1)',
            'teams'           => $teams,
            'periods'         => $periods,
            'stats'           => $stats,
            'periodFilter'    => $periodFilter,
            'search'          => $search,
        ]);
    }

    /**
     * Detail tim peserta
     */
    public function teamDetail(int $id)
    {
        $proposalModel = new \App\Models\Proposal\PmwProposalModel();
        $memberModel = new \App\Models\Proposal\PmwProposalMemberModel();
        $bankAccountModel = new \App\Models\AnnouncementFunding\PmwBankAccountModel();
        $documentModel = new PmwDocumentModel();
        $guidanceLogbookModel = new PmwGuidanceLogbookModel();
        $activityLogbookModel = new PmwActivityLogbookModel();

        // Get proposal detail
        $proposal = $proposalModel->getProposalForValidation($id);
        if (!$proposal) {
            return redirect()->to('admin/teams')->with('error', 'Proposal tidak ditemukan');
        }

        // Get team members
        $members = $memberModel->getByProposalId($id);

        // Get bank account
        $bankAccount = $bankAccountModel->findByProposal($id);

        // Get documents
        $documents = $documentModel->getProposalDocs($id);

        // Get Guidance Logs (Bimbingan & Mentoring)
        $scheduleModel = new \App\Models\Guidance\PmwGuidanceScheduleModel();
        $guidanceLogs = $scheduleModel->select('pmw_guidance_schedules.*, gl.id as logbook_id, gl.material_explanation, gl.video_url, gl.photo_activity, gl.assignment_file, gl.nota_file, gl.nota_files, gl.nota_items, gl.nominal_konsumsi, gl.status as log_status, gl.submitted_at, gl.verification_note, gl.verified_at')
            ->join('pmw_guidance_logbooks gl', 'gl.schedule_id = pmw_guidance_schedules.id', 'left')
            ->where('pmw_guidance_schedules.proposal_id', $id)
            ->orderBy('pmw_guidance_schedules.schedule_date', 'DESC')
            ->findAll();

        // Get Activity Logs (Kegiatan Wirausaha)
        $activityScheduleModel = new \App\Models\Activity\PmwActivityScheduleModel();
        $activityLogs = $activityScheduleModel->select('pmw_activity_schedules.*, pal.id as logbook_id, pal.activity_description, pal.photo_activity, pal.video_url, pal.status as log_status, pal.created_at as submitted_at, pal.dosen_status, pal.dosen_note, pal.mentor_status, pal.mentor_note, pal.admin_note')
            ->join('pmw_activity_logbooks pal', 'pal.schedule_id = pmw_activity_schedules.id', 'left')
            ->where('pmw_activity_schedules.proposal_id', $id)
            ->orderBy('pmw_activity_schedules.activity_date', 'DESC')
            ->findAll();

        // Get Milestone Reports
        $reportModel = new \App\Models\Milestone\PmwReportModel();
        $milestoneReports = $reportModel->where('proposal_id', $id)->findAll();

        return view('admin/teams/detail', [
            'title'        => 'Detail TIM | PMW Polsri',
            'header_title' => 'Detail TIM Peserta',
            'header_subtitle' => $proposal['nama_usaha'] ?? 'Proposal #' . $id,
            'proposal'     => $proposal,
            'members'      => $members,
            'bankAccount'  => $bankAccount,
            'documents'    => $documents,
            'guidanceLogs' => $guidanceLogs,
            'activityLogs' => $activityLogs,
            'milestoneReports' => $milestoneReports,
        ]);
    }

    /**
     * Securely serve guidance logbook files for admin
     */
    public function viewGuidanceFile(string $type, int $logbookId)
    {
        $logbookModel = new \App\Models\Guidance\PmwGuidanceLogbookModel();
        $logbook = $logbookModel->find($logbookId);

        if (!$logbook) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        $filePath = match ($type) {
            'photo'      => $logbook->photo_activity,
            'assignment' => $logbook->assignment_file,
            'nota'       => (function() use ($logbook) {
                $specificPath = $this->request->getGet('path');
                if ($specificPath) {
                    $notaFiles = json_decode($logbook->nota_files ?? '[]', true) ?? [];
                    if (in_array($specificPath, $notaFiles)) {
                        return $specificPath;
                    }
                }
                return $logbook->nota_file;
            })(),
            default      => ''
        };

        if (empty($filePath)) {
            return $this->response->setStatusCode(404)->setBody('Berkas tidak ditemukan.');
        }

        $absPath = WRITEPATH . 'uploads/' . $filePath;

        if (!is_file($absPath)) {
            return $this->response->setStatusCode(404)->setBody('File fisik tidak ditemukan.');
        }

        $mimeType = mime_content_type($absPath);
        return $this->response
            ->setHeader('Content-Type', $mimeType)
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($absPath) . '"')
            ->setBody(file_get_contents($absPath));
    }
}
