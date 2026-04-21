<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section id="section-tentang-hero" class="relative overflow-hidden hero-gradient hero-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-24 pb-20 lg:pt-28 relative z-10">
        <div class="text-center max-w-3xl mx-auto reveal-zoom">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-4 stagger-1"><?= cms('tentang_hero_badge', 'Tentang Program') ?></p>
            <h1 class="font-display text-4xl sm:text-6xl font-bold text-(--text-heading) mb-6 stagger-2 text-shimmer">
                <?= cms('tentang_hero_title', 'Program Mahasiswa Wirausaha') ?>
            </h1>
            <p class="text-lg text-(--text-body) leading-relaxed stagger-3">
                <?= cms('tentang_hero_description', 'Program pembinaan kewirausahaan bagi mahasiswa Politeknik Negeri Sriwijaya untuk mengembangkan usaha berbasis inovasi dan kreativitas.') ?>
            </p>
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section id="section-tentang-vision" class="py-20 lg:py-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-24 items-center">
            
            <!-- Content -->
            <div class="reveal-left">
                <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Filosofi & Tujuan</p>
                <h2 class="font-display text-3xl lg:text-5xl font-bold text-(--text-heading) mb-8">
                    <?= cms('tentang_vision_title', 'Mencetak <span class="text-gradient">Wirausaha Muda</span>') ?>
                </h2>
                
                <div class="space-y-8">
                    <div class="flex gap-6 group">
                        <div class="w-14 h-14 rounded-2xl bg-sky-100 flex items-center justify-center shrink-0 group-hover:scale-110 transition-liquid">
                            <i class="fas fa-eye text-sky-500 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-2xl font-bold text-(--text-heading) mb-2">Visi</h3>
                            <p class="text-(--text-body) leading-relaxed">
                                <?= cms('tentang_vision_content', 'Menjadikan Politeknik Negeri Sriwijaya sebagai pusat unggulan pengembangan kewirausahaan yang menghasilkan entrepreneur muda berdaya saing tinggi, inovatif, dan berkontribusi pada pertumbuhan ekonomi lokal maupun nasional.') ?>
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex gap-6 group">
                        <div class="w-14 h-14 rounded-2xl bg-amber-100 flex items-center justify-center shrink-0 group-hover:scale-110 transition-liquid">
                            <i class="fas fa-bullseye text-amber-600 text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-2xl font-bold text-(--text-heading) mb-2">Misi</h3>
                            <ul class="space-y-4">
                                <?php 
                                $missions = cms('tentang_mission_list', []);
                                if (empty($missions)) {
                                    $missions = [
                                        'Memfasilitasi mahasiswa dalam mengembangkan ide bisnis menjadi usaha nyata',
                                        'Memberikan pendanaan dan akses permodalan untuk pengembangan usaha',
                                        'Menyediakan mentoring dan pendampingan dari praktisi berpengalaman',
                                        'Membangun ekosistem kewirausahaan yang kolaboratif dan berkelanjutan'
                                    ];
                                }
                                foreach ($missions as $idx => $mission): ?>
                                    <li class="flex items-start gap-3 reveal-on-scroll stagger-<?= ($idx % 5) + 1 ?>">
                                        <div class="mt-1 w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                                            <i class="fas fa-check text-emerald-500 text-[10px]"></i>
                                        </div>
                                        <span class="text-(--text-body)"><?= is_array($mission) ? ($mission['misi'] ?? ($mission['text'] ?? '')) : $mission ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Image -->
            <div class="relative reveal-right">
                <div class="rounded-[2.5rem] overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-liquid group">
                    <img 
                        src="<?= cms_img(cms('tentang_vision_image', 'https://images.unsplash.com/photo-1553877522-43269d4ea984?w=800&q=80')) ?>" 
                        alt="Entrepreneur workspace" 
                        class="w-full h-auto object-cover aspect-4/3 group-hover:scale-105 transition-liquid duration-1000"
                    >
                </div>
                
                <!-- Floating Stats Card -->
                <div class="absolute -bottom-10 -left-10 glass-premium rounded-3xl p-8 shadow-2xl border-white/40 reveal-zoom stagger-4">
                    <div class="text-center">
                        <div class="text-4xl font-black text-sky-600 mb-1">2019</div>
                        <div class="text-xs font-bold text-slate-500 uppercase tracking-widest">Program Berdiri</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Program Objectives -->
