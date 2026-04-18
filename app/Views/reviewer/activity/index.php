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

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Monitoring <span class="text-gradient">Kegiatan Wirausaha</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Halaman Reviewer — Dokumentasi Kunjungan Lapangan</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <?php
        $stats = [
            'total'     => count($schedules),
            'reviewed'  => count(array_filter($schedules, fn($s) => isset($s->logbook->reviewer_at))),
            'pending'   => count(array_filter($schedules, fn($s) => !isset($s->logbook->reviewer_at))),
        ];
        $statItems = [
            ['title' => 'Total Jadwal', 'value' => $stats['total'], 'icon' => 'fa-calendar-alt', 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500'],
            ['title' => 'Telah Direview', 'value' => $stats['reviewed'], 'icon' => 'fa-camera', 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500'],
            ['title' => 'Belum Direview', 'value' => $stats['pending'], 'icon' => 'fa-clock', 'bg' => 'bg-amber-50', 'icon_color' => 'text-amber-500'],
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

    <!-- Schedules Table -->
    <div class="card-premium overflow-hidden animate-stagger delay-500" @mousemove="handleMouseMove">
        <div class="px-6 py-4 border-b border-sky-50 flex items-center justify-between bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">Daftar Jadwal Monitoring</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="pmw-table">
                <thead>
                    <tr>
                        <th>Tanggal & Kategori</th>
                        <th>Tim</th>
                        <th>Lokasi</th>
                        <th>Status Monitoring</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($schedules)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="text-slate-400">
                                    <i class="fas fa-calendar-xmark text-4xl mb-3 opacity-20"></i>
                                    <p class="text-sm">Belum ada jadwal kegiatan.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($schedules as $schedule): ?>
                        <tr class="group">
                            <td class="whitespace-nowrap">
                                <div class="text-[12px] font-bold text-(--text-heading)"><?= date('d M Y', strtotime($schedule->activity_date)) ?></div>
                                <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded bg-violet-100 text-violet-700 mt-1 inline-block"><?= esc($schedule->activity_category) ?></span>
                            </td>
                            <td>
                                <div class="text-[12px] font-semibold text-slate-700"><?= esc($schedule->nama_usaha) ?></div>
                                <div class="text-[11px] text-slate-400"><?= esc($schedule->ketua_nama ?? '-') ?></div>
                            </td>
                            <td>
                                <div class="text-[12px] text-slate-600 line-clamp-1 max-w-[150px]" title="<?= esc($schedule->location) ?>">
                                    <?= esc($schedule->location ?: '-') ?>
                                </div>
                            </td>
                            <td>
                                <?php if (isset($schedule->logbook->reviewer_at)): ?>
                                    <span class="pmw-status bg-emerald-100 text-emerald-700 text-[10px]">Terdokumentasi</span>
                                <?php else: ?>
                                    <span class="pmw-status bg-slate-100 text-slate-500 text-[10px]">Belum Direview</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-right whitespace-nowrap">
                                <a href="<?= base_url('reviewer/kegiatan/detail/' . $schedule->id) ?>" class="btn-primary btn-xs shadow-lg shadow-sky-500/10">
                                    <i class="fas fa-camera mr-1"></i> Review Kunjungan
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
