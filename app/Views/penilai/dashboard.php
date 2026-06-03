<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$katBadge = [
    'pemula'    => ['bg-sky-50 text-sky-600 border-sky-200', 'Pemula', 'fa-rocket'],
    'berkembang'=> ['bg-violet-50 text-violet-600 border-violet-200', 'Berkembang', 'fa-chart-line'],
];

function medalClass(int $rank): array {
    return match (true) {
        $rank === 1 => ['bg-yellow-100 text-yellow-700 border-yellow-200', 'fa-trophy', 'Juara 1'],
        $rank === 2 => ['bg-slate-100 text-slate-700 border-slate-200', 'fa-medal', 'Juara 2'],
        $rank === 3 => ['bg-orange-100 text-orange-700 border-orange-200', 'fa-medal', 'Juara 3'],
        default     => ['bg-white text-slate-500 border-slate-200', 'fa-hashtag', '#' . $rank],
    };
}
?>

<div class="space-y-8">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="animate-stagger">
        <h2 class="section-title">
            <?= $header_title ?>
        </h2>
        <p class="section-subtitle"><?= $header_subtitle ?></p>
    </div>

    <!-- ================================================================
         2. BENTO STATS GRID
    ================================================================= -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <?php foreach ($stats as $index => $stat): ?>
        <div class="card-premium p-6 flex flex-col justify-between animate-stagger delay-<?= ($index + 1) * 100 ?> group <?= $stat['span'] ?>">

            <div class="flex items-start justify-between">
                <div class="w-12 h-12 rounded-2xl <?= $stat['bg'] ?> flex items-center justify-center icon-elevate">
                    <i class="fas <?= $stat['icon'] ?> text-xl <?= $stat['icon_color'] ?>"></i>
                </div>

                <?php if ($stat['trend_up'] === true): ?>
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-black text-emerald-600 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-full">
                        <i class="fas fa-arrow-trend-up text-[9px]"></i>
                        <?= esc($stat['trend']) ?>
                    </span>
                <?php elseif ($stat['trend_up'] === false): ?>
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-black text-rose-600 bg-rose-50 border border-rose-100 px-2.5 py-1 rounded-full">
                        <i class="fas fa-arrow-trend-down text-[9px]"></i>
                        <?= esc($stat['trend']) ?>
                    </span>
                <?php else: ?>
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-black text-sky-600 bg-sky-50 border border-sky-100 px-2.5 py-1 rounded-full">
                        <?= esc($stat['trend']) ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="mt-8">
                <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.15em]">
                    <?= esc($stat['title']) ?>
                </p>
                <h3 class="font-display text-3xl font-black text-(--text-heading) mt-1.5 tracking-tight leading-none">
                    <?= esc($stat['value']) ?>
                </h3>
            </div>

        </div>
        <?php endforeach; ?>
    </div>

    <!-- ================================================================
         3. QUICK ACTIONS
    ================================================================= -->
    <div class="card-premium p-6 animate-stagger delay-500">
        <h3 class="font-display text-sm font-bold text-(--text-heading) mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <?php foreach ($quickActions as $action): ?>
            <a href="<?= base_url($action['url']) ?>" class="<?= $action['style'] ?> w-full justify-start gap-3">
                <i class="fas <?= $action['icon'] ?> text-base"></i>
                <?= esc($action['label']) ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ================================================================
         4. RANKING BOARDS (Pemula + Berkembang)
    ================================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

        <!-- PEMULA -->
        <div class="card-premium overflow-hidden animate-stagger delay-600" x-data="{ expanded: false }">
            <div class="px-6 py-5 border-b border-sky-50 flex items-center justify-between bg-white/60">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-500 flex items-center justify-center">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div>
                        <h3 class="font-display text-base font-bold text-(--text-heading)">Juara Pitching &mdash; Pemula</h3>
                        <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5">Top 10 tim dengan persentase nilai tertinggi</p>
                    </div>
                </div>
                <a href="<?= base_url('penilai/pitching-desk?status=approved&kategori=pemula') ?>" class="btn-outline btn-sm">
                    Lihat Semua
                </a>
            </div>

            <?php if (empty($ranking_pemula)): ?>
                <div class="p-10 text-center text-slate-400">
                    <i class="fas fa-trophy text-3xl mb-3 opacity-30"></i>
                    <p class="text-sm font-semibold">Belum ada juara untuk kategori Pemula</p>
                    <p class="text-[11px] mt-1">Berikan nilai pitching terlebih dahulu untuk melihat ranking</p>
                </div>
            <?php else: ?>
                <div class="divide-y divide-slate-50">
                    <?php foreach (array_slice($ranking_pemula, 0, 5) as $i => $row):
                        $rank = $i + 1;
                        [$mc, $mi, $mlabel] = medalClass($rank);
                    ?>
                    <a href="<?= base_url('penilai/pitching-desk/' . $row['id']) ?>" class="flex items-center gap-3 px-6 py-3 hover:bg-sky-50/50 transition-colors group">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl border-2 <?= $mc ?> shrink-0">
                            <i class="fas <?= $mi ?> text-sm"></i>
                        </span>
                        <div class="flex-1 min-w-0">
                            <div class="font-display font-bold text-(--text-heading) text-[13px] truncate">
                                <?= esc($row['nama_usaha'] ?: 'Tim #' . $row['id']) ?>
                            </div>
                            <div class="text-[11px] text-(--text-muted) truncate">
                                <?= esc($row['ketua_nama'] ?? '-') ?> &middot; <?= esc($row['period_name'] ?? '-') ?>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <div class="font-display text-lg font-black text-(--text-heading) tabular-nums">
                                <?= number_format((float)$row['persentase_nilai'], 2) ?>
                            </div>
                            <div class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Nilai</div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>

                <?php if (count($ranking_pemula) > 5): ?>
                <div x-show="expanded" x-cloak class="divide-y divide-slate-50 border-t border-slate-100">
                    <?php foreach (array_slice($ranking_pemula, 5) as $i => $row):
                        $rank = $i + 6;
                        [$mc, $mi, $mlabel] = medalClass($rank);
                    ?>
                    <a href="<?= base_url('penilai/pitching-desk/' . $row['id']) ?>" class="flex items-center gap-3 px-6 py-3 hover:bg-sky-50/50 transition-colors group">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl border-2 <?= $mc ?> shrink-0 text-[11px] font-black">
                            #<?= $rank ?>
                        </span>
                        <div class="flex-1 min-w-0">
                            <div class="font-display font-bold text-(--text-heading) text-[13px] truncate">
                                <?= esc($row['nama_usaha'] ?: 'Tim #' . $row['id']) ?>
                            </div>
                            <div class="text-[11px] text-(--text-muted) truncate">
                                <?= esc($row['ketua_nama'] ?? '-') ?>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <div class="font-display text-base font-black text-(--text-heading) tabular-nums">
                                <?= number_format((float)$row['persentase_nilai'], 2) ?>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
                <div class="px-6 py-3 border-t border-slate-100 bg-slate-50/30 text-center">
                    <button @click="expanded = !expanded" class="text-[11px] font-black uppercase tracking-widest text-sky-500 hover:text-sky-600">
                        <span x-show="!expanded">Tampilkan Semua (<?= count($ranking_pemula) ?>) <i class="fas fa-chevron-down ml-1"></i></span>
                        <span x-show="expanded" x-cloak>Sembunyikan <i class="fas fa-chevron-up ml-1"></i></span>
                    </button>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- BERKEMBANG -->
        <div class="card-premium overflow-hidden animate-stagger delay-700" x-data="{ expanded: false }">
            <div class="px-6 py-5 border-b border-sky-50 flex items-center justify-between bg-white/60">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-500 flex items-center justify-center">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <h3 class="font-display text-base font-bold text-(--text-heading)">Juara Pitching &mdash; Berkembang</h3>
                        <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5">Top 10 tim dengan persentase nilai tertinggi</p>
                    </div>
                </div>
                <a href="<?= base_url('penilai/pitching-desk?status=approved&kategori=berkembang') ?>" class="btn-outline btn-sm">
                    Lihat Semua
                </a>
            </div>

            <?php if (empty($ranking_berkembang)): ?>
                <div class="p-10 text-center text-slate-400">
                    <i class="fas fa-trophy text-3xl mb-3 opacity-30"></i>
                    <p class="text-sm font-semibold">Belum ada juara untuk kategori Berkembang</p>
                    <p class="text-[11px] mt-1">Berikan nilai pitching terlebih dahulu untuk melihat ranking</p>
                </div>
            <?php else: ?>
                <div class="divide-y divide-slate-50">
                    <?php foreach (array_slice($ranking_berkembang, 0, 5) as $i => $row):
                        $rank = $i + 1;
                        [$mc, $mi, $mlabel] = medalClass($rank);
                    ?>
                    <a href="<?= base_url('penilai/pitching-desk/' . $row['id']) ?>" class="flex items-center gap-3 px-6 py-3 hover:bg-violet-50/50 transition-colors group">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl border-2 <?= $mc ?> shrink-0">
                            <i class="fas <?= $mi ?> text-sm"></i>
                        </span>
                        <div class="flex-1 min-w-0">
                            <div class="font-display font-bold text-(--text-heading) text-[13px] truncate">
                                <?= esc($row['nama_usaha'] ?: 'Tim #' . $row['id']) ?>
                            </div>
                            <div class="text-[11px] text-(--text-muted) truncate">
                                <?= esc($row['ketua_nama'] ?? '-') ?> &middot; <?= esc($row['period_name'] ?? '-') ?>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <div class="font-display text-lg font-black text-(--text-heading) tabular-nums">
                                <?= number_format((float)$row['persentase_nilai'], 2) ?>
                            </div>
                            <div class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Nilai</div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>

                <?php if (count($ranking_berkembang) > 5): ?>
                <div x-show="expanded" x-cloak class="divide-y divide-slate-50 border-t border-slate-100">
                    <?php foreach (array_slice($ranking_berkembang, 5) as $i => $row):
                        $rank = $i + 6;
                        [$mc, $mi, $mlabel] = medalClass($rank);
                    ?>
                    <a href="<?= base_url('penilai/pitching-desk/' . $row['id']) ?>" class="flex items-center gap-3 px-6 py-3 hover:bg-violet-50/50 transition-colors group">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl border-2 <?= $mc ?> shrink-0 text-[11px] font-black">
                            #<?= $rank ?>
                        </span>
                        <div class="flex-1 min-w-0">
                            <div class="font-display font-bold text-(--text-heading) text-[13px] truncate">
                                <?= esc($row['nama_usaha'] ?: 'Tim #' . $row['id']) ?>
                            </div>
                            <div class="text-[11px] text-(--text-muted) truncate">
                                <?= esc($row['ketua_nama'] ?? '-') ?>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <div class="font-display text-base font-black text-(--text-heading) tabular-nums">
                                <?= number_format((float)$row['persentase_nilai'], 2) ?>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
                <div class="px-6 py-3 border-t border-slate-100 bg-slate-50/30 text-center">
                    <button @click="expanded = !expanded" class="text-[11px] font-black uppercase tracking-widest text-violet-500 hover:text-violet-600">
                        <span x-show="!expanded">Tampilkan Semua (<?= count($ranking_berkembang) ?>) <i class="fas fa-chevron-down ml-1"></i></span>
                        <span x-show="expanded" x-cloak>Sembunyikan <i class="fas fa-chevron-up ml-1"></i></span>
                    </button>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- ================================================================
         5. RECENT ACTIVITY
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-800">
        <div class="px-6 py-5 border-b border-sky-50 flex items-center justify-between bg-white/60">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">Aktivitas Penilaian Terbaru</h3>
                <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5">5 tim terakhir yang divalidasi</p>
            </div>
            <a href="<?= base_url('penilai/pitching-desk') ?>" class="btn-outline btn-sm gap-2">
                Lihat Semua
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <?php if (empty($recent)): ?>
            <div class="p-12 text-center text-slate-400">
                <i class="fas fa-inbox text-3xl mb-3 opacity-30"></i>
                <p class="text-sm font-semibold">Belum ada aktivitas penilaian</p>
            </div>
        <?php else: ?>
        <div class="overflow-x-auto">
            <table class="pmw-table">
                <thead>
                    <tr>
                        <th>Tim / Usaha</th>
                        <th>Ketua</th>
                        <th>Kategori</th>
                        <th class="text-center">Nilai Rata-rata</th>
                        <th class="text-center">Nilai Saya</th>
                        <th>Status</th>
                        <th>Update</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $statusColor = [
                        'approved' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                        'revision' => 'bg-orange-50 text-orange-600 border-orange-200',
                        'rejected' => 'bg-rose-50 text-rose-600 border-rose-200',
                    ];
                    $statusLabel = [
                        'approved' => 'Lolos',
                        'revision' => 'Revisi',
                        'rejected' => 'Tidak Lolos',
                    ];
                    foreach ($recent as $row):
                        $katKey = $row['kategori_wirausaha'] ?? null;
                        [$katBg, $katText, $katIcon] = $katBadge[$katKey] ?? ['bg-slate-50 text-slate-500 border-slate-200', '-', 'fa-circle'];
                    ?>
                    <tr class="group">
                        <td>
                            <div class="font-display font-bold text-(--text-heading) text-[13px]">
                                <?= esc($row['nama_usaha'] ?: 'Tim #' . $row['id']) ?>
                            </div>
                        </td>
                        <td>
                            <div class="text-[12px] font-semibold text-slate-600"><?= esc($row['ketua_nama'] ?? '-') ?></div>
                        </td>
                        <td>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold border <?= $katBg ?>">
                                <i class="fas <?= $katIcon ?> text-[9px]"></i> <?= $katText ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <?php if (!empty($row['persentase_nilai'])): ?>
                                <span class="font-display text-[14px] font-black text-(--text-heading) tabular-nums">
                                    <?= number_format((float)$row['persentase_nilai'], 2) ?>
                                </span>
                            <?php else: ?>
                                <span class="text-slate-300">&mdash;</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if (!empty($row['my_score'])): ?>
                                <span class="font-display text-[14px] font-black text-emerald-600 tabular-nums">
                                    <?= number_format((float)$row['my_score'], 2) ?>
                                </span>
                            <?php else: ?>
                                <span class="text-slate-300">&mdash;</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php
                            $stKey = $row['status'] ?? 'pending';
                            $stClass = $statusColor[$stKey] ?? 'bg-slate-50 text-slate-500 border-slate-200';
                            $stLabel = $statusLabel[$stKey] ?? ucfirst($stKey);
                            ?>
                            <span class="pmw-status <?= $stClass ?>">
                                <?= $stLabel ?>
                            </span>
                        </td>
                        <td>
                            <div class="text-[11px] text-(--text-muted)">
                                <?= !empty($row['updated_at']) ? time_elapsed_string($row['updated_at']) : '-' ?>
                            </div>
                        </td>
                        <td class="text-right">
                            <a href="<?= base_url('penilai/pitching-desk/' . $row['id']) ?>" class="btn-outline btn-sm bg-sky-50 text-sky-600 border-sky-200 hover:bg-sky-500 hover:text-white transition-all">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>
