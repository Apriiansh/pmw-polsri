<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Data for Prodi Mapping (Isolated from attributes to avoid syntax errors) -->
<script>
    window.pmwProdiList = <?= json_encode($prodiList ?? []) ?>;
</script>

<div class="space-y-8" x-data="userForm()">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="max-w-2xl mx-auto animate-stagger">
        <div class="flex items-center gap-3 mb-2">
            <a href="<?= base_url('admin/users') ?>" class="text-slate-400 hover:text-sky-500 transition-colors p-2 -ml-2 rounded-lg hover:bg-slate-100">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="section-title mb-0!">
                <?= isset($user) ? 'Edit' : 'Tambah' ?> <span class="text-gradient">User</span>
            </h2>
        </div>
        <p class="section-subtitle"><?= $header_subtitle ?></p>
    </div>


    <!-- ================================================================
         2. FORM CARD
    ================================================================= -->
    <div class="max-w-2xl mx-auto animate-stagger delay-200">
        <div class="card-premium overflow-hidden">
            
            <!-- Card Header -->
            <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    Informasi User
                </h3>
                <p class="text-[11px] text-(--text-muted) mt-0.5">
                    Lengkapi data user dan pilih role yang sesuai
                </p>
            </div>

            <!-- Form -->
            <form action="<?= isset($user) ? base_url('admin/users/update/' . $user->id) : base_url('admin/users/store') ?>" 
                  method="post" 
                  class="p-5 sm:p-7 space-y-5 sm:space-y-6">
                
                <?= csrf_field() ?>

                <!-- Username -->
                <div class="form-field">
                    <label class="form-label">
                        Username <span class="required">*</span>
                    </label>
                    <div class="input-group <?= session('errors.username') ? 'input-error' : '' ?>">
                        <span class="input-icon">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text"
                               name="username"
                               value="<?= old('username', $user->username ?? '') ?>"
                               placeholder="Masukkan username"
                               required>
                    </div>
                    <?php if (session('errors.username')): ?>
                        <p class="form-error">
                            <i class="fas fa-circle-exclamation"></i>
                            <?= session('errors.username') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Email -->
                <div class="form-field">
                    <label class="form-label">
                        Email <span class="required">*</span>
                    </label>
                    <div class="input-group <?= session('errors.email') ? 'input-error' : '' ?>">
                        <span class="input-icon">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email"
                               name="email"
                               value="<?= old('email', isset($user) ? $user->getEmail() : '') ?>"
                               placeholder="nama@email.com"
                               <?= isset($user) ? 'readonly' : 'required' ?>>
                    </div>
                    <?php if (isset($user)): ?>
                        <p class="text-xs text-slate-400 mt-1">Email tidak dapat diubah</p>
                    <?php endif; ?>
                    <?php if (session('errors.email')): ?>
                        <p class="form-error">
                            <i class="fas fa-circle-exclamation"></i>
                            <?= session('errors.email') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="form-field">
                    <label class="form-label">
                        Password <?= isset($user) ? '' : '<span class="required">*</span>' ?>
                    </label>
                    <div class="input-group <?= session('errors.password') ? 'input-error' : '' ?>">
                        <span class="input-icon">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input :type="showPassword ? 'text' : 'password'"
                               name="password"
                               placeholder="<?= isset($user) ? 'Kosongkan jika tidak ingin mengubah' : 'Minimal 8 karakter' ?>"
                               <?= isset($user) ? '' : 'required' ?>>
                        <button type="button"
                                @click="showPassword = !showPassword"
                                class="text-slate-400 hover:text-sky-500 transition-colors px-2">
                            <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    <?php if (session('errors.password')): ?>
                        <p class="form-error">
                            <i class="fas fa-circle-exclamation"></i>
                            <?= session('errors.password') ?>
                        </p>
                    <?php endif; ?>
                </div>


                <!-- Role Selection -->
                <div class="form-field">
                    <label class="form-label">
                        Role <span class="required">*</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <?php 
                        $roleIcons = [
                            'admin'     => 'fa-user-shield',
                            'mahasiswa' => 'fa-user-graduate',
                            'dosen'     => 'fa-chalkboard-user',
                            'mentor'    => 'fa-handshake-angle',
                            'reviewer'  => 'fa-clipboard-check',
                        ];
                        $roleColors = [
                            'admin'     => 'border-rose-400 bg-rose-50 shadow-sm shadow-rose-100',
                            'mahasiswa' => 'border-sky-400 bg-sky-50 shadow-sm shadow-sky-100',
                            'dosen'     => 'border-violet-400 bg-violet-50 shadow-sm shadow-violet-100',
                            'mentor'    => 'border-teal-400 bg-teal-50 shadow-sm shadow-teal-100',
                            'reviewer'  => 'border-yellow-400 bg-yellow-50 shadow-sm shadow-yellow-100',
                        ];
                        $roleIconColors = [
                            'admin'     => 'text-rose-500',
                            'mahasiswa' => 'text-sky-500',
                            'dosen'     => 'text-violet-500',
                            'mentor'    => 'text-teal-500',
                            'reviewer'  => 'text-yellow-500',
                        ];
                        $roleTextColors = [
                            'admin'     => 'text-rose-900',
                            'mahasiswa' => 'text-sky-900',
                            'dosen'     => 'text-violet-900',
                            'mentor'    => 'text-teal-900',
                            'reviewer'  => 'text-yellow-900',
                        ];
                        $roleCheckColors = [
                            'admin'     => 'bg-rose-500 border-rose-500',
                            'mahasiswa' => 'bg-sky-500 border-sky-500',
                            'dosen'     => 'bg-violet-500 border-violet-500',
                            'mentor'    => 'bg-teal-500 border-teal-500',
                            'reviewer'  => 'bg-yellow-500 border-yellow-500',
                        ];
                        
                        foreach ($roles as $roleKey => $roleInfo): 
                        ?>
                        <label class="relative cursor-pointer group">
                            <input type="radio" 
                                   name="role" 
                                   value="<?= $roleKey ?>"
                                   x-model="selectedRole"
                                   class="sr-only"
                                   required>
                            <div class="p-4 rounded-xl border transition-all duration-300"
                                 :class="selectedRole === '<?= $roleKey ?>' ? '<?= $roleColors[$roleKey] ?>' : 'border-slate-200 bg-white hover:border-slate-300'">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300"
                                         :class="selectedRole === '<?= $roleKey ?>' ? 'bg-white shadow-sm' : 'bg-slate-100'">
                                        <i class="fas <?= $roleIcons[$roleKey] ?? 'fa-user' ?> transition-colors duration-300"
                                           :class="selectedRole === '<?= $roleKey ?>' ? '<?= $roleIconColors[$roleKey] ?>' : 'text-slate-500'"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-display font-bold text-sm transition-colors duration-300"
                                           :class="selectedRole === '<?= $roleKey ?>' ? '<?= $roleTextColors[$roleKey] ?>' : 'text-(--text-heading)' ">
                                            <?= $roleInfo['title'] ?>
                                        </p>
                                        <p class="text-xs text-(--text-muted) mt-0.5 line-clamp-2">
                                            <?= $roleInfo['description'] ?>
                                        </p>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-all duration-300"
                                         :class="selectedRole === '<?= $roleKey ?>' ? '<?= $roleCheckColors[$roleKey] ?> scale-110' : 'border-slate-300'">
                                        <i class="fas fa-check text-white text-[10px] transition-opacity duration-300"
                                           :class="selectedRole === '<?= $roleKey ?>' ? 'opacity-100' : 'opacity-0'"></i>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <?php endforeach; ?>
                    </div>
                    <?php if (session('errors.role')): ?>
                        <p class="form-error mt-2">
                            <i class="fas fa-circle-exclamation"></i>
                            <?= session('errors.role') ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- ==========================================
                     ROLE-SPECIFIC PROFILE FIELDS
                ========================================== -->
                <div class="border-t border-sky-50 pt-6 mt-6">
                    <h4 class="font-display font-bold text-sm text-(--text-heading) mb-4 flex items-center gap-2">
                        <i class="fas fa-id-card text-sky-500"></i>
                        Data Profil <span class="text-(--text-muted) font-normal">(<span x-text="selectedRole === 'mahasiswa' ? 'Mahasiswa' : selectedRole === 'dosen' ? 'Dosen' : selectedRole === 'mentor' ? 'Mentor' : selectedRole === 'reviewer' ? 'Reviewer' : 'Admin'"></span>)</span>
                    </h4>

                    <!-- Common Fields -->
                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <!-- Nama Lengkap -->
                        <div class="form-field">
                            <label class="form-label">
                                Nama Lengkap <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-icon">
                                    <i class="fas fa-id-badge"></i>
                                </span>
                                <input type="text"
                                       name="nama"
                                       value="<?= old('nama', $profileData['nama'] ?? '') ?>"
                                       placeholder="Nama lengkap"
                                       required>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="form-field">
                            <label class="form-label">
                                Nomor Telepon
                            </label>
                            <div class="input-group">
                                <span class="input-icon">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="tel"
                                       name="phone"
                                       value="<?= old('phone', $profileData['phone'] ?? '') ?>"
                                       placeholder="08xxxxxxxxx">
                            </div>
                        </div>
                    </div>

                    <!-- MAHASISWA Fields -->
                    <div x-show="selectedRole === 'mahasiswa'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <div class="space-y-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <!-- NIM -->
                                <div class="form-field">
                                    <label class="form-label">
                                        NIM <span class="required">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-hashtag"></i>
                                        </span>
                                        <input type="text"
                                               name="nim"
                                               value="<?= old('nim', $profileData['nim'] ?? '') ?>"
                                               placeholder="Contoh: 062230700000"
                                               :required="selectedRole === 'mahasiswa'"
                                               :disabled="selectedRole !== 'mahasiswa'">
                                    </div>
                                </div>

                                <!-- Semester -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Semester
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-calendar"></i>
                                        </span>
                                        <select name="semester"
                                                :disabled="selectedRole !== 'mahasiswa'">
                                            <?php for ($i = 1; $i <= 8; $i++): ?>
                                                <option value="<?= $i ?>" <?= old('semester', $profileData['semester'] ?? '1') == $i ? 'selected' : '' ?>>Semester <?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">
                                <!-- Jurusan -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Jurusan <span class="required">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        <select name="jurusan"
                                                x-model="jurusan"
                                                @change="$refs.prodiSelect.value = ''"
                                                :required="selectedRole === 'mahasiswa'"
                                                :disabled="selectedRole !== 'mahasiswa'">
                                            <option value="">Pilih Jurusan</option>
                                            <?php foreach ($jurusanList as $j): ?>
                                                <option value="<?= $j ?>"><?= $j ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Prodi -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Program Studi <span class="required">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-graduation-cap"></i>
                                        </span>
                                        <select name="prodi"
                                                x-ref="prodiSelect"
                                                :disabled="!jurusan || selectedRole !== 'mahasiswa'"
                                                :required="selectedRole === 'mahasiswa'">
                                            <option value="">Pilih Prodi</option>
                                            <template x-for="prodi in prodiOptions" :key="prodi">
                                                <option :value="prodi" x-text="prodi"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="form-field">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="flex gap-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="L" <?= old('gender', $profileData['gender'] ?? 'L') === 'L' ? 'checked' : '' ?> class="w-4 h-4 text-sky-500" :disabled="selectedRole !== 'mahasiswa'">
                                        <span class="text-sm">Laki-laki</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="P" <?= old('gender', $profileData['gender'] ?? '') === 'P' ? 'checked' : '' ?> class="w-4 h-4 text-sky-500" :disabled="selectedRole !== 'mahasiswa'">
                                        <span class="text-sm">Perempuan</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DOSEN Fields -->
                    <div x-show="selectedRole === 'dosen'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <div class="space-y-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <!-- NIP -->
                                <div class="form-field">
                                    <label class="form-label">
                                        NIP
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-hashtag"></i>
                                        </span>
                                        <input type="text"
                                               name="nip"
                                               value="<?= old('nip', $profileData['nip'] ?? '') ?>"
                                               placeholder="Nomor Induk Pegawai"
                                               :disabled="selectedRole !== 'dosen' && selectedRole !== 'reviewer'">
                                    </div>
                                </div>

                                <!-- Expertise -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Bidang Keahlian
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-brain"></i>
                                        </span>
                                        <input type="text"
                                               name="expertise"
                                               value="<?= old('expertise', $profileData['expertise'] ?? '') ?>"
                                               placeholder="Contoh: Kewirausahaan, Digital Marketing"
                                               :disabled="selectedRole !== 'dosen' && selectedRole !== 'mentor' && selectedRole !== 'reviewer'">
                                    </div>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">
                                <!-- Jurusan -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Jurusan
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        <select name="jurusan"
                                                x-model="jurusan"
                                                @change="$refs.prodiSelectDosen.value = ''"
                                                :disabled="selectedRole !== 'dosen'">
                                            <option value="">Pilih Jurusan</option>
                                            <?php foreach ($jurusanList as $j): ?>
                                                <option value="<?= $j ?>"><?= $j ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Prodi -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Program Studi
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-graduation-cap"></i>
                                        </span>
                                        <select name="prodi"
                                                x-ref="prodiSelectDosen"
                                                :disabled="!jurusan || selectedRole !== 'dosen'">
                                            <option value="">Pilih Prodi</option>
                                            <template x-for="prodi in prodiOptions" :key="prodi">
                                                <option :value="prodi" x-text="prodi"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Bio -->
                            <div class="form-field">
                                <label class="form-label">
                                    Biografi / Catatan
                                </label>
                                 <textarea name="bio"
                                           rows="3"
                                           class="form-textarea"
                                           placeholder="Biografi singkat (optional)"
                                           :disabled="selectedRole === 'admin' || selectedRole === 'mahasiswa'"><?= old('bio', $profileData['bio'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- MENTOR Fields -->
                    <div x-show="selectedRole === 'mentor'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <div class="space-y-4">
                            <div class="grid md:grid-cols-2 gap-4">
                                <!-- Company -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Perusahaan / Organisasi <span class="required">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        <input type="text"
                                               name="company"
                                               value="<?= old('company', $profileData['company'] ?? '') ?>"
                                               placeholder="Nama perusahaan/organisasi"
                                               :required="selectedRole === 'mentor'"
                                               :disabled="selectedRole !== 'mentor'">
                                    </div>
                                </div>

                                <!-- Position -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Jabatan
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-briefcase"></i>
                                        </span>
                                        <input type="text"
                                               name="position"
                                               value="<?= old('position', $profileData['position'] ?? '') ?>"
                                               placeholder="Contoh: CEO, Founder, Manager"
                                               :disabled="selectedRole !== 'mentor'">
                                    </div>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">
                                <!-- Expertise -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Bidang Keahlian
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-brain"></i>
                                        </span>
                                        <input type="text"
                                               name="expertise"
                                               value="<?= old('expertise', $profileData['expertise'] ?? '') ?>"
                                               placeholder="Contoh: Business Development">
                                    </div>
                                </div>

                                <!-- Email Secondary -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Email Alternatif
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email"
                                               name="email_secondary"
                                               value="<?= old('email_secondary', $profileData['email'] ?? '') ?>"
                                               placeholder="Email alternatif"
                                               :disabled="selectedRole !== 'mentor'">
                                    </div>
                                </div>
                            </div>

                            <!-- Bio -->
                            <div class="form-field">
                                <label class="form-label">
                                    Biografi / Pengalaman
                                </label>
                                <textarea name="bio"
                                          rows="3"
                                          class="form-textarea"
                                          placeholder="Pengalaman dan keahlian mentor (optional)"><?= old('bio', $profileData['bio'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- REVIEWER Fields -->
                    <div x-show="selectedRole === 'reviewer'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <div class="space-y-4">
                            <div class="grid md:grid-cols-3 gap-4">
                                <!-- NIDN -->
                                <div class="form-field">
                                    <label class="form-label">
                                        NIDN
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                        <input type="text"
                                               name="nidn"
                                               value="<?= old('nidn', $profileData['nidn'] ?? '') ?>"
                                               placeholder="Nomor Dosen"
                                               :disabled="selectedRole !== 'reviewer'">
                                    </div>
                                </div>

                                <!-- NIP -->
                                <div class="form-field">
                                    <label class="form-label">
                                        NIP
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-hashtag"></i>
                                        </span>
                                        <input type="text"
                                               name="nip"
                                               value="<?= old('nip', $profileData['nip'] ?? '') ?>"
                                               placeholder="Nomor Induk Pegawai"
                                               :disabled="selectedRole !== 'reviewer'">
                                    </div>
                                </div>

                                <!-- Institution -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Institusi
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-university"></i>
                                        </span>
                                        <input type="text"
                                               name="institution"
                                               value="<?= old('institution', $profileData['institution'] ?? '') ?>"
                                               placeholder="Asal institusi"
                                               :disabled="selectedRole !== 'reviewer'">
                                    </div>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">
                                <!-- Expertise -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Bidang Keahlian
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-brain"></i>
                                        </span>
                                        <input type="text"
                                               name="expertise"
                                               value="<?= old('expertise', $profileData['expertise'] ?? '') ?>"
                                               placeholder="Contoh: Evaluasi Bisnis, Teknologi">
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="form-field">
                                    <label class="form-label">
                                        Nomor Telepon
                                    </label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <input type="tel"
                                               name="phone_reviewer"
                                               value="<?= old('phone_reviewer', $profileData['phone'] ?? '') ?>"
                                               placeholder="08xxxxxxxxx"
                                               :disabled="selectedRole !== 'reviewer'">
                                    </div>
                                </div>
                            </div>

                            <!-- Bio -->
                            <div class="form-field">
                                <label class="form-label">
                                    Biografi / Catatan
                                </label>
                                <textarea name="bio"
                                          rows="3"
                                          class="form-textarea"
                                          placeholder="Biografi dan pengalaman reviewer (optional)"><?= old('bio', $profileData['bio'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- ADMIN Fields (minimal) -->
                    <div x-show="selectedRole === 'admin'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        <p class="text-sm text-(--text-muted)">
                            <i class="fas fa-info-circle mr-1"></i>
                            Admin tidak memerlukan data profil tambahan. Data nama dan telepon sudah mencukupi.
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 pt-4 border-t border-sky-50">
                    <a href="<?= base_url('admin/users') ?>" class="btn-outline px-6 text-center">
                        Batal
                    </a>
                    <button type="submit" class="btn-accent px-6 gap-2 justify-center">
                        <i class="fas fa-save"></i>
                        <?= isset($user) ? 'Update User' : 'Simpan User' ?>
                    </button>
                </div>

            </form>
        </div>
    </div>

</div><!-- /page wrapper -->

<script>
    function userForm() {
        return {
            showPassword: false,
            selectedRole: '<?= old('role', isset($userGroups) && !empty($userGroups) ? $userGroups[0] : 'mahasiswa') ?>',
            jurusan: '<?= old('jurusan', $profileData['jurusan'] ?? '') ?>',
            prodiList: window.pmwProdiList,
            get prodiOptions() {
                return this.prodiList[this.jurusan] || [];
            }
        }
    }
</script>

<?= $this->endSection() ?>
