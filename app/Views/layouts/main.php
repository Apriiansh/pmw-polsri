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

    <!-- Vite Assets (Alpine.js + Tailwind) -->
    <?php if (ENVIRONMENT === 'development'): ?>
        <script type="module" src="http://localhost:5173/@vite/client"></script>
        <script type="module" src="http://localhost:5173/app/Views/js/app.js"></script>
        <link rel="stylesheet" href="http://localhost:5173/app/Views/css/input.css">
    <?php else: ?>
        <script type="module" src="<?= base_url('build/app.js') ?>"></script>
        <link rel="stylesheet" href="<?= base_url('build/app.css') ?>">
        <link rel="stylesheet" href="<?= base_url('build/style.css') ?>">
    <?php endif; ?>

    <!-- Page-specific styles -->
    <?= $this->renderSection('styles') ?>
</head>

<!--
    Alpine.js x-data on body:
    - isSidebarOpen : controls sidebar width
    - isMobileMenuOpen : overlay sidebar on mobile
-->

<body
    class="bg-(--surface-page) text-(--text-body) overflow-x-hidden"
    x-data="{
        isSidebarOpen: window.innerWidth >= 1024 ? (localStorage.getItem('sidebarOpen') !== 'false') : false,
        isMobileMenuOpen: false,
        openDropdown: null,
        toggleSidebar() {
            this.isSidebarOpen = !this.isSidebarOpen;
            localStorage.setItem('sidebarOpen', this.isSidebarOpen);
        }
    }"
    @resize.window="if (window.innerWidth < 1024) isSidebarOpen = false"
    x-init="
        // Auto-open active dropdowns on load
        $nextTick(() => {
            const activeChild = document.querySelector('.sidebar-item-child.active');
            if (activeChild) {
                const parent = activeChild.closest('[data-dropdown-id]');
                if (parent) openDropdown = parent.getAttribute('data-dropdown-id');
            }
        })
    ">

    <div class="flex h-screen overflow-hidden bg-(--surface-page)">

        <!-- ================================================================
         SIDEBAR
    ================================================================= -->
        <aside
            class="hidden lg:flex bg-white border-r border-sky-100 flex-col relative z-30 shrink-0 transition-all duration-300 ease-smooth"
            :class="isSidebarOpen ? 'w-72' : 'w-[72px]'">

            <!-- Logo Header -->
            <div class="h-20 flex items-center px-4 border-b border-sky-50 shrink-0 relative" :class="isSidebarOpen ? 'justify-between' : 'justify-center'">

                <!-- Logo icon + Text -->
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-xl bg-linear-to-br from-sky-500 to-sky-400 flex items-center justify-center shadow-md shadow-sky-200 shrink-0">
                        <img src="<?= base_url('favicon.png') ?>" alt="PMW Polsri" class="w-6 h-6 object-contain">
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

                <!-- Floating Toggle Button (Desktop only) -->
                <button
                    @click="toggleSidebar()"
                    class="hidden lg:flex absolute -right-3 top-1/2 -translate-y-1/2 w-6 h-6 items-center justify-center rounded-full bg-white border border-sky-100 text-slate-400 hover:text-sky-500 shadow-md hover:shadow-lg transition-all duration-300 z-50 group/toggle"
                    :class="isSidebarOpen ? '' : 'rotate-180'"
                    title="Toggle Sidebar">
                    <i class="fas fa-chevron-left text-[10px] transition-transform group-hover/toggle:-translate-x-0.5"></i>
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
                    $navItems[] = ['route' => 'admin/pmw-system', 'icon' => 'fa-calendar-days',  'label' => 'PMW System', 'match' => 'admin/pmw-system'];

                    // 1. Seleksi & Validasi
                    $navItems[] = [
                        'label' => 'Seleksi & Validasi',
                        'icon'  => 'fa-clipboard-check',
                        'id'    => 'seleksi',
                        'children' => [
                            ['route' => 'admin/administrasi/seleksi', 'label' => 'Administrasi', 'match' => 'admin/administrasi/seleksi'],
                            ['route' => 'admin/pitching-desk',        'label' => 'Pitching Desk', 'match' => 'admin/pitching-desk'],
                            ['route' => 'admin/perjanjian',           'label' => 'Perjanjian Kontrak', 'match' => 'admin/perjanjian'],
                            ['route' => 'admin/pengumuman',           'label' => 'Pengumuman Lolos', 'match' => 'admin/pengumuman'],
                            ['route' => 'admin/implementasi', 'label' => 'Implementasi List', 'match' => 'admin/implementasi'],
                        ]
                    ];

                    // 2. Monitoring & Monev
                    $navItems[] = [
                        'label' => 'Monev',
                        'icon'  => 'fa-chart-line',
                        'id'    => 'monitoring',
                        'children' => [
                            ['route' => 'admin/teams', 'label' => 'Peserta PMW', 'match' => 'admin/teams'],
                            ['route' => 'admin/kegiatan',     'label' => 'Kegiatan Wirausaha',   'match' => 'admin/kegiatan'],
                            ['route' => 'admin/milestone', 'label' => 'Laporan Milestone', 'match' => 'admin/milestone'],
                        ]
                    ];

                    $navItems[] = ['route' => 'admin/finalisasi', 'icon' => 'fa-gavel', 'label' => 'Finalisasi Dana II', 'match' => 'admin/finalisasi'];
                    $navItems[] = ['route' => 'admin/expo', 'icon' => 'fa-gavel', 'label' => 'Awarding & Expo', 'match' => 'admin/expo'];

                    // 3. Manajemen Data
                    $navItems[] = [
                        'label' => 'Manajemen Data',
                        'icon'  => 'fa-database',
                        'id'    => 'manajemen',
                        'children' => [
                            ['route' => 'admin/users/', 'label' => 'Users',   'match' => 'admin/users'],
                            ['route' => 'admin/portal-announcements', 'label' => 'Pengumuman', 'match' => 'admin/portal-announcements'],
                            ['route' => 'admin/gallery', 'label' => 'Kelola Galeri', 'match' => 'admin/gallery'],
                            ['route' => 'admin/cms',    'label' => 'Konten CMS', 'match' => 'admin/cms'],
                        ]
                    ];
                }

                if ($mainRole === 'mahasiswa') {
                    // Group: Proposal & Administrasi
                    $navItems[] = [
                        'label' => 'Proposal & Administrasi',
                        'icon' => 'fa-folder-tree',
                        'children' => [
                            ['route' => 'mahasiswa/proposal', 'icon' => 'fa-file-invoice', 'label' => 'Proposal', 'match' => 'mahasiswa/proposal'],
                            ['route' => 'mahasiswa/pitching-desk', 'icon' => 'fa-chalkboard', 'label' => 'Pitching Desk', 'match' => 'mahasiswa/pitching-desk'],
                            ['route' => 'mahasiswa/perjanjian', 'icon' => 'fa-file-signature', 'label' => 'Perjanjian', 'match' => 'mahasiswa/perjanjian'],
                        ]
                    ];

                    // Tahap 5, 6 & 7
                    $navItems[] = [
                        'label' => 'Kelolosan Tahap I',
                        'icon' => 'fa-money-bill-1',
                        'children' => [
                            ['route' => 'mahasiswa/pengumuman', 'icon' => 'fa-bullhorn', 'label' => 'Pengumuman Lolos Dana I', 'match' => 'mahasiswa/pengumuman'],
                            ['route' => 'mahasiswa/pembekalan', 'icon' => 'fa-chalkboard-user', 'label' => 'Pembekalan', 'match' => 'mahasiswa/pembekalan'],
                            ['route' => 'mahasiswa/implementasi', 'icon' => 'fa-list-check', 'label' => 'Implementasi', 'match' => 'mahasiswa/implementasi'],
                        ]
                    ];

                    // Tahap 8 & 9
                    $navItems[] = [
                        'label' => 'Logbook PMW',
                        'icon' => 'fa-book',
                        'children' => [
                            ['route' => 'mahasiswa/bimbingan', 'icon' => 'fa-book', 'label' => 'Bimbingan', 'match' => 'mahasiswa/bimbingan'],
                            ['route' => 'mahasiswa/mentoring', 'icon' => 'fa-handshake-angle', 'label' => 'Mentoring', 'match' => 'mahasiswa/mentoring'],
                            ['route' => 'mahasiswa/kegiatan', 'icon' => 'fa-store', 'label' => 'Kegiatan Wirausaha', 'match' => 'mahasiswa/kegiatan'],
                        ]
                    ];
                    // Laporan Milestone (Kemajuan & Akhir)
                    $navItems[] = ['route' => 'mahasiswa/milestone', 'icon' => 'fa-file-arrow-up', 'label' => 'Laporan Milestone', 'match' => 'mahasiswa/milestone'];

                    // Tahap 10
                    $navItems[] = ['route' => 'mahasiswa/expo', 'icon' => 'fa-trophy', 'label' => 'Awarding & Expo', 'match' => 'mahasiswa/expo'];
                }
                if ($mainRole === 'reviewer') {
                    // Penilaian Proposal - Tahap 2-3 (Seleksi Administrasi & Pitching Desk)
                    // $navItems[] = ['route' => 'reviewer/penilaian-proposal', 'icon' => 'fa-clipboard-check', 'label' => 'Penilaian Proposal', 'match' => 'reviewer/penilaian-proposal'];
                    // Penilaian Laporan - Tahap 7-8 (Monev 1 & 2)
                    // $navItems[] = ['route' => 'reviewer/penilaian-laporan', 'icon' => 'fa-file-circle-check', 'label' => 'Penilaian Laporan', 'match' => 'reviewer/penilaian-laporan'];
                    // Monitoring Kegiatan - Tahap 9
                    $navItems[] = ['route' => 'reviewer/kegiatan', 'icon' => 'fa-camera-retro', 'label' => 'Monitoring Kegiatan', 'match' => 'reviewer/kegiatan'];
                }

                if ($mainRole === 'dosen') {
                    // Tahap 8 & 9
                    $navItems[] = [
                        'label' => 'Validasi',
                        'icon' => 'fa-check-double',
                        'children' => [
                            ['route' => 'dosen/pitching-desk', 'icon' => 'fa-chalkboard-user', 'label' => 'Pitching Desk', 'match' => 'dosen/pitching-desk'],
                            ['route' => 'dosen/implementasi', 'icon' => 'fa-list-check', 'label' => 'Implementasi List', 'match' => 'dosen/implementasi'],
                        ]
                    ];
                    $navItems[] = [
                        'label' => 'Bimbingan & Kegiatan',
                        'icon' => 'fa-users',
                        'children' => [
                            ['route' => 'dosen/bimbingan', 'icon' => 'fa-signature', 'label' => 'Bimbingan Mahasiswa', 'match' => 'dosen/bimbingan'],
                            ['route' => 'dosen/kegiatan', 'icon' => 'fa-store', 'label' => 'Kegiatan Wirausaha', 'match' => 'dosen/kegiatan'],
                            ['route' => 'dosen/milestone', 'icon' => 'fa-file-circle-check', 'label' => 'Laporan Milestone', 'match' => 'dosen/milestone'],
                        ]
                    ];
                    // Monitoring Tim
                    $navItems[] = ['route' => 'dosen/monitoring', 'icon' => 'fa-users-viewfinder', 'label' => 'Monitoring Tim', 'match' => 'dosen/monitoring'];
                }

                if ($mainRole === 'mentor') {
                    // Validasi Logbook - Tahap 8 (Mentoring)
                    $navItems[] = ['route' => 'mentor/mentoring', 'icon' => 'fa-check-double', 'label' => 'Mentoring Mahasiswa', 'match' => 'mentor/mentoring'];
                    // Validasi Logbook - Tahap 9 (Kegiatan Wirausaha)
                    $navItems[] = ['route' => 'mentor/kegiatan', 'icon' => 'fa-store', 'label' => 'Kegiatan Wirausaha', 'match' => 'mentor/kegiatan'];

                    // Monitoring Tim - Tahap x (Implementasi & Monev)
                    $navItems[] = ['route' => 'mentor/monitoring', 'icon' => 'fa-briefcase', 'label' => 'Monitoring Tim', 'match' => 'mentor/monitoring'];
                }
                $currentUrl = current_url();
                $currentPath = trim((string) parse_url($currentUrl, PHP_URL_PATH), '/');

                foreach ($navItems as $item):
                    if (isset($item['children'])) {
                        // Dropdown Parent
                        $isAnyChildActive = false;
                        foreach ($item['children'] as $child) {
                            if (strpos($currentPath, trim($child['match'], '/')) !== false) {
                                $isAnyChildActive = true;
                                break;
                            }
                        }
                        $dropdownId = $item['id'] ?? str_replace(' ', '-', strtolower($item['label']));
                ?>
                        <div class="space-y-1" data-dropdown-id="<?= $dropdownId ?>">
                            <button
                                @click="isSidebarOpen ? (openDropdown = (openDropdown === '<?= $dropdownId ?>' ? null : '<?= $dropdownId ?>')) : toggleSidebar()"
                                class="sidebar-item w-full group/item"
                                :class="isSidebarOpen ? 'px-3 justify-start' : 'px-0 justify-center'"
                                title="<?= $item['label'] ?>">
                                <span class="sidebar-item-icon transition-transform duration-300 group-hover/item:scale-110 <?= $isAnyChildActive ? 'text-sky-500' : '' ?>">
                                    <i class="fas <?= $item['icon'] ?>"></i>
                                </span>
                                <span
                                    class="text-sm font-medium whitespace-nowrap transition-all duration-300 ease-smooth <?= $isAnyChildActive ? 'text-slate-800' : '' ?>"
                                    :class="isSidebarOpen ? 'opacity-100 max-w-[200px] translate-x-0 ml-3' : 'opacity-0 max-w-0 -translate-x-4 ml-0 overflow-hidden'">
                                    <?= $item['label'] ?>
                                </span>
                                <i
                                    x-show="isSidebarOpen"
                                    class="fas fa-chevron-down text-[10px] ml-auto transition-transform duration-300 text-slate-300"
                                    :class="openDropdown === '<?= $dropdownId ?>' ? 'rotate-180' : ''"></i>
                            </button>

                            <!-- Submenu Container -->
                            <div
                                x-show="isSidebarOpen && openDropdown === '<?= $dropdownId ?>'"
                                x-collapse
                                class="relative ml-8 border-l border-slate-100 space-y-0.5 overflow-hidden"
                                x-cloak>
                                <?php foreach ($item['children'] as $index => $child):
                                    $isChildActive = strpos($currentPath, trim($child['match'], '/')) !== false;
                                ?>
                                    <a
                                        href="<?= base_url($child['route']) ?>"
                                        class="sidebar-item-child <?= $isChildActive ? 'active' : '' ?> flex items-center py-2 px-3 text-xs font-medium text-slate-500 hover:text-sky-600 transition-all duration-200 group/child"
                                        style="transition-delay: <?= $index * 30 ?>ms">

                                        <!-- Active Indicator (Sliding Bar) -->
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-[2px] h-0 bg-sky-500 rounded-full transition-all duration-300 <?= $isChildActive ? 'h-3/5' : 'group-hover/child:h-1/4 group-hover/child:bg-slate-300' ?>"></div>

                                        <span class="ml-1 transition-transform duration-200 group-hover/child:translate-x-1">
                                            <?= $child['label'] ?>
                                        </span>

                                        <?php if ($isChildActive): ?>
                                            <i class="fas fa-circle text-[4px] text-sky-500 ml-auto animate-pulse"></i>
                                        <?php endif; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    <?php } else {
                        // Regular Item
                        $isActive = strpos($currentPath, trim($item['match'], '/')) !== false;
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
                    <?php } ?>
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
                    $isActive = strpos($currentPath, trim($item['match'], '/')) !== false;
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
                    class="flex items-center gap-3 p-3 rounded-xl bg-sky-50/50 group transition-all duration-300 overflow-hidden relative"
                    :class="isSidebarOpen ? 'justify-start' : 'justify-center'">
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
                </div>
            </div>

        </aside>

        <!-- Mobile sidebar overlay -->
        <div
            x-show="isMobileMenuOpen"
            x-cloak
            @click="isMobileMenuOpen = false"
            class="fixed inset-0 bg-black/40 backdrop-blur-sm z-20 lg:hidden"
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
            <header class="glass-header px-4 sm:px-6 lg:px-8 flex items-center justify-between h-20 shrink-0 relative z-10">

                <!-- Left: Mobile menu + Brand/Page Title -->
                <div class="flex items-center gap-4">
                    <!-- Mobile hamburger -->
                    <button
                        @click="isMobileMenuOpen = !isMobileMenuOpen"
                        class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:bg-sky-50 hover:text-sky-500 transition-colors shrink-0">
                        <i class="fas fa-bars text-lg"></i>
                    </button>

                    <div class="hidden lg:flex items-center gap-3">
                        <span class="text-xs font-black text-slate-300 uppercase tracking-widest pointer-events-none"><?= esc($title ?? 'PMW') ?></span>
                    </div>
                </div>

                <!-- Right: Actions + User -->
                <div class="flex items-center gap-3 md:gap-5">

                    <!-- Actions -->
                    <div class="flex items-center gap-1 md:gap-2">
                        <!-- Notification Bell Dropdown -->
                        <?php
                        $notificationModel = new \App\Models\NotificationModel();
                        $notifUser = auth()->user();
                        $isAdmin = $notifUser->inGroup('admin');
                        $notifUserId = $isAdmin ? null : (int) $notifUser->id;
                        $unreadCount = $notificationModel->countUnread($notifUserId);
                        $notifications = $notificationModel->getUnread($notifUserId, 5);
                        ?>
                        <div class="relative" x-data="{ isNotifOpen: false }" @click.outside="isNotifOpen = false">
                            <button @click="isNotifOpen = !isNotifOpen"
                                class="relative w-10 h-10 flex items-center justify-center rounded-xl text-slate-400 hover:text-sky-500 hover:bg-sky-50 border border-transparent hover:border-sky-100 transition-all duration-300 group">
                                <i class="fas fa-bell text-base"></i>
                                <?php if ($unreadCount > 0): ?>
                                    <span class="absolute -top-1 -right-1 flex h-5 w-5">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                        <span class="relative inline-flex h-5 w-5 bg-rose-500 text-white text-[10px] font-black items-center justify-center rounded-full border-2 border-white shadow-sm">
                                            <?= $unreadCount > 9 ? '9+' : $unreadCount ?>
                                        </span>
                                    </span>
                                <?php endif; ?>
                            </button>

                            <!-- Notification Dropdown -->
                            <div x-show="isNotifOpen"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                                class="absolute right-0 top-full mt-2 w-80 bg-white rounded-xl shadow-xl shadow-slate-200/50 border border-sky-100 py-2 z-50"
                                x-cloak>

                                <!-- Header -->
                                <div class="px-4 py-3 border-b border-sky-50 flex items-center justify-between">
                                    <p class="text-sm font-bold text-(--text-heading)">Notifikasi</p>
                                    <?php if ($unreadCount > 0): ?>
                                        <span class="px-2 py-0.5 bg-rose-100 text-rose-700 text-[10px] font-black rounded-full">
                                            <?= $unreadCount ?> baru
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Notification List -->
                                <div class="max-h-72 overflow-y-auto">
                                    <?php if (empty($notifications)): ?>
                                        <div class="px-4 py-6 text-center text-slate-400">
                                            <i class="fas fa-bell-slash text-2xl mb-2"></i>
                                            <p class="text-xs">Tidak ada notifikasi baru</p>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($notifications as $notif): ?>
                                            <a href="<?= base_url($notif['link'] ?? '#') ?>?notif=<?= $notif['id'] ?>"
                                                class="flex items-start gap-3 px-4 py-3 hover:bg-sky-50 transition-colors border-b border-slate-50 last:border-0">
                                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0
                                                    <?= $notif['type'] === 'proposal_submitted' ? 'bg-emerald-100 text-emerald-600' : 'bg-sky-100 text-sky-600' ?>">
                                                    <i class="fas <?= $notif['type'] === 'proposal_submitted' ? 'fa-file-import' : 'fa-info' ?> text-xs"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-xs font-bold text-(--text-heading) leading-tight truncate">
                                                        <?= esc($notif['title']) ?>
                                                    </p>
                                                    <p class="text-[11px] text-slate-500 leading-snug line-clamp-2">
                                                        <?= esc($notif['message']) ?>
                                                    </p>
                                                    <p class="text-[10px] text-slate-400 mt-1">
                                                        <?= time_elapsed_string($notif['created_at']) ?>
                                                    </p>
                                                </div>
                                                <?php if (!$notif['is_read']): ?>
                                                    <span class="w-2 h-2 bg-sky-500 rounded-full shrink-0 mt-1"></span>
                                                <?php endif; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                                <!-- Footer -->
                                <div class="border-t border-sky-50 px-4 py-2">
                                    <a href="<?= base_url('notifications') ?>" class="text-xs font-semibold text-sky-600 hover:text-sky-700 flex items-center justify-center gap-1 py-1">
                                        Lihat Semua
                                        <i class="fas fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-8 w-px bg-slate-100 mx-1"></div>

                    <!-- User Profile Dropdown -->
                    <div class="relative" x-data="{ isUserMenuOpen: false }" @click.outside="isUserMenuOpen = false">
                        <button
                            @click="isUserMenuOpen = !isUserMenuOpen"
                            class="flex items-center gap-3 pl-1 cursor-pointer group focus:outline-none">
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
                            <!-- Dropdown arrow -->
                            <i class="fas fa-chevron-down text-xs text-slate-400 group-hover:text-sky-500 transition-all duration-200"
                                :class="isUserMenuOpen ? 'rotate-180' : ''"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div
                            x-show="isUserMenuOpen"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                            class="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl shadow-xl shadow-slate-200/50 border border-sky-100 py-2 z-50"
                            x-cloak>

                            <!-- User Info Header -->
                            <div class="px-4 py-3 border-b border-sky-50">
                                <p class="text-sm font-bold text-(--text-heading)"><?= esc($displayName) ?></p>
                                <p class="text-xs text-(--text-muted)"><?= esc($displayRole) ?></p>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-1">
                                <!-- Account Settings -->
                                <a href="<?= base_url('profile') ?>" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-sky-50 hover:text-sky-600 transition-colors">
                                    <i class="fas fa-user-gear w-5 text-center text-slate-400"></i>
                                    <span>Pengaturan Akun</span>
                                </a>
                            </div>

                            <!-- Divider -->
                            <div class="border-t border-sky-50 my-1"></div>

                            <!-- Logout -->
                            <form action="<?= base_url('logout') ?>" method="post" class="px-2 py-1">
                                <?= csrf_field() ?>
                                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-rose-600 hover:bg-rose-50 transition-colors">
                                    <i class="fas fa-right-from-bracket w-5 text-center"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
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
        class="fixed inset-y-0 left-0 w-72 bg-white border-r border-sky-100 flex flex-col z-40 lg:hidden">
        <!-- Mobile Sidebar Header -->
        <div class="h-16 flex items-center justify-between px-4 border-b border-sky-50 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-linear-to-br from-sky-500 to-sky-400 flex items-center justify-center shadow-md shadow-sky-200">
                    <img src="<?= base_url('favicon.png') ?>" alt="PMW Polsri" class="w-8 h-8 object-contain">
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
                if (isset($item['children'])) {
                    $isAnyChildActive = false;
                    foreach ($item['children'] as $child) {
                        if (strpos($currentUrl, base_url($child['match'])) !== false) {
                            $isAnyChildActive = true;
                            break;
                        }
                    }
                    $dropdownId = ($item['id'] ?? str_replace(' ', '-', strtolower($item['label']))) . '_mobile';
            ?>
                    <div x-data="{ isOpen: <?= $isAnyChildActive ? 'true' : 'false' ?> }" class="space-y-1">
                        <button
                            @click="isOpen = !isOpen"
                            class="w-full flex items-center justify-between px-3 py-3 rounded-xl text-sm font-medium transition-colors <?= $isAnyChildActive ? 'bg-sky-50 text-sky-600' : 'text-slate-500 hover:bg-slate-50' ?>">
                            <div class="flex items-center gap-3">
                                <i class="fas <?= $item['icon'] ?> w-5 text-center"></i>
                                <?= $item['label'] ?>
                            </div>
                            <i class="fas fa-chevron-down text-[10px] transition-transform duration-300" :class="isOpen ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="isOpen" x-collapse class="pl-11 space-y-1">
                            <?php foreach ($item['children'] as $child):
                                $isChildActive = strpos($currentUrl, base_url($child['match'])) !== false;
                            ?>
                                <a href="<?= base_url($child['route']) ?>" class="block py-2 text-sm <?= $isChildActive ? 'text-sky-600 font-bold' : 'text-slate-500 hover:text-slate-700' ?>">
                                    <?= $child['label'] ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php } else {
                    $isActive = strpos($currentUrl, base_url($item['match'])) !== false;
                    $activeClass = $isActive ? 'bg-sky-50 text-sky-600 border-sky-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-700';
                ?>
                    <a href="<?= base_url($item['route']) ?>" class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium transition-colors <?= $activeClass ?>">
                        <i class="fas <?= $item['icon'] ?> w-5 text-center"></i>
                        <?= $item['label'] ?>
                    </a>
                <?php } ?>
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
                <div class="w-10 h-10 rounded-xl bg-linear-to-tr from-sky-500 to-sky-400 flex items-center justify-center text-white font-display font-bold text-sm shadow-sm shadow-sky-200">
                    <?= esc($initials) ?>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-(--text-heading) truncate"><?= esc($displayName) ?></p>
                    <p class="text-[10px] text-(--text-muted) uppercase font-black tracking-widest truncate"><?= esc($displayRole) ?></p>
                </div>
                <form action="<?= base_url('logout') ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="text-slate-300 hover:text-rose-500 transition-colors">
                        <i class="fas fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Centralized Toast Notification System -->
    <div x-data="toastManager(<?= htmlspecialchars(json_encode($notifications), ENT_QUOTES, 'UTF-8') ?>)"
        @toast-notify.window="add($event.detail)"
        class="fixed top-6 right-6 z-9999 flex flex-col gap-3 w-full max-w-sm pointer-events-none">

        <template x-for="item in items" :key="item.id">
            <div x-show="item.show"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="translate-x-4 opacity-0"
                @click="item.link ? window.location.href = item.link : remove(item.id)"
                class="pointer-events-auto bg-white/90 backdrop-blur-md border rounded-2xl shadow-2xl p-4 flex items-center gap-4 group cursor-pointer hover:scale-[1.02] transition-transform"
                :class="{
                    'border-emerald-100 bg-emerald-50/80': item.type === 'success',
                    'border-rose-100 bg-rose-50/80': item.type === 'error',
                    'border-sky-100 bg-sky-50/80': item.type === 'info',
                    'border-amber-100 bg-amber-50/80': item.type === 'warning'
                 }">

                <!-- Icon -->
                <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0"
                    :class="{
                        'bg-emerald-100 text-emerald-600': item.type === 'success',
                        'bg-rose-100 text-rose-600': item.type === 'error',
                        'bg-sky-100 text-sky-600': item.type === 'info',
                        'bg-amber-100 text-amber-600': item.type === 'warning'
                     }">
                    <i class="fas" :class="{
                        'fa-check-circle': item.type === 'success',
                        'fa-exclamation-circle': item.type === 'error',
                        'fa-info-circle': item.type === 'info',
                        'fa-triangle-exclamation': item.type === 'warning'
                    }"></i>
                </div>

                <!-- Message -->
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-(--text-heading) leading-tight" x-text="item.message"></p>
                </div>

                <!-- Close Button -->
                <button class="text-slate-300 hover:text-slate-500 transition-colors p-1">
                    <i class="fas fa-xmark text-xs"></i>
                </button>
            </div>
        </template>
    </div>

    <script>
        function toastManager(dbNotifs = []) {
            return {
                items: [],
                dbNotifs: dbNotifs,

                init() {
                    // 1. Auto-hydrate from PHP Flash Messages
                    <?php if (session()->getFlashdata('success')): ?>
                        this.add({
                            message: "<?= addslashes(session()->getFlashdata('success')) ?>",
                            type: 'success'
                        });
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        this.add({
                            message: "<?= addslashes(session()->getFlashdata('error')) ?>",
                            type: 'error'
                        });
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('info')): ?>
                        this.add({
                            message: "<?= addslashes(session()->getFlashdata('info')) ?>",
                            type: 'info'
                        });
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('warning')): ?>
                        this.add({
                            message: "<?= addslashes(session()->getFlashdata('warning')) ?>",
                            type: 'warning'
                        });
                    <?php endif; ?>

                    // 2. Handle Database Notifications
                    if (this.dbNotifs.length > 0) {
                        const lastNotifiedId = parseInt(localStorage.getItem('pmw_last_notified_id') || '0');
                        let maxId = lastNotifiedId;

                        this.dbNotifs.forEach(notif => {
                            if (notif.id > lastNotifiedId) {
                                // Map notification type to toast type
                                let toastType = 'info';
                                if (notif.type.includes('approved')) toastType = 'success';
                                if (notif.type.includes('rejected')) toastType = 'error';
                                if (notif.type.includes('revision')) toastType = 'warning';

                                this.add({
                                    message: `${notif.title}: ${notif.message}`,
                                    type: toastType,
                                    link: notif.link ? `<?= base_url() ?>${notif.link}?notif=${notif.id}` : null
                                });

                                if (notif.id > maxId) maxId = notif.id;
                            }
                        });

                        localStorage.setItem('pmw_last_notified_id', maxId.toString());
                    }
                },

                add(detail) {
                    const id = Date.now() + Math.random();
                    this.items.push({
                        id: id,
                        show: false,
                        message: detail.message || 'No message provided',
                        type: detail.type || 'info',
                        link: detail.link || null
                    });

                    // Trigger enter animation
                    this.$nextTick(() => {
                        const item = this.items.find(i => i.id === id);
                        if (item) item.show = true;
                    });

                    // Auto remove after 5 seconds
                    setTimeout(() => {
                        this.remove(id);
                    }, 5000);
                },

                remove(id) {
                    const item = this.items.find(i => i.id === id);
                    if (item) {
                        item.show = false;
                        setTimeout(() => {
                            this.items = this.items.filter(i => i.id !== id);
                        }, 300); // Wait for transition
                    }
                }
            }
        }
    </script>

    <!-- Page-specific scripts -->
    <?= $this->renderSection('scripts') ?>

</body>

</html>