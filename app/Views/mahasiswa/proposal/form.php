<?= $this->extend('layouts/main') ?>

<?php helper('pmw'); ?>
<?php $prodiList = getProdiList(); ?>

<?= $this->section('content') ?>
<div class="space-y-8 animate-stagger" x-data="proposalForm()">
    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Page Heading -->
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <div>
                <h2 class="section-title"><?= $isEdit ? 'Edit' : 'Buat' ?> <span class="text-gradient">Proposal</span></h2>
                <p class="section-subtitle">Lengkapi identitas tim, profil usaha, dan unggah dokumen</p>
            </div>
            <a href="<?= base_url('mahasiswa/proposal') ?>" class="btn-outline inline-flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>



        <!-- Period Info Card -->
        <div class="card-premium p-5 sm:p-7">
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
                        <?= $phase1 ? (esc($phase1['start_date'] ?? '-') . ' s/d ' . esc($phase1['end_date'] ?? '-')) : '-' ?>
                    </p>
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold mt-2 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700 border border-emerald-100" : "bg-rose-50 text-rose-700 border border-rose-100" ?>">
                        <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                        <?= $isPhaseOpen ? 'Dibuka' : 'Ditutup' ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Proposal Form -->
        <form action="<?= base_url('mahasiswa/proposal/save') ?>" method="post" class="space-y-8">
            <?= csrf_field() ?>

            <!-- Section 1: Identitas Tim -->
            <div class="card-premium p-5 sm:p-7 space-y-6">
                <?php
                $anggotaOnly = array_values(array_filter($members ?? [], fn($m) => ($m['role'] ?? '') === 'anggota'));
                $existingCount = count($anggotaOnly);
                ?>
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <div>
                        <h3 class="font-display text-base font-bold text-slate-800">1) Identitas Tim</h3>
                        <p class="text-xs text-slate-500 mt-1">Ketua otomatis dari akun kamu, tambah 2–4 anggota.</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Ketua Info -->
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-xs font-black uppercase tracking-widest text-slate-400">Ketua Tim</p>
                        <div class="mt-2 space-y-1">
                            <div class="text-sm font-bold text-slate-800"><?= esc($profile['nama'] ?? '-') ?></div>
                            <div class="text-xs text-slate-500">NIM: <?= esc($profile['nim'] ?? '-') ?></div>
                            <div class="text-xs text-slate-500"><?= esc($profile['jurusan'] ?? '-') ?> • <?= esc($profile['prodi'] ?? '-') ?></div>
                        </div>
                    </div>

                    <!-- Dosen Pendamping -->
                    <div class="form-field">
                        <label class="form-label">
                            Dosen Pendamping <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-icon">
                                <i class="fas fa-chalkboard-user"></i>
                            </span>
                            <select name="lecturer_id" required>
                                <option value="">Pilih Dosen</option>
                                <?php foreach ($lecturers as $lec): ?>
                                    <option value="<?= (int) $lec['id'] ?>" <?= (string) old('lecturer_id', $proposal['lecturer_id'] ?? '') === (string) $lec['id'] ? 'selected' : '' ?>>
                                        <?= esc($lec['nama']) ?><?= !empty($lec['nip']) ? ' — ' . esc($lec['nip']) : '' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="divider-label">
                    <span>Anggota Tim</span>
                </div>

                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <p class="text-xs text-slate-500">Wajib 2–4 anggota.</p>
                    <button type="button" class="btn-outline inline-flex items-center gap-2" @click="addMember()" :disabled="<?= $existingCount ?> + newMembers.length >= 4">
                        <i class="fas fa-user-plus"></i>
                        Tambah Anggota
                    </button>
                </div>

                <div class="space-y-4">

                    <!-- PHP Loop: Existing Members (100% Reliable for Stored Data) -->
                    <?php foreach ($anggotaOnly as $idx => $m): ?>
                        <div class="p-4 rounded-xl bg-white border border-slate-100 member-row animate-in fade-in slide-in-from-top-2"
                             x-data="{ 
                                 show: true, 
                                 jurusan: '<?= esc(old('members.'.$idx.'.jurusan', $m['jurusan'] ?? ''), 'js') ?>', 
                                 prodi: '<?= esc(old('members.'.$idx.'.prodi', $m['prodi'] ?? ''), 'js') ?>' 
                             }"
                             x-init="$nextTick(() => { prodi = '<?= esc(old('members.'.$idx.'.prodi', $m['prodi'] ?? ''), 'js') ?>' })"
                             x-show="show">
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <p class="text-sm font-bold text-slate-800">Anggota <span x-text="<?= $idx + 1 ?>"></span></p>
                                <button type="button" class="btn-ghost btn-sm text-rose-600 hover:text-rose-700" @click="show = false">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                            </div>
                            <!-- Conditional inputs: only if show is true -->
                            <template x-if="show">
                                <div class="grid md:grid-cols-2 gap-4">
                                    <div class="form-field">
                                        <label class="form-label text-xs">Nama</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-user text-xs"></i></span>
                                            <input type="text" name="members[<?= $idx ?>][nama]" value="<?= esc(old('members.'.$idx.'.nama', $m['nama'] ?? '')) ?>" placeholder="Nama lengkap" required>
                                        </div>
                                        <input type="hidden" name="members[<?= $idx ?>][role]" value="anggota">
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-xs">NIM</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-id-card text-xs"></i></span>
                                            <input type="text" name="members[<?= $idx ?>][nim]" value="<?= esc(old('members.'.$idx.'.nim', $m['nim'] ?? '')) ?>" placeholder="Nomor Induk Mahasiswa" required>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-xs">Jurusan</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-building text-xs"></i></span>
                                            <select name="members[<?= $idx ?>][jurusan]" x-model="jurusan" @change="prodi = ''"
                                                    class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-xs bg-white" required>
                                                <option value="">Pilih Jurusan</option>
                                                <?php foreach (array_keys($prodiList) as $j): ?>
                                                    <option value="<?= esc($j) ?>"><?= esc($j) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-xs">Prodi</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-graduation-cap text-xs"></i></span>
                                            <select name="members[<?= $idx ?>][prodi]" x-model="prodi"
                                                    class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-xs bg-white disabled:bg-slate-50 disabled:text-slate-400"
                                                    :disabled="!jurusan" required>
                                                <option value="">Pilih Program Studi</option>
                                                
                                                <!-- PHP Seed for initial display and validation errors -->
                                                <?php $currentJurusan = old('members.'.$idx.'.jurusan', $m['jurusan'] ?? ''); ?>
                                                <?php if (!empty($currentJurusan) && isset($prodiList[$currentJurusan])): ?>
                                                    <?php foreach ($prodiList[$currentJurusan] as $p): ?>
                                                        <option value="<?= esc($p) ?>"><?= esc($p) ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>

                                                <!-- Alpine template for dynamic changes -->
                                                <template x-for="p in prodiOptions(jurusan)" :key="p">
                                                    <option :value="p" x-text="p"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-xs">Semester</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-calendar-alt text-xs"></i></span>
                                            <select name="members[<?= $idx ?>][semester]"
                                                    class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-xs bg-white" required>
                                                <option value="">Pilih Semester</option>
                                                <?php $currSemester = (int) old('members.'.$idx.'.semester', $m['semester'] ?? 0); ?>
                                                <?php for ($i = 1; $i <= 8; $i++): ?>
                                                    <option value="<?= $i ?>" <?= $currSemester === $i ? 'selected' : '' ?>><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-xs">No. HP</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-phone text-xs"></i></span>
                                            <input type="tel" name="members[<?= $idx ?>][phone]" value="<?= esc(old('members.'.$idx.'.phone', $m['phone'] ?? '')) ?>" placeholder="08xxxxxxxxxx" required>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-xs">Email</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-envelope text-xs"></i></span>
                                            <input type="email" name="members[<?= $idx ?>][email]" value="<?= esc(old('members.'.$idx.'.email', $m['email'] ?? '')) ?>" placeholder="email@student.polsri.ac.id" required>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    <?php endforeach; ?>

                    <!-- Alpine Loop: New Members (Dynamic Interactivity) -->
                    <template x-for="(m, idx) in newMembers" :key="idx">
                        <div class="p-4 rounded-xl bg-sky-50/30 border border-sky-100/50 member-row">
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <p class="text-sm font-bold text-sky-800">Baru: Anggota <span x-text="<?= $existingCount ?> + idx + 1"></span></p>
                                <button type="button" class="btn-ghost btn-sm text-rose-600 hover:text-rose-700" @click="removeMember(idx)">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                            </div>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div class="form-field">
                                    <label class="form-label text-xs">Nama</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-user text-xs"></i></span>
                                        <input type="text" :name="`members[${<?= $existingCount ?>} + idx][nama]`" x-model="m.nama" placeholder="Nama lengkap" required>
                                    </div>
                                    <input type="hidden" :name="`members[${<?= $existingCount ?>} + idx][role]`" value="anggota">
                                </div>
                                <div class="form-field">
                                    <label class="form-label text-xs">NIM</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-id-card text-xs"></i></span>
                                        <input type="text" :name="`members[${<?= $existingCount ?>} + idx][nim]`" x-model="m.nim" placeholder="Nomor Induk Mahasiswa" required>
                                    </div>
                                </div>
                                <div class="form-field">
                                    <label class="form-label text-xs">Jurusan</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-building text-xs"></i></span>
                                        <select :name="`members[${<?= $existingCount ?>} + idx][jurusan]`" x-model="m.jurusan" @change="m.prodi = ''"
                                                class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-xs bg-white" required>
                                            <option value="">Pilih Jurusan</option>
                                            <template x-for="j in jurusanList()" :key="j">
                                                <option :value="j" x-text="j"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-field">
                                    <label class="form-label text-xs">Prodi</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-graduation-cap text-xs"></i></span>
                                        <select :name="`members[${<?= $existingCount ?>} + idx][prodi]`" x-model="m.prodi" :key="m.jurusan"
                                                class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-xs bg-white disabled:bg-slate-50 disabled:text-slate-400"
                                                :disabled="!m.jurusan" required>
                                            <option value="">Pilih Program Studi</option>
                                            <template x-for="p in prodiOptions(m.jurusan)" :key="p">
                                                <option :value="p" x-text="p"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-field">
                                    <label class="form-label text-xs">Semester</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-calendar-alt text-xs"></i></span>
                                        <select :name="`members[${<?= $existingCount ?>} + idx][semester]`" x-model="m.semester"
                                                class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all text-xs bg-white" required>
                                            <option value="">Pilih Semester</option>
                                            <?php for ($i = 1; $i <= 8; $i++): ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-field">
                                    <label class="form-label text-xs">No. HP</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-phone text-xs"></i></span>
                                        <input type="tel" :name="`members[${<?= $existingCount ?>} + idx][phone]`" x-model="m.phone" placeholder="08xxxxxxxxxx" required>
                                    </div>
                                </div>
                                <div class="form-field">
                                    <label class="form-field text-xs">Email</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-envelope text-xs"></i></span>
                                        <input type="email" :name="`members[${<?= $existingCount ?>} + idx][email]`" x-model="m.email" placeholder="email@student.polsri.ac.id" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Section 2: Profil Usaha -->
            <div class="card-premium p-5 sm:p-7 space-y-6">
                <h3 class="font-display text-base font-bold text-slate-800">2) Profil Usaha</h3>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="form-field">
                        <label class="form-label">
                            Kategori Usaha <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-tags"></i></span>
                            <select name="kategori_usaha" required>
                                <?php $kategori = old('kategori_usaha', $proposal['kategori_usaha'] ?? ''); ?>
                                <option value="">Pilih Kategori</option>
                                <option value="F&B" <?= $kategori === 'F&B' ? 'selected' : '' ?>>Makanan & Minuman (F&B)</option>
                                <option value="Jasa" <?= $kategori === 'Jasa' ? 'selected' : '' ?>>Jasa & Perdagangan</option>
                                <option value="Teknologi" <?= $kategori === 'Teknologi' ? 'selected' : '' ?>>Teknologi Terapan</option>
                                <option value="Kreatif" <?= $kategori === 'Kreatif' ? 'selected' : '' ?>>Industri Kreatif</option>
                                <option value="Budidaya" <?= $kategori === 'Budidaya' ? 'selected' : '' ?>>Budi Daya</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="form-label">
                            Nama Usaha/Produk <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-store"></i></span>
                            <input type="text" name="nama_usaha" value="<?= esc(old('nama_usaha', $proposal['nama_usaha'] ?? '')) ?>" placeholder="Nama usaha atau produk" required>
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="form-label">
                            Kategori Wirausaha <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-layer-group"></i></span>
                            <select name="kategori_wirausaha" required>
                                <?php $kategoriWirausaha = old('kategori_wirausaha', $proposal['kategori_wirausaha'] ?? 'pemula'); ?>
                                <option value="pemula" <?= $kategoriWirausaha === 'pemula' ? 'selected' : '' ?>>Pemula</option>
                                <option value="berkembang" <?= $kategoriWirausaha === 'berkembang' ? 'selected' : '' ?>>Berkembang</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="form-label">
                            Total RAB (Rp)
                        </label>
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-money-bill-wave"></i></span>
                            <input type="number" name="total_rab" value="<?= esc(old('total_rab', $proposal['total_rab'] ?? '')) ?>" placeholder="0.00" min="0" step="0.01">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end pt-4 border-t border-sky-50">
                    <button type="submit" class="btn-accent inline-flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        Simpan Draft
                    </button>
                </div>
            </div>
        </form>

        <!-- Section 3: Dokumen -->
        <div class="card-premium p-5 sm:p-7 space-y-6">
            <h3 class="font-display text-base font-bold text-slate-800">3) Unggah Dokumen (PDF, max 5MB)</h3>

            <?php if (!$proposal): ?>
                <div class="p-4 rounded-xl bg-sky-50 border border-sky-100">
                    <p class="text-sm text-slate-600 flex items-center gap-2">
                        <i class="fas fa-info-circle text-sky-500"></i>
                        Simpan draft terlebih dahulu untuk mengunggah dokumen.
                    </p>
                </div>
            <?php else: ?>
                <div class="space-y-4">
                    <?php
                        $labels = [
                            'proposal_utama' => 'Dokumen Proposal Utama',
                            'biodata' => 'Lampiran Biodata',
                            'surat_pernyataan_ketua' => 'Surat Pernyataan Ketua',
                            'surat_kesediaan_dosen' => 'Surat Kesediaan Dosen Pendamping',
                            'ktm' => 'Scan KTM (gabungan)',
                        ];
                        $icons = [
                            'proposal_utama' => 'fa-file-alt',
                            'biodata' => 'fa-id-card',
                            'surat_pernyataan_ketua' => 'fa-signature',
                            'surat_kesediaan_dosen' => 'fa-user-check',
                            'ktm' => 'fa-id-badge',
                        ];
                    ?>
                    <?php foreach ($requiredDocKeys as $key): ?>
                        <?php $doc = $docsByKey[$key] ?? null; ?>
                        <div class="p-4 rounded-xl bg-white border border-slate-100">
                            <div class="flex items-start justify-between gap-4 flex-wrap">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                        <i class="fas <?= $icons[$key] ?? 'fa-file' ?> text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800"><?= esc($labels[$key] ?? $key) ?></p>
                                        <p class="text-xs text-slate-500 mt-0.5">
                                            <?= $doc ? esc($doc['original_name'] ?? '-') : 'Belum diunggah' ?>
                                        </p>
                                        <?php if ($doc): ?>
                                            <a class="text-xs font-bold text-sky-600 hover:text-sky-700 inline-flex items-center gap-1 mt-1" href="<?= base_url('mahasiswa/proposal/doc/' . $doc['id']) ?>">
                                                <i class="fas fa-download text-[10px]"></i> Download
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <form action="<?= base_url('mahasiswa/proposal/upload/' . $proposal['id']) ?>" method="post" enctype="multipart/form-data" class="flex items-center gap-3">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="doc_key" value="<?= esc($key) ?>">
                                    <input type="file" name="file" accept="application/pdf" required class="text-xs file:mr-2 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-600 file:text-xs file:font-medium hover:file:bg-slate-200 file:transition-colors file:cursor-pointer">
                                    <button type="submit" class="btn-outline inline-flex items-center gap-2">
                                        <i class="fas fa-upload"></i>
                                        Upload
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="flex items-center justify-end pt-4 border-t border-sky-50">
                    <form action="<?= base_url('mahasiswa/proposal/submit/' . $proposal['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn-primary inline-flex items-center gap-2" <?= $isPhaseOpen ? '' : 'disabled' ?>>
                            <i class="fas fa-paper-plane"></i>
                            Kirim Proposal
                        </button>
                    </form>
                </div>
                <?php if (!$isPhaseOpen): ?>
                    <p class="text-xs text-rose-600 text-right flex items-center justify-end gap-1">
                        <i class="fas fa-lock"></i> Pengiriman proposal ditutup sesuai jadwal.
                    </p>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function proposalForm() {
        return {
            newMembers: [],
            prodiList: <?= json_encode($prodiList) ?>,
            existingCount: <?= $existingCount ?>,
            
            init() {
                // If this is a new proposal (existingCount === 0), add 2 default member slots
                if (this.existingCount === 0) {
                    this.addMember();
                    this.addMember();
                }
            },

            jurusanList() {
                return Object.keys(this.prodiList);
            },

            prodiOptions(jurusan) {
                return this.prodiList[jurusan] || [];
            },

            addMember() {
                if (this.existingCount + this.newMembers.length >= 4) return;
                this.newMembers.push({ 
                    nama: '', nim: '', jurusan: '', prodi: '', 
                    semester: '', phone: '', email: '' 
                });
            },
            removeMember(idx) {
                this.newMembers.splice(idx, 1);
            }
        }
    }
</script>
<?= $this->endSection() ?>
