<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="<?= base_url('admin/portal-announcements') ?>" class="w-10 h-10 rounded-xl border border-slate-200 flex items-center justify-center text-slate-400 hover:text-sky-600 hover:border-sky-200 hover:bg-sky-50 transition-all">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="font-display text-2xl font-bold text-slate-800 tracking-tight">Buat Pengumuman</h1>
            <p class="text-xs text-slate-500 font-medium">Isi detail pengumuman untuk dipublikasikan ke portal.</p>
        </div>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="bg-rose-50 border border-rose-100 text-rose-600 px-4 py-3 rounded-xl text-sm mb-6">
            <ul class="list-disc list-inside">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

<div x-data="{ 
    files: []
}">
    <form action="<?= base_url('admin/portal-announcements/store') ?>" method="POST" enctype="multipart/form-data" class="space-y-6" id="announcementForm">
        <?= csrf_field() ?>
        
        <div class="bg-white rounded-md border border-slate-200 p-8 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase mb-2 block tracking-wider">Judul Pengumuman</label>
                    <input type="text" name="title" id="title" required
                           placeholder="Contoh: Pendaftaran PMW 2026 Resmi Dibuka"
                           class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all">
                </div>

                <!-- Slug -->
                <div class="md:col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase mb-2 block tracking-wider">URL Slug (Otomatis)</label>
                    <div class="relative">
                        <i class="fas fa-link absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                        <input type="text" name="slug" id="slug" required readonly
                               class="w-full pl-10 pr-5 py-3 bg-slate-100 border border-slate-200 rounded-2xl text-xs font-mono text-slate-500 outline-none cursor-not-allowed">
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase mb-2 block tracking-wider">Kategori</label>
                    <select name="category" required
                            class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:bg-white focus:border-sky-500 outline-none transition-all">
                        <option value="Penting">Penting</option>
                        <option value="Info">Info</option>
                        <option value="Jadwal">Jadwal</option>
                        <option value="Prestasi">Prestasi</option>
                        <option value="Umum">Umum</option>
                    </select>
                </div>

                <!-- Type (Color Style) -->
                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase mb-2 block tracking-wider">Gaya Tampilan (Warna)</label>
                    <select name="type" required class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:bg-white focus:border-sky-500 outline-none transition-all">
                        <option value="normal">Normal (Biru)</option>
                        <option value="urgent">Urgent (Merah)</option>
                        <option value="success">Prestasi (Hijau)</option>
                        <option value="warning">Jadwal (Kuning)</option>
                    </select>
                </div>

                <!-- Date -->
                <div>
                    <label class="text-[10px] font-bold text-slate-400 uppercase mb-2 block tracking-wider">Tanggal</label>
                    <input type="date" name="date" required
                           class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:bg-white focus:border-sky-500 outline-none transition-all">
                </div>

                <!-- Status -->
                <div class="flex items-center gap-3 h-full pt-6">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-sky-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sky-500"></div>
                        <span class="ml-3 text-sm font-bold text-slate-700">Publikasikan Sekarang</span>
                    </label>
                </div>

                <!-- Content with QuillJS -->
                <div class="md:col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase mb-2 block tracking-wider">Isi Pengumuman</label>
                    <div id="quillEditor" class="min-h-[300px] bg-slate-50 rounded-2xl border border-slate-200"></div>
                    <input type="hidden" name="announcement_content" id="contentInput">
                </div>

                <!-- Multiple Attachments -->
                <div class="md:col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase mb-2 block tracking-wider">Lampiran File (PDF, Gambar, ZIP)</label>
                    <div class="relative group">
                        <input type="file" name="attachments[]" multiple 
                               @change="files = Array.from($event.target.files)"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-full px-5 py-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl flex flex-col items-center justify-center transition-all group-hover:border-sky-400 group-hover:bg-sky-50">
                            <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center text-slate-400 mb-3 group-hover:text-sky-500 group-hover:scale-110 transition-all">
                                <i class="fas fa-cloud-arrow-up text-xl"></i>
                            </div>
                            <p class="text-sm font-bold text-slate-600 mb-1">Klik atau seret file ke sini</p>
                            <p class="text-[10px] text-slate-400 uppercase tracking-widest">Maksimal 10MB per file</p>
                        </div>
                    </div>

                    <!-- File List Preview -->
                    <template x-if="files.length > 0">
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                            <template x-for="(file, index) in files" :key="index">
                                <div class="flex items-center justify-between p-3 bg-white border border-slate-100 rounded-2xl shadow-sm">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                            <i class="fas" :class="file.type.includes('image') ? 'fa-file-image' : 'fa-file-pdf'"></i>
                                        </div>
                                        <div class="overflow-hidden">
                                            <p class="text-xs font-bold text-slate-700 truncate w-48" x-text="file.name"></p>
                                            <p class="text-[10px] text-slate-400" x-text="(file.size / 1024 / 1024).toFixed(2) + ' MB'"></p>
                                        </div>
                                    </div>
                                    <button type="button" class="text-slate-300 hover:text-rose-500 transition-colors p-2">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Submit Bar -->
        <div class="flex items-center justify-end gap-3 mb-12">
            <a href="<?= base_url('admin/portal-announcements') ?>" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">Batal</a>
            <button type="submit" class="px-10 py-3 bg-sky-500 hover:bg-sky-600 text-white text-sm font-black rounded-2xl transition-all shadow-lg shadow-sky-500/25 active:scale-95">
                SIMPAN PENGUMUMAN
            </button>
        </div>

    </form>
