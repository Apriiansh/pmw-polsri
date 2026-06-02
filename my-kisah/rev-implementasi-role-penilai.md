# Rencana Implementasi Role Penilai

## Tujuan
Tambah role **Penilai** — user yang hanya bisa verifikasi/penilaian Pitching Desk (tidak bisa akses admin lain).

## Catatan: Semua perubahan dilakukan via `php spark`
Migration, run, dan tooling pakai CLI. Tidak ada file migrasi yang ditulis manual dengan tangan — cukup `php spark make:migration <nama>`, lalu edit method `up()` / `down()`.

---

## Arsitektur: Copy atau Shared?

```
Admin (existing)                    Penilai (baru)
══════════════════════════          ══════════════════════════
Route: /admin/pitching-desk/*       Route: /penilai/pitching-desk/*
Guard: group:admin                  Guard: group:penilai
Controller: Admin\PitchingDesk      Controller: Penilai\PitchingDesk  ← COPY
Views: admin/pitching/              Views: penilai/pitching/          ← COPY
Models: PmwProposalModel            Models: PmwProposalModel          ← SHARED (sama)
Model: PmwSelectionPitchingModel    Model: PmwSelectionPitchingModel  ← SHARED (sama)
DB: pmw_selection_pitching          DB: pmw_selection_pitching        ← SHARED (sama)
```

**Penilai controller = copy dari Admin controller**, bedanya cuma:
- View path → `penilai/pitching/` (bukan `admin/pitching/`)
- Heading/subtitle teks
- Route guard

**Models dan DB table tetap sama** — penilai dan admin write ke kolom `status`/`catatan`/`persentase_nilai` yang sama.

---

## Fitur Tambahan (Bersama Admin & Penilai)

1. Kolom baru `persentase_nilai DECIMAL(5,2)` di `pmw_selection_pitching`
2. Halaman pitching desk di-split by kategori (Pemula / Berkembang) via tab filter
3. Default view: status `pending` (menunggu validasi)
4. Item sudah divalidasi diurut `persentase_nilai DESC` (nilai tertinggi dulu)

---

## Ringkasan Perubahan — 14 File

| # | File | Perubahan |
|---|------|-----------|
| 1 | `app/Database/Migrations/2026-06-02-XXXXXX_MakePitchingStatusGeneric.php` | **Buat via `php spark make:migration`** — rename `admin_status`→`status`, `admin_catatan`→`catatan`, add `persentase_nilai` di `pmw_selection_pitching` |
| 2 | `app/Database/Migrations/2026-06-02-XXXXXX_CreatePenilaiTable.php` | **Buat via `php spark make:migration`** — table `pmw_penilai` |
| 3 | `app/Database/Migrations/2026-06-02-XXXXXX_SyncPenilaiToShieldSettings.php` | **Buat via `php spark make:migration`** — update settings table untuk AuthGroups.groups, matrix, permissions |
| 4 | `app/Config/AuthGroups.php` | **Edit** — tambah group `penilai` di `$groups`, `$permissions`, `$matrix` |
| 5 | `app/Models/Selection/PmwSelectionPitchingModel.php` | **Edit** — `$allowedFields` rename + add `persentase_nilai` |
| 6 | `app/Models/Proposal/PmwProposalModel.php` | **Edit** — `getProposalsForAdminPitching()`: rename alias, add `persentase_nilai`, add filter kategori + sorting |
| 7 | `app/Controllers/Admin/PitchingDeskController.php` | **Edit** — key rename, add persentase_nilai, default pending filter, kategori filter, sorting |
| 8 | `app/Controllers/Penilai/PitchingDeskController.php` | **Buat** — **COPY** dari Admin, ganti view path ke `penilai/pitching/` |
| 9 | `app/Views/admin/pitching/validation.php` | **Edit** — rename var, tambah tab kategori, kolom nilai |
| 10 | `app/Views/admin/pitching/validation_detail.php` | **Edit** — rename var, tambah input persentase_nilai di form |
| 11 | `app/Views/penilai/pitching/validation.php` | **Buat** — **COPY** dari admin view, sesuaikan heading/subtitle |
| 12 | `app/Views/penilai/pitching/validation_detail.php` | **Buat** — **COPY** dari admin view, sesuaikan heading/subtitle |
| 13 | `app/Config/Routes.php` | **Edit** — tambah grup route `penilai/pitching-desk/*` |
| 14 | `app/Controllers/AdminController.php` | **Edit** — tambah `penilai` di dropdown role create user + handle profile creation |

