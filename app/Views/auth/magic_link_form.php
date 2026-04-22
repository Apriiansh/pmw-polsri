<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<section class="min-h-screen bg-linear-to-br from-sky-50 via-white to-yellow-50 py-8 sm:py-12 px-4 flex items-center justify-center">
    <div class="w-full max-w-[420px]">
        
        <!-- Logo -->
        <div class="text-center mb-6 sm:mb-8">
            <a href="<?= base_url() ?>" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-linear-to-br from-sky-500 to-sky-400 flex items-center justify-center shadow-lg shadow-sky-200 group-hover:shadow-xl transition-all">
                    <img src="<?= base_url('favicon.png') ?>" alt="PMW Polsri" class="w-11 h-11 sm:w-10 sm:h-10 object-contain">
                </div>
                <div class="text-left">
                    <h1 class="font-display text-xl sm:text-2xl font-bold text-slate-800">PMW <span class="text-sky-500">Polsri</span></h1>
                    <p class="text-[10px] sm:text-xs text-slate-500 uppercase tracking-wider">Program Mahasiswa Wirausaha</p>
                </div>
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-sky-100/50 border border-sky-100 overflow-hidden reveal-zoom">
            <div class="p-6 sm:p-8">
                <h2 class="font-display text-xl sm:text-2xl font-bold text-slate-800 text-center mb-2">Lupa Password?</h2>
                <p class="text-slate-500 text-center mb-6 sm:mb-8 text-sm sm:text-base">Jangan khawatir! Masukkan email Anda dan kami akan mengirimkan link login ajaib.</p>

                <?php if (session('error')) : ?>
                    <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-100 text-rose-600 text-sm flex items-center gap-3">
                        <i class="fas fa-exclamation-circle text-lg"></i>
                        <p><?= session('error') ?></p>
                    </div>
                <?php endif ?>

                <?php if (session('message')) : ?>
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 text-sm flex items-center gap-3">
                        <i class="fas fa-check-circle text-lg"></i>
                        <p><?= session('message') ?></p>
                    </div>
                <?php endif ?>

                <form action="<?= url_to('magic-link') ?>" method="post" class="space-y-5">
                    <?= csrf_field() ?>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input type="email" name="email" value="<?= old('email', auth()->user()->email ?? '') ?>" 
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-sm sm:text-base"
                                placeholder="email@student.polsri.ac.id" required autofocus>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-primary w-full py-3.5 sm:py-4 text-base sm:text-lg">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Link Login
                    </button>
                </form>

                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-slate-500">Kembali ke</span>
                    </div>
                </div>

                <p class="text-center text-slate-500 text-sm">
                    Ingat password Anda? 
                    <a href="<?= base_url('login') ?>" class="text-sky-600 hover:text-sky-700 font-medium">Masuk kembali</a>
                </p>
            </div>
        </div>

        <!-- Back link -->
        <p class="text-center mt-6 sm:mt-8 text-slate-500 text-sm">
            <a href="<?= base_url() ?>" class="hover:text-sky-600 transition-colors inline-flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Beranda
            </a>
        </p>
    </div>
</section>

<?= $this->endSection() ?>
