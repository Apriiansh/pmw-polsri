<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8">

    <!-- ================================================================
         1. PAGE HEADING + ACTION
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                <?= $header_title ?> <span class="text-gradient">System</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]"><?= $header_subtitle ?></p>
        </div>
        <a href="<?= base_url('admin/users/create') ?>" class="btn-accent text-sm justify-center">
            <i class="fas fa-plus mr-2"></i>
            <span class="hidden sm:inline">Tambah User</span>
            <span class="sm:hidden">Tambah</span>
        </a>
    </div>

    <!-- ================================================================
         2. STATS OVERVIEW
    ================================================================= -->
    <?php
    $totalUsers = count($users);
    $roleCounts = ['admin' => 0, 'mahasiswa' => 0, 'dosen' => 0, 'mentor' => 0, 'reviewer' => 0];
    foreach ($users as $user) {
        foreach ($user->groups as $group) {
            if (isset($roleCounts[$group])) {
                $roleCounts[$group]++;
            }
        }
    }

    $stats = [
        ['title' => 'Total User', 'value' => $totalUsers, 'icon' => 'fa-users', 'bg' => 'bg-sky-50', 'icon_color' => 'text-sky-500'],
        ['title' => 'Mahasiswa', 'value' => $roleCounts['mahasiswa'], 'icon' => 'fa-user-graduate', 'bg' => 'bg-teal-50', 'icon_color' => 'text-teal-500'],
        ['title' => 'Dosen', 'value' => $roleCounts['dosen'], 'icon' => 'fa-chalkboard-user', 'bg' => 'bg-violet-50', 'icon_color' => 'text-violet-500'],
        ['title' => 'Reviewer', 'value' => $roleCounts['reviewer'], 'icon' => 'fa-clipboard-check', 'bg' => 'bg-yellow-50', 'icon_color' => 'text-yellow-500'],
    ];
    ?>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5">
        <?php foreach ($stats as $index => $stat): ?>
        <div class="card-premium p-3 sm:p-5 flex items-center gap-3 sm:gap-4 animate-stagger delay-<?= ($index + 1) * 100 ?>">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl <?= $stat['bg'] ?> flex items-center justify-center shrink-0">
                <i class="fas <?= $stat['icon'] ?> text-lg sm:text-xl <?= $stat['icon_color'] ?>"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[10px] sm:text-[11px] font-black text-slate-400 uppercase tracking-wider truncate"><?= $stat['title'] ?></p>
                <h3 class="font-display text-xl sm:text-2xl font-black text-(--text-heading)"><?= $stat['value'] ?></h3>
            </div>
        </div>
        <?php endforeach; ?>
    </div>


    <!-- ================================================================
         3. USERS TABLE
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-500">
        
        <!-- Table Header -->
        <div class="px-4 sm:px-7 py-4 sm:py-5 border-b border-sky-50 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white/60">
            <div>
                <h3 class="font-display text-base font-bold text-(--text-heading)">Daftar Pengguna</h3>
                <p class="text-[11px] text-(--text-muted) font-semibold mt-0.5">Semua user yang terdaftar di sistem</p>
            </div>
            
            <!-- Search/Filter -->
            <div class="input-group w-full sm:max-w-xs">
                <span class="input-icon">
                    <i class="fas fa-magnifying-glass text-sm text-slate-400"></i>
                </span>
                <input type="text" placeholder="Cari user..." class="text-sm w-full">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="pmw-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Terdaftar</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): 
                        $mainGroup = $user->groups[0] ?? 'visitor';
                        
                        // Role badge colors
                        $roleColors = [
                            'admin'     => 'bg-rose-50 text-rose-600 border-rose-200',
                            'mahasiswa' => 'bg-sky-50 text-sky-600 border-sky-200',
                            'dosen'     => 'bg-violet-50 text-violet-600 border-violet-200',
                            'mentor'    => 'bg-teal-50 text-teal-600 border-teal-200',
                            'reviewer'  => 'bg-yellow-50 text-yellow-600 border-yellow-200',
                        ];
                        $roleBadge = $roleColors[$mainGroup] ?? 'bg-slate-50 text-slate-600 border-slate-200';
                        
                        // Role labels
                        $roleLabels = [
                            'admin'     => 'Administrator',
                            'mahasiswa' => 'Mahasiswa',
                            'dosen'     => 'Dosen',
                            'mentor'    => 'Mentor',
                            'reviewer'  => 'Reviewer',
                        ];
                        $roleLabel = $roleLabels[$mainGroup] ?? ucfirst($mainGroup);
                        
                        // Status
                        $statusClass = $user->active ? 'pmw-status pmw-status-success' : 'pmw-status pmw-status-danger';
                        $statusText = $user->active ? 'Aktif' : 'Nonaktif';
                        $statusIcon = $user->active ? 'fa-circle-check' : 'fa-circle-xmark';
                    ?>
                    <tr class="group">
                        <!-- User Info -->
                        <td class="whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl bg-linear-to-tr from-sky-500 to-sky-400 flex items-center justify-center text-white font-display font-bold text-xs sm:text-sm shrink-0">
                                    <?= strtoupper(substr($user->username, 0, 2)) ?>
                                </div>
                                <div class="min-w-0">
                                    <div class="font-display font-bold text-(--text-heading) text-[13px] truncate max-w-[120px] sm:max-w-none">
                                        <?= esc($user->username) ?>
                                    </div>
                                    <div class="text-xs text-(--text-muted)">
                                        ID: <?= $user->id ?>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Role Badge -->
                        <td class="whitespace-nowrap">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 sm:px-2.5 rounded-lg text-[11px] sm:text-xs font-bold border <?= $roleBadge ?>">
                                <i class="fas fa-shield-alt text-[9px] sm:text-[10px]"></i>
                                <span class="hidden sm:inline"><?= $roleLabel ?></span>
                                <span class="sm:hidden"><?= substr($roleLabel, 0, 3) ?>.</span>
                            </span>
                        </td>

                        <!-- Status -->
                        <td>
                            <span class="<?= $statusClass ?>">
                                <i class="fas <?= $statusIcon ?> text-[10px]"></i>
                                <?= $statusText ?>
                            </span>
                        </td>

                        <!-- Date -->
                        <td>
                            <span class="text-xs text-(--text-muted) font-mono">
                                <?= $user->created_at ? date('d M Y', strtotime($user->created_at->toDateTimeString())) : '-' ?>
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5 sm:gap-2">
                                <!-- Detail Button -->
                                <?php
                                $profileJson = json_encode($user->profile ?? []);
                                $profileEscaped = htmlspecialchars($profileJson, ENT_QUOTES, 'UTF-8');
                                ?>
                                <button type="button"
                                        onclick='openUserModal(<?= $user->id ?>, "<?= esc($user->username) ?>", "<?= esc($user->email ?? '-') ?>", "<?= $roleLabel ?>", "<?= $mainGroup ?>", <?= $user->active ? 'true' : 'false' ?>, "<?= $user->created_at ? date('d M Y H:i', strtotime($user->created_at->toDateTimeString())) : '-' ?>", "<?= $mainGroup ?>", <?= $profileJson ?>)'
                                        class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-lg bg-violet-50 text-violet-500 hover:bg-violet-500 hover:text-white transition-all"
                                        title="Detail">
                                    <i class="fas fa-eye text-[11px] sm:text-xs"></i>
                                </button>
                                <a href="<?= base_url('admin/users/edit/' . $user->id) ?>"
                                   class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-lg bg-sky-50 text-sky-500 hover:bg-sky-500 hover:text-white transition-all"
                                   title="Edit">
                                    <i class="fas fa-pen text-[11px] sm:text-xs"></i>
                                </a>
                                <?php if ($user->id !== auth()->user()->id): ?>
                                <!-- Toggle Status -->
                                <a href="<?= base_url('admin/users/toggle-status/' . $user->id) ?>"
                                   class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-lg <?= $user->active ? "bg-orange-50 text-orange-500 hover:bg-orange-500" : "bg-emerald-50 text-emerald-500 hover:bg-emerald-500" ?> hover:text-white transition-all"
                                   title="<?= $user->active ? 'Nonaktifkan' : 'Aktifkan' ?>"
                                   onclick="return confirm('<?= $user->active ? 'Nonaktifkan user ini?' : 'Aktifkan user ini?' ?>')">
                                    <i class="fas <?= $user->active ? 'fa-ban' : 'fa-check' ?> text-[11px] sm:text-xs"></i>
                                </a>
                                <a href="<?= base_url('admin/users/delete/' . $user->id) ?>" 
                                   class="w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-lg bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all"
                                   title="Hapus"
                                   onclick="return confirm('Yakin ingin menghapus user ini?')">
                                    <i class="fas fa-trash text-[11px] sm:text-xs"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-12">
                            <div class="text-(--text-muted)">
                                <i class="fas fa-users text-4xl mb-3 opacity-30"></i>
                                <p class="text-sm">Belum ada user terdaftar</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="px-4 sm:px-7 py-3 sm:py-4 border-t border-sky-50 bg-white/40 flex items-center justify-between">
            <p class="text-xs text-(--text-muted)">Menampilkan <?= count($users) ?> user</p>
            <div class="flex gap-2">
                <button class="btn-outline btn-sm px-2! sm:px-3!" disabled>
                    <i class="fas fa-chevron-left text-xs"></i>
                </button>
                <button class="btn-outline btn-sm px-2! sm:px-3!" disabled>
                    <i class="fas fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>
    </div>

