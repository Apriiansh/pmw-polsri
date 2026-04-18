<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 pb-20" x-data="{ 
    showScheduleModal: false,
    showEditModal: false,
    showMonitoringModal: false,
    editData: {
        batch_id: '',
        activity_category: '',
        activity_date: '',
        location: '',
        notes: '',
        status: '',
        old_category: '',
        old_date: '',
        old_location: ''
    },
    monitoringData: {
        id: '',
        nama_usaha: '',
        summary: '',
        photo_url: ''
    },
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}" @edit-master.window="
    editData = $event.detail;
    editData.old_category = editData.activity_category;
    editData.old_date = editData.activity_date;
    editData.old_location = editData.location;
    showEditModal = true;
" @monitoring.window="
    monitoringData = $event.detail;
    showMonitoringModal = true;
">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Manajemen <span class="text-gradient">Kegiatan Wirausaha</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap 9 — Penjadwalan dan Verifikasi Logbook Kegiatan</p>
        </div>
        <button @click="showScheduleModal = true" class="btn-primary shadow-lg shadow-sky-500/20">
            <i class="fas fa-calendar-plus mr-2"></i> Buat Jadwal Kegiatan
        </button>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <?php
        $statItems = [
            ['title' => 'Total Record', 'value' => $stats['total'], 'icon' => 'fa-database', 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500'],
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

    <!-- Main Content Tabs -->
    <div class="space-y-6" x-data="{ activeTab: 'master' }">
        <?php
        $statusColors = [
            'planned'   => 'bg-yellow-50 text-yellow-600 border-yellow-200',
            'ongoing'   => 'bg-sky-50 text-sky-600 border-sky-200',
            'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
            'cancelled' => 'bg-rose-50 text-rose-600 border-rose-200',
        ];
        ?>
        <div class="flex items-center gap-2 p-1 bg-slate-100 rounded-xl w-fit">
            <button @click="activeTab = 'master'" :class="activeTab === 'master' ? 'bg-white text-sky-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg transition-all">
                <i class="fas fa-calendar-alt mr-2"></i> Daftar Jadwal Global
            </button>
            <button @click="activeTab = 'teams'" :class="activeTab === 'teams' ? 'bg-white text-sky-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg transition-all">
                <i class="fas fa-users mr-2"></i> Validasi Logbook Tim
            </button>
        </div>

        <!-- Master Schedules Table -->
        <div x-show="activeTab === 'master'" class="card-premium overflow-hidden animate-stagger" @mousemove="handleMouseMove">
            <div class="px-6 py-4 border-b border-sky-50 flex items-center justify-between bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">Daftar Jadwal Global</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="pmw-table">
                    <thead>
                        <tr>
                            <th>Jadwal & Kategori</th>
                            <th>Lokasi</th>
                            <th class="text-center">Jumlah Tim Aktif</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($masterSchedules)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-12">
                                    <div class="text-slate-400">
                                        <i class="fas fa-calendar-xmark text-4xl mb-3 opacity-20"></i>
                                        <p class="text-sm">Belum ada jadwal Kegiatan yang dibuat.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($masterSchedules as $master): ?>
                                <tr class="group">
                                    <td class="whitespace-nowrap">
                                        <div class="text-[12px] font-bold text-(--text-heading)"><?= date('d M Y', strtotime($master->activity_date)) ?></div>
                                        <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded bg-violet-100 text-violet-700 mt-1 inline-block"><?= esc($master->activity_category) ?></span>
                                    </td>
                                    <td>
                                        <div class="text-[12px] text-slate-600 line-clamp-1 max-w-[200px]" title="<?= esc($master->location) ?>">
                                            <?= esc($master->location ?: '-') ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-sky-50 text-sky-600 border border-sky-100">
                                            <?= $master->team_count ?> Tim
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex flex-col">
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-tight mb-1">Updateable</span>
                                            <form action="<?= base_url('admin/kegiatan/quick-update-status') ?>" method="POST" class="inline">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="batch_id" value="<?= esc($master->batch_id) ?>">
                                                <select name="status" onchange="this.form.submit()" 
                                                    class="pmw-status <?= $statusColors[$master->status] ?> cursor-pointer focus:ring-2 focus:ring-offset-1 focus:ring-sky-500 transition-all text-[10px] appearance-none py-1 px-3">
                                                    <option value="planned" <?= $master->status === 'planned' ? 'selected' : '' ?>>Planned</option>
                                                    <option value="ongoing" <?= $master->status === 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
                                                    <option value="completed" <?= $master->status === 'completed' ? 'selected' : '' ?>>Completed</option>
                                                    <option value="cancelled" <?= $master->status === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                </select>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-1">
                                            <button @click="window.dispatchEvent(new CustomEvent('edit-master', { detail: <?= htmlspecialchars(json_encode($master)) ?> }))" class="btn-ghost btn-xs text-sky-600 hover:bg-sky-500">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="<?= base_url('admin/kegiatan/delete-batch') ?>" method="POST" class="inline" onsubmit="return confirm('Hapus jadwal ini untuk SEMUA tim? Tindakan ini tidak dapat dibatalkan.')">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="batch_id" value="<?= esc($master->batch_id) ?>">
                                                <input type="hidden" name="activity_category" value="<?= esc($master->activity_category) ?>">
                                                <input type="hidden" name="activity_date" value="<?= esc($master->activity_date) ?>">
                                                <input type="hidden" name="location" value="<?= esc($master->location) ?>">
                                                <button type="submit" class="btn-ghost btn-xs text-rose-600 hover:bg-rose-500">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Individual Team Logbooks Table -->
        <div x-show="activeTab === 'teams'" class="card-premium overflow-hidden animate-stagger" @mousemove="handleMouseMove" style="display: none;">
            <div class="px-6 py-4 border-b border-sky-50 flex items-center justify-between bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">Validasi Logbook Tim</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="pmw-table">
                    <thead>
                        <tr>
                            <th>Tim & Kategori</th>
                            <th>Tanggal & Lokasi</th>
                            <th>Status Logbook</th>
                            <th>Monitoring</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($schedules)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-12">
                                    <div class="text-slate-400">
                                        <i class="fas fa-users-slash text-4xl mb-3 opacity-20"></i>
                                        <p class="text-sm">Belum ada tim yang memiliki jadwal.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($schedules as $schedule): ?>
                                <tr class="group">
                                    <td>
                                        <div class="text-[12px] font-semibold text-slate-700"><?= esc($schedule->nama_usaha) ?></div>
                                        <div class="text-[11px] text-slate-400"><?= esc($schedule->ketua_nama ?? '-') ?></div>
                                    </td>
                                    <td class="whitespace-nowrap">
                                        <div class="text-[11px] font-bold text-slate-600"><?= date('d M Y', strtotime($schedule->activity_date)) ?></div>
                                        <div class="text-[10px] text-slate-400 italic truncate max-w-[150px]"><?= esc($schedule->location ?: '-') ?></div>
                                    </td>
                                    <td>
                                        <?php
                                        $logbookStatus = $schedule->logbook_status ?? 'not_submitted';
                                        $logbookBadges = [
                                            'not_submitted'      => ['bg-slate-100 text-slate-500', 'Belum Diisi'],
                                            'draft'              => ['bg-yellow-100 text-yellow-700', 'Draft'],
                                            'pending'            => ['bg-blue-100 text-blue-700', 'Menunggu Dosen'],
                                            'approved_by_dosen'  => ['bg-purple-100 text-purple-700', 'Approved Dosen'],
                                            'approved_by_mentor' => ['bg-indigo-100 text-indigo-700', 'Approved Mentor'],
                                            'approved'           => ['bg-emerald-100 text-emerald-700', 'Final Approved'],
                                            'revision'           => ['bg-orange-100 text-orange-700', 'Perlu Revisi'],
                                        ];
                                        $badge = $logbookBadges[$logbookStatus] ?? $logbookBadges['not_submitted'];
                                        ?>
                                        <span class="pmw-status <?= $badge[0] ?> text-[10px]"><?= $badge[1] ?></span>
                                    </td>
                                    <td>
                                        <?php if ($schedule->reviewer_at): ?>
                                            <span class="pmw-status bg-emerald-50 text-emerald-600 border-emerald-200 text-[10px]">
                                                <i class="fas fa-check-circle mr-1"></i> Selesai
                                            </span>
                                        <?php else: ?>
                                            <span class="pmw-status bg-slate-50 text-slate-400 border-slate-200 text-[10px]">
                                                <i class="fas fa-clock mr-1"></i> Belum
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-2">
                                            <button @click="$dispatch('monitoring', { 
                                                id: '<?= $schedule->id ?>', 
                                                nama_usaha: '<?= esc($schedule->nama_usaha) ?>',
                                                summary: '<?= esc($schedule->reviewer_summary ?? '') ?>',
                                                photo_url: '<?= $schedule->reviewer_photo ? base_url('admin/kegiatan/file/reviewer/' . $schedule->id) : '' ?>'
                                            })" class="btn-outline btn-xs bg-emerald-50 text-emerald-600 border-emerald-200 hover:bg-emerald-500 hover:text-white transition-all">
                                                <i class="fas fa-map-location-dot mr-1"></i> Monitoring
                                            </button>
                                            <a href="<?= base_url('admin/kegiatan/detail/' . $schedule->id) ?>" class="btn-outline btn-xs bg-sky-50 text-sky-600 border-sky-200 hover:bg-sky-500 hover:text-white transition-all">
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
    </div>

    <!-- Edit Schedule Modal -->
    <div x-show="showEditModal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="display: none;">

        <div class="card-premium w-full max-w-lg bg-white shadow-2xl animate-modal" @click.away="showEditModal = false">
            <div class="p-6 border-b border-sky-50 flex justify-between items-center bg-sky-50/30">
                <h3 class="font-display text-lg font-black text-sky-900 uppercase tracking-tight">Edit Jadwal</h3>
                <button @click="showEditModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form action="<?= base_url('admin/kegiatan/update-batch') ?>" method="POST" class="p-6 space-y-4">
                <?= csrf_field() ?>
                <input type="hidden" name="batch_id" x-model="editData.batch_id">
                <input type="hidden" name="old_category" x-model="editData.old_category">
                <input type="hidden" name="old_date" x-model="editData.old_date">
                <input type="hidden" name="old_location" x-model="editData.old_location">

                <div class="p-4 rounded-xl bg-amber-50 border border-amber-100 flex gap-3 mb-2">
                    <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                        <i class="fas fa-info-circle text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-amber-900 leading-snug">Jadwal Kegiatan Wirausaha</p>
                        <p class="text-[10px] text-amber-700 leading-normal">Perubahan pada jadwal ini akan otomatis diterapkan kepada <strong>seluruh tim</strong> yang terkait.</p>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Kategori Kegiatan</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-tag"></i></span>
                        <input type="text" name="activity_category" x-model="editData.activity_category" placeholder="Contoh: BAZAR, PAMERAN" required>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Tanggal Kegiatan</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-calendar-alt"></i></span>
                        <input type="date" name="activity_date" x-model="editData.activity_date" required>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Lokasi</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" name="location" x-model="editData.location" placeholder="Tempat pelaksanaan kegiatan">
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Status Kegiatan</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-info-circle"></i></span>
                        <select name="status" x-model="editData.status" required>
                            <option value="planned">Planned (Terencana)</option>
                            <option value="ongoing">Ongoing (Berjalan)</option>
                            <option value="completed">Completed (Selesai)</option>
                            <option value="cancelled">Cancelled (Dibatalkan)</option>
                        </select>
                    </div>
                    <p class="text-[10px] text-slate-400 italic mt-1">* Mengubah status ini berdampak pada semua tim terkait.</p>
                </div>

                <div class="form-field">
                    <label class="form-label">Catatan</label>
                    <textarea name="notes" x-model="editData.notes" rows="2" class="form-textarea" placeholder="Catatan tambahan (opsional)"></textarea>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showEditModal = false" class="btn-outline flex-1">Batal</button>
                    <button type="submit" class="btn-primary flex-1">Simpan Perubahan</button>
                </div>
            </form>
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
                <h3 class="font-display text-lg font-black text-sky-900 uppercase tracking-tight">Buat Jadwal Kegiatan</h3>
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
                        <p class="text-[11px] font-bold text-amber-900 leading-snug">Jadwal Kegiatan PMW</p>
                        <p class="text-[10px] text-amber-700 leading-normal">Jadwal ini akan otomatis diterapkan kepada <strong>seluruh tim</strong> yang telah lolos seleksi implementasi.</p>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Kategori Kegiatan</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-tag"></i></span>
                        <input type="text" name="activity_category" placeholder="Contoh: BAZAR, PAMERAN" required>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1">Masukkan kategori kegiatan secara bebas</p>
                </div>

                <div class="form-field">
                    <label class="form-label">Tanggal Kegiatan</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-calendar-alt"></i></span>
                        <input type="date" name="activity_date" required>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Lokasi</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" name="location" placeholder="Tempat pelaksanaan kegiatan">
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Catatan</label>
                    <textarea name="notes" rows="2" class="form-textarea" placeholder="Catatan tambahan (opsional)"></textarea>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showScheduleModal = false" class="btn-outline flex-1">Batal</button>
                    <button type="submit" class="btn-primary flex-1">Simpan Jadwal</button>
                </div>
            </form>
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

            <form :action="'<?= base_url('admin/kegiatan/review') ?>/' + monitoringData.id" method="POST" enctype="multipart/form-data" class="p-6">
                <?= csrf_field() ?>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Photo Section -->
                    <div class="space-y-4">
                        <label class="text-[10px] text-slate-400 font-black uppercase tracking-widest block">Foto Dokumentasi Lapangan</label>
                        
                        <div class="relative">
                            <template x-if="monitoringData.photo_url">
                                <div class="aspect-video rounded-2xl overflow-hidden border-4 border-white shadow-lg relative group">
                                    <img :src="monitoringData.photo_url" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                        <i class="fas fa-search-plus text-2xl"></i>
                                    </div>
                                </div>
                            </template>
                            
                            <template x-if="!monitoringData.photo_url">
                                <div class="aspect-video rounded-2xl bg-slate-50 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-300">
                                    <i class="fas fa-image text-4xl mb-2"></i>
                                    <p class="text-[10px] font-bold uppercase tracking-widest">Belum Ada Foto</p>
                                </div>
                            </template>
                        </div>

                        <div class="form-field mt-6">
                            <label class="form-label text-[11px]">Upload Foto Rill Baru</label>
                            <input type="file" name="photo" class="input-field py-2.5 text-xs bg-slate-50" accept="image/*">
                            <p class="text-[9px] text-slate-400 mt-2 italic">* Format: JPG, PNG, WEBP. Maks 2MB.</p>
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