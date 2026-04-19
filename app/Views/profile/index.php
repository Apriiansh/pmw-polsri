<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php helper('pmw'); ?>
<?php $prodiList = $prodiList ?? getProdiList(); ?>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('profileForm', () => ({
            showCurrentPass: false,
            showNewPass: false,
            showConfirmPass: false,
            passwordStrength: 0,
            passwordStrengthText: '',
            passwordStrengthColor: 'text-slate-400',
            fotoPreview: null,
            activeTab: 'profile',
            jurusan: <?= json_encode(old('jurusan', $profile['jurusan'] ?? '')) ?>,
            prodi: <?= json_encode(old('prodi', $profile['prodi'] ?? '')) ?>,
            semester: <?= json_encode(old('semester', $profile['semester'] ?? '')) ?>,
            prodiList: <?= json_encode($prodiList) ?>,
            teamMembers: <?= json_encode($teamMembers ?: []) ?>,

            init() {
                // Ensure prodi value is applied AFTER the options list re-renders
                if (this.jurusan) {
                    this.$nextTick(() => {
                        this.prodi = <?= json_encode(old('prodi', $profile['prodi'] ?? '')) ?>;
                    });
                }
                
                // Initialize team members with editing flag
                this.teamMembers = this.teamMembers.map(m => ({
                    ...m,
                    editing: false,
                    fotoPreview: null
                }));
            },

            jurusanList() {
                return Object.keys(this.prodiList);
            },

            prodiOptions() {
                return this.prodiList[this.jurusan] || [];
            },

            updatePasswordStrength(password) {
                let strength = 0;
                if (password.length >= 8) strength++;
                if (password.length >= 12) strength++;
                if (/[A-Z]/.test(password) && /[a-z]/.test(password)) strength++;
                if (/[0-9]/.test(password) && /[^A-Za-z0-9]/.test(password)) strength++;
                
                this.passwordStrength = strength;
                
                const labels = ['Sangat Lemah', 'Sangat Lemah', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];
                const colors = ['text-slate-400', 'text-rose-500', 'text-orange-400', 'text-yellow-500', 'text-primary', 'text-emerald-500'];
                const bgs = ['bg-slate-100', 'bg-rose-500', 'bg-orange-400', 'bg-yellow-500', 'bg-primary', 'bg-emerald-500'];
                
                this.passwordStrengthText = password.length > 0 ? (labels[strength] || '') : '';
                this.passwordStrengthColor = colors[strength] || 'text-slate-400';
                this.passwordStrengthBg = bgs[strength] || 'bg-slate-100';
            },

            handleFotoChange(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.fotoPreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },

            removeFotoPreview() {
                this.fotoPreview = null;
                const input = document.querySelector('input[name="foto"]');
                if (input) input.value = '';
            },

            showToast(message, type = 'info') {
                const toast = document.createElement('div');
                const bgColor = type === 'success' ? 'bg-emerald-500' : type === 'error' ? 'bg-rose-500' : 'bg-sky-500';
                const icon = type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle';
                toast.className = `fixed top-4 right-4 ${bgColor} text-white px-4 py-3 rounded-xl shadow-lg z-50 text-sm font-medium flex items-center gap-2 animate-fade-in-down`;
                toast.innerHTML = `<i class="fas ${icon}"></i>${message}`;
                document.body.appendChild(toast);
                setTimeout(() => {
                    toast.classList.add('animate-fade-out-up');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            },

            getMemberProdiOptions(jurusan) {
                return this.prodiList[jurusan] || [];
            },

            addTeamMember() {
                if (this.teamMembers.length >= 5) {
                    this.showToast('Maksimal 5 anggota tim (termasuk ketua).', 'error');
                    return;
                }
                this.teamMembers.push({
                    role: 'anggota',
                    nama: '',
                    nim: '',
                    jurusan: '',
                    prodi: '',
                    email: '',
                    phone: '',
                    semester: '',
                    id: null,
                    foto: null,
                    fotoPreview: null,
                    editing: true
                });
            },

            removeTeamMember(index) {
                this.teamMembers.splice(index, 1);
            },

            handleMemberFotoChange(index, event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.teamMembers[index].fotoPreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },

            removeMemberFotoPreview(index) {
                this.teamMembers[index].fotoPreview = null;
                // We don't reset the file input easily with x-for, 
                // but setting it to null is enough for preview logic
            },
        }));
    });
</script>

