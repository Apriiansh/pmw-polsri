<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="{
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Validasi Final <span class="text-gradient">Pitching Desk</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]"><?= esc($proposal['nama_usaha'] ?? 'Proposal #' . $proposal['id']) ?> &mdash; Validasi Administrasi & Desk Evaluation oleh Admin/UPAPKK</p>
        </div>
        <a href="<?= base_url('admin/pitching-desk') ?>" class="btn-ghost inline-flex items-center gap-2">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <?php if (!$proposal): ?>
    <div class="card-premium p-8 text-center">
        <i class="fas fa-exclamation-circle text-4xl text-rose-400 mb-3"></i>
        <p class="text-slate-500">Proposal tidak ditemukan</p>
    </div>
    <?php else: ?>

    <?php
    $statusColors = [
        'pending'  => 'bg-slate-100 text-slate-600 border-slate-200',
        'submitted' => 'bg-amber-100 text-amber-600 border-amber-200',
        'approved' => 'bg-emerald-100 text-emerald-600 border-emerald-200',
        'revision' => 'bg-orange-100 text-orange-600 border-orange-200',
        'rejected' => 'bg-rose-100 text-rose-600 border-rose-200',
    ];
    $statusLabels = [
        'pending'  => 'Belum Dikirim',
        'submitted' => 'Menunggu Validasi',
        'approved' => 'Lolos Pitching',
        'revision' => 'Perlu Revisi',
        'rejected' => 'Ditolak',
    ];

    // Determine current effective status
    $currentStatus = $proposal['pitching_admin_status'];
    if ($currentStatus === 'pending' && !empty($proposal['student_submitted_at'])) {
        $currentStatus = 'submitted';
    }
    ?>

    <!-- ================================================================
         2. PROPOSAL INFO CARD
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-100" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-file-invoice text-sky-500 mr-2"></i>
                    <?= esc($proposal['nama_usaha'] ?: 'Proposal #' . $proposal['id']) ?>
                </h3>
                <p class="text-[11px] text-(--text-muted) mt-0.5">
                    <?= esc($proposal['period_name'] ?? '-') ?> - <?= esc($proposal['period_year'] ?? '') ?>
                </p>
            </div>
            <span class="pmw-status <?= $statusColors[$currentStatus] ?? '' ?>">
                <i class="fas fa-circle text-[8px]"></i>
                <?= $statusLabels[$currentStatus] ?? ucfirst($currentStatus) ?>
            </span>
            <?php if (!empty($proposal['student_submitted_at'])): ?>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black bg-sky-500 text-white shadow-sm shadow-sky-100">
                    <i class="fas fa-paper-plane"></i>
                    TERKIRIM: <?= date('d/m/y H:i', strtotime($proposal['student_submitted_at'])) ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="p-2 md:p-4">
            <div class="grid md:grid-cols-4 gap-6">
                <!-- Kategori -->
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Kategori Wirausaha</p>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold border <?= $proposal['kategori_wirausaha'] === 'pemula' ? "bg-sky-50 text-sky-600 border-sky-200" : "bg-violet-50 text-violet-600 border-violet-200" ?>">
                        <i class="fas fa-rocket text-xs"></i>
                        <?= $proposal['kategori_wirausaha'] === 'pemula' ? 'Pemula' : 'Berkembang' ?>
                    </span>
                </div>

                <!-- Kategori Usaha -->
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Kategori Usaha</p>
                    <p class="font-semibold text-(--text-heading)"><?= esc($proposal['kategori_usaha'] ?: '-') ?></p>
                </div>

                <!-- Lama Usaha -->
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Lama Usaha Berjalan</p>
                    <?php
                    $tahun = (int)($proposal['lama_usaha_tahun'] ?? 0);
                    $bulan = (int)($proposal['lama_usaha_bulan'] ?? 0);
                    $lamaStr = '';
                    if ($tahun > 0) $lamaStr .= $tahun . ' tahun ';
                    if ($bulan > 0) $lamaStr .= $bulan . ' bulan';
                    $lamaStr = trim($lamaStr) ?: '-';
                    ?>
                    <p class="font-semibold text-(--text-heading)"><?= esc($lamaStr) ?></p>
                </div>

                <!-- Instagram -->
                <?php if (!empty($proposal['instagram_url'])): ?>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Medsos Usaha</p>
                    <a href="https://instagram.com/<?= esc($proposal['instagram_url']) ?>" target="_blank"
                        class="inline-flex items-center gap-1.5 text-sm font-semibold text-rose-500 hover:underline">
                        <i class="fab fa-instagram"></i>@<?= esc($proposal['instagram_url']) ?>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Timeline -->
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Tahap Saat Ini</p>
                    <p class="font-semibold text-sky-600">
                        <i class="fas fa-award mr-1"></i> Pitching Desk
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================
         3. TEAM INFO
    ================================================================= -->
    <div class="animate-stagger delay-200">
        <!-- Tim Proposal -->
        <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-users text-teal-500 mr-2"></i>
                    Tim Proposal
                </h3>
            </div>
            <div class="p-5 sm:p-7 space-y-3">
                <?php foreach ($members as $member): ?>
                <div class="flex items-center gap-3 p-3 rounded-xl <?= $member['role'] === 'ketua' ? 'bg-teal-50 border border-teal-100' : 'bg-slate-50' ?> cursor-pointer hover:shadow-md transition-all"
                     onclick='openBiodataModal("mahasiswa", <?= json_encode($member, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                    <div class="w-10 h-10 rounded-lg <?= $member['role'] === 'ketua' ? 'bg-teal-500' : 'bg-slate-300' ?> flex items-center justify-center text-white font-display font-bold text-sm shrink-0">
                        <?= strtoupper(substr($member['nama'], 0, 2)) ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-(--text-heading) text-sm"><?= esc($member['nama']) ?></span>
                            <?php if ($member['role'] === 'ketua'): ?>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-teal-500 text-white">KETUA</span>
                            <?php endif; ?>
                        </div>
                        <div class="text-xs text-(--text-muted)">
                            <?= esc($member['nim'] ?? '-') ?> · <?= esc($member['prodi'] ?? '-') ?>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-slate-400 text-xs"></i>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- ================================================================
         4. PITCHING MEDIA (VIDEO & PPT)
    ================================================================= -->
    <div class="grid lg:grid-cols-3 gap-6 animate-stagger delay-300">
        <!-- Video Player -->
        <div class="lg:col-span-2 card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-play-circle text-sky-500 mr-2"></i>
                    Video Pitching
                </h3>
            </div>
            <div class="p-0">
                <?php 
                $embedUrl = get_video_embed_url($proposal['video_url']);
                if ($embedUrl): 
                ?>
                <div class="aspect-video w-full">
                    <iframe src="<?= $embedUrl ?>" class="w-full h-full" allowfullscreen allow="autoplay"></iframe>
                </div>
                <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                    <p class="text-xs text-slate-500 truncate mr-4"><?= esc($proposal['video_url']) ?></p>
                    <a href="<?= esc($proposal['video_url']) ?>" target="_blank" class="btn-ghost btn-sm text-sky-600">
                        <i class="fas fa-external-link-alt mr-1"></i> Buka Link
                    </a>
                </div>
                <?php else: ?>
                <div class="p-12 text-center">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <i class="fas fa-video-slash text-2xl"></i>
                    </div>
                    <p class="text-slate-400 italic text-sm">Media video tidak tersedia atau format link tidak didukung</p>
                    <?php if ($proposal['video_url']): ?>
                        <a href="<?= esc($proposal['video_url']) ?>" target="_blank" class="btn-primary mt-4 inline-flex items-center gap-2">
                            <i class="fas fa-external-link-alt"></i> Buka Link Manual
                        </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Dokumen Panel with Tab Switcher -->
        <?php
        $allDocs = [
            'pitching_ppt'           => ['label' => 'Presentasi',    'icon' => 'fa-file-powerpoint', 'color' => 'orange'],
            'biodata'                => ['label' => 'Biodata',       'icon' => 'fa-id-card',         'color' => 'teal'],
            'ktm'                    => ['label' => 'KTM',           'icon' => 'fa-address-card',    'color' => 'sky'],
            'surat_pernyataan_ketua' => ['label' => 'Surat Ketua',   'icon' => 'fa-file-signature',  'color' => 'violet'],
            'cashflow'               => ['label' => 'Cashflow',      'icon' => 'fa-chart-line',      'color' => 'emerald'],
            'surat_kesediaan_dosen'  => ['label' => 'Surat Dosen',   'icon' => 'fa-file-contract',   'color' => 'indigo'],
        ];
        $availableDocs = array_filter($allDocs, fn($k) => isset($docsByKey[$k]), ARRAY_FILTER_USE_KEY);
        $firstDocKey = array_key_first($availableDocs);
        ?>
        <div class="lg:col-span-1 card-premium overflow-hidden" x-data="{ activeDoc: '<?= $firstDocKey ?? '' ?>' }" @mousemove="handleMouseMove">
            <!-- Tab Header -->
            <div class="px-4 py-3 border-b border-sky-50 bg-white/60">
                <div class="flex items-center gap-1 flex-wrap">
                    <?php foreach ($availableDocs as $key => $meta): ?>
                    <button type="button"
                        @click="activeDoc = '<?= $key ?>'"
                        :class="activeDoc === '<?= $key ?>' ? 'bg-sky-500 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-100'"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">
                        <i class="fas <?= $meta['icon'] ?> text-[9px]"></i>
                        <?= $meta['label'] ?>
                    </button>
                    <?php endforeach; ?>
                    <?php if (empty($availableDocs)): ?>
                    <span class="text-xs text-slate-400 italic px-2">Belum ada dokumen</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Doc Panels -->
            <?php foreach ($availableDocs as $key => $meta): ?>
            <?php
                $doc = $docsByKey[$key];
                $ext = strtolower(pathinfo($doc['original_name'], PATHINFO_EXTENSION));
                $isPdf = ($ext === 'pdf');
                $docUrl = base_url('admin/pitching-desk/doc/' . $doc['id']);
            ?>
            <div x-show="activeDoc === '<?= $key ?>'" x-cloak>
                <div class="p-0">
                    <div class="h-64 lg:h-[460px] w-full bg-slate-50 relative group flex items-center justify-center">
                        <?php if ($isPdf): ?>
                            <iframe src="<?= $docUrl ?>?inline=1" class="w-full h-full border-none"></iframe>
                        <?php else: ?>
                            <div class="text-center p-8">
                                <div class="w-20 h-20 rounded-3xl bg-<?= $meta['color'] ?>-100 text-<?= $meta['color'] ?>-500 flex items-center justify-center mx-auto mb-4 shadow-lg">
                                    <i class="fas <?= $meta['icon'] ?> text-3xl"></i>
                                </div>
                                <h4 class="font-bold text-slate-700 mb-1 text-sm"><?= esc($doc['original_name']) ?></h4>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-4">File <?= strtoupper($ext) ?> · Preview tidak tersedia</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="p-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between gap-2">
                    <span class="text-[10px] text-slate-500 font-bold uppercase truncate"><?= esc($doc['original_name']) ?></span>
                    <div class="flex items-center gap-2 shrink-0">
                        <?php if ($isPdf): ?>
                        <a href="<?= $docUrl ?>?inline=1" target="_blank"
                           class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-black bg-white border border-slate-200 text-slate-600 hover:text-sky-600 hover:border-sky-300 transition-all">
                            <i class="fas fa-expand-alt"></i> Preview
                        </a>
                        <?php endif; ?>
                        <a href="<?= $docUrl ?>"
                           class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-black bg-sky-500 text-white hover:bg-sky-600 transition-all">
                            <i class="fas fa-download"></i> Download
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <?php if (empty($availableDocs)): ?>
            <div class="p-12 text-center bg-slate-50/50">
                <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <i class="fas fa-file-circle-exclamation text-2xl"></i>
                </div>
                <p class="text-slate-400 italic text-sm">Belum ada dokumen diunggah</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ================================================================
         5. JURI ASSESSMENT PANEL (Aggregation View)
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-500 border-l-4 border-l-violet-500" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60 flex items-center justify-between">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-users-between-lines text-violet-500 mr-2"></i>
                    Penilaian Juri
                </h3>
                <p class="text-[11px] text-(--text-muted) mt-0.5">Hasil penilaian dari para penilai</p>
            </div>
            <div class="flex items-center gap-2">
                <?php if ($aggregation['count'] > 0): ?>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-black border <?= ($aggregation['avg'] ?? 0) >= 80 ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-rose-50 text-rose-600 border-rose-200' ?>">
                    <i class="fas <?= ($aggregation['avg'] ?? 0) >= 80 ? 'fa-trophy' : 'fa-circle-xmark' ?>"></i>
                    Rata-rata: <?= number_format($aggregation['avg'] ?? 0, 2) ?>%
                </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="p-5 sm:p-7 space-y-4">
            <!-- Summary Bar -->
            <div class="grid grid-cols-3 gap-3 mb-4">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-center">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Menilai</p>
                    <p class="font-display text-xl font-black text-(--text-heading)"><?= $aggregation['count'] ?>/<?= $totalPenilai ?></p>
                </div>
                <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-100 text-center">
                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-wider">Lolos</p>
                    <p class="font-display text-xl font-black text-emerald-600"><?= $aggregation['approved'] ?></p>
                </div>
                <div class="p-3 rounded-xl bg-rose-50 border border-rose-100 text-center">
                    <p class="text-[10px] font-black text-rose-500 uppercase tracking-wider">Tdk Lolos</p>
                    <p class="font-display text-xl font-black text-rose-600"><?= $aggregation['rejected'] ?></p>
                </div>
            </div>

            <!-- Per-Penilai Cards -->
            <?php if (!empty($assessments)): ?>
            <div class="space-y-3">
                <?php foreach ($assessments as $assessment): ?>
                <?php
                $aStatus = $assessment['status'];
                $aScore = (float)($assessment['persentase_nilai'] ?? 0);
                $aPassed = $aScore >= 80;
                ?>
                <div class="flex items-start gap-4 p-4 rounded-2xl border <?= $aPassed ? 'border-emerald-100 bg-emerald-50/30' : 'border-rose-100 bg-rose-50/30' ?>">
                    <div class="w-11 h-11 rounded-xl <?= $aPassed ? 'bg-emerald-500' : 'bg-rose-500' ?> flex items-center justify-center text-white font-bold shrink-0 shadow-sm">
                        <?= strtoupper(substr($assessment['penilai_nama'] ?? $assessment['penilai_username'] ?? '??', 0, 2)) ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="font-bold text-(--text-heading) text-sm"><?= esc($assessment['penilai_nama'] ?? $assessment['penilai_username'] ?? 'Penilai') ?></span>
                            <?php if (!empty($assessment['penilai_expertise'])): ?>
                            <span class="text-[10px] text-slate-400"><?= esc($assessment['penilai_expertise']) ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($assessment['catatan'])): ?>
                        <p class="text-xs text-slate-600 mt-1 line-clamp-2"><?= esc($assessment['catatan']) ?></p>
                        <?php endif; ?>
                        <?php if (!empty($assessment['submitted_at'])): ?>
                        <p class="text-[10px] text-slate-400 mt-1">
                            <i class="far fa-clock mr-0.5"></i> <?= date('d/m/Y H:i', strtotime($assessment['submitted_at'])) ?>
                        </p>
                        <?php endif; ?>
                    </div>
                    <div class="text-right shrink-0">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[12px] font-black border <?= $aPassed ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-rose-50 text-rose-600 border-rose-200' ?>">
                            <i class="fas <?= $aPassed ? 'fa-check' : 'fa-xmark' ?>"></i>
                            <?= number_format($aScore, 2) ?>%
                        </span>
                        <p class="text-[10px] font-semibold <?= $aPassed ? 'text-emerald-600' : 'text-rose-600' ?> mt-0.5">
                            <?= $aPassed ? 'LOLOS' : 'BELUM LOLOS' ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="p-8 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-3 text-slate-300">
                    <i class="fas fa-users-slash text-xl"></i>
                </div>
                <p class="text-slate-500 font-semibold">Belum ada penilai yang menilai</p>
                <p class="text-xs text-slate-400 mt-1">Menunggu penilai mengirimkan penilaian mereka</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ================================================================
         6. ADMIN FINALISASI
    ================================================================= -->
    <?php
    $isFinalized = !empty($proposal['penilaian_final_at'] ?? $proposal['pitching_final_at'] ?? null);
    $avgScore = $aggregation['avg'] ?? null;
    $autoStatus = ($avgScore !== null && $avgScore >= 80) ? 'approved' : 'rejected';
    $statusLabel = $autoStatus === 'approved' ? 'LOLOS' : 'BELUM LOLOS';
    $statusClass = $autoStatus === 'approved' ? 'text-emerald-600 bg-emerald-50 border-emerald-200' : 'text-rose-600 bg-rose-50 border-rose-200';
    ?>
    <div class="card-premium overflow-hidden animate-stagger delay-600 border-l-4 <?= $isFinalized ? 'border-l-emerald-500' : 'border-l-amber-500' ?>" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-file-signature text-amber-500 mr-2"></i>
                Finalisasi Admin
            </h3>
            <p class="text-[11px] text-(--text-muted) mt-0.5">Setujui hasil akhir penilaian untuk membuka tahap selanjutnya</p>
        </div>

        <div class="p-5 sm:p-7">
            <?php if ($isFinalized): ?>
            <!-- Already finalized -->
            <div class="flex items-start gap-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200">
                <div class="w-12 h-12 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-display font-bold text-emerald-700">✔ Sudah Difinalisasi</h4>
                    <p class="text-sm text-emerald-600 mt-1">Hasil penilaian pitching telah difinalisasi.</p>
                    <?php if ($avgScore !== null): ?>
                    <p class="text-xs text-emerald-500 mt-1">
                        Rata-rata: <strong><?= number_format($avgScore, 2) ?>%</strong> &middot;
                        Status akhir: <strong><?= $statusLabel ?></strong>
                        &middot; <?= $aggregation['count'] ?> penilai
                    </p>
                    <?php endif; ?>
                </div>
                <span class="px-3 py-1.5 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-700 border border-emerald-200 shrink-0">
                    FINAL
                </span>
            </div>
            <?php elseif ($avgScore === null || $aggregation['count'] === 0): ?>
            <!-- No assessments yet -->
            <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-200">
                <div class="w-12 h-12 rounded-xl bg-slate-300 text-white flex items-center justify-center shrink-0">
                    <i class="fas fa-hourglass-half text-xl"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-display font-bold text-slate-600">Menunggu Penilaian</h4>
                    <p class="text-sm text-slate-500 mt-1">Belum ada penilai yang mengirimkan penilaian. Finalisasi belum dapat dilakukan.</p>
                </div>
                <span class="px-3 py-1.5 rounded-full text-[10px] font-black bg-slate-100 text-slate-500 border border-slate-200 shrink-0">
                    TUNGGU
                </span>
            </div>
            <?php else: ?>
            <!-- Ready to finalize -->
            <div class="space-y-4">
                <div class="flex items-start gap-4 p-4 rounded-2xl bg-sky-50 border border-sky-200">
                    <div class="w-12 h-12 rounded-xl bg-sky-500 text-white flex items-center justify-center shrink-0">
                        <i class="fas fa-chart-simple text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-display font-bold text-sky-700">Hasil Otomatis</h4>
                        <p class="text-sm text-sky-600 mt-1">
                            Rata-rata: <strong><?= number_format($avgScore, 2) ?>%</strong>
                            &middot; Status: <span class="font-bold <?= $autoStatus === 'approved' ? 'text-emerald-600' : 'text-rose-600' ?>"><?= $statusLabel ?></span>
                            &middot; Dari <?= $aggregation['count'] ?> penilai
                        </p>
                        <p class="text-xs text-sky-500 mt-1">
                            <?php if ($autoStatus === 'approved'): ?>
                            ✔ Rata-rata <?= number_format($avgScore, 2) ?>% ≥ 80% → <strong>LOLOS</strong>
                            <?php else: ?>
                            ✘ Rata-rata <?= number_format($avgScore, 2) ?>% < 80% → <strong>BELUM LOLOS</strong>
                            <?php endif; ?>
                        </p>
                    </div>
                    <span class="px-3 py-1.5 rounded-full text-[10px] font-black <?= $statusClass ?> shrink-0">
                        <?= $statusLabel ?>
                    </span>
                </div>

                <form action="<?= base_url('admin/pitching-desk/' . $proposal['id'] . '/finalize') ?>" method="post"
                      onsubmit="return confirm('Setujui hasil final penilaian pitching ini?\n\nRata-rata: <?= number_format($avgScore, 2) ?>%\nStatus: <?= $statusLabel ?>\n\nSetelah difinalisasi, mahasiswa akan mendapat notifikasi dan tahap selanjutnya akan terbuka.')">
                    <?= csrf_field() ?>
                    <div class="flex justify-end">
                        <button type="submit" class="btn-primary px-8 bg-amber-500 hover:bg-amber-600 focus:ring-amber-100">
                            <i class="fas fa-check-circle mr-2"></i>Setujui Hasil & Finalisasi
                        </button>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php endif; ?>

