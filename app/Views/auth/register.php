<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<?php helper('pmw'); ?>
<?php $prodiList = $prodiList ?? getProdiList(); ?>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('registerForm', () => ({
            showPass: false,
            showConfirm: false,
            nama: '<?= old('nama') ?? '' ?>',
            nim: '<?= old('nim') ?? '' ?>',
            username: '',
            jurusan: '<?= old('jurusan') ?? '' ?>',
            prodi: '<?= old('prodi') ?? '' ?>',
            prodiList: <?= json_encode($prodiList) ?>,
            passwordValue: '',
            passwordStrength: 0,
            passwordStrengthText: '',
            passwordStrengthColor: 'text-slate-400',
            fotoPreview: null,
            fotoName: '',

            init() {
                this.generateUsername();
                // Restore prodi if jurusan is set (from old value)
                const oldJurusan = '<?= old('jurusan') ?? '' ?>';
                const oldProdi = '<?= old('prodi') ?? '' ?>';
                if (oldJurusan) {
                    this.jurusan = oldJurusan;
                    this.$nextTick(() => {
                        this.prodi = oldProdi;
                    });
                }
            },

            generateUsername() {
                const nama = (this.nama || '').trim().toLowerCase();
                const nim = (this.nim || '').toString().trim();
                const parts = nama.split(/\s+/).filter(Boolean).map(p => p.replace(/[^a-z]/g, ''));
                const middle = (parts.length >= 2 ? parts[1] : (parts.length ? parts[parts.length - 1] : ''));
                const last4 = nim.slice(-4);
                this.username = (middle + last4).replace(/[^a-z0-9]/g, '');
            },

            jurusanList() {
                return Object.keys(this.prodiList);
            },

            prodiOptions() {
                return this.prodiList[this.jurusan] || [];
            },

            generatePassword() {
                const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                const specialChars = '!@#$%^&*';
                let password = '';
                
                // Ensure at least one of each type
                password += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'[Math.floor(Math.random() * 26)];
                password += 'abcdefghijklmnopqrstuvwxyz'[Math.floor(Math.random() * 26)];
                password += '0123456789'[Math.floor(Math.random() * 10)];
                password += specialChars[Math.floor(Math.random() * specialChars.length)];
                
                // Fill remaining with random chars (total 12 chars)
                const allChars = chars + specialChars;
                for (let i = 4; i < 12; i++) {
                    password += allChars[Math.floor(Math.random() * allChars.length)];
                }
                
                // Shuffle password
                password = password.split('').sort(() => 0.5 - Math.random()).join('');
                this.passwordValue = password;
                this.updatePasswordStrength(password);
            },

            updatePasswordStrength(password) {
                let strength = 0;
                if (password.length >= 8) strength++;
                if (password.length >= 12) strength++;
                if (/[A-Z]/.test(password) && /[a-z]/.test(password)) strength++;
                if (/[0-9]/.test(password) && /[^A-Za-z0-9]/.test(password)) strength++;
                
                this.passwordStrength = strength;
                
                const labels = ['Sangat Lemah', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];
                const colors = ['text-red-500', 'text-orange-400', 'text-yellow-500', 'text-blue-500', 'text-emerald-500'];
                
                this.passwordStrengthText = password.length > 0 ? (labels[strength - 1] || '') : '';
                this.passwordStrengthColor = colors[strength - 1] || 'text-slate-400';
            },

            copyPassword() {
                navigator.clipboard.writeText(this.passwordValue).then(() => {
                    this.showToast('Password disalin ke clipboard!', 'success');
                });
            },

            handleFotoChange(event) {
                const file = event.target.files[0];
                if (file) {
                    this.fotoName = file.name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.fotoPreview = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },

            removeFoto() {
                this.fotoPreview = null;
                this.fotoName = '';
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
            }
        }));
    });
</script>

