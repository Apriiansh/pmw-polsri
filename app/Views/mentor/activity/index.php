<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="{
    showVerifyModal: false,
    selectedLogbook: null,
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Verifikasi <span class="text-gradient">Kegiatan Wirausaha</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap 9 — Review dan verifikasi logbook dari Dosen</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 gap-3 sm:gap-5">
        <?php
        $statItems = [
            ['title' => 'Total Review', 'value' => $stats['total'], 'icon' => 'fa-clipboard-check', 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500'],
            ['title' => 'Pending', 'value' => $stats['pending'], 'icon' => 'fa-clock', 'bg' => 'bg-blue-50', 'icon_color' => 'text-blue-500'],
        ];
        ?>
        <?php foreach ($statItems as $index => $stat): ?>
        <div class="card-premium p-3 sm:p-5 flex items-center gap-3 sm:gap-4 animate-stagger delay-<?= ($index + 1) * 100 ?>" @mousemove="handleMouseMove">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl <?= $stat['bg'] ?> flex items-center justify-center shrink-0">
                <i class="fas <?= $stat['icon'] ?> text-lg sm:text-xl <?= $stat['icon_color'] ?>"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] sm:text-[11px] font-black text-slate-400 uppercase tracking-wider truncate"><?= $stat['title'] ?></p>
                <h3 class="font-display text-xl sm:text-2xl font-black text-(--text-heading)"><?= $stat['value'] ?></h3>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Pending Logbooks -->
    <div class="card-premium overflow-hidden animate-stagger delay-300" @mousemove="handleMouseMove">
        <div class="px-6 py-4 border-b border-sky-50 flex items-center justify-between bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">Logbook Menunggu Verifikasi (Approved by Dosen)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="pmw-table">
                <thead>
                    <tr>
                        <th>Tanggal & Kategori</th>
                        <th>Tim</th>
                        <th>Deskripsi</th>
                        <th>Catatan Dosen</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendingLogbooks)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="text-slate-400">
                                    <i class="fas fa-check-circle text-4xl mb-3 opacity-20"></i>
                                    <p class="text-sm">Tidak ada logbook yang menunggu verifikasi.</p>
                                    <p class="text-[11px] text-slate-400 mt-1">Logbook akan muncul setelah di-approve oleh Dosen Pendamping.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pendingLogbooks as $logbook): ?>
                        <tr class="group">
                            <td class="whitespace-nowrap">
                                <div class="text-[12px] font-bold text-(--text-heading)"><?= date('d M Y', strtotime($logbook['activity_date'])) ?></div>
                                <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded bg-violet-100 text-violet-700 mt-1 inline-block"><?= esc($logbook['activity_category']) ?></span>
                                <span class="pmw-status bg-purple-50 text-purple-600 border-purple-200 text-[9px] ml-1">✓ Dosen</span>
                            </td>
                            <td>
                                <div class="text-[12px] font-semibold text-slate-700"><?= esc($logbook['nama_usaha']) ?></div>
                            </td>
                            <td>
                                <div class="text-[12px] text-slate-600 line-clamp-2 max-w-[200px]" title="<?= esc($logbook['activity_description']) ?>">
                                    <?= esc($logbook['activity_description']) ?>
                                </div>
                            </td>
                            <td>
                                <div class="text-[11px] text-slate-500 italic" title="<?= esc($logbook['dosen_note']) ?>">
                                    <?= esc($logbook['dosen_note'] ?: '-') ?>
                                </div>
                            </td>
                            <td class="text-right whitespace-nowrap">
                                <button @click="selectedLogbook = <?= htmlspecialchars(json_encode($logbook)) ?>; showVerifyModal = true" 
                                        class="btn-outline btn-xs bg-sky-50 text-sky-600 border-sky-200 hover:bg-sky-500 hover:text-white transition-all">
                                    <i class="fas fa-magnifying-glass mr-1"></i> Review
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Teams Info -->
    <div class="card-premium p-6 animate-stagger delay-400" @mousemove="handleMouseMove">
        <h3 class="font-display text-base font-bold text-(--text-heading) mb-4 border-b border-sky-50 pb-3">
            <i class="fas fa-users-viewfinder mr-2 text-sky-500"></i>Tim Mentoring Anda
        </h3>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($proposals as $team): ?>
            <div class="p-4 rounded-xl border border-slate-100 hover:border-sky-200 hover:bg-sky-50/30 transition-all">
                <h4 class="text-[13px] font-bold text-(--text-heading) uppercase"><?= esc($team['nama_usaha']) ?></h4>
                <p class="text-[11px] text-slate-500 mt-0.5 italic"><?= esc($team['kategori_wirausaha']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Verify Modal -->
    <div x-show="showVerifyModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        
        <div class="card-premium w-full max-w-3xl bg-white shadow-2xl animate-modal max-h-[90vh] overflow-hidden" @click.away="showVerifyModal = false">
            <div class="p-6 border-b border-sky-50 flex justify-between items-center bg-sky-50/30">
                <div>
                    <h3 class="font-display text-lg font-black text-sky-900 uppercase">Review Logbook Kegiatan</h3>
                    <p class="text-[11px] text-slate-500" x-text="selectedLogbook ? `${selectedLogbook.nama_usaha} - ${selectedLogbook.activity_category}` : ''"></p>
                </div>
                <button @click="showVerifyModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="overflow-y-auto p-6 space-y-6 max-h-[60vh]" x-if="selectedLogbook">
                <!-- Status Dosen Badge -->
                <div class="p-4 rounded-xl bg-purple-50 border border-purple-100">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="fas fa-check-circle text-purple-500"></i>
                        <span class="text-[11px] font-black text-purple-700 uppercase">Sudah di-approve oleh Dosen Pendamping</span>
                    </div>
                    <p class="text-[12px] text-slate-600" x-text="selectedLogbook?.dosen_note ? `Catatan: ${selectedLogbook.dosen_note}` : 'Tidak ada catatan dari dosen'"></p>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penjelasan Kegiatan</label>
                    <div class="p-4 rounded-xl bg-slate-50 text-[13px] text-slate-700 leading-relaxed" x-text="selectedLogbook?.activity_description"></div>
                </div>

                <!-- Files Info -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="p-4 rounded-xl border border-slate-100 text-center">
                        <i class="fas fa-camera text-sky-500 text-xl mb-2"></i>
                        <p class="text-[10px] font-black text-slate-400 uppercase">Foto Kegiatan</p>
                        <p class="text-[12px] font-bold text-slate-700" x-text="selectedLogbook?.photo_activity ? 'Ada' : 'Belum'">Ada</p>
                    </div>
                    <div class="p-4 rounded-xl border border-slate-100 text-center">
                        <i class="fas fa-user-tie text-amber-500 text-xl mb-2"></i>
                        <p class="text-[10px] font-black text-slate-400 uppercase">Foto Kunjungan</p>
                        <p class="text-[12px] font-bold text-slate-700" x-text="selectedLogbook?.photo_supervisor_visit ? 'Ada' : 'Belum'">Ada</p>
                    </div>
                    <div class="p-4 rounded-xl border border-slate-100 text-center">
                        <i class="fab fa-youtube text-rose-500 text-xl mb-2"></i>
                        <p class="text-[10px] font-black text-slate-400 uppercase">Video</p>
                        <p class="text-[12px] font-bold text-slate-700" x-text="selectedLogbook?.video_url ? 'Ada' : 'Belum'">Ada</p>
                    </div>
                </div>

                <!-- View Links -->
                <div class="flex gap-3">
                    <a :href="`<?= base_url('mentor/kegiatan/file/photo') ?>/${selectedLogbook?.id}`" target="_blank" 
                       class="flex-1 btn-outline text-center text-[11px] py-2" x-show="selectedLogbook?.photo_activity">
                        <i class="fas fa-image mr-1"></i> Lihat Foto Kegiatan
                    </a>
                    <a :href="`<?= base_url('mentor/kegiatan/file/supervisor') ?>/${selectedLogbook?.id}`" target="_blank"
                       class="flex-1 btn-outline text-center text-[11px] py-2" x-show="selectedLogbook?.photo_supervisor_visit">
                        <i class="fas fa-user-tie mr-1"></i> Lihat Foto Kunjungan
                    </a>
                </div>
            </div>

            <!-- Verification Form -->
            <form :action="`<?= base_url('mentor/kegiatan/verify') ?>/${selectedLogbook?.id}`" method="POST" class="p-6 border-t border-slate-100 bg-slate-50/50">
                <?= csrf_field() ?>
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="status" value="approved" class="peer sr-only" required>
                            <div class="p-3 rounded-xl border-2 border-slate-200 bg-white text-slate-400 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-600 transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-check-circle"></i>
                                <span class="text-sm font-bold uppercase tracking-wide">Approve</span>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="status" value="revision" class="peer sr-only">
                            <div class="p-3 rounded-xl border-2 border-slate-200 bg-white text-slate-400 peer-checked:border-rose-500 peer-checked:bg-rose-50 peer-checked:text-rose-600 transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-times-circle"></i>
                                <span class="text-sm font-bold uppercase tracking-wide">Revisi</span>
                            </div>
                        </label>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Catatan Verifikasi</label>
                        <textarea name="mentor_note" rows="2" class="input-modern w-full" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" @click="showVerifyModal = false" class="btn-outline flex-1">Batal</button>
                        <button type="submit" class="btn-primary flex-1 shadow-lg shadow-sky-500/20">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
