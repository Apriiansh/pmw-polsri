<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6" x-data="{ 
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        card.style.setProperty('--mouse-x', `${x}px`);
        card.style.setProperty('--mouse-y', `${y}px`);
    }
}">
    <!-- Breadcrumb & Title -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">
                <a href="<?= base_url('admin/finalisasi') ?>" class="hover:text-sky-500 transition-colors">Finalisasi</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-slate-600">Audit Detail</span>
            </div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight"><?= esc($header_title) ?></h1>
            <p class="text-slate-500 text-sm"><?= esc($header_subtitle) ?></p>
        </div>

        <div class="flex items-center gap-3">
            <a href="<?= base_url('admin/finalisasi') ?>" class="px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-all flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Summary Statistics for Audit -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Bimbingan Stat -->
        <?php $bimbinganCount = count(array_filter($guidanceLogs, fn($l) => $l->type === 'bimbingan' && $l->status === 'approved')); ?>
        <div class="card-premium p-4 border-l-4 border-l-amber-500" @mousemove="handleMouseMove">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-slate-400 font-bold uppercase">Log Bimbingan</span>
                <i class="fas fa-chalkboard-teacher text-amber-500"></i>
            </div>
            <p class="text-2xl font-black text-slate-800"><?= $bimbinganCount ?></p>
            <p class="text-[9px] text-slate-400 mt-1 italic">Total Terverifikasi Dosen</p>
        </div>

        <!-- Mentoring Stat -->
        <?php $mentoringCount = count(array_filter($guidanceLogs, fn($l) => $l->type === 'mentoring' && $l->status === 'approved')); ?>
        <div class="card-premium p-4 border-l-4 border-l-emerald-500" @mousemove="handleMouseMove">
            <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] text-slate-400 font-bold uppercase">Log Mentoring</span>
                <i class="fas fa-user-tie text-emerald-500"></i>
            </div>
            <p class="text-2xl font-black text-slate-800"><?= $mentoringCount ?></p>
            <p class="text-[9px] text-slate-400 mt-1 italic">Total Terverifikasi Mentor</p>
        </div>

        <!-- Milestone Status -->
        <?php 
            $kemajuan = array_filter($milestoneReports, fn($r) => $r['type'] === 'kemajuan' && $r['status'] === 'approved');
            $akhir = array_filter($milestoneReports, fn($r) => $r['type'] === 'akhir' && $r['status'] === 'approved');
        ?>
        <div class="card-premium p-4 border-l-4 border-l-sky-500" @mousemove="handleMouseMove">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] text-slate-400 font-bold uppercase">Lap. Kemajuan</span>
                <i class="fas <?= !empty($kemajuan) ? 'fa-check-circle text-emerald-500' : 'fa-times-circle text-slate-300' ?>"></i>
            </div>
            <p class="text-sm font-bold <?= !empty($kemajuan) ? 'text-emerald-600' : 'text-slate-400' ?>">
                <?= !empty($kemajuan) ? 'SUDAH DISETUJUI' : 'BELUM DISETUJUI' ?>
            </p>
        </div>

        <div class="card-premium p-4 border-l-4 border-l-indigo-500" @mousemove="handleMouseMove">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[10px] text-slate-400 font-bold uppercase">Lap. Akhir</span>
                <i class="fas <?= !empty($akhir) ? 'fa-check-circle text-emerald-500' : 'fa-times-circle text-slate-300' ?>"></i>
            </div>
            <p class="text-sm font-bold <?= !empty($akhir) ? 'text-emerald-600' : 'text-slate-400' ?>">
                <?= !empty($akhir) ? 'SUDAH DISETUJUI' : 'BELUM DISETUJUI' ?>
            </p>
        </div>
    </div>

    <!-- Finalization Action Card -->
    <div class="card-premium border-2 border-sky-100 overflow-hidden" @mousemove="handleMouseMove">
        <div class="px-6 py-4 bg-sky-50/50 border-b border-sky-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-sky-500 text-white flex items-center justify-center">
                    <i class="fas fa-gavel"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 uppercase tracking-tight">Keputusan Penetapan Dana Tahap II</h3>
                    <p class="text-xs text-sky-600 font-medium">Tentukan status kelolosan akhir berdasarkan hasil audit di atas</p>
                </div>
            </div>
            <?php if ($finalization): ?>
                <div class="flex flex-col items-end">
                    <span class="px-3 py-1 rounded-full <?= $finalization['admin_status'] === 'approved' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' ?> text-[10px] font-black uppercase mb-1">
                        <?= $finalization['admin_status'] === 'approved' ? 'LOLOS DANA II' : 'TIDAK LOLOS' ?>
                    </span>
                    <p class="text-[10px] text-slate-400 italic">Audit oleh: <?= esc($finalization['admin_id'] ?? 'Admin') ?> pada <?= date('d/m/Y', strtotime($finalization['admin_verified_at'])) ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="p-6">
            <form action="<?= base_url('admin/finalisasi/validate') ?>" method="post" class="space-y-6">
                <?= csrf_field() ?>
                <input type="hidden" name="proposal_id" value="<?= $proposal['id'] ?>">

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Decision -->
                    <div class="space-y-4">
                        <label class="text-xs font-black text-slate-500 uppercase tracking-wider block">Pilih Status Kelolosan</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative block group cursor-pointer">
                                <input type="radio" name="status" value="approved" class="peer hidden" <?= ($finalization['admin_status'] ?? '') === 'approved' ? 'checked' : '' ?> required>
                                <div class="p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50/30 group-hover:border-slate-200 transition-all text-center">
                                    <div class="w-12 h-12 rounded-full bg-slate-100 peer-checked:bg-emerald-500 flex items-center justify-center mx-auto mb-3 transition-all">
                                        <i class="fas fa-check text-slate-400 group-hover:text-slate-600 peer-checked:text-emerald-500"></i>
                                    </div>
                                    <p class="font-bold text-slate-600 group-hover:text-slate-800">LOLOS</p>
                                    <p class="text-[10px] text-slate-400 mt-1">Tim Berhak Menerima Sisa Dana</p>
                                </div>
                                <div class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-opacity">
                                    <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                                </div>
                            </label>

                            <label class="relative block group cursor-pointer">
                                <input type="radio" name="status" value="rejected" class="peer hidden" <?= ($finalization['admin_status'] ?? '') === 'rejected' ? 'checked' : '' ?> required>
                                <div class="p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-rose-500 peer-checked:bg-rose-50/30 group-hover:border-slate-200 transition-all text-center">
                                    <div class="w-12 h-12 rounded-full bg-slate-100 peer-checked:bg-rose-500 flex items-center justify-center mx-auto mb-3 transition-all">
                                        <i class="fas fa-times text-slate-400 group-hover:text-slate-600 peer-checked:text-rose-500"></i>
                                    </div>
                                    <p class="font-bold text-slate-600 group-hover:text-slate-800">TIDAK LOLOS</p>
                                    <p class="text-[10px] text-slate-400 mt-1">Evaluasi Gagal / Melanggar Aturan</p>
                                </div>
                                <div class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-opacity">
                                    <i class="fas fa-check-circle text-rose-500 text-lg"></i>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="space-y-4">
                        <label class="text-xs font-black text-slate-500 uppercase tracking-wider block">Catatan Audit (Opsional)</label>
                        <textarea name="admin_notes" rows="4" 
                            class="form-textarea"
                            placeholder="Tuliskan alasan keputusan atau evaluasi untuk tim..."><?= esc($finalization['admin_catatan'] ?? '') ?></textarea>
                        <p class="text-[10px] text-slate-400 italic">Catatan ini akan dapat dilihat oleh tim mahasiswa di dashboard mereka.</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-slate-100">
                    <button type="reset" class="px-6 py-2.5 rounded-xl text-slate-500 text-sm font-bold hover:bg-slate-50 transition-all">
                        Reset
                    </button>
                    <button type="submit" class="px-8 py-2.5 rounded-xl bg-sky-500 text-white text-sm font-black hover:bg-sky-600 transition-all shadow-lg shadow-sky-200 flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        Simpan Keputusan Final
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Team Detail Summary (The Partial) -->
    <div class="mt-12">
        <div class="flex items-center gap-4 mb-6">
            <h3 class="text-lg font-black text-slate-800 uppercase tracking-tight">Data Dukung Audit</h3>
            <div class="h-px flex-1 bg-slate-100"></div>
        </div>
        <?= view('admin/teams/_summary') ?>
    </div>
</div>

<style>
/* Peer-checked radio logic refinement */
input[type="radio"]:checked + div .fa-check { color: #10b981 !important; }
input[type="radio"]:checked + div .fa-times { color: #f43f5e !important; }
input[type="radio"]:checked + div { border-color: currentColor !important; }
</style>

<?= $this->endSection() ?>