---

## Detail Perubahan Per File

---

### 1. Migration — Rename Kolom + Add Persentase

**Generate via:**
```bash
php spark make:migration MakePitchingStatusGeneric
```
File yang dibuat: `app/Database/Migrations/2026-06-02-XXXXXX_MakePitchingStatusGeneric.php` (timestamp auto-prepend)

**Edit `up()`:**
```php
public function up()
{
    // Rename admin_status -> status
    $this->forge->modifyColumn('pmw_selection_pitching', [
        'admin_status' => [
            'name'       => 'status',
            'type'       => 'ENUM',
            'constraint' => ['pending', 'approved', 'rejected', 'revision'],
            'default'    => 'pending',
        ],
    ]);

    // Rename admin_catatan -> catatan
    $this->forge->modifyColumn('pmw_selection_pitching', [
        'admin_catatan' => [
            'name' => 'catatan',
            'type' => 'TEXT',
            'null' => true,
        ],
    ]);

    // Tambah kolom persentase_nilai
    $this->forge->addColumn('pmw_selection_pitching', [
        'persentase_nilai' => [
            'type'       => 'DECIMAL',
            'constraint' => '5,2',
            'null'       => true,
            'after'      => 'catatan',
        ],
    ]);
}

public function down()
{
    // Drop persentase_nilai
    $this->forge->dropColumn('pmw_selection_pitching', 'persentase_nilai');

    // Revert catatan -> admin_catatan
    $this->forge->modifyColumn('pmw_selection_pitching', [
        'catatan' => [
            'name' => 'admin_catatan',
            'type' => 'TEXT',
            'null' => true,
        ],
    ]);

    // Revert status -> admin_status
    $this->forge->modifyColumn('pmw_selection_pitching', [
        'status' => [
            'name'       => 'admin_status',
            'type'       => 'ENUM',
            'constraint' => ['pending', 'approved', 'rejected', 'revision'],
            'default'    => 'pending',
        ],
    ]);
}
```

`dosen_status` / `dosen_catatan` tetap tidak berubah.

**Run via:**
```bash
php spark migrate
```

---

### 2. Migration — Create Table `pmw_penilai`

**Generate via:**
```bash
php spark make:migration CreatePenilaiTable
```

**Edit `up()`:**
```php
public function up()
{
    $this->forge->addField([
        'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'user_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        'nama'        => ['type' => 'VARCHAR', 'constraint' => 100],
        'nidn'        => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
        'nip'         => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
        'institution' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
        'expertise'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        'phone'       => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
        'bio'         => ['type' => 'TEXT', 'null' => true],
        'created_at'  => ['type' => 'DATETIME', 'null' => true],
        'updated_at'  => ['type' => 'DATETIME', 'null' => true],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->addUniqueKey('user_id');
    $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('pmw_penilai');
}

public function down()
{
    $this->forge->dropTable('pmw_penilai');
}
```

Pattern persis `pmw_reviewers`.

**Run via:**
```bash
php spark migrate
```

---

### 3. Migration — Sync Penilai ke Shield Settings

PENTING — Shield baca groups via `setting('AuthGroups.groups')` (settings table). Setelah nambah `penilai` ke `AuthGroups.php`, kita juga harus update settings table-nya.

**Generate via:**
```bash
php spark make:migration SyncPenilaiToShieldSettings
```

