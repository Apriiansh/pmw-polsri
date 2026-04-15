<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="relative overflow-hidden hero-gradient hero-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-4">Tentang Program</p>
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-(--text-heading)] mb-6">
                Program Mahasiswa <span class="text-gradient">Wirausaha</span>
            </h1>
            <p class="text-lg text-(--text-body)] leading-relaxed">
                Program pembinaan kewirausahaan bagi mahasiswa Politeknik Negeri Sriwijaya untuk mengembangkan usaha berbasis inovasi dan kreativitas.
            </p>
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            
            <!-- Content -->
            <div>
                <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Visi & Misi</p>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading)] mb-6">
                    Mengembangkan <span class="text-gradient">Entrepreneur Muda</span>
                </h2>
                
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center shrink-0">
                            <i class="fas fa-eye text-sky-500 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Visi</h3>
                            <p class="text-(--text-body)] leading-relaxed">
                                Menjadikan Politeknik Negeri Sriwijaya sebagai pusat unggulan pengembangan kewirausahaan yang menghasilkan entrepreneur muda berdaya saing tinggi, inovatif, dan berkontribusi pada pertumbuhan ekonomi lokal maupun nasional.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center shrink-0">
                            <i class="fas fa-bullseye text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Misi</h3>
                            <ul class="space-y-3 text-(--text-body)]">
                                <li class="flex items-start gap-3">
                                    <i class="fas fa-check-circle text-emerald-500 mt-1 shrink-0"></i>
                                    <span>Memfasilitasi mahasiswa dalam mengembangkan ide bisnis menjadi usaha nyata</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fas fa-check-circle text-emerald-500 mt-1 shrink-0"></i>
                                    <span>Memberikan pendanaan dan akses permodalan untuk pengembangan usaha</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fas fa-check-circle text-emerald-500 mt-1 shrink-0"></i>
                                    <span>Menyediakan mentoring dan pendampingan dari praktisi berpengalaman</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fas fa-check-circle text-emerald-500 mt-1 shrink-0"></i>
                                    <span>Membangun ekosistem kewirausahaan yang kolaboratif dan berkelanjutan</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Image -->
            <div class="relative">
                <div class="rounded-2xl overflow-hidden shadow-xl">
                    <img 
                        src="https://images.unsplash.com/photo-1553877522-43269d4ea984?w=800&q=80" 
                        alt="Entrepreneur workspace" 
                        class="w-full h-auto object-cover aspect-4/3"
                    >
                </div>
                
                <!-- Stats Card -->
                <div class="absolute -bottom-6 -left-6 bg-white rounded-xl p-6 shadow-lg border border-sky-100">
                    <div class="text-center">
                        <div class="stat-number mb-1">2019</div>
                        <div class="text-sm text-slate-600">Program Berdiri</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Program Objectives -->
