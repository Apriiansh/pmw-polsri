<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PmwPeriodModel;
use App\Models\Proposal\PmwProposalModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Exceptions\ValidationException;

class AuthController extends BaseController
{
    protected $helpers = ['form', 'url', 'text', 'pmw'];

    /**
     * Show register form
     */
    public function register()
    {
        // If already logged in, redirect based on role
        if (auth()->loggedIn()) {
            return redirect()->to($this->getRedirectUrlForRole());
        }

        // Ensure helper is loaded
        helper('pmw');

        return view('auth/register', [
            'title' => 'Daftar Akun',
            'prodiList' => getProdiList(),
        ]);
    }

    /**
     * Process registration
     */
    public function attemptRegister()
    {
        $validation = $this->validate([
            'nama' => 'required|min_length[3]|max_length[100]',
            'nim' => 'required|min_length[5]|max_length[20]|is_unique[pmw_profiles.nim]',
            'username' => 'permit_empty|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
            'jurusan' => 'required',
            'prodi' => 'required|max_length[100]',
            'phone' => 'required|regex_match[/^[0-9\s\+\-\(\)]+$/]|min_length[10]|max_length[20]',
            'foto' => 'permit_empty|is_image[foto]|max_size[foto,2048]|ext_in[foto,jpg,jpeg,png]',
            'semester' => 'permit_empty|numeric',
            'gender' => 'permit_empty|in_list[L,P]',
        ], [
            'nim' => [
                'is_unique' => 'NIM ini sudah terdaftar sebagai akun.',
            ],
            'username' => [
                'is_unique' => 'Username ini sudah digunakan.',
            ],
            'email' => [
                'is_unique' => 'Alamat email ini sudah terdaftar.',
            ],
            'phone' => [
                'regex_match' => 'Format nomor HP tidak valid.',
            ]
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();

        // Generate username: middle name, fallback to last name + last 4 digits of NIM
        $namaParts = array_values(array_filter(explode(' ', strtolower(trim($data['nama'])))));
        $middleName = $namaParts[1] ?? end($namaParts);
        $middleName = preg_replace('/[^a-z]/', '', (string) $middleName);
        $last4Nim = substr((string) $data['nim'], -4);
        $data['username'] = $middleName . $last4Nim;

        // Handle foto upload with security checks
        $fotoPath = null;
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Verify mime type matches extension (security check)
            $mimeType = $foto->getMimeType();
            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($mimeType, $allowedMimes)) {
                return redirect()->back()->withInput()->with('error', 'Format file foto tidak valid.');
            }
            
            // Ensure upload directory exists and is secure
            $uploadDir = WRITEPATH . 'uploads/profiles';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
                // Create .htaccess to prevent direct access
                file_put_contents($uploadDir . '/.htaccess', "deny from all\n");
            }
            
            // Generate secure random filename
            $newName = $foto->getRandomName();
            $foto->move($uploadDir, $newName);
            $fotoPath = 'uploads/profiles/' . $newName;
        }

        // Create Shield user provider
        $users = auth()->getProvider();

        // Ensure username is unique by appending number if needed
        $userModel = new UserModel();
        $baseUsername = $data['username'];
        $counter = 1;
        $finalUsername = $baseUsername;
        while ($userModel->where('username', $finalUsername)->first()) {
            $finalUsername = $baseUsername . $counter;
            $counter++;
        }

