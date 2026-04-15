<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use App\Models\LecturerModel;
use App\Models\MentorModel;
use App\Models\ReviewerModel;
use App\Models\PmwPeriodModel;
use App\Models\PmwScheduleModel;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class AdminController extends BaseController
{
    protected $helpers = ['form', 'url', 'text'];

    // Jurusan list for mahasiswa and dosen
    protected $jurusanList = [
        'Teknik Sipil',
        'Teknik Mesin',
        'Teknik Elektro',
        'Teknik Kimia',
        'Akuntansi',
        'Administrasi Bisnis',
        'Teknik Komputer',
        'Manajemen Informatika',
        'Bahasa dan Pariwisata',
        'Rekayasa Teknologi dan Bisnis Pertanian',
    ];

    /**
     * Get prodi list based on jurusan
     */
    private function getProdiList(): array
    {
        return [
            'Teknik Sipil' => [
                'D-III Teknik Sipil',
                'D-IV Perancangan Jalan dan Jembatan',
                'D-IV Perancangan Jalan dan Jembatan PSDKU OKU',
                'D-IV Arsitektur Bangunan Gedung',
            ],
            'Teknik Mesin' => [
                'D-III Teknik Mesin',
                'D-III Pemeliharaan Alat Berat',
                'D-IV Teknik Mesin Produksi dan Perawatan',
                'D-IV Teknik Mesin Produksi dan Perawatan PSDKU Kab. Siak Prov. Riau',
            ],
            'Teknik Elektro' => [
                'D-III Teknik Listrik',
                'D-III Teknik Elektronika',
                'D-III Teknik Telekomunikasi',
                'D-IV Teknik Elektro',
                'D-IV Teknik Telekomunikasi',
                'D-IV Teknologi Rekayasa Instalasi Listrik',
            ],
            'Teknik Kimia' => [
                'D-III Teknik Kimia',
                'D-III Teknik Kimia PSDKU Kab. Siak Prov. Riau',
                'D-IV Teknologi Kimia Industri',
                'D-IV Teknik Energi',
                'S2 Terapan/Magister Terapan: Teknik Energi Terbarukan',
            ],
            'Akuntansi' => [
                'D-III Akuntansi',
                'D-IV Akuntansi Sektor Publik',
                'D-IV Akuntansi Sektor Publik PSDKU OKU Baturaja',
                'D-IV Akuntansi Sektor Publik Kab. Siak Prov. Riau',
            ],
            'Administrasi Bisnis' => [
                'D-III Administrasi Bisnis',
                'D-III Administrasi Bisnis PSDKU OKU Baturaja',
                'D-IV Manajemen Bisnis',
                'D-IV Bisnis Digital',
                'D-IV Usaha Perjalanan Wisata',
                'S2 Pemasaran, Inovasi, dan Teknologi',
            ],
            'Teknik Komputer' => [
                'D-III Teknik Komputer',
                'D-IV Teknologi Informatika Multimedia Digital',
            ],
            'Manajemen Informatika' => [
                'D-III Manajemen Informatika',
                'D-IV Manajemen Informatika',
            ],
            'Bahasa dan Pariwisata' => [
                'D-III Bahasa Inggris',
                'D-IV Bahasa Inggris untuk Komunikasi Bisnis dan Profesional',
            ],
            'Rekayasa Teknologi dan Bisnis Pertanian' => [
                'D-III Teknologi Pangan Kampus Banyuasin',
                'D-IV Teknologi Produksi Tanaman Perkebunan',
                'D-IV Agribisnis Pangan Kampus Banyuasin',
                'D-IV Manajemen Agribisnis Kampus Banyuasin',
                'D-IV Teknologi Akuakultur',
                'D-IV Teknologi Rekayasa Pangan',
            ],
        ];
    }

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

        return view('admin/users', $data);
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
            'jurusanList'     => $this->jurusanList,
            'prodiList'       => $this->getProdiList(),
        ];

        return view('admin/user_form', $data);
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
            'jurusanList'     => $this->jurusanList,
            'prodiList'       => $this->getProdiList(),
        ];

        return view('admin/user_form', $data);
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
            'password' => 'required|min_length[8]|strong_password',
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
            $rules['password'] = 'min_length[8]|strong_password';
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
     * Delete user
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

        $userModel->delete($id);

        return redirect()->to('admin/users')->with('success', 'User berhasil dihapus');
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
        return view('dashboard/placeholder', ['title' => 'Manajemen Konten (CMS)']);
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
                    'expertise' => $data['expertise'] ?? '',
                    'phone'     => $data['phone'] ?? '',
                    'bio'       => $data['bio'] ?? '',
                ]);
                break;

            case 'mentor':
                $mentorModel = new MentorModel();
                $mentorModel->insert([
                    'user_id'   => $userId,
                    'nama'      => $data['nama'] ?? $data['username'],
                    'company'   => $data['company'] ?? '',
                    'position'  => $data['position'] ?? '',
                    'expertise' => $data['expertise'] ?? '',
                    'phone'     => $data['phone'] ?? '',
                    'email'     => $data['email_secondary'] ?? '',
                    'bio'       => $data['bio'] ?? '',
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
                    'expertise'   => $data['expertise'] ?? '',
                    'phone'       => $data['phone_reviewer'] ?? $data['phone'] ?? '', // Handle phone name discrepancy
                    'bio'         => $data['bio'] ?? '',
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
                    'expertise' => $data['expertise'] ?? '',
                    'phone'     => $data['phone'] ?? '',
                    'bio'       => $data['bio'] ?? '',
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
                    'expertise' => $data['expertise'] ?? '',
                    'phone'     => $data['phone'] ?? '',
                    'email'     => $data['email_secondary'] ?? '',
                    'bio'       => $data['bio'] ?? '',
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
                    'expertise'   => $data['expertise'] ?? '',
                    'phone'       => $data['phone_reviewer'] ?? $data['phone'] ?? '',
                    'bio'         => $data['bio'] ?? '',
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
}
