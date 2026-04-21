<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section id="section-hero" class="relative overflow-hidden hero-gradient hero-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-24 pb-20 lg:pt-28 relative z-10">
        <!-- Floating Decorative Blobs -->
        <div class="absolute top-0 -left-20 w-72 h-72 bg-sky-400/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-0 -right-20 w-96 h-96 bg-indigo-400/10 rounded-full blur-3xl animate-float" style="animation-delay: -2s"></div>

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            
            <!-- Content -->
            <div>
                <div class="badge badge-sky mb-4">
                    <i class="fas fa-rocket text-xs"></i>
                    <span><?= cms('home_hero_badge', 'Program Tahun 2026') ?></span>
                </div>
                
                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-(--text-heading) leading-tight mb-6 text-shimmer">
                    <?= cms('home_hero_title_1', 'Program Mahasiswa') ?> <br>
                    <span class="text-gradient"><?= cms('home_hero_title_2', 'Wirausaha') ?></span>
                </h1>
                
                <p class="text-lg text-(--text-body) leading-relaxed mb-8 max-w-xl">
                    <?= cms('home_hero_description', 'Politeknik Negeri Sriwijaya memfasilitasi mahasiswa untuk mengembangkan ide bisnis menjadi usaha nyata melalui program pembinaan kewirausahaan.') ?>
                </p>
                
                <div class="flex flex-wrap gap-4">
                    <a href="<?= base_url('register') ?>" class="btn-accent text-base px-8 py-4">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Daftar Sekarang
                    </a>
                    <a href="<?= base_url('tentang') ?>" class="btn-outline text-base px-8 py-4">
                        <i class="fas fa-play-circle mr-2"></i>
                        Pelajari Program
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="flex flex-wrap gap-8 mt-12 pt-8 border-t border-sky-200/50">
                    <?php 
                    $stats = cms('home_hero_stats', [
                        ['number' => '7+', 'label' => 'Tahun Berdiri'],
                        ['number' => '100+', 'label' => 'Tim Terbina'],
                        ['number' => '50+', 'label' => 'Usaha Aktif'],
                    ]);
                    foreach ($stats as $idx => $stat): 
                    ?>
                    <div>
                        <div class="stat-number"><?= $stat['number'] ?></div>
                        <div class="stat-label"><?= $stat['label'] ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Hero Image -->
            <div class="relative lg:pl-8">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-sky-200/50 card-magnetic">
                    <img 
                        src="<?= cms_img(cms('home_hero_image'), 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80') ?>" 
                        alt="Mahasiswa berkolaborasi" 
                        class="w-full h-auto object-cover aspect-4/3"
                    >
                    <div class="absolute inset-0 bg-linear-to-tr from-sky-500/20 to-transparent rounded-2xl"></div>
                </div>
                
                <!-- Floating Cards (Desktop only for cleaner mobile UI) -->
                <div class="absolute -bottom-6 -left-6 bg-white rounded-xl p-4 shadow-lg border border-sky-100 animate-stagger delay-300 hidden sm:block">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 flex items-center justify-center">
                            <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Pendaftaran Dibuka</p>
                            <p class="text-sm text-slate-500">Batch Tahun 2026</p>
                        </div>
                    </div>
                </div>
                
                <div class="absolute -top-4 -right-4 bg-white rounded-xl p-3 shadow-lg border border-sky-100 animate-stagger delay-400 hidden sm:block">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center">
                            <i class="fas fa-lightbulb text-yellow-500"></i>
                        </div>
                        <span class="text-sm font-medium text-slate-700">Ide Kreatif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 hidden lg:flex flex-col items-center gap-2 text-slate-400">
        <span class="text-xs font-medium uppercase tracking-wider">Scroll</span>
        <div class="w-6 h-10 border-2 border-slate-300 rounded-full flex justify-center pt-2">
            <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce"></div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="section-features" class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-16 reveal-on-scroll">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3"><?= cms('home_features_badge', 'Mengapa PMW?') ?></p>
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading) mb-4 text-shimmer">
                <?= cms('home_features_title', 'Program Pembinaan Komprehensif') ?>
            </h2>
            <p class="text-(--text-muted)">
                <?= cms('home_features_description', 'Program Mahasiswa Wirausaha dirancang untuk memberikan dukungan holistik dari ide hingga usaha yang berkelanjutan.') ?>
            </p>
        </div>
        
        <!-- Features Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php 
            $features = cms('home_features_list', []);
            foreach ($features as $index => $feature): 
            ?>
            <div class="group relative p-8 rounded-3xl glass-premium reveal-zoom card-magnetic stagger-<?= ($index % 4) + 1 ?> hover:border-sky-400/50 transition-all duration-500">
                <!-- Decorative Light Glow -->
                <div class="absolute -top-10 -right-10 w-24 h-24 bg-sky-400/10 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                
                <div class="feature-icon <?= $feature['color'] ?? 'sky' ?> mb-6 transform group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500">
                    <i class="fas <?= $feature['icon'] ?? 'fa-rocket' ?> text-2xl"></i>
                </div>
                
                <h3 class="font-display text-xl font-bold text-(--text-heading) mb-3 group-hover:text-sky-600 transition-colors">
                    <?= $feature['title'] ?>
                </h3>
                
                <p class="text-sm text-(--text-muted) leading-relaxed">
                    <?= $feature['desc'] ?>
                </p>
                
                <!-- Bottom indicator -->
                <div class="mt-6 w-10 h-1 bg-slate-100 rounded-full overflow-hidden">
                    <div class="w-0 group-hover:w-full h-full bg-sky-500 transition-all duration-700 ease-out-expo"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Workflow Preview Section -->
