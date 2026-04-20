<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section id="section-galeri-hero" class="relative overflow-hidden hero-gradient hero-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-4"><?= cms('galeri_hero_badge', 'Dokumentasi') ?></p>
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-slate-900 mb-6">
                <?= cms('galeri_hero_title', 'Galeri <span class="text-gradient">Kegiatan</span>') ?>
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                <?= cms('galeri_hero_description', 'Momen-momen berkesan dari Program Mahasiswa Wirausaha Polsri. Lihat aktivitas mentoring, pitching, bazaar, dan awarding.') ?>
            </p>
        </div>
    </div>
</section>

<!-- Gallery Filter -->
<section class="py-12 border-b border-sky-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-3">
            <button class="filter-btn active px-5 py-2.5 rounded-full text-sm font-medium transition-all bg-sky-500 text-white shadow-md shadow-sky-200">
                Semua
            </button>
            <button class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium transition-all bg-white text-slate-600 border border-slate-200 hover:border-sky-300 hover:text-sky-600">
                Mentoring
            </button>
            <button class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium transition-all bg-white text-slate-600 border border-slate-200 hover:border-sky-300 hover:text-sky-600">
                Pitching
            </button>
            <button class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium transition-all bg-white text-slate-600 border border-slate-200 hover:border-sky-300 hover:text-sky-600">
                Bazaar
            </button>
            <button class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium transition-all bg-white text-slate-600 border border-slate-200 hover:border-sky-300 hover:text-sky-600">
                Awarding
            </button>
            <button class="filter-btn px-5 py-2.5 rounded-full text-sm font-medium transition-all bg-white text-slate-600 border border-slate-200 hover:border-sky-300 hover:text-sky-600">
                Workshop
            </button>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section id="section-galeri-grid" class="py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php 
            $items = cms('galeri_items_list', []);
            if (empty($items)) {
                $items = [
                    ['img' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80', 'badge' => 'Mentoring 2025', 'title' => 'Sesi Mentoring Intensif', 'desc' => 'Dosen dan mentor berbagi pengalaman', 'size' => 'large'],
                    ['img' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=400&q=80', 'badge' => 'Pitching', 'title' => 'Pitching Desk 2025', 'desc' => '', 'size' => 'small'],
                    ['img' => 'https://images.unsplash.com/photo-1531058020387-3be344556be6?w=400&q=80', 'badge' => 'Awarding', 'title' => 'Awarding 2024', 'desc' => '', 'size' => 'small'],
                    ['img' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=400&q=80', 'badge' => 'Workshop', 'title' => 'Workshop Business Plan', 'desc' => '', 'size' => 'small'],
                    ['img' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=400&q=80', 'badge' => 'Bazaar', 'title' => 'Bazaar Monev 2025', 'desc' => '', 'size' => 'small'],
                ];
            }
            foreach ($items as $item): 
                $spanClass = ($item['size'] ?? 'small') === 'large' ? 'col-span-2 row-span-2' : '';
            ?>
                <div class="gallery-item group <?= $spanClass ?>">
                    <img src="<?= cms_img($item['img']) ?>" alt="<?= $item['title'] ?>">
                    <div class="gallery-overlay">
                        <span class="badge badge-sky mb-2 w-fit"><?= $item['badge'] ?></span>
                        <p class="text-white font-semibold <?= ($item['size'] ?? 'small') === 'large' ? 'text-lg' : 'text-sm' ?>"><?= $item['title'] ?></p>
                        <?php if ($item['desc']): ?>
                            <p class="text-white/80 text-sm"><?= $item['desc'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Load More -->
        <div class="text-center mt-12">
            <button class="btn-outline">
                <i class="fas fa-plus-circle mr-2"></i>
                Muat Lebih Banyak
            </button>
        </div>
    </div>
</section>

<!-- Video Section -->
<section class="py-20 lg:py-32 bg-linear-to-b from-sky-50/30 to-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Video</p>
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-slate-900 mb-4">
                Dokumentasi <span class="text-gradient">Video</span>
            </h2>
            <p class="text-slate-600 mb-6">
                Tonton video highlight dan testimonial dari program PMW.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-sky-100 group cursor-pointer">
                <div class="relative aspect-video">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=600&q=80" alt="Video thumbnail" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center group-hover:bg-black/40 transition-all">
                        <div class="w-16 h-16 rounded-full bg-white/90 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-play text-sky-500 text-xl ml-1"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <span class="badge badge-sky mb-2">Highlight</span>
                    <h3 class="font-display text-lg font-bold text-slate-900 mb-1">PMW 2024 Highlight</h3>
                    <p class="text-sm text-slate-500">3:45 menit • 1.2K views</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-sky-100 group cursor-pointer">
                <div class="relative aspect-video">
                    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=600&q=80" alt="Video thumbnail" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center group-hover:bg-black/40 transition-all">
                        <div class="w-16 h-16 rounded-full bg-white/90 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-play text-sky-500 text-xl ml-1"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <span class="badge badge-yellow mb-2">Testimonial</span>
                    <h3 class="font-display text-lg font-bold text-slate-900 mb-1">Cerita Sukses Alumni</h3>
                    <p class="text-sm text-slate-500">5:20 menit • 890 views</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-sky-100 group cursor-pointer">
                <div class="relative aspect-video">
                    <img src="https://images.unsplash.com/photo-1531058020387-3be344556be6?w=600&q=80" alt="Video thumbnail" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center group-hover:bg-black/40 transition-all">
                        <div class="w-16 h-16 rounded-full bg-white/90 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-play text-sky-500 text-xl ml-1"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <span class="badge badge-emerald mb-2">Tutorial</span>
                    <h3 class="font-display text-lg font-bold text-slate-900 mb-1">Tips Menulis Proposal</h3>
                    <p class="text-sm text-slate-500">8:15 menit • 2.1K views</p>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Simple filter functionality
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active', 'bg-sky-500', 'text-white', 'shadow-md', 'shadow-sky-200');
                b.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            });
            
            // Add active class to clicked
            this.classList.add('active', 'bg-sky-500', 'text-white', 'shadow-md', 'shadow-sky-200');
            this.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');
        });
    });
</script>
<?= $this->endSection() ?>
