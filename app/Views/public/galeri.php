<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="relative overflow-hidden hero-gradient hero-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-4">Dokumentasi</p>
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-slate-900 mb-6">
                Galeri <span class="text-gradient">Kegiatan</span>
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Momen-momen berkesan dari Program Mahasiswa Wirausaha Polsri. Lihat aktivitas mentoring, pitching, bazaar, dan awarding.
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
<section class="py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            
            <!-- Featured Large Item -->
            <div class="gallery-item col-span-2 row-span-2 group">
                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80" alt="Business meeting">
                <div class="gallery-overlay">
                    <span class="badge badge-sky mb-2 w-fit">Mentoring 2025</span>
                    <p class="text-white font-semibold text-lg">Sesi Mentoring Intensif</p>
                    <p class="text-white/80 text-sm">Dosen dan mentor berbagi pengalaman dengan tim peserta</p>
                </div>
            </div>
            
            <div class="gallery-item group">
                <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=400&q=80" alt="Team presentation">
                <div class="gallery-overlay">
                    <span class="badge badge-yellow mb-2 w-fit">Pitching</span>
                    <p class="text-white font-semibold text-sm">Pitching Desk 2025</p>
                </div>
            </div>
            
            <div class="gallery-item group">
                <img src="https://images.unsplash.com/photo-1531058020387-3be344556be6?w=400&q=80" alt="Award ceremony">
                <div class="gallery-overlay">
                    <span class="badge badge-emerald mb-2 w-fit">Awarding</span>
                    <p class="text-white font-semibold text-sm">Awarding 2024</p>
                </div>
            </div>
            
            <div class="gallery-item group">
                <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=400&q=80" alt="Startup team">
                <div class="gallery-overlay">
                    <span class="badge badge-sky mb-2 w-fit">Workshop</span>
                    <p class="text-white font-semibold text-sm">Workshop Business Plan</p>
                </div>
            </div>
            
            <div class="gallery-item group">
                <img src="https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=400&q=80" alt="Bazaar event">
                <div class="gallery-overlay">
                    <span class="badge badge-yellow mb-2 w-fit">Bazaar</span>
                    <p class="text-white font-semibold text-sm">Bazaar Monev 2025</p>
                </div>
            </div>
            
            <div class="gallery-item col-span-2 group">
                <img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=800&q=80" alt="Collaboration">
                <div class="gallery-overlay">
                    <span class="badge badge-emerald mb-2 w-fit">Team Building</span>
                    <p class="text-white font-semibold text-lg">Kolaborasi Tim PMW</p>
                    <p class="text-white/80 text-sm">Sesi team building dan networking antar peserta</p>
                </div>
            </div>
            
            <div class="gallery-item group">
                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&q=80" alt="Training session">
                <div class="gallery-overlay">
                    <span class="badge badge-sky mb-2 w-fit">Training</span>
                    <p class="text-white font-semibold text-sm">Pelatihan Keuangan</p>
                </div>
            </div>
            
            <div class="gallery-item group">
                <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?w=400&q=80" alt="Office workspace">
                <div class="gallery-overlay">
                    <span class="badge badge-yellow mb-2 w-fit">Mentoring</span>
                    <p class="text-white font-semibold text-sm">Office Hours</p>
                </div>
            </div>
            
            <div class="gallery-item group">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400&q=80" alt="Conference">
                <div class="gallery-overlay">
                    <span class="badge badge-emerald mb-2 w-fit">Expo</span>
                    <p class="text-white font-semibold text-sm">Expo Kewirausahaan</p>
                </div>
            </div>
            
            <div class="gallery-item group">
                <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=400&q=80" alt="Presentation">
                <div class="gallery-overlay">
                    <span class="badge badge-sky mb-2 w-fit">Pitching</span>
                    <p class="text-white font-semibold text-sm">Final Presentation</p>
                </div>
            </div>
            
            <div class="gallery-item col-span-2 row-span-2 group">
                <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=800&q=80" alt="Celebration">
                <div class="gallery-overlay">
                    <span class="badge badge-yellow mb-2 w-fit">Awarding 2024</span>
                    <p class="text-white font-semibold text-lg">Puncak Awarding Night</p>
                    <p class="text-white/80 text-sm">Malam penganugerahan para pemenang PMW</p>
                </div>
            </div>
            
            <div class="gallery-item group">
                <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=400&q=80" alt="Meeting">
                <div class="gallery-overlay">
                    <span class="badge badge-sky mb-2 w-fit">Site Visit</span>
                    <p class="text-white font-semibold text-sm">Monitoring Lapangan</p>
                </div>
            </div>
            
            <div class="gallery-item group">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&q=80" alt="Students learning">
                <div class="gallery-overlay">
                    <span class="badge badge-emerald mb-2 w-fit">Workshop</span>
                    <p class="text-white font-semibold text-sm">Digital Marketing</p>
                </div>
            </div>
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

<!-- Statistics -->
<section class="py-20 lg:py-24 bg-linear-to-br from-yellow-400 to-amber-500 p-8 rounded-2xl text-center">
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-300 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-amber-300 rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-yellow-100">
                <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-users text-sky-600 text-xl"></i>
                </div>
                <div class="text-4xl lg:text-5xl font-display font-bold text-sky-600 mb-2">500+</div>
                <div class="text-slate-600 font-medium">Peserta Terdaftar</div>
            </div>
            
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-yellow-100">
                <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-store text-yellow-600 text-xl"></i>
                </div>
                <div class="text-4xl lg:text-5xl font-display font-bold text-yellow-600 mb-2">120+</div>
                <div class="text-slate-600 font-medium">Usaha Aktif</div>
            </div>
            
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-yellow-100">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-chalkboard-teacher text-emerald-600 text-xl"></i>
                </div>
                <div class="text-4xl lg:text-5xl font-display font-bold text-emerald-600 mb-2">50+</div>
                <div class="text-slate-600 font-medium">Mentor Berpengalaman</div>
            </div>
            
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-sm border border-yellow-100">
                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-hand-holding-dollar text-amber-600 text-xl"></i>
                </div>
                <div class="text-4xl lg:text-5xl font-display font-bold text-amber-600 mb-2">2.5M</div>
                <div class="text-slate-600 font-medium">Total Dana Terdistribusi</div>
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
