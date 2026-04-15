<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Exceptions\ValidationException;

class AuthController extends BaseController
{
    protected $helpers = ['form', 'url', 'text'];

    /**
     * Show register form
     */
    public function register()
    {
        // If already logged in, redirect based on role
        if (auth()->loggedIn()) {
            return redirect()->to($this->getRedirectUrlForRole());
        }

        return view('auth/register', [
            'title' => 'Daftar Akun',
        ]);
    }

    /**
     * Process registration
     */
    public function attemptRegister()
    {
        $validation = $this->validate([
            'nama' => 'required|min_length[3]|max_length[100]',
            'username' => 'required|min_length[5]|max_length[20]|is_unique[users.username]|is_unique[pmw_profiles.nim]',
            'email' => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|min_length[8]|strong_password',
            'password_confirm' => 'required|matches[password]',
            'jurusan' => 'required',
            'prodi' => 'required|max_length[100]',
            'phone' => 'required|regex_match[/^[0-9\s\+\-\(\)]+$/]|min_length[10]|max_length[20]',
            'foto' => 'permit_empty|is_image[foto]|max_size[foto,2048]|ext_in[foto,jpg,jpeg,png]',
            'semester' => 'permit_empty|numeric',
            'gender' => 'permit_empty|in_list[L,P]',
        ], [
            'username' => [
                'is_unique' => 'NIM atau username ini sudah terdaftar sebagai akun.',
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

        // Handle foto upload
        $fotoPath = null;
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(WRITEPATH . 'uploads/profiles', $newName);
            $fotoPath = 'uploads/profiles/' . $newName;
        }

        // Create Shield user
        $users = auth()->getProvider();
        $user = new User([
            'username' => $data['username'], // Using the field directly
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        try {
            // Save user to get user ID
            if (!$users->save($user)) {
                throw new \Exception('Gagal membuat akun user: ' . implode(', ', $users->errors()));
            }
            
            $userId = $users->getInsertID();

            // Create PMW profile
            $profileModel = new \App\Models\ProfileModel();
            $profileModel->insert([
                'user_id' => $userId,
                'nama' => $data['nama'],
                'nim' => $data['username'], // Save username (NIM input) to profile nim column
                'jurusan' => $data['jurusan'],
                'prodi' => $data['prodi'],
                'semester' => $data['semester'] ?? 1,
                'phone' => $data['phone'],
                'foto' => $fotoPath,
                'gender' => $data['gender'] ?? 'L',
            ]);

            // Fetch the saved user and assign group
            $savedUser = $users->findById($userId);
            $savedUser->addGroup('mahasiswa');

            // Auto login with the saved user
            auth()->login($savedUser);

            return redirect()->to('/dashboard')->with('message', 'Registrasi berhasil! Selamat datang di PMW Polsri.');
        } catch (ValidationException $e) {
            // Delete uploaded foto if error
            if ($fotoPath && file_exists(WRITEPATH . $fotoPath)) {
                unlink(WRITEPATH . $fotoPath);
            }
            return redirect()->back()->withInput()->with('error', 'Validasi gagal: ' . $e->getMessage());
        } catch (\Exception $e) {
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
            'email'    => 'required|valid_email',
            'password' => 'required',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('error', 'Silakan masukkan email yang valid dan password.');
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        // Attempt to login
        $result = auth()->attempt([
            'email'    => $email,
            'password' => $password,
        ]);

        if (! $result->isOK()) {
            return redirect()->back()->withInput()->with('error', $result->reason());
        }

        // Handle remember me
        if ($remember) {
            auth()->user()->rememberMe();
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

        $groups = $user->getGroups();
        $role = $groups[0] ?? 'mahasiswa';

        return match ($role) {
            'admin'     => 'admin/users',
            'mahasiswa' => 'mahasiswa/proposal',
            'dosen'     => 'dosen/monitoring',
            'mentor'    => 'mentor/monitoring',
            'reviewer'  => 'reviewer/penilaian-proposal',
            default     => 'dashboard',
        };
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
