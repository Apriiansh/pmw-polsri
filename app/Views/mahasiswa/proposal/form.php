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

        <!-- Sticky Actions Bar -->
        <div class="sticky top-4 z-40 bg-white/90 backdrop-blur-md shadow-lg border border-sky-100 rounded-2xl p-4 mb-6 flex items-center justify-between gap-4 flex-wrap animate-in fade-in slide-in-from-top-4 duration-500">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center text-sky-500">
                    <i class="fas fa-file-signature text-lg"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Status Proposal</p>
                    <div class="flex items-center gap-2 mt-0.5">
                        <?php
                        $status = $proposal['status'] ?? 'new';
                        $statusMap = [
                            'new' => ['bg-slate-400', 'Baru (Draft)'],
                            'draft' => ['bg-amber-400', 'Draft Tersimpan'],
                            'submitted' => ['bg-emerald-500', 'Sudah Dikirim'],
                            'revision' => ['bg-orange-500', 'Perlu Revisi'],
                            'approved' => ['bg-sky-500', 'Disetujui'],
                            'rejected' => ['bg-rose-500', 'Ditolak'],
                        ];
                        $currStatus = $statusMap[$status] ?? $statusMap['new'];
                        ?>
                        <span class="inline-flex w-2 h-2 rounded-full <?= $currStatus[0] ?> <?= $status === 'draft' ? 'animate-pulse' : '' ?>"></span>
                        <p class="text-sm font-bold text-slate-700"><?= $currStatus[1] ?></p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" form="mainProposalForm" class="btn-accent py-2.5 px-6 shadow-sm hover:shadow-md transition-all flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    <span>Simpan Draft</span>
                </button>
            </div>
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
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400">Jadwal Tahap 1 (Pengajuan Proposal)</p>
                    <p class="text-sm font-bold text-slate-700 mt-1">
                        <?= $phase1 ? (formatIndonesianDate($phase1['start_date']) . ' s/d ' . formatIndonesianDate($phase1['end_date'])) : '-' ?>
                    </p>
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold mt-2 <?= $isPhaseOpen ? "bg-emerald-50 text-emerald-700 border border-emerald-100" : "bg-rose-50 text-rose-700 border border-rose-100" ?>">
                        <i class="fas <?= $isPhaseOpen ? 'fa-lock-open' : 'fa-lock' ?>"></i>
                        <?= $isPhaseOpen ? 'Dibuka' : 'Ditutup' ?>
                    </span>
                </div>
            </div>
        </div>

        <?php if (!empty($proposal['catatan'])): ?>
        <div class="mt-6 p-4 rounded-2xl bg-orange-50 border border-orange-200 animate-in slide-in-from-top-2 duration-500">
            <div class="flex items-center gap-3 mb-2">
                <i class="fas fa-circle-exclamation text-orange-500 text-lg"></i>
                <h4 class="font-bold text-sm text-orange-800 uppercase tracking-wider">Catatan Perbaikan dari Admin</h4>
            </div>
            <div class="text-sm text-orange-800 leading-relaxed whitespace-pre-line pl-7 opacity-90">
                <?= esc($proposal['catatan'] ?? '') ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Proposal Form -->
        <form id="mainProposalForm" action="<?= base_url('mahasiswa/proposal/save') ?>" method="post" enctype="multipart/form-data" class="space-y-8">
            <?= csrf_field() ?>
            <input type="hidden" name="is_final_submit" value="0">

            <!-- Section 1: Identitas Tim -->
            <div class="card-premium p-5 sm:p-7 space-y-6" :class="isOpen ? 'z-lift' : ''">
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

                <div class="grid md:grid-cols-2 gap-6" :class="isOpen ? 'z-lift' : ''">
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
                        <div class="search-select-container" :class="isOpen ? 'is-open' : ''" @click.away="isOpen = false">
                            <div class="input-group" @click="isOpen = !isOpen">
                                <span class="input-icon">
                                    <i class="fas fa-chalkboard-user"></i>
                                </span>
                                <input type="text"
                                    x-model="lecturerSearch"
                                    placeholder="Pilih atau cari dosen..."
                                    @input="isOpen = true"
                                    @focus="isOpen = true"
                                    class="cursor-pointer"
                                    required>
                                <span class="input-icon">
                                    <i class="fas" :class="isOpen ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                </span>
                            </div>

                            <!-- Dropdown Panel -->
                            <div x-show="isOpen"
                                x-transition
                                x-cloak
                                class="search-select-dropdown">
                                <template x-for="lec in filteredLecturers" :key="lec.id">
                                    <div class="search-select-item"
                                        :class="formData.lecturer_id == lec.id ? 'selected' : ''"
                                        @click="
                                            formData.lecturer_id = lec.id;
                                            lecturerSearch = lec.nama + (lec.nip ? ' — ' + lec.nip : '');
                                            isOpen = false;
                                         ">
                                        <div class="font-semibold" x-text="lec.nama"></div>
                                        <div class="text-xs opacity-80" x-text="lec.nip ? 'NIP: ' + lec.nip : 'NIP: -'"></div>
                                    </div>
                                </template>
                                <div x-show="filteredLecturers.length === 0" class="search-select-empty">
                                    <i class="fas fa-search mb-2 block text-xl opacity-20"></i>
                                    Dosen tidak ditemukan
                                </div>
                            </div>

                            <input type="hidden" name="lecturer_id" :value="formData.lecturer_id">
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="divider-label">
                    <span>Anggota Tim</span>
                </div>

                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <p class="text-xs text-slate-500">Wajib 3–4 anggota.</p>
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
                                 jurusan: '<?= esc(old('members.' . $idx . '.jurusan', $m['jurusan'] ?? ''), 'js') ?>', 
                                 prodi: '<?= esc(old('members.' . $idx . '.prodi', $m['prodi'] ?? ''), 'js') ?>' 
                             }"
                            x-init="$nextTick(() => { prodi = '<?= esc(old('members.' . $idx . '.prodi', $m['prodi'] ?? ''), 'js') ?>' })"
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
                                            <input type="text" name="members[<?= $idx ?>][nama]" value="<?= esc(old('members.' . $idx . '.nama', $m['nama'] ?? '')) ?>" placeholder="Nama lengkap" required>
                                        </div>
                                        <input type="hidden" name="members[<?= $idx ?>][role]" value="anggota">
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-xs">NIM</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-id-card text-xs"></i></span>
                                            <input type="text" name="members[<?= $idx ?>][nim]" value="<?= esc(old('members.' . $idx . '.nim', $m['nim'] ?? '')) ?>" placeholder="Nomor Induk Mahasiswa" required>
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
                                                <?php $currentJurusan = old('members.' . $idx . '.jurusan', $m['jurusan'] ?? ''); ?>
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
                                                <?php $currSemester = (int) old('members.' . $idx . '.semester', $m['semester'] ?? 0); ?>
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
                                            <input type="tel" name="members[<?= $idx ?>][phone]" value="<?= esc(old('members.' . $idx . '.phone', $m['phone'] ?? '')) ?>" placeholder="08xxxxxxxxxx" required>
                                        </div>
                                    </div>
                                    <div class="form-field">
                                        <label class="form-label text-xs">Email</label>
                                        <div class="input-group">
                                            <span class="input-icon"><i class="fas fa-envelope text-xs"></i></span>
                                            <input type="email" name="members[<?= $idx ?>][email]" value="<?= esc(old('members.' . $idx . '.email', $m['email'] ?? '')) ?>" placeholder="email@student.polsri.ac.id" required>
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
                            <select name="kategori_usaha" x-model="formData.kategori_usaha" required>
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
                            <input type="text" name="nama_usaha" x-model="formData.nama_usaha" value="<?= esc(old('nama_usaha', $proposal['nama_usaha'] ?? '')) ?>" placeholder="Nama usaha atau produk" required>
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="form-label">
                            Kategori Wirausaha <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-icon"><i class="fas fa-layer-group"></i></span>
                            <select name="kategori_wirausaha" x-model="formData.kategori_wirausaha" required>
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
                            <input type="number" name="total_rab" x-model="formData.total_rab" value="<?= esc(old('total_rab', $proposal['total_rab'] ?? '')) ?>" placeholder="0.00" min="0" step="0.01">
                        </div>
                    </div>

                    <!-- Detail Keterangan -->
                    <div class="form-field md:col-span-2">
                        <label class="form-label">
                            Detail Keterangan Usaha / Ide Bisnis
                        </label>
                        <div class="input-group">
                            <span class="input-icon self-start mt-3"><i class="fas fa-align-left text-xs"></i></span>
                            <textarea name="detail_keterangan" x-model="formData.detail_keterangan" rows="4"
                                class="w-full py-2.5 outline-none resize-none bg-transparent"
                                placeholder="Jelaskan secara singkat mengenai detil usaha atau ide bisnis Anda..."><?= esc(old('detail_keterangan', $proposal['detail_keterangan'] ?? '')) ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-sky-50">
                    <p class="text-[10px] text-slate-400 italic">* Kolom bertanda merah wajib diisi</p>
                </div>
            </div>

            <!-- Section 3: Dokumen -->
            <div class="card-premium p-5 sm:p-7 space-y-6">
                <h3 class="font-display text-base font-bold text-slate-800">3) Unggah Dokumen (PDF, max 5MB)</h3>

                <?php if (!$proposal): ?>
                    <div class="p-4 rounded-xl bg-sky-50 border border-sky-100">
                        <p class="text-sm text-slate-600 flex items-center gap-2">
                            <i class="fas fa-info-circle text-sky-500"></i>
                            Simpan draft terlebih dahulu untuk membuka fitur unggah dokumen.
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
                            <div class="p-4 rounded-xl bg-white border border-slate-100 transition-all hover:border-sky-100 group">
                                <div class="flex items-start justify-between gap-4 flex-wrap">
                                    <div class="flex items-start gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 shrink-0 group-hover:bg-sky-50 group-hover:text-sky-500 transition-colors">
                                            <i class="fas <?= $icons[$key] ?? 'fa-file' ?> text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800"><?= esc($labels[$key] ?? $key) ?></p>

                                            <!-- Status Badge -->
                                            <div class="flex items-center gap-2 mt-1">
                                                <template x-if="docStatus['<?= $key ?>'] === 'uploaded'">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">
                                                        <i class="fas fa-check-circle mr-1"></i> Tersimpan
                                                    </span>
                                                </template>
                                                <template x-if="docStatus['<?= $key ?>'] === 'selected'">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-amber-100 text-amber-700 animate-pulse">
                                                        <i class="fas fa-clock mr-1"></i> Siap Unggah
                                                    </span>
                                                </template>
                                                <template x-if="docStatus['<?= $key ?>'] === 'missing'">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-700">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i> Belum Ada
                                                    </span>
                                                </template>
                                            </div>

                                            <p class="text-xs text-slate-500 mt-1">
                                                <span x-text="docFilename['<?= $key ?>'] || 'Belum ada file terpilih'"></span>
                                            </p>

                                            <?php if ($doc): ?>
                                                <a class="text-xs font-bold text-sky-600 hover:text-sky-700 inline-flex items-center gap-1 mt-2" href="<?= base_url('mahasiswa/proposal/doc/' . $doc['id']) ?>">
                                                    <i class="fas fa-download text-[10px]"></i> Download Draft File
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-end gap-2">
                                        <label class="relative cursor-pointer">
                                            <span class="btn-outline btn-sm inline-flex items-center gap-2 bg-white">
                                                <i class="fas fa-folder-open"></i>
                                                Pilih File
                                            </span>
                                            <input type="file" name="<?= esc($key) ?>"
                                                accept="application/pdf"
                                                class="hidden"
                                                @change="handleFileChange($event, '<?= $key ?>')">
                                        </label>
                                        <p class="text-[10px] text-slate-400">PDF, Maks 5MB</p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="pt-8 border-t border-sky-50">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6 p-6 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="space-y-1">
                                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Kirim Proposal Final</h4>
                                <p class="text-xs text-slate-500">Pastikan semua data dan dokumen sudah benar. Proposal dapat diubah kembali selama jadwal pendaftaran belum berakhir.</p>

                                <div class="flex items-center gap-3 mt-3">
                                    <div class="flex items-center gap-1 text-[10px] font-bold" :class="isFormComplete ? 'text-emerald-600' : 'text-slate-400'">
                                        <i class="fas" :class="isFormComplete ? 'fa-check-circle' : 'fa-circle'"></i>
                                        Data Lengkap
                                    </div>
                                    <div class="flex items-center gap-1 text-[10px] font-bold" :class="allDocsReady ? 'text-emerald-600' : 'text-slate-400'">
                                        <i class="fas" :class="allDocsReady ? 'fa-check-circle' : 'fa-circle'"></i>
                                        Dokumen Lengkap
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <?php if ($isPhaseOpen): ?>
                                    <button type="button"
                                        class="btn-primary py-3 px-8 shadow-lg shadow-sky-200 disabled:opacity-50 disabled:grayscale disabled:cursor-not-allowed group"
                                        :disabled="!isFormComplete || !allDocsReady"
                                        @click="confirmSubmit()">
                                        <span class="flex items-center gap-2">
                                            <i class="fas fa-paper-plane group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                                            Kirim Proposal Sekarang
                                        </span>
                                    </button>
                                <?php else: ?>
                                    <p class="text-xs text-rose-600 flex items-center justify-end gap-1 font-bold">
                                        <i class="fas fa-lock"></i> Pengiriman ditutup
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function proposalForm() {
        <?php
        $jsDocStatus = [];
        $jsDocFilename = [];
        foreach ($requiredDocKeys as $key) {
            $jsDocStatus[$key] = isset($docsByKey[$key]) ? 'uploaded' : 'missing';
            $jsDocFilename[$key] = isset($docsByKey[$key]) ? $docsByKey[$key]['original_name'] : '';
        }
        $currentLecName = '';
        $targetId = old('lecturer_id', $proposal['lecturer_id'] ?? '');
        if ($targetId) {
            foreach ($lecturers as $lec) {
                if ((string)$lec['id'] === (string)$targetId) {
                    $currentLecName = $lec['nama'] . (!empty($lec['nip']) ? ' — ' . $lec['nip'] : '');
                    break;
                }
            }
        }
        ?>
        return {
            newMembers: [],
            prodiList: <?= json_encode($prodiList) ?>,
            lecturers: <?= json_encode($lecturers) ?>,
            existingCount: <?= $existingCount ?>,
            lecturerSearch: <?= json_encode($currentLecName) ?>,
            isOpen: false,

            // Document Tracking
            docStatus: <?= json_encode($jsDocStatus) ?>,
            docFilename: <?= json_encode($jsDocFilename) ?>,

            get filteredLecturers() {
                if (!this.lecturerSearch) return this.lecturers;
                const s = this.lecturerSearch.toLowerCase();
                return this.lecturers.filter(l =>
                    l.nama.toLowerCase().includes(s) ||
                    (l.nip && l.nip.toLowerCase().includes(s))
                );
            },

            // Form Data for validation
            formData: {
                lecturer_id: '<?= old('lecturer_id', $proposal['lecturer_id'] ?? '') ?>',
                kategori_usaha: '<?= old('kategori_usaha', $proposal['kategori_usaha'] ?? '') ?>',
                nama_usaha: <?= json_encode(old('nama_usaha', $proposal['nama_usaha'] ?? '')) ?>,
                kategori_wirausaha: '<?= old('kategori_wirausaha', $proposal['kategori_wirausaha'] ?? 'pemula') ?>',
                detail_keterangan: <?= json_encode(old('detail_keterangan', $proposal['detail_keterangan'] ?? '')) ?>,
                total_rab: '<?= old('total_rab', $proposal['total_rab'] ?? '') ?>',
            },

            init() {
                if (this.existingCount === 0) {
                    this.addMember();
                    this.addMember();
                }
            },

            // Computed-like getters for completeness
            get isFormComplete() {
                const totalMembers = this.existingCount + this.newMembers.length;
                const membersValid = totalMembers >= 3 && totalMembers <= 4;
                const fieldsValid = this.formData.lecturer_id && this.formData.kategori_usaha && this.formData.nama_usaha;

                return membersValid && fieldsValid;
            },

            get allDocsReady() {
                return Object.values(this.docStatus).every(s => s === 'uploaded' || s === 'selected');
            },

            handleFileChange(e, key) {
                const file = e.target.files[0];
                if (file) {
                    this.docStatus[key] = 'selected';
                    this.docFilename[key] = file.name;

                    // Trigger toast for feedback
                    this.$dispatch('toast-notify', {
                        message: `File ${file.name} terpilih. Tekan Simpan Draft untuk mengunggah.`,
                        type: 'info'
                    });
                }
            },

            confirmSubmit() {
                Swal.fire({
                    title: 'Kirim Proposal Sekarang?',
                    text: "Proposal masih dapat Anda ubah kembali jika diperlukan selama jadwal pendaftaran belum berakhir. Setelah ini, proposal akan masuk ke tahap penilaian dan akan diinformasikan jika lolos administrasi",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0284c7',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Kirim Sekarang',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('mainProposalForm');
                        form.querySelector('input[name="is_final_submit"]').value = '1';
                        form.submit();
                    }
                });
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
                    nama: '',
                    nim: '',
                    jurusan: '',
                    prodi: '',
                    semester: '',
                    phone: '',
                    email: ''
                });
            },
            removeMember(idx) {
                this.newMembers.splice(idx, 1);
            }
        }
    }
</script>
<?= $this->endSection() ?>