<?php 
    /**
     * Shared Monitoring View
     * This partial is used by Admin, Dosen, and Mentor to monitor a specific team's progress.
     * Designed to match the premium Admin Team Summary style.
     */
    
    $guidanceLogs = $guidanceLogs ?? [];
    $activityLogs = $activityLogs ?? [];
    $milestoneReports = $milestoneReports ?? [];
    $members = $members ?? [];
    $documents = $documents ?? [];
    
    // Normalize Logs into arrays for easier processing
    $normalizedGuidance = array_map(function($l) {
        return is_array($l) ? $l : (method_exists($l, 'toArray') ? $l->toArray() : (array)$l);
    }, $guidanceLogs);

    $normalizedActivity = array_map(function($l) {
        return is_array($l) ? $l : (method_exists($l, 'toArray') ? $l->toArray() : (array)$l);
    }, $activityLogs);

    $bimbinganLogs = array_filter($normalizedGuidance, fn($l) => ($l['type'] ?? '') === 'bimbingan');
    $mentoringLogs = array_filter($normalizedGuidance, fn($l) => ($l['type'] ?? '') === 'mentoring');
    
    $bimbinganCount = count(array_filter($bimbinganLogs, fn($l) => ($l['status'] ?? '') === 'approved'));
    $mentoringCount = count(array_filter($mentoringLogs, fn($l) => ($l['status'] ?? '') === 'approved'));
    $activityCount = count(array_filter($normalizedActivity, fn($l) => ($l['status'] ?? '') === 'approved'));

    $docNames = [
        'proposal_utama'         => 'Proposal Utama',
        'biodata'                => 'Lampiran Biodata',
        'surat_pernyataan_ketua' => 'Surat Pernyataan Ketua',
        'surat_kesediaan_dosen'  => 'Surat Kesediaan Dosen Pendamping',
        'ktm'                    => 'Scan KTM (gabungan)',
        'pitching_ppt'           => 'Presentasi Pitching',
        'bukti_perjanjian'       => 'Bukti Perjanjian',
    ];

    $badgeClasses = [
        'draft'              => 'bg-slate-100 text-slate-600',
        'pending'            => 'bg-amber-100 text-amber-700',
        'approved'           => 'bg-emerald-100 text-emerald-700',
        'revision'           => 'bg-orange-100 text-orange-700',
        'rejected'           => 'bg-rose-100 text-rose-700',
        'approved_by_dosen'  => 'bg-purple-100 text-purple-700',
        'approved_by_mentor' => 'bg-indigo-100 text-indigo-700',
    ];
?>