<section id="section-tentang-objectives" class="py-20 lg:py-32 bg-linear-to-b from-white to-sky-50/50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-20 reveal-on-scroll">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Target & Capaian</p>
            <h2 class="font-display text-3xl lg:text-5xl font-bold text-(--text-heading) mb-6">
                <?= cms('tentang_objectives_title', 'Apa yang Kami Kejar') ?>
            </h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
            $objectives = cms('tentang_objectives_list', []);
            if (empty($objectives)) {
                $objectives = [
                    ['icon' => 'fa-lightbulb', 'color' => 'sky', 'title' => 'Inovasi & Kreativitas', 'desc' => 'Mendorong mahasiswa mengembangkan produk/jasa inovatif.'],
                    ['icon' => 'fa-hand-holding-usd', 'color' => 'yellow', 'title' => 'Kemandirian Ekonomi', 'desc' => 'Membantu mahasiswa membangun sumber penghasilan mandiri.'],
                    ['icon' => 'fa-network-wired', 'color' => 'emerald', 'title' => 'Networking Bisnis', 'desc' => 'Membangun jaringan dengan pelaku usaha dan investor.'],
                    ['icon' => 'fa-graduation-cap', 'color' => 'sky', 'title' => 'Skill Development', 'desc' => 'Pelatihan manajemen bisnis dan financial literacy.'],
                    ['icon' => 'fa-users', 'color' => 'yellow', 'title' => 'Job Creation', 'desc' => 'Menciptakan lapangan kerja melalui usaha berkelanjutan.'],
                    ['icon' => 'fa-globe-asia', 'color' => 'emerald', 'title' => 'Dampak Sosial', 'desc' => 'Mengembangkan usaha yang berdampak positif bagi masyarakat.'],
                ];
            }
            foreach ($objectives as $idx => $obj): 
                $bgColor = $obj['color'] === 'sky' ? 'bg-sky-50' : ($obj['color'] === 'yellow' ? 'bg-amber-50' : 'bg-emerald-50');
                $iconColor = $obj['color'] === 'sky' ? 'text-sky-500' : ($obj['color'] === 'yellow' ? 'text-amber-600' : 'text-emerald-500');
            ?>
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 reveal-zoom card-magnetic stagger-<?= ($idx % 3) + 1 ?> group hover:border-sky-300/50 transition-liquid">
                    <div class="w-16 h-16 rounded-2xl <?= $bgColor ?> flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-6 transition-liquid">
                        <i class="fas <?= $obj['icon'] ?> <?= $iconColor ?> text-3xl"></i>
                    </div>
                    <h3 class="font-display text-2xl font-bold text-(--text-heading) mb-4 group-hover:text-sky-600 transition-colors"><?= $obj['title'] ?></h3>
                    <p class="text-(--text-body) leading-relaxed">
                        <?= $obj['desc'] ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Program Categories -->
