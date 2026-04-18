<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="{
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Detail <span class="text-gradient">Kegiatan Wirausaha</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]"><?= esc($schedule->activity_category) ?> — <?= date('d M Y', strtotime($schedule->activity_date)) ?></p>
        </div>
        <a href="<?= base_url('admin/kegiatan') ?>" class="btn-ghost inline-flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Info Cards -->
    <div class="grid md:grid-cols-3 gap-6 animate-stagger delay-100">
        <div class="card-premium p-5" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Tim</p>
            <p class="text-lg font-bold text-slate-800 mt-1"><?= esc($proposal['nama_usaha']) ?></p>
            <p class="text-[11px] text-slate-500"><?= esc($proposal['kategori_wirausaha']) ?></p>
        </div>
        <div class="card-premium p-5" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Lokasi & Waktu</p>
            <p class="text-lg font-bold text-slate-800 mt-1"><?= esc($schedule->location ?: '-') ?></p>
            <p class="text-[11px] text-slate-500"><?= $schedule->activity_time ?></p>
        </div>
        <div class="card-premium p-5" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Verifikasi</p>
            <?php
            $logbookStatus = $logbook->status ?? 'not_submitted';
            $mainStatus = [
                'not_submitted'   => ['bg-slate-100 text-slate-500', 'Belum Diisi'],
                'draft'           => ['bg-yellow-100 text-yellow-700', 'Draft'],
                'pending'         => ['bg-blue-100 text-blue-700', 'Menunggu Dosen'],
                'approved_by_dosen' => ['bg-purple-100 text-purple-700', 'Approved Dosen'],
                'approved_by_mentor' => ['bg-indigo-100 text-indigo-700', 'Approved Mentor'],
                'approved'        => ['bg-emerald-100 text-emerald-700', 'Final Approved'],
                'revision'        => ['bg-orange-100 text-orange-700', 'Perlu Revisi'],
            ];
            $badge = $mainStatus[$logbookStatus] ?? $mainStatus['not_submitted'];
            ?>
            <span class="pmw-status <?= $badge[0] ?> text-[11px] mt-2"><?= $badge[1] ?></span>
        </div>
    </div>

    <!-- Logbook Content -->
    <?php if ($logbook): ?>
    <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
        <div class="px-6 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-clipboard-list text-sky-500 mr-2"></i>Isi Logbook
            </h3>
        </div>
        <div class="p-6 space-y-6">
            <!-- Description -->
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penjelasan Kegiatan</label>
                <div class="p-4 rounded-xl bg-slate-50 text-[13px] text-slate-700 leading-relaxed">
                    <?= nl2br(esc($logbook->activity_description)) ?>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Photo Activity -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Foto Kegiatan Wirausaha</label>
                    <?php if ($logbook->photo_activity): ?>
                        <div class="aspect-video rounded-2xl overflow-hidden border-2 border-slate-100 bg-slate-50 group relative">
                            <img src="<?= base_url('admin/kegiatan/file/photo/' . $logbook->id) ?>" class="w-full h-full object-cover">
                            <a href="<?= base_url('admin/kegiatan/file/photo/' . $logbook->id) ?>" target="_blank" 
                               class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                <i class="fas fa-expand text-2xl"></i>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="aspect-video rounded-2xl border-2 border-dashed border-slate-200 flex items-center justify-center text-slate-400">
                            <span class="text-[12px]">Foto belum diupload</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Supervisor Visit Photo -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Foto Kunjungan Dosen</label>
                    <?php if ($logbook->photo_supervisor_visit): ?>
                        <div class="aspect-video rounded-2xl overflow-hidden border-2 border-slate-100 bg-slate-50 group relative">
                            <img src="<?= base_url('admin/kegiatan/file/supervisor/' . $logbook->id) ?>" class="w-full h-full object-cover">
                            <a href="<?= base_url('admin/kegiatan/file/supervisor/' . $logbook->id) ?>" target="_blank" 
                               class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                <i class="fas fa-expand text-2xl"></i>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="aspect-video rounded-2xl border-2 border-dashed border-slate-200 flex items-center justify-center text-slate-400">
                            <span class="text-[12px]">Foto belum diupload</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Video URL -->
            <?php if ($logbook->video_url): ?>
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Video Kegiatan</label>
                <a href="<?= esc($logbook->video_url) ?>" target="_blank" class="flex items-center gap-3 p-4 rounded-xl border border-rose-100 bg-rose-50 text-rose-600 hover:bg-rose-100 transition-all group">
                    <i class="fab fa-youtube text-2xl"></i>
                    <span class="text-sm font-bold"><?= esc($logbook->video_url) ?></span>
                    <i class="fas fa-external-link-alt ml-auto opacity-0 group-hover:opacity-100 transition-all"></i>
                </a>
            </div>
            <?php endif; ?>

            <!-- Verification Notes -->
            <div class="grid md:grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                <div class="p-4 rounded-xl bg-blue-50/50 border border-blue-100">
                    <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-2">Catatan Dosen</p>
                    <p class="text-[13px] text-slate-600"><?= esc($logbook->dosen_note ?: '-') ?></p>
                    <?php if ($logbook->dosen_verified_at): ?>
                        <p class="text-[10px] text-slate-400 mt-2"><?= date('d M Y H:i', strtotime($logbook->dosen_verified_at)) ?></p>
                    <?php endif; ?>
                </div>
                <div class="p-4 rounded-xl bg-amber-50/50 border border-amber-100">
                    <p class="text-[10px] font-black text-amber-400 uppercase tracking-widest mb-2">Catatan Mentor</p>
                    <p class="text-[13px] text-slate-600"><?= esc($logbook->mentor_note ?: '-') ?></p>
                    <?php if ($logbook->mentor_verified_at): ?>
                        <p class="text-[10px] text-slate-400 mt-2"><?= date('d M Y H:i', strtotime($logbook->mentor_verified_at)) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Final Verification Form (only if approved by mentor) -->
    <?php if ($logbook->status === 'approved_by_mentor' || $logbook->status === 'approved' || $logbook->status === 'revision'): ?>
    <div class="card-premium overflow-hidden border-l-4 border-l-sky-500 animate-stagger delay-300" @mousemove="handleMouseMove">
        <div class="px-6 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">Verifikasi Final Admin</h3>
        </div>
        <div class="p-6">
            <form action="<?= base_url('admin/kegiatan/verify/' . $logbook->id) ?>" method="POST" class="space-y-6">
                <?= csrf_field() ?>
                
                <div class="grid grid-cols-2 gap-3">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="status" value="approved" class="peer sr-only" <?= $logbook->status === 'approved' ? 'checked' : '' ?>>
                        <div class="p-3 rounded-xl border-2 border-slate-100 bg-slate-50 text-slate-400 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-600 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-check-circle"></i>
                            <span class="text-sm font-bold uppercase tracking-wide">Approve Final</span>
                        </div>
                    </label>
                    <label class="relative cursor-pointer">
                        <input type="radio" name="status" value="revision" class="peer sr-only" <?= $logbook->status === 'revision' ? 'checked' : '' ?>>
                        <div class="p-3 rounded-xl border-2 border-slate-100 bg-slate-50 text-slate-400 peer-checked:border-rose-500 peer-checked:bg-rose-50 peer-checked:text-rose-600 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-times-circle"></i>
                            <span class="text-sm font-bold uppercase tracking-wide">Mintai Revisi</span>
                        </div>
                    </label>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Catatan Admin</label>
                    <textarea name="admin_note" rows="3" class="input-modern w-full" placeholder="Catatan verifikasi final..."><?= esc($logbook->admin_note ?? '') ?></textarea>
                </div>

                <button type="submit" class="btn-primary w-full py-3 shadow-lg shadow-sky-500/20">
                    Simpan Verifikasi Final
                </button>
            </form>
        </div>
    </div>
    <?php else: ?>
    <div class="card-premium p-6 text-center text-slate-400 animate-stagger delay-300">
        <i class="fas fa-lock text-2xl mb-2"></i>
        <p class="text-sm">Verifikasi final dapat dilakukan setelah mentor melakukan approval.</p>
    </div>
    <?php endif; ?>

    <?php else: ?>
    <!-- No logbook -->
    <div class="card-premium p-12 text-center text-slate-400 animate-stagger delay-200">
        <i class="fas fa-clipboard-question text-4xl mb-3 opacity-20"></i>
        <p class="text-sm">Logbook belum diisi oleh mahasiswa.</p>
    </div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>
