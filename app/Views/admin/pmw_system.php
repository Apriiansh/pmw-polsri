<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="animate-stagger">
        <h2 class="section-title">
            <?= $title ?> <span class="text-gradient">System</span>
        </h2>
        <p class="section-subtitle"><?= $header_subtitle ?></p>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
    <div class="animate-stagger delay-100">
        <div class="card-premium border-l-4 border-l-emerald-500 bg-emerald-50/30 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                    <i class="fas fa-check-circle"></i>
                </div>
                <p class="font-semibold text-emerald-700"><?= session()->getFlashdata('success') ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
    <div class="animate-stagger delay-100">
        <div class="card-premium border-l-4 border-l-rose-500 bg-rose-50/30 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-rose-100 flex items-center justify-center text-rose-600 shrink-0">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <p class="font-semibold text-rose-700"><?= session()->getFlashdata('error') ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ================================================================
         2. ACTIVE PERIOD CARD
    ================================================================= -->
    <?php if ($activePeriod): ?>
    <div class="animate-stagger delay-200">
        <div class="card-premium px-4 border-l-4 border-l-sky-500">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-linear-to-br from-sky-400 to-sky-600 flex items-center justify-center text-white">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-lg text-(--text-heading)">
                            <?= esc($activePeriod['name']) ?>
                        </h3>
                        <span class="pmw-status pmw-status-success">
                            <i class="fas fa-circle text-[8px]"></i> Periode Aktif
                        </span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-display font-bold text-sky-600"><?= $activePeriod['year'] ?></p>
                    <p class="text-xs text-(--text-muted)">Tahun Akademik</p>
                </div>
            </div>
            <?php if ($activePeriod['description']): ?>
                <p class="text-sm text-(--text-body)"><?= esc($activePeriod['description']) ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php else: ?>
    <div class="animate-stagger delay-200">
        <div class="card-premium border-l-4 border-l-yellow-400 bg-yellow-50/30">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center text-yellow-600">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div>
                    <h3 class="font-display font-bold text-(--text-heading)">Belum Ada Periode Aktif</h3>
                    <p class="text-sm text-(--text-muted)">Silakan buat periode baru atau aktifkan periode yang sudah ada.</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <!-- ================================================================
         3. SCHEDULES TABLE (Only if active period exists)
    ================================================================= -->
    <?php if ($activePeriod && !empty($schedules)): ?>
    <div class="animate-stagger delay-300">
        <form action="<?= base_url('admin/pmw-system/schedule') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="period_id" value="<?= $activePeriod['id'] ?>">

            <div class="card-premium overflow-hidden">
                <!-- Card Header -->
                <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60 flex items-center justify-between">
                    <div>
                        <h3 class="font-display text-base font-bold text-(--text-heading)">
                            <i class="fas fa-timeline text-sky-500 mr-2"></i>
                            Jadwal Tahapan
                        </h3>
                        <p class="text-[11px] text-(--text-muted) mt-0.5">
                            Atur tanggal mulai, selesai, dan deskripsi untuk setiap tahap
                        </p>
                    </div>
                    <button type="submit" class="btn-primary text-sm py-2 px-4">
                        <i class="fas fa-save mr-2"></i>Simpan Jadwal
                    </button>
                </div>

                <!-- Schedules Table -->
                <div class="overflow-x-auto">
                    <table class="pmw-table">
                        <thead>
                            <tr>
                                <th class="w-12 text-center">No</th>
                                <th>Nama Tahap</th>
                                <th class="w-40">Tanggal Mulai</th>
                                <th class="w-40">Tanggal Selesai</th>
                                <th>Deskripsi</th>
                                <th class="w-20 text-center">Aktif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($schedules as $schedule): ?>
                            <tr>
                                <td class="text-center font-display font-bold text-(--text-heading)">
                                    <?= $schedule['phase_number'] ?>
                                </td>
                                <td>
                                    <p class="font-semibold text-(--text-heading)"><?= esc($schedule['phase_name']) ?></p>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-calendar-day"></i></span>
                                        <input type="date"
                                               name="schedules[<?= $schedule['id'] ?>][start_date]"
                                               value="<?= $schedule['start_date'] ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-calendar-check"></i></span>
                                        <input type="date"
                                               name="schedules[<?= $schedule['id'] ?>][end_date]"
                                               value="<?= $schedule['end_date'] ?>">
                                    </div>
                                </td>
                                <td>
                                    <textarea name="schedules[<?= $schedule['id'] ?>][description]"
                                              rows="2"
                                              class="form-textarea"
                                              placeholder="Deskripsi tahap..."><?= esc($schedule['description']) ?></textarea>
                                </td>
                                <td class="text-center">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox"
                                               name="schedules[<?= $schedule['id'] ?>][is_active]"
                                               value="1"
                                               <?= $schedule['is_active'] ? 'checked' : '' ?>
                                               class="sr-only peer">
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-sky-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sky-500"></div>
                                    </label>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
    <?php endif; ?>


    <!-- ================================================================
         4. PERIODS MANAGEMENT
    ================================================================= -->
    <div class="animate-stagger delay-400">
        <div class="card-premium overflow-hidden">
            <!-- Card Header -->
            <div class="px-5 sm:px-7 py-4 sm:py-5 border-b border-sky-50 bg-white/60">
                <h3 class="font-display text-base font-bold text-(--text-heading)">
                    <i class="fas fa-layer-group text-sky-500 mr-2"></i>
                    Manajemen Periode
                </h3>
                <p class="text-[11px] text-(--text-muted) mt-0.5">
                    Buat periode baru atau aktifkan periode yang sudah ada
                </p>
            </div>

            <div class="p-5 sm:p-7">
                <!-- Toggle Button -->
                <div class="mb-4">
                    <button type="button"
                            id="toggleCreateForm"
                            class="btn-primary"
                            onclick="document.getElementById('createPeriodForm').classList.toggle('hidden'); this.querySelector('span').textContent = document.getElementById('createPeriodForm').classList.contains('hidden') ? 'Buat Periode PMW' : 'Tutup Form';">
                        <i class="fas fa-plus-circle mr-2"></i>
                        <span><?= old('name') ? 'Tutup Form' : 'Buat Periode PMW' ?></span>
                    </button>
                </div>

                <!-- Create New Period Form (Hidden by default, show if validation error) -->
                <form id="createPeriodForm" action="<?= base_url('admin/pmw-system/period') ?>" method="post" class="mb-8 <?= old('name') ? '' : 'hidden' ?>">
                    <?= csrf_field() ?>
                    <h4 class="font-display font-bold text-sm text-(--text-heading) mb-4">Buat Periode Baru</h4>

                    <div class="grid md:grid-cols-3 gap-4 mb-4">
                        <!-- Period Name -->
                        <div class="form-field">
                            <label class="form-label">Nama Periode <span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-icon"><i class="fas fa-tag"></i></span>
                                <input type="text"
                                       name="name"
                                       value="<?= old('name') ?>"
                                       placeholder="Contoh: PMW Tahun 2026"
                                       required>
                            </div>
                        </div>

                        <!-- Year -->
                        <div class="form-field">
                            <label class="form-label">Tahun <span class="required">*</span></label>
                            <div class="input-group">
                                <span class="input-icon"><i class="fas fa-calendar"></i></span>
                                <input type="number"
                                       name="year"
                                       value="<?= old('year', date('Y')) ?>"
                                       min="2020"
                                       max="2100"
                                       required>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-field flex items-end">
                            <label class="form-label opacity-0">Aksi</label>
                            <button type="submit" class="btn-primary w-full">
                                <i class="fas fa-plus mr-2"></i>Buat Periode
                            </button>
                        </div>
                    </div>
                                
                    <!-- Description -->
                    <div class="form-field">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description"
                                  rows="2"
                                  class="form-textarea"
                                  placeholder="Deskripsi singkat periode ini..."><?= old('description') ?></textarea>
                    </div>
                </form>

                <hr class="border-slate-100 my-6">

                <!-- Existing Periods List -->
                <h4 class="font-display font-bold text-sm text-(--text-heading) mb-4">Daftar Periode</h4>

                <?php if (empty($periods)): ?>
                    <div class="text-center py-8 text-(--text-muted)">
                        <i class="fas fa-inbox text-4xl mb-3 opacity-50"></i>
                        <p class="text-sm">Belum ada periode yang dibuat</p>
                    </div>
                <?php else: ?>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php foreach ($periods as $period): ?>
                        <div class="p-4 rounded-xl border <?= $period['is_active'] ? 'border-sky-200 bg-sky-50/30' : 'border-slate-200 bg-white' ?>">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h5 class="font-display font-bold text-(--text-heading)"><?= esc($period['name']) ?></h5>
                                    <p class="text-sm text-(--text-muted)">Tahun <?= $period['year'] ?></p>
                                </div>
                                <?php if ($period['is_active']): ?>
                                    <span class="pmw-status pmw-status-success text-[10px]">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php if ($period['description']): ?>
                                <p class="text-xs text-(--text-body) mb-3 line-clamp-2"><?= esc($period['description']) ?></p>
                            <?php endif; ?>

                            <div class="flex items-center gap-2">
                                <?php if (!$period['is_active']): ?>
                                    <form action="<?= base_url('admin/pmw-system/period/activate/' . $period['id']) ?>" method="post" class="flex-1"
                                          onsubmit="return confirm('Aktifkan periode <?= esc($period['name']) ?>? Periode lain akan otomatis dinonaktifkan.');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="w-full py-2 px-3 rounded-lg bg-sky-500 hover:bg-sky-600 text-white text-xs font-semibold transition-colors">
                                            <i class="fas fa-power-off mr-1"></i> Aktifkan
                                        </button>
                                    </form>
                                    <a href="<?= base_url('admin/pmw-system/period/delete/' . $period['id']) ?>"
                                       onclick="return confirm('Yakin ingin menghapus periode ini? Semua jadwal terkait juga akan terhapus.')"
                                       class="py-2 px-3 rounded-lg bg-rose-100 hover:bg-rose-200 text-rose-600 text-xs font-semibold transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                <?php else: ?>
                                    <form action="<?= base_url('admin/pmw-system/period/deactivate/' . $period['id']) ?>" method="post" class="flex-1"
                                          onsubmit="return confirm('Nonaktifkan periode <?= esc($period['name']) ?>? Tidak akan ada periode aktif.');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="w-full py-2 px-3 rounded-lg bg-slate-400 hover:bg-slate-500 text-white text-xs font-semibold transition-colors">
                                            <i class="fas fa-ban mr-1"></i> Nonaktifkan
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div><!-- /page wrapper -->

