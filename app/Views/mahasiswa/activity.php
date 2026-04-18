<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="activityLogbook()">

    <!-- ─── PAGE HEADER ─────────────────────────────────────────────────── -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Logbook <span class="text-gradient">Kegiatan Wirausaha</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap 9 — Dokumentasi dan Laporan Kegiatan Praktis</p>
        </div>
    </div>

    <!-- ─── STAT SUMMARY CARDS ──────────────────────────────────────────── -->
    <div class="grid grid-cols-3 gap-5 animate-stagger delay-100">
        <div class="card-premium p-5 flex flex-col justify-between" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Kegiatan</p>
            <div class="flex items-end gap-2 mt-2">
                <p class="text-3xl font-black text-violet-600"><?= $statsTotal ?></p>
                <p class="text-[11px] font-bold text-slate-400 mb-1">Jadwal</p>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-50">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Dijadwalkan Admin</p>
            </div>
        </div>

        <div class="card-premium p-5 flex flex-col justify-between" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Logbook Diisi</p>
            <div class="flex items-end gap-2 mt-2">
                <p class="text-3xl font-black text-emerald-500"><?= $statsLogbook ?></p>
                <p class="text-[11px] font-bold text-slate-400 mb-1">/ <?= $statsTotal ?></p>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-50">
                <?php $pct = $statsTotal > 0 ? round(($statsLogbook / $statsTotal) * 100) : 0; ?>
                <div class="h-1.5 rounded-full bg-slate-100 overflow-hidden">
                    <div class="h-full rounded-full bg-emerald-400 transition-all" style="width: <?= $pct ?>%"></div>
                </div>
            </div>
        </div>

        <div class="card-premium p-5 flex flex-col justify-between" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Terverifikasi</p>
            <div class="flex items-end gap-2 mt-2">
                <p class="text-3xl font-black text-indigo-500"><?= $statsVerified ?></p>
                <p class="text-[11px] font-bold text-slate-400 mb-1">Laporan</p>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-50">
                <p class="text-[10px] font-bold text-violet-600 uppercase tracking-widest">
                    <i class="fas fa-shield-check mr-1"></i>Disetujui Final
                </p>
            </div>
        </div>
    </div>

    <!-- Schedule List -->
    <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-white/70">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-calendar-days text-violet-500 mr-2"></i>Jadwal Kegiatan
                </h3>
                <p class="text-[10px] text-slate-400 font-semibold mt-0.5">Isi dan submit logbook untuk setiap kegiatan</p>
            </div>
            <span class="text-[10px] font-black bg-slate-100 text-slate-600 px-3 py-1 rounded-full uppercase tracking-widest">
                <?= $statsTotal ?> Kegiatan
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
                <div class="p-8 hover:bg-slate-50/50 transition-colors" id="schedule-<?= $schedule->id ?>">
                    <div class="flex flex-col lg:flex-row gap-8">
                        <!-- LEFT: Schedule Info -->
                        <div class="lg:w-72 shrink-0 space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center shrink-0 shadow-sm">
                                    <i class="fas fa-store text-violet-600 text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight"><?= esc($schedule->activity_category) ?></h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"><?= date('d M Y', strtotime($schedule->activity_date)) ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white border border-slate-100 shadow-sm space-y-3">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-map-pin text-rose-400 text-[10px]"></i>
                                    <p class="text-[11px] font-bold text-slate-600"><?= esc($schedule->location ?: 'Lokasi belum ditentukan') ?></p>
                                </div>
                                <?php if ($schedule->notes): ?>
                                    <div class="p-3 rounded-xl bg-slate-50 text-[10px] text-slate-500 leading-relaxed italic border-l-2 border-violet-400">
                                        "<?= esc($schedule->notes) ?>"
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="space-y-3">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Status Laporan</p>
                                <span class="pmw-status <?= $config[0] ?> w-full justify-center py-2 text-[10px] font-black tracking-widest uppercase">
                                    <i class="fas <?= $config[2] ?> mr-2"></i><?= $config[1] ?>
                                </span>

                                <?php if ($isPending): ?>
                                    <div class="pt-2">
                                        <div class="h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                            <?php 
                                            $progress = match($logbook->status) {
                                                'pending' => 33,
                                                'approved_by_dosen' => 66,
                                                'approved_by_mentor' => 90,
                                                default => 0
                                            };
                                            ?>
                                            <div class="h-full rounded-full bg-gradient-to-r from-violet-500 to-emerald-500 transition-all shadow-[0_0_10px_rgba(139,92,246,0.3)]" style="width: <?= $progress ?>%"></div>
                                        </div>
                                        <div class="flex justify-between mt-2">
                                            <p class="text-[9px] font-bold text-slate-400 uppercase">Progres Verifikasi</p>
                                            <p class="text-[9px] font-black text-violet-600"><?= $progress ?>%</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- RIGHT: Logbook Form -->
                        <div class="flex-1">
                            <form action="<?= base_url('mahasiswa/kegiatan/logbook/' . $schedule->id) ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                                <?= csrf_field() ?>
                                <input type="hidden" name="status" x-model="formStatus">

                                <div class="grid lg:grid-cols-2 gap-6">
                                    <!-- Description & Video -->
                                    <div class="space-y-5">
                                        <div class="form-field">
                                            <label class="form-label text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2 block">
                                                Penjelasan Detail Kegiatan <span class="text-rose-500">*</span>
                                            </label>
                                            <textarea name="activity_description" rows="5" class="input-modern w-full text-sm leading-relaxed" 
                                                placeholder="Jelaskan secara detail: apa yang dilakukan, capaian/omset hari ini, respon pelanggan, dan kendala yang dihadapi..."
                                                <?= !$canFill ? 'disabled' : '' ?>><?= $logbook ? esc($logbook->activity_description) : '' ?></textarea>
                                        </div>

                                        <div class="form-field">
                                            <label class="form-label text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2 block">
                                                Link Video Dokumentasi <span class="text-slate-300 font-normal">(Opsional)</span>
                                            </label>
                                            <div class="relative group">
                                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-violet-500 text-slate-400">
                                                    <i class="fab fa-youtube"></i>
                                                </div>
                                                <input type="url" name="video_url" class="input-modern w-full pl-10 text-sm" 
                                                    placeholder="https://youtube.com/watch?v=..."
                                                    value="<?= $logbook ? esc($logbook->video_url) : '' ?>"
                                                    <?= !$canFill ? 'disabled' : '' ?>>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Photos -->
                                    <div class="space-y-5">
                                        <div class="form-field">
                                            <label class="form-label text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2 block">
                                                Foto Bukti Kegiatan <span class="text-rose-500">*</span>
                                            </label>
                                            
                                            <div class="relative group rounded-2xl overflow-hidden border border-slate-100 bg-slate-50 aspect-video mb-3 shadow-sm">
                                                <template x-if="photoPreview">
                                                    <img :src="photoPreview" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!photoPreview && <?= ($logbook && $logbook->photo_activity) ? 'true' : 'false' ?>">
                                                    <img src="<?= base_url('mahasiswa/kegiatan/file/photo/' . ($logbook->id ?? 0)) ?>" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!photoPreview && !<?= ($logbook && $logbook->photo_activity) ? 'true' : 'false' ?>">
                                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-300">
                                                        <i class="fas fa-image text-3xl mb-2"></i>
                                                        <p class="text-[9px] font-bold uppercase tracking-tighter text-slate-400">Belum ada foto kegiatan</p>
                                                    </div>
                                                </template>
                                            </div>

                                            <?php if ($canFill): ?>
                                                <label class="block cursor-pointer group/upload">
                                                    <input type="file" name="photo_activity" accept=".jpg,.jpeg,.png" class="hidden sr-only" 
                                                        @change="handlePhotoPreview($event, 'activity')"
                                                        :required="formStatus === 'pending' && !<?= ($logbook && $logbook->photo_activity) ? 'true' : 'false' ?>">
                                                    <div class="flex items-center gap-3 p-3 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50 group-hover/upload:border-violet-400 group-hover/upload:bg-violet-50/30 transition-all">
                                                        <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center shrink-0">
                                                            <i class="fas fa-camera text-slate-300 group-hover/upload:text-violet-500 transition-colors"></i>
                                                        </div>
                                                        <div class="flex-1">
                                                            <p class="text-[11px] font-bold text-slate-500 group-hover/upload:text-violet-700"><?= ($logbook && $logbook->photo_activity) ? 'Ganti Foto' : 'Pilih Foto' ?></p>
                                                            <p class="text-[9px] text-slate-400 uppercase tracking-tighter">JPG, PNG (Max 2MB)</p>
                                                        </div>
                                                        <span class="px-2 py-0.5 rounded-lg bg-slate-200 text-slate-500 text-[8px] font-black uppercase">Wajib</span>
                                                    </div>
                                                </label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Extra Photo & Reviewer -->
                                <div class="grid lg:grid-cols-2 gap-6 pt-2 border-t border-slate-50">
                                    <div class="form-field">
                                        <label class="form-label text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2 block">
                                            Foto Kunjungan Dosen <span class="text-slate-300 font-normal">(Opsional)</span>
                                        </label>
                                        
                                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm relative group overflow-hidden">
                                            <div class="w-16 h-12 rounded-lg bg-slate-50 border border-slate-100 overflow-hidden shrink-0">
                                                <template x-if="supervisorPreview">
                                                    <img :src="supervisorPreview" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!supervisorPreview && <?= ($logbook && $logbook->photo_supervisor_visit) ? 'true' : 'false' ?>">
                                                    <img src="<?= base_url('mahasiswa/kegiatan/file/supervisor/' . ($logbook->id ?? 0)) ?>" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!supervisorPreview && !<?= ($logbook && $logbook->photo_supervisor_visit) ? 'true' : 'false' ?>">
                                                    <div class="w-full h-full flex items-center justify-center text-slate-200">
                                                        <i class="fas fa-user-tie"></i>
                                                    </div>
                                                </template>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-[11px] font-bold text-slate-700 truncate"><?= ($logbook && $logbook->photo_supervisor_visit) ? 'Kunjungan Dosen Terlampir' : 'Belum ada bukti kunjungan' ?></p>
                                                <p class="text-[9px] text-slate-400 uppercase tracking-tighter">Bukti kehadiran dosen pendamping</p>
                                            </div>
                                            <?php if ($canFill): ?>
                                            <label class="cursor-pointer">
                                                <input type="file" name="photo_supervisor_visit" accept=".jpg,.jpeg,.png" class="hidden sr-only" @change="handlePhotoPreview($event, 'supervisor')">
                                                <span class="w-8 h-8 rounded-lg bg-violet-50 text-violet-500 flex items-center justify-center hover:bg-violet-500 hover:text-white transition-all shadow-sm">
                                                    <i class="fas fa-plus text-xs"></i>
                                                </span>
                                            </label>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Feedback & Reviewer -->
                                    <div class="space-y-3">
                                        <?php if ($logbook && ($logbook->dosen_note || $logbook->mentor_note)): ?>
                                            <div class="p-4 rounded-2xl bg-amber-50/50 border border-amber-100/50 space-y-3">
                                                <?php if ($logbook->dosen_note): ?>
                                                    <div class="flex gap-3">
                                                        <div class="w-6 h-6 rounded-lg bg-amber-100 flex items-center justify-center shrink-0"><i class="fas fa-comment text-amber-600 text-[10px]"></i></div>
                                                        <p class="text-[11px] text-amber-800 leading-relaxed font-medium">"<?= esc($logbook->dosen_note) ?>" <span class="text-[9px] font-black opacity-50 block mt-0.5">— Dosen Pendamping</span></p>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($logbook->mentor_note): ?>
                                                    <div class="flex gap-3">
                                                        <div class="w-6 h-6 rounded-lg bg-indigo-100 flex items-center justify-center shrink-0"><i class="fas fa-comment text-indigo-600 text-[10px]"></i></div>
                                                        <p class="text-[11px] text-indigo-800 leading-relaxed font-medium">"<?= esc($logbook->mentor_note) ?>" <span class="text-[9px] font-black opacity-50 block mt-0.5">— Mentor Bisnis</span></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($logbook && $logbook->reviewer_at): ?>
                                            <div class="p-4 rounded-2xl bg-indigo-50/50 border border-indigo-100/50 flex gap-4 items-center">
                                                <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 border border-indigo-200">
                                                    <img src="<?= base_url('mahasiswa/kegiatan/file/reviewer/' . $logbook->id) ?>" class="w-full h-full object-cover">
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1"><i class="fas fa-camera-retro mr-1"></i>Visit Documentation</p>
                                                    <p class="text-[11px] text-slate-700 italic truncate" title="<?= esc($logbook->reviewer_summary) ?>">"<?= esc($logbook->reviewer_summary) ?>"</p>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- ACTION BUTTONS -->
                                <?php if ($canFill): ?>
                                    <div class="pt-6 flex flex-col sm:flex-row gap-4 border-t border-slate-50">
                                        <button type="submit" @click="formStatus = 'draft'" 
                                            class="flex items-center justify-center gap-3 px-6 py-3.5 rounded-2xl bg-white border border-slate-200 text-slate-600 font-black text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all shadow-sm">
                                            <i class="fas fa-save opacity-50"></i> Simpan Draft
                                        </button>
                                        <button type="submit" @click="formStatus = 'pending'"
                                            class="flex-1 flex items-center justify-center gap-3 px-6 py-3.5 rounded-2xl bg-violet-600 text-white font-black text-[10px] uppercase tracking-widest hover:bg-violet-700 transition-all shadow-lg shadow-violet-200 group">
                                            Kirim Laporan <i class="fas fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                                        </button>
                                    </div>
                                <?php elseif ($isPending): ?>
                                    <div class="pt-6">
                                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-blue-50/50 border border-blue-100">
                                            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                                <i class="fas fa-clock text-blue-500 animate-pulse text-lg"></i>
                                            </div>
                                            <div>
                                                <p class="text-[11px] font-black text-blue-800 uppercase tracking-widest">Menunggu Verifikasi</p>
                                                <p class="text-[10px] text-blue-600 mt-0.5">Laporan Anda sedang ditinjau oleh tim pembimbing.</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif ($isApproved): ?>
                                    <div class="pt-6">
                                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100">
                                            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                                                <i class="fas fa-shield-check text-emerald-500 text-lg"></i>
                                            </div>
                                            <div>
                                                <p class="text-[11px] font-black text-emerald-800 uppercase tracking-widest">Laporan Disetujui</p>
                                                <p class="text-[10px] text-emerald-600 mt-0.5">Kegiatan ini telah selesai dan diverifikasi dengan baik.</p>
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
        photoPreview: null,
        supervisorPreview: null,
        handleMouseMove(e) {
            const card = e.currentTarget;
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
            card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
        },
        handlePhotoPreview(e, type) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (event) => {
                if (type === 'activity') this.photoPreview = event.target.result;
                if (type === 'supervisor') this.supervisorPreview = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
}
</script>
<?= $this->endSection() ?>
