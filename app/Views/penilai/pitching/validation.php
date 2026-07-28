<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="{
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Penilaian <span class="text-gradient">Pitching Desk</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Penilaian & Penentuan Kelolosan Pitching Desk</p>
        </div>
    </div>

    <!-- ================================================================
         2. STATS OVERVIEW
    ================================================================= -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <?php
        $statItems = [
            ['title' => 'Total Proposal', 'value' => $stats['total'], 'icon' => 'fa-clipboard-list', 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500'],
            ['title' => 'Sudah Dinilai Saya', 'value' => $stats['my_submitted'], 'icon' => 'fa-check-circle', 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500'],
            ['title' => 'Belum Dinilai', 'value' => $stats['pending'], 'icon' => 'fa-clock', 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500'],
            ['title' => 'Total Tersubmit', 'value' => $stats['submitted'], 'icon' => 'fa-paper-plane', 'bg' => 'bg-violet-50', 'icon_color' => 'text-violet-500'],
        ];
        ?>
        <?php foreach ($statItems as $index => $stat): ?>
        <div class="card-premium p-3 sm:p-5 flex items-center gap-3 sm:gap-4 animate-stagger delay-<?= ($index + 1) * 100 ?>" @mousemove="handleMouseMove">
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
    <div class="space-y-3 animate-stagger delay-300">
        <div class="flex flex-wrap gap-2">
            <a href="<?= base_url('penilai/pitching-desk') ?>"
               class="btn-outline btn-sm <?= !$statusFilter ? 'bg-sky-500 text-white border-sky-500 hover:bg-sky-600' : '' ?>">
                Semua
            </a>
            <a href="<?= base_url('penilai/pitching-desk?status=pending') ?>"
               class="btn-outline btn-sm <?= $statusFilter === 'pending' ? 'bg-yellow-500 text-white border-yellow-500 hover:bg-yellow-600' : '' ?>">
                <i class="fas fa-clock mr-1"></i> Pending
            </a>
            <a href="<?= base_url('penilai/pitching-desk?status=approved') ?>"
               class="btn-outline btn-sm <?= $statusFilter === 'approved' ? 'bg-emerald-500 text-white border-emerald-500 hover:bg-emerald-600' : '' ?>">
                <i class="fas fa-check mr-1"></i> Lolos
            </a>
            <a href="<?= base_url('penilai/pitching-desk?status=rejected') ?>"
               class="btn-outline btn-sm <?= $statusFilter === 'rejected' ? 'bg-rose-500 text-white border-rose-500 hover:bg-rose-600' : '' ?>">
                <i class="fas fa-circle-xmark mr-1"></i> Tdk Lolos
            </a>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori:</span>
            <a href="<?= base_url('penilai/pitching-desk?' . http_build_query(array_filter(['status' => $statusFilter]))) ?>"
               class="btn-outline btn-sm <?= !$kategoriFilter ? 'bg-slate-700 text-white border-slate-700 hover:bg-slate-800' : '' ?>">
                Semua
            </a>
            <a href="<?= base_url('penilai/pitching-desk?' . http_build_query(array_filter(['status' => $statusFilter, 'kategori' => 'pemula']))) ?>"
               class="btn-outline btn-sm <?= $kategoriFilter === 'pemula' ? 'bg-sky-500 text-white border-sky-500 hover:bg-sky-600' : '' ?>">
                <i class="fas fa-rocket mr-1"></i> Pemula
            </a>
            <a href="<?= base_url('penilai/pitching-desk?' . http_build_query(array_filter(['status' => $statusFilter, 'kategori' => 'berkembang']))) ?>"
               class="btn-outline btn-sm <?= $kategoriFilter === 'berkembang' ? 'bg-violet-500 text-white border-violet-500 hover:bg-violet-600' : '' ?>">
                <i class="fas fa-chart-line mr-1"></i> Berkembang
            </a>
        </div>
    </div>

    <!-- ================================================================
         4. PROPOSALS TABLE
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-500" @mousemove="handleMouseMove">
        
        <div class="px-4 sm:px-7 py-4 sm:py-5 border-b border-sky-50 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white/60">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">Daftar Penilaian Pitching</h3>
                <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5">
                    Proposal yang sudah dikirim mahasiswa dan siap dinilai
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="pmw-table">
                <thead>
                    <tr>
                        <th class="text-center w-10">#</th>
                        <th>Tim / Usaha</th>
                        <th>Ketua</th>
                        <th>Kategori</th>
                        <th class="text-center">Link Video</th>
                        <th class="text-center">PPT/PDF</th>
                        <th class="text-center">Nilai Saya</th>
                        <th class="text-center">Nilai Rata-rata</th>
                        <th>Status</th>
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
                    $no = 1;
                    ?>
                    <?php foreach ($proposals as $proposal): ?>
                    <tr class="group">
                        <td class="text-center text-[11px] font-bold text-slate-400 tabular-nums"><?= $no++ ?></td>
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
                            <?php $kat = $proposal['kategori_wirausaha'] ?? null; ?>
                            <?php if ($kat === 'pemula'): ?>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-sky-50 text-sky-600 border border-sky-200">
                                    <i class="fas fa-rocket text-[9px]"></i> Pemula
                                </span>
                            <?php elseif ($kat === 'berkembang'): ?>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-violet-50 text-violet-600 border border-violet-200">
                                    <i class="fas fa-chart-line text-[9px]"></i> Berkembang
                                </span>
                            <?php else: ?>
                                <span class="text-[10px] text-slate-300">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($proposal['video_url']): ?>
                                <a href="<?= esc($proposal['video_url']) ?>" target="_blank" class="text-sky-500 hover:text-sky-600">
                                    <i class="fas fa-play-circle text-xl"></i>
                                </a>
                            <?php else: ?>
                                <span class="text-slate-300"><i class="fas fa-minus"></i></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($proposal['pitching_ppt_id']): ?>
                                <a href="<?= base_url('penilai/pitching-desk/doc/' . $proposal['pitching_ppt_id']) ?>" class="text-orange-500 hover:text-orange-600">
                                    <i class="fas fa-file-powerpoint text-xl"></i>
                                </a>
                            <?php else: ?>
                                <i class="fas fa-file-powerpoint text-xl text-slate-300"></i>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($proposal['has_submitted']): ?>
                                <?php
                                $myScore = (float)$proposal['my_score'];
                                $myScoreCls = $myScore >= 80 ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-rose-50 text-rose-600 border-rose-200';
                                $myIcon = $myScore >= 80 ? 'fa-trophy' : 'fa-circle-xmark';
                                ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[12px] font-black border <?= $myScoreCls ?>">
                                    <i class="fas <?= $myIcon ?> text-[10px]"></i>
                                    <?= number_format($myScore, 2) ?>
                                </span>
                            <?php else: ?>
                                <span class="text-[11px] text-slate-300">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php $nilai = $proposal['pitching_persentase_nilai'] ?? null; ?>
                            <?php if ($nilai !== null && $nilai !== ''): ?>
                                <?php
                                $nv = (float)$nilai;
                                $nilaiCls = $nv >= 80 ? 'bg-emerald-50 text-emerald-600 border-emerald-200'
                                    : 'bg-rose-50 text-rose-600 border-rose-200';
                                $iconNilai = $nv >= 80 ? 'fa-trophy' : 'fa-circle-xmark';
                                ?>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[12px] font-black border <?= $nilaiCls ?>">
                                    <i class="fas <?= $iconNilai ?> text-[10px]"></i>
                                    <?= number_format($nv, 2) ?>
                                </span>
                            <?php else: ?>
                                <span class="text-[11px] text-slate-300">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php 
                            $effStatus = $proposal['pitching_admin_status'];
                            $effLabel = $statusLabels[$effStatus];
                            $effColor = $statusColors[$effStatus];
                            
                            if ($effStatus === 'pending' && !empty($proposal['student_submitted_at'])) {
                                $effLabel = 'Siap Dinilai';
                                $effColor = 'bg-sky-500 text-white border-sky-600 shadow-sm';
                            } elseif ($effStatus === 'pending') {
                                $effLabel = 'Belum Kirim';
                                $effColor = 'bg-slate-100 text-slate-500 border-slate-200';
                            }
                            ?>
                            <span class="pmw-status <?= $effColor ?>">
                                <?= $effLabel ?>
                            </span>
                        </td>
                        <td class="text-right whitespace-nowrap">
                            <a href="<?= base_url('penilai/pitching-desk/' . $proposal['id']) ?>" 
                               class="btn-outline btn-sm bg-violet-50 text-violet-600 border-violet-200 hover:bg-violet-500 hover:text-white transition-all">
                                <i class="fas fa-eye mr-1.5"></i> Detail & Validasi
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php if (empty($proposals)): ?>
                    <tr>
                        <td colspan="9" class="text-center py-12">
                            <div class="text-(--text-muted)">
                                <i class="fas fa-inbox text-4xl mb-3 opacity-30"></i>
                                <p class="text-sm">Tidak ada tim bimbingan yang membutuhkan validasi akhir saat ini.</p>
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
