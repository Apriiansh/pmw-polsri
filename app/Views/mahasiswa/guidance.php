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
                <?php 
                $schedules = array_reverse($schedules);
                foreach ($schedules as $idx => $s):
                    $logbook    = $s->logbook;
                    $isApproved = $logbook && $logbook->status === 'approved';
                    $isPending  = $logbook && $logbook->status === 'pending';
                    $isDraft    = $logbook && $logbook->status === 'draft';
                    $isRejected = $logbook && $logbook->status === 'rejected';

                    // Deadline logic
                    $deadlineDays = $s->deadline_days ?? 5;
                    $deadlineDate = (new \DateTime($s->schedule_date))->modify("+$deadlineDays days");
                    $now = new \DateTime();
                    $isOverdue = $now > $deadlineDate;
                    $daysRemaining = $now->diff($deadlineDate)->days;

                    $canFill = (!$logbook || $isDraft || $isRejected) && !$isApproved && !$isPending;
                    if ($isOverdue && !$isPending && !$isApproved && !$isRejected) {
                        $canFill = false;
                    }

                    $schedStatusDot = match ($s->status) {
                        'planned'   => 'bg-slate-400',
                        'ongoing'   => 'bg-blue-500 animate-pulse',
                        'completed' => 'bg-emerald-500',
                        default     => 'bg-slate-300'
                    };

                    $parsedNotaItems = [];
                    if ($logbook && $logbook->nota_items) {
                        $parsedNotaItems = json_decode($logbook->nota_items, true) ?? [];
                    }

                    $lbPayload = $logbook ? [
                        'id'                  => $logbook->id,
                        'status'              => $logbook->status,
                        'material_explanation' => $logbook->material_explanation,
                        'video_url'           => $logbook->video_url,
                        'photo_activity'      => $logbook->photo_activity,
                        'assignment_file'     => $logbook->assignment_file,
                        'nota_file'           => $logbook->nota_file,
                        'nota_files'          => json_decode($logbook->nota_files ?? '[]', true) ?? [],
                        'nota_items'          => $parsedNotaItems,
                        'nominal_konsumsi'    => (float)($logbook->nominal_konsumsi ?? 0),
                        'submitted_at'        => $logbook->submitted_at ? date('Y-m-d H:i:s', strtotime($logbook->submitted_at)) : null,
                        'verification_note'   => $logbook->verification_note,
                    ] : null;
                ?>
                    <div>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4 px-6 py-5 hover:bg-slate-50/60 transition-colors" @mousemove="handleMouseMove">
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

                            <div class="shrink-0 flex items-center gap-3">
                                <?php if ($isApproved): ?>
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-wider">
                                        <i class="fas fa-circle-check text-[9px]"></i>Verified
                                    </span>
                                <?php elseif ($isPending): ?>
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-blue-50 text-blue-600 border border-blue-200 uppercase tracking-wider">
                                        <i class="fas fa-clock text-[9px] animate-pulse"></i>Review
                                    </span>
                                <?php elseif ($isOverdue && !$isRejected): ?>
                                    <div class="flex flex-col items-end">
                                        <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-rose-50 text-rose-600 border border-rose-200 uppercase tracking-wider border">
                                            <i class="fas fa-lock text-[9px]"></i>Locked
                                        </span>
                                        <p class="text-[9px] font-bold text-rose-400 mt-1 uppercase tracking-tighter">
                                            Deadline: <?= $deadlineDate->format('d M Y') ?> (Lewat)
                                        </p>
                                    </div>
                                <?php elseif ($isDraft): ?>
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200 uppercase tracking-wider">
                                        <i class="fas fa-file-pen text-[9px]"></i>Draft
                                    </span>
                                <?php elseif ($isRejected): ?>
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-orange-50 text-orange-600 border border-orange-200 uppercase tracking-wider">
                                        <i class="fas fa-rotate text-[9px]"></i>Revisi
                                    </span>
                                <?php else: ?>
                                    <div class="flex flex-col items-end">
                                        <span class="inline-flex items-center gap-1.5 text-[10px] font-black px-3 py-1 rounded-full bg-slate-100 text-slate-500 border border-slate-200 uppercase tracking-wider border">
                                            <i class="fas fa-clock text-[9px]"></i>Belum Diisi
                                        </span>
                                        <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase tracking-tighter">
                                            Deadline: <?= $deadlineDate->format('d M Y') ?> (<?= $daysRemaining ?> hari lagi)
                                        </p>
                                    </div>
                                <?php endif; ?>

                                <?php if ($logbook && $logbook->submitted_at): ?>
                                    <div class="flex items-center gap-1.5 text-[9px] font-bold text-slate-400 px-2">
                                        <i class="fas fa-paper-plane text-[8px] opacity-60"></i>
                                        <span>Dikirim: <?= date('d M Y, H:i', strtotime($logbook->submitted_at)) ?></span>
                                    </div>
                                <?php endif; ?>

                                <button
                                    @click="toggleForm(<?= $idx ?>, <?= htmlspecialchars(json_encode($lbPayload), ENT_QUOTES, 'UTF-8') ?>)"
                                    :class="openIdx === <?= $idx ?> ? 'bg-slate-700 text-white border-slate-700' : '<?= $canFill ? ($btnMap[$color] . ' shadow-md') : 'btn-outline bg-slate-50' ?>'"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider border transition-all">
                                    <i :class="openIdx === <?= $idx ?> ? 'fas fa-chevron-up' : (<?= $canFill ? 'true' : 'false' ?> ? 'fas fa-pen-to-square' : 'fas fa-eye')"></i>
                                    <span x-text="openIdx === <?= $idx ?> ? 'Tutup' : (<?= $canFill ? 'true' : 'false' ?> ? '<?= $isDraft ? 'Lanjut Draft' : ($isRejected ? 'Perbaiki' : 'Isi Logbook') ?>' : '<?= $isOverdue && !$isPending && !$isApproved ? 'Locked' : 'Lihat Detail' ?>')"></span>
                                </button>
                            </div>
                        </div>

                        <div x-show="openIdx === <?= $idx ?>"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            x-cloak
                            class="px-4 sm:px-6 pb-6">

                            <div class="rounded-3xl border border-slate-200 bg-slate-50/60 overflow-hidden shadow-inner">
                                <div class="px-6 py-4 bg-white border-b border-slate-100 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl <?= $bgMap[$color] ?> flex items-center justify-center shrink-0">
                                        <i class="fas fa-file-signature <?= $txtMap[$color] ?> text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-display text-sm font-black text-slate-800"><?= $canFill ? 'Isi Laporan Logbook' : 'Detail Logbook' ?></h4>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider"><?= date('d F Y', strtotime($s->schedule_date)) ?> — <?= esc($s->topic) ?></p>
                                    </div>
                                </div>

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

                                <form action="<?= base_url($logRoute . '/' . $s->id) ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="status" x-model="formStatus">

                                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                                        <div class="lg:col-span-7 space-y-5">
                                            <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm space-y-5">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-7 h-7 rounded-lg <?= $bgMap[$color] ?> flex items-center justify-center">
                                                        <i class="fas fa-align-left <?= $txtMap[$color] ?> text-xs"></i>
                                                    </div>
                                                    <h5 class="text-xs font-black text-slate-700 uppercase tracking-widest">Konten Pembelajaran</h5>
                                                </div>

                                                <div class="form-field">
                                                    <label class="form-label text-xs">Ringkasan Materi <span class="required">*</span></label>
                                                    <div class="input-group items-start py-2">
                                                        <textarea name="material_explanation" placeholder="Dalam kegiatan ini saya bersama tim ..." rows="5" class="custom-scrollbar resize-none" :required="formStatus === 'pending'" <?= !$canFill ? 'disabled' : '' ?>><?= $logbook ? esc($logbook->material_explanation) : '' ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-field">
                                                    <label class="form-label text-xs">Link Video Rekaman</label>
                                                    <div class="input-group">
                                                        <div class="input-icon"><i class="fab fa-youtube text-rose-400"></i></div>
                                                        <input type="url" name="video_url" placeholder="https://youtu.be/..." value="<?= $logbook ? esc($logbook->video_url) : '' ?>" <?= !$canFill ? 'disabled' : '' ?>>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="rounded-2xl bg-white border border-slate-200/60 shadow-sm overflow-hidden">
                                                <div class="px-5 pt-5 pb-3 flex items-center justify-between bg-slate-50/30 border-b border-slate-50">
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center border border-slate-200/50">
                                                            <i class="fas fa-wallet text-slate-500 text-sm"></i>
                                                        </div>
                                                        <h5 class="text-xs font-black uppercase tracking-widest text-slate-800">Administrasi Konsumsi</h5>
                                                    </div>
                                                    <?php if ($canFill): ?>
                                                        <button type="button" @click="addNotaItem()" class="flex items-center gap-1.5 px-3 py-2 rounded-xl bg-white border border-slate-200 text-slate-600 text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                                                            <i class="fas fa-plus text-[9px] text-emerald-500"></i> Tambah Item
                                                        </button>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="px-5 space-y-2 py-4">
                                                    <template x-for="(item, i) in notaItems" :key="i">
                                                        <div class="grid grid-cols-12 gap-2 items-center bg-slate-50/50 rounded-xl p-2 border border-slate-100">
                                                            <div class="col-span-5">
                                                                <input type="text" :name="'nota_title[]'" x-model="item.title" <?= !$canFill ? 'disabled' : '' ?> class="w-full bg-white border border-slate-200 rounded-lg px-2.5 py-2 text-xs font-semibold outline-none">
                                                            </div>
                                                            <div class="col-span-2">
                                                                <input type="number" :name="'nota_qty[]'" x-model.number="item.qty" @input="recalcTotal()" min="1" <?= !$canFill ? 'disabled' : '' ?> class="w-full bg-white border border-slate-200 rounded-lg px-2 py-2 text-xs font-black text-center outline-none">
                                                            </div>
                                                            <div class="col-span-3">
                                                                <input type="number" :name="'nota_price[]'" x-model.number="item.price" @input="recalcTotal()" min="0" <?= !$canFill ? 'disabled' : '' ?> class="w-full bg-white border border-slate-200 rounded-lg px-2 py-2 text-xs font-black text-right outline-none">
                                                            </div>
                                                            <div class="col-span-2 flex items-center justify-end">
                                                                <?php if ($canFill): ?>
                                                                    <button type="button" @click="removeNotaItem(i)" class="w-6 h-6 rounded-lg bg-rose-50 text-rose-400 hover:bg-rose-500 hover:text-white transition-all"><i class="fas fa-trash-can text-[9px]"></i></button>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>

                                                <div class="mx-5 mb-5 p-4 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-between">
                                                    <span class="text-[11px] font-black uppercase tracking-widest text-slate-300">Total Keseluruhan</span>
                                                    <div class="flex items-center gap-1.5 text-white">
                                                        <span class="text-[10px] font-black opacity-60">Rp</span>
                                                        <span class="text-xl font-black" x-text="new Intl.NumberFormat('id-ID').format(notaTotal)"></span>
                                                    </div>
                                                </div>

                                                <div class="px-5 pb-5 pt-2 space-y-4">
                                                    <template x-if="existingNotaFiles.length > 0">
                                                        <div class="space-y-2">
                                                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-1">File Tersimpan:</p>
                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                                                <template x-for="(file, idx) in existingNotaFiles" :key="idx">
                                                                    <div class="flex items-center justify-between p-2 rounded-xl bg-white border border-slate-200 shadow-sm">
                                                                        <span class="text-[10px] text-slate-600 font-bold truncate pl-2" x-text="'Nota #' + (idx + 1)"></span>
                                                                        <a :href="'<?= base_url($fileRoute . '/nota/') ?>' + (lbPayload?.id || 0) + '?path=' + file" target="_blank" class="text-[8px] font-black text-sky-600 bg-sky-50 px-2 py-1 rounded-lg">View</a>
                                                                    </div>
                                                                </template>
                                                            </div>
                                                        </div>
                                                    </template>

                                                    <template x-if="notaFiles.length > 0">
                                                        <div class="space-y-2">
                                                            <p class="text-[9px] font-black uppercase tracking-widest text-sky-500 ml-1">Baru Dipilih:</p>
                                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                                                <template x-for="(f, idx) in notaFiles" :key="idx">
                                                                    <div class="flex items-center justify-between p-2 rounded-xl bg-sky-50/50 border border-sky-100 border-dashed">
                                                                        <span class="text-[10px] text-slate-600 truncate font-semibold pl-2" x-text="f.name"></span>
                                                                        <button type="button" @click="removeSelectedNota(idx)" class="text-rose-400 p-1"><i class="fas fa-times"></i></button>
                                                                    </div>
                                                                </template>
                                                            </div>
                                                        </div>
                                                    </template>

                                                    <?php if ($canFill): ?>
                                                        <label class="block cursor-pointer">
                                                            <input type="file" name="nota_files[]" accept=".jpg,.jpeg,.png,.pdf" class="hidden sr-only" multiple @change="handleNotaChange($event)">
                                                            <div class="flex items-center justify-center gap-3 py-4 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 hover:bg-white hover:border-sky-300 transition-all">
                                                                <i class="fas fa-cloud-arrow-up text-slate-400"></i>
                                                                <span class="text-[11px] font-black uppercase text-slate-700">Unggah Nota (Multiple)</span>
                                                            </div>
                                                        </label>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="lg:col-span-5 space-y-5">
                                            <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm space-y-6">
                                                <div class="form-field">
                                                    <label class="form-label text-xs">Foto Bukti Kegiatan <span class="required">*</span></label>
                                                    <?php if ($logbook && $logbook->photo_activity): ?>
                                                        <div class="relative rounded-2xl overflow-hidden border border-slate-100 aspect-video mb-3 shadow-sm">
                                                            <img src="<?= base_url($fileRoute . '/photo/' . $logbook->id) ?>" class="w-full h-full object-cover">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($canFill): ?>
                                                        <label class="block cursor-pointer">
                                                            <input type="file" name="photo_activity" accept=".jpg,.jpeg,.png" class="hidden sr-only" @change="handlePhotoPreview($event)">
                                                            <template x-if="photoPreview">
                                                                <div class="aspect-video rounded-2xl overflow-hidden border-2 border-sky-400 mb-2">
                                                                    <img :src="photoPreview" class="w-full h-full object-cover">
                                                                </div>
                                                            </template>
                                                            <div class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 rounded-2xl p-6 bg-slate-50/50 hover:border-sky-400 transition-all">
                                                                <i class="fas fa-camera text-slate-300 text-xl"></i>
                                                                <p class="text-[11px] font-bold text-slate-500">Lampirkan Foto</p>
                                                            </div>
                                                        </label>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="form-field pt-2 border-t border-slate-50">
                                                    <label class="form-label text-xs">Output / Berkas Tugas (PDF)</label>
                                                    <?php if ($logbook && $logbook->assignment_file): ?>
                                                        <div class="flex items-center gap-3 p-3 rounded-xl bg-orange-50 border border-orange-100 mb-3">
                                                            <i class="fas fa-file-pdf text-orange-500"></i>
                                                            <span class="text-[11px] font-bold text-slate-700 flex-1 min-w-0 truncate">Berkas Terlampir</span>
                                                            <a href="<?= base_url($fileRoute . '/assignment/' . $logbook->id) ?>" target="_blank" class="w-8 h-8 rounded-lg bg-orange-500 text-white flex items-center justify-center"><i class="fas fa-eye text-xs"></i></a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($canFill): ?>
                                                        <label class="block cursor-pointer">
                                                            <input type="file" name="assignment_file" accept=".pdf" class="hidden sr-only" @change="handleAssignmentChange($event)">
                                                            <div class="flex items-center gap-3 p-3 rounded-xl border border-dashed border-slate-200 bg-slate-50/50 hover:border-orange-400 transition-all">
                                                                <i class="fas fa-file-arrow-up text-slate-400"></i>
                                                                <span class="text-[11px] font-bold text-slate-500" x-text="assignmentFileName || 'Upload PDF'"></span>
                                                            </div>
                                                        </label>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-4 border-t border-slate-200">
                                        <?php if ($canFill): ?>
                                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                                <button type="submit" @click.prevent="formStatus = 'draft'; $nextTick(() => $el.closest('form').submit())" class="flex items-center justify-center gap-2 px-6 py-3 rounded-2xl bg-slate-100 border border-slate-200 text-slate-600 font-black text-[11px] uppercase tracking-widest transition-all">
                                                    <i class="fas fa-floppy-disk"></i> Simpan Draft
                                                </button>
                                                <button type="submit" @click.prevent="formStatus = 'pending'; $nextTick(() => $el.closest('form').submit())" class="<?= $isBmb ? 'btn-primary' : 'btn-accent' ?> flex-1 flex items-center justify-center gap-2 py-3.5 px-6 rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-lg transition-all">
                                                    <i class="fas fa-paper-plane"></i> Kirim Laporan
                                                </button>
                                            </div>
                                        <?php elseif ($isPending): ?>
                                            <div class="flex items-center gap-3 p-4 rounded-2xl bg-blue-50 border border-blue-100">
                                                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                                                    <i class="fas fa-clock text-blue-500 animate-pulse"></i>
                                                </div>
                                                <div>
                                                    <p class="text-[11px] font-black text-blue-800 uppercase tracking-widest">Menunggu Verifikasi</p>
                                                    <p class="text-[10px] text-blue-600 mt-0.5">Laporan Anda sedang dalam antrian review.</p>
                                                </div>
                                            </div>
                                        <?php elseif ($isApproved): ?>
                                            <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100">
                                                <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                                                    <i class="fas fa-shield-check text-emerald-500"></i>
                                                </div>
                                                <div>
                                                    <p class="text-[11px] font-black text-emerald-800 uppercase tracking-widest">Logbook Terverifikasi</p>
                                                    <p class="text-[10px] text-emerald-600 mt-0.5">Laporan sesi ini telah disetujui.</p>
                                                </div>
                                            </div>
                                        <?php elseif ($isOverdue): ?>
                                            <div class="flex items-center gap-3 p-4 rounded-2xl bg-rose-50 border border-rose-100 shadow-sm">
                                                <div class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center shrink-0 border border-rose-200">
                                                    <i class="fas fa-lock text-rose-500"></i>
                                                </div>
                                                <div>
                                                    <p class="text-[11px] font-black text-rose-800 uppercase tracking-widest">Akses Pengiriman Terkunci</p>
                                                    <p class="text-[10px] text-rose-600 mt-0.5 font-medium italic">
                                                        Batas waktu pengisian (<?= $deadlineDate->format('d M Y') ?>) telah berakhir.
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
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

    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-150 {
        animation-delay: 0.15s;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    @keyframes slideUpFade {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function guidanceLogbook() {
        return {
            // Which schedule row is open (-1 = none)
            openIdx: -1,
            logbookData: {},

            // Per-form state (reset on each open)
            formStatus: 'pending', // Will be seeded from logbook.status on open
            photoPreview: null,
            assignmentFileName: '',

            // Multi-nota files
            notaFiles: [], // Files selected in current session
            existingNotaFiles: [], // Files already in DB
            notaFileName: '', // Legacy text display

            // Dynamic nota items list
            notaItems: [], // [{ title, qty, price }]
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
                this.logbookData = logbook || {};

                // Reset/Seed per-form state
                this.formStatus = logbook?.status || 'pending';
                this.photoPreview = null;
                this.assignmentFileName = '';
                this.notaFiles = [];
                this.notaFileName = '';

                // Load existing files
                this.existingNotaFiles = logbook?.nota_files || [];

                // Seed nota items from existing logbook
                if (logbook && Array.isArray(logbook.nota_items) && logbook.nota_items.length > 0) {
                    this.notaItems = logbook.nota_items.map(item => ({
                        title: item.title ?? '',
                        qty: parseInt(item.qty ?? 1),
                        price: parseFloat(item.price ?? 0),
                    }));
                } else {
                    // Start fresh — add one empty row for convenience
                    this.notaItems = [];
                }

                this.recalcTotal();

                // Scroll into view
                this.$nextTick(() => {
                    this.$el.querySelector(`[x-show="openIdx === ${idx}"]`)
                        ?.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest'
                        });
                });
            },

            addNotaItem() {
                this.notaItems.push({
                    title: '',
                    qty: 1,
                    price: 0
                });
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
                if (!file) {
                    this.photoPreview = null;
                    return;
                }
                const reader = new FileReader();
                reader.onload = ev => {
                    this.photoPreview = ev.target.result;
                };
                reader.readAsDataURL(file);
            },

            handleAssignmentChange(e) {
                const file = e.target.files[0];
                this.assignmentFileName = file ? file.name : '';
            },

            handleNotaChange(e) {
                const files = e.target.files;
                if (!files) return;

                for (let i = 0; i < files.length; i++) {
                    this.notaFiles.push({
                        name: files[i].name,
                        file: files[i]
                    });
                }
            },

            removeSelectedNota(idx) {
                this.notaFiles.splice(idx, 1);
            }
        };
    }
</script>
<?= $this->endSection() ?>