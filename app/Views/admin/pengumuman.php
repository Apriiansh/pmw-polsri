<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="pengumumanAdmin()">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Pengumuman Kelolosan Dana <span class="text-gradient">Tahap I</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Pengumuman lolos & info pembekalan</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6 animate-stagger delay-100">
        <div class="card-premium p-5 flex flex-col justify-between" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Periode</p>
            <p class="text-base font-bold text-slate-800 mt-1">
                <?= $activePeriod ? esc($activePeriod['name']) . ' ' . esc($activePeriod['year']) : '-' ?>
            </p>
            <div class="mt-4 pt-4 border-t border-slate-50">
                <p class="text-[11px] font-bold text-slate-500 italic"><?= esc($activePeriod['year'] ?? '') ?></p>
            </div>
        </div>

        <div class="card-premium p-5 border-l-4 <?= $isPhaseOpen ? 'border-l-emerald-500' : 'border-l-rose-500' ?>" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Jadwal Pengumuman</p>
            <p class="text-sm font-bold text-slate-800 mt-1">
                <?= $phase ? (formatIndonesianDate($phase['start_date']) . ' - ' . formatIndonesianDate($phase['end_date'])) : 'Belum dijadwalkan' ?>
            </p>
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-black mt-3 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700" : "bg-rose-50 text-rose-700" ?>">
                <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                <?= $isPhaseOpen ? 'TAHAPAN DIBUKA' : 'TAHAPAN DITUTUP' ?>
            </span>
        </div>

        <div class="card-premium p-5 border-l-4 <?= ($announcement && (int) $announcement->is_published === 1) ? 'border-l-emerald-500' : 'border-l-amber-500' ?>" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Publish</p>
            <div class="flex items-center gap-2 mt-1">
                <i class="fas <?= ($announcement && (int) $announcement->is_published === 1) ? 'fa-circle-check text-emerald-500' : 'fa-pen-to-square text-amber-500' ?>"></i>
                <p class="text-sm font-bold text-slate-800 uppercase">
                    <?= ($announcement && (int) $announcement->is_published === 1) ? 'Published' : 'Draft' ?>
                </p>
            </div>
            <p class="text-[11px] text-slate-500 mt-2">
                <?= ($announcement && $announcement->published_at) ? 'Publish: ' . formatIndonesianDate(substr((string) $announcement->published_at, 0, 10)) : 'Belum dipublish' ?>
            </p>
        </div>
    </div>

    <?php if (!$activePeriod): ?>
        <div class="card-premium p-6 text-center">
            <p class="text-sm font-semibold text-slate-600">Belum ada periode aktif.</p>
        </div>
    <?php else: ?>

        <form method="post" action="<?= base_url('admin/pengumuman/' . $announcement->id . '/save') ?>" class="grid lg:grid-cols-2 gap-6 animate-stagger delay-200">
            <?= csrf_field() ?>

            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-base font-bold text-(--text-heading)">Konten Pengumuman</h3>
                </div>
                <div class="p-5 sm:p-7 space-y-4">
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase tracking-wider">Judul</label>
                        <input name="title" value="<?= esc($announcement->title) ?>" class="w-full mt-2 px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all" required>
                    </div>

                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase tracking-wider">Isi (opsional)</label>
                        <textarea name="content" rows="6" class="w-full mt-2 px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all" placeholder="Tulis informasi pengumuman..."><?= esc($announcement->content ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-base font-bold text-(--text-heading)">File SK & Info Pembekalan</h3>
                </div>
                <div class="p-5 sm:p-7 space-y-6">

                    <!-- SK File Upload -->
                    <div>
                        <label class="text-xs font-black text-slate-500 uppercase tracking-wider">File SK Direktur (PDF)</label>
                        <div class="mt-3">
                            <!-- Current File State -->
                            <template x-if="skStatus === 'uploaded'">
                                <div class="mb-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-between group transition-all hover:bg-emerald-100/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-emerald-500 shadow-sm">
                                            <i class="fas fa-file-pdf text-xl"></i>
                                        </div>
                                        <div>
                                            <span class="block text-sm font-bold text-emerald-800" x-text="skFilename"></span>
                                            <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-tight">Tersimpan</span>
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <a :href="'<?= base_url('admin/pengumuman/') ?>' + announcementId + '/sk'" class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-emerald-600 hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <button type="button" @click="deleteSk()" class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-rose-600 hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <!-- Upload Box -->
                            <div x-show="skStatus !== 'uploaded'" class="space-y-3">
                                <div
                                    class="relative group cursor-pointer"
                                    @click="$refs.skInput.click()"
                                    @dragover.prevent
                                    @drop.prevent="handleSkDrop($event)">
                                    <input
                                        type="file"
                                        x-ref="skInput"
                                        class="hidden"
                                        accept=".pdf"
                                        @change="handleSkSelected($event)">
                                    <div class="flex flex-col items-center justify-center gap-3 p-8 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 group-hover:border-emerald-400 group-hover:bg-emerald-50/30 transition-all duration-300">
                                        <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center shadow-sm group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                            <template x-if="skStatus === 'uploading'">
                                                <i class="fas fa-circle-notch fa-spin text-emerald-500 text-2xl"></i>
                                            </template>
                                            <template x-if="skStatus !== 'uploading'">
                                                <i class="fas fa-cloud-arrow-up text-emerald-400 text-2xl group-hover:text-emerald-500 transition-colors"></i>
                                            </template>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-xs font-bold text-slate-600 group-hover:text-emerald-700 transition-colors">
                                                <span x-text="skStatus === 'uploading' ? 'Sedang mengunggah...' : 'Pilih atau drop file SK di sini'"></span>
                                            </p>
                                            <p class="text-[10px] text-slate-400 mt-1 font-medium">Format: PDF (Maks 5MB)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Training Info -->
                    <div class="pt-6 border-t border-slate-100">
                        <label class="text-xs font-black text-slate-500 uppercase tracking-wider">Informasi Pembekalan (Tahap 6)</label>
                        <div class="mt-3 space-y-4">
                            <div>
                                <label class="text-[11px] font-semibold text-slate-600">Tanggal & Waktu</label>
                                <input type="datetime-local" name="training_date" value="<?= $announcement->training_date ? date('Y-m-d\TH:i', strtotime($announcement->training_date)) : '' ?>" class="w-full mt-1 px-4 py-2 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all">
                            </div>
                            <div>
                                <label class="text-[11px] font-semibold text-slate-600">Lokasi</label>
                                <input type="text" name="training_location" value="<?= esc($announcement->training_location ?? '') ?>" class="w-full mt-1 px-4 py-2 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all" placeholder="Contoh: Aula Rektorat Lt. 3">
                            </div>
                            <div>
                                <label class="text-[11px] font-semibold text-slate-600">Detail/Catatan</label>
                                <textarea name="training_details" rows="3" class="w-full mt-1 px-4 py-2 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all" placeholder="Detail tambahan seperti dress code, bahan yang dibawa, dll..."><?= esc($announcement->training_details ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Submit Buttons -->
                <div class="px-5 sm:px-7 py-4 border-t border-slate-100 bg-white/60 flex flex-wrap gap-2">
                    <button type="submit" class="btn-primary btn-sm">
                        <i class="fas fa-save mr-1.5"></i> Simpan
                    </button>
                    <?php if ((int) $announcement->is_published !== 1): ?>
                        <button type="button" onclick="document.getElementById('publishForm').submit()" class="btn-outline btn-sm bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-500 hover:text-white">
                            <i class="fas fa-bullhorn mr-1.5"></i> Publish
                        </button>
                    <?php endif; ?>
                </div>
            </div>

        </form>

        <!-- Hidden Publish Form (outside main form) -->
        <?php if ((int) $announcement->is_published !== 1): ?>
            <form id="publishForm" method="post" action="<?= base_url('admin/pengumuman/' . $announcement->id . '/publish') ?>" class="hidden">
                <?= csrf_field() ?>
            </form>
        <?php endif; ?>

        <!-- Teams & Bank Accounts Table -->
        <div class="card-premium overflow-hidden mt-8 animate-stagger delay-300" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between">
                <div>
                    <h3 class="font-display text-base font-bold text-(--text-heading)">Data Rekening dan Dokumentasi Pembekalan Tim yg Lolos Dana Tahap I</h3>
                    <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5">Daftar tim beserta informasi pencairan dana PMW</p>
                </div>
                <div class="px-3 py-1 rounded-full bg-sky-50 text-sky-700 text-xs font-bold border border-sky-100">
                    <?= count($passedTeams) ?> Tim
                </div>
            </div>

            <div class="p-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-y border-slate-100">
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Usaha & Tim</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Informasi Bank</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Rekening</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider text-center">Buku Rekening</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider text-center">Foto Pembekalan</th>
                                <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-wider">Ringkasan Pembekalan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php if (empty($passedTeams)): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mb-3">
                                                <i class="fas fa-inbox text-2xl text-slate-300"></i>
                                            </div>
                                            <h3 class="text-sm font-bold text-slate-700">Belum Ada Tim</h3>
                                            <p class="text-xs text-slate-500 mt-1">Belum ada tim yang lolos tahap Wawancara.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($passedTeams as $index => $team):
                                    $acc = $bankAccounts[$team['id']] ?? null;
                                    $trainingPhotos = $team['training_photos'] ?? [];
                                    $trainingSummary = $team['training_summary'] ?? null;
                                ?>
                                    <tr class="group hover:bg-slate-50/50 transition-colors">
                                        <td class="px-6 py-4 text-sm font-semibold text-slate-500">
                                            <?= $index + 1 ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-slate-800"><?= esc($team['nama_usaha']) ?></div>
                                            <div class="text-xs text-slate-500 mt-0.5">Ketua: <span class="font-semibold text-slate-600"><?= esc($team['ketua_nama'] ?? '-') ?></span></div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php if ($acc && !empty($acc->bank_name)): ?>
                                                <div class="font-bold text-sky-700 text-sm"><?= esc($acc->bank_name) ?></div>
                                                <div class="text-xs text-slate-500 mt-0.5"><?= esc($acc->branch_office) ?></div>
                                            <?php else: ?>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-200">
                                                    Belum Diinput
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php if ($acc && !empty($acc->account_number)): ?>
                                                <div class="font-mono text-sm tracking-widest font-black text-slate-700">
                                                    <?= esc($acc->account_number) ?>
                                                </div>
                                                <div class="text-xs font-semibold text-slate-600 mt-0.5 uppercase">
                                                    A.N. <?= esc($acc->account_holder_name) ?>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400 italic">Menunggu input...</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <?php if ($acc && !empty($acc->bank_book_scan)): ?>
                                                <a href="<?= base_url('admin/pengumuman/rekening/' . $acc->id . '/download') ?>"
                                                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white transition-all tooltip"
                                                    title="Download Buku Rekening">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                            <?php else: ?>
                                                <div class="w-8 h-8 rounded-lg bg-slate-50 text-slate-300 flex items-center justify-center mx-auto" title="Belum diupload">
                                                    <i class="fas fa-minus"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <?php if (!empty($trainingPhotos)): ?>
                                                <div class="flex flex-wrap gap-1.5 justify-center">
                                                    <?php foreach ($trainingPhotos as $photo): ?>
                                                        <a href="<?= base_url('admin/pengumuman/pembekalan/foto/' . $photo->id) ?>"
                                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-500 hover:text-white transition-all"
                                                            title="Download <?= esc($photo->original_name ?? 'foto') ?>">
                                                            <i class="fas fa-image text-xs"></i>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                                <p class="text-[10px] text-slate-400 mt-1"><?= count($trainingPhotos) ?> foto</p>
                                            <?php else: ?>
                                                <div class="w-8 h-8 rounded-lg bg-slate-50 text-slate-300 flex items-center justify-center mx-auto" title="Belum diupload">
                                                    <i class="fas fa-minus"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php if (!empty($trainingSummary)): ?>
                                                <p class="text-xs text-slate-700 leading-relaxed line-clamp-3"><?= esc($trainingSummary) ?></p>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400 italic">Belum diisi</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function pengumumanAdmin() {
        return {
            announcementId: <?= (int) $announcement->id ?>,
            skFile: null,
            skStatus: '<?= !empty($announcement->sk_file_path) ? 'uploaded' : 'missing' ?>',
            skFilename: <?= json_encode($announcement->sk_original_name ?? '') ?>,

            handleMouseMove(e) {
                const card = e.currentTarget;
                const rect = card.getBoundingClientRect();
                card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            },

            handleSkSelected(e) {
                this.skFile = e.target.files && e.target.files[0] ? e.target.files[0] : null;
                if (this.skFile) {
                    this.uploadSk();
                }
            },

            handleSkDrop(e) {
                const files = e.dataTransfer.files;
                if (files && files[0]) {
                    this.skFile = files[0];
                    const dt = new DataTransfer();
                    dt.items.add(files[0]);
                    this.$refs.skInput.files = dt.files;
                    this.uploadSk();
                }
            },

            uploadSk() {
                if (!this.skFile) return;

                // Validate PDF
                const ext = this.skFile.name.split('.').pop().toLowerCase();
                if (ext !== 'pdf') {
                    Swal.fire('Error', 'File SK harus berformat PDF.', 'error');
                    return;
                }

                // Validate Size (5MB)
                if (this.skFile.size > 5 * 1024 * 1024) {
                    Swal.fire('Error', 'Ukuran file SK maksimal 5MB.', 'error');
                    return;
                }

                this.skStatus = 'uploading';

                const formData = new FormData();
                formData.append('sk_file', this.skFile);
                formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                fetch('<?= base_url('admin/pengumuman/') ?>' + this.announcementId + '/upload-sk', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(r => r.json())
                    .then(d => {
                        if (d.success) {
                            this.skStatus = 'uploaded';
                            this.skFilename = d.filename;
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: d.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            return;
                        }
                        this.skStatus = 'missing';
                        Swal.fire('Error', d.message || 'Gagal mengunggah file.', 'error');
                    })
                    .catch(() => {
                        this.skStatus = 'missing';
                        Swal.fire('Error', 'Terjadi kesalahan server saat mengunggah.', 'error');
                    });
            },

            deleteSk() {
                Swal.fire({
                    title: 'Hapus File SK?',
                    text: "File yang dihapus tidak dapat dikembalikan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                        fetch('<?= base_url('admin/pengumuman/') ?>' + this.announcementId + '/delete-sk', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(r => r.json())
                            .then(d => {
                                if (d.success) {
                                    this.skStatus = 'missing';
                                    this.skFilename = '';
                                    Swal.fire('Terhapus!', d.message, 'success');
                                    return;
                                }
                                Swal.fire('Gagal', d.message || 'Gagal menghapus file.', 'error');
                            })
                            .catch(() => {
                                Swal.fire('Error', 'Terjadi kesalahan server saat menghapus.', 'error');
                            });
                    }
                });
            }
        }
    }
</script>
<?= $this->endSection() ?>