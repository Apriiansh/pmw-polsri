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

    <!-- Header with Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="card-premium p-4 flex items-center gap-4" @mousemove="handleMouseMove">
            <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center">
                <i class="fas fa-users text-sky-500 text-lg"></i>
            </div>
            <div>
                <p class="text-[10px] text-slate-400 font-bold uppercase">TIM Dana 1</p>
                <p class="text-xl font-bold text-slate-800"><?= number_format($stats['total']) ?></p>
            </div>
        </div>
        <div class="card-premium p-4 flex items-center gap-4" @mousemove="handleMouseMove">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                <i class="fas fa-user-tie text-emerald-500 text-lg"></i>
            </div>
            <div>
                <p class="text-[10px] text-slate-400 font-bold uppercase">Dengan Mentor</p>
                <p class="text-xl font-bold text-emerald-600"><?= number_format($stats['with_mentor']) ?></p>
            </div>
        </div>
        <div class="card-premium p-4 flex items-center gap-4" @mousemove="handleMouseMove">
            <div class="w-12 h-12 rounded-xl bg-violet-100 flex items-center justify-center">
                <i class="fas fa-university text-violet-500 text-lg"></i>
            </div>
            <div>
                <p class="text-[10px] text-slate-400 font-bold uppercase">Dengan Rekening</p>
                <p class="text-xl font-bold text-violet-600"><?= number_format($stats['with_bank']) ?></p>
            </div>
        </div>
        <div class="card-premium p-4 flex items-center gap-4" @mousemove="handleMouseMove">
            <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                <i class="fas fa-chart-line text-amber-500 text-base"></i>
            </div>
            <div class="flex flex-col gap-1.5 flex-1 min-w-0">
                <div class="flex justify-between items-center">
                    <p class="text-[9px] text-slate-400 font-bold uppercase truncate">Bimbingan</p>
                    <p class="text-xs font-black text-amber-600"><?= number_format($stats['total_bimbingan']) ?>x</p>
                </div>
                <div class="flex justify-between items-center border-t border-slate-50 pt-1">
                    <p class="text-[9px] text-slate-400 font-bold uppercase truncate">Mentoring</p>
                    <p class="text-xs font-black text-emerald-600"><?= number_format($stats['total_mentoring']) ?>x</p>
                </div>
                <div class="flex justify-between items-center border-t border-slate-50 pt-1">
                    <p class="text-[9px] text-slate-400 font-bold uppercase truncate">Kegiatan</p>
                    <p class="text-xs font-black text-violet-600"><?= number_format($stats['total_kegiatan']) ?>x</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card-premium p-4" @mousemove="handleMouseMove">
        <form method="GET" action="<?= base_url('admin/teams') ?>" class="flex flex-wrap items-end gap-3">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1.5">Cari TIM</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" name="search" value="<?= esc($search ?? '') ?>"
                        placeholder="Nama usaha, ketua, atau NIM..."
                        class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                </div>
            </div>
            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1.5">Periode</label>
                <select name="period" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                    <option value="">Semua Periode</option>
                    <?php foreach ($periods as $period): ?>
                        <option value="<?= $period['id'] ?>" <?= ($periodFilter == $period['id']) ? 'selected' : '' ?>>
                            <?= esc($period['name']) ?> <?= esc($period['year']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="btn-primary text-sm px-4">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                <?php if ($search || $periodFilter): ?>
                    <a href="<?= base_url('admin/teams') ?>" class="btn-outline text-sm px-4">
                        <i class="fas fa-times mr-2"></i>Reset
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Teams Table -->
    <div class="card-premium overflow-hidden" @mousemove="handleMouseMove">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-[11px] font-bold text-slate-500 uppercase">TIM & Usaha</th>
                        <th class="px-4 py-3 text-left text-[11px] font-bold text-slate-500 uppercase">Anggota</th>
                        <th class="px-4 py-3 text-left text-[11px] font-bold text-slate-500 uppercase">Dosen Pendamping dan Mentor</th>
                        <th class="px-4 py-3 text-left text-[11px] font-bold text-slate-500 uppercase">Periode</th>
                        <th class="px-4 py-3 text-left text-[11px] font-bold text-slate-500 uppercase">Total Bimbingan</th>
                        <th class="px-4 py-3 text-left text-[11px] font-bold text-slate-500 uppercase">Total Mentoring</th>
                        <th class="px-4 py-3 text-left text-[11px] font-bold text-slate-500 uppercase">Total Kegiatan</th>
                        <th class="px-4 py-3 text-center text-[11px] font-bold text-slate-500 uppercase">Laporan Milestone</th>
                        <th class="px-4 py-3 text-center text-[11px] font-bold text-slate-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if (empty($teams)): ?>
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center text-slate-400">
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-users-slash text-2xl"></i>
                                </div>
                                <p class="font-bold text-slate-500">Tidak ada data TIM</p>
                                <p class="text-xs mt-1">Belum ada tim peserta yang terdaftar</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($teams as $team): ?>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <!-- TIM & Usaha -->
                                <td class="px-4 py-4">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-linear-to-tr from-sky-500 to-sky-400 flex items-center justify-center text-white font-bold text-sm shrink-0">
                                            <?= substr(esc($team['ketua_nama'] ?? '?'), 0, 1) ?>
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800"><?= esc($team['nama_usaha'] ?? 'Tanpa Nama') ?></p>
                                            <p class="text-[11px] text-slate-500">
                                                <i class="fas fa-user text-sky-400 mr-1"></i>
                                                <?= esc($team['ketua_nama'] ?? '-') ?>
                                                <span class="text-slate-400">(<?= esc($team['ketua_nim'] ?? '-') ?>)</span>
                                            </p>
                                            <p class="text-[10px] text-slate-400 mt-0.5">
                                                <?= esc($team['kategori_usaha'] ?? '-') ?> • Rp <?= number_format($team['total_rab'] ?? 0, 0, ',', '.') ?>
                                            </p>
                                            <?php if (!empty($team['ketua_prodi'])): ?>
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-slate-100 text-slate-500 text-[10px] mt-1">
                                                    <i class="fas fa-graduation-cap"></i>
                                                    <?= esc($team['ketua_prodi']) ?> - <?= esc($team['ketua_jurusan'] ?? '-') ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                <!-- Anggota -->
                                <td class="px-4 py-4">
                                    <?php if ($team['member_count'] > 0): ?>
                                        <div class="flex items-center gap-1">
                                            <span class="w-6 h-6 rounded-full bg-sky-100 text-sky-600 flex items-center justify-center text-[10px] font-bold">
                                                <?= $team['member_count'] ?>
                                            </span>
                                            <span class="text-[11px] text-slate-500">anggota</span>
                                        </div>
                                        <?php
                                        $members = explode('|', $team['members_list'] ?? '');
                                        foreach ($members as $member):
                                            if (strpos($member, 'anggota:') !== false):
                                                $member = str_replace('anggota:', '', $member);
                                        ?>
                                                <p class="text-[10px] text-slate-400 mt-0.5 pl-7">• <?= esc($member) ?></p>
                                        <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    <?php else: ?>
                                        <span class="text-[11px] text-slate-400">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Pembimbing -->
                                <td class="px-4 py-4">
                                    <?php if ($team['dosen_nama']): ?>
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-lg bg-violet-100 flex items-center justify-center">
                                                <i class="fas fa-chalkboard-user text-violet-500 text-xs"></i>
                                            </div>
                                            <div>
                                                <p class="text-[11px] font-semibold text-slate-700"><?= esc($team['dosen_nama']) ?></p>
                                                <p class="text-[10px] text-slate-400">Dosen</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($team['mentor_nama']): ?>
                                        <div class="flex items-center gap-2 mt-1">
                                            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                                                <i class="fas fa-user-tie text-emerald-500 text-xs"></i>
                                            </div>
                                            <div>
                                                <p class="text-[11px] font-semibold text-slate-700"><?= esc($team['mentor_nama']) ?></p>
                                                <p class="text-[10px] text-slate-400">Mentor</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!$team['dosen_nama'] && !$team['mentor_nama']): ?>
                                        <span class="text-[11px] text-slate-400">Belum ditugaskan</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Periode -->
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-[11px] font-semibold">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?= esc($team['period_name']) ?> <?= esc($team['period_year']) ?>
                                    </span>
                                </td>

                                <!-- Total Bimbingan -->
                                <td class="px-4 py-4 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full <?= $team['total_bimbingan'] > 0 ? 'bg-amber-50 text-amber-600 border border-amber-100' : 'bg-slate-50 text-slate-400 border border-slate-100' ?> text-[11px] font-bold transition-all">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                        <?= number_format($team['total_bimbingan']) ?>x
                                    </span>
                                </td>

                                <!-- Total Mentoring -->
                                <td class="px-4 py-4 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full <?= $team['total_mentoring'] > 0 ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-slate-50 text-slate-400 border border-slate-100' ?> text-[11px] font-bold transition-all">
                                        <i class="fas fa-user-tie"></i>
                                        <?= number_format($team['total_mentoring']) ?>x
                                    </span>
                                </td>

                                <!-- Total Kegiatan -->
                                 <td class="px-4 py-4 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full <?= $team['total_kegiatan'] > 0 ? 'bg-violet-50 text-violet-600 border border-violet-100' : 'bg-slate-50 text-slate-400 border border-slate-100' ?> text-[11px] font-bold transition-all">
                                        <i class="fas fa-store"></i>
                                        <?= number_format($team['total_kegiatan']) ?>x
                                    </span>
                                </td>

                                <!-- Milestone Reports -->
                                <td class="px-4 py-4">
                                    <div class="flex flex-col gap-1.5 items-center">
                                        <!-- Kemajuan -->
                                        <div class="flex items-center justify-between w-full max-w-[120px] px-2 py-1 rounded bg-slate-50 border border-slate-100">
                                            <span class="text-[9px] font-bold text-slate-400 uppercase">KMJ</span>
                                            <?php if ($team['kemajuan_status'] === 'approved'): ?>
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]" title="Laporan Kemajuan: Approved"></span>
                                            <?php elseif ($team['kemajuan_status'] === 'pending'): ?>
                                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse" title="Laporan Kemajuan: Pending Review"></span>
                                            <?php elseif ($team['kemajuan_status'] === 'rejected'): ?>
                                                <span class="w-2 h-2 rounded-full bg-rose-500" title="Laporan Kemajuan: Rejected"></span>
                                            <?php else: ?>
                                                <span class="w-2 h-2 rounded-full bg-slate-200" title="Laporan Kemajuan: Belum Upload"></span>
                                            <?php endif; ?>
                                        </div>
                                        <!-- Akhir -->
                                        <div class="flex items-center justify-between w-full max-w-[120px] px-2 py-1 rounded bg-slate-50 border border-slate-100">
                                            <span class="text-[9px] font-bold text-slate-400 uppercase">AKH</span>
                                            <?php if ($team['akhir_status'] === 'approved'): ?>
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]" title="Laporan Akhir: Approved"></span>
                                            <?php elseif ($team['akhir_status'] === 'pending'): ?>
                                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse" title="Laporan Akhir: Pending Review"></span>
                                            <?php elseif ($team['akhir_status'] === 'rejected'): ?>
                                                <span class="w-2 h-2 rounded-full bg-rose-500" title="Laporan Akhir: Rejected"></span>
                                            <?php else: ?>
                                                <span class="w-2 h-2 rounded-full bg-slate-200" title="Laporan Akhir: Belum Upload"></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                <!-- Aksi -->
                                <td class="px-4 py-4">
                                    <div class="flex items-center justify-center gap-1">
                                        <!-- Detail -->
                                        <a href="<?= base_url('admin/teams/' . $team['proposal_id']) ?>"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-sky-50 text-sky-500 hover:bg-sky-500 hover:text-white transition-all"
                                            title="Detail TIM">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>

                                        <!-- Bank Account -->
                                        <?php if ($team['bank_account']): ?>
                                            <button type="button"
                                                onclick='openBankModal(<?= json_encode($team['bank_account']) ?>)'
                                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-emerald-50 text-emerald-500 hover:bg-emerald-500 hover:text-white transition-all"
                                                title="Rekening Bank">
                                                <i class="fas fa-university text-xs"></i>
                                            </button>
                                        <?php endif; ?>

                                        <!-- Proposal Link -->
                                        <a href="<?= base_url('admin/administrasi/seleksi/' . $team['proposal_id']) ?>"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-violet-50 text-violet-500 hover:bg-violet-500 hover:text-white transition-all"
                                            title="Lihat Proposal">
                                            <i class="fas fa-file-alt text-xs"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bank Account Modal -->
