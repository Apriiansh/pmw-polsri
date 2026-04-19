<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-8" x-data="{
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
    <!-- Header with Back Button -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-slate-100 pb-8">
        <div class="flex items-center gap-5">
            <a href="<?= base_url('mentor/monitoring') ?>" class="w-12 h-12 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-indigo-500 hover:border-indigo-200 hover:shadow-lg hover:shadow-indigo-50 transition-all group">
                <i class="fas fa-arrow-left text-sm transition-transform group-hover:-translate-x-1"></i>
            </a>
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <span class="px-2 py-0.5 rounded-lg bg-indigo-50 text-[10px] font-black text-indigo-600 uppercase tracking-widest border border-indigo-100/50">Monitoring Mentoring</span>
                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"><?= esc($proposal['skema'] ?? 'PMW') ?></span>
                </div>
                <h1 class="text-3xl font-black text-slate-800 uppercase tracking-tight leading-none"><?= esc($proposal['nama_usaha']) ?></h1>
            </div>
        </div>
        
        <div class="flex items-center gap-4 bg-white p-2 pr-4 rounded-2xl border border-slate-100 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Status Tim</p>
                <p class="text-xs font-bold text-emerald-600 uppercase"><?= esc($proposal['status']) ?></p>
            </div>
        </div>
    </div>

    <!-- Include the shared monitoring partial -->
    <?= $this->include('shared/_monitoring_team') ?>
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
</style>
<?= $this->endSection() ?>
