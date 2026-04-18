<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="activityLogbook()">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Logbook <span class="text-gradient">Kegiatan Wirausaha</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap 9 — Dokumentasi dan Laporan Kegiatan Praktis</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-4 gap-4 animate-stagger delay-100">
        <div class="card-premium p-4 flex items-center gap-3" @mousemove="handleMouseMove($event)">
            <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center shrink-0">
                <i class="fas fa-calendar-check text-sky-500 text-lg"></i>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Jadwal</p>
                <p class="text-xl font-black text-sky-600"><?= $stats['total'] ?></p>
            </div>
        </div>
        <div class="card-premium p-4 flex items-center gap-3" @mousemove="handleMouseMove($event)">
            <div class="w-10 h-10 rounded-xl bg-yellow-50 flex items-center justify-center shrink-0">
                <i class="fas fa-pencil-alt text-yellow-500 text-lg"></i>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Draft</p>
                <p class="text-xl font-black text-yellow-600"><?= $stats['draft'] ?></p>
            </div>
        </div>
        <div class="card-premium p-4 flex items-center gap-3" @mousemove="handleMouseMove($event)">
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center shrink-0">
                <i class="fas fa-clock text-blue-500 text-lg"></i>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Proses</p>
                <p class="text-xl font-black text-blue-600"><?= $stats['pending'] ?></p>
            </div>
        </div>
        <div class="card-premium p-4 flex items-center gap-3" @mousemove="handleMouseMove($event)">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0">
                <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Approved</p>
                <p class="text-xl font-black text-emerald-600"><?= $stats['approved'] ?></p>
            </div>
        </div>
    </div>

    <!-- Schedule List -->
    <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove($event)">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-white/70">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-calendar-days text-sky-500 mr-2"></i>Jadwal Kegiatan
                </h3>
                <p class="text-[10px] text-slate-400 font-semibold mt-0.5">Isi dan submit logbook untuk setiap kegiatan</p>
            </div>
            <span class="text-[10px] font-black bg-slate-100 text-slate-600 px-3 py-1 rounded-full uppercase tracking-widest">
                <?= $stats['total'] ?> Kegiatan
            </span>
        </div>

        <?php if (empty($schedules)): ?>
            <div class="p-12 text-center text-slate-400">
                <div class="w-20 h-20 rounded-full bg-slate-50 flex items-center justify-center mb-4 mx-auto">
                    <i class="fas fa-calendar-xmark text-3xl text-slate-300"></i>
                </div>
                <p class="text-sm font-bold uppercase tracking-widest text-slate-500">Belum ada jadwal kegiatan</p>
                <p class="text-[11px] text-slate-400 mt-1">Jadwal akan muncul setelah ditetapkan oleh Admin UPAPPK.</p>
            </div>
        <?php else: ?>
            <div class="divide-y divide-slate-50">
                <?php foreach ($schedules as $schedule): 
                    $logbook    = $schedule->logbook;
                    $canFill    = !$logbook || in_array($logbook->status, ['draft', 'revision']);
                    $isApproved = $logbook && $logbook->status === 'approved';
                    $isPending  = $logbook && in_array($logbook->status, ['pending', 'approved_by_dosen', 'approved_by_mentor']);
                    
                    // Status labels
                    $statusConfig = [
                        'not_submitted'      => ['bg-slate-100 text-slate-500', 'Belum Diisi', 'fa-circle'],
                        'draft'              => ['bg-yellow-100 text-yellow-700', 'Draft', 'fa-pencil'],
                        'pending'            => ['bg-blue-100 text-blue-700', 'Menunggu Dosen', 'fa-clock'],
                        'approved_by_dosen'  => ['bg-purple-100 text-purple-700', 'Approved Dosen', 'fa-check'],
                        'approved_by_mentor' => ['bg-indigo-100 text-indigo-700', 'Approved Mentor', 'fa-check-double'],
                        'approved'           => ['bg-emerald-100 text-emerald-700', 'Final Approved', 'fa-shield-check'],
                        'revision'           => ['bg-orange-100 text-orange-700', 'Perlu Revisi', 'fa-rotate'],
                    ];
                    $statusKey = $logbook ? $logbook->status : 'not_submitted';
                    $config = $statusConfig[$statusKey] ?? $statusConfig['not_submitted'];
                ?>
                <div class="p-6 hover:bg-slate-50/50 transition-colors" id="schedule-<?= $schedule->id ?>">
                    <div class="flex flex-col lg:flex-row gap-6">
                        <!-- Schedule Info -->
                        <div class="lg:w-64 shrink-0">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-xl bg-violet-100 flex items-center justify-center shrink-0">
                                    <i class="fas fa-store text-violet-500"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-slate-800"><?= esc($schedule->activity_category) ?></h4>
                                    <p class="text-[11px] text-slate-500 mt-0.5">
                                        <?= date('d M Y', strtotime($schedule->activity_date)) ?> • <?= $schedule->activity_time ?: '-' ?>
                                    </p>
                                    <p class="text-[10px] text-slate-400 mt-1">
                                        <i class="fas fa-map-marker-alt mr-1"></i><?= esc($schedule->location ?: 'Lokasi belum ditentukan') ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="mt-4">
                                <span class="pmw-status <?= $config[0] ?> text-[10px]">
                                    <i class="fas <?= $config[2] ?> mr-1"></i><?= $config[1] ?>
                                </span>
                            </div>

                            <!-- Progress Bar for pending -->
                            <?php if ($isPending): ?>
                            <div class="mt-3">
                                <div class="h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                    <?php 
                                    $progress = match($logbook->status) {
                                        'pending' => 33,
                                        'approved_by_dosen' => 66,
                                        'approved_by_mentor' => 90,
                                        default => 0
                                    };
                                    ?>
                                    <div class="h-full rounded-full bg-gradient-to-r from-blue-500 to-emerald-500 transition-all" style="width: <?= $progress ?>%"></div>
                                </div>
                                <p class="text-[9px] text-slate-400 mt-1 text-center">Progress verifikasi</p>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Logbook Form -->
                        <div class="flex-1">
                            <form action="<?= base_url('mahasiswa/kegiatan/logbook/' . $schedule->id) ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
                                <?= csrf_field() ?>
                                <input type="hidden" name="status" x-model="formStatus">

                                <!-- Activity Description -->
                                <div class="form-field">
                                    <label class="form-label text-xs">
                                        Penjelasan Detail Kegiatan
                                        <span class="required">*</span>
                                    </label>
                                    <textarea name="activity_description" rows="4" class="input-modern w-full" 
                                        placeholder="Jelaskan secara detail kegiatan wirausaha yang dilakukan: apa yang dijual, berapa omset, respon pelanggan, dll..."
                                        <?= !$canFill ? 'disabled' : '' ?>><?= $logbook ? esc($logbook->activity_description) : '' ?></textarea>
                                </div>

                                <div class="grid md:grid-cols-2 gap-5">
                                    <!-- Photo Activity -->
                                    <div class="form-field">
                                        <label class="form-label text-xs">
                                            Foto Kegiatan Wirausaha
                                            <span class="required">*</span>
                                        </label>
                                        
                                        <?php if ($logbook && $logbook->photo_activity): ?>
                                            <div class="relative group rounded-2xl overflow-hidden border border-slate-100 aspect-video mb-3">
                                                <img src="<?= base_url('mahasiswa/kegiatan/file/photo/' . $logbook->id) ?>" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-3">
                                                    <a href="<?= base_url('mahasiswa/kegiatan/file/photo/' . $logbook->id) ?>" target="_blank" class="text-white text-[10px] font-black uppercase tracking-widest">
                                                        <i class="fas fa-expand-alt mr-1"></i> Perbesar
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($canFill): ?>
                                            <label class="block cursor-pointer">
                                                <input type="file" name="photo_activity" accept=".jpg,.jpeg,.png" class="hidden" 
                                                       :required="formStatus !== 'draft' && !<?= ($logbook && $logbook->photo_activity) ? 'true' : 'false' ?>">
                                                <div class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 rounded-2xl p-4 bg-slate-50/50 hover:border-sky-400 hover:bg-sky-50/30 transition-all">
                                                    <i class="fas fa-camera text-slate-300"></i>
                                                    <p class="text-[11px] font-bold text-slate-500"><?= ($logbook && $logbook->photo_activity) ? 'Ganti Foto' : 'Upload Foto' ?></p>
                                                    <p class="text-[9px] text-slate-400">JPG, PNG</p>
                                                </div>
                                            </label>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Supervisor Visit Photo -->
                                    <div class="form-field">
                                        <label class="form-label text-xs">
                                            Foto Kunjungan Dosen
                                            <span class="text-slate-400 font-normal">(Opsional)</span>
                                        </label>
                                        
                                        <?php if ($logbook && $logbook->photo_supervisor_visit): ?>
                                            <div class="relative group rounded-2xl overflow-hidden border border-slate-100 aspect-video mb-3">
                                                <img src="<?= base_url('mahasiswa/kegiatan/file/supervisor/' . $logbook->id) ?>" class="w-full h-full object-cover">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-3">
                                                    <a href="<?= base_url('mahasiswa/kegiatan/file/supervisor/' . $logbook->id) ?>" target="_blank" class="text-white text-[10px] font-black uppercase tracking-widest">
                                                        <i class="fas fa-expand-alt mr-1"></i> Perbesar
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($canFill): ?>
                                            <label class="block cursor-pointer">
                                                <input type="file" name="photo_supervisor_visit" accept=".jpg,.jpeg,.png" class="hidden">
                                                <div class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 rounded-2xl p-4 bg-slate-50/50 hover:border-amber-400 hover:bg-amber-50/30 transition-all">
                                                    <i class="fas fa-user-tie text-slate-300"></i>
                                                    <p class="text-[11px] font-bold text-slate-500"><?= ($logbook && $logbook->photo_supervisor_visit) ? 'Ganti Foto' : 'Upload Foto' ?></p>
                                                    <p class="text-[9px] text-slate-400">JPG, PNG</p>
                                                </div>
                                            </label>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Video URL -->
                                <div class="form-field">
                                    <label class="form-label text-xs">
                                        Link Video Kegiatan
                                        <span class="text-slate-400 font-normal">(Opsional)</span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-icon"><i class="fab fa-youtube"></i></div>
                                        <input type="url" name="video_url" class="bg-transparent border-none outline-none w-full text-sm" 
                                               placeholder="https://youtube.com/watch?v=... atau link video lainnya"
                                               value="<?= $logbook ? esc($logbook->video_url) : '' ?>"
                                               <?= !$canFill ? 'disabled' : '' ?>>
                                    </div>
                                </div>

                                <!-- Verification Notes (Read Only) -->
                                <?php if ($logbook && ($logbook->dosen_note || $logbook->mentor_note)): ?>
                                <div class="grid md:grid-cols-2 gap-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                                    <?php if ($logbook->dosen_note): ?>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                            <i class="fas fa-chalkboard-user mr-1 text-sky-500"></i>Catatan Dosen
                                        </p>
                                        <p class="text-[12px] text-slate-600 italic">"<?= esc($logbook->dosen_note) ?>"</p>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($logbook->mentor_note): ?>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                            <i class="fas fa-handshake mr-1 text-amber-500"></i>Catatan Mentor
                                        </p>
                                        <p class="text-[12px] text-slate-600 italic">"<?= esc($logbook->mentor_note) ?>"</p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>

                                <!-- Action Buttons -->
                                <?php if ($canFill): ?>
                                <div class="pt-4 border-t border-slate-100">
                                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                        <!-- Save Draft -->
                                        <button type="submit"
                                                @click.prevent="formStatus = 'draft'; $nextTick(() => $el.closest('form').submit())"
                                                class="group/draft flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-2xl bg-slate-100 hover:bg-slate-200 border border-slate-200 text-slate-600 font-black text-[11px] uppercase tracking-widest transition-all">
                                            <div class="w-7 h-7 rounded-lg bg-slate-200 group-hover/draft:bg-slate-300 flex items-center justify-center shrink-0 transition-all">
                                                <i class="fas fa-floppy-disk text-slate-500 text-xs"></i>
                                            </div>
                                            <div class="text-left">
                                                <p class="text-[10px] font-black">Simpan Draft</p>
                                                <p class="text-[9px] font-medium text-slate-400 normal-case tracking-normal">Belum dikirim</p>
                                            </div>
                                        </button>

                                        <!-- Submit for Review -->
                                        <button type="submit"
                                                @click.prevent="formStatus = 'pending'; $nextTick(() => $el.closest('form').submit())"
                                                class="btn-primary group/submit flex-1 flex items-center justify-center gap-2.5 py-3.5 px-6 rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-lg transition-all">
                                            <i class="fas fa-paper-plane group-hover/submit:translate-x-0.5 group-hover/submit:-translate-y-0.5 transition-transform"></i>
                                            <div class="text-left">
                                                <p class="text-[10px] font-black">Kirim Logbook</p>
                                                <p class="text-[9px] font-medium opacity-70 normal-case tracking-normal">Dikirim ke Dosen untuk diverifikasi</p>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <?php elseif ($isPending): ?>
                                <div class="pt-4 border-t border-slate-100">
                                    <div class="flex items-center gap-3 p-4 rounded-2xl bg-blue-50 border border-blue-100">
                                        <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                            <i class="fas fa-clock text-blue-500 animate-pulse"></i>
                                        </div>
                                        <div>
                                            <p class="text-[11px] font-black text-blue-800 uppercase tracking-widest">Menunggu Verifikasi</p>
                                            <p class="text-[10px] text-blue-600 mt-0.5">Logbook Anda sedang dalam antrian review.</p>
                                        </div>
                                    </div>
                                </div>
                                <?php elseif ($isApproved): ?>
                                <div class="pt-4 border-t border-slate-100">
                                    <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100">
                                        <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                                            <i class="fas fa-shield-check text-emerald-500"></i>
                                        </div>
                                        <div>
                                            <p class="text-[11px] font-black text-emerald-800 uppercase tracking-widest">Logbook Terverifikasi</p>
                                            <p class="text-[10px] text-emerald-600 mt-0.5">Selamat! Kegiatan Anda telah di-approve.</p>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function activityLogbook() {
    return {
        formStatus: 'draft',
        handleMouseMove(e) {
            const card = e.currentTarget;
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
            card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
        }
    }
}
</script>
<?= $this->endSection() ?>
