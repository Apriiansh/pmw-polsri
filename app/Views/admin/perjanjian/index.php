<?php
/** @var array $proposals */
/** @var array $stats */
/** @var string|null $statusFilter */
?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Perjanjian <span class="text-gradient">Implementasi</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap 4 - Validasi Berkas Perjanjian Mahasiswa</p>
        </div>
    </div>

    <!-- ================================================================
         2. STATS OVERVIEW
    ================================================================= -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <?php
        $statItems = [
            ['title' => 'Siap Kontrak', 'value' => $stats['total'], 'icon' => 'fa-file-signature', 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500'],
            ['title' => 'Menunggu Review', 'value' => $stats['pending'], 'icon' => 'fa-clock', 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500'],
            ['title' => 'Sudah Kontrak', 'value' => $stats['approved'], 'icon' => 'fa-check-double', 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500'],
            ['title' => 'Revisi/Ditolak', 'value' => $stats['revision'] + $stats['rejected'], 'icon' => 'fa-circle-xmark', 'bg' => 'bg-rose-50', 'icon_color' => 'text-rose-500'],
        ];
        ?>
        <?php foreach ($statItems as $index => $stat): ?>
        <div class="card-premium p-3 sm:p-5 flex items-center gap-3 sm:gap-4 animate-stagger delay-<?= ($index + 1) * 100 ?>">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl <?= $stat['bg'] ?> flex items-center justify-center shrink-0">
                <i class="fas <?= $stat['icon'] ?> text-lg sm:text-xl <?= $stat['icon_color'] ?>"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] sm:text-[11px] font-black text-slate-400 uppercase tracking-wider truncate"><?= $stat['title'] ?></p>
                <h3 class="font-display text-xl sm:text-2xl font-black text-(--text-heading)"><?= $stat['value'] ?></h3>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- ================================================================
         3. FILTER TABS
    ================================================================= -->
    <div class="flex flex-wrap gap-2 animate-stagger delay-300">
        <a href="<?= base_url('admin/perjanjian') ?>" 
           class="btn-outline btn-sm <?= !$statusFilter ? 'bg-sky-500 text-white border-sky-500 hover:bg-sky-600' : '' ?>">
            Semua
        </a>
        <a href="<?= base_url('admin/perjanjian?status=pending') ?>" 
           class="btn-outline btn-sm <?= $statusFilter === 'pending' ? 'bg-yellow-500 text-white border-yellow-500 hover:bg-yellow-600' : '' ?>">
            <i class="fas fa-clock mr-1"></i> Menunggu
        </a>
        <a href="<?= base_url('admin/perjanjian?status=approved') ?>" 
           class="btn-outline btn-sm <?= $statusFilter === 'approved' ? 'bg-emerald-500 text-white border-emerald-500 hover:bg-emerald-600' : '' ?>">
            <i class="fas fa-check mr-1"></i> Disetujui
        </a>
    </div>

    <!-- ================================================================
         4. PROPOSALS TABLE
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-500">
        
        <div class="px-4 sm:px-7 py-4 sm:py-5 border-b border-sky-50 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white/60">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">Antrian Berkas Perjanjian</h3>
                <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5">
                    Proposal yang telah melewati Pitching Desk dan sedang mengurus administrasi kontrak
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="pmw-table">
                <thead>
                    <tr>
                        <th>Tim / Usaha</th>
                        <th>Ketua</th>
                        <th>Dosen Pembimbing</th>
                        <th>Mentor (Praktisi)</th>
                        <th class="text-center">Berkas PDF</th>
                        <th>Status Admin</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $statusColors = [
                        'pending'  => 'bg-yellow-50 text-yellow-600 border-yellow-200',
                        'approved' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                        'revision' => 'bg-orange-50 text-orange-600 border-orange-200',
                        'rejected' => 'bg-rose-50 text-rose-600 border-rose-200',
                    ];
                    $statusLabels = [
                        'pending'  => 'Menunggu',
                        'approved' => 'Disetujui',
                        'revision' => 'Revisi',
                        'rejected' => 'Ditolak',
                    ];
                    ?>
                    <?php foreach ($proposals as $proposal): ?>
                    <tr class="group">
                        <td>
                            <div class="font-display font-bold text-(--text-heading) text-[13px]">
                                <?= esc($proposal['nama_usaha'] ?: 'Tim #' . $proposal['id']) ?>
                            </div>
                            <div class="text-[10px] text-slate-400"><?= esc($proposal['period_name']) ?></div>
                        </td>
                        <td>
                            <div class="text-[13px] font-semibold text-slate-600"><?= esc($proposal['ketua_nama']) ?></div>
                            <div class="text-[11px] text-slate-400"><?= esc($proposal['ketua_nim']) ?></div>
                        </td>
                        <td>
                            <div class="text-[13px] font-semibold text-slate-600"><?= esc($proposal['dosen_nama']) ?></div>
                        </td>
                        <td>
                            <?php if ($proposal['mentor_nama']): ?>
                                <div class="text-[13px] font-semibold text-sky-600"><?= esc($proposal['mentor_nama']) ?></div>
                            <?php else: ?>
                                <div class="text-[11px] text-slate-300 italic">Belum Dipilih</div>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($proposal['bukti_perjanjian_id']): ?>
                                <a href="<?= base_url('admin/seleksi-administrasi/doc/' . $proposal['bukti_perjanjian_id']) ?>" class="text-rose-500 hover:text-rose-600">
                                    <i class="fas fa-file-pdf text-xl"></i>
                                </a>
                            <?php else: ?>
                                <span class="text-slate-300 italic text-[10px]">Belum Upload</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="pmw-status <?= $statusColors[$proposal['perjanjian_status']] ?? 'bg-slate-50' ?>">
                                <?= $statusLabels[$proposal['perjanjian_status']] ?>
                            </span>
                        </td>
                        <td class="text-right whitespace-nowrap">
                            <a href="<?= base_url('admin/perjanjian/' . $proposal['id']) ?>" 
                               class="btn-outline btn-sm bg-violet-50 text-violet-600 border-violet-200 hover:bg-violet-500 hover:text-white transition-all">
                                <i class="fas fa-stamp mr-1.5"></i> Verifikasi Berkas
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php if (empty($proposals)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-12">
                            <div class="text-(--text-muted)">
                                <i class="fas fa-file-invoice text-4xl mb-3 opacity-30"></i>
                                <p class="text-sm">Tidak ada berkas perjanjian yang masuk dalam tahap ini.</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
