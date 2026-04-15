<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="relative overflow-hidden hero-gradient hero-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-32">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            
            <!-- Content -->
            <div class="animate-stagger">
                <div class="badge badge-sky mb-4">
                    <i class="fas fa-rocket text-xs"></i>
                    <span>Program Tahun 2026</span>
                </div>
                
                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold text-(--text-heading) leading-tight mb-6">
                    Program Mahasiswa <br>
                    <span class="text-gradient">Wirausaha</span>
                </h1>
                
                <p class="text-lg text-(--text-body) leading-relaxed mb-8 max-w-xl">
                    Politeknik Negeri Sriwijaya memfasilitasi mahasiswa untuk mengembangkan ide bisnis menjadi usaha nyata melalui program pembinaan kewirausahaan.
                </p>
                
                <div class="flex flex-wrap gap-4">
                    <a href="<?= base_url('daftar') ?>" class="btn-accent text-base px-8 py-4">
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
                    <div>
                        <div class="stat-number">7+</div>
                        <div class="stat-label">Tahun Berdiri</div>
                    </div>
                    <div>
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Tim Terbina</div>
                    </div>
                    <div>
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Usaha Aktif</div>
                    </div>
                </div>
            </div>
            
            <!-- Hero Image -->
            <div class="relative lg:pl-8 animate-stagger delay-200">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-sky-200/50">
                    <img 
                        src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80" 
                        alt="Mahasiswa berkolaborasi" 
                        class="w-full h-auto object-cover aspect-4/3"
                    >
                    <div class="absolute inset-0 bg-linear-to-tr from-sky-500/20 to-transparent rounded-2xl"></div>
                </div>
                
                <!-- Floating Cards -->
                <div class="absolute -bottom-6 -left-6 bg-white rounded-xl p-4 shadow-lg border border-sky-100 animate-stagger delay-300">
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
                
                <div class="absolute -top-4 -right-4 bg-white rounded-xl p-3 shadow-lg border border-sky-100 animate-stagger delay-400">
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
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Mengapa PMW?</p>
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading)] mb-4">
                Program Pembinaan <span class="text-gradient">Komprehensif</span>
            </h2>
            <p class="text-(--text-muted)]">
                Program Mahasiswa Wirausaha dirancang untuk memberikan dukungan holistik dari ide hingga usaha yang berkelanjutan.
            </p>
        </div>
        
        <!-- Features Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="feature-card animate-stagger">
                <div class="feature-icon sky">
                    <i class="fas fa-route"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Proses Jelas</h3>
                <p class="text-sm text-(--text-muted)] leading-relaxed">
                    Tahapan program yang terstruktur dari pendaftaran hingga awarding dengan milestone yang jelas.
                </p>
            </div>
            
            <div class="feature-card animate-stagger delay-100">
                <div class="feature-icon yellow">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Tim Pendamping</h3>
                <p class="text-sm text-(--text-muted)] leading-relaxed">
                    Didampingi oleh dosen dan mentor industri berpengalaman dalam setiap tahap pengembangan.
                </p>
            </div>
            
            <div class="feature-card animate-stagger delay-200">
                <div class="feature-icon sky">
                    <i class="fas fa-coins"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Dana Ilham</h3>
                <p class="text-sm text-(--text-muted)] leading-relaxed">
                    Akses pendanaan tahap 1 dan tahap 2 untuk mengakselerasi pertumbuhan usaha Anda.
                </p>
            </div>
            
            <div class="feature-card animate-stagger delay-300">
                <div class="feature-icon emerald">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Pengembangan Skill</h3>
                <p class="text-sm text-(--text-muted)] leading-relaxed">
                    Pelatihan kewirausahaan, manajemen bisnis, dan pengembangan produk berkualitas.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Workflow Preview Section -->
