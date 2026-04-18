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
                Review <span class="text-gradient">Kunjungan Lapangan</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]"><?= esc($schedule->activity_category) ?> — <?= date('d M Y', strtotime($schedule->activity_date)) ?></p>
        </div>
        <a href="<?= base_url('reviewer/kegiatan') ?>" class="btn-ghost inline-flex items-center gap-2">
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
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Lokasi Pelaksanaan</p>
            <p class="text-lg font-bold text-slate-800 mt-1"><?= esc($schedule->location ?: '-') ?></p>
        </div>
        <div class="card-premium p-5" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Monitoring</p>
            <?php if ($logbook && $logbook->reviewer_at): ?>
                <span class="pmw-status bg-emerald-100 text-emerald-700 text-[11px] mt-2">Terdokumentasi</span>
            <?php else: ?>
                <span class="pmw-status bg-slate-100 text-slate-500 text-[11px] mt-2">Belum Direview</span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Monitoring Kunjungan Lapangan (Reviewer Form) -->
    <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
        <div class="px-6 py-4 border-b border-sky-50 bg-sky-50/30 flex justify-between items-center">
            <h3 class="font-display text-base font-bold text-sky-900">
                <i class="fas fa-camera text-sky-500 mr-2"></i>Dokumentasi Kunjungan Lapangan
            </h3>
        </div>
        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Left: Form -->
                <div>
                    <form action="<?= base_url('reviewer/kegiatan/review/' . $schedule->id) ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                        <?= csrf_field() ?>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Foto Kunjungan Lapangan</label>
                            <?php if ($logbook && $logbook->reviewer_photo): ?>
                                <div class="aspect-video rounded-2xl overflow-hidden border-2 border-sky-100 bg-sky-50 group relative mb-3">
                                    <img src="<?= base_url('reviewer/kegiatan/file/reviewer/' . $logbook->id) ?>" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                        <i class="fas fa-expand text-2xl"></i>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <input type="file" name="photo" class="input-modern w-full text-[11px]" accept="image/*">
                            <p class="text-[10px] text-slate-400 italic">Format: JPG, PNG. Maks 2MB. (Upload ulang untuk mengganti)</p>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ringkasan Detail Keterangan</label>
                            <textarea name="summary" rows="4" class="input-modern w-full text-[13px]" placeholder="Masukkan hasil review/kunjungan rill di lapangan..."><?= esc($logbook->reviewer_summary ?? '') ?></textarea>
                        </div>

                        <button type="submit" class="btn-primary w-full shadow-lg shadow-sky-500/20">
                            Simpan Dokumentasi Monitoring
                        </button>
                    </form>
                </div>

                <!-- Right: Status & Info -->
                <div class="bg-slate-50/50 rounded-2xl p-6 border border-slate-100 flex flex-col justify-center text-center space-y-4">
                    <div class="w-16 h-16 rounded-full bg-sky-100 text-sky-500 flex items-center justify-center mx-auto mb-2">
                        <i class="fas fa-info-circle text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-800">Panduan Monitoring</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed px-4">Reviewer bertugas memverifikasi kondisi rill di lapangan. Foto yang diunggah harus mencerminkan aktivitas wirausaha mahasiswa di lokasi.</p>
                    </div>
                    <?php if ($logbook && $logbook->reviewer_at): ?>
                    <div class="pt-4 border-t border-slate-200">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Terakhir Diperbarui</p>
                        <p class="text-[12px] font-bold text-slate-700 mt-1">
                            <?= date('d M Y, H:i', strtotime($logbook->reviewer_at)) ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Logbook Section (View Only) -->
    <?php if ($logbook): ?>
    <div class="card-premium overflow-hidden animate-stagger delay-300" @mousemove="handleMouseMove">
        <div class="px-6 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-clipboard-list text-sky-500 mr-2"></i>Logbook Mahasiswa (View Only)
            </h3>
        </div>
        <div class="p-6 space-y-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penjelasan Kegiatan</label>
                <div class="p-4 rounded-xl bg-slate-50 text-[13px] text-slate-700 leading-relaxed">
                    <?= nl2br(esc($logbook->activity_description)) ?>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Foto Kegiatan</label>
                    <?php if ($logbook->photo_activity): ?>
                        <div class="aspect-video rounded-2xl overflow-hidden border border-slate-100">
                            <img src="<?= base_url('reviewer/kegiatan/file/photo/' . $logbook->id) ?>" class="w-full h-full object-cover">
                        </div>
                    <?php else: ?>
                        <div class="aspect-video rounded-2xl bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-slate-400 text-[11px]">Foto belum ada</div>
                    <?php endif; ?>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Foto Kunjungan Dosen</label>
                    <?php if ($logbook->photo_supervisor_visit): ?>
                        <div class="aspect-video rounded-2xl overflow-hidden border border-slate-100">
                            <img src="<?= base_url('reviewer/kegiatan/file/supervisor/' . $logbook->id) ?>" class="w-full h-full object-cover">
                        </div>
                    <?php else: ?>
                        <div class="aspect-video rounded-2xl bg-slate-50 border border-dashed border-slate-200 flex items-center justify-center text-slate-400 text-[11px]">Foto belum ada</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>
