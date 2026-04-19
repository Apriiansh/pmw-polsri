<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 pb-20" x-data="{ 
    showAssignModal: false,
    assignData: {
        category_id: '',
        category_name: '',
        proposal_id: '',
        rank: 1,
        notes: ''
    },
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- ================================================================
         1. PAGE HEADER
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <a href="<?= base_url('admin/expo') ?>" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-sky-600 transition-colors">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard Expo
                </a>
            </div>
            <h2 class="section-title text-xl sm:text-2xl">
                Manajemen <span class="text-gradient">Pemenang Award</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Penetapan Juara dan Kategori Khusus PMW Polsri</p>
        </div>
    </div>

    <!-- ================================================================
         2. AWARDS CATEGORIES GRID
    ================================================================= -->
    <div class="grid lg:grid-cols-2 gap-8">
        <?php foreach ($categories as $index => $cat): ?>
            <div class="card-premium overflow-hidden flex flex-col group animate-stagger delay-<?= ($index + 1) * 100 ?>" 
                 @mousemove="handleMouseMove">
                
                <!-- Category Header -->
                <div class="px-6 py-5 border-b border-sky-50 bg-white/60 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white shadow-lg shadow-amber-100 group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-trophy text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-base font-black text-(--text-heading) uppercase tracking-tight leading-tight"><?= esc($cat->name) ?></h3>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-[9px] font-black text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-100 uppercase tracking-widest">
                                    Limit: <?= $cat->max_rank ?> Pemenang
                                </span>
                                <span class="w-1 h-1 rounded-full bg-slate-200"></span>
                                <span class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">
                                    <?= count($cat->winners) ?> Terisi
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php if (count($cat->winners) < $cat->max_rank): ?>
                        <button @click="assignData = { category_id: '<?= $cat->id ?>', category_name: '<?= esc($cat->name) ?>', proposal_id: '', rank: <?= count($cat->winners) + 1 ?>, notes: '' }; showAssignModal = true" 
                                class="w-10 h-10 rounded-full bg-sky-50 text-sky-600 hover:bg-sky-500 hover:text-white flex items-center justify-center shadow-sm transition-all duration-300">
                            <i class="fas fa-plus"></i>
                        </button>
                    <?php endif; ?>
                </div>

                <!-- Winners List -->
                <div class="p-6 space-y-4 flex-1">
                    <?php if (empty($cat->winners)): ?>
                        <div class="py-12 rounded-3xl bg-slate-50 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-300 transition-colors group-hover:border-amber-200 group-hover:bg-amber-50/30">
                            <i class="fas fa-award text-4xl mb-3 group-hover:text-amber-400 transition-colors"></i>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-amber-600">Belum Ada Pemenang</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php foreach ($cat->winners as $winner): ?>
                                <div class="relative flex items-center gap-4 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-md hover:border-sky-200 hover:bg-sky-50/20 transition-all duration-300 group/item">
                                    
                                    <!-- Rank Badge -->
                                    <?php 
                                        $rankColors = [
                                            1 => 'from-amber-400 to-yellow-600 shadow-amber-200',
                                            2 => 'from-slate-300 to-slate-500 shadow-slate-200',
                                            3 => 'from-orange-400 to-orange-700 shadow-orange-200'
                                        ];
                                        $bgRank = $rankColors[$winner->rank] ?? 'from-sky-400 to-blue-600 shadow-sky-200';
                                    ?>
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br <?= $bgRank ?> flex flex-col items-center justify-center text-white shadow-lg shrink-0 group-hover/item:scale-110 transition-transform">
                                        <span class="text-[9px] font-black uppercase leading-none opacity-80">Rank</span>
                                        <span class="text-xl font-display font-black leading-none mt-0.5"><?= $winner->rank ?></span>
                                    </div>

                                    <!-- Winner Info -->
                                    <div class="min-w-0 flex-1">
                                        <h4 class="text-[13px] font-black text-slate-700 truncate leading-tight"><?= esc($winner->nama_usaha) ?></h4>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5"><?= esc($winner->ketua_nama) ?></p>
                                        <?php if ($winner->notes): ?>
                                            <div class="flex items-start gap-1.5 mt-2 text-[10px] text-sky-600 font-medium italic leading-snug">
                                                <i class="fas fa-quote-left text-[8px] mt-1 opacity-50"></i>
                                                <span><?= esc($winner->notes) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center gap-1 opacity-0 group-hover/item:opacity-100 transition-all transform translate-x-2 group-hover/item:translate-x-0">
                                        <a href="<?= base_url('admin/awards/delete/' . $winner->id) ?>" 
                                           onclick="return confirm('Hapus penetapan pemenang ini?')" 
                                           class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all shadow-sm border border-rose-100">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Card Footer Info -->
                <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-50 flex items-center justify-between">
                    <div class="flex -space-x-2">
                        <?php foreach (array_slice($cat->winners, 0, 3) as $w): ?>
                            <div class="w-6 h-6 rounded-full border-2 border-white bg-sky-500 flex items-center justify-center text-[8px] text-white font-black">
                                <?= strtoupper(substr($w->nama_usaha, 0, 1)) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <span class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">
                        Standardized Award Card
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- ================================================================
         3. ASSIGN WINNER MODAL
    ================================================================= -->
    <div x-show="showAssignModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] hidden"
         :class="{ 'hidden': !showAssignModal }"
         aria-labelledby="assign-modal-title"
         role="dialog"
         aria-modal="true">

        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="showAssignModal = false"></div>

        <!-- Modal Panel -->
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl" @click.stop>

                    <!-- Modal Header -->
                    <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-display font-bold text-white" id="assign-modal-title">
                                <i class="fas fa-trophy mr-2"></i>Tetapkan Pemenang
                            </h3>
                            <button type="button" @click="showAssignModal = false" class="text-white/80 hover:text-white transition-colors">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <p class="text-[10px] text-white/80 font-black uppercase tracking-widest mt-1" x-text="assignData.category_name"></p>
                    </div>

                    <!-- Modal Body & Form -->
                    <form action="<?= base_url('admin/awards/assign') ?>" method="POST" class="space-y-0">
                        <?= csrf_field() ?>
                        <input type="hidden" name="category_id" x-model="assignData.category_id">

                        <div class="px-6 py-5 space-y-5">
                            <div class="grid sm:grid-cols-3 gap-4">
                                <div class="form-field sm:col-span-1">
                                    <label class="form-label !text-slate-700">Peringkat / Juara</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-sky-500 transition-colors">
                                            <i class="fas fa-medal text-sm"></i>
                                        </div>
                                        <input type="number" name="rank" x-model="assignData.rank" min="1" max="10" required
                                               class="form-input !pl-11 focus:ring-4 focus:ring-sky-500/10 transition-all border-slate-100 bg-slate-50/50">
                                    </div>
                                </div>

                                <div class="form-field sm:col-span-2">
                                    <label class="form-label !text-slate-700">Pilih Tim Pemenang</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-sky-500 transition-colors">
                                            <i class="fas fa-users text-sm"></i>
                                        </div>
                                        <select name="proposal_id" x-model="assignData.proposal_id" required
                                                class="form-input !pl-11 focus:ring-4 focus:ring-sky-500/10 transition-all border-slate-100 bg-slate-50/50 appearance-none">
                                            <option value="">-- Pilih Tim (Lolos Final) --</option>
                                            <?php foreach ($teams as $team): ?>
                                                <option value="<?= $team['id'] ?>"><?= esc($team['nama_usaha']) ?> (<?= esc($team['ketua_nama']) ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-400">
                                            <i class="fas fa-chevron-down text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-field">
                                <label class="form-label !text-slate-700">Catatan Juri / Alasan (Opsional)</label>
                                <textarea name="notes" x-model="assignData.notes" rows="3"
                                          class="form-input focus:ring-4 focus:ring-sky-500/10 transition-all border-slate-100 bg-slate-50/50 resize-none"
                                          placeholder="Berikan alasan mengapa tim ini layak menjadi pemenang..."></textarea>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-slate-50 px-6 py-4 flex gap-3 justify-end border-t border-slate-100">
                            <button type="button" @click="showAssignModal = false"
                                    class="btn-outline text-sm">
                                <i class="fas fa-times mr-2"></i>Batal
                            </button>
                            <button type="submit"
                                    class="btn-primary text-sm shadow-lg shadow-sky-500/20">
                                <i class="fas fa-save mr-2"></i>Simpan Penetapan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
