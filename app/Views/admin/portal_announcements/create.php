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

    <form action="<?= base_url('admin/portal-announcements/store') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>
        
        <div class="bg-white rounded-[2rem] border border-slate-200 p-8 shadow-sm">
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
                    <select name="category" required class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:bg-white focus:border-sky-500 outline-none transition-all">
                        <option value="Penting">Penting</option>
                        <option value="Info" selected>Info</option>
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
                    <input type="date" name="date" required value="<?= date('Y-m-d') ?>"
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

                <!-- Content -->
                <div class="md:col-span-2">
                    <label class="text-[10px] font-bold text-slate-400 uppercase mb-2 block tracking-wider">Isi Pengumuman</label>
                    <textarea name="content" rows="8" required placeholder="Tulis detail pengumuman di sini..."
                              class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all resize-none shadow-inner leading-relaxed"></textarea>
                    <p class="text-[10px] text-slate-400 mt-2 italic">Mendukung format HTML dasar.</p>
                </div>
            </div>
        </div>

        <!-- Submit Bar -->
        <div class="flex items-center justify-end gap-3">
            <a href="<?= base_url('admin/portal-announcements') ?>" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">Batal</a>
            <button type="submit" class="px-10 py-3 bg-sky-500 hover:bg-sky-600 text-white text-sm font-black rounded-2xl transition-all shadow-lg shadow-sky-500/25 active:scale-95">
                SIMPAN PENGUMUMAN
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slug = title.toLowerCase()
        .replace(/[^\w ]+/g, '')
        .replace(/ +/g, '-');
    document.getElementById('slug').value = slug;
});
</script>
<?= $this->endSection() ?>
