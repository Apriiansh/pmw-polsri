<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="min-h-[80vh] flex flex-col items-center justify-center p-4 animate-stagger">
    
    <!-- Illustration / Icon -->
    <div class="relative mb-10">
        <div class="w-32 h-32 rounded-[2.5rem] bg-slate-50 flex items-center justify-center border-4 border-white shadow-xl relative z-10 animate-float">
            <i class="fas fa-lock text-5xl text-slate-300"></i>
        </div>
        <div class="absolute -top-4 -right-4 w-12 h-12 rounded-2xl bg-rose-500 text-white flex items-center justify-center shadow-lg shadow-rose-500/30 z-20 animate-pulse">
            <i class="fas fa-shield-alt text-xl"></i>
        </div>
        <!-- Decorative Glow -->
        <div class="absolute inset-0 bg-slate-400/10 blur-3xl rounded-full transform scale-150"></div>
    </div>

    <!-- Message -->
    <div class="text-center max-w-lg space-y-4">
        <h2 class="font-display text-2xl sm:text-3xl font-black text-(--text-heading) leading-tight">
            Akses <span class="text-gradient">Belum Tersedia</span>
        </h2>
        <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
            Mohon maaf, Anda belum dapat mengakses modul Expo & Awarding. Tahap ini hanya tersedia bagi tim yang telah <strong>Lolos Seleksi Tahap II (Finalisasi Dana)</strong>.
        </p>
    </div>

    <!-- Status Tracker -->
    <div class="mt-12 w-full max-w-md card-premium p-6 space-y-6 bg-white/60 backdrop-blur-md">
        <div class="flex items-center justify-between px-2">
            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Prasyarat Akses</h4>
            <span class="text-[10px] font-black text-rose-500 uppercase tracking-widest bg-rose-50 px-2 py-0.5 rounded">Belum Terpenuhi</span>
        </div>

        <div class="space-y-4">
            <!-- Step 1 (Done) -->
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs shadow-lg shadow-emerald-500/20">
                    <i class="fas fa-check"></i>
                </div>
                <div class="flex-1">
                    <p class="text-[11px] font-bold text-slate-700 leading-none">Implementasi Usaha</p>
                    <p class="text-[10px] text-slate-400 mt-1">Laporan kemajuan & monitoring selesai.</p>
                </div>
            </div>

            <!-- Connector -->
            <div class="ml-4 w-0.5 h-6 bg-slate-100"></div>

            <!-- Step 2 (Pending) -->
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-xs border-2 border-slate-50">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="flex-1">
                    <p class="text-[11px] font-bold text-slate-400 leading-none">Finalisasi Seleksi Dana II</p>
                    <p class="text-[10px] text-slate-400 mt-1">Menunggu verifikasi admin untuk kelolosan dana.</p>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-50">
            <a href="<?= base_url('dashboard') ?>" class="btn-primary w-full py-3 text-xs shadow-xl shadow-sky-500/10">
                <i class="fas fa-home mr-2"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Support Link -->
    <p class="mt-8 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
        Butuh bantuan? <a href="#" class="text-sky-500 hover:underline">Hubungi Admin UPAPKK</a>
    </p>

</div>

<?= $this->endSection() ?>
