<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div x-data="{ showPreview: true, previewUrl: '<?= base_url('galeri') ?>' }" class="flex flex-col h-[calc(100vh-140px)]">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-8 shrink-0 px-2">
        <div class="flex items-center gap-4">
            <a href="<?= base_url('admin/gallery') ?>" class="w-12 h-12 rounded-2xl bg-white border border-slate-100 text-slate-400 flex items-center justify-center hover:text-emerald-600 hover:border-emerald-100 transition-all shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="font-display text-3xl font-black text-slate-800 tracking-tight leading-none mb-1">Edit Dokumentasi</h1>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest opacity-70">Visual Content Editor</p>
            </div>
        </div>
        <button @click="showPreview = !showPreview"
                class="p-3.5 rounded-2xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition-all shadow-sm"
                :class="showPreview ? 'text-emerald-600 border-emerald-100 bg-emerald-50 ring-4 ring-emerald-500/5' : ''">
            <i class="fas" :class="showPreview ? 'fa-eye-slash' : 'fa-eye'"></i>
        </button>
    </div>

    <!-- Content Area -->
    <div class="flex-1 flex gap-8 min-h-0 overflow-hidden">
        
        <!-- Form Area -->
        <div :class="showPreview ? 'w-1/2' : 'w-full'" class="overflow-y-auto pr-4 custom-scrollbar transition-all duration-700">
            <form action="<?= base_url('admin/gallery/update/' . $gallery['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-6 pb-32">
                <?= csrf_field() ?>

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Judul Dokumentasi</label>
                            <input type="text" name="title" value="<?= old('title', $gallery['title']) ?>" 
                                   class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-8 focus:ring-emerald-500/5 transition-all font-bold text-slate-700">
                            <?php if (isset(session('errors')['title'])) : ?>
                                <p class="text-rose-500 text-[10px] mt-2 font-black uppercase tracking-wider ml-1"><?= session('errors')['title'] ?></p>
                            <?php endif; ?>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Deskripsi Singkat</label>
                            <textarea name="description" rows="4" 
                                      class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-8 focus:ring-emerald-500/5 transition-all font-medium text-slate-600"><?= old('description', $gallery['description']) ?></textarea>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Kategori</label>
                                <select name="category" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-8 focus:ring-emerald-500/5 transition-all font-bold text-slate-700 appearance-none">
                                    <?php foreach ($categories as $cat) : ?>
                                        <option value="<?= $cat ?>" <?= old('category', $gallery['category']) == $cat ? 'selected' : '' ?>><?= $cat ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Urutan</label>
                                <input type="number" name="sort_order" value="<?= old('sort_order', $gallery['sort_order']) ?>" 
                                       class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-8 focus:ring-emerald-500/5 transition-all font-bold text-slate-700">
                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    $isExternal = filter_var($gallery['image_url'], FILTER_VALIDATE_URL);
                    $sourceType = $isExternal ? 'link' : 'upload';
                ?>
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm" x-data="{ sourceType: '<?= $sourceType ?>' }">
                    <div class="flex items-center justify-between mb-6 ml-1">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Sumber Visual</label>
                        <div class="flex bg-slate-100 p-1 rounded-xl">
                            <button type="button" @click="sourceType = 'upload'" 
                                    :class="sourceType === 'upload' ? 'bg-white text-emerald-600 shadow-sm' : 'text-slate-400'"
                                    class="px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Upload</button>
                            <button type="button" @click="sourceType = 'link'" 
                                    :class="sourceType === 'link' ? 'bg-white text-emerald-600 shadow-sm' : 'text-slate-400'"
                                    class="px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Link URL</button>
                        </div>
                    </div>

                    <input type="hidden" name="source_type" :value="sourceType">
                    
                    <!-- Upload Section -->
                    <div x-show="sourceType === 'upload'" x-transition:enter.duration.500ms x-data="{ photoPreview: '<?= !$isExternal ? base_url($gallery['image_url']) : '' ?>' }" class="space-y-4">
                        <input type="file" name="image" class="hidden" x-ref="photo"
                               @change="
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($event.target.files[0]);
                               ">

                        <div class="relative group">
                            <div class="aspect-video rounded-[2rem] overflow-hidden border border-slate-100 shadow-lg cursor-pointer" @click="$refs.photo.click()">
                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                </template>
                                <template x-if="!photoPreview">
                                    <div class="w-full h-full bg-slate-50 flex items-center justify-center text-slate-300">
                                        <i class="fas fa-image text-3xl"></i>
                                    </div>
                                </template>
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <div class="bg-white/20 backdrop-blur-xl px-6 py-3 rounded-2xl border border-white/30 text-white font-black text-xs uppercase tracking-widest">Ganti Foto</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Link Section -->
                    <div x-show="sourceType === 'link'" x-transition:enter.duration.500ms x-data="{ linkPreview: '<?= $isExternal ? $gallery['image_url'] : '' ?>' }" class="space-y-4">
                        <div class="relative group">
                            <i class="fas fa-link absolute left-5 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-emerald-500 transition-colors"></i>
                            <input type="url" name="external_url" x-model="linkPreview" placeholder="https://example.com/image.jpg"
                                   class="w-full pl-12 pr-6 py-4 rounded-2xl bg-slate-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-8 focus:ring-emerald-500/5 transition-all font-medium text-slate-600">
                        </div>
                        <template x-if="linkPreview">
                            <div class="aspect-video rounded-2xl overflow-hidden border border-slate-100 shadow-sm">
                                <img :src="linkPreview" class="w-full h-full object-cover" @error="$el.src='https://placehold.co/600x400?text=Invalid+Image+URL'">
                            </div>
                        </template>
                    </div>
                </div>

                <div class="bg-emerald-900/90 backdrop-blur-2xl p-8 rounded-[2.5rem] border border-white/10 flex items-center justify-between shadow-2xl shadow-emerald-900/20">
                    <div class="flex items-center gap-4">
                        <span class="text-xs font-black text-white uppercase tracking-widest">Status Terbit</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_published" value="1" <?= $gallery['is_published'] ? 'checked' : '' ?> class="sr-only peer">
                            <div class="w-14 h-7 bg-white/10 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                        </label>
                    </div>
                    <button type="submit" class="bg-white text-emerald-900 px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-50 transition-all active:scale-95 shadow-xl shadow-black/20 flex items-center gap-2">
                        <i class="fas fa-cloud-arrow-up"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>

        <!-- Preview Area -->
        <div x-show="showPreview"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 translate-x-40 scale-90"
             x-transition:enter-end="opacity-100 translate-x-0 scale-100"
             class="flex-1 bg-slate-900 rounded-[3rem] border-[12px] border-slate-900 overflow-hidden shadow-2xl flex flex-col relative transition-all duration-700">
            
            <div class="bg-slate-900 px-8 py-5 border-b border-slate-800 flex items-center justify-between">
                <div class="bg-black/40 px-6 py-2 rounded-2xl border border-slate-800 flex items-center gap-4 min-w-[250px]">
                    <i class="fas fa-lock text-[10px] text-emerald-500"></i>
                    <span class="text-[10px] font-mono text-slate-500 truncate" x-text="previewUrl"></span>
                </div>
                <button @click="$refs.previewFrame.contentWindow.location.reload()" class="text-slate-500 hover:text-white transition-colors">
                    <i class="fas fa-rotate-right text-xs"></i>
                </button>
            </div>
            
            <div class="flex-1 bg-white relative overflow-hidden">
                <div class="absolute top-8 left-1/2 -translate-x-1/2 z-20 px-6 py-2 bg-emerald-500 text-white text-[10px] font-black rounded-full shadow-xl uppercase tracking-widest">Live Preview</div>
                <iframe x-ref="previewFrame" :src="previewUrl" class="w-full h-full border-0"></iframe>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 50px; border: 2px solid transparent; background-clip: content-box; }
    .font-display { font-family: 'Outfit', 'Inter', sans-serif; }
</style>
<?= $this->endSection() ?>
