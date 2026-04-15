<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<section class="min-h-screen bg-linear-to-br from-sky-50 via-white to-yellow-50 py-8 sm:py-12 px-4 flex items-center justify-center" x-data="{ showPass: false }">
    <div class="w-full max-w-[420px]">
        
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
        <div class="bg-white rounded-2xl shadow-xl shadow-sky-100/50 border border-sky-100 overflow-hidden">
            <div class="p-6 sm:p-8">
                <h2 class="font-display text-xl sm:text-2xl font-bold text-slate-800 text-center mb-2">Selamat Datang</h2>
                <p class="text-slate-500 text-center mb-6 sm:mb-8 text-sm sm:text-base">Masuk ke akun PMW Polsri Anda</p>

                <form action="<?= base_url('login') ?>" method="post" class="space-y-5">
                    <?= csrf_field() ?>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="email" name="email" value="<?= old('email') ?>" 
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-sm sm:text-base"
                                placeholder="email@student.polsri.ac.id" required autofocus>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input :type="showPass ? 'text' : 'password'" type="password" name="password" 
                                class="w-full pl-11 pr-12 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-sm sm:text-base"
                                placeholder="Masukkan password" required>
                            <button type="button" @click="showPass = !showPass" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-sky-500 transition-colors w-9 h-9 flex items-center justify-center rounded-lg hover:bg-slate-100">
                                <i class="fas" :class="showPass ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 sm:gap-0">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-sky-500 focus:ring-sky-400">
                            <span class="text-sm text-slate-600">Ingat saya</span>
                        </label>
                        <a href="<?= base_url('forgot') ?>" class="text-sm text-sky-600 hover:text-sky-700 font-medium">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-primary w-full py-3.5 sm:py-4 text-base sm:text-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                    </button>
                </form>

                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-slate-500">atau</span>
                    </div>
                </div>

                <p class="text-center text-slate-500 text-sm">
                    Belum punya akun? 
                    <a href="<?= base_url('register') ?>" class="text-sky-600 hover:text-sky-700 font-medium">Daftar sekarang</a>
                </p>
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
