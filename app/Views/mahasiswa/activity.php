<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="{
    showImageModal: false,
    modalImageUrl: '',
    openImageModal(url) {
        this.modalImageUrl = url;
        this.showImageModal = true;
    },
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- ─── PAGE HEADER ─────────────────────────────────────────────────── -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Logbook <span class="text-gradient">Kegiatan Wirausaha</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Dokumentasi dan Laporan Kegiatan Praktis</p>
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
    <div class="space-y-10 animate-stagger delay-200">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="card-premium p-4 border-rose-100 bg-rose-50/30 mb-6">
                <div class="flex items-center gap-3 text-rose-600 mb-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <span class="text-xs font-black uppercase tracking-widest">Kesalahan Input</span>
                </div>
                <ul class="list-disc list-inside text-[11px] text-rose-500 space-y-1 ml-1">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (empty($schedules)): ?>
            <div class="card-premium p-20 text-center text-slate-400" @mousemove="handleMouseMove">
                <div class="w-24 h-24 rounded-full bg-sky-50 flex items-center justify-center mb-6 mx-auto shadow-inner">
                    <i class="fas fa-calendar-xmark text-4xl text-sky-200"></i>
                </div>
                <h3 class="font-display text-xl font-black text-slate-800 uppercase tracking-widest">Belum Ada Jadwal</h3>
                <p class="text-[11px] text-slate-400 mt-2 max-w-xs mx-auto">Jadwal kegiatan akan muncul di sini setelah ditetapkan oleh Admin UPAPPK.</p>
            </div>
        <?php else: ?>
            <?php foreach ($schedules as $schedule): 
                $logbook    = $schedule->logbook;
                $canFill    = !$logbook || in_array($logbook->status, ['draft', 'revision']);
                $isApproved = $logbook && $logbook->status === 'approved';
                $isPending  = $logbook && in_array($logbook->status, ['pending', 'approved_by_dosen', 'approved_by_mentor']);
                
                $statusConfig = [
                    'not_submitted'      => ['bg-slate-100 text-slate-500', 'Belum Diisi', 'fa-circle'],
                    'draft'              => ['bg-amber-100 text-amber-700', 'Draft', 'fa-pencil'],
                    'pending'            => ['bg-sky-100 text-sky-700', 'Menunggu Dosen', 'fa-clock'],
                    'approved_by_dosen'  => ['bg-violet-100 text-violet-700', 'Approved Dosen', 'fa-check'],
                    'approved_by_mentor' => ['bg-indigo-100 text-indigo-700', 'Approved Mentor', 'fa-check-double'],
                    'approved'           => ['bg-emerald-100 text-emerald-700', 'Final Approved', 'fa-shield-check'],
                    'revision'           => ['bg-rose-100 text-rose-700', 'Perlu Revisi', 'fa-rotate'],
                ];
                $statusKey = $logbook ? $logbook->status : 'not_submitted';
                $config = $statusConfig[$statusKey] ?? $statusConfig['not_submitted'];
            ?>
            <div x-data="activityLogbook()" class="space-y-4" id="schedule-<?= $schedule->id ?>">
                <!-- 1. COMPACT SCHEDULE HEADER -->
                <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                    <div class="px-6 py-5 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white/70">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 rounded-2xl bg-sky-50 flex items-center justify-center text-sky-600 shrink-0 shadow-sm border border-sky-100">
                                <i class="fas fa-calendar-check text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-display text-lg font-black text-slate-800 uppercase tracking-tight leading-none"><?= esc($schedule->activity_category) ?></h4>
                                <div class="flex items-center gap-4 mt-2">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"><i class="fas fa-clock mr-1 text-sky-400"></i> <?= date('d M Y', strtotime($schedule->activity_date)) ?></span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"><i class="fas fa-map-marker-alt mr-1 text-rose-400"></i> <?= esc($schedule->location ?: 'Lokasi belum ditentukan') ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <?php if ($isPending): ?>
                                <div class="hidden sm:block text-right">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Verifikasi</p>
                                    <div class="w-24 h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                        <?php $progress = match($logbook->status) { 'pending' => 33, 'approved_by_dosen' => 66, 'approved_by_mentor' => 90, default => 0 } ?>
                                        <div class="h-full rounded-full bg-sky-500 shadow-[0_0_8px_rgba(14,165,233,0.4)]" style="width: <?= $progress ?>%"></div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <span class="pmw-status <?= $config[0] ?> px-4 py-2 text-[10px] font-black uppercase tracking-widest">
                                <i class="fas <?= $config[2] ?> mr-2"></i><?= $config[1] ?>
                            </span>
                        </div>
                    </div>
                    <?php if ($schedule->notes): ?>
                        <div class="px-6 py-3 bg-slate-50/50 border-t border-slate-50 flex items-center gap-3">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-2 py-0.5 rounded bg-slate-200/50">Admin Note</span>
                            <p class="text-[10px] text-slate-500 italic leading-relaxed">"<?= esc($schedule->notes) ?>"</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- 2. BENTO FORM AREA -->
                <form action="<?= base_url('mahasiswa/kegiatan/logbook/' . $schedule->id) ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="status" x-model="formStatus">
                    
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <!-- Left Bento: Content (span 8) -->
                        <div class="md:col-span-8 space-y-4">
                            <div class="card-premium p-6" @mousemove="handleMouseMove">
                                <label class="form-label mb-3">Detail Kegiatan <span class="required">*</span></label>
                                <textarea name="activity_description" rows="7" class="form-textarea w-full text-sm leading-relaxed" 
                                    placeholder="Jelaskan secara detail: apa yang dilakukan, capaian/omset hari ini, respon pelanggan, dan kendala yang dihadapi..."
                                    <?= !$canFill ? 'disabled' : '' ?>><?= $logbook ? esc($logbook->activity_description) : '' ?></textarea>
                            </div>
                            
                            <div class="card-premium p-6" @mousemove="handleMouseMove">
                                <label class="form-label mb-3">Dokumentasi Video <span class="text-[10px] font-normal text-slate-400 ml-1">(YouTube URL)</span></label>
                                <div class="input-group">
                                    <span class="input-icon"><i class="fab fa-youtube text-rose-500"></i></span>
                                    <input type="url" name="video_url" placeholder="https://youtube.com/watch?v=..."
                                        value="<?= $logbook ? esc($logbook->video_url) : '' ?>" <?= !$canFill ? 'disabled' : '' ?>>
                                </div>
                            </div>
                        </div>

                        <!-- Right Bento: Media & Photos (span 4) -->
                        <div class="md:col-span-4 space-y-4 flex flex-col">
                            <!-- MULTIPLE PHOTOS GALLERY -->
                            <div class="card-premium p-5 flex-1 flex flex-col" @mousemove="handleMouseMove">
                                <label class="form-label mb-3">Foto Kegiatan <span class="required">*</span> <span class="text-[9px] font-normal text-slate-400 ml-1">(Bisa pilih banyak)</span></label>
                                
                                <!-- Gallery Grid -->
                                <div class="grid grid-cols-2 gap-2 mb-4">
                                    <!-- Existing Photos -->
                                    <?php if ($logbook && !empty($logbook->gallery)): ?>
                                        <?php foreach ($logbook->gallery as $photo): ?>
                                            <div class="relative aspect-square rounded-xl overflow-hidden bg-slate-100 group shadow-sm border border-slate-200" x-data="{ isDeleted: false }" x-show="!isDeleted">
                                                <img src="<?= base_url('mahasiswa/kegiatan/gallery/' . $photo->id) ?>" class="w-full h-full object-cover">
                                                <?php if ($canFill): ?>
                                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                        <button type="button" @click="if(confirm('Hapus foto ini?')) { deleteExistingPhoto(<?= $photo->id ?>); isDeleted = true; }" class="w-8 h-8 rounded-full bg-rose-500 text-white flex items-center justify-center hover:bg-rose-600 transition-colors shadow-lg">
                                                            <i class="fas fa-trash-alt text-[10px]"></i>
                                                        </button>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <!-- New Previews -->
                                    <template x-for="(preview, index) in photoPreviews" :key="index">
                                        <div class="relative aspect-square rounded-xl overflow-hidden bg-sky-50 group border border-sky-100 shadow-sm">
                                            <img :src="preview" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                                <button type="button" @click="removeNewPhoto(index)" class="w-8 h-8 rounded-full bg-amber-500 text-white flex items-center justify-center hover:bg-amber-600 transition-colors shadow-lg">
                                                    <i class="fas fa-times text-[10px]"></i>
                                                </button>
                                            </div>
                                            <div class="absolute bottom-1 right-1 px-1.5 py-0.5 rounded bg-sky-500 text-[8px] font-black text-white uppercase tracking-widest shadow-sm">New</div>
                                        </div>
                                    </template>

                                    <!-- Empty State Placeholder -->
                                    <?php if ((!$logbook || empty($logbook->gallery))): ?>
                                        <template x-if="photoPreviews.length === 0">
                                            <div class="col-span-2 py-10 flex flex-col items-center justify-center text-slate-200 bg-slate-50/50 rounded-xl border border-dashed border-slate-200">
                                                <i class="fas fa-images text-3xl mb-2"></i>
                                                <p class="text-[9px] font-black uppercase opacity-50 tracking-widest">Wajib Upload Minimal 1</p>
                                            </div>
                                        </template>
                                    <?php endif; ?>
                                </div>

                                <?php if ($canFill): ?>
                                    <label class="btn-outline w-full cursor-pointer py-3 text-[10px] font-black uppercase tracking-widest">
                                        <i class="fas fa-camera mr-2 text-sky-500"></i> Tambah Foto
                                        <input type="file" name="photo_activity[]" class="hidden" @change="handlePhotoPreview($event)" accept="image/*" multiple>
                                    </label>
                                <?php endif; ?>
                            </div>

                            <div class="card-premium p-5" @mousemove="handleMouseMove">
                                <label class="form-label mb-3">Kunjungan Dosen <span class="text-[10px] font-normal text-slate-400 ml-1">(Opsional)</span></label>
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-12 rounded-lg bg-slate-50 border border-slate-100 overflow-hidden shadow-inner shrink-0">
                                        <template x-if="supervisorPreview">
                                            <img :src="supervisorPreview" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!supervisorPreview && <?= ($logbook && $logbook->id && !empty($logbook->photo_supervisor_visit)) ? 'true' : 'false' ?>">
                                            <img src="<?= $logbook ? base_url('mahasiswa/kegiatan/file/supervisor/' . $logbook->id) : '#' ?>" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!supervisorPreview && !<?= ($logbook && $logbook->id && !empty($logbook->photo_supervisor_visit)) ? 'true' : 'false' ?>">
                                            <div class="w-full h-full flex items-center justify-center text-slate-200"><i class="fas fa-user-tie"></i></div>
                                        </template>
                                    </div>
                                    <?php if ($canFill): ?>
                                        <label class="flex-1 btn-ghost border-dashed border-slate-200 py-2.5 text-[9px] uppercase font-black cursor-pointer">
                                            <i class="fas fa-plus mr-1 text-sky-400"></i> Lampirkan
                                            <input type="file" name="photo_supervisor_visit" class="hidden" @change="handleSupervisorPreview($event)" accept="image/*">
                                        </label>
                                    <?php else: ?>
                                        <p class="text-[10px] font-bold text-slate-500 uppercase"><?= ($logbook && $logbook->photo_supervisor_visit) ? 'Terlampir' : 'Tidak Ada' ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Feedback Bento (span 12) -->
                        <?php if ($logbook && ($logbook->dosen_note || $logbook->mentor_note || $logbook->reviewer_at || $logbook->admin_at)): ?>
                            <div class="md:col-span-12 card-premium p-6 bg-slate-50/30" @mousemove="handleMouseMove">
                                <div class="flex items-center gap-2 mb-6">
                                    <i class="fas fa-comment-dots text-sky-500"></i>
                                    <label class="form-label mb-0 uppercase tracking-widest text-[10px]">Feedback & Monitoring Lapangan</label>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                    <!-- 1. Dosen Note -->
                                    <?php if ($logbook->dosen_note): ?>
                                        <div class="space-y-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-1.5 h-1.5 rounded-full bg-violet-400"></div>
                                                <span class="text-[9px] font-black text-violet-500 uppercase tracking-widest">Dosen Pendamping</span>
                                            </div>
                                            <div class="p-4 rounded-2xl bg-white border border-slate-100 shadow-sm min-h-[100px]">
                                                <p class="text-[10px] text-slate-600 italic leading-relaxed">"<?= esc($logbook->dosen_note) ?>"</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- 2. Mentor Note -->
                                    <?php if ($logbook->mentor_note): ?>
                                        <div class="space-y-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-1.5 h-1.5 rounded-full bg-indigo-400"></div>
                                                <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest">Mentor Bisnis</span>
                                            </div>
                                            <div class="p-4 rounded-2xl bg-white border border-slate-100 shadow-sm min-h-[100px]">
                                                <p class="text-[10px] text-slate-600 italic leading-relaxed">"<?= esc($logbook->mentor_note) ?>"</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- 3. Admin Monitoring -->
                                    <?php if ($logbook->admin_at): ?>
                                        <div class="space-y-3 col-span-1 md:col-span-2 lg:col-span-1">
                                            <div class="flex items-center gap-2">
                                                <div class="w-1.5 h-1.5 rounded-full bg-rose-400"></div>
                                                <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest">Monitoring Admin</span>
                                            </div>
                                            <div class="p-4 rounded-2xl bg-rose-50/50 border border-rose-100 shadow-sm min-h-[100px] flex flex-col gap-3">
                                                <p class="text-[10px] text-rose-900 italic leading-relaxed">"<?= esc($logbook->admin_summary ?: 'Terdokumentasi di lapangan.') ?>"</p>
                                                
                                                <?php if (!empty($logbook->admin_photos)): ?>
                                                    <div class="grid grid-cols-4 gap-1.5 mt-auto pt-2 border-t border-rose-100">
                                                        <?php foreach ($logbook->admin_photos as $p): ?>
                                                            <div @click="openImageModal('<?= $p->url ?>')" class="aspect-square rounded-lg overflow-hidden border border-rose-200 cursor-pointer hover:ring-2 hover:ring-rose-400 transition-all">
                                                                <img src="<?= $p->url ?>" class="w-full h-full object-cover">
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- 4. Reviewer Monitoring -->
                                    <?php if ($logbook->reviewer_at): ?>
                                        <div class="space-y-3 col-span-1 md:col-span-2 lg:col-span-1">
                                            <div class="flex items-center gap-2">
                                                <div class="w-1.5 h-1.5 rounded-full bg-sky-400"></div>
                                                <span class="text-[9px] font-black text-sky-500 uppercase tracking-widest">Monitoring Reviewer</span>
                                            </div>
                                            <div class="p-4 rounded-2xl bg-sky-50/50 border border-sky-100 shadow-sm min-h-[100px] flex flex-col gap-3">
                                                <p class="text-[10px] text-sky-900 italic leading-relaxed">"<?= esc($logbook->reviewer_summary ?: 'Terdokumentasi di lapangan.') ?>"</p>
                                                
                                                <?php if (!empty($logbook->reviewer_photos)): ?>
                                                    <div class="grid grid-cols-4 gap-1.5 mt-auto pt-2 border-t border-sky-100">
                                                        <?php foreach ($logbook->reviewer_photos as $p): ?>
                                                            <div @click="openImageModal('<?= $p->url ?>')" class="aspect-square rounded-lg overflow-hidden border border-sky-200 cursor-pointer hover:ring-2 hover:ring-sky-400 transition-all">
                                                                <img src="<?= $p->url ?>" class="w-full h-full object-cover">
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Action Bento (span 12) -->
                        <?php if ($canFill): ?>
                            <div class="md:col-span-12 flex flex-col sm:flex-row gap-4">
                                <button type="submit" @click="formStatus = 'draft'" 
                                    class="btn-outline flex-1 py-4 text-[11px] font-black uppercase tracking-widest bg-white shadow-sm">
                                    <i class="fas fa-save mr-2 opacity-50"></i> Simpan Draft
                                </button>
                                <button type="button" @click="validateAndSubmit('pending')"
                                    class="btn-primary flex-[2] py-4 text-[11px] font-black uppercase tracking-widest shadow-xl shadow-sky-500/20 group">
                                    Kirim Laporan <i class="fas fa-paper-plane ml-2 group-hover:translate-x-1 transition-transform"></i>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <!-- IMAGE PREVIEW MODAL -->
    <template x-teleport="body">
        <div x-show="showImageModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[120]"
             :class="{ 'hidden': !showImageModal }"
             aria-labelledby="image-modal-title"
             role="dialog"
             aria-modal="true">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="showImageModal = false"></div>

            <!-- Modal Panel -->
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                        <!-- Modal Header -->
                        <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-display font-bold text-white" id="image-modal-title">
                                    <i class="fas fa-eye mr-2"></i>Preview Gambar
                                </h3>
                                <button type="button" @click="showImageModal = false" class="text-white/80 hover:text-white transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Modal Body -->
                        <div class="px-6 py-5 bg-slate-50">
                            <!-- Image Title Badge -->
                            <div class="mb-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border bg-emerald-50 text-emerald-600 border-emerald-200">
                                    <i class="fas fa-image text-[10px]"></i>
                                    <span class="truncate max-w-[300px]">Dokumentasi Kegiatan</span>
                                </span>
                            </div>

                            <!-- Image Content -->
                            <div class="rounded-xl overflow-hidden bg-white border border-slate-200 shadow-sm p-4 flex items-center justify-center min-h-[300px] max-h-[500px]">
                                <img :src="modalImageUrl" class="max-w-full max-h-[450px] rounded-lg object-contain">
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-white px-6 py-4 flex justify-between items-center border-t border-slate-100">
                            <div class="flex items-center gap-2 text-xs text-slate-400">
                                <i class="fas fa-info-circle"></i>
                                <span>Image Preview • Klik untuk memperbesar</span>
                            </div>
                            <div class="flex gap-2">
                                <a :href="modalImageUrl" download class="btn-accent text-sm">
                                    <i class="fas fa-download mr-2"></i>Download
                                </a>
                                <button type="button" @click="showImageModal = false" class="btn-outline text-sm">
                                    <i class="fas fa-times mr-2"></i>Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function activityLogbook() {
    return {
        formStatus: 'draft',
        photoPreviews: [],
        supervisorPreview: null,
        handlePhotoPreview(e) {
            const files = Array.from(e.target.files);
            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = (event) => {
                    this.photoPreviews.push(event.target.result);
                };
                reader.readAsDataURL(file);
            });
        },
        handleSupervisorPreview(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (event) => {
                this.supervisorPreview = event.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeNewPhoto(index) {
            this.photoPreviews.splice(index, 1);
        },
        async deleteExistingPhoto(photoId) {
            try {
                const response = await fetch(`<?= base_url('mahasiswa/kegiatan/photo/') ?>${photoId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                    }
                });
                const result = await response.json();
                if (!result.success) {
                    alert(result.message || 'Gagal menghapus foto.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus foto.');
            }
        },
        validateAndSubmit(status) {
            const videoInput = document.querySelector('input[name="video_url"]');
            const videoUrl = videoInput ? videoInput.value.trim() : '';

            if (status === 'pending' && videoUrl) {
                const isYoutube = videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be');
                const isGDrive = videoUrl.includes('drive.google.com') || videoUrl.includes('google.com/drive');

                if (!isYoutube && !isGDrive) {
                    Swal.fire({
                        title: 'Link Video Tidak Valid',
                        text: 'Hanya diperbolehkan link YouTube atau Google Drive untuk dokumentasi video.',
                        icon: 'error',
                        confirmButtonColor: '#0ea5e9'
                    });
                    return;
                }
            }

            this.formStatus = status;
            
            // Wait for Alpine to update formStatus then submit
            this.$nextTick(() => {
                this.$root.querySelector('form').submit();
            });
        }
    }
}
</script>
<?= $this->endSection() ?>