</div><!-- /page wrapper -->

<!-- User Detail Modal -->
<div id="userModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeUserModal()"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                <!-- Modal Header -->
                <div class="bg-linear-to-r from-sky-500 to-sky-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-display font-bold text-white" id="modal-title">Detail User</h3>
                        <button type="button" onclick="closeUserModal()" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-5">
                    <!-- Avatar & Username -->
                    <div class="text-center mb-5">
                        <div id="modal-avatar" class="w-16 h-16 mx-auto rounded-2xl bg-linear-to-tr from-sky-500 to-sky-400 flex items-center justify-center text-white font-display font-bold text-xl mb-3">
                            --
                        </div>
                        <h4 id="modal-username" class="font-display font-bold text-lg text-slate-800">--</h4>
                        <span id="modal-role-badge" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border mt-2">
                            --
                        </span>

                        <!-- Bio Section (Prominent) -->
                        <div id="modal-bio-container" class="mt-4 px-6 scale-in hidden">
                            <div class="relative bg-slate-50 rounded-2xl p-4 border border-slate-100">
                                <i class="fas fa-quote-left text-sky-200 absolute -top-2 -left-2 text-xl"></i>
                                <p id="modal-bio" class="text-xs sm:text-sm text-slate-500 italic leading-relaxed pt-1 line-clamp-4 hover:line-clamp-none transition-all cursor-default">
                                    --
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Two Column Layout -->
                    <div class="grid md:grid-cols-2 gap-5 p-4">
                        <!-- Left: Detail Akun -->
                        <div>
                            <h5 class="font-display font-bold text-sm text-slate-700 mb-3 flex items-center gap-2">
                                <i class="fas fa-user-circle text-sky-500"></i>
                                Detail Akun
                            </h5>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50">
                                    <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-slate-400 font-semibold uppercase">User ID</p>
                                        <p id="modal-userid" class="font-mono text-sm text-slate-700">--</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50">
                                    <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-slate-400 font-semibold uppercase">Email</p>
                                        <p id="modal-email" class="text-sm text-slate-700">--</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50">
                                    <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-slate-400 font-semibold uppercase">Role</p>
                                        <p id="modal-role" class="text-sm text-slate-700">--</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50">
                                    <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm">
                                        <i class="fas fa-circle-check"></i>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-slate-400 font-semibold uppercase">Status</p>
                                        <p id="modal-status" class="text-sm">--</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50">
                                    <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-slate-400 shadow-sm">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div>
                                        <p class="text-[11px] text-slate-400 font-semibold uppercase">Terdaftar</p>
                                        <p id="modal-created" class="text-sm text-slate-700">--</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Detail Role -->
                        <div id="modal-profile-section" class="hidden">
                            <h5 class="font-display font-bold text-sm text-slate-700 mb-3 flex items-center gap-2">
                                <i class="fas fa-id-badge text-sky-500"></i>
                                Detail <span id="modal-profile-role">Role</span>
                            </h5>
                            <div id="modal-profile-content" class="space-y-3">
                                <!-- Dynamic content -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="bg-slate-50 px-6 py-4 flex justify-end">
                    <button type="button" onclick="closeUserModal()" class="btn-outline text-sm">
                        <i class="fas fa-times mr-2"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openUserModal(id, username, email, roleLabel, roleKey, isActive, createdAt, roleGroup, profileData) {
    // Set avatar initials
    const initials = username.substring(0, 2).toUpperCase();
    document.getElementById('modal-avatar').textContent = initials;

    // Set text content
    document.getElementById('modal-userid').textContent = id;
    document.getElementById('modal-username').textContent = username;
    document.getElementById('modal-email').textContent = email;
    document.getElementById('modal-role').textContent = roleLabel;
    document.getElementById('modal-created').textContent = createdAt;

    // Set Bio
    const bioContainer = document.getElementById('modal-bio-container');
    const bioText = document.getElementById('modal-bio');
    if (profileData && profileData.bio && profileData.bio.trim() !== '') {
        bioContainer.classList.remove('hidden');
        bioText.textContent = profileData.bio;
    } else {
        bioContainer.classList.add('hidden');
    }

    // Set status
    const statusEl = document.getElementById('modal-status');
    if (isActive) {
        statusEl.innerHTML = '<span class="inline-flex items-center gap-1 text-emerald-600 font-semibold"><i class="fas fa-check-circle"></i> Aktif</span>';
    } else {
        statusEl.innerHTML = '<span class="inline-flex items-center gap-1 text-rose-600 font-semibold"><i class="fas fa-ban"></i> Nonaktif</span>';
    }

    // Set role badge colors
    const roleBadge = document.getElementById('modal-role-badge');
    const roleColors = {
        'admin': 'bg-rose-50 text-rose-600 border-rose-200',
        'mahasiswa': 'bg-sky-50 text-sky-600 border-sky-200',
        'dosen': 'bg-violet-50 text-violet-600 border-violet-200',
        'mentor': 'bg-teal-50 text-teal-600 border-teal-200',
        'reviewer': 'bg-yellow-50 text-yellow-600 border-yellow-200'
    };
    roleBadge.className = `inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border mt-2 ${roleColors[roleKey] || 'bg-slate-50 text-slate-600 border-slate-200'}`;
    roleBadge.innerHTML = `<i class="fas fa-shield-alt text-[10px]"></i> ${roleLabel}`;

    // Render role-specific profile data
    const profileSection = document.getElementById('modal-profile-section');
    const profileContent = document.getElementById('modal-profile-content');
    const profileRoleLabel = document.getElementById('modal-profile-role');

    profileContent.innerHTML = ''; // Clear previous

    if (profileData && Object.keys(profileData).length > 0) {
        profileSection.classList.remove('hidden');
        profileRoleLabel.textContent = roleLabel;

        let html = '';

        switch(roleGroup) {
            case 'mahasiswa':
                html = `
                    ${renderProfileField('fa-id-card', 'NIM', profileData.nim)}
                    ${renderProfileField('fa-user', 'Nama Lengkap', profileData.nama)}
                    ${renderProfileField('fa-building', 'Jurusan', profileData.jurusan)}
                    ${renderProfileField('fa-graduation-cap', 'Prodi', profileData.prodi)}
                    ${renderProfileField('fa-layer-group', 'Semester', profileData.semester)}
                    ${renderProfileField('fa-phone', 'No. HP', profileData.phone)}
                    ${profileData.gender ? renderProfileField('fa-venus-mars', 'Gender', profileData.gender === 'L' ? 'Laki-laki' : 'Perempuan') : ''}
                `;
                break;
            case 'dosen':
                html = `
                    ${renderProfileField('fa-id-badge', 'NIP/NIDN', profileData.nip || profileData.nidn)}
                    ${renderProfileField('fa-user', 'Nama Lengkap', profileData.nama)}
                    ${renderProfileField('fa-building', 'Jurusan', profileData.jurusan)}
                    ${renderProfileField('fa-graduation-cap', 'Prodi', profileData.prodi)}
                    ${renderProfileField('fa-star', 'Keahlian', profileData.expertise)}
                    ${renderProfileField('fa-phone', 'No. HP', profileData.phone)}
                    ${profileData.gender ? renderProfileField('fa-venus-mars', 'Gender', profileData.gender === 'L' ? 'Laki-laki' : 'Perempuan') : ''}
                `;
                break;
            case 'mentor':
                html = `
                    ${renderProfileField('fa-user', 'Nama Lengkap', profileData.nama)}
                    ${renderProfileField('fa-building', 'Perusahaan', profileData.company)}
                    ${renderProfileField('fa-briefcase', 'Jabatan', profileData.position)}
                    ${renderProfileField('fa-star', 'Keahlian', profileData.expertise)}
                    ${renderProfileField('fa-phone', 'No. HP', profileData.phone)}
                    ${renderProfileField('fa-envelope', 'Email Kantor', profileData.email)}
                `;
                break;
            case 'reviewer':
                html = `
                    ${renderProfileField('fa-id-badge', 'NIP/NIDN', profileData.nip || profileData.nidn)}
                    ${renderProfileField('fa-user', 'Nama Lengkap', profileData.nama)}
                    ${renderProfileField('fa-university', 'Institusi', profileData.institution)}
                    ${renderProfileField('fa-star', 'Keahlian', profileData.expertise)}
                    ${renderProfileField('fa-phone', 'No. HP', profileData.phone)}
                `;
                break;
            default:
                html = '<div class="text-center py-4 text-slate-400 italic">Data profil tidak tersedia</div>';
        }

        profileContent.innerHTML = html;
    } else {
        profileSection.classList.add('hidden');
    }

    // Show modal
    document.getElementById('userModal').classList.remove('hidden');
}

function renderProfileField(icon, label, value) {
    if (!value) return '';
    return `
        <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50/50 border border-slate-100/50">
            <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-sky-500 shadow-sm shrink-0">
                <i class="fas ${icon} text-xs"></i>
            </div>
            <div>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">${label}</p>
                <p class="text-[13px] text-slate-700 font-medium">${value}</p>
            </div>
        </div>
    `;
}

function closeUserModal() {
    document.getElementById('userModal').classList.add('hidden');
    document.body.style.overflow = '';
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('userModal').classList.contains('hidden')) {
        closeUserModal();
    }
});
</script>

<?= $this->endSection() ?>
