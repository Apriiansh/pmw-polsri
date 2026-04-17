<?php
/**
 * @var array $proposal
 * @var \App\Entities\PmwImplementationItem[] $items
 * @var \App\Entities\PmwImplementationPayment[] $payments
 * @var \App\Entities\PmwImplementationKonsumsi[] $konsumsi
 * @var float|int $totalPrice
 */
?>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="implementasiDetail()">

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-slate-500 animate-stagger">
        <a href="<?= base_url('admin/implementasi') ?>" class="hover:text-sky-600 transition-colors">
            <i class="fas fa-arrow-left mr-1"></i>Kembali ke List
        </a>
        <span>/</span>
        <span class="text-slate-800 font-medium">Detail Validasi</span>
    </div>

    <!-- Header Info -->
    <div class="card-premium p-6 animate-stagger delay-100" @mousemove="handleMouseMove">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-display text-xl font-bold text-(--text-heading)">
                    <?= esc($proposal['nama_usaha']) ?>
                </h2>
                <p class="text-[11px] text-(--text-muted) mt-1">
                    <?= esc($proposal['ketua_nama']) ?> (<?= esc($proposal['ketua_nim']) ?>) •
                    <?= esc($proposal['ketua_prodi']) ?> •
                    Dosen: <?= esc($proposal['dosen_nama'] ?? '-') ?>
                </p>
                <p class="text-[11px] text-slate-400 mt-0.5">
                    <?= esc($proposal['period_name']) ?> <?= $proposal['period_year'] ?>
                </p>
            </div>
            <?php
            $statusBadge = match ($proposal['implementasi_status']) {
                'approved' => ['bg-emerald-50 text-emerald-700 border-emerald-200', 'fa-check', 'Disetujui'],
                'rejected' => ['bg-rose-50 text-rose-700 border-rose-200', 'fa-xmark', 'Ditolak'],
                'revision' => ['bg-orange-50 text-orange-700 border-orange-200', 'fa-pen', 'Perlu Revisi'],
                default => ['bg-amber-50 text-amber-700 border-amber-200', 'fa-clock', 'Menunggu'],
            };
            ?>
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-black border <?= $statusBadge[0] ?>">
                <i class="fas <?= $statusBadge[1] ?>"></i>
                <?= $statusBadge[2] ?>
            </span>
        </div>
    </div>

    <!-- Summary -->
    <div class="grid md:grid-cols-3 gap-6 animate-stagger delay-150">
        <div class="card-premium p-5 flex items-center justify-between" @mousemove="handleMouseMove">
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Jumlah Barang</p>
                <p class="text-3xl font-bold text-sky-600 mt-1"><?= count($items) ?></p>
            </div>
            <div class="w-14 h-14 rounded-xl bg-sky-100 flex items-center justify-center">
                <i class="fas fa-boxes text-sky-600 text-2xl"></i>
            </div>
        </div>
        <div class="card-premium p-5 flex items-center justify-between" @mousemove="handleMouseMove">
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Harga</p>
                <p class="text-3xl font-bold text-emerald-600 mt-1">Rp <?= number_format($totalPrice, 0, ',', '.') ?></p>
            </div>
            <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center">
                <i class="fas fa-money-bill text-emerald-600 text-2xl"></i>
            </div>
        </div>
        <div class="card-premium p-5 flex items-center justify-between" @mousemove="handleMouseMove">
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Bukti Pembayaran</p>
                <p class="text-3xl font-bold text-amber-600 mt-1"><?= count($payments) ?></p>
            </div>
            <div class="w-14 h-14 rounded-xl bg-amber-100 flex items-center justify-center">
                <i class="fas fa-receipt text-amber-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Items Detail -->
    <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-boxes text-sky-500 mr-2"></i>Detail Barang
            </h3>
        </div>
        <div class="p-5 sm:p-7 space-y-6">
            <?php foreach ($items as $index => $item): ?>
                <div class="border border-slate-200 rounded-xl overflow-hidden">
                    <!-- Item Header -->
                    <div class="px-4 py-3 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-sky-500 text-white flex items-center justify-center font-bold text-sm">
                                <?= $index + 1 ?>
                            </span>
                            <div>
                                <h4 class="font-display font-bold text-(--text-heading)"><?= esc(is_object($item) ? $item->item_title : $item['item_title']) ?></h4>
                                <?php 
                                    $itemPrice = is_object($item) ? $item->price : ($item['price'] ?? 0);
                                    if ($itemPrice > 0): 
                                ?>
                                    <span class="text-sm text-emerald-600 font-bold">
                                        Rp <?= number_format($itemPrice, 0, ',', '.') ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Item Content -->
                    <div class="p-4">
                        <?php 
                            $itemDesc = is_object($item) ? $item->item_description : ($item['item_description'] ?? '');
                            if ($itemDesc): 
                        ?>
                            <div class="mb-4 p-3 bg-slate-50 rounded-lg">
                                <p class="text-xs font-bold text-slate-500 uppercase mb-1">Detail Kegunaan</p>
                                <p class="text-sm text-slate-700"><?= nl2br(esc((string)$itemDesc)) ?></p>
                            </div>
                        <?php endif; ?>

                        <!-- Photos -->
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase mb-3">
                                <i class="fas fa-images mr-1"></i>Foto (<?= count((is_object($item) ? $item->photos : ($item['photos'] ?? [])) ?? []) ?>)
                            </p>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                <?php 
                                    $photos = (is_object($item) ? $item->photos : ($item['photos'] ?? [])) ?? [];
                                    foreach ($photos as $photo): 
                                ?>
                                    <div class="relative group">
                                        <img src="<?= base_url('admin/implementasi/photo/' . (is_object($photo) ? $photo->id : $photo['id'])) ?>"
                                            alt="<?= esc(is_object($photo) ? $photo->photo_title : $photo['photo_title']) ?>"
                                            class="w-full aspect-square object-cover rounded-lg cursor-pointer"
                                            @click="openImageModal('<?= base_url('admin/implementasi/photo/' . (is_object($photo) ? $photo->id : $photo['id'])) ?>', '<?= esc(is_object($photo) ? $photo->photo_title : $photo['photo_title']) ?>')">
                                        <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <i class="fas fa-expand text-white text-xl"></i>
                                        </div>
                                        <p class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-[10px] px-2 py-1 rounded-b-lg truncate">
                                            <?= esc(is_object($photo) ? $photo->photo_title : $photo['photo_title']) ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if (empty($items)): ?>
                <div class="text-center py-8 text-slate-400">
                    <i class="fas fa-box-open text-4xl mb-3 opacity-30"></i>
                    <p>Belum ada barang</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Payment Proofs -->
    <div class="card-premium overflow-hidden animate-stagger delay-250" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-receipt text-sky-500 mr-2"></i>Bukti Pembayaran
            </h3>
        </div>
        <div class="p-5 sm:p-7">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                <?php foreach ($payments as $payment): ?>
                    <div class="relative group">
                        <img src="<?= base_url('admin/implementasi/payment/' . (is_object($payment) ? $payment->id : $payment['id'])) ?>"
                            alt="<?= esc(is_object($payment) ? $payment->payment_title : $payment['payment_title']) ?>"
                            class="w-full aspect-square object-cover rounded-xl cursor-pointer"
                            @click="openImageModal('<?= base_url('admin/implementasi/payment/' . (is_object($payment) ? $payment->id : $payment['id'])) ?>', '<?= esc(is_object($payment) ? $payment->payment_title : $payment['payment_title']) ?>')">
                        <div class="absolute inset-0 bg-black/50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <i class="fas fa-expand text-white text-xl"></i>
                        </div>
                        <p class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-[10px] px-2 py-1 rounded-b-xl truncate">
                            <?= esc(is_object($payment) ? $payment->payment_title : $payment['payment_title']) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (empty($payments)): ?>
                <div class="text-center py-8 text-slate-400">
                    <i class="fas fa-receipt text-4xl mb-3 opacity-30"></i>
                    <p>Belum ada bukti pembayaran</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Konsumsi Proofs -->
    <div class="card-premium overflow-hidden animate-stagger delay-275" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-utensils text-sky-500 mr-2"></i>Bukti Konsumsi Mentoring
            </h3>
        </div>
        <div class="p-5 sm:p-7">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                <?php foreach ($konsumsi ?? [] as $k): ?>
                    <div class="relative group">
                        <img src="<?= base_url('admin/implementasi/konsumsi/' . (is_object($k) ? $k->id : $k['id'])) ?>"
                            alt="<?= esc(is_object($k) ? $k->konsumsi_title : $k['konsumsi_title']) ?>"
                            class="w-full aspect-square object-cover rounded-xl cursor-pointer"
                            @click="openImageModal('<?= base_url('admin/implementasi/konsumsi/' . (is_object($k) ? $k->id : $k['id'])) ?>', '<?= esc(is_object($k) ? $k->konsumsi_title : $k['konsumsi_title']) ?>')">
                        <div class="absolute inset-0 bg-black/50 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <i class="fas fa-expand text-white text-xl"></i>
                        </div>
                        <p class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-[10px] px-2 py-1 rounded-b-xl truncate">
                            <?= esc(is_object($k) ? $k->konsumsi_title : $k['konsumsi_title']) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (empty($konsumsi)): ?>
                <div class="text-center py-8 text-slate-400">
                    <i class="fas fa-utensils text-4xl mb-3 opacity-30"></i>
                    <p>Belum ada bukti konsumsi</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Verification Form -->
    <div class="card-premium overflow-hidden animate-stagger delay-300" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-clipboard-check text-sky-500 mr-2"></i>Form Verifikasi
            </h3>
        </div>
        <div class="p-5 sm:p-7">
            <form action="<?= base_url('admin/implementasi/verify/' . $proposal['id']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="grid md:grid-cols-3 gap-4 mb-6">
                    <!-- Approved -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="status" value="approved" class="peer sr-only" <?= $proposal['implementasi_status'] === 'approved' ? 'checked' : '' ?> required>
                        <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:border-emerald-300">
                            <div class="flex flex-col items-center text-center gap-2">
                                <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center peer-checked:bg-emerald-500 peer-checked:text-white transition-colors">
                                    <i class="fas fa-check text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-(--text-heading)">DISETUJUI</p>
                                    <p class="text-xs text-slate-500">Data lengkap dan valid</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Revision -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="status" value="revision" class="peer sr-only" <?= $proposal['implementasi_status'] === 'revision' ? 'checked' : '' ?>">
                        <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all hover:border-orange-300">
                            <div class="flex flex-col items-center text-center gap-2">
                                <div class="w-12 h-12 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center peer-checked:bg-orange-500 peer-checked:text-white transition-colors">
                                    <i class="fas fa-pen text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-(--text-heading)">PERLU REVISI</p>
                                    <p class="text-xs text-slate-500">Ada data yang perlu diperbaiki</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- Rejected -->
                    <label class="relative cursor-pointer">
                        <input type="radio" name="status" value="rejected" class="peer sr-only" <?= $proposal['implementasi_status'] === 'rejected' ? 'checked' : '' ?>">
                        <div class="p-4 rounded-xl border-2 border-slate-200 peer-checked:border-rose-500 peer-checked:bg-rose-50 transition-all hover:border-rose-300">
                            <div class="flex flex-col items-center text-center gap-2">
                                <div class="w-12 h-12 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center peer-checked:bg-rose-500 peer-checked:text-white transition-colors">
                                    <i class="fas fa-xmark text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-(--text-heading)">DITOLAK</p>
                                    <p class="text-xs text-slate-500">Data tidak valid, reset semua</p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>

                <div class="mb-6">
                    <label class="text-xs font-black text-slate-500 uppercase tracking-wider">Catatan Verifikasi</label>
                    <textarea name="catatan" rows="4" class="w-full mt-2 px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all" placeholder="Berikan catatan untuk mahasiswa..."><?= esc($proposal['implementasi_catatan'] ?? '') ?></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i>Simpan Verifikasi
                    </button>
                    <a href="<?= base_url('admin/implementasi') ?>" class="btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Image Modal -->
    <div x-show="imageModal.show" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4" @click.self="closeImageModal()">
        <div class="max-w-4xl w-full max-h-[90vh] flex flex-col" @click.stop>
            <div class="flex items-center justify-between p-4 bg-white rounded-t-2xl">
                <h4 class="font-bold text-slate-800" x-text="imageModal.title"></h4>
                <button @click="closeImageModal()" class="text-slate-500 hover:text-rose-500">
                    <i class="fas fa-xmark text-2xl"></i>
                </button>
            </div>
            <div class="bg-black flex-1 flex items-center justify-center rounded-b-2xl overflow-hidden">
                <img :src="imageModal.src" class="max-w-full max-h-[70vh] object-contain">
            </div>
        </div>
    </div>

</div>

<script>
    function implementasiDetail() {
        return {
            imageModal: {
                show: false,
                src: '',
                title: ''
            },

            handleMouseMove(e) {
                const card = e.currentTarget;
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            },

            openImageModal(src, title) {
                this.imageModal.src = src;
                this.imageModal.title = title;
                this.imageModal.show = true;
                document.body.style.overflow = 'hidden';
            },

            closeImageModal() {
                this.imageModal.show = false;
                document.body.style.overflow = '';
            }
        }
    }
</script>

<?= $this->endSection() ?>