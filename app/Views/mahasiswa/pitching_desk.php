<?= $this->extend('layouts/main') ?>

<?php helper('pmw'); ?>
<?php $prodiList = getProdiList(); ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-5xl mx-auto" x-data="pitchingDeskForm()">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Administrasi & <span class="text-gradient">Desk Evaluation</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Lengkapi Administrasi dan Tentang Usaha yg Diusulkan</p>
        </div>
    </div>

    <?php
    $hasProposal  = !empty($proposal);
    $isBerkembang = $hasProposal && ($proposal['kategori_wirausaha'] ?? '') === 'berkembang';
    $pptDoc        = $docsByKey['pitching_ppt'] ?? null;
    $biodataDoc    = $docsByKey['biodata'] ?? null;
    $ktmDoc        = $docsByKey['ktm'] ?? null;
    $pernyataanDoc = $docsByKey['surat_pernyataan_ketua'] ?? null;
    $cashflowDoc   = $docsByKey['cashflow'] ?? null;
    $aStatus      = $proposal['pitching_admin_status'] ?? 'pending';
    $isSubmitted  = !empty($proposal['student_submitted_at'] ?? null);
    $isLocked     = $hasProposal && (($isSubmitted && $aStatus !== 'revision') || $aStatus === 'approved');
    ?>

    <?php if ($hasProposal): ?>
        <!-- ─── STICKY ACTION BAR ────────────────────────────────────────── -->
        <div class="sticky top-4 z-20 bg-white/90 backdrop-blur-md shadow-lg border border-sky-100 rounded-2xl p-4 mb-6 animate-stagger delay-150 flex items-center justify-between gap-4 flex-wrap">
            <div class="flex items-center gap-3 min-w-0">
                <?php if ($aStatus === 'approved'): ?>
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                        <i class="fas fa-circle-check text-emerald-500 text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Tahap 1</p>
                        <p class="text-sm font-black text-emerald-700">Lolos Administrasi & Desk Evaluation ✓</p>
                    </div>
                <?php elseif ($isSubmitted && $aStatus === 'pending'): ?>
                    <div class="w-9 h-9 rounded-xl bg-amber-100 flex items-center justify-center shrink-0">
                        <i class="fas fa-hourglass-half text-amber-500 text-base animate-pulse-soft"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Tahap 1</p>
                        <p class="text-sm font-black text-amber-700">Menunggu Verifikasi Admin</p>
                        <p class="text-[10px] text-amber-500 font-mono">Dikirim: <?= date('d M Y H:i', strtotime($proposal['student_submitted_at'])) ?></p>
                    </div>
                <?php else: ?>
                    <div class="w-9 h-9 rounded-xl bg-sky-50 flex items-center justify-center shrink-0">
                        <i class="fas fa-file-pen text-sky-500 text-base"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Tahap 1</p>
                        <p class="text-sm font-black text-slate-700">
                            <?= $aStatus === 'revision' ? 'Revisi — Perbarui Berkas' : 'Draft — Belum Dikirim' ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!$isLocked): ?>
            <!-- Action Buttons -->
            <div class="flex items-center gap-2 shrink-0">
                <button type="button" @click="saveDraft()"
                    :disabled="isSavingDraft"
                    class="inline-flex items-center gap-2 h-9 px-4 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-xs shadow-sm transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fas fa-save text-amber-500" :class="isSavingDraft ? 'fa-spin fa-circle-notch' : 'fa-save'"></i>
                    <span x-text="isSavingDraft ? 'Menyimpan...' : 'Simpan Draft'"></span>
                </button>
                <template x-if="isComplete">
                    <button type="button" @click="submitPitching()"
                        class="inline-flex items-center gap-2 h-9 px-4 rounded-xl bg-emerald-500 text-white hover:bg-emerald-600 font-bold text-xs shadow-sm shadow-emerald-200 transition-all">
                        <i class="fas fa-paper-plane"></i>
                        Kirim Berkas
                    </button>
                </template>
                <template x-if="!isComplete">
                    <div class="inline-flex items-center gap-2 h-9 px-4 rounded-xl bg-slate-100 text-slate-400 font-bold text-xs cursor-not-allowed select-none"
                        title="Lengkapi semua berkas terlebih dahulu">
                        <i class="fas fa-paper-plane"></i>
                        Kirim Berkas
                    </div>
                </template>
            </div>
            <?php elseif ($aStatus === 'approved'): ?>
            <div class="inline-flex items-center gap-2 h-9 px-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 font-bold text-xs">
                <i class="fas fa-check-circle"></i>
                Tahap 1 Selesai
            </div>
            <?php else: ?>
            <div class="inline-flex items-center gap-2 h-9 px-4 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 font-bold text-xs">
                <i class="fas fa-lock"></i>
                Menunggu Verifikasi
            </div>
            <?php endif; ?>
        </div>
    <?php endif; // endif hasProposal (sticky bar) ?>

    <!-- ================================================================
         2. PERIOD INFO CARD
    ================================================================= -->
    <div class="card-premium p-5 sm:p-7 animate-stagger delay-100" @mousemove="handleMouseMove">
        <div class="flex items-start justify-between gap-4 flex-wrap">
            <div>
                <p class="text-xs font-black uppercase tracking-widest text-slate-400">Periode Aktif</p>
                <p class="text-lg font-bold text-slate-800 mt-1">
                    <?= $activePeriod ? esc($activePeriod['name']) . ' ' . esc($activePeriod['year']) : '-' ?>
                </p>
            </div>
            <div class="text-right">
                <p class="text-xs font-black uppercase tracking-widest text-slate-400">Jadwal Tahap 1</p>
                <p class="text-sm font-bold text-slate-700 mt-1">
                    <?= $phase ? (formatIndonesianDate($phase['start_date']) . ' s/d ' . formatIndonesianDate($phase['end_date'])) : 'Belum dijadwalkan' ?>
                </p>
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold mt-2 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700 border border-emerald-100" : "bg-rose-50 text-rose-700 border border-rose-100" ?>">
                    <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                    <?= $isPhaseOpen ? 'Dibuka' : 'Ditutup' ?>
                </span>
            </div>
        </div>
    </div>

    <?php if (!$hasProposal): ?>
        <!-- No proposal yet — show guidance -->
        <div class="card-premium p-8 text-center animate-stagger delay-200">
            <i class="fas fa-file-circle-plus text-5xl text-slate-200 mb-4"></i>
            <h3 class="text-lg font-bold text-slate-700 mb-1">Belum Ada Pendaftaran</h3>
            <p class="text-sm text-slate-400 mb-4">Anda belum terdaftar dalam periode PMW yang aktif. Hubungi admin atau daftarkan diri Anda.</p>
        </div>
    <?php else: ?>

        <?php
        // Notification Alert
        $hasAdminNote = !empty($proposal['pitching_admin_catatan']) && $aStatus !== 'approved' && $aStatus !== 'pending';
        if ($hasAdminNote):
            $note = $proposal['pitching_admin_catatan'];
            $noteStatus = $aStatus;
            $source = 'Admin/UPAPKK';
            $alertClass = ($noteStatus === 'rejected') ? 'bg-rose-50 border-rose-200 text-rose-800' : 'bg-orange-50 border-orange-200 text-orange-800';
            $alertIcon  = ($noteStatus === 'rejected') ? 'fa-circle-xmark text-rose-500' : 'fa-circle-exclamation text-orange-500';
        ?>
        <div class="p-5 rounded-2xl border <?= $alertClass ?> shadow-sm">
            <div class="flex items-center gap-3 mb-3">
                <i class="fas <?= $alertIcon ?> text-xl"></i>
                <div>
                    <h4 class="font-black text-xs uppercase tracking-widest opacity-80">Catatan dari <?= $source ?></h4>
                    <p class="text-[10px] font-bold uppercase"><?= $noteStatus === 'rejected' ? 'Ditolak' : 'Perlu Perbaikan' ?></p>
                </div>
            </div>
            <div class="text-sm leading-relaxed whitespace-pre-line bg-white/30 p-4 rounded-xl italic text-slate-700">"<?= esc($note) ?>"</div>
        </div>
        <?php endif; ?>

        <!-- ================================================================
             SUCCESS BANNER — lolos ke Tahap 2
        ================================================================= -->
        <?php if ($aStatus === 'approved'): ?>
        <div class="card-premium bg-linear-to-br from-emerald-600 to-teal-600 animate-stagger delay-200 overflow-hidden" @mousemove="handleMouseMove">
            <div class="bg-white/10 backdrop-blur-md p-8 sm:p-10 rounded-[1.4rem] text-white flex flex-col items-center text-center gap-5 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-teal-400/20 rounded-full blur-3xl"></div>
                <div class="max-w-2xl relative z-10">
                    <h3 class="font-display text-2xl sm:text-3xl font-black mb-3 tracking-tight">Selamat <?= esc($proposal['ketua_nama'] ?? 'Tim Anda') ?>!</h3>
                    <p class="text-sm sm:text-base text-slate-800/90 font-medium leading-relaxed">
                        Tim Anda lolos Tahap 1 (Administrasi & Desk Evaluation). Lanjutkan ke Tahap 2: <strong>Business Plan & Business Model Canvas</strong>.
                    </p>
                    <div class="mt-8 flex justify-center gap-4">
                        <a href="<?= base_url('mahasiswa/proposal') ?>" class="inline-flex items-center gap-3 px-8 py-4 rounded-2xl bg-white text-emerald-700 font-black text-sm shadow-2xl hover:scale-105 transition-all">
                            <i class="fas fa-file-invoice text-lg text-teal-500"></i>
                            BUSINESS PLAN & BMC
                            <i class="fas fa-arrow-right text-[10px] ml-1 opacity-50"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; // endif approved ?>

        <!-- ================================================================
             3. VALIDATION PROGRESS TRACKER
        ================================================================= -->
        <div class="card-premium overflow-hidden animate-stagger delay-200" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-tasks text-teal-500 mr-2"></i>
                    Progres Validasi
                </h3>
            </div>
            <div class="p-5 sm:p-7">
                <div class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-6 md:gap-0">
                    <div class="hidden md:block absolute top-6 left-0 w-full h-0.5 bg-slate-100 z-0"></div>
                    <?php
                    $steps = [
                        ['label' => 'Validasi UPAPKK', 'sublabel' => 'Admin/UPAPKK', 'status' => (!$pptDoc ? 'empty' : $aStatus), 'note' => $proposal['pitching_admin_catatan'], 'icon' => 'fa-award'],
                    ];
                    $stepColors = [
                        'pending'  => ['bg' => 'bg-amber-500',   'text' => 'text-amber-500',   'light' => 'bg-amber-50',   'icon' => 'fa-clock',  'label' => 'PENDING'],
                        'approved' => ['bg' => 'bg-emerald-500', 'text' => 'text-emerald-500', 'light' => 'bg-emerald-50', 'icon' => 'fa-check',  'label' => 'DISETUJUI'],
                        'revision' => ['bg' => 'bg-orange-500',  'text' => 'text-orange-500',  'light' => 'bg-orange-50',  'icon' => 'fa-rotate', 'label' => 'REVISI'],
                        'rejected' => ['bg' => 'bg-rose-500',    'text' => 'text-rose-500',    'light' => 'bg-rose-50',    'icon' => 'fa-xmark',  'label' => 'DITOLAK'],
                        'empty'    => ['bg' => 'bg-slate-300',   'text' => 'text-slate-400',   'light' => 'bg-slate-50',   'icon' => 'fa-minus',  'label' => 'BELUM KIRIM'],
                    ];
                    ?>
                    <?php foreach ($steps as $step):
                        $color = $stepColors[$step['status']] ?? $stepColors['pending'];
                    ?>
                    <div class="relative z-10 flex flex-row md:flex-col items-center gap-4 md:gap-2 flex-1 w-full md:w-auto">
                        <div class="w-12 h-12 rounded-2xl <?= $color['bg'] ?> text-white flex items-center justify-center shadow-lg shrink-0">
                            <i class="fas <?= $step['icon'] ?> text-lg"></i>
                        </div>
                        <div class="text-left md:text-center mt-1">
                            <p class="text-xs font-black uppercase tracking-tighter text-slate-400"><?= $step['label'] ?></p>
                            <p class="text-[10px] text-slate-500 truncate max-w-[140px]"><i class="fas fa-user-tag text-[9px] mr-1"></i><?= esc($step['sublabel'] ?? '') ?></p>
                            <span class="text-[10px] font-black <?= $color['text'] ?> uppercase italic"><?= $color['label'] ?></span>
                        </div>
                        <?php if (!empty($step['note'])): ?>
                        <div class="md:absolute md:top-24 md:left-1/2 md:-translate-x-1/2 w-full md:w-48 p-3 rounded-xl <?= $color['light'] ?> text-[10px] text-slate-600 italic">"<?= esc($step['note']) ?>"</div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- ================================================================
             4. IDENTITAS USAHA & TIM (DRAFT FORM)
        ================================================================= -->
        <div class="card-premium overflow-hidden animate-stagger delay-300" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60 flex items-center justify-between">
                <div>
                    <h3 class="font-display text-base font-bold text-(--text-heading)">
                        <i class="fas fa-building text-sky-500 mr-2"></i>
                        Identitas Usaha & Tim
                    </h3>
                    <p class="text-[11px] text-(--text-muted) mt-0.5">Data ini wajib diisi sebelum pengiriman</p>
                </div>
                <?php if (!$isLocked && $isPhaseOpen): ?>
                <button type="button" @click="saveDraft()" :disabled="isSavingDraft"
                    class="btn-outline btn-sm inline-flex items-center gap-2 shrink-0">
                    <i class="fas fa-save text-amber-500" :class="isSavingDraft ? 'fa-spinner fa-spin' : 'fa-save'"></i>
                    <span x-text="isSavingDraft ? 'Menyimpan...' : 'Simpan Draft'"></span>
                </button>
                <?php endif; ?>
            </div>
            <div class="p-5 sm:p-7 space-y-5">

                <!-- Nama Usaha -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Usaha / Produk <span class="text-rose-500">*</span></label>
                    <input type="text" x-model="namaUsaha" class="input-field w-full" placeholder="Masukkan nama usaha atau produk..."
                        <?= $isLocked ? 'disabled' : '' ?>>
                </div>

                <!-- Kategori Usaha -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori Usaha <span class="text-rose-500">*</span></label>
                    <div class="grid sm:grid-cols-2 gap-3">
                        <!-- Digital -->
                        <label class="relative cursor-pointer group" <?= $isLocked ? 'style=pointer-events:none;opacity:0.7' : '' ?>>
                            <input type="radio" x-model="kategoriUsaha" value="Digital" class="sr-only peer" @change="showSubKategori = false">
                            <div class="p-4 rounded-xl border-2 border-slate-100 bg-white peer-checked:border-sky-400 peer-checked:bg-sky-50 transition-all group-hover:border-sky-200 flex items-center gap-3"
                                :class="kategoriUsaha === 'Digital' ? 'border-sky-400 bg-sky-50' : ''">
                                <div class="w-10 h-10 rounded-lg bg-sky-50 peer-checked:bg-sky-100 flex items-center justify-center shrink-0">
                                    <i class="fas fa-laptop-code text-sky-500"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-slate-800">Digital</p>
                                    <p class="text-[10px] text-slate-400">Teknologi & platform digital</p>
                                </div>
                            </div>
                        </label>
                        <!-- Non-Digital (show sub-category picker) -->
                        <label class="relative cursor-pointer group" <?= $isLocked ? 'style=pointer-events:none;opacity:0.7' : '' ?>>
                            <input type="radio" name="_nd_toggle" class="sr-only peer" @click="showSubKategori = true; if(kategoriUsaha === 'Digital') kategoriUsaha = ''" :checked="isNonDigital">
                            <div class="p-4 rounded-xl border-2 border-slate-100 bg-white peer-checked:border-violet-400 peer-checked:bg-violet-50 transition-all group-hover:border-violet-200 flex items-center gap-3"
                                :class="isNonDigital ? 'border-violet-400 bg-violet-50' : ''">
                                <div class="w-10 h-10 rounded-lg bg-violet-50 flex items-center justify-center shrink-0">
                                    <i class="fas fa-store text-violet-500"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-slate-800">Non-Digital</p>
                                    <p class="text-[10px] text-slate-400">Pilih sub-kategori di bawah</p>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Sub-kategori Non-Digital -->
                    <div class="mt-3 grid sm:grid-cols-2 gap-2" x-show="isNonDigital" x-transition>
                        <?php
                        $nonDigitalOptions = [
                            'Teknologi Non Digital' => ['icon' => 'fa-gears',       'desc' => 'Inovasi non-digital'],
                            'Jasa Sosial'            => ['icon' => 'fa-hands-helping','desc' => 'Layanan sosial & komunitas'],
                            'Kreatif'                => ['icon' => 'fa-palette',     'desc' => 'Kesenian, budaya, entertainment & fashion'],
                            'Boga'                   => ['icon' => 'fa-utensils',    'desc' => 'Makanan & minuman'],
                        ];
                        foreach ($nonDigitalOptions as $val => $opt): ?>
                        <label class="cursor-pointer group" <?= $isLocked ? 'style=pointer-events:none;opacity:0.7' : '' ?>>
                            <input type="radio" x-model="kategoriUsaha" value="<?= $val ?>" class="sr-only peer">
                            <div class="p-3 rounded-xl border-2 border-slate-100 bg-white peer-checked:border-violet-400 peer-checked:bg-violet-50 transition-all group-hover:border-violet-200 flex items-center gap-3">
                                <i class="fas <?= $opt['icon'] ?> text-violet-400 w-5 text-center"></i>
                                <div>
                                    <p class="font-bold text-xs text-slate-700"><?= $val ?></p>
                                    <p class="text-[10px] text-slate-400"><?= $opt['desc'] ?></p>
                                </div>
                            </div>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Kategori Wirausaha -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Status Wirausaha <span class="text-rose-500">*</span></label>
                    <div class="grid sm:grid-cols-2 gap-3">
                        <label class="cursor-pointer group" <?= $isLocked ? 'style=pointer-events:none;opacity:0.7' : '' ?>>
                            <input type="radio" x-model="kategoriWirausaha" value="pemula" class="sr-only peer">
                            <div class="p-4 rounded-xl border-2 border-slate-100 bg-white peer-checked:border-sky-400 peer-checked:bg-sky-50 transition-all group-hover:border-sky-200 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-sky-50 flex items-center justify-center shrink-0"><i class="fas fa-seedling text-sky-500"></i></div>
                                <div>
                                    <p class="font-bold text-sm text-slate-800">Pemula</p>
                                    <p class="text-[10px] text-slate-400">Usaha baru / bisa solo (1 orang)</p>
                                </div>
                            </div>
                        </label>
                        <label class="cursor-pointer group" <?= $isLocked ? 'style=pointer-events:none;opacity:0.7' : '' ?>>
                            <input type="radio" x-model="kategoriWirausaha" value="berkembang" class="sr-only peer">
                            <div class="p-4 rounded-xl border-2 border-slate-100 bg-white peer-checked:border-violet-400 peer-checked:bg-violet-50 transition-all group-hover:border-violet-200 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-violet-50 flex items-center justify-center shrink-0"><i class="fas fa-rocket text-violet-500"></i></div>
                                <div>
                                    <p class="font-bold text-sm text-slate-800">Berkembang</p>
                                    <p class="text-[10px] text-slate-400">Usaha sudah berjalan</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Detail Keterangan Usaha -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Detail Keterangan Usaha</label>
                    <textarea x-model="detailKeterangan" rows="4" class="form-textarea w-full" placeholder="Deskripsikan usaha Anda, produk/jasa, target pasar, dll..." <?= $isLocked ? 'disabled' : '' ?>></textarea>
                </div>

                <!-- Lama Usaha -->
                <div x-data="{ touched: false }"
                    x-init="
                        $watch('kategoriWirausaha', v => {
                            if (v === 'berkembang' && lamaUsahaTahun < 1) lamaUsahaTahun = 1;
                            if (v === 'pemula') lamaUsahaTahun = 0;
                        })
                    ">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Lama Usaha Berjalan
                        <span class="text-[10px] font-normal text-slate-400 ml-1">
                            <template x-if="kategoriWirausaha === 'berkembang'">
                                <span><span class="text-rose-500">*</span> min. 1 tahun</span>
                            </template>
                            <template x-if="kategoriWirausaha !== 'berkembang'">
                                <span>(opsional, dalam bulan)</span>
                            </template>
                        </span>
                    </label>
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-2">
                        <!-- Tahun: hanya tampil untuk berkembang -->
                        <template x-if="kategoriWirausaha === 'berkembang'">
                            <div class="flex items-center gap-2">
                                <input type="number" x-model.number="lamaUsahaTahun" @change="touched = true"
                                    min="1" max="50" placeholder="1"
                                    class="input-field w-32" <?= $isLocked ? 'disabled' : '' ?>>
                                <span class="text-sm font-semibold text-slate-500 whitespace-nowrap">Tahun</span>
                            </div>
                        </template>
                        <!-- Bulan: selalu tampil -->
                        <div class="flex items-center gap-2">
                            <input type="number" x-model.number="lamaUsahaBulan" @change="touched = true"
                                min="0" max="11" placeholder="0"
                                class="input-field w-32" <?= $isLocked ? 'disabled' : '' ?>>
                            <span class="text-sm font-semibold text-slate-500 whitespace-nowrap">Bulan</span>
                        </div>
                        <!-- Preview -->
                        <span class="text-sm font-semibold text-sky-600 whitespace-nowrap"
                            x-show="lamaUsahaTahun > 0 || lamaUsahaBulan > 0"
                            x-text="'= ' + (lamaUsahaTahun > 0 ? lamaUsahaTahun + ' Tahun' : '') + (lamaUsahaTahun > 0 && lamaUsahaBulan > 0 ? ' ' : '') + (lamaUsahaBulan > 0 ? lamaUsahaBulan + ' Bulan' : '')">
                        </span>
                    </div>
                    <p class="text-[10px] text-rose-500 font-bold mt-1.5"
                        x-show="touched && kategoriWirausaha === 'berkembang' && lamaUsahaTahun < 1">
                        <i class="fas fa-exclamation-circle mr-1"></i>Minimal 1 tahun untuk kategori Berkembang.
                    </p>
                </div>

                <!-- Anggota Tim -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-xs font-bold text-slate-700 uppercase tracking-wider">
                            <i class="fas fa-users text-sky-500 mr-1"></i>
                            Anggota Tim
                            <template x-if="kategoriWirausaha === 'berkembang'">
                                <span class="text-[10px] font-normal text-slate-400 ml-1">(Berkembang: min 1 anggota, max 4)</span>
                            </template>
                            <template x-if="kategoriWirausaha !== 'berkembang'">
                                <span class="text-[10px] font-normal text-slate-400 ml-1">(Pemula: bisa solo/individu, max 4 anggota)</span>
                            </template>
                        </label>
                        <?php if (!$isLocked): ?>
                        <button type="button" @click="addMember()" class="btn-outline btn-sm inline-flex items-center gap-1 text-[11px]"
                            :disabled="members.length >= 4">
                            <i class="fas fa-plus text-emerald-500"></i> Tambah
                        </button>
                        <?php endif; ?>
                    </div>

                    <!-- Ketua (read-only from profile) -->
                    <div class="p-3 rounded-xl bg-sky-50 border border-sky-100 mb-3 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-sky-100 flex items-center justify-center shrink-0">
                            <i class="fas fa-crown text-amber-500"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-sky-700">Ketua Tim (Akun Anda)</p>
                            <p class="text-sm font-semibold text-slate-800"><?= esc($members[0]['nama'] ?? ($profile['nama'] ?? '-')) ?></p>
                            <p class="text-[10px] text-slate-500"><?= esc($members[0]['nim'] ?? ($profile['nim'] ?? '-')) ?> &bull; <?= esc($members[0]['prodi'] ?? ($profile['prodi'] ?? '-')) ?></p>
                        </div>
                    </div>

                    <!-- Dynamic members -->
                    <div class="space-y-3">
                        <template x-for="(m, i) in members" :key="i">
                            <div class="p-4 rounded-xl border border-slate-100 bg-white space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-lg bg-sky-100 flex items-center justify-center shrink-0">
                                            <span class="text-[10px] font-black text-sky-600" x-text="i + 1"></span>
                                        </div>
                                        <p class="text-xs font-black text-slate-600 uppercase tracking-wider" x-text="`Anggota ${i + 1}`"></p>
                                    </div>
                                    <?php if (!$isLocked): ?>
                                    <button type="button" @click="removeMember(i)"
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-rose-500 hover:bg-rose-50 text-[10px] font-bold transition-colors">
                                        <i class="fas fa-trash-alt"></i>Hapus
                                    </button>
                                    <?php endif; ?>
                                </div>

                                <div class="grid sm:grid-cols-2 gap-3">
                                    <div class="form-field">
                                        <label class="form-label text-[10px] uppercase tracking-wider">Nama Lengkap <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-user text-xs"></i></span>
                                            <input type="text" x-model="m.nama" placeholder="Nama lengkap" <?= $isLocked ? 'disabled' : '' ?>>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-[10px] uppercase tracking-wider">NIM <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-id-card text-xs"></i></span>
                                            <input type="text" x-model="m.nim" placeholder="Nomor Induk Mahasiswa" <?= $isLocked ? 'disabled' : '' ?>>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-[10px] uppercase tracking-wider">Jurusan <span class="required">*</span></label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-building text-xs"></i></span>
                                            <select x-model="m.jurusan" @change="m.prodi = ''" <?= $isLocked ? 'disabled' : '' ?>>
                                                <option value="">Pilih Jurusan</option>
                                                <?php foreach (array_keys($prodiList) as $j): ?>
                                                    <option value="<?= esc($j) ?>"><?= esc($j) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-[10px] uppercase tracking-wider">Program Studi <span class="required">*</span></label>
                                        <div class="input-group" :class="!m.jurusan ? 'opacity-50' : ''">
                                            <span class="input-icon"><i class="fas fa-graduation-cap text-xs"></i></span>
                                            <select x-model="m.prodi" :disabled="!m.jurusan<?= $isLocked ? ' || true' : '' ?>">
                                                <option value="">Pilih Prodi</option>
                                                <template x-for="p in (prodiList[m.jurusan] || [])" :key="p">
                                                    <option :value="p" x-text="p" :selected="m.prodi === p"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-[10px] uppercase tracking-wider">Semester</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-calendar-alt text-xs"></i></span>
                                            <input type="number" x-model.number="m.semester" min="1" max="14" placeholder="Semester ke-" <?= $isLocked ? 'disabled' : '' ?>>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-[10px] uppercase tracking-wider">No. WhatsApp</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-phone text-xs"></i></span>
                                            <input type="tel" x-model="m.phone" placeholder="08xxxxxxxxxx" <?= $isLocked ? 'disabled' : '' ?>>
                                        </div>
                                    </div>
                                    <div class="form-field sm:col-span-2">
                                        <label class="form-label text-[10px] uppercase tracking-wider">Email</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-envelope text-xs"></i></span>
                                            <input type="email" x-model="m.email" placeholder="email@polsri.ac.id" <?= $isLocked ? 'disabled' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template x-if="members.length === 0">
                            <p class="text-center text-sm text-slate-400 py-4 border border-dashed border-slate-200 rounded-xl">
                                <i class="fas fa-users mr-2"></i> Belum ada anggota ditambahkan
                            </p>
                        </template>
                    </div>
                    <template x-if="members.length >= 1">
                        <p class="text-[10px] text-sky-600 font-bold mt-2">
                            <i class="fas fa-info-circle mr-1"></i>Tim ≥ 2 orang: setiap anggota harus berasal dari <strong>program studi yang berbeda</strong>.
                        </p>
                    </template>
                </div>

            </div>
        </div>

        <!-- ================================================================
             5. UPLOAD PPT
        ================================================================= -->
        <div class="card-premium overflow-hidden animate-stagger delay-350" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-file-powerpoint text-orange-500 mr-2"></i>
                    Presentasi PowerPoint
                </h3>
                <p class="text-[11px] text-(--text-muted) mt-0.5">Wajib untuk semua kategori — PPT, PPTX, atau PDF (Maks 10MB)</p>
            </div>
            <div class="p-5 sm:p-7">
                <?php $lockStatus = $isLocked ? ($aStatus === 'approved' ? 'Berkas Sah & Terkunci' : 'Menunggu Validasi') : null; ?>
                <div class="p-4 rounded-xl bg-white border border-slate-100 flex items-start justify-between gap-4 flex-wrap">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500 shrink-0">
                            <i class="fas fa-file-powerpoint text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">File Presentasi (PPT/PPTX/PDF)</p>
                            <div class="flex items-center gap-2 mt-1">
                                <template x-if="pptStatus === 'uploaded'">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700"><i class="fas fa-check-circle mr-1"></i> Tersimpan</span>
                                </template>
                                <template x-if="pptStatus === 'uploading'">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-700 animate-pulse"><i class="fas fa-spinner fa-spin mr-1"></i> Mengunggah...</span>
                                </template>
                                <template x-if="pptStatus === 'missing'">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-700"><i class="fas fa-exclamation-triangle mr-1"></i> Belum Ada</span>
                                </template>
                            </div>
                            <p class="text-xs text-slate-500 mt-1"><span x-text="pptFilename || 'Belum ada file terpilih'"></span></p>
                            <?php if ($pptDoc): ?>
                            <button type="button" @click="downloadFile('ppt')" class="mt-2 text-xs font-bold text-sky-600 hover:text-sky-700 inline-flex items-center gap-1" x-show="pptStatus === 'uploaded'">
                                <i class="fas fa-download text-[10px]"></i> Download
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <?php if ($lockStatus): ?>
                            <div class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg font-bold text-[10px] flex items-center gap-1.5 text-slate-600">
                                <i class="fas fa-lock"></i> <?= $lockStatus ?>
                            </div>
                        <?php elseif ($isPhaseOpen): ?>
                            <label class="cursor-pointer">
                                <span class="btn-outline btn-sm inline-flex items-center gap-2 bg-white"><i class="fas fa-folder-open"></i> Pilih File</span>
                                <input type="file" name="ppt_file" accept=".ppt,.pptx,.pdf" class="hidden" @change="handlePptUpload($event)">
                            </label>
                        <?php else: ?>
                            <p class="text-xs text-rose-600 font-bold"><i class="fas fa-lock mr-1"></i> Upload ditutup</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================================================================
             6. UPLOAD DOKUMEN PDF (Biodata, KTM, Pernyataan, Surat Dosen)
        ================================================================= -->
        <div class="card-premium overflow-hidden animate-stagger delay-400" @mousemove="handleMouseMove">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-file-pdf text-rose-500 mr-2"></i>
                    Dokumen Administrasi
                </h3>
                <p class="text-[11px] text-(--text-muted) mt-0.5">Semua dokumen wajib dalam format PDF (Maks 5MB)</p>
            </div>
            <div class="p-5 sm:p-7 space-y-3">
                <?php
                $adminDocs = [
                    'biodata'                => ['label' => 'Biodata Tim',                   'icon' => 'fa-id-card',       'color' => 'sky',    'doc' => $biodataDoc,    'berkembang_only' => false],
                    'ktm'                    => ['label' => 'KTM Gabungan',                  'icon' => 'fa-address-card',  'color' => 'teal',   'doc' => $ktmDoc,        'berkembang_only' => false],
                    'surat_pernyataan_ketua' => ['label' => 'Surat Pernyataan Ketua',        'icon' => 'fa-file-signature','color' => 'amber',  'doc' => $pernyataanDoc, 'berkembang_only' => false],
                    'cashflow'               => ['label' => 'Cashflow / Bukti Transaksi',    'icon' => 'fa-chart-line',    'color' => 'violet', 'doc' => $cashflowDoc,   'berkembang_only' => true],
                ];
                foreach ($adminDocs as $key => $info):
                    $uploaded = !empty($info['doc']);
                    $c = $info['color'];
                    $isBerkembangOnly = $info['berkembang_only'] ?? false;
                ?>
                <div class="p-4 rounded-xl border border-slate-100 bg-white flex items-center justify-between gap-4 flex-wrap"
                    <?= $isBerkembangOnly ? 'x-show="kategoriWirausaha === \'berkembang\'"' : '' ?>>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-<?= $c ?>-50 flex items-center justify-center text-<?= $c ?>-500 shrink-0">
                            <i class="fas <?= $info['icon'] ?>"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800"><?= $info['label'] ?></p>
                            <?php if ($uploaded): ?>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700 mt-1">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    <span x-text="docStatus['<?= $key ?>']?.name || '<?= esc($info['doc']['original_name'] ?? 'Tersimpan') ?>'"></span>
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold mt-1"
                                    :class="docStatus['<?= $key ?>'] ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700'">
                                    <i class="fas" :class="docStatus['<?= $key ?>'] ? 'fa-check-circle' : 'fa-exclamation-triangle'"></i>
                                    <span class="ml-1" x-text="docStatus['<?= $key ?>'] ? (docStatus['<?= $key ?>'].uploading ? 'Mengunggah...' : docStatus['<?= $key ?>'].name) : 'Belum diunggah'"></span>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <?php if ($uploaded && isset($info['doc']['id'])): ?>
                            <a href="<?= base_url('mahasiswa/pitching-desk/doc/' . $info['doc']['id']) ?>" target="_blank"
                                class="text-xs font-bold text-sky-600 hover:text-sky-700 inline-flex items-center gap-1">
                                <i class="fas fa-eye text-[10px]"></i> Lihat
                            </a>
                        <?php endif; ?>
                        <?php if (!$isLocked && $isPhaseOpen): ?>
                            <label class="cursor-pointer" :class="docStatus['<?= $key ?>']?.uploading ? 'opacity-50 pointer-events-none' : ''">
                                <span class="btn-outline btn-sm inline-flex items-center gap-1 bg-white text-[11px]">
                                    <i class="fas fa-upload text-[10px]"></i> <?= $uploaded ? 'Ganti' : 'Upload' ?>
                                </span>
                                <input type="file" name="doc_file" accept=".pdf,application/pdf" class="hidden"
                                    @change="handleDocUpload($event, '<?= $key ?>')">
                            </label>
                        <?php elseif ($isLocked): ?>
                            <span class="text-[10px] font-bold text-slate-400"><i class="fas fa-lock mr-1"></i>Terkunci</span>
                        <?php else: ?>
                            <span class="text-[10px] font-bold text-rose-500"><i class="fas fa-lock mr-1"></i>Ditutup</span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ================================================================
             7. VIDEO PERKENALAN USAHA
             - Wajib untuk Berkembang
             - Opsional untuk Pemula
        ================================================================= -->
        <div class="card-premium overflow-hidden animate-stagger delay-450" @mousemove="handleMouseMove"
            :class="kategoriWirausaha === 'berkembang' ? 'border-l-4 border-l-violet-500' : ''">
            <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-video text-violet-500 mr-2"></i>
                    Video Perkenalan Usaha
                </h3>
                <p class="text-[11px] mt-0.5" :class="kategoriWirausaha === 'berkembang' ? 'text-violet-600 font-bold' : 'text-(--text-muted)'">
                    <template x-if="kategoriWirausaha === 'berkembang'">
                        <span><i class="fas fa-exclamation-circle mr-1"></i>Wajib untuk kategori Berkembang</span>
                    </template>
                    <template x-if="kategoriWirausaha !== 'berkembang'">
                        <span>Opsional untuk kategori Pemula</span>
                    </template>
                </p>
            </div>
            <div class="p-5 sm:p-7 space-y-5">
                <!-- Video URL -->
                <div class="p-4 rounded-xl bg-white border border-slate-100">
                    <div class="flex items-start gap-4 flex-wrap">
                        <div class="w-12 h-12 rounded-xl bg-violet-50 flex items-center justify-center text-violet-500 shrink-0">
                            <i class="fas fa-link text-lg"></i>
                        </div>
                        <div class="flex-1 min-w-[260px]">
                            <p class="text-sm font-bold text-slate-800">Link Video (YouTube atau Google Drive)</p>
                            <p class="text-xs text-slate-500 mt-0.5 mb-3">Pastikan akses publik / anyone with link</p>
                            <div class="flex items-center gap-2">
                                <div class="relative flex-1">
                                    <i class="fas fa-video absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                    <input type="url" x-model="videoUrl" class="input-field pl-9 w-full text-sm"
                                        placeholder="https://youtu.be/... atau https://drive.google.com/..."
                                        :disabled="<?= ($isPhaseOpen && !$isLocked) ? 'isSavingVideo' : 'true' ?>">
                                </div>
                                <?php if ($isPhaseOpen && !$isLocked): ?>
                                <button type="button" @click="saveVideoUrl()" :disabled="isSavingVideo" class="btn-primary py-2 px-4 text-sm shrink-0">
                                    <i class="fas" :class="isSavingVideo ? 'fa-spinner fa-spin' : 'fa-save'"></i>
                                    <span class="hidden sm:inline ml-1" x-text="isSavingVideo ? 'Menyimpan...' : 'Simpan'"></span>
                                </button>
                                <?php endif; ?>
                            </div>
                            <div class="flex items-center gap-2 mt-2" x-show="videoUrl">
                                <template x-if="videoUrl && (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be'))">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 text-rose-600 border border-rose-100"><i class="fab fa-youtube mr-1"></i> YouTube</span>
                                </template>
                                <template x-if="videoUrl && videoUrl.includes('drive.google.com')">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-100"><i class="fab fa-google-drive mr-1"></i> Google Drive</span>
                                </template>
                                <a :href="videoUrl" target="_blank" class="text-[10px] font-bold text-sky-600 hover:underline flex items-center gap-1">
                                    <i class="fas fa-external-link-alt text-[9px]"></i> Buka Link
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================================================================
             8. COMPLETION STATUS & SUBMIT
        ================================================================= -->
        <div class="card-premium p-5 sm:p-7 bg-slate-50 border border-slate-100 animate-stagger delay-500" @mousemove="handleMouseMove">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="space-y-2">
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Status Kelengkapan</h4>
                    <div class="flex flex-wrap gap-3">
                        <div class="flex items-center gap-1 text-[10px] font-bold" :class="pptStatus === 'uploaded' ? 'text-emerald-600' : 'text-slate-400'">
                            <i class="fas" :class="pptStatus === 'uploaded' ? 'fa-check-circle' : 'fa-circle'"></i> PPT/Presentasi
                        </div>
                        <div class="flex items-center gap-1 text-[10px] font-bold" :class="docStatus['biodata'] || <?= $biodataDoc ? 'true' : 'false' ?> ? 'text-emerald-600' : 'text-slate-400'">
                            <i class="fas" :class="docStatus['biodata'] || <?= $biodataDoc ? 'true' : 'false' ?> ? 'fa-check-circle' : 'fa-circle'"></i> Biodata Tim
                        </div>
                        <div class="flex items-center gap-1 text-[10px] font-bold" :class="docStatus['ktm'] || <?= $ktmDoc ? 'true' : 'false' ?> ? 'text-emerald-600' : 'text-slate-400'">
                            <i class="fas" :class="docStatus['ktm'] || <?= $ktmDoc ? 'true' : 'false' ?> ? 'fa-check-circle' : 'fa-circle'"></i> KTM Gabungan
                        </div>
                        <div class="flex items-center gap-1 text-[10px] font-bold" :class="docStatus['surat_pernyataan_ketua'] || <?= $pernyataanDoc ? 'true' : 'false' ?> ? 'text-emerald-600' : 'text-slate-400'">
                            <i class="fas" :class="docStatus['surat_pernyataan_ketua'] || <?= $pernyataanDoc ? 'true' : 'false' ?> ? 'fa-check-circle' : 'fa-circle'"></i> Pernyataan Ketua
                        </div>
                        <div class="flex items-center gap-1 text-[10px] font-bold" x-show="kategoriWirausaha === 'berkembang'"
                            :class="(docStatus['cashflow'] && !docStatus['cashflow'].uploading) || <?= $cashflowDoc ? 'true' : 'false' ?> ? 'text-emerald-600' : 'text-rose-500'">
                            <i class="fas" :class="(docStatus['cashflow'] && !docStatus['cashflow'].uploading) || <?= $cashflowDoc ? 'true' : 'false' ?> ? 'fa-check-circle' : 'fa-exclamation-circle'"></i> Cashflow (Wajib Berkembang)
                        </div>
                        <div class="flex items-center gap-1 text-[10px] font-bold" x-show="kategoriWirausaha === 'berkembang'" :class="videoUrl ? 'text-emerald-600' : 'text-rose-500'">
                            <i class="fas" :class="videoUrl ? 'fa-check-circle' : 'fa-exclamation-circle'"></i> Video (Wajib Berkembang)
                        </div>
                    </div>
                </div>

                <div class="text-right shrink-0">
                    <template x-if="isSubmitted">
                        <div class="inline-flex flex-col items-end">
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 border border-emerald-200">
                                <i class="fas fa-check-double text-emerald-500"></i>
                                <span class="text-sm font-bold text-emerald-700">Sudah Terkirim</span>
                            </div>
                            <?php if ($isSubmitted): ?>
                            <p class="text-[10px] text-slate-400 mt-1 italic">Dikirim pada <?= formatIndonesianDate($proposal['student_submitted_at']) ?></p>
                            <?php endif; ?>
                        </div>
                    </template>

                    <template x-if="!isSubmitted && isComplete">
                        <button type="button" @click="submitPitching()"
                            class="group relative overflow-hidden inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-100 text-emerald-700 border border-emerald-200 font-bold transition-all hover:bg-emerald-600 hover:text-white hover:shadow-xl active:scale-95">
                            <span class="inline-flex items-center gap-2 transition-all duration-300 group-hover:-translate-y-10 group-hover:opacity-0">
                                <i class="fas fa-check-circle"></i> Siap Dikirim!
                            </span>
                            <span class="absolute inset-0 flex items-center justify-center translate-y-10 opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Sekarang
                            </span>
                        </button>
                    </template>

                    <template x-if="!isSubmitted && !isComplete">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-50 border border-amber-200">
                            <i class="fas fa-exclamation-triangle text-amber-500"></i>
                            <span class="text-sm font-bold text-amber-700">Belum Lengkap</span>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    <?php endif; // endif hasProposal ?>

