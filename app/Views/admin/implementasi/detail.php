<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-6" x-data="{
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Validasi Final <span class="text-gradient">Implementasi</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Validasi akhir oleh Admin setelah persetujuan Dosen Pendamping</p>
        </div>
        <a href="<?= base_url('admin/implementasi') ?>" class="btn-ghost inline-flex items-center gap-2 text-slate-500 hover:text-sky-600 transition-colors">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <?php
    $statusColors = [
        'pending'   => 'bg-slate-100 text-slate-600 border-slate-200',
        'approved'  => 'bg-emerald-100 text-emerald-600 border-emerald-200',
        'revision'  => 'bg-orange-100 text-orange-600 border-orange-200',
        'rejected'  => 'bg-rose-100 text-rose-600 border-rose-200',
    ];
    $statusLabels = [
        'pending'   => 'Menunggu Validasi',
        'approved'  => 'Disetujui Admin',
        'revision'  => 'Perlu Revisi',
        'rejected'  => 'Ditolak',
    ];
    $currentStatus = $proposal['implementasi_status'] ?: 'pending';
    $percent = min(100, ($totalPrice / ($proposal['total_rab'] ?: 1)) * 100);
    ?>

    <!-- ================================================================
         2. BENTO GRID LAYOUT
    ================================================================= -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 animate-stagger">

        <!-- CARD: HERO BUSINESS & FINANCIALS (Col 3) -->
        <div class="lg:col-span-3 card-premium overflow-hidden group/hero" @mousemove="handleMouseMove">
            <div class="absolute inset-0 bg-gradient-to-br from-sky-500/[0.03] to-violet-500/[0.03] pointer-events-none"></div>
            <div class="relative p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row justify-between items-start gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 rounded-md bg-sky-100 text-sky-600 text-[9px] font-black uppercase tracking-widest"><?= esc($proposal['kategori_wirausaha']) ?></span>
                            <span class="text-slate-300">•</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tight"><?= esc($proposal['period_name']) ?> <?= esc($proposal['period_year']) ?></span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl font-black text-(--text-heading) leading-tight mb-4 group-hover/hero:text-sky-600 transition-colors">
                            <?= esc($proposal['nama_usaha']) ?>
                        </h3>

                        <div class="grid grid-cols-2 gap-8 mt-8">
                            <div>
                                <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] mb-2">Realisasi Dana</p>
                                <div class="flex items-baseline gap-2">
                                    <span class="text-2xl font-black text-emerald-600">Rp <?= number_format($totalPrice, 0, ',', '.') ?></span>
                                    <span class="text-[11px] font-bold text-slate-400">/ Rp <?= number_format($proposal['total_rab'] ?? 0, 0, ',', '.') ?></span>
                                </div>
                                <!-- Progress Bar -->
                                <div class="mt-3 w-full h-2 bg-slate-100 rounded-full overflow-hidden border border-slate-50">
                                    <div class="h-full bg-linear-to-r from-emerald-500 to-sky-500 rounded-full transition-all duration-1000" style="width: <?= $percent ?>%"></div>
                                </div>
                                <p class="mt-1.5 text-[10px] font-bold text-slate-400"><?= number_format($percent, 1) ?>% Dana Terserap</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD: QUICK STATUS (Col 1) -->
        <div class="lg:col-span-1 card-premium flex flex-col justify-between overflow-hidden group/status" @mousemove="handleMouseMove">
            <div class="p-6 flex flex-col h-full">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6">Status Validasi</p>

                <div class="flex-1 flex flex-col items-center justify-center text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-slate-50 border-4 border-white shadow-xl mb-4 transition-transform group-hover/status:scale-110">
                        <?php if ($currentStatus === 'approved'): ?>
                            <i class="fas fa-check-circle text-4xl text-emerald-500"></i>
                        <?php elseif ($currentStatus === 'revision'): ?>
                            <i class="fas fa-rotate-left text-4xl text-orange-500"></i>
                        <?php else: ?>
                            <i class="fas fa-clock text-4xl text-sky-500 opacity-20"></i>
                        <?php endif; ?>
                    </div>
                    <span class="pmw-status <?= $statusColors[$currentStatus] ?> text-xs px-4 py-1.5 shadow-sm">
                        <?= $statusLabels[$currentStatus] ?>
                    </span>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-50">
                    <div class="flex items-center justify-between text-[10px]">
                        <span class="font-bold text-slate-400 uppercase tracking-tighter">Dikirim Pada</span>
                        <span class="font-black text-slate-700"><?= $proposal['student_submitted_at'] ? date('d M, H:i', strtotime($proposal['student_submitted_at'])) : '-' ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD: TEAM MEMBERS (Col 2) -->
        <div class="lg:col-span-2 card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="text-xs font-black uppercase tracking-widest text-slate-400">Anggota Tim</h4>
                    <span class="px-2 py-0.5 rounded-md bg-slate-50 text-slate-500 text-[10px] font-bold"><?= count($members) ?> Orang</span>
                </div>
                <div class="grid sm:grid-cols-2 gap-3">
                    <?php foreach ($members as $member): ?>
                        <div class="flex items-center gap-3 p-3 rounded-2xl bg-white border border-slate-50 hover:border-sky-200 hover:shadow-md transition-all cursor-pointer group"
                            onclick='openBiodataModal("mahasiswa", <?= json_encode($member, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                            <div class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 group-hover:bg-sky-500 group-hover:text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm transition-all overflow-hidden border border-slate-50">
                                <?= strtoupper(substr(esc((string)$member['nama']), 0, 1)) ?>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[12px] font-bold text-slate-700 truncate group-hover:text-sky-600 transition-colors"><?= esc($member['nama']) ?></p>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-tighter mt-0.5"><?= esc($member['role']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- CARD: LECTURER INFO (Col 2) -->
        <div class="lg:col-span-2 card-premium overflow-hidden group/dosen" @mousemove="handleMouseMove">
            <div class="p-6">
                <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-6">Persetujuan Dosen</h4>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col sm:flex-row items-center gap-6">
                    <div class="shrink-0">
                        <div class="w-14 h-14 rounded-2xl bg-white border border-slate-100 text-sky-500 flex items-center justify-center shadow-sm">
                            <i class="fas fa-chalkboard-user text-2xl"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-center sm:text-left min-w-0">
                        <p class="text-sm font-bold text-slate-800 truncate"><?= esc($proposal['dosen_nama']) ?></p>
                        <p class="text-[10px] font-bold text-slate-400 mt-0.5 uppercase tracking-wide">NIP: <?= esc($proposal['dosen_nip']) ?></p>
                    </div>
                    <?php if ($proposal['dosen_status'] === 'approved'): ?>
                        <div class="shrink-0 flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-500 text-white shadow-lg shadow-emerald-100">
                            <i class="fas fa-shield-check text-xs"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest">VERIFIED</span>
                        </div>
                    <?php else: ?>
                        <div class="shrink-0 animate-pulse flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-100 text-amber-600">
                            <i class="fas fa-hourglass-half text-xs"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest">WAITING</span>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($proposal['dosen_status'] === 'approved'): ?>
                    <div class="mt-4 p-4 rounded-xl bg-white border border-slate-50 italic text-[11px] text-slate-500 leading-relaxed relative">
                        <i class="fas fa-quote-left absolute -top-2 left-3 text-slate-100 text-2xl -z-0"></i>
                        <span class="relative z-10">&quot;<?= esc($proposal['dosen_catatan'] ?: 'Laporan telah diperiksa dan disetujui.') ?>&quot;</span>
                        <p class="mt-2 text-[9px] font-black text-slate-300 uppercase tracking-tighter not-italic text-right">
                            Disetujui: <?= date('d/m/Y H:i', strtotime($proposal['dosen_verified_at'])) ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- CARD: ITEMS & ASSETS (Col 3) -->
        <div class="lg:col-span-3 card-premium overflow-hidden" @mousemove="handleMouseMove">
            <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between bg-white/60">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Daftar Komponen</h4>
                <span class="text-[10px] font-black px-2 py-0.5 rounded-full bg-sky-100 text-sky-600"><?= count($items) ?> Komponen</span>
            </div>
            <div class="max-h-[500px] overflow-y-auto divide-y divide-slate-50 custom-scrollbar">
                <?php if (empty($items)): ?>
                    <div class="p-12 text-center text-slate-400">
                        <i class="fas fa-cubes-stacked text-3xl opacity-20 mb-3 block"></i>
                        <p class="text-xs font-bold uppercase tracking-widest">Belum ada data komponen</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($items as $item): ?>
                        <div class="p-6 hover:bg-slate-50/50 transition-colors group/item">
                            <div class="flex flex-col sm:flex-row gap-6">
                                <div class="flex-1">
                                    <?php if ($item->category): 
                                        $categoryLabels = [
                                            'bahan' => 'Bahan/Perlengkapan',
                                            'alat' => 'Alat/Mesin',
                                            'legalitas' => 'Legalitas',
                                            'tempat' => 'Tempat',
                                            'kemasan' => 'Kemasan',
                                            'lainnya' => 'Lainnya'
                                        ];
                                        $catLabel = $categoryLabels[$item->category] ?? $item->category;
                                        $catClass = match($item->category) {
                                            'bahan' => 'bg-blue-100 text-blue-700 border-blue-200',
                                            'alat' => 'bg-purple-100 text-purple-700 border-purple-200',
                                            'legalitas' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                            'tempat' => 'bg-orange-100 text-orange-700 border-orange-200',
                                            'kemasan' => 'bg-pink-100 text-pink-700 border-pink-200',
                                            default => 'bg-slate-100 text-slate-600 border-slate-200'
                                        };
                                    ?>
                                        <span class="text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md border <?= $catClass ?> mb-1 inline-block"><?= $catLabel ?></span>
                                    <?php endif; ?>
                                    <h5 class="text-sm font-black text-slate-800 mb-1 group-hover/item:text-sky-600 transition-colors"><?= esc($item->item_title) ?></h5>
                                    <p class="text-[11px] text-slate-500 leading-relaxed"><?= esc($item->item_description ?: 'Tidak ada deskripsi.') ?></p>
                                    <div class="flex flex-wrap gap-6 mt-4">
                                        <div class="text-center sm:text-left">
                                            <p class="text-[8px] font-black text-slate-300 uppercase tracking-[0.2em] mb-1">QTY</p>
                                            <p class="text-xs font-bold text-slate-700"><?= number_format($item->qty ?: 1, 0, ',', '.') ?> Unit</p>
                                        </div>
                                        <div class="text-center sm:text-left">
                                            <p class="text-[8px] font-black text-slate-300 uppercase tracking-[0.2em] mb-1">Satuan</p>
                                            <p class="text-xs font-bold text-slate-700">Rp <?= number_format($item->price, 0, ',', '.') ?></p>
                                        </div>
                                        <div class="text-center sm:text-left">
                                            <p class="text-[8px] font-black text-slate-300 uppercase tracking-[0.2em] mb-1">Subtotal</p>
                                            <p class="text-xs font-black text-emerald-600">Rp <?= number_format(($item->qty ?: 1) * $item->price, 0, ',', '.') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="shrink-0">
                                    <div class="flex flex-wrap sm:flex-nowrap gap-2">
                                        <?php if (!empty($item->photos)): ?>
                                            <?php foreach ($item->photos as $ph): ?>
                                                <button type="button"
                                                    onclick="openImagePreview('<?= base_url('admin/implementasi/photo/' . $ph->id) ?>', 'Foto Komponen: <?= esc($item->item_title) ?>')"
                                                    class="block w-20 h-20 rounded-2xl overflow-hidden border-2 border-white shadow-sm hover:border-sky-400 transition-all group relative">
                                                    <img src="<?= base_url('admin/implementasi/photo/' . $ph->id) ?>" alt="Photo" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                                        <i class="fas fa-expand text-white text-[10px]"></i>
                                                    </div>
                                                </button>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="w-20 h-20 rounded-2xl bg-slate-50 border border-dashed border-slate-200 flex flex-col items-center justify-center text-slate-300 gap-1 text-center px-1">
                                                <i class="fas fa-image text-lg opacity-40"></i>
                                                <span class="text-[7px] font-black uppercase tracking-tighter leading-tight">No Photo</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- SIDEBAR PROOFS (Col 1) -->
        <div class="lg:col-span-1 flex flex-col gap-6">
            <!-- Payment Proofs -->
            <div class="card-premium flex-1 overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 py-4 border-b border-slate-50 bg-white/60">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Bukti Bayar / Nota</h4>
                </div>
                <div class="p-4 space-y-2 max-h-[300px] overflow-y-auto">
                    <?php if (empty($payments)): ?>
                        <div class="py-10 text-center text-slate-300 text-[10px] font-bold uppercase tracking-widest">Kosong</div>
                    <?php else: ?>
                        <?php foreach ($payments as $p): ?>
                            <a href="<?= base_url('admin/implementasi/payment/' . $p->id) ?>" target="_blank"
                                class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 hover:bg-violet-50 hover:text-violet-600 transition-all group">
                                <i class="fas fa-file-invoice-dollar text-violet-400 group-hover:scale-110 transition-transform"></i>
                                <span class="text-[11px] font-bold truncate flex-1"><?= esc($p->payment_title) ?></span>
                                <i class="fas fa-external-link-alt text-[9px] opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Konsumsi Gallery -->
            <div class="card-premium flex-1 overflow-hidden" @mousemove="handleMouseMove">
                <div class="px-5 py-4 border-b border-slate-50 bg-white/60 flex items-center justify-between">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.15em] text-slate-400">Dok. Konsumsi</h4>
                    <span class="text-[10px] font-black text-amber-500"><?= count($konsumsi) ?></span>
                </div>
                <div class="p-4 flex items-center justify-start overflow-x-auto no-scrollbar py-8">
                    <?php if (empty($konsumsi)): ?>
                        <div class="w-full py-6 text-center text-slate-300 text-[10px] font-bold uppercase tracking-widest">Belum Ada Dokumentasi</div>
                    <?php else: ?>
                        <div class="flex items-center -space-x-4 px-2">
                            <?php foreach ($konsumsi as $idx => $k): ?>
                                <button type="button"
                                    onclick="openImagePreview('<?= base_url('admin/implementasi/konsumsi/' . $k->id) ?>', 'Dokumentasi Konsumsi #<?= $idx + 1 ?>')"
                                    class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl overflow-hidden border-4 border-white shadow-lg bg-slate-100 hover:z-10 hover:-translate-y-2 hover:scale-110 transition-all duration-300 grow-0 shrink-0 first:ml-0 group relative cursor-pointer ring-1 ring-slate-100/50">
                                    <img src="<?= base_url('admin/implementasi/konsumsi/' . $k->id) ?>" alt="Konsumsi" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                        <i class="fas fa-expand text-white text-[10px]"></i>
                                    </div>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- CARD: FINAL VALIDATION (Col 4) -->
        <div class="lg:col-span-4 mt-4 animate-stagger delay-300">
            <?php if ($proposal['dosen_status'] === 'approved'): ?>
                <div class="card-premium overflow-hidden animate-stagger delay-400 border-l-4 border-l-sky-500" @mousemove="handleMouseMove" id="validation-section">
                    <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60">
                        <h3 class="font-display text-base font-bold text-(--text-heading)">
                            <i class="fas fa-shield-halved text-sky-500 mr-2"></i>
                            Keputusan Admin UPAPKK
                        </h3>
                        <p class="text-[11px] text-(--text-muted) mt-0.5">Berikan penilaian final untuk laporan implementasi mahasiswa</p>
                    </div>

                    <form action="<?= base_url('admin/implementasi/verify/' . $proposal['id']) ?>" method="POST" id="validationForm">
                        <?= csrf_field() ?>
                        <div class="p-5 sm:p-7 space-y-6">
                            <!-- Status Selection -->
                            <div>
                                <label class="form-label mb-3 block text-xs font-black uppercase tracking-widest text-slate-400">Tindakan Validasi</label>
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <!-- Setujui -->
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="status" value="approved" class="peer sr-only" <?= $currentStatus === 'approved' ? 'checked' : '' ?> required>
                                        <div class="p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all hover:border-emerald-200 group">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 peer-checked:bg-emerald-500 peer-checked:text-white transition-colors flex items-center justify-center">
                                                    <i class="fas fa-circle-check"></i>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-(--text-heading) text-sm leading-tight">Setujui Laporan</p>
                                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">Sah / Final</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>

                                    <!-- Revisi -->
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="status" value="revision" class="peer sr-only" <?= $currentStatus === 'revision' ? 'checked' : '' ?>>
                                        <div class="p-4 rounded-2xl border-2 border-slate-100 peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all hover:border-orange-200">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 peer-checked:bg-orange-500 peer-checked:text-white transition-colors flex items-center justify-center">
                                                    <i class="fas fa-rotate-left"></i>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-(--text-heading) text-sm leading-tight">Minta Revisi</p>
                                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">Butuh Perbaikan</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Catatan -->
                            <div class="space-y-1.5">
                                <label class="form-label text-xs font-black uppercase tracking-widest text-slate-400">Catatan Feedback</label>
                                <div class="input-group items-start py-2 focus-within:ring-4 focus-within:ring-sky-50 transition-all">
                                    <div class="input-icon mt-2 text-slate-400">
                                        <i class="fas fa-comment-dots"></i>
                                    </div>
                                    <textarea name="catatan" rows="4" placeholder="Berikan instruksi final untuk mahasiswa..." class="bg-transparent border-none outline-none w-full text-sm font-medium leading-relaxed"><?= esc($proposal['implementasi_catatan'] ?? '') ?></textarea>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-end gap-3 pt-4 border-t border-slate-50">
                                <button type="submit" class="btn-primary w-full sm:w-auto px-10 py-3 shadow-lg shadow-sky-100 font-black text-xs uppercase tracking-widest">
                                    <i class="fas fa-save mr-2"></i>Simpan Validasi Final
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <!-- Banner blockade when Dosen hasn't approved -->
                <div class="card-premium p-8 sm:p-12 border-l-8 border-l-amber-500 bg-linear-to-r from-amber-50/30 to-white/30 animate-pulse" @mousemove="handleMouseMove">
                    <div class="flex flex-col sm:flex-row items-center gap-10 text-center sm:text-left">
                        <div class="w-28 h-28 rounded-[2.5rem] bg-amber-100 text-amber-600 flex items-center justify-center shrink-0 shadow-2xl shadow-amber-50/50 relative">
                            <i class="fas fa-lock text-5xl"></i>
                            <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-lg">
                                <i class="fas fa-exclamation text-amber-600 text-xs"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-slate-800 leading-tight">Validasi Final <span class="text-amber-600">Terkunci</span></h3>
                            <p class="text-sm text-slate-500 mt-4 max-w-2xl leading-relaxed font-medium italic">
                                Sesuai prosedur operasional standar, Admin baru dapat melakukan validasi implementasi apabila <span class="font-bold text-slate-800">Dosen Pendamping</span> telah menyetujui laporan ini terlebih dahulu.
                            </p>
                            <div class="mt-8 flex items-center gap-4 bg-white/50 w-fit px-5 py-3 rounded-2xl border border-amber-50 shadow-sm">
                                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shadow-lg shadow-amber-100 shrink-0">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="text-left">
                                    <p class="text-[9px] font-black text-amber-800 uppercase tracking-widest leading-none mb-1">Status Saat Ini</p>
                                    <p class="text-xs font-black text-amber-600 uppercase">DOSEN: <?= strtoupper($proposal['dosen_status'] ?: 'MENUNGGU') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- ================================================================
     BIODATA MODAL
