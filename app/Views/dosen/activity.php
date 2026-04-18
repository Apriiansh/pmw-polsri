<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="{
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
    }
}">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Verifikasi <span class="text-gradient">Kegiatan Wirausaha</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap 9 — Review dan verifikasi logbook kegiatan tim bimbingan Anda</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-5">
        <?php
        $statItems = [
            ['title' => 'Total Review', 'value' => $stats['total'], 'icon' => 'fa-clipboard-check', 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500'],
            ['title' => 'Pending', 'value' => $stats['pending'], 'icon' => 'fa-clock', 'bg' => 'bg-blue-50', 'icon_color' => 'text-blue-500'],
            ['title' => 'Revisi', 'value' => $stats['revision'], 'icon' => 'fa-rotate', 'bg' => 'bg-orange-50', 'icon_color' => 'text-orange-500'],
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Column: Logbooks -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Pending Logbooks -->
            <div class="card-premium overflow-hidden animate-stagger delay-400" @mousemove="handleMouseMove">
                <div class="px-6 py-4 border-b border-sky-50 flex items-center justify-between bg-white/60">
                    <h3 class="font-display text-base font-bold text-(--text-heading)">Logbook Menunggu Verifikasi</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="pmw-table">
                        <thead>
                            <tr>
                                <th>Tanggal & Kategori</th>
                                <th>Status</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pendingLogbooks)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-12">
                                        <div class="text-slate-400">
                                            <i class="fas fa-check-circle text-4xl mb-3 opacity-20"></i>
                                            <p class="text-sm">Tidak ada logbook yang menunggu verifikasi.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($pendingLogbooks as $logbook): ?>
                                <tr class="group">
                                    <td class="whitespace-nowrap">
                                        <div class="text-[12px] font-bold text-(--text-heading)"><?= date('d M Y', strtotime($logbook->activity_date)) ?></div>
                                        <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded bg-violet-100 text-violet-700 mt-1 inline-block"><?= esc($logbook->activity_category) ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        $statusBadges = [
                                            'pending'  => ['bg-blue-50 text-blue-600 border-blue-200', 'Menunggu'],
                                            'revision' => ['bg-orange-50 text-orange-600 border-orange-200', 'Revisi'],
                                        ];
                                        $badge = $statusBadges[$logbook->status] ?? ['bg-slate-50 text-slate-600', $logbook->status];
                                        ?>
                                        <span class="pmw-status <?= $badge[0] ?> text-[10px]"><?= $badge[1] ?></span>
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

            <!-- Validation History -->
            <div class="card-premium overflow-hidden animate-stagger delay-500" @mousemove="handleMouseMove">
                <div class="px-6 py-4 border-b border-sky-50 flex items-center justify-between bg-white/60">
                    <h3 class="font-display text-base font-bold text-(--text-heading)">Riwayat Validasi</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="pmw-table">
                        <thead>
                            <tr>
                                <th>Tanggal & Kategori</th>
                                <th>Status Akhir</th>
                                <th>Catatan Anda</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($historyLogbooks)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-12">
                                        <div class="text-slate-400">
                                            <i class="fas fa-history text-4xl mb-3 opacity-20"></i>
                                            <p class="text-sm">Belum ada riwayat validasi.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($historyLogbooks as $logbook): ?>
                                <tr class="group">
                                    <td class="whitespace-nowrap">
                                        <div class="text-[12px] font-bold text-(--text-heading)"><?= date('d M Y', strtotime($logbook->activity_date)) ?></div>
                                        <span class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded bg-slate-100 text-slate-500 mt-1 inline-block"><?= esc($logbook->activity_category) ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        $statusBadges = [
                                            'approved_by_dosen'  => ['bg-violet-50 text-violet-600 border-violet-100', 'Approved Dosen'],
                                            'approved_by_mentor' => ['bg-indigo-50 text-indigo-600 border-indigo-100', 'Approved Mentor'],
                                            'approved'           => ['bg-emerald-50 text-emerald-600 border-emerald-100', 'Final Approved'],
                                        ];
                                        $badge = $statusBadges[$logbook->status] ?? ['bg-slate-50 text-slate-600', $logbook->status];
                                        ?>
                                        <span class="pmw-status <?= $badge[0] ?> text-[10px]"><?= $badge[1] ?></span>
                                    </td>
                                    <td>
                                        <div class="text-[11px] text-slate-500 italic max-w-[150px] truncate" title="<?= esc($logbook->dosen_note) ?>">
                                            <?= esc($logbook->dosen_note ?: '-') ?>
                                        </div>
                                    </td>
                                    <td class="text-right whitespace-nowrap">
                                        <button @click="selectedLogbook = <?= htmlspecialchars(json_encode($logbook)) ?>; showVerifyModal = true" 
                                                class="btn-ghost btn-xs text-slate-400 hover:text-sky-600 transition-all">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar: Teams Info -->
        <div class="lg:col-span-1 space-y-6 animate-stagger delay-500">
            <div class="card-premium p-6" @mousemove="handleMouseMove">
                <h3 class="font-display text-base font-bold text-(--text-heading) mb-4 border-b border-sky-50 pb-3 flex items-center">
                    <i class="fas fa-users-viewfinder mr-2.5 text-sky-500"></i>
                    Tim Bimbingan Anda
                </h3>
                <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                    <?php if (empty($proposals)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-user-slash text-3xl text-slate-200 mb-2"></i>
                            <p class="text-xs text-slate-400">Belum ada tim yang ditugaskan.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($proposals as $team): ?>
                        <div class="p-3 rounded-xl border border-slate-100 hover:border-sky-200 hover:bg-sky-50/30 transition-all group cursor-pointer"
                             @click="selectedTeam = <?= htmlspecialchars(json_encode($team)) ?>; showTeamModal = true">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h4 class="text-[13px] font-bold text-(--text-heading) group-hover:text-sky-600 transition-colors uppercase"><?= esc($team['nama_usaha']) ?></h4>
                                    <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1 italic border-l-2 border-sky-200 pl-2 ml-1">"<?= esc($team['kategori_wirausaha']) ?>"</p>
                                </div>
                                <div class="flex flex-col items-end gap-1">
                                    <span class="pmw-status bg-sky-50 text-sky-600 border-sky-200 text-[9px]">AKTIF</span>
                                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter group-hover:text-sky-500 transition-colors">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
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
                    <p class="text-[11px] text-slate-500" x-text="selectedLogbook ? `Kategori: ${selectedLogbook.activity_category}` : ''"></p>
                </div>
                <button @click="showVerifyModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="overflow-y-auto p-6 space-y-6 max-h-[60vh]" x-if="selectedLogbook">
                <!-- Description -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Penjelasan Kegiatan oleh Mahasiswa</label>
                    <div class="p-4 rounded-xl bg-slate-50 text-[13px] text-slate-700 leading-relaxed" x-text="selectedLogbook?.activity_description"></div>
                </div>

                <!-- Previews -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" x-show="selectedLogbook?.photo_supervisor_visit || selectedLogbook?.video_url">
                    <!-- Foto Kunjungan Preview -->
                    <div class="space-y-2" x-show="selectedLogbook?.photo_supervisor_visit">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Kunjungan Dosen Pendamping</label>
                        <div class="aspect-video rounded-xl overflow-hidden border border-slate-100 bg-slate-50 group relative shadow-sm">
                            <img :src="`<?= base_url('dosen/kegiatan/file/supervisor') ?>/${selectedLogbook?.id}`" class="w-full h-full object-cover">
                            <div class="absolute top-2 right-2">
                                <span class="bg-sky-500/80 backdrop-blur-md text-white text-[8px] font-black uppercase px-2 py-1 rounded-lg">Supervisor Visit</span>
                            </div>
                        </div>
                    </div>

                    <!-- Video Preview -->
                    <div class="space-y-2" x-show="selectedLogbook?.video_url && (selectedLogbook.video_url.includes('youtube.com') || selectedLogbook.video_url.includes('youtu.be'))">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Preview Video (YouTube)</label>
                        <div class="aspect-video rounded-xl overflow-hidden border border-slate-100 bg-slate-50 shadow-sm">
                            <iframe class="w-full h-full" 
                                :src="`https://www.youtube.com/embed/${getYoutubeId(selectedLogbook?.video_url)}`" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    
                    <!-- GDrive / Other Video Placeholder -->
                    <div class="space-y-2" x-show="selectedLogbook?.video_url && !(selectedLogbook.video_url.includes('youtube.com') || selectedLogbook.video_url.includes('youtu.be'))">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Dokumentasi Video</label>
                        <a :href="selectedLogbook?.video_url" target="_blank" class="aspect-video rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 flex flex-col items-center justify-center group hover:border-sky-300 hover:bg-sky-50 transition-all">
                            <i class="fab fa-google-drive text-3xl text-slate-300 group-hover:text-sky-500 transition-colors mb-2"></i>
                            <span class="text-[11px] font-bold text-slate-500 group-hover:text-sky-700">Lihat di Google Drive</span>
                            <span class="text-[9px] text-slate-400 mt-1">Klik untuk membuka link eksternal</span>
                        </a>
                    </div>
                </div>

                <!-- Gallery Photos -->
                <div class="space-y-2" x-show="selectedLogbook?.gallery && selectedLogbook.gallery.length > 0">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Galeri Foto Kegiatan</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        <template x-for="photo in selectedLogbook?.gallery" :key="photo.id">
                            <a :href="`<?= base_url('dosen/kegiatan/gallery') ?>/${photo.id}`" target="_blank" class="aspect-square rounded-lg overflow-hidden border border-slate-100 bg-slate-50 group relative">
                                <img :src="`<?= base_url('dosen/kegiatan/gallery') ?>/${photo.id}`" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white text-[10px]">
                                    <i class="fas fa-expand"></i>
                                </div>
                            </a>
                        </template>
                    </div>
                </div>

            </div>

            <!-- Verification Form -->
            <form :action="`<?= base_url('dosen/kegiatan/verify') ?>/${selectedLogbook?.id}`" method="POST" 
                  class="p-6 border-t border-slate-100 bg-slate-50/50"
                  x-show="['pending', 'revision'].includes(selectedLogbook?.status)">
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
                        <textarea name="dosen_note" rows="2" class="input-modern w-full" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="button" @click="showVerifyModal = false" class="btn-outline w-full sm:flex-1">Batal</button>
                        <button type="submit" class="btn-primary w-full sm:flex-1 shadow-lg shadow-sky-500/20">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>

            <!-- Close Button for History -->
            <div class="p-6 border-t border-slate-100 bg-slate-50/50 flex justify-end" x-show="!['pending', 'revision'].includes(selectedLogbook?.status)">
                <button @click="showVerifyModal = false" class="btn-outline px-8!">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Team Detail Modal -->
    <div x-show="showTeamModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        
        <div class="card-premium w-full max-w-2xl bg-white shadow-2xl animate-modal flex flex-col max-h-[90vh] overflow-hidden" @click.away="showTeamModal = false">
            <div class="p-6 bg-linear-to-r from-sky-600 to-sky-500 text-white flex justify-between items-start shrink-0">
                <div>
                    <h3 class="font-display text-lg font-black uppercase tracking-wider" x-text="selectedTeam ? selectedTeam.nama_usaha : 'Detail Tim'"></h3>
                    <p class="text-[10px] text-sky-100 font-bold uppercase tracking-widest mt-0.5" x-text="selectedTeam ? `Kategori: ${selectedTeam.kategori_wirausaha}` : ''"></p>
                </div>
                <button @click="showTeamModal = false" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition-all">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            
            <div class="overflow-y-auto p-6 space-y-6 flex-1 custom-scrollbar">
                <!-- Members List -->
                <div class="space-y-4">
                    <h4 class="font-display text-xs font-black text-slate-400 uppercase tracking-widest flex items-center">
                        <i class="fas fa-users-gear mr-2 text-sky-500"></i>
                        Anggota Tim & Kontak
                    </h4>
                    
                    <div class="grid grid-cols-1 gap-3">
                        <template x-if="selectedTeam && selectedTeam.members">
                            <template x-for="(member, idx) in selectedTeam.members" :key="idx">
                                <div class="group relative p-4 rounded-2xl border border-slate-100 hover:border-sky-200 hover:bg-sky-50/30 transition-all flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-linear-to-tr from-sky-500 to-sky-400 flex items-center justify-center text-white font-display font-black text-sm shrink-0 shadow-lg shadow-sky-200">
                                        <span x-text="member.nama.substring(0, 2).toUpperCase()"></span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <h5 class="text-sm font-bold text-slate-800 truncate" x-text="member.nama"></h5>
                                            <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-tighter"
                                                  :class="member.role === 'ketua' ? 'bg-rose-100 text-rose-600' : 'bg-slate-100 text-slate-500'"
                                                  x-text="member.role"></span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 font-medium" x-text="`${member.nim} • ${member.prodi}`"></p>
                                        
                                        <!-- Contact Actions -->
                                        <div class="flex items-center gap-3 mt-2.5">
                                            <a :href="`https://wa.me/${member.phone ? member.phone.replace(/[^0-9]/g, '') : ''}`" target="_blank" 
                                               class="flex items-center gap-1.5 text-[10px] font-black text-emerald-600 hover:text-emerald-700 transition-colors uppercase tracking-tight">
                                                <i class="fab fa-whatsapp text-xs"></i>
                                                WhatsApp
                                            </a>
                                            <span class="w-1 h-1 rounded-full bg-slate-200"></span>
                                            <a :href="`mailto:${member.email}`" 
                                               class="flex items-center gap-1.5 text-[10px] font-black text-sky-600 hover:text-sky-700 transition-colors uppercase tracking-tight">
                                                <i class="fas fa-envelope text-xs"></i>
                                                Email
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </div>
                </div>

                <!-- Dosen Notes (History Only) -->
                <div class="space-y-2 p-4 mt-4 rounded-xl bg-violet-50 border border-violet-100" x-show="!['pending', 'revision'].includes(selectedLogbook?.status) && selectedLogbook?.dosen_note">
                    <label class="text-[10px] font-black text-violet-400 uppercase tracking-widest">Catatan Anda Sebelumnya</label>
                    <p class="text-[13px] text-violet-700 italic" x-text="`&quot;${selectedLogbook?.dosen_note}&quot;`"></p>
                </div>
            </div>

            <div class="p-6 border-t border-slate-50 bg-slate-50/50 flex justify-end">
                <button @click="showTeamModal = false" class="btn-outline px-8!">
                    Tutup
                </button>
            </div>
        </div>
    </div>

</div>

<style>
    .animate-stagger {
        animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }

    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes modalIn {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .animate-modal {
        animation: modalIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

<?= $this->endSection() ?>
