<!-- CMS Home Page Wrapper -->
<div class="space-y-6">
    <div class="bg-gradient-to-r from-sky-600 to-indigo-700 rounded-3xl p-8 mb-8 text-white relative overflow-hidden shadow-xl shadow-sky-500/20">
        <div class="relative z-10">
            <h2 class="text-2xl font-black mb-2">Editor Beranda</h2>
            <p class="text-sky-100 text-xs font-medium max-w-md leading-relaxed opacity-90">Sesuaikan Hero section, fitur unggulan, dan alur kerja yang tampil di halaman utama portal.</p>
        </div>
        <i class="fas fa-home absolute right-8 top-1/2 -translate-y-1/2 text-8xl text-white/10 -rotate-12"></i>
    </div>

    <?= $this->include('admin/cms/partials/_content_list', ['items' => $items]) ?>
</div>
