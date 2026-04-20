<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="relative overflow-hidden hero-gradient hero-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-4">
                <?= cms('tahapan_hero_badge', 'Alur Program') ?>
            </p>
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-(--text-heading) mb-6">
                <?= cms('tahapan_hero_title_1', 'Tahapan') ?> <span class="text-gradient"><?= cms('tahapan_hero_title_2', 'Program PMW') ?></span>
            </h1>
            <p class="text-lg text-(--text-body) leading-relaxed">
                <?= cms('tahapan_hero_description', 'Program Mahasiswa Wirausaha terdiri dari beberapa tahapan yang harus dilalui peserta.') ?>
            </p>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section class="py-20 lg:py-32">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        
        <!-- Timeline -->
        <div class="relative">
            
            <?php if (empty($schedules)): ?>
                <div class="text-center py-12 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                    <i class="fas fa-calendar-times text-4xl text-slate-300 mb-4"></i>
                    <p class="text-slate-500 font-medium">Jadwal tahapan belum tersedia untuk periode ini.</p>
                </div>
            <?php else: ?>
                <?php foreach ($schedules as $index => $schedule): 
                    // Logic for badge color based on phase number or content
                    $badgeClass = 'badge-sky';
                    if (str_contains(strtolower($schedule['phase_name']), 'pengumuman')) $badgeClass = 'badge-yellow';
                    if (str_contains(strtolower($schedule['phase_name']), 'evaluasi') || str_contains(strtolower($schedule['phase_name']), 'awarding')) $badgeClass = 'badge-emerald';
                    
                    $isLast = ($index === count($schedules) - 1);
                    $isActive = $schedule['is_active'];
                ?>
                <div class="timeline-item">
                    <div class="timeline-dot <?= $isActive ? 'active' : '' ?> <?= $isLast ? 'completed' : '' ?>"></div>
                    <div class="<?= $isLast ? 'bg-linear-to-br from-sky-50 to-emerald-50 border-sky-200' : 'bg-white border-sky-100' ?> rounded-2xl p-6 shadow-sm border">
                        <div class="flex flex-wrap items-center gap-2 mb-3">
                            <span class="badge <?= $badgeClass ?>">Tahap <?= $schedule['phase_number'] ?></span>
                            <span class="text-xs text-slate-400">
                                <i class="far fa-calendar mr-1"></i>
                                <?php 
                                    $start = date('M', strtotime($schedule['start_date']));
                                    $end = date('M', strtotime($schedule['end_date']));
                                    echo ($start == $end) ? $start : "$start - $end";
                                ?>
                            </span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-(--text-heading) mb-2">
                            <?= esc($schedule['phase_name']) ?>
                        </h3>
                        <p class="text-(--text-body) mb-4">
                            <?= esc($schedule['description']) ?>
                        </p>
                        
                        <?php if ($isActive): ?>
                            <div class="flex items-center gap-2 text-xs font-bold text-sky-600">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-sky-500"></span>
                                </span>
                                Tahapan Berjalan
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
            
        </div>
    </div>
</section>

