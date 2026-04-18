<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="{
    showScheduleModal: false,
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
                Manajemen <span class="text-gradient">Kegiatan Wirausaha</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap 9 — Penjadwalan dan Verifikasi Logbook Kegiatan</p>
        </div>
        <button @click="showScheduleModal = true" class="btn-primary">
            <i class="fas fa-calendar-plus mr-2"></i> Buat Jadwal
        </button>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <?php
        $statItems = [
            ['title' => 'Total Jadwal', 'value' => $stats['total'], 'icon' => 'fa-calendar-alt', 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500'],
            ['title' => 'Terencana', 'value' => $stats['planned'], 'icon' => 'fa-clock', 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500'],
            ['title' => 'Berjalan', 'value' => $stats['ongoing'], 'icon' => 'fa-spinner', 'bg' => 'bg-blue-50', 'icon_color' => 'text-blue-500'],
            ['title' => 'Selesai', 'value' => $stats['completed'], 'icon' => 'fa-check-circle', 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500'],
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
            <h3 class="font-display text-base font-bold text-(--text-heading)">Daftar Jadwal Kegiatan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="pmw-table">
                <thead>
                    <tr>
                        <th>Tanggal & Kategori</th>
                        <th>Tim</th>
                        <th>Lokasi</th>
                        <th>Status Logbook</th>
                        <th>Status Jadwal</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($schedules)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-12">
                                <div class="text-slate-400">
                                    <i class="fas fa-calendar-xmark text-4xl mb-3 opacity-20"></i>
                                    <p class="text-sm">Belum ada jadwal kegiatan yang dibuat.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($schedules as $schedule): ?>
                        <tr class="group">
                            <td class="whitespace-nowrap">
                                <div class="text-[12px] font-bold text-(--text-heading)"><?= date('d M Y', strtotime($schedule->activity_date)) ?></div>
                                <div class="text-[11px] text-sky-600 font-semibold"><?= $schedule->activity_time ?></div>
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
                                <?php
                                $logbookStatus = $schedule->logbook->status ?? 'not_submitted';
                                $logbookBadges = [
                                    'not_submitted'   => ['bg-slate-100 text-slate-500', 'Belum Diisi'],
                                    'draft'           => ['bg-yellow-100 text-yellow-700', 'Draft'],
                                    'pending'         => ['bg-blue-100 text-blue-700', 'Menunggu Dosen'],
                                    'approved_by_dosen' => ['bg-purple-100 text-purple-700', 'Approved Dosen'],
                                    'approved_by_mentor' => ['bg-indigo-100 text-indigo-700', 'Approved Mentor'],
                                    'approved'        => ['bg-emerald-100 text-emerald-700', 'Final Approved'],
                                    'revision'        => ['bg-orange-100 text-orange-700', 'Perlu Revisi'],
                                ];
                                $badge = $logbookBadges[$logbookStatus] ?? $logbookBadges['not_submitted'];
                                ?>
                                <span class="pmw-status <?= $badge[0] ?> text-[10px]"><?= $badge[1] ?></span>
                            </td>
                            <td>
                                <?php
                                $statusColors = [
                                    'planned'   => 'bg-yellow-50 text-yellow-600 border-yellow-200',
                                    'ongoing'   => 'bg-sky-50 text-sky-600 border-sky-200',
                                    'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                    'cancelled' => 'bg-rose-50 text-rose-600 border-rose-200',
                                ];
                                ?>
                                <span class="pmw-status <?= $statusColors[$schedule->status] ?>"><?= ucfirst($schedule->status) ?></span>
                            </td>
                            <td class="text-right whitespace-nowrap">
                                <a href="<?= base_url('admin/kegiatan/detail/' . $schedule->id) ?>" class="btn-outline btn-xs bg-sky-50 text-sky-600 border-sky-200 hover:bg-sky-500 hover:text-white transition-all">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Schedule Modal -->
    <div x-show="showScheduleModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        
        <div class="card-premium w-full max-w-lg bg-white shadow-2xl animate-modal" @click.away="showScheduleModal = false">
            <div class="p-6 border-b border-sky-50 flex justify-between items-center bg-sky-50/30">
                <h3 class="font-display text-lg font-black text-sky-900 uppercase">Buat Jadwal Kegiatan</h3>
                <button @click="showScheduleModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="<?= base_url('admin/kegiatan/schedule') ?>" method="POST" class="p-6 space-y-4">
                <?= csrf_field() ?>
                
                <div class="p-4 rounded-xl bg-amber-50 border border-amber-100 flex gap-3 mb-2">
                    <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                        <i class="fas fa-info-circle text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-amber-900 leading-snug">Jadwal Global</p>
                        <p class="text-[10px] text-amber-700 leading-normal">Jadwal ini akan otomatis diterapkan kepada <strong>seluruh tim</strong> yang telah lolos seleksi implementasi.</p>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest pl-1">Kategori Kegiatan</label>
                    <input type="text" name="activity_category" class="input-modern w-full" placeholder="Contoh: BAZAR, MARKET DAY, PAMERAN" required>
                    <p class="text-[10px] text-slate-400">Masukkan kategori kegiatan secara bebas</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest pl-1">Tanggal</label>
                        <input type="date" name="activity_date" class="input-modern w-full" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest pl-1">Waktu</label>
                        <input type="time" name="activity_time" class="input-modern w-full">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest pl-1">Lokasi</label>
                    <input type="text" name="location" class="input-modern w-full" placeholder="Tempat pelaksanaan kegiatan">
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest pl-1">Catatan</label>
                    <textarea name="notes" rows="2" class="input-modern w-full" placeholder="Catatan tambahan (opsional)"></textarea>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showScheduleModal = false" class="btn-outline flex-1">Batal</button>
                    <button type="submit" class="btn-primary flex-1">Simpan Jadwal</button>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
