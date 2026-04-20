<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<script>
    window.__cmsData = {
        allGroups: <?= json_encode($groups) ?>,
        activeGroup: '<?= esc($activeGroup, 'js') ?>',
        selectedPage: '<?= esc($pageFilter, 'js') ?>',
        baseUrl: '<?= esc(base_url(), 'js') ?>',
        cmsUrl: '<?= esc(base_url('admin/cms'), 'js') ?>',
        urls: {
            home:        '<?= esc(base_url(), 'js') ?>',
            tahapan:     '<?= esc(base_url('tahapan'), 'js') ?>',
            tentang:     '<?= esc(base_url('tentang'), 'js') ?>',
            galeri:      '<?= esc(base_url('galeri'), 'js') ?>',
            pengumuman:  '<?= esc(base_url('pengumuman'), 'js') ?>',
        },
        // Metadata grup untuk filter client-side
        groups_meta: <?= json_encode(array_map(function($items) {
            return array_map(fn($c) => [
                'label' => strtolower($c['label']),
                'key'   => strtolower($c['key']),
            ], $items);
        }, $groupedContents)) ?>
    };
</script>

<div x-data="{
    search: '',
    activeGroup: window.__cmsData.activeGroup,
    dirty: false,
    showPreview: true,
    previewUrl: window.__cmsData.urls[window.__cmsData.selectedPage] ?? window.__cmsData.baseUrl,
    groupMapping: {
        'home_hero':              'section-hero',
        'home_features':          'section-features',
        'home_workflow':          'section-workflow',
        'home_gallery':           'section-gallery',
        'home_announcements':     'section-announcements',
        'home_cta':               'section-cta',
        'home_stats':             'section-stats',
        'tahapan_hero':           'section-tahapan-hero',
        'tahapan_flow':           'section-tahapan-flow',
        'tahapan_cta':            'section-tahapan-cta',
        'tentang_hero':           'section-tentang-hero',
        'tentang_vision':         'section-tentang-vision',
        'tentang_objectives':     'section-tentang-objectives',
        'tentang_cta':            'section-tentang-cta',
        'galeri_hero':            'section-galeri-hero',
        'galeri_grid':            'section-galeri-grid',
        'pengumuman_hero':        'section-pengumuman-hero',
        'pengumuman_subscribe':   'section-pengumuman-subscribe'
    },
    selectedPage: window.__cmsData.selectedPage,
    pages: {
        'all':        { label: 'Semua Halaman',       icon: 'fa-layer-group' },
        'home':       { label: 'Beranda (Home)',       icon: 'fa-home' },
        'tahapan':    { label: 'Halaman Tahapan',      icon: 'fa-route' },
        'tentang':    { label: 'Halaman Tentang',      icon: 'fa-info-circle' },
        'galeri':     { label: 'Halaman Galeri',       icon: 'fa-images' },
        'pengumuman': { label: 'Halaman Pengumuman',   icon: 'fa-bullhorn' },
        'general':    { label: 'Pengaturan Umum',      icon: 'fa-cog' }
    },
    allGroups: window.__cmsData.allGroups,

    get filteredGroups() {
        if (this.selectedPage === 'all') return this.allGroups;
        let filtered = {};
        Object.keys(this.allGroups).forEach(key => {
            if (key === this.selectedPage || key.startsWith(this.selectedPage + '_')) {
                filtered[key] = this.allGroups[key];
            }
        });
        return filtered;
    },

    groups_meta: window.__cmsData.groups_meta,

    // Cek apakah sebuah card (grup) harus ditampilkan
    isCardVisible(groupName) {
        const meta = this.groups_meta[groupName] || [];
        
        // 1. Filter halaman
        const pageMatch = this.selectedPage === 'all'
            || groupName === this.selectedPage
            || groupName.startsWith(this.selectedPage + '_');

        if (!pageMatch) return false;

        // 2. Filter section (activeGroup)
        const sectionMatch = this.activeGroup === 'all'
            || groupName === this.activeGroup;

        if (!sectionMatch) return false;

        // 3. Filter search (jika ada salah satu item di grup cocok)
        const q = this.search.toLowerCase();
        if (q === '') return true;

        return groupName.toLowerCase().includes(q) || meta.some(item => 
            item.label.includes(q) || item.key.includes(q)
        );
    },

    // Computed: apakah ada card yang visible saat ini?
    get hasVisibleCards() {
        return Object.keys(this.groups_meta).some(groupName => this.isCardVisible(groupName));
    },

    init() {
        this.$nextTick(() => {
            // Arahkan iframe ke halaman yang sesuai dengan selectedPage
            this.updatePreviewPage();

            // Setelah iframe load, scroll ke section jika activeGroup aktif
            if (this.activeGroup && this.activeGroup !== 'all') {
                if (this.$refs.previewFrame) {
                    this.$refs.previewFrame.addEventListener('load', () => {
                        setTimeout(() => this.scrollToSection(this.activeGroup), 300);
                    }, { once: true });
                }
            }
        });
    },

    // Arahkan preview iframe ke halaman yang sesuai selectedPage
    updatePreviewPage() {
        if (!this.$refs.previewFrame) return;
        const urls = window.__cmsData.urls;
        const map = {
            home:        urls.home,
            tahapan:     urls.tahapan,
            tentang:     urls.tentang,
            galeri:      urls.galeri,
            pengumuman:  urls.pengumuman,
            all:         urls.home,
            general:     urls.home,
        };
        const target = map[this.selectedPage] ?? urls.home;
        this.$refs.previewFrame.src = target;
        this.previewUrl = target;
    },

    // Update address bar di browser mock saat iframe navigasi
    updateAddressBar() {
        try {
            this.previewUrl = this.$refs.previewFrame.contentWindow.location.href;
        } catch (e) {
            // cross-origin fallback
        }
    },

    changePage(page) {
        // Reset activeGroup ke 'all' saat ganti halaman
        this.activeGroup = 'all';
        window.location.href = window.__cmsData.cmsUrl + '?group=all&page=' + page;
    },

    changeSection(group) {
        // Section filter sepenuhnya client-side, tidak perlu redirect
        this.activeGroup = group;
        if (group !== 'all') {
            // Pastikan iframe sudah di halaman yang benar, baru scroll ke section
            const sectionId = this.groupMapping[group];
            if (sectionId && this.$refs.previewFrame) {
                const urls = window.__cmsData.urls;
                let targetPage = urls.home;
                if (group.startsWith('tahapan_'))    targetPage = urls.tahapan;
                else if (group.startsWith('tentang_'))    targetPage = urls.tentang;
                else if (group.startsWith('galeri_'))     targetPage = urls.galeri;
                else if (group.startsWith('pengumuman_')) targetPage = urls.pengumuman;

                try {
                    const currentUrl = this.$refs.previewFrame.contentWindow.location.href;
                    if (!currentUrl.startsWith(targetPage)) {
                        // Halaman berbeda — navigasi dulu, scroll setelah load
                        this.$refs.previewFrame.src = targetPage + '#' + sectionId;
                    } else {
                        // Halaman sama — langsung scroll
                        this.$refs.previewFrame.contentWindow.location.hash = sectionId;
                    }
                } catch (e) {
                    this.$refs.previewFrame.src = targetPage + '#' + sectionId;
                }
            }
        }
    },

    scrollToSection(group) {
        const sectionId = this.groupMapping[group];
        if (sectionId && this.$refs.previewFrame) {
            const urls = window.__cmsData.urls;
            let targetPage = urls.home;
            if (group.startsWith('tahapan_'))    targetPage = urls.tahapan;
            else if (group.startsWith('tentang_'))    targetPage = urls.tentang;
            else if (group.startsWith('galeri_'))     targetPage = urls.galeri;
            else if (group.startsWith('pengumuman_')) targetPage = urls.pengumuman;

            try {
                const currentUrl = this.$refs.previewFrame.contentWindow.location.href;
                if (!currentUrl.includes(targetPage)) {
                    this.$refs.previewFrame.src = targetPage + '#' + sectionId;
                } else {
                    this.$refs.previewFrame.contentWindow.location.hash = sectionId;
                }
            } catch (e) {
                this.$refs.previewFrame.src = targetPage + '#' + sectionId;
            }
        }
    }
}" class="flex flex-col h-[calc(100vh-140px)]">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 shrink-0">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="w-10 h-10 rounded-2xl bg-sky-100 flex items-center justify-center text-sky-600">
                    <i class="fas fa-sliders text-lg"></i>
                </div>
                <div>
                    <h1 class="font-display text-2xl font-bold text-slate-800 tracking-tight">Manajemen Konten</h1>
                    <p class="text-xs text-slate-500 font-medium">Kustomisasi teks dan gambar portal publik tanpa menyentuh kode.</p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="relative group">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs transition-colors group-focus-within:text-sky-500"></i>
                <input type="text" x-model="search" placeholder="Cari kunci atau label..."
                       class="pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none w-64 transition-all">
            </div>
            <button @click="showPreview = !showPreview"
                    class="p-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition-all active:scale-95"
                    :class="showPreview ? 'text-sky-600 border-sky-100 bg-sky-50 ring-2 ring-sky-500/10' : ''"
                    title="Toggle Preview">
                <i class="fas" :class="showPreview ? 'fa-eye-slash' : 'fa-eye'"></i>
            </button>
        </div>
    </div>

    <!-- Filter Section: Page & Component -->
    <div class="flex flex-col md:flex-row gap-4 mb-6 shrink-0">

        <!-- Select Halaman -->
        <div class="flex-1">
            <label class="text-[10px] font-bold text-slate-400 uppercase mb-1.5 block tracking-wider">Pilih Halaman</label>
            <div class="input-group">
                <div class="input-icon">
                    <i class="fas" :class="pages[selectedPage]?.icon || 'fa-file-lines'"></i>
                </div>
                <select x-model="selectedPage" @change="changePage($event.target.value)" class="form-select">
                    <?php 
                    $pages = [
                        'all'        => ['label' => 'Semua Halaman',     'icon' => 'fa-layer-group'],
                        'home'       => ['label' => 'Beranda (Home)',     'icon' => 'fa-home'],
                        'tahapan'    => ['label' => 'Halaman Tahapan',    'icon' => 'fa-route'],
                        'tentang'    => ['label' => 'Halaman Tentang',    'icon' => 'fa-info-circle'],
                        'galeri'     => ['label' => 'Halaman Galeri',     'icon' => 'fa-images'],
                        'pengumuman' => ['label' => 'Halaman Pengumuman', 'icon' => 'fa-bullhorn'],
                        'general'    => ['label' => 'Pengaturan Umum',    'icon' => 'fa-cog']
                    ];
                    foreach ($pages as $id => $info): ?>
                        <option value="<?= $id ?>" <?= $pageFilter === $id ? 'selected' : '' ?>><?= $info['label'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Select Bagian (Section) -->
        <div class="flex-1">
            <label class="text-[10px] font-bold text-slate-400 uppercase mb-1.5 block tracking-wider">Bagian Spesifik</label>
            <div class="input-group">
                <div class="input-icon">
                    <i class="fas fa-puzzle-piece text-xs"></i>
                </div>
                <select x-model="activeGroup" @change="changeSection($event.target.value)" class="form-select">
                    <option value="all" <?= $activeGroup === 'all' ? 'selected' : '' ?>>Tampilkan Semua Bagian</option>
                    <template x-for="(label, id) in filteredGroups" :key="id">
                        <option :value="id" x-text="label" :selected="id === activeGroup"></option>
                    </template>
                </select>
            </div>
        </div>
    </div>

    <!-- Main Content Split View -->
    <div class="flex-1 flex gap-6 min-h-0 overflow-hidden">

        <!-- Sidebar: Content List -->
        <div :class="showPreview ? 'w-1/2' : 'w-full'" class="flex flex-col gap-4 overflow-y-auto pr-2 custom-scrollbar transition-all duration-500">

            <form action="<?= base_url('admin/cms/save') ?>" method="POST" enctype="multipart/form-data" @input="dirty = true" class="space-y-4 pb-20">
                <?= csrf_field() ?>
                <input type="hidden" name="group" value="<?= esc($activeGroup) ?>">
                <input type="hidden" name="page" value="<?= esc($pageFilter) ?>">

                <?php foreach ($groupedContents as $groupName => $items): ?>
                    <div x-show="isCardVisible('<?= esc($groupName, 'js') ?>')"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         data-card
                         data-group="<?= esc($groupName) ?>"
                         class="group bg-white rounded-2xl border border-slate-200 p-6 hover:border-sky-400 hover:shadow-xl hover:shadow-sky-500/5 transition-all duration-300 cursor-pointer relative overflow-hidden"
                         @click="scrollToSection('<?= esc($groupName, 'js') ?>')">

                        <!-- Active Indicator -->
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-sky-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <div class="flex items-center gap-2 mb-1.5">
                                    <span class="inline-block px-2 py-0.5 rounded bg-sky-50 text-[9px] font-black text-sky-600 uppercase tracking-widest">
                                        <?= esc($groupName) ?>
                                    </span>
                                    <span class="inline-block px-2 py-0.5 rounded bg-slate-100 text-[9px] font-black text-slate-400 uppercase tracking-widest">
                                        <?= count($items) ?> ITEMS
                                    </span>
                                </div>
                                <h3 class="font-bold text-slate-800 group-hover:text-sky-600 transition-colors">
                                    <?= esc($groups[$groupName] ?? ucwords(str_replace('_', ' ', $groupName))) ?>
                                </h3>
                            </div>
                            <div class="p-2 rounded-lg bg-slate-50 text-slate-300 group-hover:text-sky-500 transition-colors">
                                <i class="fas fa-layer-group"></i>
                            </div>
                        </div>

                        <div class="space-y-6">
                        <?php foreach ($items as $content): ?>
                            <div class="relative pt-4 border-t border-slate-100 first:border-0 first:pt-0">
                                <div class="flex items-center justify-between mb-3">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-wider">
                                        <?= esc($content['label']) ?>
                                        <span class="ml-1 font-mono text-[9px] lowercase opacity-50 font-normal"><?= esc($content['key']) ?></span>
                                    </label>
                                    <span class="text-[9px] font-bold text-slate-300 uppercase"><?= esc($content['type']) ?></span>
                                </div>

                                <?php if ($content['type'] === 'image'): ?>
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                        <div class="space-y-3">
                                            <div class="relative">
                                                <i class="fas fa-link absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-[10px]"></i>
                                                <input type="text" name="cms[<?= esc($content['key']) ?>]" value="<?= esc($content['content']) ?>"
                                                       class="w-full pl-8 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-[11px] font-mono focus:bg-white focus:ring-2 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all">
                                            </div>
                                            <div class="relative group/upload">
                                                <input type="file" name="cms_file[<?= esc($content['key']) ?>]"
                                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                                <div class="flex items-center gap-2 p-2 rounded-xl border border-dashed border-slate-300 bg-slate-50 group-hover/upload:bg-sky-50 transition-all text-center justify-center">
                                                    <i class="fas fa-upload text-[10px] text-slate-400"></i>
                                                    <span class="text-[10px] font-bold text-slate-500">Upload File</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="relative aspect-video rounded-xl border border-slate-100 bg-slate-50 overflow-hidden shadow-inner flex items-center justify-center">
                                            <?php if ($content['content']): ?>
                                                <img src="<?= cms_img($content['content']) ?>" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <i class="fas fa-image text-slate-200 text-xl"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                <?php elseif ($content['type'] === 'text'): ?>
                                    <textarea name="cms[<?= esc($content['key']) ?>]" rows="2"
                                              class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all resize-none shadow-inner leading-relaxed"><?= esc($content['content']) ?></textarea>

                                <?php elseif ($content['type'] === 'rich_text'): ?>
                                    <textarea name="cms[<?= esc($content['key']) ?>]" rows="4"
                                              class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all shadow-inner leading-relaxed"><?= esc($content['content']) ?></textarea>

                                <?php elseif ($content['type'] === 'json'): ?>
                                    <div class="bg-slate-50 rounded-xl border border-slate-200 overflow-hidden"
                                         x-data='{
                                            items: <?= json_encode(json_decode($content["content"], true) ?? []) ?>,
                                            mode: "visual",
                                            raw: "",
                                            init() {
                                                this.raw = JSON.stringify(this.items, null, 4);
                                                this.$watch("items", val => {
                                                    this.raw = JSON.stringify(val, null, 4);
                                                }, { deep: true });
                                            },
                                            addItem() {
                                                if (this.items.length > 0) {
                                                    let newItem = JSON.parse(JSON.stringify(this.items[0]));
                                                    Object.keys(newItem).forEach(key => newItem[key] = "");
                                                    this.items.push(newItem);
                                                } else {
                                                    this.items.push({ label: "", value: "" });
                                                }
                                                this.$dispatch("change");
                                            },
                                            removeItem(index) {
                                                this.items.splice(index, 1);
                                                this.$dispatch("change");
                                            },
                                            syncRaw() {
                                                try { this.items = JSON.parse(this.raw); } catch(e) {}
                                            }
                                         }'>
                                        <div class="bg-slate-100 px-3 py-1.5 border-b border-slate-200 flex items-center justify-between">
                                            <div class="flex gap-1">
                                                <button type="button" @click="mode = 'visual'" :class="mode === 'visual' ? 'bg-white shadow-sm text-sky-600' : 'text-slate-500'" class="px-2 py-0.5 rounded text-[9px] font-black uppercase">Visual</button>
                                                <button type="button" @click="mode = 'raw'" :class="mode === 'raw' ? 'bg-white shadow-sm text-sky-600' : 'text-slate-500'" class="px-2 py-0.5 rounded text-[9px] font-black uppercase">Code</button>
                                            </div>
                                            <button type="button" x-show="mode === 'visual'" @click="addItem()" class="text-sky-600 hover:text-sky-700 font-bold text-[9px] uppercase">
                                                + Tambah
                                            </button>
                                        </div>
                                        <div x-show="mode === 'visual'" class="p-3 space-y-2 max-h-[300px] overflow-y-auto custom-scrollbar">
                                            <template x-for="(item, index) in items" :key="index">
                                                <div class="bg-white p-2.5 rounded-lg border border-slate-100 shadow-sm relative group/row">
                                                    <button type="button" @click="removeItem(index)" class="absolute -right-1 -top-1 w-5 h-5 bg-rose-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover/row:opacity-100 transition-opacity">
                                                        <i class="fas fa-times text-[8px]"></i>
                                                    </button>
                                                    <div class="grid grid-cols-2 gap-2">
                                                        <template x-for="val in Object.keys(item)" :key="val">
                                                            <div>
                                                                <label class="text-[8px] font-black text-slate-300 uppercase block mb-0.5" x-text="val"></label>
                                                                <input type="text" x-model="items[index][val]" @input="$dispatch('change')"
                                                                       class="w-full px-2 py-1 bg-slate-50 border border-slate-100 rounded text-[10px] focus:bg-white focus:border-sky-500 outline-none transition-all">
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                        <div x-show="mode === 'raw'" class="bg-slate-900">
                                            <textarea x-model="raw" @input="syncRaw(); $dispatch('change')" rows="6"
                                                      class="w-full bg-transparent border-none text-sky-400 font-mono text-[10px] focus:ring-0 resize-none leading-relaxed p-3 custom-scrollbar"></textarea>
                                        </div>
                                        <input type="hidden" name="cms[<?= esc($content['key']) ?>]" :value="JSON.stringify(items)">
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Empty State -->
                <div x-show="!hasVisibleCards"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     class="flex flex-col items-center justify-center py-20 text-slate-400">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4 text-slate-300">
                        <i class="fas fa-filter text-2xl"></i>
                    </div>
                    <p class="font-bold text-slate-500 mb-1">Tidak ada konten ditemukan</p>
                    <p class="text-xs text-center max-w-xs">
                        Tidak ada item yang cocok dengan filter aktif.
                        <template x-if="search !== ''">
                            <span> Coba hapus kata kunci "<span class="font-mono text-sky-500" x-text="search"></span>".</span>
                        </template>
                        <template x-if="activeGroup !== 'all'">
                            <span> Atau pilih bagian lain.</span>
                        </template>
                    </p>
                    <div class="flex gap-2 mt-4">
                        <button type="button" x-show="search !== ''" @click="search = ''"
                                class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-xs font-bold transition-all">
                            <i class="fas fa-times mr-1"></i> Reset Pencarian
                        </button>
                        <button type="button" x-show="activeGroup !== 'all'" @click="activeGroup = 'all'"
                                class="px-4 py-2 rounded-xl bg-sky-100 hover:bg-sky-200 text-sky-700 text-xs font-bold transition-all">
                            <i class="fas fa-layer-group mr-1"></i> Tampilkan Semua Bagian
                        </button>
                    </div>
                </div>

                <!-- Sticky Save Bar -->
                <div x-show="dirty"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="translate-y-full opacity-0"
                     x-transition:enter-end="translate-y-0 opacity-100"
                     class="fixed bottom-10 left-1/2 -translate-x-1/2 z-50 w-full max-w-2xl px-4">
                    <div class="bg-slate-900/95 backdrop-blur-2xl text-white px-8 py-5 rounded-3xl shadow-2xl flex items-center justify-between border border-white/10 ring-1 ring-black/50">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-yellow-400 flex items-center justify-center text-slate-900 shadow-lg shadow-yellow-400/20 animate-pulse">
                                <i class="fas fa-cloud-arrow-up text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold leading-none mb-1.5">Draft Perubahan Aktif</p>
                                <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black opacity-80">Klik simpan untuk mempublikasikan</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <button type="button" @click="window.location.reload()"
                                    class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-400 hover:text-white hover:bg-white/5 transition-all">Batalkan</button>
                            <button type="submit"
                                    class="bg-sky-500 hover:bg-sky-400 px-8 py-2.5 rounded-xl text-xs font-black shadow-xl shadow-sky-500/30 transition-all active:scale-95 flex items-center gap-2">
                                <i class="fas fa-check-circle"></i>
                                SIMPAN SEKARANG
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right: Live Preview -->
        <div x-show="showPreview"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 translate-x-20 scale-95"
             x-transition:enter-end="opacity-100 translate-x-0 scale-100"
             class="flex-1 bg-white rounded-[2.5rem] border-8 border-slate-800 overflow-hidden shadow-2xl flex flex-col relative group/preview transition-all duration-500 ring-1 ring-slate-200">

            <!-- Browser Top Bar Decor -->
            <div class="bg-slate-800 px-6 py-3 border-b border-slate-700 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-6">
                    <div class="flex gap-2">
                        <div class="w-3 h-3 rounded-full bg-rose-500/80 shadow-inner"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-500/80 shadow-inner"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-500/80 shadow-inner"></div>
                    </div>
                    <div class="bg-slate-900/50 px-4 py-1.5 rounded-full border border-slate-700 flex items-center gap-3 min-w-[300px]">
                        <i class="fas fa-lock text-[10px] text-emerald-500"></i>
                        <span class="text-[10px] font-mono text-slate-400 truncate" x-text="previewUrl"></span>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button @click="$refs.previewFrame.contentWindow.location.reload()"
                            class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-700 hover:text-white transition-all">
                        <i class="fas fa-rotate-right text-xs"></i>
                    </button>
                    <a :href="previewUrl" target="_blank"
                       class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-700 hover:text-white transition-all">
                        <i class="fas fa-external-link-alt text-xs"></i>
                    </a>
                </div>
            </div>

            <div class="flex-1 relative bg-slate-50 overflow-hidden">
                <!-- Status Banner -->
                <div class="absolute top-6 left-1/2 -translate-x-1/2 z-20 px-5 py-2.5 bg-slate-900/90 backdrop-blur-xl text-white text-[10px] font-black rounded-full border border-white/10 shadow-2xl pointer-events-none opacity-0 group-hover/preview:opacity-100 translate-y-4 group-hover/preview:translate-y-0 transition-all uppercase tracking-[0.2em] flex items-center gap-3">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-sky-500"></span>
                    </span>
                    Live Preview Mode
                </div>

                <iframe x-ref="previewFrame"
                        src="<?= base_url() ?>"
                        @load="updateAddressBar()"
                        class="w-full h-full border-0 bg-white"
                        id="cms-preview-frame"></iframe>
            </div>
        </div>

    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 20px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
</style>

<?= $this->endSection() ?>