<?php

/**
 * @var array|null $proposal
 * @var array|null $activePeriod
 * @var \App\Entities\PmwImplementationItem[] $items
 * @var \App\Entities\PmwImplementationPayment[] $payments
 * @var \App\Entities\PmwImplementationKonsumsi[] $konsumsi
 */
?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="implementasiMahasiswa()">

    <!-- ─── PAGE HEADER ────────────────────────────────────────────── -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Implementasi <span class="text-gradient">Perjanjian</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Dokumentasi Komponen & Bukti Pembayaran</p>
        </div>
        <?php if ($selection && $selection->admin_status === 'revision' && $canEdit): ?>
            <button @click="resetAll()" class="btn-outline btn-sm bg-rose-50 text-rose-700 border-rose-200 hover:bg-rose-500 hover:text-white group">
                <i class="fas fa-trash-can mr-2 group-hover:rotate-12 transition-transform"></i>Reset Semua Data
            </button>
        <?php endif; ?>
    </div>

    <!-- ─── STATUS CARDS ───────────────────────────────────────────── -->
    <?php
        $selectionStatus = $selection ? $selection->admin_status : 'pending';
        $dosenStatus     = $selection ? ($selection->dosen_status ?? 'pending') : 'pending';
        $isSubmitted     = $selection && !empty($selection->student_submitted_at);
    ?>
    <div class="grid md:grid-cols-4 gap-5 animate-stagger delay-100">
        <div class="card-premium p-5 flex flex-col justify-between" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Periode Aktif</p>
            <p class="text-base font-bold text-slate-800 mt-1">
                <?= $activePeriod ? esc($activePeriod['name']) . ' ' . esc($activePeriod['year']) : '-' ?>
            </p>
            <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
                <p class="text-[11px] font-bold text-slate-500 italic">Tahapan Program</p>
                <span class="px-2 py-0.5 rounded bg-sky-50 text-sky-600 text-[10px] font-black">TAHAP 7</span>
            </div>
        </div>

        <div class="card-premium p-5 border-l-4 <?= $isPhaseOpen ? 'border-l-emerald-500' : 'border-l-rose-500' ?>" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Jadwal Implementasi</p>
            <p class="text-sm font-bold text-slate-800 mt-1">
                <?= $phase ? (formatIndonesianDate($phase['start_date']) . ' — ' . formatIndonesianDate($phase['end_date'])) : 'Belum dijadwalkan' ?>
            </p>
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-black mt-3 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700" : "bg-rose-50 text-rose-700" ?>">
                <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?> animate-pulse-soft"></i>
                <?= $isPhaseOpen ? 'SISTEM TERBUKA' : 'SISTEM TERKUNCI' ?>
            </span>
        </div>

        <?php
            $dosenBorder = match($dosenStatus) { 'approved' => 'border-l-emerald-500', 'rejected', 'revision' => 'border-l-orange-500', default => 'border-l-amber-400' };
            $dosenIcon   = match($dosenStatus) { 'approved' => 'fa-circle-check text-emerald-500', 'rejected' => 'fa-circle-xmark text-rose-500', 'revision' => 'fa-circle-exclamation text-orange-500', default => 'fa-clock text-amber-400' };
            $dosenLabel  = match($dosenStatus) { 'approved' => 'Disetujui', 'rejected' => 'Ditolak', 'revision' => 'Perlu Revisi', default => ($isSubmitted ? 'Menunggu Review' : 'Belum Dikirim') };
        ?>
        <div class="card-premium p-5 border-l-4 <?= $dosenBorder ?>" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Dosen Pendamping</p>
            <div class="flex items-center gap-2 mt-1">
                <i class="fas <?= $dosenIcon ?>"></i>
                <p class="text-sm font-bold text-slate-800 uppercase"><?= $dosenLabel ?></p>
            </div>
            <?php if ($selection && $selection->dosen_catatan): ?>
                <div class="mt-2 p-2 rounded-lg bg-amber-50 border border-amber-100">
                    <p class="text-[10px] text-amber-600 italic">"<?= esc($selection->dosen_catatan) ?>"</p>
                </div>
            <?php endif; ?>
        </div>

        <?php
            $adminBorder = match($selectionStatus) { 'approved' => 'border-l-emerald-500', 'rejected' => 'border-l-rose-500', 'revision' => 'border-l-orange-500', default => 'border-l-slate-300' };
            $adminIcon   = match($selectionStatus) { 'approved' => 'fa-circle-check text-emerald-500', 'rejected' => 'fa-circle-xmark text-rose-500', 'revision' => 'fa-circle-exclamation text-orange-500', default => 'fa-clock text-slate-400' };
            $adminLabel  = match($selectionStatus) { 'approved' => 'Disetujui', 'rejected' => 'Ditolak', 'revision' => 'Perlu Revisi', default => ($dosenStatus === 'approved' ? 'Menunggu Admin' : 'Menunggu Dosen') };
        ?>
        <div class="card-premium p-5 border-l-4 <?= $adminBorder ?>" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Admin UPAPKK</p>
            <div class="flex items-center gap-2 mt-1">
                <i class="fas <?= $adminIcon ?>"></i>
                <p class="text-sm font-bold text-slate-800 uppercase"><?= $adminLabel ?></p>
            </div>
            <?php if ($selection && $selection->admin_catatan): ?>
                <div class="mt-2 p-2 rounded-lg bg-rose-50 border border-rose-100">
                    <p class="text-[10px] text-rose-600 italic">"<?= esc($selection->admin_catatan) ?>"</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ─── SUMMARY STATS ──────────────────────────────────────────── -->
    <div class="grid md:grid-cols-3 gap-6 animate-stagger delay-150">
        <div class="card-premium p-5 flex items-center justify-between group overflow-hidden" @mousemove="handleMouseMove">
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Komponen</p>
                <?php
                    $totalQty = array_reduce($items, function($carry, $item) {
                        return $carry + (is_object($item) ? $item->qty : ($item['qty'] ?? 1));
                    }, 0);
                ?>
                <p class="text-2xl font-bold text-sky-600 mt-1"><?= $totalQty ?> <span class="text-xs text-slate-400 font-normal">item belanja</span></p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-sky-50 flex items-center justify-center group-hover:bg-sky-100 transition-colors duration-500">
                <i class="fas fa-cubes-stacked text-sky-500 text-2xl group-hover:scale-110 transition-transform"></i>
            </div>
        </div>
        <div class="card-premium p-5 flex items-center justify-between group overflow-hidden" @mousemove="handleMouseMove">
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total RAB</p>
                <p class="text-2xl font-bold text-violet-600 mt-1">Rp <?= number_format($proposal['total_rab'] ?? 0, 0, ',', '.') ?></p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-violet-50 flex items-center justify-center group-hover:bg-violet-100 transition-colors duration-500">
                <i class="fas fa-wallet text-violet-500 text-2xl group-hover:scale-110 transition-transform"></i>
            </div>
        </div>
        <div class="card-premium p-5 flex items-center justify-between group overflow-hidden" @mousemove="handleMouseMove">
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Akumulasi Harga</p>
                <p class="text-2xl font-bold text-emerald-600 mt-1">Rp <?= number_format($totalPrice, 0, ',', '.') ?></p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition-colors duration-500">
                <i class="fas fa-receipt text-emerald-500 text-2xl group-hover:scale-110 transition-transform"></i>
            </div>
        </div>
    </div>

    <!-- ─── STICKY ACTION BAR ────────────────────────────────────────── -->
    <?php if ($isPhaseOpen): ?>
    <div class="sticky top-4 z-20 bg-white/80 backdrop-blur-xl shadow-2xl shadow-sky-500/10 border border-white/40 rounded-3xl p-4 animate-stagger delay-150 flex items-center justify-between gap-4 flex-wrap ring-1 ring-slate-900/5">

        <!-- Left: Status info -->
        <div class="flex items-center gap-4 min-w-0">
            <?php if ($selectionStatus === 'approved'): ?>
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center shrink-0 border border-emerald-200">
                    <i class="fas fa-check-double text-emerald-600 text-lg"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 leading-none">Status Implementasi</p>
                    <p class="text-sm font-black text-emerald-700 mt-1">Selesai & Disetujui ✓</p>
                </div>
            <?php elseif ($isSubmitted && $dosenStatus === 'pending'): ?>
                <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center shrink-0 border border-amber-200">
                    <i class="fas fa-paper-plane text-amber-600 text-lg animate-bounce-soft"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 leading-none">Status Implementasi</p>
                    <p class="text-sm font-black text-amber-700 mt-1">Sedang Diverifikasi</p>
                    <p class="text-[9px] text-amber-500 font-bold bg-amber-50 px-2 py-0.5 rounded-full inline-block mt-0.5">
                        <i class="fas fa-clock mr-1"></i><?= $selection->student_submitted_at ? date('d M Y H:i', strtotime($selection->student_submitted_at)) : '-' ?>
                    </p>
                </div>
            <?php elseif ($isSubmitted && $dosenStatus === 'approved' && $selectionStatus === 'pending'): ?>
                <div class="w-12 h-12 rounded-2xl bg-sky-100 flex items-center justify-center shrink-0 border border-sky-200">
                    <i class="fas fa-building-circle-check text-sky-600 text-lg animate-pulse-soft"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 leading-none">Status Implementasi</p>
                    <p class="text-sm font-black text-sky-700 mt-1">Dosen ✓ · Menunggu Admin</p>
                </div>
            <?php elseif ($canEdit): ?>
                <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center shrink-0 border border-slate-200">
                    <i class="fas fa-file-signature text-slate-500 text-lg"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 leading-none">Status Implementasi</p>
                    <p class="text-sm font-black text-slate-700 mt-1">
                        <?= $isSubmitted ? 'Perlu Revisi Data' : 'Draf Laporan Belum Dikirim' ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right: Action button -->
        <div class="flex items-center gap-3 shrink-0">
            <?php if ($canEdit): ?>
                <!-- Summary indicator -->
                <div class="hidden lg:flex flex-col items-end mr-2">
                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Total Akumulasi</p>
                    <p class="text-sm font-black text-emerald-600">Rp <?= number_format($totalPrice, 0, ',', '.') ?></p>
                </div>

                <button
                    @click="submitImplementation()"
                    :disabled="isSubmitting"
                    class="btn-primary h-12 px-8 bg-linear-to-r from-sky-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white font-bold rounded-2xl shadow-xl shadow-sky-500/20 hover:shadow-sky-500/40 hover:-translate-y-0.5 transition-all duration-300 disabled:opacity-60 disabled:cursor-not-allowed uppercase tracking-widest text-[11px]"
                >
                    <span x-show="!isSubmitting">
                        <i class="fas fa-paper-plane mr-2"></i>
                        <?= $isSubmitted ? 'Kirim Ulang' : 'Kirim Laporan' ?>
                    </span>
                    <span x-show="isSubmitting">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...
                    </span>
                </button>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>


    <?php if ($canEdit): ?>
        <!-- ─── ADD ITEM FORM ──────────────────────────────────────────── -->
        <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between">
                <div>
                    <h3 class="font-display text-base font-bold text-(--text-heading)">
                        <i class="fas fa-square-plus text-sky-500 mr-2"></i>Registrasi Komponen
                    </h3>
                    <p class="text-[10px] text-slate-400 font-semibold mt-0.5 uppercase tracking-tighter">Input rincian komponen implementasi sesuai RAB</p>
                </div>
            </div>
            <div class="p-5 sm:p-7">
                <form @submit.prevent="saveItem()" class="grid md:grid-cols-12 gap-6">
                    <div class="md:col-span-6 form-field">
                        <label class="form-label">Nama Komponen <span class="required">*</span></label>
                        <div class="input-group">
                            <div class="input-icon"><i class="fas fa-tag"></i></div>
                            <input type="text" x-model="newItem.item_title" placeholder="Contoh: Oven Listrik, Tepung, NIB, dll" required>
                        </div>
                    </div>
                    <div class="md:col-span-6 form-field">
                        <label class="form-label">Kategori/Justifikasi Pemakaian</label>
                        <div class="input-group">
                            <div class="input-icon"><i class="fas fa-layer-group"></i></div>
                            <select x-model="newItem.category" class="bg-transparent border-none outline-none w-full text-sm">
                                <option value="">Pilih Kategori...</option>
                                <option value="bahan">Bahan/Perlengkapan</option>
                                <option value="alat">Alat/Mesin</option>
                                <option value="legalitas">Legalitas (NIB, Halal, dll)</option>
                                <option value="tempat">Tempat/Gerobak</option>
                                <option value="kemasan">Kemasan</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="md:col-span-2 form-field">
                        <label class="form-label">Kuantiti</label>
                        <div class="input-group">
                            <div class="input-icon"><i class="fas fa-cubes"></i></div>
                            <input type="number" x-model="newItem.qty" min="1" placeholder="1">
                        </div>
                    </div>
                    <div class="md:col-span-4 form-field">
                        <label class="form-label">Harga Satuan/Total (Rp)</label>
                        <div class="input-group">
                            <div class="input-icon"><i class="fas fa-rupiah-sign"></i></div>
                            <input type="number" x-model="newItem.price" placeholder="0">
                        </div>
                    </div>
                    <div class="md:col-span-6 form-field">
                        <label class="form-label">Deskripsi/Justifikasi Pemakaian</label>
                        <div class="input-group p-0!">
                            <div class="input-icon pl-3"><i class="fas fa-align-left"></i></div>
                            <textarea x-model="newItem.item_description" rows="3" class="px-0! py-3!" placeholder="Jelaskan secara ringkas untuk apa komponen ini digunakan dalam usaha Anda..."></textarea>
                        </div>
                    </div>
                    <div class="md:col-span-12 flex justify-end">
                        <button type="submit" :disabled="isLoading" class="btn-primary w-full sm:w-auto h-12 px-8">
                            <i class="fas fa-save mr-2" :class="isLoading ? 'fa-spin fa-spinner' : ''"></i>
                            <span x-text="isLoading ? 'Memproses...' : 'Simpan Komponen'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- ─── ITEMS LIST ─────────────────────────────────────────────── -->
    <div class="card-premium overflow-hidden animate-stagger delay-250" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-table-list text-sky-500 mr-2"></i>Daftar Komponen
            </h3>
            <span class="text-[10px] font-black bg-sky-100 text-sky-700 px-3 py-1 rounded-full uppercase"><?= count($items) ?> Komponen</span>
        </div>
        <div class="p-5 sm:p-7 space-y-6">
            <?php foreach ($items as $item): ?>
                <div class="group/item relative p-6 rounded-2xl border border-slate-200 bg-white hover:border-sky-300 hover:shadow-lg hover:shadow-sky-500/5 transition-all duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100 group-hover/item:bg-sky-50 group-hover/item:border-sky-200 transition-colors">
                                    <i class="fas fa-box text-slate-400 group-hover/item:text-sky-500 transition-colors"></i>
                                </div>
                                <div>
                                    <?php
                                    $itemCategory = is_object($item) ? $item->category : ($item['category'] ?? '');
                                    if ($itemCategory):
                                        $categoryLabels = [
                                            'bahan' => 'Bahan/Perlengkapan',
                                            'alat' => 'Alat/Mesin',
                                            'legalitas' => 'Legalitas',
                                            'tempat' => 'Tempat',
                                            'kemasan' => 'Kemasan',
                                            'lainnya' => 'Lainnya'
                                        ];
                                        $catLabel = $categoryLabels[$itemCategory] ?? $itemCategory;
                                        $catClass = match($itemCategory) {
                                            'bahan' => 'bg-blue-100 text-blue-700',
                                            'alat' => 'bg-purple-100 text-purple-700',
                                            'legalitas' => 'bg-emerald-100 text-emerald-700',
                                            'tempat' => 'bg-orange-100 text-orange-700',
                                            'kemasan' => 'bg-pink-100 text-pink-700',
                                            default => 'bg-slate-100 text-slate-600'
                                        };
                                    ?>
                                        <span class="text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md <?= $catClass ?>"><?= $catLabel ?></span>
                                    <?php endif; ?>
                                    <h4 class="font-display font-bold text-base text-(--text-heading) mt-1"><?= esc($item->item_title) ?></h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-xs font-bold text-slate-700">Rp <?= number_format($item->price, 0, ',', '.') ?></span>
                                        <span class="text-[10px] font-black uppercase text-slate-400">×</span>
                                        <span class="text-[10px] font-black uppercase text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md"><?= $item->qty ?> pcs</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-200"></span>
                                        <span class="text-xs font-bold text-emerald-600">Total: Rp <?= number_format($item->price * $item->qty, 0, ',', '.') ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $itemDesc = $item->item_description;
                            if ($itemDesc):
                            ?>
                                <div class="mt-4 p-3 rounded-xl bg-slate-50/50 border border-slate-100 text-[13px] text-slate-600 leading-relaxed">
                                    <?= nl2br(esc((string)$itemDesc)) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($canEdit): ?>
                        <div class="flex items-center gap-1 shrink-0">
                            <button @click="openEditItem(<?= is_object($item) ? $item->id : $item['id'] ?>, <?= htmlspecialchars(json_encode(is_object($item) ? $item->item_title : $item['item_title']), ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars(json_encode((is_object($item) ? $item->item_description : ($item['item_description'] ?? '')) ?: ''), ENT_QUOTES, 'UTF-8') ?>, <?= is_object($item) ? $item->qty : ($item['qty'] ?? 1) ?>, <?= is_object($item) ? $item->price : $item['price'] ?>, <?= htmlspecialchars(json_encode(is_object($item) ? $item->category : ($item['category'] ?? '')), ENT_QUOTES, 'UTF-8') ?>)"
                                class="w-9 h-9 flex items-center justify-center rounded-xl text-slate-400 hover:bg-sky-50 hover:text-sky-600 border border-transparent hover:border-sky-100 transition-all bg-white shadow-sm hover:shadow-sky-100">
                                <i class="fas fa-pen-to-square text-sm"></i>
                            </button>
                            <button @click="deleteItem(<?= is_object($item) ? $item->id : $item['id'] ?>)"
                                class="w-9 h-9 flex items-center justify-center rounded-lg text-slate-400 hover:bg-rose-50 hover:text-rose-600 transition-all">
                                <i class="fas fa-trash-can text-sm"></i>
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Photos Section -->
                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                <i class="fas fa-camera-retro mr-1.5 text-sky-400"></i>Galeri Komponen (<?= count((is_object($item) ? $item->photos : ($item['photos'] ?? [])) ?? []) ?>)
                            </p>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            <?php
                            $itemPhotos = (is_object($item) ? $item->photos : ($item['photos'] ?? [])) ?? [];
                            foreach ($itemPhotos as $photo):
                            ?>
                                <div class="group/img relative aspect-square rounded-2xl overflow-hidden border border-slate-100 bg-slate-50">
                                    <img src="<?= base_url('mahasiswa/implementasi/photo/' . (is_object($photo) ? $photo->id : $photo['id'])) ?>"
                                        alt="<?= esc(is_object($photo) ? $photo->photo_title : $photo['photo_title']) ?>"
                                        class="w-full h-full object-cover group-hover/img:scale-110 transition-transform duration-700">

                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover/img:opacity-100 transition-all duration-300 flex flex-col justify-end p-3">
                                        <div class="flex items-center justify-center gap-2 mb-2">
                                            <button @click="openLightbox('<?= base_url('mahasiswa/implementasi/photo/' . (is_object($photo) ? $photo->id : $photo['id'])) ?>', '<?= esc(is_object($photo) ? $photo->photo_title : $photo['photo_title']) ?>')"
                                                class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition-colors">
                                                <i class="fas fa-eye text-xs"></i>
                                            </button>
                                            <?php if ($canEdit): ?>
                                                <button @click="deletePhoto(<?= is_object($photo) ? $photo->id : $photo['id'] ?>)"
                                                    class="w-8 h-8 rounded-full bg-rose-500/20 backdrop-blur-md text-rose-200 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-colors">
                                                    <i class="fas fa-trash-can text-xs"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                        <p class="text-[9px] font-bold text-white truncate text-center uppercase tracking-tighter">
                                            <?= esc(is_object($photo) ? $photo->photo_title : $photo['photo_title']) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <?php if ($canEdit && count($itemPhotos) < 5): ?>
                                <!-- ─── MODERN PHOTO UPLOAD TRIGGER ────────────────── -->
                                <div class="col-span-1">
                                    <div x-show="currentUploadItemId !== <?= is_object($item) ? $item->id : $item['id'] ?>"
                                        @click="$refs.photoInput<?= is_object($item) ? $item->id : $item['id'] ?>.click()"
                                        class="aspect-square rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 flex flex-col items-center justify-center cursor-pointer hover:border-sky-400 hover:bg-sky-50 group/upload transition-all animate-pulse-soft hover:animate-none">
                                        <input type="file" x-ref="photoInput<?= is_object($item) ? $item->id : $item['id'] ?>" class="hidden" accept=".jpg,.jpeg,.png"
                                            @change="handlePhotoSelected(<?= is_object($item) ? $item->id : $item['id'] ?>, $event)">
                                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm group-hover/upload:scale-110 group-hover/upload:text-sky-500 transition-all mb-2">
                                            <i class="fas fa-cloud-arrow-up text-slate-400 group-hover/upload:text-sky-500"></i>
                                        </div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-tighter group-hover/upload:text-sky-600 transition-colors">Tambah Foto</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($canEdit): ?>
                            <!-- ─── INLINE UPLOAD PREVIEW & FORM ──────────────────── -->
                            <div x-show="currentUploadItemId === <?= is_object($item) ? $item->id : $item['id'] ?> && photoUploadForm.preview"
                                x-cloak x-transition.opacity
                                class="mt-4 p-5 rounded-2xl border border-sky-200 bg-sky-50/30 backdrop-blur-sm">
                                <div class="flex flex-col md:flex-row items-center gap-6">
                                    <div class="relative w-32 h-32 shrink-0 group/preview rounded-2xl overflow-hidden shadow-lg border-2 border-white ring-4 ring-sky-100">
                                        <img :src="photoUploadForm.preview" class="w-full h-full object-cover">
                                        <button @click="cancelPhotoUpload()" class="absolute top-1 right-1 w-6 h-6 rounded-lg bg-black/50 text-white text-[10px] flex items-center justify-center opacity-0 group-hover/preview:opacity-100 transition-opacity">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="flex-1 w-full space-y-4">
                                        <div class="form-field">
                                            <label class="form-label text-sky-700">Beri Nama Foto Ini <span class="required text-sky-400">*</span></label>
                                            <div class="input-group bg-white!">
                                                <div class="input-icon"><i class="fas fa-signature text-sky-400"></i></div>
                                                <input type="text" x-model="photoUploadForm.photo_title" placeholder="Misal: Foto Detail Mesin, Kwitansi, dll" class="text-sm!" required>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap gap-2">
                                            <button @click="submitItemPhoto(<?= is_object($item) ? $item->id : $item['id'] ?>)" :disabled="isLoadingPhoto || !photoUploadForm.photo_title"
                                                class="btn-primary btn-sm flex-1 sm:flex-none">
                                                <i class="fas " :class="isLoadingPhoto ? 'fa-spin fa-spinner' : 'fa-cloud-arrow-up mr-2'"></i>
                                                <span x-text="isLoadingPhoto ? 'Mengupload...' : 'Mulai Upload'"></span>
                                            </button>
                                            <button @click="cancelPhotoUpload()" class="btn-outline btn-sm bg-white! flex-1 sm:flex-none">Batalkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if (empty($items)): ?>
                <div class="flex flex-col items-center justify-center py-16 text-slate-300 bg-slate-50/50 rounded-3xl border-2 border-dashed border-slate-100">
                    <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center shadow-sm mb-4">
                        <i class="fas fa-box-open text-3xl"></i>
                    </div>
                    <h5 class="font-display font-bold text-slate-400">Belum Ada Komponen Terdaftar</h5>
                    <p class="text-xs font-medium text-slate-400 mt-1 uppercase tracking-widest">Gunakan form di atas untuk menambah rincian komponen implementasi</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ─── PAYMENT PROOFS SECTION ─────────────────────────────────── -->
    <div class="card-premium overflow-hidden animate-stagger delay-300" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-receipt text-sky-500 mr-2"></i>Bundel Bukti Transaksi
                </h3>
                <p class="text-[10px] text-slate-400 font-semibold mt-0.5 uppercase tracking-tighter">Upload semua nota, invoice, atau slip pembayaran dalam satu tempat</p>
            </div>
            <span class="text-[10px] font-black bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full uppercase tracking-widest"><?= count($payments) ?> Nota</span>
        </div>
        <div class="p-5 sm:p-7">
            <!-- Payment List Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-8">
                <?php foreach ($payments as $payment): ?>
                    <div class="group relative aspect-[3/4] rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 hover:shadow-xl hover:shadow-emerald-500/10 transition-all duration-300">
                        <img src="<?= base_url('mahasiswa/implementasi/payment/' . $payment->id) ?>"
                            alt="<?= esc($payment->payment_title) ?>"
                            class="w-full h-full object-cover">

                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/90 via-emerald-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-3">
                            <div class="flex items-center justify-center gap-2 mb-2">
                                <button @click="openLightbox('<?= base_url('mahasiswa/implementasi/payment/' . $payment->id) ?>', '<?= esc($payment->payment_title) ?>')"
                                    class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition-colors">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                                <?php if ($canEdit): ?>
                                    <button @click="openEditPayment(<?= $payment->id ?>, '<?= esc($payment->payment_title) ?>', '<?= esc($payment->link_pembelian ?? '') ?>')"
                                        class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition-colors">
                                        <i class="fas fa-pen-to-square text-xs"></i>
                                    </button>
                                    <button @click="deletePayment(<?= $payment->id ?>)"
                                        class="w-8 h-8 rounded-full bg-rose-500/20 backdrop-blur-md text-rose-200 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-colors">
                                        <i class="fas fa-trash-can text-xs"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                            <p class="text-[10px] font-bold text-white text-center line-clamp-2 uppercase leading-tight tracking-tighter">
                                <?= esc($payment->payment_title) ?>
                            </p>
                            <?php if (!empty($payment->link_pembelian)): ?>
                                <a href="<?= esc($payment->link_pembelian) ?>" target="_blank" @click.stop
                                    class="mt-2 w-full py-1.5 rounded-lg bg-emerald-500 text-white text-[9px] font-black uppercase tracking-widest flex items-center justify-center gap-1.5 hover:bg-emerald-400 transition-colors">
                                    <i class="fas fa-cart-shopping text-[8px]"></i> Link Toko
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($canEdit): ?>
                <!-- ─── MODERN PAYMENT UPLOAD FORM ───────────────────────────── -->
                <div class="p-6 rounded-3xl bg-slate-50/50 border-2 border-dashed border-slate-200 hover:border-emerald-300 hover:bg-emerald-50/10 transition-all">
                    <form @submit.prevent="uploadPayment()" class="space-y-6">
                        <div class="grid md:grid-cols-12 gap-6">
                            <div class="md:col-span-4 form-field">
                                <label class="form-label">Nama/Keterangan Nota <span class="required">*</span></label>
                                <div class="input-group bg-white!">
                                    <div class="input-icon"><i class="fas fa-file-invoice text-emerald-400"></i></div>
                                    <input type="text" x-model="newPayment.payment_title" placeholder="Contoh: Nota Toko ATK Sejahtera" required>
                                </div>
                            </div>
                            <div class="md:col-span-4 form-field">
                                <label class="form-label">Link Pembelian <span class="text-[9px] text-slate-400 ml-1">(Opsional)</span></label>
                                <div class="input-group bg-white!">
                                    <div class="input-icon"><i class="fas fa-link text-emerald-400"></i></div>
                                    <input type="url" x-model="newPayment.link_pembelian" placeholder="https://shopee.co.id/product/...">
                                </div>
                            </div>
                            <div class="md:col-span-4 form-field">
                                <label class="form-label">File Dokumentasi Nota <span class="required">*</span></label>
                                <div class="relative group/file">
                                    <input type="file" x-ref="paymentInput" class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                        accept=".jpg,.jpeg,.png" @change="handlePaymentFile($event)" required>
                                    <div class="w-full px-4 h-12 flex items-center gap-3 rounded-xl border border-slate-200 bg-white group-hover/file:border-emerald-400 transition-all">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600">
                                            <i class="fas fa-cloud-arrow-up text-xs"></i>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-400 group-hover/file:text-slate-600 truncate" x-text="newPayment.file ? newPayment.file.name : 'Pilih file nota (JPG/PNG)...'"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" :disabled="isLoadingPayment" class="btn-accent h-12 px-10 rounded-2xl shadow-emerald-500/20">
                                <i class="fas fa-upload mr-2" :class="isLoadingPayment ? 'fa-spin fa-spinner' : ''"></i>
                                <span x-text="isLoadingPayment ? 'Mengirim Data...' : 'Upload Dokumen Transaksi'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

            <?php if (empty($payments)): ?>
                <div class="flex flex-col items-center justify-center py-12 text-slate-300">
                    <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mb-3 border border-slate-100">
                        <i class="fas fa-file-circle-exclamation text-2xl"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Belum Ada Bukti Pembayaran Dilampirkan</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ─── KONSUMSI MENTORING SECTION ─────────────────────────────── -->
    <div class="card-premium overflow-hidden animate-stagger delay-350" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-utensils text-amber-500 mr-2"></i>Bukti Konsumsi Mentoring
                </h3>
                <p class="text-[10px] text-slate-400 font-semibold mt-0.5 uppercase tracking-tighter">Upload dokumentasi konsumsi saat sesi mentoring</p>
            </div>
            <span class="text-[10px] font-black bg-amber-100 text-amber-700 px-3 py-1 rounded-full uppercase tracking-widest"><?= count($konsumsi ?? []) ?> File</span>
        </div>
        <div class="p-5 sm:p-7">
            <!-- Konsumsi List Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-8">
                <?php foreach ($konsumsi ?? [] as $k): ?>
                    <div class="group relative aspect-[3/4] rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 hover:shadow-xl hover:shadow-amber-500/10 transition-all duration-300">
                        <img src="<?= base_url('mahasiswa/implementasi/konsumsi/' . $k->id) ?>"
                            alt="<?= esc($k->konsumsi_title) ?>"
                            class="w-full h-full object-cover">

                        <div class="absolute inset-0 bg-gradient-to-t from-amber-950/90 via-amber-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-3">
                            <div class="flex items-center justify-center gap-2 mb-2">
                                <button @click="openLightbox('<?= base_url('mahasiswa/implementasi/konsumsi/' . $k->id) ?>', '<?= esc($k->konsumsi_title) ?>')"
                                    class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition-colors">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                                <?php if ($canEdit): ?>
                                    <button @click="openEditKonsumsi(<?= $k->id ?>, '<?= esc($k->konsumsi_title) ?>')"
                                        class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center hover:bg-white/40 transition-colors">
                                        <i class="fas fa-pen-to-square text-xs"></i>
                                    </button>
                                    <button @click="deleteKonsumsi(<?= $k->id ?>)"
                                        class="w-8 h-8 rounded-full bg-rose-500/20 backdrop-blur-md text-rose-200 flex items-center justify-center hover:bg-rose-500 hover:text-white transition-colors">
                                        <i class="fas fa-trash-can text-xs"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                            <p class="text-[10px] font-bold text-white text-center line-clamp-2 uppercase leading-tight tracking-tighter">
                                <?= esc($k->konsumsi_title) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($canEdit): ?>
                <!-- ─── MODERN KONSUMSI UPLOAD FORM ───────────────────────────── -->
                <div class="p-6 rounded-3xl bg-slate-50/50 border-2 border-dashed border-slate-200 hover:border-amber-300 hover:bg-amber-50/10 transition-all">
                    <form @submit.prevent="uploadKonsumsi()" class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="form-field">
                                <label class="form-label">Nama/Keterangan <span class="required">*</span></label>
                                <div class="input-group bg-white!">
                                    <div class="input-icon"><i class="fas fa-file-invoice text-amber-400"></i></div>
                                    <input type="text" x-model="newKonsumsi.konsumsi_title" placeholder="Contoh: Makan Siang Mentoring 1" required>
                                </div>
                            </div>
                            <div class="form-field">
                                <label class="form-label">File Dokumentasi <span class="required">*</span></label>
                                <div class="relative group/file">
                                    <input type="file" x-ref="konsumsiInput" class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                        accept=".jpg,.jpeg,.png" @change="handleKonsumsiFile($event)" required>
                                    <div class="w-full px-4 h-12 flex items-center gap-3 rounded-xl border border-slate-200 bg-white group-hover/file:border-amber-400 transition-all">
                                        <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600">
                                            <i class="fas fa-cloud-arrow-up text-xs"></i>
                                        </div>
                                        <span class="text-xs font-semibold text-slate-400 group-hover/file:text-slate-600 truncate" x-text="newKonsumsi.file ? newKonsumsi.file.name : 'Pilih file dokumentasi (JPG/PNG)...'"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" :disabled="isLoadingKonsumsi" class="btn-accent border-none! bg-amber-500! hover:bg-amber-600! h-12 px-10 rounded-2xl shadow-amber-500/20">
                                <i class="fas fa-upload mr-2" :class="isLoadingKonsumsi ? 'fa-spin fa-spinner' : ''"></i>
                                <span x-text="isLoadingKonsumsi ? 'Mengirim Data...' : 'Upload Dokumen Konsumsi'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

            <?php if (empty($konsumsi)): ?>
                <div class="flex flex-col items-center justify-center py-12 text-slate-300">
                    <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mb-3 border border-slate-100">
                        <i class="fas fa-utensils text-2xl"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Belum Ada Bukti Konsumsi Dilampirkan</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ─── MODALS ─────────────────────────────────────────────────── -->

    <!-- Lightbox Modal -->
    <template x-teleport="body">
        <div x-show="showLightbox"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[120]"
            :class="{ 'hidden': !showLightbox }"
            aria-labelledby="lightbox-modal-title"
            role="dialog"
            aria-modal="true">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="closeLightbox()"></div>

            <!-- Modal Panel -->
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                        <!-- Modal Header -->
                        <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-display font-bold text-white" id="lightbox-modal-title">
                                    <i class="fas fa-eye mr-2"></i>Preview Dokumentasi
                                </h3>
                                <button type="button" @click="closeLightbox()" class="text-white/80 hover:text-white transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Modal Body -->
                        <div class="px-6 py-5 bg-slate-50">
                            <!-- Title Badge -->
                            <div class="mb-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border bg-emerald-50 text-emerald-600 border-emerald-200">
                                    <i class="fas fa-image text-[10px]"></i>
                                    <span class="truncate max-w-[300px]" x-text="lightboxTitle || 'Dokumentasi'">Dokumentasi</span>
                                </span>
                            </div>

                            <!-- Image Content -->
                            <div class="rounded-xl overflow-hidden bg-white border border-slate-200 shadow-sm p-4 flex items-center justify-center min-h-[300px] max-h-[500px]">
                                <img :src="lightboxUrl" class="max-w-full max-h-[450px] rounded-lg object-contain" :alt="lightboxTitle">
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-white px-6 py-4 flex justify-between items-center border-t border-slate-100">
                            <div class="flex items-center gap-2 text-xs text-slate-400">
                                <i class="fas fa-info-circle"></i>
                                <span>Dokumentasi Implementasi Perjanjian</span>
                            </div>
                            <div class="flex gap-2">
                                <a :href="lightboxUrl" target="_blank" class="btn-accent text-sm">
                                    <i class="fas fa-external-link-alt mr-2"></i>Buka di Tab Baru
                                </a>
                                <button type="button" @click="closeLightbox()" class="btn-outline text-sm">
                                    <i class="fas fa-times mr-2"></i>Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Edit Item Modal -->
    <template x-teleport="body">
        <div x-show="showEditItemModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[100]"
            :class="{ 'hidden': !showEditItemModal }"
            aria-labelledby="edit-item-modal-title"
            role="dialog"
            aria-modal="true">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="showEditItemModal = false"></div>

            <!-- Modal Panel -->
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-xl">

                        <!-- Modal Header -->
                        <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-display font-bold text-white" id="edit-item-modal-title">
                                    <i class="fas fa-pen-nib mr-2"></i>Perbarui Item
                                </h3>
                                <button type="button" @click="showEditItemModal = false" class="text-white/80 hover:text-white transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <p class="text-[10px] text-white/80 font-black uppercase tracking-widest mt-1">Master Data Implementasi</p>
                        </div>

                        <!-- Modal Body & Form -->
                        <form @submit.prevent="saveEditItem()" class="space-y-0">
                            <div class="px-6 py-5 space-y-5">
                        <div class="form-field">
                            <label class="form-label text-[10px] font-black uppercase text-slate-400 tracking-widest">Nama Komponen</label>
                            <div class="input-group group-focus-within:border-sky-500 transition-colors">
                                <div class="input-icon"><i class="fas fa-tag"></i></div>
                                <input type="text" x-model="editItem.item_title" placeholder="Nama komponen..." required>
                            </div>
                        </div>

                        <div class="form-field">
                            <label class="form-label text-[10px] font-black uppercase text-slate-400 tracking-widest">Kategori/Justifikasi Pemakaian</label>
                            <div class="input-group group-focus-within:border-sky-500 transition-colors">
                                <div class="input-icon"><i class="fas fa-layer-group"></i></div>
                                <select x-model="editItem.category" class="bg-transparent border-none outline-none w-full text-sm">
                                    <option value="">Pilih Kategori...</option>
                                    <option value="bahan">Bahan/Perlengkapan</option>
                                    <option value="alat">Alat/Mesin</option>
                                    <option value="legalitas">Legalitas (NIB, Halal, dll)</option>
                                    <option value="tempat">Tempat/Gerobak</option>
                                    <option value="kemasan">Kemasan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-5">
                            <div class="form-field">
                                <label class="form-label text-[10px] font-black uppercase text-slate-400 tracking-widest">Kuantiti</label>
                                <div class="input-group group-focus-within:border-sky-500 transition-colors">
                                    <div class="input-icon"><i class="fas fa-cubes"></i></div>
                                    <input type="number" x-model="editItem.qty" min="1" placeholder="1">
                                </div>
                            </div>
                            <div class="form-field">
                                <label class="form-label text-[10px] font-black uppercase text-slate-400 tracking-widest">Harga Satuan (Rp)</label>
                                <div class="input-group group-focus-within:border-sky-500 transition-colors">
                                    <div class="input-icon text-emerald-500"><i class="fas fa-rupiah-sign"></i></div>
                                    <input type="number" x-model="editItem.price" placeholder="0">
                                </div>
                            </div>
                        </div>

                        <div class="form-field">
                            <label class="form-label text-[10px] font-black uppercase text-slate-400 tracking-widest">Deskripsi/Justifikasi Pemakaian</label>
                            <div class="input-group p-0! group-focus-within:border-sky-500 transition-colors">
                                <div class="input-icon pl-3"><i class="fas fa-align-left"></i></div>
                                <textarea x-model="editItem.item_description" rows="3" class="px-0! py-3!" placeholder="Deskripsi penggunaan komponen..."></textarea>
                            </div>
                        </div>
                    </div>

                            </div>

                            <!-- Modal Footer -->
                            <div class="bg-slate-50 px-6 py-4 flex gap-3 justify-end border-t border-slate-100">
                                <button type="button" @click="showEditItemModal = false" class="btn-outline text-sm">
                                    <i class="fas fa-times mr-2"></i>Batal
                                </button>
                                <button type="submit" :disabled="isLoadingEdit" class="btn-primary text-sm shadow-lg shadow-sky-500/20">
                                    <i class="fas fa-save mr-2" :class="isLoadingEdit ? 'fa-spin fa-spinner' : ''"></i>
                                    <span x-text="isLoadingEdit ? 'Menyimpan...' : 'Simpan Perubahan'"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Edit Payment Modal -->
    <template x-teleport="body">
        <div x-show="showEditPaymentModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[100]"
            :class="{ 'hidden': !showEditPaymentModal }"
            aria-labelledby="edit-payment-modal-title"
            role="dialog"
            aria-modal="true">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="showEditPaymentModal = false"></div>

            <!-- Modal Panel -->
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">

                        <!-- Modal Header -->
                        <div class="bg-linear-to-r from-emerald-500 to-teal-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-display font-bold text-white" id="edit-payment-modal-title">
                                    <i class="fas fa-file-invoice mr-2"></i>Ubah Data Nota
                                </h3>
                                <button type="button" @click="showEditPaymentModal = false" class="text-white/80 hover:text-white transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <p class="text-[10px] text-white/80 font-black uppercase tracking-widest mt-1">Update Bukti Transaksi</p>
                        </div>

                        <!-- Modal Body & Form -->
                        <form @submit.prevent="saveEditPayment()" class="space-y-0">
                            <div class="px-6 py-5">
                                <div class="form-field">
                                    <label class="form-label text-[10px] font-black uppercase text-slate-400 tracking-widest">Keterangan / Nama Nota</label>
                                    <div class="input-group group-focus-within:border-emerald-500 transition-colors">
                                        <div class="input-icon"><i class="fas fa-signature text-emerald-400"></i></div>
                                        <input type="text" x-model="editPayment.payment_title" placeholder="Contoh: Nota Pembelian Alat..." required>
                                    </div>
                                </div>
                                <div class="form-field mt-4">
                                    <label class="form-label text-[10px] font-black uppercase text-slate-400 tracking-widest">Link Pembelian <span class="text-slate-300 ml-1">(Opsional)</span></label>
                                    <div class="input-group group-focus-within:border-emerald-500 transition-colors">
                                        <div class="input-icon"><i class="fas fa-link text-emerald-400"></i></div>
                                        <input type="url" x-model="editPayment.link_pembelian" placeholder="https://...">
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="bg-slate-50 px-6 py-4 flex gap-3 justify-end border-t border-slate-100">
                                <button type="button" @click="showEditPaymentModal = false" class="btn-outline text-sm">
                                    <i class="fas fa-times mr-2"></i>Batal
                                </button>
                                <button type="submit" :disabled="isLoadingEditPayment" class="btn-primary text-sm shadow-lg shadow-emerald-500/20" style="background-color: #10b981; border: none;">
                                    <i class="fas fa-check-circle mr-2" :class="isLoadingEditPayment ? 'fa-spin fa-spinner' : ''"></i>
                                    <span x-text="isLoadingEditPayment ? 'Memproses...' : 'Terapkan'"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <!-- Edit Konsumsi Modal -->
    <template x-teleport="body">
        <div x-show="showEditKonsumsiModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[100]"
            :class="{ 'hidden': !showEditKonsumsiModal }"
            aria-labelledby="edit-konsumsi-modal-title"
            role="dialog"
            aria-modal="true">

            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" @click="showEditKonsumsiModal = false"></div>

            <!-- Modal Panel -->
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">

                        <!-- Modal Header -->
                        <div class="bg-linear-to-r from-amber-500 to-orange-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-display font-bold text-white" id="edit-konsumsi-modal-title">
                                    <i class="fas fa-utensils mr-2"></i>Data Konsumsi
                                </h3>
                                <button type="button" @click="showEditKonsumsiModal = false" class="text-white/80 hover:text-white transition-colors">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <p class="text-[10px] text-white/80 font-black uppercase tracking-widest mt-1">Update Dokumentasi</p>
                        </div>

                        <!-- Modal Body & Form -->
                        <form @submit.prevent="saveEditKonsumsi()" class="space-y-0">
                            <div class="px-6 py-5">
                                <div class="form-field">
                                    <label class="form-label text-[10px] font-black uppercase text-slate-400 tracking-widest">Keterangan / Nama Kegiatan</label>
                                    <div class="input-group group-focus-within:border-amber-500 transition-colors">
                                        <div class="input-icon"><i class="fas fa-signature text-amber-500"></i></div>
                                        <input type="text" x-model="editKonsumsi.konsumsi_title" placeholder="Contoh: Makan Siang Rapat..." required>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="bg-slate-50 px-6 py-4 flex gap-3 justify-end border-t border-slate-100">
                                <button type="button" @click="showEditKonsumsiModal = false" class="btn-outline text-sm">
                                    <i class="fas fa-times mr-2"></i>Batal
                                </button>
                                <button type="submit" :disabled="isLoadingEditKonsumsi" class="btn-primary text-sm shadow-lg shadow-amber-500/20" style="background-color: #f59e0b; border: none;">
                                    <i class="fas fa-check-circle mr-2" :class="isLoadingEditKonsumsi ? 'fa-spin fa-spinner' : ''"></i>
                                    <span x-text="isLoadingEditKonsumsi ? 'Memproses...' : 'Terapkan'"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>