<!-- Registration Flow -->
<section class="py-20 lg:py-32 bg-linear-to-b from-white to-sky-50/30">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">
                <?= cms('tahapan_flow_badge', 'Alur Pendaftaran') ?>
            </p>
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading) mb-4">
                <?= cms('tahapan_flow_title_1', 'Bagaimana Cara') ?> <span class="text-gradient"><?= cms('tahapan_flow_title_2', 'Mendaftar') ?></span>
            </h2>
            <p class="text-(--text-muted)">
                <?= cms('tahapan_flow_description', 'Ikuti langkah-langkah berikut untuk mendaftar Program Mahasiswa Wirausaha Polsri.') ?>
            </p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php 
            $steps = cms('tahapan_flow_steps', []);
            foreach ($steps as $index => $step): 
                $isHighlight = ($index == count($steps) - 1);
            ?>
            <div class="relative <?= $isHighlight ? 'bg-linear-to-br from-emerald-50 to-sky-50 border-emerald-200' : 'bg-white border-sky-100' ?> rounded-xl p-6 shadow-sm border">
                <div class="absolute -top-4 -left-2 w-10 h-10 rounded-full <?= $isHighlight ? 'bg-emerald-500' : 'bg-sky-500' ?> text-white flex items-center justify-center font-bold text-lg shadow-lg">
                    <?= $step['num'] ?? ($index + 1) ?>
                </div>
                <h3 class="font-display text-lg font-bold text-(--text-heading) mb-2 mt-2">
                    <?= esc($step['title'] ?? 'Langkah ' . ($index + 1)) ?>
                </h3>
                <p class="text-sm text-(--text-muted)">
                    <?= esc($step['desc'] ?? '') ?>
                </p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Important Dates -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            <div>
                <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Timeline Penting</p>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading) mb-6">
                    Jadwal Program <span class="text-gradient"><?= $activePeriod['year'] ?? date('Y') ?></span>
                </h2>
                <p class="text-(--text-body) mb-8 leading-relaxed">
                    Pastikan Anda mencatat tanggal-tanggal penting dalam program PMW <?= $activePeriod['year'] ?? date('Y') ?>. Setiap tahapan memiliki deadline yang harus dipatuhi.
                </p>
                
                <div class="space-y-4">
                    <?php 
                    // Show top 4 active schedules as key dates
                    $keyDates = array_slice(array_filter($schedules, function($s) { return $s['is_active']; }), 0, 4);
                    if (empty($keyDates)) $keyDates = array_slice($schedules, 0, 4);

                    $colors = [
                        ['bg' => 'bg-rose-50', 'border' => 'border-rose-100', 'icon_bg' => 'bg-rose-100', 'text' => 'text-rose-600'],
                        ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-100', 'icon_bg' => 'bg-yellow-100', 'text' => 'text-yellow-700'],
                        ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-100', 'icon_bg' => 'bg-emerald-100', 'text' => 'text-emerald-600'],
                        ['bg' => 'bg-amber-50', 'border' => 'border-amber-100', 'icon_bg' => 'bg-amber-100', 'text' => 'text-amber-600'],
                    ];

                    foreach ($keyDates as $index => $date): 
                        $c = $colors[$index % count($colors)];
                    ?>
                    <div class="flex items-center gap-4 p-4 <?= $c['bg'] ?> rounded-xl border <?= $c['border'] ?>">
                        <div class="w-14 h-14 rounded-xl <?= $c['icon_bg'] ?> flex items-center justify-center shrink-0">
                            <span class="<?= $c['text'] ?> font-bold text-sm text-center uppercase">
                                <?= date('M', strtotime($date['start_date'])) ?><br>
                                <?= date('d', strtotime($date['start_date'])) ?>
                            </span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800"><?= esc($date['phase_name']) ?></p>
                            <p class="text-sm text-slate-500">Berakhir pada <?= date('d M Y', strtotime($date['end_date'])) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="relative">
                <div class="rounded-2xl overflow-hidden shadow-xl">
                    <img 
                        src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&q=80" 
                        alt="Calendar planning" 
                        class="w-full h-auto object-cover aspect-4/3"
                    >
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 lg:py-24 cta-gradient cta-pattern relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative z-10">
        <h2 class="font-display text-3xl lg:text-5xl font-bold text-accent mb-6">
            <?= cms('tahapan_cta_title', 'Siap Mengikuti Tahapan PMW?') ?>
        </h2>
        <p class="text-lg text-slate-900 mb-10 max-w-2xl mx-auto">
            <?= cms('tahapan_cta_description', 'Daftarkan tim Anda sekarang dan mulai perjalanan kewirausahaan.') ?>
        </p>
        <a href="<?= base_url('register') ?>" class="btn-accent text-base px-8 py-4">
            <i class="fas fa-paper-plane mr-2"></i>
            Daftar Sekarang
        </a>
    </div>
</section>

<?= $this->endSection() ?>
