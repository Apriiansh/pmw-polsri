<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 pb-20" x-data="{ 
    showScheduleModal: false,
    showCategoryModal: false,
    showCertModal: false,
    certificateSubmissionId: null,
    categoryData: {
        id: '',
        name: '',
        max_rank: 3
    },
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 animate-stagger">
        <div>
            <h2 class="section-title text-2xl sm:text-3xl">
                Awarding & <span class="text-gradient">Expo PMW</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px] uppercase font-black tracking-widest opacity-70">Tahap Akhir — Expo Kewirausahaan & Awarding PMW</p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <a href="<?= base_url('admin/awards') ?>" class="btn-outline bg-amber-50 text-amber-600 border-amber-200 hover:bg-amber-500 hover:text-white transition-all shadow-sm py-2.5 px-5">
                <i class="fas fa-trophy mr-2 text-xs"></i> Manajemen Pemenang
            </a>
            <button @click="showScheduleModal = true" class="btn-primary shadow-lg shadow-sky-500/20 py-2.5 px-5">
                <i class="fas fa-calendar-days mr-2 text-xs"></i> Pengaturan Expo
            </button>
        </div>
    </div>

    <!-- Expo Info Card -->
    <div class="grid lg:grid-cols-3 gap-6 animate-stagger delay-100">
        <div class="lg:col-span-2 card-premium p-6 overflow-hidden relative group" @mousemove="handleMouseMove">
            <div class="flex flex-col md:flex-row md:items-center gap-6">
                <div class="w-20 h-20 rounded-3xl bg-sky-50 flex items-center justify-center shrink-0 border-2 border-white shadow-sm">
                    <i class="fas fa-calendar-day text-3xl text-sky-500"></i>
                </div>
                <div class="space-y-1">
                    <h3 class="font-display text-xl font-black text-(--text-heading)">
                        <?= $schedule->event_name ?? 'Jadwal Expo Belum Diatur' ?>
                    </h3>
                    <div class="flex flex-wrap items-center gap-4">
                        <span class="flex items-center text-[11px] font-bold text-slate-500">
                            <i class="fas fa-map-marker-alt mr-1.5 text-sky-400"></i>
                            <?= $schedule->location ?? '-' ?>
                        </span>
                        <span class="flex items-center text-[11px] font-bold text-slate-500">
                            <i class="fas fa-calendar-day mr-1.5 text-sky-400"></i>
                            <?= ($schedule && $schedule->event_date) ? date('d F Y', strtotime($schedule->event_date)) : '-' ?>
                        </span>
                    </div>
                </div>
                <div class="md:ml-auto flex flex-col items-start md:items-end gap-2">
                    <?php if ($schedule): ?>
                        <span class="pmw-status <?= $schedule->is_closed ? 'bg-rose-50 text-rose-600 border-rose-200' : 'bg-emerald-50 text-emerald-600 border-emerald-200' ?> text-[10px] px-3">
                            <i class="fas <?= $schedule->is_closed ? 'fa-lock' : 'fa-lock-open' ?> mr-1.5"></i>
                            <?= $schedule->is_closed ? 'Sesi Ditutup' : 'Sesi Dibuka' ?>
                        </span>
                        <form action="<?= base_url('admin/expo/status') ?>" method="POST">
                            <?= csrf_field() ?>
                            <button type="submit" class="text-[10px] font-black uppercase tracking-tighter text-slate-400 hover:text-sky-600 transition-colors">
                                [ Klik untuk <?= $schedule->is_closed ? 'Buka' : 'Tutup' ?> Sesi ]
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-sky-50 grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Deadline Submit</p>
                    <p class="text-xs font-bold text-slate-700">
                        <?= ($schedule && $schedule->submission_deadline) ? date('d M Y, H:i', strtotime($schedule->submission_deadline)) : '-' ?>
                    </p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kategori Award</p>
                    <p class="text-xs font-bold text-slate-700"><?= count($categories) ?> Kategori</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Submission</p>
                    <p class="text-xs font-bold text-slate-700"><?= count($submissions) ?> Tim</p>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Periode</p>
                    <p class="text-xs font-bold text-sky-600"><?= esc($period['year']) ?></p>
                </div>
            </div>
        </div>

        <!-- Award Categories Summary -->
        <div class="card-premium p-6 flex flex-col" @mousemove="handleMouseMove">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-display text-sm font-black text-(--text-heading) uppercase tracking-tight">Kategori Award</h3>
                <button @click="categoryData = { id: '', name: '', max_rank: 3 }; showCategoryModal = true" class="text-sky-500 hover:text-sky-700">
                    <i class="fas fa-plus-circle"></i>
                </button>
            </div>
            <div class="space-y-3 overflow-y-auto max-h-[160px] custom-scrollbar pr-2">
                <?php if (empty($categories)): ?>
                    <p class="text-[11px] text-slate-400 italic text-center py-4">Belum ada kategori award.</p>
                <?php else: ?>
                    <?php foreach ($categories as $cat): ?>
                        <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100 group">
                            <div class="min-w-0">
                                <p class="text-[11px] font-bold text-slate-700 truncate"><?= esc($cat->name) ?></p>
                                <p class="text-[9px] text-slate-400 font-black uppercase">Max Rank: <?= $cat->max_rank ?></p>
                            </div>
                            <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button @click="categoryData = { id: '<?= $cat->id ?>', name: '<?= esc($cat->name) ?>', max_rank: <?= $cat->max_rank ?> }; showCategoryModal = true" class="w-6 h-6 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-sky-500 text-[10px]">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?= base_url('admin/expo/category/delete/' . $cat->id) ?>" onclick="return confirm('Hapus kategori ini?')" class="w-6 h-6 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-rose-500 text-[10px]">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Submissions Table -->
    <div class="space-y-6 animate-stagger delay-200">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h3 class="font-display text-base font-black text-(--text-heading)">
                Daftar <span class="text-sky-500">Dokumentasi Expo</span>
            </h3>
            <div class="flex items-center gap-3">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest shrink-0">Filter Status:</span>
                <select class="w-full sm:w-auto text-[10px] font-bold border border-slate-200 bg-white rounded-lg px-3 py-1.5 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all">
                    <option>Semua Tim</option>
                    <option>Sudah Submit</option>
                    <option>Belum Submit</option>
                </select>
            </div>
        </div>

        <div class="card-premium overflow-hidden">
            <div class="overflow-x-auto">
                <table class="pmw-table">
                    <thead>
                        <tr>
                            <th>Identitas Tim & Usaha</th>
                            <th>Summary Dokumentasi</th>
                            <th class="text-center">Lampiran</th>
                            <th>Tanggal Kirim</th>
                            <th class="text-center">Sertifikat</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($submissions)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-20">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mb-4 border border-slate-100">
                                            <i class="fas fa-file-invoice text-2xl text-slate-300"></i>
                                        </div>
                                        <p class="text-sm font-bold text-slate-400">Belum ada dokumentasi yang dikirim oleh tim.</p>
                                        <p class="text-[10px] text-slate-300 mt-1 uppercase tracking-widest">Pastikan tim sudah mencapai tahap finalisasi dana II</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($submissions as $sub): ?>
                                <tr class="group">
                                    <td>
                                        <div class="text-[12px] font-bold text-slate-700"><?= esc($sub->nama_usaha) ?></div>
                                        <div class="text-[10px] text-slate-400 flex items-center gap-2 mt-0.5">
                                            <span class="font-black text-sky-500"><?= esc($sub->ketua_nim) ?></span>
                                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                            <span><?= esc($sub->ketua_nama) ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-[11px] text-slate-600 line-clamp-2 italic leading-relaxed max-w-xs">
                                            "<?= esc($sub->summary ?: 'Tidak ada ringkasan.') ?>"
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-sky-50 text-sky-600 text-[10px] font-black border border-sky-100">
                                            <?= $sub->attachment_count ?> File
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-[11px] font-bold text-slate-500"><?= date('d/m/Y', strtotime($sub->submitted_at)) ?></div>
                                        <div class="text-[10px] text-slate-400"><?= date('H:i', strtotime($sub->submitted_at)) ?> WIB</div>
                                    </td>
                                    <td class="text-center">
                                        <?php if (!empty($sub->certificate_path)): ?>
                                            <div class="flex items-center justify-center gap-3">
                                                <a href="<?= base_url('admin/expo/certificate/' . $sub->id) ?>" target="_blank" class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all shadow-sm" title="Lihat Sertifikat">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                <a href="<?= base_url('admin/expo/delete-certificate/' . $sub->id) ?>" onclick="return confirm('Hapus sertifikat ini?')" class="w-7 h-7 rounded-lg bg-rose-50 text-rose-500 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all shadow-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <button @click="certificateSubmissionId = <?= $sub->id ?>; showCertModal = true" class="text-[9px] font-black uppercase text-slate-400 hover:text-sky-600 transition-colors flex items-center gap-1.5 mx-auto">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                Upload
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right whitespace-nowrap">
                                        <a href="<?= base_url('admin/expo/submission/' . $sub->id) ?>" class="btn-outline btn-xs bg-sky-50 text-sky-600 border-sky-200 hover:bg-sky-500 hover:text-white transition-all">
                                            <i class="fas fa-eye mr-1.5"></i> Lihat Detail
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

    <!-- Modals -->
    <!-- Schedule Modal -->
    <div x-show="showScheduleModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" style="display: none;">
        <div class="card-premium w-full max-w-2xl bg-white shadow-2xl animate-modal" @click.away="showScheduleModal = false">
            <div class="p-6 border-b border-sky-50 flex justify-between items-center bg-sky-50/30">
                <h3 class="font-display text-lg font-black text-sky-900 uppercase tracking-tight">Pengaturan Expo</h3>
                <button @click="showScheduleModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form action="<?= base_url('admin/expo/schedule') ?>" method="POST" class="p-6 space-y-4">
                <?= csrf_field() ?>
                <div class="form-field">
                    <label class="form-label">Nama Event</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-rocket"></i></span>
                        <input type="text" name="event_name" value="<?= esc($schedule->event_name ?? '') ?>" placeholder="Contoh: Expo Kewirausahaan PMW Polsri 2026" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-field">
                        <label class="form-label">Tanggal Pelaksanaan</label>
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" name="event_date" value="<?= esc(($schedule && $schedule->event_date) ? date('Y-m-d', strtotime($schedule->event_date)) : '') ?>" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label class="form-label">Deadline Dokumentasi</label>
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-clock"></i></span>
                            <input type="datetime-local" name="submission_deadline" value="<?= esc(($schedule && $schedule->submission_deadline) ? date('Y-m-d\TH:i', strtotime($schedule->submission_deadline)) : '') ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Lokasi</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" name="location" value="<?= esc($schedule->location ?? '') ?>" placeholder="Contoh: Graha Pendidikan Polsri">
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" rows="3" class="form-textarea" placeholder="Informasi tambahan untuk mahasiswa..."><?= esc($schedule->description ?? '') ?></textarea>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showScheduleModal = false" class="btn-outline flex-1">Batal</button>
                    <button type="submit" class="btn-primary flex-1">Simpan Pengaturan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Category Modal -->
    <div x-show="showCategoryModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" style="display: none;">
        <div class="card-premium w-full max-w-md bg-white shadow-2xl animate-modal" @click.away="showCategoryModal = false">
            <div class="p-6 border-b border-sky-50 flex justify-between items-center bg-sky-50/30">
                <h3 class="font-display text-lg font-black text-sky-900 uppercase tracking-tight" x-text="categoryData.id ? 'Edit Kategori' : 'Tambah Kategori'"></h3>
                <button @click="showCategoryModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form action="<?= base_url('admin/expo/category') ?>" method="POST" class="p-6 space-y-4">
                <?= csrf_field() ?>
                <input type="hidden" name="id" x-model="categoryData.id">
                <div class="form-field">
                    <label class="form-label">Nama Kategori</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-tag"></i></span>
                        <input type="text" name="name" x-model="categoryData.name" placeholder="Contoh: Usaha Terinovatif" required>
                    </div>
                </div>
                <div class="form-field">
                    <label class="form-label">Maksimal Juara (Peringkat)</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-list-ol"></i></span>
                        <input type="number" name="max_rank" x-model="categoryData.max_rank" min="1" max="10" required>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1 italic">* Contoh: 3 berarti Juara 1, 2, dan 3.</p>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showCategoryModal = false" class="btn-outline flex-1">Batal</button>
                    <button type="submit" class="btn-primary flex-1">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Certificate Upload Modal -->
    <div x-show="showCertModal" 
         class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden border border-slate-100"
             @click.away="showCertModal = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="bg-slate-50 p-6 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-display text-lg font-black text-sky-900 uppercase tracking-tight">Upload Sertifikat</h3>
                <button @click="showCertModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form action="<?= base_url('admin/expo/upload-certificate') ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                <?= csrf_field() ?>
                <input type="hidden" name="submission_id" x-model="certificateSubmissionId">
                <div class="form-field">
                    <label class="form-label">File Sertifikat (PDF/JPG/PNG)</label>
                    <div class="mt-2">
                        <input type="file" name="certificate" accept=".pdf,.jpg,.jpeg,.png" required
                               class="block w-full text-sm text-slate-500
                                      file:mr-4 file:py-2.5 file:px-4
                                      file:rounded-xl file:border-0
                                      file:text-xs file:font-black file:uppercase
                                      file:bg-sky-50 file:text-sky-700
                                      hover:file:bg-sky-100 transition-all">
                    </div>
                    <p class="text-[10px] text-slate-400 mt-2 italic">Pastikan file sudah sesuai dengan tim yang dipilih.</p>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showCertModal = false" class="btn-outline flex-1">Batal</button>
                    <button type="submit" class="btn-primary flex-1">Upload Sertifikat</button>
                </div>
            </form>
        </div>
    </div>

</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
</style>

<?= $this->endSection() ?>
