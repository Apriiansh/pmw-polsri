<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div x-data="{ 
    showPreview: false,
    previewUrl: '',
    showVerifyModal: false,
    selectedReport: null,
    openPreview(url) {
        this.previewUrl = url;
        this.showPreview = true;
    },
    openVerify(report) {
        this.selectedReport = report;
        this.showVerifyModal = true;
    },
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}" class="space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-2xl font-display font-bold text-(--text-heading)">Verifikasi Laporan Milestone</h2>
            <p class="text-sm text-(--text-muted) mt-1">Lakukan peninjauan dan verifikasi terhadap laporan kemajuan & akhir mahasiswa bimbingan Anda.</p>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <?php 
        $flattened = [];
        foreach ($reports as $pReports) {
            foreach ($pReports as $r) $flattened[] = $r;
        }
        $approvedCount = count(array_filter($flattened, fn($r) => $r['status'] === 'approved'));
        $pendingCount = count(array_filter($flattened, fn($r) => $r['status'] === 'pending' || $r['status'] === 'revision'));
        ?>
        <div @mousemove="handleMouseMove" class="card-premium p-6 flex items-center gap-4 border-l-4 border-l-sky-500">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl">
                <i class="fas fa-file-import"></i>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Laporan</p>
                <h4 class="text-2xl font-display font-bold text-slate-800"><?= count($flattened) ?></h4>
            </div>
        </div>
        <div @mousemove="handleMouseMove" class="card-premium p-6 flex items-center gap-4 border-l-4 border-l-emerald-500">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                <i class="fas fa-check-double"></i>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Telah Disetujui</p>
                <h4 class="text-2xl font-display font-bold text-slate-800"><?= $approvedCount ?></h4>
            </div>
        </div>
        <div @mousemove="handleMouseMove" class="card-premium p-6 flex items-center gap-4 border-l-4 border-l-amber-500">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Perlu Review</p>
                <h4 class="text-2xl font-display font-bold text-slate-800"><?= $pendingCount ?></h4>
            </div>
        </div>
    </div>

    <!-- Reports List -->
    <div class="space-y-6">
        <?php if (empty($proposals)): ?>
            <div @mousemove="handleMouseMove" class="card-premium p-12 text-center">
                <i class="fas fa-folder-open text-4xl text-slate-200 mb-4 block"></i>
                <p class="text-slate-500 italic">Belum ada tim bimbingan yang terdaftar untuk periode aktif.</p>
            </div>
        <?php else: ?>
            <?php foreach ($proposals as $p): ?>
                <div @mousemove="handleMouseMove" class="card-premium animate-fade-in">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-50">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl">
                                <i class="fas fa-users-rectangle"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800"><?= esc($p['nama_usaha']) ?></h3>
                                <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black"><?= esc($p['ketua_nama']) ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-[9px] font-black text-slate-500 uppercase tracking-widest">
                                <?= esc($p['kategori_wirausaha'] ?? 'PEMULA') ?>
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <?php foreach (['kemajuan', 'akhir'] as $type): ?>
                            <?php 
                            $rep = $reports[$p['id']][$type] ?? null;
                            $sched = $schedules[$type] ?? null;
                            $icon = $type === 'kemajuan' ? 'fa-chart-line' : 'fa-flag-checkered';
                            $color = $type === 'kemajuan' ? 'sky' : 'indigo';
                            ?>
                            <div class="group relative p-5 rounded-2xl transition-all duration-300 <?= $rep ? 'bg-white border border-slate-100 shadow-sm hover:shadow-md' : 'bg-slate-50/50 border border-dashed border-slate-200 opacity-80' ?>">
                                <div class="flex items-center justify-between gap-4 mb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-<?= $color ?>-50 text-<?= $color ?>-600 flex items-center justify-center">
                                            <i class="fas <?= $icon ?>"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Laporan <?= ucfirst($type) ?></p>
                                            <div class="flex items-center gap-2 mt-0.5">
                                                <?php if ($rep): ?>
                                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-widest 
                                                        <?= $rep['status'] === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($rep['status'] === 'rejected' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') ?>">
                                                        <?= $rep['status'] ?>
                                                    </span>
                                                <?php elseif ($sched): ?>
                                                    <span class="px-2 py-0.5 rounded-full bg-slate-200 text-slate-500 text-[9px] font-bold uppercase tracking-widest">Belum Diunggah</span>
                                                <?php else: ?>
                                                    <span class="px-2 py-0.5 rounded-full bg-rose-50 text-rose-400 text-[9px] font-bold uppercase tracking-widest">Belum Ditugaskan</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php if ($rep): ?>
                                        <div class="flex items-center gap-2">
                                            <button @click="openPreview('<?= base_url('dosen/milestone/view/'.$rep['id']) ?>')" class="w-9 h-9 rounded-xl bg-slate-100 text-slate-500 hover:bg-sky-50 hover:text-sky-600 transition-colors flex items-center justify-center" title="Pratinjau PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </button>
                                            <button @click="openVerify(<?= htmlspecialchars(json_encode(array_merge($rep, ['nama_usaha' => $p['nama_usaha']])), ENT_QUOTES, 'UTF-8') ?>)" 
                                                class="px-4 h-9 rounded-xl bg-sky-600 text-white text-[11px] font-bold shadow-lg shadow-sky-100 hover:shadow-sky-200 transition-all flex items-center gap-2">
                                                <i class="fas fa-signature text-[10px]"></i>
                                                Verifikasi
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ($rep): ?>
                                    <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                        <div class="flex items-center gap-2 text-[10px] text-slate-400 font-medium">
                                            <i class="fas fa-clock"></i>
                                            <?= date('d M Y, H:i', strtotime($rep['created_at'])) ?> WIB
                                        </div>
                                        <?php if ($rep['dosen_note']): ?>
                                            <div class="group/note relative">
                                                <i class="fas fa-comment-dots text-amber-400 cursor-help"></i>
                                                <div class="absolute bottom-full right-0 mb-2 w-48 p-2 bg-slate-800 text-white text-[10px] rounded-lg opacity-0 group-hover/note:opacity-100 transition-opacity pointer-events-none z-10 shadow-xl">
                                                    "<?= esc($rep['dosen_note']) ?>"
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php elseif ($sched): ?>
                                    <div class="flex items-center gap-2 text-[10px] text-slate-400">
                                        <i class="fas fa-calendar-alt"></i>
                                        Deadline: <?= date('d M Y', strtotime($sched['end_date'])) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Verification Modal -->
    <div x-show="showVerifyModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-9999 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
        x-cloak>
        
        <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden animate-scale-in" @click.outside="showVerifyModal = false">
            <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">Verifikasi Laporan</h3>
                <button @click="showVerifyModal = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form action="<?= base_url('dosen/milestone/verify') ?>" method="post" class="p-6 space-y-6">
                <?= csrf_field() ?>
                <input type="hidden" name="report_id" :value="selectedReport ? selectedReport.id : ''">
                
                <!-- Student Info in Modal -->
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Informasi Laporan</p>
                    <div class="flex flex-col gap-1">
                        <span class="text-sm font-bold text-slate-800" x-text="selectedReport ? selectedReport.nama_usaha : ''"></span>
                        <span class="text-xs text-slate-600" x-text="selectedReport ? 'Jenis: Laporan ' + selectedReport.type : ''"></span>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Status Verifikasi</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative flex items-center justify-center p-4 rounded-2xl border-2 border-slate-100 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 group">
                            <input type="radio" name="status" value="approved" class="hidden" required :checked="selectedReport && selectedReport.status === 'approved'">
                            <div class="text-center">
                                <i class="fas fa-check-circle text-xl text-slate-300 group-has-[:checked]:text-emerald-500 mb-1"></i>
                                <p class="text-xs font-bold text-slate-600 group-has-[:checked]:text-emerald-700">Setujui</p>
                            </div>
                        </label>
                        <label class="relative flex items-center justify-center p-4 rounded-2xl border-2 border-slate-100 cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50 group">
                            <input type="radio" name="status" value="revision" class="hidden" required :checked="selectedReport && selectedReport.status === 'revision'">
                            <div class="text-center">
                                <i class="fas fa-pen-to-square text-xl text-slate-300 group-has-[:checked]:text-amber-500 mb-1"></i>
                                <p class="text-xs font-bold text-slate-600 group-has-[:checked]:text-amber-700">Revisi</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Catatan / Feedback</label>
                    <textarea name="dosen_note" class="input-field min-h-[120px]" placeholder="Berikan saran atau alasan jika memerlukan revisi..." x-text="selectedReport ? selectedReport.dosen_note : ''"></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="button" @click="showVerifyModal = false" class="flex-1 py-3.5 rounded-2xl border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 transition-all">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 py-3.5 bg-linear-to-r from-sky-600 to-sky-500 text-white rounded-2xl font-bold shadow-lg shadow-sky-100 hover:shadow-sky-200 transition-all">
                        Simpan Verifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- PDF Preview Modal -->
    <div x-show="showPreview" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-9999 flex items-center justify-center p-4 md:p-8 bg-slate-900/60 backdrop-blur-sm"
        x-cloak>
        
        <div class="bg-white w-full max-w-5xl h-full rounded-3xl shadow-2xl overflow-hidden flex flex-col animate-scale-in" @click.outside="showPreview = false">
            <div class="p-4 border-b border-slate-100 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-sky-50 flex items-center justify-center text-sky-600">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">Pratinjau Laporan Mahasiswa</h3>
                </div>
                <button @click="showPreview = false" class="w-10 h-10 rounded-xl hover:bg-slate-100 text-slate-400 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="flex-1 bg-slate-100 p-4">
                <iframe :src="previewUrl" class="w-full h-full rounded-xl shadow-inner border-0"></iframe>
            </div>
        </div>
    </div>

</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fade-in 0.4s ease-out forwards;
    }
    @keyframes scale-in {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-scale-in {
        animation: scale-in 0.3s ease-out forwards;
    }
</style>
<?= $this->endSection() ?>
