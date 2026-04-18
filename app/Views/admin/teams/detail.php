<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6" x-data="{
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- Breadcrumb & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-sm">
            <a href="<?= base_url('admin/teams') ?>" class="text-slate-500 hover:text-sky-600 transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Data TIM
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-700 font-semibold">Detail</span>
        </div>
        <div class="flex gap-2">
            <a href="<?= base_url('admin/administrasi/seleksi/' . $proposal['id']) ?>" class="btn-primary text-sm">
                <i class="fas fa-file-alt mr-2"></i>Lihat Proposal
            </a>
        </div>
    </div>

    <!-- Header Card -->
    <div class="card-premium p-6" @mousemove="handleMouseMove">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Avatar -->
            <div class="shrink-0">
                <div class="w-20 h-20 rounded-2xl bg-linear-to-tr from-sky-500 to-sky-400 flex items-center justify-center text-white font-display font-bold text-3xl">
                    <?= substr(esc($members[0]['nama'] ?? '?'), 0, 1) ?>
                </div>
            </div>

            <!-- Info -->
            <div class="flex-1">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800"><?= esc($proposal['nama_usaha'] ?? 'Tanpa Nama') ?></h2>
                        <p class="text-slate-500 mt-1">
                            <i class="fas fa-user text-sky-400 mr-1"></i>
                            <?= esc($members[0]['nama'] ?? '-') ?>
                            <span class="text-slate-400">(Ketua)</span>
                        </p>
                    </div>
                    <?php
                    $statusConfig = [
                        'draft' => ['bg-slate-100', 'text-slate-600', 'Draft'],
                        'submitted' => ['bg-amber-100', 'text-amber-700', 'Menunggu Validasi'],
                        'revision' => ['bg-orange-100', 'text-orange-700', 'Perlu Revisi'],
                        'approved' => ['bg-emerald-100', 'text-emerald-700', 'Disetujui'],
                        'rejected' => ['bg-rose-100', 'text-rose-700', 'Ditolak'],
                    ];
                    $config = $statusConfig[$proposal['status']] ?? $statusConfig['draft'];
                    ?>
                    <span class="px-3 py-1 rounded-full <?= $config[0] ?> <?= $config[1] ?> text-xs font-black uppercase">
                        <?= $config[2] ?>
                    </span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 pt-4 border-t border-slate-100">
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">NIM Ketua</p>
                        <p class="text-sm font-semibold text-slate-700"><?= esc($members[0]['nim'] ?? '-') ?></p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Program Studi</p>
                        <p class="text-sm font-semibold text-slate-700"><?= esc($members[0]['prodi'] ?? '-') ?></p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Jurusan</p>
                        <p class="text-sm font-semibold text-slate-700"><?= esc($members[0]['jurusan'] ?? '-') ?></p>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Total Anggota</p>
                        <p class="text-sm font-semibold text-slate-700"><?= count($members) ?> orang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Columns -->
    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Left: Team Members -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Anggota TIM -->
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <i class="fas fa-users text-sky-500"></i>
                        Anggota TIM
                    </h3>
                </div>
                <div class="divide-y divide-slate-100">
                    <?php foreach ($members as $index => $member): ?>
                        <div class="p-4 flex items-start gap-4 hover:bg-slate-50 transition-colors">
                            <div class="w-12 h-12 rounded-xl <?= $member['role'] === 'ketua' ? 'bg-sky-100 text-sky-600' : 'bg-slate-100 text-slate-500' ?> flex items-center justify-center shrink-0">
                                <i class="fas <?= $member['role'] === 'ketua' ? 'fa-crown' : 'fa-user' ?> text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <p class="font-bold text-slate-800"><?= esc($member['nama']) ?></p>
                                    <?php if ($member['role'] === 'ketua'): ?>
                                        <span class="px-2 py-0.5 bg-sky-100 text-sky-700 text-[10px] font-black rounded-full">KETUA</span>
                                    <?php else: ?>
                                        <span class="px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] font-bold rounded-full">Anggota</span>
                                    <?php endif; ?>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-2 text-[11px]">
                                    <p class="text-slate-500">
                                        <i class="fas fa-id-card text-slate-300 mr-1"></i>
                                        <?= esc($member['nim'] ?: '-') ?>
                                    </p>
                                    <p class="text-slate-500">
                                        <i class="fas fa-graduation-cap text-slate-300 mr-1"></i>
                                        <?= esc($member['prodi'] ?: '-') ?>
                                    </p>
                                    <p class="text-slate-500">
                                        <i class="fas fa-building text-slate-300 mr-1"></i>
                                        <?= esc($member['jurusan'] ?: '-') ?>
                                    </p>
                                    <p class="text-slate-500">
                                        <i class="fas fa-layer-group text-slate-300 mr-1"></i>
                                        Semester <?= esc($member['semester'] ?: '-') ?>
                                    </p>
                                </div>
                                <?php if ($member['phone'] || $member['email']): ?>
                                    <div class="flex flex-wrap gap-3 mt-2 text-[11px]">
                                        <?php if ($member['phone']): ?>
                                            <a href="tel:<?= $member['phone'] ?>" class="text-sky-600 hover:underline">
                                                <i class="fas fa-phone mr-1"></i><?= esc($member['phone']) ?>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($member['email']): ?>
                                            <a href="mailto:<?= $member['email'] ?>" class="text-sky-600 hover:underline">
                                                <i class="fas fa-envelope mr-1"></i><?= esc($member['email']) ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Dokumen -->
            <?php if (!empty($documents)): ?>
                <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                    <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i class="fas fa-file-pdf text-rose-500"></i>
                            Dokumen Proposal
                        </h3>
                    </div>
                    <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <?php
                        // Mapping user-friendly document names
                        $docNames = [
                            'proposal_utama' => 'Proposal Utama',
                            'biodata' => 'Biodata Anggota',
                            'surat_pernyataan_ketua' => 'Surat Pernyataan Ketua',
                            'surat_kesediaan_dosen' => 'Surat Kesediaan Dosen',
                            'ktm' => 'Kartu Tanda Mahasiswa',
                            'pitching_ppt' => 'Presentasi Pitching',
                            'bukti_perjanjian' => 'Bukti Perjanjian',
                        ];
                        ?>

                        <?php foreach ($documents as $doc): ?>
                            <?php
                            $friendlyName = $docNames[$doc['doc_key']] ?? strtoupper(str_replace('_', ' ', $doc['doc_key']));
                            ?>
                            <a href="<?= base_url('admin/administrasi/seleksi/doc/' . $doc['id']) ?>"
                                class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 hover:bg-sky-50 border border-slate-100 hover:border-sky-200 transition-all group">
                                <div class="w-10 h-10 rounded-lg bg-rose-100 text-rose-500 flex items-center justify-center group-hover:bg-rose-500 group-hover:text-white transition-all">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-slate-700 truncate"><?= esc($friendlyName) ?></p>
                                </div>
                                <i class="fas fa-download text-slate-300 group-hover:text-sky-500"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Progress & Activity Tracking -->
            <div class="space-y-6">
                <!-- Tabs Header -->
                <div class="flex items-center gap-4 mb-2">
                    <h3 class="text-lg font-bold text-slate-800">Tracking Progress</h3>
                    <div class="h-px flex-1 bg-slate-100"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Bimbingan Stat -->
                    <?php $bimbinganCount = count(array_filter($guidanceLogs, fn($l) => $l->type === 'bimbingan' && $l->status === 'approved')); ?>
                    <div class="card-premium p-4 border-l-4 border-l-amber-500" @mousemove="handleMouseMove">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-500 flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <span class="text-xs font-black text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full uppercase">Bimbingan</span>
                        </div>
                        <p class="text-2xl font-black text-slate-800"><?= $bimbinganCount ?> <span class="text-xs font-normal text-slate-400">Log</span></p>
                        <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold tracking-wider">Total Terverifikasi</p>
                    </div>

                    <!-- Mentoring Stat -->
                    <?php $mentoringCount = count(array_filter($guidanceLogs, fn($l) => $l->type === 'mentoring' && $l->status === 'approved')); ?>
                    <div class="card-premium p-4 border-l-4 border-l-emerald-500" @mousemove="handleMouseMove">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-500 flex items-center justify-center">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <span class="text-xs font-black text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full uppercase">Mentoring</span>
                        </div>
                        <p class="text-2xl font-black text-slate-800"><?= $mentoringCount ?> <span class="text-xs font-normal text-slate-400">Log</span></p>
                        <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold tracking-wider">Total Terverifikasi</p>
                    </div>

                    <!-- Kegiatan Wirausaha Stat -->
                    <?php $kegiatanCount = count(array_filter($activityLogs, fn($l) => $l->status === 'approved')); ?>
                    <div class="card-premium p-4 border-l-4 border-l-violet-500" @mousemove="handleMouseMove">
                        <div class="flex items-center justify-between mb-2">
                            <div class="w-10 h-10 rounded-lg bg-violet-50 text-violet-500 flex items-center justify-center">
                                <i class="fas fa-store"></i>
                            </div>
                            <span class="text-xs font-black text-violet-600 bg-violet-50 px-2 py-0.5 rounded-full uppercase">Kegiatan</span>
                        </div>
                        <p class="text-2xl font-black text-slate-800"><?= $kegiatanCount ?> <span class="text-xs font-normal text-slate-400">Log</span></p>
                        <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold tracking-wider">Total Terverifikasi</p>
                    </div>
                </div>

                <!-- Logs List -->
                <div class="card-premium overflow-hidden" @mousemove="handleMouseMove" x-data="{ activeTab: 'bimbingan' }">
                    <?php
                    $badgeClasses = [
                        'draft' => 'bg-slate-100 text-slate-600',
                        'pending' => 'bg-amber-100 text-amber-700',
                        'approved' => 'bg-emerald-100 text-emerald-700',
                        'revision' => 'bg-rose-100 text-rose-700',
                        'approved_by_dosen' => 'bg-purple-100 text-purple-700',
                        'approved_by_mentor' => 'bg-indigo-100 text-indigo-700',
                    ];
                    ?>
                    <div class="flex border-b border-slate-100 bg-slate-50/50">
                        <button @click="activeTab = 'bimbingan'" :class="activeTab === 'bimbingan' ? 'border-amber-500 text-amber-600 bg-white' : 'border-transparent text-slate-500 hover:text-slate-700'" class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-b-2 transition-all">
                            Log Bimbingan
                        </button>
                        <button @click="activeTab = 'mentoring'" :class="activeTab === 'mentoring' ? 'border-emerald-500 text-emerald-600 bg-white' : 'border-transparent text-slate-500 hover:text-slate-700'" class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-b-2 transition-all">
                            Log Mentoring
                        </button>
                        <button @click="activeTab = 'kegiatan'" :class="activeTab === 'kegiatan' ? 'border-violet-500 text-violet-600 bg-white' : 'border-transparent text-slate-500 hover:text-slate-700'" class="px-6 py-3 text-xs font-bold uppercase tracking-wider border-b-2 transition-all">
                            Log Kegiatan
                        </button>
                    </div>

                    <div class="p-0">
                        <!-- Bimbingan Tab -->
                        <div x-show="activeTab === 'bimbingan'" class="divide-y divide-slate-100">
                            <?php $bimbinganLogs = array_filter($guidanceLogs, fn($l) => $l->type === 'bimbingan'); ?>
                            <?php if (empty($bimbinganLogs)): ?>
                                <div class="p-8 text-center text-slate-400">
                                    <i class="fas fa-calendar-times text-3xl mb-2 opacity-20"></i>
                                    <p class="text-sm">Belum ada log bimbingan</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($bimbinganLogs as $log): ?>
                                    <div class="p-4 hover:bg-slate-50/50 transition-colors">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-[11px] font-bold text-slate-500">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                <?= date('d M Y', strtotime($log->schedule_date)) ?>
                                            </span>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase <?= $badgeClasses[$log->status] ?? 'bg-slate-100 text-slate-600' ?>">
                                                <?= $log->status ?> by Dosen
                                            </span>
                                        </div>
                                        <p class="text-sm font-semibold text-slate-700 mb-1"><?= esc($log->topic ?: 'Bimbingan Rutin') ?></p>
                                        <p class="text-[11px] text-slate-500 line-clamp-2"><?= esc($log->material_explanation) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <!-- Mentoring Tab -->
                        <div x-show="activeTab === 'mentoring'" class="divide-y divide-slate-100" style="display: none;">
                            <?php $mentoringLogs = array_filter($guidanceLogs, fn($l) => $l->type === 'mentoring'); ?>
                            <?php if (empty($mentoringLogs)): ?>
                                <div class="p-8 text-center text-slate-400">
                                    <i class="fas fa-calendar-times text-3xl mb-2 opacity-20"></i>
                                    <p class="text-sm">Belum ada log mentoring</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($mentoringLogs as $log): ?>
                                    <div class="p-4 hover:bg-slate-50/50 transition-colors">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-[11px] font-bold text-slate-500">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                <?= date('d M Y', strtotime($log->schedule_date)) ?>
                                            </span>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase <?= $badgeClasses[$log->status] ?? 'bg-slate-100 text-slate-600' ?>">
                                                <?= $log->status ?> by Mentor
                                            </span>
                                        </div>
                                        <p class="text-sm font-semibold text-slate-700 mb-1"><?= esc($log->topic ?: 'Mentoring Rutin') ?></p>
                                        <p class="text-[11px] text-slate-500 line-clamp-2"><?= esc($log->material_explanation) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <!-- Kegiatan Tab -->
                        <div x-show="activeTab === 'kegiatan'" class="divide-y divide-slate-100" style="display: none;">
                            <?php if (empty($activityLogs)): ?>
                                <div class="p-8 text-center text-slate-400">
                                    <i class="fas fa-calendar-times text-3xl mb-2 opacity-20"></i>
                                    <p class="text-sm">Belum ada log kegiatan</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($activityLogs as $log): ?>
                                    <div class="p-4 hover:bg-slate-50/50 transition-colors">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-[11px] font-bold text-slate-500">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                <?= date('d M Y', strtotime($log->activity_date)) ?>
                                            </span>
                                            <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase <?= $badgeClasses[$log->status] ?? 'bg-slate-100 text-slate-600' ?>">
                                                <?= $log->status ?>
                                            </span>
                                        </div>
                                        <p class="text-sm font-semibold text-slate-700 mb-1"><?= esc($log->activity_category) ?></p>
                                        <p class="text-[11px] text-slate-500 line-clamp-2"><?= esc($log->activity_description) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Sidebar Info -->
        <div class="space-y-6">
            <!-- Pembimbing -->
            <div class="card-premium p-5" @mousemove="handleMouseMove">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-chalkboard-user text-violet-500"></i>
                    Pembimbing
                </h3>

                <?php if (!empty($proposal['dosen_nama'])): ?>
                    <div class="flex items-start gap-3 p-3 rounded-xl bg-violet-50 border border-violet-100">
                        <div class="w-10 h-10 rounded-lg bg-violet-100 text-violet-500 flex items-center justify-center shrink-0">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800"><?= esc($proposal['dosen_nama']) ?></p>
                            <p class="text-[11px] text-slate-500">Dosen Pendamping</p>
                            <?php if (!empty($proposal['dosen_nip'])): ?>
                                <p class="text-[10px] text-slate-400 mt-1">NIP: <?= esc($proposal['dosen_nip']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($proposal['mentor_nama'])): ?>
                    <div class="flex items-start gap-3 p-3 rounded-xl bg-emerald-50 border border-emerald-100 mt-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-500 flex items-center justify-center shrink-0">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800"><?= esc($proposal['mentor_nama']) ?></p>
                            <p class="text-[11px] text-slate-500">Mentor</p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (empty($proposal['dosen_nama']) && empty($proposal['mentor_nama'])): ?>
                    <div class="text-center py-4 text-slate-400">
                        <i class="fas fa-user-slash text-2xl mb-2"></i>
                        <p class="text-sm">Belum ada pembimbing</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Rekening Bank -->
            <div class="card-premium p-5" @mousemove="handleMouseMove">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-university text-emerald-500"></i>
                    Rekening Bank
                </h3>

                <?php if ($bankAccount): ?>
                    <div class="space-y-3">
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <p class="text-[10px] text-slate-400 font-bold uppercase">Atas Nama</p>
                            <p class="text-sm font-bold text-slate-800"><?= esc($bankAccount->account_holder_name) ?></p>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <p class="text-[10px] text-slate-400 font-bold uppercase">Bank</p>
                            <p class="text-sm font-bold text-slate-800"><?= esc($bankAccount->bank_name) ?></p>
                        </div>
                        <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-100">
                            <p class="text-[10px] text-emerald-500 font-bold uppercase">No. Rekening</p>
                            <p class="text-base font-mono font-bold text-emerald-700"><?= esc($bankAccount->account_number) ?></p>
                        </div>
                        <?php if ($bankAccount->branch_office): ?>
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <p class="text-[10px] text-slate-400 font-bold uppercase">Kantor Cabang</p>
                                <p class="text-sm text-slate-600"><?= esc($bankAccount->branch_office) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4 text-slate-400">
                        <i class="fas fa-university text-2xl mb-2"></i>
                        <p class="text-sm">Belum ada data rekening</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Info Proposal -->
            <div class="card-premium p-5" @mousemove="handleMouseMove">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-sky-500"></i>
                    Info Proposal
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-500">Kategori</span>
                        <span class="font-semibold text-slate-800"><?= esc($proposal['kategori_wirausaha'] ?? '-') ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Bidang Usaha</span>
                        <span class="font-semibold text-slate-800"><?= esc($proposal['kategori_usaha'] ?? '-') ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">Total RAB</span>
                        <span class="font-semibold text-sky-600">Rp <?= number_format($proposal['total_rab'] ?? 0, 0, ',', '.') ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500">ID Proposal</span>
                        <span class="font-mono text-slate-600">#<?= $proposal['id'] ?></span>
                    </div>
                </div>

                <?php if (!empty($proposal['submitted_at'])): ?>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <p class="text-[11px] text-slate-400">
                            <i class="far fa-clock mr-1"></i>
                            Dikirim: <?= formatIndonesianDate($proposal['submitted_at']) ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Quick Links -->
            <div class="card-premium p-5" @mousemove="handleMouseMove">
                <h3 class="font-bold text-slate-800 mb-4">Tautan Cepat</h3>
                <div class="space-y-2">
                    <a href="<?= base_url('admin/administrasi/seleksi/' . $proposal['id']) ?>"
                        class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 hover:bg-sky-50 text-slate-600 hover:text-sky-600 transition-colors">
                        <i class="fas fa-file-alt w-5"></i>
                        <span class="text-sm font-medium">Detail Proposal</span>
                    </a>
                    <a href="<?= base_url('admin/pitching-desk/' . $proposal['id']) ?>"
                        class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 hover:bg-sky-50 text-slate-600 hover:text-sky-600 transition-colors">
                        <i class="fas fa-chalkboard w-5"></i>
                        <span class="text-sm font-medium">Pitching Desk</span>
                    </a>
                    <a href="<?= base_url('admin/perjanjian/' . $proposal['id']) ?>"
                        class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 hover:bg-sky-50 text-slate-600 hover:text-sky-600 transition-colors">
                        <i class="fas fa-handshake w-5"></i>
                        <span class="text-sm font-medium">Perjanjian</span>
                    </a>
                    <a href="<?= base_url('admin/implementasi/' . $proposal['id']) ?>"
                        class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 hover:bg-sky-50 text-slate-600 hover:text-sky-600 transition-colors">
                        <i class="fas fa-cubes w-5"></i>
                        <span class="text-sm font-medium">Implementasi</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>