**Edit `up()`:**
```php
public function up()
{
    $db = \Config\Database::connect();

    // 1. Update AuthGroups.groups — tambahkan penilai
    $currentGroups = $db->table('settings')
        ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
        ->where('key', 'groups')
        ->get()->getRowArray();

    if ($currentGroups) {
        $groups = json_decode($currentGroups['value'], true);
        if (!isset($groups['penilai'])) {
            $groups['penilai'] = [
                'title'       => 'Penilai',
                'description' => 'Assessors for pitching desk evaluation.',
            ];
            $db->table('settings')
                ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
                ->where('key', 'groups')
                ->update(['value' => json_encode($groups)]);
        }
    }

    // 2. Update AuthGroups.permissions — tambahkan data.pitching_verify
    $currentPerms = $db->table('settings')
        ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
        ->where('key', 'permissions')
        ->get()->getRowArray();

    if ($currentPerms) {
        $perms = json_decode($currentPerms['value'], true);
        if (!isset($perms['data.pitching_verify'])) {
            $perms['data.pitching_verify'] = 'Can verify/assess pitching desk submissions';
            $db->table('settings')
                ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
                ->where('key', 'permissions')
                ->update(['value' => json_encode($perms)]);
        }
    }

    // 3. Update AuthGroups.matrix — assign permission ke penilai
    $currentMatrix = $db->table('settings')
        ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
        ->where('key', 'matrix')
        ->get()->getRowArray();

    if ($currentMatrix) {
        $matrix = json_decode($currentMatrix['value'], true);
        if (!isset($matrix['penilai'])) {
            $matrix['penilai'] = [
                'data.pitching_verify',
                'data.view_all',
            ];
            $db->table('settings')
                ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
                ->where('key', 'matrix')
                ->update(['value' => json_encode($matrix)]);
        }
    }
}

public function down()
{
    $db = \Config\Database::connect();

    // Revert: hapus penilai dari groups
    $currentGroups = $db->table('settings')
        ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
        ->where('key', 'groups')
        ->get()->getRowArray();
    if ($currentGroups) {
        $groups = json_decode($currentGroups['value'], true);
        unset($groups['penilai']);
        $db->table('settings')
            ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
            ->where('key', 'groups')
            ->update(['value' => json_encode($groups)]);
    }

    // Revert: hapus data.pitching_verify
    $currentPerms = $db->table('settings')
        ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
        ->where('key', 'permissions')
        ->get()->getRowArray();
    if ($currentPerms) {
        $perms = json_decode($currentPerms['value'], true);
        unset($perms['data.pitching_verify']);
        $db->table('settings')
            ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
            ->where('key', 'permissions')
            ->update(['value' => json_encode($perms)]);
    }

    // Revert: hapus penilai dari matrix
    $currentMatrix = $db->table('settings')
        ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
        ->where('key', 'matrix')
        ->get()->getRowArray();
    if ($currentMatrix) {
        $matrix = json_decode($currentMatrix['value'], true);
        unset($matrix['penilai']);
        $db->table('settings')
            ->where('class', 'CodeIgniter\Shield\Config\AuthGroups')
            ->where('key', 'matrix')
            ->update(['value' => json_encode($matrix)]);
    }
}
```

**Run via:**
```bash
php spark migrate
```

---

### 4. Config/AuthGroups.php

**Tambah di `$groups`:**
```php
'penilai' => [
    'title'       => 'Penilai',
    'description' => 'Assessors for pitching desk evaluation.',
],
```

**Tambah di `$permissions`:**
```php
'data.pitching_verify' => 'Can verify/assess pitching desk submissions',
```

**Tambah di `$matrix`:**
```php
'penilai' => [
    'data.pitching_verify',
    'data.view_all',
],
```

---

### 5. Models/Selection/PmwSelectionPitchingModel.php

**`$allowedFields`:**
```php
protected $allowedFields = [
    'proposal_id',
    'student_submitted_at',
    'dosen_status',
    'status',            // ← ADMIN_STATUS → STATUS
    'dosen_catatan',
    'catatan',           // ← ADMIN_CATATAN → CATATAN
    'persentase_nilai',  // ← BARU
];
```

---

### 6. Models/Proposal/PmwProposalModel.php

**Method `getProposalsForAdminPitching()`:**

Select:
```php
// BEFORE:
'sp.admin_status as pitching_admin_status',

// AFTER:
'sp.status as pitching_status',
'sp.persentase_nilai',
'p.kategori_wirausaha',
```

Signature:
```php
public function getProposalsForAdminPitching(
    ?string $statusFilter = null,
    ?string $kategoriFilter = null   // 'pemula' | 'berkembang' | null
): array
```

Tambahan WHERE:
```php
if ($kategoriFilter) {
    $builder->where('p.kategori_wirausaha', $kategoriFilter);
}
```

