<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="pembekalanMahasiswa()">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Pembekalan <span class="text-gradient">PMW</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Input laporan dan foto kegiatan pembekalan</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6 animate-stagger delay-100">
        <div class="card-premium p-5 flex flex-col justify-between" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Periode</p>
            <p class="text-base font-bold text-slate-800 mt-1">
                <?= $activePeriod ? esc($activePeriod['name']) . ' ' . esc($activePeriod['year']) : '-' ?>
            </p>
            <div class="mt-4 pt-4 border-t border-slate-50">
                <p class="text-[11px] font-bold text-slate-500 italic">Tahap 6</p>
            </div>
        </div>

        <div class="card-premium p-5 border-l-4 <?= $isPhaseOpen ? 'border-l-emerald-500' : 'border-l-rose-500' ?>" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Jadwal Pembekalan</p>
            <p class="text-sm font-bold text-slate-800 mt-1">
                <?= $phase ? (formatIndonesianDate($phase['start_date']) . ' - ' . formatIndonesianDate($phase['end_date'])) : 'Belum dijadwalkan' ?>
            </p>
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-black mt-3 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700" : "bg-rose-50 text-rose-700" ?>">
                <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                <?= $isPhaseOpen ? 'INPUT DIBUKA' : 'INPUT DITUTUP' ?>
            </span>
        </div>

        <div class="card-premium p-5 border-l-4 <?= ($hasCompleteData ?? false) ? 'border-l-emerald-500' : 'border-l-amber-500' ?>" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Laporan</p>
            <div class="flex items-center gap-2 mt-1">
                <i class="fas <?= ($hasCompleteData ?? false) ? 'fa-circle-check text-emerald-500' : 'fa-circle-info text-amber-500' ?>"></i>
                <p class="text-sm font-bold text-slate-800">
                    <?= ($hasCompleteData ?? false) ? 'Laporan Lengkap' : 'Belum Lengkap' ?>
                </p>
            </div>
            <p class="text-[11px] text-slate-500 mt-2">
                <?= ($hasCompleteData ?? false)
                    ? 'Terima kasih telah mengupload foto dan ringkasan pembekalan.'
                    : 'Silakan upload foto kegiatan dan tulis ringkasan pembekalan.' ?>
            </p>
        </div>
    </div>

    <?php if ($announcement && (!empty($announcement->training_date) || !empty($announcement->training_location))): ?>
        <div class="card-premium p-5 border-l-4 border-l-sky-500 animate-stagger delay-150" @mousemove="handleMouseMove">
            <div class="flex items-start gap-3">
                <div class="shrink-0 w-10 h-10 rounded-xl bg-sky-100 flex items-center justify-center">
                    <i class="fas fa-calendar-check text-sky-600"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-800">Informasi Pembekalan</h4>
                    <?php if (!empty($announcement->training_date)): ?>
                        <p class="text-[13px] text-slate-600 mt-1"><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($announcement->training_date)) ?> WIB</p>
                    <?php endif; ?>
                    <?php if (!empty($announcement->training_location)): ?>
                        <p class="text-[13px] text-slate-600 mt-1"><strong>Lokasi:</strong> <?= esc($announcement->training_location) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($announcement->training_details)): ?>
                        <p class="text-[12px] text-slate-500 mt-2"><?= nl2br(esc((string)$announcement->training_details)) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!$isPhaseOpen): ?>
        <div class="card-premium p-6 border-l-4 border-l-rose-500">
            <div class="flex items-center gap-3">
                <i class="fas fa-lock text-rose-500 text-xl"></i>
                <div>
                    <p class="font-bold text-slate-800">Input Laporan Ditutup</p>
                    <p class="text-sm text-slate-500">Input laporan pembekalan hanya dapat dilakukan saat Tahap 6 (Pembekalan) dibuka.</p>
                </div>
            </div>
        </div>
    <?php elseif (!$isPassed): ?>
        <div class="card-premium p-6 border-l-4 border-l-amber-500">
            <div class="flex items-center gap-3">
                <i class="fas fa-shield text-amber-500 text-xl"></i>
                <div>
                    <p class="font-bold text-slate-800">Akses Terbatas</p>
                    <p class="text-sm text-slate-500">Laporan pembekalan hanya untuk tim yang lolos Tahap I.</p>
                </div>
            </div>
        </div>
    <?php else: ?>

        <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">Form Laporan Pembekalan</h3>
                <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5">Upload foto kegiatan dan ringkasan pembekalan</p>
            </div>

            <form method="post" action="<?= base_url('mahasiswa/pembekalan/save') ?>" enctype="multipart/form-data" class="p-5 sm:p-7 space-y-6">
                <?= csrf_field() ?>

                <!-- Photo Upload -->
                <div>
                    <label class="text-xs font-black text-slate-500 uppercase tracking-wider block mb-3">
                        Foto Kegiatan Pembekalan <span class="text-rose-500">*</span>
                        <span class="text-[10px] font-normal text-slate-400 ml-2">(Max 5 foto, JPG/PNG, Max 2MB per foto)</span>
                    </label>

                    <!-- Existing Photos -->
                    <?php if (!empty($photos)): ?>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-4">
                            <?php foreach ($photos as $photo): ?>
                                <div class="relative group">
                                    <img src="<?= base_url('mahasiswa/pembekalan/photo/' . $photo->id) ?>" alt="Foto" class="w-full h-32 object-cover rounded-xl">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center gap-2">
                                        <a href="<?= base_url('mahasiswa/pembekalan/photo/' . $photo->id) ?>" download class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center hover:bg-emerald-600">
                                            <i class="fas fa-download text-xs"></i>
                                        </a>
                                        <button type="button" @click="deletePhoto(<?= $photo->id ?>)" class="w-8 h-8 rounded-full bg-rose-500 text-white flex items-center justify-center hover:bg-rose-600">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Upload New Photos -->
                    <?php if (count($photos) < 5): ?>
                        <div
                            class="relative group cursor-pointer"
                            @click="$refs.photoInput.click()"
                            @dragover.prevent
                            @drop.prevent="handlePhotoDrop($event)">
                            <input
                                type="file"
                                x-ref="photoInput"
                                name="photos[]"
                                class="hidden"
                                accept=".jpg,.jpeg,.png"
                                multiple
                                @change="handlePhotoSelected($event)">
                            <div class="flex flex-col items-center justify-center gap-2 p-6 rounded-xl border-2 border-dashed border-slate-300 bg-slate-50/50 group-hover:border-emerald-400 group-hover:bg-emerald-50/30 transition-all duration-200">
                                <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-camera text-emerald-600 text-xl"></i>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm font-semibold text-slate-600 group-hover:text-emerald-700">
                                        <span x-text="selectedPhotos.length > 0 ? selectedPhotos.length + ' foto dipilih' : 'Klik atau drop foto di sini'"></span>
                                    </p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">JPG/PNG, Max 2MB per foto</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Summary -->
                <div>
                    <label class="text-xs font-black text-slate-500 uppercase tracking-wider block mb-2">
                        Ringkasan Pembekalan <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="summary" rows="5" x-model="summary"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all"
                        placeholder="Tuliskan ringkasan/pembelajaran dari kegiatan pembekalan..."><?= esc($trainingReport->summary ?? '') ?></textarea>
                    <p class="text-[10px] text-slate-400 mt-1">Minimum 50 karakter. Jelaskan materi yang dipelajari dan manfaatnya.</p>
                </div>

                <!-- Submit Buttons -->
                <div class="pt-4 border-t border-slate-100">
                    <div class="flex flex-wrap items-center gap-3">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save mr-2"></i> Simpan Laporan
                        </button>
                    </div>
                </div>
            </form>
        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function pembekalanMahasiswa() {
        return {
            selectedPhotos: [],
            summary: '<?= addslashes($trainingReport->summary ?? '') ?>',

            handleMouseMove(e) {
                const card = e.currentTarget;
                const rect = card.getBoundingClientRect();
                card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            },

            handlePhotoSelected(e) {
                const files = e.target.files;
                if (files) {
                    this.selectedPhotos = Array.from(files);
                }
            },

            handlePhotoDrop(e) {
                const files = e.dataTransfer.files;
                if (files) {
                    this.selectedPhotos = Array.from(files);
                    // Update file input for form submission
                    const dt = new DataTransfer();
                    this.selectedPhotos.forEach(f => dt.items.add(f));
                    this.$refs.photoInput.files = dt.files;
                }
            },

            deletePhoto(photoId) {
                if (!confirm('Yakin ingin menghapus foto ini?')) {
                    return;
                }

                const formData = new FormData();
                formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                fetch('<?= base_url('mahasiswa/pembekalan/photo/') ?>' + photoId + '/delete', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(r => r.json())
                    .then(d => {
                        if (d.success) {
                            window.location.reload();
                            return;
                        }
                        window.dispatchEvent(new CustomEvent('toast-notify', {
                            detail: {
                                message: d.message || 'Gagal menghapus foto',
                                type: 'error'
                            }
                        }));
                    })
                    .catch(() => {
                        window.dispatchEvent(new CustomEvent('toast-notify', {
                            detail: {
                                message: 'Terjadi kesalahan server',
                                type: 'error'
                            }
                        }));
                    });
            }
        }
    }
</script>
<?= $this->endSection() ?>