<div id="bankModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeBankModal()"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                <!-- Modal Header -->
                <div class="bg-linear-to-r from-emerald-500 to-emerald-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-display font-bold text-white" id="modal-title">
                            <i class="fas fa-university mr-2"></i>Data Rekening Bank
                        </h3>
                        <button type="button" onclick="closeBankModal()" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-5">
                    <div class="space-y-4">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-[11px] text-slate-400 font-bold uppercase mb-1">Nama Pemilik Rekening</p>
                            <p id="bank-account-holder" class="text-sm font-bold text-slate-800">--</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <p class="text-[11px] text-slate-400 font-bold uppercase mb-1">Nama Bank</p>
                                <p id="bank-name" class="text-sm font-bold text-slate-800">--</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                                <p class="text-[11px] text-slate-400 font-bold uppercase mb-1">Kantor Cabang</p>
                                <p id="bank-branch" class="text-sm font-bold text-slate-800">--</p>
                            </div>
                        </div>

                        <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                            <p class="text-[11px] text-emerald-500 font-bold uppercase mb-1">Nomor Rekening</p>
                            <p id="bank-account-number" class="text-lg font-mono font-bold text-emerald-700">--</p>
                        </div>

                        <div id="bank-description-section" class="hidden">
                            <p class="text-[11px] text-slate-400 font-bold uppercase mb-1">Keterangan</p>
                            <p id="bank-description" class="text-sm text-slate-600 italic">--</p>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-slate-50 px-6 py-4 flex justify-end">
                    <button type="button" onclick="closeBankModal()" class="btn-outline text-sm">
                        <i class="fas fa-times mr-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openBankModal(bankData) {
        document.getElementById('bank-account-holder').textContent = bankData.account_holder_name || '-';
        document.getElementById('bank-name').textContent = bankData.bank_name || '-';
        document.getElementById('bank-branch').textContent = bankData.branch_office || '-';
        document.getElementById('bank-account-number').textContent = bankData.account_number || '-';

        const descSection = document.getElementById('bank-description-section');
        const descEl = document.getElementById('bank-description');
        if (bankData.description) {
            descSection.classList.remove('hidden');
            descEl.textContent = bankData.description;
        } else {
            descSection.classList.add('hidden');
        }

        document.getElementById('bankModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeBankModal() {
        document.getElementById('bankModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
</script>

<?= $this->endSection() ?>