================================================================= -->
<div id="biodataModal" class="fixed inset-0 z-50 hidden" aria-labelledby="biodata-modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeBiodataModal()"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                <!-- Modal Header -->
                <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-display font-bold text-white" id="biodata-modal-title">
                            <i class="fas fa-user-graduate mr-2"></i>Detail Mahasiswa
                        </h3>
                        <button type="button" onclick="closeBiodataModal()" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-5">
                    <!-- Avatar & Info -->
                    <div class="text-center mb-6">
                        <div id="modal-avatar" class="w-20 h-20 mx-auto rounded-3xl flex items-center justify-center text-white font-display font-black text-2xl mb-4 shadow-xl">
                            --
                        </div>
                        <h4 id="modal-nama" class="font-display font-black text-xl text-slate-800">--</h4>
                        <span id="modal-role-badge" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-black border mt-3 uppercase tracking-widest">
                            --
                        </span>
                    </div>

                    <!-- Details Grid -->
                    <div id="modal-content" class="grid md:grid-cols-2 gap-4 px-4 pb-4"></div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-slate-50 px-6 py-4 flex justify-end border-t border-slate-100">
                    <button type="button" onclick="closeBiodataModal()" class="btn-outline text-sm">
                        <i class="fas fa-times mr-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openBiodataModal(type, data) {
        const modal = document.getElementById('biodataModal');
        const avatar = document.getElementById('modal-avatar');
        const nama = document.getElementById('modal-nama');
        const roleBadge = document.getElementById('modal-role-badge');
        const content = document.getElementById('modal-content');

        const bgColor = 'bg-sky-500';
        const roleLabel = data.role === 'ketua' ? 'Ketua Tim' : 'Anggota Tim';

        const initials = (data.nama || '??').substring(0, 2).toUpperCase();
        avatar.textContent = initials;
        avatar.className = `w-20 h-20 mx-auto rounded-3xl ${bgColor} flex items-center justify-center text-white font-display font-black text-2xl mb-4 shadow-xl`;

        nama.textContent = data.nama || '-';
        roleBadge.textContent = roleLabel;
        roleBadge.className = `inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-black border bg-sky-50 text-sky-600 border-sky-200 uppercase tracking-widest`;

        let html = '';
        const fields = [
            { icon: 'fa-id-card', label: 'NIM', value: data.nim },
            { icon: 'fa-building', label: 'Jurusan', value: data.jurusan },
            { icon: 'fa-graduation-cap', label: 'Prodi', value: data.prodi },
            { icon: 'fa-calendar-alt', label: 'Semester', value: data.semester },
            { icon: 'fa-phone', label: 'No. HP', value: data.phone },
            { icon: 'fa-envelope', label: 'Email', value: data.email },
        ];

        fields.forEach(f => {
            if (f.value) {
                html += `
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100 group/item hover:border-sky-200 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 group-hover/item:text-sky-500 transition-colors shrink-0">
                        <i class="fas ${f.icon} text-xs"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest">${f.label}</p>
                        <p class="text-[12px] font-bold text-slate-700 truncate">${f.value}</p>
                    </div>
                </div>`;
            }
        });

        content.innerHTML = html || '<p class="text-center text-slate-400 py-4 font-bold uppercase text-[10px] tracking-widest">Tidak ada data tambahan</p>';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeBiodataModal() {
        document.getElementById('biodataModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    /* ================================================================
       IMAGE PREVIEW MODAL LOGIC
    ================================================================ */
    function openImagePreview(url, title) {
        const modal = document.getElementById('imagePreviewModal');
        const img = document.getElementById('previewImg');
        const titleEl = document.getElementById('previewTitle');
        const downloadBtn = document.getElementById('downloadBtn');

        img.src = url;

        // Update title badge
        const titleSpan = titleEl.querySelector('span');
        titleSpan.textContent = title || 'Preview Gambar';

        // Update download button
        downloadBtn.href = url;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeImagePreview() {
        document.getElementById('imagePreviewModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Global Escape key handler
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (!document.getElementById('biodataModal').classList.contains('hidden')) closeBiodataModal();
            if (!document.getElementById('imagePreviewModal').classList.contains('hidden')) closeImagePreview();
        }
    });
</script>

<!-- ================================================================
     IMAGE PREVIEW MODAL
================================================================= -->
<div id="imagePreviewModal" class="fixed inset-0 z-[120] hidden" aria-labelledby="preview-modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeImagePreview()"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                <!-- Modal Header -->
                <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-display font-bold text-white" id="preview-modal-title">
                            <i class="fas fa-eye mr-2"></i>Preview Gambar
                        </h3>
                        <button type="button" onclick="closeImagePreview()" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-5 bg-slate-50">
                    <!-- Image Title Badge -->
                    <div class="mb-4">
                        <span id="previewTitle" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border bg-emerald-50 text-emerald-600 border-emerald-200">
                            <i class="fas fa-image text-[10px]"></i>
                            <span class="truncate max-w-[300px]">Preview Gambar</span>
                        </span>
                    </div>

                    <!-- Image Content -->
                    <div class="rounded-xl overflow-hidden bg-white border border-slate-200 shadow-sm p-4 flex items-center justify-center min-h-[300px] max-h-[500px]">
                        <img id="previewImg" src="" alt="Preview" class="max-w-full max-h-[450px] rounded-lg object-contain">
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-white px-6 py-4 flex justify-between items-center border-t border-slate-100">
                    <div class="flex items-center gap-2 text-xs text-slate-400">
                        <i class="fas fa-info-circle"></i>
                        <span>Image Preview • Klik untuk memperbesar</span>
                    </div>
                    <div class="flex gap-2">
                        <a id="downloadBtn" href="#" target="_blank" class="btn-accent text-sm" onclick="window.open(document.getElementById('previewImg').src, '_blank'); return false;">
                            <i class="fas fa-external-link-alt mr-2"></i>Buka di Tab Baru
                        </a>
                        <button type="button" onclick="closeImagePreview()" class="btn-outline text-sm">
                            <i class="fas fa-times mr-2"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>