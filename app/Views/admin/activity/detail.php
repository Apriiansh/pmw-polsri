<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="{
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Validasi Final <span class="text-gradient">Kegiatan</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Validasi akhir laporan kegiatan oleh Admin Pusat</p>
        </div>
        <a href="<?= base_url('admin/kegiatan') ?>" class="btn-ghost inline-flex items-center gap-2">
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
    $logbookStatus = $logbook->status ?? 'not_submitted';
    $statusColors = [
        'not_submitted'      => 'bg-slate-100 text-slate-600 border-slate-200',
        'draft'              => 'bg-yellow-100 text-yellow-600 border-yellow-200',
        'pending'            => 'bg-blue-100 text-blue-600 border-blue-200',
        'approved_by_dosen'  => 'bg-purple-100 text-purple-600 border-purple-200',
        'approved_by_mentor' => 'bg-indigo-100 text-indigo-600 border-indigo-200',
        'approved'           => 'bg-emerald-100 text-emerald-600 border-emerald-200',
        'revision'           => 'bg-orange-100 text-orange-600 border-orange-200',
    ];
    $statusLabels = [
        'not_submitted'      => 'Belum Diisi',
        'draft'              => 'Draft',
        'pending'            => 'Menunggu Dosen',
        'approved_by_dosen'  => 'Approved Dosen',
        'approved_by_mentor' => 'Approved Mentor',
        'approved'           => 'Final Approved',
        'revision'           => 'Perlu Revisi',
    ];
    ?>

    <!-- ================================================================
         2. ACTIVITY SUMMARY CARD
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-100" @mousemove="handleMouseMove">
        <div class="px-5 py-3 border-b border-sky-50 bg-white/60 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-sky-500 flex items-center justify-center text-white shadow-lg shadow-sky-100">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div>
                    <h3 class="font-display text-sm font-bold text-(--text-heading)">
                        <?= esc($schedule->activity_category) ?>
                    </h3>
                    <p class="text-[10px] text-(--text-muted)">
                        <?= date('d M Y', strtotime($schedule->activity_date)) ?> • <?= esc($schedule->location ?: 'Lokasi -') ?>
                    </p>
                </div>
            </div>
            <span class="pmw-status <?= $statusColors[$logbookStatus] ?? '' ?> scale-90">
                <i class="fas fa-circle text-[6px]"></i>
                <?= $statusLabels[$logbookStatus] ?? ucfirst($logbookStatus) ?>
            </span>
        </div>

        <div class="px-5 py-3 bg-slate-50/50">
            <div class="flex flex-wrap items-center gap-x-8 gap-y-2">
                <div>
                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider block">Tim Wirausaha</span>
                    <span class="font-bold text-xs text-slate-700"><?= esc($proposal['nama_usaha']) ?></span>
                </div>
                <div class="w-px h-6 bg-slate-200 hidden sm:block"></div>
                <div>
                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider block">Kategori</span>
                    <span class="text-[10px] font-bold text-sky-600 bg-sky-50 px-2 py-0.5 rounded border border-sky-100"><?= ucfirst($proposal['kategori_wirausaha']) ?></span>
                </div>
                <div class="w-px h-6 bg-slate-200 hidden sm:block"></div>
                <div>
                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider block">Update</span>
                    <span class="font-semibold text-xs text-slate-500"><?= $logbook ? date('d/m/y H:i', strtotime($logbook->updated_at)) : '-' ?></span>
                </div>
            </div>
        </div>
    </div>

    <?php if ($logbook): ?>
    <!-- ================================================================
         3. LOGBOOK CONTENT & MEDIA
    ================================================================= -->
    <div class="grid lg:grid-cols-3 gap-6 animate-stagger delay-200">
        <!-- Main Content (Evidence) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- 1. Description -->
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 py-4 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-sm font-bold text-(--text-heading)">
                        <i class="fas fa-align-left text-sky-500 mr-2"></i>
                        Deskripsi Kegiatan
                    </h3>
                </div>
                <div class="p-5">
                    <div class="p-4 rounded-2xl bg-slate-50/80 border border-slate-100 text-slate-700 text-sm leading-relaxed">
                        <?= nl2br(esc($logbook->activity_description)) ?>
                    </div>
                </div>
            </div>

            <!-- 2. Unified Media Documentation -->
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 py-4 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-sm font-bold text-(--text-heading)">
                        <i class="fas fa-photo-film text-rose-500 mr-2"></i>
                        Dokumentasi Mahasiswa
                    </h3>
                </div>
                <div class="p-5 space-y-6">
                    <!-- Video Player -->
                    <?php if ($logbook->video_url): ?>
                        <div class="rounded-2xl overflow-hidden border-2 border-slate-100 shadow-sm bg-slate-900 aspect-video w-full">
                            <?php $embedUrl = get_video_embed_url($logbook->video_url); ?>
                            <?php if ($embedUrl): ?>
                                <iframe src="<?= $embedUrl ?>" class="w-full h-full border-none" allowfullscreen></iframe>
                            <?php else: ?>
                                <div class="flex flex-col items-center justify-center h-full text-slate-500 gap-2">
                                    <i class="fas fa-video-slash text-3xl"></i>
                                    <a href="<?= esc($logbook->video_url) ?>" target="_blank" class="text-xs text-rose-400 hover:underline">Buka Link Original <i class="fas fa-external-link-alt ml-1"></i></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Photo Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        <?php if (!empty($logbook->gallery)): ?>
                            <?php foreach ($logbook->gallery as $photo): ?>
                            <div class="aspect-square rounded-xl overflow-hidden border-2 border-white shadow-sm group relative cursor-pointer"
                                 onclick="openImageModal('<?= base_url('admin/kegiatan/gallery/' . $photo->id) ?>')">
                                <img src="<?= base_url('admin/kegiatan/gallery/' . $photo->id) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white">
                                    <i class="fas fa-expand text-xl"></i>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if ($logbook->photo_activity): ?>
                        <div class="aspect-square rounded-xl overflow-hidden border-2 border-white shadow-sm group relative cursor-pointer"
                             onclick="openImageModal('<?= base_url('admin/kegiatan/file/photo/' . $logbook->id) ?>')">
                            <img src="<?= base_url('admin/kegiatan/file/photo/' . $logbook->id) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                            <div class="absolute inset-0 bg-emerald-500/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white text-[10px] font-bold">
                                FOTO UTAMA
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (empty($logbook->gallery) && !$logbook->photo_activity): ?>
                            <div class="col-span-full py-12 text-center bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                                <i class="fas fa-images text-slate-300 text-3xl mb-2"></i>
                                <p class="text-xs text-slate-400 font-medium">Tidak ada foto dokumentasi</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Details (Info & Reviews) -->
        <div class="space-y-6">
            <!-- Members Card -->
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 py-3 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                        <i class="fas fa-users text-teal-500 mr-2"></i>Anggota Tim
                    </h3>
                </div>
                <div class="p-3 space-y-2">
                    <?php foreach ($members as $member): ?>
                    <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100 cursor-pointer"
                         onclick='openBiodataModal("mahasiswa", <?= json_encode($member, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                        <div class="w-8 h-8 rounded bg-teal-500 flex items-center justify-center text-white font-bold text-[10px] shrink-0">
                            <?= strtoupper(substr($member['nama'], 0, 2)) ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-[11px] text-slate-700 truncate"><?= esc($member['nama']) ?></p>
                            <p class="text-[9px] text-slate-400"><?= esc($member['nim']) ?></p>
                        </div>
                        <?php if ($member['role'] === 'ketua'): ?>
                            <i class="fas fa-crown text-[10px] text-amber-400"></i>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Combined Supervisor Review -->
            <?php 
                $dosenData = ['nama' => $proposal['dosen_nama'] ?? '-', 'nip' => $proposal['dosen_nip'] ?? '-', 'jurusan' => $proposal['dosen_jurusan'] ?? '-', 'prodi' => $proposal['dosen_prodi'] ?? '-', 'phone' => $proposal['dosen_phone'] ?? '-'];
                $mentorData = ['nama' => $proposal['mentor_nama'] ?? '-', 'company' => $proposal['mentor_company'] ?? '-', 'phone' => $proposal['mentor_phone'] ?? '-'];
            ?>
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                        <i class="fas fa-shield-halved text-indigo-500 mr-2"></i>Validasi Dosen Pendamping dan Mentor
                    </h3>
                </div>
                <div class="p-4 space-y-5">
                    <!-- Dosen Feedback -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 cursor-pointer group" onclick='openBiodataModal("dosen", <?= json_encode($dosenData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                                <div class="w-7 h-7 rounded bg-purple-500 flex items-center justify-center text-white text-[10px] font-bold group-hover:scale-110 transition-transform">
                                    <?= strtoupper(substr($proposal['dosen_nama'] ?? 'D', 0, 2)) ?>
                                </div>
                                <span class="text-[11px] font-bold text-slate-700 truncate max-w-[100px]"><?= esc($proposal['dosen_nama'] ?? '-') ?></span>
                            </div>
                            <?php if ($logbook->dosen_verified_at): ?>
                                <span class="text-[8px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-100">VERIFIED</span>
                            <?php else: ?>
                                <span class="text-[8px] font-bold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-100">PENDING</span>
                            <?php endif; ?>
                        </div>
                        <div class="p-2.5 rounded-xl bg-purple-50/50 border border-purple-100">
                            <p class="text-[9px] font-black text-purple-400 uppercase tracking-widest mb-1">Catatan Dosen</p>
                            <p class="text-[11px] text-slate-600 italic leading-relaxed">"<?= esc($logbook->dosen_note ?: 'Tidak ada catatan khusus.') ?>"</p>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 border-dashed"></div>

                    <!-- Mentor Feedback -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 cursor-pointer group" onclick='openBiodataModal("mentor", <?= json_encode($mentorData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                                <div class="w-7 h-7 rounded bg-indigo-500 flex items-center justify-center text-white text-[10px] font-bold group-hover:scale-110 transition-transform">
                                    <?= strtoupper(substr($proposal['mentor_nama'] ?? 'M', 0, 2)) ?>
                                </div>
                                <span class="text-[11px] font-bold text-slate-700 truncate max-w-[100px]"><?= esc($proposal['mentor_nama'] ?? '-') ?></span>
                            </div>
                            <?php if ($logbook->mentor_verified_at): ?>
                                <span class="text-[8px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-100">VERIFIED</span>
                            <?php else: ?>
                                <span class="text-[8px] font-bold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-100">PENDING</span>
                            <?php endif; ?>
                        </div>
                        <div class="p-2.5 rounded-xl bg-indigo-50/50 border border-indigo-100">
                            <p class="text-[9px] font-black text-indigo-400 uppercase tracking-widest mb-1">Catatan Mentor</p>
                            <p class="text-[11px] text-slate-600 italic leading-relaxed">"<?= esc($logbook->mentor_note ?: 'Tidak ada catatan khusus.') ?>"</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Supervisor Visit Photo (Moved to Sidebar) -->
            <?php if ($logbook->photo_supervisor_visit): ?>
            <div class="card-premium overflow-hidden border-l-4 border-l-indigo-500 animate-stagger" @mousemove="handleMouseMove">
                <div class="px-5 py-3 border-b border-indigo-50 bg-indigo-50/30 flex items-center justify-between">
                    <h3 class="font-display text-[11px] font-bold text-indigo-900 uppercase tracking-widest">
                        <i class="fas fa-user-friends mr-2"></i>Kunjungan Pendamping
                    </h3>
                </div>
                <div class="p-4">
                    <div class="aspect-video rounded-xl overflow-hidden border-2 border-white shadow-sm group relative cursor-pointer"
                        onclick="openImageModal('<?= base_url('admin/kegiatan/file/supervisor/' . $logbook->id) ?>')">
                        <img src="<?= base_url('admin/kegiatan/file/supervisor/' . $logbook->id) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                        <div class="absolute inset-0 bg-indigo-900/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center text-white text-[10px] font-bold">
                            PREVIEW FOTO KUNJUNGAN
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ================================================================
         7. FINAL VALIDATION FORM
    ================================================================= -->
    <?php if ($logbookStatus === 'approved_by_mentor' || $logbookStatus === 'approved' || $logbookStatus === 'revision'): ?>
    <div class="card-premium overflow-hidden border-l-4 border-l-emerald-500 animate-stagger delay-600" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-shield-check text-emerald-500 mr-2"></i>
                Keputusan Validasi Final
            </h3>
        </div>
        <form action="<?= base_url('admin/kegiatan/verify/' . $logbook->id) ?>" method="POST">
            <?= csrf_field() ?>
            <div class="p-5 sm:p-7 space-y-6">
                <!-- Status Radios -->
                <div class="grid sm:grid-cols-2 gap-4">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="status" value="approved" class="peer sr-only" <?= $logbookStatus === 'approved' ? 'checked' : '' ?> required>
                        <div class="p-5 rounded-2xl border-2 border-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:border-emerald-300 shadow-sm peer-checked:shadow-emerald-100">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center peer-checked:bg-emerald-500 peer-checked:text-white transition-colors">
                                    <i class="fas fa-check-double text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-(--text-heading)">Approve Final</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Selesaikan Tahapan</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <label class="relative cursor-pointer">
                        <input type="radio" name="status" value="revision" class="peer sr-only" <?= $logbookStatus === 'revision' ? 'checked' : '' ?>>
                        <div class="p-5 rounded-2xl border-2 border-slate-100 peer-checked:border-rose-500 peer-checked:bg-rose-50 transition-all hover:border-rose-300 shadow-sm peer-checked:shadow-rose-100">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center peer-checked:bg-rose-500 peer-checked:text-white transition-colors">
                                    <i class="fas fa-rotate text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-(--text-heading)">Kembalikan / Revisi</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Butuh Perbaikan</p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Note -->
                <div class="form-field">
                    <label class="form-label text-slate-700">Catatan/Instruksi Admin (Opsional)</label>
                    <textarea name="admin_note" rows="4" class="form-textarea" placeholder="Berikan alasan keputusan atau instruksi tambahan bagi mahasiswa..."><?= esc($logbook->admin_note ?? '') ?></textarea>
                    <p class="text-[10px] text-slate-400 font-medium">* Catatan ini akan terlihat oleh Mahasiswa, Dosen, dan Mentor.</p>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="<?= base_url('admin/kegiatan') ?>" class="btn-outline">Batal</a>
                    <button type="submit" class="btn-primary px-8">
                        <i class="fas fa-save mr-2"></i> Simpan & Kirim Notifikasi
                    </button>
                </div>
            </div>
        </form>
    </div>
    <?php else: ?>
    <div class="card-premium p-10 text-center animate-stagger delay-600 bg-slate-50/50">
        <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4 text-slate-300">
            <i class="fas fa-lock text-2xl"></i>
        </div>
        <h4 class="font-bold text-slate-700">Verifikasi Terkunci</h4>
        <p class="text-sm text-slate-400 mt-2 max-w-sm mx-auto">
            Tombol validasi final hanya akan muncul jika laporan telah disetujui oleh Mentor. 
            Saat ini status masih: <span class="font-bold text-sky-600"><?= $statusLabels[$logbookStatus] ?></span>
        </p>
    </div>
    <?php endif; ?>

    <?php endif; // End if $logbook ?>

    <?php endif; // End if $proposal ?>