</div>

<!-- ─── JAVASCRIPT LOGIC ───────────────────────────────────────── -->
<script>
    function implementasiMahasiswa() {
        return {
            isLoading: false,
            isLoadingPhoto: false,
            isLoadingPayment: false,
            isLoadingKonsumsi: false,
            isLoadingEdit: false,
            isLoadingEditPayment: false,
            isLoadingEditKonsumsi: false,
            isSubmitting: false,
            showEditItemModal: false,
            showEditPaymentModal: false,
            showEditKonsumsiModal: false,
            showLightbox: false,
            lightboxUrl: '',
            lightboxTitle: '',
            currentItemId: null,
            currentPaymentId: null,
            currentUploadItemId: null,

            newItem: {
                item_title: '',
                item_description: '',
                category: '',
                qty: 1,
                price: ''
            },
            newPayment: {
                payment_title: '',
                link_pembelian: '',
                file: null
            },
            newKonsumsi: {
                konsumsi_title: '',
                file: null
            },
            photoUploadForm: {
                photo_title: '',
                file: null,
                preview: null
            },
            editItem: {
                id: null,
                item_title: '',
                item_description: '',
                category: '',
                qty: 1,
                price: ''
            },
            editPayment: {
                id: null,
                payment_title: '',
                link_pembelian: ''
            },
            editKonsumsi: {
                id: null,
                konsumsi_title: ''
            },

            handleMouseMove(e) {
                const card = e.currentTarget;
                const rect = card.getBoundingClientRect();
                card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            },

            openLightbox(url, title) {
                this.lightboxUrl = url;
                this.lightboxTitle = title;
                this.showLightbox = true;
                document.body.classList.add('overflow-hidden');
            },

            closeLightbox() {
                this.showLightbox = false;
                setTimeout(() => {
                    this.lightboxUrl = '';
                    this.lightboxTitle = '';
                    document.body.classList.remove('overflow-hidden');
                }, 300);
            },

            scrollToForm() {
                document.querySelector('.card-premium form')?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            },

            async saveItem() {
                if (!this.newItem.item_title) return;
                this.isLoading = true;
                try {
                    const formData = new FormData();
                    Object.keys(this.newItem).forEach(k => formData.append(k, this.newItem[k]));
                    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                    const response = await fetch('<?= base_url('mahasiswa/implementasi/item') ?>', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const result = await response.json();
                    if (result.success) {
                        this.$dispatch('toast-notify', {
                            message: 'Komponen berhasil diregistrasi',
                            type: 'success'
                        });
                        setTimeout(() => window.location.reload(), 600);
                    } else {
                        this.$dispatch('toast-notify', {
                            message: result.message || 'Gagal menyimpan',
                            type: 'error'
                        });
                    }
                } catch (error) {
                    this.$dispatch('toast-notify', {
                        message: 'Komunikasi server gagal',
                        type: 'error'
                    });
                } finally {
                    this.isLoading = false;
                }
            },

            handlePhotoSelected(itemId, e) {
                const file = e.target.files[0];
                if (!file) return;
                if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                    this.$dispatch('toast-notify', {
                        message: 'Gunakan format JPG/PNG',
                        type: 'error'
                    });
                    return;
                }
                const reader = new FileReader();
                reader.onload = (event) => {
                    this.photoUploadForm.preview = event.target.result;
                };
                reader.readAsDataURL(file);
                this.photoUploadForm.file = file;
                this.photoUploadForm.photo_title = '';
                this.currentUploadItemId = itemId;
            },

            async submitItemPhoto(itemId) {
                if (!this.photoUploadForm.photo_title || !this.photoUploadForm.file) return;
                this.isLoadingPhoto = true;
                try {
                    const formData = new FormData();
                    formData.append('photo_title', this.photoUploadForm.photo_title);
                    formData.append('photo', this.photoUploadForm.file);
                    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                    const response = await fetch(`<?= base_url('mahasiswa/implementasi/item') ?>/${itemId}/photo`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const result = await response.json();
                    if (result.success) {
                        this.$dispatch('toast-notify', {
                            message: 'Dokumentasi berhasil diunggah',
                            type: 'success'
                        });
                        setTimeout(() => window.location.reload(), 600);
                    } else {
                        this.$dispatch('toast-notify', {
                            message: result.message || 'Gagal upload',
                            type: 'error'
                        });
                    }
                } catch (error) {
                    this.$dispatch('toast-notify', {
                        message: 'Error server',
                        type: 'error'
                    });
                } finally {
                    this.isLoadingPhoto = false;
                }
            },

            cancelPhotoUpload() {
                this.photoUploadForm = {
                    photo_title: '',
                    file: null,
                    preview: null
                };
                this.currentUploadItemId = null;
            },

            handlePaymentFile(e) {
                this.newPayment.file = e.target.files[0];
            },

            openEditItem(id, title, desc, qty, price, category) {
                this.editItem = {
                    id: id,
                    item_title: title,
                    item_description: desc,
                    category: category || '',
                    qty: qty,
                    price: price
                };
                this.showEditItemModal = true;
            },

            openEditPayment(id, title, link) {
                this.editPayment = {
                    id: id,
                    payment_title: title,
                    link_pembelian: link || ''
                };
                this.showEditPaymentModal = true;
            },

            openEditKonsumsi(id, title) {
                this.editKonsumsi = {
                    id: id,
                    konsumsi_title: title
                };
                this.showEditKonsumsiModal = true;
            },

            async uploadPayment() {
                if (!this.newPayment.payment_title || !this.newPayment.file) return;
                this.isLoadingPayment = true;
                try {
                    const formData = new FormData();
                    formData.append('payment_title', this.newPayment.payment_title);
                    formData.append('link_pembelian', this.newPayment.link_pembelian);
                    formData.append('payment_file', this.newPayment.file);
                    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                    const response = await fetch('<?= base_url('mahasiswa/implementasi') ?>/payment', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const result = await response.json();
                    if (result.success) {
                        this.$dispatch('toast-notify', {
                            message: 'Nota pembayaran terarsip',
                            type: 'success'
                        });
                        setTimeout(() => window.location.reload(), 600);
                    } else {
                        this.$dispatch('toast-notify', {
                            message: result.message,
                            type: 'error'
                        });
                    }
                } catch (e) {
                    this.$dispatch('toast-notify', {
                        message: 'Error',
                        type: 'error'
                    });
                } finally {
                    this.isLoadingPayment = false;
                }
            },

            async deleteItem(itemId) {
                if (!confirm('Hapus komponen ini beserta galeri fotonya?')) return;
                try {
                    const r = await fetch(`<?= base_url('mahasiswa/implementasi/item') ?>/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                        }
                    });
                    const res = await r.json();
                    if (res.success) window.location.reload();
                } catch (e) {}
            },

            async deletePhoto(id) {
                if (!confirm('Hapus foto ini?')) return;
                try {
                    const r = await fetch(`<?= base_url('mahasiswa/implementasi/photo') ?>/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                        }
                    });
                    if (r.ok) window.location.reload();
                } catch (e) {}
            },

            async deletePayment(id) {
                if (!confirm('Hapus nota ini?')) return;
                try {
                    const r = await fetch(`<?= base_url('mahasiswa/implementasi/payment') ?>/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                        }
                    });
                    if (r.ok) window.location.reload();
                } catch (e) {}
            },

            async resetAll() {
                if (!confirm('PERINGATAN KRITIKAL: Hapus semua data komponen & nota secara permanen?')) return;
                if (!confirm('Konfirmasi Terakhir: Anda harus mengulang input dari awal. Lanjutkan?')) return;
                try {
                    const formData = new FormData();
                    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
                    const r = await fetch('<?= base_url('mahasiswa/implementasi/reset') ?>', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const res = await r.json();
                    if (res.success) window.location.href = res.redirect || '<?= base_url('mahasiswa/implementasi') ?>';
                } catch (e) {}
            },

            openEditItem(id, title, desc, qty, price, category) {
                this.editItem = {
                    id,
                    item_title: title,
                    item_description: desc || '',
                    category: category || '',
                    qty: qty || 1,
                    price: price || ''
                };
                this.showEditItemModal = true;
            },

            async saveEditItem() {
                this.isLoadingEdit = true;
                try {
                    const r = await fetch(`<?= base_url('mahasiswa/implementasi/item') ?>/${this.editItem.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                        },
                        body: JSON.stringify(this.editItem)
                    });
                    const res = await r.json();
                    if (res.success) window.location.reload();
                } catch (e) {} finally {
                    this.isLoadingEdit = false;
                }
            },

            openEditPayment(id, title, link) {
                this.editPayment = {
                    id,
                    payment_title: title,
                    link_pembelian: link || ''
                };
                this.showEditPaymentModal = true;
            },

            async saveEditPayment() {
                this.isLoadingEditPayment = true;
                try {
                    const r = await fetch(`<?= base_url('mahasiswa/implementasi/payment') ?>/${this.editPayment.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                        },
                        body: JSON.stringify({
                            payment_title: this.editPayment.payment_title,
                            link_pembelian: this.editPayment.link_pembelian
                        })
                    });
                    const res = await r.json();
                    if (res.success) window.location.reload();
                } catch (e) {} finally {
                    this.isLoadingEditPayment = false;
                }
            },

            handleKonsumsiFile(e) {
                this.newKonsumsi.file = e.target.files[0];
            },

            async uploadKonsumsi() {
                if (!this.newKonsumsi.konsumsi_title || !this.newKonsumsi.file) return;
                this.isLoadingKonsumsi = true;
                try {
                    const formData = new FormData();
                    formData.append('konsumsi_title', this.newKonsumsi.konsumsi_title);
                    formData.append('konsumsi_file', this.newKonsumsi.file);
                    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                    const response = await fetch('<?= base_url('mahasiswa/implementasi/konsumsi') ?>', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const result = await response.json();
                    if (result.success) {
                        this.$dispatch('toast-notify', {
                            message: 'Dokumentasi konsumsi terarsip',
                            type: 'success'
                        });
                        setTimeout(() => window.location.reload(), 600);
                    } else {
                        this.$dispatch('toast-notify', {
                            message: result.message,
                            type: 'error'
                        });
                    }
                } catch (e) {
                    this.$dispatch('toast-notify', {
                        message: 'Error server HTTP',
                        type: 'error'
                    });
                } finally {
                    this.isLoadingKonsumsi = false;
                }
            },

            async deleteKonsumsi(id) {
                if (!confirm('Hapus bukti konsumsi ini secara permanen?')) return;
                try {
                    const r = await fetch(`<?= base_url('mahasiswa/implementasi/konsumsi') ?>/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                        }
                    });
                    if (r.ok) window.location.reload();
                } catch (e) {}
            },

            openEditKonsumsi(id, title) {
                this.editKonsumsi = {
                    id,
                    konsumsi_title: title
                };
                this.showEditKonsumsiModal = true;
            },

            async saveEditKonsumsi() {
                this.isLoadingEditKonsumsi = true;
                try {
                    const r = await fetch(`<?= base_url('mahasiswa/implementasi/konsumsi') ?>/${this.editKonsumsi.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                        },
                        body: JSON.stringify({
                            konsumsi_title: this.editKonsumsi.konsumsi_title
                        })
                    });
                    const res = await r.json();
                    if (res.success) window.location.reload();
                } catch (e) {} finally {
                    this.isLoadingEditKonsumsi = false;
                }
            },

            async submitImplementation() {
                if (!confirm('Apakah Anda yakin ingin mengirim laporan implementasi ini? Setelah dikirim, data akan dikunci dan diverifikasi oleh Dosen Pendamping & Admin.')) return;
                
                this.isSubmitting = true;
                try {
                    const formData = new FormData();
                    formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                    const response = await fetch('<?= base_url('mahasiswa/implementasi/submit') ?>', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const result = await response.json();
                    
                    if (result.success) {
                        this.$dispatch('toast-notify', {
                            message: result.message,
                            type: 'success'
                        });
                        if (result.redirect) {
                            setTimeout(() => window.location.href = result.redirect, 1000);
                        }
                    } else {
                        this.$dispatch('toast-notify', {
                            message: result.message,
                            type: 'error'
                        });
                    }
                } catch (e) {
                    this.$dispatch('toast-notify', {
                        message: 'Terjadi kesalahan sistem',
                        type: 'error'
                    });
                } finally {
                    this.isSubmitting = false;
                }
            }
        }
    }
</script>

<?= $this->endSection() ?>