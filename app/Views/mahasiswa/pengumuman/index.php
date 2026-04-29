<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="pengumumanMahasiswa()">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Pengumuman Kelolosan Dana <span class="text-gradient">Tahap I</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Pengumuman lolos & info pembekalan</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-6 animate-stagger delay-100">
        <div class="card-premium p-5 flex flex-col justify-between" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Periode</p>
            <p class="text-base font-bold text-slate-800 mt-1">
                <?= $activePeriod ? esc($activePeriod['name']) . ' - ' . esc($activePeriod['year']) : '-' ?>
            </p>
            <div class="mt-4 pt-4 border-t border-slate-50">
                <p class="text-[11px] font-bold text-slate-500 italic"><?= esc($activePeriod['year'] ?? '') ?></p>
            </div>
        </div>

        <div class="card-premium p-5 border-l-4 <?= $isPhaseOpen ? 'border-l-emerald-500' : 'border-l-rose-500' ?>" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Jadwal Pengumuman</p>
            <p class="text-sm font-bold text-slate-800 mt-1">
                <?= $phase ? (formatIndonesianDate($phase['start_date']) . ' - ' . formatIndonesianDate($phase['end_date'])) : 'Belum dijadwalkan' ?>
            </p>
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-black mt-3 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700" : "bg-rose-50 text-rose-700" ?>">
                <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                <?= $isPhaseOpen ? 'TAHAPAN DIBUKA' : 'TAHAPAN DITUTUP' ?>
            </span>
        </div>

        <div class="card-premium p-5 border-l-4 <?= $isPassed ? 'border-l-emerald-500' : 'border-l-amber-500' ?>" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Anda</p>
            <div class="flex items-center gap-2 mt-1">
                <i class="fas <?= $isPassed ? 'fa-circle-check text-emerald-500' : 'fa-circle-info text-amber-500' ?>"></i>
                <p class="text-sm font-bold text-slate-800 uppercase">
                    <?= $isPassed ? 'Lolos Tahap I' : 'Belum Lolos / Belum Diproses' ?>
                </p>
            </div>
            <p class="text-[11px] text-slate-500 mt-2">
                <?= $isPassed ? 'Anda lolos Tahap I. Silakan input data rekening dan catat jadwal pembekalan.' : 'Jika Anda lolos, informasi akan muncul saat Tahap 5 dibuka.' ?>
            </p>
        </div>
    </div>

    <?php if ($isPassed && $proposal): ?>
    <!-- ================================================================
         TIM ASSIGNMENT (DOSEN & MENTOR)
    ================================================================= -->
    <div class="grid md:grid-cols-2 gap-6 animate-stagger delay-125">
        <div class="card-premium p-5 flex items-center gap-4" @mousemove="handleMouseMove">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 flex items-center justify-center shrink-0">
                <i class="fas fa-chalkboard-teacher text-xl text-sky-500"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Dosen Pendamping</p>
                <h4 class="text-sm font-bold text-slate-800 truncate"><?= esc($proposal['dosen_nama'] ?? 'Belum Ditunjuk') ?></h4>
                <p class="text-[11px] text-slate-500">Internal Polsri</p>
            </div>
        </div>
        <div class="card-premium p-5 flex items-center gap-4" @mousemove="handleMouseMove">
            <div class="w-12 h-12 rounded-2xl bg-violet-50 flex items-center justify-center shrink-0">
                <i class="fas fa-user-tie text-xl text-violet-500"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Mentor Praktisi</p>
                <h4 class="text-sm font-bold text-slate-800 truncate"><?= esc($proposal['mentor_nama'] ?? 'Belum Ditunjuk') ?></h4>
                <p class="text-[11px] text-slate-500">Eksternal / Praktisi</p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($isPassed && $isPhaseOpen): ?>
    <div class="grid md:grid-cols-1 gap-6 animate-stagger delay-150">
        <div class="card-premium p-5 border-l-4 <?= ($hasBankData ?? false) ? 'border-l-emerald-500' : 'border-l-amber-500' ?>" @mousemove="handleMouseMove">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Data Rekening Bank</p>
                    <div class="flex items-center gap-2 mt-1">
                        <i class="fas <?= ($hasBankData ?? false) ? 'fa-circle-check text-emerald-500' : 'fa-circle-exclamation text-amber-500' ?>"></i>
                        <p class="text-sm font-bold text-slate-800">
                            <?= ($hasBankData ?? false) ? 'Data rekening sudah lengkap' : 'Data rekening belum lengkap' ?>
                        </p>
                    </div>
                    <p class="text-[11px] text-slate-500 mt-2">
                        <?= ($hasBankData ?? false) 
                            ? 'Terima kasih telah mengisi data rekening untuk pencairan dana.' 
                            : 'Silakan lengkapi data rekening bank Anda untuk keperluan pencairan dana PMW.' ?>
                    </p>
                </div>
                <a href="<?= base_url('mahasiswa/pengumuman/rekening') ?>" class="btn-primary btn-sm whitespace-nowrap">
                    <i class="fas fa-university mr-2"></i>
                    <?= ($hasBankData ?? false) ? 'Lihat/Edit Data Rekening' : 'Input Data Rekening' ?>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class=" animate-stagger delay-200">

        <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">Pengumuman & File SK</h3>
                <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5">Pengumuman resmi dan Surat Keputusan (SK)</p>
            </div>

            <div class="p-5 sm:p-7">
                <?php if (!$isPhaseOpen): ?>
                    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-100">
                        <p class="text-sm font-bold text-rose-700"><i class="fas fa-lock mr-2"></i>Pengumuman belum dibuka.</p>
                    </div>
                <?php elseif (!$isPassed): ?>
                    <div class="p-4 rounded-2xl bg-amber-50 border border-amber-100">
                        <p class="text-sm font-bold text-amber-700"><i class="fas fa-shield mr-2"></i>Pengumuman hanya untuk peserta yang lolos Tahap I.</p>
                    </div>
                <?php elseif (!$announcement || (int) $announcement->is_published !== 1): ?>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                        <p class="text-sm font-bold text-slate-700"><i class="fas fa-clock mr-2"></i>Pengumuman belum dipublish oleh admin.</p>
                    </div>
                <?php else: ?>

                    <div class="space-y-4">
                        <div>
                            <h4 class="text-base font-black text-slate-800"><?= esc($announcement->title ?? 'Pengumuman') ?></h4>
                            <?php if (!empty($announcement->content)): ?>
                                <p class="text-[12px] text-slate-600 mt-1 leading-relaxed"><?= nl2br(esc((string) $announcement->content)) ?></p>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($announcement->sk_file_path)): ?>
                            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-file-pdf text-emerald-500 text-xl"></i>
                                    <div>
                                        <p class="text-sm font-semibold text-emerald-700">File SK Direktur</p>
                                        <p class="text-[11px] text-emerald-600"><?= esc($announcement->sk_original_name ?? 'SK.pdf') ?></p>
                                    </div>
                                </div>
                                <a href="<?= base_url('mahasiswa/pengumuman/sk') ?>" class="btn-outline btn-sm bg-emerald-100 text-emerald-700 border-emerald-200 hover:bg-emerald-500 hover:text-white">
                                    <i class="fas fa-download mr-1.5"></i> Download
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($announcement->training_date) || !empty($announcement->training_location)): ?>
                            <div class="p-4 rounded-2xl bg-sky-50 border border-sky-200">
                                <h5 class="text-sm font-bold text-sky-700 mb-2"><i class="fas fa-calendar-check mr-1.5"></i> Jadwal Pembekalan (Tahap 6)</h5>
                                <?php if (!empty($announcement->training_date)): ?>
                                    <p class="text-[12px] text-sky-600"><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($announcement->training_date)) ?> WIB</p>
                                <?php endif; ?>
                                <?php if (!empty($announcement->training_location)): ?>
                                    <p class="text-[12px] text-sky-600 mt-1"><strong>Lokasi:</strong> <?= esc($announcement->training_location) ?></p>
                                <?php endif; ?>
                                <?php if (!empty($announcement->training_details)): ?>
                                    <p class="text-[12px] text-sky-600 mt-2"><?= nl2br(esc((string) $announcement->training_details)) ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function pengumumanMahasiswa() {
    return {
        handleMouseMove(e) {
            const card = e.currentTarget;
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
            card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
        }
    }
}
</script>
<?= $this->endSection() ?>
