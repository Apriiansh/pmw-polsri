<!-- CMS Tahapan Page Wrapper -->
<div class="space-y-6">
    <div class="bg-gradient-to-r from-amber-500 to-orange-600 rounded-3xl p-8 mb-8 text-white relative overflow-hidden shadow-xl shadow-amber-500/20">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl font-black mb-2">Alur & Tahapan</h2>
                <p class="text-amber-100 text-xs font-medium max-w-md leading-relaxed opacity-90">Kelola informasi timeline kegiatan dan detail setiap tahapan kompetisi PMW.</p>
            </div>
            <a href="<?= base_url('admin/pmw-system') ?>" 
               class="bg-white/20 hover:bg-white/30 backdrop-blur-md px-6 py-3 rounded-2xl text-xs font-black transition-all flex items-center gap-3 border border-white/10 group">
                <i class="fas fa-route group-hover:rotate-12 transition-transform"></i>
                PENGATURAN SISTEM & TAHAPAN
                <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </div>
        <i class="fas fa-route absolute right-8 top-1/2 -translate-y-1/2 text-8xl text-white/10 -rotate-12"></i>
    </div>

    <?= $this->include('admin/cms/partials/_content_list', ['items' => $items]) ?>
</div>
