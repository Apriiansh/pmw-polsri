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
                Validasi <span class="text-gradient">Proposal</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Review Business Plan dan Surat Kesediaan sebagai Dosen Pendamping</p>
        </div>
        <a href="<?= base_url('dosen/proposal-validation') ?>" class="btn-ghost inline-flex items-center gap-2">
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
        'pending'  => 'bg-slate-50 text-slate-600 border-slate-200',
        'approved' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
        'revision' => 'bg-orange-50 text-orange-600 border-orange-200',
        'rejected' => 'bg-rose-50 text-rose-600 border-rose-200',
    ];
    $statusLabels = [
        'pending'  => 'Menunggu Validasi',
        'approved' => 'Disetujui',
        'revision' => 'Perlu Revisi',
        'rejected' => 'Ditolak',
    ];
    $dosenStatus = $proposal['proposal_dosen_status'] ?? 'pending';
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
            <div class="flex items-center gap-3">
                <?php if (!empty($proposal['student_submitted_at'])): ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black bg-sky-500 text-white shadow-sm shadow-sky-100">
                        <i class="fas fa-paper-plane"></i>
                        TERKIRIM: <?= date('d/m/y H:i', strtotime($proposal['student_submitted_at'])) ?>
                    </span>
                <?php endif; ?>
                <span class="pmw-status <?= $statusColors[$dosenStatus] ?? '' ?>">
                    <i class="fas fa-circle text-[8px]"></i>
                    <?= $statusLabels[$dosenStatus] ?? ucfirst($dosenStatus) ?>
                </span>
            </div>
        </div>

        <div class="p-5 sm:p-7">
            <div class="grid md:grid-cols-3 gap-6">
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Kategori Wirausaha</p>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold border <?= $proposal['kategori_wirausaha'] === 'pemula' ? "bg-sky-50 text-sky-600 border-sky-200" : "bg-violet-50 text-violet-600 border-violet-200" ?>">
                        <i class="fas fa-rocket text-xs"></i>
                        <?= $proposal['kategori_wirausaha'] === 'pemula' ? 'Pemula' : 'Berkembang' ?>
                    </span>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Kategori Usaha</p>
                    <p class="font-semibold text-(--text-heading)"><?= esc($proposal['kategori_usaha'] ?: '-') ?></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Total RAB</p>
                    <p class="font-semibold text-(--text-heading)">
                        <?= $proposal['total_rab'] ? 'Rp ' . number_format((float) $proposal['total_rab'], 0, ',', '.') : '-' ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================
         3. TEAM INFO
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-users text-teal-500 mr-2"></i>
                Anggota Tim Mahasiswa
            </h3>
        </div>
        <div class="p-5 sm:p-7 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($members as $member): ?>
            <div class="flex items-center gap-3 p-3 rounded-xl <?= $member['role'] === 'ketua' ? "bg-teal-50 border border-teal-100" : "bg-slate-50 border border-transparent" ?>">
                <div class="w-10 h-10 rounded-lg <?= $member['role'] === 'ketua' ? "bg-teal-500 shadow-lg shadow-teal-100" : "bg-slate-300" ?> flex items-center justify-center text-white font-display font-bold text-sm shrink-0">
                    <?= strtoupper(substr($member['nama'], 0, 2)) ?>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="font-semibold text-(--text-heading) text-sm truncate"><?= esc($member['nama']) ?></div>
                    <div class="text-[10px] text-(--text-muted) truncate">
                        <?= esc($member['nim'] ?? '-') ?> · <?= esc($member['role'] === 'ketua' ? 'Ketua' : 'Anggota') ?>
                    </div>
                    <?php if (!empty($member['prodi'])): ?>
                    <div class="text-[9px] text-slate-400 truncate"><?= esc($member['prodi']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ================================================================
         4. DOCUMENTS
    ================================================================= -->
    <div class="grid lg:grid-cols-2 gap-6 animate-stagger delay-300">
        <!-- Proposal Utama -->
        <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-file-alt text-sky-500 mr-2"></i>
                    Business Plan & BMC
                </h3>
                <?php if (isset($docsByKey['proposal_utama'])): ?>
                <a href="<?= base_url('dosen/proposal-validation/doc/' . $docsByKey['proposal_utama']['id']) ?>" class="text-[10px] font-black text-sky-500 hover:text-sky-600 uppercase tracking-widest">
                    <i class="fas fa-download mr-1"></i> Download
                </a>
                <?php endif; ?>
            </div>
            <div class="p-5">
                <?php if (isset($docsByKey['proposal_utama'])): ?>
                    <div class="aspect-3/4 w-full bg-slate-50 rounded-xl overflow-hidden">
                        <iframe src="<?= base_url('dosen/proposal-validation/doc/' . $docsByKey['proposal_utama']['id'] . '?inline=1') ?>" class="w-full h-full border-none"></iframe>
                    </div>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="text-[10px] text-slate-500 truncate"><?= esc($docsByKey['proposal_utama']['original_name']) ?></span>
                        <a href="<?= base_url('dosen/proposal-validation/doc/' . $docsByKey['proposal_utama']['id'] . '?inline=1') ?>" target="_blank" class="btn-ghost btn-xs text-sky-600">
                            <i class="fas fa-expand-alt"></i>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="p-10 text-center bg-slate-50/50 rounded-2xl border-2 border-dashed border-slate-100">
                        <i class="fas fa-file-circle-exclamation text-4xl mb-3 opacity-20"></i>
                        <p class="text-sm italic text-slate-400">File belum diunggah</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Surat Kesediaan Dosen -->
        <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-user-shield text-violet-500 mr-2"></i>
                    Surat Kesediaan Dosen
                </h3>
                <?php if (isset($docsByKey['surat_kesediaan_dosen'])): ?>
                <a href="<?= base_url('dosen/proposal-validation/doc/' . $docsByKey['surat_kesediaan_dosen']['id']) ?>" class="text-[10px] font-black text-violet-500 hover:text-violet-600 uppercase tracking-widest">
                    <i class="fas fa-download mr-1"></i> Download
                </a>
                <?php endif; ?>
            </div>
            <div class="p-5">
                <?php if (isset($docsByKey['surat_kesediaan_dosen'])): ?>
                    <div class="aspect-3/4 w-full bg-slate-50 rounded-xl overflow-hidden">
                        <iframe src="<?= base_url('dosen/proposal-validation/doc/' . $docsByKey['surat_kesediaan_dosen']['id'] . '?inline=1') ?>" class="w-full h-full border-none"></iframe>
                    </div>
                    <div class="mt-2 flex items-center justify-between">
                        <span class="text-[10px] text-slate-500 truncate"><?= esc($docsByKey['surat_kesediaan_dosen']['original_name']) ?></span>
                        <a href="<?= base_url('dosen/proposal-validation/doc/' . $docsByKey['surat_kesediaan_dosen']['id'] . '?inline=1') ?>" target="_blank" class="btn-ghost btn-xs text-violet-600">
                            <i class="fas fa-expand-alt"></i>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="p-10 text-center bg-slate-50/50 rounded-2xl border-2 border-dashed border-slate-100">
                        <i class="fas fa-file-circle-exclamation text-4xl mb-3 opacity-20"></i>
                        <p class="text-sm italic text-slate-400">File belum diunggah</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ================================================================
         5. VALIDATION FORM
    ================================================================= -->
    <div class="grid lg:grid-cols-5 gap-6">
        <div class="lg:col-span-3">
            <div class="card-premium overflow-hidden animate-stagger delay-400 border-l-4 border-l-sky-500" @mousemove="handleMouseMove">
                <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-base font-bold text-(--text-heading)">
                        <i class="fas fa-clipboard-check text-sky-500 mr-2"></i>
                        Validasi Dosen Pendamping
                    </h3>
                    <p class="text-[11px] text-(--text-muted) mt-0.5">Berikan penilaian dan feedback untuk proposal mahasiswa</p>
                </div>

                <form action="<?= base_url('dosen/proposal-validation/' . $proposal['id'] . '/validate') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="p-5 sm:p-7 space-y-6">
                        <!-- Status Selection -->
                        <div>
                            <label class="form-label mb-3 block text-xs font-black uppercase tracking-widest text-slate-400">Keputusan Validasi</label>
                            <div class="grid sm:grid-cols-3 gap-4">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="status" value="approved" class="peer sr-only" <?= $dosenStatus === 'approved' ? 'checked' : '' ?> required>
                                    <div class="p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:border-emerald-200">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center peer-checked:bg-emerald-500 peer-checked:text-white transition-colors">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-(--text-heading) text-sm leading-tight">Layak</p>
                                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">Setujui</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer">
                                    <input type="radio" name="status" value="revision" class="peer sr-only" <?= $dosenStatus === 'revision' ? 'checked' : '' ?>>
                                    <div class="p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all hover:border-orange-200">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center peer-checked:bg-orange-500 peer-checked:text-white transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-(--text-heading) text-sm leading-tight">Revisi</p>
                                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">Perlu Perbaikan</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer">
                                    <input type="radio" name="status" value="rejected" class="peer sr-only" <?= $dosenStatus === 'rejected' ? 'checked' : '' ?>>
                                    <div class="p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-rose-500 peer-checked:bg-rose-50 transition-all hover:border-rose-200">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center peer-checked:bg-rose-500 peer-checked:text-white transition-colors">
                                                <i class="fas fa-times-circle"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-(--text-heading) text-sm leading-tight">Tolak</p>
                                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">Tidak Layak</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="space-y-1.5">
                            <label class="form-label text-xs font-black uppercase tracking-widest text-slate-400">Catatan Feedback</label>
                            <div class="input-group items-start py-2 focus-within:ring-4 focus-within:ring-sky-50 transition-all">
                                <div class="input-icon mt-2 text-slate-400">
                                    <i class="fas fa-comment-dots"></i>
                                </div>
                                <textarea name="catatan" rows="4" placeholder="Berikan feedback membangun untuk mahasiswa..."><?= esc($proposal['proposal_dosen_catatan'] ?? '') ?></textarea>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-50">
                            <button type="submit" class="btn-primary w-full sm:w-auto px-10 py-3 shadow-lg shadow-sky-100">
                                <i class="fas fa-save mr-2"></i>Simpan Validasi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Admin Info Sidebar -->
        <div class="lg:col-span-2">
            <div class="card-premium overflow-hidden border-l-4 border-l-emerald-500 animate-stagger delay-500" @mousemove="handleMouseMove">
                <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-base font-bold text-(--text-heading)">
                        <i class="fas fa-shield-halved text-emerald-500 mr-2"></i>
                        Status Akhir Admin
                    </h3>
                </div>
                <div class="p-6">
                    <?php if (($proposal['proposal_admin_status'] ?? 'pending') !== 'pending'): ?>
                    <div class="text-center">
                        <div class="w-14 h-14 rounded-full <?= ($proposal['proposal_admin_status'] === 'approved') ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600' ?> flex items-center justify-center mx-auto mb-3 text-xl">
                            <i class="fas <?= ($proposal['proposal_admin_status'] === 'approved') ? 'fa-circle-check' : 'fa-circle-xmark' ?>"></i>
                        </div>
                        <h4 class="font-black text-xs uppercase tracking-[0.2em] mb-1">Status Final</h4>
                        <p class="font-bold text-lg <?= ($proposal['proposal_admin_status'] === 'approved') ? 'text-emerald-600' : 'text-rose-600' ?>">
                            <?= strtoupper($proposal['proposal_admin_status']) ?>
                        </p>
                        <?php if (!empty($proposal['proposal_admin_catatan'])): ?>
                        <div class="mt-4 p-4 rounded-xl bg-slate-50 text-slate-600 text-xs italic border border-slate-100 leading-relaxed">
                            "<?= esc($proposal['proposal_admin_catatan']) ?>"
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php else: ?>
                    <div class="text-center py-6">
                        <div class="w-14 h-14 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3 animate-pulse">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-widest italic">Menunggu Final Admin</p>
                        <p class="text-[10px] text-slate-300 mt-2 px-10">Status final akan muncul di sini setelah Admin memproses validasi Anda.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>