<section id="section-workflow" class="py-20 lg:py-32 bg-linear-to-b from-white to-sky-50/30">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            
            <!-- Image -->
            <div class="relative order-2 lg:order-1 reveal-left">
                <div class="relative rounded-2xl overflow-hidden shadow-xl reveal-mask">
                    <img 
                        src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80" 
                        alt="Workshop PMW" 
                        class="w-full h-auto object-cover aspect-4/3"
                    >
                </div>
                
                <!-- Badge -->
                <div class="absolute top-6 right-6 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-3 shadow-lg">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-calendar-alt text-sky-500"></i>
                        <span class="text-sm font-medium text-slate-700">Program 2026</span>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="order-1 lg:order-2 reveal-right stagger-1">
                <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3"><?= cms('home_workflow_badge', 'Alur Program') ?></p>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading) mb-6">
                    <?= cms('home_workflow_title', '11 Tahapan Menuju Wirausaha Mandiri') ?>
                </h2>
                
                <p class="text-(--text-body) leading-relaxed mb-8">
                    <?= cms('home_workflow_description', 'Program ini dirancang dengan pendekatan berbasis proses yang sistematis. Setiap tahap memiliki kriteria evaluasi yang jelas dan dukungan yang sesuai.') ?>
                </p>
                
                <!-- Timeline Preview -->
                <div class="space-y-4 mb-8">
                    <?php 
                    $workflow = cms('home_workflow_list', []);
                    foreach ($workflow as $idx => $item): 
                    ?>
                    <div class="group flex items-center gap-4 p-4 rounded-2xl bg-white border border-sky-100 shadow-sm hover:shadow-lg hover:border-sky-300 transition-liquid hover-slide-right reveal-on-scroll stagger-<?= ($idx % 5) + 1 ?>">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-<?= $item['color'] ?? 'sky' ?>-100 flex items-center justify-center text-<?= $item['color'] ?? 'sky' ?>-600 font-bold text-sm group-hover:scale-110 transition-liquid">
                            <?= $item['num'] ?>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 group-hover:text-sky-600 transition-liquid"><?= $item['title'] ?></p>
                            <p class="text-xs text-slate-500 leading-relaxed"><?= $item['desc'] ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <a href="<?= base_url('tahapan') ?>" class="btn-outline btn-magnetic group">
                    <span>Lihat Seluruh Tahapan</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Preview Section -->
<section id="section-gallery" class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3"><?= cms('home_gallery_badge', 'Dokumentasi') ?></p>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading)">
                    <?= cms('home_gallery_title_1', 'Galeri') ?> <span class="text-gradient"><?= cms('home_gallery_title_2', 'Kegiatan') ?></span>
                </h2>
            </div>
            <a href="<?= base_url('galeri') ?>" class="btn-ghost text-sm">
                <span>Lihat Semua</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <div class="gallery-item sm:col-span-2 sm:row-span-2 reveal-zoom">
                <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?w=800&q=80" alt="Mentoring session" class="reveal-mask">
                <div class="gallery-overlay">
                    <p class="text-white font-semibold">Sesi Mentoring 2025</p>
                    <p class="text-white/80 text-sm">Dosen dan mentor berbagi pengalaman</p>
                </div>
            </div>
            <div class="gallery-item reveal-blur stagger-1">
                <img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=400&q=80" alt="Team collaboration">
                <div class="gallery-overlay">
                    <p class="text-white font-semibold text-sm">Team Work</p>
                </div>
            </div>
            <div class="gallery-item reveal-blur stagger-2">
                <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=400&q=80" alt="Pitching event">
                <div class="gallery-overlay">
                    <p class="text-white font-semibold text-sm">Pitching Day</p>
                </div>
            </div>
            <div class="gallery-item reveal-blur stagger-3">
                <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=400&q=80" alt="Award ceremony">
                <div class="gallery-overlay">
                    <p class="text-white font-semibold text-sm">Awarding</p>
                </div>
            </div>
            <div class="gallery-item reveal-blur stagger-4">
                <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=400&q=80" alt="Bazaar">
                <div class="gallery-overlay">
                    <p class="text-white font-semibold text-sm">Bazaar Monev</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics -->