        // Create Shield user
        $user = new User([
            'username' => $finalUsername,
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            if (!$users->save($user)) {
                throw new \Exception('Gagal membuat akun user: ' . implode(', ', $users->errors()));
            }

            $userId = $users->getInsertID();

            // Create PMW profile
            $profileModel = new \App\Models\ProfileModel($db);
            $profileData = [
                'user_id' => $userId,
                'nama' => $data['nama'],
                'nim' => $data['nim'],
                'jurusan' => $data['jurusan'],
                'prodi' => $data['prodi'],
                'semester' => $data['semester'] ?? 1,
                'phone' => $data['phone'],
                'foto' => $fotoPath,
                'gender' => $data['gender'] ?? 'L',
            ];

            if (!$profileModel->insert($profileData)) {
                $errors = json_encode($profileModel->errors());
                throw new \Exception('Gagal membuat profil mahasiswa: ' . $errors);
            }

            $periodModel = new \App\Models\PmwPeriodModel($db);
            $activePeriod = $periodModel->where('is_active', 1)->first();

            $proposalId = null;
            if ($activePeriod) {
                $proposalModel = new \App\Models\Proposal\PmwProposalModel($db);
                $proposalData = [
                    'period_id' => $activePeriod['id'],
                    'leader_user_id' => $userId,
                    'kategori_usaha' => '',
                    'nama_usaha' => '',
                    'kategori_wirausaha' => 'pemula',
                    'status' => 'draft',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $proposalId = $proposalModel->insert($proposalData, true);
                if (!$proposalId) {
                    $errors = $proposalModel->errors();
                    throw new \Exception('Gagal membuat draft proposal otomatis: ' . json_encode($errors));
                }

                // Insert sebagai ketua di proposal_members
                if (!$db->table('pmw_proposal_members')->insert([
                    'proposal_id' => $proposalId,
                    'role' => 'ketua',
                    'nama' => $data['nama'],
                    'nim' => $data['nim'],
                    'jurusan' => $data['jurusan'],
                    'prodi' => $data['prodi'],
                    'semester' => $data['semester'] ?? 1,
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ])) {
                    throw new \Exception('Gagal mendaftarkan anggota (ketua) proposal: ' . json_encode($db->error()));
                }
            }

            // Fetch the saved user and assign group
            $savedUser = $users->findById($userId);
            if (!$savedUser) {
                throw new \Exception('Gagal memverifikasi akun yang baru dibuat.');
            }
            
            $savedUser->addGroup('mahasiswa');

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaksi database gagal diselesaikan (Rollback).');
            }

            // Auto login with the saved user
            auth()->login($savedUser);
            // return redirect()->to('/dashboard')->with('message', 'Registrasi berhasil! Selamat datang di PMW Polsri.');          
            
            return redirect()->to('mahasiswa/pitching-desk')->with('message', 'Registrasi berhasil! Mulai dengan melengkapi Pitching Desk.');
        } catch (ValidationException $e) {
            $db->transRollback();
            // Delete uploaded foto if error
            if ($fotoPath && file_exists(WRITEPATH . $fotoPath)) {
                unlink(WRITEPATH . $fotoPath);
            }
            return redirect()->back()->withInput()->with('error', 'Validasi gagal: ' . $e->getMessage());
        } catch (\Exception $e) {
            $db->transRollback();
            // Delete uploaded foto if error
            if ($fotoPath && file_exists(WRITEPATH . $fotoPath)) {
                unlink(WRITEPATH . $fotoPath);
            }
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show login form
     */
    public function login()
    {
        // If already logged in, redirect based on role
        if (auth()->loggedIn()) {
            return redirect()->to($this->getRedirectUrlForRole());
        }

        return view('auth/login', [
            'title' => 'Masuk',
        ]);
    }

    /**
     * Process login
     */
    public function attemptLogin()
    {
        // Reverted to standard email-based login as requested
        $validation = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('error', 'Silakan masukkan email yang valid dan password.');
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        // Attempt to login
        $result = auth()->remember($remember)->attempt([
            'email' => $email,
            'password' => $password,
        ]);

        if (!$result->isOK()) {
            return redirect()->back()->withInput()->with('error', $result->reason());
        }

        // Role-based redirect
        $redirectUrl = $this->getRedirectUrlForRole();

        return redirect()->to($redirectUrl)->with('success', 'Selamat datang kembali!');
    }

    /**
     * Get redirect URL based on user role
     */
    private function getRedirectUrlForRole(): string
    {
        $user = auth()->user();

        if (!$user) {
            return 'dashboard';
        }

        // All roles redirect to dashboard after login
        return 'dashboard';
    }

    /**
     * Logout - Handle both GET and POST for Shield
     */
    public function logout()
    {
        // Only process if user is logged in
        if (auth()->loggedIn()) {
            // Get authenticator instance
            $authenticator = auth('session')->getAuthenticator();

            // Perform logout
            $authenticator->logout();
        }

        // Clear all session data
        session()->destroy();

        // Redirect ke login page dengan pesan
        return redirect()->to('/login')->with('message', 'Anda telah keluar.');
    }
}
