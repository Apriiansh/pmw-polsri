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

            init() {
                this.generateUsername();
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

                <?php if (session('error')): ?>
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-700 text-sm">
                        <i class="fas fa-exclamation-circle mr-2"></i><?= session('error') ?>
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

                    <div class="grid md:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                            <div class="relative">
                                <input :type="showPass ? 'text' : 'password'" type="password" name="password"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-sm sm:text-base"
                                    placeholder="Minimal 8 karakter" required>
                                <button type="button" @click="showPass = !showPass" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-sky-500 transition-colors w-9 h-9 flex items-center justify-center rounded-lg hover:bg-slate-100">
                                    <i class="fas" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                            <?php if (isset(session('errors')['password'])): ?>
                                <p class="mt-1 text-xs text-rose-500"><?= session('errors')['password'] ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Password Confirm -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password</label>
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
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Foto Profil (Opsional)</label>
                        <input type="file" name="foto"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 outline-none transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                        <p class="mt-2 text-[11px] text-slate-400 italic">Format: JPG, JPEG, PNG. Maks: 2MB.</p>
                        <?php if (isset(session('errors')['foto'])): ?>
                            <p class="mt-1 text-xs text-rose-500"><?= session('errors')['foto'] ?></p>
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