<div class="w-full max-w-full overflow-x-hidden space-y-6" 
     x-data="{ 
        activeTab: 'bimbingan', 
        showLogModal: false, 
        selectedLog: {},
        handleMouseMove(e) {
            const card = e.currentTarget;
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        }
     }">

    <!-- HEADER CARD -->
    <div class="card-premium p-5 sm:p-6" @mousemove="handleMouseMove">
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-5 text-center sm:text-left">

            <!-- Avatar -->
            <div class="shrink-0">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-3xl bg-linear-to-tr from-sky-600 to-sky-400 flex items-center justify-center text-white font-display font-bold text-3xl sm:text-4xl shadow-xl shadow-sky-500/20">
                    <?= substr(esc($members[0]['nama'] ?? '?'), 0, 1) ?>
                </div>
            </div>

            <!-- Info -->
            <div class="flex-1 w-full min-w-0">
                <div class="flex flex-col sm:flex-row items-center sm:items-start justify-between gap-3">
                    <div class="min-w-0 w-full sm:w-auto">
                        <h2 class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight truncate">
                            <?= esc($proposal['nama_usaha'] ?? 'Tanpa Nama') ?>
                        </h2>
                        <p class="text-slate-500 mt-1 text-sm">
                            <i class="fas fa-user text-sky-400 mr-1"></i>
                            <?= esc($members[0]['nama'] ?? '-') ?>
                            <span class="text-slate-400">(Ketua)</span>
                        </p>
                    </div>

                    <?php
                    $statusConfig = [
                        'draft'     => ['bg-slate-100', 'text-slate-600', 'Draft'],
                        'submitted' => ['bg-amber-100', 'text-amber-700', 'Menunggu Validasi'],
                        'revision'  => ['bg-orange-100', 'text-orange-700', 'Perlu Revisi'],
                        'approved'  => ['bg-emerald-100', 'text-emerald-700', 'Disetujui'],
                        'rejected'  => ['bg-rose-100', 'text-rose-700', 'Ditolak'],
                    ];
                    $config = $statusConfig[$proposal['status']] ?? $statusConfig['draft'];
                    ?>
                    <span class="shrink-0 px-3 py-1 rounded-full <?= $config[0] ?> <?= $config[1] ?> text-xs font-black uppercase">
                        <?= $config[2] ?>
                    </span>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-4 pt-4 border-t border-slate-100">
                    <div class="min-w-0">
                        <p class="text-[10px] text-slate-400 font-bold uppercase">NIM Ketua</p>
                        <p class="text-sm font-semibold text-slate-700 truncate"><?= esc($members[0]['nim'] ?? '-') ?></p>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Program Studi</p>
                        <p class="text-sm font-semibold text-slate-700 truncate"><?= esc($members[0]['prodi'] ?? '-') ?></p>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Jurusan</p>
                        <p class="text-sm font-semibold text-slate-700 truncate"><?= esc($members[0]['jurusan'] ?? '-') ?></p>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-slate-400 font-bold uppercase">Total Anggota</p>
                        <p class="text-sm font-semibold text-slate-700"><?= count($members) ?> orang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN BODY: Left col + Sidebar                       -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT / MAIN COLUMN -->
        <div class="lg:col-span-2 space-y-6 min-w-0">

            <!-- ANGGOTA TIM -->
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2">
                        <i class="fas fa-users text-sky-500"></i>
                        Anggota TIM
                    </h3>
                </div>

                <div class="divide-y divide-slate-100">
                    <?php foreach ($members as $member): ?>
                        <div class="p-4 flex items-start gap-3 hover:bg-slate-50 transition-colors">

                            <!-- Icon -->
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl <?= $member['role'] === 'ketua' ? 'bg-sky-100 text-sky-600' : 'bg-slate-100 text-slate-500' ?> flex items-center justify-center shrink-0">
                                <i class="fas <?= $member['role'] === 'ketua' ? 'fa-crown' : 'fa-user' ?> text-sm"></i>
                            </div>

                            <!-- Body -->
                            <div class="flex-1 min-w-0">
                                <!-- Name + Badge -->
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <p class="font-bold text-slate-800 truncate"><?= esc($member['nama']) ?></p>
                                    <?php if ($member['role'] === 'ketua'): ?>
                                        <span class="shrink-0 px-2 py-0.5 bg-sky-100 text-sky-700 text-[10px] font-black rounded-full">KETUA</span>
                                    <?php else: ?>
                                        <span class="shrink-0 px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] font-bold rounded-full">Anggota</span>
                                    <?php endif; ?>
                                </div>

                                <!-- Detail: 2 col on mobile → 4 col on md -->
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-x-3 gap-y-1.5 text-[11px]">
                                    <p class="text-slate-500 flex items-center gap-1 min-w-0">
                                        <i class="fas fa-id-card text-slate-300 shrink-0"></i>
                                        <span class="truncate"><?= esc($member['nim'] ?: '-') ?></span>
                                    </p>
                                    <p class="text-slate-500 flex items-center gap-1 min-w-0">
                                        <i class="fas fa-graduation-cap text-slate-300 shrink-0"></i>
                                        <span class="truncate"><?= esc($member['prodi'] ?: '-') ?></span>
                                    </p>
                                    <p class="text-slate-500 flex items-center gap-1 min-w-0">
                                        <i class="fas fa-building text-slate-300 shrink-0"></i>
                                        <span class="truncate"><?= esc($member['jurusan'] ?: '-') ?></span>
                                    </p>
                                    <p class="text-slate-500 flex items-center gap-1 min-w-0">
                                        <i class="fas fa-layer-group text-slate-300 shrink-0"></i>
                                        <span>Sem. <?= esc($member['semester'] ?: '-') ?></span>
                                    </p>
                                </div>

                                <!-- Contacts -->
                                <?php if ($member['phone'] || $member['email']): ?>
                                    <div class="flex flex-wrap gap-3 mt-2 text-[11px]">
                                        <?php if ($member['phone']): ?>
                                            <a href="tel:<?= $member['phone'] ?>" class="text-sky-600 hover:underline flex items-center gap-1 min-w-0">
                                                <i class="fas fa-phone shrink-0"></i>
                                                <span class="truncate"><?= esc($member['phone']) ?></span>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($member['email']): ?>
                                            <a href="mailto:<?= $member['email'] ?>" class="text-sky-600 hover:underline flex items-center gap-1 min-w-0">
                                                <i class="fas fa-envelope shrink-0"></i>
                                                <span class="truncate"><?= esc($member['email']) ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- DOKUMEN PROPOSAL -->
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
                        $docNames = [
                            'proposal_utama'          => 'Proposal Utama',
                            'biodata'                 => 'Biodata Anggota',
                            'surat_pernyataan_ketua'  => 'Surat Pernyataan Ketua',
                            'surat_kesediaan_dosen'   => 'Surat Kesediaan Dosen',
                            'ktm'                     => 'Kartu Tanda Mahasiswa',
                            'pitching_ppt'            => 'Presentasi Pitching',
                            'bukti_perjanjian'        => 'Bukti Perjanjian',
                        ];
                        ?>
                        <?php foreach ($documents as $doc): ?>
                            <?php $friendlyName = $docNames[$doc['doc_key']] ?? strtoupper(str_replace('_', ' ', $doc['doc_key'])); ?>
                            <a href="<?= base_url('admin/administrasi/seleksi/doc/' . $doc['id']) ?>"
                               class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 hover:bg-sky-50 border border-slate-100 hover:border-sky-200 transition-all group min-w-0">
                                <div class="w-10 h-10 rounded-lg bg-rose-100 text-rose-500 flex items-center justify-center group-hover:bg-rose-500 group-hover:text-white transition-all shrink-0">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-slate-700 truncate"><?= esc($friendlyName) ?></p>
                                    <p class="text-[10px] text-slate-400">PDF File</p>
                                </div>
                                <i class="fas fa-download text-slate-300 group-hover:text-sky-500 shrink-0"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- TRACKING PROGRESS -->
            <div class="space-y-6">

                <!-- Stat Cards -->
                <div class="card-premium p-5 sm:p-6" @mousemove="handleMouseMove">
                    <div class="flex items-center gap-4 mb-5">
                        <h3 class="text-base sm:text-lg font-black text-slate-800 uppercase tracking-tight whitespace-nowrap">Tracking Progress</h3>
                        <div class="h-px flex-1 bg-slate-100"></div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Bimbingan -->
                        <?php $bimbinganCount = count(array_filter($guidanceLogs, fn($l) => $l->type === 'bimbingan' && $l->status === 'approved')); ?>
                        <div class="p-4 rounded-2xl bg-amber-50/50 border border-amber-100 border-l-4 border-l-amber-500">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 rounded-lg bg-white text-amber-500 flex items-center justify-center shadow-sm border border-amber-100 shrink-0">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <span class="text-[10px] font-black text-amber-600 bg-white px-2 py-0.5 rounded-full uppercase border border-amber-100 shadow-sm">Bimbingan</span>
                            </div>
                            <p class="text-2xl font-black text-slate-800"><?= $bimbinganCount ?> <span class="text-xs font-normal text-slate-400">Log</span></p>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold tracking-wider">Total Terverifikasi</p>
                        </div>

                        <!-- Mentoring -->
                        <?php $mentoringCount = count(array_filter($guidanceLogs, fn($l) => $l->type === 'mentoring' && $l->status === 'approved')); ?>
                        <div class="p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100 border-l-4 border-l-emerald-500">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 rounded-lg bg-white text-emerald-500 flex items-center justify-center shadow-sm border border-emerald-100 shrink-0">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <span class="text-[10px] font-black text-emerald-600 bg-white px-2 py-0.5 rounded-full uppercase border border-emerald-100 shadow-sm">Mentoring</span>
                            </div>
                            <p class="text-2xl font-black text-slate-800"><?= $mentoringCount ?> <span class="text-xs font-normal text-slate-400">Log</span></p>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold tracking-wider">Total Terverifikasi</p>
                        </div>

                        <!-- Kegiatan -->
                        <?php $kegiatanCount = count(array_filter($activityLogs, fn($l) => $l->status === 'approved')); ?>
                        <div class="p-4 rounded-2xl bg-violet-50/50 border border-violet-100 border-l-4 border-l-violet-500">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 rounded-lg bg-white text-violet-500 flex items-center justify-center shadow-sm border border-violet-100 shrink-0">
                                    <i class="fas fa-store"></i>
                                </div>
                                <span class="text-[10px] font-black text-violet-600 bg-white px-2 py-0.5 rounded-full uppercase border border-violet-100 shadow-sm">Kegiatan</span>
                            </div>
                            <p class="text-2xl font-black text-slate-800"><?= $kegiatanCount ?> <span class="text-xs font-normal text-slate-400">Log</span></p>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold tracking-wider">Total Terverifikasi</p>
                        </div>
                    </div>
                </div>

                <!-- LOG TABS -->
                <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">

                    <?php
                    $badgeClasses = [
                        'draft'              => 'bg-slate-100 text-slate-600',
                        'pending'            => 'bg-amber-100 text-amber-700',
                        'approved'           => 'bg-emerald-100 text-emerald-700',
                        'revision'           => 'bg-rose-100 text-rose-700',
                        'approved_by_dosen'  => 'bg-purple-100 text-purple-700',
                        'approved_by_mentor' => 'bg-indigo-100 text-indigo-700',
                    ];
                    ?>

                    <!-- Tab Headers -->
                    <div class="flex border-b border-slate-100 bg-slate-50/50 overflow-x-auto scrollbar-hide">
                        <button @click="activeTab = 'bimbingan'"
                                :class="activeTab === 'bimbingan' ? 'border-amber-500 text-amber-600 bg-white' : 'border-transparent text-slate-500 hover:text-slate-700'"
                                class="flex-none px-5 sm:px-6 py-4 text-[10px] font-black uppercase tracking-wider border-b-2 transition-all whitespace-nowrap min-w-0">
                            Log Bimbingan
                        </button>
                        <button @click="activeTab = 'mentoring'"
                                :class="activeTab === 'mentoring' ? 'border-emerald-500 text-emerald-600 bg-white' : 'border-transparent text-slate-500 hover:text-slate-700'"
                                class="flex-none px-5 sm:px-6 py-4 text-[10px] font-black uppercase tracking-wider border-b-2 transition-all whitespace-nowrap min-w-0">
                            Log Mentoring
                        </button>
                        <button @click="activeTab = 'kegiatan'"
                                :class="activeTab === 'kegiatan' ? 'border-violet-500 text-violet-600 bg-white' : 'border-transparent text-slate-500 hover:text-slate-700'"
                                class="flex-none px-5 sm:px-6 py-4 text-[10px] font-black uppercase tracking-wider border-b-2 transition-all whitespace-nowrap min-w-0">
                            Log Kegiatan
                        </button>
                        <button @click="activeTab = 'milestone'"
                                :class="activeTab === 'milestone' ? 'border-sky-500 text-sky-600 bg-white' : 'border-transparent text-slate-500 hover:text-slate-700'"
                                class="flex-none px-5 sm:px-6 py-4 text-[10px] font-black uppercase tracking-wider border-b-2 transition-all whitespace-nowrap min-w-0">
                            Milestone
                        </button>
                    </div>

                    <!-- Tab: Bimbingan -->
                    <div x-show="activeTab === 'bimbingan'" class="divide-y divide-slate-100">
                        <?php $bimbinganLogs = array_filter($guidanceLogs, fn($l) => $l->type === 'bimbingan'); ?>
                        <?php if (empty($bimbinganLogs)): ?>
                            <div class="p-8 text-center text-slate-400">
                                <i class="fas fa-calendar-times text-3xl mb-2 opacity-20"></i>
                                <p class="text-sm">Belum ada log bimbingan</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($bimbinganLogs as $log): ?>
                                 <div class="p-4 hover:bg-slate-50 transition-all cursor-pointer group"
                                      @click='selectedLog = <?= json_encode([
                                          "type" => "bimbingan",
                                          "log_title" => "Detail Bimbingan",
                                          "log_subtitle" => "Sesi Dosen Pendamping",
                                          "logbook_id" => $log->logbook_id,
                                          "status" => $log->log_status ?? "waiting",
                                          "schedule_date" => date("d M Y", strtotime($log->schedule_date)),
                                          "deadline_info" => date("d M Y", strtotime($log->schedule_date . " + " . ($log->deadline_days ?? 5) . " days")),
                                          "topic" => $log->topic,
                                          "material_explanation" => $log->material_explanation,
                                          "video_url" => $log->video_url,
                                          "photo_activity" => $log->photo_activity,
                                          "assignment_file" => $log->assignment_file,
                                          "nota_file" => $log->nota_file,
                                          "nota_files" => json_decode($log->nota_files ?? "[]", true),
                                          "nota_items" => json_decode($log->nota_items ?? "[]", true),
                                          "nominal_konsumsi" => $log->nominal_konsumsi,
                                          "submitted_at" => $log->submitted_at,
                                          "lecturer_catatan" => $log->verification_note
                                      ]) ?>; showLogModal = true'>
                                    <div class="flex items-center justify-between gap-2 mb-2">
                                        <div class="flex items-center gap-2 min-w-0">
                                            <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center text-xs group-hover:bg-amber-500 group-hover:text-white transition-all shrink-0">
                                                <i class="fas fa-chalkboard-teacher"></i>
                                            </div>
                                            <span class="text-[11px] font-bold text-slate-500 whitespace-nowrap">
                                                <?= date('d M Y', strtotime($log->schedule_date)) ?>
                                            </span>
                                        </div>
                                        <span class="shrink-0 px-2 py-0.5 rounded text-[10px] font-black uppercase <?= $badgeClasses[$log->status] ?? 'bg-slate-100 text-slate-600' ?>">
                                            <?= $log->status ?>
                                        </span>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800 group-hover:text-sky-600 transition-colors truncate"><?= esc($log->topic ?: 'Bimbingan Rutin') ?></h4>
                                    <p class="text-[11px] text-slate-500 mt-1 italic">Klik untuk melihat detail bimbingan...</p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Tab: Mentoring -->
                    <div x-show="activeTab === 'mentoring'" class="divide-y divide-slate-100" style="display:none;">
                        <?php $mentoringLogs = array_filter($guidanceLogs, fn($l) => $l->type === 'mentoring'); ?>
                        <?php if (empty($mentoringLogs)): ?>
                            <div class="p-8 text-center text-slate-400">
                                <i class="fas fa-calendar-times text-3xl mb-2 opacity-20"></i>
                                <p class="text-sm">Belum ada log mentoring</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($mentoringLogs as $log): ?>
                                 <div class="p-4 hover:bg-slate-50 transition-all cursor-pointer group"
                                      @click='selectedLog = <?= json_encode([
                                          "type" => "mentoring",
                                          "log_title" => "Detail Mentoring",
                                          "log_subtitle" => "Sesi Mentor Praktisi",
                                          "logbook_id" => $log->logbook_id,
                                          "status" => $log->log_status ?? "waiting",
                                          "schedule_date" => date("d M Y", strtotime($log->schedule_date)),
                                          "deadline_info" => date("d M Y", strtotime($log->schedule_date . " + " . ($log->deadline_days ?? 5) . " days")),
                                          "topic" => $log->topic,
                                          "material_explanation" => $log->material_explanation,
                                          "video_url" => $log->video_url,
                                          "photo_activity" => $log->photo_activity,
                                          "assignment_file" => $log->assignment_file,
                                          "nota_file" => $log->nota_file,
                                          "nota_files" => json_decode($log->nota_files ?? "[]", true),
                                          "nota_items" => json_decode($log->nota_items ?? "[]", true),
                                          "nominal_konsumsi" => $log->nominal_konsumsi,
                                          "submitted_at" => $log->submitted_at,
                                          "lecturer_catatan" => $log->verification_note
                                      ]) ?>; showLogModal = true'>
                                    <div class="flex items-center justify-between gap-2 mb-2">
                                        <div class="flex items-center gap-2 min-w-0">
                                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs group-hover:bg-emerald-500 group-hover:text-white transition-all shrink-0">
                                                <i class="fas fa-user-tie"></i>
                                            </div>
                                            <span class="text-[11px] font-bold text-slate-500 whitespace-nowrap">
                                                <?= date('d M Y', strtotime($log->schedule_date)) ?>
                                            </span>
                                        </div>
                                        <span class="shrink-0 px-2 py-0.5 rounded text-[10px] font-black uppercase <?= $badgeClasses[$log->status] ?? 'bg-slate-100 text-slate-600' ?>">
                                            <?= $log->status ?>
                                        </span>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800 group-hover:text-sky-600 transition-colors truncate"><?= esc($log->topic ?: 'Mentoring Rutin') ?></h4>
                                    <p class="text-[11px] text-slate-500 mt-1 italic">Klik untuk melihat detail mentoring...</p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Tab: Kegiatan -->
                    <div x-show="activeTab === 'kegiatan'" class="divide-y divide-slate-100" style="display:none;">
                        <?php if (empty($activityLogs)): ?>
                            <div class="p-8 text-center text-slate-400">
                                <i class="fas fa-calendar-times text-3xl mb-2 opacity-20"></i>
                                <p class="text-sm">Belum ada log kegiatan</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($activityLogs as $log): ?>
                                 <div class="p-4 hover:bg-slate-50 transition-all cursor-pointer group"
                                      @click='selectedLog = <?= json_encode([
                                          "type" => "kegiatan",
                                          "log_title" => "Detail Kegiatan",
                                          "log_subtitle" => "Pelaksanaan Lapangan",
                                          "logbook_id" => $log->logbook_id,
                                          "status" => $log->log_status ?? "waiting",
                                          "activity_date" => date("d M Y", strtotime($log->activity_date)),
                                          "activity_category" => $log->activity_category,
                                          "schedule_description" => $log->notes,
                                          "schedule_location" => $log->location,
                                          "activity_description" => $log->activity_description,
                                          "video_url" => $log->video_url,
                                          "photo_activity" => $log->photo_activity,
                                          "catatan" => $log->admin_note ?: ($log->mentor_note ?: $log->dosen_note)
                                      ]) ?>; showLogModal = true'>
                                    <div class="flex items-center justify-between gap-2 mb-2">
                                        <div class="flex items-center gap-2 min-w-0">
                                            <div class="w-8 h-8 rounded-lg bg-violet-100 text-violet-600 flex items-center justify-center text-xs group-hover:bg-violet-500 group-hover:text-white transition-all shrink-0">
                                                <i class="fas fa-store"></i>
                                            </div>
                                            <span class="text-[11px] font-bold text-slate-500 whitespace-nowrap">
                                                <?= date('d M Y', strtotime($log->activity_date)) ?>
                                            </span>
                                        </div>
                                        <span class="shrink-0 px-2 py-0.5 rounded text-[10px] font-black uppercase <?= $badgeClasses[$log->status] ?? 'bg-slate-100 text-slate-600' ?>">
                                            <?= $log->status ?>
                                        </span>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800 group-hover:text-sky-600 transition-colors truncate"><?= esc($log->activity_category) ?></h4>
                                    <p class="text-[11px] text-slate-500 mt-1 italic">Klik untuk melihat detail kegiatan...</p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Tab: Milestone -->
                    <div x-show="activeTab === 'milestone'" class="p-4 sm:p-6" style="display:none;">
                        <?php if (empty($milestoneReports)): ?>
                            <div class="py-8 text-center text-slate-400">
                                <i class="fas fa-file-invoice text-3xl mb-2 opacity-20"></i>
                                <p class="text-sm">Belum ada laporan milestone yang diunggah</p>
                            </div>
                        <?php else: ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <?php
                                $reportTypes = [
                                    'kemajuan' => ['title' => 'Laporan Kemajuan', 'icon' => 'fa-tasks',        'color' => 'amber'],
                                    'akhir'    => ['title' => 'Laporan Akhir',    'icon' => 'fa-check-double', 'color' => 'emerald'],
                                ];
                                ?>
                                <?php foreach (['kemajuan', 'akhir'] as $type): ?>
                                    <?php
                                    $report = array_filter($milestoneReports, fn($r) => $r['type'] === $type);
                                    $report = !empty($report) ? array_values($report)[0] : null;
                                    $cfg    = $reportTypes[$type];
                                    ?>
                                    <div class="p-4 rounded-2xl border <?= $report ? 'bg-white border-slate-200 shadow-sm' : 'bg-slate-50 border-slate-100 border-dashed' ?>">
                                        <div class="flex items-center justify-between gap-2 mb-4">
                                            <div class="flex items-center gap-3 min-w-0">
                                                <div class="w-10 h-10 rounded-xl bg-<?= $cfg['color'] ?>-100 text-<?= $cfg['color'] ?>-600 flex items-center justify-center shrink-0">
                                                    <i class="fas <?= $cfg['icon'] ?>"></i>
                                                </div>
                                                <div class="min-w-0">
                                                    <h4 class="text-sm font-bold text-slate-800 truncate"><?= $cfg['title'] ?></h4>
                                                    <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Status Laporan</p>
                                                </div>
                                            </div>
                                            <?php if ($report): ?>
                                                <?php
                                                $ss = ['pending' => 'bg-amber-100 text-amber-700', 'approved' => 'bg-emerald-100 text-emerald-700', 'rejected' => 'bg-rose-100 text-rose-700'];
                                                ?>
                                                <span class="shrink-0 px-2 py-0.5 rounded text-[10px] font-black uppercase <?= $ss[$report['status']] ?? 'bg-slate-100 text-slate-600' ?>">
                                                    <?= $report['status'] ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="shrink-0 px-2 py-0.5 rounded bg-slate-100 text-slate-400 text-[10px] font-black uppercase">Belum Ada</span>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ($report): ?>
                                            <div class="space-y-3">
                                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                                    <p class="text-[10px] text-slate-400 font-bold uppercase mb-1">Catatan Mahasiswa</p>
                                                    <p class="text-xs text-slate-600 italic"><?= esc($report['notes'] ?: 'Tidak ada catatan') ?></p>
                                                </div>
                                                <?php if ($report['dosen_note']): ?>
                                                    <div class="p-3 rounded-xl bg-violet-50 border border-violet-100">
                                                        <p class="text-[10px] text-violet-400 font-bold uppercase mb-1">Catatan Dosen</p>
                                                        <p class="text-xs text-violet-600"><?= esc($report['dosen_note']) ?></p>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="flex items-center justify-between gap-2 pt-2 flex-wrap">
                                                    <p class="text-[10px] text-slate-400 whitespace-nowrap">
                                                        <i class="far fa-clock mr-1"></i>
                                                        <?= date('d M Y H:i', strtotime($report['created_at'])) ?>
                                                    </p>
                                                    <a href="<?= base_url('admin/milestone/view/' . $report['id']) ?>"
                                                       target="_blank"
                                                       class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-600 hover:text-white transition-all text-[11px] font-bold whitespace-nowrap">
                                                        <i class="fas fa-file-pdf"></i>
                                                        Lihat PDF
                                                    </a>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="py-6 text-center">
                                                <p class="text-[11px] text-slate-400 italic">Laporan belum diunggah oleh mahasiswa</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT / SIDEBAR COLUMN -->
        <div class="space-y-6 min-w-0">

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
                        <div class="min-w-0">
                            <p class="font-semibold text-slate-800 truncate"><?= esc($proposal['dosen_nama']) ?></p>
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
                        <div class="min-w-0">
                            <p class="font-semibold text-slate-800 truncate"><?= esc($proposal['mentor_nama']) ?></p>
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
                            <p class="text-sm font-bold text-slate-800 truncate"><?= esc($bankAccount->account_holder_name) ?></p>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <p class="text-[10px] text-slate-400 font-bold uppercase">Bank</p>
                            <p class="text-sm font-bold text-slate-800"><?= esc($bankAccount->bank_name) ?></p>
                        </div>
                        <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-100">
                            <p class="text-[10px] text-emerald-500 font-bold uppercase">No. Rekening</p>
                            <p class="text-base font-mono font-bold text-emerald-700 break-all"><?= esc($bankAccount->account_number) ?></p>
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
                    <div class="flex justify-between gap-2">
                        <span class="text-slate-500 shrink-0">Kategori</span>
                        <span class="font-semibold text-slate-800 text-right truncate"><?= esc($proposal['kategori_wirausaha'] ?? '-') ?></span>
                    </div>
                    <div class="flex justify-between gap-2">
                        <span class="text-slate-500 shrink-0">Bidang Usaha</span>
                        <span class="font-semibold text-slate-800 text-right truncate"><?= esc($proposal['kategori_usaha'] ?? '-') ?></span>
                    </div>
                    <div class="flex justify-between gap-2">
                        <span class="text-slate-500 shrink-0">Total RAB</span>
                        <span class="font-semibold text-sky-600 text-right">Rp <?= number_format($proposal['total_rab'] ?? 0, 0, ',', '.') ?></span>
                    </div>
                    <div class="flex justify-between gap-2">
                        <span class="text-slate-500 shrink-0">ID Proposal</span>
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
                        <i class="fas fa-file-alt w-5 shrink-0 text-center"></i>
                        <span class="text-sm font-medium">Detail Proposal</span>
                    </a>
                    <a href="<?= base_url('admin/pitching-desk/' . $proposal['id']) ?>"
                       class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 hover:bg-sky-50 text-slate-600 hover:text-sky-600 transition-colors">
                        <i class="fas fa-chalkboard w-5 shrink-0 text-center"></i>
                        <span class="text-sm font-medium">Pitching Desk</span>
                    </a>
                    <a href="<?= base_url('admin/perjanjian/' . $proposal['id']) ?>"
                       class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 hover:bg-sky-50 text-slate-600 hover:text-sky-600 transition-colors">
                        <i class="fas fa-handshake w-5 shrink-0 text-center"></i>
                        <span class="text-sm font-medium">Perjanjian</span>
                    </a>
                    <a href="<?= base_url('admin/implementasi/' . $proposal['id']) ?>"
                       class="flex items-center gap-3 p-3 rounded-lg bg-slate-50 hover:bg-sky-50 text-slate-600 hover:text-sky-600 transition-colors">
                        <i class="fas fa-cubes w-5 shrink-0 text-center"></i>
                        <span class="text-sm font-medium">Implementasi</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- LOG DETAIL MODAL -->
    <div class="fixed inset-0 z-[100] flex items-end sm:items-center justify-center p-0 sm:p-6"
         x-show="showLogModal"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="showLogModal = false"></div>

        <div class="relative w-full sm:max-w-2xl bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl overflow-hidden max-h-[92dvh] sm:max-h-[90vh] flex flex-col">

            <!-- Drag handle (mobile) -->
            <div class="sm:hidden w-10 h-1 bg-slate-200 rounded-full mx-auto mt-3 mb-1 shrink-0"></div>

            <!-- Modal Header -->
            <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between bg-linear-to-r from-slate-50 to-white shrink-0">
                <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl flex items-center justify-center text-lg sm:text-xl shadow-sm shrink-0"
                         :class="selectedLog.type === 'bimbingan' ? 'bg-amber-100 text-amber-600' :
                                 (selectedLog.type === 'mentoring' ? 'bg-emerald-100 text-emerald-600' : 'bg-violet-100 text-violet-600')">
                        <i class="fas" :class="selectedLog.type === 'bimbingan' ? 'fa-chalkboard-teacher' :
                                              (selectedLog.type === 'mentoring' ? 'fa-user-tie' : 'fa-store')"></i>
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-base sm:text-lg font-black text-slate-800 leading-tight uppercase tracking-tight truncate" x-text="selectedLog.log_title || 'Detail Logbook'"></h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider" x-text="selectedLog.log_subtitle || 'Rincian Pelaksanaan'"></p>
                        <template x-if="selectedLog.submitted_at">
                            <p class="text-[9px] text-emerald-600 font-black uppercase tracking-tighter mt-1">
                                <i class="fas fa-paper-plane mr-1 text-[8px]"></i>
                                Dikirim: <span x-text="new Date(selectedLog.submitted_at).toLocaleString('id-ID', {day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit'})"></span>
                            </p>
                        </template>
                    </div>
                </div>
                <button @click="showLogModal = false" class="w-9 h-9 flex items-center justify-center rounded-xl hover:bg-slate-100 text-slate-400 transition-colors shrink-0 ml-2">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="flex-1 overflow-y-auto p-5 sm:p-6 space-y-5 custom-scrollbar">

                <!-- Status -->
                <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Status Verifikasi</span>
                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase shadow-sm"
                          :class="selectedLog.status === 'approved' ? 'bg-emerald-500 text-white' :
                                  (selectedLog.status === 'pending' ? 'bg-amber-500 text-white' : 'bg-slate-200 text-slate-500')"
                          x-text="selectedLog.status || 'Draft'"></span>
                </div>

                <!-- Schedule Info -->
                <template x-if="selectedLog.type === 'bimbingan' || selectedLog.type === 'mentoring' || selectedLog.type === 'kegiatan'">
                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="h-1 w-8 rounded-full bg-sky-500"></span>
                            <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Informasi Jadwal</h4>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="p-4 rounded-2xl bg-white border border-slate-100 shadow-sm">
                                <p class="text-[9px] text-slate-400 font-bold uppercase mb-1">Tanggal Sesi</p>
                                <p class="text-sm font-bold text-slate-700" x-text="selectedLog.schedule_date || selectedLog.activity_date || '-'"></p>
                            </div>
                            <div class="p-4 rounded-2xl bg-white border border-slate-100 shadow-sm">
                                <p class="text-[9px] text-slate-400 font-bold uppercase mb-1"
                                   x-text="selectedLog.type === 'kegiatan' ? 'Lokasi Rencana' : 'Deadline Pengisian'"></p>
                                <p class="text-sm font-bold break-words"
                                   :class="selectedLog.type === 'kegiatan' ? 'text-slate-700' : 'text-rose-500'"
                                   x-text="selectedLog.type === 'kegiatan' ? (selectedLog.schedule_location || '-') : (selectedLog.deadline_info || '-')"></p>
                            </div>
                        </div>
                        <div class="p-4 rounded-2xl bg-white border border-slate-100 shadow-sm">
                            <p class="text-[9px] text-slate-400 font-bold uppercase mb-1"
                               x-text="selectedLog.type === 'kegiatan' ? 'Rencana Kegiatan' : 'Topik yang Dijadwalkan'"></p>
                            <p class="text-sm font-bold text-slate-700" x-text="selectedLog.topic || selectedLog.activity_category || 'Bimbingan Rutin'"></p>
                            <p class="text-[11px] text-slate-500 mt-2 italic"
                               x-text="selectedLog.schedule_description || 'Tidak ada penjelasan tambahan dari penjadwal'"></p>
                        </div>
                    </div>
                </template>

                <!-- Student Submission -->
                <div class="space-y-4" x-show="selectedLog.logbook_id">
                    <div class="flex items-center gap-2">
                        <span class="h-1 w-8 rounded-full bg-emerald-500"></span>
                        <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Laporan Mahasiswa</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <!-- Main Report Content -->
                            <div class="p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100">
                                <p class="text-[9px] text-emerald-600 font-bold uppercase mb-2"
                                   x-text="selectedLog.type === 'kegiatan' ? 'Uraian Kegiatan' : 'Penjelasan Materi'"></p>
                                <div class="text-[13px] text-slate-700 leading-relaxed italic border-l-4 border-emerald-400 pl-3 py-1"
                                     x-text="selectedLog.material_explanation || selectedLog.activity_description || 'Tidak ada uraian laporan'"></div>

                                <template x-if="selectedLog.video_url">
                                    <div class="mt-4">
                                        <a :href="selectedLog.video_url" target="_blank"
                                           class="flex items-center gap-2 p-2.5 rounded-xl border border-rose-100 bg-rose-50 text-rose-600 hover:bg-rose-100 transition-all group w-full">
                                            <i class="fab fa-youtube text-lg"></i>
                                            <span class="text-[10px] font-black uppercase tracking-wider">Tonton Video Rekaman</span>
                                            <i class="fas fa-external-link-alt ml-auto text-[10px] opacity-0 group-hover:opacity-100 transition-all"></i>
                                        </a>
                                    </div>
                                </template>
                            </div>

                            <!-- Expenses / Items (Only for Guidance/Mentoring) -->
                            <template x-if="selectedLog.type !== 'kegiatan' && (selectedLog.nota_items && selectedLog.nota_items.length > 0)">
                                <div class="rounded-2xl border border-slate-100 overflow-hidden shadow-sm bg-white">
                                    <table class="w-full text-left border-collapse">
                                        <thead class="bg-slate-50">
                                            <tr>
                                                <th class="px-3 py-2 text-[9px] font-black uppercase text-slate-500 tracking-wider">Item</th>
                                                <th class="px-3 py-2 text-[9px] font-black uppercase text-slate-500 tracking-wider text-right">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-50">
                                            <template x-for="(item, idx) in selectedLog.nota_items" :key="idx">
                                                <tr class="hover:bg-slate-50/50 transition-colors">
                                                    <td class="px-3 py-2 text-[11px] font-medium text-slate-700">
                                                        <span x-text="item.title"></span>
                                                        <span class="text-[10px] text-slate-400" x-text="' (x' + item.qty + ')'"></span>
                                                    </td>
                                                    <td class="px-3 py-2 text-[11px] text-slate-700 font-bold text-right"
                                                        x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(item.price)"></td>
                                                </tr>
                                            </template>
                                        </tbody>
                                        <tfoot class="bg-emerald-50/50">
                                            <tr>
                                                <td class="px-3 py-2 text-[10px] font-black text-emerald-700 uppercase">Total</td>
                                                <td class="px-3 py-2 text-xs font-black text-emerald-700 text-right"
                                                    x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(selectedLog.nominal_konsumsi || 0)"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </template>

                            <!-- Nota Files -->
                            <template x-if="selectedLog.type !== 'kegiatan' && ((selectedLog.nota_files && selectedLog.nota_files.length > 0) || selectedLog.nota_file)">
                                <div class="grid grid-cols-1 gap-2">
                                    <template x-if="selectedLog.nota_files && selectedLog.nota_files.length > 0">
                                        <template x-for="(file, idx) in selectedLog.nota_files" :key="idx">
                                            <a :href="`<?= base_url('admin/guidance/file/nota') ?>/${selectedLog.logbook_id}?path=${file}`" target="_blank"
                                               class="flex items-center gap-2.5 p-2 rounded-xl border border-emerald-100 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 transition-all group">
                                                <i class="fas fa-file-invoice text-sm opacity-60"></i>
                                                <div class="min-w-0 flex-1">
                                                    <p class="text-[10px] font-black uppercase tracking-tighter" x-text="'Nota Bukti #' + (idx + 1)"></p>
                                                </div>
                                                <i class="fas fa-download text-[10px] mr-1 opacity-0 group-hover:opacity-100 transition-all"></i>
                                            </a>
                                        </template>
                                    </template>
                                    <template x-if="!selectedLog.nota_files && selectedLog.nota_file">
                                        <a :href="`<?= base_url('admin/guidance/file/nota') ?>/${selectedLog.logbook_id}`" target="_blank"
                                           class="flex items-center gap-2.5 p-2 rounded-xl border border-emerald-100 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 transition-all group">
                                            <i class="fas fa-file-invoice text-sm opacity-60"></i>
                                            <p class="text-[10px] font-black uppercase tracking-tighter flex-1">Bukti Nota Pembayaran</p>
                                            <i class="fas fa-download text-[10px] mr-1 opacity-0 group-hover:opacity-100 transition-all"></i>
                                        </a>
                                    </template>
                                </div>
                            </template>
                        </div>

                        <div class="space-y-4">
                            <!-- Activity Photo -->
                            <template x-if="selectedLog.photo_activity">
                                <div class="space-y-2">
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest pl-1">Dokumentasi Kegiatan</p>
                                    <div class="aspect-video rounded-2xl overflow-hidden border-2 border-slate-100 bg-slate-50 group relative">
                                        <img :src="selectedLog.type === 'kegiatan' ? `<?= base_url('admin/kegiatan/file/photo') ?>/${selectedLog.logbook_id}` : `<?= base_url('admin/guidance/file/photo') ?>/${selectedLog.logbook_id}`"
                                             class="w-full h-full object-cover">
                                        <a :href="selectedLog.type === 'kegiatan' ? `<?= base_url('admin/kegiatan/file/photo') ?>/${selectedLog.logbook_id}` : `<?= base_url('admin/guidance/file/photo') ?>/${selectedLog.logbook_id}`"
                                           target="_blank"
                                           class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                            <i class="fas fa-expand text-xl"></i>
                                        </a>
                                    </div>
                                </div>
                            </template>

                            <!-- Assignment File -->
                            <template x-if="selectedLog.assignment_file">
                                <div class="space-y-2">
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest pl-1">Tugas / Output</p>
                                    <a :href="`<?= base_url('admin/guidance/file/assignment') ?>/${selectedLog.logbook_id}`" target="_blank"
                                       class="flex items-center gap-3 p-3 rounded-xl border border-sky-100 bg-sky-50 text-sky-600 hover:bg-sky-100 transition-all group w-full">
                                        <i class="fas fa-file-lines text-xl"></i>
                                        <div class="min-w-0">
                                            <p class="text-[10px] font-black uppercase tracking-wider">Berkas Tugas Bimbingan</p>
                                            <p class="text-[8px] text-sky-500 font-bold truncate">Klik untuk mengunduh</p>
                                        </div>
                                        <i class="fas fa-download ml-auto opacity-0 group-hover:opacity-100 transition-all"></i>
                                    </a>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Empty State (No Logbook) -->
                <div x-show="!selectedLog.logbook_id" class="p-8 text-center bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                    <i class="fas fa-clock text-4xl text-slate-200 mb-3"></i>
                    <p class="text-sm font-bold text-slate-400">Belum ada laporan dari mahasiswa</p>
                    <p class="text-[11px] text-slate-300 mt-1 uppercase tracking-widest">Menunggu pengisian logbook...</p>
                </div>

                <!-- Verification Feedback -->
                <template x-if="selectedLog.lecturer_catatan || selectedLog.catatan">
                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="h-1 w-8 rounded-full bg-violet-500"></span>
                            <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Catatan Verifikasi</h4>
                        </div>
                        <div class="p-4 rounded-2xl bg-violet-50 border border-violet-100">
                            <p class="text-xs text-violet-700 leading-relaxed italic" x-text="selectedLog.lecturer_catatan || selectedLog.catatan"></p>
                            <div class="flex items-center justify-end gap-2 mt-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-violet-300"></span>
                                <p class="text-[9px] text-violet-400 font-black uppercase tracking-tighter">Diverifikasi oleh Pembimbing/Mentor</p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Modal Footer -->
            <div class="p-5 sm:p-6 border-t border-slate-100 bg-slate-50 flex justify-end shrink-0">
                <button @click="showLogModal = false"
                        class="px-6 py-2.5 rounded-xl bg-white border border-slate-200 text-sm font-bold text-slate-600 hover:bg-slate-100 transition-all shadow-sm">
                    Tutup Detail
                </button>
            </div>
        </div>
    </div>

</div>