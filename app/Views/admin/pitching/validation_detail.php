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
                Validasi Final <span class="text-gradient">Pitching Desk</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Validasi akhir oleh Admin setelah persetujuan Dosen Pendamping</p>
        </div>
        <a href="<?= base_url('admin/pitching-desk') ?>" class="btn-ghost inline-flex items-center gap-2">
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
        'pending'  => 'Menunggu Validasi',
        'approved' => 'Lolos Pitching',
        'revision' => 'Perlu Revisi',
        'rejected' => 'Ditolak',
    ];
    ?>

    <!-- ================================================================
         2. PROPOSAL INFO CARD
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-100" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-file-invoice text-sky-500 mr-2"></i>
                    <?= esc($proposal['nama_usaha'] ?: 'Proposal #' . $proposal['id']) ?>
                </h3>
                <p class="text-[11px] text-(--text-muted) mt-0.5">
                    <?= esc($proposal['period_name'] ?? '-') ?> - <?= esc($proposal['period_year'] ?? '') ?>
                </p>
            </div>
            <span class="pmw-status <?= $statusColors[$proposal['pitching_admin_status']] ?? '' ?>">
                <i class="fas fa-circle text-[8px]"></i>
                <?= $statusLabels[$proposal['pitching_admin_status']] ?? ucfirst($proposal['pitching_admin_status']) ?>
            </span>
        </div>

        <div class="p-5 sm:p-7">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Kategori -->
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Kategori Wirausaha</p>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold border <?= $proposal['kategori_wirausaha'] === 'pemula' ? "bg-sky-50 text-sky-600 border-sky-200" : "bg-violet-50 text-violet-600 border-violet-200" ?>">
                        <i class="fas fa-rocket text-xs"></i>
                        <?= $proposal['kategori_wirausaha'] === 'pemula' ? 'Pemula' : 'Berkembang' ?>
                    </span>
                </div>

                <!-- Kategori Usaha -->
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Kategori Usaha</p>
                    <p class="font-semibold text-(--text-heading)"><?= esc($proposal['kategori_usaha'] ?: '-') ?></p>
                </div>

                <!-- Timeline -->
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Tahap Saat Ini</p>
                    <p class="font-semibold text-sky-600">
                        <i class="fas fa-award mr-1"></i> Pitching Desk
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================
         3. TEAM & DOSEN INFO
    ================================================================= -->
    <div class="grid lg:grid-cols-2 gap-6 animate-stagger delay-200">
        <!-- Tim Proposal -->
        <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-users text-teal-500 mr-2"></i>
                    Tim Proposal
                </h3>
            </div>
            <div class="p-5 sm:p-7 space-y-3">
                <?php foreach ($members as $member): ?>
                <div class="flex items-center gap-3 p-3 rounded-xl <?= $member['role'] === 'ketua' ? 'bg-teal-50 border border-teal-100' : 'bg-slate-50' ?> cursor-pointer hover:shadow-md transition-all"
                     onclick='openBiodataModal("mahasiswa", <?= json_encode($member, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                    <div class="w-10 h-10 rounded-lg <?= $member['role'] === 'ketua' ? 'bg-teal-500' : 'bg-slate-300' ?> flex items-center justify-center text-white font-display font-bold text-sm shrink-0">
                        <?= strtoupper(substr($member['nama'], 0, 2)) ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-(--text-heading) text-sm"><?= esc($member['nama']) ?></span>
                            <?php if ($member['role'] === 'ketua'): ?>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-teal-500 text-white">KETUA</span>
                            <?php endif; ?>
                        </div>
                        <div class="text-xs text-(--text-muted)">
                            <?= esc($member['nim'] ?? '-') ?> · <?= esc($member['prodi'] ?? '-') ?>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-slate-400 text-xs"></i>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Dosen Pendamping -->
        <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-chalkboard-user text-violet-500 mr-2"></i>
                    Dosen Pendamping
                </h3>
            </div>
            <div class="p-5 sm:p-7">
                <?php if (!empty($proposal['dosen_nama'])): ?>
                <?php
                $dosenData = [
                    'nama' => $proposal['dosen_nama'],
                    'nip' => $proposal['dosen_nip'] ?? null,
                    'jurusan' => $proposal['dosen_jurusan'] ?? null,
                    'prodi' => $proposal['dosen_prodi'] ?? null,
                    'phone' => $proposal['dosen_phone'] ?? null,
                ];
                ?>
                <div class="flex items-center gap-3 p-3 rounded-xl bg-violet-50 border border-violet-100 cursor-pointer hover:shadow-md transition-all"
                     onclick='openBiodataModal("dosen", <?= json_encode($dosenData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                    <div class="w-10 h-10 rounded-lg bg-violet-500 flex items-center justify-center text-white font-display font-bold text-sm shrink-0">
                        <?= strtoupper(substr($proposal['dosen_nama'], 0, 2)) ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-(--text-heading) text-sm"><?= esc($proposal['dosen_nama']) ?></div>
                        <div class="text-xs text-(--text-muted)">
                            <?= esc($proposal['dosen_nip'] ?? '-') ?> · <?= esc($proposal['dosen_prodi'] ?? '-') ?>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-slate-400 text-xs"></i>
                </div>
                <?php else: ?>
                <div class="text-center py-4 text-slate-400">
                    <i class="fas fa-user-slash text-2xl mb-2"></i>
                    <p class="text-sm">Belum ada dosen pendamping</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ================================================================
         4. PITCHING MEDIA (VIDEO & PPT)
    ================================================================= -->
    <div class="grid lg:grid-cols-3 gap-6 animate-stagger delay-300">
        <!-- Video Player -->
        <div class="lg:col-span-2 card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-play-circle text-sky-500 mr-2"></i>
                    Video Pitching
                </h3>
            </div>
            <div class="p-0">
                <?php 
                $embedUrl = get_video_embed_url($proposal['video_url']);
                if ($embedUrl): 
                ?>
                <div class="aspect-video w-full">
                    <iframe src="<?= $embedUrl ?>" class="w-full h-full" allowfullscreen allow="autoplay"></iframe>
                </div>
                <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                    <p class="text-xs text-slate-500 truncate mr-4"><?= esc($proposal['video_url']) ?></p>
                    <a href="<?= esc($proposal['video_url']) ?>" target="_blank" class="btn-ghost btn-sm text-sky-600">
                        <i class="fas fa-external-link-alt mr-1"></i> Buka Link
                    </a>
                </div>
                <?php else: ?>
                <div class="p-12 text-center">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <i class="fas fa-video-slash text-2xl"></i>
                    </div>
                    <p class="text-slate-400 italic text-sm">Media video tidak tersedia atau format link tidak didukung</p>
                    <?php if ($proposal['video_url']): ?>
                        <a href="<?= esc($proposal['video_url']) ?>" target="_blank" class="btn-primary mt-4 inline-flex items-center gap-2">
                            <i class="fas fa-external-link-alt"></i> Buka Link Manual
                        </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- PPT / PDF Card -->
        <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-file-powerpoint text-orange-500 mr-2"></i>
                    Bahan Presentasi
                </h3>
                <?php if (isset($docsByKey['pitching_ppt'])): ?>
                <a href="<?= base_url('admin/seleksi-administrasi/doc/' . $docsByKey['pitching_ppt']['id']) ?>" class="text-[10px] font-black text-orange-500 hover:text-orange-600 uppercase tracking-widest">
                    <i class="fas fa-download mr-1"></i> Download
                </a>
                <?php endif; ?>
            </div>
            <div class="p-0">
                <?php if (isset($docsByKey['pitching_ppt'])): ?>
                <div class="aspect-3/4 sm:aspect-square w-full bg-slate-100 relative group">
                    <iframe src="<?= base_url('admin/seleksi-administrasi/doc/' . $docsByKey['pitching_ppt']['id'] . '?inline=1') ?>" class="w-full h-full border-none" allow="autoplay"></iframe>
                    <!-- Overlay for better UX -->
                    <div class="absolute inset-x-0 bottom-0 p-4 bg-linear-to-t from-slate-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                        <p class="text-white text-[10px] font-bold"><?= esc($docsByKey['pitching_ppt']['original_name']) ?></p>
                    </div>
                </div>
                <div class="p-3 bg-orange-50/50 border-t border-orange-100 flex items-center justify-between">
                    <span class="text-[10px] text-orange-700 font-bold uppercase"><?= strtoupper(pathinfo($docsByKey['pitching_ppt']['file_path'], PATHINFO_EXTENSION)) ?></span>
                    <a href="<?= base_url('admin/seleksi-administrasi/doc/' . $docsByKey['pitching_ppt']['id'] . '?inline=1') ?>" target="_blank" class="btn-ghost btn-xs text-orange-600">
                        <i class="fas fa-expand-alt"></i>
                    </a>
                </div>
                <?php else: ?>
                <div class="p-12 text-center bg-slate-50/50">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <i class="fas fa-file-circle-exclamation text-2xl"></i>
                    </div>
                    <p class="text-slate-400 italic text-sm">File belum diunggah</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ================================================================
         5. LECTURER FEEDBACK
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-400 border-l-4 border-l-emerald-500 bg-emerald-50/30" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-emerald-100 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-comments text-emerald-500 mr-2"></i>
                Validasi Dosen Pendamping
            </h3>
        </div>
        <div class="p-5 sm:p-7">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500 flex items-center justify-center text-white shrink-0 shadow-lg shadow-emerald-100">
                    <i class="fas fa-user-check text-xl"></i>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <h4 class="font-bold text-slate-800"><?= esc($proposal['dosen_nama']) ?></h4>
                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Dosen Pendamping</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-black bg-emerald-500 text-white shadow-sm">APPROVED</span>
                    </div>
                    <div class="p-4 rounded-xl bg-white text-slate-600 text-sm leading-relaxed border border-emerald-100 shadow-sm italic">
                        "<?= esc($proposal['pitching_dosen_catatan'] ?: 'Dosen menyetujui konten pitching tanpa catatan khusus.') ?>"
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================
         6. VALIDATION FORM
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-500 border-l-4 border-l-sky-500" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-clipboard-check text-sky-500 mr-2"></i>
                Validasi Final Admin
            </h3>
            <p class="text-[11px] text-(--text-muted) mt-0.5">Tentukan keputusan akhir untuk tahap Pitching Desk</p>
        </div>

        <form action="<?= base_url('admin/pitching-desk/' . $proposal['id'] . '/validate') ?>" method="post">
            <?= csrf_field() ?>
            <div class="p-5 sm:p-7 space-y-6">
                <!-- Status Selection -->
                <div>
                    <label class="form-label mb-3 block">Hasil Validasi <span class="required">*</span></label>
                    <div class="grid sm:grid-cols-3 gap-4">
                        <!-- Lolos -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="status" value="approved" class="peer sr-only" <?= $proposal['pitching_admin_status'] === 'approved' ? 'checked' : '' ?> required>
                            <div class="p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:border-emerald-300 shadow-sm peer-checked:shadow-emerald-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center peer-checked:bg-emerald-500 peer-checked:text-white transition-colors">
                                        <i class="fas fa-award"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-(--text-heading) text-sm leading-tight">Lolos</p>
                                        <p class="text-[10px] text-slate-400 font-medium">Pitching Diterima</p>
                                    </div>
                                </div>
                            </div>
                        </label>

                        <!-- Revisi -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="status" value="revision" class="peer sr-only" <?= $proposal['pitching_admin_status'] === 'revision' ? 'checked' : '' ?>>
                            <div class="p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all hover:border-orange-300 shadow-sm peer-checked:shadow-orange-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center peer-checked:bg-orange-500 peer-checked:text-white transition-colors">
                                        <i class="fas fa-rotate"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-(--text-heading) text-sm leading-tight">Revisi</p>
                                        <p class="text-[10px] text-slate-400 font-medium">Perlu Perbaikan</p>
                                    </div>
                                </div>
                            </div>
                        </label>

                        <!-- Tolak -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="status" value="rejected" class="peer sr-only" <?= $proposal['pitching_admin_status'] === 'rejected' ? 'checked' : '' ?>>
                            <div class="p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-rose-500 peer-checked:bg-rose-50 transition-all hover:border-rose-300 shadow-sm peer-checked:shadow-rose-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center peer-checked:bg-rose-500 peer-checked:text-white transition-colors">
                                        <i class="fas fa-circle-xmark"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-(--text-heading) text-sm leading-tight">Tolak</p>
                                        <p class="text-[10px] text-slate-400 font-medium">Tidak Lolos Tahap 3</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="space-y-1.5">
                    <label class="form-label">Catatan Validasi Admin</label>
                    <div class="input-group items-start py-2 group focus-within:ring-4 focus-within:ring-sky-100 transition-all">
                        <div class="input-icon mt-2 text-slate-400 group-focus-within:text-sky-500">
                            <i class="fas fa-comment-medical text-base"></i>
                        </div>
                        <textarea name="catatan" rows="4" placeholder="Berikan instruksi atau catatan akhir untuk mahasiswa..."><?= esc($proposal['pitching_admin_catatan'] ?? '') ?></textarea>
                    </div>
                    <p class="text-[10px] text-slate-400 font-medium">Catatan ini akan muncul di dashboard mahasiswa.</p>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="<?= base_url('admin/pitching-desk') ?>" class="btn-outline">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit" class="btn-primary px-8">
                        <i class="fas fa-save mr-2"></i>Simpan Hasil Validasi
                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php endif; ?>

