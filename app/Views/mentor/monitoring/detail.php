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
    <!-- Header with Back Button -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="<?= base_url('mentor/monitoring') ?>" class="w-10 h-10 rounded-2xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 hover:text-indigo-500 hover:border-indigo-200 transition-all shadow-sm">
                <i class="fas fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-2xl font-black text-slate-800 uppercase tracking-tight leading-none"><?= esc($proposal['nama_usaha']) ?></h1>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Monitoring Progress Mentoring</p>
            </div>
        </div>
        
        <div class="flex items-center gap-2 px-4 py-2 rounded-2xl bg-indigo-50 border border-indigo-100">
            <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">Status:</span>
            <span class="px-2 py-0.5 rounded-lg bg-white border border-indigo-200 text-[9px] font-black text-indigo-500 uppercase"><?= esc($proposal['status']) ?></span>
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
