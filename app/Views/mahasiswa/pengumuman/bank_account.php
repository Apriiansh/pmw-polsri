<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-4xl mx-auto" x-data="bankAccountForm()">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <a href="<?= base_url('mahasiswa/pengumuman') ?>" class="text-xs font-semibold text-slate-500 hover:text-sky-600 mb-2 inline-flex items-center">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Pengumuman
            </a>
            <h2 class="section-title text-xl sm:text-2xl">
                Data Rekening <span class="text-gradient">Ketua Tim</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Input data rekening bank untuk pencairan dana PMW</p>
        </div>
    </div>

    <!-- ─── STICKY ACTION BAR ────────────────────────────────────────── -->
    <div class="sticky top-4 z-40 bg-white/90 backdrop-blur-md shadow-lg border border-sky-100 rounded-2xl p-4 mb-6 animate-stagger delay-150 flex items-center justify-between gap-4 flex-wrap">
        
        <!-- Left: Status Info -->
        <div class="flex items-center gap-3 min-w-0">
            <?php
            $hasData = !empty($bankAccount->bank_name) && !empty($bankAccount->account_number);
            $updateAt = $bankAccount->updated_at ?? null;
            ?>
            <div class="w-9 h-9 rounded-xl <?= $hasData ? 'bg-emerald-100' : 'bg-amber-100' ?> flex items-center justify-center shrink-0">
                <i class="fas <?= $hasData ? 'fa-circle-check text-emerald-500' : 'fa-circle-info text-amber-500' ?> text-base"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Data Rekening</p>
                <p class="text-sm font-black <?= $hasData ? 'text-emerald-700' : 'text-amber-700' ?>">
                    <?= $hasData ? 'Data Sudah Lengkap ✓' : 'Belum Dilengkapi' ?>
                </p>
                <?php if (!empty($updateAt)): ?>
                    <p class="text-[10px] text-slate-500 font-mono">
                        Terakhir Update: <?= date('d M Y H:i', strtotime($updateAt)) ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right: Action Summary -->
        <div class="flex items-center gap-2 shrink-0">
            <button type="submit" form="bankAccountForm" class="btn-accent h-10 px-6 font-bold rounded-xl shadow-sm hover:shadow-md transition-all flex items-center gap-2">
                <i class="fas fa-save shadow-sm"></i>
                <span>Simpan Data</span>
            </button>
        </div>
    </div>

    <!-- ================================================================
         2. PHASE INFO
    ================================================================= -->
    <div class="grid md:grid-cols-2 gap-6 animate-stagger delay-100">
        <!-- Period Card -->
        <div class="card-premium p-5 flex flex-col justify-between" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Periode</p>
            <p class="text-base font-bold text-slate-800 mt-1">
                <?= $activePeriod ? esc($activePeriod['name']) . ' ' . esc($activePeriod['year']) : '-' ?>
            </p>
            <div class="mt-4 pt-4 border-t border-slate-50">
                <p class="text-[11px] font-bold text-slate-500 italic">Pengisian Data Rekening</p>
            </div>
        </div>

        <!-- Schedule Card -->
        <div class="card-premium p-5 border-l-4 <?= $isPhaseOpen ? 'border-l-emerald-500' : 'border-l-rose-500' ?>" @mousemove="handleMouseMove">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Jadwal Input</p>
            <p class="text-sm font-bold text-slate-800 mt-1">
                <?= $phase ? (formatIndonesianDate($phase['start_date']) . ' - ' . formatIndonesianDate($phase['end_date'])) : 'Belum dijadwalkan' ?>
            </p>
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[10px] font-black mt-3 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700" : "bg-rose-50 text-rose-700" ?>">
                <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                <?= $isPhaseOpen ? 'INPUT DIBUKA' : 'INPUT DITUTUP' ?>
            </span>
        </div>
    </div>

    <?php if (!$isPhaseOpen): ?>
        <div class="card-premium p-6 border-l-4 border-l-rose-500">
            <div class="flex items-center gap-3">
                <i class="fas fa-lock text-rose-500 text-xl"></i>
                <div>
                    <p class="font-bold text-slate-800">Input Data Rekening Ditutup</p>
                    <p class="text-sm text-slate-500">Input data rekening hanya dapat dilakukan saat Tahap 5 (Pengumuman) dibuka.</p>
                </div>
            </div>
        </div>
    <?php else: ?>

    <div class="card-premium overflow-hidden animate-stagger delay-200" x-data="bankAccountForm()" @mousemove="handleMouseMove">
        <div class="px-5 sm:px-7 py-4 border-b border-sky-50 bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">Form Data Rekening Bank</h3>
            <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5">Pastikan data sesuai dengan buku rekening</p>
        </div>

        <form method="post" action="<?= base_url('mahasiswa/pengumuman/rekening/save') ?>" enctype="multipart/form-data" class="p-5 sm:p-7 space-y-6">
            <?= csrf_field() ?>

            <div class="grid md:grid-cols-2 gap-6" x-data="bankSelector()" x-init="initBank('<?= esc($bankAccount->bank_name ?? '') ?>')">
                <div class="relative">
                    <label class="text-xs font-black text-slate-500 uppercase tracking-wider block mb-2">
                        Nama Bank <span class="text-rose-500">*</span>
                    </label>
                    <input type="hidden" name="bank_name" x-model="selectedBankName" required>
                    <div class="relative">
                        <input 
                            type="text" 
                            x-model="searchQuery"
                            @input.debounce.300ms="searchBanks()"
                            @focus="showDropdown = true"
                            @click.outside="showDropdown = false"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all"
                            placeholder="Ketik nama bank (min 3 huruf)..."
                            autocomplete="off">
                        <div x-show="isLoading" class="absolute right-3 top-1/2 -translate-y-1/2">
                            <i class="fas fa-spinner fa-spin text-slate-400"></i>
                        </div>
                    </div>
                    
                    <!-- Dropdown Results -->
                    <div x-show="showDropdown && (banks.length > 0 || searchQuery.length >= 3)" 
                         x-cloak
                         class="absolute z-50 w-full mt-1 bg-white rounded-xl shadow-lg border border-slate-200 max-h-60 overflow-y-auto">
                        <template x-if="isLoading">
                            <div class="p-3 text-center text-slate-500">
                                <i class="fas fa-spinner fa-spin mr-2"></i>Mencari...
                            </div>
                        </template>
                        <template x-if="!isLoading && banks.length === 0 && searchQuery.length >= 3">
                            <div class="p-3 text-center text-slate-500">
                                <i class="fas fa-inbox mr-2"></i>Bank tidak ditemukan
                            </div>
                        </template>
                        <template x-for="bank in banks" :key="bank[2]">
                            <div @click="selectBank(bank)" 
                                 class="px-4 py-3 hover:bg-sky-50 cursor-pointer border-b border-slate-100 last:border-0">
                                <div class="font-semibold text-slate-700" x-text="bank[3]"></div>
                                <div class="text-xs text-slate-500" x-text="bank[1]"></div>
                            </div>
                        </template>
                    </div>
                    
                    <p x-show="selectedBankName" class="mt-2 text-sm text-emerald-600 font-medium">
                        <i class="fas fa-check-circle mr-1"></i>
                        Terpilih: <span x-text="selectedBankName"></span>
                    </p>
                    <p class="text-[10px] text-slate-400 mt-1">Ketik min. 3 huruf untuk mencari bank</p>
                </div>

                <div>
                    <label class="text-xs font-black text-slate-500 uppercase tracking-wider block mb-2">
                        Kantor Cabang <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="branch_office" value="<?= esc($bankAccount->branch_office ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all"
                        placeholder="Contoh: Cabang Palembang" required>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="text-xs font-black text-slate-500 uppercase tracking-wider block mb-2">
                        Nama Pemilik Rekening <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="account_holder_name" value="<?= esc($bankAccount->account_holder_name ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all"
                        placeholder="Nama lengkap sesuai buku rekening" required>
                    <p class="text-[10px] text-slate-400 mt-1">Pastikan nama sesuai dengan buku tabungan</p>
                </div>

                <div>
                    <label class="text-xs font-black text-slate-500 uppercase tracking-wider block mb-2">
                        Nomor Rekening <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="account_number" value="<?= esc($bankAccount->account_number ?? '') ?>"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all"
                        placeholder="Nomor rekening bank" required>
                </div>
            </div>

            <div>
                <label class="text-xs font-black text-slate-500 uppercase tracking-wider block mb-2">
                    Scan/Foto Halaman Pertama Buku Rekening (PDF) <span class="text-rose-500">*</span>
                </label>
                <div class="p-4 rounded-2xl border border-slate-200 bg-white/70">
                    <?php if (!empty($bankAccount->bank_book_scan)): ?>
                        <div class="mb-3 p-3 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-file-pdf text-emerald-500"></i>
                                <span class="text-sm font-semibold text-emerald-700">File sudah diupload</span>
                            </div>
                            <a href="<?= base_url('mahasiswa/pengumuman/rekening/download') ?>" class="text-xs font-semibold text-emerald-600 hover:text-emerald-800">
                                <i class="fas fa-download mr-1"></i> Download
                            </a>
                        </div>
                    <?php endif; ?>
                    <input type="file" name="bank_book_scan" accept=".pdf"
                        class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100"
                        <?= empty($bankAccount->bank_book_scan) ? 'required' : '' ?>>
                    <p class="text-[10px] text-slate-400 mt-2">Format: PDF, Maksimal 5MB. Upload scan/foto halaman pertama buku rekening.</p>
                </div>
            </div>

            <div>
                <label class="text-xs font-black text-slate-500 uppercase tracking-wider block mb-2">
                    Deskripsi/Keterangan (Opsional)
                </label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all"
                    placeholder="Keterangan tambahan jika diperlukan..."><?= esc($bankAccount->description ?? '') ?></textarea>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <div class="flex flex-wrap items-center gap-3">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i> Simpan Data Rekening
                    </button>
                    <a href="<?= base_url('mahasiswa/pengumuman') ?>" class="btn-outline">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                </div>
                <p class="text-[10px] text-slate-400 mt-3">
                    <span class="text-rose-500">*</span> Wajib diisi. Pastikan semua data sudah benar sebelum menyimpan.
                </p>
            </div>
        </form>
    </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function bankAccountForm() {
    return {
        handleMouseMove(e) {
            const card = e.currentTarget;
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
            card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
        }
    }
}

function bankSelector() {
    return {
        searchQuery: '',
        selectedBankName: '',
        banks: [],
        isLoading: false,
        showDropdown: false,
        
        initBank(savedBankName) {
            if (savedBankName) {
                this.selectedBankName = savedBankName;
                this.searchQuery = savedBankName;
            }
        },
        
        async searchBanks() {
            if (this.searchQuery.length < 3) {
                this.banks = [];
                this.showDropdown = false;
                return;
            }
            
            this.isLoading = true;
            this.showDropdown = true;
            
            try {
                const response = await fetch(`https://bank.thecloudalert.com/api/get/?keyword=${encodeURIComponent(this.searchQuery)}`);
                const result = await response.json();
                
                if (result.status === 200 && result.data) {
                    this.banks = result.data;
                } else {
                    this.banks = [];
                }
            } catch (error) {
                console.error('Error fetching banks:', error);
                this.banks = [];
            } finally {
                this.isLoading = false;
            }
        },
        
        selectBank(bank) {
            // bank[3] contains the bank name (PT BANK ...)
            this.selectedBankName = bank[3];
            this.searchQuery = bank[3];
            this.showDropdown = false;
            this.banks = [];
        }
    }
}
</script>
<?= $this->endSection() ?>
