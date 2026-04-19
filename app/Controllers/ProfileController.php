<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\Proposal\PmwProposalMemberModel;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class ProfileController extends BaseController
{
    protected $helpers = ['form', 'url', 'pmw'];

    /**
     * Show profile settings page
     */
    public function index()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect()->to('login');
        }

        // Get user profile data
        $profileModel = new ProfileModel();
        $profile = $profileModel->where('user_id', $user->id)->first();

        // Get user groups/roles
        $groups = $user->getGroups();
        $primaryRole = $groups[0] ?? 'mahasiswa';

        // Get proposal and team data if user is mahasiswa
        $proposal = null;
        $teamMembers = [];
        
        if (in_array('mahasiswa', $groups)) {
            $proposalModel = new PmwProposalModel();
            $memberModel = new PmwProposalMemberModel();
            
            // Get active proposal for this user
            $proposal = $proposalModel->where('leader_user_id', $user->id)
                ->orderBy('created_at', 'DESC')
                ->first();
            
            if ($proposal) {
                $teamMembers = $memberModel->getByProposalId($proposal['id']);
            }
        }

        // Get user identities (email)
        $userModel = new UserModel();
        $userData = $userModel->find($user->id);
        $email = $userData ? $userData->getEmail() : '';

        $data = [
            'title'         => 'Pengaturan Akun',
            'user'          => $user,
            'profile'       => $profile,
            'email'         => $email,
            'primaryRole'   => $primaryRole,
            'groups'        => $groups,
            'proposal'      => $proposal,
            'teamMembers'   => $teamMembers,
            'jurusanList'   => getJurusanList(),
            'prodiList'     => getProdiList(),
        ];

        return view('profile/index', $data);
    }

    /**
     * Update profile information
     */
    public function updateProfile()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect()->to('login');
        }

        $rules = [
            'nama'     => 'required|min_length[3]|max_length[100]',
            'phone'    => 'permit_empty|max_length[20]',
            'jurusan'  => 'permit_empty|max_length[100]',
            'prodi'    => 'permit_empty|max_length[100]',
            'semester' => 'permit_empty|integer',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $profileModel = new ProfileModel();
        $existing = $profileModel->where('user_id', $user->id)->first();

        // Prepare data
        $updateData = [
            'nama'  => trim($this->request->getVar('nama') ?? ''),
            'phone' => trim($this->request->getVar('phone') ?? ''),
        ];

        // Only update these fields if they are present in the request
        // This handles cases where fields are hidden/disabled for certain roles
        if ($this->request->getVar('jurusan') !== null) {
            $updateData['jurusan'] = trim($this->request->getVar('jurusan'));
        }
        if ($this->request->getVar('prodi') !== null) {
            $updateData['prodi'] = trim($this->request->getVar('prodi'));
        }
        if ($this->request->getVar('semester') !== null) {
            $updateData['semester'] = $this->request->getVar('semester') ?: null;
        }

        if ($existing) {
            // Update existing
            $updateData['id'] = $existing['id'];
            
            // Disable nim validation for update
            $profileModel->setValidationRule('nim', 'permit_empty');
            
            if (! $profileModel->save($updateData)) {
                return redirect()->back()->withInput()->with('errors', $profileModel->errors());
            }

            // Sync with pmw_proposal_members if user is a student
            if (!empty($existing['nim']) || !empty($updateData['nim'])) {
                $searchNim = $existing['nim'] ?? $updateData['nim'];
                $proposalMemberModel = new \App\Models\Proposal\PmwProposalMemberModel();
                
                $syncData = [
                    'nama'     => $updateData['nama'],
                    'phone'    => $updateData['phone'],
                ];
                
                // Add NIM to sync if it was updated
                if (isset($updateData['nim']))      $syncData['nim']      = $updateData['nim'];
                if (isset($updateData['jurusan']))  $syncData['jurusan']  = $updateData['jurusan'];
                if (isset($updateData['prodi']))    $syncData['prodi']    = $updateData['prodi'];
                if (isset($updateData['semester'])) $syncData['semester'] = $updateData['semester'];

                $proposalMemberModel->where('nim', $searchNim)->set($syncData)->update();
            }
        } else {
            // Create new
            $updateData['user_id'] = $user->id;
            $updateData['nim'] = $this->request->getVar('nim') ?: 'TEMP-' . $user->id;
            
            if (! $profileModel->insert($updateData)) {
                return redirect()->back()->withInput()->with('errors', $profileModel->errors());
            }
        }

        return redirect()->to('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update password
     */
    public function updatePassword()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect()->to('login');
        }

        $rules = [
            'current_password'  => 'required',
            'new_password'      => 'required|min_length[8]',
            'confirm_password'  => 'required|matches[new_password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');

        // Verify current password via provider for better security context
        $userProvider = auth()->getProvider();
        $userData = $userProvider->findById($user->id);

        if ($userData === null || ! service('passwords')->verify($currentPassword, $userData->password_hash)) {
            return redirect()->back()->withInput()->with('error', 'Password saat ini tidak sesuai.');
        }

        // Update password
        $userData->password = $newPassword;
        
        if (! $userProvider->save($userData)) {
            return redirect()->back()->withInput()->with('errors', $userProvider->errors());
        }

        return redirect()->to('profile')->with('success', 'Password berhasil diperbarui.');
    }

    /**
     * Update profile photo
     */
    public function updateFoto()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect()->to('login');
        }

        $validationRules = [
            'foto' => 'uploaded[foto]|is_image[foto]|max_size[foto,2048]|ext_in[foto,jpg,jpeg,png]',
        ];

        if (! $this->validate($validationRules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('foto');
        
        if ($foto && $foto->isValid() && ! $foto->hasMoved()) {
            // Verify mime type (security check)
            $mimeType = $foto->getMimeType();
            $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (! in_array($mimeType, $allowedMimes)) {
                return redirect()->back()->with('error', 'Format file foto tidak valid.');
            }

            // Ensure upload directory exists
            $uploadDir = WRITEPATH . 'uploads/profiles';
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
                file_put_contents($uploadDir . '/.htaccess', "deny from all\n");
            }

            // Generate secure filename
            $newName = $foto->getRandomName();
            $foto->move($uploadDir, $newName);
            $fotoPath = 'uploads/profiles/' . $newName;

            // Get current profile to delete old foto
            $profileModel = new ProfileModel();
            $existing = $profileModel->where('user_id', $user->id)->first();

            if ($existing && ! empty($existing['foto'])) {
                $oldPath = WRITEPATH . $existing['foto'];
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            // Update profile with new foto path
            if ($existing) {
                $profileModel->update($existing['id'], ['foto' => $fotoPath]);
            } else {
                // Create profile with foto
                $profileModel->insert([
                    'user_id'  => $user->id,
                    'nama'     => $user->username,
                    'nim'      => 'TEMP-' . $user->id,
                    'jurusan'  => '',
                    'prodi'    => '',
                    'foto'     => $fotoPath,
                ]);
            }

            return redirect()->to('profile')->with('success', 'Foto profil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal mengupload foto.');
    }

    /**
     * Delete profile photo
     */
    public function deleteFoto()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect()->to('login');
        }

        $profileModel = new ProfileModel();
        $existing = $profileModel->where('user_id', $user->id)->first();

        if ($existing && ! empty($existing['foto'])) {
            $oldPath = WRITEPATH . $existing['foto'];
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }

            $profileModel->update($existing['id'], ['foto' => null]);
            return redirect()->to('profile')->with('success', 'Foto profil berhasil dihapus.');
        }

        return redirect()->to('profile')->with('error', 'Tidak ada foto profil yang dapat dihapus.');
    }

    /**
     * Update team member data (for mahasiswa)
     */
    public function updateTeam()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect()->to('login');
        }

        // Check if user is mahasiswa
        $groups = $user->getGroups();
        if (! in_array('mahasiswa', $groups)) {
            return redirect()->to('profile')->with('error', 'Hanya mahasiswa yang dapat mengedit data tim.');
        }

        $proposalId = $this->request->getPost('proposal_id');
        if (! $proposalId) {
            return redirect()->back()->with('error', 'Proposal tidak ditemukan.');
        }

        // Verify proposal belongs to this user
        $proposalModel = new PmwProposalModel();
        $proposal = $proposalModel->find($proposalId);
        
        if (! $proposal || $proposal['leader_user_id'] != $user->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke proposal ini.');
        }

        // Validate team members data
        $members = $this->request->getPost('members');
        if (! is_array($members)) {
            return redirect()->back()->with('error', 'Data anggota tidak valid.');
        }

        $memberModel = new PmwProposalMemberModel();
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Delete existing members (except ketua)
            // But first, let's get existing members to check for photos
            $existingMembers = $memberModel->where('proposal_id', $proposalId)->findAll();
            
            $memberModel->where('proposal_id', $proposalId)->delete();

            $files = $this->request->getFiles();
            $membersFoto = $files['members_foto'] ?? [];

            // Helper to handle photo upload
            $uploadMemberFoto = function($index) use ($membersFoto) {
                if (isset($membersFoto[$index]) && $membersFoto[$index]->isValid() && ! $membersFoto[$index]->hasMoved()) {
                    $uploadDir = WRITEPATH . 'uploads/members';
                    if (! is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                        file_put_contents($uploadDir . '/.htaccess', "deny from all\n");
                    }
                    $newName = $membersFoto[$index]->getRandomName();
                    $membersFoto[$index]->move($uploadDir, $newName);
                    return 'uploads/members/' . $newName;
                }
                return null;
            };

            foreach ($members as $index => $m) {
                $role = $m['role'] ?? 'anggota';
                
                // Handle photo
                $fotoPath = $uploadMemberFoto($index);
                if (! $fotoPath && ! empty($m['foto'])) {
                    $fotoPath = $m['foto']; // Keep existing
                }

                $memberData = [
                    'proposal_id' => $proposalId,
                    'role'        => $role,
                    'nama'        => $m['nama'] ?? '',
                    'nim'         => $m['nim'] ?? '',
                    'jurusan'     => $m['jurusan'] ?? '',
                    'prodi'       => $m['prodi'] ?? '',
                    'semester'    => $m['semester'] ?? null,
                    'phone'       => $m['phone'] ?? '',
                    'email'       => $m['email'] ?? '',
                    'foto'        => $fotoPath,
                ];

                $memberModel->insert($memberData);

                // Sync back to pmw_profiles if this is the ketua
                if ($role === 'ketua') {
                    $profileModel = new \App\Models\ProfileModel();
                    $profileModel->where('user_id', $proposal['leader_user_id'])
                        ->set([
                            'nama'    => $memberData['nama'],
                            'nim'     => $memberData['nim'],
                            'jurusan' => $memberData['jurusan'],
                            'prodi'   => $memberData['prodi'],
                            'phone'   => $memberData['phone'],
                        ])
                        ->update();
                }
            }

            $db->transComplete();

            return redirect()->to('profile')->with('success', 'Data tim berhasil diperbarui.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal memperbarui data tim: ' . $e->getMessage());
        }
    }

    /**
     * View profile photo (serve file securely)
     */
    public function viewFoto($userId = null)
    {
        $currentUser = auth()->user();
        if (! $currentUser) {
            return redirect()->to('login');
        }

        // If no userId provided, use current user
        $targetUserId = $userId ?? $currentUser->id;

        $profileModel = new ProfileModel();
        $profile = $profileModel->where('user_id', $targetUserId)->first();

        if (! $profile || empty($profile['foto'])) {
            // Return default avatar
            $defaultPath = ROOTPATH . 'public/assets/img/default-avatar.png';
            if (file_exists($defaultPath)) {
                return $this->response->setContentType('image/png')->setBody(file_get_contents($defaultPath));
            }
            return $this->response->setStatusCode(404);
        }

        $filePath = WRITEPATH . $profile['foto'];
        if (! file_exists($filePath)) {
            return $this->response->setStatusCode(404);
        }

        // Serve file with proper content type
        $mimeType = mime_content_type($filePath);
        return $this->response
            ->setContentType($mimeType)
            ->setBody(file_get_contents($filePath));
    }

    /**
     * View member photo (serve file securely)
     */
    public function viewMemberFoto($memberId)
    {
        $currentUser = auth()->user();
        if (! $currentUser) {
            return redirect()->to('login');
        }

        $memberModel = new PmwProposalMemberModel();
        $member = $memberModel->find($memberId);

        if (! $member || empty($member['foto'])) {
            // Return default avatar
            $defaultPath = ROOTPATH . 'public/assets/img/default-avatar.png';
            if (file_exists($defaultPath)) {
                return $this->response->setContentType('image/png')->setBody(file_get_contents($defaultPath));
            }
            return $this->response->setStatusCode(404);
        }

        $filePath = WRITEPATH . $member['foto'];
        if (! file_exists($filePath)) {
            return $this->response->setStatusCode(404);
        }

        // Serve file with proper content type
        $mimeType = mime_content_type($filePath);
        return $this->response
            ->setContentType($mimeType)
            ->setBody(file_get_contents($filePath));
    }
}
