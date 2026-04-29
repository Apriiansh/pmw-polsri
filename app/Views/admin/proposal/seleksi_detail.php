<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="{
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    },
    activeDoc: 'proposal_utama',
    selectedMember: null,
    openMember(m) { this.selectedMember = m; },
    closeMember() { this.selectedMember = null; }
}">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Detail <span class="text-gradient">Proposal</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Validasi kelengkapan dokumen & Business Plan</p>
        </div>
        <a href="<?= base_url('admin/administrasi/seleksi') ?>" class="btn-ghost inline-flex items-center gap-2">
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
        'draft'     => 'bg-slate-50 text-slate-600 border-slate-200',
        'submitted' => 'bg-amber-50 text-amber-600 border-amber-200',
        'revision'  => 'bg-orange-50 text-orange-600 border-orange-200',
        'approved'  => 'bg-emerald-50 text-emerald-600 border-emerald-200',
        'rejected'  => 'bg-rose-50 text-rose-600 border-rose-200',
    ];
    $statusLabels = [
        'draft'     => 'Draft',
        'submitted' => 'Menunggu Validasi',
        'revision'  => 'Perlu Revisi',
        'approved'  => 'Disetujui',
        'rejected'  => 'Ditolak',
    ];
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
            <div class="flex items-center gap-2 flex-wrap">
                <span class="pmw-status <?= $statusColors[$proposal['status']] ?? '' ?>">
                    <i class="fas fa-circle text-[8px]"></i>
                    <?= $statusLabels[$proposal['status']] ?? ucfirst($proposal['status']) ?>
                </span>
                <?php if (!empty($proposal['submitted_at'])): ?>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black bg-sky-500 text-white shadow-sm shadow-sky-100">
                    <i class="fas fa-paper-plane"></i>
                    <?= date('d/m/y H:i', strtotime($proposal['submitted_at'])) ?>
                </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="p-5 sm:p-7">
            <div class="grid md:grid-cols-3 gap-6">
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Kategori Wirausaha</p>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold border <?= ($proposal['kategori_wirausaha'] ?? '') === 'pemula' ? 'bg-sky-50 text-sky-600 border-sky-200' : 'bg-violet-50 text-violet-600 border-violet-200' ?>">
                        <i class="fas fa-rocket text-xs"></i>
                        <?= ($proposal['kategori_wirausaha'] ?? '') === 'pemula' ? 'Pemula' : 'Berkembang' ?>
                    </span>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Kategori Usaha</p>
                    <p class="font-semibold text-(--text-heading)"><?= esc($proposal['kategori_usaha'] ?: '-') ?></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Total RAB</p>
                    <p class="font-display font-bold text-lg text-(--text-heading)">
                        <?= !empty($proposal['total_rab']) ? 'Rp ' . number_format((float)$proposal['total_rab'], 0, ',', '.') : '-' ?>
                    </p>
                </div>
            </div>

            <?php if (!empty($proposal['catatan'])): ?>
            <div class="mt-5 pt-5 border-t border-slate-100">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-2">Catatan Sebelumnya</p>
                <p class="text-sm text-(--text-body) leading-relaxed bg-amber-50 border border-amber-100 rounded-xl p-3"><?= nl2br(esc($proposal['catatan'])) ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ================================================================
         3. DOCUMENTS (tabbed) + TEAM INFO — 2 kolom
    ================================================================= -->
    <div class="grid lg:grid-cols-3 gap-6 animate-stagger delay-200">

        <!-- Kiri: Dokumen tabbed (col-span-2) -->
        <div class="lg:col-span-2 card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-5 py-3 border-b border-sky-50 bg-white/60 flex items-center justify-between gap-3 flex-wrap">
                <div class="flex gap-1 bg-slate-100 rounded-xl p-1">
                    <?php
                    $allDocTabs = [
                        'proposal_utama'        => ['label' => 'Proposal', 'icon' => 'fa-file-alt',    'color' => 'sky'],
                        'surat_kesediaan_dosen' => ['label' => 'Surat Kesediaan Dosen', 'icon' => 'fa-user-shield', 'color' => 'violet'],
                    ];
                    $availableTabs = array_filter($allDocTabs, fn($k) => isset($docsByKey[$k]), ARRAY_FILTER_USE_KEY);
                    $firstTab = array_key_first($availableTabs) ?? 'proposal_utama';
                    ?>
                    <?php foreach ($availableTabs as $key => $meta): ?>
                    <button type="button" @click="activeDoc='<?= $key ?>'"
                        :class="activeDoc==='<?= $key ?>' ? 'bg-white shadow text-<?= $meta['color'] ?>-600 font-black' : 'text-slate-500 hover:text-slate-700'"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold transition-all">
                        <i class="fas <?= $meta['icon'] ?> text-[10px]"></i>
                        <?= $meta['label'] ?>
                    </button>
                    <?php endforeach; ?>
                    <?php if (empty($availableTabs)): ?>
                    <span class="text-xs text-slate-400 italic px-2 py-1.5">Belum ada dokumen</span>
                    <?php endif; ?>
                </div>
                <?php foreach ($availableTabs as $key => $meta): ?>
                <div x-show="activeDoc==='<?= $key ?>'">
                    <a href="<?= base_url('admin/administrasi/seleksi/doc/' . $docsByKey[$key]['id']) ?>"
                       class="text-[10px] font-black text-<?= $meta['color'] ?>-500 hover:text-<?= $meta['color'] ?>-600 uppercase tracking-widest">
                        <i class="fas fa-download mr-1"></i> Download
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="p-4">
                <?php foreach ($availableTabs as $key => $meta): ?>
                <?php
                    $doc = $docsByKey[$key];
                    $ext = strtolower(pathinfo($doc['original_name'], PATHINFO_EXTENSION));
                    $isPdf = ($ext === 'pdf');
                    $docUrl = base_url('admin/administrasi/seleksi/doc/' . $doc['id']);
                ?>
                <div x-show="activeDoc==='<?= $key ?>'" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <?php if ($isPdf): ?>
                    <div class="w-full bg-slate-50 rounded-xl overflow-hidden" style="height:65vh">
                        <iframe src="<?= $docUrl ?>?inline=1" class="w-full h-full border-none"></iframe>
                    </div>
                    <?php else: ?>
                    <div class="flex flex-col items-center justify-center p-12 bg-slate-50 rounded-xl" style="height:65vh">
                        <div class="w-20 h-20 rounded-3xl bg-<?= $meta['color'] ?>-100 text-<?= $meta['color'] ?>-500 flex items-center justify-center mb-4 shadow-lg">
                            <i class="fas <?= $meta['icon'] ?> text-3xl"></i>
                        </div>
                        <p class="font-bold text-slate-700 text-sm"><?= esc($doc['original_name']) ?></p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">File <?= strtoupper($ext) ?> · Preview tidak tersedia</p>
                    </div>
                    <?php endif; ?>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="text-[10px] text-slate-500 truncate"><?= esc($doc['original_name']) ?></span>
                        <?php if ($isPdf): ?>
                        <a href="<?= $docUrl ?>?inline=1" target="_blank" class="btn-ghost btn-xs text-<?= $meta['color'] ?>-600">
                            <i class="fas fa-expand-alt"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php if (empty($availableTabs)): ?>
                <div class="p-10 text-center bg-slate-50/50 rounded-2xl border-2 border-dashed border-slate-100">
                    <i class="fas fa-file-circle-exclamation text-4xl mb-3 opacity-20"></i>
                    <p class="text-sm italic text-slate-400">Belum ada dokumen diunggah</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Kanan: Anggota Tim + Dosen (col-span-1) -->
        <div class="space-y-4">
            <!-- Anggota Tim -->
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-4 py-3 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-sm font-bold text-(--text-heading)">
                        <i class="fas fa-users text-teal-500 mr-2"></i>
                        Anggota Tim
                    </h3>
                </div>
                <div class="p-3 space-y-2">
                    <?php foreach ($members as $member): ?>
                    <?php
                        $phone = $member['phone'] ?? null;
                        $wa = preg_replace('/[^0-9]/', '', $phone ?? '');
                        if (str_starts_with($wa, '0')) $wa = '62' . substr($wa, 1);
                        $waLink = $wa ? 'https://wa.me/' . $wa : null;
                        $memberJson = json_encode([
                            'nama'     => $member['nama'],
                            'nim'      => $member['nim'] ?? '-',
                            'jurusan'  => $member['jurusan'] ?? null,
                            'prodi'    => $member['prodi'] ?? '-',
                            'semester' => $member['semester'] ?? null,
                            'role'     => $member['role'] === 'ketua' ? 'Ketua' : 'Anggota',
                            'no_hp'    => $phone,
                            'wa'       => $waLink,
                            'email'    => $member['email'] ?? null,
                        ]);
                    ?>
                    <button type="button" @click="openMember(<?= htmlspecialchars($memberJson, ENT_QUOTES) ?>)"
                        class="flex items-center gap-2.5 p-2.5 rounded-xl text-left w-full transition-all hover:shadow-sm <?= $member['role'] === 'ketua' ? 'bg-teal-50 border border-teal-100 hover:border-teal-300' : 'bg-slate-50 border border-slate-100 hover:border-slate-200' ?>">
                        <div class="w-8 h-8 rounded-lg <?= $member['role'] === 'ketua' ? 'bg-teal-500' : 'bg-slate-300' ?> flex items-center justify-center text-white font-bold text-xs shrink-0">
                            <?= strtoupper(substr($member['nama'], 0, 2)) ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-(--text-heading) text-xs truncate"><?= esc($member['nama']) ?></div>
                            <div class="text-[10px] text-(--text-muted) truncate"><?= esc($member['nim'] ?? '-') ?></div>
                            <div class="text-[9px] <?= $member['role'] === 'ketua' ? 'text-teal-600 font-bold' : 'text-slate-400' ?>">
                                <?= $member['role'] === 'ketua' ? 'Ketua' : 'Anggota' ?>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-[9px] text-slate-300 shrink-0"></i>
                    </button>
                    <?php endforeach; ?>
                    <?php if (empty($members)): ?>
                    <div class="text-center py-4 text-slate-400">
                        <i class="fas fa-users-slash text-xl mb-2"></i>
                        <p class="text-xs">Belum ada anggota</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Dosen Pendamping -->
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-4 py-3 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-sm font-bold text-(--text-heading)">
                        <i class="fas fa-chalkboard-user text-violet-500 mr-2"></i>
                        Dosen Pendamping
                    </h3>
                </div>
                <div class="p-3">
                    <?php if (!empty($proposal['dosen_nama'])): ?>
                    <?php
                        $dosenPhone = $proposal['dosen_phone'] ?? null;
                        $dosenWa = preg_replace('/[^0-9]/', '', $dosenPhone ?? '');
                        if (str_starts_with($dosenWa, '0')) $dosenWa = '62' . substr($dosenWa, 1);
                        $dosenWaLink = $dosenWa ? 'https://wa.me/' . $dosenWa : null;
                        $dosenJson = json_encode([
                            'nama'    => $proposal['dosen_nama'],
                            'nim'     => $proposal['dosen_nip'] ?? '-',
                            'jurusan' => $proposal['dosen_jurusan'] ?? null,
                            'prodi'   => $proposal['dosen_prodi'] ?? null,
                            'role'    => 'Dosen Pendamping',
                            'no_hp'   => $dosenPhone,
                            'wa'      => $dosenWaLink,
                            'email'   => $proposal['dosen_email'] ?? null,
                        ]);
                    ?>
                    <button type="button" @click="openMember(<?= htmlspecialchars($dosenJson, ENT_QUOTES) ?>)"
                        class="flex items-center gap-2.5 p-2.5 rounded-xl text-left w-full transition-all hover:shadow-sm bg-violet-50 border border-violet-100 hover:border-violet-300">
                        <div class="w-8 h-8 rounded-lg bg-violet-500 flex items-center justify-center text-white font-bold text-xs shrink-0">
                            <?= strtoupper(substr($proposal['dosen_nama'], 0, 2)) ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-(--text-heading) text-xs truncate"><?= esc($proposal['dosen_nama']) ?></div>
                            <div class="text-[10px] text-(--text-muted) truncate"><?= esc($proposal['dosen_nip'] ?? '-') ?></div>
                            <div class="text-[9px] text-violet-600 font-bold">Dosen Pendamping</div>
                        </div>
                        <i class="fas fa-chevron-right text-[9px] text-slate-300 shrink-0"></i>
                    </button>
                    <?php else: ?>
                    <div class="text-center py-4 text-slate-400">
                        <i class="fas fa-user-slash text-xl mb-2"></i>
                        <p class="text-xs">Belum ada dosen</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Member / Dosen Detail Modal -->
    <div x-show="selectedMember" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm" @click.self="closeMember()" style="display:none">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-6 space-y-4" @click.stop>
            <div class="flex items-center justify-between">
                <h4 class="font-display font-bold text-slate-800">Detail</h4>
                <button @click="closeMember()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition-colors">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>
            <template x-if="selectedMember">
            <div class="space-y-3">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-teal-500 flex items-center justify-center text-white font-display font-bold text-lg shrink-0"
                        x-text="selectedMember.nama.substring(0,2).toUpperCase()"></div>
                    <div>
                        <p class="font-bold text-slate-800" x-text="selectedMember.nama"></p>
                        <p class="text-xs text-slate-500" x-text="selectedMember.nim + ' · ' + selectedMember.role"></p>
                    </div>
                </div>
                <div class="space-y-2 pt-2 border-t border-slate-50">
                    <template x-if="selectedMember.jurusan">
                    <div class="flex items-center gap-3 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-7 h-7 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm shrink-0"><i class="fas fa-building text-xs"></i></div>
                        <div><p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Jurusan</p><p class="text-sm font-semibold text-slate-700" x-text="selectedMember.jurusan"></p></div>
                    </div>
                    </template>
                    <div class="flex items-center gap-3 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-7 h-7 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm shrink-0"><i class="fas fa-graduation-cap text-xs"></i></div>
                        <div><p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Prodi</p><p class="text-sm font-semibold text-slate-700" x-text="selectedMember.prodi"></p></div>
                    </div>
                    <template x-if="selectedMember.semester">
                    <div class="flex items-center gap-3 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-7 h-7 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm shrink-0"><i class="fas fa-calendar-alt text-xs"></i></div>
                        <div><p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Semester</p><p class="text-sm font-semibold text-slate-700" x-text="selectedMember.semester"></p></div>
                    </div>
                    </template>
                    <template x-if="selectedMember.no_hp">
                    <div class="flex items-center gap-3 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-7 h-7 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm shrink-0"><i class="fas fa-phone text-xs"></i></div>
                        <div><p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">No. HP</p><p class="text-sm font-semibold text-slate-700" x-text="selectedMember.no_hp"></p></div>
                    </div>
                    </template>
                    <template x-if="selectedMember.email">
                    <div class="flex items-center gap-3 p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="w-7 h-7 rounded-lg bg-sky-50 flex items-center justify-center text-sky-400 shadow-sm shrink-0"><i class="fas fa-envelope text-xs"></i></div>
                        <div><p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Email</p><p class="text-sm font-semibold text-slate-700" x-text="selectedMember.email"></p></div>
                    </div>
                    </template>
                </div>
                <template x-if="selectedMember.wa">
                <a :href="selectedMember.wa" target="_blank"
                    class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-sm transition-colors">
                    <i class="fab fa-whatsapp text-base"></i>
                    Hubungi via WhatsApp
                </a>
                </template>
                <template x-if="!selectedMember.wa">
                <div class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-slate-100 text-slate-400 font-bold text-sm cursor-not-allowed">
                    <i class="fas fa-phone-slash text-xs"></i>
                    Nomor tidak tersedia
                </div>
                </template>
            </div>
            </template>
        </div>
    </div>

    <!-- ================================================================
         4. VALIDATION FORM
    ================================================================= -->
    <?php if (in_array($proposal['status'], ['submitted', 'revision'])): ?>
    <div class="card-premium overflow-hidden animate-stagger delay-400 border-l-4 border-l-sky-500" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-clipboard-check text-sky-500 mr-2"></i>
                Form Validasi Admin
            </h3>
            <p class="text-[11px] text-(--text-muted) mt-0.5">Tentukan status proposal ini</p>
        </div>
        <form action="<?= base_url('admin/administrasi/seleksi/' . $proposal['id'] . '/validasi') ?>" method="post">
            <?= csrf_field() ?>
            <div class="p-5 sm:p-7 space-y-5">
                <div>
                    <label class="form-label">Status Validasi <span class="required">*</span></label>
                    <div class="grid sm:grid-cols-3 gap-3 mt-2">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="status" value="approved" class="peer sr-only" required>
                            <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:border-emerald-300">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                        <i class="fas fa-circle-check"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-(--text-heading)">Setujui</p>
                                        <p class="text-xs text-(--text-muted)">Lolos seleksi</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="status" value="revision" class="peer sr-only">
                            <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all hover:border-orange-300">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center">
                                        <i class="fas fa-rotate"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-(--text-heading)">Revisi</p>
                                        <p class="text-xs text-(--text-muted)">Perlu perbaikan</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="status" value="rejected" class="peer sr-only">
                            <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-rose-500 peer-checked:bg-rose-50 transition-all hover:border-rose-300">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center">
                                        <i class="fas fa-circle-xmark"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-(--text-heading)">Tolak</p>
                                        <p class="text-xs text-(--text-muted)">Tidak memenuhi syarat</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="form-label">Catatan untuk Mahasiswa</label>
                    <textarea name="catatan" rows="3" class="form-textarea" placeholder="Berikan catatan atau feedback..."><?= esc($proposal['catatan'] ?? '') ?></textarea>
                    <p class="text-xs text-(--text-muted) mt-1">Catatan ini akan dilihat oleh mahasiswa.</p>
                </div>
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="<?= base_url('admin/administrasi/seleksi') ?>" class="btn-outline">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i>Simpan Validasi
                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php elseif ($proposal['status'] === 'approved'): ?>
    <div class="card-premium p-5 sm:p-7 bg-emerald-50 border border-emerald-200 animate-stagger delay-400" @mousemove="handleMouseMove">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center text-white shrink-0">
                <i class="fas fa-circle-check text-xl"></i>
            </div>
            <div>
                <h4 class="font-display font-bold text-emerald-700">Proposal Disetujui</h4>
                <p class="text-sm text-emerald-600">Proposal ini telah lolos seleksi administrasi dan dapat melanjutkan ke tahap berikutnya.</p>
            </div>
        </div>
    </div>

    <?php elseif ($proposal['status'] === 'rejected'): ?>
    <div class="card-premium p-5 sm:p-7 bg-rose-50 border border-rose-200 animate-stagger delay-400" @mousemove="handleMouseMove">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-rose-500 flex items-center justify-center text-white shrink-0">
                    <i class="fas fa-circle-xmark text-xl"></i>
                </div>
                <div>
                    <h4 class="font-display font-bold text-rose-700">Proposal Ditolak</h4>
                    <p class="text-sm text-rose-600">Proposal ini tidak memenuhi syarat seleksi administrasi.</p>
                </div>
            </div>
            <a href="<?= base_url('admin/administrasi/seleksi/' . $proposal['id'] . '/hapus') ?>"
               class="btn-outline border-rose-300 text-rose-600 hover:bg-rose-500 hover:text-white"
               onclick="return confirm('Yakin ingin menghapus proposal ini secara permanen?')">
                <i class="fas fa-trash mr-2"></i>Hapus
            </a>
        </div>
    </div>
    <?php endif; ?>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>
