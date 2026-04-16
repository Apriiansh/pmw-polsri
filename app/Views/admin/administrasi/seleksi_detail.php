<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Detail <span class="text-gradient">Proposal</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Validasi kelengkapan dokumen proposal</p>
        </div>
        <a href="<?= base_url('admin/seleksi-administrasi') ?>" class="btn-ghost inline-flex items-center gap-2">
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
        'submitted' => 'bg-yellow-50 text-yellow-600 border-yellow-200',
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
    <div class="card-premium overflow-hidden animate-stagger delay-100">
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
            <span class="pmw-status <?= $statusColors[$proposal['status']] ?? '' ?>">
                <i class="fas fa-circle text-[8px]"></i>
                <?= $statusLabels[$proposal['status']] ?? ucfirst($proposal['status']) ?>
            </span>
        </div>

        <div class="p-5 sm:p-7">
            <div class="grid md:grid-cols-3 gap-6">
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

                <!-- Total RAB -->
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Total RAB</p>
                    <p class="font-display font-bold text-lg text-(--text-heading)">
                        <?= $proposal['total_rab'] ? 'Rp ' . number_format($proposal['total_rab'], 0, ',', '.') : '-' ?>
                    </p>
                </div>
            </div>

            <?php if (!empty($proposal['detail_keterangan'])): ?>
            <div class="mt-6 pt-6 border-t border-slate-100">
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-2">Detail Keterangan</p>
                <p class="text-sm text-(--text-body) leading-relaxed"><?= nl2br(esc($proposal['detail_keterangan'])) ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ================================================================
         3. TEAM & DOSEN INFO
    ================================================================= -->
    <div class="grid lg:grid-cols-2 gap-6 animate-stagger delay-200">
        <!-- Tim Proposal -->
        <div class="card-premium overflow-hidden">
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

                <?php if (empty($members)): ?>
                <div class="text-center py-4 text-slate-400">
                    <i class="fas fa-users-slash text-2xl mb-2"></i>
                    <p class="text-sm">Belum ada anggota terdaftar</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Dosen Pendamping -->
        <div class="card-premium overflow-hidden">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-chalkboard-user text-violet-500 mr-2"></i>
                    Dosen Pendamping
                </h3>
            </div>
            <div class="p-5 sm:p-7">
                <?php if (!empty($proposal['dosen_nama'])): ?>
                <?php
                $dosenData = [
                    'nama' => $proposal['dosen_nama'],
                    'nip' => $proposal['dosen_nip'] ?? null,
                    'jurusan' => $proposal['dosen_jurusan'] ?? null,
                    'prodi' => $proposal['dosen_prodi'] ?? null,
                    'phone' => $proposal['dosen_phone'] ?? null,
                ];
                ?>
                <div class="flex items-center gap-3 p-3 rounded-xl bg-violet-50 border border-violet-100 cursor-pointer hover:shadow-md transition-all"
                     onclick='openBiodataModal("dosen", <?= json_encode($dosenData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                    <div class="w-10 h-10 rounded-lg bg-violet-500 flex items-center justify-center text-white font-display font-bold text-sm shrink-0">
                        <?= strtoupper(substr($proposal['dosen_nama'], 0, 2)) ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-(--text-heading) text-sm"><?= esc($proposal['dosen_nama']) ?></div>
                        <div class="text-xs text-(--text-muted)">
                            <?= esc($proposal['dosen_nip'] ?? '-') ?> · <?= esc($proposal['dosen_prodi'] ?? '-') ?>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-slate-400 text-xs"></i>
                </div>
                <?php else: ?>
                <div class="text-center py-4 text-slate-400">
                    <i class="fas fa-user-slash text-2xl mb-2"></i>
                    <p class="text-sm">Belum ada dosen pendamping</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ================================================================
         4. DOCUMENTS CHECKLIST
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-300">
        <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-folder-open text-sky-500 mr-2"></i>
                Kelengkapan Dokumen
            </h3>
            <p class="text-[11px] text-(--text-muted) mt-0.5">5 dokumen wajib untuk validasi administrasi</p>
        </div>

        <div class="p-5 sm:p-7">
            <div class="space-y-3">
                <?php 
                $completeDocs = 0;
                foreach ($requiredDocs as $docKey => $docLabel): 
                    $doc = $docsByKey[$docKey] ?? null;
                    $isComplete = !empty($doc);
                    if ($isComplete) $completeDocs++;
                ?>
                <div class="flex items-center justify-between gap-3 p-3 rounded-xl border <?= $isComplete ? 'bg-emerald-50 border-emerald-200' : 'bg-rose-50 border-rose-200' ?>">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg <?= $isComplete ? 'bg-emerald-500' : 'bg-rose-400' ?> flex items-center justify-center text-white shrink-0">
                            <i class="fas <?= $isComplete ? 'fa-check' : 'fa-xmark' ?> text-sm"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-(--text-heading) text-sm"><?= esc($docLabel) ?></p>
                            <?php if ($isComplete && !empty($doc['original_name'])): ?>
                            <p class="text-xs text-(--text-muted)"><?= esc($doc['original_name']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <?php if ($isComplete): ?>
                        <a href="<?= base_url('admin/seleksi-administrasi/doc/' . $doc['id']) ?>" 
                           class="w-8 h-8 flex items-center justify-center rounded-lg bg-emerald-100 text-emerald-600 hover:bg-emerald-500 hover:text-white transition-all"
                           title="Download">
                            <i class="fas fa-download text-xs"></i>
                        </a>
                        <?php else: ?>
                        <span class="text-xs text-rose-500 font-semibold">Belum diunggah</span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Progress -->
            <div class="mt-6 pt-6 border-t border-slate-100">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-semibold text-(--text-heading)">Kelengkapan Dokumen</span>
                    <span class="text-sm font-bold <?= $completeDocs >= 5 ? 'text-emerald-600' : 'text-rose-500' ?>"><?= $completeDocs ?>/5</span>
                </div>
                <div class="h-3 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full <?= $completeDocs >= 5 ? 'bg-emerald-500' : 'bg-yellow-500' ?> transition-all" style="width: <?= ($completeDocs / 5) * 100 ?>%"></div>
                </div>
                <?php if ($completeDocs < 5): ?>
                <p class="text-xs text-rose-500 mt-2">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    Dokumen belum lengkap. Harap minta mahasiswa melengkapi dokumen sebelum validasi.
                </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ================================================================
         5. VALIDATION FORM
    ================================================================= -->
    <?php if (in_array($proposal['status'], ['submitted', 'revision'])): ?>
    <div class="card-premium overflow-hidden animate-stagger delay-400 border-l-4 border-l-sky-500">
        <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-clipboard-check text-sky-500 mr-2"></i>
                Form Validasi
            </h3>
            <p class="text-[11px] text-(--text-muted) mt-0.5">Tentukan status proposal ini</p>
        </div>

        <form action="<?= base_url('admin/seleksi-administrasi/' . $proposal['id'] . '/validasi') ?>" method="post">
            <?= csrf_field() ?>
            <div class="p-5 sm:p-7 space-y-5">
                <!-- Status Options -->
                <div>
                    <label class="form-label">Status Validasi <span class="required">*</span></label>
                    <div class="grid sm:grid-cols-3 gap-3 mt-2">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="status" value="approved" class="peer sr-only" required>
                            <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:border-emerald-300">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center peer-checked:bg-emerald-500 peer-checked:text-white">
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
                                    <div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center peer-checked:bg-orange-500 peer-checked:text-white">
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
                                    <div class="w-10 h-10 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center peer-checked:bg-rose-500 peer-checked:text-white">
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

                <!-- Catatan -->
                <div>
                    <label class="form-label">Catatan untuk Mahasiswa</label>
                    <textarea name="catatan" rows="3" class="form-textarea" placeholder="Berikan catatan atau feedback untuk mahasiswa..."><?= esc($proposal['catatan'] ?? '') ?></textarea>
                    <p class="text-xs text-(--text-muted) mt-1">Catatan ini akan dilihat oleh mahasiswa.</p>
                </div>

                <!-- Submit -->
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="<?= base_url('admin/seleksi-administrasi') ?>" class="btn-outline">
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
    <div class="card-premium p-5 sm:p-7 bg-emerald-50 border border-emerald-200 animate-stagger delay-400">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center text-white">
                <i class="fas fa-circle-check text-xl"></i>
            </div>
            <div>
                <h4 class="font-display font-bold text-emerald-700">Proposal Disetujui</h4>
                <p class="text-sm text-emerald-600">Proposal ini telah lolos seleksi administrasi dan dapat melanjutkan ke tahap berikutnya.</p>
            </div>
        </div>
    </div>
    <?php elseif ($proposal['status'] === 'rejected'): ?>
    <div class="card-premium p-5 sm:p-7 bg-rose-50 border border-rose-200 animate-stagger delay-400">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-rose-500 flex items-center justify-center text-white">
                    <i class="fas fa-circle-xmark text-xl"></i>
                </div>
                <div>
                    <h4 class="font-display font-bold text-rose-700">Proposal Ditolak</h4>
                    <p class="text-sm text-rose-600">Proposal ini tidak memenuhi syarat seleksi administrasi.</p>
                </div>
            </div>
            <a href="<?= base_url('admin/seleksi-administrasi/' . $proposal['id'] . '/hapus') ?>" 
               class="btn-outline border-rose-300 text-rose-600 hover:bg-rose-500 hover:text-white"
               onclick="return confirm('Yakin ingin menghapus proposal ini secara permanen?')">
                <i class="fas fa-trash mr-2"></i>Hapus Proposal
            </a>
        </div>
    </div>
    <?php endif; ?>

    <?php endif; ?>

</div><!-- /page wrapper -->

<!-- ================================================================
     BIODATA MODAL
================================================================= -->
<div id="biodataModal" class="fixed inset-0 z-50 hidden" aria-modal="true" role="dialog">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeBiodataModal()"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <!-- Modal Header -->
                <div id="modal-header" class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-display font-bold text-white">Detail Biodata</h3>
                        <button type="button" onclick="closeBiodataModal()" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-5">
                    <!-- Avatar & Name -->
                    <div class="text-center mb-5">
                        <div id="modal-avatar" class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-white font-display font-bold text-xl mb-3">
                            --
                        </div>
                        <h4 id="modal-nama" class="font-display font-bold text-lg text-slate-800">--</h4>
                        <span id="modal-role-badge" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border mt-2">
                            --
                        </span>
                    </div>

                    <!-- Biodata Grid -->
                    <div id="modal-content" class="space-y-3">
                        <!-- Dynamic content -->
                    </div>
                </div>

                <!-- Modal Footer -->
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

    // Set colors based on type
    let bgColor, borderColor, textColor, roleLabel;
    if (type === 'mahasiswa') {
        bgColor = 'bg-teal-500';
        borderColor = 'border-teal-200';
        textColor = 'text-teal-600';
        roleLabel = data.role === 'ketua' ? 'Ketua Tim' : 'Anggota';
    } else {
        bgColor = 'bg-violet-500';
        borderColor = 'border-violet-200';
        textColor = 'text-violet-600';
        roleLabel = 'Dosen Pendamping';
    }

    // Set header color
    header.className = `${bgColor} px-6 py-4`;

    // Set avatar
    const initials = (data.nama || '??').substring(0, 2).toUpperCase();
    avatar.textContent = initials;
    avatar.className = `w-16 h-16 mx-auto rounded-2xl ${bgColor} flex items-center justify-center text-white font-display font-bold text-xl mb-3`;

    // Set name and badge
    nama.textContent = data.nama || '-';
    roleBadge.textContent = roleLabel;
    roleBadge.className = `inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border ${bgColor.replace('bg-', 'bg-50 text-').replace('bg-', 'border-')}`;

    // Build content
    let html = '';

    if (type === 'mahasiswa') {
        const fields = [
            { icon: 'fa-id-card', label: 'NIM', value: data.nim },
            { icon: 'fa-building', label: 'Jurusan', value: data.jurusan },
            { icon: 'fa-graduation-cap', label: 'Prodi', value: data.prodi },
            { icon: 'fa-calendar-alt', label: 'Semester', value: data.semester },
            { icon: 'fa-phone', label: 'No. HP', value: data.phone },
            { icon: 'fa-envelope', label: 'Email', value: data.email },
        ];
        fields.forEach(f => {
            if (f.value) {
                html += `
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50">
                    <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm">
                        <i class="fas ${f.icon}"></i>
                    </div>
                    <div>
                        <p class="text-[11px] text-slate-400 font-semibold uppercase">${f.label}</p>
                        <p class="text-sm text-slate-700">${f.value}</p>
                    </div>
                </div>`;
            }
        });
    } else {
        const fields = [
            { icon: 'fa-id-card', label: 'NIP', value: data.nip },
            { icon: 'fa-building', label: 'Jurusan', value: data.jurusan },
            { icon: 'fa-graduation-cap', label: 'Prodi', value: data.prodi },
            { icon: 'fa-phone', label: 'No. HP', value: data.phone },
        ];
        fields.forEach(f => {
            if (f.value) {
                html += `
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50">
                    <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm">
                        <i class="fas ${f.icon}"></i>
                    </div>
                    <div>
                        <p class="text-[11px] text-slate-400 font-semibold uppercase">${f.label}</p>
                        <p class="text-sm text-slate-700">${f.value}</p>
                    </div>
                </div>`;
            }
        });
    }

    content.innerHTML = html || '<p class="text-center text-slate-400 py-4">Tidak ada data biodata</p>';

    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeBiodataModal() {
    const modal = document.getElementById('biodataModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

// Close on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeBiodataModal();
    }
});
</script>

<?= $this->endSection() ?>
