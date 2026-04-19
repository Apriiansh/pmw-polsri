<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 pb-20 animate-stagger" x-data="{ 
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

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
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

    <!-- Awards Grid -->
    <div class="grid lg:grid-cols-2 gap-8">
        <?php foreach ($categories as $index => $cat): ?>
            <div class="card-premium p-6 flex flex-col group animate-stagger delay-<?= ($index + 1) * 100 ?>" @mousemove="handleMouseMove">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500 border border-amber-100 group-hover:bg-amber-500 group-hover:text-white transition-all duration-500">
                            <i class="fas fa-trophy text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-display text-base font-black text-(--text-heading) uppercase tracking-tight"><?= esc($cat->name) ?></h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Maksimal Juara: <?= $cat->max_rank ?></p>
                        </div>
                    </div>
                    <?php if (count($cat->winners) < $cat->max_rank): ?>
                        <button @click="assignData = { category_id: '<?= $cat->id ?>', category_name: '<?= esc($cat->name) ?>', proposal_id: '', rank: <?= count($cat->winners) + 1 ?>, notes: '' }; showAssignModal = true" 
                            class="btn-primary py-1.5 px-3 text-[10px] shadow-lg shadow-sky-500/10">
                            <i class="fas fa-plus mr-1.5"></i> Tambah Pemenang
                        </button>
                    <?php endif; ?>
                </div>

                <div class="space-y-3 flex-1">
                    <?php if (empty($cat->winners)): ?>
                        <div class="h-32 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-300">
                            <i class="fas fa-award text-2xl mb-2"></i>
                            <p class="text-[10px] font-black uppercase tracking-widest">Belum Ada Pemenang</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($cat->winners as $winner): ?>
                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-white border border-slate-100 shadow-sm hover:shadow-md hover:border-sky-200 transition-all duration-300 group/item">
                                <div class="w-10 h-10 rounded-xl <?= $winner->rank == 1 ? 'bg-amber-100 text-amber-600' : ($winner->rank == 2 ? 'bg-slate-100 text-slate-500' : 'bg-orange-100 text-orange-600') ?> flex items-center justify-center font-display font-black text-lg shrink-0 shadow-inner">
                                    <?= $winner->rank ?>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-xs font-black text-slate-700 truncate"><?= esc($winner->nama_usaha) ?></h4>
                                    <p class="text-[10px] text-slate-400 truncate"><?= esc($winner->ketua_nama) ?></p>
                                    <?php if ($winner->notes): ?>
                                        <p class="text-[9px] text-sky-500 italic mt-0.5 truncate">"<?= esc($winner->notes) ?>"</p>
                                    <?php endif; ?>
                                </div>
                                <div class="flex items-center gap-1 opacity-0 group-hover/item:opacity-100 transition-opacity">
                                    <a href="<?= base_url('admin/awards/delete/' . $winner->id) ?>" onclick="return confirm('Hapus pemenang ini?')" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-500 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-trash-alt text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Assign Winner Modal -->
    <div x-show="showAssignModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" style="display: none;">
        <div class="card-premium w-full max-w-lg bg-white shadow-2xl animate-modal" @click.away="showAssignModal = false">
            <div class="p-6 border-b border-sky-50 flex justify-between items-center bg-sky-50/30">
                <div class="flex flex-col">
                    <h3 class="font-display text-lg font-black text-sky-900 uppercase tracking-tight">Tetapkan Pemenang</h3>
                    <p class="text-[10px] text-sky-600 font-bold" x-text="assignData.category_name"></p>
                </div>
                <button @click="showAssignModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form action="<?= base_url('admin/awards/assign') ?>" method="POST" class="p-6 space-y-4">
                <?= csrf_field() ?>
                <input type="hidden" name="category_id" x-model="assignData.category_id">
                
                <div class="form-field">
                    <label class="form-label">Peringkat / Juara</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-medal"></i></span>
                        <input type="number" name="rank" x-model="assignData.rank" min="1" max="10" required>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1 italic">* Peringkat 1 = Juara 1, dst.</p>
                </div>

                <div class="form-field">
                    <label class="form-label">Pilih Tim (Lolos Tahap II)</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fas fa-users"></i></span>
                        <select name="proposal_id" x-model="assignData.proposal_id" required class="searchable-select">
                            <option value="">-- Pilih Tim Pemenang --</option>
                            <?php foreach ($teams as $team): ?>
                                <option value="<?= $team['id'] ?>"><?= esc($team['nama_usaha']) ?> (<?= esc($team['ketua_nama']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-field">
                    <label class="form-label">Catatan Juri (Opsional)</label>
                    <textarea name="notes" x-model="assignData.notes" rows="2" class="form-textarea" placeholder="Contoh: Sangat inovatif dan prospek pasar luas"></textarea>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" @click="showAssignModal = false" class="btn-outline flex-1">Batal</button>
                    <button type="submit" class="btn-primary flex-1">Simpan Penetapan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