Sorting:
```php
// BEFORE:
$builder->orderBy('p.updated_at', 'DESC');

// AFTER:
$builder->orderBy("(sp.status = 'pending') DESC", '', false);  // pending first
$builder->orderBy('sp.persentase_nilai', 'DESC', false);       // then by score
```

Method ini bisa dipanggil juga oleh penilai (sama querynya).

---

### 7. Controllers/Admin/PitchingDeskController.php

**a. `validateAction()` — key rename + persentase:**
```php
// BEFORE:
'admin_status'  => $status,
'admin_catatan' => $catatan ?: null,

// AFTER:
'status'           => $status,
'catatan'          => $catatan ?: null,
'persentase_nilai' => $this->request->getPost('persentase_nilai') ?: null,
```

**b. `index()` — filter kategori + default pending:**
```php
public function index()
{
    $proposalModel = new PmwProposalModel();

    $statusFilter   = $this->request->getGet('status') ?: 'pending';  // default
    $kategoriFilter = $this->request->getGet('kategori');              // null|pemula|berkembang

    $proposals = $proposalModel->getProposalsForAdminPitching($statusFilter, $kategoriFilter);

    // Stats — panggil ulang tanpa status filter buat itung total per kategori
    $allProposals = $proposalModel->getProposalsForAdminPitching(null, $kategoriFilter);
    $stats = [
        'total'     => count($allProposals),
        'pending'   => count(array_filter($allProposals, fn($p) => $p['pitching_status'] === 'pending' && empty($p['student_submitted_at']))),
        'submitted' => count(array_filter($allProposals, fn($p) => $p['pitching_status'] === 'pending' && !empty($p['student_submitted_at']))),
        'approved'  => count(array_filter($allProposals, fn($p) => $p['pitching_status'] === 'approved')),
        'revision'  => count(array_filter($allProposals, fn($p) => $p['pitching_status'] === 'revision')),
        'rejected'  => count(array_filter($allProposals, fn($p) => $p['pitching_status'] === 'rejected')),
    ];

    return view('admin/pitching/validation', [
        'title'           => 'Validasi Akhir Pitching | PMW Polsri',
        'proposals'       => $proposals,
        'stats'           => $stats,
        'statusFilter'    => $statusFilter,
        'kategoriFilter'  => $kategoriFilter,
    ]);
}
```

**c. `detail()`** — `persentase_nilai` otomatis ke-include dari result array.

---

### 8. Controllers/Penilai/PitchingDeskController.php (BARU — COPY)

**File baru:** `app/Controllers/Penilai/PitchingDeskController.php`

```
Namespace:  App\Controllers\Penilai
Extends:    BaseController
Helpers:    ['form', 'url', 'pmw']
```

**Method yang di-copy dari Admin** (logic identik):
- `index()` — view → `penilai/pitching/validation`
- `detail(int $id)` — view → `penilai/pitching/validation_detail`
- `validateAction(int $id)` — sama persis
- `viewDoc(int $id)` — sama persis

**Bedanya:**
- View path: `penilai/pitching/` bukan `admin/pitching/`
- Route guard: `group:penilai`

---

### 9. Views/admin/pitching/validation.php

**a. Variable rename:**
- `$proposal['pitching_admin_status']` → `$proposal['pitching_status']`
- Tambah: `$proposal['persentase_nilai']`, `$proposal['kategori_wirausaha']`

**b. Tambah tab kategori** (sebelum tab status existing):
```html
<div class="flex flex-wrap gap-2 animate-stagger delay-200">
    <a href="?kategori=&status=<?= $statusFilter ?>" class="...">Semua</a>
    <a href="?kategori=pemula&status=<?= $statusFilter ?>" class="...">
        <i class="fas fa-rocket mr-1"></i> Pemula
    </a>
    <a href="?kategori=berkembang&status=<?= $statusFilter ?>" class="...">
        <i class="fas fa-chart-line mr-1"></i> Berkembang
    </a>
</div>
```

**c. Tambah kolom Nilai di table:**
```html
<th class="text-center">Nilai</th>
<th class="text-center">PPT/PDF</th>
<th>Status Penilai</th>
```

