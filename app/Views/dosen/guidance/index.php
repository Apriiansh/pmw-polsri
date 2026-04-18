<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="{
    showScheduleModal: false,
    showVerifyModal: false,
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
                Manajemen <span class="text-gradient">Bimbingan</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap 7 - Penjadwalan, Monitoring, dan Verifikasi Logbook Mahasiswa</p>
        </div>
        <button @click="showScheduleModal = true" class="btn-primary">
            <i class="fas fa-calendar-plus mr-2"></i> Buat Jadwal
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
            ['title' => 'Total Jadwal', 'value' => $statsData['total'], 'icon' => 'fa-calendar-alt', 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500'],
            ['title' => 'Terencana', 'value' => $statsData['planned'], 'icon' => 'fa-clock', 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500'],
            ['title' => 'Berjalan', 'value' => $statsData['ongoing'], 'icon' => 'fa-spinner', 'bg' => 'bg-blue-50', 'icon_color' => 'text-blue-500'],
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
                <h3 class="font-display text-base font-bold text-(--text-heading) mb-4 border-b border-sky-50 pb-3 flex items-center">
                    <i class="fas fa-users-viewfinder mr-2.5 text-sky-500"></i>
                    Tim Bimbingan Anda
                </h3>
                <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                    <?php if (empty($teams)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-user-slash text-3xl text-slate-200 mb-2"></i>
                            <p class="text-xs text-slate-400">Belum ada tim yang ditugaskan.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($teams as $team): ?>
                        <div class="p-3 rounded-xl border border-slate-100 hover:border-sky-200 hover:bg-sky-50/30 transition-all group cursor-default">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-[13px] font-bold text-(--text-heading) group-hover:text-sky-600 transition-colors uppercase"><?= esc($team['nama_usaha']) ?></h4>
                                    <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1 italic border-l-2 border-sky-200 pl-2 ml-1">"<?= esc($team['kategori_wirausaha']) ?>"</p>
                                </div>
                                <span class="pmw-status bg-sky-50 text-sky-600 border-sky-200 text-[9px]">AKTIF</span>
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
                <div class="px-6 py-4 border-b border-sky-50 flex items-center justify-between bg-white/60">
                    <h3 class="font-display text-base font-bold text-(--text-heading)">Riwayat Bimbingan</h3>
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
                                            <p class="text-sm">Belum ada jadwal bimbingan yang dibuat.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($schedules as $schedule): ?>
                                <tr class="group">
                                    <td class="whitespace-nowrap">
                                        <div class="text-[12px] font-bold text-(--text-heading)"><?= date('d M Y', strtotime($schedule->schedule_date)) ?></div>
                                        <div class="text-[11px] text-slate-400"><?= $schedule->schedule_time ?> • <?= esc($schedule->team_name) ?></div>
                                    </td>
                                    <td>
                                        <div class="text-[12px] text-slate-600 line-clamp-1 max-w-[150px]" title="<?= esc($schedule->topic) ?>"><?= esc($schedule->topic) ?></div>
                                    </td>
                                    <td>
                                        <?php if ($schedule->logbook): ?>
                                            <div class="flex items-center gap-1.5">
                                                <span class="pmw-status bg-blue-50 text-blue-600 border-blue-200 text-[10px]">Submitted</span>
                                                <?php if($schedule->logbook->status === 'pending'): ?>
                                                    <span class="animate-pulse flex h-2 w-2 rounded-full bg-blue-500"></span>
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
                                            'ongoing'   => 'bg-sky-50 text-sky-600 border-sky-200',
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
                                            <button @click="selectedLogbook = <?= htmlspecialchars(json_encode($lb)) ?>; selectedLogbook.schedule = <?= htmlspecialchars(json_encode(['date' => $schedule->schedule_date, 'team' => $schedule->team_name, 'topic' => $schedule->topic])) ?>; showVerifyModal = true" 
                                                    class="btn-outline btn-xs bg-sky-50 text-sky-600 border-sky-200 hover:bg-sky-500 hover:text-white transition-all">
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
            <div class="p-6 border-b border-sky-50 flex justify-between items-center bg-sky-50/30">
                <h3 class="font-display text-lg font-black text-sky-900 uppercase">Buat Jadwal Bimbingan</h3>
                <button @click="showScheduleModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <form action="<?= base_url('dosen/bimbingan/schedule') ?>" method="POST" class="p-6 space-y-4">
                <?= csrf_field() ?>
                
                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest pl-1">Pilih Tim</label>
                    <select name="proposal_id" class="input-modern w-full" required>
                        <option value="">-- Pilih Tim Bimbingan --</option>
                        <?php foreach($teams as $team): ?>
                            <option value="<?= $team['id'] ?>"><?= esc($team['nama_usaha']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest pl-1">Tanggal</label>
                        <input type="date" name="schedule_date" class="input-modern w-full" required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest pl-1">Waktu</label>
                        <input type="time" name="schedule_time" class="input-modern w-full" required>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest pl-1">Topik Bimbingan</label>
                    <textarea name="topic" rows="3" class="input-modern w-full" placeholder="Contoh: Pembahasan Strategi Pemasaran Digital & Finansial" required></textarea>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showScheduleModal = false" class="btn-outline flex-1">Batal</button>
                    <button type="submit" class="btn-primary flex-1">Simpan Jadwal</button>
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
            <div class="p-6 border-b border-sky-50 flex justify-between items-center bg-sky-50/30">
                <div>
                    <h3 class="font-display text-lg font-black text-sky-900 uppercase">Review Logbook Bimbingan</h3>
                    <p class="text-[11px] text-slate-500 font-semibold" x-text="selectedLogbook ? `${selectedLogbook.schedule.team} - ${selectedLogbook.schedule.date}` : ''"></p>
                    <template x-if="selectedLogbook && selectedLogbook.submitted_at">
                        <p class="text-[9px] text-sky-600 font-black uppercase tracking-tighter mt-1">
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
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penjelasan Materi</label>
                            <div class="p-4 rounded-xl bg-slate-50 text-[13px] text-slate-700 leading-relaxed italic border-l-4 border-sky-400" x-text="selectedLogbook.material_explanation"></div>
                        </div>
                        
                        <div class="space-y-1.5" x-show="selectedLogbook.video_url">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Video Rekaman (Jika ada)</label>
                            <a :href="selectedLogbook.video_url" target="_blank" class="flex items-center gap-3 p-3 rounded-xl border border-rose-100 bg-rose-50 text-rose-600 hover:bg-rose-100 transition-all group w-full">
                                <i class="fab fa-youtube text-xl"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Tonton Video Bimbingan</span>
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
                                        <a :href="`<?= base_url('dosen/bimbingan/file/nota') ?>/${selectedLogbook.id}?path=${file}`" target="_blank" 
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
                                     <a :href="`<?= base_url('dosen/bimbingan/file/nota') ?>/${selectedLogbook.id}`" target="_blank" 
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
                                <img :src="`<?= base_url('dosen/bimbingan/file/photo') ?>/${selectedLogbook.id}`" class="w-full h-full object-cover">
                                <a :href="`<?= base_url('dosen/bimbingan/file/photo') ?>/${selectedLogbook.id}`" target="_blank" 
                                   class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                    <i class="fas fa-expand text-2xl"></i>
                                </a>
                            </div>
                        </div>

                        <div class="space-y-1.5" x-show="selectedLogbook.assignment_file">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tugas / Output</label>
                            <a :href="`<?= base_url('dosen/bimbingan/file/assignment') ?>/${selectedLogbook.id}`" target="_blank" class="flex items-center gap-3 p-3 rounded-xl border border-sky-100 bg-sky-50 text-sky-600 hover:bg-sky-100 transition-all group w-full">
                                <i class="fas fa-file-lines text-xl"></i>
                                <span class="text-xs font-bold uppercase tracking-wider">Download Berkas Tugas</span>
                                <i class="fas fa-download ml-auto opacity-0 group-hover:opacity-100 transition-all"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <form :action="`<?= base_url('dosen/bimbingan/verify') ?>/${selectedLogbook.id}`" method="POST" class="pt-6 border-t border-slate-100">
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
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Catatan Bimbingan (Wajib jika ditolak)</label>
                            <textarea name="verification_note" rows="3" class="input-modern w-full" placeholder="Masukkan saran atau alasan penolakan..."></textarea>
                        </div>

                        <button type="submit" class="btn-primary w-full py-3 shadow-lg shadow-sky-500/20">
                            Simpan Verifikasi Logbook
                        </button>
                    </div>
                </form>
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
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }
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
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

<?= $this->endSection() ?>
