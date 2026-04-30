<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8" x-data="{
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- 1. PAGE HEADING -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Validasi <span class="text-gradient">Implementasi</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Review Laporan Progress Tim Bimbingan Anda</p>
        </div>
    </div>

    <!-- 2. STATS -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <?php
        $statItems = [
            ['title' => 'Total Laporan', 'value' => $stats['total'], 'icon' => 'fa-users', 'bg' => 'bg-sky-50', 'color' => 'text-sky-500'],
            ['title' => 'Menunggu Review', 'value' => $stats['pending'], 'icon' => 'fa-clock', 'bg' => 'bg-amber-50', 'color' => 'text-amber-500'],
            ['title' => 'Disetujui', 'value' => $stats['approved'], 'icon' => 'fa-circle-check', 'bg' => 'bg-emerald-50', 'color' => 'text-emerald-500'],
            ['title' => 'Perlu Revisi', 'value' => $stats['revision'], 'icon' => 'fa-circle-exclamation', 'bg' => 'bg-orange-50', 'color' => 'text-orange-500'],
        ];
        ?>
        <?php foreach ($statItems as $i => $stat): ?>
        <div class="card-premium p-4 sm:p-5 flex items-center gap-3 sm:gap-4 animate-stagger delay-<?= ($i + 1) * 100 ?>" @mousemove="handleMouseMove">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl <?= $stat['bg'] ?> flex items-center justify-center shrink-0">
                <i class="fas <?= $stat['icon'] ?> text-lg sm:text-xl <?= $stat['color'] ?>"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] sm:text-[11px] font-black text-slate-400 uppercase tracking-wider truncate"><?= $stat['title'] ?></p>
                <h3 class="font-display text-xl sm:text-2xl font-black text-(--text-heading)"><?= $stat['value'] ?></h3>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- 3. FILTER TABS -->
    <div class="flex flex-wrap gap-2 animate-stagger delay-300">
        <a href="<?= base_url('dosen/implementasi') ?>"
           class="btn-outline btn-sm <?= !$statusFilter ? 'bg-sky-500 text-white border-sky-500' : '' ?>">
            Semua
        </a>
        <a href="<?= base_url('dosen/implementasi?status=pending') ?>"
           class="btn-outline btn-sm <?= $statusFilter === 'pending' ? 'bg-amber-500 text-white border-amber-500' : '' ?>">
            <i class="fas fa-clock mr-1.5"></i>Menunggu
        </a>
        <a href="<?= base_url('dosen/implementasi?status=approved') ?>"
           class="btn-outline btn-sm <?= $statusFilter === 'approved' ? 'bg-emerald-500 text-white border-emerald-500' : '' ?>">
            <i class="fas fa-circle-check mr-1.5"></i>Disetujui
        </a>
        <a href="<?= base_url('dosen/implementasi?status=revision') ?>"
           class="btn-outline btn-sm <?= $statusFilter === 'revision' ? 'bg-orange-500 text-white border-orange-500' : '' ?>">
            <i class="fas fa-circle-exclamation mr-1.5"></i>Perlu Revisi
        </a>
    </div>

    <!-- 4. PROPOSALS TABLE -->
    <div class="card-premium overflow-hidden animate-stagger delay-400">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">
                <i class="fas fa-clipboard-list text-sky-500 mr-2"></i>Antrian Laporan Implementasi
            </h3>
        </div>

        <?php if (empty($proposals)): ?>
            <div class="p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-inbox text-slate-300 text-2xl"></i>
                </div>
                <p class="text-slate-500 font-semibold">Belum ada laporan yang masuk</p>
                <p class="text-slate-400 text-[11px] mt-1">Laporan akan muncul setelah mahasiswa menekan tombol "Kirim Laporan"</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50/60 border-b border-slate-100">
                            <th class="text-left px-5 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400">#</th>
                            <th class="text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400">Tim / Ketua</th>
                            <th class="text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400 hidden lg:table-cell">Kategori</th>
                            <th class="text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400 hidden md:table-cell">Dikirim</th>
                            <th class="text-left px-4 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400">Status Dosen</th>
                            <th class="text-right px-5 py-3 text-[10px] font-black uppercase tracking-widest text-slate-400">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php foreach ($proposals as $i => $p): ?>
                        <?php
                            $statusColors = [
                                'pending'  => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200',
                                'approved' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200',
                                'revision' => 'bg-orange-50 text-orange-700 ring-1 ring-orange-200',
                            ];
                            $statusLabels = ['pending' => 'Menunggu', 'approved' => 'Disetujui', 'revision' => 'Perlu Revisi'];
                            $status = $p['dosen_status'] ?? 'pending';
                        ?>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-5 py-4 text-[11px] font-bold text-slate-400"><?= $i + 1 ?></td>
                            <td class="px-4 py-4">
                                <p class="text-sm font-bold text-slate-800"><?= esc($p['nama_usaha']) ?></p>
                                <p class="text-[11px] text-slate-400 mt-0.5"><?= esc($p['ketua_nama']) ?> · <?= esc($p['ketua_nim']) ?></p>
                            </td>
                            <td class="px-4 py-4 hidden lg:table-cell">
                                <span class="text-[11px] font-semibold text-slate-500 capitalize"><?= esc($p['kategori']) ?></span>
                            </td>
                            <td class="px-4 py-4 hidden md:table-cell">
                                <span class="text-[11px] font-mono text-slate-500">
                                    <?= date('d M Y H:i', strtotime($p['student_submitted_at'])) ?>
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black <?= $statusColors[$status] ?? $statusColors['pending'] ?>">
                                    <?= $statusLabels[$status] ?? 'Menunggu' ?>
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right">
                                <a href="<?= base_url('dosen/implementasi/' . $p['id']) ?>"
                                   class="btn-outline btn-sm text-[11px] group-hover:bg-sky-50 group-hover:text-sky-600 group-hover:border-sky-200">
                                    <i class="fas fa-eye mr-1.5"></i>Review
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>