<section class="min-h-screen bg-linear-to-br from-sky-50 via-white to-yellow-50 py-8 sm:py-12 px-4 flex items-center justify-center pt-20 sm:pt-24"
    x-data="registerForm">
    <div class="w-full max-w-2xl">

        <!-- Logo -->
        <div class="text-center mb-6 sm:mb-8">
            <a href="<?= base_url() ?>" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-linear-to-br from-sky-500 to-sky-400 flex items-center justify-center shadow-lg shadow-sky-200 group-hover:shadow-xl transition-all">
                    <i class="fas fa-graduation-cap text-white text-xl sm:text-2xl"></i>
                </div>
                <div class="text-left">
                    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800">PMW <span class="text-sky-500">Polsri</span></h1>
                    <p class="text-[10px] sm:text-xs text-slate-500 uppercase tracking-wider">Program Mahasiswa Wirausaha</p>
                </div>
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl shadow-sky-100/50 border border-sky-100 overflow-hidden">
            <div class="p-5 sm:p-8 md:p-12">
                <div class="mb-6 sm:mb-10 text-center">
                    <h2 class="font-display text-2xl sm:text-3xl font-bold text-slate-800 mb-2">Pendaftaran Akun</h2>
                    <p class="text-slate-500 text-sm sm:text-base">Lengkapi data ketua tim untuk memulai pengusulan PMW</p>
                </div>

                <!-- Flash Messages -->
                <?php if (session('error')): ?>
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-700 text-sm flex items-start gap-3 animate-fade-in">
                        <i class="fas fa-exclamation-circle mt-0.5"></i>
                        <div><?= session('error') ?></div>
                    </div>
                <?php endif; ?>
                
                <?php if (session('success')): ?>
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm flex items-start gap-3 animate-fade-in">
                        <i class="fas fa-check-circle mt-0.5"></i>
                        <div><?= session('success') ?></div>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('register') ?>" method="post" enctype="multipart/form-data" class="space-y-5 sm:space-y-6">
                    <?= csrf_field() ?>

                    <input type="hidden" name="username" :value="username">

                    <!-- Nama Lengkap -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap Ketua</label>
                        <input type="text" name="nama" value="<?= old('nama') ?>" x-model="nama" @input="generateUsername()"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-sm sm:text-base"
                            placeholder="Contoh: Nama Lengkap Tanpa Gelar" required>
                        <?php if (isset(session('errors')['nama'])): ?>
                            <p class="mt-1 text-xs text-rose-500"><?= session('errors')['nama'] ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 sm:gap-6">
                        <!-- NIM -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">NIM</label>
                            <input type="text" name="nim" value="<?= old('nim') ?>" x-model="nim" @input="generateUsername()"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-sm sm:text-base"
                                placeholder="Contoh: 062230700000" required>
                            <?php if (isset(session('errors')['nim'])): ?>
                                <p class="mt-1 text-xs text-rose-500"><?= session('errors')['nim'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Email Institusi / Pribadi</label>
                            <input type="email" name="email" value="<?= old('email') ?>"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-sm sm:text-base"
                                placeholder="email@student.polsri.ac.id" required>
                            <?php if (isset(session('errors')['email'])): ?>
                                <p class="mt-1 text-xs text-rose-500"><?= session('errors')['email'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Password Section -->
                    <div class="bg-slate-50 rounded-xl p-4 sm:p-5 border border-slate-100">
                        <div class="flex items-center justify-between mb-4">
                            <label class="block text-sm font-medium text-slate-700">Password Akun</label>
                            <button type="button" @click="generatePassword()" 
                                class="text-xs bg-sky-100 hover:bg-sky-200 text-sky-700 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1.5">
                                <i class="fas fa-magic"></i> Generate Otomatis
                            </button>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            <!-- Password -->
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1.5">Password</label>
                                <div class="relative">
                                    <input :type="showPass ? 'text' : 'password'" name="password" x-model="passwordValue" @input="updatePasswordStrength(passwordValue)"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-sm sm:text-base pr-20"
                                        placeholder="Minimal 8 karakter" required>
                                    <div class="absolute right-1 top-1/2 -translate-y-1/2 flex">
                                        <button type="button" @click="showPass = !showPass" class="text-slate-400 hover:text-sky-500 transition-colors w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-100">
                                            <i class="fas text-sm" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                                        </button>
                                        <button type="button" x-show="passwordValue" x-cloak @click="copyPassword()" class="text-slate-400 hover:text-emerald-500 transition-colors w-8 h-8 flex items-center justify-center rounded-lg hover:bg-emerald-50" title="Copy password">
                                            <i class="fas fa-copy text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Password Strength Meter -->
                                <div x-show="passwordValue" x-cloak class="mt-2 space-y-1">
                                    <div class="flex gap-1 h-1">
                                        <div class="flex-1 rounded-full transition-colors duration-300" :class="passwordStrength >= 1 ? 'bg-red-400' : 'bg-slate-200'"></div>
                                        <div class="flex-1 rounded-full transition-colors duration-300" :class="passwordStrength >= 2 ? 'bg-orange-400' : 'bg-slate-200'"></div>
                                        <div class="flex-1 rounded-full transition-colors duration-300" :class="passwordStrength >= 3 ? 'bg-yellow-400' : 'bg-slate-200'"></div>
                                        <div class="flex-1 rounded-full transition-colors duration-300" :class="passwordStrength >= 4 ? 'bg-emerald-400' : 'bg-slate-200'"></div>
                                    </div>
                                    <p class="text-xs" :class="passwordStrengthColor" x-text="passwordStrengthText"></p>
                                </div>
                                
                                <?php if (isset(session('errors')['password'])): ?>
                                    <p class="mt-1 text-xs text-rose-500"><?= session('errors')['password'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- Password Confirm -->
                            <div>
                                <label class="block text-xs font-medium text-slate-500 mb-1.5">Konfirmasi Password</label>
                                <div class="relative">
                                    <input :type="showConfirm ? 'text' : 'password'" type="password" name="password_confirm"
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-sm sm:text-base"
                                        placeholder="Ulangi password" required>
                                    <button type="button" @click="showConfirm = !showConfirm" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-sky-500 transition-colors w-9 h-9 flex items-center justify-center rounded-lg hover:bg-slate-100">
                                        <i class="fas" :class="showConfirm ? 'fa-eye-slash' : 'fa-eye'"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Jurusan -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Jurusan</label>
                            <select name="jurusan" x-model="jurusan" @change="prodi = ''"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all bg-white text-sm sm:text-base" required>
                                <option value="">Pilih Jurusan</option>
                                <template x-for="j in jurusanList()" :key="j">
                                    <option :value="j" x-text="j"></option>
                                </template>
                            </select>
                            <?php if (isset(session('errors')['jurusan'])): ?>
                                <p class="mt-1 text-xs text-rose-500"><?= session('errors')['jurusan'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Prodi -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Program Studi</label>
                            <select name="prodi" x-model="prodi"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all bg-white disabled:bg-slate-50 disabled:text-slate-400 text-sm sm:text-base"
                                :disabled="!jurusan" required>
                                <option value="">Pilih Program Studi</option>
                                <template x-for="p in prodiOptions()" :key="p">
                                    <option :value="p" x-text="p"></option>
                                </template>
                            </select>
                            <?php if (isset(session('errors')['prodi'])): ?>
                                <p class="mt-1 text-xs text-rose-500"><?= session('errors')['prodi'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Gender & Semester -->
                    <div class="grid md:grid-cols-2 gap-4 sm:gap-5">
                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Kelamin</label>
                            <div class="flex gap-4">
                                <label class="flex-1">
                                    <input type="radio" name="gender" value="L" class="peer sr-only" <?= old('gender', 'L') == 'L' ? 'checked' : '' ?> required>
                                    <div class="px-4 py-3 rounded-xl border border-slate-200 text-center cursor-pointer hover:bg-slate-50 peer-checked:border-sky-500 peer-checked:bg-sky-50 peer-checked:text-sky-600 transition-all text-sm font-medium">
                                        Laki-laki
                                    </div>
                                </label>
                                <label class="flex-1">
                                    <input type="radio" name="gender" value="P" class="peer sr-only" <?= old('gender') == 'P' ? 'checked' : '' ?>>
                                    <div class="px-4 py-3 rounded-xl border border-slate-200 text-center cursor-pointer hover:bg-slate-50 peer-checked:border-sky-500 peer-checked:bg-sky-50 peer-checked:text-sky-600 transition-all text-sm font-medium">
                                        Perempuan
                                    </div>
                                </label>
                            </div>
                            <?php if (isset(session('errors')['gender'])): ?>
                                <p class="mt-1 text-xs text-rose-500"><?= session('errors')['gender'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Semester -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Semester Saat Ini</label>
                            <select name="semester"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all bg-white text-sm sm:text-base" required>
                                <option value="">Pilih Semester</option>
                                <?php for ($i = 1; $i <= 8; $i++): ?>
                                    <option value="<?= $i ?>" <?= old('semester') == $i ? 'selected' : '' ?>>Semester <?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                            <?php if (isset(session('errors')['semester'])): ?>
                                <p class="mt-1 text-xs text-rose-500"><?= session('errors')['semester'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- No. HP -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">No. HP / WhatsApp</label>
                        <input type="tel" name="phone" value="<?= old('phone') ?>"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-sm sm:text-base"
                            placeholder="Contoh: 081234567890" required>
                        <p class="mt-1.5 text-[11px] text-slate-400 italic">Pastikan nomor aktif untuk koordinasi via WhatsApp.</p>
                        <?php if (isset(session('errors')['phone'])): ?>
                            <p class="mt-1 text-xs text-rose-500"><?= session('errors')['phone'] ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Foto Profile -->
                    <div class="bg-slate-50 rounded-xl p-4 sm:p-5 border border-slate-100">
                        <label class="block text-sm font-medium text-slate-700 mb-3">Foto Profil (Opsional)</label>
                        
                        <!-- Foto Preview -->
                        <div x-show="fotoPreview" x-cloak class="mb-4 flex items-center gap-4">
                            <div class="relative">
                                <img :src="fotoPreview" class="w-20 h-20 rounded-xl object-cover border-2 border-sky-200 shadow-sm">
                                <button type="button" @click="removeFoto()" class="absolute -top-2 -right-2 w-6 h-6 bg-rose-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-rose-600 transition-colors shadow-sm">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-700 truncate" x-text="fotoName"></p>
                                <p class="text-xs text-slate-500">Foto siap diupload</p>
                            </div>
                        </div>
                        
                        <!-- File Input -->
                        <div x-show="!fotoPreview" x-cloak>
                            <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png" @change="handleFotoChange($event)"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 outline-none transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 text-sm">
                        </div>
                        
                        <!-- Re-upload button when preview exists -->
                        <div x-show="fotoPreview" x-cloak class="mt-2">
                            <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png" @change="handleFotoChange($event)" id="foto-reupload"
                                class="hidden">
                            <button type="button" onclick="document.getElementById('foto-reupload').click()" 
                                class="text-sm text-sky-600 hover:text-sky-700 font-medium flex items-center gap-1.5">
                                <i class="fas fa-sync-alt"></i> Ganti foto
                            </button>
                        </div>
                        
                        <div class="mt-2 flex items-start gap-2">
                            <i class="fas fa-shield-alt text-emerald-500 text-xs mt-0.5"></i>
                            <div>
                                <p class="text-[11px] text-slate-500">Format: JPG, JPEG, PNG. Maks: 2MB.</p>
                                <p class="text-[11px] text-emerald-600 font-medium">File dienkripsi & dipindai untuk keamanan</p>
                            </div>
                        </div>
                        <?php if (isset(session('errors')['foto'])): ?>
                            <p class="mt-2 text-xs text-rose-500 flex items-center gap-1">
                                <i class="fas fa-exclamation-triangle"></i><?= session('errors')['foto'] ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Submit -->
                    <div class="pt-4 sm:pt-6">
                        <button type="submit" class="btn-primary w-full py-3.5 sm:py-4 text-base sm:text-lg">
                            Daftar Sekarang
                        </button>
                    </div>

                    <p class="text-center text-slate-500">
                        Sudah punya akun?
                        <a href="<?= base_url('login') ?>" class="text-sky-600 hover:text-sky-700 font-semibold underline decoration-sky-200 underline-offset-4">Masuk di sini</a>
                    </p>
                </form>
            </div>
        </div>

        <!-- Back link -->
        <p class="text-center mt-6 sm:mt-8 text-slate-500 text-sm">
            <a href="<?= base_url() ?>" class="hover:text-sky-600 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
            </a>
        </p>
    </div>
</section>

<?= $this->endSection() ?>