Cell:
```php
<?php if ($proposal['pitching_status'] !== 'pending' && $proposal['persentase_nilai'] !== null): ?>
    <span class="text-emerald-600 font-bold"><?= number_format($proposal['persentase_nilai'], 2) ?>%</span>
<?php else: ?>
    <span class="text-slate-300">-</span>
<?php endif; ?>
```

**d. Status label: "Penilai" bukan "Admin":**
- "Siap Dinilai" bukan "Siap Validasi"

---

### 10. Views/admin/pitching/validation_detail.php

**a. Variable rename:**
- `$proposal['pitching_admin_status']` → `$proposal['pitching_status']`
- `$proposal['pitching_admin_catatan']` → `$proposal['pitching_catatan']`

**b. Tambah input Nilai Akhir (%)** — letakkan SEBELUM radio button status:
```html
<div class="space-y-1.5">
    <label class="form-label">Nilai Akhir <span class="required">*</span></label>
    <div class="input-group items-center py-2 group focus-within:ring-4 focus-within:ring-sky-100 transition-all">
        <div class="input-icon text-slate-400 group-focus-within:text-sky-500">
            <i class="fas fa-percentage text-base"></i>
        </div>
        <input type="number" name="persentase_nilai"
               min="0" max="100" step="0.01"
               value="<?= esc($proposal['persentase_nilai'] ?? '') ?>"
               placeholder="0.00 - 100.00"
               class="w-full bg-transparent border-none outline-none text-sm font-semibold text-slate-700 placeholder:text-slate-300">
    </div>
</div>
```

**c. Tampilkan nilai saat ini di header card** (kalau sudah divalidasi):
```php
<?php if ($proposal['persentase_nilai'] !== null): ?>
<div class="...">
    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Nilai Akhir</p>
    <p class="font-display text-xl font-black text-emerald-600">
        <?= number_format($proposal['persentase_nilai'], 2) ?>%
    </p>
</div>
<?php endif; ?>
```

---

### 11–12. Views penilai/pitching/ (BARU — COPY dari admin)

Copy hasil edit dari step 9 & 10 ke folder baru:
```
app/Views/penilai/pitching/validation.php        ← copy dari admin
app/Views/penilai/pitching/validation_detail.php  ← copy dari admin
```

**Penyesuaian teks:**
| Teks Admin | Teks Penilai |
|---|---|
| "Validasi Akhir Pitching Desk" | "Penilaian Pitching Desk" |
| "Validasi Administrasi & Desk Evaluation" | "Penilaian oleh Penilai" |
| "Validasi Final Admin" | "Form Penilaian" |
| "Validasi Final Admin/UPAPKK" | "Penilaian Pitching Desk oleh Penilai" |
| "Tentukan keputusan akhir untuk tahap Pitching Desk" | "Berikan penilaian untuk tahap Pitching Desk" |
| "Catatan Validasi Admin" | "Catatan Penilai" |

---

### 13. Config/Routes.php

Tambah dalam grup `['filter' => 'session']` (bersama route auth lain):
```php
$routes->group('penilai', ['filter' => 'group:penilai'], static function ($routes) {
    $routes->get('pitching-desk', 'Penilai\PitchingDeskController::index');
    $routes->get('pitching-desk/(:num)', 'Penilai\PitchingDeskController::detail/$1');
    $routes->post('pitching-desk/(:num)/validate', 'Penilai\PitchingDeskController::validateAction/$1');
    $routes->get('pitching-desk/doc/(:num)', 'Penilai\PitchingDeskController::viewDoc/$1');
});
```

---

### 14. Controllers/AdminController.php

**a. `createUser()` — tambah `penilai` di dropdown:**
```php
$roles = [
    'admin'     => 'Administrator',
    'mahasiswa' => 'Mahasiswa',
    'dosen'     => 'Dosen',
    'mentor'    => 'Mentor',
    'reviewer'  => 'Reviewer',
    'penilai'   => 'Penilai',   // ← BARU
];
```

**b. `storeUser()`** — validasi role sudah include `penilai` (cek `$authGroups->groups`).

