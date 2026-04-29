<?php

/** @var array $proposal */
/** @var array $members */
/** @var array $docsByKey */
/** @var array $mentors */
?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="adminVerification()">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Verifikasi <span class="text-gradient">Perjanjian</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Memeriksa kelengkapan dan keabsahan berkas perjanjian implementasi</p>
        </div>
        <a href="<?= base_url('admin/perjanjian') ?>" class="btn-ghost inline-flex items-center gap-2">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <?php if (!$proposal): ?>
        <div class="card-premium p-8 text-center">
            <i class="fas fa-exclamation-circle text-4xl text-rose-400 mb-3"></i>
            <p class="text-slate-500">Proposal tidak ditemukan</p>
        </div>
    <?php else: ?>

        <?php
        $statusColors = [
            'pending'  => 'bg-yellow-50 text-yellow-600 border-yellow-200',
            'approved' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
            'revision' => 'bg-orange-50 text-orange-600 border-orange-200',
            'rejected' => 'bg-rose-50 text-rose-600 border-rose-200',
        ];
        $statusLabels = [
            'pending'  => 'Menunggu Verifikasi',
            'approved' => 'Berkas Disetujui',
            'revision' => 'Perlu Revisi Berkas',
            'rejected' => 'Berkas Ditolak',
        ];
        ?>

        <!-- ================================================================
         2. PROPOSAL SUMMARY
    ================================================================= -->
        <div class="card-premium overflow-hidden animate-stagger delay-100" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="font-display text-base font-bold text-(--text-heading)">
                        <i class="fas fa-building text-sky-500 mr-2"></i>
                        <?= esc($proposal['nama_usaha'] ?: 'Proposal #' . $proposal['id']) ?>
                    </h3>
                    <p class="text-[11px] text-(--text-muted) mt-0.5">
                        <?= esc($proposal['period_name'] ?? '-') ?> - <?= esc($proposal['period_year'] ?? '') ?>
                    </p>
                </div>
                <span class="pmw-status <?= $statusColors[$proposal['perjanjian_status']] ?? '' ?>">
                    <i class="fas fa-circle text-[8px]"></i>
                    <?= $statusLabels[$proposal['perjanjian_status']] ?? ucfirst($proposal['perjanjian_status']) ?>
                </span>
            </div>

            <div class="p-5 sm:p-7 grid md:grid-cols-4 gap-4">
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Ketua Tim</p>
                    <p class="text-sm font-bold text-slate-700"><?= esc($proposal['ketua_nama']) ?></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Dosen Pendamping</p>
                    <p class="text-sm font-bold text-slate-700"><?= esc($proposal['dosen_nama']) ?></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Total Dana Disetujui</p>
                    <p class="text-sm font-bold text-emerald-600">Rp <?= number_format($proposal['total_rab'], 0, ',', '.') ?></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Mentor (Praktisi)</p>
                    <p class="text-sm font-bold text-sky-600"><?= esc($proposal['mentor_nama'] ?? 'Belum Ditentukan') ?></p>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Status Pitching Desk</p>
                    <span class="px-2 py-0.5 rounded text-[10px] bg-emerald-100 text-emerald-600 font-black">FULL APPROVED</span>
                </div>
            </div>
        </div>

        <!-- ================================================================
         3. VERIFICATION CONTENT
    ================================================================= -->
        <div class="grid lg:grid-cols-3 gap-6 animate-stagger delay-200">

            <!-- Document Viewer -->
            <div class="lg:col-span-2 space-y-6">
                <div class="card-premium overflow-hidden flex flex-col h-[calc(100vh-200px)] min-h-[500px]" @mousemove="handleMouseMove">
                    <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between shrink-0">
                        <h3 class="font-display text-base font-bold text-(--text-heading)">
                            <i class="fas fa-file-pdf text-rose-500 mr-2"></i>
                            Berkas Perjanjian (Scan PDF)
                        </h3>
                        <?php if (isset($docsByKey['bukti_perjanjian'])): ?>
                            <div class="flex items-center gap-2">
                                <a href="<?= base_url('admin/perjanjian/doc/' . $docsByKey['bukti_perjanjian']['id']) ?>" class="btn-outline btn-xs">
                                    <i class="fas fa-download mr-1"></i> Download
                                </a>
                                <a href="<?= base_url('admin/perjanjian/doc/' . $docsByKey['bukti_perjanjian']['id'] . '?inline=1') ?>" target="_blank" class="btn-outline btn-xs">
                                    <i class="fas fa-expand-alt mr-1"></i> Layar Penuh
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="flex-1 bg-slate-100 relative">
                        <?php if (isset($docsByKey['bukti_perjanjian'])): ?>
                            <iframe src="<?= base_url('admin/perjanjian/doc/' . $docsByKey['bukti_perjanjian']['id'] . '?inline=1') ?>" class="w-full h-full border-none"></iframe>
                        <?php else: ?>
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-400 p-8 text-center">
                                <div class="w-20 h-20 rounded-full bg-slate-200 flex items-center justify-center mb-4">
                                    <i class="fas fa-file-circle-exclamation text-3xl"></i>
                                </div>
                                <h4 class="font-bold text-slate-600">Berkas Belum Diunggah</h4>
                                <p class="text-sm max-w-xs mt-2">Mahasiswa belum mengunggah scan berkas perjanjian yang sudah ditanda tangani.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Validation Form Sidebar -->
            <div class="space-y-6">

                <!-- Checklist Card (Static reference) -->
                <div class="card-premium p-5 bg-slate-50 border border-slate-100" @mousemove="handleMouseMove">
                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Checklist Verifikasi</h4>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="w-5 h-5 rounded bg-emerald-500 flex items-center justify-center text-white shrink-0 mt-0.5">
                                <i class="fas fa-check text-[10px]"></i>
                            </div>
                            <p class="text-[11px] text-slate-600">Kesesuaian identitas (Nama Usaha, Nama Ketua, & Anggota)</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-5 h-5 rounded bg-emerald-500 flex items-center justify-center text-white shrink-0 mt-0.5">
                                <i class="fas fa-check text-[10px]"></i>
                            </div>
                            <p class="text-[11px] text-slate-600">Kelengkapan rincian komponen (Jumlah, Harga, & Link Pembelian)</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-5 h-5 rounded bg-emerald-500 flex items-center justify-center text-white shrink-0 mt-0.5">
                                <i class="fas fa-check text-[10px]"></i>
                            </div>
                            <p class="text-[11px] text-slate-600">Tanda Tangan Ketua Tim di atas Materai</p>
                        </div>
                    </div>
                </div>

                <!-- Validation Form -->
                <div class="card-premium overflow-hidden border-l-4 border-l-sky-500" @mousemove="handleMouseMove">
                    <div class="px-5 py-4 border-b border-sky-50 bg-white/60">
                        <h3 class="font-display text-sm font-bold text-(--text-heading)">Keputusan Verifikasi</h3>
                    </div>
                    <form action="<?= base_url('admin/perjanjian/' . $proposal['id'] . '/validate') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="p-5 space-y-6">
                            <!-- Mentor Selection -->
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Pilih Mentor Praktisi</label>
                                <div class="input-group py-2 group focus-within:ring-4 focus-within:ring-sky-100 transition-all">
                                    <div class="input-icon text-slate-400 group-focus-within:text-sky-500">
                                        <i class="fas fa-user-tie text-base"></i>
                                    </div>
                                    <select name="mentor_id" class="text-xs bg-transparent border-none focus:ring-0 w-full" required>
                                        <option value="">-- Pilih Mentor --</option>
                                        <?php foreach ($mentors as $mentor): ?>
                                            <?php
                                                $teamCount = (int)($mentor['assigned_team_count'] ?? 0);
                                                $isCurrentMentor = (int)$proposal['mentor_id'] === (int)$mentor['id'];
                                                $teamLabel = $teamCount > 0 ? " [{$teamCount} tim]" : '';
                                            ?>
                                            <option value="<?= $mentor['id'] ?>"
                                                <?= $isCurrentMentor ? 'selected' : '' ?>>
                                                <?= esc($mentor['nama']) ?> - <?= esc($mentor['company']) ?><?= $teamLabel ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <p class="text-[9px] text-slate-400">Mentor akan mendampingi tim selama masa implementasi.</p>
                            </div>

                            <!-- Status Radio Cards -->
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 block">Hasil Verifikasi Berkas</label>

                                <!-- Sah -->
                                <label class="relative cursor-pointer block">
                                    <input type="radio" name="status" value="approved" class="peer sr-only" <?= $proposal['perjanjian_status'] === 'approved' ? 'checked' : '' ?> required>
                                    <div class="p-3.5 rounded-xl border-2 border-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:border-emerald-300 shadow-sm peer-checked:shadow-emerald-100">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center peer-checked:bg-emerald-500 peer-checked:text-white transition-colors">
                                                <i class="fas fa-file-circle-check"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-(--text-heading) text-xs">SAH / DISETUJUI</p>
                                                <p class="text-[9px] text-slate-400 font-medium">Perjanjian Ditandatangani</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <!-- Revisi -->
                                <label class="relative cursor-pointer block">
                                    <input type="radio" name="status" value="revision" class="peer sr-only" <?= $proposal['perjanjian_status'] === 'revision' ? 'checked' : '' ?>>
                                    <div class="p-3.5 rounded-xl border-2 border-slate-100 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all hover:border-orange-300 shadow-sm peer-checked:shadow-orange-100">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center peer-checked:bg-orange-500 peer-checked:text-white transition-colors">
                                                <i class="fas fa-file-pen"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-(--text-heading) text-xs">PERLU REVISI</p>
                                                <p class="text-[9px] text-slate-400 font-medium">Ada Kesalahan Berkas</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <!-- Tolak -->
                                <label class="relative cursor-pointer block">
                                    <input type="radio" name="status" value="rejected" class="peer sr-only" <?= $proposal['perjanjian_status'] === 'rejected' ? 'checked' : '' ?>>
                                    <div class="p-3.5 rounded-xl border-2 border-slate-100 peer-checked:border-rose-500 peer-checked:bg-rose-50 transition-all hover:border-rose-300 shadow-sm peer-checked:shadow-rose-100">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center peer-checked:bg-rose-500 peer-checked:text-white transition-colors">
                                                <i class="fas fa-file-circle-xmark"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-(--text-heading) text-xs">TIDAK SAH / TOLAK</p>
                                                <p class="text-[9px] text-slate-400 font-medium">Dibatalkan Permanen</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Catatan -->
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Catatan Verifikasi</label>
                                <div class="input-group items-start py-2 group focus-within:ring-4 focus-within:ring-sky-100 transition-all">
                                    <div class="input-icon mt-2 text-slate-400 group-focus-within:text-sky-500">
                                        <i class="fas fa-comment-medical text-base"></i>
                                    </div>
                                    <textarea name="catatan" rows="4" class="text-xs" placeholder="Berikan instruksi perbaikan jika perlu revisi..."><?= esc($proposal['wawancara_catatan'] ?? '') ?></textarea>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn-primary w-full py-3 shadow-lg shadow-sky-100 flex items-center justify-center gap-2">
                                <i class="fas fa-save"></i>
                                Simpan Hasil Verifikasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    <?php endif; ?>

</div><!-- /page wrapper -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function adminVerification() {
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