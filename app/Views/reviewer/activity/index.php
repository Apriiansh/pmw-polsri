<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="{
    showMonitoringModal: false,
    monitoringData: {
        id: '',
        nama_usaha: '',
        summary: '',
        photos: []
    },
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}" @monitoring.window="
    monitoringData = $event.detail;
    showMonitoringModal = true;
">

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
            'reviewed'  => count(array_filter($schedules, fn($s) => !empty($s->reviewer_at))),
            'pending'   => count(array_filter($schedules, fn($s) => empty($s->reviewer_at))),
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
                                <?php if (!empty($schedule->reviewer_at)): ?>
                                    <span class="pmw-status bg-emerald-50 text-emerald-600 border-emerald-200 text-[10px]">
                                        <i class="fas fa-check-circle mr-1"></i> Terdokumentasi
                                    </span>
                                <?php else: ?>
                                    <span class="pmw-status bg-slate-50 text-slate-400 border-slate-200 text-[10px]">
                                        <i class="fas fa-clock mr-1"></i> Belum Review
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <button @click="$dispatch('monitoring', { 
                                        id: '<?= $schedule->id ?>', 
                                        nama_usaha: '<?= esc($schedule->nama_usaha) ?>',
                                        summary: '<?= esc($schedule->reviewer_summary ?? '') ?>',
                                        photos: <?= htmlspecialchars(json_encode($schedule->photos ?? [])) ?>
                                    })" class="btn-outline btn-xs bg-emerald-50 text-emerald-600 border-emerald-200 hover:bg-emerald-500 hover:text-white transition-all">
                                        <i class="fas fa-map-location-dot mr-1"></i> Monitoring
                                    </button>
                                    <a href="<?= base_url('reviewer/kegiatan/detail/' . $schedule->id) ?>" class="btn-outline btn-xs bg-sky-50 text-sky-600 border-sky-200 hover:bg-sky-500 hover:text-white transition-all">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Monitoring Modal -->
    <div x-show="showMonitoringModal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="display: none;"
        x-cloak>

        <div class="card-premium w-full max-w-3xl bg-white shadow-2xl animate-modal" @click.away="showMonitoringModal = false">
            <div class="p-6 border-b border-sky-50 flex justify-between items-center bg-sky-50/30">
                <div class="flex flex-col">
                    <h3 class="font-display text-lg font-black text-sky-900 uppercase tracking-tight">Monitoring Lapangan</h3>
                    <p class="text-[10px] text-sky-600 font-bold" x-text="monitoringData.nama_usaha"></p>
                </div>
                <button @click="showMonitoringModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form :action="'<?= base_url('reviewer/kegiatan/review') ?>/' + monitoringData.id" method="POST" enctype="multipart/form-data" class="p-6">
                <?= csrf_field() ?>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Photo Section -->
                    <div class="space-y-4">
                        <label class="text-[10px] text-slate-400 font-black uppercase tracking-widest block">Foto Dokumentasi Lapangan</label>
                        
                        <div class="relative">
                            <template x-if="monitoringData.photos && monitoringData.photos.length > 0">
                                <div class="grid grid-cols-2 gap-3">
                                    <template x-for="photo in monitoringData.photos" :key="photo.id">
                                        <div class="aspect-square rounded-xl overflow-hidden border-2 border-white shadow-md relative group">
                                            <img :src="photo.url" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                                <i class="fas fa-search-plus text-lg"></i>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                            
                            <template x-if="!monitoringData.photos || monitoringData.photos.length === 0">
                                <div class="aspect-video rounded-2xl bg-slate-50 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-300">
                                    <i class="fas fa-images text-4xl mb-2"></i>
                                    <p class="text-[10px] font-bold uppercase tracking-widest">Belum Ada Dokumentasi</p>
                                </div>
                            </template>
                        </div>

                        <div class="form-field mt-6">
                            <label class="form-label text-[11px]">Upload Foto Dokumentasi (Multiple)</label>
                            <input type="file" name="photos[]" class="input-field py-2.5 text-xs bg-slate-50" accept="image/*" multiple>
                            <p class="text-[9px] text-slate-400 mt-2 italic">* Pilih satu atau lebih foto rill di lapangan.</p>
                        </div>
                    </div>

                    <!-- Note Section -->
                    <div class="flex flex-col">
                        <div class="form-field flex-1">
                            <label class="form-label text-[11px]">Catatan / Hasil Temuan Lapangan</label>
                            <textarea name="summary" x-model="monitoringData.summary" rows="10" class="form-textarea text-xs h-full min-h-[200px]" placeholder="Ceritakan kondisi rill usaha di lokasi..."></textarea>
                        </div>
                        
                        <div class="pt-6 flex gap-3">
                            <button type="button" @click="showMonitoringModal = false" class="btn-outline flex-1 py-3 text-xs">Batal</button>
                            <button type="submit" class="btn-primary flex-1 py-3 text-xs shadow-lg shadow-sky-500/10">
                                <i class="fas fa-save mr-2"></i> Simpan Dokumentasi
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