**c. `createRoleProfile()` — tambah handler `penilai`:**
```php
private function createRoleProfile(int $userId, string $role, array $data): void
{
    switch ($role) {
        // ... existing cases ...
        case 'penilai':
            $penilaiModel = new \App\Models\PenilaiModel();  // atau buat nanti
            $penilaiModel->insert([
                'user_id'     => $userId,
                'nama'        => $data['nama'] ?? '',
                'nidn'        => $data['nidn'] ?? null,
                'nip'         => $data['nip'] ?? null,
                'institution' => $data['institution'] ?? null,
                'expertise'   => $data['expertise'] ?? null,
                'phone'       => $data['phone'] ?? null,
                'bio'         => $data['bio'] ?? null,
            ]);
            break;
    }
}
```

(Cek existing pattern di method yang sama untuk dosen/mentor/reviewer.)

---

## Dependency Graph (Urutan Eksekusi)

```
Migration 1 (rename + add persentase_nilai)
  │
  ├──→ PmwSelectionPitchingModel   ($allowedFields)
  ├──→ PmwProposalModel            (query alias + filter + sorting)
  ├──→ Admin/PitchingDeskController (keys + filter)
  └──→ Views admin & penilai       (var names)

Migration 2 (pmw_penilai table)
  └──→ AdminController             (createRoleProfile)

Migration 3 (Sync settings)
  └──→ AuthGroups runs (untuk isValidGroup() check di Shield)

AuthGroups (group + permission)
  ├──→ Routes (route guard)
  └──→ AdminController (user mgmt dropdown)

Penilai/PitchingDeskController
  ├──→ Routes
  └──→ Views penilai/pitching/
```

**Migration 1, 2, 3 harus di-run** sebelum kode baru di-deploy:
```bash
php spark migrate
```

**Urutan eksekusi langkah:**
1. `php spark make:migration` × 3
2. Edit masing-masing `up()` & `down()`
3. `php spark migrate`
4. Edit `AuthGroups.php`
5. Edit models & controllers & views
6. Buat Penilai controller & views (copy)
7. Edit `Routes.php`
8. Edit `AdminController.php`
9. `php spark serve` & test manual

---

## Halaman Pitching Desk — Alur Data

```
URL: /admin/pitching-desk?status=pending&kategori=pemula

                          ┌───────────────────────────────────────┐
                          │  Controller: index()                  │
                          │  $statusFilter   = 'pending' (default)│
                          │  $kategoriFilter = 'pemula'           │
                          └──────────┬────────────────────────────┘
                                     │
                          ┌──────────▼────────────────────────────┐
                          │  PmwProposalModel                     │
                          │  → getProposalsForAdminPitching()     │
                          │    WHERE sp.status = 'pending'        │
                          │    AND p.kategori_wirausaha = 'pemula'│
                          │    ORDER BY pending first,            │
                          │             persentase_nilai DESC     │
                          └──────────┬────────────────────────────┘
                                     │
                          ┌──────────▼────────────────────────────┐
                          │  View: admin/pitching/validation      │
                          │  - Tab kategori: [Semua] [Pemula]     │
                          │                  [Berkembang]         │
                          │  - Tab status: [Semua] [Menunggu]     │
                          │               [Disetujui] [Revisi]    │
                          │               [Ditolak]               │
                          │  - Table: Nama | Ketua | Nilai |      │
                          │           Video | PPT | Status | Aksi │
                          └───────────────────────────────────────┘

Default: status=pending, kategori="" (semua kategori)
```

---

## ✅ Final Review — Checklist

- [x] Migration 1: rename kolom + add `persentase_nilai`
- [x] Migration 2: create `pmw_penilai`
- [x] Migration 3: sync `penilai` ke Shield settings (groups, permissions, matrix)
- [x] AuthGroups.php: tambah group `penilai`
- [x] Models: `allowedFields` + query update
- [x] Admin controller: key rename, filter, sorting
- [x] Penilai controller: copy dari admin
- [x] Views admin: rename var, tab kategori, kolom nilai, form input
- [x] Views penilai: copy dari admin
- [x] Routes: grup `penilai/pitching-desk/*`
- [x] AdminController: dropdown `penilai` + profile creation
- [x] Default filter: status=pending
- [x] Sorting: pending first → score DESC
- [x] Category split: Pemula / Berkembang

**Plan ini FINAL.** Tidak ada lagi yang perlu diubah. Tinggal eksekusi sesuai urutan di atas.