<!-- 1. Header Card (Premium Summary) -->
<div class="card-premium p-6 mb-6" @mousemove="handleMouseMove">
    <div class="flex flex-col md:flex-row gap-6">
        <!-- Avatar / Initials -->
        <div class="shrink-0">
            <div class="w-20 h-20 rounded-2xl bg-linear-to-tr from-sky-500 to-indigo-500 flex items-center justify-center text-white font-display font-bold text-3xl shadow-xl shadow-sky-200">
                <?= substr(esc($proposal['nama_usaha'] ?? '?'), 0, 1) ?>
            </div>
        </div>

        <!-- Team Info -->
        <div class="flex-1">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h2 class="text-xl font-black text-slate-800 tracking-tight uppercase"><?= esc($proposal['nama_usaha'] ?? 'Tanpa Nama') ?></h2>
                    <p class="text-slate-500 mt-1 flex items-center gap-2">
                        <i class="fas fa-crown text-amber-400"></i>
                        <span class="font-bold text-slate-700"><?= esc($members[0]['nama'] ?? '-') ?></span>
                        <span class="text-[10px] bg-slate-100 px-2 py-0.5 rounded-full font-black text-slate-400">KETUA</span>
                    </p>
                </div>
                <?php
                $statusMap = [
                    'draft'     => ['bg-slate-100', 'text-slate-600', 'Draft'],
                    'submitted' => ['bg-amber-100', 'text-amber-700', 'Menunggu Validasi'],
                    'revision'  => ['bg-orange-100', 'text-orange-700', 'Perlu Revisi'],
                    'approved'  => ['bg-emerald-100', 'text-emerald-700', 'Disetujui'],
                    'rejected'  => ['bg-rose-100', 'text-rose-700', 'Ditolak'],
                ];
                $st = $statusMap[$proposal['status']] ?? $statusMap['draft'];
                ?>
                <span class="px-4 py-1.5 rounded-xl <?= $st[0] ?> <?= $st[1] ?> text-[10px] font-black uppercase tracking-widest border border-current/10">
                    <?= $st[2] ?>
                </span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 pt-6 border-t border-slate-100">
                <div>
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">NIM Ketua</p>
                    <p class="text-sm font-bold text-slate-700 mt-0.5"><?= esc($members[0]['nim'] ?? '-') ?></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Kategori Usaha</p>
                    <p class="text-sm font-bold text-slate-700 mt-0.5"><?= esc($proposal['kategori_usaha'] ?? '-') ?></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Kategori Wirausaha</p>
                    <p class="text-sm font-bold text-slate-700 mt-0.5"><?= esc($proposal['kategori_wirausaha'] ?? '-') ?></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Total Anggota</p>
                    <p class="text-sm font-bold text-slate-700 mt-0.5"><?= count($members) ?> Mahasiswa</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <!-- LEFT COLUMN: Members & Documents -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Team Members List -->
        <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <h3 class="font-black text-slate-800 uppercase tracking-tight flex items-center gap-2">
                    <i class="fas fa-users text-sky-500"></i>
                    Anggota Tim
                </h3>
            </div>
            <div class="divide-y divide-slate-50">
                <?php foreach ($members as $member): ?>
                    <div class="p-5 flex items-center gap-4 hover:bg-slate-50/80 transition-all cursor-pointer group"
                         @click="selectedMember = <?= esc(json_encode($member)) ?>; showTeamModal = true">
                        <div class="w-12 h-12 rounded-xl <?= $member['role'] === 'ketua' ? 'bg-sky-100 text-sky-600' : 'bg-slate-100 text-slate-500' ?> flex items-center justify-center shrink-0 shadow-sm group-hover:scale-110 transition-transform">
                            <i class="fas <?= $member['role'] === 'ketua' ? 'fa-crown' : 'fa-user' ?> text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="font-bold text-slate-800 group-hover:text-sky-600 transition-colors"><?= esc($member['nama']) ?></p>
                                <span class="text-[9px] px-2 py-0.5 rounded-full font-black uppercase <?= $member['role'] === 'ketua' ? 'bg-sky-100 text-sky-600' : 'bg-slate-100 text-slate-400' ?>">
                                    <?= $member['role'] ?>
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1">
                                <p class="text-[11px] text-slate-400 font-medium">
                                    <i class="fas fa-id-card mr-1 opacity-50"></i><?= esc($member['nim']) ?>
                                </p>
                                <p class="text-[11px] text-slate-400 font-medium">
                                    <i class="fas fa-graduation-cap mr-1 opacity-50"></i><?= esc($member['prodi']) ?>
                                </p>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-slate-300 text-xs opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Tracking Stats (Bento Style) -->
        <div class="card-premium p-6" @mousemove="handleMouseMove">
            <div class="flex items-center gap-4 mb-6">
                <h3 class="font-black text-slate-800 uppercase tracking-tight flex items-center gap-2">
                    <i class="fas fa-chart-line text-indigo-500"></i>
                    Progress Logbook
                </h3>
                <div class="h-px flex-1 bg-slate-100"></div>
            </div>

            <div class="grid sm:grid-cols-3 gap-4">
                <!-- Bimbingan Stat -->
                <div class="p-5 rounded-2xl bg-amber-50 border border-amber-100 border-l-4 border-l-amber-500 group hover:shadow-lg hover:shadow-amber-100 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-white text-amber-500 flex items-center justify-center shadow-sm border border-amber-50">
                            <i class="fas fa-chalkboard-teacher text-lg"></i>
                        </div>
                        <span class="text-[9px] font-black text-amber-600 bg-white px-2.5 py-1 rounded-full uppercase tracking-widest border border-amber-100">Bimbingan</span>
                    </div>
                    <p class="text-3xl font-black text-slate-800"><?= $bimbinganCount ?> <span class="text-xs font-normal text-slate-400 ml-1">Approved</span></p>
                    <p class="text-[10px] text-slate-400 mt-1 uppercase font-black tracking-widest">Total Sesi Dosen</p>
                </div>

                <!-- Mentoring Stat -->
                <div class="p-5 rounded-2xl bg-emerald-50 border border-emerald-100 border-l-4 border-l-emerald-500 group hover:shadow-lg hover:shadow-emerald-100 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-white text-emerald-500 flex items-center justify-center shadow-sm border border-emerald-50">
                            <i class="fas fa-user-tie text-lg"></i>
                        </div>
                        <span class="text-[9px] font-black text-emerald-600 bg-white px-2.5 py-1 rounded-full uppercase tracking-widest border border-emerald-100">Mentoring</span>
                    </div>
                    <p class="text-3xl font-black text-slate-800"><?= $mentoringCount ?> <span class="text-xs font-normal text-slate-400 ml-1">Approved</span></p>
                    <p class="text-[10px] text-slate-400 mt-1 uppercase font-black tracking-widest">Total Sesi Mentor</p>
                </div>

                <!-- Kegiatan Stat -->
                <div class="p-5 rounded-2xl bg-indigo-50 border border-indigo-100 border-l-4 border-l-indigo-500 group hover:shadow-lg hover:shadow-indigo-100 transition-all">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl bg-white text-indigo-500 flex items-center justify-center shadow-sm border border-indigo-50">
                            <i class="fas fa-store text-lg"></i>
                        </div>
                        <span class="text-[9px] font-black text-indigo-600 bg-white px-2.5 py-1 rounded-full uppercase tracking-widest border border-indigo-100">Kegiatan</span>
                    </div>
                    <p class="text-3xl font-black text-slate-800"><?= $activityCount ?> <span class="text-xs font-normal text-slate-400 ml-1">Approved</span></p>
                    <p class="text-[10px] text-slate-400 mt-1 uppercase font-black tracking-widest">Aktivitas Usaha</p>
                </div>
            </div>
        </div>

        <!-- Logs Tabs -->
        <div class="card-premium overflow-hidden" @mousemove="handleMouseMove" x-data="{ activeTab: 'bimbingan' }">
            <div class="flex overflow-x-auto no-scrollbar border-b border-slate-100 bg-slate-50/50 p-1">
                <button @click="activeTab = 'bimbingan'" :class="activeTab === 'bimbingan' ? 'bg-white text-sky-600 shadow-sm' : 'text-slate-500 hover:bg-white/50'" class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                    Log Bimbingan
                </button>
                <button @click="activeTab = 'mentoring'" :class="activeTab === 'mentoring' ? 'bg-white text-emerald-600 shadow-sm' : 'text-slate-500 hover:bg-white/50'" class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                    Log Mentoring
                </button>
                <button @click="activeTab = 'kegiatan'" :class="activeTab === 'kegiatan' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:bg-white/50'" class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                    Log Kegiatan
                </button>
                <button @click="activeTab = 'milestone'" :class="activeTab === 'milestone' ? 'bg-white text-violet-600 shadow-sm' : 'text-slate-500 hover:bg-white/50'" class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all">
                    Milestone
                </button>
            </div>

            <div class="divide-y divide-slate-100">
                <!-- Bimbingan Tab -->
                <template x-if="activeTab === 'bimbingan'">
                    <div class="divide-y divide-slate-50">
                        <?php if (empty($bimbinganLogs)): ?>
                            <div class="p-12 text-center text-slate-300">
                                <i class="fas fa-ghost text-4xl mb-3 opacity-20"></i>
                                <p class="text-sm font-medium">Belum ada log bimbingan</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($bimbinganLogs as $log): ?>
                                <div class="p-5 hover:bg-slate-50/50 transition-colors">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-[10px] font-black text-slate-400 tracking-widest uppercase">
                                            <i class="far fa-calendar-alt mr-1.5 opacity-60"></i>
                                            <?= date('d M Y', strtotime($log['schedule_date'] ?? '')) ?>
                                        </span>
                                        <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest <?= $badgeClasses[$log['status'] ?? ''] ?? 'bg-slate-100 text-slate-500' ?>">
                                            <?= esc($log['status'] ?? '') ?>
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-slate-800 mb-1.5"><?= esc($log['topic'] ?? 'Bimbingan Rutin') ?></h4>
                                    <p class="text-xs text-slate-500 line-clamp-2 italic"><?= esc(($log['material_explanation'] ?? '') ?: 'Tidak ada catatan bimbingan') ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </template>

                <!-- Mentoring Tab -->
                <template x-if="activeTab === 'mentoring'">
                    <div class="divide-y divide-slate-50">
                        <?php if (empty($mentoringLogs)): ?>
                            <div class="p-12 text-center text-slate-300">
                                <i class="fas fa-ghost text-4xl mb-3 opacity-20"></i>
                                <p class="text-sm font-medium">Belum ada log mentoring</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($mentoringLogs as $log): ?>
                                <div class="p-5 hover:bg-slate-50/50 transition-colors">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-[10px] font-black text-slate-400 tracking-widest uppercase">
                                            <i class="far fa-calendar-alt mr-1.5 opacity-60"></i>
                                            <?= date('d M Y', strtotime($log['schedule_date'] ?? '')) ?>
                                        </span>
                                        <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest <?= $badgeClasses[$log['status'] ?? ''] ?? 'bg-slate-100 text-slate-500' ?>">
                                            <?= esc($log['status'] ?? '') ?>
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-slate-800 mb-1.5"><?= esc($log['topic'] ?? 'Mentoring Rutin') ?></h4>
                                    <p class="text-xs text-slate-500 line-clamp-2 italic"><?= esc(($log['material_explanation'] ?? '') ?: 'Tidak ada catatan mentoring') ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </template>

                <!-- Kegiatan Tab -->
                <template x-if="activeTab === 'kegiatan'">
                    <div class="divide-y divide-slate-50">
                        <?php if (empty($normalizedActivity)): ?>
                            <div class="p-12 text-center text-slate-300">
                                <i class="fas fa-ghost text-4xl mb-3 opacity-20"></i>
                                <p class="text-sm font-medium">Belum ada log kegiatan</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($normalizedActivity as $log): ?>
                                <div class="p-5 hover:bg-slate-50/50 transition-colors">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-[10px] font-black text-slate-400 tracking-widest uppercase">
                                            <i class="far fa-calendar-alt mr-1.5 opacity-60"></i>
                                            <?= date('d M Y', strtotime($log['activity_date'] ?? '')) ?>
                                        </span>
                                        <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest <?= $badgeClasses[$log['status'] ?? ''] ?? 'bg-slate-100 text-slate-500' ?>">
                                            <?= esc($log['status'] ?? '') ?>
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-slate-800 mb-1.5"><?= esc($log['activity_category'] ?? 'Kegiatan Usaha') ?></h4>
                                    <p class="text-xs text-slate-500 line-clamp-2 italic"><?= esc(($log['activity_description'] ?? '') ?: 'Tidak ada deskripsi kegiatan') ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </template>

                <!-- Milestone Tab -->
                <template x-if="activeTab === 'milestone'">
                    <div class="p-6">
                        <?php if (empty($milestoneReports)): ?>
                            <div class="py-12 text-center text-slate-300">
                                <i class="fas fa-file-invoice text-4xl mb-3 opacity-20"></i>
                                <p class="text-sm font-medium">Laporan Milestone belum tersedia</p>
                            </div>
                        <?php else: ?>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <?php
                                $reportTypes = [
                                    'kemajuan' => ['title' => 'Laporan Kemajuan', 'icon' => 'fa-tasks', 'color' => 'amber'],
                                    'akhir'    => ['title' => 'Laporan Akhir', 'icon' => 'fa-check-double', 'color' => 'emerald']
                                ];
                                foreach (['kemajuan', 'akhir'] as $type):
                                    $report = array_filter($milestoneReports, fn($r) => $r['type'] === $type);
                                    $report = !empty($report) ? array_values($report)[0] : null;
                                    $config = $reportTypes[$type];
                                ?>
                                    <div class="p-5 rounded-2xl border <?= $report ? 'bg-white border-slate-200 shadow-sm' : 'bg-slate-50/50 border-slate-100 border-dashed' ?> transition-all">
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-<?= $config['color'] ?>-100 text-<?= $config['color'] ?>-600 flex items-center justify-center shadow-sm">
                                                    <i class="fas <?= $config['icon'] ?>"></i>
                                                </div>
                                                <div>
                                                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight"><?= $config['title'] ?></h4>
                                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Tahapan Milestone</p>
                                                </div>
                                            </div>
                                            <?php if ($report): ?>
                                                <span class="px-2 py-0.5 rounded-lg text-[9px] font-black uppercase tracking-widest <?= $badgeClasses[$report['status']] ?? 'bg-slate-100 text-slate-500' ?>">
                                                    <?= esc($report['status']) ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest">BELUM ADA</span>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ($report): ?>
                                            <div class="space-y-4">
                                                <div class="p-3.5 rounded-xl bg-slate-50/50 border border-slate-100">
                                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Catatan Mahasiswa</p>
                                                    <p class="text-xs text-slate-600 italic line-clamp-3 leading-relaxed">"<?= esc($report['notes'] ?: 'Tidak ada catatan') ?>"</p>
                                                </div>
                                                <div class="flex items-center justify-between pt-2">
                                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                                        <i class="far fa-clock mr-1 opacity-60"></i>
                                                        <?= date('d M Y', strtotime($report['created_at'])) ?>
                                                    </p>
                                                    <?php
                                                        $reportUrl = '#';
                                                        $currUser = auth()->user();
                                                        if ($currUser?->inGroup('admin')) $reportUrl = base_url('admin/milestone/view/' . $report['id']);
                                                        elseif ($currUser?->inGroup('dosen', 'mentor')) $reportUrl = base_url('dosen/milestone/view/' . $report['id']);
                                                    ?>
                                                    <a href="<?= $reportUrl ?>" target="_blank" class="px-4 py-2 rounded-xl bg-sky-50 text-sky-600 hover:bg-sky-600 hover:text-white transition-all text-[10px] font-black uppercase tracking-widest shadow-sm shadow-sky-100">
                                                        Lihat PDF
                                                    </a>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="py-8 text-center">
                                                <p class="text-xs text-slate-300 italic">Menunggu unggahan mahasiswa...</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN: Sidebar Documents & Recent Feed -->
    <div class="space-y-6">
        
        <!-- Document Sidebar (Premium Grid) -->
        <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h3 class="font-black text-slate-800 uppercase tracking-tight flex items-center gap-2 text-sm">
                    <i class="fas fa-file-pdf text-rose-500"></i>
                    Berkas Proposal
                </h3>
            </div>
            <div class="p-5 space-y-3">
                <?php if (empty($documents)): ?>
                    <div class="text-center py-8">
                        <i class="fas fa-file-import text-slate-200 text-3xl mb-2"></i>
                        <p class="text-xs text-slate-400 italic">Belum ada dokumen yang diunggah</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($documents as $doc): ?>
                        <?php 
                            $friendlyName = $docNames[$doc['doc_key']] ?? strtoupper(str_replace('_', ' ', $doc['doc_key']));
                            $docUrl = '#';
                            $currUser = auth()->user();
                            if ($currUser?->inGroup('admin')) $docUrl = base_url('admin/administrasi/seleksi/doc/' . $doc['id']);
                            elseif ($currUser?->inGroup('dosen')) $docUrl = base_url('dosen/pitching-desk/doc/' . $doc['id']);
                            // Mentor doesn't have a direct route in the listing, use dosen as fallback or admin if possible
                        ?>
                        <a href="<?= $docUrl ?>" target="_blank" class="flex items-center gap-3 p-3.5 rounded-2xl bg-slate-50/50 hover:bg-sky-50 border border-slate-100 hover:border-sky-200 transition-all group">
                            <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-500 flex items-center justify-center group-hover:bg-rose-500 group-hover:text-white shadow-sm transition-all duration-300">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-bold text-slate-700 truncate group-hover:text-sky-700 transition-colors"><?= esc($friendlyName) ?></p>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">Berkas PDF</p>
                            </div>
                            <i class="fas fa-arrow-down text-slate-300 group-hover:text-sky-500 group-hover:translate-y-0.5 transition-all text-xs mr-1"></i>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Activity Feed (Modern Vertical) -->
        <div class="card-premium p-6" @mousemove="handleMouseMove">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                <h3 class="font-black text-slate-800 uppercase tracking-tight text-sm">Aktivitas Terkini</h3>
            </div>
            
            <div class="space-y-4">
                <?php 
                    $allLogs = array_merge(
                        array_map(fn($l) => array_merge($l, [
                            'feed_type'     => 'guidance',
                            'display_notes' => $l['material_explanation'] ?? null
                        ]), $normalizedGuidance),
                        array_map(fn($l) => array_merge($l, [
                            'feed_type'     => 'activity',
                            'display_notes' => $l['activity_description'] ?? null
                        ]), $normalizedActivity)
                    );
                    usort($allLogs, fn($a, $b) => strcmp($b['updated_at'] ?? '', $a['updated_at'] ?? ''));
                    $recentLogs = array_slice($allLogs, 0, 5);
                ?>

                <?php if (empty($recentLogs)): ?>
                    <div class="py-12 text-center">
                        <i class="fas fa-ghost text-slate-200 text-3xl mb-2 opacity-30"></i>
                        <p class="text-xs text-slate-400 italic">Belum ada aktivitas baru</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($recentLogs as $log): ?>
                        <div class="relative pl-6 pb-4 border-l-2 border-slate-100 last:border-0 last:pb-0">
                            <!-- Bullet -->
                            <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full border-4 border-white shadow-sm <?= $log['feed_type'] === 'guidance' ? 'bg-amber-400' : 'bg-indigo-400' ?>"></div>
                            
                            <div class="flex flex-col">
                                <span class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mb-1"><?= date('d M Y, H:i', strtotime($log['updated_at'] ?? 'now')) ?></span>
                                <div class="p-3 rounded-2xl bg-slate-50 border border-slate-100 hover:border-sky-100 transition-all">
                                    <p class="text-[10px] font-black text-slate-700 uppercase tracking-tighter mb-1">
                                        <?= $log['feed_type'] === 'guidance' ? esc($log['type'] ?? '') : 'KEGIATAN USAHA' ?>
                                    </p>
                                    <p class="text-[11px] text-slate-500 italic line-clamp-2 leading-relaxed"><?= esc(($log['display_notes'] ?? '') ?: 'Tidak ada catatan') ?></p>
                                    <div class="mt-2 flex items-center gap-2">
                                        <span class="px-2 py-0.5 rounded-lg text-[8px] font-black uppercase tracking-widest <?= ($log['status'] ?? '') === 'approved' ? 'bg-emerald-100 text-emerald-700' : (($log['status'] ?? '') === 'rejected' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') ?>">
                                            <?= esc($log['status'] ?? '') ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
     STUDENT PROFILE MODAL (ALPINE.JS)
     Referenced from mahasiswa/pitching_desk.php
