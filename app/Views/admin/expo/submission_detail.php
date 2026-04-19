<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 pb-20" x-data="{
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
            <div class="flex items-center gap-2 mb-1">
                <a href="<?= base_url('admin/expo') ?>" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-sky-600 transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
                </a>
            </div>
            <h2 class="section-title text-xl sm:text-2xl">
                Detail <span class="text-gradient">Dokumentasi Expo</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Validasi dokumentasi akhir dan sertifikat keikutsertaan</p>
        </div>
        <div class="flex items-center gap-2">
             <span class="pmw-status bg-emerald-50 text-emerald-600 border-emerald-200 text-[10px] px-3 py-1.5 font-black uppercase tracking-widest">
                <i class="fas fa-check-circle mr-2"></i> Terkirim
            </span>
        </div>
    </div>

    <!-- ================================================================
         2. TEAM SUMMARY CARD
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-100" @mousemove="handleMouseMove">
        <div class="px-5 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white shadow-lg shadow-sky-100">
                    <i class="fas fa-rocket text-xl"></i>
                </div>
                <div>
                    <h3 class="font-display text-lg font-black text-(--text-heading) leading-tight">
                        <?= esc($submission->nama_usaha) ?>
                    </h3>
                    <div class="flex items-center gap-3 mt-1">
                        <span class="text-[10px] font-black text-sky-600 bg-sky-50 px-2 py-0.5 rounded border border-sky-100 uppercase tracking-wider">
                            <?= ucfirst($proposal['kategori_wirausaha'] ?? '-') ?>
                        </span>
                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                            Ketua: <span class="text-slate-600"><?= esc($submission->ketua_nama) ?> (<?= esc($submission->ketua_nim) ?>)</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="text-right hidden sm:block">
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mb-1">Dikirim Pada</p>
                <p class="text-xs font-black text-slate-700"><?= date('d M Y, H:i', strtotime($submission->submitted_at)) ?> WIB</p>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Content -->
        <div class="lg:col-span-2 space-y-8 animate-stagger delay-200">
            
            <!-- Summary Card -->
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 py-4 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-sm font-bold text-(--text-heading) uppercase tracking-widest">
                        <i class="fas fa-quote-left text-sky-500 mr-2"></i>
                        Ringkasan Hasil Usaha
                    </h3>
                </div>
                <div class="p-6">
                    <div class="p-5 rounded-2xl bg-slate-50 border border-slate-100 text-slate-700 text-sm leading-relaxed italic relative">
                        <i class="fas fa-quote-right absolute bottom-4 right-4 text-slate-200 text-2xl"></i>
                        "<?= nl2br(esc($submission->summary ?: 'Tidak ada ringkasan yang diberikan oleh tim.')) ?>"
                    </div>
                </div>
            </div>

            <!-- Attachments Gallery -->
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between">
                    <h3 class="font-display text-sm font-bold text-(--text-heading) uppercase tracking-widest">
                        <i class="fas fa-images text-rose-500 mr-2"></i>
                        Lampiran Dokumentasi
                    </h3>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest"><?= count($attachments) ?> Files</span>
                </div>
                <div class="p-6">
                    <div class="grid sm:grid-cols-2 gap-5">
                        <?php if (empty($attachments)): ?>
                            <div class="sm:col-span-2 py-12 flex flex-col items-center justify-center text-slate-300">
                                <i class="fas fa-folder-open text-4xl mb-3"></i>
                                <p class="text-xs font-bold uppercase tracking-widest">Tidak ada lampiran terunggah</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($attachments as $att): ?>
                                <div class="group relative card-premium p-3 border border-slate-100 hover:border-sky-300 transition-all duration-300 cursor-pointer"
                                     onclick="openPreviewModal('<?= $att->file_type ?>', '<?= base_url('admin/expo/attachment/' . $att->id) ?>', '<?= esc($att->title) ?>')">
                                    <div class="aspect-video rounded-xl bg-slate-50 overflow-hidden relative border border-slate-100 mb-3">
                                        <?php if ($att->file_type === 'image'): ?>
                                            <img src="<?= base_url('admin/expo/attachment/' . $att->id) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <?php else: ?>
                                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                                <i class="fas fa-file-pdf text-4xl mb-2 text-rose-400"></i>
                                                <span class="text-[9px] font-black uppercase tracking-widest">Document / PDF</span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <div class="w-10 h-10 rounded-full bg-white text-sky-600 flex items-center justify-center shadow-lg transform scale-90 group-hover:scale-100 transition-transform">
                                                <i class="fas fa-expand"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-1">
                                        <h4 class="text-[11px] font-black text-slate-700 truncate"><?= esc($att->title) ?></h4>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase mt-0.5 tracking-wider"><?= $att->file_type === 'image' ? 'Image File' : 'PDF Document' ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Sidebar -->
        <div class="space-y-8 animate-stagger delay-300">
            
            <!-- Certificate Section -->
            <div class="card-premium overflow-hidden border-l-4 border-l-sky-500" @mousemove="handleMouseMove">
                <div class="px-5 py-4 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-[11px] font-black text-slate-400 uppercase tracking-widest">
                        <i class="fas fa-certificate text-sky-500 mr-2"></i>Sertifikat Keikutsertaan
                    </h3>
                </div>
                <div class="p-5">
                    <?php if (!empty($submission->certificate_path)): ?>
                        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-500 text-white flex items-center justify-center shadow-lg shadow-emerald-100">
                                <i class="fas fa-file-pdf text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-black text-emerald-900 truncate">Sertifikat_Expo.pdf</p>
                                <p class="text-[9px] text-emerald-600 font-bold uppercase mt-0.5 tracking-wider">Terbit & Terkirim</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mt-4">
                            <button onclick="openPreviewModal('document', '<?= base_url('admin/expo/certificate/' . $submission->id) ?>', 'Sertifikat Keikutsertaan')" 
                                    class="btn-outline btn-xs flex items-center justify-center gap-2">
                                <i class="fas fa-eye"></i> Preview
                            </button>
                            <a href="<?= base_url('admin/expo/delete-certificate/' . $submission->id) ?>" 
                               onclick="return confirm('Hapus sertifikat ini?')" 
                               class="btn-outline btn-xs !text-rose-500 !border-rose-100 hover:!bg-rose-50 flex items-center justify-center gap-2">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-6 px-4 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-300 mx-auto mb-3 shadow-sm">
                                <i class="fas fa-cloud-upload-alt text-sm"></i>
                            </div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Sertifikat Belum Diunggah</p>
                            <button @click="$dispatch('open-cert-modal', {id: <?= $submission->id ?>})" 
                                    class="btn-primary btn-xs w-full">
                                <i class="fas fa-upload mr-1.5"></i> Upload Sekarang
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Team Awards -->
            <?php if (!empty($awards)): ?>
            <div class="card-premium overflow-hidden border-l-4 border-l-amber-500" @mousemove="handleMouseMove">
                <div class="px-5 py-3 border-b border-amber-50 bg-white/60">
                    <h3 class="font-display text-[11px] font-black text-slate-400 uppercase tracking-widest text-amber-600">
                        <i class="fas fa-trophy mr-2"></i>Penghargaan Awarding
                    </h3>
                </div>
                <div class="p-4 space-y-3">
                    <?php foreach ($awards as $award): ?>
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-amber-50 border border-amber-100">
                            <div class="w-8 h-8 rounded-lg bg-amber-500 text-white flex items-center justify-center shadow-lg shadow-amber-100">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div>
                                <p class="text-[11px] font-black text-amber-900 leading-tight"><?= esc($award->category_name) ?></p>
                                <p class="text-[9px] font-bold text-amber-600 uppercase mt-0.5">Juara / Peringkat <?= $award->rank ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Team Members -->
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 py-3 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-[11px] font-black text-slate-400 uppercase tracking-widest">
                        <i class="fas fa-users text-teal-500 mr-2"></i>Anggota Tim
                    </h3>
                </div>
                <div class="p-3 space-y-1.5">
                    <?php foreach ($members as $m): ?>
                        <div class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100 cursor-pointer group"
                             onclick='openBiodataModal("mahasiswa", <?= json_encode($m) ?>)'>
                            <div class="w-8 h-8 rounded bg-teal-500 flex items-center justify-center text-white font-black text-[10px] group-hover:scale-110 transition-transform">
                                <?= strtoupper(substr($m['nama'], 0, 2)) ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-black text-[11px] text-slate-700 truncate"><?= esc($m['nama']) ?></p>
                                <p class="text-[9px] text-slate-400 font-bold"><?= esc($m['nim']) ?></p>
                            </div>
                            <?php if ($m['role'] === 'ketua'): ?>
                                <i class="fas fa-crown text-[10px] text-amber-400"></i>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Supervisor Info -->
            <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 py-3 border-b border-sky-50 bg-white/60">
                    <h3 class="font-display text-[11px] font-black text-slate-400 uppercase tracking-widest">
                        <i class="fas fa-shield-halved text-indigo-500 mr-2"></i>Pembimbing & Mentor
                    </h3>
                </div>
                <div class="p-4 space-y-4">
                    <!-- Dosen -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-3 cursor-pointer group" 
                             onclick='openBiodataModal("dosen", <?= json_encode([
                                 "nama" => $proposal["dosen_nama"] ?? "-",
                                 "nip" => $proposal["dosen_nip"] ?? "-",
                                 "jurusan" => $proposal["dosen_jurusan"] ?? "-",
                                 "prodi" => $proposal["dosen_prodi"] ?? "-",
                                 "phone" => $proposal["dosen_phone"] ?? "-"
                             ]) ?>)'>
                            <div class="w-8 h-8 rounded bg-violet-500 flex items-center justify-center text-white text-[10px] font-black group-hover:scale-110 transition-transform">
                                <?= strtoupper(substr($proposal['dosen_nama'] ?? 'D', 0, 2)) ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[9px] font-black text-violet-400 uppercase tracking-wider">Dosen Pendamping</p>
                                <p class="text-[11px] font-bold text-slate-700 truncate"><?= esc($proposal['dosen_nama'] ?? '-') ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- Mentor -->
                    <div class="space-y-2 pt-3 border-t border-slate-50">
                        <div class="flex items-center gap-3 cursor-pointer group"
                             onclick='openBiodataModal("mentor", <?= json_encode([
                                 "nama" => $proposal["mentor_nama"] ?? "-",
                                 "company" => $proposal["mentor_company"] ?? "-",
                                 "phone" => $proposal["mentor_phone"] ?? "-"
                             ]) ?>)'>
                            <div class="w-8 h-8 rounded bg-indigo-500 flex items-center justify-center text-white text-[10px] font-black group-hover:scale-110 transition-transform">
                                <?= strtoupper(substr($proposal['mentor_nama'] ?? 'M', 0, 2)) ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[9px] font-black text-indigo-400 uppercase tracking-wider">Mentor Bisnis</p>
                                <p class="text-[11px] font-bold text-slate-700 truncate"><?= esc($proposal['mentor_nama'] ?? '-') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ================================================================
     MODALS
