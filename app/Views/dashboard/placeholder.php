<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="animate-stagger">
    <div class="card-premium p-12 text-center space-y-6">
        <div class="w-24 h-24 rounded-3xl bg-sky-50 flex items-center justify-center mx-auto text-sky-500 shadow-sm border border-sky-100">
            <i class="fas fa-hammer text-4xl animate-bounce"></i>
        </div>
        
        <div class="space-y-2">
            <h2 class="section-title text-3xl">Fitur Sedang Dibangun</h2>
            <p class="text-muted max-w-md mx-auto">
                Halaman <span class="text-sky-600 font-bold"><?= esc($title) ?></span> sedang dalam tahap pengembangan oleh tim teknis. Silakan kembali lagi nanti.
            </p>
        </div>

        <div class="pt-4">
            <a href="<?= base_url('dashboard') ?>" class="btn-primary inline-flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