</div><!-- /page wrapper -->

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

<script>
function openBiodataModal(type, data) {
    const modal = document.getElementById('biodataModal');
    const header = document.getElementById('modal-header');
    const avatar = document.getElementById('modal-avatar');
    const nama = document.getElementById('modal-nama');
    const roleBadge = document.getElementById('modal-role-badge');
    const content = document.getElementById('modal-content');

    let bgColor = type === 'mahasiswa' ? 'bg-teal-500' : 'bg-violet-500';
    let roleLabel = type === 'mahasiswa' ? (data.role === 'ketua' ? 'Ketua Tim' : 'Anggota') : 'Dosen Pendamping';

    header.className = `${bgColor} px-6 py-4`;
    const initials = (data.nama || '??').substring(0, 2).toUpperCase();
    avatar.textContent = initials;
    avatar.className = `w-16 h-16 mx-auto rounded-2xl ${bgColor} flex items-center justify-center text-white font-display font-bold text-xl mb-3 shadow-lg shadow-slate-200`;

    nama.textContent = data.nama || '-';
    roleBadge.textContent = roleLabel;
    roleBadge.className = `inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border ${bgColor.replace('bg-', 'bg-50 text-').replace('bg-', 'border-')}`;

    let html = '';
    const fields = type === 'mahasiswa' ? [
        { icon: 'fa-id-card', label: 'NIM', value: data.nim },
        { icon: 'fa-building', label: 'Jurusan', value: data.jurusan },
        { icon: 'fa-graduation-cap', label: 'Prodi', value: data.prodi },
        { icon: 'fa-calendar-alt', label: 'Semester', value: data.semester },
        { icon: 'fa-phone', label: 'No. HP', value: data.phone },
        { icon: 'fa-envelope', label: 'Email', value: data.email },
    ] : [
        { icon: 'fa-id-card', label: 'NIP', value: data.nip },
        { icon: 'fa-building', label: 'Jurusan', value: data.jurusan },
        { icon: 'fa-graduation-cap', label: 'Prodi', value: data.prodi },
        { icon: 'fa-phone', label: 'No. HP', value: data.phone },
    ];

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

document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeBiodataModal(); });
</script>

<?= $this->endSection() ?>