<section class="py-20 lg:py-32 bg-linear-to-b from-white to-sky-50/30">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Tujuan Program</p>
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading)] mb-4">
                Apa yang Kami <span class="text-gradient">Capai</span>
            </h2>
            <p class="text-(--text-muted)]">
                PMW Polsri berkomitmen untuk memberikan dampak nyata bagi mahasiswa dan masyarakat.
            </p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="feature-card text-center">
                <div class="feature-icon sky mx-auto">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Inovasi & Kreativitas</h3>
                <p class="text-sm text-(--text-muted)]">
                    Mendorong mahasiswa mengembangkan produk/jasa inovatif yang berbasis teknologi dan kreativitas.
                </p>
            </div>
            
            <div class="feature-card text-center">
                <div class="feature-icon yellow mx-auto">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Kemandirian Ekonomi</h3>
                <p class="text-sm text-(--text-muted)]">
                    Membantu mahasiswa membangun sumber penghasilan mandiri sejak masa studi.
                </p>
            </div>
            
            <div class="feature-card text-center">
                <div class="feature-icon emerald mx-auto">
                    <i class="fas fa-network-wired"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Networking Bisnis</h3>
                <p class="text-sm text-(--text-muted)]">
                    Membangun jaringan dengan pelaku usaha, investor, dan stakeholder industri.
                </p>
            </div>
            
            <div class="feature-card text-center">
                <div class="feature-icon sky mx-auto">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Skill Development</h3>
                <p class="text-sm text-(--text-muted)]">
                    Pelatihan manajemen bisnis, pemasaran digital, financial literacy, dan leadership.
                </p>
            </div>
            
            <div class="feature-card text-center">
                <div class="feature-icon yellow mx-auto">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Job Creation</h3>
                <p class="text-sm text-(--text-muted)]">
                    Menciptakan lapangan kerja melalui pengembangan usaha yang berkelanjutan.
                </p>
            </div>
            
            <div class="feature-card text-center">
                <div class="feature-icon emerald mx-auto">
                    <i class="fas fa-globe-asia"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Dampak Sosial</h3>
                <p class="text-sm text-(--text-muted)]">
                    Mengembangkan usaha yang berdampak positif bagi masyarakat dan lingkungan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Program Categories -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Kategori</p>
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading)] mb-4">
                Pilih Kategori <span class="text-gradient">Sesuai Usaha</span>
            </h2>
            <p class="text-(--text-muted)]">
                PMW menawarkan dua kategori pendanaan yang disesuaikan dengan tahap pengembangan usaha Anda.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            
            <!-- Usaha Pemula -->
            <div class="bg-linear-to-br from-orange-50 to-amber-50 rounded-2xl p-8 border border-orange-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-200/30 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                
                <div class="relative">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-orange-400 to-amber-500 flex items-center justify-center mb-6">
                        <i class="fas fa-seedling text-white text-2xl"></i>
                    </div>
                    
                    <h3 class="font-display text-2xl font-bold text-(--text-heading)] mb-2">Usaha Pemula</h3>
                    <p class="text-orange-600 font-medium text-sm mb-4">Pendanaan hingga Rp 5.000.000</p>
                    
                    <p class="text-(--text-body)] mb-6 leading-relaxed">
                        Untuk peserta yang baru memiliki ide atau belum memiliki usaha. Fokus pada validasi ide dan pengembangan prototype.
                    </p>
                    
                    <ul class="space-y-3 text-sm text-(--text-body)]">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-orange-500"></i>
                            <span>Ide bisnis yang inovatif</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-orange-500"></i>
                            <span>Belum beroperasi secara komersial</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-orange-500"></i>
                            <span>Tim minimal 2 orang</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Usaha Berkembang -->
            <div class="bg-linear-to-br from-emerald-50 to-teal-50 rounded-2xl p-8 border border-emerald-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-200/30 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                
                <div class="relative">
                    <div class="w-14 h-14 rounded-xl bg-linear-to-br from-emerald-500 to-teal-500 flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    
                    <h3 class="font-display text-2xl font-bold text-(--text-heading)] mb-2">Usaha Berkembang</h3>
                    <p class="text-emerald-600 font-medium text-sm mb-4">Pendanaan hingga Rp 15.000.000</p>
                    
                    <p class="text-(--text-body)] mb-6 leading-relaxed">
                        Untuk peserta yang telah memiliki usaha dan ingin mengembangkan skala. Fokus pada ekspansi dan optimalisasi bisnis.
                    </p>
                    
                    <ul class="space-y-3 text-sm text-(--text-body)]">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-emerald-500"></i>
                            <span>Usaha berjalan minimal 6 bulan</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-emerald-500"></i>
                            <span>Memiliki revenue track record</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check text-emerald-500"></i>
                            <span>Tim terstruktur dengan jelas</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits -->
