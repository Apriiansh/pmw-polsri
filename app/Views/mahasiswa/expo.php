<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 pb-20 animate-stagger" x-data="{ 
    showSubmitModal: <?= empty($submission) ? 'true' : 'false' ?>,
    attachments: [
        { title: 'Foto Produk / Prototipe', file: null },
        { title: 'Foto Stand / Booth Expo', file: null }
    ],
    addAttachment() {
        this.attachments.push({ title: '', file: null });
    },
    removeAttachment(index) {
        this.attachments.splice(index, 1);
    },
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Expo & <span class="text-gradient">Awarding PMW</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap Akhir — Pameran Hasil Usaha & Penganugerahan</p>
        </div>
        <?php if ($schedule && !$schedule->is_closed && (!$schedule->submission_deadline || strtotime($schedule->submission_deadline) > time())): ?>
            <button @click="showSubmitModal = true" class="btn-primary shadow-lg shadow-sky-500/20">
                <i class="fas fa-upload mr-2"></i> Update Dokumentasi
            </button>
        <?php endif; ?>
    </div>

    <!-- Expo Schedule & Awards Card -->
    <div class="grid lg:grid-cols-3 gap-6 animate-stagger delay-100">
        <!-- Schedule Info -->
        <div class="lg:col-span-2 card-premium p-6 overflow-hidden relative group" @mousemove="handleMouseMove">
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] group-hover:opacity-[0.07] transition-opacity pointer-events-none">
                <i class="fas fa-calendar-star text-8xl transform rotate-12"></i>
            </div>
            
            <div class="flex flex-col md:flex-row md:items-center gap-6">
                <div class="w-16 h-16 rounded-2xl bg-sky-50 flex items-center justify-center shrink-0 border border-sky-100 shadow-sm">
                    <i class="fas fa-map-location-dot text-2xl text-sky-500"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-sky-600 uppercase tracking-widest">Informasi Expo</p>
                    <h3 class="font-display text-lg font-black text-(--text-heading)">
                        <?= $schedule->event_name ?? 'Jadwal Expo Belum Diumumkan' ?>
                    </h3>
                    <div class="flex flex-wrap items-center gap-4 pt-1">
                        <span class="flex items-center text-[10px] font-bold text-slate-500">
                            <i class="fas fa-map-marker-alt mr-1.5 text-sky-400"></i>
                            <?= $schedule->location ?? '-' ?>
                        </span>
                        <span class="flex items-center text-[10px] font-bold text-slate-500">
                            <i class="fas fa-calendar-day mr-1.5 text-sky-400"></i>
                            <?= $schedule->event_date ? date('d F Y', strtotime($schedule->event_date)) : '-' ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-sky-50 grid grid-cols-2 sm:grid-cols-3 gap-4">
                <div class="space-y-1">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Batas Pengumpulan</p>
                    <p class="text-[11px] font-bold <?= $schedule && strtotime($schedule->submission_deadline) < time() ? 'text-rose-500' : 'text-slate-700' ?>">
                        <?= $schedule->submission_deadline ? date('d M Y, H:i', strtotime($schedule->submission_deadline)) : '-' ?>
                    </p>
                </div>
                <div class="space-y-1">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status Sesi</p>
                    <span class="pmw-status <?= $schedule && $schedule->is_closed ? 'bg-rose-50 text-rose-600' : 'bg-emerald-50 text-emerald-600' ?> text-[9px] px-2 py-0.5">
                        <?= $schedule && $schedule->is_closed ? 'Ditutup' : 'Terbuka' ?>
                    </span>
                </div>
                <div class="space-y-1">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Dokumentasi</p>
                    <span class="pmw-status <?= $submission ? 'bg-sky-50 text-sky-600' : 'bg-slate-50 text-slate-400' ?> text-[9px] px-2 py-0.5">
                        <?= $submission ? 'Sudah Dikirim' : 'Belum Dikirim' ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Awards Earned -->
        <div class="card-premium p-6 flex flex-col group relative overflow-hidden" @mousemove="handleMouseMove">
            <div class="absolute -bottom-2 -right-2 opacity-5 transform rotate-12 group-hover:scale-125 transition-transform duration-700">
                <i class="fas fa-trophy text-7xl text-amber-500"></i>
            </div>
            
            <h3 class="font-display text-sm font-black text-(--text-heading) uppercase tracking-tight mb-4">
                Pencapaian <span class="text-amber-500">Award</span>
            </h3>

            <div class="space-y-3 flex-1 overflow-y-auto max-h-[160px] custom-scrollbar pr-2">
                <?php if (empty($awards)): ?>
                    <div class="flex flex-col items-center justify-center py-6 text-slate-300">
                        <i class="fas fa-award text-3xl mb-2 opacity-20"></i>
                        <p class="text-[10px] font-black uppercase tracking-widest">Belum Ada Award</p>
                        <p class="text-[9px] text-slate-400 italic text-center mt-1 leading-tight">Pengumuman dilakukan setelah expo selesai.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($awards as $award): ?>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-gradient-to-r from-amber-50 to-white border border-amber-100 shadow-sm">
                            <div class="w-8 h-8 rounded-lg bg-amber-500 text-white flex items-center justify-center text-xs font-black shrink-0">
                                <?= $award->rank ?>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[10px] font-black text-amber-800 uppercase leading-tight"><?= esc($award->category_name) ?></p>
                                <p class="text-[9px] text-amber-600/70 font-bold truncate"><?= esc($award->notes ?: 'Luar Biasa!') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Your Submission Detail -->
    <?php if ($submission): ?>
        <div class="space-y-6 animate-stagger delay-200">
            <h3 class="font-display text-base font-black text-(--text-heading)">
                Detail <span class="text-sky-500">Dokumentasi Terkirim</span>
            </h3>

            <div class="grid lg:grid-cols-4 gap-6">
                <div class="lg:col-span-1">
                    <div class="card-premium p-6 space-y-4">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <i class="fas fa-quote-left text-sky-400"></i> Ringkasan Usaha
                        </p>
                        <p class="text-[12px] text-slate-600 leading-relaxed italic">
                            "<?= esc($submission->summary) ?>"
                        </p>
                    </div>
                </div>
                <div class="lg:col-span-3">
                    <div class="grid sm:grid-cols-3 gap-4">
                        <?php foreach ($attachments as $att): ?>
                            <div class="card-premium p-2 group hover:border-sky-300 transition-all duration-300">
                                <div class="aspect-video rounded-lg bg-slate-100 mb-2 overflow-hidden relative border border-slate-200">
                                    <?php if ($att->file_type === 'image'): ?>
                                        <img src="<?= base_url('mahasiswa/kegiatan/gallery/' . $att->id) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <?php else: ?>
                                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-50">
                                            <i class="fas fa-file-pdf text-3xl mb-1 text-rose-400"></i>
                                            <span class="text-[8px] font-black uppercase tracking-widest">Document</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="px-1">
                                    <h4 class="text-[10px] font-black text-slate-700 truncate"><?= esc($att->title) ?></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Empty State -->
        <div class="card-premium p-16 flex flex-col items-center justify-center text-center animate-stagger delay-200">
            <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center mb-6 border-2 border-dashed border-slate-200 text-slate-200">
                <i class="fas fa-upload text-3xl"></i>
            </div>
            <h3 class="font-display text-xl font-black text-(--text-heading)">Kirim Dokumentasi Usaha Anda</h3>
            <p class="text-slate-400 text-sm max-w-md mt-2 leading-relaxed">
                Ceritakan perkembangan usaha Anda dan unggah foto dokumentasi rill selama masa implementasi untuk berkesempatan memenangkan Award PMW Polsri.
            </p>
            <button @click="showSubmitModal = true" class="btn-primary mt-8 px-8 py-3 shadow-xl shadow-sky-500/10">
                <i class="fas fa-paper-plane mr-2"></i> Mulai Submit Sekarang
            </button>
        </div>
    <?php endif; ?>

    <!-- Submit Modal -->
    <div x-show="showSubmitModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" style="display: none;">
        <div class="card-premium w-full max-w-2xl bg-white shadow-2xl animate-modal" @click.away="showSubmitModal = false">
            <div class="p-6 border-b border-sky-50 flex justify-between items-center bg-sky-50/30">
                <div class="flex flex-col">
                    <h3 class="font-display text-lg font-black text-sky-900 uppercase tracking-tight">Kirim Dokumentasi Expo</h3>
                    <p class="text-[10px] text-sky-600 font-bold">Lengkapi data dokumentasi usaha Anda</p>
                </div>
                <button @click="showSubmitModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="<?= base_url('mahasiswa/expo/submit') ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                <?= csrf_field() ?>
                
                <div class="form-field">
                    <label class="form-label">Ringkasan Perkembangan Usaha</label>
                    <textarea name="summary" rows="3" class="form-textarea text-xs" placeholder="Ceritakan singkat bagaimana progres usaha Anda hingga saat ini..." required><?= esc($submission->summary ?? '') ?></textarea>
                    <p class="text-[9px] text-slate-400 mt-1 italic">* Maksimal 500 karakter.</p>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <label class="form-label m-0">Lampiran Foto / Berkas</label>
                        <button type="button" @click="addAttachment" class="text-[10px] font-black text-sky-600 uppercase tracking-tighter hover:text-sky-800">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Lampiran
                        </button>
                    </div>

                    <div class="space-y-3 max-h-[250px] overflow-y-auto custom-scrollbar pr-2">
                        <template x-for="(att, index) in attachments" :key="index">
                            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200 group">
                                <div class="flex-1 space-y-2">
                                    <input type="text" name="attachment_titles[]" x-model="att.title" 
                                        class="w-full bg-transparent border-none p-0 text-[11px] font-bold text-slate-700 placeholder:text-slate-300 focus:ring-0" 
                                        placeholder="Judul Lampiran (Misal: Foto Booth)">
                                    <input type="file" name="attachments[]" class="text-[10px] text-slate-500 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100" required>
                                </div>
                                <button type="button" @click="removeAttachment(index)" x-show="attachments.length > 1" class="text-rose-400 hover:text-rose-600 transition-colors">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                    <p class="text-[9px] text-slate-400 mt-2 italic">* Pastikan file berformat Gambar (JPG/PNG) atau PDF.</p>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showSubmitModal = false" class="btn-outline flex-1">Batal</button>
                    <button type="submit" class="btn-primary flex-1 shadow-lg shadow-sky-500/10">
                        <i class="fas fa-save mr-2"></i> Simpan & Kirim
                    </button>
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
