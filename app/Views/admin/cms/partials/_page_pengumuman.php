<!-- CMS Pengumuman Page Wrapper -->
<div class="space-y-6">
    <div class="bg-gradient-to-r from-violet-600 to-purple-700 rounded-3xl p-8 mb-8 text-white relative overflow-hidden shadow-xl shadow-violet-500/20">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl font-black mb-2">Halaman Pengumuman</h2>
                <p class="text-violet-100 text-xs font-medium max-w-md leading-relaxed opacity-90">Kustomisasi teks banner dan area langganan informasi terbaru.</p>
            </div>
            <a href="<?= base_url('admin/portal-announcements') ?>" 
               class="bg-white/20 hover:bg-white/30 backdrop-blur-md px-6 py-3 rounded-2xl text-xs font-black transition-all flex items-center gap-3 border border-white/10 group">
                <i class="fas fa-bullhorn group-hover:rotate-12 transition-transform"></i>
                KELOLA DATA PENGUMUMAN
                <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </div>
        <i class="fas fa-bullhorn absolute right-8 top-1/2 -translate-y-1/2 text-8xl text-white/10 -rotate-12"></i>
    </div>

    <?= $this->include('admin/cms/partials/_content_list', ['items' => $items]) ?>
</div>