<section class="py-6" x-data="profileForm">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-(--text-heading) mb-2">Pengaturan Akun</h1>
        <p class="text-(--text-muted)">Kelola informasi profil, password, dan data tim Anda</p>
    </div>

    <!-- Flash Messages -->
    <?php if (session('success')): ?>
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm flex items-start gap-3">
            <i class="fas fa-check-circle mt-0.5"></i>
            <div><?= session('success') ?></div>
        </div>
    <?php endif; ?>

    <?php if (session('error')): ?>
        <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-700 text-sm flex items-start gap-3">
            <i class="fas fa-exclamation-circle mt-0.5"></i>
            <div><?= session('error') ?></div>
        </div>
    <?php endif; ?>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Left Column - Profile Summary -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Profile Card -->
            <div class="card-premium text-center">
                <!-- Foto Profile -->
                <div class="relative inline-block mb-6">
                    <div class="w-28 h-28 rounded-3xl overflow-hidden border-4 border-white shadow-xl mx-auto bg-slate-100">
                        <?php if (!empty($profile['foto'])): ?>
                            <img src="<?= base_url('profile/foto/' . $user->id) ?>" class="w-full h-full object-cover">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-user text-4xl text-slate-300"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-emerald-500 rounded-2xl flex items-center justify-center border-4 border-white shadow-lg animate-bounce-subtle">
                        <i class="fas fa-check text-white text-xs"></i>
                    </div>
                </div>
                
                <h3 class="text-xl font-bold text-slate-800 mb-1 font-display"><?= esc($profile['nama'] ?? $user->username) ?></h3>
                <p class="text-sm text-slate-500 mb-4"><?= esc($email) ?></p>
                
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-bold bg-primary-50 text-primary border border-primary-100 uppercase tracking-wider">
                    <i class="fas fa-shield-alt"></i>
                    <?= ucfirst($primaryRole) ?>
                </div>

                <div class="mt-8 space-y-3 pt-6 border-t border-slate-100 text-left">
                    <div class="flex items-center justify-between group/info">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-tight">Username</span>
                        <span class="text-sm font-semibold text-slate-700"><?= esc($user->username) ?></span>
                    </div>
                    <?php if (!empty($profile['nim'])): ?>
                        <div class="flex items-center justify-between group/info">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-tight">NIM</span>
                            <span class="text-sm font-semibold text-slate-700"><?= esc($profile['nim']) ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($profile['phone'])): ?>
                        <div class="flex items-center justify-between group/info">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-tight">Telepon</span>
                            <span class="text-sm font-semibold text-slate-700"><?= esc($profile['phone']) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card-premium">
                <h4 class="text-sm font-bold text-slate-800 mb-4 font-display flex items-center gap-2 uppercase tracking-widest">
                    <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                    Menu Navigasi
                </h4>
                <div class="space-y-1.5">
                    <button @click="activeTab = 'profile'" 
                        :class="activeTab === 'profile' ? 'active' : ''"
                        class="sidebar-item w-full">
                        <i class="fas fa-user-edit sidebar-item-icon"></i>
                        <span class="sidebar-item-label">Informasi Profil</span>
                        <template x-if="activeTab === 'profile'">
                            <i class="fas fa-chevron-right text-[10px] ml-auto"></i>
                        </template>
                    </button>
                    
                    <button @click="activeTab = 'password'" 
                        :class="activeTab === 'password' ? 'active' : ''"
                        class="sidebar-item w-full">
                        <i class="fas fa-fingerprint sidebar-item-icon"></i>
                        <span class="sidebar-item-label">Keamanan Akun</span>
                        <template x-if="activeTab === 'password'">
                            <i class="fas fa-chevron-right text-[10px] ml-auto"></i>
                        </template>
                    </button>

                    <?php if (in_array('mahasiswa', $groups)): ?>
                        <button @click="activeTab = 'foto'" 
                            :class="activeTab === 'foto' ? 'active' : ''"
                            class="sidebar-item w-full">
                            <i class="fas fa-camera-retro sidebar-item-icon"></i>
                            <span class="sidebar-item-label">Foto Biometrik</span>
                            <template x-if="activeTab === 'foto'">
                                <i class="fas fa-chevron-right text-[10px] ml-auto"></i>
                            </template>
                        </button>
                    <?php endif; ?>

                    <?php if (in_array('mahasiswa', $groups) && $proposal): ?>
                        <button @click="activeTab = 'team'" 
                            :class="activeTab === 'team' ? 'active' : ''"
                            class="sidebar-item w-full">
                            <i class="fas fa-users-viewfinder sidebar-item-icon"></i>
                            <span class="sidebar-item-label">Manajemen Tim</span>
                            <template x-if="activeTab === 'team'">
                                <i class="fas fa-chevron-right text-[10px] ml-auto"></i>
                            </template>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Right Column - Forms -->
        <div class="lg:col-span-2">
            <!-- Tab: Edit Profil -->
            <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="card-premium">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-2xl bg-primary-50 flex items-center justify-center border border-primary-100 shadow-sm">
                        <i class="fas fa-user-edit text-primary text-xl"></i>
                    </div>
                    <div>
                        <h3 class="section-title text-xl">Edit Profil</h3>
                        <p class="section-subtitle">Perbarui informasi personal Anda</p>
                    </div>
                </div>

                <form action="<?= base_url('profile/update') ?>" method="post" class="space-y-6">
                    <?= csrf_field() ?>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div class="md:col-span-2 form-field">
                            <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                            <div class="input-group">
                                <div class="input-icon">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <input type="text" name="nama" value="<?= old('nama', $profile['nama'] ?? '') ?>" placeholder="Nama lengkap sesuai identitas" required>
                            </div>
                            <?php if (session('errors.nama')): ?>
                                <p class="form-error"><i class="fas fa-circle-exclamation"></i> <?= session('errors.nama') ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Phone -->
                        <div class="form-field">
                            <label class="form-label">Nomor WhatsApp</label>
                            <div class="input-group">
                                <div class="input-icon">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <input type="tel" name="phone" value="<?= old('phone', $profile['phone'] ?? '') ?>" placeholder="08xxxxxxxxxx">
                            </div>
                            <?php if (session('errors.phone')): ?>
                                <p class="form-error"><i class="fas fa-circle-exclamation"></i> <?= session('errors.phone') ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if (in_array('mahasiswa', $groups)): ?>
                            <!-- Jurusan -->
                            <div class="form-field">
                                <label class="form-label">Jurusan</label>
                                <div class="input-group">
                                    <div class="input-icon">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <select name="jurusan" x-model="jurusan" @change="prodi = ''">
                                        <option value="">Pilih Jurusan</option>
                                        <?php foreach (array_keys($prodiList) as $j): ?>
                                            <option value="<?= esc($j) ?>"><?= esc($j) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php if (session('errors.jurusan')): ?>
                                    <p class="form-error"><i class="fas fa-circle-exclamation"></i> <?= session('errors.jurusan') ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Prodi -->
                            <div class="form-field">
                                <label class="form-label">Program Studi</label>
                                <div class="input-group" :class="!jurusan ? 'opacity-50' : ''">
                                    <div class="input-icon">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <select name="prodi" x-model="prodi" :disabled="!jurusan">
                                        <option value="">Pilih Program Studi</option>
                                        <!-- PHP Seed for initial display (Hybrid Pattern) -->
                                        <?php $currentJurusan = old('jurusan', $profile['jurusan'] ?? ''); ?>
                                        <?php if (!empty($currentJurusan) && isset($prodiList[$currentJurusan])): ?>
                                            <?php foreach ($prodiList[$currentJurusan] as $p): ?>
                                                <option value="<?= esc($p) ?>"><?= esc($p) ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <!-- Alpine template for dynamic changes -->
                                        <template x-for="p in prodiOptions()" :key="p">
                                            <option :value="p" x-text="p"></option>
                                        </template>
                                    </select>
                                </div>
                                <?php if (session('errors.prodi')): ?>
                                    <p class="form-error"><i class="fas fa-circle-exclamation"></i> <?= session('errors.prodi') ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Semester -->
                            <div class="form-field">
                                <label class="form-label">Semester Aktif</label>
                                <div class="input-group">
                                    <div class="input-icon">
                                        <i class="fas fa-clock-rotate-left"></i>
                                    </div>
                                    <select name="semester" x-model="semester">
                                        <option value="">Pilih Semester</option>
                                        <?php for ($i = 1; $i <= 8; $i++): ?>
                                            <option value="<?= $i ?>">Semester <?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <?php if (session('errors.semester')): ?>
                                    <p class="form-error"><i class="fas fa-circle-exclamation"></i> <?= session('errors.semester') ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <button type="reset" class="btn-ghost btn-sm">
                            Reset Form
                        </button>
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save mr-2 text-xs"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tab: Ganti Password -->
            <div x-show="activeTab === 'password'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="card-premium">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-2xl bg-accent-glow flex items-center justify-center border border-accent-light shadow-sm">
                        <i class="fas fa-fingerprint text-accent-dark text-xl"></i>
                    </div>
                    <div>
                        <h3 class="section-title text-xl">Keamanan Akun</h3>
                        <p class="section-subtitle">Kelola otentikasi dan akses</p>
                    </div>
                </div>

                <form action="<?= base_url('profile/password') ?>" method="post" class="space-y-6">
                    <?= csrf_field() ?>

                    <!-- Current Password -->
                    <div class="form-field">
                        <label class="form-label">Password Saat Ini</label>
                        <div class="input-group">
                            <div class="input-icon">
                                <i class="fas fa-lock-open"></i>
                            </div>
                            <input :type="showCurrentPass ? 'text' : 'password'" name="current_password" placeholder="Masukkan password saat ini" required>
                            <button type="button" @click="showCurrentPass = !showCurrentPass" class="text-slate-400 hover:text-primary transition-colors pr-1">
                                <i class="fas" :class="showCurrentPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div class="form-field">
                        <label class="form-label">Password Baru</label>
                        <div class="input-group">
                            <div class="input-icon">
                                <i class="fas fa-shield-halved"></i>
                            </div>
                            <input :type="showNewPass ? 'text' : 'password'" name="new_password" @input="updatePasswordStrength($event.target.value)" placeholder="Minimal 8 karakter" required>
                            <button type="button" @click="showNewPass = !showNewPass" class="text-slate-400 hover:text-primary transition-colors pr-1">
                                <i class="fas" :class="showNewPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                        
                        <!-- Password Strength Meter -->
                        <div class="mt-3 space-y-2">
                            <div class="flex gap-1.5 h-1.5">
                                <template x-for="i in 4">
                                    <div class="flex-1 rounded-full transition-all duration-500" :class="passwordStrength >= i ? passwordStrengthBg : 'bg-slate-100'"></div>
                                </template>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-bold uppercase tracking-wider" :class="passwordStrengthColor" x-text="passwordStrengthText"></p>
                                <p class="text-[10px] text-slate-400 font-medium" x-show="passwordStrength > 0" x-text="passwordStrength + '/4 Strength'"></p>
                            </div>
                        </div>
                        <?php if (session('errors.new_password')): ?>
                            <p class="form-error"><i class="fas fa-circle-exclamation"></i> <?= session('errors.new_password') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-field">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <div class="input-icon">
                                <i class="fas fa-check-double"></i>
                            </div>
                            <input :type="showConfirmPass ? 'text' : 'password'" name="confirm_password" placeholder="Ulangi password baru" required>
                            <button type="button" @click="showConfirmPass = !showConfirmPass" class="text-slate-400 hover:text-primary transition-colors pr-1">
                                <i class="fas" :class="showConfirmPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                        <?php if (session('errors.confirm_password')): ?>
                            <p class="form-error"><i class="fas fa-circle-exclamation"></i> <?= session('errors.confirm_password') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="pmw-status pmw-status-warning w-full py-3 px-4 rounded-xl border-dashed">
                        <i class="fas fa-lightbulb text-sm"></i>
                        <span class="text-xs font-semibold">Gunakan kombinasi simbol & angka untuk keamanan maksimal.</span>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                        <button type="reset" class="btn-ghost btn-sm">
                            Reset Form
                        </button>
                        <button type="submit" class="btn-accent">
                            <i class="fas fa-key-skeleton mr-2 text-xs"></i>
                            Perbarui Password
                        </button>
                    </div>
                </form>
            </div>

            <?php if (in_array('mahasiswa', $groups)): ?>
            <!-- Tab: Foto Profil -->
            <div x-show="activeTab === 'foto'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="card-premium">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-2xl bg-primary-50 flex items-center justify-center border border-primary-100 shadow-sm">
                        <i class="fas fa-camera-retro text-primary text-xl"></i>
                    </div>
                    <div>
                        <h3 class="section-title text-xl">Foto Profile</h3>
                        <p class="section-subtitle">Identifikasi visual untuk sistem administrasi</p>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row gap-8 items-start">
                    <!-- Scanner Preview Area -->
                    <div class="w-full lg:w-1/3 flex flex-col items-center">
                        <div class="relative group/scanner mb-6">
                            <!-- Scanner Line Animation -->
                            <div class="absolute inset-0 z-10 pointer-events-none overflow-hidden rounded-[2.5rem]">
                                <div class="w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-50 shadow-[0_0_15px_rgba(var(--primary-rgb),0.5)] animate-scan"></div>
                            </div>

                            <!-- Corner Brackets -->
                            <div class="absolute -top-2 -left-2 w-8 h-8 border-t-4 border-l-4 border-primary rounded-tl-xl opacity-40"></div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 border-t-4 border-r-4 border-primary rounded-tr-xl opacity-40"></div>
                            <div class="absolute -bottom-2 -left-2 w-8 h-8 border-b-4 border-l-4 border-primary rounded-bl-xl opacity-40"></div>
                            <div class="absolute -bottom-2 -right-2 w-8 h-8 border-b-4 border-r-4 border-primary rounded-br-xl opacity-40"></div>

                            <div class="w-56 h-72 rounded-[2.5rem] bg-slate-50 border-4 border-white shadow-2xl overflow-hidden relative">
                                <template x-if="fotoPreview">
                                    <img :src="fotoPreview" class="w-full h-full object-cover grayscale-[20%] group-hover/scanner:grayscale-0 transition-all duration-700">
                                </template>
                                <template x-if="!fotoPreview">
                                    <?php if (!empty($profile['foto'])): ?>
                                        <img src="<?= base_url('profile/foto/' . $user->id) ?>" class="w-full h-full object-cover grayscale-[20%] group-hover/scanner:grayscale-0 transition-all duration-700">
                                    <?php else: ?>
                                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 bg-slate-100/50">
                                            <i class="fas fa-user-astronaut text-6xl mb-4 animate-pulse"></i>
                                            <span class="text-[10px] font-bold uppercase tracking-[0.2em]">No Bio Data</span>
                                        </div>
                                    <?php endif; ?>
                                </template>
                                
                                <!-- Overlay Info -->
                                <div class="absolute bottom-0 inset-x-0 p-4 bg-gradient-to-t from-slate-900/80 to-transparent">
                                    <p class="text-[10px] text-white/70 font-mono tracking-tighter uppercase">Status: <span x-text="fotoPreview ? 'READY_TO_UPLOAD' : 'SYSTEM_VERIFIED'"></span></p>
                                    <p class="text-xs text-white font-bold tracking-wide"><?= strtoupper(esc($user->username)) ?></p>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($profile['foto'])): ?>
                            <form action="<?= base_url('profile/foto/delete') ?>" method="post">
                                <?= csrf_field() ?>
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus foto profil?')" class="text-xs font-bold text-rose-500 hover:text-rose-600 transition-colors uppercase tracking-widest flex items-center gap-2">
                                    <i class="fas fa-trash-alt text-[10px]"></i>
                                    Hapus Foto Saat Ini
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <!-- Upload Controls -->
                    <div class="flex-1 w-full space-y-6">
                        <div class="pmw-status pmw-status-info py-4 px-5 rounded-2xl">
                            <h4 class="text-sm font-bold text-primary-dark mb-1">Panduan Foto Profil</h4>
                            <ul class="text-xs text-primary/80 space-y-1 ml-4 list-disc font-medium">
                                <li>Wajah menghadap ke depan dan terlihat jelas</li>
                                <li>Latar belakang polos (disarankan putih atau biru)</li>
                                <li>Pencahayaan cukup, tidak ada bayangan menutupi wajah</li>
                                <li>Format file JPG/PNG/WebP, maksimal 2MB</li>
                            </ul>
                        </div>

                        <form action="<?= base_url('profile/upload-foto') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
                            <?= csrf_field() ?>
                            
                            <div class="form-field">
                                <label class="form-label">Pilih Berkas Foto</label>
                                <div class="relative">
                                    <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png,image/webp" @change="handleFotoChange($event)" 
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" required>
                                    <div class="input-group">
                                        <div class="input-icon">
                                            <i class="fas fa-file-arrow-up"></i>
                                        </div>
                                        <div class="flex-1 px-4 py-2.5 text-sm text-slate-500 italic">
                                            <span x-text="fotoPreview ? 'Foto terpilih...' : 'Klik untuk memilih berkas...'"></span>
                                        </div>
                                        <div class="pr-3">
                                            <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                                <button type="button" x-show="fotoPreview" @click="removeFotoPreview()" class="btn-ghost btn-sm text-rose-500">
                                    <i class="fas fa-times mr-2"></i>Batal
                                </button>
                                <div class="flex-1"></div>
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-cloud-arrow-up mr-2 text-xs"></i>
                                    Sinkronkan Identitas
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Tab: Data Tim (for Mahasiswa only) -->
            <?php if (in_array('mahasiswa', $groups) && $proposal): ?>
                <div x-show="activeTab === 'team'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="card-premium">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center border border-indigo-100 shadow-sm">
                            <i class="fas fa-users-viewfinder text-indigo-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="section-title text-xl">Manajemen Tim</h3>
                            <p class="section-subtitle">Struktur organisasi tim proposal Anda</p>
                        </div>
                    </div>

                    <form action="<?= base_url('profile/team') ?>" method="post" enctype="multipart/form-data" class="space-y-8">
                        <?= csrf_field() ?>
                        <input type="hidden" name="proposal_id" value="<?= $proposal['id'] ?>">

                        <!-- Proposal Summary Card -->
                        <div class="p-5 rounded-3xl bg-slate-50 border border-slate-200/60 relative overflow-hidden group/prop">
                            <div class="absolute top-0 right-0 p-3 opacity-10 group-hover/prop:opacity-20 transition-opacity">
                                <i class="fas fa-file-invoice text-4xl"></i>
                            </div>
                            <div class="relative z-10 flex items-start gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center shrink-0">
                                    <i class="fas fa-lightbulb text-amber-500"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Judul Proposal</span>
                                    <h4 class="text-sm font-bold text-slate-800 line-clamp-2 leading-relaxed"><?= esc($proposal['nama_usaha'] ?? 'Belum Menentukan Judul') ?></h4>
                                    <div class="flex items-center gap-3 mt-2">
                                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-lg bg-sky-100 text-sky-700 uppercase"><?= esc($proposal['kategori_wirausaha'] ?? 'DRAFT') ?></span>
                                        <span class="text-[10px] font-medium text-slate-400">ID: #<?= esc($proposal['id'] ?? '-') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Members Grid -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between px-1">
                                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest flex items-center gap-2">
                                    Daftar Anggota Tim
                                    <span class="w-5 h-5 rounded-full bg-slate-100 text-[10px] flex items-center justify-center text-slate-600" x-text="teamMembers.length"></span>
                                </h4>
                            </div>

                            <template x-for="(member, index) in teamMembers" :key="index">
                                <div class="relative group/member">
                                    <!-- Hidden Inputs for Submission -->
                                    <input type="hidden" :name="'members[' + index + '][id]'" x-model="member.id">
                                    <input type="hidden" :name="'members[' + index + '][role]'" x-model="member.role">

                                    <div class="card-premium !p-0 overflow-hidden transition-all duration-300"
                                        :class="member.editing ? 'ring-2 ring-primary border-transparent shadow-2xl' : 'hover:shadow-xl'">
                                        
                                        <!-- Header / Role Stripe -->
                                        <div class="h-1.5 w-full" :class="member.role === 'ketua' ? 'bg-primary' : 'bg-slate-200'"></div>

                                        <div class="p-5">
                                            <!-- VIEW MODE -->
                                            <div x-show="!member.editing" class="flex items-center gap-5">
                                                <div class="shrink-0 relative">
                                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 overflow-hidden border-2 border-white shadow-sm">
                                                        <template x-if="member.fotoPreview">
                                                            <img :src="member.fotoPreview" class="w-full h-full object-cover">
                                                        </template>
                                                        <template x-if="!member.fotoPreview">
                                                            <template x-if="member.foto">
                                                                <img :src="'<?= base_url('profile/member-foto') ?>/' + member.id" class="w-full h-full object-cover">
                                                            </template>
                                                            <template x-if="!member.foto">
                                                                <div class="w-full h-full flex items-center justify-center">
                                                                    <i class="fas fa-user text-xl text-slate-300"></i>
                                                                </div>
                                                            </template>
                                                        </template>
                                                    </div>
                                                    <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-lg bg-white shadow-sm border border-slate-100 flex items-center justify-center">
                                                        <i class="fas text-[10px]" :class="member.role === 'ketua' ? 'fa-crown text-amber-500' : 'fa-user-group text-slate-400'"></i>
                                                    </div>
                                                </div>

                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center gap-2 mb-0.5">
                                                        <h5 class="font-bold text-slate-800 truncate" x-text="member.nama || 'Nama Belum Diisi'"></h5>
                                                        <span x-show="member.role === 'ketua'" class="text-[9px] font-bold px-1.5 py-0.5 rounded-md bg-primary-glow text-primary uppercase tracking-tighter">Ketua</span>
                                                    </div>
                                                    <p class="text-xs text-slate-500 font-medium tracking-tight">
                                                        <span x-text="member.nim || 'NIM -'"></span> • <span x-text="member.prodi || 'Prodi -'"></span>
                                                    </p>
                                                    <div class="flex items-center gap-3 mt-2">
                                                        <div class="flex items-center gap-1 text-[10px] text-slate-400">
                                                            <i class="fas fa-envelope text-[8px]"></i>
                                                            <span x-text="member.email || '-'"></span>
                                                        </div>
                                                        <div class="flex items-center gap-1 text-[10px] text-slate-400">
                                                            <i class="fab fa-whatsapp text-[8px]"></i>
                                                            <span x-text="member.phone || '-'"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex items-center gap-1">
                                                    <button type="button" @click="member.editing = true" class="w-9 h-9 rounded-xl hover:bg-slate-100 flex items-center justify-center text-slate-400 hover:text-primary transition-all">
                                                        <i class="fas fa-pen-to-square text-sm"></i>
                                                    </button>
                                                    <template x-if="member.role !== 'ketua'">
                                                        <button type="button" @click="removeTeamMember(index)" class="w-9 h-9 rounded-xl hover:bg-rose-50 flex items-center justify-center text-slate-400 hover:text-rose-500 transition-all">
                                                            <i class="fas fa-trash-can text-sm"></i>
                                                        </button>
                                                    </template>
                                                </div>
                                            </div>

                                            <!-- EDIT MODE -->
                                            <div x-show="member.editing" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                                                <div class="flex items-center justify-between mb-6">
                                                    <h5 class="text-xs font-bold text-primary uppercase tracking-widest flex items-center gap-2">
                                                        <i class="fas fa-user-pen"></i>
                                                        Konfigurasi Anggota
                                                    </h5>
                                                    <button type="button" @click="member.editing = false" class="text-[10px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-tighter transition-colors">
                                                        Selesai <i class="fas fa-check ml-1"></i>
                                                    </button>
                                                </div>

                                                <div class="grid lg:grid-cols-4 gap-6">
                                                    <!-- Photo Upload -->
                                                    <div class="lg:col-span-1 flex flex-col items-center justify-center border-r border-slate-100 pr-6">
                                                        <div class="relative group/m-foto mb-3">
                                                            <div class="w-24 h-24 rounded-3xl bg-slate-50 overflow-hidden border-2 border-white shadow-md relative">
                                                                <template x-if="member.fotoPreview">
                                                                    <img :src="member.fotoPreview" class="w-full h-full object-cover">
                                                                </template>
                                                                <template x-if="!member.fotoPreview">
                                                                    <template x-if="member.foto">
                                                                        <img :src="'<?= base_url('profile/member-foto') ?>/' + member.id" class="w-full h-full object-cover">
                                                                    </template>
                                                                    <template x-if="!member.foto">
                                                                        <div class="w-full h-full flex items-center justify-center text-slate-200">
                                                                            <i class="fas fa-camera text-3xl"></i>
                                                                        </div>
                                                                    </template>
                                                                </template>
                                                                
                                                                <!-- Upload Overlay -->
                                                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover/m-foto:opacity-100 transition-opacity flex items-center justify-center">
                                                                    <i class="fas fa-cloud-arrow-up text-white text-xl"></i>
                                                                </div>
                                                                <input type="file" :name="'member_foto_' + index" accept="image/*" @change="handleMemberFotoChange(index, $event)" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                                                            </div>
                                                            <button x-show="member.fotoPreview" type="button" @click="removeMemberFotoPreview(index)" class="absolute -top-1 -right-1 w-6 h-6 rounded-full bg-rose-500 text-white flex items-center justify-center shadow-lg hover:bg-rose-600 transition-colors z-20">
                                                                <i class="fas fa-times text-[10px]"></i>
                                                            </button>
                                                        </div>
                                                        <p class="text-[10px] text-slate-400 font-medium text-center leading-tight">Klik frame untuk<br>unggah foto</p>
                                                    </div>

                                                    <!-- Form Fields -->
                                                    <div class="lg:col-span-3 space-y-4">
                                                        <div class="grid md:grid-cols-2 gap-4">
                                                            <div class="form-field">
                                                                <label class="form-label !text-[10px]">Nama Lengkap</label>
                                                                <div class="input-group">
                                                                    <div class="input-icon !w-8">
                                                                        <i class="fas fa-user text-[10px]"></i>
                                                                    </div>
                                                                    <input type="text" :name="'members[' + index + '][nama]'" x-model="member.nama" placeholder="Sesuai KTM" class="!py-1.5 !text-xs">
                                                                </div>
                                                            </div>
                                                            <div class="form-field">
                                                                <label class="form-label !text-[10px]">NIM</label>
                                                                <div class="input-group">
                                                                    <div class="input-icon !w-8">
                                                                        <i class="fas fa-id-badge text-[10px]"></i>
                                                                    </div>
                                                                    <input type="text" :name="'members[' + index + '][nim]'" x-model="member.nim" placeholder="Nomor Induk Mahasiswa" class="!py-1.5 !text-xs">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="grid md:grid-cols-2 gap-4">
                                                            <div class="form-field">
                                                                <label class="form-label !text-[10px]">Jurusan</label>
                                                                <div class="input-group">
                                                                    <div class="input-icon !w-8">
                                                                        <i class="fas fa-building text-[10px]"></i>
                                                                    </div>
                                                                    <select :name="'members[' + index + '][jurusan]'" x-model="member.jurusan" @change="member.prodi = ''" class="!py-1.5 !text-xs">
                                                                        <option value="">Pilih Jurusan</option>
                                                                        <template x-for="j in jurusanList()" :key="j">
                                                                            <option :value="j" x-text="j"></option>
                                                                        </template>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-field">
                                                                <label class="form-label !text-[10px]">Program Studi</label>
                                                                <div class="input-group">
                                                                    <div class="input-icon !w-8">
                                                                        <i class="fas fa-graduation-cap text-[10px]"></i>
                                                                    </div>
                                                                    <select :name="'members[' + index + '][prodi]'" x-model="member.prodi" x-init="$nextTick(() => { if (member.prodi) member.prodi = member.prodi })" class="!py-1.5 !text-xs">
                                                                        <option value="">Pilih Prodi</option>
                                                                        <template x-for="p in getMemberProdiOptions(member.jurusan)" :key="p">
                                                                            <option :value="p" x-text="p"></option>
                                                                        </template>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="grid md:grid-cols-3 gap-4">
                                                            <div class="form-field">
                                                                <label class="form-label !text-[10px]">Email</label>
                                                                <div class="input-group">
                                                                    <div class="input-icon !w-8">
                                                                        <i class="fas fa-envelope text-[10px]"></i>
                                                                    </div>
                                                                    <input type="email" :name="'members[' + index + '][email]'" x-model="member.email" placeholder="Email aktif" class="!py-1.5 !text-xs">
                                                                </div>
                                                            </div>
                                                            <div class="form-field">
                                                                <label class="form-label !text-[10px]">No. WhatsApp</label>
                                                                <div class="input-group">
                                                                    <div class="input-icon !w-8">
                                                                        <i class="fab fa-whatsapp text-[10px]"></i>
                                                                    </div>
                                                                    <input type="tel" :name="'members[' + index + '][phone]'" x-model="member.phone" placeholder="08xxxxxxxxxx" class="!py-1.5 !text-xs">
                                                                </div>
                                                            </div>
                                                            <div class="form-field">
                                                                <label class="form-label !text-[10px]">Semester</label>
                                                                <div class="input-group">
                                                                    <div class="input-icon !w-8">
                                                                        <i class="fas fa-clock text-[10px]"></i>
                                                                    </div>
                                                                    <select :name="'members[' + index + '][semester]'" x-model="member.semester" class="!py-1.5 !text-xs">
                                                                        <option value="">Semester</option>
                                                                        <template x-for="s in [1,2,3,4,5,6,7,8]" :key="s">
                                                                            <option :value="s" x-text="s"></option>
                                                                        </template>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Add Member Button -->
                        <div class="relative">
                            <button type="button" @click="addTeamMember()" 
                                class="w-full py-6 border-2 border-dashed border-slate-200 rounded-[2rem] text-slate-400 hover:border-primary hover:text-primary hover:bg-primary-glow transition-all group overflow-hidden">
                                <div class="relative z-10 flex flex-col items-center gap-2">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 group-hover:bg-primary text-slate-400 group-hover:text-white flex items-center justify-center transition-all duration-500 scale-90 group-hover:scale-100 shadow-sm group-hover:shadow-lg group-hover:rotate-6">
                                        <i class="fas fa-plus text-xl"></i>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-sm font-bold uppercase tracking-[0.1em]">Tambah Rekan Tim</p>
                                        <p class="text-[10px] font-medium opacity-60">Klik untuk menambahkan data anggota baru</p>
                                    </div>
                                </div>
                            </button>
                        </div>

                        <div class="pmw-status pmw-status-warning py-4 px-5 rounded-2xl flex items-start gap-3">
                            <div class="w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-circle-exclamation text-amber-600 text-sm"></i>
                            </div>
                            <div>
                                <h5 class="text-xs font-bold text-amber-800 uppercase tracking-tight mb-0.5">Aturan Pembentukan Tim</h5>
                                <p class="text-[11px] text-amber-700/80 leading-relaxed font-medium">Maksimal anggota tim adalah 5 orang (1 Ketua + 4 Anggota). Pastikan seluruh data valid sesuai dengan data di sistem akademik untuk kelancaran verifikasi proposal.</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                            <button type="reset" class="btn-ghost btn-sm">
                                Reset Semua
                            </button>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-cloud-check mr-2 text-xs"></i>
                                Simpan Perubahan Tim
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
