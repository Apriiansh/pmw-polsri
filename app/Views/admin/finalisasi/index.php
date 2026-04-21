<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6" x-data="{ 
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        card.style.setProperty('--mouse-x', `${x}px`);
        card.style.setProperty('--mouse-y', `${y}px`);
    }
}">
    <!-- Header Page -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight"><?= esc($header_title) ?></h1>
            <p class="text-slate-500 text-sm"><?= esc($header_subtitle) ?></p>
        </div>
        
        <div class="w-full lg:w-auto">
            <form action="" method="get" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <!-- Period Filter -->
                <div class="w-full sm:w-48">
                    <select name="period" class="form-select w-full h-10 py-0 px-3 rounded-xl border-sky-100 font-semibold text-sm cursor-pointer focus:ring-sky-500 focus:border-sky-500">
                        <option value="">Semua Periode</option>
                        <?php foreach ($periods as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= $periodFilter == $p['id'] ? 'selected' : '' ?>>
                                <?= esc($p['name']) ?> (<?= esc($p['year']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Search Input -->
                <div class="relative w-full sm:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-slate-400 text-xs"></i>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        value="<?= esc($search) ?>" 
                        placeholder="Cari Tim/Ketua..."
                        class="block w-full h-10 pl-10 pr-3 py-2 border border-sky-100 rounded-xl text-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all font-medium"
                    >
                </div>

                <button type="submit" class="btn-primary h-10 px-4 sm:px-0 sm:w-10 flex items-center justify-center rounded-xl shrink-0">
                    <i class="fas fa-filter sm:text-sm"></i>
                    <span class="sm:hidden ml-2 font-bold text-sm uppercase tracking-wider">Filter Data</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="card-premium p-4" @mousemove="handleMouseMove">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Total Tim Dana I</p>
            <p class="text-2xl font-black text-slate-800"><?= count($teams) ?></p>
        </div>
        <?php 
            $finalizedCount = count(array_filter($teams, fn($t) => !empty($t['final_status'])));
            $approvedCount = count(array_filter($teams, fn($t) => $t['final_status'] === 'approved'));
        ?>
        <div class="card-premium p-4" @mousemove="handleMouseMove">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Telah Diproses</p>
            <p class="text-2xl font-black text-amber-600"><?= $finalizedCount ?></p>
        </div>
        <div class="card-premium p-4" @mousemove="handleMouseMove">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Lolos Dana II</p>
            <p class="text-2xl font-black text-emerald-600"><?= $approvedCount ?></p>
        </div>
        <div class="card-premium p-4" @mousemove="handleMouseMove">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Menunggu Audit</p>
            <p class="text-2xl font-black text-sky-600"><?= count($teams) - $finalizedCount ?></p>
        </div>
    </div>

    <!-- Teams Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <?php foreach ($teams as $team): ?>
            <div class="card-premium group hover:border-sky-200 transition-all duration-300" @mousemove="handleMouseMove">
                <div class="p-5">
                    <!-- Header Tim -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-linear-to-br from-sky-500 to-indigo-500 text-white flex items-center justify-center font-bold text-xl shadow-lg shadow-sky-100">
                                <?= substr(esc($team['nama_usaha']), 0, 1) ?>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 group-hover:text-sky-600 transition-colors line-clamp-1"><?= esc($team['nama_usaha']) ?></h3>
                                <p class="text-xs text-slate-500 flex items-center gap-1">
                                    <i class="fas fa-user-circle text-sky-400"></i>
                                    <?= esc($team['ketua_nama']) ?> (<?= esc($team['ketua_nim']) ?>)
                                </p>
                            </div>
                        </div>
                        <?php if ($team['final_status'] === 'approved'): ?>
                            <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase">LOLOS DANA II</span>
                        <?php elseif ($team['final_status'] === 'rejected'): ?>
                            <span class="px-3 py-1 rounded-full bg-rose-100 text-rose-700 text-[10px] font-black uppercase">TIDAK LOLOS</span>
                        <?php else: ?>
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-[10px] font-black uppercase">MENUNGGU AUDIT</span>
                        <?php endif; ?>
                    </div>

                    <!-- Stats Row -->
                    <div class="grid grid-cols-3 gap-3 mb-4">
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-center">
                            <p class="text-[9px] text-slate-400 font-bold uppercase mb-1">Bimbingan</p>
                            <p class="text-sm font-black text-slate-700"><?= $team['total_bimbingan'] ?></p>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-center">
                            <p class="text-[9px] text-slate-400 font-bold uppercase mb-1">Mentoring</p>
                            <p class="text-sm font-black text-slate-700"><?= $team['total_mentoring'] ?></p>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-center">
                            <p class="text-[9px] text-slate-400 font-bold uppercase mb-1">Kegiatan</p>
                            <p class="text-sm font-black text-slate-700"><?= $team['total_kegiatan'] ?></p>
                        </div>
                    </div>

                    <!-- Milestone Checklist -->
                    <div class="flex items-center gap-4 mb-5 p-3 rounded-xl bg-sky-50/50 border border-sky-100">
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 rounded-full <?= $team['kemajuan_status'] === 'approved' ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400' ?> flex items-center justify-center text-[10px]">
                                <i class="fas fa-check"></i>
                            </div>
                            <span class="text-[11px] font-bold <?= $team['kemajuan_status'] === 'approved' ? 'text-emerald-600' : 'text-slate-400' ?>">Lap. Kemajuan</span>
                        </div>
                        <div class="w-px h-4 bg-sky-200"></div>
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 rounded-full <?= $team['akhir_status'] === 'approved' ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400' ?> flex items-center justify-center text-[10px]">
                                <i class="fas fa-check"></i>
                            </div>
                            <span class="text-[11px] font-bold <?= $team['akhir_status'] === 'approved' ? 'text-emerald-600' : 'text-slate-400' ?>">Lap. Akhir</span>
                        </div>
                    </div>

                    <!-- Footer Action -->
                    <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                        <div class="text-[11px] text-slate-400 font-medium italic">
                            <?php if ($team['finalized_at']): ?>
                                <i class="fas fa-history mr-1"></i> Terakhir audit: <?= date('d M Y', strtotime($team['finalized_at'])) ?>
                            <?php else: ?>
                                <i class="fas fa-exclamation-circle text-amber-500 mr-1"></i> Audit diperlukan
                            <?php endif; ?>
                        </div>
                        <a href="<?= base_url('admin/finalisasi/' . $team['proposal_id']) ?>" 
                           class="px-5 py-2 rounded-xl bg-slate-800 text-white text-xs font-bold hover:bg-sky-600 transition-all">
                            Audit & Finalisasi
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (empty($teams)): ?>
            <div class="lg:col-span-2 py-20 card-premium text-center">
                <div class="w-20 h-20 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4 text-slate-200 text-3xl">
                    <i class="fas fa-users-slash"></i>
                </div>
                <h3 class="text-slate-600 font-bold">Tidak ada tim yang ditemukan</h3>
                <p class="text-slate-400 text-sm mt-1 px-4 max-w-md mx-auto">Pastikan tim telah lolos tahap Pitching Desk untuk dapat muncul di halaman finalisasi ini.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
