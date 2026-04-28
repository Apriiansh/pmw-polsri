<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
/**
 * @var \App\Entities\Expo\PmwExpoSchedule $schedule
 * @var \App\Entities\Expo\PmwExpoSubmission $submission
 * @var array $attachments
 * @var array $awards
 */

$isClosed = $schedule && $schedule->is_closed;
$isDeadlinePassed = $schedule && $schedule->submission_deadline && strtotime($schedule->submission_deadline) < time();
$canSubmit = !$isClosed && !$isDeadlinePassed;
?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="expoPage()">

    <!-- ─── PAGE HEADER ─────────────────────────────────────────────────── -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Expo & <span class="text-gradient">Awarding PMW</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap Akhir — Pameran Hasil Usaha & Penganugerahan</p>
        </div>
        <?php if ($canSubmit): ?>
            <button @click="showSubmitModal = true" class="btn-primary shadow-lg shadow-sky-500/20 group">
                <i class="fas fa-upload mr-2 group-hover:translate-y-[-2px] transition-transform"></i>
                <?= $submission ? 'Update Dokumentasi' : 'Kirim Dokumentasi' ?>
            </button>
        <?php endif; ?>
    </div>

    <!-- ─── STAT SUMMARY CARDS ──────────────────────────────────────────── -->
    <div class="grid lg:grid-cols-12 gap-6 animate-stagger delay-100">
        <!-- Card 1: Combined Info & Status -->
        <div class="lg:col-span-8 card-premium p-6 overflow-hidden relative group" @mousemove="handleMouseMove">
            <div class="grid md:grid-cols-2 gap-8 divide-x divide-slate-100">
                <!-- Left Section: Expo Info -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center shrink-0 border border-sky-100">
                            <i class="fas fa-map-location-dot text-sky-500"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-sky-600 uppercase tracking-widest">Informasi Expo</p>
                            <h3 class="font-display text-sm font-black text-(--text-heading) leading-tight mt-0.5">
                                <?= $schedule->event_name ?? 'Jadwal Belum Diumumkan' ?>
                            </h3>
                        </div>
                    </div>

                    <div class="space-y-2.5">
                        <div class="flex items-center text-[11px] font-bold text-slate-500">
                            <div class="w-5 h-5 flex items-center justify-center mr-2 text-sky-400"><i class="fas fa-map-marker-alt"></i></div>
                            <?= $schedule->location ?? '-' ?>
                        </div>
                        <div class="flex items-center text-[11px] font-bold text-slate-500">
                            <div class="w-5 h-5 flex items-center justify-center mr-2 text-sky-400"><i class="fas fa-calendar-day"></i></div>
                            <?= $schedule->event_date ? date('d F Y', strtotime($schedule->event_date)) : '-' ?>
                        </div>
                    </div>
                </div>

                <!-- Right Section: Submission Status -->
                <div class="md:pl-8 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl <?= $submission ? 'bg-emerald-50' : 'bg-slate-50' ?> flex items-center justify-center shrink-0 border <?= $submission ? 'border-emerald-100' : 'border-slate-100' ?>">
                            <i class="fas <?= $submission ? 'fa-check-double text-emerald-500' : 'fa-clock text-slate-400' ?>"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Status Pengiriman</p>
                            <h3 class="font-display text-sm font-black text-(--text-heading) leading-tight mt-0.5">
                                <?= $submission ? 'Dokumentasi Terkirim' : 'Belum Ada Dokumentasi' ?>
                            </h3>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Batas Pengumpulan</p>
                        <p class="text-[11px] font-bold <?= $isDeadlinePassed ? 'text-rose-500' : 'text-slate-700' ?>">
                            <?= $schedule->submission_deadline ? date('d M Y, H:i', strtotime($schedule->submission_deadline)) : 'Tanpa Batas Waktu' ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Awards Earned -->
        <div class="lg:col-span-4 card-premium p-6 group relative overflow-hidden" @mousemove="handleMouseMove">
            <h3 class="font-display text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">
                Pencapaian <span class="text-amber-500">Award</span>
            </h3>

            <div class="space-y-3 flex-1 overflow-y-auto max-h-[105px] custom-scrollbar pr-2">
                <?php if (empty($awards)): ?>
                    <div class="flex flex-col items-center justify-center py-4 text-slate-300">
                        <p class="text-[9px] font-black uppercase tracking-widest text-center">Belum Ada Award</p>
                        <p class="text-[8px] text-slate-400 italic text-center mt-1 leading-tight text-balance">Diumumkan setelah sesi expo berakhir.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($awards as $award): ?>
                        <div class="flex items-center gap-3 p-2.5 rounded-xl bg-linear-to-r from-amber-50/50 to-white border border-amber-100 shadow-sm">
                            <div class="w-7 h-7 rounded-lg bg-amber-500 text-white flex items-center justify-center text-[10px] font-black shrink-0 shadow-lg shadow-amber-500/20">
                                <?= $award->rank ?>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[10px] font-black text-amber-800 uppercase leading-tight"><?= esc($award->category_name) ?></p>
                                <p class="text-[8px] text-amber-600/70 font-bold truncate mt-0.5"><?= esc($award->notes ?: 'Pencapaian Luar Biasa!') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if ($submission && $submission->certificate_path): ?>
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <a href="<?= base_url('mahasiswa/expo/certificate') ?>" target="_blank" class="w-full py-2 px-3 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center gap-2 hover:bg-emerald-500 hover:text-white transition-all group/cert">
                        <i class="fas fa-certificate text-[10px]"></i>
                        <span class="text-[9px] font-black uppercase tracking-widest">Download E-Sertifikat</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ─── MAIN CONTENT ───────────────────────────────────────────── -->
    <?php if ($submission): ?>
        <div class="card-premium p-8 animate-stagger delay-200">
            <div class="flex items-center justify-between mb-8">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    Detail <span class="text-sky-500">Dokumentasi Terkirim</span>
                </h3>
                <div class="flex items-center gap-3">
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1.5 rounded-full border border-slate-100">
                        <i class="fas fa-paperclip mr-1 text-sky-400"></i> <?= count($attachments) ?> Lampiran
                    </span>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">
                        Diperbarui: <?= date('d M Y', strtotime($submission->updated_at)) ?>
                    </p>
                </div>
            </div>

            <div class="space-y-10">
                <!-- Summary Section -->
                <div class="relative p-6 rounded-2xl bg-slate-50/50 border border-slate-100">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-6 h-6 rounded-lg bg-sky-100 flex items-center justify-center">
                            <i class="fas fa-quote-left text-sky-500 text-[10px]"></i>
                        </div>
                        <p class="text-[10px] font-black text-slate-700 uppercase tracking-widest">Ringkasan Usaha</p>
                    </div>
                    <p class="text-[13px] text-slate-600 leading-relaxed italic pl-4">
                        "<?= esc($submission->summary) ?>"
                    </p>
                </div>

                <!-- Gallery Section -->
                <div class="grid sm:grid-cols-3 lg:grid-cols-4 gap-6">
                    <?php foreach ($attachments as $att): ?>
                        <div class="card-premium p-2.5 group hover:border-sky-300 transition-all duration-300 cursor-pointer overflow-hidden shadow-sm hover:shadow-xl hover:shadow-sky-500/5" 
                                @click="<?= $att->file_type === 'image' ? "openPreview('" . base_url('mahasiswa/expo/attachment/' . $att->id) . "', '" . esc($att->title, 'js') . "')" : "window.open('" . base_url('mahasiswa/expo/attachment/' . $att->id) . "', '_blank')" ?>">
                            <div class="aspect-video rounded-xl bg-slate-50 mb-3 overflow-hidden relative border border-slate-100 group-hover:border-sky-100">
                                <?php if ($att->file_type === 'image'): ?>
                                    <img src="<?= base_url('mahasiswa/expo/attachment/' . $att->id) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-sky-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-[2px]">
                                        <div class="w-10 h-10 rounded-full bg-white/20 border border-white/30 flex items-center justify-center transform scale-50 group-hover:scale-100 transition-all duration-300">
                                            <i class="fas fa-search-plus text-white text-sm"></i>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 bg-slate-50 group-hover:bg-rose-50/50 transition-colors">
                                        <i class="fas fa-file-pdf text-4xl mb-2 text-rose-400/50 group-hover:text-rose-500 transition-colors"></i>
                                        <span class="text-[9px] font-black uppercase tracking-widest text-slate-400 group-hover:text-rose-600">Dokumen PDF</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="px-1 pb-1">
                                <h4 class="text-[11px] font-bold text-slate-700 truncate group-hover:text-sky-600 transition-colors"><?= esc($att->title) ?></h4>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter mt-0.5">
                                    <?= $att->file_type === 'image' ? 'Pratinjau' : 'Buka Dokumen' ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- ─── EMPTY STATE ────────────────────────────────────────────── -->
        <div class="card-premium p-16 flex flex-col items-center justify-center text-center animate-stagger delay-200 overflow-hidden relative group" @mousemove="handleMouseMove">
            <div class="absolute inset-0 bg-linear-to-br from-sky-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
            
            <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center mb-6 border-2 border-dashed border-slate-200 text-slate-300 group-hover:border-sky-300 group-hover:text-sky-400 group-hover:bg-sky-50 transition-all duration-500">
                <i class="fas fa-folder-open text-3xl group-hover:scale-110 transition-transform"></i>
            </div>

            <h3 class="font-display text-2xl font-black text-(--text-heading) tracking-tight">Siapkan Dokumentasi Terbaik Anda!</h3>
            <p class="text-slate-400 text-sm max-w-md mt-3 leading-relaxed font-medium">
                Satu langkah terakhir untuk memenangkan Award PMW Polsri. Unggah ringkasan perkembangan usaha dan dokumentasi visual (foto/berkas) kegiatan Anda selama masa implementasi.
            </p>
            
            <button @click="showSubmitModal = true" class="btn-primary mt-8 px-8 py-3.5 shadow-xl shadow-sky-500/20 group hover:shadow-sky-500/40 transition-all">
                Mulai Submit Dokumentasi
            </button>

            <div class="mt-12 flex items-center gap-6 opacity-40 group-hover:opacity-100 transition-opacity grayscale group-hover:grayscale-0 duration-700">
                <div class="flex flex-col items-center">
                    <div class="w-1.5 h-1.5 rounded-full bg-sky-500 mb-1"></div>
                    <span class="text-[8px] font-black uppercase tracking-widest text-slate-500">Foto Produk</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-1.5 h-1.5 rounded-full bg-sky-500 mb-1"></div>
                    <span class="text-[8px] font-black uppercase tracking-widest text-slate-500">Foto Booth</span>
                </div>
                <div class="flex flex-col items-center">
                    <div class="w-1.5 h-1.5 rounded-full bg-sky-500 mb-1"></div>
                    <span class="text-[8px] font-black uppercase tracking-widest text-slate-500">Video Promosi</span>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- ─── MODALS ─────────────────────────────────────────────────── -->

    <!-- Submit Modal -->
    <template x-teleport="body">
        <div x-show="showSubmitModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-100"
             :class="{ 'hidden': !showSubmitModal }"
             aria-labelledby="submit-modal-title"
             role="dialog"
             aria-modal="true">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="showSubmitModal = false"></div>

            <!-- Modal Panel -->
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                        <!-- Modal Header -->
                        <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-display font-bold text-white" id="submit-modal-title">
                                    <i class="fas fa-upload mr-2"></i>Submit Dokumentasi Expo
                                </h3>
                                <button type="button" @click="showSubmitModal = false" class="text-white/80 hover:text-white transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <p class="text-[10px] text-white/80 font-black uppercase tracking-widest mt-1">Lengkapi data untuk penilaian final</p>
                        </div>

                        <!-- Modal Body & Form -->
                        <form action="<?= base_url('mahasiswa/expo/submit') ?>" method="POST" enctype="multipart/form-data" class="space-y-0" @submit="isLoading = true">
                    <?= csrf_field() ?>
                    
                        <div class="px-6 py-5 space-y-5">
                            <div class="space-y-3">
                                <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                    <i class="fas fa-align-left text-sky-400"></i> Ringkasan Perkembangan Usaha <span class="text-rose-500">*</span>
                                </label>
                        <div class="relative">
                            <textarea name="summary" rows="4" 
                                class="w-full rounded-3xl border-slate-200 bg-slate-50/50 text-[13px] p-5 focus:ring-4 focus:ring-sky-500/5 focus:border-sky-500 transition-all leading-relaxed placeholder:text-slate-300" 
                                placeholder="Ceritakan singkat bagaimana progres usaha Anda hingga saat ini, kendala yang dihadapi, dan hasil yang dicapai..." 
                                required x-ref="summaryField"><?= esc($submission->summary ?? '') ?></textarea>
                            <div class="absolute bottom-4 right-5 flex items-center gap-2">
                                <span class="text-[9px] font-bold" :class="$refs.summaryField.value.length > 450 ? 'text-rose-500' : 'text-slate-300'" x-text="$refs.summaryField.value.length + '/500'"></span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                <i class="fas fa-images text-sky-400"></i> Lampiran Dokumentasi Visual <span class="text-rose-500">*</span>
                            </label>
                                    <button type="button" @click="addAttachment" class="group flex items-center gap-2 text-[10px] font-black text-sky-600 uppercase tracking-tighter hover:text-sky-800 transition-colors bg-sky-50 px-3 py-1.5 rounded-full border border-sky-100">
                                        <i class="fas fa-plus-circle"></i>
                                        Tambah Lampiran
                                    </button>
                                </div>

                        <div class="space-y-4 max-h-[280px] overflow-y-auto custom-scrollbar pr-3 -mr-3">
                            <template x-for="(att, index) in attachments" :key="index">
                                <div class="relative group p-5 rounded-3xl bg-white border border-slate-100 shadow-sm hover:shadow-md hover:border-sky-200 transition-all"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 translate-y-4"
                                     x-transition:enter-end="opacity-100 translate-y-0">
                                    
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100 group-hover:bg-sky-50 group-hover:border-sky-100 transition-colors">
                                            <i :class="att.id ? 'fas fa-check-circle text-emerald-500' : 'fas fa-image text-slate-300 group-hover:text-sky-500'"></i>
                                        </div>
                                        
                                        <div class="flex-1 space-y-4">
                                            <div class="flex items-center justify-between">
                                                <input type="text" name="attachment_titles[]" x-model="att.title" 
                                                    class="w-full bg-transparent border-none p-0 text-[14px] font-bold text-slate-700 placeholder:text-slate-300 focus:ring-0" 
                                                    placeholder="Judul Lampiran (Misal: Foto Booth Expo)" required>
                                                
                                                <template x-if="att.id">
                                                    <span class="text-[8px] font-black text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md uppercase tracking-widest border border-emerald-100">Tersimpan</span>
                                                </template>
                                            </div>
                                            
                                            <div class="relative group/file">
                                                <input type="file" name="attachments[]" 
                                                    class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                                    :required="!att.id"
                                                    @change="att.file = $event.target.files[0]">
                                                <div class="flex items-center gap-3 px-4 py-2 rounded-xl bg-slate-50 border border-slate-100 group-hover/file:bg-sky-50/50 group-hover/file:border-sky-200 transition-all">
                                                    <i class="fas fa-cloud-arrow-up text-slate-400 text-xs"></i>
                                                    <span class="text-[10px] font-bold text-slate-500 truncate" x-text="att.file ? att.file.name : (att.id ? 'Ganti file lama...' : 'Pilih file (JPG, PNG, PDF)...')"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" @click="removeAttachment(index)" x-show="attachments.length > 1"
                                                class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-300 hover:text-rose-500 hover:bg-rose-50 hover:border-rose-100 border border-transparent transition-all">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="attachment_ids[]" :value="att.id || ''">
                                </div>
                            </template>
                        </div>
                    </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-slate-50 px-6 py-4 flex gap-3 justify-end border-t border-slate-100">
                            <button type="button" @click="showSubmitModal = false"
                                    class="btn-outline text-sm">
                                <i class="fas fa-times mr-2"></i>Batal
                            </button>
                            <button type="submit" :disabled="isLoading"
                                    class="btn-primary text-sm shadow-lg shadow-sky-500/20">
                                <span x-show="!isLoading"><i class="fas fa-paper-plane mr-2"></i>Kirim Laporan</span>
                                <span x-show="isLoading"><i class="fas fa-spinner fa-spin mr-2"></i>Sedang Memproses...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>

    <!-- Lightbox Preview -->
    <template x-teleport="body">
        <div x-show="showPreview"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-120"
             :class="{ 'hidden': !showPreview }"
             aria-labelledby="preview-modal-title"
             role="dialog"
             aria-modal="true">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="showPreview = false"></div>

            <!-- Modal Panel -->
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                        <!-- Modal Header -->
                        <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-display font-bold text-white" id="preview-modal-title">
                                    <i class="fas fa-eye mr-2"></i>Preview Lampiran
                                </h3>
                                <button type="button" @click="showPreview = false" class="text-white/80 hover:text-white transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Modal Body -->
                        <div class="px-6 py-5 bg-slate-50">
                            <!-- Title Badge -->
                            <div class="mb-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border bg-emerald-50 text-emerald-600 border-emerald-200">
                                    <i class="fas fa-image text-[10px]"></i>
                                    <span class="truncate max-w-[300px]" x-text="previewTitle || 'Dokumentasi'">Dokumentasi</span>
                                </span>
                            </div>

                            <!-- Image Content -->
                            <div class="rounded-xl overflow-hidden bg-white border border-slate-200 shadow-sm p-4 flex items-center justify-center min-h-[300px] max-h-[500px]">
                                <img :src="previewUrl" class="max-w-full max-h-[450px] rounded-lg object-contain">
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-white px-6 py-4 flex justify-between items-center border-t border-slate-100">
                            <div class="flex items-center gap-2 text-xs text-slate-400">
                                <i class="fas fa-info-circle"></i>
                                <span>Lampiran Dokumentasi Expo</span>
                            </div>
                            <div class="flex gap-2">
                                <a :href="previewUrl" target="_blank" class="btn-accent text-sm">
                                    <i class="fas fa-external-link-alt mr-2"></i>Buka di Tab Baru
                                </a>
                                <button type="button" @click="showPreview = false" class="btn-outline text-sm">
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

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }

    .animate-stagger {
        animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }

    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function expoPage() {
        return {
            showSubmitModal: <?= empty($submission) && $schedule && !$schedule->is_closed ? "true" : "false" ?>,
            showPreview: false,
            previewUrl: "",
            previewTitle: "",
            isLoading: false,
            attachments: [],

            init() {
                // Seed initial attachments from PHP
                const existing = <?= json_encode(array_map(fn($a) => [
                    "id" => $a->id, 
                    "title" => $a->title, 
                    "file_path" => $a->file_path,
                    "file_type" => $a->file_type,
                    "url" => base_url("mahasiswa/expo/attachment/" . $a->id),
                    "file" => null
                ], $attachments)) ?>;

                if (existing.length > 0) {
                    this.attachments = existing;
                } else {
                    this.attachments = [
                        { title: "Foto Produk / Prototipe", file: null },
                        { title: "Foto Stand / Booth Expo", file: null }
                    ];
                }
            },

            addAttachment() {
                this.attachments.push({ title: "", file: null });
            },

            async removeAttachment(index) {
                const att = this.attachments[index];
                if (att.id) {
                    if (!confirm("Hapus lampiran ini secara permanen?")) return;
                    try {
                        const response = await fetch("<?= base_url("mahasiswa/expo/attachment/") ?>" + att.id, {
                            method: "DELETE",
                            headers: { 
                                "X-CSRF-TOKEN": "<?= csrf_hash() ?>",
                                "X-Requested-With": "XMLHttpRequest"
                            }
                        });
                        const result = await response.json();
                        if (result.success) {
                            this.attachments.splice(index, 1);
                        } else {
                            alert(result.message || "Gagal menghapus lampiran");
                        }
                    } catch (e) {
                        alert("Terjadi kesalahan jaringan");
                    }
                } else {
                    this.attachments.splice(index, 1);
                }
            },

            openPreview(url, title) {
                this.previewUrl = url;
                this.previewTitle = title;
                this.showPreview = true;
            },

            handleMouseMove(e) {
                const card = e.currentTarget;
                const rect = card.getBoundingClientRect();
                card.style.setProperty("--mouse-x", `${e.clientX - rect.left}px`);
                card.style.setProperty("--mouse-y", `${e.clientY - rect.top}px`);
            }
        }
    }
</script>
<?= $this->endSection() ?>