<!-- Toast Notification Container -->
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2 transition-all duration-300 opacity-0 translate-x-full pointer-events-none">
    <div id="toast" class="bg-rose-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-lg"></i>
        <div>
            <p id="toast-message" class="font-semibold text-sm"></p>
        </div>
    </div>
</div>

<!-- Schedule Date Validation Script -->
<script>
(function() {
    const form = document.querySelector('form[action*="pmw-system/schedule"]');
    if (!form) return;

    const submitBtn = form.querySelector('button[type="submit"]');
    const toastContainer = document.getElementById('toast-container');
    const toastMessage = document.getElementById('toast-message');

    let toastTimeout;

    function showToast(message) {
        toastMessage.textContent = message;
        toastContainer.classList.remove('opacity-0', 'translate-x-full', 'pointer-events-none');
        toastContainer.classList.add('opacity-100', 'translate-x-0');

        clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            hideToast();
        }, 5000);
    }

    function hideToast() {
        toastContainer.classList.add('opacity-0', 'translate-x-full', 'pointer-events-none');
        toastContainer.classList.remove('opacity-100', 'translate-x-0');
    }

    function validateDates() {
        const rows = form.querySelectorAll('tbody tr');
        const schedules = [];

        rows.forEach(row => {
            const startInput = row.querySelector('input[name*="[start_date]"]');
            const endInput = row.querySelector('input[name*="[end_date]"]');
            const phaseCell = row.querySelector('td:first-child');

            if (startInput && endInput && phaseCell) {
                const phase = parseInt(phaseCell.textContent.trim());
                schedules.push({
                    phase: phase,
                    start: startInput.value,
                    end: endInput.value,
                    startInput: startInput,
                    endInput: endInput
                });
            }
        });

        // Sort by phase number
        schedules.sort((a, b) => a.phase - b.phase);

        let hasError = false;
        let errorMessage = '';

        for (let i = 0; i < schedules.length; i++) {
            const current = schedules[i];

            // Reset styles
            current.startInput.classList.remove('border-rose-500', 'bg-rose-50');
            current.endInput.classList.remove('border-rose-500', 'bg-rose-50');

            // Skip if empty
            if (!current.start || !current.end) continue;

            const currentStart = new Date(current.start);
            const currentEnd = new Date(current.end);

            // Validate: end >= start (dalam 1 tahap)
            if (currentEnd < currentStart) {
                hasError = true;
                errorMessage = `Tahap ${current.phase}: Tanggal selesai harus lebih besar dari tanggal mulai`;
                current.startInput.classList.add('border-rose-500', 'bg-rose-50');
                current.endInput.classList.add('border-rose-500', 'bg-rose-50');
                break;
            }

            // Validate: start >= end tahap sebelumnya
            if (i > 0) {
                const prev = schedules[i - 1];
                if (prev.end) {
                    const prevEnd = new Date(prev.end);
                    if (currentStart < prevEnd) {
                        hasError = true;
                        errorMessage = `Tahap ${current.phase}: Tanggal mulai harus lebih besar atau sama dengan tanggal selesai Tahap ${prev.phase}`;
                        current.startInput.classList.add('border-rose-500', 'bg-rose-50');
                        break;
                    }
                }
            }
        }

        // Toggle submit button
        if (submitBtn) {
            submitBtn.disabled = hasError;
            submitBtn.classList.toggle('opacity-50', hasError);
            submitBtn.classList.toggle('cursor-not-allowed', hasError);
        }

        // Show/hide toast
        if (hasError) {
            showToast(errorMessage);
        } else {
            hideToast();
        }

        return !hasError;
    }

    // Listen to date changes
    form.querySelectorAll('input[type="date"]').forEach(input => {
        input.addEventListener('change', validateDates);
        input.addEventListener('blur', validateDates);
    });

    // Validate on form submit
    form.addEventListener('submit', function(e) {
        if (!validateDates()) {
            e.preventDefault();
        }
    });

    // Initial validation
    validateDates();
})();
</script>

<?= $this->endSection() ?>
