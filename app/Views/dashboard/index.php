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
                            <th><?= (in_array($mainRole, ['dosen', 'mentor'])) ? 'Ketua & Tim' : 'ID / Tim' ?></th>
                            <th>Kategori</th>
                            <th>Progres</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $proposals = $proposals ?? [];

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
                            <!-- ID & Team / Leader & Team -->
                            <td>
                                <?php if (in_array($mainRole, ['dosen', 'mentor'])): ?>
                                    <div class="font-display font-bold text-(--text-heading) text-[13px]">
                                        <?= esc($row['leader'] ?? '-') ?>
                                    </div>
                                    <div class="text-[11px] text-sky-500 font-bold uppercase tracking-wider mt-0.5">
                                        <?= esc($row['team']) ?>
                                    </div>
                                <?php else: ?>
                                    <div class="font-display font-bold text-(--text-heading) text-[13px] italic">
                                        <?= esc($row['id']) ?>
                                    </div>
                                    <div class="text-xs text-(--text-muted) font-medium mt-0.5">
                                        <?= esc($row['team']) ?> &middot; <?= esc($row['date']) ?>
                                    </div>
                                <?php endif; ?>
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

            <!-- Notifications & Announcements Slider -->
            <div class="card-premium p-6 animate-stagger delay-600 overflow-hidden" x-data="{ 
                activeSlide: 0, 
                slides: <?= count($updates) ?>,
                next() { this.activeSlide = (this.activeSlide + 1) % this.slides },
                prev() { this.activeSlide = (this.activeSlide - 1 + this.slides) % this.slides }
            }">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="font-display text-sm font-bold text-(--text-heading)">Update Terbaru</h3>
                    
                    <!-- Slider Navigation -->
                    <div class="flex items-center gap-1.5" x-show="slides > 1">
                        <button @click="prev()" class="w-6 h-6 rounded-lg bg-white border border-sky-100 flex items-center justify-center text-slate-400 hover:text-sky-500 hover:border-sky-200 transition-all">
                            <i class="fas fa-chevron-left text-[10px]"></i>
                        </button>
                        <button @click="next()" class="w-6 h-6 rounded-lg bg-white border border-sky-100 flex items-center justify-center text-slate-400 hover:text-sky-500 hover:border-sky-200 transition-all">
                            <i class="fas fa-chevron-right text-[10px]"></i>
                        </button>
                    </div>
                </div>

                <!-- Slider Content -->
                <div class="relative min-h-[140px]">
                    <?php if (empty($updates)): ?>
                        <div class="flex flex-col items-center justify-center py-8 text-center">
                            <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center mb-3">
                                <i class="fas fa-bell-slash text-slate-300"></i>
                            </div>
                            <p class="text-xs font-medium text-slate-400">Belum ada update terbaru</p>
                        </div>
                    <?php else: ?>
                        <div class="flex transition-transform duration-500 ease-out h-full" :style="`transform: translateX(-${activeSlide * 100}%)`" style="display: flex;">
                            <?php foreach ($updates as $update): ?>
                            <div class="w-full shrink-0 px-1">
                                <div class="bg-slate-50/50 border border-white/50 rounded-2xl p-4 h-full flex flex-col justify-between group">
                                    <div class="flex items-start gap-3">
                                        <div class="w-9 h-9 rounded-xl <?= $update['color'] ?> flex items-center justify-center shrink-0 shadow-sm group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas <?= $update['icon'] ?> text-xs"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <span class="text-[10px] font-black <?= str_contains($update['color'], 'violet') ? 'text-violet-500' : 'text-sky-500' ?> uppercase tracking-widest block mb-1">
                                                <?= $update['type'] === 'announcement' ? 'Pengumuman' : 'Notifikasi' ?>
                                            </span>
                                            <h4 class="text-xs font-bold text-(--text-heading) leading-snug line-clamp-2">
                                                <?= esc($update['title']) ?>
                                            </h4>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 flex items-center justify-between pt-3 border-t border-white/60">
                                        <span class="text-[10px] font-semibold text-slate-400">
                                            <i class="far fa-clock mr-1"></i> <?= $update['time'] ?>
                                        </span>
                                        <a href="<?= base_url($update['url']) ?>" class="text-[10px] font-black text-sky-500 hover:text-sky-600 flex items-center gap-1 group/btn">
                                            Buka <i class="fas fa-arrow-right text-[8px] transition-transform group-hover/btn:translate-x-0.5"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Slide Indicators -->
                <div class="flex justify-center gap-1.5 mt-5" x-show="slides > 1">
                    <template x-for="i in slides" :key="i">
                        <button 
                            @click="activeSlide = i-1"
                            class="h-1 rounded-full transition-all duration-300"
                            :class="activeSlide === i-1 ? 'w-4 bg-sky-500' : 'w-1.5 bg-slate-200'"
                        ></button>
                    </template>
                </div>
            </div>

        </div><!-- /side panel -->

    </div><!-- /main content row -->

</div><!-- /page wrapper -->

<?= $this->endSection() ?>