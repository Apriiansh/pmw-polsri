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
$ringMap = ['sky' => 'ring-sky-200 focus-within:ring-sky-400', 'amber' => 'ring-amber-200 focus-within:ring-amber-400'];

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

    <!-- ─── SCHEDULE LIST WITH INLINE LOGBOOK FORMS ─────────────────────── -->
    <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-white/70">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-calendar-days <?= $txtMap[$color] ?> mr-2"></i>Jadwal & Logbook Sesi
                </h3>
                <p class="text-[10px] text-slate-400 font-semibold mt-0.5 uppercase tracking-wider">
                    Klik tombol aksi untuk mengisi atau melihat detail logbook
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
                <?php foreach ($schedules as $idx => $s):
                    $logbook    = $s->logbook;
                    $canFill    = !$logbook || in_array($logbook->status, ['rejected', 'draft']);
                    $isApproved = $logbook && $logbook->status === 'approved';
                    $isPending  = $logbook && $logbook->status === 'pending';
                    $isDraft    = $logbook && $logbook->status === 'draft';

                    $schedStatusDot = match ($s->status) {
                        'planned'   => 'bg-slate-400',
                        'ongoing'   => 'bg-blue-500 animate-pulse',
                        'completed' => 'bg-emerald-500',
                        default     => 'bg-slate-300'
                    };

                    // Pre-build JSON payload for Alpine (server-side, clean)
                    $parsedNotaItems = [];
                    if ($logbook && $logbook->nota_items) {
                        $parsedNotaItems = json_decode($logbook->nota_items, true) ?? [];
                    }

                    $lbPayload = $logbook ? [
                        'id'                  => $logbook->id,
                        'status'              => $logbook->status,
                        'material_explanation'=> $logbook->material_explanation,
                        'video_url'           => $logbook->video_url,
                        'photo_activity'      => $logbook->photo_activity,
                        'assignment_file'     => $logbook->assignment_file,
                        'nota_file'           => $logbook->nota_file,
                        'nota_items'          => $parsedNotaItems,
                        'nominal_konsumsi'    => (float)($logbook->nominal_konsumsi ?? 0),
                        'verification_note'   => $logbook->verification_note,
                    ] : null;
                ?>
                    <!-- ── ROW: Schedule Header ─────────────────────────────────── -->
                    <div>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 px-6 py-5 hover:bg-slate-50/60 transition-colors">
                            <!-- Counter & Date block -->
                            <div class="flex items-start gap-4 flex-1 min-w-0">
                                <div class="w-11 h-11 rounded-2xl <?= $bgMap[$color] ?> flex-shrink-0 flex flex-col items-center justify-center text-center leading-none <?= $txtMap[$color] ?>">
                                    <span class="text-[9px] font-black uppercase"><?= date('M', strtotime($s->schedule_date)) ?></span>
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
                                            <?= ucfirst($s->status) ?>
                                        </span>
                                    </div>
                                    <p class="text-[11px] text-slate-500 font-medium mt-1 italic truncate">"<?= esc($s->topic) ?>"</p>
                                </div>
                            </div>

                            <!-- Status badge + action button -->
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
                                <?php elseif ($isDraft): ?>
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200 uppercase tracking-wider">
                                        <i class="fas fa-file-pen text-[9px]"></i>Draft
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-orange-50 text-orange-600 border border-orange-200 uppercase tracking-wider">
                                        <i class="fas fa-rotate text-[9px]"></i>Revisi
                                    </span>
                                <?php endif; ?>

                                <!-- Toggle button -->
                                <button
                                    @click="toggleForm(<?= $idx ?>, <?= htmlspecialchars(json_encode($lbPayload), ENT_QUOTES, 'UTF-8') ?>)"
                                    :class="openIdx === <?= $idx ?> ? 'bg-slate-700 text-white border-slate-700' : '<?= $canFill ? ($btnMap[$color] . ' shadow-md') : 'btn-outline bg-slate-50' ?>'"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider border transition-all">
                                    <i :class="openIdx === <?= $idx ?> ? 'fas fa-chevron-up' : '<?= $canFill ? 'fas fa-pen-to-square' : 'fas fa-eye' ?>'"></i>
                                    <span x-text="openIdx === <?= $idx ?> ? 'Tutup' : '<?= $canFill ? ($isDraft ? 'Lanjut Draft' : 'Isi Logbook') : 'Lihat Detail' ?>'"></span>
                                </button>
                            </div>
                        </div>

                        <!-- ── INLINE EXPAND: Logbook Form ──────────────────────────── -->
                        <div x-show="openIdx === <?= $idx ?>"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             x-cloak
                             class="px-4 sm:px-6 pb-6">

                            <!-- Form container -->
                            <div class="rounded-3xl border border-slate-200 bg-slate-50/60 overflow-hidden shadow-inner">

                                <!-- Inner header -->
                                <div class="px-6 py-4 bg-white border-b border-slate-100 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl <?= $bgMap[$color] ?> flex items-center justify-center shrink-0">
                                        <i class="fas fa-file-signature <?= $txtMap[$color] ?> text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-display text-sm font-black text-slate-800">
                                            <?= $canFill ? 'Isi Laporan Logbook' : 'Detail Logbook' ?>
                                        </h4>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                                            <?= date('d F Y', strtotime($s->schedule_date)) ?> — <?= esc($s->topic) ?>
                                        </p>
                                    </div>
                                </div>

                                <!-- Revision note banner -->
                                <?php if ($logbook && $logbook->verification_note): ?>
                                    <div class="mx-6 mt-5 p-4 rounded-2xl bg-orange-50 border border-orange-200 flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center shrink-0 mt-0.5">
                                            <i class="fas fa-triangle-exclamation text-orange-500 text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-orange-700 uppercase tracking-widest mb-1">Catatan Revisi dari Verifikator</p>
                                            <p class="text-[13px] text-orange-800 leading-relaxed font-medium"><?= esc($logbook->verification_note) ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- MAIN FORM -->
                                <form action="<?= base_url($logRoute . '/' . $s->id) ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="status" x-model="formStatus">

                                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                                        <!-- LEFT: Konten Bimbingan (7 cols) -->
                                        <div class="lg:col-span-7 space-y-5">
                                            <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm space-y-5">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-7 h-7 rounded-lg <?= $bgMap[$color] ?> flex items-center justify-center">
                                                        <i class="fas fa-align-left <?= $txtMap[$color] ?> text-xs"></i>
                                                    </div>
                                                    <h5 class="text-xs font-black text-slate-700 uppercase tracking-widest">Konten Pembelajaran</h5>
                                                </div>

                                                <!-- Material -->
                                                <div class="form-field">
                                                    <label class="form-label text-xs">
                                                        Ringkasan Materi
                                                        <span class="required">*</span>
                                                        <span class="text-[10px] font-normal text-slate-400 ml-1">(wajib saat kirim laporan)</span>
                                                    </label>
                                                    <div class="input-group items-start py-2">
                                                        <div class="input-icon mt-1"><i class="fas fa-pen-nib"></i></div>
                                                        <textarea
                                                            name="material_explanation"
                                                            rows="5"
                                                            placeholder="Detail pembahasan selama sesi berlangsung... (min. 50 kata)"
                                                            class="custom-scrollbar resize-none"
                                                            :required="formStatus === 'pending'"
                                                            <?= $isApproved ? 'disabled' : '' ?>
                                                        ><?= $logbook ? esc($logbook->material_explanation) : '' ?></textarea>
                                                    </div>
                                                    <p class="text-[10px] text-slate-400 mt-1.5 ml-1 italic">
                                                        <i class="fas fa-info-circle mr-1"></i>Min. 50 kata untuk laporan berkualitas.
                                                    </p>
                                                </div>

                                                <!-- Video URL -->
                                                <div class="form-field">
                                                    <label class="form-label text-xs">
                                                        Link Video Rekaman
                                                        <span class="text-slate-400 font-normal text-[10px] ml-1">(YouTube/Drive, Opsional)</span>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-icon"><i class="fab fa-youtube text-rose-400"></i></div>
                                                        <input
                                                            type="url"
                                                            name="video_url"
                                                            placeholder="https://youtu.be/..."
                                                            value="<?= $logbook ? esc($logbook->video_url) : '' ?>"
                                                            <?= $isApproved ? 'disabled' : '' ?>>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- NOTA SECTION (Dynamic Multi-Item) -->
                                            <div class="rounded-2xl bg-gradient-to-b from-emerald-600 to-emerald-800 text-white shadow-xl overflow-hidden">

                                                <!-- Nota header -->
                                                <div class="px-5 pt-5 pb-3 flex items-center justify-between">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center border border-white/20">
                                                            <i class="fas fa-wallet text-white text-sm"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="text-xs font-black uppercase tracking-widest text-white/90">Administrasi Konsumsi</h5>
                                                            <p class="text-[10px] text-emerald-200 font-medium">Rincian pengeluaran per item (opsional)</p>
                                                        </div>
                                                    </div>
                                                    <?php if (!$isApproved): ?>
                                                    <button type="button" @click="addNotaItem()"
                                                        class="flex items-center gap-1.5 px-3 py-2 rounded-xl bg-white/15 hover:bg-white/25 border border-white/20 text-white text-[11px] font-black uppercase tracking-widest transition-all">
                                                        <i class="fas fa-plus text-[10px]"></i> Tambah Item
                                                    </button>
                                                    <?php endif; ?>
                                                </div>

                                                <!-- Column headers -->
                                                <div class="px-5 pb-2">
                                                    <div class="grid grid-cols-12 gap-2 text-[9px] font-black uppercase tracking-widest text-emerald-300 px-1">
                                                        <div class="col-span-5">Keterangan Item</div>
                                                        <div class="col-span-2 text-center">Qty</div>
                                                        <div class="col-span-3 text-right">Satuan (Rp)</div>
                                                        <div class="col-span-2 text-right">Subtotal</div>
                                                    </div>
                                                </div>

                                                <!-- Dynamic rows -->
                                                <div class="px-5 space-y-2 pb-3" id="nota-rows-<?= $idx ?>">
                                                    <template x-for="(item, i) in notaItems" :key="i">
                                                        <div class="grid grid-cols-12 gap-2 items-center bg-white/10 rounded-xl p-2 border border-white/10"
                                                             x-transition:enter="transition ease-out duration-200"
                                                             x-transition:enter-start="opacity-0 scale-95"
                                                             x-transition:enter-end="opacity-100 scale-100">
                                                            <!-- Title -->
                                                            <div class="col-span-5">
                                                                <input type="text"
                                                                       :name="'nota_title[]'"
                                                                       x-model="item.title"
                                                                       placeholder="Contoh: Nasi Box"
                                                                       <?= $isApproved ? 'disabled' : '' ?>
                                                                       class="w-full bg-white/10 border border-white/20 rounded-lg px-2.5 py-2 text-white text-xs font-medium placeholder:text-white/30 outline-none focus:border-white/50 focus:bg-white/15 transition-all">
                                                            </div>
                                                            <!-- Qty -->
                                                            <div class="col-span-2">
                                                                <input type="number"
                                                                       :name="'nota_qty[]'"
                                                                       x-model.number="item.qty"
                                                                       @input="recalcTotal()"
                                                                       min="1"
                                                                       <?= $isApproved ? 'disabled' : '' ?>
                                                                       class="w-full bg-white/10 border border-white/20 rounded-lg px-2 py-2 text-white text-xs font-bold text-center outline-none focus:border-white/50 focus:bg-white/15 transition-all">
                                                            </div>
                                                            <!-- Price -->
                                                            <div class="col-span-3">
                                                                <input type="number"
                                                                       :name="'nota_price[]'"
                                                                       x-model.number="item.price"
                                                                       @input="recalcTotal()"
                                                                       min="0"
                                                                       step="500"
                                                                       placeholder="0"
                                                                       <?= $isApproved ? 'disabled' : '' ?>
                                                                       class="w-full bg-white/10 border border-white/20 rounded-lg px-2 py-2 text-white text-xs font-bold text-right outline-none focus:border-white/50 focus:bg-white/15 transition-all">
                                                            </div>
                                                            <!-- Subtotal + Remove -->
                                                            <div class="col-span-2 flex items-center justify-end gap-1">
                                                                <span class="text-[10px] font-black text-emerald-200 truncate"
                                                                      x-text="new Intl.NumberFormat('id-ID', {notation:'compact',maximumFractionDigits:1}).format(item.qty * item.price)"></span>
                                                                <?php if (!$isApproved): ?>
                                                                <button type="button" @click="removeNotaItem(i)"
                                                                        class="w-6 h-6 rounded-lg bg-rose-500/30 hover:bg-rose-500/60 flex items-center justify-center text-rose-200 hover:text-white transition-all shrink-0 ml-1">
                                                                    <i class="fas fa-xmark text-[9px]"></i>
                                                                </button>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </template>

                                                    <!-- Empty state -->
                                                    <template x-if="notaItems.length === 0">
                                                        <div class="flex items-center justify-center py-5 rounded-xl border border-dashed border-white/20 text-white/40 gap-2">
                                                            <i class="fas fa-receipt text-sm"></i>
                                                            <span class="text-[11px] font-bold uppercase tracking-widest">Belum ada item konsumsi</span>
                                                        </div>
                                                    </template>
                                                </div>

                                                <!-- Grand total row -->
                                                <div class="mx-5 mb-5 p-3 rounded-xl bg-emerald-900/60 border border-emerald-400/20 flex items-center justify-between">
                                                    <div class="flex items-center gap-2">
                                                        <i class="fas fa-sigma text-emerald-300 text-xs"></i>
                                                        <span class="text-[11px] font-black uppercase tracking-widest text-emerald-200">
                                                            Total Konsumsi
                                                            <span class="text-emerald-400 font-normal" x-text="'(' + notaItems.length + ' item)'"></span>
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center gap-1.5">
                                                        <span class="text-[10px] font-black text-emerald-300">Rp</span>
                                                        <span class="text-lg font-black text-white tracking-tight" x-text="new Intl.NumberFormat('id-ID').format(notaTotal)"></span>
                                                    </div>
                                                </div>

                                                <!-- Nota file upload -->
                                                <div class="px-5 pb-5 border-t border-white/10 pt-4">
                                                    <?php if ($logbook && $logbook->nota_file): ?>
                                                        <div class="flex items-center justify-between mb-3">
                                                            <div class="flex items-center gap-2">
                                                                <i class="fas fa-receipt text-emerald-200 text-xs"></i>
                                                                <span class="text-[11px] font-bold text-emerald-100">Bukti nota/kuitansi terlampir</span>
                                                            </div>
                                                            <a href="<?= base_url($fileRoute . '/nota/' . ($logbook->id ?? 0)) ?>" target="_blank"
                                                               class="text-[10px] font-black bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded-lg uppercase tracking-wider transition-all">
                                                                <i class="fas fa-eye mr-1"></i>Lihat
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!$isApproved): ?>
                                                        <label class="block cursor-pointer group/nota-upload">
                                                            <input type="file" name="nota_file" accept=".jpg,.jpeg,.png,.pdf" class="hidden sr-only"
                                                                   @change="handleNotaChange($event)">
                                                            <div class="flex items-center justify-center gap-2.5 py-3 rounded-2xl border border-dashed border-white/25 hover:border-white/50 hover:bg-white/5 transition-all"
                                                                 :class="notaFileName ? 'bg-emerald-800/40 border-emerald-300/40' : ''">
                                                                <i class="text-emerald-200 text-sm"
                                                                   :class="notaFileName ? 'fas fa-check-circle text-emerald-300' : 'fas fa-cloud-arrow-up'"></i>
                                                                <p class="text-[11px] font-black tracking-widest uppercase text-emerald-100"
                                                                   x-text="notaFileName || '<?= $logbook && $logbook->nota_file ? 'Ganti Bukti Nota' : 'Upload Kuitansi / Nota Fisik' ?>'">
                                                                </p>
                                                                <span class="text-[9px] bg-emerald-400/20 px-2 py-0.5 rounded text-emerald-200 uppercase">PDF, JPG, PNG</span>
                                                            </div>
                                                        </label>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- RIGHT: Evidence Files (5 cols) -->
                                        <div class="lg:col-span-5 space-y-5">
                                            <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm space-y-6">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center">
                                                        <i class="fas fa-paperclip text-indigo-500 text-xs"></i>
                                                    </div>
                                                    <h5 class="text-xs font-black text-slate-700 uppercase tracking-widest">Lampiran Dokumentasi</h5>
                                                </div>

                                                <!-- === FOTO KEGIATAN === -->
                                                <div class="form-field">
                                                    <label class="form-label text-xs">
                                                        Foto Bukti Kegiatan
                                                        <span class="required">*</span>
                                                        <span class="text-[10px] font-normal text-slate-400 ml-1">(wajib saat kirim laporan)</span>
                                                    </label>

                                                    <!-- Existing photo preview -->
                                                    <?php if ($logbook && $logbook->photo_activity): ?>
                                                        <div class="relative group rounded-2xl overflow-hidden border border-slate-100 bg-slate-50 aspect-video mb-3 shadow-sm">
                                                            <img src="<?= base_url($fileRoute . '/photo/' . $logbook->id) ?>"
                                                                 class="w-full h-full object-cover" alt="Foto kegiatan">
                                                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center pb-3">
                                                                <a href="<?= base_url($fileRoute . '/photo/' . $logbook->id) ?>" target="_blank"
                                                                   class="text-white text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5">
                                                                    <i class="fas fa-expand-alt"></i> Perbesar
                                                                </a>
                                                            </div>
                                                            <div class="absolute top-2 right-2">
                                                                <span class="bg-black/50 text-white text-[9px] font-black uppercase tracking-widest px-2 py-1 rounded-lg backdrop-blur-sm">
                                                                    Foto Aktif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!$isApproved): ?>
                                                        <!-- Upload / Replace area -->
                                                        <label class="block cursor-pointer group/photo-upload">
                                                            <input type="file" name="photo_activity" accept=".jpg,.jpeg,.png" class="hidden sr-only"
                                                                   :required="formStatus === 'pending' && !<?= ($logbook && $logbook->photo_activity) ? 'true' : 'false' ?>"
                                                                   @change="handlePhotoPreview($event)">

                                                            <!-- Photo preview after selection -->
                                                            <template x-if="photoPreview">
                                                                <div class="aspect-video rounded-2xl overflow-hidden border-2 border-<?= $accent ?>-400 shadow-md mb-2 relative">
                                                                    <img :src="photoPreview" class="w-full h-full object-cover">
                                                                    <div class="absolute top-2 right-2 bg-emerald-500 text-white text-[9px] font-black uppercase px-2 py-1 rounded-lg">
                                                                        <i class="fas fa-check mr-1"></i>Foto Baru
                                                                    </div>
                                                                </div>
                                                            </template>

                                                            <!-- Drop zone (when no preview) -->
                                                            <template x-if="!photoPreview">
                                                                <div class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 rounded-2xl p-6 bg-slate-50/50
                                                                            group-hover/photo-upload:border-<?= $accent ?>-400 group-hover/photo-upload:bg-<?= $accent ?>-50/30 transition-all">
                                                                    <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center group-hover/photo-upload:scale-110 transition-transform">
                                                                        <i class="fas <?= $logbook && $logbook->photo_activity ? 'fa-sync-alt' : 'fa-camera' ?> text-slate-300 group-hover/photo-upload:text-<?= $accent ?>-500 transition-colors"></i>
                                                                    </div>
                                                                    <p class="text-[11px] font-bold text-slate-500 group-hover/photo-upload:text-<?= $accent ?>-700 transition-colors">
                                                                        <?= $logbook && $logbook->photo_activity ? 'Ganti Foto Kegiatan' : 'Lampirkan Foto Kegiatan' ?>
                                                                    </p>
                                                                    <p class="text-[9px] text-slate-400 uppercase tracking-tighter">JPG, PNG — Rasio 16:9 Recommended</p>
                                                                </div>
                                                            </template>
                                                        </label>
                                                    <?php endif; ?>
                                                </div>

                                                <!-- === OUTPUT / ASSIGNMENT FILE === -->
                                                <div class="form-field pt-2 border-t border-slate-50">
                                                    <label class="form-label text-xs">
                                                        Output / Berkas Tugas
                                                        <span class="text-slate-400 font-normal text-[10px] ml-1">(Opsional, PDF)</span>
                                                    </label>

                                                    <?php if ($logbook && $logbook->assignment_file): ?>
                                                        <div class="flex items-center gap-3 p-3 rounded-xl bg-orange-50 border border-orange-100 mb-3">
                                                            <div class="w-9 h-9 rounded-xl bg-orange-100 flex items-center justify-center shrink-0">
                                                                <i class="fas fa-file-pdf text-orange-500 text-sm"></i>
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-[11px] font-bold text-slate-700">Berkas Tugas Aktif</p>
                                                                <p class="text-[10px] text-slate-400">Dokumen PDF Terlampir</p>
                                                            </div>
                                                            <a href="<?= base_url($fileRoute . '/assignment/' . $logbook->id) ?>" target="_blank"
                                                               class="w-8 h-8 rounded-lg bg-orange-500 text-white flex items-center justify-center hover:bg-orange-600 transition-colors shadow-sm">
                                                                <i class="fas fa-eye text-xs"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!$isApproved): ?>
                                                        <label class="block cursor-pointer group/assign-upload">
                                                            <input type="file" name="assignment_file" accept=".pdf" class="hidden sr-only"
                                                                   @change="handleAssignmentChange($event)">

                                                            <div class="flex items-center gap-3 p-3 rounded-xl border border-dashed border-slate-200 bg-slate-50/50
                                                                        group-hover/assign-upload:border-orange-400 group-hover/assign-upload:bg-orange-50/30 transition-all"
                                                                 :class="assignmentFileName ? 'border-emerald-300 bg-emerald-50/30' : ''">
                                                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 transition-all"
                                                                     :class="assignmentFileName ? 'bg-emerald-100' : 'bg-slate-100 group-hover/assign-upload:bg-orange-100'">
                                                                    <i class="text-sm transition-colors"
                                                                       :class="assignmentFileName ? 'fas fa-check text-emerald-500' : 'fas fa-file-arrow-up text-slate-400 group-hover/assign-upload:text-orange-500'"></i>
                                                                </div>
                                                                <div class="flex-1 min-w-0">
                                                                    <p class="text-[11px] font-bold transition-colors"
                                                                       :class="assignmentFileName ? 'text-emerald-700' : 'text-slate-500 group-hover/assign-upload:text-orange-700'"
                                                                       x-text="assignmentFileName || '<?= ($logbook && $logbook->assignment_file) ? 'Ganti Berkas PDF' : 'Upload Output / Tugas (PDF)' ?>'"></p>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ACTION FOOTER -->
                                    <?php if ($canFill): ?>
                                        <div class="pt-4 border-t border-slate-200">
                                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                                <!-- Save Draft -->
                                                <button type="submit"
                                                        @click.prevent="formStatus = 'draft'; $el.closest('form').submit()"
                                                        class="group/draft flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-2xl bg-slate-100 hover:bg-slate-200 border border-slate-200 text-slate-600 font-black text-[11px] uppercase tracking-widest transition-all">
                                                    <div class="w-7 h-7 rounded-lg bg-slate-200 group-hover/draft:bg-slate-300 flex items-center justify-center shrink-0 transition-all">
                                                        <i class="fas fa-floppy-disk text-slate-500 text-xs"></i>
                                                    </div>
                                                    <div class="text-left">
                                                        <p class="text-[10px] font-black">Simpan Draft</p>
                                                        <p class="text-[9px] font-medium text-slate-400 normal-case tracking-normal">Belum dikirim ke verifikator</p>
                                                    </div>
                                                </button>

                                                <!-- Submit for Review -->
                                                <button type="submit"
                                                        @click.prevent="formStatus = 'pending'; $el.closest('form').submit()"
                                                        class="<?= $isBmb ? 'btn-primary' : 'btn-accent' ?> group/submit flex-1 flex items-center justify-center gap-2.5 py-3.5 px-6 rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-lg transition-all">
                                                    <i class="fas fa-paper-plane group-hover/submit:translate-x-0.5 group-hover/submit:-translate-y-0.5 transition-transform"></i>
                                                    <div class="text-left">
                                                        <p class="text-[10px] font-black">Kirim Laporan</p>
                                                        <p class="text-[9px] font-medium opacity-70 normal-case tracking-normal">Dikirim ke <?= esc($c['person_label']) ?> untuk diverifikasi</p>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    <?php elseif ($isPending): ?>
                                        <div class="pt-4 border-t border-slate-200">
                                            <div class="flex items-center gap-3 p-4 rounded-2xl bg-blue-50 border border-blue-100">
                                                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                                    <i class="fas fa-clock text-blue-500 animate-pulse"></i>
                                                </div>
                                                <div>
                                                    <p class="text-[11px] font-black text-blue-800 uppercase tracking-widest">Menunggu Verifikasi</p>
                                                    <p class="text-[10px] text-blue-600 mt-0.5">Laporan Anda sedang dalam antrian review oleh <?= esc($c['person_label']) ?>.</p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif ($isApproved): ?>
                                        <div class="pt-4 border-t border-slate-200">
                                            <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100">
                                                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                                                    <i class="fas fa-shield-check text-emerald-500"></i>
                                                </div>
                                                <div>
                                                    <p class="text-[11px] font-black text-emerald-800 uppercase tracking-widest">Logbook Terverifikasi</p>
                                                    <p class="text-[10px] text-emerald-600 mt-0.5">Laporan sesi ini telah disetujui dan diarsipkan.</p>
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

