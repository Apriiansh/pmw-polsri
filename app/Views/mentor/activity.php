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
            <p class="section-subtitle text-[10px] sm:text-[11px]">Review dan verifikasi logbook dari Dosen</p>
        </div>
    </div>

    <!-- =============================================
         STATS — 2-col grid, scales to 4-col on lg
         ============================================= -->
    <div class="grid grid-cols-2 gap-3 sm:gap-5 animate-stagger delay-100">
        <?php
        $statItems = [
            ['title' => 'Total Review', 'value' => $stats['total'],   'icon' => 'fa-clipboard-check', 'bg' => 'bg-sky-50',  'icon_color' => 'text-sky-500'],
            ['title' => 'Pending',      'value' => $stats['pending'], 'icon' => 'fa-clock',           'bg' => 'bg-blue-50', 'icon_color' => 'text-blue-500'],
        ];
        ?>
        <?php foreach ($statItems as $index => $stat): ?>
        <div class="card-premium p-3 sm:p-5 flex items-center gap-3 sm:gap-4"
             @mousemove="handleMouseMove">
            <div class="w-9 h-9 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl <?= $stat['bg'] ?> flex items-center justify-center shrink-0">
                <i class="fas <?= $stat['icon'] ?> text-base sm:text-xl <?= $stat['icon_color'] ?>"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[9px] sm:text-[11px] font-black text-slate-400 uppercase tracking-wider truncate"><?= $stat['title'] ?></p>
                <h3 class="font-display text-xl sm:text-2xl font-black text-(--text-heading)"><?= $stat['value'] ?></h3>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- =============================================
         MAIN GRID: logbooks (left) + sidebar (right)
         Stacks vertically on mobile
         ============================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-8">

        <!-- ---- MAIN COLUMN ---- -->
        <div class="lg:col-span-2 space-y-6 sm:space-y-8">

            <!-- PENDING LOGBOOKS -->
            <div class="space-y-3 sm:space-y-4 animate-stagger delay-200">
                <div class="flex items-center justify-between px-1">
                    <h3 class="font-display text-sm sm:text-base font-bold text-(--text-heading) flex items-center gap-2">
                        <i class="fas fa-clock-rotate-left text-sky-500"></i>
                        Menunggu Verifikasi
                        <span class="text-[10px] bg-sky-100 text-sky-600 px-2 py-0.5 rounded-full font-black">
                            <?= count($pendingLogbooks) ?>
                        </span>
                    </h3>
                </div>

                <?php if (empty($pendingLogbooks)): ?>
                    <div class="card-premium py-10 sm:py-12 text-center" @mousemove="handleMouseMove">
                        <i class="fas fa-check-circle text-4xl sm:text-5xl mb-3 sm:mb-4 opacity-20 text-slate-400 block"></i>
                        <p class="text-sm font-medium text-slate-400">Semua beres! Tidak ada verifikasi tertunda.</p>
                        <p class="text-[11px] text-slate-400 mt-1 italic">Logbook muncul di sini setelah disetujui Dosen Pendamping.</p>
                    </div>
                <?php else: ?>
                    <!-- Card-list on mobile, 2-col grid on md+ -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                        <?php foreach ($pendingLogbooks as $logbook): ?>
                        <button type="button"
                                class="card-premium p-4 sm:p-5 group hover:border-sky-300 transition-all cursor-pointer flex flex-col justify-between text-left w-full"
                                @mousemove="handleMouseMove"
                                @click="openVerify(<?= htmlspecialchars(json_encode($logbook)) ?>)">

                            <!-- Card Top -->
                            <div class="space-y-3 sm:space-y-4">
                                <div class="flex justify-between items-start gap-2">
                                    <div class="flex items-center gap-3">
                                        <!-- Date pill -->
                                        <div class="w-10 h-10 rounded-xl bg-sky-50 border border-sky-100 flex flex-col items-center justify-center shrink-0 group-hover:bg-sky-500 group-hover:border-sky-500 transition-all duration-300">
                                            <span class="text-[7px] font-black text-sky-400 group-hover:text-sky-100 uppercase leading-none"><?= date('M', strtotime($logbook->activity_date)) ?></span>
                                            <span class="text-xs font-display font-black text-sky-700 group-hover:text-white leading-none mt-0.5"><?= date('d', strtotime($logbook->activity_date)) ?></span>
                                        </div>
                                        <div class="min-w-0">
                                            <span class="text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded bg-violet-100 text-violet-700 block w-fit mb-1 truncate max-w-[140px]">
                                                <?= esc($logbook->activity_category) ?>
                                            </span>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Approved by Dosen</p>
                                        </div>
                                    </div>
                                    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-300 group-hover:bg-sky-100 group-hover:text-sky-500 transition-all shrink-0">
                                        <i class="fas fa-arrow-right text-[9px]"></i>
                                    </div>
                                </div>

                                <p class="text-[12px] text-slate-600 line-clamp-3 leading-relaxed italic text-left">
                                    "<?= esc($logbook->activity_description) ?>"
                                </p>

                                <?php if ($logbook->dosen_note): ?>
                                <div class="bg-amber-50/50 border-l-2 border-amber-300 p-2 rounded-r-lg">
                                    <p class="text-[9px] font-black text-amber-700 uppercase tracking-widest mb-0.5">Catatan Dosen:</p>
                                    <p class="text-[11px] text-amber-600 italic line-clamp-2"><?= esc($logbook->dosen_note) ?></p>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Card Footer -->
                            <div class="mt-4 pt-3 border-t border-slate-50 flex items-center justify-between">
                                <div class="flex -space-x-1.5">
                                    <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-[7px] text-slate-400">
                                        <i class="fas fa-image"></i>
                                    </div>
                                    <div class="w-5 h-5 sm:w-6 sm:h-6 rounded-full bg-slate-100 border-2 border-white flex items-center justify-center text-[7px] text-slate-400">
                                        <i class="fas fa-video"></i>
                                    </div>
                                </div>
                                <span class="text-[10px] font-black text-sky-500 uppercase tracking-widest group-hover:translate-x-1 transition-transform">
                                    Review <i class="fas fa-chevron-right ml-1 text-[8px]"></i>
                                </span>
                            </div>
                        </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>


            <!-- VALIDATION HISTORY -->
            <div class="space-y-3 sm:space-y-4 animate-stagger delay-300 pt-2">
                <div class="flex items-center justify-between px-1 border-t border-slate-100 pt-5 sm:pt-6">
                    <h3 class="font-display text-sm sm:text-base font-bold text-(--text-heading) flex items-center gap-2">
                        <i class="fas fa-history text-slate-400"></i>
                        Riwayat Validasi
                    </h3>
                </div>

                <?php if (empty($historyLogbooks)): ?>
                    <div class="card-premium py-10 sm:py-12 text-center opacity-60" @mousemove="handleMouseMove">
                        <i class="fas fa-folder-open text-4xl sm:text-5xl mb-3 sm:mb-4 text-slate-300 block"></i>
                        <p class="text-sm text-slate-400">Belum ada riwayat validasi.</p>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                        <?php foreach ($historyLogbooks as $logbook):
                            $statusBadges = [
                                'approved_by_mentor' => ['bg-indigo-50 text-indigo-600',  'Approved Mentor'],
                                'approved'           => ['bg-emerald-50 text-emerald-600', 'Final Approved'],
                                'revision'           => ['bg-rose-50 text-rose-600',       'Revisi'],
                            ];
                            $badge = $statusBadges[$logbook->status] ?? ['bg-slate-50 text-slate-600', $logbook->status];
                        ?>
                        <button type="button"
                                class="card-premium p-3 sm:p-4 group hover:bg-slate-50/50 transition-all cursor-pointer border-dashed border-slate-200 text-left w-full"
                                @mousemove="handleMouseMove"
                                @click="openVerify(<?= htmlspecialchars(json_encode($logbook)) ?>)">

                            <div class="flex items-center justify-between mb-2 sm:mb-3 gap-2">
                                <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                                    <!-- Date -->
                                    <div class="text-center px-2 py-1 bg-slate-50 rounded-lg border border-slate-100 shrink-0">
                                        <p class="text-[7px] font-black text-slate-400 uppercase leading-none"><?= date('M', strtotime($logbook->activity_date)) ?></p>
                                        <p class="text-xs font-display font-black text-slate-600 leading-none mt-0.5"><?= date('d', strtotime($logbook->activity_date)) ?></p>
                                    </div>
                                    <div class="min-w-0">
                                        <span class="text-[8px] font-black uppercase tracking-wider px-2 py-0.5 rounded bg-slate-100 text-slate-500 block w-fit mb-0.5 truncate max-w-[120px] sm:max-w-full">
                                            <?= esc($logbook->activity_category) ?>
                                        </span>
                                        <span class="text-[9px] font-black uppercase tracking-tighter <?= $badge[0] ?>"><?= $badge[1] ?></span>
                                    </div>
                                </div>
                                <i class="fas fa-eye text-slate-200 group-hover:text-sky-400 transition-colors shrink-0"></i>
                            </div>

                            <?php if ($logbook->mentor_note): ?>
                            <p class="text-[11px] text-slate-500 italic line-clamp-1 border-l-2 border-slate-200 pl-2">
                                "<?= esc($logbook->mentor_note) ?>"
                            </p>
                            <?php else: ?>
                            <p class="text-[10px] text-slate-300 italic">Tidak ada catatan</p>
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
                    Tim Mentoring Anda
                </h3>

                <!-- On mobile: horizontal scroll row. On lg: vertical list -->
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
         VERIFY MODAL
         ============================================= -->
    <template x-if="showVerifyModal">
        <div class="fixed inset-0 z-50 flex items-end sm:items-center justify-center bg-slate-900/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             @keydown.escape.window="closeVerify()">

            <!-- Backdrop tap to close -->
            <div class="absolute inset-0" @click="closeVerify()"></div>

            <div class="relative w-full sm:max-w-2xl transform overflow-hidden rounded-t-[2rem] sm:rounded-[2rem] bg-white shadow-2xl transition-all"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-8 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
                
                    <!-- Modal Header -->
                <div class="relative h-36 sm:h-44 bg-linear-to-br from-sky-500 to-indigo-600 p-6 sm:p-8 flex flex-col justify-end">
                    <div class="absolute top-4 right-4">
                        <button @click="closeVerify()" class="w-10 h-10 rounded-full bg-white/20 text-white hover:bg-white/30 backdrop-blur-md flex items-center justify-center transition-all">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="mb-2">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-3 py-1 rounded-full bg-white/20 text-white text-[10px] font-black uppercase tracking-widest backdrop-blur-md border border-white/10" x-text="selectedLogbook.activity_category"></span>
                            <span class="px-3 py-1 rounded-full bg-amber-400 text-amber-900 text-[10px] font-black uppercase tracking-widest border border-amber-300 shadow-sm" x-text="selectedLogbook.nama_usaha"></span>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-black text-white leading-tight">Detail Verifikasi Kegiatan</h3>
                    </div>
                </div>

                <!-- Modal Body — scrollable -->
                <div class="max-h-[70vh] overflow-y-auto p-6 sm:p-8 custom-scrollbar">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                        <!-- Info Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Tanggal Kegiatan</label>
                                <div class="flex items-center gap-2 text-slate-700 font-bold">
                                    <i class="far fa-calendar-alt text-sky-500"></i>
                                    <span x-text="new Date(selectedLogbook.activity_date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })"></span>
                                </div>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Status Saat Ini</label>
                                <div class="flex items-center gap-2">
                                    <template x-if="['approved_by_dosen'].includes(selectedLogbook.status)">
                                        <div class="flex items-center gap-2">
                                            <span class="flex h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                                            <span class="text-[10px] font-black text-amber-600 uppercase">Menunggu Verifikasi Mentor</span>
                                        </div>
                                    </template>
                                    <template x-if="!['approved_by_dosen'].includes(selectedLogbook.status)">
                                        <div class="flex items-center gap-2">
                                            <span class="flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                            <span class="text-[10px] font-black text-emerald-600 uppercase" x-text="selectedLogbook.status.replace(/_/g, ' ')"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <!-- Illustration Column -->
                        <div class="hidden sm:flex items-center justify-end">
                            <div class="w-20 h-20 rounded-3xl bg-sky-50 border border-sky-100 flex items-center justify-center">
                                <i class="fas fa-file-signature text-3xl text-sky-200"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-slate-50 rounded-2xl p-5 mb-8 border border-slate-100">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Deskripsi Kegiatan</label>
                        <p class="text-sm text-slate-600 leading-relaxed italic" x-text="'&quot;' + selectedLogbook.activity_description + '&quot;'"></p>
                    </div>

                    <!-- Media Section -->
                    <div class="space-y-6 mb-8" x-show="selectedLogbook.photo_supervisor_visit || selectedLogbook.video_url || (selectedLogbook.gallery && selectedLogbook.gallery.length > 0)">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Media Dokumentasi</label>
                        
                        <!-- Main Media Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Photo Supervisor -->
                            <template x-if="selectedLogbook.photo_supervisor_visit">
                                <div class="aspect-video rounded-2xl overflow-hidden border border-slate-100 bg-slate-100 relative group shadow-sm">
                                    <img :src="`<?= base_url('mentor/kegiatan/file/supervisor') ?>/${selectedLogbook.id}`" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <a :href="`<?= base_url('mentor/kegiatan/file/supervisor') ?>/${selectedLogbook.id}`" target="_blank" class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center">
                                            <i class="fas fa-expand"></i>
                                        </a>
                                    </div>
                                    <div class="absolute top-2 left-2">
                                        <span class="px-2 py-1 rounded-lg bg-white/20 backdrop-blur-md text-white text-[8px] font-black uppercase">Foto Kunjungan</span>
                                    </div>
                                </div>
                            </template>

                            <!-- Video -->
                            <template x-if="selectedLogbook.video_url">
                                <div class="aspect-video rounded-2xl overflow-hidden border border-slate-100 bg-slate-100 relative group shadow-sm">
                                    <template x-if="getYoutubeId(selectedLogbook.video_url)">
                                        <iframe class="w-full h-full" :src="`https://www.youtube.com/embed/${getYoutubeId(selectedLogbook.video_url)}`" frameborder="0" allowfullscreen></iframe>
                                    </template>
                                    <template x-if="!getYoutubeId(selectedLogbook.video_url)">
                                        <a :href="selectedLogbook.video_url" target="_blank" class="w-full h-full flex flex-col items-center justify-center gap-2 bg-indigo-50 text-indigo-500 hover:bg-indigo-100 transition-colors">
                                            <i class="fab fa-google-drive text-3xl"></i>
                                            <span class="text-[10px] font-black uppercase">Buka Link Dokumentasi</span>
                                        </a>
                                    </template>
                                </div>
                            </template>
                        </div>

                        <!-- Gallery Thumbnails -->
                        <template x-if="selectedLogbook.gallery && selectedLogbook.gallery.length > 0">
                            <div class="grid grid-cols-4 sm:grid-cols-6 gap-2 mt-4">
                                <template x-for="photo in selectedLogbook.gallery" :key="photo.id">
                                    <a :href="`<?= base_url('mentor/kegiatan/gallery') ?>/${photo.id}`" target="_blank" class="aspect-square rounded-xl overflow-hidden border border-slate-100 group">
                                        <img :src="`<?= base_url('mentor/kegiatan/gallery') ?>/${photo.id}`" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </a>
                                </template>
                            </div>
                        </template>
                    </div>

                    <!-- Dosen Feedback -->
                    <template x-if="selectedLogbook.dosen_note">
                        <div class="bg-indigo-50/50 border-l-4 border-indigo-400 p-5 rounded-r-2xl mb-8">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-user-tie text-indigo-500 text-xs"></i>
                                <span class="text-[10px] font-black text-indigo-700 uppercase tracking-widest">Catatan Dosen Pendamping</span>
                            </div>
                            <p class="text-sm text-indigo-600 italic" x-text="selectedLogbook.dosen_note"></p>
                        </div>
                    </template>

                    <!-- Mentor Action Section -->
                    <template x-if="['approved_by_dosen'].includes(selectedLogbook.status)">
                        <form :action="'<?= base_url('mentor/kegiatan/verify/') ?>' + selectedLogbook.id" method="POST" class="space-y-6 pt-4 border-t border-slate-100">
                            <?= csrf_field() ?>
                            <div>
                                <label for="mentor_note" class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 flex items-center gap-2">
                                    <i class="fas fa-comment-dots"></i>
                                    Berikan Catatan atau Feedback (Opsional)
                                </label>
                                <textarea name="mentor_note" id="mentor_note" rows="3" 
                                          class="w-full rounded-2xl border-slate-200 bg-slate-50 text-sm focus:border-sky-500 focus:ring-sky-500/20 transition-all placeholder:text-slate-300"
                                          placeholder="Tuliskan arahan atau masukan Anda untuk tim ini..."></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <button type="submit" name="status" value="revision" 
                                        class="flex items-center justify-center gap-2 px-6 py-4 rounded-2xl bg-slate-100 text-slate-600 font-bold hover:bg-rose-100 hover:text-rose-600 transition-all group">
                                    <i class="fas fa-redo text-xs group-hover:rotate-180 transition-transform duration-500"></i>
                                    Minta Revisi
                                </button>
                                <button type="submit" name="status" value="approved" 
                                        class="flex items-center justify-center gap-2 px-6 py-4 rounded-2xl bg-linear-to-r from-emerald-500 to-teal-600 text-white font-bold shadow-lg shadow-emerald-200 hover:shadow-xl hover:scale-[1.02] transition-all">
                                    <i class="fas fa-check-double"></i>
                                    Verifikasi Sekarang
                                </button>
                            </div>
                        </form>
                    </template>

                    <!-- Mentor Feedback View (for history) -->
                    <template x-if="!['approved_by_dosen'].includes(selectedLogbook.status) && selectedLogbook.mentor_note">
                        <div class="bg-emerald-50/50 border-l-4 border-emerald-400 p-5 rounded-r-2xl mb-4">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-comment-check text-emerald-500 text-xs"></i>
                                <span class="text-[10px] font-black text-emerald-700 uppercase tracking-widest">Catatan Anda (Mentor)</span>
                            </div>
                            <p class="text-sm text-emerald-600 italic" x-text="selectedLogbook.mentor_note"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </template>


    <!-- =============================================
         TEAM DETAIL MODAL
         ============================================= -->
    <template x-if="showTeamModal">
        <div class="fixed inset-0 z-50 flex items-end sm:items-center justify-center bg-slate-900/60 backdrop-blur-sm"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             @keydown.escape.window="closeTeam()">

            <div class="absolute inset-0" @click="closeTeam()"></div>

            <div class="relative w-full sm:max-w-xl transform overflow-hidden rounded-t-[2.5rem] sm:rounded-[2.5rem] bg-white shadow-2xl transition-all"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-8 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">
                
                <!-- Drag handle (mobile) -->
                <div class="flex justify-center pt-3 pb-1 sm:hidden shrink-0 absolute top-0 left-0 right-0 z-10">
                    <div class="w-10 h-1 bg-white/40 rounded-full"></div>
                </div>

                <!-- Header gradient -->
                <div class="px-5 pt-8 sm:pt-6 pb-5
                            bg-linear-to-br from-sky-600 to-indigo-600 text-white
                            flex items-start justify-between gap-3 shrink-0 relative">
                    <div class="flex items-center gap-4 min-w-0">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-white/20 backdrop-blur-md
                                    flex items-center justify-center border border-white/20 shrink-0 shadow-lg font-display font-black text-xl">
                            <span x-text="selectedTeam.nama_usaha.substring(0,1)"></span>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-display text-base sm:text-lg font-black uppercase tracking-wider truncate"
                                x-text="selectedTeam.nama_usaha"></h3>
                            <div class="flex items-center gap-2 mt-0.5 flex-wrap">
                                <span class="text-[9px] text-sky-100 font-bold uppercase tracking-widest"
                                   x-text="selectedTeam.kategori_usaha"></span>
                                <span class="w-1 h-1 rounded-full bg-sky-300 opacity-50"></span>
                                <span class="text-[9px] text-sky-100 font-bold uppercase tracking-widest"
                                   x-text="selectedTeam.kategori_wirausaha"></span>
                            </div>
                        </div>
                    </div>
                    <button @click="closeTeam()"
                            class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/30 transition-all shrink-0">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>

                <!-- Body — scrollable -->
                <div class="overflow-y-auto overscroll-contain flex-1 p-5 sm:p-8 space-y-6 custom-scrollbar max-h-[70vh]">
                    
                    <!-- Stats Section -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 rounded-3xl bg-slate-50 border border-slate-100 flex flex-col items-center text-center group hover:bg-white hover:border-sky-200 transition-all duration-300">
                            <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center mb-3 text-sky-500 group-hover:scale-110 transition-transform">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Bimbingan</p>
                            <p class="text-xl font-black text-slate-800" x-text="selectedTeam.total_bimbingan"></p>
                        </div>
                        <div class="p-4 rounded-3xl bg-slate-50 border border-slate-100 flex flex-col items-center text-center group hover:bg-white hover:border-indigo-200 transition-all duration-300">
                            <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center mb-3 text-indigo-500 group-hover:scale-110 transition-transform">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kegiatan</p>
                            <p class="text-xl font-black text-slate-800" x-text="selectedTeam.total_kegiatan"></p>
                        </div>
                    </div>

                    <!-- Members Section -->
                    <div class="space-y-4">
                        <h4 class="font-display text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <i class="fas fa-users-gear text-sky-500"></i>
                            Anggota Tim & Kontak
                        </h4>

                        <div class="space-y-3">
                            <template x-if="selectedTeam && selectedTeam.members">
                                <template x-for="(member, idx) in selectedTeam.members" :key="idx">
                                    <div class="group p-4 rounded-2xl border border-slate-100 hover:border-sky-200 hover:bg-sky-50/30 transition-all flex items-center gap-4">
                                        <!-- Avatar -->
                                        <div class="w-12 h-12 rounded-xl bg-linear-to-tr from-sky-500 to-sky-400 flex items-center justify-center text-white font-display font-black text-sm shrink-0 shadow-lg shadow-sky-200">
                                            <span x-text="member.nama.substring(0, 2).toUpperCase()"></span>
                                        </div>
                                        <!-- Info -->
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <h5 class="text-sm font-bold text-slate-800 truncate" x-text="member.nama"></h5>
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-tighter"
                                                      :class="member.role === 'ketua' ? 'bg-rose-100 text-rose-600' : 'bg-slate-100 text-slate-500'"
                                                      x-text="member.role"></span>
                                            </div>
                                            <p class="text-[10px] sm:text-[11px] text-slate-500 font-medium" x-text="`${member.nim} • ${member.prodi}`"></p>
                                            <!-- Contact -->
                                            <div class="flex items-center gap-3 mt-2 flex-wrap">
                                                <a :href="`https://wa.me/${member.phone ? member.phone.replace(/[^0-9]/g, '') : ''}`" target="_blank" class="flex items-center gap-1 text-[10px] font-black text-emerald-600 hover:text-emerald-700 transition-colors uppercase tracking-tight">
                                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                                </a>
                                                <span class="w-1 h-1 rounded-full bg-slate-200 shrink-0"></span>
                                                <a :href="`mailto:${member.email}`" class="flex items-center gap-1 text-[10px] font-black text-sky-600 hover:text-sky-700 transition-colors uppercase tracking-tight">
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
            </div>
        </div>
    </template>

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

    /* Mobile bottom-sheet: slide up from bottom */
    @media (max-width: 639px) {
        @keyframes modalIn {
            from { transform: translateY(100%); opacity: 1; }
            to   { transform: translateY(0); opacity: 1; }
        }
    }

    /* ---- Scrollbar ---- */
    .custom-scrollbar::-webkit-scrollbar       { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track  { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb  { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

    /* ---- Sidebar horizontal scroll snap on mobile ---- */
    @media (max-width: 1023px) {
        .modal-sheet { border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important; }
    }

    /* ---- Safe area for iPhone notch ---- */
    .modal-sheet { padding-bottom: env(safe-area-inset-bottom, 0); }
</style>

<?= $this->endSection() ?>