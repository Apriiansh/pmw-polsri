<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

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
         Layout: [Total Pendanaan (wide)] [Tim Aktif] [Success Rate]
                 [Proposal Masuk] [Proposal Disetujui]
    ================================================================= -->
    <?php
    // Data can be passed from controller. This is the fallback:
    $stats = $stats ?? [
        [
            'title'   => 'Total Anggaran Pendanaan',
            'value'   => 'Rp 450.000.000',
            'icon'    => 'fa-wallet',
            'trend'   => '+12.5%',
            'trend_up'=> true,
            'bg'      => 'bg-sky-50',
            'icon_color' => 'text-sky-500',
            'span'    => 'col-span-1 md:col-span-2',
        ],
        [
            'title'   => 'Tim Aktif',
            'value'   => '124',
            'icon'    => 'fa-users-gear',
            'trend'   => '+4 Unit',
            'trend_up'=> true,
            'bg'      => 'bg-teal-50',
            'icon_color' => 'text-teal-500',
            'span'    => 'col-span-1',
        ],
        [
            'title'   => 'Success Rate',
            'value'   => '78%',
            'icon'    => 'fa-chart-pie',
            'trend'   => '+2.1%',
            'trend_up'=> true,
            'bg'      => 'bg-yellow-50',
            'icon_color' => 'text-yellow-500',
            'span'    => 'col-span-1',
        ],
        [
            'title'   => 'Proposal Masuk',
            'value'   => '58',
            'icon'    => 'fa-file-circle-plus',
            'trend'   => 'Semester ini',
            'trend_up'=> null,
            'bg'      => 'bg-violet-50',
            'icon_color' => 'text-violet-500',
            'span'    => 'col-span-1',
        ],
        [
            'title'   => 'Proposal Disetujui',
            'value'   => '45',
            'icon'    => 'fa-file-circle-check',
            'trend'   => '77,6%',
            'trend_up'=> true,
            'bg'      => 'bg-emerald-50',
            'icon_color' => 'text-emerald-500',
            'span'    => 'col-span-1',
        ],
    ];
    ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <?php foreach ($stats as $index => $stat): ?>
        <div class="card-premium p-6 flex flex-col justify-between animate-stagger delay-<?= ($index + 1) * 100 ?> group <?= $stat['span'] ?>">

            <!-- Top row: Icon + Trend badge -->
            <div class="flex items-start justify-between">
                <!-- Icon -->
                <div class="w-12 h-12 rounded-2xl <?= $stat['bg'] ?> flex items-center justify-center icon-elevate">
                    <i class="fas <?= $stat['icon'] ?> text-xl <?= $stat['icon_color'] ?>"></i>
                </div>

                <!-- Trend badge -->
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

            <!-- Bottom row: Value + Label -->
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
         3. MAIN CONTENT ROW: Table (wide) + Quick Info (narrow)
    ================================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        <!-- ─── PROPOSALS TABLE (2/3 width) ─────────────────────────── -->
        <div class="lg:col-span-2 card-premium overflow-hidden animate-stagger delay-400">

            <!-- Card Header -->
            <div class="px-7 py-5 border-b border-sky-50 flex items-center justify-between bg-white/60">
                <div>
                    <h3 class="font-display text-base font-bold text-(--text-heading)"><?= $tableTitle ?></h3>
                    <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5"><?= $tableSubtitle ?></p>
                </div>
                <a href="<?= base_url($quickActions[0]['url'] ?? 'dashboard') ?>" class="btn-outline btn-sm gap-2">
                    Lihat Semua
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="pmw-table">
                    <thead>
                        <tr>
                            <th>ID / Tim</th>
                            <th>Kategori</th>
                            <th>Progres</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $proposals = $proposals ?? [
                            ['id' => 'PMW-26-001', 'team' => 'TechNova Solutions',  'category' => 'Teknologi Digital',  'progress' => 100, 'status' => 'Disetujui', 'date' => '12 Apr 2026'],
                            ['id' => 'PMW-26-002', 'team' => 'EcoBite Culinary',    'category' => 'Kuliner Kreatif',    'progress' => 45,  'status' => 'Review',    'date' => '10 Apr 2026'],
                            ['id' => 'PMW-26-003', 'team' => 'AgroSmart Polsri',    'category' => 'Agrobisnis',         'progress' => 100, 'status' => 'Disetujui', 'date' => '08 Apr 2026'],
                            ['id' => 'PMW-26-004', 'team' => 'KriyaLokal Art',      'category' => 'Industri Kreatif',   'progress' => 75,  'status' => 'Revisi',    'date' => '05 Apr 2026'],
                            ['id' => 'PMW-26-005', 'team' => 'HealthPulse Team',    'category' => 'Kesehatan',          'progress' => 20,  'status' => 'Review',    'date' => '02 Apr 2026'],
                        ];

                        foreach ($proposals as $row):
                            // Progress bar color
                            $barColor = $row['progress'] == 100
                                ? 'bg-emerald-400'
                                : ($row['progress'] >= 60 ? 'bg-sky-400' : ($row['progress'] >= 30 ? 'bg-yellow-400' : 'bg-rose-400'));

                            // Status badge
                            $statusClass = match($row['status']) {
                                'Disetujui' => 'pmw-status pmw-status-success',
                                'Review'    => 'pmw-status pmw-status-info',
                                'Revisi'    => 'pmw-status pmw-status-warning',
                                default     => 'pmw-status pmw-status-danger',
                            };

                            $statusIcon = match($row['status']) {
                                'Disetujui' => 'fa-circle-check',
                                'Review'    => 'fa-clock',
                                'Revisi'    => 'fa-pen',
                                default     => 'fa-circle-xmark',
                            };
                        ?>
                        <tr class="group">
                            <!-- ID & Team -->
                            <td>
                                <div class="font-display font-bold text-(--text-heading) text-[13px] italic">
                                    <?= esc($row['id']) ?>
                                </div>
                                <div class="text-xs text-(--text-muted) font-medium mt-0.5">
                                    <?= esc($row['team']) ?> &middot; <?= esc($row['date']) ?>
                                </div>
                            </td>

                            <!-- Category -->
                            <td>
                                <span class="text-xs font-bold text-(--text-body) uppercase tracking-wide">
                                    <?= esc($row['category']) ?>
                                </span>
                            </td>

                            <!-- Progress -->
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="progress-bar w-24">
                                        <div
                                            class="progress-bar-fill <?= $barColor ?>"
                                            style="--progress-value: <?= $row['progress'] ?>%; width: <?= $row['progress'] ?>%;"
                                        ></div>
                                    </div>
                                    <span class="text-[11px] font-black text-(--text-muted) w-8 tabular-nums">
                                        <?= $row['progress'] ?>%
                                    </span>
                                </div>
                            </td>

                            <!-- Status Badge -->
                            <td>
                                <span class="<?= $statusClass ?> group-hover:scale-105">
                                    <i class="fas <?= $statusIcon ?> text-[10px]"></i>
                                    <?= esc($row['status']) ?>
                                </span>
                            </td>

                            <!-- Action -->
                            <td class="text-right">
                                <button class="
                                    opacity-0 translate-x-3
                                    group-hover:opacity-100 group-hover:translate-x-0
                                    transition-all duration-300
                                    w-9 h-9 flex items-center justify-center ml-auto
                                    bg-white border border-sky-100 rounded-xl
                                    text-slate-400 hover:text-sky-500 hover:border-sky-300
                                    shadow-sm hover:shadow-sky-100
                                ">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- ─── SIDE PANEL (1/3 width) ───────────────────────────────── -->
        <div class="space-y-5">

            <!-- Quick Actions card -->
            <div class="card-premium p-6 animate-stagger delay-500">
                <h3 class="font-display text-sm font-bold text-(--text-heading) mb-4">Aksi Cepat</h3>
                <div class="space-y-2.5">
                    <?php foreach ($quickActions as $index => $action): ?>
                    <a href="<?= base_url($action['url']) ?>" class="<?= $action['style'] ?> w-full justify-start gap-3 <?= $action['style'] === 'btn-ghost' ? 'text-slate-500' : '' ?>">
                        <i class="fas <?= $action['icon'] ?> text-base"></i>
                        <?= $action['label'] ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Activity Feed card -->
            <div class="card-premium p-6 animate-stagger delay-600">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="font-display text-sm font-bold text-(--text-heading)]">Aktivitas Terbaru</h3>
                    <span class="text-[10px] font-black text-sky-400 uppercase tracking-widest">Live</span>
                </div>

                <div class="space-y-4">
                    <?php
                    $activities = $activities ?? [
                        ['icon' => 'fa-file-circle-check', 'color' => 'text-emerald-500 bg-emerald-50', 'text' => 'TechNova Solutions disetujui', 'time' => '2 menit lalu'],
                        ['icon' => 'fa-comment-dots',       'color' => 'text-sky-500 bg-sky-50',         'text' => 'Komentar baru pada EcoBite', 'time' => '15 menit lalu'],
                        ['icon' => 'fa-rotate',             'color' => 'text-yellow-500 bg-yellow-50',   'text' => 'KriyaLokal diminta revisi',  'time' => '1 jam lalu'],
                        ['icon' => 'fa-user-plus',          'color' => 'text-violet-500 bg-violet-50',   'text' => 'Mentor baru ditambahkan',    'time' => '3 jam lalu'],
                    ];

                    foreach ($activities as $act):
                    ?>
                    <div class="flex items-start gap-3 group">
                        <div class="w-8 h-8 rounded-xl <?= $act['color'] ?> flex items-center justify-center shrink-0 mt-0.5 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas <?= $act['icon'] ?> text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-semibold text-(--text-body)] leading-snug">
                                <?= esc($act['text']) ?>
                            </p>
                            <p class="text-[10px] text-(--text-muted)] mt-0.5 font-medium">
                                <?= esc($act['time']) ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div><!-- /side panel -->

    </div><!-- /main content row -->

</div><!-- /page wrapper -->

<?= $this->endSection() ?>