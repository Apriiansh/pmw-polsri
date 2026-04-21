<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="relative overflow-hidden px-6 lg:px-8 pt-24 pb-20 lg:pt-28 relative z-10">
    <!-- Premium Background Elements -->
    <div class="absolute inset-0 -z-10">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-sky-500/10 rounded-full blur-[120px] animate-float"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-[120px] animate-float" style="animation-delay: -3s"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto reveal-blur">
            <p class="text-sky-500 font-bold text-sm uppercase tracking-[0.2em] mb-4">
                <?= cms('tahapan_hero_badge', 'Alur Program') ?>
            </p>
            <h1 class="font-display text-5xl lg:text-7xl font-bold text-(--text-heading) mb-8 leading-tight text-shimmer">
                <?= cms_split('tahapan_hero_title', 2, 'Tahapan Program PMW', 'end') ?>
            </h1>
            <p class="text-xl text-(--text-body) leading-relaxed">
                <?= cms('tahapan_hero_description', 'Program Mahasiswa Wirausaha terdiri dari beberapa tahapan strategis yang dirancang untuk membangun mentalitas bisnis yang tangguh.') ?>
            </p>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section class="py-20 lg:py-32 relative">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">
        
        <!-- Timeline Container -->
        <div class="relative">
            <!-- Vertical Line -->
            <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-linear-to-b from-sky-500/50 via-emerald-500/50 to-transparent -translate-x-1/2 hidden md:block"></div>
            
            <?php if (empty($schedules)): ?>
                <div class="text-center py-20 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200 reveal-on-scroll">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                        <i class="fas fa-calendar-times text-4xl text-slate-300"></i>
                    </div>
                    <p class="text-slate-500 font-display text-xl font-bold">Jadwal tahapan belum tersedia</p>
                    <p class="text-slate-400 mt-2">Nantikan informasi terbaru untuk periode mendatang.</p>
                </div>
            <?php else: ?>
                <div class="space-y-12 lg:space-y-24">
                <?php foreach ($schedules as $index => $schedule): 
                    $isEven = ($index % 2 === 0);
                    $badgeClass = 'bg-sky-100 text-sky-600';
                    if (str_contains(strtolower($schedule['phase_name']), 'pengumuman')) $badgeClass = 'bg-amber-100 text-amber-600';
                    if (str_contains(strtolower($schedule['phase_name']), 'evaluasi') || str_contains(strtolower($schedule['phase_name']), 'awarding')) $badgeClass = 'bg-emerald-100 text-emerald-600';
                    
                    $isActive = $schedule['is_active'];
                ?>
                <div class="relative flex flex-col md:flex-row items-center <?= $isEven ? 'md:flex-row-reverse' : '' ?> reveal-on-scroll">
                    
                    <!-- Timeline Dot -->
                    <div class="absolute left-4 md:left-1/2 top-0 md:top-12 w-8 h-8 rounded-full border-4 border-white shadow-lg z-20 -translate-x-1/2 flex items-center justify-center transition-liquid <?= $isActive ? 'bg-sky-500 scale-125' : 'bg-slate-200' ?>">
                        <?php if ($isActive): ?>
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                        <?php endif; ?>
                    </div>

                    <!-- Card Content -->
                    <div class="w-full md:w-[45%] pl-12 md:pl-0">
                        <div class="group bg-white p-8 lg:p-10 rounded-[2.5rem] border border-slate-100 hover:border-sky-300/50 hover:shadow-2xl hover:shadow-sky-500/5 transition-liquid relative overflow-hidden">
                            <?php if ($isActive): ?>
                                <div class="absolute top-0 right-0 px-6 py-2 bg-sky-500 text-white text-[10px] font-bold uppercase tracking-widest rounded-bl-2xl">
                                    Tahapan Aktif
                                </div>
                            <?php endif; ?>

                            <div class="flex items-center gap-3 mb-6">
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider <?= $badgeClass ?>">
                                    Tahap <?= $schedule['phase_number'] ?>
                                </span>
                                <span class="text-xs font-bold text-slate-400">
                                    <i class="far fa-calendar-alt mr-1.5"></i>
                                    <?php 
                                        $start = date('d M', strtotime($schedule['start_date']));
                                        $end = date('d M Y', strtotime($schedule['end_date']));
                                        echo "$start — $end";
                                    ?>
                                </span>
                            </div>

                            <h3 class="font-display text-2xl lg:text-3xl font-bold text-(--text-heading) mb-4 group-hover:text-sky-600 transition-colors">
                                <?= esc($schedule['phase_name']) ?>
                            </h3>
                            <p class="text-(--text-body) leading-relaxed">
                                <?= esc($schedule['description']) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Spacer for Desktop -->
                    <div class="hidden md:block w-[10%]"></div>
                </div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
</section>

