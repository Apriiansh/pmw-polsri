<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'PMW Polsri') ?> — Program Mahasiswa Wirausaha Politeknik Negeri Sriwijaya</title>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="<?= esc($meta_description ?? 'Program Mahasiswa Wirausaha Politeknik Negeri Sriwijaya - Mengembangkan jiwa kewirausahaan mahasiswa melalui pendanaan, mentoring, dan pelatihan.') ?>">
    <meta name="keywords"
        content="<?= esc($meta_keywords ?? 'PMW Polsri, Wirausaha Mahasiswa, Polsri, Kewirausahaan, Palembang') ?>">
    <meta name="author" content="PMW Politeknik Negeri Sriwijaya">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= current_url() ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:title" content="<?= esc($title ?? 'PMW Polsri') ?> — Program Mahasiswa Wirausaha">
    <meta property="og:description"
        content="<?= esc($meta_description ?? 'Program Mahasiswa Wirausaha Politeknik Negeri Sriwijaya - Mengembangkan jiwa kewirausahaan mahasiswa.') ?>">
    <meta property="og:image" content="<?= base_url('assets/img/og-image.jpg') ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= current_url() ?>">
    <meta property="twitter:title" content="<?= esc($title ?? 'PMW Polsri') ?> — Program Mahasiswa Wirausaha">
    <meta property="twitter:description"
        content="<?= esc($meta_description ?? 'Program Mahasiswa Wirausaha Politeknik Negeri Sriwijaya - Mengembangkan jiwa kewirausahaan mahasiswa.') ?>">
    <meta property="twitter:image" content="<?= base_url('assets/img/og-image.jpg') ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Vite Assets (Alpine.js + Tailwind) -->
    <?php if (ENVIRONMENT === 'development'): ?>
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/app/Views/js/app.js"></script>
        <link rel="stylesheet" href="http://localhost:5173/app/Views/css/input-v2.css">
    <?php else: ?>
        <script type="module" src="<?= base_url('build/app.js?v=' . filemtime(FCPATH . 'build/app.js')) ?>"></script>
        <link rel="stylesheet" href="<?= base_url('build/app.css?v=' . filemtime(FCPATH . 'build/app.css')) ?>">
        <link rel="stylesheet" href="<?= base_url('build/style_v2.css?v=' . filemtime(FCPATH . 'build/style_v2.css')) ?>">
    <?php endif; ?>

    <!-- Global Premium Interaction Engine -->
    <script>
        // Add js-ready class immediately to enable animations only when JS is active
        document.documentElement.classList.add('js-ready');

        document.addEventListener('DOMContentLoaded', () => {
            // 1. Scroll Reveal Logic
            const observerOptions = {
                threshold: 0.05, // Lower threshold for better reliability
                rootMargin: '0px 0px -50px 0px' // Trigger slightly before it enters the viewport
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        // Once animated, we can stop observing
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const revealElements = document.querySelectorAll('.reveal-on-scroll, .reveal-left, .reveal-right, .reveal-zoom, .reveal-blur, .reveal-mask');
            revealElements.forEach(el => observer.observe(el));

            // Fallback: If after 3 seconds some elements are still not active, force them (safety first)
            setTimeout(() => {
                revealElements.forEach(el => {
                    if (!el.classList.contains('active')) {
                        el.classList.add('active');
                    }
                });
            }, 3000);

            // 2. Magnetic Mouse Effect
            document.querySelectorAll('.card-magnetic').forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = (y - centerY) / 15;
                    const rotateY = (centerX - x) / 15;
                    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = `perspective(1000px) rotateX(0) rotateY(0) translateY(0)`;
                });
            });
        });
    </script>

    <style>
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
            position: relative;
        }
    </style>

    <!-- Page-specific styles -->
    <?= $this->renderSection('styles') ?>
</head>
<?php
// Check if current page is auth page (hide navbar/footer)
$currentUri = uri_string();
$isAuthPage = in_array($currentUri, ['login', 'register']);
?>

