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

    <!-- Monitoring Kunjungan Lapangan (Reviewer View) -->
    <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
        <div class="px-6 py-4 border-b border-sky-50 bg-sky-50/30 flex justify-between items-center">
            <h3 class="font-display text-base font-bold text-sky-900">
                <i class="fas fa-map-location-dot text-sky-500 mr-2"></i>Hasil Monitoring Lapangan
            </h3>
            <?php if ($logbook && $logbook->reviewer_at): ?>
                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">
                    <i class="fas fa-check-circle mr-1"></i> Terverifikasi: <?= date('d/m/Y', strtotime($logbook->reviewer_at)) ?>
                </span>
            <?php endif; ?>
        </div>
        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Left: Photo -->
                <div class="space-y-4">
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Foto Dokumentasi Lapangan</p>
                    <div class="grid grid-cols-2 gap-3">
                        <?php if (!empty($logbook->reviewer_monitoring_photos)): ?>
                            <?php foreach ($logbook->reviewer_monitoring_photos as $photo): ?>
                            <div class="aspect-video rounded-xl overflow-hidden border-2 border-white shadow-sm group relative cursor-pointer" 
                                 onclick="window.open('<?= base_url('reviewer/kegiatan/gallery/' . $photo->id) ?>', '_blank')">
                                <img src="<?= base_url('reviewer/kegiatan/gallery/' . $photo->id) ?>" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                    <i class="fas fa-search-plus text-xl"></i>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php elseif ($logbook->reviewer_photo): ?>
                            <!-- Legacy support -->
                            <div class="aspect-video rounded-xl overflow-hidden border-2 border-white shadow-sm group relative cursor-pointer" 
                                 onclick="window.open('<?= base_url('reviewer/kegiatan/file/reviewer/' . $logbook->id) ?>', '_blank')">
                                <img src="<?= base_url('reviewer/kegiatan/file/reviewer/' . $logbook->id) ?>" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                    <i class="fas fa-search-plus text-xl"></i>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-span-full aspect-video rounded-2xl bg-slate-50 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-300">
                                <i class="fas fa-image text-3xl mb-2"></i>
                                <p class="text-[10px] font-bold uppercase tracking-widest">Belum Ada Foto</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Right: Summary -->
                <div class="space-y-4">
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Catatan / Temuan Lapangan</p>
                    <div class="p-5 rounded-2xl bg-sky-50/50 border border-sky-100 min-h-[150px]">
                        <?php if ($logbook && $logbook->reviewer_summary): ?>
                            <p class="text-[13px] text-slate-700 leading-relaxed italic">"<?= esc($logbook->reviewer_summary) ?>"</p>
                        <?php else: ?>
                            <div class="flex flex-col items-center justify-center h-full text-slate-400 py-10">
                                <i class="fas fa-comment-slash text-2xl mb-2 opacity-20"></i>
                                <p class="text-[11px] font-bold uppercase tracking-widest text-center">Belum ada catatan temuan</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="pt-4">
                         <p class="text-[10px] text-slate-400 italic leading-relaxed">* Monitoring lapangan dilakukan oleh reviewer untuk memvalidasi keberadaan dan progres rill usaha mahasiswa.</p>
                    </div>
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
                <!-- Photo Gallery Activity -->
                <div class="space-y-3 col-span-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Galeri Foto Kegiatan Wirausaha</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-4">
                        <?php if (!empty($logbook->gallery)): ?>
                            <?php foreach ($logbook->gallery as $photo): ?>
                                <div class="aspect-square rounded-2xl overflow-hidden border-2 border-slate-100 bg-slate-50 group relative shadow-sm cursor-pointer"
                                     onclick="openImageModal('<?= base_url('reviewer/kegiatan/gallery/' . $photo->id) ?>')">
                                    <img src="<?= base_url('reviewer/kegiatan/gallery/' . $photo->id) ?>" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                        <i class="fas fa-expand text-xl"></i>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php elseif ($logbook->photo_activity): ?>
                             <!-- Legacy support -->
                                <div class="aspect-square rounded-2xl overflow-hidden border-2 border-slate-100 bg-slate-50 group relative shadow-sm cursor-pointer"
                                     onclick="openImageModal('<?= base_url('reviewer/kegiatan/file/photo/' . $logbook->id) ?>')">
                                    <img src="<?= base_url('reviewer/kegiatan/file/photo/' . $logbook->id) ?>" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                        <i class="fas fa-expand text-xl"></i>
                                    </div>
                                </div>
                        <?php else: ?>
                            <div class="col-span-full py-10 rounded-2xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-400">
                                <i class="fas fa-images text-2xl mb-2 opacity-20"></i>
                                <span class="text-[11px] font-bold uppercase tracking-widest">Belum ada foto kegiatan</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="space-y-2 col-span-2 md:col-span-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Foto Kunjungan Dosen</label>
                    <?php if ($logbook->photo_supervisor_visit): ?>
                        <div class="aspect-video rounded-2xl overflow-hidden border border-slate-100 group relative cursor-pointer"
                             onclick="openImageModal('<?= base_url('reviewer/kegiatan/file/supervisor/' . $logbook->id) ?>')">
                            <img src="<?= base_url('reviewer/kegiatan/file/supervisor/' . $logbook->id) ?>" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                <i class="fas fa-expand text-2xl"></i>
                            </div>
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

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-md" onclick="closeImageModal()">
        <div class="relative max-w-5xl w-full flex items-center justify-center animate-modal" @click.stop>
            <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-white hover:text-rose-400 transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <img id="modalImage" src="" class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl border-4 border-white/10 object-contain bg-slate-800">
        </div>
    </div>

    <script>
    function openImageModal(src) {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('modalImage');
        img.src = src;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', (e) => { 
        if (e.key === 'Escape') closeImageModal();
    });
    </script>

<?= $this->endSection() ?>