</div>

<!-- ================================================================
     BIODATA MODAL
================================================================= -->
<div id="biodataModal" class="fixed inset-0 z-50 hidden" aria-modal="true" role="dialog">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeBiodataModal()"></div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div id="modal-header" class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-display font-bold text-white">Detail Biodata</h3>
                        <button type="button" onclick="closeBiodataModal()" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="px-6 py-5">
                    <div class="text-center mb-5">
                        <div id="modal-avatar" class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center text-white font-display font-bold text-xl mb-3">
                            --
                        </div>
                        <h4 id="modal-nama" class="font-display font-bold text-lg text-slate-800">--</h4>
                        <span id="modal-role-badge" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border mt-2">
                            --
                        </span>
                    </div>
                    <div id="modal-content" class="space-y-3"></div>
                </div>
                <div class="bg-slate-50 px-6 py-4 flex justify-end">
                    <button type="button" onclick="closeBiodataModal()" class="btn-outline text-sm">
                        <i class="fas fa-times mr-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div id="imageModal" class="fixed inset-0 z-[100] hidden overflow-hidden bg-slate-900/90 backdrop-blur-sm animate-fade-in" onclick="closeImageModal()">
    <div class="absolute top-5 right-5 z-10">
        <button type="button" class="w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all border border-white/20">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
    <div class="flex items-center justify-center h-full p-4 md:p-10">
        <img id="modalImage" src="" class="max-w-full max-h-full rounded-xl shadow-2xl animate-zoom-in object-contain border-4 border-white/10" onclick="event.stopPropagation()">
    </div>