<section class="py-20 lg:py-32 bg-linear-to-b from-white to-sky-50/30">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            
            <!-- Image -->
            <div class="relative order-2 lg:order-1">
                <div class="relative rounded-2xl overflow-hidden shadow-xl">
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
            <div class="order-1 lg:order-2">
                <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Alur Program</p>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading)] mb-6">
                    11 Tahapan Menuju <span class="text-gradient">Wirausaha Mandiri</span>
                </h2>
                
                <p class="text-(--text-body)] leading-relaxed mb-8">
                    Program ini dirancang dengan pendekatan berbasis proses yang sistematis. Setiap tahap memiliki kriteria evaluasi yang jelas dan dukungan yang sesuai.
                </p>
                
                <!-- Timeline Preview -->
                <div class="space-y-4 mb-8">
                    <div class="flex items-center gap-4 p-3 rounded-xl bg-white border border-sky-100 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 font-bold text-sm">1</div>
                        <div>
                            <p class="font-semibold text-slate-800">Pendaftaran & Proposal</p>
                            <p class="text-xs text-slate-500">Submit ide bisnis Anda</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-3 rounded-xl bg-white border border-sky-100 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 font-bold text-sm">2</div>
                        <div>
                            <p class="font-semibold text-slate-800">Seleksi & Pitching</p>
                            <p class="text-xs text-slate-500">Presentasi di depan reviewer</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-3 rounded-xl bg-white border border-sky-100 shadow-sm">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 font-bold text-sm">3</div>
                        <div>
                            <p class="font-semibold text-slate-800">Implementasi & Mentoring</p>
                            <p class="text-xs text-slate-500">Bimbingan intensif 4 bulan</p>
                        </div>
                    </div>
                </div>
                
                <a href="<?= base_url('tahapan') ?>" class="btn-outline">
                    <span>Lihat Seluruh Tahapan</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Preview Section -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Dokumentasi</p>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading)]">
                    Galeri <span class="text-gradient">Kegiatan</span>
                </h2>
            </div>
            <a href="<?= base_url('galeri') ?>" class="btn-ghost text-sm">
                <span>Lihat Semua</span>
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="gallery-item col-span-2 row-span-2">
                <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?w=800&q=80" alt="Mentoring session">
                <div class="gallery-overlay">
                    <p class="text-white font-semibold">Sesi Mentoring 2025</p>
                    <p class="text-white/80 text-sm">Dosen dan mentor berbagi pengalaman</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=400&q=80" alt="Team collaboration">
                <div class="gallery-overlay">
                    <p class="text-white font-semibold text-sm">Team Work</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=400&q=80" alt="Pitching event">
                <div class="gallery-overlay">
                    <p class="text-white font-semibold text-sm">Pitching Day</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=400&q=80" alt="Award ceremony">
                <div class="gallery-overlay">
                    <p class="text-white font-semibold text-sm">Awarding</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=400&q=80" alt="Bazaar">
                <div class="gallery-overlay">
                    <p class="text-white font-semibold text-sm">Bazaar Monev</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Announcements Section -->
<section class="py-20 lg:py-32 bg-linear-to-b from-sky-50/30 to-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid lg:grid-cols-3 gap-12">
            
            <!-- Section Header -->
            <div class="lg:col-span-1">
                <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Informasi Terkini</p>
                <h2 class="font-display text-3xl font-bold text-(--text-heading) mb-4">
                    Pengumuman <span class="text-gradient">Terbaru</span>
                </h2>
                <p class="text-(--text-muted) mb-6">
                    Pantau terus informasi penting seputar Program Mahasiswa Wirausaha.
                </p>
                <a href="<?= base_url('pengumuman') ?>" class="btn-primary">
                    <span>Semua Pengumuman</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            
            <!-- Announcements List -->
            <div class="lg:col-span-2 space-y-4">
                
                <div class="announcement-card urgent">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-rose-100 flex items-center justify-center shrink-0">
                            <i class="fas fa-exclamation text-rose-500"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="badge bg-rose-100 text-rose-700">Penting</span>
                                <span class="text-xs text-slate-400">14 April 2026</span>
                            </div>
                            <h3 class="font-semibold text-slate-800 mb-1">Pendaftaran PMW 2026 Dibuka</h3>
                            <p class="text-sm text-slate-600">Pendaftaran Program Mahasiswa Wirausaha tahun 2026 resmi dibuka. Deadline pengumpulan proposal hingga 30 Mei 2026.</p>
                        </div>
                    </div>
                </div>
                
                <div class="announcement-card">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center shrink-0">
                            <i class="fas fa-info text-sky-500"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="badge badge-sky">Info</span>
                                <span class="text-xs text-slate-400">10 April 2026</span>
                            </div>
                            <h3 class="font-semibold text-slate-800 mb-1">Workshop Penulisan Proposal Bisnis</h3>
                            <p class="text-sm text-slate-600">Workshop gratis untuk mahasiswa yang ingin mempelajari cara menulis proposal bisnis yang efektif.</p>
                        </div>
                    </div>
                </div>
                
                <div class="announcement-card success">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                            <i class="fas fa-trophy text-emerald-500"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="badge badge-emerald">Prestasi</span>
                                <span class="text-xs text-slate-400">5 April 2026</span>
                            </div>
                            <h3 class="font-semibold text-slate-800 mb-1">Tim PMW Raih Juara di Kompetisi Startup Nasional</h3>
                            <p class="text-sm text-slate-600">Selamat kepada tim EcoPrint yang meraih Juara 2 dalam Kompetisi Startup Lingkungan tingkat Nasional.</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 lg:py-24 cta-gradient cta-pattern relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative z-10">
        <div class="badge badge-yellow mb-6 mx-auto">
            <i class="fas fa-rocket text-xs"></i>
            <span>Siap Memulai?</span>
        </div>
        
        <h2 class="font-display text-3xl lg:text-5xl font-bold text-white mb-6">
            Bersiaplah untuk PMW Berikutnya
        </h2>
        
        <p class="text-lg text-black-100 mb-10 max-w-2xl mx-auto">
            Pelajari tahapan program dan persiapkan diri Anda untuk pendaftaran periode berikutnya. Tim kami siap membimbing Anda.
        </p>
        
        <div class="flex flex-wrap justify-center gap-4">
            <a href="<?= base_url('daftar') ?>" class="btn-accent text-base px-8 py-4">
                <i class="fas fa-paper-plane mr-2"></i>
                Daftar Sekarang
            </a>
            <a href="<?= base_url('tentang') ?>" class="btn-ghost text-white border-white/30 hover:bg-white/10 text-base px-8 py-4">
                <i class="fas fa-info-circle mr-2"></i>
                Pelajari Program
            </a>
        </div>
    </div>
</section>

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
