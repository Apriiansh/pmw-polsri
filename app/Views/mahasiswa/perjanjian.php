<?php

use App\Models\Proposal\PmwProposalModel;

?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-5xl mx-auto" x-data="wawancaraForm()">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Perjanjian <span class="text-gradient">Implementasi</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Penandatanganan berkas hasil perjanjian wirausaha</p>
        </div>
        <div class="flex items-center gap-2">
             <a href="<?= base_url('mahasiswa/pitching-desk') ?>" class="btn-outline btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>

    <?php if (!$isEligible): ?>
        <div class="card-premium p-12 text-center animate-stagger">
            <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-file-signature text-3xl text-slate-300"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800">Tahap Belum Tersedia</h3>
            <p class="text-slate-500 max-w-md mx-auto mt-2"><?= esc($reason) ?></p>
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a href="<?= base_url('mahasiswa/pitching-desk') ?>" class="btn-primary">
                    Ke Pitching Desk <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="<?= base_url('dashboard') ?>" class="btn-outline">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    <?php else: ?>

    <!-- ─── STICKY ACTION BAR ────────────────────────────────────────── -->
    <div class="sticky top-4 z-20 bg-white/90 backdrop-blur-md shadow-lg border border-sky-100 rounded-2xl p-4 mb-6 animate-stagger delay-150 flex items-center justify-between gap-4 flex-wrap">
        
        <!-- Left: Status Info -->
        <div class="flex items-center gap-3 min-w-0">
            <?php
            $wStatus = $proposal['perjanjian_status'] ?? 'pending';
            $wSubmittedAt = $proposal['perjanjian_submitted_at'] ?? null;
            $hasDoc = isset($docsByKey['bukti_perjanjian']);
            $statusMap = [
                'pending'  => ['icon' => 'fa-hourglass-half', 'color' => 'amber',   'label' => 'Menunggu Verifikasi Admin'],
                'approved' => ['icon' => 'fa-circle-check',    'color' => 'emerald', 'label' => 'Berkas Disetujui ✓'],
                'revision' => ['icon' => 'fa-circle-exclamation', 'color' => 'orange', 'label' => 'Perlu Revisi Berkas'],
                'rejected' => ['icon' => 'fa-circle-xmark',    'color' => 'rose',    'label' => 'Berkas Ditolak'],
            ];
            if ($wStatus === 'pending' && !$hasDoc && empty($wSubmittedAt)) {
                $st = ['icon' => 'fa-file-pen', 'color' => 'sky', 'label' => 'Belum Diunggah'];
            } else {
                $st = $statusMap[$wStatus] ?? $statusMap['pending'];
            }
            ?>
            <div class="w-9 h-9 rounded-xl bg-<?= $st['color'] ?>-100 flex items-center justify-center shrink-0">
                <i class="fas <?= $st['icon'] ?> text-<?= $st['color'] ?>-500 text-base"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Perjanjian</p>
                <p class="text-sm font-black text-<?= $st['color'] ?>-700"><?= $st['label'] ?></p>
                <?php if (!empty($wSubmittedAt)): ?>
                    <p class="text-[10px] text-<?= $st['color'] ?>-500 font-mono">
                        Dikirim: <?= date('d M Y H:i', strtotime($wSubmittedAt)) ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right: Action Summary -->
        <?php if (!empty($wSubmittedAt)): ?>
        <div class="flex items-center gap-2 shrink-0">
            <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-100">
                <i class="fas fa-file-pdf text-rose-400 text-xs"></i>
                <span class="text-[11px] font-black text-slate-600">PDF Terunggah</span>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- ================================================================
         2. PHASE INFO
    ================================================================= -->
    <div class="grid md:grid-cols-2 gap-6 animate-stagger delay-100">
        <!-- Period Card -->
        <div class="card-premium p-5 flex flex-col justify-between" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Periode</p>
            <p class="text-base font-bold text-slate-800 mt-1">
                <?= $activePeriod ? esc($activePeriod['name']) . ' ' . esc($activePeriod['year']) : '-' ?>
            </p>
            <div class="mt-4 pt-4 border-t border-slate-50">
                <p class="text-[11px] font-bold text-slate-500 italic"><?= $proposal['nama_usaha'] ?></p>
            </div>
        </div>

        <!-- Schedule Card -->
        <div class="card-premium p-5 border-l-4 <?= $isPhaseOpen ? 'border-l-emerald-500' : 'border-l-rose-500' ?>" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Jadwal Pengunggahan</p>
            <p class="text-sm font-bold text-slate-800 mt-1">
                <?= $phase ? (formatIndonesianDate($phase['start_date']) . ' - ' . formatIndonesianDate($phase['end_date'])) : 'Belum dijadwalkan' ?>
            </p>
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-black mt-3 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700" : "bg-rose-50 text-rose-700" ?>">
                <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                <?= $isPhaseOpen ? 'TAHAPAN DIBUKA' : 'TAHAPAN DITUTUP' ?>
            </span>
        </div>
    </div>

    <!-- ================================================================
         3. WORKFLOW STEPS
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-list-check text-sky-500 mr-2"></i>
                Alur Penyelesaian Perjanjian
            </h3>
        </div>
        <div class="p-5 sm:p-7">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="flex flex-col items-center text-center group cursor-default">
                    <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-500 flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 group-hover:rotate-3 transition-transform">
                        <i class="fas fa-file-signature text-xl"></i>
                    </div>
                    <h4 class="text-sm font-bold text-slate-800 mb-1">1. Tanda Tangan UPK2</h4>
                    <p class="text-xs text-slate-500 px-4 leading-relaxed">Mendapat dokumen Perjanjian Implementasi yang telah ditandatangani UPK2.</p>
                </div>
                <!-- Step 2 -->
                <div class="flex flex-col items-center text-center group cursor-default">
                    <div class="w-14 h-14 rounded-2xl bg-violet-50 text-violet-500 flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 group-hover:-rotate-3 transition-transform">
                        <i class="fas fa-pen-nib text-xl"></i>
                    </div>
                    <h4 class="text-sm font-bold text-slate-800 mb-1">2. Tanda Tangan Mahasiswa</h4>
                    <p class="text-xs text-slate-500 px-4 leading-relaxed">Menandatangani dokumen (Ketua & Anggota) dan melengkapi materai.</p>
                </div>
                <!-- Step 3 -->
                <div class="flex flex-col items-center text-center group cursor-default">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 group-hover:rotate-3 transition-transform">
                        <i class="fas fa-cloud-arrow-up text-xl"></i>
                    </div>
                    <h4 class="text-sm font-bold text-slate-800 mb-1">3. Scan & Upload</h4>
                    <p class="text-xs text-slate-500 px-4 leading-relaxed">Mengunggah hasil scan dokumen (PDF) yang sudah lengkap tanda tangan & stempel.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================
         4. ACTION AREA
    ================================================================= -->
    <div class="grid animate-stagger delay-300">
        
        <!-- Upload Section -->
        <div class="card-premium p-6 sm:p-8 flex flex-col mx-auto w-full max-w-xl" @mousemove="handleMouseMove">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <i class="fas fa-upload text-emerald-500"></i>
                Upload Berkas Perjanjian
            </h3>
            
            <div class="flex-1 flex flex-col justify-center">
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:border-emerald-200 transition-all group relative">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-slate-400 group-hover:text-emerald-500 shadow-sm shrink-0">
                            <i class="fas fa-file-signature text-xl"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-slate-700">Bukti Perjanjian Implementasi (PDF)</p>
                            <p class="text-xs text-slate-500 mt-1 truncate">
                                <span x-text="perjanjianFilename || 'Belum ada file diunggah'"></span>
                            </p>
                            
                            <!-- Progress Badge -->
                            <div class="mt-2 flex items-center gap-2">
                                <template x-if="perjanjianStatus === 'uploaded'">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-black bg-emerald-100 text-emerald-700 uppercase tracking-tighter" :class="isLocked ? 'ring-1 ring-emerald-200' : ''">
                                        <i class="fas fa-check-circle mr-1"></i> 
                                        <span x-text="isLocked ? 'Berkas Sah & Terkunci' : 'Tersimpan'"></span>
                                    </span>
                                </template>
                                <template x-if="perjanjianStatus === 'uploading'">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-black bg-sky-100 text-sky-700 animate-pulse uppercase tracking-tighter">
                                        <i class="fas fa-spinner fa-spin mr-1"></i> Proses...
                                    </span>
                                </template>
                            </div>
                        </div>
                    </div>

                    <?php if ($isLocked): ?>
                    <div class="mt-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-lg shadow-emerald-200">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div>
                            <p class="text-[11px] font-black text-emerald-800 uppercase tracking-tight">Perjanjian Final</p>
                            <p class="text-[10px] text-emerald-600 font-medium">Berkas telah divalidasi dan tidak dapat diubah kembali.</p>
                        </div>
                    </div>
                    <?php elseif ($isPhaseOpen): ?>
                    <div class="mt-6">
                        <label class="relative block cursor-pointer group/upload">
                            <div class="btn-outline w-full py-4 flex items-center justify-center gap-2 border-2 border-dashed border-slate-200 grow group-hover/upload:border-emerald-400 group-hover/upload:text-emerald-600 transition-all">
                                <i class="fas fa-cloud-arrow-up text-lg"></i>
                                <span class="text-sm font-bold">Pilih & Upload Hasil Scan</span>
                            </div>
                            <input type="file" class="hidden" accept="application/pdf" @change="handleFileUpload($event)">
                        </label>
                        <p class="text-[10px] text-slate-400 mt-3 text-center">Harap pastikan berkas sudah ditandatangani lengkap (PDF, Max 2MB)</p>
                    </div>
                    <?php else: ?>
                    <div class="mt-6 p-3 rounded-lg bg-rose-50 border border-rose-100 text-center">
                        <p class="text-xs text-rose-600 font-bold">
                            <i class="fas fa-lock mr-1"></i> Upload Ditutup
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>
</div><!-- /page wrapper -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function wawancaraForm() {
    <?php
    $perjanjianDoc = $docsByKey['bukti_perjanjian'] ?? null;
    ?>
    return {
        perjanjianStatus: '<?= $perjanjianDoc ? 'uploaded' : 'missing' ?>',
        perjanjianFilename: <?= json_encode($perjanjianDoc['original_name'] ?? '') ?>,
        isLocked: <?= ($isLocked ?? false) ? 'true' : 'false' ?>,

        handleMouseMove(e) {
            const card = e.currentTarget;
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
            card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
        },

        handleFileUpload(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Validate PDF
            if (file.type !== 'application/pdf') {
                Swal.fire({
                    title: 'Bukan PDF',
                    text: 'Harap unggah berkas dalam format PDF.',
                    icon: 'error',
                    confirmButtonColor: '#3b82f6'
                });
                return;
            }

            // Validate Size
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    title: 'Terlalu Besar',
                    text: 'Ukuran file maksimal adalah 2MB.',
                    icon: 'error',
                    confirmButtonColor: '#3b82f6'
                });
                return;
            }

            this.perjanjianStatus = 'uploading';

            const formData = new FormData();
            formData.append('perjanjian_file', file);
            formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

            fetch('<?= base_url('mahasiswa/perjanjian/upload') ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.perjanjianStatus = 'uploaded';
                    this.perjanjianFilename = data.filename;
                    
                    // Centralized Toast Notification
                    window.dispatchEvent(new CustomEvent('toast-notify', {
                        detail: { message: data.message, type: 'success' }
                    }));

                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Berkas perjanjian Anda telah diunggah dan siap divalidasi.',
                        icon: 'success',
                        confirmButtonColor: '#10b981'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    this.perjanjianStatus = 'missing';
                    Swal.fire('Gagal', data.message, 'error');
                }
            })
            .catch(() => {
                this.perjanjianStatus = 'missing';
                Swal.fire('Error', 'Terjadi kesalahan pada server.', 'error');
            });
        }
    }
}
</script>
<?= $this->endSection() ?>