<section id="section-stats-container" class="py-12 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div id="section-stats" class="py-16 lg:py-24 bg-linear-to-br from-yellow-400 to-amber-500 p-6 lg:p-8 rounded-[2.5rem] text-center relative overflow-hidden shadow-2xl shadow-amber-200/50">
            <div class="absolute inset-0 opacity-20 lg:opacity-30">
                <div class="absolute -top-12 -right-12 w-64 h-64 lg:w-96 lg:h-96 bg-yellow-300 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-12 -left-12 w-64 h-64 lg:w-96 lg:h-96 bg-amber-300 rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative z-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 text-center">
                    <?php 
                    $stats = cms('home_stats_list', [
                        ['icon' => 'fa-users', 'val' => '500+', 'label' => 'Peserta Terdaftar', 'color' => 'sky'],
                        ['icon' => 'fa-store', 'val' => '120+', 'label' => 'Usaha Aktif', 'color' => 'yellow'],
                        ['icon' => 'fa-chalkboard-teacher', 'val' => '50+', 'label' => 'Mentor Berpengalaman', 'color' => 'emerald'],
                        ['icon' => 'fa-hand-holding-dollar', 'val' => '2.5M', 'label' => 'Total Dana Terdistribusi', 'color' => 'amber'],
                    ]);
                    foreach ($stats as $idx => $stat): 
                        $bgColor = "bg-{$stat['color']}-100";
                        $textColor = "text-{$stat['color']}-600";
                    ?>
                        <div class="bg-white/80 backdrop-blur-md rounded-3xl p-6 lg:p-8 shadow-sm border border-white/50 reveal-zoom card-magnetic stagger-<?= ($idx % 4) + 1 ?>">
                            <div class="w-14 h-14 rounded-2xl <?= $bgColor ?> flex items-center justify-center mx-auto mb-4 shadow-inner">
                                <i class="fas <?= $stat['icon'] ?> <?= $textColor ?> text-2xl"></i>
                            </div>
                            <div class="text-4xl lg:text-5xl font-display font-bold <?= $textColor ?> mb-2 tracking-tight"><?= $stat['val'] ?></div>
                            <div class="text-slate-600 font-semibold text-sm lg:text-base"><?= $stat['label'] ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Announcements Section -->
