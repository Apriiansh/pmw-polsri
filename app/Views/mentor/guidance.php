<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="{
    showScheduleModal: false,
    showVerifyModal: false,
    showTeamModal: false,
    selectedTeam: null,
    selectedLogbook: null,
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
                Manajemen <span class="text-[--primary]">Mentoring</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Penjadwalan, Monitoring, dan Verifikasi Logbook oleh Mentor Praktisi</p>
        </div>
        <button @click="showScheduleModal = true" class="btn-primary" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
            <i class="fas fa-calendar-plus mr-2"></i> Buat Jadwal Mentoring
        </button>
    </div>

    <!-- ================================================================
         2. STATS OVERVIEW
    ================================================================= -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <?php
        $statsData = [
            'total'     => count($schedules),
            'ongoing'   => count(array_filter($schedules, fn($s) => $s->status === 'ongoing')),
            'completed' => count(array_filter($schedules, fn($s) => $s->status === 'completed')),
            'planned'   => count(array_filter($schedules, fn($s) => $s->status === 'planned')),
        ];
        $statItems = [
            ['title' => 'Total Jadwal', 'value' => $statsData['total'], 'icon' => 'fa-calendar-alt', 'bg' => 'bg-amber-50', 'icon_color' => 'text-amber-500'],
            ['title' => 'Terencana', 'value' => $statsData['planned'], 'icon' => 'fa-clock', 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500'],
            ['title' => 'Berjalan', 'value' => $statsData['ongoing'], 'icon' => 'fa-spinner', 'bg' => 'bg-orange-50', 'icon_color' => 'text-orange-500'],
            ['title' => 'Selesai', 'value' => $statsData['completed'], 'icon' => 'fa-check-circle', 'bg' => 'bg-emerald-50', 'icon_color' => 'text-emerald-500'],
        ];
        ?>
        <?php foreach ($statItems as $index => $stat): ?>
        <div class="card-premium p-3 sm:p-5 flex items-center gap-3 sm:gap-4 animate-stagger delay-<?= ($index + 1) * 100 ?>" @mousemove="handleMouseMove">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl <?= $stat['bg'] ?> flex items-center justify-center shrink-0">
                <i class="fas <?= $stat['icon'] ?> text-lg sm:text-xl <?= $stat['icon_color'] ?>"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] sm:text-[11px] font-black text-slate-400 uppercase tracking-wider truncate"><?= $stat['title'] ?></p>
                <h3 class="font-display text-xl sm:text-2xl font-black text-(--text-heading)"><?= $stat['value'] ?></h3>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- ================================================================
             3. TEAMS LIST (LEFT)
        ================================================================= -->
        <div class="lg:col-span-1 space-y-6 animate-stagger delay-500">
            <div class="card-premium p-6" @mousemove="handleMouseMove">
                <h3 class="font-display text-base font-bold text-(--text-heading) mb-4 border-b border-amber-50 pb-3 flex items-center">
                    <i class="fas fa-users-viewfinder mr-2.5 text-amber-500"></i>
                    Tim Mentoring Anda
                </h3>
                <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                    <?php if (empty($teams)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-user-slash text-3xl text-slate-200 mb-2"></i>
                            <p class="text-xs text-slate-400">Belum ada tim yang ditugaskan.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($teams as $team): ?>
                        <div class="p-3 rounded-xl border border-slate-100 hover:border-amber-200 hover:bg-amber-50/30 transition-all group cursor-pointer"
                             @click="selectedTeam = <?= htmlspecialchars(json_encode($team)) ?>; showTeamModal = true">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-[13px] font-bold text-(--text-heading) group-hover:text-amber-600 transition-colors uppercase"><?= esc($team['nama_usaha']) ?></h4>
                                    <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1 italic border-l-2 border-amber-200 pl-2 ml-1">"<?= esc($team['kategori_wirausaha']) ?>"</p>
                                </div>
                                <div class="flex flex-col items-end gap-1">
                                    <span class="pmw-status bg-amber-50 text-amber-600 border-amber-200 text-[9px]">TIM</span>
                                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter group-hover:text-amber-500 transition-colors">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- ================================================================
             4. SCHEDULES & LOGBOOKS (RIGHT)
        ================================================================= -->
        <div class="lg:col-span-2 space-y-6 animate-stagger delay-700">
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-6 py-4 border-b border-amber-50 flex items-center justify-between bg-white/60">
                    <h3 class="font-display text-base font-bold text-(--text-heading)">Riwayat Mentoring</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="pmw-table">
                        <thead>
                            <tr>
                                <th>Tanggal & Tim</th>
                                <th>Topik</th>
                                <th>Logbook</th>
                                <th>Status</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($schedules)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-12">
                                        <div class="text-slate-400">
                                            <i class="fas fa-calendar-xmark text-4xl mb-3 opacity-20"></i>
                                            <p class="text-sm">Belum ada jadwal mentoring yang dibuat.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($schedules as $schedule): ?>
                                <tr class="group">
                                    <td class="whitespace-nowrap">
                                        <div class="text-[12px] font-bold text-(--text-heading)"><?= date('d M Y', strtotime($schedule->schedule_date)) ?></div>
                                        <div class="text-[11px] text-slate-400"><?= $schedule->schedule_time ?> • <?= esc($schedule->nama_usaha) ?></div>
                                    </td>
                                    <td>
                                        <div class="text-[12px] text-slate-600 line-clamp-1 max-w-[150px]" title="<?= esc($schedule->topic) ?>"><?= esc($schedule->topic) ?></div>
                                    </td>
                                    <td>
                                        <?php if ($schedule->logbook): ?>
                                            <div class="flex items-center gap-1.5">
                                                <span class="pmw-status bg-orange-50 text-orange-600 border-orange-200 text-[10px]">Submitted</span>
                                                <?php if($schedule->logbook->status === 'pending'): ?>
                                                    <span class="animate-pulse flex h-2 w-2 rounded-full bg-orange-500"></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-[11px] text-slate-300 italic">No report yet</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $statusColors = [
                                            'planned'   => 'bg-yellow-50 text-yellow-600 border-yellow-200',
                                            'ongoing'   => 'bg-amber-50 text-amber-600 border-amber-200',
                                            'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                            'cancelled' => 'bg-rose-50 text-rose-600 border-rose-200',
                                        ];
                                        ?>
                                        <span class="pmw-status <?= $statusColors[$schedule->status] ?>"><?= ucfirst($schedule->status) ?></span>
                                    </td>
                                    <td class="text-right whitespace-nowrap">
                                        <?php if ($schedule->logbook && $schedule->logbook->status !== 'draft'): 
                                            $lb = $schedule->logbook;
                                            $lb->parsed_items = json_decode($lb->nota_items ?? '[]', true) ?? [];
                                            $lb->parsed_files = json_decode($lb->nota_files ?? '[]', true) ?? [];
                                        ?>
                                            <button @click="selectedLogbook = <?= htmlspecialchars(json_encode($lb)) ?>; selectedLogbook.schedule = <?= htmlspecialchars(json_encode(['date' => $schedule->schedule_date, 'team' => $schedule->nama_usaha, 'topic' => $schedule->topic])) ?>; showVerifyModal = true" 
                                                    class="btn-outline btn-xs bg-amber-50 text-amber-600 border-amber-200 hover:bg-amber-500 hover:text-white transition-all">
                                                <i class="fas fa-magnifying-glass mr-1"></i> Preview
                                            </button>
                                        <?php elseif ($schedule->logbook && $schedule->logbook->status === 'draft'): ?>
                                            <span class="text-[10px] font-bold text-slate-400 italic">
                                                <i class="fas fa-edit mr-1"></i> Drafting...
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================
         MODALS
    ================================================================= -->

    <!-- Schedule Modal -->
    <div x-show="showScheduleModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        
        <div class="card-premium w-full max-w-lg bg-white shadow-2xl animate-modal" @click.away="showScheduleModal = false">
            <div class="p-6 border-b border-amber-50 flex justify-between items-center bg-amber-50/30">
                <h3 class="font-display text-lg font-black text-amber-900 uppercase">Buat Jadwal Mentoring</h3>
                <button @click="showScheduleModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="<?= base_url('mentor/mentoring/schedule') ?>" method="POST" class="p-6 space-y-6">
                <?= csrf_field() ?>
                
                <div class="form-field">
                    <label class="form-label">Pilih Tim Mahasiswa <span class="required">*</span></label>
                    <div class="input-group bg-white!">
                        <div class="input-icon"><i class="fas fa-users text-amber-500"></i></div>
                        <select name="proposal_id" required>
                            <option value="">-- Pilih Tim --</option>
                            <?php foreach($teams as $team): ?>
                                <option value="<?= $team['id'] ?>"><?= esc($team['nama_usaha']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div class="form-field">
                        <label class="form-label">Tanggal Sesi <span class="required">*</span></label>
                        <div class="input-group bg-white!">
                            <div class="input-icon"><i class="fas fa-calendar-day text-amber-500"></i></div>
                            <input type="date" name="schedule_date" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label class="form-label">Waktu Mulai <span class="required">*</span></label>
                        <div class="input-group bg-white!">
                            <div class="input-icon"><i class="fas fa-clock text-amber-500"></i></div>
                            <input type="time" name="schedule_time" required>
                        </div>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Topik Utama Mentoring <span class="required">*</span></label>
                    <div class="input-group bg-white!">
                        <div class="input-icon"><i class="fas fa-comment-dots text-amber-500"></i></div>
                        <input type="text" name="topic" placeholder="Contoh: Strategi Penetrasi Pasar & Branding Identity" required>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Deadline Pengisian Logbook <span class="required">*</span></label>
                    <div class="input-group bg-white!">
                        <div class="input-icon"><i class="fas fa-hourglass-half text-amber-500"></i></div>
                        <input type="number" name="deadline_days" value="5" min="1" max="30" required>
                        <span class="text-[10px] font-black text-slate-400 uppercase pr-3">Hari</span>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-2 ml-1 italic">Mahasiswa memiliki waktu <span class="font-bold text-amber-600">X hari</span> setelah jadwal selesai untuk mengisi logbook.</p>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showScheduleModal = false" class="btn-outline flex-1 py-3 border-amber-200 text-amber-600 hover:bg-amber-50">Batal</button>
                    <button type="submit" class="btn-primary flex-1 py-3 shadow-lg shadow-amber-500/20" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none;">Buat Jadwal Sesi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Verification Modal -->
    <div x-show="showVerifyModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        
        <div class="card-premium w-full max-w-3xl bg-white shadow-2xl animate-modal overflow-hidden max-h-[90vh] flex flex-col" @click.away="showVerifyModal = false">
            <div class="p-6 border-b border-amber-50 flex justify-between items-center bg-amber-50/30">
                <div>
                    <h3 class="font-display text-lg font-black text-amber-900 uppercase">Review Logbook Mentoring</h3>
                    <p class="text-[11px] text-slate-500 font-semibold" x-text="selectedLogbook ? `${selectedLogbook.schedule.team} - ${selectedLogbook.schedule.date}` : ''"></p>
                    <template x-if="selectedLogbook && selectedLogbook.submitted_at">
                        <p class="text-[9px] text-amber-600 font-black uppercase tracking-tighter mt-1">
                            <i class="fas fa-paper-plane mr-1 text-[8px]"></i>
                            Dikirim: <span x-text="new Date(selectedLogbook.submitted_at).toLocaleString('id-ID', {day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit'})"></span>
                        </p>
                    </template>
                </div>
                <button @click="showVerifyModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="overflow-y-auto p-6 space-y-8 flex-1 custom-scrollbar" x-if="selectedLogbook">
                <!-- Content Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penjelasan Materi Mentoring</label>
                            <div class="p-4 rounded-xl bg-slate-50 text-[13px] text-slate-700 leading-relaxed italic border-l-4 border-amber-400" x-text="selectedLogbook.material_explanation"></div>
                        </div>
                        
                        <div class="space-y-1.5" x-show="selectedLogbook.video_url">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Video Rekaman Mentoring</label>
                            <a :href="selectedLogbook.video_url" target="_blank" class="flex items-center gap-3 p-3 rounded-xl border border-rose-100 bg-rose-50 text-rose-600 hover:bg-rose-100 transition-all group w-full">
                                <i class="fab fa-youtube text-xl"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Tonton Video Mentoring</span>
                                <i class="fas fa-external-link-alt ml-auto opacity-0 group-hover:opacity-100 transition-all"></i>
                            </a>
                        </div>

                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Rincian Nota & Biaya</label>
                            
                            <!-- Items Table -->
                            <div class="rounded-xl border border-slate-100 overflow-hidden shadow-sm bg-white">
                                <table class="w-full text-left border-collapse">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th class="px-3 py-2 text-[9px] font-black uppercase text-slate-500 tracking-wider">Item</th>
                                            <th class="px-3 py-2 text-[9px] font-black uppercase text-slate-500 tracking-wider text-center">Qty</th>
                                            <th class="px-3 py-2 text-[9px] font-black uppercase text-slate-500 tracking-wider text-right">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        <template x-if="selectedLogbook && selectedLogbook.parsed_items.length > 0">
                                            <template x-for="(item, idx) in selectedLogbook.parsed_items" :key="idx">
                                                <tr class="hover:bg-slate-50/50 transition-colors">
                                                    <td class="px-3 py-2 text-[11px] font-medium text-slate-700" x-text="item.title"></td>
                                                    <td class="px-3 py-2 text-[11px] text-slate-500 text-center" x-text="item.qty"></td>
                                                    <td class="px-3 py-2 text-[11px] text-slate-700 font-bold text-right" x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(item.price)"></td>
                                                </tr>
                                            </template>
                                        </template>
                                        <template x-if="!selectedLogbook || selectedLogbook.parsed_items.length === 0">
                                            <tr>
                                                <td colspan="3" class="px-3 py-4 text-[11px] text-slate-400 italic text-center">Tidak ada rincian item.</td>
                                            </tr>
                                        </template>
                                    </tbody>
                                    <tfoot class="bg-emerald-50/50">
                                        <tr>
                                            <td colspan="2" class="px-3 py-2 text-[10px] font-black text-emerald-700 uppercase">Total Keseluruhan</td>
                                            <td class="px-3 py-2 text-[13px] font-black text-emerald-700 text-right" x-text="selectedLogbook ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(selectedLogbook.nominal_konsumsi) : 'Rp 0'"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Multi Files -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                <template x-if="selectedLogbook && selectedLogbook.parsed_files.length > 0">
                                    <template x-for="(file, idx) in selectedLogbook.parsed_files" :key="idx">
                                        <a :href="`<?= base_url('mentor/mentoring/file/nota') ?>/${selectedLogbook.id}?path=${file}`" target="_blank" 
                                           class="flex items-center gap-2.5 p-2 rounded-xl border border-emerald-100 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 transition-all group">
                                            <div class="w-8 h-8 rounded-lg bg-white/60 flex items-center justify-center text-emerald-500">
                                                <i class="fas fa-file-invoice text-sm"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-[10px] font-black uppercase tracking-tighter" x-text="'Nota #' + (idx + 1)"></p>
                                                <p class="text-[8px] text-emerald-600/70 truncate tracking-widest font-bold">BUKTI FISIK</p>
                                            </div>
                                            <i class="fas fa-chevron-right text-[10px] mr-1 opacity-0 group-hover:opacity-100 transition-all"></i>
                                        </a>
                                    </template>
                                </template>
                                <template x-if="selectedLogbook && (!selectedLogbook.parsed_files || selectedLogbook.parsed_files.length === 0) && selectedLogbook.nota_file">
                                     <a :href="`<?= base_url('mentor/mentoring/file/nota') ?>/${selectedLogbook.id}`" target="_blank" 
                                           class="flex items-center gap-2.5 p-2 rounded-xl border border-emerald-100 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 transition-all group">
                                            <div class="w-8 h-8 rounded-lg bg-white/60 flex items-center justify-center text-emerald-500">
                                                <i class="fas fa-file-invoice text-sm"></i>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-[10px] font-black uppercase tracking-tighter">Bukti Nota</p>
                                                <p class="text-[8px] text-emerald-600/70 truncate tracking-widest font-bold">LEGACY FILE</p>
                                            </div>
                                            <i class="fas fa-chevron-right text-[10px] mr-1 opacity-0 group-hover:opacity-100 transition-all"></i>
                                        </a>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Foto Dokumentasi</label>
                            <div class="aspect-video rounded-2xl overflow-hidden border-2 border-slate-100 bg-slate-50 group relative">
                                <img :src="`<?= base_url('mentor/mentoring/file/photo') ?>/${selectedLogbook.id}`" class="w-full h-full object-cover">
                                <a :href="`<?= base_url('mentor/mentoring/file/photo') ?>/${selectedLogbook.id}`" target="_blank" 
                                   class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                    <i class="fas fa-expand text-2xl"></i>
                                </a>
                            </div>
                        </div>

                        <div class="space-y-1.5" x-show="selectedLogbook.assignment_file">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tugas / Draft Dokumen</label>
                            <a :href="`<?= base_url('mentor/mentoring/file/assignment') ?>/${selectedLogbook.id}`" target="_blank" class="flex items-center gap-3 p-3 rounded-xl border border-amber-100 bg-amber-50 text-amber-600 hover:bg-amber-100 transition-all group w-full">
                                <i class="fas fa-file-lines text-xl"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Download Berkas Tugas</span>
                                <i class="fas fa-download ml-auto opacity-0 group-hover:opacity-100 transition-all"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <form :action="`<?= base_url('mentor/mentoring/verify') ?>/${selectedLogbook.id}`" method="POST" class="pt-6 border-t border-slate-100">
                    <?= csrf_field() ?>
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="status" value="approved" class="peer sr-only" required>
                                <div class="p-3 rounded-xl border-2 border-slate-100 bg-slate-50 text-slate-400 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-600 transition-all flex items-center justify-center gap-2">
                                    <i class="fas fa-check-circle"></i>
                                    <span class="text-sm font-bold uppercase tracking-wide">Terima</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="status" value="rejected" class="peer sr-only">
                                <div class="p-3 rounded-xl border-2 border-slate-100 bg-slate-50 text-slate-400 peer-checked:border-rose-500 peer-checked:bg-rose-50 peer-checked:text-rose-600 transition-all flex items-center justify-center gap-2">
                                    <i class="fas fa-times-circle"></i>
                                    <span class="text-sm font-bold uppercase tracking-wide">Tolak / Revisi</span>
                                </div>
                            </label>
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Catatan Mentor (Wajib jika ditolak)</label>
                            <textarea name="verification_note" rows="3" class="input-modern w-full" placeholder="Masukkan saran perbaikan untuk tim mahasiswa..."></textarea>
                        </div>

                        <button type="submit" class="btn-primary w-full py-3 shadow-lg shadow-amber-500/20" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none;">
                            Simpan Verifikasi Logbook
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Team Details Modal -->
    <div x-show="showTeamModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        
        <div class="card-premium w-full max-w-2xl bg-white shadow-2xl animate-modal overflow-hidden max-h-[90vh] flex flex-col" @click.away="showTeamModal = false">
            <div class="p-6 border-b border-amber-50 flex justify-between items-center bg-linear-to-r from-amber-500 to-amber-600 text-white">
                <div>
                    <h3 class="font-display text-lg font-black uppercase tracking-wider" x-text="selectedTeam ? selectedTeam.nama_usaha : 'Detail Tim'"></h3>
                    <p class="text-[10px] text-amber-100 font-bold uppercase tracking-widest mt-0.5" x-text="selectedTeam ? `Kategori: ${selectedTeam.kategori_wirausaha}` : ''"></p>
                </div>
                <button @click="showTeamModal = false" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition-all">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            
            <div class="overflow-y-auto p-6 space-y-6 flex-1 custom-scrollbar">
                <!-- Team Overview -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kategori Usaha</p>
                        <p class="text-sm font-bold text-slate-700 uppercase" x-text="selectedTeam ? selectedTeam.kategori_usaha : '-'"></p>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Dana Disetujui</p>
                        <p class="text-sm font-bold text-emerald-600" x-text="selectedTeam ? new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(selectedTeam.total_rab) : '-'"></p>
                    </div>
                </div>

                <!-- Members List -->
                <div class="space-y-4">
                    <h4 class="font-display text-xs font-black text-slate-400 uppercase tracking-widest flex items-center">
                        <i class="fas fa-users-gear mr-2 text-amber-500"></i>
                        Anggota Tim & Kontak
                    </h4>
                    
                    <div class="grid grid-cols-1 gap-3">
                        <template x-if="selectedTeam && selectedTeam.members">
                            <template x-for="(member, idx) in selectedTeam.members" :key="idx">
                                <div class="group relative p-4 rounded-2xl border border-slate-100 hover:border-amber-200 hover:bg-amber-50/30 transition-all flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-linear-to-tr from-amber-500 to-amber-400 flex items-center justify-center text-white font-display font-black text-sm shrink-0 shadow-lg shadow-amber-200">
                                        <span x-text="member.nama.substring(0, 2).toUpperCase()"></span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <h5 class="text-sm font-bold text-slate-800 truncate" x-text="member.nama"></h5>
                                            <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-tighter"
                                                  :class="member.role === 'ketua' ? 'bg-rose-100 text-rose-600' : 'bg-slate-100 text-slate-500'"
                                                  x-text="member.role"></span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 font-medium" x-text="`${member.nim} • ${member.prodi}`"></p>
                                        
                                        <!-- Contact Actions -->
                                        <div class="flex items-center gap-3 mt-2.5">
                                            <a :href="`https://wa.me/${member.phone.replace(/[^0-9]/g, '')}`" target="_blank" 
                                               class="flex items-center gap-1.5 text-[10px] font-black text-emerald-600 hover:text-emerald-700 transition-colors uppercase tracking-tight">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                                WhatsApp
                                            </a>
                                            <span class="w-1 h-1 rounded-full bg-slate-200"></span>
                                            <a :href="`mailto:${member.email}`" 
                                               class="flex items-center gap-1.5 text-[10px] font-black text-amber-600 hover:text-amber-700 transition-colors uppercase tracking-tight">
                                                <i class="fas fa-envelope text-xs"></i>
                                                Email
                                            </a>
                                        </div>
                                    </div>
                                    <div class="hidden sm:block opacity-0 group-hover:opacity-100 transition-all">
                                        <i class="fas fa-chevron-right text-slate-300"></i>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-slate-50 bg-slate-50/50 flex justify-end">
                <button @click="showTeamModal = false" class="btn-outline px-8!">
                    Tutup
                </button>
            </div>
        </div>
    </div>

</div>

<style>
    .animate-stagger {
        animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-700 { animation-delay: 0.7s; }

    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes modalIn {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .animate-modal {
        animation: modalIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #fcd34d; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #fbbf24; }
</style>

<?= $this->endSection() ?>