================================================================= -->

<!-- Biodata Modal -->
<div id="biodataModal" class="fixed inset-0 z-[110] hidden" aria-modal="true" role="dialog">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeBiodataModal()"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                <!-- Modal Header -->
                <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-display font-bold text-white" id="modal-title">Detail Informasi</h3>
                        <button type="button" onclick="closeBiodataModal()" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-8">
                    <!-- Avatar & Info -->
                    <div class="text-center mb-8">
                        <div id="modal-avatar" class="w-20 h-20 mx-auto rounded-3xl flex items-center justify-center text-white font-display font-black text-2xl mb-4 shadow-xl">
                            --
                        </div>
                        <h4 id="modal-nama" class="font-display font-black text-xl text-slate-800">--</h4>
                        <span id="modal-role-badge" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-black border mt-3 uppercase tracking-widest">
                            --
                        </span>
                    </div>

                    <!-- Details Grid -->
                    <div id="modal-content" class="grid md:grid-cols-2 gap-4 px-4 pb-4">
                        <!-- Dynamic content -->
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-slate-50 px-6 py-4 flex justify-end">
                    <button type="button" onclick="closeBiodataModal()" class="btn-outline text-sm">
                        <i class="fas fa-times mr-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal (Image/PDF) -->
<div id="previewModal" class="fixed inset-0 z-[120] hidden" aria-labelledby="preview-modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closePreviewModal()"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                <!-- Modal Header -->
                <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-display font-bold text-white" id="preview-modal-title">
                            <i class="fas fa-eye mr-2"></i>Preview Dokumen
                        </h3>
                        <button type="button" onclick="closePreviewModal()" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-5 bg-slate-50">
                    <!-- Document Title -->
                    <div class="mb-4">
                        <span id="previewTitle" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border bg-sky-50 text-sky-600 border-sky-200">
                            <i class="fas fa-file text-[10px]"></i>
                            <span class="truncate max-w-[300px]">Document</span>
                        </span>
                    </div>

                    <!-- Preview Content -->
                    <div class="rounded-xl overflow-hidden bg-white border border-slate-200 shadow-sm">
                        <!-- Image Preview -->
                        <div id="imageContainer" class="hidden p-4 flex items-center justify-center min-h-[300px] max-h-[500px]">
                            <img id="previewImage" src="" class="max-w-full max-h-[450px] rounded-lg object-contain">
                        </div>

                        <!-- Document Preview (Iframe) -->
                        <div id="documentContainer" class="hidden w-full h-[500px]">
                            <iframe id="previewFrame" src="" class="w-full h-full border-none"></iframe>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-white px-6 py-4 flex justify-between items-center border-t border-slate-100">
                    <div class="flex items-center gap-2 text-xs text-slate-400">
                        <i class="fas fa-info-circle"></i>
                        <span id="previewFileInfo">Image / Document Preview</span>
                    </div>
                    <div class="flex gap-2">
                        <a id="previewDownloadBtn" href="#" target="_blank" class="btn-accent text-sm">
                            <i class="fas fa-external-link-alt mr-2"></i>Buka di Tab Baru
                        </a>
                        <button type="button" onclick="closePreviewModal()" class="btn-outline text-sm">
                            <i class="fas fa-times mr-2"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Certificate Upload Modal -->