</div><!-- /page wrapper -->

<!-- ================================================================
     BIODATA MODAL
================================================================= -->
<div id="biodataModal" class="fixed inset-0 z-50 hidden" aria-modal="true" role="dialog">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeBiodataModal()"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div id="modal-header" class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-display font-bold text-white">Detail Biodata</h3>
                        <button type="button" onclick="closeBiodataModal()" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="px-6 py-5">
                    <div class="text-center mb-5">
                        <div id="modal-avatar" class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-white font-display font-bold text-xl mb-3">
                            --
                        </div>
                        <h4 id="modal-nama" class="font-display font-bold text-lg text-slate-800">--</h4>
                        <span id="modal-role-badge" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border mt-2">
                            --
                        </span>
                    </div>
                    <div id="modal-content" class="space-y-3"></div>
                </div>
                <div class="bg-slate-50 px-6 py-4 flex justify-end">
                    <button type="button" onclick="closeBiodataModal()" class="btn-outline text-sm">
                        <i class="fas fa-times mr-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openBiodataModal(type, data) {
    const modal = document.getElementById('biodataModal');
    const header = document.getElementById('modal-header');
    const avatar = document.getElementById('modal-avatar');
    const nama = document.getElementById('modal-nama');
    const roleBadge = document.getElementById('modal-role-badge');
    const content = document.getElementById('modal-content');

    let bgColor = type === 'mahasiswa' ? 'bg-teal-500' : 'bg-violet-500';
    let roleLabel = type === 'mahasiswa' ? (data.role === 'ketua' ? 'Ketua Tim' : 'Anggota') : 'Dosen Pendamping';

    header.className = `${bgColor} px-6 py-4`;
    const initials = (data.nama || '??').substring(0, 2).toUpperCase();
    avatar.textContent = initials;
    avatar.className = `w-16 h-16 mx-auto rounded-2xl ${bgColor} flex items-center justify-center text-white font-display font-bold text-xl mb-3 shadow-lg shadow-slate-200`;

    nama.textContent = data.nama || '-';
    roleBadge.textContent = roleLabel;
    roleBadge.className = `inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border ${bgColor.replace('bg-', 'bg-50 text-').replace('bg-', 'border-')}`;

    let html = '';
    const fields = type === 'mahasiswa' ? [
        { icon: 'fa-id-card', label: 'NIM', value: data.nim },
        { icon: 'fa-building', label: 'Jurusan', value: data.jurusan },
        { icon: 'fa-graduation-cap', label: 'Prodi', value: data.prodi },
        { icon: 'fa-calendar-alt', label: 'Semester', value: data.semester },
        { icon: 'fa-phone', label: 'No. HP', value: data.phone },
        { icon: 'fa-envelope', label: 'Email', value: data.email },
    ] : [
        { icon: 'fa-id-card', label: 'NIP', value: data.nip },
        { icon: 'fa-building', label: 'Jurusan', value: data.jurusan },
        { icon: 'fa-graduation-cap', label: 'Prodi', value: data.prodi },
        { icon: 'fa-phone', label: 'No. HP', value: data.phone },
    ];

    fields.forEach(f => {
        if (f.value) {
            html += `
            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm">
                    <i class="fas ${f.icon}"></i>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">${f.label}</p>
                    <p class="text-sm font-semibold text-slate-700">${f.value}</p>
                </div>
            </div>`;
        }
    });

    content.innerHTML = html || '<p class="text-center text-slate-400 py-4">Tidak ada data tambahan</p>';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeBiodataModal() {
    document.getElementById('biodataModal').classList.add('hidden');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeBiodataModal(); });
</script>

<?= $this->endSection() ?>
