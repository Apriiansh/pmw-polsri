<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-5 sm:space-y-8" x-data="{
    showVerifyModal: false,
    showTeamModal: false,
    selectedLogbook: null,
    selectedTeam: null,
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    },
    getYoutubeId(url) {
        if (!url) return '';
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length === 11) ? match[2] : null;
    },
    openVerify(logbook) {
        this.selectedLogbook = logbook;
        this.showVerifyModal = true;
        document.body.style.overflow = 'hidden';
    },
    openTeam(team) {
        this.selectedTeam = team;
        this.showTeamModal = true;
        document.body.style.overflow = 'hidden';
    },
    closeVerify() {
        this.showVerifyModal = false;
        document.body.style.overflow = '';
    },
    closeTeam() {
        this.showTeamModal = false;
        document.body.style.overflow = '';
    }
}">

    <!-- =============================================
         PAGE HEADER
         ============================================= -->
    <div class="flex flex-col xs:flex-row xs:items-center xs:justify-between gap-2 animate-stagger">
        <div>
            <h2 class="section-title text-lg sm:text-2xl">
                Verifikasi <span class="text-gradient">Kegiatan Wirausaha</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Review dan verifikasi logbook kegiatan tim bimbingan Anda</p>
        </div>
    </div>


    <!-- =============================================
         STATS — 3-col, collapses to 1-col on xs
         ============================================= -->
    <div class="grid grid-cols-3 gap-3 sm:gap-5 animate-stagger delay-100">
        <?php
        $statItems = [
            ['title' => 'Total Review', 'value' => $stats['total'],    'icon' => 'fa-clipboard-check', 'bg' => 'bg-sky-50',    'icon_color' => 'text-sky-500'],
            ['title' => 'Pending',      'value' => $stats['pending'],  'icon' => 'fa-clock',           'bg' => 'bg-blue-50',   'icon_color' => 'text-blue-500'],
            ['title' => 'Revisi',       'value' => $stats['revision'], 'icon' => 'fa-rotate',          'bg' => 'bg-orange-50', 'icon_color' => 'text-orange-500'],
        ];
        ?>
        <?php foreach ($statItems as $index => $stat): ?>
        <div class="card-premium p-3 sm:p-5 flex items-center gap-2 sm:gap-4"
             @mousemove="handleMouseMove">
            <div class="w-8 h-8 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl <?= $stat['bg'] ?> flex items-center justify-center shrink-0">
                <i class="fas <?= $stat['icon'] ?> text-sm sm:text-xl <?= $stat['icon_color'] ?>"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[9px] sm:text-[11px] font-black text-slate-400 uppercase tracking-wider truncate"><?= $stat['title'] ?></p>
                <h3 class="font-display text-lg sm:text-2xl font-black text-(--text-heading)"><?= $stat['value'] ?></h3>
            </div>
        </div>
        <?php endforeach; ?>
    </div>


    <!-- =============================================
         MAIN GRID
         ============================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-8">

        <!-- ---- MAIN COLUMN ---- -->
        <div class="lg:col-span-2 space-y-6 sm:space-y-8">

            <!-- PENDING LOGBOOKS -->
            <div class="space-y-3 sm:space-y-4 animate-stagger delay-200">
                <div class="flex items-center gap-2 px-1">
                    <h3 class="font-display text-sm sm:text-base font-bold text-(--text-heading) flex items-center gap-2">
                        <i class="fas fa-hourglass-start text-sky-500"></i>
                        Menunggu Verifikasi
                        <span class="text-[10px] bg-sky-100 text-sky-600 px-2 py-0.5 rounded-full font-black">
                            <?= count($pendingLogbooks) ?>
                        </span>
                    </h3>
                </div>

                <?php if (empty($pendingLogbooks)): ?>
                    <div class="card-premium py-10 sm:py-12 text-center" @mousemove="handleMouseMove">
                        <i class="fas fa-calendar-check text-4xl sm:text-5xl mb-3 sm:mb-4 opacity-20 text-slate-400 block"></i>
                        <p class="text-sm font-medium text-slate-400">Bagus! Semua logbook sudah Anda proses.</p>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                        <?php foreach ($pendingLogbooks as $logbook):
                            $statusBadges = [
                                'pending'  => ['text-blue-500',   'Baru Masuk'],
                                'revision' => ['text-orange-500', 'Butuh Revisi'],
                            ];
                            $s = $statusBadges[$logbook->status] ?? ['text-slate-400', $logbook->status];
                        ?>
                        <button type="button"
                                class="card-premium p-4 sm:p-5 group hover:border-sky-300 transition-all cursor-pointer
                                       flex flex-col justify-between text-left w-full"
                                @mousemove="handleMouseMove"
                                @click="openVerify(<?= htmlspecialchars(json_encode($logbook)) ?>)">

                            <div class="space-y-3 sm:space-y-4">
                                <div class="flex justify-between items-start gap-2">
                                    <div class="flex items-center gap-3">
                                        <!-- Date pill -->
                                        <div class="w-10 h-10 rounded-xl bg-sky-50 border border-sky-100
                                                    flex flex-col items-center justify-center shrink-0
                                                    group-hover:bg-sky-500 group-hover:border-sky-500 transition-all duration-300">
                                            <span class="text-[7px] font-black text-sky-400 group-hover:text-sky-100 uppercase leading-none">
                                                <?= date('M', strtotime($logbook->activity_date)) ?>
                                            </span>
                                            <span class="text-xs font-display font-black text-sky-700 group-hover:text-white leading-none mt-0.5">
                                                <?= date('d', strtotime($logbook->activity_date)) ?>
                                            </span>
                                        </div>
                                        <div class="min-w-0">
                                            <span class="text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded
                                                         bg-violet-100 text-violet-700 block w-fit mb-1 truncate max-w-[140px]">
                                                <?= esc($logbook->activity_category) ?>
                                            </span>
                                            <p class="text-[10px] font-bold uppercase tracking-tighter <?= $s[0] ?>"><?= $s[1] ?></p>
                                        </div>
                                    </div>
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-slate-50 flex items-center justify-center
                                                text-slate-300 group-hover:bg-sky-100 group-hover:text-sky-500 transition-all shrink-0">
                                        <i class="fas fa-clipboard-check text-[9px] sm:text-[10px]"></i>
                                    </div>
                                </div>

                                <p class="text-[12px] text-slate-600 line-clamp-3 leading-relaxed text-left">
                                    <?= esc($logbook->activity_description) ?>
                                </p>
                            </div>

                            <div class="mt-4 pt-3 border-t border-slate-50 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                                    <span class="text-[9px] sm:text-[10px] font-black text-slate-400 uppercase tracking-widest">Ready to Review</span>
                                </div>
                                <span class="text-[10px] font-black text-sky-600 uppercase tracking-widest group-hover:translate-x-1 transition-transform">
                                    Buka <i class="fas fa-arrow-right ml-1 text-[9px]"></i>
                                </span>
                            </div>
                        </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>


            <!-- VALIDATION HISTORY -->
            <div class="space-y-3 sm:space-y-4 animate-stagger delay-300 pt-2">
                <div class="flex items-center px-1 border-t border-slate-100 pt-5 sm:pt-6">
                    <h3 class="font-display text-sm sm:text-base font-bold text-(--text-heading) flex items-center gap-2">
                        <i class="fas fa-list-check text-slate-400"></i>
                        Riwayat Verifikasi Anda
                    </h3>
                </div>

                <?php if (empty($historyLogbooks)): ?>
                    <div class="card-premium py-10 sm:py-12 text-center opacity-60" @mousemove="handleMouseMove">
                        <i class="fas fa-box-open text-4xl sm:text-5xl mb-3 sm:mb-4 text-slate-300 block"></i>
                        <p class="text-sm text-slate-400">Belum ada riwayat verifikasi.</p>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                        <?php foreach ($historyLogbooks as $logbook):
                            $statusBadges = [
                                'approved_by_dosen'  => ['bg-violet-50 text-emerald-600',  'Approved'],
                                'approved_by_mentor' => ['bg-green-50 text-green-600',  'Approved Mentor'],
                                'approved'           => ['bg-emerald-50 text-emerald-600', 'Final Approved'],
                            ];
                            $badge = $statusBadges[$logbook->status] ?? ['bg-slate-50 text-slate-600', $logbook->status];
                        ?>
                        <button type="button"
                                class="card-premium p-3 sm:p-4 group hover:bg-slate-50/50 transition-all cursor-pointer
                                       border-dashed border-slate-200 text-left w-full"
                                @mousemove="handleMouseMove"
                                @click="openVerify(<?= htmlspecialchars(json_encode($logbook)) ?>)">

                            <div class="flex items-center justify-between mb-2 sm:mb-3 gap-2">
                                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                                    <div class="text-center px-2 py-1 bg-slate-50 rounded-lg border border-slate-100 shrink-0">
                                        <p class="text-[7px] font-black text-slate-400 uppercase leading-none">
                                            <?= date('M', strtotime($logbook->activity_date)) ?>
                                        </p>
                                        <p class="text-xs font-display font-black text-slate-600 leading-none mt-0.5">
                                            <?= date('d', strtotime($logbook->activity_date)) ?>
                                        </p>
                                    </div>
                                    <div class="min-w-0">
                                        <span class="text-[8px] font-black uppercase tracking-wider px-2 py-0.5 rounded
                                                     bg-slate-100 text-slate-500 block w-fit mb-0.5
                                                     truncate max-w-[120px] sm:max-w-full">
                                            <?= esc($logbook->activity_category) ?>
                                        </span>
                                        <span class="text-[9px] font-black uppercase tracking-tighter <?= $badge[0] ?>">
                                            <?= $badge[1] ?>
                                        </span>
                                    </div>
                                </div>
                                <i class="fas fa-eye text-slate-200 group-hover:text-sky-400 transition-colors shrink-0"></i>
                            </div>

                            <?php if ($logbook->dosen_note): ?>
                            <p class="text-[11px] text-slate-500 italic line-clamp-1 border-l-2 border-slate-200 pl-2">
                                "<?= esc($logbook->dosen_note) ?>"
                            </p>
                            <?php else: ?>
                            <p class="text-[10px] text-slate-300 italic">Tidak ada catatan verifikasi</p>
                            <?php endif; ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div><!-- /main col -->


        <!-- ---- SIDEBAR: Teams ---- -->
        <div class="lg:col-span-1 animate-stagger delay-400">
            <div class="card-premium p-4 sm:p-6" @mousemove="handleMouseMove">
                <h3 class="font-display text-sm sm:text-base font-bold text-(--text-heading) mb-3 sm:mb-4
                           border-b border-sky-50 pb-3 flex items-center gap-2">
                    <i class="fas fa-users-viewfinder text-sky-500"></i>
                    Tim Bimbingan Anda
                </h3>

                <!-- Mobile: horizontal scroll. lg: vertical list -->
                <div class="flex lg:flex-col gap-3 overflow-x-auto pb-2 lg:pb-0 lg:overflow-x-visible
                            lg:max-h-[500px] lg:overflow-y-auto custom-scrollbar -mx-1 px-1">
                    <?php if (empty($proposals)): ?>
                        <div class="text-center py-8 w-full">
                            <i class="fas fa-user-slash text-3xl text-slate-200 mb-2 block"></i>
                            <p class="text-xs text-slate-400">Belum ada tim yang ditugaskan.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($proposals as $team): ?>
                        <button type="button"
                                class="p-3 rounded-xl border border-slate-100 hover:border-sky-200 hover:bg-sky-50/30
                                       transition-all group cursor-pointer text-left
                                       shrink-0 w-56 sm:w-64 lg:w-full"
                                @click="openTeam(<?= htmlspecialchars(json_encode($team)) ?>)">
                            <div class="flex items-start justify-between gap-2">
                                <div class="min-w-0">
                                    <h4 class="text-[12px] sm:text-[13px] font-bold text-(--text-heading) group-hover:text-sky-600 transition-colors uppercase truncate">
                                        <?= esc($team['nama_usaha']) ?>
                                    </h4>
                                    <p class="text-[10px] sm:text-[11px] text-slate-500 mt-0.5 line-clamp-1 italic border-l-2 border-sky-200 pl-2 ml-1">
                                        "<?= esc($team['kategori_wirausaha']) ?>"
                                    </p>
                                </div>
                                <div class="flex flex-col items-end gap-1 shrink-0">
                                    <span class="pmw-status bg-sky-50 text-sky-600 border-sky-200 text-[9px]">AKTIF</span>
                                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter group-hover:text-sky-500 transition-colors whitespace-nowrap">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </span>
                                </div>
                            </div>
                        </button>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div><!-- /main grid -->


    <!-- =============================================
         VERIFY MODAL — split panel
         Mobile: stacked sheet. md+: side-by-side dialog
         ============================================= -->
    <div x-show="showVerifyModal"
         class="fixed inset-0 z-50 flex items-end sm:items-center justify-center
                bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="closeVerify()"
         style="display: none;">

        <div class="absolute inset-0" @click="closeVerify()"></div>

        <!-- Modal shell -->
        <div class="modal-sheet card-premium bg-white shadow-2xl animate-modal
                    relative w-full
                    sm:max-w-5xl sm:mx-4
                    flex flex-col md:flex-row
                    max-h-[92dvh] sm:max-h-[90vh]
                    rounded-t-3xl sm:rounded-3xl overflow-hidden">

            <!-- Drag handle (mobile) -->
            <div class="flex justify-center pt-3 pb-1 sm:hidden shrink-0 md:hidden">
                <div class="w-10 h-1 bg-slate-200 rounded-full"></div>
            </div>

            <!-- ---- LEFT: Content & Evidence ---- -->
            <div class="flex-1 flex flex-col min-w-0 border-b md:border-b-0 md:border-r border-slate-100
                        overflow-hidden">

                <!-- Header — sticky -->
                <div class="px-4 sm:px-5 py-3.5 sm:py-4 border-b border-sky-50 bg-sky-50/50
                            flex justify-between items-center shrink-0
                            sticky top-0 z-20 backdrop-blur-md">
                    <div class="min-w-0 pr-3">
                        <div class="flex items-center gap-2 mb-0.5 flex-wrap">
                            <span class="text-[8px] sm:text-[9px] font-black uppercase tracking-widest
                                         px-2 py-0.5 rounded bg-sky-500 text-white"
                                  x-text="selectedLogbook?.activity_category"></span>
                            <span class="text-[8px] sm:text-[9px] font-black uppercase tracking-widest
                                         px-2 py-0.5 rounded bg-amber-400 text-amber-900 border border-amber-300"
                                  x-text="selectedLogbook?.nama_usaha"></span>
                            <span class="text-[8px] sm:text-[9px] font-black text-slate-400 uppercase tracking-widest"
                                  x-text="selectedLogbook ? new Date(selectedLogbook.activity_date).toLocaleDateString('id-ID', {day:'numeric', month:'long', year:'numeric'}) : ''"></span>
                        </div>
                        <h3 class="font-display text-sm sm:text-base font-black text-sky-900 uppercase leading-tight">
                            Review Logbook
                        </h3>
                    </div>
                    <button @click="closeVerify()"
                            class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center
                                   text-slate-400 hover:text-rose-500 hover:bg-rose-50 transition-colors shrink-0">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>

                <!-- Scrollable body -->
                <div class="overflow-y-auto overscroll-contain flex-1 p-4 sm:p-6 space-y-5 sm:space-y-6 custom-scrollbar">

                    <!-- Description -->
                    <div class="space-y-1.5">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <i class="fas fa-quote-left text-sky-400"></i> Penjelasan Mahasiswa
                        </p>
                        <div class="p-3 sm:p-4 rounded-2xl bg-slate-50 border border-slate-100
                                    text-[13px] text-slate-700 leading-relaxed shadow-inner"
                             x-text="selectedLogbook?.activity_description"></div>
                    </div>

                    <!-- Media -->
                    <div x-show="selectedLogbook?.photo_supervisor_visit || selectedLogbook?.video_url">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Media Dokumentasi</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            <!-- Foto Kunjungan -->
                            <div class="space-y-1.5" x-show="selectedLogbook?.photo_supervisor_visit">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Foto Kunjungan Dosen</p>
                                <div class="aspect-video rounded-xl overflow-hidden border border-slate-100 bg-slate-50 relative shadow-sm">
                                    <template x-if="selectedLogbook?.id">
                                        <img :src="`<?= base_url('dosen/kegiatan/file/supervisor') ?>/${selectedLogbook.id}`"
                                             class="w-full h-full object-cover">
                                    </template>
                                </div>
                            </div>

                            <!-- YouTube -->
                            <div class="space-y-1.5"
                                 x-show="selectedLogbook?.video_url && (selectedLogbook.video_url.includes('youtube.com') || selectedLogbook.video_url.includes('youtu.be'))">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Video YouTube</p>
                                <div class="aspect-video rounded-xl overflow-hidden border border-slate-100 bg-slate-50 shadow-sm">
                                    <iframe class="w-full h-full"
                                        :src="`https://www.youtube.com/embed/${getYoutubeId(selectedLogbook?.video_url)}`"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>

                            <!-- GDrive / Other -->
                            <div class="space-y-1.5"
                                 x-show="selectedLogbook?.video_url && !(selectedLogbook.video_url.includes('youtube.com') || selectedLogbook.video_url.includes('youtu.be'))">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Dokumentasi Video</p>
                                <a :href="selectedLogbook?.video_url" target="_blank"
                                   class="aspect-video rounded-xl border-2 border-dashed border-slate-200 bg-slate-50
                                          flex flex-col items-center justify-center gap-2
                                          group hover:border-sky-300 hover:bg-sky-50 transition-all">
                                    <i class="fab fa-google-drive text-3xl text-slate-300 group-hover:text-sky-500 transition-colors"></i>
                                    <span class="text-[11px] font-bold text-slate-500 group-hover:text-sky-700">Buka Link Video</span>
                                    <span class="text-[9px] text-slate-400">Klik untuk membuka</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery -->
                    <div class="space-y-2"
                         x-show="selectedLogbook?.gallery && selectedLogbook.gallery.length > 0">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <i class="fas fa-images text-sky-400"></i> Galeri Foto
                        </p>
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                            <template x-for="photo in selectedLogbook?.gallery" :key="photo.id">
                                <a :href="`<?= base_url('dosen/kegiatan/gallery') ?>/${photo.id}`" target="_blank"
                                   class="aspect-square rounded-xl overflow-hidden border border-slate-100 bg-slate-50 group relative">
                                    <img :src="`<?= base_url('dosen/kegiatan/gallery') ?>/${photo.id}`"
                                         class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                        <i class="fas fa-expand-alt"></i>
                                    </div>
                                </a>
                            </template>
                        </div>
                    </div>

                </div><!-- /left scrollable -->
            </div><!-- /left panel -->


            <!-- ---- RIGHT: Action Panel ---- -->
            <!-- On mobile: rendered below left panel (flex-col).
                 On md+: fixed-width right column (flex-row). -->
            <div class="w-full md:w-[300px] lg:w-[360px] shrink-0 flex flex-col
                        bg-slate-50/50 border-t border-slate-100 md:border-t-0">

                <!-- Right panel header (desktop only) -->
                <div class="hidden md:flex items-center px-5 py-4 border-b border-slate-100 bg-white shrink-0">
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest">Verification Panel</h4>
                </div>

                <!-- Right scrollable content -->
                <div class="overflow-y-auto overscroll-contain flex-1 p-4 sm:p-5 custom-scrollbar">

                    <!-- FORM: pending / revision -->
                    <form x-show="['pending', 'revision'].includes(selectedLogbook?.status)"
                          :action="`<?= base_url('dosen/kegiatan/verify') ?>/${selectedLogbook?.id}`"
                          method="POST"
                          class="space-y-5">
                        <?= csrf_field() ?>

                        <!-- Radio options -->
                        <div class="space-y-2">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest text-center">
                                Status Verifikasi
                            </p>
                            <div class="grid grid-cols-1 gap-2">
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="status" value="approved" class="peer sr-only" required>
                                    <div class="p-3 sm:p-4 rounded-2xl border-2 border-white bg-white shadow-sm text-slate-400
                                                peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-600
                                                transition-all flex items-center gap-3">
                                        <i class="fas fa-check-circle text-lg"></i>
                                        <span class="text-xs sm:text-[13px] font-black uppercase">Approve</span>
                                    </div>
                                </label>
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="status" value="revision" class="peer sr-only">
                                    <div class="p-3 sm:p-4 rounded-2xl border-2 border-white bg-white shadow-sm text-slate-400
                                                peer-checked:border-rose-500 peer-checked:bg-rose-50 peer-checked:text-rose-600
                                                transition-all flex items-center gap-3">
                                        <i class="fas fa-rotate text-lg"></i>
                                        <span class="text-xs sm:text-[13px] font-black uppercase">Revisi</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Catatan -->
                         <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">
                                Catatan <span class="normal-case font-normal text-slate-400">(Opsional)</span>
                            </label>
                        <div class="flex flex-col input-group">
                            <textarea name="dosen_note" rows="3"
                                      class="input-area w-full"
                                      placeholder="Berikan alasan jika revisi..."></textarea>
                        </div>

                        <button type="submit"
                                class="btn-primary w-full py-3.5 sm:py-4 shadow-xl shadow-sky-500/20 text-sm">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Verifikasi
                        </button>
                    </form>

                    <!-- STATUS VIEW: already processed -->
                    <div x-show="!['pending', 'revision'].includes(selectedLogbook?.status)"
                         class="text-center space-y-5 py-4">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-emerald-50 border-4 border-emerald-100
                                    flex items-center justify-center mx-auto">
                            <i class="fas fa-check-double text-xl sm:text-2xl text-emerald-500"></i>
                        </div>
                        <div>
                            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Status Verifikasi</p>
                            <p class="text-slate-800 font-display font-black text-base sm:text-lg uppercase tracking-tighter"
                               x-text="selectedLogbook?.status.replace(/_/g, ' ')"></p>
                        </div>
                        <div class="p-3 sm:p-4 rounded-2xl bg-white border border-slate-100 shadow-sm text-left"
                             x-show="selectedLogbook?.dosen_note">
                            <p class="text-[12px] text-slate-600 italic"
                               x-text="`&quot;${selectedLogbook?.dosen_note}&quot;`"></p>
                        </div>
                        <button @click="closeVerify()" class="btn-outline w-full text-sm">Tutup</button>
                    </div>

                </div><!-- /right scrollable -->
            </div><!-- /right panel -->

        </div><!-- /modal card -->
    </div><!-- /verify modal -->


    <!-- =============================================
         TEAM DETAIL MODAL
         ============================================= -->
    <div x-show="showTeamModal"
         class="fixed inset-0 z-50 flex items-end sm:items-center justify-center
                bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="closeTeam()"
         style="display: none;">

        <div class="absolute inset-0" @click="closeTeam()"></div>

        <div class="modal-sheet card-premium bg-white shadow-2xl animate-modal
                    relative w-full
                    sm:max-w-xl sm:mx-4
                    flex flex-col
                    max-h-[92dvh] sm:max-h-[85vh]
                    rounded-t-3xl sm:rounded-3xl overflow-hidden">

            <!-- Drag handle -->
            <div class="flex justify-center pt-3 pb-1 sm:hidden shrink-0 absolute top-0 left-0 right-0 z-10">
                <div class="w-10 h-1 bg-white/40 rounded-full"></div>
            </div>

            <!-- Header gradient -->
            <div class="px-5 pt-8 sm:pt-5 pb-5
                        bg-linear-to-br from-sky-600 to-sky-500 text-white
                        flex items-start justify-between gap-3 shrink-0">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-white/20 backdrop-blur-md
                                flex items-center justify-center border border-white/20 shrink-0">
                        <i class="fas fa-users-viewfinder text-lg sm:text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <h3 class="font-display text-base sm:text-lg font-black uppercase tracking-wider truncate"
                            x-text="selectedTeam ? selectedTeam.nama_usaha : 'Detail Tim'"></h3>
                        <div class="flex items-center gap-2 mt-0.5 flex-wrap">
                            <span class="text-[9px] text-sky-100 font-bold uppercase tracking-widest"
                               x-text="selectedTeam ? selectedTeam.kategori_usaha : ''"></span>
                            <span class="w-1 h-1 rounded-full bg-sky-300 opacity-50"></span>
                            <span class="text-[9px] text-sky-100 font-bold uppercase tracking-widest"
                               x-text="selectedTeam ? selectedTeam.kategori_wirausaha : ''"></span>
                        </div>
                    </div>
                </div>
                <button @click="closeTeam()"
                        class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/30 transition-all shrink-0">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="overflow-y-auto overscroll-contain flex-1 p-4 sm:p-5 space-y-4 custom-scrollbar">
                <div class="space-y-3">
                    <div class="flex items-center border-b border-slate-100 pb-2">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            Struktur Anggota Tim
                        </h4>
                    </div>

                    <div class="space-y-2">
                        <template x-if="selectedTeam && selectedTeam.members">
                            <template x-for="(member, idx) in selectedTeam.members" :key="idx">
                                <div class="p-3 sm:p-4 rounded-xl sm:rounded-2xl border border-slate-50 bg-slate-50/30
                                            flex items-center gap-3 sm:gap-4 group">

                                    <!-- Avatar -->
                                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-white border border-slate-100
                                                flex items-center justify-center text-sky-600 font-display font-black text-xs shrink-0">
                                        <span x-text="member.nama.substring(0, 2).toUpperCase()"></span>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2 mb-0.5 flex-wrap">
                                            <h5 class="text-xs font-bold text-slate-800 truncate"
                                                x-text="member.nama"></h5>
                                            <span class="px-1.5 py-0.5 rounded text-[8px] font-black uppercase tracking-tighter shrink-0"
                                                  :class="member.role === 'ketua' ? 'bg-rose-50 text-rose-500 border border-rose-100' : 'bg-slate-100 text-slate-400 border border-slate-200'"
                                                  x-text="member.role"></span>
                                        </div>
                                        <p class="text-[10px] text-slate-500 font-medium"
                                           x-text="`${member.nim} • ${member.prodi}`"></p>

                                        <!-- Contact links — always visible on mobile, hover on md+ -->
                                        <div class="flex items-center gap-3 mt-1.5 md:opacity-0 md:group-hover:opacity-100 transition-opacity flex-wrap">
                                            <a :href="`https://wa.me/${member.phone ? member.phone.replace(/[^0-9]/g, '') : ''}`"
                                               target="_blank"
                                               class="flex items-center gap-1 text-[10px] font-black text-emerald-600 hover:text-emerald-700 uppercase">
                                                <i class="fab fa-whatsapp"></i> WhatsApp
                                            </a>
                                            <span class="w-1 h-1 rounded-full bg-slate-200 shrink-0"></span>
                                            <a :href="`mailto:${member.email}`"
                                               class="flex items-center gap-1 text-[10px] font-black text-sky-600 hover:text-sky-700 uppercase">
                                                <i class="fas fa-envelope"></i> Email
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="shrink-0 p-4 sm:p-5 border-t border-slate-50 flex justify-end">
                <button @click="closeTeam()" class="btn-outline text-sm px-8">Tutup</button>
            </div>

        </div>
    </div>

</div><!-- /x-data root -->


<style>
    /* ---- Stagger animation ---- */
    .animate-stagger {
        animation: slideUpFade 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }
    .delay-100 { animation-delay: 0.08s; }
    .delay-200 { animation-delay: 0.16s; }
    .delay-300 { animation-delay: 0.24s; }
    .delay-400 { animation-delay: 0.32s; }

    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ---- Modal animation ---- */
    @keyframes modalIn {
        from { transform: translateY(20px) scale(0.98); opacity: 0; }
        to   { transform: translateY(0) scale(1); opacity: 1; }
    }
    .animate-modal { animation: modalIn 0.3s cubic-bezier(0.16, 1, 0.3, 1); }

    @media (max-width: 639px) {
        @keyframes modalIn {
            from { transform: translateY(100%); }
            to   { transform: translateY(0); }
        }
        .modal-sheet {
            border-bottom-left-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }
    }

    /* ---- Scrollbar ---- */
    .custom-scrollbar::-webkit-scrollbar       { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track  { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb  { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

    /* ---- Safe area (iPhone home bar) ---- */
    .modal-sheet { padding-bottom: env(safe-area-inset-bottom, 0); }
</style>

<?= $this->endSection() ?>