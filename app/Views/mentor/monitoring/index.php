<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="p-6 md:p-8 space-y-8" x-data="{
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        card.style.setProperty('--mouse-x', `${x}px`);
        card.style.setProperty('--mouse-y', `${y}px`);
    }
}">
    <!-- Header Section -->
    <div class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-indigo-600 via-indigo-500 to-purple-600 p-8 md:p-12 shadow-2xl shadow-indigo-200/50 group">
        <!-- Abstract Decorations -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-700"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-60 h-60 bg-indigo-400/20 rounded-full blur-2xl group-hover:bg-indigo-400/30 transition-all duration-700"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 backdrop-blur-md">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                    </span>
                    <span class="text-[10px] font-black text-white uppercase tracking-widest">Dashboard Mentoring</span>
                </div>
                <div>
                    <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight">
                        Tim <span class="text-amber-400">Mentoring</span>
                    </h1>
                    <p class="text-indigo-100/80 font-medium text-lg mt-2 max-w-xl">
                        Selamat datang, <span class="text-white font-bold"><?= $mentor['nama'] ?></span>. Bantu tim Anda mencapai pertumbuhan bisnis yang maksimal.
                    </p>
                </div>
            </div>
            
            <div class="flex items-center gap-4 bg-black/10 backdrop-blur-xl p-4 rounded-3xl border border-white/10">
                <div class="text-right">
                    <p class="text-[10px] font-black text-indigo-200 uppercase tracking-widest leading-none mb-1">Total Tim</p>
                    <p class="text-3xl font-black text-white leading-none"><?= count($teams) ?></p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center border border-white/20">
                    <i class="fas fa-briefcase text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Teams Grid -->
    <?php if (empty($teams)): ?>
        <div class="card-premium p-16 text-center" @mousemove="handleMouseMove">
            <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-slate-100">
                <i class="fas fa-folder-open text-slate-200 text-4xl"></i>
            </div>
            <h3 class="text-xl font-black text-slate-800 mb-2 uppercase tracking-tight">Belum Ada Tim</h3>
            <p class="text-slate-500 max-w-md mx-auto italic">Anda belum memiliki tim yang ditugaskan untuk dimentoring pada periode ini.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($teams as $team): ?>
                <div class="card-premium group p-6 hover:shadow-2xl hover:shadow-indigo-100 transition-all duration-500 border-b-4 border-b-transparent hover:border-b-indigo-500" @mousemove="handleMouseMove">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center group-hover:bg-indigo-50 group-hover:border-indigo-100 transition-colors duration-500">
                            <i class="fas fa-chart-line text-indigo-500 text-xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <div class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase border border-emerald-100">
                            <?= esc($team['status']) ?>
                        </div>
                    </div>

                    <div class="space-y-1 mb-6">
                        <h3 class="font-black text-slate-800 text-lg leading-tight uppercase line-clamp-2 group-hover:text-indigo-600 transition-colors">
                            <?= esc($team['nama_usaha']) ?>
                        </h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest"><?= esc($team['kategori_usaha']) ?></p>
                    </div>

                    <!-- Progress Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="p-3 rounded-2xl bg-slate-50 border border-slate-100 group-hover:bg-white transition-colors">
                            <p class="text-[9px] text-slate-400 font-bold uppercase mb-1">Mentoring</p>
                            <div class="flex items-end gap-1">
                                <span class="text-xl font-black text-slate-800 leading-none"><?= $team['total_mentoring'] ?></span>
                                <span class="text-[10px] text-slate-400 font-bold leading-none mb-1">/4</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-2xl bg-slate-50 border border-slate-100 group-hover:bg-white transition-colors">
                            <p class="text-[9px] text-slate-400 font-bold uppercase mb-1">Kegiatan</p>
                            <span class="text-xl font-black text-slate-800 leading-none"><?= $team['total_kegiatan'] ?></span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-indigo-600" title="Ketua: <?= $team['ketua_nama'] ?>">
                                <?= substr($team['ketua_nama'], 0, 1) ?>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-[10px] font-bold text-slate-400">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <a href="<?= base_url('mentor/monitoring/detail/' . $team['proposal_id']) ?>" class="inline-flex items-center gap-2 text-xs font-black text-indigo-500 hover:text-indigo-600 uppercase tracking-tighter group-hover:translate-x-1 transition-all">
                            Lihat Progress <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.card-premium {
    background: white;
    border-radius: 2rem;
    border: 1px solid rgba(226, 232, 240, 0.8);
    position: relative;
    overflow: hidden;
}

.card-premium::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(
        800px circle at var(--mouse-x) var(--mouse-y),
        rgba(79, 70, 229, 0.06),
        transparent 40%
    );
    z-index: 0;
    pointer-events: none;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
<?= $this->endSection() ?>
