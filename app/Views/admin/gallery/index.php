<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<script>
    function galleryManager() {
        return {
            search: '',
            showPreview: true,
            previewUrl: '<?= base_url('galeri') ?>',
            activeCategory: '<?= $category ?>',
            
            init() {
                // Scroll to gallery section if needed
            },

            confirmDelete(id) {
                Swal.fire({
                    title: 'Hapus foto ini?',
                    text: "Foto akan dihapus permanen dari galeri publik.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-[2rem]',
                        confirmButton: 'rounded-xl px-6 py-3 font-bold',
                        cancelButton: 'rounded-xl px-6 py-3 font-bold'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= base_url('admin/gallery/delete') ?>/' + id;
                    }
                })
            },

            filterCategory(cat) {
                window.location.href = '<?= base_url('admin/gallery') ?>?category=' + cat;
            }
        };
    }
</script>

<div x-data="galleryManager()" class="flex flex-col h-[calc(100vh-140px)]">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 shrink-0">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-[1.5rem] bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white shadow-xl shadow-emerald-500/20 rotate-3">
                <i class="fas fa-images text-2xl"></i>
            </div>
            <div>
                <h1 class="font-display text-3xl font-black text-slate-800 tracking-tight leading-none mb-1">Manajemen Galeri</h1>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest opacity-70">Visual Gallery Editor</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="relative group">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs transition-colors group-focus-within:text-emerald-500"></i>
                <input type="text" x-model="search" placeholder="Cari di galeri..."
                       class="pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-bold focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-500 outline-none w-64 transition-all shadow-sm">
            </div>
            <a href="<?= base_url('admin/gallery/create') ?>" 
               class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3.5 rounded-2xl font-bold transition-all flex items-center shadow-lg shadow-emerald-200 active:scale-95">
                <i class="fas fa-plus mr-2"></i> Tambah Foto
            </a>
            <button @click="showPreview = !showPreview"
                    class="p-3.5 rounded-2xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition-all active:scale-95 shadow-sm"
                    :class="showPreview ? 'text-emerald-600 border-emerald-100 bg-emerald-50 ring-4 ring-emerald-500/5' : ''"
                    title="Toggle Preview">
                <i class="fas" :class="showPreview ? 'fa-eye-slash' : 'fa-eye'"></i>
            </button>
        </div>
    </div>

    <!-- Category Filter Bar -->
    <div class="flex items-center gap-2 mb-8 overflow-x-auto pb-2 shrink-0 no-scrollbar">
        <button @click="filterCategory('all')"
                :class="activeCategory === 'all' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-white text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 border border-slate-100'"
                class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all">Semua</button>
        <?php foreach ($categories as $cat): ?>
            <button @click="filterCategory('<?= $cat ?>')"
                    :class="activeCategory === '<?= $cat ?>' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'bg-white text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 border border-slate-100'"
                    class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap"><?= $cat ?></button>
        <?php endforeach; ?>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl mb-6 flex items-center animate-fade-in shrink-0">
            <i class="fas fa-check-circle mr-3 text-xl"></i>
            <span class="font-bold text-sm"><?= session()->getFlashdata('success') ?></span>
        </div>
    <?php endif; ?>

    <!-- Content Area -->
    <div class="flex-1 flex gap-8 min-h-0 overflow-hidden">
        
        <!-- Sidebar List -->
        <div :class="showPreview ? 'w-1/2' : 'w-full'" class="flex flex-col gap-4 overflow-y-auto pr-4 custom-scrollbar transition-all duration-700 ease-in-out">
            <div class="grid <?= $category === 'all' ? 'grid-cols-1 xl:grid-cols-2' : 'grid-cols-1' ?> gap-6 pb-32">
                <?php foreach ($galleries as $item) : ?>
                    <div x-show="search === '' || '<?= strtolower(esc($item['title'], 'js')) ?>'.includes(search.toLowerCase())"
                         x-transition.fade.duration.500ms
                         class="group bg-white rounded-[2.5rem] p-6 border border-slate-100 hover:border-emerald-200 hover:shadow-2xl hover:shadow-emerald-500/10 transition-all duration-500 relative overflow-hidden">
                        
                        <div class="flex gap-6">
                            <!-- Image Preview -->
                            <?php 
                                $imgSrc = (filter_var($item['image_url'], FILTER_VALIDATE_URL)) 
                                          ? $item['image_url'] 
                                          : base_url($item['image_url']);
                            ?>
                            <div class="w-32 h-32 rounded-[2rem] overflow-hidden shrink-0 border border-slate-50">
                                <img src="<?= $imgSrc ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>

                            <!-- Info -->
                            <div class="flex-1 flex flex-col justify-between py-1">
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest border border-emerald-100"><?= $item['category'] ?></span>
                                        <?php if (!$item['is_published']): ?>
                                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-widest">Draft</span>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="font-display font-black text-slate-800 text-lg leading-tight group-hover:text-emerald-600 transition-colors"><?= esc($item['title']) ?></h3>
                                    <p class="text-xs text-slate-400 font-medium mt-1 line-clamp-2"><?= esc($item['description'] ?: 'Tidak ada deskripsi.') ?></p>
                                </div>
                                
                                <div class="flex items-center justify-between mt-4">
                                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest"><i class="far fa-calendar-alt mr-1"></i> <?= date('d M Y', strtotime($item['created_at'])) ?></span>
                                    <div class="flex items-center gap-2">
                                        <a href="<?= base_url('admin/gallery/edit/' . $item['id']) ?>" 
                                           class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 hover:bg-emerald-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="fas fa-pencil-alt text-xs"></i>
                                        </a>
                                        <button @click="confirmDelete(<?= $item['id'] ?>)" 
                                                class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if (empty($galleries)) : ?>
                    <div class="col-span-full py-32 bg-white rounded-[3rem] border-2 border-dashed border-slate-100 flex flex-col items-center justify-center">
                        <div class="w-24 h-24 rounded-full bg-slate-50 flex items-center justify-center mb-6 text-slate-200">
                            <i class="fas fa-images text-4xl"></i>
                        </div>
                        <p class="font-black text-slate-800 text-lg mb-2">Galeri Masih Kosong</p>
                        <p class="text-sm text-slate-400 font-medium text-center max-w-xs mb-8">Belum ada dokumentasi untuk kategori ini.</p>
                        <a href="<?= base_url('admin/gallery/create') ?>" class="btn-primary">Mulai Tambahkan Foto</a>
                    </div>
                <?php endif; ?>
            </div>
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
                    <div class="bg-black/40 px-6 py-2 rounded-2xl border border-slate-800 flex items-center gap-4 min-w-[300px] group-hover/preview:border-emerald-500/30 transition-colors duration-500">
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
                       class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500 hover:text-white transition-all shadow-lg shadow-emerald-500/10 flex items-center justify-center">
                        <i class="fas fa-external-link-alt text-xs"></i>
                    </a>
                </div>
            </div>

            <div class="flex-1 relative bg-white overflow-hidden">
                <div class="absolute inset-0 pointer-events-none border-t border-slate-100 z-10 shadow-[inset_0_20px_40px_rgba(0,0,0,0.02)]"></div>
                
                <div class="absolute top-8 left-1/2 -translate-x-1/2 z-20 px-6 py-3 bg-slate-900/90 backdrop-blur-2xl text-white text-[10px] font-black rounded-full border border-white/10 shadow-2xl pointer-events-none opacity-0 group-hover/preview:opacity-100 translate-y-8 group-hover/preview:translate-y-0 transition-all uppercase tracking-[0.3em] flex items-center gap-4">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500 shadow-lg shadow-emerald-500/50"></span>
                    </span>
                    Live Gallery Preview
                </div>

                <iframe x-ref="previewFrame"
                        :src="previewUrl"
                        class="w-full h-full border-0 bg-white"
                        id="gallery-preview-frame"></iframe>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 50px; border: 2px solid transparent; background-clip: content-box; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; border: 2px solid transparent; background-clip: content-box; }
    
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    [x-cloak] { display: none !important; }
    
    .font-display { font-family: 'Outfit', 'Inter', sans-serif; }
    .transition-all { transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); }
    
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.5s ease forwards; }
</style>

<?= $this->endSection() ?>
