<?php
/**
 * @var array $proposal
 * @var array $schedules
 * @var string $type  — 'bimbingan' | 'mentoring'
 * @var array $context
 * @var int $statsTotal
 * @var int $statsLogbook
 * @var int $statsVerified
 */
?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    $c      = $context;
    $isBmb  = $type === 'bimbingan';
    $color  = $c['color']; // 'sky' or 'amber'
    $accent = $isBmb ? 'sky' : 'amber';

    // Tailwind-safe color maps
    $bgMap  = ['sky' => 'bg-sky-100',   'amber' => 'bg-amber-100'];
    $txtMap = ['sky' => 'text-sky-600', 'amber' => 'text-amber-600'];
    $bdMap  = ['sky' => 'border-l-sky-500', 'amber' => 'border-l-amber-500'];
    $btnMap = ['sky' => 'btn-primary',  'amber' => 'btn-accent'];
    $tagBg  = ['sky' => 'bg-sky-50 text-sky-600 border-sky-200', 'amber' => 'bg-amber-50 text-amber-600 border-amber-200'];
    $rBg    = ['sky' => 'bg-sky-600',   'amber' => 'bg-amber-500'];

    $logRoute  = $c['route_logbook'];
    $fileRoute = $c['route_file'];
?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="guidanceLogbook()">

    <!-- ─── PAGE HEADER ─────────────────────────────────────────────────── -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Logbook <span class="text-gradient"><?= esc($c['heading_accent']) ?></span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]"><?= esc($c['subtitle']) ?></p>
        </div>
    </div>

    <!-- ─── STAT SUMMARY CARDS ──────────────────────────────────────────── -->
    <div class="grid grid-cols-3 gap-5 animate-stagger delay-100">
        <div class="card-premium p-5 flex flex-col justify-between" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Sesi</p>
            <div class="flex items-end gap-2 mt-2">
                <p class="text-3xl font-black <?= $txtMap[$color] ?>"><?= $statsTotal ?></p>
                <p class="text-[11px] font-bold text-slate-400 mb-1">Jadwal</p>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-50">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Dijadwalkan</p>
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
                <p class="text-[11px] font-bold text-slate-400 mb-1">Sesi</p>
            </div>
            <div class="mt-3 pt-3 border-t border-slate-50">
                <p class="text-[10px] font-bold <?= $txtMap[$color] ?> uppercase tracking-widest">
                    <i class="fas fa-shield-check mr-1"></i>Disetujui Verifikator
                </p>
            </div>
        </div>
    </div>

    <!-- ─── PERSON INFO CARD ─────────────────────────────────────────────── -->
    <div class="card-premium p-5 border-l-4 <?= $bdMap[$color] ?> animate-stagger delay-150" @mousemove="handleMouseMove">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl <?= $bgMap[$color] ?> flex items-center justify-center shrink-0">
                <i class="fas <?= esc($c['icon']) ?> text-xl <?= $txtMap[$color] ?>"></i>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400"><?= esc($c['person_label']) ?></p>
                <h4 class="text-sm font-bold text-slate-800 mt-0.5">
                    <?= esc($proposal[$c['person_key']] ?? 'Belum ditugaskan') ?>
                </h4>
                <p class="text-[11px] text-slate-500 mt-0.5"><?= esc($c['person_desc']) ?></p>
            </div>
        </div>
    </div>

    <!-- ─── SCHEDULE LIST ────────────────────────────────────────────────── -->
    <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-white/70">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-calendar-days <?= $txtMap[$color] ?> mr-2"></i>Jadwal Sesi
                </h3>
                <p class="text-[10px] text-slate-400 font-semibold mt-0.5 uppercase tracking-wider">
                    Ditetapkan oleh <?= esc($c['person_label']) ?>
                </p>
            </div>
            <span class="text-[10px] font-black bg-slate-100 text-slate-600 px-3 py-1 rounded-full uppercase tracking-widest">
                <?= $statsTotal ?> Sesi
            </span>
        </div>

        <?php if (empty($schedules)): ?>
            <div class="flex flex-col items-center justify-center py-20 text-slate-300">
                <div class="w-20 h-20 rounded-full <?= $bgMap[$color] ?> flex items-center justify-center mb-4 opacity-50">
                    <i class="fas <?= esc($c['icon']) ?> text-3xl <?= $txtMap[$color] ?>"></i>
                </div>
                <p class="text-sm font-bold uppercase tracking-widest text-slate-400"><?= esc($c['empty_msg']) ?></p>
                <p class="text-[11px] text-slate-400 mt-1">Jadwal akan muncul setelah ditetapkan oleh <?= esc($c['person_label']) ?>.</p>
            </div>
        <?php else: ?>
            <div class="divide-y divide-slate-50">
                <?php foreach ($schedules as $s):
                    $logbook    = $s->logbook;
                    $canFill    = !$logbook || $logbook->status === 'rejected';
                    $isApproved = $logbook && $logbook->status === 'approved';
                    $isPending  = $logbook && $logbook->status === 'pending';

                    $schedStatusDot = match($s->status) {
                        'planned'   => 'bg-slate-400',
                        'ongoing'   => 'bg-blue-500 animate-pulse',
                        'completed' => 'bg-emerald-500',
                        default     => 'bg-slate-300'
                    };
                    $schedStatusLabel = match($s->status) {
                        'planned'   => 'Dijadwalkan',
                        'ongoing'   => 'Berlangsung',
                        'completed' => 'Selesai',
                        default     => $s->status
                    };
                ?>
                <div class="flex flex-col sm:flex-row sm:items-center gap-4 px-6 py-5 hover:bg-slate-50/70 transition-colors group">
                    <!-- Date & Topic -->
                    <div class="flex items-start gap-4 flex-1 min-w-0">
                        <div class="w-11 h-11 rounded-2xl <?= $bgMap[$color] ?> flex-shrink-0 flex flex-col items-center justify-center text-center leading-none <?= $txtMap[$color] ?>">
                            <span class="text-[10px] font-black uppercase"><?= date('M', strtotime($s->schedule_date)) ?></span>
                            <span class="text-lg font-black leading-none"><?= date('d', strtotime($s->schedule_date)) ?></span>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <p class="text-[13px] font-bold text-slate-800">
                                    <?= date('l, d F Y', strtotime($s->schedule_date)) ?>
                                    <span class="font-semibold text-slate-500">— <?= esc($s->schedule_time) ?></span>
                                </p>
                                <span class="inline-flex items-center gap-1 text-[10px] font-black px-2 py-0.5 rounded-full bg-slate-100 text-slate-500">
                                    <span class="w-1.5 h-1.5 rounded-full <?= $schedStatusDot ?>"></span>
                                    <?= $schedStatusLabel ?>
                                </span>
                            </div>
                            <p class="text-[11px] text-slate-500 font-medium mt-1 italic truncate">"<?= esc($s->topic) ?>"</p>
                        </div>
                    </div>

                    <!-- Logbook Status Badge -->
                    <div class="shrink-0 flex items-center gap-3">
                        <?php if (!$logbook): ?>
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-rose-50 text-rose-600 border border-rose-200 uppercase tracking-wider">
                                <i class="fas fa-circle-exclamation text-[9px]"></i>Belum Diisi
                            </span>
                        <?php elseif ($isApproved): ?>
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wider">
                                <i class="fas fa-circle-check text-[9px]"></i>Verified
                            </span>
                        <?php elseif ($isPending): ?>
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-blue-50 text-blue-600 border border-blue-200 uppercase tracking-wider">
                                <i class="fas fa-clock text-[9px] animate-pulse"></i>Review
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-orange-50 text-orange-600 border border-orange-200 uppercase tracking-wider">
                                <i class="fas fa-rotate text-[9px]"></i>Revisi
                            </span>
                        <?php endif; ?>

                        <!-- Action Button -->
                        <?php if ($canFill): ?>
                            <button @click="openModal(<?= htmlspecialchars(json_encode(['id' => $s->id, 'date' => date('d F Y', strtotime($s->schedule_date)), 'time' => $s->schedule_time, 'topic' => $s->topic, 'logbook' => $logbook ? json_decode(json_encode($logbook)) : null]), ENT_QUOTES, 'UTF-8') ?>)"
                                    class="<?= $btnMap[$color] ?> btn-sm">
                                <i class="fas fa-pen-to-square text-xs mr-1"></i>
                                <?= $logbook ? 'Revisi' : 'Isi Logbook' ?>
                            </button>
                        <?php else: ?>
                            <button @click="openModal(<?= htmlspecialchars(json_encode(['id' => $s->id, 'date' => date('d F Y', strtotime($s->schedule_date)), 'time' => $s->schedule_time, 'topic' => $s->topic, 'logbook' => $logbook ? json_decode(json_encode($logbook)) : null]), ENT_QUOTES, 'UTF-8') ?>)"
                                    class="btn-outline btn-sm">
                                <i class="fas fa-eye text-xs mr-1"></i>Detail
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- ─── LOGBOOK MODAL ────────────────────────────────────────────────── -->
    <div x-show="showModal"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-end="opacity-0"
         style="display: none;">

        <div class="card-premium w-full max-w-3xl bg-white shadow-2xl overflow-hidden max-h-[90vh] flex flex-col animate-modal"
             @click.away="showModal = false">

            <!-- Modal Header -->
            <div class="p-6 border-b border-slate-100 flex justify-between items-start bg-gradient-to-r from-<?= $accent ?>-50 to-transparent">
                <div>
                    <h3 class="font-display text-lg font-black text-slate-800">
                        <i class="fas fa-book-open <?= $txtMap[$color] ?> mr-2"></i>Input Logbook
                    </h3>
                    <p class="text-[11px] text-slate-500 font-semibold mt-0.5"
                       x-text="activeSchedule ? activeSchedule.date + ' — ' + activeSchedule.topic : ''"></p>
                </div>
                <button @click="showModal = false" class="text-slate-300 hover:text-rose-500 transition-colors mt-1">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Alert: Revision Note -->
            <div class="overflow-y-auto flex-1">
                <template x-if="activeSchedule && activeSchedule.logbook && activeSchedule.logbook.verification_note">
                    <div class="mx-6 mt-5 p-4 rounded-2xl bg-orange-50 border border-orange-200 flex items-start gap-3">
                        <i class="fas fa-triangle-exclamation text-orange-500 mt-0.5"></i>
                        <div>
                            <p class="text-[11px] font-black text-orange-700 uppercase tracking-widest mb-1">Catatan Verifikator</p>
                            <p class="text-[12px] text-orange-800 italic" x-text="activeSchedule.logbook.verification_note"></p>
                        </div>
                    </div>
                </template>

                <!-- Approved Banner -->
                <template x-if="activeSchedule && activeSchedule.logbook && activeSchedule.logbook.status === 'approved'">
                    <div class="mx-6 mt-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-3">
                        <i class="fas fa-shield-check text-emerald-600 text-xl"></i>
                        <div>
                            <p class="text-sm font-black text-emerald-800">Logbook Telah Diverifikasi!</p>
                            <p class="text-[11px] text-emerald-600">Data logbook ini sudah dikonfirmasi oleh verifikator dan tidak dapat diubah.</p>
                        </div>
                    </div>
                </template>

                <form :action="`<?= base_url($logRoute) ?>/${activeSchedule?.id}`" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    <?= csrf_field() ?>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left: Text Fields -->
                        <div class="space-y-5">
                            <!-- Material Explanation -->
                            <div class="form-field">
                                <label class="form-label">Ringkasan Materi <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-icon"><i class="fas fa-align-left"></i></div>
                                    <textarea name="material_explanation" rows="5"
                                              placeholder="Jelaskan materi/topik yang dibahas selama sesi ini..."
                                              :required="!activeSchedule?.logbook"
                                              :disabled="activeSchedule?.logbook?.status === 'approved'"
                                              x-text="activeSchedule?.logbook?.material_explanation ?? ''"></textarea>
                                </div>
                            </div>

                            <!-- Video URL -->
                            <div class="form-field">
                                <label class="form-label">Link Video Rekaman <span class="text-slate-400 font-normal text-xs">(Opsional)</span></label>
                                <div class="input-group">
                                    <div class="input-icon"><i class="fab fa-youtube text-rose-500"></i></div>
                                    <input type="url" name="video_url" placeholder="https://youtube.com/watch?v=..."
                                           :disabled="activeSchedule?.logbook?.status === 'approved'"
                                           :value="activeSchedule?.logbook?.video_url ?? ''">
                                </div>
                            </div>

                            <!-- Nota Konsumsi -->
                            <div class="px-5 py-4 rounded-2xl bg-emerald-50/50 border border-emerald-100/80 space-y-4">
                                <div class="flex items-center justify-between">
                                    <label class="text-[10px] font-black text-emerald-700 uppercase tracking-widest">
                                        <i class="fas fa-utensils mr-1.5"></i>Rincian Konsumsi Sesi
                                    </label>
                                    <template x-if="activeSchedule?.logbook?.nota_file">
                                        <a :href="`<?= base_url($fileRoute) ?>/nota/${activeSchedule.logbook.id}`"
                                           target="_blank"
                                           class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600 hover:text-emerald-700 transition-colors bg-white px-2 py-0.5 rounded-full border border-emerald-100 shadow-sm">
                                            <i class="fas fa-file-invoice"></i>Lihat Nota
                                        </a>
                                    </template>
                                </div>

                                <div class="space-y-4">
                                    <!-- Judith/Item Name -->
                                    <div class="form-field">
                                        <label class="form-label text-[11px] text-emerald-800">Nama Item / Keterangan Nota</label>
                                        <div class="input-group">
                                            <div class="input-icon"><i class="fas fa-tag text-emerald-400"></i></div>
                                            <input type="text" name="nota_title" placeholder="Misal: Snack Bimbingan..."
                                                   x-model="notaTitle"
                                                   :disabled="activeSchedule?.logbook?.status === 'approved'"
                                                   class="w-full">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="form-field">
                                            <label class="form-label text-[11px] text-emerald-800">Kuantitas</label>
                                            <div class="input-group">
                                                <div class="input-icon"><i class="fas fa-calculator text-emerald-400"></i></div>
                                                <input type="number" name="nota_qty" min="1"
                                                       x-model.number="notaQty"
                                                       @input="calculateTotal()"
                                                       :disabled="activeSchedule?.logbook?.status === 'approved'"
                                                       class="w-full">
                                            </div>
                                        </div>
                                        <div class="form-field">
                                            <label class="form-label text-[11px] text-emerald-800">Harga Satuan</label>
                                            <div class="input-group">
                                                <div class="input-icon"><i class="fas fa-money-bill-wave text-emerald-400"></i></div>
                                                <input type="number" name="nota_price" min="0" step="1000"
                                                       x-model.number="notaPrice"
                                                       @input="calculateTotal()"
                                                       :disabled="activeSchedule?.logbook?.status === 'approved'"
                                                       class="w-full">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="form-field">
                                            <label class="form-label text-[11px] font-bold text-emerald-900">Total Nominal (Otomatis)</label>
                                            <div class="input-group bg-emerald-100/30">
                                                <div class="input-icon"><i class="fas fa-coins text-emerald-600"></i></div>
                                                <input type="number" name="nominal_konsumsi" readonly
                                                       x-model="notaTotal"
                                                       class="w-full font-bold text-emerald-700">
                                            </div>
                                        </div>
                                        <div class="form-field">
                                            <label class="form-label text-[11px] text-emerald-800">Upload Nota Fisik</label>
                                            <div class="input-group">
                                                <div class="input-icon"><i class="fas fa-file-invoice text-emerald-400"></i></div>
                                                <input type="file" name="nota_file" accept=".jpg,.jpeg,.png,.pdf"
                                                       class="w-full text-[10px] text-slate-500 file:hidden cursor-pointer py-2"
                                                       :disabled="activeSchedule?.logbook?.status === 'approved'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right: File Uploads -->
                        <div class="space-y-5">
                            <!-- Photo Activity -->
                            <div class="form-field">
                                <label class="form-label">Foto Kegiatan <span class="required">*</span></label>
                                <template x-if="activeSchedule?.logbook?.photo_activity && !photoPreview">
                                    <div class="mb-3 rounded-2xl overflow-hidden border border-slate-200 shadow-sm relative group">
                                        <img :src="`<?= base_url($fileRoute) ?>/photo/${activeSchedule.logbook.id}`"
                                             class="w-full h-36 object-cover" alt="Foto kegiatan">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <span class="text-white text-[10px] font-bold uppercase tracking-widest">Foto Tersimpan</span>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="!activeSchedule?.logbook || activeSchedule?.logbook?.status !== 'approved'">
                                    <label class="block cursor-pointer group/upload">
                                        <input type="file" name="photo_activity" accept=".jpg,.jpeg,.png" class="hidden"
                                               :required="!activeSchedule?.logbook" @change="handlePhotoPreview($event)">
                                        <div class="relative">
                                            <template x-if="photoPreview">
                                                <img :src="photoPreview" class="w-full h-36 object-cover rounded-2xl border border-slate-200">
                                            </template>
                                            <template x-if="!photoPreview && (!activeSchedule?.logbook?.photo_activity)">
                                                <div class="flex flex-col items-center justify-center p-8 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 group-hover/upload:border-<?= $accent ?>-400 group-hover/upload:bg-<?= $accent ?>-50 transition-all">
                                                    <i class="fas fa-camera text-2xl text-slate-300 group-hover/upload:text-<?= $accent ?>-500 mb-2 transition-colors"></i>
                                                    <p class="text-[11px] font-bold text-slate-500 group-hover/upload:text-<?= $accent ?>-700 transition-colors">Klik untuk Ubah/Tambah Foto</p>
                                                    <p class="text-[10px] text-slate-400">JPG, PNG (Max 2MB)</p>
                                                </div>
                                            </template>
                                            <template x-if="!photoPreview && activeSchedule?.logbook?.photo_activity">
                                                <div class="flex flex-col items-center justify-center p-4 border border-dashed border-slate-200 rounded-2xl bg-slate-50 group-hover/upload:bg-<?= $accent ?>-50 transition-all">
                                                    <i class="fas fa-rotate text-lg text-slate-300 group-hover/upload:text-<?= $accent ?>-500 mb-1"></i>
                                                    <p class="text-[10px] font-bold text-slate-500">Ganti Foto Kegiatan</p>
                                                </div>
                                            </template>
                                        </div>
                                label>
                                </template>
                            </div>

                            <!-- Assignment File -->
                            <div class="form-field">
                                <label class="form-label">Output / Tugas <span class="text-slate-400 font-normal text-xs">(PDF, Opsional)</span></label>
                                <template x-if="activeSchedule?.logbook?.assignment_file && !assignmentFileName">
                                    <div class="mb-3 p-3 rounded-xl bg-rose-50/50 border border-rose-100 flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-lg bg-rose-100 flex items-center justify-center">
                                            <i class="fas fa-file-pdf text-rose-600"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-[11px] font-bold text-slate-700 truncate">Berkas Tugas Terlampir</p>
                                            <p class="text-[10px] text-slate-400">Silakan upload ulang untuk mengganti</p>
                                        </div>
                                        <a :href="`<?= base_url($fileRoute) ?>/assignment/${activeSchedule.logbook.id}`" target="_blank"
                                           class="w-7 h-7 rounded-lg bg-white border border-rose-100 flex items-center justify-center text-rose-500 hover:text-rose-700 shadow-sm transition-all">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                    </div>
                                </template>

                                <template x-if="!activeSchedule?.logbook || activeSchedule?.logbook?.status !== 'approved'">
                                    <label class="block cursor-pointer group/file">
                                        <input type="file" name="assignment_file" accept=".pdf" class="hidden"
                                               @change="handleAssignmentChange($event)">
                                        <div class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 group-hover/file:border-rose-400 group-hover/file:bg-rose-50 transition-all">
                                            <template x-if="!assignmentFileName">
                                                <div class="contents">
                                                    <i class="fas fa-file-arrow-up text-2xl text-slate-300 group-hover/file:text-rose-500 mb-2 transition-colors"></i>
                                                    <p class="text-[11px] font-bold text-slate-500 group-hover/file:text-rose-700 transition-colors">Upload Berkas PDF</p>
                                                    <p class="text-[10px] text-slate-400">Hanya PDF (Max 5MB)</p>
                                                </div>
                                            </template>
                                            <template x-if="assignmentFileName">
                                                <div class="text-center">
                                                    <i class="fas fa-file-circle-check text-2xl text-emerald-500 mb-2"></i>
                                                    <p class="text-[11px] font-black text-emerald-700" x-text="assignmentFileName"></p>
                                                    <p class="text-[10px] text-emerald-600 mt-1">Siap dikirim!</p>
                                                </div>
                                            </template>
                                        </div>
                                    </label>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button type="button" @click="showModal = false" class="btn-outline flex-1">
                            <i class="fas fa-times mr-2"></i>Tutup
                        </button>
                        <button type="submit"
                                x-show="!activeSchedule?.logbook || activeSchedule?.logbook?.status === 'rejected'"
                                class="<?= $isBmb ? 'btn-primary' : 'btn-accent' ?> flex-1 shadow-lg">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Logbook
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    .animate-stagger { animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-100 { animation-delay: 0.1s; }
    .delay-150 { animation-delay: 0.15s; }
    .delay-200 { animation-delay: 0.2s; }
    @keyframes slideUpFade { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes modalIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .animate-modal { animation: modalIn 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function guidanceLogbook() {
        return {
            showModal:      false,
            activeSchedule: null,
            photoPreview:   null,
            assignmentFileName: '',

            // Extended Nota Fields
            notaTitle: '',
            notaQty: 1,
            notaPrice: 0,
            notaTotal: 0,

            handleMouseMove(e) {
                const card = e.currentTarget;
                const rect = card.getBoundingClientRect();
                card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            },

            openModal(schedule) {
                this.activeSchedule = schedule;
                this.photoPreview   = null;
                this.assignmentFileName = '';

                // Reset / Populate Nota Fields
                const lb = schedule.logbook;
                this.notaTitle     = lb?.nota_title     ?? '';
                this.notaQty       = parseInt(lb?.nota_qty ?? 1);
                this.notaPrice     = parseFloat(lb?.nota_price ?? 0);
                this.notaTotal     = parseFloat(lb?.nominal_konsumsi ?? 0);

                this.showModal      = true;
            },

            calculateTotal() {
                this.notaTotal = this.notaQty * this.notaPrice;
            },

            handlePhotoPreview(e) {
                const file = e.target.files[0];
                if (!file) { this.photoPreview = null; return; }
                const reader = new FileReader();
                reader.onload = (ev) => { this.photoPreview = ev.target.result; };
                reader.readAsDataURL(file);
            },

            handleAssignmentChange(e) {
                const file = e.target.files[0];
                this.assignmentFileName = file ? file.name : '';
            }
        };
    }
</script>
<?= $this->endSection() ?>
