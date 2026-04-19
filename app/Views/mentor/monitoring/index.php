<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6" x-data="{ 
    showTeamModal: false,
    selectedMember: null,
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
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight"><?= esc($header_title) ?></h1>
            <p class="text-slate-500 text-sm"><?= esc($header_subtitle) ?></p>
        </div>
        
        <?php if (!$is_single_team && !empty($teams)): ?>
            <div class="flex items-center gap-3">
                <div class="px-4 py-2 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center gap-2">
                    <i class="fas fa-briefcase text-indigo-500"></i>
                    <span class="text-xs font-bold text-indigo-700"><?= count($teams) ?> Tim Mentoring</span>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (empty($teams)): ?>
        <!-- Empty State -->
        <div class="card-premium p-20 text-center" @mousemove="handleMouseMove">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-slate-100 shadow-inner">
                <i class="fas fa-folder-open text-slate-200 text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Tim</h3>
            <p class="text-slate-400 max-w-md mx-auto italic text-sm">
                Anda belum memiliki tim yang ditugaskan untuk dimentoring pada periode ini.
            </p>
        </div>

    <?php elseif ($is_single_team): ?>
        <!-- Single Team Focused Dashboard -->
        <div class="space-y-6">
            <?= $this->include('shared/_monitoring_team', [
                'headerBadge'  => 'Monitoring Mentoring',
            ]) ?>
        </div>

    <?php else: ?>
        <!-- Multiple Teams Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <?php foreach ($teams as $team): ?>
                <div class="card-premium group hover:border-indigo-200 transition-all duration-300" @mousemove="handleMouseMove">
                    <div class="p-5">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-linear-to-br from-indigo-500 to-purple-500 text-white flex items-center justify-center font-bold text-xl shadow-lg shadow-indigo-100">
                                    <?= substr(esc($team['nama_usaha']), 0, 1) ?>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800 group-hover:text-indigo-600 transition-colors line-clamp-1 uppercase"><?= esc($team['nama_usaha']) ?></h3>
                                    <p class="text-xs text-slate-500 flex items-center gap-1">
                                        <i class="fas fa-user-circle text-indigo-400"></i>
                                        <?= esc($team['ketua_nama']) ?>
                                    </p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-[10px] font-black uppercase"><?= esc($team['status']) ?></span>
                        </div>

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

                        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                <?= esc($team['kategori_usaha']) ?>
                            </div>
                            <a href="<?= base_url('mentor/monitoring/detail/' . $team['proposal_id']) ?>" 
                               class="text-xs font-black text-indigo-500 hover:text-indigo-600 uppercase tracking-tighter">
                                Detail Progress <i class="fas fa-arrow-right text-[10px] ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.card-premium {
    background: white;
    border-radius: 1.5rem;
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
        rgba(79, 70, 229, 0.04),
        transparent 40%
    );
    z-index: 0;
    pointer-events: none;
}
</style>
<?= $this->endSection() ?>