<section class="py-20 lg:py-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-20 reveal-on-scroll">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Kategori</p>
            <h2 class="font-display text-3xl lg:text-5xl font-bold text-(--text-heading) mb-6">
                Pilih Jalur <span class="text-gradient">Usaha Anda</span>
            </h2>
            <p class="text-(--text-muted)">
                PMW menawarkan dua kategori pendanaan yang disesuaikan dengan tahap pengembangan usaha Anda saat ini.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-10 max-w-5xl mx-auto">
            
            <!-- Usaha Pemula -->
            <div class="bg-linear-to-br from-orange-50 to-amber-50 rounded-[3rem] p-10 lg:p-12 border border-orange-100 relative overflow-hidden reveal-left group hover:shadow-2xl hover:shadow-orange-200/50 transition-liquid">
                <div class="absolute top-0 right-0 w-48 h-48 bg-orange-200/30 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl group-hover:scale-125 transition-transform duration-1000"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-linear-to-br from-orange-400 to-amber-500 flex items-center justify-center mb-8 shadow-lg shadow-orange-200">
                        <i class="fas fa-seedling text-white text-3xl animate-float"></i>
                    </div>
                    
                    <h3 class="font-display text-3xl font-bold text-(--text-heading) mb-2">Usaha Pemula</h3>
                    <p class="text-orange-600 font-bold text-lg mb-6">Pendanaan hingga Rp 5.000.000</p>
                    
                    <p class="text-(--text-body) mb-8 leading-relaxed text-lg">
                        Untuk peserta yang baru memiliki ide atau belum memiliki usaha. Fokus pada validasi ide dan pengembangan prototype.
                    </p>
                    
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-check text-orange-600 text-[10px]"></i>
                            </div>
                            <span class="font-medium text-slate-700">Ide bisnis yang inovatif</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-check text-orange-600 text-[10px]"></i>
                            </div>
                            <span class="font-medium text-slate-700">Belum beroperasi secara komersial</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-orange-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-check text-orange-600 text-[10px]"></i>
                            </div>
                            <span class="font-medium text-slate-700">Tim minimal 2-3 orang</span>
                        </li>
                    </ul>
                    
                    <a href="<?= base_url('register') ?>" class="btn-primary bg-orange-500 hover:bg-orange-600 border-none shadow-orange-200">Daftar Jalur Pemula</a>
                </div>
            </div>
            
            <!-- Usaha Berkembang -->
            <div class="bg-linear-to-br from-emerald-50 to-teal-50 rounded-[3rem] p-10 lg:p-12 border border-emerald-100 relative overflow-hidden reveal-right group hover:shadow-2xl hover:shadow-emerald-200/50 transition-liquid">
                <div class="absolute top-0 right-0 w-48 h-48 bg-emerald-200/30 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl group-hover:scale-125 transition-transform duration-1000"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 rounded-2xl bg-linear-to-br from-emerald-500 to-teal-500 flex items-center justify-center mb-8 shadow-lg shadow-emerald-200">
                        <i class="fas fa-chart-line text-white text-3xl animate-float" style="animation-delay: -2s"></i>
                    </div>
                    
                    <h3 class="font-display text-3xl font-bold text-(--text-heading) mb-2">Usaha Berkembang</h3>
                    <p class="text-emerald-600 font-bold text-lg mb-6">Pendanaan hingga Rp 15.000.000</p>
                    
                    <p class="text-(--text-body) mb-8 leading-relaxed text-lg">
                        Untuk peserta yang telah memiliki usaha dan ingin mengembangkan skala. Fokus pada ekspansi dan optimalisasi bisnis.
                    </p>
                    
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-check text-emerald-600 text-[10px]"></i>
                            </div>
                            <span class="font-medium text-slate-700">Usaha berjalan minimal 6 bulan</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-check text-emerald-600 text-[10px]"></i>
                            </div>
                            <span class="font-medium text-slate-700">Memiliki revenue track record</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 flex items-center justify-center shrink-0">
                                <i class="fas fa-check text-emerald-600 text-[10px]"></i>
                            </div>
                            <span class="font-medium text-slate-700">Tim terstruktur dengan jelas</span>
                        </li>
                    </ul>
                    
                    <a href="<?= base_url('register') ?>" class="btn-primary bg-emerald-600 hover:bg-emerald-700 border-none shadow-emerald-200">Daftar Jalur Berkembang</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits -->
