<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div x-data="{ 
    activeTab: 'kemajuan',
    showPreview: false,
    previewUrl: '',
    fileNameKemajuan: '',
    fileNameAkhir: '',
    fileNameMagang: '',
    fileNameBoothcamp: '',
    openPreview(url) {
        this.previewUrl = url;
        this.showPreview = true;
    }
}" class="space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-2xl font-display font-bold text-(--text-heading)">Laporan Milestone</h2>
            <p class="text-sm text-(--text-muted) mt-1">Unggah Laporan untuk tim <span class="font-bold text-sky-600"><?= esc($proposal['nama_usaha']) ?></span></p>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="relative">
        <div class="flex flex-col md:flex-row items-stretch md:items-center gap-2 bg-slate-100/80 backdrop-blur-sm p-2 rounded-3xl w-full md:w-fit border border-slate-200/50">
            <!-- Tab Kemajuan -->
            <button @click="activeTab = 'kemajuan'" 
                :class="activeTab === 'kemajuan' ? 'bg-white text-sky-600 shadow-md shadow-sky-100/50 translate-x-1 md:translate-x-0 md:scale-[1.02]' : 'text-slate-500 hover:text-slate-700 hover:bg-white/50'"
                class="px-5 py-3 rounded-2xl text-sm font-bold transition-all duration-300 flex items-center gap-3 shrink-0">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors"
                    :class="activeTab === 'kemajuan' ? 'bg-sky-50' : 'bg-slate-200/50'">
                    <i class="fas fa-chart-line text-xs"></i>
                </div>
                <span>Laporan Kemajuan</span>
            </button>

            <!-- Tab Magang (Semua Kategori) -->
            <button @click="activeTab = 'magang'" 
                :class="activeTab === 'magang' ? 'bg-white text-emerald-600 shadow-md shadow-emerald-100/50 translate-x-1 md:translate-x-0 md:scale-[1.02]' : 'text-slate-500 hover:text-slate-700 hover:bg-white/50'"
                class="px-5 py-3 rounded-2xl text-sm font-bold transition-all duration-300 flex items-center gap-3 shrink-0">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors"
                    :class="activeTab === 'magang' ? 'bg-emerald-50' : 'bg-slate-200/50'">
                    <i class="fas fa-user-graduate text-xs"></i>
                </div>
                <span>Laporan Magang</span>
            </button>

            <!-- Tab Akhir -->
            <button @click="activeTab = 'akhir'" 
                :class="activeTab === 'akhir' ? 'bg-white text-indigo-600 shadow-md shadow-indigo-100/50 translate-x-1 md:translate-x-0 md:scale-[1.02]' : 'text-slate-500 hover:text-slate-700 hover:bg-white/50'"
                class="px-5 py-3 rounded-2xl text-sm font-bold transition-all duration-300 flex items-center gap-3 shrink-0">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors"
                    :class="activeTab === 'akhir' ? 'bg-indigo-50' : 'bg-slate-200/50'">
                    <i class="fas fa-flag-checkered text-xs"></i>
                </div>
                <span>Laporan Akhir</span>
            </button>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left: Submission Form -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Kemajuan Tab -->
            <template x-if="activeTab === 'kemajuan'">
                <div class="card-premium animate-fade-in">
                    <?php if (isset($schedules['kemajuan'])): $sched = $schedules['kemajuan']; ?>
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center text-sky-500">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800">Jadwal Pengumpulan</h3>
                                    <p class="text-xs text-slate-500"><?= date('d M Y', strtotime($sched['start_date'])) ?> — <?= date('d M Y', strtotime($sched['end_date'])) ?></p>
                                </div>
                            </div>
                            <?php 
                            $now = date('Y-m-d');
                            $isOpen = ($now >= $sched['start_date'] && $now <= $sched['end_date']);
                            ?>
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest <?= $isOpen ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' ?>">
                                <?= $isOpen ? 'Terbuka' : 'Ditutup' ?>
                            </span>
                        </div>

                        <?php if (isset($reports['kemajuan'])): $rep = $reports['kemajuan']; ?>
                            <!-- Status Submission -->
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 mb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xs font-bold text-slate-600">Status Laporan Anda</span>
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest 
                                        <?= $rep['status'] === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($rep['status'] === 'rejected' ? 'bg-rose-100 text-rose-700' : 'bg-sky-100 text-sky-700') ?>">
                                        <?= strtoupper($rep['status']) ?>
                                    </span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <button @click="openPreview('<?= base_url('mahasiswa/milestone/view/'.$rep['id']) ?>')" class="flex-1 py-2 rounded-xl border border-sky-200 text-sky-600 text-xs font-bold hover:bg-sky-50 transition-colors flex items-center justify-center gap-2">
                                        <i class="fas fa-file-pdf"></i> Lihat Berkas
                                    </button>
                                </div>
                                <?php if ($rep['dosen_note']): ?>
                                    <div class="mt-4 p-3 bg-white rounded-xl border border-slate-100">
                                        <p class="text-[10px] uppercase font-black text-slate-400 tracking-widest mb-1">Catatan Dosen</p>
                                        <p class="text-xs text-slate-600 italic">"<?= esc($rep['dosen_note']) ?>"</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($isOpen && (!isset($reports['kemajuan']) || $reports['kemajuan']['status'] === 'rejected' || $reports['kemajuan']['status'] === 'revision')): ?>
                            <form action="<?= base_url('mahasiswa/milestone/submit') ?>" method="post" enctype="multipart/form-data" class="space-y-4">
                                <?= csrf_field() ?>
                                <input type="hidden" name="schedule_id" value="<?= $sched['id'] ?>">
                                
                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Catatan Tambahan (Opsional)</label>
                                    <textarea name="notes" class="input-field min-h-[100px]" placeholder="Berikan keterangan singkat mengenai laporan ini..."><?= isset($reports['kemajuan']) ? esc($reports['kemajuan']['notes']) : '' ?></textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-3">
                                        <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Berkas Laporan (PDF)</label>
                                        <div class="relative group h-[180px]">
                                            <input type="file" name="file_report" accept="application/pdf" 
                                                   @change="fileNameKemajuan = $event.target.files[0] ? $event.target.files[0].name : ''"
                                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                            <div class="h-full border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 group-hover:bg-sky-50 group-hover:border-sky-200 transition-all flex flex-col items-center justify-center text-center p-6">
                                                <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                                    <i class="fas fa-cloud-arrow-up text-xl text-sky-500"></i>
                                                </div>
                                                <p class="text-sm font-bold text-slate-700">Pilih Berkas PDF</p>
                                                <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-widest font-black">Maksimal 5MB</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Pratinjau Berkas</label>
                                        <div class="h-[180px] p-6 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-center items-center text-center">
                                            <template x-if="!fileNameKemajuan">
                                                <div class="space-y-2 opacity-50">
                                                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mx-auto mb-2">
                                                        <i class="fas fa-file-lines text-xl text-slate-400"></i>
                                                    </div>
                                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Belum Ada Berkas</p>
                                                </div>
                                            </template>
                                            <template x-if="fileNameKemajuan">
                                                <div class="w-full animate-fade-in">
                                                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 flex items-center justify-center mx-auto mb-4 border border-emerald-100 text-emerald-500">
                                                        <i class="fas fa-file-lines text-2xl"></i>
                                                    </div>
                                                    <p class="text-xs font-bold text-slate-700 truncate px-4" x-text="fileNameKemajuan"></p>
                                                    <div class="mt-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-100 text-[9px] font-black text-emerald-700 uppercase tracking-widest">
                                                        <i class="fas fa-check-circle"></i> Siap Unggah
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="w-full py-3.5 bg-linear-to-r from-sky-600 to-sky-500 text-white rounded-2xl font-bold shadow-lg shadow-sky-200 hover:shadow-sky-300 hover:-translate-y-0.5 transition-all">
                                    Unggah Laporan Kemajuan
                                </button>
                            </form>
                        <?php elseif (!$isOpen): ?>
                            <div class="p-8 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                <i class="fas fa-lock text-3xl text-slate-300 mb-3 block"></i>
                                <p class="text-sm font-medium text-slate-500 italic">Pengumpulan saat ini belum dibuka atau sudah berakhir.</p>
                            </div>
                        <?php endif; ?>

                    <?php else: ?>
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-calendar-xmark text-slate-300 text-xl"></i>
                            </div>
                            <h4 class="font-bold text-slate-800 mb-1">Jadwal Belum Diatur</h4>
                            <p class="text-sm text-slate-500 italic">Admin belum merilis jadwal pengumpulan laporan kemajuan.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </template>

            <!-- Akhir Tab -->
            <template x-if="activeTab === 'akhir'">
                <div class="space-y-6">

                    <!-- Dokumentasi Boothcamp (prasyarat laporan akhir) -->
                    <div class="card-premium animate-fade-in">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                                    <i class="fas fa-images"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800">Dokumentasi Boothcamp</h3>
                                    <p class="text-xs text-slate-500">Wajib sebelum Laporan Akhir. Bisa diunggah kapan pun, tanpa verifikasi.</p>
                                </div>
                            </div>
                            <?php if ($boothcampDoc): ?>
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-emerald-100 text-emerald-700">Sudah Diunggah</span>
                            <?php else: ?>
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-rose-100 text-rose-700">Belum Ada</span>
                            <?php endif; ?>
                        </div>

                        <?php if ($boothcampDoc): ?>
                            <?php $uploadedAt = $boothcampDoc['updated_at'] ?: ($boothcampDoc['created_at'] ?? null); ?>
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 mb-4">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="min-w-0">
                                        <p class="text-xs font-bold text-slate-700 truncate">
                                            <?= esc($boothcampDoc['original_name'] ?: 'Dokumentasi Boothcamp.pdf') ?>
                                        </p>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">
                                            Diunggah <?= $uploadedAt ? esc(date('d M Y H:i', strtotime($uploadedAt))) : '-' ?>
                                        </p>
                                    </div>
                                    <button type="button"
                                            @click="openPreview('<?= base_url('mahasiswa/proposal/doc/'.$boothcampDoc['id'].'?inline=1') ?>')"
                                            class="shrink-0 px-4 py-2 rounded-xl border border-sky-200 text-sky-600 text-xs font-bold hover:bg-sky-50 transition-colors flex items-center gap-2">
                                        <i class="fas fa-file-pdf"></i> Lihat
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('mahasiswa/milestone/boothcamp') ?>" method="post" enctype="multipart/form-data" class="space-y-4">
                            <?= csrf_field() ?>
                            <div class="relative group h-[140px]">
                                <input type="file" name="boothcamp_file" accept="application/pdf" required
                                       @change="fileNameBoothcamp = $event.target.files[0] ? $event.target.files[0].name : ''"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="h-full border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 group-hover:bg-amber-50 group-hover:border-amber-200 transition-all flex flex-col items-center justify-center text-center p-6">
                                    <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                        <i class="fas fa-cloud-arrow-up text-xl text-amber-500"></i>
                                    </div>
                                    <p class="text-sm font-bold text-slate-700"
                                       x-text="fileNameBoothcamp || '<?= $boothcampDoc ? 'Pilih PDF Pengganti' : 'Pilih Berkas PDF' ?>'"></p>
                                    <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-widest font-black">Maksimal 5MB</p>
                                </div>
                            </div>

                            <button type="submit" class="w-full py-3 rounded-2xl bg-linear-to-r from-amber-600 to-amber-500 text-white font-bold shadow-lg shadow-amber-200 hover:shadow-amber-300 hover:-translate-y-0.5 transition-all">
                                <?= $boothcampDoc ? 'Ganti Dokumentasi Boothcamp' : 'Unggah Dokumentasi Boothcamp' ?>
                            </button>
                        </form>
                    </div>

                    <div class="card-premium animate-fade-in">
                    <?php if (isset($schedules['akhir'])): $sched = $schedules['akhir']; ?>
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500">
                                    <i class="fas fa-flag-checkered"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800">Jadwal Laporan Akhir</h3>
                                    <p class="text-xs text-slate-500"><?= date('d M Y', strtotime($sched['start_date'])) ?> — <?= date('d M Y', strtotime($sched['end_date'])) ?></p>
                                </div>
                            </div>
                            <?php 
                            $now = date('Y-m-d');
                            $isOpen = ($now >= $sched['start_date'] && $now <= $sched['end_date']);
                            ?>
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest <?= $isOpen ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' ?>">
                                <?= $isOpen ? 'Terbuka' : 'Ditutup' ?>
                            </span>
                        </div>

                        <?php if (isset($reports['akhir'])): $rep = $reports['akhir']; ?>
                            <!-- Status Submission -->
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 mb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xs font-bold text-slate-600">Status Laporan Anda</span>
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest 
                                        <?= $rep['status'] === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($rep['status'] === 'rejected' ? 'bg-rose-100 text-rose-700' : 'bg-sky-100 text-sky-700') ?>">
                                        <?= strtoupper($rep['status']) ?>
                                    </span>
                                </div>
                                <button @click="openPreview('<?= base_url('mahasiswa/milestone/view/'.$rep['id']) ?>')" class="w-full py-2 rounded-xl border border-sky-200 text-sky-600 text-xs font-bold hover:bg-sky-50 transition-colors flex items-center justify-center gap-2">
                                    <i class="fas fa-file-pdf"></i> Lihat Berkas
                                </button>
                                <?php if ($rep['dosen_note']): ?>
                                    <div class="mt-4 p-3 bg-white rounded-xl border border-slate-100">
                                        <p class="text-[10px] uppercase font-black text-slate-400 tracking-widest mb-1">Catatan Dosen</p>
                                        <p class="text-xs text-slate-600 italic">"<?= esc($rep['dosen_note']) ?>"</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($isOpen && $boothcampDoc && (!isset($reports['akhir']) || $reports['akhir']['status'] === 'rejected' || $reports['akhir']['status'] === 'revision')): ?>
                            <form action="<?= base_url('mahasiswa/milestone/submit') ?>" method="post" enctype="multipart/form-data" class="space-y-4">
                                <?= csrf_field() ?>
                                <input type="hidden" name="schedule_id" value="<?= $sched['id'] ?>">
                                
                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Catatan Tambahan (Opsional)</label>
                                    <textarea name="notes" class="input-field min-h-[100px]" placeholder="Berikan keterangan singkat mengenai laporan akhir ini..."><?= isset($reports['akhir']) ? esc($reports['akhir']['notes']) : '' ?></textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-3">
                                        <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Berkas Laporan Akhir (PDF)</label>
                                        <div class="relative group h-[180px]">
                                            <input type="file" name="file_report" accept="application/pdf" 
                                                   @change="fileNameAkhir = $event.target.files[0] ? $event.target.files[0].name : ''"
                                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                            <div class="h-full border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 group-hover:bg-indigo-50 group-hover:border-indigo-200 transition-all flex flex-col items-center justify-center text-center p-6">
                                                <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                                    <i class="fas fa-cloud-arrow-up text-xl text-indigo-500"></i>
                                                </div>
                                                <p class="text-sm font-bold text-slate-700">Pilih Berkas PDF</p>
                                                <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-widest font-black">Maksimal 5MB</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Pratinjau Berkas</label>
                                        <div class="h-[180px] p-6 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-center items-center text-center">
                                            <template x-if="!fileNameAkhir">
                                                <div class="space-y-2 opacity-50">
                                                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mx-auto mb-2">
                                                        <i class="fas fa-file-pdf text-xl text-slate-400"></i>
                                                    </div>
                                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Belum Ada Berkas</p>
                                                </div>
                                            </template>
                                            <template x-if="fileNameAkhir">
                                                <div class="w-full animate-fade-in">
                                                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 flex items-center justify-center mx-auto mb-4 border border-emerald-100 text-emerald-500">
                                                        <i class="fas fa-file-pdf text-2xl"></i>
                                                    </div>
                                                    <p class="text-xs font-bold text-slate-700 truncate px-4" x-text="fileNameAkhir"></p>
                                                    <div class="mt-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-100 text-[9px] font-black text-emerald-700 uppercase tracking-widest">
                                                        <i class="fas fa-check-circle"></i> Siap Unggah
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="w-full py-3.5 bg-linear-to-r from-indigo-600 to-indigo-500 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:shadow-indigo-300 hover:-translate-y-0.5 transition-all">
                                    Unggah Laporan Akhir
                                </button>
                            </form>
                        <?php elseif (!$isOpen): ?>
                            <div class="p-8 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                <i class="fas fa-lock text-3xl text-slate-300 mb-3 block"></i>
                                <p class="text-sm font-medium text-slate-500 italic">Pengumpulan laporan akhir belum dibuka.</p>
                            </div>
                        <?php elseif (!$boothcampDoc): ?>
                            <div class="p-8 text-center bg-amber-50 rounded-2xl border border-dashed border-amber-200">
                                <i class="fas fa-triangle-exclamation text-3xl text-amber-400 mb-3 block"></i>
                                <p class="text-sm font-medium text-amber-700 italic">Unggah Dokumentasi Boothcamp terlebih dahulu sebelum mengumpulkan Laporan Akhir.</p>
                            </div>
                        <?php endif; ?>

                    <?php else: ?>
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-calendar-xmark text-slate-300 text-xl"></i>
                            </div>
                            <h4 class="font-bold text-slate-800 mb-1">Jadwal Belum Diatur</h4>
                            <p class="text-sm text-slate-500 italic">Admin belum merilis jadwal pengumpulan laporan akhir.</p>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </template>

            <!-- Magang Tab -->
            <template x-if="activeTab === 'magang'">
                <div class="card-premium animate-fade-in">
                    <?php if (isset($schedules['magang'])): $sched = $schedules['magang']; ?>
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800">Jadwal Laporan Magang</h3>
                                    <p class="text-xs text-slate-500"><?= date('d M Y', strtotime($sched['start_date'])) ?> — <?= date('d M Y', strtotime($sched['end_date'])) ?></p>
                                </div>
                            </div>
                            <?php 
                            $now = date('Y-m-d');
                            $isOpen = ($now >= $sched['start_date'] && $now <= $sched['end_date']);
                            ?>
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest <?= $isOpen ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' ?>">
                                <?= $isOpen ? 'Terbuka' : 'Ditutup' ?>
                            </span>
                        </div>

                        <?php if (isset($reports['magang'])): $rep = $reports['magang']; ?>
                            <!-- Status Submission -->
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 mb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xs font-bold text-slate-600">Status Laporan Anda</span>
                                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest 
                                        <?= $rep['status'] === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($rep['status'] === 'rejected' ? 'bg-rose-100 text-rose-700' : 'bg-sky-100 text-sky-700') ?>">
                                        <?= strtoupper($rep['status']) ?>
                                    </span>
                                </div>
                                <button @click="openPreview('<?= base_url('mahasiswa/milestone/view/'.$rep['id']) ?>')" class="w-full py-2 rounded-xl border border-sky-200 text-sky-600 text-xs font-bold hover:bg-sky-50 transition-colors flex items-center justify-center gap-2">
                                    <i class="fas fa-file-pdf"></i> Lihat Berkas
                                </button>
                                <?php if ($rep['dosen_note']): ?>
                                    <div class="mt-4 p-3 bg-white rounded-xl border border-slate-100">
                                        <p class="text-[10px] uppercase font-black text-slate-400 tracking-widest mb-1">Catatan Dosen</p>
                                        <p class="text-xs text-slate-600 italic">"<?= esc($rep['dosen_note']) ?>"</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($isOpen && (!isset($reports['magang']) || $reports['magang']['status'] === 'rejected' || $reports['magang']['status'] === 'revision')): ?>
                            <form action="<?= base_url('mahasiswa/milestone/submit') ?>" method="post" enctype="multipart/form-data" class="space-y-4">
                                <?= csrf_field() ?>
                                <input type="hidden" name="schedule_id" value="<?= $sched['id'] ?>">
                                
                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Catatan Tambahan (Opsional)</label>
                                    <textarea name="notes" class="input-field min-h-[100px]" placeholder="Berikan keterangan singkat mengenai laporan magang ini..."><?= isset($reports['magang']) ? esc($reports['magang']['notes']) : '' ?></textarea>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-3">
                                        <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Berkas Laporan Magang (PDF)</label>
                                        <div class="relative group h-[180px]">
                                            <input type="file" name="file_report" accept="application/pdf" 
                                                   @change="fileNameMagang = $event.target.files[0] ? $event.target.files[0].name : ''"
                                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                            <div class="h-full border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 group-hover:bg-emerald-50 group-hover:border-emerald-200 transition-all flex flex-col items-center justify-center text-center p-6">
                                                <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                                    <i class="fas fa-cloud-arrow-up text-xl text-emerald-500"></i>
                                                </div>
                                                <p class="text-sm font-bold text-slate-700">Pilih Berkas PDF</p>
                                                <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-widest font-black">Maksimal 5MB</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <label class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Pratinjau Berkas</label>
                                        <div class="h-[180px] p-6 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col justify-center items-center text-center">
                                            <template x-if="!fileNameMagang">
                                                <div class="space-y-2 opacity-50">
                                                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mx-auto mb-2">
                                                        <i class="fas fa-file-pdf text-xl text-slate-400"></i>
                                                    </div>
                                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Belum Ada Berkas</p>
                                                </div>
                                            </template>
                                            <template x-if="fileNameMagang">
                                                <div class="w-full animate-fade-in">
                                                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 flex items-center justify-center mx-auto mb-4 border border-emerald-100 text-emerald-500">
                                                        <i class="fas fa-file-pdf text-2xl"></i>
                                                    </div>
                                                    <p class="text-xs font-bold text-slate-700 truncate px-4" x-text="fileNameMagang"></p>
                                                    <div class="mt-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-100 text-[9px] font-black text-emerald-700 uppercase tracking-widest">
                                                        <i class="fas fa-check-circle"></i> Siap Unggah
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="w-full py-3.5 bg-linear-to-r from-emerald-600 to-emerald-500 text-white rounded-2xl font-bold shadow-lg shadow-emerald-200 hover:shadow-emerald-300 hover:-translate-y-0.5 transition-all">
                                    Unggah Laporan Magang
                                </button>
                            </form>
                        <?php elseif (!$isOpen): ?>
                            <div class="p-8 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                                <i class="fas fa-lock text-3xl text-slate-300 mb-3 block"></i>
                                <p class="text-sm font-medium text-slate-500 italic">Pengumpulan laporan magang belum dibuka.</p>
                            </div>
                        <?php endif; ?>

                    <?php else: ?>
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-calendar-xmark text-slate-300 text-xl"></i>
                            </div>
                            <h4 class="font-bold text-slate-800 mb-1">Jadwal Belum Diatur</h4>
                            <p class="text-sm text-slate-500 italic">Admin belum merilis jadwal pengumpulan laporan magang.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </template>

        </div>

        <!-- Right: Information & Guidelines -->
        <div class="lg:col-span-5 space-y-6">
            <div class="card-premium">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-sky-500"></i>
                    Panduan Pengumpulan
                </h3>
                <ul class="space-y-4">
                    <li class="flex gap-3">
                        <div class="w-5 h-5 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center text-[10px] font-bold shrink-0">1</div>
                        <p class="text-xs text-slate-600 leading-relaxed">Gunakan format laporan yang telah disediakan oleh panitia PMW.</p>
                    </li>
                    <li class="flex gap-3">
                        <div class="w-5 h-5 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center text-[10px] font-bold shrink-0">2</div>
                        <p class="text-xs text-slate-600 leading-relaxed">Pastikan seluruh tanda tangan pembimbing dan ketua telah dibubuhi (jika diperlukan).</p>
                    </li>
                    <li class="flex gap-3">
                        <div class="w-5 h-5 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center text-[10px] font-bold shrink-0">3</div>
                        <p class="text-xs text-slate-600 leading-relaxed">Ukuran berkas maksimal <span class="font-bold">5MB</span> dalam format <span class="font-bold">PDF</span>.</p>
                    </li>
                    <li class="flex gap-3">
                        <div class="w-5 h-5 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center text-[10px] font-bold shrink-0">4</div>
                        <p class="text-xs text-slate-600 leading-relaxed">Setelah diunggah, dosen pendamping akan memverifikasi laporan Anda.</p>
                    </li>
                </ul>
            </div>

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
                        <i class="fas fa-file-lines"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">Pratinjau Laporan</h3>
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