</div><!-- /page wrapper -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function pitchingDeskForm() {
        return {
            namaUsaha: <?= json_encode($proposal['nama_usaha'] ?? '') ?>,
            kategoriUsaha: <?= json_encode($proposal['kategori_usaha'] ?? '') ?>,
            kategoriWirausaha: <?= json_encode($proposal['kategori_wirausaha'] ?? '') ?>,
            detailKeterangan: <?= json_encode($proposal['detail_keterangan'] ?? '') ?>,
            lamaUsahaTahun: <?= (int)($proposal['lama_usaha_tahun'] ?? 0) ?>,
            lamaUsahaBulan: <?= (int)($proposal['lama_usaha_bulan'] ?? 0) ?>,
            videoUrl: <?= json_encode($proposal['video_url'] ?? '') ?>,
            pptStatus: '<?= $pptDoc ? 'uploaded' : 'missing' ?>',
            pptFilename: <?= json_encode($pptDoc['original_name'] ?? '') ?>,
            docStatus: {},
            members: <?= json_encode(array_values(array_filter($members ?? [], fn($m) => ($m['role'] ?? '') === 'anggota'))) ?>,
            prodiList: <?= json_encode($prodiList) ?>,
            isSavingDraft: false,
            isSavingVideo: false,
            isSubmitted: <?= $isSubmitted ? 'true' : 'false' ?>,

            get isNonDigital() {
                const nonOptions = ['Teknologi Non Digital', 'Jasa Sosial', 'Kreatif', 'Boga'];
                return nonOptions.includes(this.kategoriUsaha) || this.showSubKategori === true;
            },

            showSubKategori: <?= in_array($proposal['kategori_usaha'] ?? '', ['Teknologi Non Digital', 'Jasa Sosial', 'Kreatif', 'Boga']) ? 'true' : 'false' ?>,

            get isComplete() {
                const pptReady = this.pptStatus === 'uploaded';
                const biodataReady = !!(this.docStatus['biodata'] && !this.docStatus['biodata'].uploading) || <?= $biodataDoc ? 'true' : 'false' ?>;
                const ktmReady = !!(this.docStatus['ktm'] && !this.docStatus['ktm'].uploading) || <?= $ktmDoc ? 'true' : 'false' ?>;
                const pernyataanReady = !!(this.docStatus['surat_pernyataan_ketua'] && !this.docStatus['surat_pernyataan_ketua'].uploading) || <?= $pernyataanDoc ? 'true' : 'false' ?>;
                const cashflowReady = this.kategoriWirausaha !== 'berkembang' || !!(this.docStatus['cashflow'] && !this.docStatus['cashflow'].uploading) || <?= $cashflowDoc ? 'true' : 'false' ?>;
                const videoReady = this.kategoriWirausaha !== 'berkembang' || !!this.videoUrl;
                const membersReady = this.kategoriWirausaha === 'berkembang'
                    ? (this.members.length >= 1 && this.members.length <= 4)
                    : (this.members.length <= 4);
                return pptReady && biodataReady && ktmReady && pernyataanReady && cashflowReady && videoReady && membersReady;
            },

            handleMouseMove(e) {
                const card = e.currentTarget;
                if (!card) return;
                const rect = card.getBoundingClientRect();
                card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            },

            addMember() {
                if (this.members.length >= 4) return;
                this.members.push({ nama: '', nim: '', jurusan: '', prodi: '', semester: '', phone: '', email: '' });
            },

            removeMember(i) {
                this.members.splice(i, 1);
            },

            saveDraft() {
                this.isSavingDraft = true;
                const body = new URLSearchParams();
                body.append('nama_usaha', this.namaUsaha);
                body.append('kategori_usaha', this.kategoriUsaha);
                body.append('kategori_wirausaha', this.kategoriWirausaha);
                body.append('detail_keterangan', this.detailKeterangan);
                body.append('lama_usaha_tahun', this.lamaUsahaTahun || '');
                body.append('lama_usaha_bulan', this.lamaUsahaBulan || '');
                this.members.forEach((m, i) => {
                    Object.entries(m).forEach(([k, v]) => body.append(`members[${i}][${k}]`, v));
                    body.append(`members[${i}][role]`, 'anggota');
                });

                fetch('<?= base_url('mahasiswa/pitching-desk/save-draft') ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
                    body: body.toString()
                })
                .then(r => r.json())
                .then(d => {
                    if (d.success) {
                        Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: d.message, showConfirmButton: false, timer: 2000 });
                    } else {
                        Swal.fire('Gagal', d.message, 'error');
                    }
                })
                .catch(() => Swal.fire('Error', 'Gagal menyimpan draft', 'error'))
                .finally(() => this.isSavingDraft = false);
            },

            handlePptUpload(e) {
                const file = e.target.files[0];
                if (!file) return;
                if (file.size > 10 * 1024 * 1024) { Swal.fire('Error', 'Ukuran file maksimal 10MB', 'error'); return; }
                const ext = file.name.split('.').pop().toLowerCase();
                if (!['ppt', 'pptx', 'pdf'].includes(ext)) { Swal.fire('Error', 'Format file harus PPT, PPTX, atau PDF', 'error'); return; }
                this.pptStatus = 'uploading';
                const fd = new FormData();
                fd.append('ppt_file', file);
                fetch('<?= base_url('mahasiswa/pitching-desk/upload-ppt') ?>', {
                    method: 'POST', body: fd, headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(r => r.json())
                .then(d => {
                    if (d.success) { this.pptStatus = 'uploaded'; this.pptFilename = d.filename; Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: d.message, showConfirmButton: false, timer: 2000 }); }
                    else { this.pptStatus = 'missing'; Swal.fire('Error', d.message, 'error'); }
                })
                .catch(() => { this.pptStatus = 'missing'; Swal.fire('Error', 'Gagal mengunggah file', 'error'); });
            },

            handleDocUpload(e, docKey) {
                const file = e.target.files[0];
                if (!file) return;
                if (file.size > 5 * 1024 * 1024) { Swal.fire('Error', 'Ukuran file maksimal 5MB', 'error'); return; }
                if (file.type !== 'application/pdf') { Swal.fire('Error', 'Format file harus PDF', 'error'); return; }
                this.docStatus[docKey] = { uploading: true, name: file.name };
                const fd = new FormData();
                fd.append('file', file);
                fd.append('doc_key', docKey);
                fetch('<?= base_url('mahasiswa/pitching-desk/upload-doc') ?>', {
                    method: 'POST', body: fd, headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(r => r.json())
                .then(d => {
                    if (d.success) {
                        this.docStatus[docKey] = { uploading: false, name: d.filename };
                        Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: d.message, showConfirmButton: false, timer: 2000 });
                    } else {
                        delete this.docStatus[docKey];
                        Swal.fire('Error', d.message, 'error');
                    }
                })
                .catch(() => { delete this.docStatus[docKey]; Swal.fire('Error', 'Gagal mengunggah dokumen', 'error'); });
            },

            saveVideoUrl() {
                if (!this.videoUrl) { Swal.fire('Error', 'Link video tidak boleh kosong', 'error'); return; }
                const isYT = this.videoUrl.includes('youtube.com') || this.videoUrl.includes('youtu.be');
                const isGD = this.videoUrl.includes('drive.google.com');
                if (!isYT && !isGD) { Swal.fire('Error', 'Hanya diperbolehkan link YouTube atau Google Drive', 'error'); return; }
                this.isSavingVideo = true;
                fetch('<?= base_url('mahasiswa/pitching-desk/update-video-url') ?>', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
                    body: 'video_url=' + encodeURIComponent(this.videoUrl)
                })
                .then(r => r.json())
                .then(d => {
                    if (d.success) Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: d.message, showConfirmButton: false, timer: 2000 });
                    else Swal.fire('Error', d.message, 'error');
                })
                .catch(() => Swal.fire('Error', 'Gagal menyimpan link video', 'error'))
                .finally(() => this.isSavingVideo = false);
            },

            submitPitching() {
                Swal.fire({
                    title: 'Kirim Berkas Administrasi?',
                    html: 'Pastikan semua dokumen sudah lengkap dan benar.<br><strong>Setelah dikirim, tidak dapat diubah sampai diproses.</strong>',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#10b981',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Kirim!',
                    cancelButtonText: 'Cek Lagi',
                    reverseButtons: true
                }).then(result => {
                    if (!result.isConfirmed) return;
                    Swal.fire({ title: 'Mengirim...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
                    fetch('<?= base_url('mahasiswa/pitching-desk/submit') ?>', {
                        method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(r => r.json())
                    .then(d => {
                        if (d.success) {
                            Swal.fire('Terikirim!', d.message, 'success').then(() => window.location.reload());
                        } else {
                            Swal.fire('Gagal!', d.message, 'error');
                        }
                    })
                    .catch(() => Swal.fire('Error', 'Gagal menghubungi server', 'error'));
                });
            },

            downloadFile(type) {
                <?php if ($pptDoc): ?>
                if (type === 'ppt') window.location.href = '<?= base_url('mahasiswa/pitching-desk/doc/' . ($pptDoc['id'] ?? 0)) ?>';
                <?php endif; ?>
            }
        };
    }
</script>
<?= $this->endSection() ?>