<section class="py-20 lg:py-32 bg-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-sky-500/20 rounded-full blur-[120px] animate-float"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[120px] animate-float" style="animation-delay: -3s"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-2xl mx-auto mb-20 reveal-on-scroll">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Keunggulan</p>
            <h2 class="font-display text-4xl lg:text-5xl font-bold text-(--text-heading) mb-6">
                Apa yang Anda <span class="text-gradient">Dapatkan</span>
            </h2>
            <p class="text-(--text-body) text-lg">
                Bergabung dengan PMW membuka akses ke berbagai fasilitas dan ekosistem pengembangan usaha yang matang.
            </p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php 
            $benefits = [
                ['icon' => 'fa-coins', 'color' => 'emerald', 'title' => 'Dana Hibah', 'desc' => 'Akses pendanaan modal usaha tanpa bunga untuk pengembangan prototype.'],
                ['icon' => 'fa-user-tie', 'color' => 'amber', 'title' => 'Mentoring', 'desc' => 'Dampingan langsung dari mentor bisnis profesional dan praktisi industri.'],
                ['icon' => 'fa-chalkboard-teacher', 'color' => 'fuchsia', 'title' => 'Bootcamp', 'desc' => 'Pelatihan intensif manajemen bisnis, marketing, dan keuangan.'],
                ['icon' => 'fa-handshake', 'color' => 'sky', 'title' => 'Networking', 'desc' => 'Koneksi dengan alumni sukses, investor, dan mitra bisnis potensial.'],
            ];
            foreach ($benefits as $idx => $ben): 
                $iconColor = match($ben['color']) {
                    'emerald' => 'text-emerald-500',
                    'amber' => 'text-amber-500',
                    'fuchsia' => 'text-fuchsia-500',
                    default => 'text-sky-500',
                };
                $bgColor = match($ben['color']) {
                    'emerald' => 'bg-emerald-50',
                    'amber' => 'bg-amber-50',
                    'fuchsia' => 'bg-fuchsia-50',
                    default => 'bg-sky-50',
                };
            ?>
            <div class="bg-slate-50 p-8 rounded-[2rem] border border-slate-100 hover:bg-white hover:border-sky-300/50 hover:shadow-2xl hover:shadow-sky-500/5 transition-liquid reveal-zoom stagger-<?= $idx + 1 ?> group">
                <div class="w-14 h-14 rounded-2xl <?= $bgColor ?> flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-liquid">
                    <i class="fas <?= $ben['icon'] ?> <?= $iconColor ?> text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl mb-3 text-(--text-heading)"><?= $ben['title'] ?></h3>
                <p class="text-sm text-(--text-body) leading-relaxed"><?= $ben['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Team Structure -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-20 reveal-on-scroll">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Ekosistem</p>
            <h2 class="font-display text-3xl lg:text-5xl font-bold text-(--text-heading) mb-6">
                Siapa Saja di <span class="text-gradient">PMW</span>
            </h2>
            <p class="text-(--text-muted)">
                Program ini melibatkan berbagai pihak yang berkolaborasi secara aktif untuk kesuksesan setiap peserta.
            </p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php 
            $teams = [
                ['icon' => 'fa-user-graduate', 'color' => 'sky', 'title' => 'Mahasiswa', 'desc' => 'Peserta utama program yang mengembangkan ide menjadi usaha nyata.', 'tasks' => ['Submit proposal', 'Implementasi usaha', 'Laporan progress']],
                ['icon' => 'fa-user-tie', 'color' => 'amber', 'title' => 'Dosen', 'desc' => 'Pembimbing akademik dari internal Politeknik Negeri Sriwijaya.', 'tasks' => ['Verifikasi bimbingan', 'Monitoring akademik', 'Site visit']],
                ['icon' => 'fa-briefcase', 'color' => 'emerald', 'title' => 'Mentor', 'desc' => 'Praktisi industri eksternal dengan pengalaman bisnis nyata.', 'tasks' => ['Sharing best practices', 'Koneksi industri', 'Evaluasi bisnis']],
                ['icon' => 'fa-gavel', 'color' => 'sky', 'title' => 'Reviewer', 'desc' => 'Assessor yang menilai kelayakan proposal dan progress usaha.', 'tasks' => ['Penilaian proposal', 'Pitching desk', 'Monev berkala']],
            ];
            foreach ($teams as $idx => $t): ?>
            <div class="bg-white group p-8 rounded-[2.5rem] border border-slate-100 hover:border-sky-300/50 hover:shadow-2xl hover:shadow-sky-500/10 transition-liquid reveal-on-scroll stagger-<?= $idx + 1 ?>">
                <div class="w-16 h-16 rounded-2xl bg-<?= $t['color'] ?>-50 flex items-center justify-center mb-6 group-hover:scale-110 transition-liquid">
                    <i class="fas <?= $t['icon'] ?> text-<?= $t['color'] ?>-500 text-2xl"></i>
                </div>
                <h3 class="font-display text-xl font-bold text-(--text-heading) mb-3"><?= $t['title'] ?></h3>
                <p class="text-sm text-(--text-muted) mb-6 leading-relaxed">
                    <?= $t['desc'] ?>
                </p>
                <div class="space-y-2">
                    <?php foreach ($t['tasks'] as $task): ?>
                    <div class="flex items-center gap-2 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <div class="w-1 h-1 rounded-full bg-<?= $t['color'] ?>-400"></div>
                        <span><?= $task ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section id="section-tentang-cta" class="py-20 lg:py-32 relative overflow-hidden">
    <div class="absolute inset-0 cta-gradient opacity-95"></div>
    <div class="absolute inset-0 cta-pattern opacity-30"></div>
    
    <div class="max-w-5xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="reveal-zoom glass-premium p-10 lg:p-20 rounded-[40px] border-white/20 shadow-2xl text-center backdrop-blur-2xl">
            <h2 class="font-display text-4xl lg:text-6xl font-bold text-white mb-8 leading-tight">
                <?= cms('tentang_cta_title', 'Mulai Perjalanan Wirausaha Anda Hari Ini') ?>
            </h2>
            <p class="text-xl text-white/80 mb-12 max-w-2xl mx-auto leading-relaxed">
                <?= cms('tentang_cta_description', 'Jangan biarkan ide cemerlang Anda menguap begitu saja. Bergabunglah dengan ribuan mahasiswa lainnya di PMW Polsri.') ?>
            </p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="<?= base_url('register') ?>" class="btn-accent btn-magnetic group px-10 py-5 text-lg shadow-xl shadow-amber-500/30">
                    <i class="fas fa-paper-plane mr-3 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                    Daftar Sekarang
                </a>
                <a href="<?= base_url('tahapan') ?>" class="btn-ghost btn-magnetic border-white/40 text-white hover:bg-white/10 px-10 py-5 text-lg">
                    <i class="fas fa-route mr-3"></i>
                    Lihat Tahapan
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
