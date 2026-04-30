<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div x-data="{ 
    activeTab: 'jadwal',
    showPreview: false,
    previewUrl: '',
    openPreview(url) {
        this.previewUrl = url;
        this.showPreview = true;
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
            <h2 class="text-2xl font-display font-bold text-(--text-heading)">Manajemen Laporan Milestone</h2>
            <p class="text-sm text-(--text-muted) mt-1">Kelola penjadwalan dan pantau pengumpulan laporan kemajuan & akhir mahasiswa.</p>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-2xl w-fit">
        <button @click="activeTab = 'jadwal'" 
            :class="activeTab === 'jadwal' ? 'bg-white text-sky-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
            class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2">
            <i class="fas fa-calendar-alt text-xs"></i>
            Penjadwalan
        </button>
        <button @click="activeTab = 'monitoring'" 
            :class="activeTab === 'monitoring' ? 'bg-white text-sky-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
            class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2">
            <i class="fas fa-list-check text-xs"></i>
            Monitoring Pengumpulan
        </button>
    </div>

    <!-- Main Content Area -->
    <div class="animate-fade-in">
        
        <!-- Tab 1: Scheduling -->
        <template x-if="activeTab === 'jadwal'">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in">
                
                <!-- Laporan Kemajuan Schedule -->
                <div @mousemove="handleMouseMove" class="card-premium h-fit">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800">Laporan Kemajuan</h3>
                            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black">Implementasi Tengah</p>
                        </div>
                    </div>

                    <form action="<?= base_url('admin/milestone/schedule') ?>" method="post" class="space-y-6">
                        <?= csrf_field() ?>
                        <input type="hidden" name="type" value="kemajuan">
                        <input type="hidden" name="period_id" value="<?= $activePeriod['id'] ?>">
                        <input type="hidden" name="is_active" value="1">

                        <div class="space-y-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-xs font-bold text-slate-600 ml-1">Tanggal Mulai</label>
                                <input type="date" name="start_date" value="<?= isset($schedules['kemajuan']) ? $schedules['kemajuan']['start_date'] : '' ?>" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-4 focus:ring-sky-50 outline-none transition-all text-sm font-medium" required>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="text-xs font-bold text-slate-600 ml-1">Deadline Pengumpulan</label>
                                <input type="date" name="end_date" value="<?= isset($schedules['kemajuan']) ? $schedules['kemajuan']['end_date'] : '' ?>" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-500 focus:ring-4 focus:ring-sky-50 outline-none transition-all text-sm font-medium" required>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status</span>
                                <?php 
                                $isKemajuanActive = false;
                                if (isset($schedules['kemajuan'])) {
                                    $now = date('Y-m-d');
                                    $isKemajuanActive = ($now >= $schedules['kemajuan']['start_date'] && $now <= $schedules['kemajuan']['end_date']);
                                }
                                ?>
                                <span class="px-2.5 py-1 rounded-full text-[9px] font-black uppercase tracking-wider <?= $isKemajuanActive ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' ?>">
                                    <?= $isKemajuanActive ? 'Berjalan' : 'Tidak Aktif' ?>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-linear-to-r from-sky-600 to-sky-500 text-white rounded-2xl font-bold shadow-lg shadow-sky-100 hover:shadow-sky-200 hover:-translate-y-0.5 transition-all">
                            Simpan Jadwal
                        </button>
                    </form>
                </div>

                <!-- Laporan Magang Schedule (Pemula Only) -->
                <div @mousemove="handleMouseMove" class="card-premium h-fit">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800">Laporan Magang</h3>
                            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black">Khusus Tim Pemula</p>
                        </div>
                    </div>

                    <form action="<?= base_url('admin/milestone/schedule') ?>" method="post" class="space-y-6">
                        <?= csrf_field() ?>
                        <input type="hidden" name="type" value="magang">
                        <input type="hidden" name="period_id" value="<?= $activePeriod['id'] ?>">
                        <input type="hidden" name="is_active" value="1">

                        <div class="space-y-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-xs font-bold text-slate-600 ml-1">Tanggal Mulai</label>
                                <input type="date" name="start_date" value="<?= isset($schedules['magang']) ? $schedules['magang']['start_date'] : '' ?>" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 outline-none transition-all text-sm font-medium" required>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="text-xs font-bold text-slate-600 ml-1">Deadline Pengumpulan</label>
                                <input type="date" name="end_date" value="<?= isset($schedules['magang']) ? $schedules['magang']['end_date'] : '' ?>" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 outline-none transition-all text-sm font-medium" required>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status</span>
                                <?php 
                                $isMagangActive = false;
                                if (isset($schedules['magang'])) {
                                    $now = date('Y-m-d');
                                    $isMagangActive = ($now >= $schedules['magang']['start_date'] && $now <= $schedules['magang']['end_date']);
                                }
                                ?>
                                <span class="px-2.5 py-1 rounded-full text-[9px] font-black uppercase tracking-wider <?= $isMagangActive ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' ?>">
                                    <?= $isMagangActive ? 'Berjalan' : 'Tidak Aktif' ?>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-linear-to-r from-emerald-600 to-emerald-500 text-white rounded-2xl font-bold shadow-lg shadow-emerald-100 hover:shadow-emerald-200 hover:-translate-y-0.5 transition-all">
                            Simpan Jadwal
                        </button>
                    </form>
                </div>

                <!-- Laporan Akhir Schedule -->
                <div @mousemove="handleMouseMove" class="card-premium h-fit">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl shadow-sm">
                            <i class="fas fa-flag-checkered"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800">Laporan Akhir</h3>
                            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black">Tahap Akhir Program</p>
                        </div>
                    </div>

                    <form action="<?= base_url('admin/milestone/schedule') ?>" method="post" class="space-y-6">
                        <?= csrf_field() ?>
                        <input type="hidden" name="type" value="akhir">
                        <input type="hidden" name="period_id" value="<?= $activePeriod['id'] ?>">
                        <input type="hidden" name="is_active" value="1">

                        <div class="space-y-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-xs font-bold text-slate-600 ml-1">Tanggal Mulai</label>
                                <input type="date" name="start_date" value="<?= isset($schedules['akhir']) ? $schedules['akhir']['start_date'] : '' ?>" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 outline-none transition-all text-sm font-medium" required>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="text-xs font-bold text-slate-600 ml-1">Deadline Pengumpulan</label>
                                <input type="date" name="end_date" value="<?= isset($schedules['akhir']) ? $schedules['akhir']['end_date'] : '' ?>" 
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-50 outline-none transition-all text-sm font-medium" required>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status</span>
                                <?php 
                                $isAkhirActive = false;
                                if (isset($schedules['akhir'])) {
                                    $now = date('Y-m-d');
                                    $isAkhirActive = ($now >= $schedules['akhir']['start_date'] && $now <= $schedules['akhir']['end_date']);
                                }
                                ?>
                                <span class="px-2.5 py-1 rounded-full text-[9px] font-black uppercase tracking-wider <?= $isAkhirActive ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' ?>">
                                    <?= $isAkhirActive ? 'Berjalan' : 'Tidak Aktif' ?>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-linear-to-r from-indigo-600 to-indigo-500 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all">
                            Simpan Jadwal
                        </button>
                    </form>
                </div>

            </div>
        </template>

        <!-- Tab 2: Monitoring -->
        <template x-if="activeTab === 'monitoring'">
            <div class="space-y-6 animate-fade-in">
                <!-- Monitoring Header -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 px-2">
                    <div>
                        <h3 class="text-xl font-display font-bold text-slate-800">Monitoring Pengumpulan</h3>
                        <p class="text-xs text-slate-500 mt-1">Status laporan dari <?= count($proposals) ?> tim yang diverifikasi oleh dosen pendamping.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="relative group">
                            <input type="text" placeholder="Cari tim..." class="pl-10 pr-4 py-2.5 rounded-2xl bg-white border border-slate-100 text-xs focus:ring-2 focus:ring-sky-100 focus:border-sky-400 outline-hidden transition-all w-full md:w-64 shadow-sm">
                            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                        </div>
                    </div>
                </div>

                <!-- Cards List -->
                <div class="grid grid-cols-1 gap-4">
                    <?php if (empty($proposals)): ?>
                        <div class="card-premium p-12 text-center">
                            <i class="fas fa-users-slash text-4xl text-slate-200 mb-4 block"></i>
                            <p class="text-slate-500 italic">Belum ada tim yang terdaftar.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($proposals as $idx => $p): ?>
                            <div @mousemove="handleMouseMove" class="card-premium p-5 hover:shadow-xl hover:border-sky-100 transition-all group">
                                <div class="flex flex-col lg:flex-row gap-6">
                                    <!-- Team Info Section -->
                                    <div class="lg:w-1/3 flex items-start gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center font-bold text-sm group-hover:bg-sky-50 group-hover:text-sky-600 transition-colors shrink-0">
                                            <?= str_pad($idx + 1, 2, '0', STR_PAD_LEFT) ?>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-bold text-slate-800 text-base truncate mb-1"><?= esc($p['nama_usaha']) ?></h4>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <span class="text-[10px] font-medium text-slate-500 bg-slate-100 px-2 py-0.5 rounded-full flex items-center gap-1">
                                                    <i class="fas fa-crown text-[8px]"></i> <?= esc($p['ketua_nama']) ?>
                                                </span>
                                                <span class="text-[10px] font-black text-sky-600 uppercase tracking-widest bg-sky-50 px-2 py-0.5 rounded-full">
                                                    <?= esc($p['category']) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Reports Status Section -->
                                    <div class="lg:w-2/3 grid grid-cols-1 sm:grid-cols-3 gap-3">
                                        <?php 
                                        $reportTypes = [
                                            'kemajuan' => ['label' => 'Kemajuan', 'icon' => 'fa-chart-line'],
                                            'magang'   => ['label' => 'Magang', 'icon' => 'fa-user-graduate'],
                                            'akhir'    => ['label' => 'Akhir', 'icon' => 'fa-flag-checkered']
                                        ];
                                        ?>
                                        <?php foreach ($reportTypes as $type => $info): ?>
                                            <div class="p-3 rounded-2xl bg-slate-50/50 border border-slate-100 flex flex-col justify-between gap-3 relative overflow-hidden group/status">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400"><?= $info['label'] ?></p>
                                                    <i class="fas <?= $info['icon'] ?> text-[10px] text-slate-200 group-hover/status:text-sky-200 transition-colors"></i>
                                                </div>

                                                <?php if ($type === 'magang' && ($p['category'] ?? '') !== 'pemula'): ?>
                                                    <span class="text-[10px] font-bold text-slate-200 uppercase tracking-widest italic">N/A</span>
                                                <?php elseif (isset($submissions[$p['id']][$type])): $sub = $submissions[$p['id']][$type]; ?>
                                                    <div class="flex items-center justify-between gap-2">
                                                        <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-widest <?= $sub['status'] === 'approved' ? 'bg-emerald-100 text-emerald-700' : 'bg-sky-100 text-sky-700' ?>">
                                                            <?= $sub['status'] ?>
                                                        </span>
                                                        <button @click="openPreview('<?= base_url('admin/milestone/view/'.$sub['id']) ?>')" class="w-8 h-8 rounded-lg bg-white text-rose-500 shadow-sm border border-slate-100 flex items-center justify-center hover:bg-rose-50 transition-colors" title="Lihat Laporan">
                                                            <i class="fas fa-file-pdf text-sm"></i>
                                                        </button>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="text-[10px] font-bold text-slate-300 italic">Belum Ada</span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </template>

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
                    <h3 class="font-bold text-slate-800">Pratinjau Laporan Milestone</h3>
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