</div>
</div>

<style>
/* Quill Theme Adjustments */
.ql-toolbar.ql-snow {
    border: none !important;
    background: white !important;
    padding: 1rem !important;
    border-bottom: 1px solid #e2e8f0 !important;
    border-radius: 1.25rem 1.25rem 0 0 !important;
}
.ql-container.ql-snow {
    border: none !important;
    font-family: 'Inter', sans-serif !important;
    font-size: 0.875rem !important;
}
.ql-editor {
    min-height: 250px !important;
    padding: 1.5rem !important;
}
.ql-editor.ql-blank::before {
    color: #94a3b8 !important;
    font-style: normal !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const form = document.getElementById('announcementForm');
    const contentInput = document.getElementById('contentInput');
    const alpineEl = document.querySelector('[x-data]');

    // Slug Logic (Keep automatic for Create mode)
    titleInput.addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
        slugInput.value = slug;
    });

    // QuillJS Initialization
    const quill = new Quill('#quillEditor', {
        theme: 'snow',
        placeholder: 'Tulis detail pengumuman di sini...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered' }],
                ['link', 'blockquote', 'code-block'],
                ['clean']
            ]
        }
    });

    // Helper to update Alpine preview
    function updatePreview() {
        const delta = quill.getContents();
        const json = JSON.stringify(delta);

        // Sync to hidden input immediately for robustness
        contentInput.value = json;
    }

    // Sync on every change
    quill.on('text-change', function() {
        updatePreview();
    });

    // Initial sync
    if (window.Alpine) {
        updatePreview();
    } else {
        document.addEventListener('alpine:initialized', updatePreview);
    }
    
    // Fallback initial sync
    setTimeout(updatePreview, 100);

    // Form Submit handling
    form.addEventListener('submit', function(e) {
        // Final sync check
        const delta = quill.getContents();
        contentInput.value = JSON.stringify(delta);
        
        // Validation check for content (check if delta has actual content)
        const isBlank = delta.ops.length === 0 || (delta.ops.length === 1 && delta.ops[0].insert === '\n');
        
        if (isBlank) {
            e.preventDefault();
            Swal.fire({
                title: 'Konten Kosong',
                text: 'Isi pengumuman tidak boleh kosong!',
                icon: 'error',
                borderRadius: '1.5rem'
            });
            return;
        }
    });
});
</script>
<?= $this->endSection() ?>