<section class="py-20 lg:py-32 bg-gradient text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 right-0 w-96 h-96 bg-sky-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-yellow-500 rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="text-sky-400 font-semibold text-sm uppercase tracking-wider mb-3">Benefit Program</p>
            <h2 class="font-display text-sky-200 text-3xl lg:text-4xl font-bold mb-4">
                Apa yang Anda <span class="text-gradient-accent">Dapatkan</span>
            </h2>
            <p class="text-slate-300">
                Bergabung dengan PMW membuka akses ke berbagai fasilitas dan dukungan pengembangan usaha.
            </p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="bg-emerald-400/70 backdrop-blur-sm rounded-xl p-6 border border-white/10 hover:bg-emerald-500/20 transition-all">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/50 flex items-center justify-center mb-4">
                    <i class="fas fa-coins text-emerald-900 text-xl"></i>
                </div>
                <h3 class="font-semibold text-teal-200 text-lg mb-2">Dana Ilham</h3>
                <p class="text-sm text-slate-700">Akses pendanaan tahap 1 dan tahap 2 untuk pengembangan usaha Anda.</p>
            </div>
            
            <div class="bg-lime-400/70 backdrop-blur-sm rounded-xl p-6 border border-white/10 hover:bg-lime-500/20 transition-all">
                <div class="w-12 h-12 rounded-xl bg-lime-500/50 flex items-center justify-center mb-4">
                    <i class="fas fa-user-tie text-lime-900 text-xl"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Mentoring Intensif</h3>
                <p class="text-sm text-slate-700">Dampingan dari mentor bisnis profesional dan dosen berpengalaman.</p>
            </div>
            
            <div class="bg-fuchsia-400/70 backdrop-blur-sm rounded-xl p-6 border border-white/10 hover:bg-fuchsia-500/20 transition-all">
                <div class="w-12 h-12 rounded-xl bg-fuchsia-500/50 flex items-center justify-center mb-4">
                    <i class="fas fa-chalkboard-teacher text-fuchsia-900 text-xl"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Pelatihan Berkelas</h3>
                <p class="text-sm text-slate-700">Workshop kewirausahaan, administrasi, dan keuangan bisnis.</p>
            </div>
            
            <div class="bg-cyan-400/70 backdrop-blur-sm rounded-xl p-6 border border-white/10 hover:bg-cyan-500/20 transition-all">
                <div class="w-12 h-12 rounded-xl bg-cyan-500/50 flex items-center justify-center mb-4">
                    <i class="fas fa-handshake text-cyan-900 text-xl"></i>
                </div>
                <h3 class="font-semibold text-lg mb-2">Networking Luas</h3>
                <p class="text-sm text-slate-700">Koneksi dengan alumni PMW, investor, dan komunitas entrepreneur.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Structure -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Struktur Tim</p>
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading)] mb-4">
                Siapa Saja di <span class="text-gradient">PMW</span>
            </h2>
            <p class="text-(--text-muted)]">
                Program ini melibatkan berbagai pihak yang berkolaborasi untuk kesuksesan peserta.
            </p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="feature-card">
                <div class="feature-icon sky">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Mahasiswa</h3>
                <p class="text-sm text-(--text-muted)] mb-4">
                    Peserta utama program yang mengembangkan ide menjadi usaha nyata.
                </p>
                <ul class="text-xs text-slate-500 space-y-1">
                    <li>• Submit proposal</li>
                    <li>• Implementasi usaha</li>
                    <li>• Laporan progress</li>
                </ul>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon yellow">
                    <i class="fas fa-user-tie"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Dosen</h3>
                <p class="text-sm text-(--text-muted)] mb-4">
                    Dosen pembimbing akademik dari Politeknik Negeri Sriwijaya.
                </p>
                <ul class="text-xs text-slate-500 space-y-1">
                    <li>• Verifikasi bimbingan</li>
                    <li>• Monitoring akademik</li>
                    <li>• Site visit</li>
                </ul>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon emerald">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Mentor</h3>
                <p class="text-sm text-(--text-muted)] mb-4">
                    Praktisi industri eksternal dengan pengalaman bisnis nyata.
                </p>
                <ul class="text-xs text-slate-500 space-y-1">
                    <li>• Sharing praktik terbaik</li>
                    <li>• Koneksi industri</li>
                    <li>• Evaluasi bisnis</li>
                </ul>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon sky">
                    <i class="fas fa-gavel"></i>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2">Reviewer</h3>
                <p class="text-sm text-(--text-muted)] mb-4">
                    Assessor yang menilai kelayakan proposal dan progress usaha.
                </p>
                <ul class="text-xs text-slate-500 space-y-1">
                    <li>• Penilaian proposal</li>
                    <li>• Pitching desk</li>
                    <li>• Monitoring evaluasi</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 lg:py-24 cta-gradient cta-pattern relative overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-white rounded-full blur-3xl"></div>
    </div>
    
    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative z-10">
        <h2 class="font-display text-3xl lg:text-4xl font-bold text-white mb-6">
            Siap Bergabung dengan PMW?
        </h2>
        <p class="text-lg text-black mb-8 max-w-2xl mx-auto">
            Pelajari tahapan program selengkapnya dan persiapkan proposal terbaik Anda.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="<?= base_url('tahapan') ?>" class="btn-accent text-base px-8 py-4">
                <i class="fas fa-route mr-2"></i>
                Lihat Tahapan Program
            </a>
            <a href="<?= base_url('daftar') ?>" class="btn-ghost text-white border-white/30 hover:bg-white/10 text-base px-8 py-4">
                <i class="fas fa-paper-plane mr-2"></i>
                Daftar Sekarang
            </a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
