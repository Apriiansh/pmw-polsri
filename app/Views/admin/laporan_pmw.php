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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-fade-in">
                
                <!-- Laporan Kemajuan Schedule -->
                <div @mousemove="handleMouseMove" class="card-premium">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800">Jadwal Laporan Kemajuan</h3>
                            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black">Tahap Implementasi Tengah</p>
                        </div>
                    </div>

                    <form action="<?= base_url('admin/milestone/schedule') ?>" method="post" class="space-y-5">
                        <?= csrf_field() ?>
                        <input type="hidden" name="type" value="kemajuan">
                        <input type="hidden" name="period_id" value="<?= $activePeriod['id'] ?>">

                        <div class="grid grid-cols-2 gap-4">
                            <div class="input-group">
                                <label class="input-label text-[10px]">Tanggal Mulai</label>
                                <input type="date" name="start_date" value="<?= isset($schedules['kemajuan']) ? $schedules['kemajuan']['start_date'] : '' ?>" class="input-field py-2.5 text-sm" required>
                            </div>
                            <div class="input-group">
                                <label class="input-label text-[10px]">Deadline</label>
                                <input type="date" name="end_date" value="<?= isset($schedules['kemajuan']) ? $schedules['kemajuan']['end_date'] : '' ?>" class="input-field py-2.5 text-sm" required>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Saat Ini</span>
                                <?php 
                                $isKemajuanActive = false;
                                if (isset($schedules['kemajuan'])) {
                                    $now = date('Y-m-d');
                                    $isKemajuanActive = ($now >= $schedules['kemajuan']['start_date'] && $now <= $schedules['kemajuan']['end_date']);
                                }
                                ?>
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase <?= $isKemajuanActive ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' ?>">
                                    <?= $isKemajuanActive ? 'Berjalan' : 'Tidak Aktif' ?>
                                </span>
                            </div>
                            <p class="text-[11px] text-slate-500 italic">Mahasiswa hanya dapat mengunggah laporan dalam rentang waktu yang ditentukan.</p>
                        </div>

                        <button type="submit" class="w-full py-3 bg-linear-to-r from-sky-600 to-sky-500 text-white rounded-xl font-bold shadow-lg shadow-sky-100 hover:shadow-sky-200 hover:-translate-y-0.5 transition-all">
                            Simpan Jadwal Kemajuan
                        </button>
                    </form>
                </div>

                <!-- Laporan Akhir Schedule -->
                <div @mousemove="handleMouseMove" class="card-premium">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                            <i class="fas fa-flag-checkered"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800">Jadwal Laporan Akhir</h3>
                            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black">Tahap Akhir Program</p>
                        </div>
                    </div>

                    <form action="<?= base_url('admin/milestone/schedule') ?>" method="post" class="space-y-5">
                        <?= csrf_field() ?>
                        <input type="hidden" name="type" value="akhir">
                        <input type="hidden" name="period_id" value="<?= $activePeriod['id'] ?>">

                        <div class="grid grid-cols-2 gap-4">
                            <div class="input-group">
                                <label class="input-label text-[10px]">Tanggal Mulai</label>
                                <input type="date" name="start_date" value="<?= isset($schedules['akhir']) ? $schedules['akhir']['start_date'] : '' ?>" class="input-field py-2.5 text-sm" required>
                            </div>
                            <div class="input-group">
                                <label class="input-label text-[10px]">Deadline</label>
                                <input type="date" name="end_date" value="<?= isset($schedules['akhir']) ? $schedules['akhir']['end_date'] : '' ?>" class="input-field py-2.5 text-sm" required>
                            </div>
                        </div>

                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Saat Ini</span>
                                <?php 
                                $isAkhirActive = false;
                                if (isset($schedules['akhir'])) {
                                    $now = date('Y-m-d');
                                    $isAkhirActive = ($now >= $schedules['akhir']['start_date'] && $now <= $schedules['akhir']['end_date']);
                                }
                                ?>
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase <?= $isAkhirActive ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' ?>">
                                    <?= $isAkhirActive ? 'Berjalan' : 'Tidak Aktif' ?>
                                </span>
                            </div>
                            <p class="text-[11px] text-slate-500 italic">Penutupan otomatis akan dilakukan setelah melewati batas deadline.</p>
                        </div>

                        <button type="submit" class="w-full py-3 bg-linear-to-r from-indigo-600 to-indigo-500 text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all">
                            Simpan Jadwal Akhir
                        </button>
                    </form>
                </div>

            </div>
        </template>

        <!-- Tab 2: Monitoring -->
        <template x-if="activeTab === 'monitoring'">
            <div @mousemove="handleMouseMove" class="card-premium p-0 animate-fade-in">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-800">Daftar Pengumpulan Tim</h3>
                        <p class="text-xs text-slate-500">Memantau status laporan dari <?= count($proposals) ?> tim implementasi.</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-400 transition-colors">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="pmw-table w-full">
                        <thead>
                            <tr>
                                <th class="w-12">No</th>
                                <th>Informasi Usaha</th>
                                <th class="text-center">Lap. Kemajuan</th>
                                <th class="text-center">Lap. Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($proposals as $idx => $p): ?>
                                <tr class="hover:bg-sky-50/30 transition-colors">
                                    <td class="text-center text-xs font-bold text-slate-400"><?= $idx + 1 ?></td>
                                    <td>
                                        <p class="font-bold text-slate-800 text-sm mb-0.5"><?= esc($p['nama_usaha']) ?></p>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-medium text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded"><?= esc($p['ketua_nama']) ?></span>
                                            <span class="text-[10px] font-bold text-sky-600"><?= esc($p['category']) ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php if (isset($submissions[$p['id']]['kemajuan'])): $sub = $submissions[$p['id']]['kemajuan']; ?>
                                            <div class="flex flex-col items-center gap-1">
                                                <button @click="openPreview('<?= base_url('admin/milestone/view/'.$sub['id']) ?>')" class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-bold hover:bg-emerald-100 transition-colors">
                                                    <i class="fas fa-file-pdf mr-1"></i> LIHAT
                                                </button>
                                                <span class="text-[9px] font-black uppercase <?= $sub['status'] === 'approved' ? 'text-emerald-500' : 'text-sky-500' ?>">
                                                    <?= $sub['status'] ?>
                                                </span>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-[10px] font-bold text-slate-300 italic">— Belum —</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (isset($submissions[$p['id']]['akhir'])): $sub = $submissions[$p['id']]['akhir']; ?>
                                            <div class="flex flex-col items-center gap-1">
                                                <button @click="openPreview('<?= base_url('admin/milestone/view/'.$sub['id']) ?>')" class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-[10px] font-bold hover:bg-indigo-100 transition-colors">
                                                    <i class="fas fa-file-pdf mr-1"></i> LIHAT
                                                </button>
                                                <span class="text-[9px] font-black uppercase <?= $sub['status'] === 'approved' ? 'text-emerald-500' : 'text-sky-500' ?>">
                                                    <?= $sub['status'] ?>
                                                </span>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-[10px] font-bold text-slate-300 italic">— Belum —</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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