<div x-data="{ open: false, submissionId: null }" 
     x-show="open" 
     @open-cert-modal.window="open = true; submissionId = $event.detail.id"
     class="fixed inset-0 z-[130] overflow-y-auto" 
     style="display: none;">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="open = false"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg" @click.stop>
            
            <!-- Modal Header -->
            <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-display font-bold text-white">Upload Sertifikat</h3>
                    <button type="button" @click="open = false" class="text-white/80 hover:text-white transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <form action="<?= base_url('admin/expo/upload-certificate') ?>" method="POST" enctype="multipart/form-data" class="px-8 py-8">
                <?= csrf_field() ?>
                <input type="hidden" name="submission_id" :value="submissionId">
                
                <div class="text-center mb-8">
                    <div class="w-16 h-16 rounded-3xl bg-slate-50 text-sky-500 flex items-center justify-center text-2xl mx-auto mb-4 shadow-sm border border-slate-100">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Sertifikat Keikutsertaan Expo</p>
                </div>

                <div class="form-field mb-6">
                    <label class="form-label !text-slate-700">Pilih File (PDF)</label>
                    <input type="file" name="certificate" accept=".pdf" required 
                           class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[11px] file:font-black file:uppercase file:bg-sky-50 file:text-sky-600 hover:file:bg-sky-100 transition-all border border-slate-100 rounded-2xl p-2 bg-slate-50/50">
                </div>
                
                <div class="bg-slate-50 -mx-8 -mb-8 px-8 py-5 mt-8 flex gap-3 justify-end">
                    <button type="button" @click="open = false" class="btn-outline text-sm">Batal</button>
                    <button type="submit" class="btn-primary text-sm">Unggah Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// --- Biodata Modal Logic ---
