<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-5xl mx-auto" x-data="pitchingDeskForm()">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Pitching <span class="text-gradient">Desk</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap 3 - Presentasi proposal di depan reviewer</p>
        </div>
    </div>

    <?php if (!$proposal): ?>
    <!-- ================================================================
         NO PROPOSAL STATE
    ================================================================= -->
    <div class="card-premium p-5 sm:p-7 animate-stagger delay-100">
        <div class="text-center py-12">
            <i class="fas fa-folder-open text-6xl text-slate-300 mb-4"></i>
            <h3 class="text-lg font-bold text-slate-600 mb-2">Belum Ada Proposal Disetujui</h3>
            <p class="text-slate-400">Anda belum memiliki proposal yang lolos seleksi administrasi.</p>
            <a href="<?= base_url('mahasiswa/proposal') ?>" class="btn-primary mt-4 inline-flex items-center gap-2">
                <i class="fas fa-file-invoice"></i>
                Lihat Proposal Saya
            </a>
        </div>
    </div>
    <?php else: ?>

    <?php
    $isBerkembang = $proposal['kategori_wirausaha'] === 'berkembang';
    $pptDoc = $docsByKey['pitching_ppt'] ?? null;
    $videoDoc = $docsByKey['pitching_video'] ?? null;
    ?>

    <!-- ================================================================
         2. PERIOD INFO CARD
    ================================================================= -->
    <div class="card-premium p-5 sm:p-7 animate-stagger delay-100">
        <div class="flex items-start justify-between gap-4 flex-wrap">
            <div>
                <p class="text-xs font-black uppercase tracking-widest text-slate-400">Periode Aktif</p>
                <p class="text-lg font-bold text-slate-800 mt-1">
                    <?= $activePeriod ? esc($activePeriod['name']) . ' ' . esc($activePeriod['year']) : '-' ?>
                </p>
            </div>
            <div class="text-right">
                <p class="text-xs font-black uppercase tracking-widest text-slate-400">Jadwal Pitching Desk</p>
                <p class="text-sm font-bold text-slate-700 mt-1">
                    <?= $phase ? (formatIndonesianDate($phase['start_date']) . ' s/d ' . formatIndonesianDate($phase['end_date'])) : 'Belum dijadwalkan' ?>
                </p>
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold mt-2 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700 border border-emerald-100" : "bg-rose-50 text-rose-700 border border-rose-100" ?>">
                    <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                    <?= $isPhaseOpen ? 'Dibuka' : 'Ditutup' ?>
                </span>
            </div>
        </div>
    </div>

    <!-- ================================================================
         3. VALIDATION PROGRESS TRACKER
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-200">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-tasks text-teal-500 mr-2"></i>
                Progres Validasi
            </h3>
        </div>
        <div class="p-5 sm:p-7">
            <div class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0">
                <!-- Connector Line (Desktop) -->
                <div class="hidden md:block absolute top-6 left-0 w-full h-0.5 bg-slate-100 -z-0"></div>

                <?php
                $steps = [
                    [
                        'label'  => 'Validasi Dosen',
                        'status' => $proposal['pitching_dosen_status'],
                        'note'   => $proposal['pitching_dosen_catatan'],
                        'icon'   => 'fa-user-tie'
                    ],
                    [
                        'label'  => 'Validasi Admin',
                        'status' => $proposal['pitching_admin_status'],
                        'note'   => $proposal['pitching_admin_catatan'],
                        'icon'   => 'fa-award'
                    ]
                ];

                $stepColors = [
                    'pending'  => ['bg' => 'bg-amber-500', 'text' => 'text-amber-500', 'light' => 'bg-amber-50', 'icon' => 'fa-clock'],
                    'approved' => ['bg' => 'bg-emerald-500', 'text' => 'text-emerald-500', 'light' => 'bg-emerald-50', 'icon' => 'fa-check'],
                    'revision' => ['bg' => 'bg-orange-500', 'text' => 'text-orange-500', 'light' => 'bg-orange-50', 'icon' => 'fa-rotate'],
                    'rejected' => ['bg' => 'bg-rose-500', 'text' => 'text-rose-500', 'light' => 'bg-rose-50', 'icon' => 'fa-xmark']
                ];
                ?>

                <?php foreach ($steps as $index => $step): 
                    $color = $stepColors[$step['status']] ?? $stepColors['pending'];
                ?>
                <div class="relative z-10 flex flex-row md:flex-col items-center gap-4 md:gap-2 flex-1 w-full md:w-auto">
                    <div class="w-12 h-12 rounded-2xl <?= $color['bg'] ?> text-white flex items-center justify-center shadow-lg shadow-<?= explode('-', $color['bg'])[1] ?>-100">
                        <i class="fas <?= $step['icon'] ?> text-lg"></i>
                    </div>
                    <div class="text-left md:text-center mt-1">
                        <p class="text-xs font-black uppercase tracking-tighter text-slate-400"><?= $step['label'] ?></p>
                        <div class="flex items-center gap-1.5 md:justify-center mt-1">
                            <span class="text-[10px] font-black <?= $color['text'] ?> uppercase italic"><?= strtoupper($step['status']) ?></span>
                            <i class="fas <?= $color['icon'] ?> text-[10px] <?= $color['text'] ?>"></i>
                        </div>
                    </div>
                    
                    <?php if ($step['note']): ?>
                    <div class="md:absolute md:top-24 md:left-1/2 md:-translate-x-1/2 w-full md:w-48 p-3 rounded-xl <?= $color['light'] ?> border border-<?= explode('-', $color['text'])[1] ?>-100 text-[10px] text-slate-600 italic">
                        "<?= esc($step['note']) ?>"
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-8 md:mt-24 pt-6 border-t border-slate-50 text-[11px] text-slate-400 text-center">
                <i class="fas fa-info-circle mr-1"></i>
                Proposal Anda harus disetujui oleh Dosen Pendamping terlebih dahulu sebelum dapat divalidasi oleh Admin.
            </div>
        </div>
    </div>

    <!-- ================================================================
         4. PROPOSAL INFO CARD
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-300">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-file-invoice text-sky-500 mr-2"></i>
                Proposal Anda
            </h3>
        </div>
        <div class="p-5 sm:p-7">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Nama Usaha</p>
                    <p class="font-semibold text-(--text-heading)"><?= esc($proposal['nama_usaha'] ?: '-') ?></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Kategori Usaha</p>
                    <p class="font-semibold text-(--text-heading)"><?= esc($proposal['kategori_usaha'] ?: '-') ?></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Kategori Wirausaha</p>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-sm font-bold border <?= $isBerkembang ? 'bg-violet-50 text-violet-600 border-violet-200' : 'bg-sky-50 text-sky-600 border-sky-200' ?>">
                        <i class="fas fa-rocket text-xs"></i>
                        <?= $isBerkembang ? 'Berkembang' : 'Pemula' ?>
                    </span>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Total RAB</p>
                    <p class="font-display font-bold text-lg text-(--text-heading)">
                        <?= $proposal['total_rab'] ? 'Rp ' . number_format($proposal['total_rab'], 0, ',', '.') : '-' ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================
         4. UPLOAD PPT (BOTH CATEGORIES)
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-300">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-file-powerpoint text-orange-500 mr-2"></i>
                Presentasi PowerPoint
            </h3>
            <p class="text-[11px] text-(--text-muted) mt-0.5">Wajib untuk semua kategori wirausaha</p>
        </div>
        <div class="p-5 sm:p-7">
            <div class="p-4 rounded-xl bg-white border border-slate-100 transition-all hover:border-sky-100 group">
                <div class="flex items-start justify-between gap-4 flex-wrap">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500 shrink-0">
                            <i class="fas fa-file-powerpoint text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">File Presentasi (PPT/PPTX)</p>
                            <div class="flex items-center gap-2 mt-1">
                                <template x-if="pptStatus === 'uploaded'">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">
                                        <i class="fas fa-check-circle mr-1"></i> Tersimpan
                                    </span>
                                </template>
                                <template x-if="pptStatus === 'uploading'">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-700 animate-pulse">
                                        <i class="fas fa-spinner fa-spin mr-1"></i> Mengunggah...
                                    </span>
                                </template>
                                <template x-if="pptStatus === 'missing'">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-700">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> Belum Ada
                                    </span>
                                </template>
                            </div>
                            <p class="text-xs text-slate-500 mt-1">
                                <span x-text="pptFilename || 'Belum ada file terpilih'"></span>
                            </p>
                            <div class="flex items-center gap-3 mt-2" x-show="pptStatus === 'uploaded'">
                                <?php if ($pptDoc): ?>
                                <button type="button" @click="downloadFile('ppt')" class="text-xs font-bold text-sky-600 hover:text-sky-700 inline-flex items-center gap-1">
                                    <i class="fas fa-download text-[10px]"></i> Download
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <?php if ($isPhaseOpen): ?>
                        <label class="relative cursor-pointer">
                            <span class="btn-outline btn-sm inline-flex items-center gap-2 bg-white">
                                 <i class="fas fa-folder-open"></i>
                                Pilih File
                            </span>
                            <input type="file" name="ppt_file" accept=".ppt,.pptx,.pdf,application/pdf,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation" class="hidden" @change="handlePptUpload($event)">
                        </label>
                        <p class="text-[10px] text-slate-400">PPT, PPTX, atau PDF (Maks 10MB)</p>
                        <?php else: ?>
                        <p class="text-xs text-rose-600 flex items-center gap-1 font-bold">
                            <i class="fas fa-lock"></i> Upload ditutup
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================
         5. UPLOAD VIDEO & DETAIL KETERANGAN (BERKEMBANG ONLY)
    ================================================================= -->
    <?php if ($isBerkembang): ?>
    <div class="card-premium overflow-hidden animate-stagger delay-400 border-l-4 border-l-violet-500">
        <div class="px-5 sm:px-7 py-4 border-b border-violet-50 bg-violet-50/30">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-video text-violet-500 mr-2"></i>
                Video Usaha & Detail Keterangan
            </h3>
            <p class="text-[11px] text-violet-600 mt-0.5">Khusus kategori Berkembang - Wajib diunggah</p>
        </div>
        <div class="p-5 sm:p-7 space-y-6">

            <!-- Video Upload -->
             <div class="p-4 rounded-xl bg-white border border-slate-100 transition-all hover:border-violet-100 group">
                <div class="flex items-start gap-4 flex-wrap">
                    <div class="w-12 h-12 rounded-xl bg-violet-50 flex items-center justify-center text-violet-500 shrink-0">
                        <i class="fas fa-link text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-[280px]">
                        <p class="text-sm font-bold text-slate-800">Link Video Usaha</p>
                        <p class="text-xs text-slate-500 mt-0.5 mb-3">Masukkan link YouTube atau Google Drive (Pastikan akses publik/anyone with link)</p>
                        
                        <div class="flex items-center gap-2">
                            <div class="relative flex-1">
                                <i class="fas fa-video absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                <input type="url" 
                                       x-model="videoUrl" 
                                       class="form-input pl-9 pr-4 py-2 text-sm w-full" 
                                       placeholder="https://www.youtube.com/watch?v=... atau https://drive.google.com/..."
                                       :disabled="!<?= $isPhaseOpen ? 'true' : 'false' ?> || isSavingVideo">
                            </div>
                            <?php if ($isPhaseOpen): ?>
                            <button type="button" 
                                    @click="saveVideoUrl()" 
                                    class="btn-primary py-2 px-4 text-sm shrink-0"
                                    :disabled="isSavingVideo">
                                <i class="fas fa-save" :class="isSavingVideo ? 'fa-spinner fa-spin' : ''"></i>
                                <span class="hidden sm:inline ml-1" x-text="isSavingVideo ? 'Menyimpan...' : 'Simpan Link'"></span>
                            </button>
                            <?php endif; ?>
                        </div>

                        <div class="flex items-center gap-2 mt-3" x-show="videoUrl">
                            <template x-if="videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-600 border border-rose-100">
                                    <i class="fab fa-youtube mr-1"></i> YouTube
                                </span>
                            </template>
                            <template x-if="videoUrl.includes('drive.google.com') || videoUrl.includes('google.com/drive')">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-100">
                                    <i class="fab fa-google-drive mr-1"></i> Google Drive
                                </span>
                            </template>
                            <a :href="videoUrl" target="_blank" class="text-[10px] font-bold text-sky-600 hover:sky-700 flex items-center gap-1">
                                <i class="fas fa-external-link-alt text-[9px]"></i> Buka Link
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Keterangan -->
            <div>
                <label class="text-sm font-bold text-slate-800 flex items-center gap-2 mb-2">
                    <i class="fas fa-align-left text-violet-500"></i>
                    Detail Keterangan Usaha
                </label>
                <p class="text-xs text-slate-500 mb-3">Perbarui informasi detail usaha Anda untuk pitching desk</p>
                <textarea name="detail_keterangan" rows="5" class="form-textarea" x-model="detailKeterangan" placeholder="Jelaskan detail usaha Anda, produk/jasa yang ditawarkan, target pasar, keunggulan kompetitif, dll..."><?= esc($proposal['detail_keterangan'] ?? '') ?></textarea>
                <?php if ($isPhaseOpen): ?>
                <div class="flex justify-end mt-3">
                    <button type="button" @click="saveDetailKeterangan()" class="btn-primary btn-sm" :disabled="isSavingDetail">
                        <i class="fas fa-save mr-1"></i>
                        <span x-text="isSavingDetail ? 'Menyimpan...' : 'Simpan Perubahan'"></span>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ================================================================
         6. COMPLETION STATUS
    ================================================================= -->
    <div class="card-premium p-5 sm:p-7 bg-slate-50 border border-slate-100 animate-stagger delay-500">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="space-y-1">
                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Status Kelengkapan Pitching</h4>
                <p class="text-xs text-slate-500">Pastikan semua file sudah diunggah sebelum jadwal pitching dimulai</p>

                <div class="flex items-center gap-3 mt-3">
                    <div class="flex items-center gap-1 text-[10px] font-bold" :class="pptStatus === 'uploaded' ? 'text-emerald-600' : 'text-slate-400'">
                        <i class="fas" :class="pptStatus === 'uploaded' ? 'fa-check-circle' : 'fa-circle'"></i>
                        PPT/PDF Terunggah
                    </div>
                    <?php if ($isBerkembang): ?>
                    <div class="flex items-center gap-1 text-[10px] font-bold" :class="videoUrl ? 'text-emerald-600' : 'text-slate-400'">
                        <i class="fas" :class="videoUrl ? 'fa-check-circle' : 'fa-circle'"></i>
                        Link Video Tersimpan
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-right">
                <template x-if="isComplete">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 border border-emerald-200">
                        <i class="fas fa-check-circle text-emerald-500"></i>
                        <span class="text-sm font-bold text-emerald-700">Siap Pitching!</span>
                    </div>
                </template>
                <template x-if="!isComplete">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-50 border border-amber-200">
                        <i class="fas fa-exclamation-triangle text-amber-500"></i>
                        <span class="text-sm font-bold text-amber-700">Belum Lengkap</span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div><!-- /page wrapper -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function pitchingDeskForm() {
    <?php
    $isBerkembang = isset($proposal) && $proposal['kategori_wirausaha'] === 'berkembang';
    $pptDoc = $docsByKey['pitching_ppt'] ?? null;
    $videoDoc = $docsByKey['pitching_video'] ?? null;
    ?>
    return {
        pptStatus: '<?= $pptDoc ? 'uploaded' : 'missing' ?>',
        pptFilename: <?= json_encode($pptDoc['original_name'] ?? '') ?>,
        videoUrl: <?= json_encode($proposal['video_url'] ?? '') ?>,
        detailKeterangan: <?= json_encode($proposal['detail_keterangan'] ?? '') ?>,
        isSavingDetail: false,
        isSavingVideo: false,

        get isComplete() {
            const pptReady = this.pptStatus === 'uploaded';
            <?php if ($isBerkembang): ?>
            const videoReady = !!this.videoUrl;
            return pptReady && videoReady;
            <?php else: ?>
            return pptReady;
            <?php endif; ?>
        },

        handlePptUpload(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Validate file size
            if (file.size > 10 * 1024 * 1024) {
                Swal.fire('Error', 'Ukuran file maksimal 10MB', 'error');
                return;
            }

            // Validate extension
            const ext = file.name.split('.').pop().toLowerCase();
            if (!['ppt', 'pptx', 'pdf'].includes(ext)) {
                Swal.fire('Error', 'Format file harus PPT, PPTX, atau PDF', 'error');
                return;
            }

            this.pptStatus = 'uploading';

            const formData = new FormData();
            formData.append('ppt_file', file);

            fetch('<?= base_url('mahasiswa/pitching-desk/upload-ppt') ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.pptStatus = 'uploaded';
                    this.pptFilename = data.filename;
                    Swal.fire('Berhasil!', data.message, 'success');
                } else {
                    this.pptStatus = 'missing';
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(() => {
                this.pptStatus = 'missing';
                Swal.fire('Error', 'Gagal mengunggah file', 'error');
            });
        },

        saveVideoUrl() {
            if (!this.videoUrl) {
                Swal.fire('Error', 'Link video tidak boleh kosong', 'error');
                return;
            }

            // Basic domain check
            const isYoutube = this.videoUrl.includes('youtube.com') || this.videoUrl.includes('youtu.be');
            const isGDrive = this.videoUrl.includes('drive.google.com') || this.videoUrl.includes('google.com/drive');

            if (!isYoutube && !isGDrive) {
                Swal.fire('Error', 'Hanya diperbolehkan link YouTube atau Google Drive', 'error');
                return;
            }

            this.isSavingVideo = true;

            fetch('<?= base_url('mahasiswa/pitching-desk/update-video-url') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'video_url=' + encodeURIComponent(this.videoUrl)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success');
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error', 'Gagal menyimpan link video', 'error');
            })
            .finally(() => {
                this.isSavingVideo = false;
            });
        },

        saveDetailKeterangan() {
            this.isSavingDetail = true;

            fetch('<?= base_url('mahasiswa/pitching-desk/update-detail') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'detail_keterangan=' + encodeURIComponent(this.detailKeterangan)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success');
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error', 'Gagal menyimpan perubahan', 'error');
            })
            .finally(() => {
                this.isSavingDetail = false;
            });
        },

        downloadFile(type) {
            <?php if ($pptDoc): ?>
            if (type === 'ppt') {
                window.location.href = '<?= base_url('mahasiswa/proposal/doc/' . $pptDoc['id']) ?>';
            }
            <?php endif; ?>
            <?php if ($videoDoc): ?>
            if (type === 'video') {
                window.location.href = '<?= base_url('mahasiswa/proposal/doc/' . $videoDoc['id']) ?>';
            }
            <?php endif; ?>
        }
    };
}
</script>
<?= $this->endSection() ?>
