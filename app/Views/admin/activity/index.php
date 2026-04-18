<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 pb-20" x-data="{ 
    showScheduleModal: false,
    showEditModal: false,
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
            <i class="fas fa-calendar-plus mr-2"></i> Buat Jadwal Global
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
                            <th class="text-center">Jumlah Tim</th>
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
                                        <p class="text-sm">Belum ada jadwal global yang dibuat.</p>
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
                                    <?php
                                    $statusColors = [
                                        'planned'   => 'bg-yellow-50 text-yellow-600 border-yellow-200',
                                        'ongoing'   => 'bg-sky-50 text-sky-600 border-sky-200',
                                        'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                        'cancelled' => 'bg-rose-50 text-rose-600 border-rose-200',
                                    ];
                                    ?>
                                    <span class="pmw-status <?= $statusColors[$master->status] ?>"><?= ucfirst($master->status) ?></span>
                                </td>
                                <td class="text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1">
                                        <button @click="window.dispatchEvent(new CustomEvent('edit-master', { detail: <?= htmlspecialchars(json_encode($master)) ?> }))" class="btn-ghost btn-xs text-sky-600 hover:bg-sky-50">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="<?= base_url('admin/kegiatan/delete-batch') ?>" method="POST" class="inline" onsubmit="return confirm('Hapus jadwal ini untuk SEMUA tim? Tindakan ini tidak dapat dibatalkan.')">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="batch_id" value="<?= esc($master->batch_id) ?>">
                                            <input type="hidden" name="activity_category" value="<?= esc($master->activity_category) ?>">
                                            <input type="hidden" name="activity_date" value="<?= esc($master->activity_date) ?>">
                                            <input type="hidden" name="location" value="<?= esc($master->location) ?>">
                                            <button type="submit" class="btn-ghost btn-xs text-rose-600 hover:bg-rose-50">
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
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($schedules)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-12">
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
                                    $logbookStatus = $schedule->logbook->status ?? 'not_submitted';
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
    </div>

    <!-- Edit Schedule Modal -->
    <template x-if="showEditModal">
        <div class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click="showEditModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                
                <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-white/20 animate-scale-up">
                    <form action="<?= base_url('admin/kegiatan/update-batch') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="batch_id" x-model="editData.batch_id">
                        <input type="hidden" name="old_category" x-model="editData.old_category">
                        <input type="hidden" name="old_date" x-model="editData.old_date">
                        <input type="hidden" name="old_location" x-model="editData.old_location">

                        <div class="px-6 py-5 border-b border-slate-50 flex items-center justify-between bg-gradient-to-r from-sky-50 to-white">
                            <h3 class="text-lg font-black text-slate-800 tracking-tight">Edit <span class="text-sky-600">Jadwal Global</span></h3>
                            <button type="button" @click="showEditModal = false" class="w-8 h-8 flex items-center justify-center rounded-full bg-white shadow-sm text-slate-400 hover:text-slate-600 transition-all">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <div class="px-8 py-6 space-y-5">
                            <div class="space-y-1.5">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-wider ml-1">Kategori Kegiatan</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-sky-500 transition-colors">
                                        <i class="fas fa-tag text-sm"></i>
                                    </div>
                                    <input type="text" name="activity_category" x-model="editData.activity_category" required class="w-full pl-10 pr-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm font-semibold text-slate-700">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-wider ml-1">Tanggal Pelaksanaan</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-sky-500 transition-colors">
                                        <i class="fas fa-calendar-day text-sm"></i>
                                    </div>
                                    <input type="date" name="activity_date" x-model="editData.activity_date" required class="w-full pl-10 pr-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm font-semibold text-slate-700">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-wider ml-1">Lokasi Pelaksanaan</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-sky-500 transition-colors">
                                        <i class="fas fa-map-marker-alt text-sm"></i>
                                    </div>
                                    <input type="text" name="location" x-model="editData.location" required placeholder="Contoh: Aula Serbaguna Polsri" class="w-full pl-10 pr-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm font-semibold text-slate-700">
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-wider ml-1">Status Global</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-sky-500 transition-colors">
                                        <i class="fas fa-info-circle text-sm"></i>
                                    </div>
                                    <select name="status" x-model="editData.status" required class="w-full pl-10 pr-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm font-semibold text-slate-700">
                                        <option value="planned">Planned (Terencana)</option>
                                        <option value="ongoing">Ongoing (Berjalan)</option>
                                        <option value="completed">Completed (Selesai)</option>
                                        <option value="cancelled">Cancelled (Dibatalkan)</option>
                                    </select>
                                </div>
                                <p class="text-[10px] text-slate-400 italic mt-1 ml-1">* Mengubah status ini akan berdampak pada semua tim terkait.</p>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-wider ml-1">Catatan Tambahan (Opsional)</label>
                                <textarea name="notes" x-model="editData.notes" rows="3" placeholder="Tambahkan catatan jika diperlukan..." class="w-full px-4 py-3 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:bg-white focus:border-sky-500 focus:ring-4 focus:ring-sky-500/10 transition-all outline-none text-sm font-semibold text-slate-700 resize-none"></textarea>
                            </div>
                        </div>

                        <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                            <button type="button" @click="showEditModal = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">
                                Batal
                            </button>
                            <button type="submit" class="px-6 py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-sm font-black rounded-xl shadow-lg shadow-sky-500/25 transition-all active:scale-95">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

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

                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest pl-1">Tanggal Kegiatan</label>
                    <input type="date" name="activity_date" class="input-modern w-full" required>
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
