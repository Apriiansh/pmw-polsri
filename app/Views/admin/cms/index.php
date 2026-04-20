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
        groups_meta: <?= json_encode(array_map(function($items) {
            return array_map(fn($c) => [
                'label' => strtolower($c['label']),
                'key'   => strtolower($c['key']),
            ], $items);
        }, $groupedContents)) ?>
    };

    function cmsManager() {
        return {
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
                'pengumuman_hero':        'section-pengumuman-hero'
            },
            selectedPage: window.__cmsData.selectedPage,
            pages: <?= json_encode($pages ?? []) ?>,
            
            get filteredGroups() {
                if (this.selectedPage === 'all') return window.__cmsData.allGroups;
                let filtered = {};
                Object.keys(window.__cmsData.allGroups).forEach(key => {
                    if (key === this.selectedPage || key.startsWith(this.selectedPage + '_')) {
                        filtered[key] = window.__cmsData.allGroups[key];
                    }
                });
                return filtered;
            },

            isCardVisible(groupName) {
                const meta = window.__cmsData.groups_meta[groupName] || [];
                const pageMatch = this.selectedPage === 'all' || groupName === this.selectedPage || groupName.startsWith(this.selectedPage + '_');
                if (!pageMatch) return false;
                const sectionMatch = this.activeGroup === 'all' || groupName === this.activeGroup;
                if (!sectionMatch) return false;
                const q = this.search.toLowerCase();
                if (q === '') return true;
                return groupName.toLowerCase().includes(q) || meta.some(item => item.label.includes(q) || item.key.includes(q));
            },

            get hasVisibleCards() {
                return Object.keys(window.__cmsData.groups_meta).some(groupName => this.isCardVisible(groupName));
            },

            init() {
                this.$nextTick(() => {
                    this.updatePreviewPage();
                    if (this.activeGroup && this.activeGroup !== 'all') {
                        if (this.$refs.previewFrame) {
                            this.$refs.previewFrame.addEventListener('load', () => {
                                setTimeout(() => this.scrollToSection(this.activeGroup), 300);
                            }, { once: true });
                        }
                    }
                });
            },

            updatePreviewPage() {
                if (!this.$refs.previewFrame) return;
                const urls = window.__cmsData.urls;
                const map = {
                    home: urls.home, tahapan: urls.tahapan, tentang: urls.tentang, 
                    pengumuman: urls.pengumuman, all: urls.home, general: urls.home
                };
                const target = map[this.selectedPage] ?? urls.home;
                this.$refs.previewFrame.src = target;
                this.previewUrl = target;
            },

            updateAddressBar() {
                try { this.previewUrl = this.$refs.previewFrame.contentWindow.location.href; } catch (e) {}
            },

            changePage(page) {
                this.activeGroup = 'all';
                window.location.href = window.__cmsData.cmsUrl + '?group=all&page=' + page;
            },

            changeSection(group) {
                this.activeGroup = group;
                if (group !== 'all') this.scrollToSection(group);
            },

            scrollToSection(group) {
                const sectionId = this.groupMapping[group];
                if (sectionId && this.$refs.previewFrame) {
                    const urls = window.__cmsData.urls;
                    let targetPage = urls.home;
                    if (group.startsWith('tahapan_'))    targetPage = urls.tahapan;
                    else if (group.startsWith('tentang_'))    targetPage = urls.tentang;
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
        };
    }
</script>

<?php 
    $pages = [
        'all'        => ['label' => 'Semua Halaman',     'icon' => 'fa-layer-group'],
        'home'       => ['label' => 'Beranda (Home)',     'icon' => 'fa-home'],
        'tahapan'    => ['label' => 'Halaman Tahapan',    'icon' => 'fa-route'],
        'tentang'    => ['label' => 'Halaman Tentang',    'icon' => 'fa-info-circle'],
        'pengumuman' => ['label' => 'Halaman Pengumuman', 'icon' => 'fa-bullhorn'],
    ];
?>

<div x-data="cmsManager()" class="flex flex-col h-[calc(100vh-140px)]">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 shrink-0">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-[1.5rem] bg-gradient-to-br from-sky-500 to-indigo-600 flex items-center justify-center text-white shadow-xl shadow-sky-500/20 rotate-3">
                <i class="fas fa-sliders text-2xl"></i>
            </div>
            <div>
                <h1 class="font-display text-3xl font-black text-slate-800 tracking-tight leading-none mb-1">Manajemen Konten</h1>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest opacity-70">Visual CMS & Live Editor</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="relative group">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs transition-colors group-focus-within:text-sky-500"></i>
                <input type="text" x-model="search" placeholder="Cari elemen konten..."
                       class="pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-bold focus:ring-8 focus:ring-sky-500/5 focus:border-sky-500 outline-none w-72 transition-all shadow-sm">
            </div>
            <button @click="showPreview = !showPreview"
                    class="p-3.5 rounded-2xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition-all active:scale-95 shadow-sm"
                    :class="showPreview ? 'text-sky-600 border-sky-100 bg-sky-50 ring-4 ring-sky-500/5' : ''"
                    title="Toggle Preview">
                <i class="fas" :class="showPreview ? 'fa-eye-slash' : 'fa-eye'"></i>
            </button>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="flex flex-col md:flex-row gap-4 mb-8 shrink-0 bg-white/50 backdrop-blur-xl p-4 rounded-3xl border border-white shadow-sm">
        <!-- Select Halaman -->
        <div class="flex-1">
            <label class="text-[10px] font-black text-slate-400 uppercase mb-2 ml-1 block tracking-[0.2em]">Pilih Halaman Utama</label>
            <div class="relative group">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-focus-within:bg-sky-500 group-focus-within:text-white transition-all duration-500">
                    <i class="fas" :class="pages[selectedPage]?.icon || 'fa-file-lines'"></i>
                </div>
                <select x-model="selectedPage" @change="changePage($event.target.value)" 
                        class="w-full pl-14 pr-4 py-3.5 bg-white border border-slate-200 rounded-2xl text-sm font-black text-slate-700 focus:ring-8 focus:ring-sky-500/5 focus:border-sky-500 outline-none appearance-none transition-all cursor-pointer">
                    <?php foreach ($pages as $id => $info): ?>
                        <option value="<?= $id ?>" <?= $pageFilter === $id ? 'selected' : '' ?>><?= $info['label'] ?></option>
                    <?php endforeach; ?>
                </select>
                <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs"></i>
            </div>
        </div>

        <!-- Select Bagian -->
        <div class="flex-1">
            <label class="text-[10px] font-black text-slate-400 uppercase mb-2 ml-1 block tracking-[0.2em]">Navigasi Bagian (Section)</label>
            <div class="relative group">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-focus-within:bg-indigo-500 group-focus-within:text-white transition-all duration-500">
                    <i class="fas fa-puzzle-piece text-xs"></i>
                </div>
                <select x-model="activeGroup" @change="changeSection($event.target.value)" 
                        class="w-full pl-14 pr-4 py-3.5 bg-white border border-slate-200 rounded-2xl text-sm font-black text-slate-700 focus:ring-8 focus:ring-indigo-500/5 focus:border-indigo-500 outline-none appearance-none transition-all cursor-pointer">
                    <option value="all" <?= $activeGroup === 'all' ? 'selected' : '' ?>>Semua Bagian Halaman</option>
                    <template x-for="(label, id) in filteredGroups" :key="id">
                        <option :value="id" x-text="label" :selected="id === activeGroup"></option>
                    </template>
                </select>
                <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 pointer-events-none text-xs"></i>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="flex-1 flex gap-8 min-h-0 overflow-hidden">
        
        <!-- Sidebar Form -->
        <div :class="showPreview ? 'w-1/2' : 'w-full'" class="flex flex-col gap-4 overflow-y-auto pr-4 custom-scrollbar transition-all duration-700 ease-in-out">
            <form action="<?= base_url('admin/cms/save') ?>" method="POST" enctype="multipart/form-data" @input="dirty = true" class="space-y-4 pb-32">
                <?= csrf_field() ?>
                <input type="hidden" name="group" value="<?= esc($activeGroup) ?>">
                <input type="hidden" name="page" value="<?= esc($pageFilter) ?>">

                <?php 
                    $pagePartial = "admin/cms/partials/_page_{$pageFilter}";
                    // Cek apakah file view tersebut ada di direktori Views
                    if (is_file(APPPATH . 'Views/' . $pagePartial . '.php')) {
                        echo view($pagePartial, ['items' => $groupedContents, 'groups' => $groups]);
                    } else {
                        echo view('admin/cms/partials/_content_list', ['items' => $groupedContents, 'groups' => $groups]);
                    }
                ?>

                <!-- Empty State -->
                <div x-show="!hasVisibleCards" class="flex flex-col items-center justify-center py-32 bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                    <div class="w-24 h-24 rounded-full bg-slate-50 flex items-center justify-center mb-6 text-slate-200">
                        <i class="fas fa-filter text-4xl"></i>
                    </div>
                    <p class="font-black text-slate-800 text-lg mb-2">Konten Tidak Ditemukan</p>
                    <p class="text-sm text-slate-400 font-medium text-center max-w-xs">Coba hapus filter atau kata kunci pencarian Anda.</p>
                </div>

                <!-- Floating Save Bar -->
                <div x-show="dirty"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="translate-y-20 opacity-0"
                     x-transition:enter-end="translate-y-0 opacity-100"
                     class="fixed bottom-10 left-0 right-0 z-50 flex justify-center px-4 pointer-events-none">
                    <div class="bg-slate-900/90 backdrop-blur-3xl text-white px-10 py-6 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.3)] flex items-center gap-12 border border-white/10 pointer-events-auto ring-1 ring-black">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-yellow-400 flex items-center justify-center text-slate-900 shadow-xl shadow-yellow-400/20 animate-bounce">
                                <i class="fas fa-save text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-lg font-black leading-none mb-1">Simpan Perubahan?</p>
                                <p class="text-[10px] text-white/50 uppercase tracking-[0.2em] font-black">Anda memiliki perubahan belum tersimpan</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="button" @click="window.location.reload()"
                                    class="px-6 py-3 rounded-2xl text-xs font-black text-white/50 hover:text-white hover:bg-white/5 transition-all uppercase tracking-widest">Batalkan</button>
                            <button type="submit"
                                    class="bg-sky-500 hover:bg-sky-400 px-10 py-4 rounded-2xl text-xs font-black shadow-2xl shadow-sky-500/40 transition-all active:scale-95 flex items-center gap-3 uppercase tracking-widest">
                                <i class="fas fa-cloud-arrow-up"></i>
                                Publikasikan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Live Preview -->
        <div x-show="showPreview"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 translate-x-40 scale-90"
             x-transition:enter-end="opacity-100 translate-x-0 scale-100"
             class="flex-1 bg-slate-900 rounded-[3rem] border-[12px] border-slate-900 overflow-hidden shadow-[0_40px_100px_-20px_rgba(0,0,0,0.5)] flex flex-col relative group/preview transition-all duration-700">

            <div class="bg-slate-900 px-8 py-5 border-b border-slate-800 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-8">
                    <div class="flex gap-2.5">
                        <div class="w-3.5 h-3.5 rounded-full bg-rose-500/40 border border-rose-500/20 shadow-lg"></div>
                        <div class="w-3.5 h-3.5 rounded-full bg-amber-500/40 border border-amber-500/20 shadow-lg"></div>
                        <div class="w-3.5 h-3.5 rounded-full bg-emerald-500/40 border border-emerald-500/20 shadow-lg"></div>
                    </div>
                    <div class="bg-black/40 px-6 py-2 rounded-2xl border border-slate-800 flex items-center gap-4 min-w-[350px] group-hover/preview:border-sky-500/30 transition-colors duration-500">
                        <i class="fas fa-lock text-[10px] text-emerald-500"></i>
                        <span class="text-[10px] font-mono text-slate-500 truncate select-none" x-text="previewUrl"></span>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button @click="$refs.previewFrame.contentWindow.location.reload()"
                            class="w-10 h-10 rounded-xl flex items-center justify-center text-slate-500 hover:bg-slate-800 hover:text-white transition-all active:rotate-180 duration-500">
                        <i class="fas fa-rotate-right text-xs"></i>
                    </button>
                    <a :href="previewUrl" target="_blank"
                       class="w-10 h-10 rounded-xl bg-sky-500/10 text-sky-400 hover:bg-sky-500 hover:text-white transition-all shadow-lg shadow-sky-500/10 flex items-center justify-center">
                        <i class="fas fa-external-link-alt text-xs"></i>
                    </a>
                </div>
            </div>

            <div class="flex-1 relative bg-white overflow-hidden">
                <div class="absolute inset-0 pointer-events-none border-t border-slate-100 z-10 shadow-[inset_0_20px_40px_rgba(0,0,0,0.02)]"></div>
                
                <div class="absolute top-8 left-1/2 -translate-x-1/2 z-20 px-6 py-3 bg-slate-900/90 backdrop-blur-2xl text-white text-[10px] font-black rounded-full border border-white/10 shadow-2xl pointer-events-none opacity-0 group-hover/preview:opacity-100 translate-y-8 group-hover/preview:translate-y-0 transition-all uppercase tracking-[0.3em] flex items-center gap-4">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-sky-500 shadow-lg shadow-sky-500/50"></span>
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
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 50px; border: 2px solid transparent; background-clip: content-box; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; border: 2px solid transparent; background-clip: content-box; }
    
    [x-cloak] { display: none !important; }
    
    .font-display { font-family: 'Outfit', 'Inter', sans-serif; }
    
    /* Animation smoothing */
    .transition-all { transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); }
</style>

<?= $this->endSection() ?>