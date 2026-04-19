<!-- Monitoring Data: Statistics -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <!-- Logbook Stats -->
    <?php 
        $bimbinganCount = count(array_filter($guidanceLogs, fn($l) => $l->type === 'bimbingan' && $l->status === 'approved'));
        $mentoringCount = count(array_filter($guidanceLogs, fn($l) => $l->type === 'mentoring' && $l->status === 'approved'));
        $activityCount = count(array_filter($activityLogs, fn($l) => $l->status === 'approved'));
    ?>
    <div class="card-premium p-5 border-l-4 border-l-sky-500" @mousemove="handleMouseMove">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Log Bimbingan</span>
            <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-500 flex items-center justify-center">
                <i class="fas fa-chalkboard-teacher text-xs"></i>
            </div>
        </div>
        <p class="text-2xl font-black text-slate-800"><?= $bimbinganCount ?></p>
        <div class="flex items-center gap-1.5 mt-2">
            <div class="h-1 flex-1 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-sky-500" style="width: <?= min(100, ($bimbinganCount/8)*100) ?>%"></div>
            </div>
            <span class="text-[9px] font-bold text-slate-400">Target 8</span>
        </div>
    </div>

    <div class="card-premium p-5 border-l-4 border-l-emerald-500" @mousemove="handleMouseMove">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Log Mentoring</span>
            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-500 flex items-center justify-center">
                <i class="fas fa-user-tie text-xs"></i>
            </div>
        </div>
        <p class="text-2xl font-black text-slate-800"><?= $mentoringCount ?></p>
        <div class="flex items-center gap-1.5 mt-2">
            <div class="h-1 flex-1 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-emerald-500" style="width: <?= min(100, ($mentoringCount/4)*100) ?>%"></div>
            </div>
            <span class="text-[9px] font-bold text-slate-400">Target 4</span>
        </div>
    </div>

    <div class="card-premium p-5 border-l-4 border-l-amber-500" @mousemove="handleMouseMove">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Kegiatan Usaha</span>
            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-500 flex items-center justify-center">
                <i class="fas fa-store text-xs"></i>
            </div>
        </div>
        <p class="text-2xl font-black text-slate-800"><?= $activityCount ?></p>
        <p class="text-[9px] text-slate-400 mt-2 italic font-medium">Logbook tervalidasi</p>
    </div>

    <div class="card-premium p-5 border-l-4 border-l-rose-500" @mousemove="handleMouseMove">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Laporan Akhir</span>
            <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-500 flex items-center justify-center">
                <i class="fas fa-file-contract text-xs"></i>
            </div>
        </div>
        <?php $akhirReport = array_filter($milestoneReports, fn($r) => $r['type'] === 'akhir' && $r['status'] === 'approved'); ?>
        <p class="text-lg font-black <?= !empty($akhirReport) ? 'text-emerald-600' : 'text-slate-400' ?>">
            <?= !empty($akhirReport) ? 'SUBMITTED' : 'NOT READY' ?>
        </p>
        <p class="text-[9px] text-slate-400 mt-2 italic font-medium">Status validasi akhir</p>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-8">
    <!-- Left Column: Team & Activity Feed -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Anggota Tim Section -->
        <div class="card-premium p-6" @mousemove="handleMouseMove">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-6 bg-sky-500 rounded-full"></div>
                <h3 class="font-black text-slate-800 uppercase tracking-tight">Anggota Tim & Peran</h3>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <?php foreach ($members as $member): ?>
                    <div class="flex items-center gap-4 p-3 rounded-2xl bg-slate-50 border border-slate-100 group hover:border-sky-200 hover:bg-white transition-all">
                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center font-bold text-slate-400 group-hover:bg-sky-50 group-hover:text-sky-500 group-hover:border-sky-100 transition-all">
                            <?= substr($member['nama'], 0, 1) ?>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-700 leading-none mb-1"><?= esc($member['nama']) ?></p>
                            <div class="flex items-center gap-2">
                                <span class="text-[9px] font-black uppercase px-2 py-0.5 rounded-md <?= $member['role'] === 'ketua' ? 'bg-amber-100 text-amber-700' : 'bg-slate-200 text-slate-500' ?>">
                                    <?= esc($member['role']) ?>
                                </span>
                                <span class="text-[9px] text-slate-400 font-medium"><?= esc($member['nim']) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Recent Activity Feed -->
        <div class="card-premium p-6" @mousemove="handleMouseMove">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                    <h3 class="font-black text-slate-800 uppercase tracking-tight">Aktivitas Terkini</h3>
                </div>
            </div>
            
            <div class="space-y-4">
                <?php 
                    $allLogs = array_merge(
                        array_map(fn($l) => array_merge($l, ['feed_type' => 'guidance']), $guidanceLogs),
                        array_map(fn($l) => array_merge($l, ['feed_type' => 'activity']), $activityLogs)
                    );
                    usort($allLogs, fn($a, $b) => strcmp($b['updated_at'], $a['updated_at']));
                    $recentLogs = array_slice($allLogs, 0, 5);
                ?>

                <?php if (empty($recentLogs)): ?>
                    <div class="py-8 text-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-ghost text-slate-200 text-2xl"></i>
                        </div>
                        <p class="text-sm text-slate-400 italic">Belum ada aktivitas yang tercatat</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($recentLogs as $log): ?>
                        <div class="flex gap-4 p-4 rounded-2xl bg-slate-50/50 border border-slate-100 hover:bg-white hover:border-sky-100 transition-all group">
                            <div class="shrink-0 mt-1">
                                <?php if ($log['feed_type'] === 'guidance'): ?>
                                    <div class="w-8 h-8 rounded-lg <?= $log['type'] === 'bimbingan' ? 'bg-sky-100 text-sky-600' : 'bg-emerald-100 text-emerald-600' ?> flex items-center justify-center">
                                        <i class="fas <?= $log['type'] === 'bimbingan' ? 'fa-user-graduate' : 'fa-briefcase' ?> text-[10px]"></i>
                                    </div>
                                <?php else: ?>
                                    <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center">
                                        <i class="fas fa-store text-[10px]"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <p class="text-xs font-black text-slate-700 uppercase tracking-tight">
                                        <?= $log['feed_type'] === 'guidance' ? esc($log['type']) : 'KEGIATAN USAHA' ?>
                                    </p>
                                    <span class="text-[9px] text-slate-400 font-bold italic"><?= date('d M Y, H:i', strtotime($log['updated_at'])) ?></span>
                                </div>
                                <p class="text-xs text-slate-600 line-clamp-2 italic">"<?= esc($log['student_notes'] ?? 'Tidak ada catatan') ?>"</p>
                                <div class="flex items-center gap-2 mt-2">
                                    <span class="px-2 py-0.5 rounded text-[8px] font-black uppercase <?= $log['status'] === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($log['status'] === 'rejected' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') ?>">
                                        <?= esc($log['status']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Right Column: Documents & Status -->
    <div class="space-y-8">
        <!-- Milestone Status -->
        <div class="card-premium p-6" @mousemove="handleMouseMove">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-6 bg-indigo-500 rounded-full"></div>
                <h3 class="font-black text-slate-800 uppercase tracking-tight">Milestone Progress</h3>
            </div>
            <div class="space-y-4">
                <?php 
                    $milestones = [
                        ['type' => 'kemajuan', 'label' => 'Laporan Kemajuan'],
                        ['type' => 'akhir', 'label' => 'Laporan Akhir'],
                    ];
                ?>
                <?php foreach ($milestones as $m): ?>
                    <?php 
                        $rep = array_filter($milestoneReports, fn($r) => $r['type'] === $m['type']);
                        $rep = !empty($rep) ? reset($rep) : null;
                    ?>
                    <div class="p-4 rounded-2xl border <?= $rep && $rep['status'] === 'approved' ? 'border-emerald-100 bg-emerald-50/30' : 'border-slate-100 bg-slate-50' ?> transition-all">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[10px] font-black uppercase text-slate-500"><?= $m['label'] ?></span>
                            <i class="fas <?= $rep && $rep['status'] === 'approved' ? 'fa-check-circle text-emerald-500' : 'fa-clock text-slate-300' ?>"></i>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-bold <?= $rep && $rep['status'] === 'approved' ? 'text-emerald-700' : 'text-slate-400' ?>">
                                <?= $rep ? strtoupper($rep['status']) : 'PENDING' ?>
                            </p>
                            <?php if ($rep && $rep['file_path']): ?>
                                <a href="<?= base_url('admin/milestone/view/' . $rep['id']) ?>" target="_blank" class="text-[10px] font-black text-sky-500 hover:text-sky-600 transition-colors uppercase">
                                    <i class="fas fa-file-pdf mr-1"></i> LIHAT PDF
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Dukungan Dokumen -->
        <div class="card-premium p-6" @mousemove="handleMouseMove">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-1.5 h-6 bg-amber-500 rounded-full"></div>
                <h3 class="font-black text-slate-800 uppercase tracking-tight">Berkas Pendukung</h3>
            </div>
            <div class="space-y-3">
                <?php foreach ($documents as $doc): ?>
                    <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100 group hover:border-sky-200 transition-all">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-hover:text-sky-500 transition-colors">
                                <i class="fas fa-file-lines text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-700 leading-tight truncate w-32 uppercase"><?= esc($doc['type']) ?></p>
                                <p class="text-[8px] text-slate-400 italic">Terakhir diunggah <?= date('d/m/Y', strtotime($doc['updated_at'])) ?></p>
                            </div>
                        </div>
                        <a href="<?= base_url('mahasiswa/proposal/doc/' . $doc['id']) ?>" target="_blank" class="w-8 h-8 rounded-lg bg-sky-50 text-sky-500 flex items-center justify-center hover:bg-sky-500 hover:text-white transition-all shadow-sm">
                            <i class="fas fa-download text-[10px]"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
