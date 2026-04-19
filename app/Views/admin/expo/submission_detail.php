<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 pb-20 animate-stagger">
    
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="<?= base_url('admin/expo') ?>" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-sky-600 transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke List
                </a>
            </div>
            <h2 class="section-title text-xl sm:text-2xl">
                Detail <span class="text-gradient">Dokumentasi Expo</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]"><?= esc($submission->nama_usaha) ?> — Tahap Akhir</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="pmw-status bg-sky-50 text-sky-600 border-sky-200 text-[10px] px-3 py-1.5 font-black uppercase tracking-widest">
                <i class="fas fa-check-circle mr-2"></i> Terkirim
            </span>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        
        <!-- Team Info Card -->
        <div class="lg:col-span-1 space-y-6">
            <div class="card-premium p-6 space-y-6">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white shadow-lg mb-4">
                        <i class="fas fa-briefcase text-2xl"></i>
                    </div>
                    <h3 class="font-display text-lg font-black text-(--text-heading) leading-tight"><?= esc($submission->nama_usaha) ?></h3>
                    <p class="text-[11px] text-slate-400 font-bold mt-1 uppercase tracking-wider"><?= esc($submission->ketua_nama) ?></p>
                </div>

                <div class="space-y-4 pt-4 border-t border-slate-50">
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="text-slate-400 font-bold uppercase tracking-widest">NIM Ketua</span>
                        <span class="text-slate-700 font-black"><?= esc($submission->ketua_nim) ?></span>
                    </div>
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="text-slate-400 font-bold uppercase tracking-widest">Waktu Kirim</span>
                        <span class="text-slate-700 font-black"><?= date('d M Y, H:i', strtotime($submission->submitted_at)) ?></span>
                    </div>
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="text-slate-400 font-bold uppercase tracking-widest">Total Lampiran</span>
                        <span class="text-sky-600 font-black"><?= count($attachments) ?> File</span>
                    </div>
                </div>
            </div>

            <!-- Summary Text -->
            <div class="card-premium p-6 space-y-4">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                    <i class="fas fa-quote-left text-sky-400"></i> Ringkasan Tim
                </h4>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 text-[12px] text-slate-600 leading-relaxed italic">
                    "<?= esc($submission->summary ?: 'Tidak ada ringkasan yang diberikan oleh tim.') ?>"
                </div>
            </div>
        </div>

        <!-- Attachments Gallery -->
        <div class="lg:col-span-2 space-y-6">
            <h3 class="font-display text-sm font-black text-(--text-heading) uppercase tracking-widest flex items-center gap-3">
                <span class="w-8 h-8 rounded-lg bg-sky-50 flex items-center justify-center text-sky-500">
                    <i class="fas fa-images text-xs"></i>
                </span>
                Lampiran Dokumentasi
            </h3>

            <div class="grid sm:grid-cols-2 gap-4">
                <?php if (empty($attachments)): ?>
                    <div class="sm:col-span-2 card-premium p-12 flex flex-col items-center justify-center text-slate-300">
                        <i class="fas fa-folder-open text-4xl mb-3"></i>
                        <p class="text-sm font-bold uppercase tracking-widest">Tidak Ada Lampiran</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($attachments as $att): ?>
                        <div class="card-premium p-3 group hover:border-sky-300 transition-all duration-300">
                            <div class="aspect-video rounded-xl bg-slate-100 mb-3 overflow-hidden relative border border-slate-200">
                                <?php if ($att->file_type === 'image'): ?>
                                    <img src="<?= base_url('mahasiswa/kegiatan/gallery/' . $att->id) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <?php else: ?>
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-50">
                                        <i class="fas fa-file-pdf text-4xl mb-2 text-rose-400"></i>
                                        <span class="text-[9px] font-black uppercase tracking-widest">Document File</span>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                    <a href="<?= base_url('mahasiswa/kegiatan/gallery/' . $att->id) ?>" target="_blank" class="w-10 h-10 rounded-full bg-white text-sky-600 flex items-center justify-center shadow-lg hover:scale-110 transition-transform">
                                        <i class="fas fa-external-link-alt text-sm"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="px-2">
                                <h4 class="text-[11px] font-black text-slate-700 truncate"><?= esc($att->title) ?></h4>
                                <p class="text-[9px] text-slate-400 font-bold uppercase mt-0.5"><?= $att->file_type === 'image' ? 'Image' : 'Document' ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
