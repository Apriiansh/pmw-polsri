<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6 animate-stagger" x-data="{
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <div>
                <h2 class="section-title">Proposal <span class="text-gradient">PMW</span></h2>
                <p class="section-subtitle">Pengajuan proposal mahasiswa sesuai jadwal PMW</p>
            </div>
            <?php if ($proposal && $proposal['status'] === 'draft'): ?>
                <a href="<?= base_url('mahasiswa/proposal/edit/' . $proposal['id']) ?>" class="btn-secondary inline-flex items-center gap-2">
                    <i class="fas fa-pen"></i>
                    Edit Draft
                </a>
            <?php elseif (!$proposal): ?>
                <a href="<?= base_url('mahasiswa/proposal/create') ?>" class="btn-primary inline-flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Buat Proposal
                </a>
            <?php endif; ?>
        </div>

        <div class="card-premium p-5 sm:p-7 mt-6" @mousemove="handleMouseMove">
            <div class="flex items-start justify-between gap-4 flex-wrap">
                <div>
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400">Periode Aktif</p>
                    <p class="text-lg font-bold text-slate-800 mt-1">
                        <?= $activePeriod ? esc($activePeriod['name']) . ' ' . esc($activePeriod['year']) : '-' ?>
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400">Jadwal Tahap 1</p>
                    <p class="text-sm font-bold text-slate-700 mt-1">
                        <?= $phase1 ? (esc($phase1['start_date'] ?? '-') . ' s/d ' . esc($phase1['end_date'] ?? '-')) : '-' ?>
                    </p>
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold mt-2 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700 border border-emerald-100" : "bg-rose-50 text-rose-700 border border-rose-100" ?>">
                        <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                        <?= $isPhaseOpen ? 'Dibuka' : 'Ditutup' ?>
                    </span>
                </div>
            </div>

            <div class="border-t border-slate-100 my-5"></div>

            <?php if ($proposal && !empty($proposal['catatan'])): ?>
                <?php
                $alertClasses = [
                    'revision' => 'bg-orange-50 border-orange-200 text-orange-800',
                    'rejected' => 'bg-rose-50 border-rose-200 text-rose-800',
                    'approved' => 'bg-emerald-50 border-emerald-200 text-emerald-800',
                ];
                $alertIcons = [
                    'revision' => 'fa-circle-exclamation text-orange-500',
                    'rejected' => 'fa-circle-xmark text-rose-500',
                    'approved' => 'fa-circle-check text-emerald-500',
                ];
                $statusLabel = [
                    'revision' => 'Perlu Revisi',
                    'rejected' => 'Proposal Ditolak',
                    'approved' => 'Pesan dari Admin',
                ];
                $class = $alertClasses[$proposal['status']] ?? 'bg-slate-50 border-slate-200 text-slate-800';
                $icon = $alertIcons[$proposal['status']] ?? 'fa-info-circle text-slate-400';
                $label = $statusLabel[$proposal['status']] ?? 'Catatan Admin';
                ?>
                <div class="p-4 rounded-2xl border <?= $class ?> mb-5 animate-in slide-in-from-top-2 duration-500">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas <?= $icon ?> text-lg"></i>
                        <h4 class="font-bold text-sm uppercase tracking-wider"><?= $label ?></h4>
                    </div>
                    <div class="text-sm leading-relaxed whitespace-pre-line opacity-90 pl-7">
                        <?= esc($proposal['catatan']) ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400">Status Proposal</p>
                    <p class="text-base font-bold text-slate-800 mt-1">
                        <?= $proposal ? esc(strtoupper($proposal['status'])) : 'BELUM ADA' ?>
                    </p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400">Aksi</p>
                    <div class="mt-2 flex items-center gap-2 flex-wrap">
                        <?php if ($proposal): ?>
                            <?php if ($proposal['status'] === 'draft'): ?>
                                <a href="<?= base_url('mahasiswa/proposal/edit/' . $proposal['id']) ?>" class="btn-secondary inline-flex items-center gap-2">
                                    <i class="fas fa-pen"></i>
                                    Edit
                                </a>
                                <form action="<?= base_url('mahasiswa/proposal/submit/' . $proposal['id']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn-primary inline-flex items-center gap-2" <?= $isPhaseOpen ? '' : 'disabled' ?>>
                                        <i class="fas fa-paper-plane"></i>
                                        Kirim
                                    </button>
                                </form>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?= base_url('mahasiswa/proposal/create') ?>" class="btn-primary inline-flex items-center gap-2" <?= $activePeriod ? '' : 'disabled' ?>>
                                <i class="fas fa-plus"></i>
                                Buat Proposal
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
