<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-10 h-10 rounded-2xl bg-amber-100 flex items-center justify-center text-amber-600">
                    <i class="fas fa-bullhorn text-lg"></i>
                </div>
                <div>
                    <h1 class="font-display text-2xl font-bold text-slate-800 tracking-tight">Manajemen Pengumuman</h1>
                    <p class="text-xs text-slate-500 font-medium">Kelola berita, agenda, dan pengumuman penting untuk portal publik.</p>
                </div>
            </div>
        </div>
        <a href="<?= base_url('admin/portal-announcements/create') ?>" 
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-500 hover:bg-sky-600 text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-sky-500/25 active:scale-95">
            <i class="fas fa-plus"></i>
            Buat Pengumuman
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-600 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-3">
            <i class="fas fa-check-circle"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Announcements List -->
    <div class="grid grid-cols-1 gap-4">
        <?php if (empty($announcements)): ?>
            <div class="bg-white rounded-[2rem] border border-slate-200 p-12 text-center">
                <div class="w-20 h-20 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <i class="fas fa-bullhorn text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">Belum Ada Pengumuman</h3>
                <p class="text-sm text-slate-500 mb-6">Mulai buat pengumuman pertama Anda untuk ditampilkan di portal publik.</p>
                <a href="<?= base_url('admin/portal-announcements/create') ?>" class="btn-primary px-6 py-2.5">Buat Sekarang</a>
            </div>
        <?php else: ?>
            <?php foreach ($announcements as $ann): ?>
                <div class="group bg-white rounded-2xl border border-slate-200 p-5 hover:border-sky-400 hover:shadow-xl hover:shadow-sky-500/5 transition-all duration-300 flex flex-col md:flex-row md:items-center gap-6">
                    <!-- Icon/Category Decor -->
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0 <?= 
                        $ann['type'] === 'urgent' ? 'bg-rose-100 text-rose-500' : (
                        $ann['type'] === 'success' ? 'bg-emerald-100 text-emerald-500' : (
                        $ann['type'] === 'warning' ? 'bg-amber-100 text-amber-500' : 'bg-sky-100 text-sky-500')) 
                    ?>">
                        <i class="fas <?= 
                            $ann['type'] === 'urgent' ? 'fa-exclamation-circle' : (
                            $ann['type'] === 'success' ? 'fa-trophy' : (
                            $ann['type'] === 'warning' ? 'fa-calendar-check' : 'fa-info-circle')) 
                        ?> text-2xl"></i>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-3 mb-1.5">
                            <span class="px-2 py-0.5 rounded bg-slate-100 text-[9px] font-black text-slate-500 uppercase tracking-widest">
                                <?= $ann['category'] ?>
                            </span>
                            <span class="text-[10px] text-slate-400 font-medium">
                                <i class="far fa-calendar-alt mr-1"></i>
                                <?= date('d M Y', strtotime($ann['date'])) ?>
                            </span>
                            <?php if (!$ann['is_published']): ?>
                                <span class="px-2 py-0.5 rounded bg-amber-50 text-[9px] font-black text-amber-600 uppercase tracking-widest border border-amber-100">
                                    Draft
                                </span>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-bold text-slate-800 text-lg group-hover:text-sky-600 transition-colors truncate"><?= $ann['title'] ?></h3>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 shrink-0">
                        <button type="button" 
                                onclick="confirmDelete('<?= base_url('admin/portal-announcements/delete/' . $ann['id']) ?>')"
                                class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-200 hover:bg-rose-50 transition-all">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Hapus Pengumuman?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0ea5e9',
        cancelButtonColor: '#f43f5e',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        borderRadius: '1.5rem'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}
</script>
<?= $this->endSection() ?>