<style>
    .animate-stagger {
        animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-150 { animation-delay: 0.15s; }
    .delay-200 { animation-delay: 0.2s; }

    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function guidanceLogbook() {
        return {
            // Which schedule row is open (-1 = none)
            openIdx: -1,

            // Per-form state (reset on each open)
            formStatus: 'pending',
            photoPreview: null,
            assignmentFileName: '',
            notaFileName: '',

            // Dynamic nota items list
            notaItems: [],   // [{ title, qty, price }]
            notaTotal: 0,

            handleMouseMove(e) {
                const card = e.currentTarget;
                const rect = card.getBoundingClientRect();
                card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            },

            /**
             * Toggle a row's inline form. Seeds nota items from existing
             * logbook JSON data when available.
             */
            toggleForm(idx, logbook) {
                if (this.openIdx === idx) {
                    this.openIdx = -1;
                    return;
                }

                this.openIdx = idx;

                // Reset per-form state
                this.formStatus         = 'pending';
                this.photoPreview       = null;
                this.assignmentFileName = '';
                this.notaFileName       = '';

                // Seed nota items from existing logbook
                if (logbook && Array.isArray(logbook.nota_items) && logbook.nota_items.length > 0) {
                    this.notaItems = logbook.nota_items.map(item => ({
                        title : item.title  ?? '',
                        qty   : parseInt(item.qty    ?? 1),
                        price : parseFloat(item.price ?? 0),
                    }));
                } else {
                    // Start fresh — add one empty row for convenience
                    this.notaItems = [];
                }

                this.recalcTotal();

                // Scroll into view
                this.$nextTick(() => {
                    this.$el.querySelector(`[x-show="openIdx === ${idx}"]`)
                        ?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                });
            },

            addNotaItem() {
                this.notaItems.push({ title: '', qty: 1, price: 0 });
            },

            removeNotaItem(i) {
                this.notaItems.splice(i, 1);
                this.recalcTotal();
            },

            recalcTotal() {
                this.notaTotal = this.notaItems.reduce((sum, item) => {
                    return sum + (parseInt(item.qty || 0) * parseFloat(item.price || 0));
                }, 0);
            },

            handlePhotoPreview(e) {
                const file = e.target.files[0];
                if (!file) { this.photoPreview = null; return; }
                const reader = new FileReader();
                reader.onload = ev => { this.photoPreview = ev.target.result; };
                reader.readAsDataURL(file);
            },

            handleAssignmentChange(e) {
                const file = e.target.files[0];
                this.assignmentFileName = file ? file.name : '';
            },

            handleNotaChange(e) {
                const file = e.target.files[0];
                this.notaFileName = file ? file.name : '';
            }
        };
    }
</script>
<?= $this->endSection() ?>