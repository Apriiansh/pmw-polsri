<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="adminImplementasi()">

    <!-- Page Header -->
    <div class="animate-stagger">
        <h2 class="section-title">
            Validasi <span class="text-gradient">Implementasi</span>
        </h2>
        <p class="section-subtitle">Verifikasi list perjanjian dari tim yang sudah lolos</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 animate-stagger delay-100">
        <div class="card-premium p-4 text-center">
            <p class="text-[10px] font-black text-slate-400 uppercase">Total</p>
            <p class="text-2xl font-bold text-slate-800"><?= $stats['total'] ?></p>
        </div>
        <div class="card-premium p-4 text-center border-l-4 border-l-amber-400">
            <p class="text-[10px] font-black text-slate-400 uppercase">Pending</p>
            <p class="text-2xl font-bold text-amber-600"><?= $stats['pending'] ?></p>
        </div>
        <div class="card-premium p-4 text-center border-l-4 border-l-emerald-400">
            <p class="text-[10px] font-black text-slate-400 uppercase">Approved</p>
            <p class="text-2xl font-bold text-emerald-600"><?= $stats['approved'] ?></p>
        </div>
        <div class="card-premium p-4 text-center border-l-4 border-l-orange-400">
            <p class="text-[10px] font-black text-slate-400 uppercase">Revision</p>
            <p class="text-2xl font-bold text-orange-600"><?= $stats['revision'] ?></p>
        </div>
        <div class="card-premium p-4 text-center border-l-4 border-l-rose-400">
            <p class="text-[10px] font-black text-slate-400 uppercase">Rejected</p>
            <p class="text-2xl font-bold text-rose-600"><?= $stats['rejected'] ?></p>
        </div>
    </div>

    <!-- Filter -->
    <div class="flex flex-wrap gap-2 animate-stagger delay-200">
        <a href="<?= base_url('admin/implementasi') ?>" class="btn-outline btn-sm <?= !$statusFilter ? 'bg-sky-50 text-sky-700 border-sky-200' : '' ?>">
            Semua
        </a>
        <a href="<?= base_url('admin/implementasi?status=pending') ?>" class="btn-outline btn-sm <?= $statusFilter === 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200' : '' ?>">
            <i class="fas fa-clock mr-1"></i>Pending
        </a>
        <a href="<?= base_url('admin/implementasi?status=approved') ?>" class="btn-outline btn-sm <?= $statusFilter === 'approved' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : '' ?>">
            <i class="fas fa-check mr-1"></i>Approved
        </a>
        <a href="<?= base_url('admin/implementasi?status=revision') ?>" class="btn-outline btn-sm <?= $statusFilter === 'revision' ? 'bg-orange-50 text-orange-700 border-orange-200' : '' ?>">
            <i class="fas fa-pen mr-1"></i>Revision
        </a>
        <a href="<?= base_url('admin/implementasi?status=rejected') ?>" class="btn-outline btn-sm <?= $statusFilter === 'rejected' ? 'bg-rose-50 text-rose-700 border-rose-200' : '' ?>">
            <i class="fas fa-xmark mr-1"></i>Rejected
        </a>
    </div>

    <!-- Table -->
    <div class="card-premium overflow-hidden animate-stagger delay-300">
        <div class="overflow-x-auto">
            <table class="pmw-table">
                <thead>
                    <tr>
                        <th>Tim/Usaha</th>
                        <th>Ketua</th>
                        <th>Periode</th>
                        <th class="text-center">Komponen</th>
                        <th class="text-right">Total Harga</th>
                        <th class="text-center">Status Dosen</th>
                        <th class="text-center">Status Final</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($proposals as $p): ?>
                    <tr>
                        <td>
                            <div class="font-display font-bold text-(--text-heading)"><?= esc($p['nama_usaha']) ?></div>
                            <div class="text-[10px] text-slate-400 uppercase font-black tracking-wider"><?= esc($p['kategori_wirausaha'] ?? '-') ?></div>
                        </td>
                        <td>
                            <div class="text-sm font-semibold text-slate-600"><?= esc($p['ketua_nama']) ?></div>
                            <div class="text-[11px] text-slate-400"><?= esc($p['ketua_nim']) ?></div>
                        </td>
                        <td>
                            <div class="text-sm font-semibold text-slate-600"><?= esc($p['period_name']) ?></div>
                            <div class="text-[11px] text-slate-400"><?= $p['period_year'] ?></div>
                        </td>
                        <td class="text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-100 text-sky-700 font-bold">
                                <?= $p['item_count'] ?>
                            </span>
                        </td>
                        <td class="text-right">
                            <span class="font-bold text-emerald-600">
                                Rp <?= number_format($p['total_price'] ?? 0, 0, ',', '.') ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php
                            $dosenStatus = $p['dosen_status'] ?? 'pending';
                            $dBadge = match($dosenStatus) {
                                'approved' => ['bg-emerald-50 text-emerald-600 border-emerald-100', 'fa-check', 'Approved'],
                                'revision' => ['bg-orange-50 text-orange-600 border-orange-100', 'fa-rotate', 'Revision'],
                                'rejected' => ['bg-rose-50 text-rose-600 border-rose-100', 'fa-times', 'Rejected'],
                                default    => ['bg-amber-50 text-amber-600 border-amber-100', 'fa-clock', 'Pending'],
                            };
                            ?>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[9px] font-black border <?= $dBadge[0] ?>">
                                <i class="fas <?= $dBadge[1] ?>"></i>
                                <?= strtoupper($dBadge[2]) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php
                            $statusBadge = match($p['implementasi_status']) {
                                'approved' => ['bg-emerald-500 text-white shadow-sm shadow-emerald-100', 'fa-check-double', 'Berkas Sah'],
                                'rejected' => ['bg-rose-500 text-white shadow-sm shadow-rose-100', 'fa-xmark', 'Ditolak'],
                                'revision' => ['bg-orange-500 text-white shadow-sm shadow-orange-100', 'fa-pen', 'Perlu Revisi'],
                                default => ['bg-slate-100 text-slate-500', 'fa-clock', 'Waiting'],
                            };
                            ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black <?= $statusBadge[0] ?>">
                                <i class="fas <?= $statusBadge[1] ?>"></i>
                                <?= strtoupper($statusBadge[2]) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/implementasi/detail/' . $p['id']) ?>" class="btn-primary btn-sm">
                                <i class="fas fa-eye mr-1"></i>Detail
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if (empty($proposals)): ?>
                    <tr>
                        <td colspan="7" class="text-center py-12">
                            <div class="text-slate-400">
                                <i class="fas fa-inbox text-4xl mb-3 opacity-30"></i>
                                <p class="text-sm">Belum ada submission implementasi</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
function adminImplementasi() {
    return {
        // Component logic here if needed
    }
}
</script>

<?= $this->endSection() ?>