<body class="bg-(--surface-page) text-(--text-body) antialiased">

    <?php if (!$isAuthPage): ?>
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 glass-premium transition-all duration-300"
            x-data="{ mobileOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex items-center justify-between h-20">

                    <!-- Logo -->
                    <a href="<?= base_url() ?>" class="flex items-center gap-3 group">
                        <div
                            class="w-10 h-10 rounded-xl flex items-center justify-center shadow-md shadow-sky-200 group-hover:shadow-lg group-hover:shadow-sky-300 transition-all">
                            <img src="<?= base_url('favicon.png') ?>" alt="PMW Polsri" class="w-9 h-9 object-contain">
                        </div>
                        <div class="hidden sm:block">
                            <h1 class="font-display text-xl font-bold text-(--text-heading) leading-tight">
                                PMW <span class="text-sky-500">Polsri</span>
                            </h1>
                            <p class="text-[10px] text-(--text-muted) uppercase tracking-widest font-semibold">
                                Program Mahasiswa Wirausaha
                            </p>
                        </div>
                    </a>

                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex items-center gap-1">
                        <?php $currentUri = uri_string(); ?>

                        <a href="<?= base_url() ?>" class="nav-link <?= $currentUri === '' ? 'active' : '' ?>">
                            <i class="fas fa-home text-sm"></i>
                            <span>Beranda</span>
                        </a>
                        <a href="<?= base_url('tentang') ?>"
                            class="nav-link <?= $currentUri === 'tentang' ? 'active' : '' ?>">
                            <span>Tentang PMW</span>
                        </a>
                        <a href="<?= base_url('tahapan') ?>"
                            class="nav-link <?= $currentUri === 'tahapan' ? 'active' : '' ?>">
                            <span>Tahapan</span>
                        </a>
                        <a href="<?= base_url('galeri') ?>"
                            class="nav-link <?= $currentUri === 'galeri' ? 'active' : '' ?>">
                            <span>Galeri</span>
                        </a>
                        <a href="<?= base_url('pengumuman') ?>"
                            class="nav-link <?= $currentUri === 'pengumuman' ? 'active' : '' ?>">
                            <span>Pengumuman</span>
                        </a>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="hidden lg:flex items-center gap-3">
                        <a href="<?= base_url('login') ?>" class="btn-ghost text-sm">
                            Masuk
                        </a>
                        <a href="<?= base_url('register') ?>" class="btn-primary text-sm">
                            <i class="fas fa-rocket mr-2"></i>
                            Daftar PMW
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileOpen = !mobileOpen"
                        class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl text-slate-500 hover:bg-sky-50 hover:text-sky-500 transition-colors">
                        <i class="fas fa-bars text-lg" x-show="!mobileOpen"></i>
                        <i class="fas fa-times text-lg" x-show="mobileOpen"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileOpen" x-cloak @click.away="mobileOpen = false"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4"
                class="lg:hidden border-t border-sky-100 bg-white/95 backdrop-blur-xl max-h-[calc(100vh-5rem)] overflow-y-auto">
                <div class="px-6 py-4 space-y-2">
                    <a href="<?= base_url() ?>" class="mobile-nav-link">
                        <i class="fas fa-home w-6"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="<?= base_url('tentang') ?>" class="mobile-nav-link">
                        <i class="fas fa-info-circle w-6"></i>
                        <span>Tentang PMW</span>
                    </a>
                    <a href="<?= base_url('tahapan') ?>" class="mobile-nav-link">
                        <i class="fas fa-route w-6"></i>
                        <span>Tahapan</span>
                    </a>
                    <a href="<?= base_url('galeri') ?>" class="mobile-nav-link">
                        <i class="fas fa-images w-6"></i>
                        <span>Galeri</span>
                    </a>
                    <a href="<?= base_url('pengumuman') ?>" class="mobile-nav-link">
                        <i class="fas fa-bullhorn w-6"></i>
                        <span>Pengumuman</span>
                    </a>

                    <div class="pt-4 border-t border-sky-100 space-y-2">
                        <a href="<?= base_url('login') ?>" class="mobile-nav-link text-slate-600">
                            <i class="fas fa-sign-in-alt w-6"></i>
                            <span>Masuk</span>
                        </a>
                        <a href="<?= base_url('register') ?>" class="btn-primary w-full justify-center text-center">
                            <i class="fas fa-rocket mr-2"></i>
                            Daftar PMW
                        </a>
                    </div>
                </div>
            </div>
        </nav>

    <?php endif; ?>

    <!-- Main Content -->
    <main class="<?= $isAuthPage ? '' : '' ?>">
        <?= $this->renderSection('content') ?>
    </main>

    <?php if (!$isAuthPage): ?>
        <!-- Footer -->
        <footer class="bg-white border-t border-sky-100">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

                    <!-- Brand -->
                    <div class="lg:col-span-1">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-12 h-12 rounded-xl bg-linear-to-br from-sky-500 to-sky-400 flex items-center justify-center">
                                <i class="fas fa-graduation-cap text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-display text-xl font-bold text-slate-800">PMW Polsri</h3>
                                <p class="text-xs text-slate-500">Politeknik Negeri Sriwijaya</p>
                            </div>
                        </div>
                        <p class="text-sm text-slate-500 leading-relaxed mb-6">
                            Program pembinaan kewirausahaan bagi mahasiswa untuk mengembangkan usaha berbasis inovasi dan
                            kreativitas.
                        </p>
                        <div class="flex items-center gap-3">
                            <a href="https://www.instagram.com/entrepreneurpolsri/" class="social-link"
                                aria-label="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link" aria-label="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="polsri.ac.id" class="social-link" aria-label="Website Polsri">
                                <i class="fas fa-globe"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-slate-800 font-semibold mb-4">Tautan Cepat</h4>
                        <ul class="space-y-3">
                            <li><a href="<?= base_url() ?>" class="footer-link">Beranda</a></li>
                            <li><a href="<?= base_url('tentang') ?>" class="footer-link">Tentang PMW</a></li>
                            <li><a href="<?= base_url('tahapan') ?>" class="footer-link">Tahapan Program</a></li>
                            <li><a href="<?= base_url('galeri') ?>" class="footer-link">Galeri Kegiatan</a></li>
                            <li><a href="<?= base_url('pengumuman') ?>" class="footer-link">Pengumuman</a></li>
                        </ul>
                    </div>

                    <!-- Resources -->
                    <div>
                        <h4 class="text-slate-800 font-semibold mb-4">Dokumen & Bantuan</h4>
                        <ul class="space-y-3">
                            <li><a href="<?= base_url('buku_panduan_pmw.pdf') ?>" class="footer-link" download><i
                                        class="fas fa-file-pdf mr-2 text-sky-500"></i>Panduan PMW</a></li>
                            <!-- <li><a href="#" class="footer-link"><i class="fas fa-file-pdf mr-2 text-sky-500"></i>Template Proposal</a></li>
                            <li><a href="#" class="footer-link"><i class="fas fa-file-pdf mr-2 text-sky-500"></i>Peraturan PMW</a></li> -->
                            <li><a href="#" class="footer-link"><i
                                        class="fas fa-question-circle mr-2 text-sky-500"></i>FAQ</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h4 class="text-slate-800 font-semibold mb-4">Kontak Kami</h4>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-map-marker-alt text-sky-500 mt-1"></i>
                                <span class="text-sm text-slate-600">Jl. Srijaya Negara, Bukit Besar, Palembang, Sumatera
                                    Selatan</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-phone text-sky-500"></i>
                                <span class="text-sm text-slate-600">(0711) 353414</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-envelope text-sky-500"></i>
                                <span class="text-sm text-slate-600">uptpkk_kewirausahaan@polsri.ac.id</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bottom -->
                <div
                    class="border-t border-sky-100 mt-12 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-slate-500">
                        <?= date('Y') ?> Politeknik Negeri Sriwijaya. Hak Cipta Dilindungi.
                    </p>
                    <p class="text-sm text-slate-500">
                        Dikembangkan dengan <i class="fas fa-heart text-rose-500 mx-1"></i> oleh Tim PMW Polsri
                    </p>
                </div>
            </div>
        </footer>
    <?php endif; ?>

    <!-- Toast Notifications -->
    <div x-data="{ 
            notifications: [],
            add(msg, type = 'info') {
                const id = Date.now();
                this.notifications.push({ id, msg, type });
                setTimeout(() => {
                    this.notifications = this.notifications.filter(n => n.id !== id);
                }, 5000);
            }
        }" x-init="
            <?php if (session('message')): ?>
                add('<?= addslashes(session('message')) ?>', 'success');
            <?php endif; ?>
            <?php if (session('error')): ?>
                add('<?= addslashes(session('error')) ?>', 'error');
            <?php endif; ?>
            <?php if (session('errors')): ?>
                <?php foreach (session('errors') as $error): ?>
                    add('<?= addslashes($error) ?>', 'error');
                <?php endforeach; ?>
            <?php endif; ?>
        "
        class="fixed top-24 z-9999 flex flex-col gap-3 w-full max-w-sm pointer-events-none <?= $isAuthPage ? 'left-1/2 -translate-x-1/2 px-4' : 'right-6' ?>">
        <template x-for="n in notifications" :key="n.id">
            <div x-show="true" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-12 scale-95"
                x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-x-0 scale-100"
                x-transition:leave-end="opacity-0 translate-x-12 scale-95" :class="{
                    'bg-white border-emerald-100 text-emerald-800 shadow-emerald-100/50': n.type === 'success',
                    'bg-white border-rose-100 text-rose-800 shadow-rose-100/50': n.type === 'error',
                    'bg-white border-sky-100 text-sky-800 shadow-sky-100/50': n.type === 'info'
                }"
                class="pointer-events-auto flex items-start gap-3 p-4 rounded-2xl border shadow-xl backdrop-blur-xl bg-white/90">
                <!-- Icon -->
                <div :class="{
                        'bg-emerald-500 text-white': n.type === 'success',
                        'bg-rose-500 text-white': n.type === 'error',
                        'bg-sky-500 text-white': n.type === 'info'
                    }" class="shrink-0 w-8 h-8 rounded-lg flex items-center justify-center">
                    <i class="fas" :class="{
                        'fa-check text-sm': n.type === 'success',
                        'fa-exclamation text-sm': n.type === 'error',
                        'fa-info text-sm': n.type === 'info'
                    }"></i>
                </div>

                <!-- Content -->
                <div class="flex-1 pt-0.5">
                    <p class="text-sm font-semibold leading-tight mb-0.5"
                        x-text="n.type === 'success' ? 'Berhasil' : (n.type === 'error' ? 'Terjadi Kesalahan' : 'Informasi')">
                    </p>
                    <p class="text-xs text-slate-500 font-medium leading-relaxed" x-text="n.msg"></p>
                </div>

                <!-- Close -->
                <button @click="notifications = notifications.filter(notif => notif.id !== n.id)"
                    class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>
        </template>
    </div>

    <!-- Alpine.js initialized via Vite -->

    <!-- Page-specific scripts -->
    <?= $this->renderSection('scripts') ?>
</body>

</html>