</div>

<script>
function openBiodataModal(type, data) {
    const modal = document.getElementById('biodataModal');
    const header = document.getElementById('modal-header');
    const avatar = document.getElementById('modal-avatar');
    const nama = document.getElementById('modal-nama');
    const roleBadge = document.getElementById('modal-role-badge');
    const content = document.getElementById('modal-content');

    let bgColor = 'bg-violet-500';
    let roleLabel = 'Dosen Pendamping';

    if (type === 'mahasiswa') {
        bgColor = 'bg-teal-500';
        roleLabel = data.role === 'ketua' ? 'Ketua Tim' : 'Anggota';
    } else if (type === 'mentor') {
        bgColor = 'bg-indigo-500';
        roleLabel = 'Mentor Bisnis';
    }

    header.className = `${bgColor} px-6 py-4`;
    const initials = (data.nama || '??').substring(0, 2).toUpperCase();
    avatar.textContent = initials;
    avatar.className = `w-16 h-16 mx-auto rounded-2xl ${bgColor} flex items-center justify-center text-white font-display font-bold text-xl mb-3 shadow-lg shadow-slate-200`;

    nama.textContent = data.nama || '-';
    roleBadge.textContent = roleLabel;
    
    // Fix badge styling logic
    const badgeColors = bgColor === 'bg-teal-500' ? 'bg-teal-50 text-teal-600 border-teal-200' : 
                        (bgColor === 'bg-indigo-500' ? 'bg-indigo-50 text-indigo-600 border-indigo-200' : 'bg-violet-50 text-violet-600 border-violet-200');
    roleBadge.className = `inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border ${badgeColors}`;

    let html = '';
    let fields = [];
    if (type === 'mahasiswa') {
        fields = [
            { icon: 'fa-id-card', label: 'NIM', value: data.nim },
            { icon: 'fa-building', label: 'Jurusan', value: data.jurusan },
            { icon: 'fa-graduation-cap', label: 'Prodi', value: data.prodi },
            { icon: 'fa-calendar-alt', label: 'Semester', value: data.semester },
            { icon: 'fa-phone', label: 'No. HP', value: data.phone },
            { icon: 'fa-envelope', label: 'Email', value: data.email },
        ];
    } else if (type === 'mentor') {
        fields = [
            { icon: 'fa-building', label: 'Perusahaan/Instansi', value: data.company },
            { icon: 'fa-phone', label: 'No. HP', value: data.phone },
        ];
    } else {
        fields = [
            { icon: 'fa-id-card', label: 'NIP', value: data.nip },
            { icon: 'fa-building', label: 'Jurusan', value: data.jurusan },
            { icon: 'fa-graduation-cap', label: 'Prodi', value: data.prodi },
            { icon: 'fa-phone', label: 'No. HP', value: data.phone },
        ];
    }

    fields.forEach(f => {
        if (f.value) {
            html += `
            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm">
                    <i class="fas ${f.icon}"></i>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">${f.label}</p>
                    <p class="text-sm font-semibold text-slate-700">${f.value}</p>
                </div>
            </div>`;
        }
    });

    content.innerHTML = html || '<p class="text-center text-slate-400 py-4">Tidak ada data tambahan</p>';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeBiodataModal() {
    document.getElementById('biodataModal').classList.add('hidden');
    document.body.style.overflow = '';
}

function openImageModal(src) {
    const modal = document.getElementById('imageModal');
    const img = document.getElementById('modalImage');
    img.src = src;
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', (e) => { 
    if (e.key === 'Escape') {
        closeBiodataModal();
        closeImageModal();
    }
});
</script>

<?= $this->endSection() ?>
