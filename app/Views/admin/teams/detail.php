<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6" x-data="{
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- Breadcrumb & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-sm">
            <a href="<?= base_url('admin/teams') ?>" class="text-slate-500 hover:text-sky-600 transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Data TIM
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-700 font-semibold">Detail</span>
        </div>
        <div class="flex gap-2">
            <a href="<?= base_url('admin/administrasi/seleksi/' . $proposal['id']) ?>" class="btn-primary text-sm">
                <i class="fas fa-file-alt mr-2"></i>Lihat Proposal
            </a>
        </div>
    </div>

    <?= view('admin/teams/_summary') ?>
</div>

<?= $this->endSection() ?>