<section id="section-announcements" class="py-20 lg:py-32 bg-linear-to-b from-sky-50/30 to-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid lg:grid-cols-3 gap-12">
            
            <!-- Section Header -->
            <div class="lg:col-span-1">
                <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3"><?= cms('home_announcement_badge', 'Informasi Terkini') ?></p>
                <h2 class="font-display text-3xl font-bold text-(--text-heading) mb-4">
                    <?= cms('home_announcement_title_1', 'Pengumuman') ?> <span class="text-gradient"><?= cms('home_announcement_title_2', 'Terbaru') ?></span>
                </h2>
                <p class="text-(--text-muted) mb-6">
                    <?= cms('home_announcement_description', 'Pantau terus informasi penting seputar Program Mahasiswa Wirausaha.') ?>
                </p>
                <a href="<?= base_url('pengumuman') ?>" class="btn-primary">
                    <span>Semua Pengumuman</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            
            <!-- Announcements List -->
            <div class="lg:col-span-2 space-y-4">
                <?php if (empty($latestAnnouncements)): ?>
                    <div class="bg-white rounded-2xl border border-slate-100 p-8 text-center">
                        <p class="text-slate-500">Belum ada pengumuman terbaru.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($latestAnnouncements as $idx => $ann): ?>
                        <a href="<?= base_url('pengumuman/' . $ann['slug']) ?>" class="announcement-card block group transition-liquid hover-slide-right reveal-on-scroll reveal-right stagger-<?= ($idx % 4) + 1 ?> <?= $ann['type'] === 'urgent' ? 'urgent' : ($ann['type'] === 'success' ? 'success' : ($ann['type'] === 'warning' ? 'warning' : '')) ?>">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl <?= 
                                    $ann['type'] === 'urgent' ? 'bg-rose-100 text-rose-500' : (
                                    $ann['type'] === 'success' ? 'bg-emerald-100 text-emerald-500' : (
                                    $ann['type'] === 'warning' ? 'bg-amber-100 text-amber-500' : 'bg-sky-100 text-sky-500')) 
                                ?> flex items-center justify-center shrink-0 group-hover:scale-110 transition-liquid">
                                    <i class="fas <?= 
                                        $ann['type'] === 'urgent' ? 'fa-exclamation' : (
                                        $ann['type'] === 'success' ? 'fa-trophy' : (
                                        $ann['type'] === 'warning' ? 'fa-calendar' : 'fa-info')) 
                                    ?>"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="badge <?= 
                                            $ann['type'] === 'urgent' ? 'bg-rose-100 text-rose-700' : (
                                            $ann['type'] === 'success' ? 'badge-emerald' : (
                                            $ann['type'] === 'warning' ? 'badge-yellow' : 'badge-sky')) 
                                        ?>"><?= $ann['category'] ?></span>
                                        <span class="text-xs text-slate-400"><?= date('d F Y', strtotime($ann['date'])) ?></span>
                                    </div>
                                    <h3 class="font-semibold text-slate-800 mb-1 group-hover:text-sky-600 transition-liquid"><?= $ann['title'] ?></h3>
                                    <div class="flex items-center gap-1 text-[10px] font-bold text-sky-500 uppercase tracking-wider opacity-0 group-hover:opacity-100 transition-liquid">
                                        Baca Selengkapnya <i class="fas fa-chevron-right text-[8px]"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section id="section-cta" class="py-20 lg:py-28 relative overflow-hidden">
    <!-- Base Gradient Layer -->
    <div class="absolute inset-0 cta-gradient opacity-90"></div>
    <div class="absolute inset-0 cta-pattern opacity-30"></div>

    <!-- Floating Decorative Blobs (More dynamic) -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-float"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-amber-400/20 rounded-full blur-3xl animate-float" style="animation-delay: -3s"></div>
    
    <div class="max-w-5xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="reveal-zoom glass-premium p-10 lg:p-16 rounded-[40px] border-white/20 shadow-2xl text-center backdrop-blur-xl">
            <div class="badge badge-yellow mb-8 mx-auto reveal-on-scroll stagger-1">
                <i class="fas fa-rocket text-xs animate-bounce"></i>
                <span><?= cms('home_cta_badge', 'Siap Memulai?') ?></span>
            </div>
            
            <h2 class="font-display text-4xl lg:text-6xl font-bold text-white mb-8 leading-tight reveal-on-scroll stagger-2">
                <?= cms('home_cta_title', 'Bersiaplah untuk PMW Berikutnya') ?>
            </h2>
            
            <p class="text-xl text-white/80 mb-12 max-w-2xl mx-auto reveal-on-scroll stagger-3">
                <?= cms('home_cta_description', 'Pelajari tahapan program dan persiapkan diri Anda untuk pendaftaran periode berikutnya. Tim kami siap membimbing Anda.') ?>
            </p>
            
            <div class="flex flex-wrap justify-center gap-6 reveal-on-scroll stagger-4">
                <a href="<?= base_url('register') ?>" class="btn-accent btn-magnetic group relative overflow-hidden text-lg px-10 py-5 shadow-xl shadow-amber-500/25">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-paper-plane mr-3 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                        Daftar Sekarang
                    </span>
                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                </a>
                
                <a href="<?= base_url('tentang') ?>" class="btn-ghost btn-magnetic text-white border-white/40 hover:bg-white/10 text-lg px-10 py-5">
                    <i class="fas fa-info-circle mr-3"></i>
                    Pelajari Program
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    /* Tone down the yellowish glow in hero on mobile */
    @media (max-width: 1024px) {
        .hero-pattern {
            background-image: radial-gradient(circle at 20% 80%, rgba(14, 165, 233, 0.08) 0%, transparent 50%), 
                              radial-gradient(circle at 80% 20%, rgba(250, 204, 21, 0.04) 0%, transparent 40%) !important;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Simple scroll animation trigger
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.animate-stagger').forEach((el) => {
            observer.observe(el);
        });
    });
</script>
<?= $this->endSection() ?>