================================================================= -->
<div x-show="showTeamModal" 
     class="fixed inset-0 z-[99] flex items-center justify-center p-4 sm:p-6"
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 scale-95"
     x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-95">
    
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showTeamModal = false"></div>

    <!-- Modal Content -->
    <div class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
        <div class="absolute top-0 left-0 w-full h-24 bg-linear-to-br from-sky-500 to-indigo-600"></div>
        
        <div class="relative pt-12 px-6 pb-8">
            <!-- Close Button -->
            <button @click="showTeamModal = false" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/20 hover:bg-white/40 text-white flex items-center justify-center transition-all">
                <i class="fas fa-times"></i>
            </button>

            <!-- Profile Info -->
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 rounded-3xl bg-white p-1.5 shadow-xl mb-4">
                    <div class="w-full h-full rounded-2xl bg-linear-to-br from-slate-100 to-slate-50 flex items-center justify-center text-sky-500">
                        <i class="fas fa-user-graduate text-4xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-black text-slate-800 uppercase tracking-tight text-center" x-text="selectedMember?.nama || '-'"></h3>
                <p class="text-xs font-black text-sky-500 uppercase tracking-widest mt-1" x-text="selectedMember?.role || '-'"></p>
                
                <div class="grid grid-cols-2 gap-3 w-full mt-8">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Nomor Induk</p>
                        <p class="text-sm font-bold text-slate-700" x-text="selectedMember?.nim || '-'"></p>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Semester</p>
                        <p class="text-sm font-bold text-slate-700" x-text="selectedMember?.semester || '-'"></p>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 col-span-2">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Program Studi</p>
                        <p class="text-sm font-bold text-slate-700" x-text="(selectedMember?.prodi || '-') + ' (' + (selectedMember?.jurusan || '-') + ')'"></p>
                    </div>
                </div>

                <!-- Contact Actions -->
                <div class="flex gap-3 w-full mt-6">
                    <a :href="`https://wa.me/${selectedMember?.phone?.replace(/^0/, '62')}`" target="_blank" class="flex-1 btn-primary bg-emerald-500 hover:bg-emerald-600 shadow-emerald-100 flex items-center justify-center gap-2 py-3.5 rounded-2xl">
                        <i class="fab fa-whatsapp text-lg"></i>
                        <span class="text-xs font-black uppercase tracking-widest">WhatsApp</span>
                    </a>
                    <a :href="`mailto:${selectedMember?.email}`" class="flex-1 btn-primary bg-sky-500 hover:bg-sky-600 shadow-sky-100 flex items-center justify-center gap-2 py-3.5 rounded-2xl">
                        <i class="fas fa-envelope text-lg"></i>
                        <span class="text-xs font-black uppercase tracking-widest">Email</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