<!-- Registration Flow -->
<section class="py-20 lg:py-32 bg-linear-to-b from-white to-sky-50/50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-20 reveal-on-scroll">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">
                <?= cms('tahapan_flow_badge', 'Alur Pendaftaran') ?>
            </p>
            <h2 class="font-display text-3xl lg:text-5xl font-bold text-(--text-heading) mb-6">
                <?= cms_split('tahapan_flow_title', 1, 'Bagaimana Cara Mendaftar') ?>
            </h2>
            <p class="text-(--text-muted)">
                <?= cms('tahapan_flow_description', 'Ikuti langkah-langkah strategis berikut untuk menjadi bagian dari ekosistem wirausaha Polsri.') ?>
            </p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
            $steps = cms('tahapan_flow_steps', []);
            foreach ($steps as $index => $step): 
                $isHighlight = ($index == count($steps) - 1);
            ?>
            <div class="relative group <?= $isHighlight ? 'bg-linear-to-br from-emerald-50 to-sky-50 border-emerald-200' : 'bg-white border-slate-100' ?> rounded-[2.5rem] p-10 shadow-sm border reveal-zoom stagger-<?= ($index % 3) + 1 ?> hover:shadow-xl transition-liquid">
                <div class="absolute -top-5 -left-2 w-12 h-12 rounded-2xl <?= $isHighlight ? 'bg-emerald-500' : 'bg-sky-500' ?> text-white flex items-center justify-center font-bold text-xl shadow-lg group-hover:rotate-6 transition-transform">
                    <?= $step['num'] ?? ($index + 1) ?>
                </div>
                <h3 class="font-display text-2xl font-bold text-(--text-heading) mb-4 mt-2 group-hover:text-sky-600 transition-colors">
                    <?= esc($step['title'] ?? 'Langkah ' . ($index + 1)) ?>
                </h3>
                <p class="text-(--text-body) leading-relaxed">
                    <?= esc($step['desc'] ?? '') ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Important Dates -->
<section class="py-20 lg:py-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            
            <div class="reveal-left">
                <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Timeline Penting</p>
                <h2 class="font-display text-3xl lg:text-5xl font-bold text-(--text-heading) mb-8 leading-tight">
                    Jadwal Program <span class="text-gradient"><?= $activePeriod['year'] ?? date('Y') ?></span>
                </h2>
                <p class="text-(--text-body) mb-10 leading-relaxed text-lg">
                    Pastikan Anda mencatat tanggal-tanggal penting dalam program PMW <?= $activePeriod['year'] ?? date('Y') ?> agar tidak melewatkan kesempatan emas ini.
                </p>
                
                <div class="space-y-4">
                    <?php 
                    $keyDates = array_slice($schedules, 0, 4);
                    $colors = [
                        ['bg' => 'bg-rose-50', 'border' => 'border-rose-100', 'icon_bg' => 'bg-rose-100', 'text' => 'text-rose-600'],
                        ['bg' => 'bg-amber-50', 'border' => 'border-amber-100', 'icon_bg' => 'bg-amber-100', 'text' => 'text-amber-600'],
                        ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-100', 'icon_bg' => 'bg-emerald-100', 'text' => 'text-emerald-600'],
                        ['bg' => 'bg-sky-50', 'border' => 'border-sky-100', 'icon_bg' => 'bg-sky-100', 'text' => 'text-sky-600'],
                    ];

                    foreach ($keyDates as $index => $date): 
                        $c = $colors[$index % count($colors)];
                    ?>
                    <div class="flex items-center gap-5 p-5 bg-white rounded-2xl border border-slate-100 hover:border-sky-200 hover:shadow-lg transition-liquid group reveal-on-scroll stagger-<?= $index + 1 ?>">
                        <div class="w-16 h-16 rounded-2xl <?= $c['bg'] ?> flex flex-col items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <span class="<?= $c['text'] ?> font-bold text-[10px] uppercase"><?= date('M', strtotime($date['start_date'])) ?></span>
                            <span class="<?= $c['text'] ?> font-bold text-2xl leading-none"><?= date('d', strtotime($date['start_date'])) ?></span>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 text-lg"><?= esc($date['phase_name']) ?></p>
                            <p class="text-sm text-slate-500 font-medium">Berakhir: <?= date('d M Y', strtotime($date['end_date'])) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="relative reveal-right">
                <div class="absolute -inset-4 bg-sky-500/5 rounded-[3rem] blur-2xl"></div>
                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-700 group">
                    <img 
                        src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&q=80" 
                        alt="Calendar planning" 
                        class="w-full h-auto object-cover aspect-4/3 group-hover:scale-110 transition-transform duration-1000"
                    >
                    <div class="absolute inset-0 bg-linear-to-t from-slate-900/40 to-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section id="section-tahapan-cta" class="py-20 lg:py-32 relative overflow-hidden">
    <div class="absolute inset-0 cta-gradient opacity-95"></div>
    <div class="absolute inset-0 cta-pattern opacity-30"></div>
    
    <div class="max-w-5xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="reveal-zoom glass-premium p-10 lg:p-20 rounded-[40px] border-white/20 shadow-2xl text-center backdrop-blur-2xl">
            <h2 class="font-display text-4xl lg:text-6xl font-bold text-white mb-8 leading-tight">
                <?= cms('tahapan_cta_title', 'Siap Mengikuti Tahapan PMW?') ?>
            </h2>
            <p class="text-xl text-white/80 mb-12 max-w-2xl mx-auto leading-relaxed">
                <?= cms('tahapan_cta_description', 'Jangan lewatkan setiap tahapan penting ini. Daftarkan tim terbaik Anda sekarang juga.') ?>
            </p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="<?= base_url('register') ?>" class="btn-accent btn-magnetic group px-10 py-5 text-lg shadow-xl shadow-amber-500/30">
                    <i class="fas fa-paper-plane mr-3 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                    Daftar Sekarang
                </a>
                <a href="<?= base_url('pedoman') ?>" class="btn-ghost btn-magnetic border-white/40 text-white hover:bg-white/10 px-10 py-5 text-lg">
                    <i class="fas fa-book mr-3"></i>
                    Unduh Pedoman
                </a>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