function openBiodataModal(type, data) {
    const modal = document.getElementById('biodataModal');
    const avatar = document.getElementById('modal-avatar');
    const nama = document.getElementById('modal-nama');
    const roleBadge = document.getElementById('modal-role-badge');
    const content = document.getElementById('modal-content');

    let bgColor = 'bg-violet-500';
    let roleLabel = 'Dosen Pendamping';

    if (type === 'mahasiswa') {
        bgColor = 'bg-teal-500';
        roleLabel = data.role === 'ketua' ? 'Ketua Tim' : 'Anggota Tim';
    } else if (type === 'mentor') {
        bgColor = 'bg-indigo-500';
        roleLabel = 'Mentor Bisnis';
    }

    const initials = (data.nama || '??').substring(0, 2).toUpperCase();
    avatar.textContent = initials;
    avatar.className = `w-20 h-20 mx-auto rounded-3xl ${bgColor} flex items-center justify-center text-white font-display font-black text-2xl mb-4 shadow-xl`;

    nama.textContent = data.nama || '-';
    roleBadge.textContent = roleLabel;
    
    const badgeColors = bgColor === 'bg-teal-500' ? 'bg-teal-50 text-teal-600 border-teal-200' : 
                        (bgColor === 'bg-indigo-500' ? 'bg-indigo-50 text-indigo-600 border-indigo-200' : 'bg-violet-50 text-violet-600 border-violet-200');
    roleBadge.className = `inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-black border ${badgeColors} uppercase tracking-widest`;

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
            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100 group/item hover:border-sky-200 transition-colors">
                <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 group-hover/item:text-sky-500 transition-colors">
                    <i class="fas ${f.icon} text-xs"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest truncate">${f.label}</p>
                    <p class="text-[12px] font-bold text-slate-700 truncate">${f.value}</p>
                </div>
            </div>`;
        }
    });

    content.innerHTML = html || '<p class="text-center text-slate-400 py-4 font-bold uppercase text-[10px] tracking-widest">Tidak ada data tambahan</p>';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeBiodataModal() {
    document.getElementById('biodataModal').classList.add('hidden');
    document.body.style.overflow = '';
}

// --- Preview Modal Logic ---
function openPreviewModal(type, src, title) {
    const modal = document.getElementById('previewModal');
    const imageContainer = document.getElementById('imageContainer');
    const documentContainer = document.getElementById('documentContainer');
    const img = document.getElementById('previewImage');
    const frame = document.getElementById('previewFrame');
    const titleEl = document.getElementById('previewTitle');
    const titleSpan = titleEl.querySelector('span');
    const fileInfo = document.getElementById('previewFileInfo');
    const downloadBtn = document.getElementById('previewDownloadBtn');

    // Set title
    titleSpan.textContent = title || 'Dokumen';

    // Update file info and icon
    if (type === 'image') {
        titleEl.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border bg-emerald-50 text-emerald-600 border-emerald-200';
        titleEl.innerHTML = '<i class="fas fa-image text-[10px]"></i><span class="truncate max-w-[300px]">' + (title || 'Gambar') + '</span>';
        fileInfo.textContent = 'Image Preview • Klik untuk memperbesar';
    } else {
        titleEl.className = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border bg-rose-50 text-rose-600 border-rose-200';
        titleEl.innerHTML = '<i class="fas fa-file-pdf text-[10px]"></i><span class="truncate max-w-[300px]">' + (title || 'PDF Document') + '</span>';
        fileInfo.textContent = 'PDF Document Preview';
    }

    // Set download button href
    downloadBtn.href = src;

    // Reset
    imageContainer.classList.add('hidden');
    documentContainer.classList.add('hidden');
    img.src = '';
    frame.src = '';

    if (type === 'image') {
        img.src = src;
        imageContainer.classList.remove('hidden');
    } else {
        frame.src = src;
        documentContainer.classList.remove('hidden');
    }

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePreviewModal() {
    document.getElementById('previewModal').classList.add('hidden');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', (e) => { 
    if (e.key === 'Escape') {
        closeBiodataModal();
        closePreviewModal();
    }
});
</script>

<?= $this->endSection() ?>
