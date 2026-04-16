<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Seleksi <span class="text-gradient">Administrasi</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap 2 - Validasi kelengkapan dokumen proposal mahasiswa</p>
        </div>
    </div>

    <!-- ================================================================
         2. STATS OVERVIEW
    ================================================================= -->
    <?php
    $stats = [
        ['title' => 'Total Proposal', 'value' => $stats['total'], 'icon' => 'fa-file-invoice', 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500'],
        ['title' => 'Menunggu', 'value' => $stats['submitted'], 'icon' => 'fa-clock', 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500'],
        ['title' => 'Disetujui', 'value' => $stats['approved'], 'icon' => 'fa-circle-check', 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500'],
        ['title' => 'Ditolak', 'value' => $stats['rejected'], 'icon' => 'fa-circle-xmark', 'bg' => 'bg-rose-50', 'icon_color' => 'text-rose-500'],
    ];
    ?>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <?php foreach ($stats as $index => $stat): ?>
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
        <a href="<?= base_url('admin/seleksi-administrasi') ?>" 
           class="btn-outline btn-sm <?= !$statusFilter ? 'bg-sky-500 text-white border-sky-500 hover:bg-sky-600' : '' ?>">
            Semua
        </a>
        <a href="<?= base_url('admin/seleksi-administrasi?status=submitted') ?>" 
           class="btn-outline btn-sm <?= $statusFilter === 'submitted' ? 'bg-yellow-500 text-white border-yellow-500 hover:bg-yellow-600' : '' ?>">
            <i class="fas fa-clock mr-1"></i> Menunggu
        </a>
        <a href="<?= base_url('admin/seleksi-administrasi?status=revision') ?>" 
           class="btn-outline btn-sm <?= $statusFilter === 'revision' ? 'bg-orange-500 text-white border-orange-500 hover:bg-orange-600' : '' ?>">
            <i class="fas fa-rotate mr-1"></i> Revisi
        </a>
        <a href="<?= base_url('admin/seleksi-administrasi?status=approved') ?>" 
           class="btn-outline btn-sm <?= $statusFilter === 'approved' ? 'bg-emerald-500 text-white border-emerald-500 hover:bg-emerald-600' : '' ?>">
            <i class="fas fa-check mr-1"></i> Disetujui
        </a>
        <a href="<?= base_url('admin/seleksi-administrasi?status=rejected') ?>" 
           class="btn-outline btn-sm <?= $statusFilter === 'rejected' ? 'bg-rose-500 text-white border-rose-500 hover:bg-rose-600' : '' ?>">
            <i class="fas fa-xmark mr-1"></i> Ditolak
        </a>
    </div>

    <!-- ================================================================
         4. PROPOSALS TABLE
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-500">
        
        <!-- Table Header -->
        <div class="px-4 sm:px-7 py-4 sm:py-5 border-b border-sky-50 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white/60">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">Daftar Proposal</h3>
                <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5">
                    <?= $statusFilter ? 'Filter: ' . ucfirst($statusFilter) : 'Semua proposal yang telah disubmit' ?>
                </p>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="pmw-table">
                <thead>
                    <tr>
                        <th>Proposal</th>
                        <th>Ketua Tim</th>
                        <th>Dosen</th>
                        <th>Kategori</th>
                        <th class="text-center">Anggota</th>
                        <th class="text-center">Dokumen</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $statusColors = [
                        'draft'     => 'bg-slate-50 text-slate-600 border-slate-200',
                        'submitted' => 'bg-yellow-50 text-yellow-600 border-yellow-200',
                        'revision'  => 'bg-orange-50 text-orange-600 border-orange-200',
                        'approved'  => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                        'rejected'  => 'bg-rose-50 text-rose-600 border-rose-200',
                    ];
                    $statusLabels = [
                        'draft'     => 'Draft',
                        'submitted' => 'Menunggu',
                        'revision'  => 'Revisi',
                        'approved'  => 'Disetujui',
                        'rejected'  => 'Ditolak',
                    ];
                    $statusIcons = [
                        'draft'     => 'fa-file',
                        'submitted' => 'fa-clock',
                        'revision'  => 'fa-rotate',
                        'approved'  => 'fa-circle-check',
                        'rejected'  => 'fa-circle-xmark',
                    ];
                    ?>
                    <?php foreach ($proposals as $proposal): ?>
                    <?php if ($proposal['status'] === 'draft') continue; ?>
                    <tr class="group">
                        <!-- Proposal Info -->
                        <td class="whitespace-nowrap">
                            <div class="min-w-0">
                                <div class="font-display font-bold text-(--text-heading) text-[13px] truncate max-w-[180px] sm:max-w-none">
                                    <?= esc($proposal['nama_usaha'] ?: 'Proposal #' . $proposal['id']) ?>
                                </div>
                                <div class="text-xs text-(--text-muted)">
                                    <?= esc($proposal['period_name'] ?? '-') ?> <?= esc($proposal['period_year'] ?? '') ?>
                                </div>
                            </div>
                        </td>

                        <!-- Ketua Tim -->
                        <td class="whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-linear-to-tr from-teal-500 to-teal-400 flex items-center justify-center text-white font-display font-bold text-xs shrink-0">
                                    <?= strtoupper(substr($proposal['ketua_nama'] ?? '??', 0, 2)) ?>
                                </div>
                                <div class="min-w-0">
                                    <div class="font-semibold text-(--text-heading) text-[13px] truncate max-w-[100px] sm:max-w-none">
                                        <?= esc($proposal['ketua_nama'] ?? '-') ?>
                                    </div>
                                    <div class="text-xs text-(--text-muted)">
                                        <?= esc($proposal['ketua_nim'] ?? '-') ?>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Dosen -->
                        <td class="whitespace-nowrap">
                            <div class="min-w-0">
                                <div class="font-semibold text-(--text-heading) text-[13px] truncate max-w-[100px] sm:max-w-none">
                                    <?= esc($proposal['dosen_nama'] ?? '-') ?>
                                </div>
                                <div class="text-xs text-(--text-muted)">
                                    <?= esc($proposal['dosen_nip'] ?? '-') ?>
                                </div>
                            </div>
                        </td>

                        <!-- Kategori -->
                        <td class="whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-lg text-[11px] font-bold border <?= $proposal['kategori_wirausaha'] === 'pemula' ? "bg-sky-50 text-sky-600 border-sky-200" : "bg-violet-50 text-violet-600 border-violet-200" ?>">
                                <?= $proposal['kategori_wirausaha'] === 'pemula' ? 'Pemula' : 'Berkembang' ?>
                            </span>
                        </td>

                        <!-- Anggota Count -->
                        <td class="text-center">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-slate-50 text-slate-600 text-xs font-bold">
                                <i class="fas fa-users text-[10px]"></i>
                                <?= (int)($proposal['member_count'] ?? 0) ?>
                            </span>
                        </td>

                        <!-- Dokumen Count -->
                        <td class="text-center">
                            <?php $docCount = (int)($proposal['doc_count'] ?? 0); ?>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-xs font-bold <?= $docCount >= 5 ? 'bg-emerald-50 text-emerald-600' : 'bg-yellow-50 text-yellow-600' ?>">
                                <i class="fas fa-file-pdf text-[10px]"></i>
                                <?= $docCount ?>/5
                            </span>
                        </td>

                        <!-- Status -->
                        <td>
                            <span class="pmw-status <?= $statusColors[$proposal['status']] ?? 'bg-slate-50 text-slate-600' ?>">
                                <i class="fas <?= $statusIcons[$proposal['status']] ?? 'fa-circle' ?> text-[10px]"></i>
                                <?= $statusLabels[$proposal['status']] ?? ucfirst($proposal['status']) ?>
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5 sm:gap-2">
                                <!-- Detail -->
                                <a href="<?= base_url('admin/seleksi-administrasi/' . $proposal['id']) ?>"
                                   class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-lg bg-violet-50 text-violet-500 hover:bg-violet-500 hover:text-white transition-all"
                                   title="Detail & Validasi">
                                    <i class="fas fa-eye text-[11px] sm:text-xs"></i>
                                </a>
                                <!-- Validasi (hanya submitted/revision) -->
                                <?php if (in_array($proposal['status'], ['submitted', 'revision'])): ?>
                                <a href="<?= base_url('admin/seleksi-administrasi/' . $proposal['id']) ?>"
                                   class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-lg bg-sky-50 text-sky-500 hover:bg-sky-500 hover:text-white transition-all"
                                   title="Validasi">
                                    <i class="fas fa-clipboard-check text-[11px] sm:text-xs"></i>
                                </a>
                                <?php endif; ?>
                                <!-- Hapus (hanya rejected) -->
                                <?php if ($proposal['status'] === 'rejected'): ?>
                                <a href="<?= base_url('admin/seleksi-administrasi/' . $proposal['id'] . '/hapus') ?>" 
                                   class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-lg bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all"
                                   title="Hapus Proposal"
                                   onclick="return confirm('Yakin ingin menghapus proposal ini secara permanen?')">
                                    <i class="fas fa-trash text-[11px] sm:text-xs"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php if (empty($proposals) || !array_filter($proposals, fn($p) => $p['status'] !== 'draft')): ?>
                    <tr>
                        <td colspan="8" class="text-center py-12">
                            <div class="text-(--text-muted)">
                                <i class="fas fa-inbox text-4xl mb-3 opacity-30"></i>
                                <p class="text-sm">Belum ada proposal <?= $statusFilter ? 'dengan status ' . ucfirst($statusFilter) : 'yang disubmit' ?></p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="px-4 sm:px-7 py-3 sm:py-4 border-t border-sky-50 bg-white/40 flex items-center justify-between">
            <p class="text-xs text-(--text-muted)">
                Menampilkan <?= count(array_filter($proposals, fn($p) => $p['status'] !== 'draft')) ?> proposal
            </p>
        </div>
    </div>

</div><!-- /page wrapper -->

<?= $this->endSection() ?>
