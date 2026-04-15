<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'PMW Polsri') ?> — Sistem Informasi PMW</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Compiled Tailwind + Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">

    <!-- Page-specific styles -->
    <?= $this->renderSection('styles') ?>
</head>

<!--
    Alpine.js x-data on body:
    - isSidebarOpen : controls sidebar width
    - isMobileMenuOpen : overlay sidebar on mobile
-->

<body
    class="bg-(--surface-page) text-(--text-body)"
    x-data="{
        isSidebarOpen: localStorage.getItem('sidebarOpen') !== 'false',
        isMobileMenuOpen: false,
        toggleSidebar() {
            this.isSidebarOpen = !this.isSidebarOpen;
            localStorage.setItem('sidebarOpen', this.isSidebarOpen);
        }
    }">

    <div class="flex h-screen overflow-hidden bg-(--surface-page)">

        <!-- ================================================================
         SIDEBAR
    ================================================================= -->
        <aside
            class="bg-white border-r border-sky-100 flex flex-col z-30 shrink-0 transition-all duration-300 ease-smooth"
            :class="isSidebarOpen ? 'w-72' : 'w-[72px]'">

            <!-- Logo -->
            <div class="h-20 flex items-center px-4 border-b border-sky-50 shrink-0 overflow-hidden" :class="isSidebarOpen ? 'justify-between' : 'justify-center'">

                <!-- Logo icon + Text -->
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-xl bg-linear-to-br from-sky-500 to-sky-400 flex items-center justify-center shadow-md shadow-sky-200 shrink-0">
                        <i class="fas fa-graduation-cap text-white text-base"></i>
                    </div>
                    <!-- Logo text (hidden when collapsed) -->
                    <div
                        class="overflow-hidden transition-all duration-300 ease-smooth"
                        x-show="isSidebarOpen"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        <h1 class="font-display text-sm font-bold text-(--text-heading) mb-0.5 tracking-tight">
                            Polsri <span class="text-sky-500">PMW</span>
                        </h1>
                        <p class="text-[9px] font-bold text-(--text-muted) uppercase tracking-widest whitespace-nowrap">
                            Business & Startup
                        </p>
                    </div>
                </div>

                <!-- Toggle button (only shows on desktop) -->
                <button
                    x-show="isSidebarOpen"
                    @click="toggleSidebar()"
                    class="hidden md:flex w-8 h-8 items-center justify-center rounded-lg text-slate-400 hover:bg-sky-50 hover:text-sky-500 transition-all duration-200 shrink-0">
                    <i class="fas fa-chevron-left text-xs"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto overflow-x-hidden">

                <?php
                $user = auth()->user();
                $profile = null;
                if ($user) {
                    $db = \Config\Database::connect();
                    $profile = $db->table('pmw_profiles')->where('user_id', $user->id)->get()->getRow();
                }

                $displayName = $profile->nama ?? ($user->username ?? 'User');
                $displayRole = $user ? ($user->getGroups()[0] ?? 'User') : 'Visitor';

                // Calculate initials
                $initials = '??';
                if ($user) {
                    $nameParts = explode(' ', $displayName);
                    if (count($nameParts) > 1) {
                        $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
                    } else {
                        $initials = strtoupper(substr($displayName, 0, 2));
                    }
                }

                $groups = $user ? $user->getGroups() : [];
                $mainRole = $groups[0] ?? 'visitor';

                // Default Phase
                $phase = 'Pendaftaran';

                // If Mahasiswa, try to get their team's phase
                if ($mainRole === 'mahasiswa') {
                    $team = $db->table('pmw_teams')
                        ->select('phase')
                        ->where('lead_id', $user->id)
                        ->orWhere("id IN (SELECT team_id FROM pmw_team_members WHERE user_id = {$user->id})")
                        ->get()
                        ->getRow();
                    if ($team) {
                        $phase = $team->phase;
                    }
                }

                // Define nav items based on role & phase
                $navItems = [
                    ['route' => 'dashboard', 'icon' => 'fa-chart-line', 'label' => 'Dashboard', 'match' => 'dashboard'],
                ];

                if ($mainRole === 'admin') {
                    $navItems[] = ['route' => 'admin/pmw-system', 'icon' => 'fa-calendar-days',  'label' => 'PMW System',       'match' => 'admin/pmw-system'];
                    $navItems[] = ['route' => 'admin/users',    'icon' => 'fa-users-gear',      'label' => 'Manajemen User',   'match' => 'admin/users'];
                    $navItems[] = ['route' => 'admin/cms',      'icon' => 'fa-clapperboard',   'label' => 'Manajemen Konten', 'match' => 'admin/cms'];
                    $navItems[] = ['route' => 'admin/laporan',  'icon' => 'fa-file-contract',   'label' => 'Laporan',          'match' => 'admin/laporan'];
                }

                if ($mainRole === 'mahasiswa') {
                    // Proposal - Tahap 1-5 (Pendaftaran - Pitching)
                    $navItems[] = ['route' => 'mahasiswa/proposal', 'icon' => 'fa-file-invoice', 'label' => 'Proposal Kami', 'match' => 'mahasiswa/proposal'];

                    // Mentoring - Tahap 6 (Implementasi, Bimbingan & Mentoring)
                    $navItems[] = ['route' => 'mahasiswa/mentoring', 'icon' => 'fa-handshake-angle', 'label' => 'Mentoring', 'match' => 'mahasiswa/mentoring'];

                    // Bimbingan - Tahap 6 (Implementasi, Bimbingan & Mentoring)
                    $navItems[] = ['route' => 'mahasiswa/bimbingan', 'icon' => 'fa-chalkboard-user', 'label' => 'Bimbingan', 'match' => 'mahasiswa/bimbingan'];

                    // Laporan Kemajuan - Tahap 7-8 (Monev 1 & 2)
                    $navItems[] = ['route' => 'mahasiswa/laporan-kemajuan', 'icon' => 'fa-chart-pie', 'label' => 'Laporan Kemajuan', 'match' => 'mahasiswa/laporan-kemajuan'];

                    // Laporan Akhir - Tahap 10-11 (Laporan Akhir & Awarding)
                    $navItems[] = ['route' => 'mahasiswa/laporan-akhir', 'icon' => 'fa-box-archive', 'label' => 'Laporan Akhir', 'match' => 'mahasiswa/laporan-akhir'];
                }

                if ($mainRole === 'reviewer') {
                    // Penilaian Proposal - Tahap 2-3 (Seleksi Administrasi & Pitching Desk)
                    $navItems[] = ['route' => 'reviewer/penilaian-proposal', 'icon' => 'fa-clipboard-check', 'label' => 'Penilaian Proposal', 'match' => 'reviewer/penilaian-proposal'];
                    // Penilaian Laporan - Tahap 7-8 (Monev 1 & 2)
                    $navItems[] = ['route' => 'reviewer/penilaian-laporan', 'icon' => 'fa-file-circle-check', 'label' => 'Penilaian Laporan', 'match' => 'reviewer/penilaian-laporan'];
                }

                if ($mainRole === 'dosen') {
                    // Monitoring Tim - Tahap 6-8 (Implementasi & Monev)
                    $navItems[] = ['route' => 'dosen/monitoring', 'icon' => 'fa-users-viewfinder', 'label' => 'Monitoring Tim', 'match' => 'dosen/monitoring'];
                    // Validasi Logbook - Tahap 6 (Bimbingan)
                    $navItems[] = ['route' => 'dosen/validasi', 'icon' => 'fa-signature', 'label' => 'Validasi Logbook', 'match' => 'dosen/validasi'];
                }

                if ($mainRole === 'mentor') {
                    // Monitoring Tim - Tahap 6-8 (Implementasi & Monev)
                    $navItems[] = ['route' => 'mentor/monitoring', 'icon' => 'fa-briefcase', 'label' => 'Monitoring Tim', 'match' => 'mentor/monitoring'];
                    // Validasi Logbook - Tahap 6 (Mentoring)
                    $navItems[] = ['route' => 'mentor/validasi', 'icon' => 'fa-check-double', 'label' => 'Validasi Logbook', 'match' => 'mentor/validasi'];
                }

                $currentUrl = current_url();

                foreach ($navItems as $item):
                    $isActive = strpos($currentUrl, base_url($item['match'])) !== false;
                    $activeClass = $isActive ? 'sidebar-item active' : 'sidebar-item';
                ?>
                    <a
                        href="<?= base_url($item['route']) ?>"
                        class="<?= $activeClass ?> group/item"
                        :class="isSidebarOpen ? 'px-3 justify-start' : 'px-0 justify-center'"
                        title="<?= $item['label'] ?>">
                        <!-- Icon -->
                        <span class="sidebar-item-icon transition-transform duration-300 group-hover/item:scale-110">
                            <i class="fas <?= $item['icon'] ?>"></i>
                        </span>

                        <!-- Label (hidden when collapsed) -->
                        <span
                            class="text-sm font-medium whitespace-nowrap transition-all duration-300 ease-smooth"
                            :class="isSidebarOpen ? 'opacity-100 max-w-[200px] translate-x-0 ml-3' : 'opacity-0 max-w-0 -translate-x-4 ml-0 overflow-hidden'">
                            <?= $item['label'] ?>
                        </span>

                        <!-- Tooltip for collapsed state -->
                        <template x-if="!isSidebarOpen">
                            <div class="absolute left-16 bg-slate-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover/item:opacity-100 translate-x-2 group-hover/item:translate-x-0 transition-all pointer-events-none z-50 whitespace-nowrap font-bold uppercase tracking-widest">
                                <?= $item['label'] ?>
                            </div>
                        </template>
                    </a>
                <?php endforeach; ?>

                <!-- Divider -->
                <div class="pt-2 pb-1">
                    <div
                        class="transition-all duration-300 ease-smooth overflow-hidden"
                        :class="isSidebarOpen ? 'opacity-100 max-h-8' : 'opacity-0 max-h-0'">
                        <p class="px-3 text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] select-none">
                            Lainnya
                        </p>
                    </div>
                </div>

                <!-- Bottom Items -->
                <?php
                $bottomItems = [
                    ['route' => 'bantuan', 'icon' => 'fa-circle-question', 'label' => 'Bantuan', 'match' => 'bantuan'],
                ];

                foreach ($bottomItems as $item):
                    $isActive = strpos($currentUrl, base_url($item['match'])) !== false;
                    $activeClass = $isActive ? 'sidebar-item active' : 'sidebar-item';
                ?>
                    <a
                        href="<?= base_url($item['route']) ?>"
                        class="<?= $activeClass ?>"
                        :class="isSidebarOpen ? 'justify-start' : 'justify-center'"
                        title="<?= $item['label'] ?>">
                        <span class="sidebar-item-icon">
                            <i class="fas <?= $item['icon'] ?>"></i>
                        </span>
                        <span
                            class="text-sm whitespace-nowrap transition-all duration-300 ease-smooth"
                            :class="isSidebarOpen ? 'opacity-100 max-w-[200px] translate-x-0 ml-3' : 'opacity-0 max-w-0 -translate-x-2 ml-0 overflow-hidden'">
                            <?= $item['label'] ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            </nav>

            <!-- Bottom: User Profile -->
            <div class="p-3 border-t border-sky-50 shrink-0">
                <div
                    class="flex items-center gap-3 p-3 rounded-xl bg-sky-50/50 cursor-pointer group hover:bg-sky-100/80 transition-all duration-300 overflow-hidden relative"
                    :class="isSidebarOpen ? 'justify-start' : 'justify-center'"
                    @click="!isSidebarOpen && toggleSidebar()">
                    <!-- Avatar -->
                    <div class="w-9 h-9 rounded-xl bg-linear-to-tr from-sky-500 to-sky-400 flex items-center justify-center text-white font-display font-bold text-xs shadow-sm shadow-sky-200 shrink-0 group-hover:scale-105 transition-transform">
                        <?= esc($initials) ?>
                    </div>

                    <!-- User info (hidden when collapsed) -->
                    <div
                        class="flex-1 min-w-0 transition-all duration-300 ease-smooth overflow-hidden flex items-center justify-between"
                        :class="isSidebarOpen ? 'opacity-100 max-w-[170px] ml-1' : 'opacity-0 max-w-0 ml-0'">
                        <div class="min-w-0">
                            <p class="text-[11px] font-bold text-(--text-heading) truncate group-hover:text-sky-600 transition-colors">
                                <?= esc($displayName) ?>
                            </p>
                            <p class="text-[9px] text-(--text-muted) uppercase font-black tracking-widest truncate">
                                <?= esc($displayRole) ?>
                            </p>
                        </div>

                        <!-- Logout form (POST for Shield CSRF) -->
                        <form action="<?= base_url('logout') ?>" method="post" class="shrink-0 ml-2">
                            <?= csrf_field() ?>
                            <button type="submit" class="text-slate-300 hover:text-rose-500 transition-colors p-1" title="Logout">
                                <i class="fas fa-right-from-bracket text-[10px]"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Expand icon for collapsed state -->
                    <div x-show="!isSidebarOpen" class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 bg-sky-50/90 transition-opacity">
                        <i class="fas fa-angles-right text-sky-500 text-xs"></i>
                    </div>
                </div>
            </div>

        </aside>

        <!-- Mobile sidebar overlay -->
        <div
            x-show="isMobileMenuOpen"
            x-cloak
            @click="isMobileMenuOpen = false"
            class="fixed inset-0 bg-black/40 backdrop-blur-sm z-20 md:hidden"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"></div>


        <!-- ================================================================
         MAIN CONTENT AREA
    ================================================================= -->
        <main class="flex-1 flex flex-col min-w-0 min-h-0 overflow-hidden bg-(--surface-page)">

            <!-- HEADER -->
            <header class="glass-header px-6 md:px-8 flex items-center justify-between h-20 shrink-0 relative z-10">

                <!-- Left: Mobile menu + Brand/Page Title -->
                <div class="flex items-center gap-4">
                    <!-- Mobile hamburger -->
                    <button
                        @click="isMobileMenuOpen = !isMobileMenuOpen"
                        class="md:hidden w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-sky-50 hover:text-sky-500 transition-colors shrink-0">
                        <i class="fas fa-bars text-lg"></i>
                    </button>

                    <div class="hidden md:flex items-center gap-3">
                        <span class="text-xs font-black text-slate-300 uppercase tracking-widest pointer-events-none"><?= esc($title ?? 'PMW') ?></span>
                    </div>
                </div>

                <!-- Right: Actions + User -->
                <div class="flex items-center gap-3 md:gap-5">

                    <!-- Actions -->
                    <div class="flex items-center gap-1 md:gap-2">
                        <!-- Notification Bell -->
                        <button class="relative w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:text-sky-500 hover:bg-sky-50 border border-transparent hover:border-sky-100 transition-all duration-300 group">
                            <i class="fas fa-bell text-base"></i>
                            <span class="absolute top-2.5 right-2.5 w-2 h-2 bg-rose-500 border-2 border-white rounded-full"></span>
                        </button>
                    </div>

                    <!-- Divider -->
                    <div class="h-8 w-px bg-slate-100 mx-1"></div>

                    <!-- User Profile Dropdown Placeholder -->
                    <div class="flex items-center gap-3 pl-1 cursor-pointer group">
                        <!-- Name & role (desktop only) -->
                        <div class="hidden lg:block text-right">
                            <p class="text-sm font-bold text-(--text-heading) group-hover:text-sky-500 transition-colors leading-tight">
                                <?= esc($displayName) ?>
                            </p>
                            <p class="text-[10px] text-(--text-muted) uppercase font-black tracking-widest mt-0.5">
                                <?= esc($displayRole) ?>
                            </p>
                        </div>
                        <!-- Avatar -->
                        <div class="w-10 h-10 rounded-xl bg-linear-to-tr from-sky-500 to-sky-400 flex items-center justify-center text-white font-display font-bold text-sm shadow-md shadow-sky-200 group-hover:scale-105 transition-transform duration-300">
                            <?= esc($initials) ?>
                        </div>
                    </div>
                </div>
            </header>

            <!-- SCROLLABLE CONTENT -->
            <div class="flex-1 overflow-y-auto overflow-x-hidden px-4 sm:px-6 md:px-8 py-6 sm:py-8 bg-(--surface-page)">
                <div class="max-w-[1600px] mx-auto w-full min-h-full flex flex-col relative">

                    <!-- Breadcrumb (optional, can be set per-view) -->
                    <?php if (isset($breadcrumb)): ?>
                        <nav class="flex items-center gap-2 text-xs text-(--text-muted) font-semibold -mb-2">
                            <a href="<?= base_url('dashboard') ?>" class="hover:text-sky-500 transition-colors">Dashboard</a>
                            <?php foreach ($breadcrumb as $crumb): ?>
                                <i class="fas fa-chevron-right text-[10px] text-slate-300"></i>
                                <?php if ($crumb['active'] ?? false): ?>
                                    <span class="text-(--text-heading)"><?= esc($crumb['label']) ?></span>
                                <?php else: ?>
                                    <a href="<?= base_url($crumb['url']) ?>" class="hover:text-sky-500 transition-colors"><?= esc($crumb['label']) ?></a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </nav>
                    <?php endif; ?>

                    <!-- PAGE CONTENT injected here -->
                    <div class="flex-1">
                        <?= $this->renderSection('content') ?>
                    </div>

                    <!-- Footer -->
                    <footer class="mt-16 sm:mt-20 pt-6 border-t border-sky-100/50 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-300 text-center sm:text-left">
                            &copy; <?= date('Y') ?> Politeknik Negeri Sriwijaya — Sistem Informasi PMW
                        </p>
                        <div class="flex items-center gap-4 sm:gap-6 text-[10px] uppercase font-black tracking-widest text-slate-300">
                            <a href="#" class="hover:text-sky-400 transition-colors">Dokumentasi</a>
                            <a href="#" class="hover:text-sky-400 transition-colors">Bantuan</a>
                            <a href="#" class="hover:text-sky-400 transition-colors">Kebijakan</a>
                        </div>
                    </footer>
                </div>
            </div>

        </main>
    </div><!-- /flex h-screen -->

    <!-- Mobile Sidebar (slides from left) -->
    <aside
        x-show="isMobileMenuOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 w-72 bg-white border-r border-sky-100 flex flex-col z-40 md:hidden">
        <!-- Mobile Sidebar Header -->
        <div class="h-16 flex items-center justify-between px-4 border-b border-sky-50 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-linear-to-br from-sky-500 to-sky-400 flex items-center justify-center shadow-md shadow-sky-200">
                    <i class="fas fa-graduation-cap text-white text-sm"></i>
                </div>
                <div>
                    <h1 class="font-display text-sm font-bold text-(--text-heading)">Polsri <span class="text-sky-500">PMW</span></h1>
                </div>
            </div>
            <button @click="isMobileMenuOpen = false" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:bg-sky-50 hover:text-sky-500">
                <i class="fas fa-xmark"></i>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <?php foreach ($navItems as $item):
                $isActive = strpos($currentUrl, base_url($item['match'])) !== false;
                $activeClass = $isActive ? 'bg-sky-50 text-sky-600 border-sky-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700';
            ?>
                <a href="<?= base_url($item['route']) ?>" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition-colors <?= $activeClass ?>">
                    <i class="fas <?= $item['icon'] ?> w-5 text-center"></i>
                    <?= $item['label'] ?>
                </a>
            <?php endforeach; ?>

            <div class="pt-4 mt-4 border-t border-sky-50">
                <?php foreach ($bottomItems as $item):
                    $isActive = strpos($currentUrl, base_url($item['match'])) !== false;
                    $activeClass = $isActive ? 'bg-sky-50 text-sky-600 border-sky-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700';
                ?>
                    <a href="<?= base_url($item['route']) ?>" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition-colors <?= $activeClass ?>">
                        <i class="fas <?= $item['icon'] ?> w-5 text-center"></i>
                        <?= $item['label'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </nav>

        <!-- Mobile User Profile -->
        <div class="p-4 border-t border-sky-50 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-linear-to-tr from-sky-500 to-sky-400 flex items-center justify-center text-white font-display font-bold text-sm">
                    <?= strtoupper(substr(auth()->user()->username ?? 'G', 0, 2)) ?>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-(--text-heading) truncate"><?= esc(auth()->user()->username ?? 'Guest') ?></p>
                    <p class="text-xs text-(--text-muted) uppercase font-black tracking-widest"><?= auth()->user() ? esc(auth()->user()->getGroups()[0] ?? 'User') : 'Visitor' ?></p>
                </div>
                <form action="<?= base_url('logout') ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="text-slate-300 hover:text-rose-400 transition-colors">
                        <i class="fas fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>


    <!-- ================================================================
     GLOBAL SCRIPTS
================================================================= -->

    <!-- Alpine.js v3 -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Mouse-tracking glow for .card-premium -->
    <script>
        document.addEventListener('mousemove', (e) => {
            document.querySelectorAll('.card-premium, .card-accent').forEach(card => {
                const rect = card.getBoundingClientRect();
                card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            });
        });
    </script>

    <!-- Page-specific scripts -->
    <?= $this->renderSection('scripts') ?>

</body>

</html>