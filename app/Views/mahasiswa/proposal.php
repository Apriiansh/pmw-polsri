<?= $this->extend('layouts/main') ?>

<?php helper('pmw'); ?>
<?php $prodiList = getProdiList(); ?>

<?= $this->section('content') ?>
<div class="space-y-8 animate-stagger" x-data="proposalForm()">
    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Page Heading -->
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <div>
                <h2 class="section-title">Proposal <span class="text-gradient">(Bussiness Plan & Business Model Canvas)</span></h2>
                <p class="section-subtitle">Pembuatan Proposal Bisnis dan Pemilihan Dosen Pendamping</p>
            </div>
        </div>

        <?php
        $pitchingApproved    = ($proposal['pitching_admin_status'] ?? '') === 'approved';
        $isEligible          = $proposal && $pitchingApproved;
        $proposalDosenStatus = $proposal['proposal_dosen_status'] ?? null;
        $proposalSubmitted   = !empty($proposal['proposal_submitted_at']);
        // Tampil gate dosen jika sudah submit tapi dosen belum approve
        $waitingDosen = $proposalSubmitted && $proposalDosenStatus !== 'approved';
        // isLocked: form read-only jika sudah submit, approved, rejected, atau menunggu dosen
        $status = $proposal['status'] ?? 'new';
        $isLocked = in_array($status, ['submitted', 'approved', 'rejected']) || $waitingDosen;
        ?>
        <?php if (!$isEligible): ?>
        <div class="card-premium p-12 text-center animate-stagger">
            <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-file-pen text-3xl text-slate-300"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800">Tahap Belum Tersedia</h3>
            <p class="text-slate-500 max-w-md mx-auto mt-2">
                Anda harus menyelesaikan <strong>Tahap 1 (Administrasi & Desk Evaluation)</strong> dan mendapatkan persetujuan Admin/UPAPKK terlebih dahulu.
            </p>
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a href="<?= base_url('mahasiswa/pitching-desk') ?>" class="btn-primary">
                    Ke Pitching Desk <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="<?= base_url('dashboard') ?>" class="btn-outline">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
        <?php else: ?>
        <!-- ─── STICKY ACTION BAR ────────────────────────────────────────── -->
        <div class="sticky top-4 z-40 bg-white/90 backdrop-blur-md shadow-lg border border-sky-100 rounded-2xl p-4 mb-6 flex items-center justify-between gap-4 flex-wrap animate-in fade-in slide-in-from-top-4 duration-500">
            
            <!-- Left: Status Info -->
            <div class="flex items-center gap-3 min-w-0">
                <?php
                $statusMap = [
                    'new'       => ['icon' => 'fa-file-circle-plus', 'color' => 'slate',   'label' => 'Baru (Draft)'],
                    'draft'     => ['icon' => 'fa-file-pen',          'color' => 'amber',   'label' => 'Draft Tersimpan'],
                    'submitted' => ['icon' => 'fa-paper-plane',      'color' => 'emerald', 'label' => 'Proposal Terkirim'],
                    'revision'  => ['icon' => 'fa-file-circle-exclamation', 'color' => 'orange', 'label' => 'Perlu Revisi'],
                    'approved'  => ['icon' => 'fa-circle-check',     'color' => 'sky',     'label' => 'Proposal Disetujui'],
                    'rejected'  => ['icon' => 'fa-circle-xmark',     'color' => 'rose',    'label' => 'Proposal Ditolak'],
                ];
                $st = $statusMap[$status] ?? $statusMap['new'];
                ?>
                <div class="w-9 h-9 rounded-xl bg-<?= $st['color'] ?>-100 flex items-center justify-center shrink-0">
                    <i class="fas <?= $st['icon'] ?> text-<?= $st['color'] ?>-500 text-base"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Proposal</p>
                    <p class="text-sm font-black text-<?= $st['color'] ?>-700"><?= $st['label'] ?></p>
                    <?php if ($status !== 'draft' && $status !== 'new' && !empty($proposal['submitted_at'])): ?>
                        <p class="text-[10px] text-<?= $st['color'] ?>-500 font-mono">
                            Dikirim: <?= date('d M Y H:i', strtotime($proposal['submitted_at'])) ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Action Buttons -->
            <div class="flex items-center gap-3 shrink-0">
                <?php if (!$isLocked): ?>
                    <button type="submit" form="mainProposalForm" formnovalidate class="btn-primary h-10 px-6 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold rounded-xl shadow-sm transition-all flex items-center gap-2">
                        <i class="fas fa-save text-amber-500"></i>
                        <span>Simpan Draft</span>
                    </button>
                    <!-- Submit button is usually at the bottom of proposal, but we keep the draft button here -->
                <?php else: ?>
                    <div class="h-10 px-4 bg-slate-100 border border-slate-200 rounded-xl text-slate-500 text-xs font-bold flex items-center gap-2">
                        <i class="fas fa-lock"></i>
                        Data Terkunci
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Period Info Card -->
        <div class="card-premium p-5 sm:p-7" @mousemove="handleMouseMove">
            <div class="flex items-start justify-between gap-4 flex-wrap">
                <div>
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400">Periode Aktif</p>
                    <p class="text-lg font-bold text-slate-800 mt-1">
                        <?= $activePeriod ? esc($activePeriod['name']) . ' ' . esc($activePeriod['year']) : '-' ?>
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400">Jadwal Tahap 1 (Pengajuan Proposal)</p>
                    <p class="text-sm font-bold text-slate-700 mt-1">
                        <?= $phase1 ? (formatIndonesianDate($phase1['start_date']) . ' s/d ' . formatIndonesianDate($phase1['end_date'])) : '-' ?>
                    </p>
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold mt-2 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700 border border-emerald-100" : "bg-rose-50 text-rose-700 border border-rose-100" ?>">
                        <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                        <?= $isPhaseOpen ? 'Dibuka' : 'Ditutup' ?>
                    </span>
                </div>
            </div>
        </div>

        <?php
        $currentStatus = $proposal['status'] ?? 'draft';
        ?>

        <?php if ($currentStatus === 'approved'): ?>
            <!-- ================================================================
                 Success Banner (Transition to Stage 2)
            ================================================================= -->
            <div class="card-premium bg-linear-to-br from-emerald-600 to-teal-600 animate-stagger delay-200 overflow-hidden" @mousemove="handleMouseMove">
                <div class="bg-white/10 backdrop-blur-md p-8 sm:p-10 rounded-[1.4rem] text-white flex flex-col items-center text-center gap-5 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-teal-400/20 rounded-full blur-3xl"></div>

                    <div class="max-w-2xl relative z-10">
                        <h3 class="font-display text-2xl sm:text-3xl font-black mb-3 tracking-tight">Selamat <?= esc($proposal['ketua_nama'] ?? 'Tim Anda') ?>, Proposal Anda Lolos!</h3>
                        <p class="text-sm sm:text-base text-slate-500 font-medium leading-relaxed">
                            Proposal Anda telah <span class="font-black underline underline-offset-4 decoration-emerald-200 uppercase">Disetujui</span> oleh UPAPPK.
                            Tim Anda sekarang dapat melanjutkan ke tahap Pitching Desk untuk mengunggah materi presentasi.
                        </p>

                        <div class="mt-8 flex justify-center gap-4">
                            <a href="<?= base_url('mahasiswa/pitching-desk') ?>" class="inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-white text-emerald-700 font-black text-sm shadow-2xl shadow-emerald-900/20 hover:scale-105 hover:bg-emerald-50 transition-all group">
                                <i class="fas fa-rocket text-lg text-teal-500 group-hover:rotate-12 transition-transform"></i>
                                PITCHING DESK
                                <i class="fas fa-arrow-right text-[10px] ml-1 opacity-50"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($currentStatus === 'rejected'): ?>
            <!-- ================================================================
                 Rejected Banner (Option to Restart)
            ================================================================= -->
            <div class="card-premium bg-linear-to-br from-rose-600 to-orange-600 animate-stagger delay-200 overflow-hidden" @mousemove="handleMouseMove">
                <div class="bg-white/10 backdrop-blur-md p-8 sm:p-10 rounded-[1.4rem] text-white flex flex-col items-center text-center gap-5 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-orange-400/20 rounded-full blur-3xl"></div>

                    <div class="max-w-2xl relative z-10">
                        <h3 class="font-display text-2xl sm:text-3xl font-black mb-3 tracking-tight">Mohon Maaf, Proposal Belum Lolos</h3>
                        <p class="text-sm sm:text-base text-white/90 font-medium leading-relaxed">
                            Setelah melalui proses review, proposal Anda dinyatakan <span class="font-black underline underline-offset-4 decoration-rose-200 uppercase">Ditolak</span>.
                        </p>

                        <?php if (!empty($proposal['catatan'])): ?>
                            <div class="mt-6 p-5 rounded-2xl bg-black/20 backdrop-blur-sm border border-white/20 text-left">
                                <p class="text-[10px] font-black uppercase tracking-widest text-white/60 mb-2">Catatan Admin:</p>
                                <p class="text-sm italic leading-relaxed">"<?= esc($proposal['catatan']) ?>"</p>
                            </div>
                        <?php endif; ?>

                        <div class="mt-8 flex justify-center gap-4">
                            <button @click="confirmReset(<?= $proposal['id'] ?>)" class="inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-white text-rose-700 font-black text-sm shadow-2xl shadow-rose-900/20 hover:scale-105 hover:bg-rose-50 transition-all group">
                                <i class="fas fa-rotate-left text-lg text-orange-500 group-hover:-rotate-45 transition-transform"></i>
                                BUAT ULANG PROPOSAL
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- ================================================================
                 Validation Progress Tracker
            ================================================================= -->
            <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
                <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-base font-bold text-slate-800">
                        <i class="fas fa-tasks text-teal-500 mr-2"></i>
                        Progres Validasi Proposal
                    </h3>
                </div>
                <div class="p-5 sm:p-7">
                    <div class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0">
                        <!-- Connector Line -->
                        <div class="hidden md:block absolute top-6 left-0 w-full h-0.5 bg-slate-100 z-0"></div>

                        <?php
                        $statusMeta = [
                            'draft'     => ['label' => 'Sedang Disusun', 'status' => 'pending'],
                            'submitted' => ['label' => 'Dalam Antrean', 'status' => 'submitted'],
                            'revision' => ['label' => 'Perlu Revisi', 'status' => 'revision'],
                            'approved'  => ['label' => 'Disetujui', 'status' => 'approved'],
                            'rejected'  => ['label' => 'Ditolak', 'status' => 'rejected'],
                        ];

                        $meta = $statusMeta[$currentStatus] ?? $statusMeta['draft'];

                        $steps = [];

                        $proposalDosenSt  = $proposal['proposal_dosen_status'] ?? null;
                        $proposalAdminSt  = $proposal['proposal_admin_status'] ?? null;
                        $isProposalSub    = !empty($proposal['proposal_submitted_at']);

                        // Step 1: Pengajuan
                        $steps[] = [
                            'label'         => 'Pengajuan',
                            'display_label' => (!$isProposalSub) ? 'Sedang Disusun' : 'Proposal Terkirim',
                            'status'        => (!$isProposalSub) ? 'pending' : 'approved',
                            'icon'          => 'fa-file-signature',
                            'note'          => null,
                            'note_label'    => null,
                        ];

                        // Step 2: Validasi Dosen
                        $dosenStepStatus = 'pending';
                        $dosenStepLabel  = 'Menunggu Review';
                        if ($proposalDosenSt === 'approved') {
                            $dosenStepStatus = 'approved';
                            $dosenStepLabel  = 'Disetujui Dosen';
                        } elseif ($proposalDosenSt === 'revision') {
                            $dosenStepStatus = 'revision';
                            $dosenStepLabel  = 'Perlu Revisi';
                        } elseif ($proposalDosenSt === 'rejected') {
                            $dosenStepStatus = 'rejected';
                            $dosenStepLabel  = 'Ditolak Dosen';
                        } elseif (!$isProposalSub) {
                            $dosenStepStatus = 'pending';
                            $dosenStepLabel  = 'Belum Dikirim';
                        }

                        $steps[] = [
                            'label'         => 'Validasi Dosen',
                            'display_label' => $dosenStepLabel,
                            'status'        => $dosenStepStatus,
                            'icon'          => 'fa-chalkboard-user',
                            'note'          => ($proposalDosenSt === 'revision') ? ($proposal['proposal_dosen_catatan'] ?? null) : null,
                            'note_label'    => 'Catatan Dosen:',
                        ];

                        // Step 3: Validasi UPAPKK
                        $adminStepStatus = 'pending';
                        $adminStepLabel  = 'Menunggu Validasi';
                        if ($proposalAdminSt === 'approved' || $currentStatus === 'approved') {
                            $adminStepStatus = 'approved';
                            $adminStepLabel  = 'Disetujui';
                        } elseif ($currentStatus === 'revision') {
                            $adminStepStatus = 'revision';
                            $adminStepLabel  = 'Perlu Revisi';
                        } elseif ($currentStatus === 'rejected') {
                            $adminStepStatus = 'rejected';
                            $adminStepLabel  = 'Ditolak';
                        } elseif ($proposalDosenSt !== 'approved') {
                            $adminStepStatus = 'pending';
                            $adminStepLabel  = 'Menunggu Dosen';
                        }

                        $steps[] = [
                            'label'         => 'Validasi UPAPKK',
                            'display_label' => $adminStepLabel,
                            'status'        => $adminStepStatus,
                            'icon'          => 'fa-award',
                            'note'          => ($currentStatus === 'revision') ? ($proposal['catatan'] ?? null) : null,
                            'note_label'    => 'Catatan Admin:',
                        ];

                        $stepColors = [
                            'pending'   => ['bg' => 'bg-amber-500', 'text' => 'text-amber-500', 'light' => 'bg-amber-50', 'icon' => 'fa-clock'],
                            'submitted' => ['bg' => 'bg-sky-500', 'text' => 'text-sky-500', 'light' => 'bg-sky-50', 'icon' => 'fa-paper-plane'],
                            'approved'  => ['bg' => 'bg-emerald-500', 'text' => 'text-emerald-500', 'light' => 'bg-emerald-50', 'icon' => 'fa-check'],
                            'revision'  => ['bg' => 'bg-orange-500', 'text' => 'text-orange-500', 'light' => 'bg-orange-50', 'icon' => 'fa-rotate'],
                            'rejected'  => ['bg' => 'bg-rose-500', 'text' => 'text-rose-500', 'light' => 'bg-rose-50', 'icon' => 'fa-xmark']
                        ];
                        ?>

                        <?php foreach ($steps as $index => $step):
                            $color = $stepColors[$step['status']] ?? $stepColors['pending'];
                        ?>
                            <div class="relative z-10 flex flex-row md:flex-col items-center gap-4 md:gap-2 flex-1 w-full md:w-auto">
                                <div class="w-12 h-12 rounded-2xl <?= $color['bg'] ?> text-white flex items-center justify-center shadow-lg shadow-<?= explode('-', $color['bg'])[1] ?>-100">
                                    <i class="fas <?= $step['icon'] ?> text-lg"></i>
                                </div>
                                <div class="text-left md:text-center mt-1">
                                    <p class="text-xs font-black uppercase tracking-tighter text-slate-400"><?= $step['label'] ?></p>
                                    <div class="flex items-center gap-1.5 md:justify-center mt-1">
                                        <span class="text-[10px] font-black <?= $color['text'] ?> uppercase italic"><?= $step['display_label'] ?></span>
                                        <i class="fas <?= ($color['icon'] ?? 'fa-circle') ?> text-[10px] <?= $color['text'] ?>"></i>
                                    </div>
                                </div>

                                <?php if ($step['note']): ?>
                                    <div class="md:absolute md:top-24 md:left-1/2 md:-translate-x-1/2 w-full md:w-64 p-3 rounded-xl <?= $color['light'] ?> border border-<?= explode('-', $color['text'])[1] ?>-100 text-[10px] text-slate-600 italic shadow-sm">
                                        <p class="font-bold not-italic mb-1 text-slate-500 uppercase tracking-widest"><?= $step['note_label'] ?? 'Catatan:' ?></p>
                                        "<?= esc($step['note']) ?>"
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mt-8 md:mt-24 pt-6 border-t border-slate-50 text-[11px] text-slate-400 text-center">
                        <i class="fas fa-info-circle mr-1"></i>
                        Tim Admin UPAPKK akan memverifikasi berkas dan kelayakan proposal Anda.
                    </div>

                    <?php if ($currentStatus === 'rejected'): ?>
                        <div class="mt-6 flex justify-center">
                            <button type="button" 
                                    @click="confirmReset(<?= $proposal['id'] ?>)"
                                    class="px-6 py-2.5 bg-rose-50 border border-rose-200 text-rose-600 rounded-xl font-bold text-xs hover:bg-rose-100 transition-all flex items-center gap-2 shadow-sm shadow-rose-50">
                                <i class="fas fa-undo-alt"></i>
                                Buat Ulang Proposal (Hapus Semua Data Terkait)
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Proposal Form -->
        <form id="mainProposalForm" action="<?= base_url('mahasiswa/proposal/save') ?>" method="post" enctype="multipart/form-data" class="space-y-8">
            <?= csrf_field() ?>
            <input type="hidden" name="is_final_submit" value="0">

            <!-- Section 0: Info dari Pitching Desk (read-only) -->
            <div class="card-premium p-5 sm:p-7 space-y-4" @mousemove="handleMouseMove">
                <div class="flex items-center gap-3 pb-3 border-b border-slate-50">
                    <div class="w-9 h-9 rounded-xl bg-sky-100 flex items-center justify-center text-sky-500 shrink-0">
                        <i class="fas fa-circle-info"></i>
                    </div>
                    <div>
                        <h3 class="font-display text-base font-bold text-slate-800">Info dari Tahap 1 (Administrasi & Desk Eval)</h3>
                        <p class="text-xs text-slate-500">Data identitas usaha & tim sudah diisi di tahap sebelumnya.</p>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Nama Usaha</p>
                        <p class="text-sm font-bold text-slate-800"><?= esc($proposal['nama_usaha'] ?? '-') ?></p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Kategori Usaha</p>
                        <p class="text-sm font-bold text-slate-800"><?= esc($proposal['kategori_usaha'] ?? '-') ?></p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Status Wirausaha</p>
                        <p class="text-sm font-bold text-slate-800 capitalize"><?= esc($proposal['kategori_wirausaha'] ?? '-') ?></p>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Ketua Tim</p>
                        <p class="text-sm font-bold text-slate-800"><?= esc($profile['nama'] ?? '-') ?></p>
                        <p class="text-xs text-slate-500">NIM: <?= esc($profile['nim'] ?? '-') ?></p>
                    </div>
                    <?php
                    $anggotaOnly = array_values(array_filter($members ?? [], fn($m) => ($m['role'] ?? '') === 'anggota'));
                    ?>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 sm:col-span-1 md:col-span-2">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Anggota Tim (<?= count($anggotaOnly) ?> orang)</p>
                        <?php if (empty($anggotaOnly)): ?>
                            <p class="text-xs text-rose-500 font-bold italic"><i class="fas fa-exclamation-triangle mr-1"></i>Belum ada anggota — isi di Tahap 1</p>
                        <?php else: ?>
                            <div class="flex flex-wrap gap-1.5 mt-1">
                                <?php foreach ($anggotaOnly as $m): ?>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-white border border-slate-200 text-[10px] font-bold text-slate-700">
                                        <i class="fas fa-user text-[8px] text-slate-400"></i>
                                        <?= esc($m['nama']) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 sm:col-span-2 md:col-span-3">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Deskripsi Singkat Usaha / Ide Bisnis</p>
                        <p class="text-sm text-slate-700 leading-relaxed"><?= esc($proposal['detail_keterangan'] ?? '-') ?></p>
                    </div>
                </div>
            </div>

            <!-- Section 1: Dosen Pendamping -->
            <div class="card-premium p-5 sm:p-7 space-y-6" @mousemove="handleMouseMove">
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <div>
                        <h3 class="font-display text-base font-bold text-slate-800">1) Dosen Pendamping</h3>
                        <p class="text-xs text-slate-500 mt-1">Pilih dosen yang akan membimbing tim Anda selama pelaksanaan program.</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Dosen Pendamping -->
                    <div class="form-field">
                        <label class="form-label">
                            Dosen Pendamping <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-chalkboard-user"></i>
                            </span>
                            <select name="lecturer_id"
                                class="w-full py-2.5 pr-4 outline-none bg-transparent text-sm text-slate-700"
                                <?= $isLocked ? 'disabled' : '' ?>
                                required>
                                <option value="">-- Pilih Dosen Pendamping --</option>
                                <?php foreach ($lecturers as $lec): ?>
                                <option value="<?= esc($lec['id']) ?>"
                                    <?= (string)($proposal['lecturer_id'] ?? '') === (string)$lec['id'] ? 'selected' : '' ?>>
                                    <?= esc($lec['nama']) ?><?= !empty($lec['nip']) ? ' — ' . esc($lec['nip']) : '' ?><?= !empty($lec['jurusan']) ? ' (' . esc($lec['jurusan']) . ')' : '' ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Rincian Rencana Anggaran Biaya (RAB) -->
            <div class="card-premium p-6 sm:p-8 space-y-6" @mousemove="handleMouseMove">
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-lg font-bold text-slate-800">Rincian Rencana Anggaran Biaya (RAB)</h3>
                            <p class="text-xs text-slate-500">Tambahkan rincian setiap item biaya program. Total dihitung otomatis.</p>
                        </div>
                    </div>
                    <?php if (!$isLocked): ?>
                    <button type="button" @click="addRabItem()"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 border border-amber-200 text-amber-700 rounded-xl text-xs font-bold hover:bg-amber-100 transition-all shrink-0">
                        <i class="fas fa-plus"></i> Tambah Item
                    </button>
                    <?php endif; ?>
                </div>

                <!-- Tabel RAB -->
                <div class="overflow-x-auto rounded-xl border border-slate-100">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="text-left text-[10px] font-black uppercase tracking-widest text-slate-400 px-4 py-3 w-6">#</th>
                                <th class="text-left text-[10px] font-black uppercase tracking-widest text-slate-400 px-4 py-3">Nama Item</th>
                                <th class="text-left text-[10px] font-black uppercase tracking-widest text-slate-400 px-4 py-3 w-24">Qty</th>
                                <th class="text-left text-[10px] font-black uppercase tracking-widest text-slate-400 px-4 py-3 w-28">Satuan</th>
                                <th class="text-left text-[10px] font-black uppercase tracking-widest text-slate-400 px-4 py-3 w-40">Harga Satuan (Rp)</th>
                                <th class="text-right text-[10px] font-black uppercase tracking-widest text-slate-400 px-4 py-3 w-40">Subtotal (Rp)</th>
                                <?php if (!$isLocked): ?>
                                <th class="px-4 py-3 w-12"></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(item, idx) in rabItems" :key="idx">
                                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                                    <td class="px-4 py-2 text-xs text-slate-400 font-mono" x-text="idx + 1"></td>
                                    <td class="px-4 py-2">
                                        <?php if (!$isLocked): ?>
                                        <input type="text" :name="`rab_items[${idx}][nama_item]`"
                                            x-model="item.nama_item"
                                            placeholder="Nama item..."
                                            class="w-full bg-transparent outline-none text-sm text-slate-700 placeholder-slate-300 border-b border-transparent focus:border-amber-300 transition-colors py-0.5">
                                        <?php else: ?>
                                        <span class="text-sm text-slate-700" x-text="item.nama_item"></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-2">
                                        <?php if (!$isLocked): ?>
                                        <input type="number" :name="`rab_items[${idx}][qty]`"
                                            x-model="item.qty"
                                            @input="item.qty = parseFloat(item.qty) || 0"
                                            min="0" step="0.01"
                                            class="w-full bg-transparent outline-none text-sm text-slate-700 border-b border-transparent focus:border-amber-300 transition-colors py-0.5 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                        <?php else: ?>
                                        <span class="text-sm text-slate-700 block text-right" x-text="item.qty"></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-2">
                                        <?php if (!$isLocked): ?>
                                        <input type="text" :name="`rab_items[${idx}][satuan]`"
                                            x-model="item.satuan"
                                            placeholder="unit"
                                            class="w-full bg-transparent outline-none text-sm text-slate-700 placeholder-slate-300 border-b border-transparent focus:border-amber-300 transition-colors py-0.5">
                                        <?php else: ?>
                                        <span class="text-sm text-slate-700" x-text="item.satuan"></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-2">
                                        <?php if (!$isLocked): ?>
                                        <input type="number" :name="`rab_items[${idx}][harga_satuan]`"
                                            x-model="item.harga_satuan"
                                            @input="item.harga_satuan = parseFloat(item.harga_satuan) || 0"
                                            min="0" step="1"
                                            class="w-full bg-transparent outline-none text-sm text-slate-700 border-b border-transparent focus:border-amber-300 transition-colors py-0.5 text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                        <?php else: ?>
                                        <span class="text-sm text-slate-700 block text-right" x-text="Number(item.harga_satuan).toLocaleString('id-ID')"></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-2 text-right">
                                        <span class="text-sm font-bold text-amber-600"
                                            x-text="'Rp ' + (Number(item.qty) * Number(item.harga_satuan)).toLocaleString('id-ID')"></span>
                                    </td>
                                    <?php if (!$isLocked): ?>
                                    <td class="px-4 py-2 text-center">
                                        <button type="button" @click="removeRabItem(idx)"
                                            class="w-7 h-7 rounded-lg bg-rose-50 text-rose-400 hover:bg-rose-100 hover:text-rose-600 transition-colors flex items-center justify-center">
                                            <i class="fas fa-trash text-[10px]"></i>
                                        </button>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                            </template>
                            <!-- Empty state -->
                            <tr x-show="rabItems.length === 0">
                                <td colspan="<?= $isLocked ? 6 : 7 ?>" class="px-4 py-8 text-center text-slate-400 text-xs italic">
                                    <i class="fas fa-inbox text-2xl block mb-2 opacity-30"></i>
                                    Belum ada item RAB<?= !$isLocked ? ' — klik "Tambah Item" untuk memulai' : '' ?>.
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-amber-50 border-t-2 border-amber-100">
                                <td colspan="5" class="px-4 py-3 text-xs font-black uppercase tracking-widest text-slate-500 text-right">
                                    Total RAB
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <span class="text-base font-black text-amber-700"
                                        x-text="'Rp ' + rabItems.reduce((s,i) => s + Number(i.qty) * Number(i.harga_satuan), 0).toLocaleString('id-ID')"></span>
                                </td>
                                <?php if (!$isLocked): ?>
                                <td></td>
                                <?php endif; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Section 3: Dokumen Proposal -->
            <div class="card-premium p-6 sm:p-8 space-y-8" @mousemove="handleMouseMove">
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-lg font-bold text-slate-800">Unggah Dokumen</h3>
                            <p class="text-xs text-slate-500">Unggah lampiran wajib dalam format PDF (Maks. 5MB).</p>
                        </div>
                    </div>
                </div>

                <?php if (!$proposal): ?>
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col items-center text-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-slate-400 shadow-sm">
                            <i class="fas fa-lock text-lg"></i>
                        </div>
                        <p class="text-xs font-bold text-slate-600">Simpan draft terlebih dahulu untuk mengaktifkan fitur unggah dokumen.</p>
                    </div>
                <?php else: ?>
                    <div class="grid md:grid-cols-2 gap-4">
                        <?php
                        $labels = [
                            'proposal_utama'        => 'Business Plan & BMC (Proposal Utama)',
                            'surat_kesediaan_dosen'  => 'Surat Kesediaan Dosen Pendamping',
                        ];
                        $icons = [
                            'proposal_utama'        => 'fa-file-alt',
                            'surat_kesediaan_dosen'  => 'fa-user-shield',
                        ];
                        ?>
                        <?php foreach ($requiredDocKeys as $key): ?>
                            <?php $doc = $docsByKey[$key] ?? null; ?>
                            <div class="p-4 rounded-xl bg-white border border-slate-100 transition-all hover:border-sky-100 hover:shadow-sm group relative overflow-hidden">
                                <div class="absolute top-0 right-0 p-3">
                                    <template x-if="docStatus['<?= $key ?>'] === 'uploaded'">
                                        <i class="fas fa-check-circle text-emerald-500 text-sm"></i>
                                    </template>
                                </div>
                                
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-sky-50 group-hover:text-sky-500 transition-colors shrink-0">
                                        <i class="fas <?= $icons[$key] ?? 'fa-file' ?>"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"><?= esc($labels[$key] ?? $key) ?></p>
                                        
                                        <div class="mt-1">
                                            <template x-if="docStatus['<?= $key ?>'] === 'uploaded'">
                                                <div class="flex flex-col gap-1">
                                                    <span class="text-xs font-bold text-slate-700 truncate" x-text="docFilename['<?= $key ?>']"></span>
                                                    <?php if ($doc): ?>
                                                        <a href="<?= base_url('mahasiswa/proposal/doc/' . $doc['id']) ?>" 
                                                           class="text-[10px] font-bold text-sky-600 hover:underline flex items-center gap-1">
                                                           <i class="fas fa-download"></i> Download File
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </template>
                                            <template x-if="docStatus['<?= $key ?>'] === 'selected'">
                                                <div class="flex flex-col gap-1 animate-pulse">
                                                    <span class="text-xs font-bold text-amber-600 truncate" x-text="docFilename['<?= $key ?>']"></span>
                                                    <span class="text-[10px] font-bold text-amber-500 uppercase tracking-tighter">Siap Diunggah...</span>
                                                </div>
                                            </template>
                                            <template x-if="docStatus['<?= $key ?>'] === 'missing'">
                                                <span class="text-xs font-semibold text-rose-400 italic">Belum ada file</span>
                                            </template>
                                        </div>

                                        <?php if (!$isLocked): ?>
                                            <div class="mt-4 flex items-center gap-2">
                                                <label class="cursor-pointer">
                                                    <span class="px-3 py-1.5 rounded-lg bg-sky-50 text-sky-600 text-[10px] font-bold hover:bg-sky-100 transition-colors inline-flex items-center gap-1.5">
                                                        <i class="fas fa-upload"></i>
                                                        Pilih PDF
                                                    </span>
                                                    <input type="file" name="<?= esc($key) ?>"
                                                        accept="application/pdf"
                                                        class="hidden"
                                                        @change="handleFileChange($event, '<?= $key ?>')">
                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="pt-8 border-t border-slate-50">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6 p-6 rounded-3xl bg-linear-to-br from-slate-50 to-white border border-slate-100">
                            <div class="space-y-1.5 max-w-2xl text-center md:text-left">
                                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Kirim Proposal Final</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">Pastikan semua data dan lampiran sudah sesuai. Anda tidak dapat melakukan perubahan setelah proposal dikirim.</p>

                                <div class="flex items-center justify-center md:justify-start gap-4 mt-4">
                                    <div class="flex items-center gap-2 text-[10px] font-bold py-1 px-3 rounded-full border transition-all" 
                                         :class="isFormComplete ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-slate-50 text-slate-400 border-slate-100'">
                                        <i class="fas" :class="isFormComplete ? 'fa-check-circle' : 'fa-circle-notch fa-spin'"></i>
                                        Data Utama
                                    </div>
                                    <div class="flex items-center gap-2 text-[10px] font-bold py-1 px-3 rounded-full border transition-all" 
                                         :class="docStatus['proposal_utama'] === 'uploaded' || docStatus['proposal_utama'] === 'selected' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-slate-50 text-slate-400 border-slate-100'">
                                        <i class="fas" :class="docStatus['proposal_utama'] === 'uploaded' || docStatus['proposal_utama'] === 'selected' ? 'fa-check-circle' : 'fa-circle-notch fa-spin'"></i>
                                        Proposal Utama
                                    </div>
                                    <div class="flex items-center gap-2 text-[10px] font-bold py-1 px-3 rounded-full border transition-all" 
                                         :class="docStatus['surat_kesediaan_dosen'] === 'uploaded' || docStatus['surat_kesediaan_dosen'] === 'selected' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-slate-50 text-slate-400 border-slate-100'">
                                        <i class="fas" :class="docStatus['surat_kesediaan_dosen'] === 'uploaded' || docStatus['surat_kesediaan_dosen'] === 'selected' ? 'fa-check-circle' : 'fa-circle-notch fa-spin'"></i>
                                        Surat Kesediaan Dosen
                                    </div>
                                </div>
                            </div>
                            
                            <div class="shrink-0 flex items-center gap-3">
                                <?php if ($proposal['status'] === 'rejected'): ?>
                                    <button type="button" 
                                        class="px-6 py-3 bg-white border-2 border-rose-500 text-rose-500 hover:bg-rose-50 rounded-2xl font-bold text-sm transition-all flex items-center gap-2 group"
                                        @click="confirmReset(<?= $proposal['id'] ?>)">
                                        <i class="fas fa-trash-alt group-hover:shake"></i>
                                        Buat Ulang Proposal
                                    </button>
                                <?php endif; ?>

                                <?php if ($isLocked && $proposal['status'] !== 'rejected'): ?>
                                    <div class="px-8 py-3.5 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-600 font-bold text-sm flex items-center gap-2 shadow-sm">
                                        <i class="fas fa-check-circle"></i>
                                        Sudah dikirim
                                    </div>
                                <?php elseif ($isPhaseOpen && $proposal['status'] !== 'rejected'): ?>
                                    <button type="button"
                                        class="btn-primary py-4 px-10 shadow-xl shadow-sky-200/50 disabled:opacity-50 disabled:grayscale disabled:cursor-not-allowed group relative overflow-hidden"
                                        :disabled="!isFormComplete || !allDocsReady"
                                        @click="confirmSubmit()">
                                        <span class="flex items-center gap-3 relative z-10 font-bold">
                                            <i class="fas fa-paper-plane group-hover:rotate-12 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                                            Kirim Proposal Final
                                        </span>
                                    </button>
                                <?php elseif (!$isPhaseOpen): ?>
                                    <div class="px-6 py-3 bg-rose-50 border border-rose-100 text-rose-600 rounded-2xl font-bold text-sm flex items-center gap-2">
                                        <i class="fas fa-lock"></i>
                                        Pendaftaran Ditutup
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function proposalForm() {

        <?php
        $jsDocStatus = [];
        $jsDocFilename = [];
        foreach ($requiredDocKeys as $key) {
            $jsDocStatus[$key] = isset($docsByKey[$key]) ? 'uploaded' : 'missing';
            $jsDocFilename[$key] = isset($docsByKey[$key]) ? $docsByKey[$key]['original_name'] : '';
        }

        // Prepare existing members for Alpine
        $anggotaData = [];
        $existingAnggota = array_values(array_filter($members ?? [], fn($m) => ($m['role'] ?? '') === 'anggota'));
        foreach ($existingAnggota as $idx => $m) {
            $anggotaData[] = [
                'id'       => $m['id'] ?? null,
                'nama'     => old('members.' . $idx . '.nama', $m['nama'] ?? ''),
                'nim'      => old('members.' . $idx . '.nim', $m['nim'] ?? ''),
                'jurusan'  => old('members.' . $idx . '.jurusan', $m['jurusan'] ?? ''),
                'prodi'    => old('members.' . $idx . '.prodi', $m['prodi'] ?? ''),
                'semester' => old('members.' . $idx . '.semester', $m['semester'] ?? ''),
                'phone'    => old('members.' . $idx . '.phone', $m['phone'] ?? ''),
                'email'    => old('members.' . $idx . '.email', $m['email'] ?? ''),
                'editing'  => false
            ];
        }

        $currentLecName = '';
        $targetId = old('lecturer_id', $proposal['lecturer_id'] ?? '');
        if ($targetId) {
            foreach ($lecturers as $lec) {
                if ((string)$lec['id'] === (string)$targetId) {
                    $currentLecName = $lec['nama'] . (!empty($lec['nip']) ? ' — ' . $lec['nip'] : '');
                    break;
                }
            }
        }

        // Prepare RAB items for Alpine
        $jsRabItems = [];
        foreach ($rabItems ?? [] as $r) {
            $jsRabItems[] = [
                'nama_item'    => $r['nama_item'],
                'qty'          => (float) $r['qty'],
                'satuan'       => $r['satuan'],
                'harga_satuan' => (float) $r['harga_satuan'],
            ];
        }
        ?>
        return {
            members: <?= json_encode($anggotaData) ?>,
            prodiList: <?= json_encode($prodiList) ?>,
            lecturers: <?= json_encode($lecturers) ?>,
            lecturerSearch: <?= json_encode($currentLecName) ?>,
            isOpen: false,

            handleMouseMove(e) {
                const card = e.currentTarget;
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            },

            // Document Tracking
            docStatus: <?= json_encode($jsDocStatus) ?>,
            docFilename: <?= json_encode($jsDocFilename) ?>,

            get filteredLecturers() {
                if (!this.lecturerSearch) return this.lecturers;
                const s = this.lecturerSearch.toLowerCase();
                return this.lecturers.filter(l =>
                    l.nama.toLowerCase().includes(s) ||
                    (l.nip && l.nip.toLowerCase().includes(s))
                );
            },

            // RAB items
            rabItems: <?= json_encode($jsRabItems) ?>,

            addRabItem() {
                this.rabItems.push({ nama_item: '', qty: 1, satuan: 'unit', harga_satuan: 0 });
            },

            removeRabItem(idx) {
                this.rabItems.splice(idx, 1);
            },

            // Form Data for validation
            formData: {
                lecturer_id: '<?= old('lecturer_id', $proposal['lecturer_id'] ?? '') ?>',
                detail_keterangan: <?= json_encode(old('detail_keterangan', $proposal['detail_keterangan'] ?? '')) ?>,
            },

            get isFormComplete() {
                return !!this.formData.lecturer_id;
            },

            get allDocsReady() {
                return Object.values(this.docStatus).every(s => s === 'uploaded' || s === 'selected');
            },

            handleFileChange(e, key) {
                const file = e.target.files[0];
                if (file) {
                    this.docStatus[key] = 'selected';
                    this.docFilename[key] = file.name;

                    this.$dispatch('toast-notify', {
                        message: `File ${file.name} terpilih. Tekan Simpan Draft untuk mengunggah.`,
                        type: 'info'
                    });
                }
            },

            confirmSubmit() {
                Swal.fire({
                    title: 'Kirim Proposal Sekarang?',
                    text: "Proposal masih dapat Anda ubah kembali jika diperlukan selama jadwal pendaftaran belum berakhir. Setelah ini, proposal akan masuk ke tahap penilaian dan akan diinformasikan jika lolos administrasi",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0284c7',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Kirim Sekarang',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('mainProposalForm');
                        form.querySelector('input[name="is_final_submit"]').value = '1';
                        form.submit();
                    }
                });
            },

            confirmReset(id) {
                Swal.fire({
                    title: 'Buat Ulang Proposal?',
                    text: "Seluruh data proposal, anggota, dan dokumen yang sudah diunggah akan dihapus secara permanen. Anda akan memulai pengisian dari awal.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus & Buat Ulang',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `<?= base_url('mahasiswa/proposal/reset') ?>/${id}`;
                    }
                });
            },

            jurusanList() {
                return Object.keys(this.prodiList);
            },

            prodiOptions(jurusan) {
                return this.prodiList[jurusan] || [];
            },

            addMember() {
                if (this.members.length >= 4) {
                    this.$dispatch('toast-notify', {
                        message: 'Jumlah anggota maksimal adalah 4 orang.',
                        type: 'warning'
                    });
                    return;
                }
                this.members.push({
                    id: null,
                    nama: '',
                    nim: '',
                    jurusan: '',
                    prodi: '',
                    semester: '',
                    phone: '',
                    email: '',
                    editing: true
                });
            },

            removeMember(idx) {
                this.members.splice(idx, 1);
            }
        }
    }
</script>
<?= $this->endSection() ?>