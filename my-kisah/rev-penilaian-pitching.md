# 📋 Revisi: Multi-Penilai Pitching Desk

**Tanggal**: 04 Jun 2026 (Update 2)
**Status**: PLAN (belum dieksekusi)
**File**: `my-kisah/rev-penilaian-pitching.md`

---

## 1. Latar Belakang & Masalah

### Current State
- Tahap pitching desk saat ini ditangani oleh **1 penilai/admin** yang memberikan 1 nilai
- 1 row per proposal di `pmw_selection_pitching` (kolom: `status`, `catatan`, `persentase_nilai`)
- Role `penilai` sudah ada di Shield tapi hanya **duplikat** dari admin (95% kode identik)
- Tabel `pmw_penilai` sudah dibuat (profile only, belum dipakai untuk relasi pitching)
- Tidak ada history/audit siapa yang menilai

### Masalah
1. **Single point of failure** — 1 juri terlalu subyektif
2. **Tidak ada transparansi** — mahasiswa tidak tahu ada berapa penilai yang menilai mereka
3. **Tidak ada agregasi** — `AVG()` calculation belum ada di mana pun
4. **Tidak scalable** — sulit menambah penilai baru tanpa ubah alur

### Kebutuhan User
> "gimana kalo kita itu ada banyak penilai (juri) sesuai misal user dengan role penilai ada 4 maka penilaian ada 4 dan misal ada 5 juga jadi 5 totalnya di rata rata kan jadi menghasilkan persentase dari penilaian penilaian user dengan role penilai, tapi rata rata itu mengisi dari total yg sudah mengisi saja, dia itu opsional"

> rev 2: "mungkin untuk admin tidak perlu menilai lagi deh, dan admin kita buat hanya meng approve kalo penilaian pitching desk itu sudah final dan di approvenya, maka baru boleh tahap selanjutnya"

**Inti**:
- N penilai eligible → N maksimal submission
- **Rata-rata dihitung dari yang SUDAH submit saja** (bukan dari total penilai terdaftar)
- Submission **opsional** per penilai
- Admin **TIDAK** menilai/override — hanya **approve** bahwa hasil sudah final
- Status final **otomatis** dari rata-rata (≥80% LOLOS)
- Setelah admin approve → proposal boleh lanjut ke tahap selanjutnya

---

## 2. Keputusan Desain (Dikonfirmasi User)

| # | Keputusan | Pilihan User |
|---|---|---|
| 1 | Definisi "penilai" eligible | **Semua role `penilai`** bisa nilai semua proposal (no assignment) |
| 2 | Minimum submission | **Minimum 1** penilai (1 submission cukup untuk hitung rata-rata) |
| 3 | Final decision authority | **Otomatis dari rata-rata** (AVG ≥ 80% → LOLOS) |
| 4 | Peran admin | **Hanya approve hasil final** — tidak menilai, tidak override |
| 5 | Form penilai | **Sama persis** dengan form admin saat ini (slider + radio + catatan) |
| 6 | Lock mahasiswa | **Lock setelah ≥1 penilai submit** |
| 7 | Notifikasi | **Hanya saat final** (setelah admin approve) |
| 8 | Phase gating | **Admin approval required** untuk unlock next stage |

---

## 3. Arsitektur

### 3.1 Alur End-to-End

```
┌─────────────────────────────────────────────────────────────┐
│ 1. MAHASISWA submit pitching                                │
│    → INSERT ke pmw_selection_pitching (status=pending)      │
└──────────────────────┬──────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────┐
│ 2. N PENILAI eligible (semua role 'penilai')                │
│    → Lihat list di /penilai/pitching-desk                   │
│    → Klik detail → form: slider 0-100 + radio + catatan     │
│    → Submit: UPSERT ke pmw_pitching_assessments             │
└──────────────────────┬──────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────┐
│ 3. AUTO-RECOMPUTE (triggered setiap penilai submit)        │
│    - AVG(persentase_nilai) WHERE submitted                   │
│    - pmw_selection_pitching.persentase_nilai = AVG          │
│    - pmw_selection_pitching.status =                        │
│        'approved' if avg >= 80 else 'rejected'              │
│    - pmw_selection_pitching.catatan =                       │
│        "Otomatis: rata-rata X.XX% dari N penilai"           │
│    (status ini PRELIMINARY — menunggu admin approve)        │
└──────────────────────┬──────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────┐
│ 4. LOCK MAHASISWA                                           │
│    IF COUNT(assessments) >= 1 → isLocked = true             │
│    Mahasiswa tidak bisa edit submission lagi                │
└──────────────────────┬──────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────┐
│ 5. ADMIN APPROVE                                            │
│    Admin lihat aggregation di /admin/pitching-desk/{id}:     │
│    - "N/M sudah menilai · rata-rata X.XX%"                  │
│    - List per penilai (nama, status, %, catatan)            │
│    - Tombol: [✔ Setujui Hasil & Finalisasi]                 │
│                                                             │
│    After click:                                              │
│    - pmw_selection_pitching.penilaian_final_at = NOW()      │
│    - pmw_selection_pitching.penilaian_final_by = admin_id   │
│    - Notifikasi dikirim ke mahasiswa                        │
└──────────────────────┬──────────────────────────────────────┘
                       ↓
┌─────────────────────────────────────────────────────────────┐
│ 6. PHASE GATE UNLOCK                                        │
│    Cek: status = 'approved' AND penilaian_final_at IS NOT NULL
│    → Mahasiswa bisa akses ProposalController, Perjanjian,   │
│      Training, Implementasi, dll (next stages)              │
└─────────────────────────────────────────────────────────────┘
```

### 3.2 Contoh Numerik

| Penilai | Status | Persentase | Catatan |
|---|---|---|---|
| Penilai A | approved | 85.00 | "Bagus, presentasi menarik" |
| Penilai B | approved | 90.00 | "Potensi pasar kuat" |
| Penilai C | rejected | 65.00 | "Cashflow kurang realistis" |
| Penilai D | — | — | (tidak submit) |
| Penilai E | — | — | (tidak submit) |

**AVG** = (85 + 90 + 65) / 3 = **80.00** → **LOLOS** (tepat di threshold)

**Setelah auto-recompute**:
- `status` = `approved` (preliminary)
- `persentase_nilai` = 80.00
- `catatan` = "Otomatis: rata-rata 80.00% dari 3 penilai"
- Mahasiswa **belum dapat notif** — menunggu admin approve

**Setelah admin approve**:
- `penilaian_final_at` = timestamp
- `penilaian_final_by` = admin_id
- Notifikasi ke mahasiswa: "Hasil Pitching: LOLOS (rata-rata 80% dari 3 penilai)"
- Phase gate → next stage terbuka

### 3.3 Perubahan dari Plan Sebelumnya

| Sebelum (Plan v1) | Sekarang (Plan v2) |
|---|---|
| Admin bisa override (radio + slider + catatan) | Admin **hanya approve**, tidak ada form penilaian |
| `admin_overridden_at/by` | **Ganti** → `penilaian_final_at/by` |
| Auto-compute skip jika override | Auto-compute **selalu jalan** (tidak ada skip logic) |
| Notif saat auto-status berubah | Notif **setelah admin approve** |
| Gate check `status = 'approved'` | Gate check `status = 'approved' AND penilaian_final_at IS NOT NULL` |
| Form admin detail: slider + radio + override | Admin detail: **aggregation panel only** + tombol approve |

---

## 4. Database Schema

### 4.1 NEW TABLE: `pmw_pitching_assessments`

```php
// Migration: 2026-06-04-NNN_CreatePmwPitchingAssessments.php
public function up()
{
    $this->forge->addField([
        'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'proposal_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        'penilai_user_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        'status'           => ['type' => 'ENUM', 'constraint' => ['approved', 'rejected']],
        'catatan'          => ['type' => 'TEXT', 'null' => true],
        'persentase_nilai' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
        'submitted_at'     => ['type' => 'DATETIME', 'null' => true],
        'created_at'       => ['type' => 'DATETIME', 'null' => true],
        'updated_at'       => ['type' => 'DATETIME', 'null' => true],
    ]);

    $this->forge->addPrimaryKey('id');
    $this->forge->addUniqueKey(['proposal_id', 'penilai_user_id']);
    $this->forge->addKey('proposal_id');
    $this->forge->addForeignKey('proposal_id', 'pmw_proposals', 'id', '', 'CASCADE');
    $this->forge->addForeignKey('penilai_user_id', 'users', 'id', '', 'CASCADE');
    $this->forge->createTable('pmw_pitching_assessments');
}
```

**Rationale**:
- `penilai_user_id` FK ke `users.id` — Shield auth pakai `users.id`. Validasi role `penilai` di kode.
- `status` ENUM `approved`/`rejected` saja — **tidak ada `revision`** untuk individual penilai.
- `catatan` TEXT NULL — boleh kosong
- `persentase_nilai` DECIMAL(5,2) — range 0.00-100.00
- UNIQUE(proposal_id, penilai_user_id) — **1 penilai = 1 row per proposal** (UPSERT)

### 4.2 ALTER: `pmw_selection_pitching` (tambah 2 kolom approval)

```php
// Migration: 2026-06-04-NNN_AddFinalizationToSelectionPitching.php
public function up()
{
    $this->forge->addColumn('pmw_selection_pitching', [
        'penilaian_final_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'persentase_nilai'],
        'penilaian_final_by' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'penilaian_final_at'],
    ]);
    $this->forge->addForeignKey('penilaian_final_by', 'users', 'id', '', 'SET NULL');
    $this->forge->addKey('penilaian_final_at');
}
```

**Kolom existing TETAP** — tidak ada perubahan:
- `status` — auto-computed (approved/rejected), jadi status preliminary
- `catatan` — auto-generated notes
- `persentase_nilai` — auto-computed AVG

**Backward compatibility**:
- Existing rows dengan `status`, `catatan`, `persentase_nilai` terisi → dianggap legacy
- Tidak ada migrasi data. Legacy rows: `penilaian_final_at` NULL, `status` existing tetap

---

## 5. Service Layer

### NEW: `PmwPitchingAssessmentService`

```php
<?php

namespace App\Services;

use App\Models\PmwPitchingAssessmentModel;
use App\Models\Selection\PmwSelectionPitchingModel;
use App\Models\Proposal\PmwProposalModel;
use App\Models\NotificationModel;

class PmwPitchingAssessmentService
{
    protected $assessmentModel;
    protected $selectionModel;
    protected $proposalModel;
    protected $notificationModel;

    public function __construct()
    {
        $this->assessmentModel   = new PmwPitchingAssessmentModel();
        $this->selectionModel    = new PmwSelectionPitchingModel();
        $this->proposalModel     = new PmwProposalModel();
        $this->notificationModel = new NotificationModel();
    }

    /**
     * Submit/update assessment from a penilai.
     * UPSERT by (proposal_id, penilai_user_id).
     * Always triggers auto-recompute.
     */
    public function submitAssessment(int $proposalId, int $penilaiUserId, array $data): array
    {
        $existing = $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('penilai_user_id', $penilaiUserId)
            ->first();

        $payload = [
            'proposal_id'       => $proposalId,
            'penilai_user_id'   => $penilaiUserId,
            'status'            => $data['status'],
            'catatan'           => $data['catatan'] ?? null,
            'persentase_nilai'  => (float) $data['persentase_nilai'],
            'submitted_at'      => date('Y-m-d H:i:s'),
        ];

        if ($existing) {
            $this->assessmentModel->update($existing['id'], $payload);
        } else {
            $this->assessmentModel->insert($payload);
        }

        $this->recomputeAverage($proposalId);

        return ['success' => true];
    }

    /**
     * Recompute AVG and update pmw_selection_pitching.
     * Always runs (no skip logic — admin does not block anymore).
     */
    public function recomputeAverage(int $proposalId): void
    {
        $selection = $this->selectionModel
            ->where('proposal_id', $proposalId)
            ->first();

        if (!$selection) return;

        // Calculate AVG from submitted assessments
        $avgRow = $this->assessmentModel
            ->selectAvg('persentase_nilai', 'avg_score')
            ->where('proposal_id', $proposalId)
            ->where('submitted_at IS NOT NULL')
            ->first();

        $avgScore = $avgRow['avg_score'] ?? null;
        if ($avgScore === null) return;

        $count = $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('submitted_at IS NOT NULL')
            ->countAllResults();

        $finalStatus = $avgScore >= 80 ? 'approved' : 'rejected';
        $finalCatatan = sprintf(
            'Otomatis: rata-rata %.2f%% dari %d penilai',
            $avgScore,
            $count
        );

        $this->selectionModel->update($selection['id'], [
            'persentase_nilai' => $avgScore,
            'status'           => $finalStatus,
            'catatan'          => $finalCatatan,
        ]);

        // NOTIFY ONLY AFTER ADMIN APPROVAL — handled in finalizeAssessment()
    }

    /**
     * Admin finalizes/approves the assessment result.
     * This is the ONLY admin action — no override/input.
     * Triggers notification to student.
     */
    public function finalizeAssessment(int $proposalId, int $adminUserId): void
    {
        $selection = $this->selectionModel
            ->where('proposal_id', $proposalId)
            ->first();

        if (!$selection) return;
        if ($selection['penilaian_final_at'] !== null) return; // Already finalized

        $this->selectionModel->update($selection['id'], [
            'penilaian_final_at' => date('Y-m-d H:i:s'),
            'penilaian_final_by' => $adminUserId,
        ]);

        // Send notification to student leader
        $this->notifyFinal($proposalId, $selection['status'], $selection['catatan']);
    }

    /**
     * Get all assessments for a proposal with penilai info.
     */
    public function getAssessmentsForProposal(int $proposalId): array
    {
        return $this->assessmentModel
            ->select('
                pmw_pitching_assessments.*,
                users.username as penilai_username,
                pmw_penilai.nama as penilai_nama,
                pmw_penilai.expertise as penilai_expertise
            ')
            ->join('users', 'users.id = pmw_pitching_assessments.penilai_user_id', 'left')
            ->join('pmw_penilai', 'pmw_penilai.user_id = users.id', 'left')
            ->where('proposal_id', $proposalId)
            ->orderBy('submitted_at', 'DESC')
            ->findAll();
    }

    /**
     * Get aggregation stats for a proposal.
     */
    public function getAggregation(int $proposalId): array
    {
        $assessments = $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('submitted_at IS NOT NULL')
            ->findAll();

        $count = count($assessments);
        $sum   = array_sum(array_column($assessments, 'persentase_nilai'));
        $avg   = $count > 0 ? $sum / $count : null;

        $approved = count(array_filter($assessments, fn($a) => $a['status'] === 'approved'));
        $rejected = count(array_filter($assessments, fn($a) => $a['status'] === 'rejected'));

        return compact('count', 'avg', 'approved', 'rejected');
    }

    /**
     * Check if a penilai already submitted for a proposal.
     */
    public function hasSubmitted(int $proposalId, int $penilaiUserId): bool
    {
        return $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('penilai_user_id', $penilaiUserId)
            ->where('submitted_at IS NOT NULL')
            ->countAllResults() > 0;
    }

    /**
     * Count total submitted assessments for a proposal.
     */
    public function countAssessments(int $proposalId): int
    {
        return $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('submitted_at IS NOT NULL')
            ->countAllResults();
    }

    /**
     * Get the assessment submitted by a specific penilai for a proposal.
     */
    public function getMyAssessment(int $proposalId, int $penilaiUserId): ?array
    {
        return $this->assessmentModel
            ->where('proposal_id', $proposalId)
            ->where('penilai_user_id', $penilaiUserId)
            ->first();
    }

    /**
     * Send final notification to student leader.
     */
    protected function notifyFinal(int $proposalId, string $status, string $catatan): void
    {
        $proposal = $this->proposalModel->find($proposalId);
        if ($proposal && !empty($proposal['ketua_user_id'])) {
            $this->notificationModel->createPitchingFinalizedNotification(
                $proposal['ketua_user_id'],
                $proposalId,
                $status,
                $catatan
            );
        }
    }
}
```

---

## 6. Models

### NEW: `PmwPitchingAssessmentModel`

```php
<?php

namespace App\Models;

use CodeIgniter\Model;

class PmwPitchingAssessmentModel extends Model
{
    protected $table         = 'pmw_pitching_assessments';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'proposal_id', 'penilai_user_id', 'status',
        'catatan', 'persentase_nilai', 'submitted_at',
    ];

    protected $validationRules = [
        'proposal_id'      => 'required|is_natural_no_zero',
        'penilai_user_id'  => 'required|is_natural_no_zero',
        'status'           => 'required|in_list[approved,rejected]',
        'persentase_nilai' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
        'catatan'          => 'permit_empty|max_length[1000]',
    ];
}
```

### UPDATE: `PmwSelectionPitchingModel`

Tambah method:
- `getWithAggregation(int $proposalId): ?array` — join + count assessors
- `getByProposalId(int $proposalId): ?array` — helper finder

### UPDATE: `PmwProposalModel`

**`getProposalsForAdminPitching()`**:
- Tambah LEFT JOIN: `COUNT(pa.id) as assessment_count, AVG(pa.persentase_nilai) as assessment_avg`
- Tambah: `sp.penilaian_final_at, sp.penilaian_final_by`
- Untuk admin list view (show aggregation per row)

Tambah method **`getProposalsForPenilai()`**:
- Filter: hanya proposal yang sudah submit (`student_submitted_at IS NOT NULL`)
- Tambah kolom: `CASE WHEN pa2.id IS NOT NULL THEN 1 ELSE 0 END as has_submitted`
- Tambah kolom: `pa2.persentase_nilai as my_score`
- LEFT JOIN `pmw_pitching_assessments pa2 ON pa2.proposal_id = sp.proposal_id AND pa2.penilai_user_id = :currentUser:`

### UPDATE: `NotificationModel`

Tambah method:
- `createPitchingFinalizedNotification(int $userId, int $proposalId, string $status, string $catatan): int`

---

## 7. Controllers

### 7.1 UPDATE: `Penilai\PitchingDeskController`

**index()** — list view:
- Query via `PmwProposalModel::getProposalsForPenilai(currentUser)`
- Tampilkan: nama tim, kategori, status, nilai Anda, aksi
- Kolom baru: "Nilai Anda" — badge (sudah/belum)
- Stats: Total proposal, "Anda sudah menilai N"

**detail($id)** — forms:
- Sama dengan form admin saat ini (slider + radio + catatan) — **TIDAK berubah**
- Banner di atas form:
  - Jika sudah submit: "✔ Anda sudah menilai: 85% (LOLOS). [Edit Nilai]"
  - Jika belum: "Anda belum menilai proposal ini"
- Informasi: "Setelah submit, mahasiswa akan di-lock dan nilai masuk rata-rata"

**validateAction($id)** — submit nilai:
```php
public function validateAction($id)
{
    $rules = [
        'status'           => 'required|in_list[approved,rejected]',
        'catatan'          => 'required|min_length[5]|max_length[1000]',
        'persentase_nilai' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
    ];
    if (!$this->validateData($this->request->getPost(), $rules)) {
        return redirect()->back()->withInput()->with('error', 'Validasi gagal');
    }

    $service = new PmwPitchingAssessmentService();
    $service->submitAssessment(
        (int) $id,
        user()->id,
        [
            'status'           => $this->request->getPost('status'),
            'catatan'          => $this->request->getPost('catatan'),
            'persentase_nilai' => $this->request->getPost('persentase_nilai'),
        ]
    );

    return redirect()->to('penilai/pitching-desk')
        ->with('success', 'Nilai berhasil disimpan');
}
```

### 7.2 UPDATE: `Admin\PitchingDeskController`

**index()** — list view:
- Query dengan aggregation (dari PmwProposalModel)
- Tampilkan kolom: Tim, Ketua, Kategori, Video, **Penilaian (N/M · %)**, **Status Final**, **Aksi**
- Kolom "Penilaian": format "3/5 · 82%" dengan warna (emerald ≥80, rose <80, slate 0)
- Kolom "Status Final": badge "Sudah Difinalisasi" / "Menunggu Finalisasi"
- Aksi: "Detail" (link ke detail, tanpa form penilaian)

**detail($id)** — view ONLY (tidak ada form penilaian):
- Sama info card seperti sekarang (tim, video, dokumen)
- **Panel "Penilaian Juri"** (aggregation):
  - Header: "3/5 sudah menilai · rata-rata 82%"
  - List per penilai: card (avatar + nama + expertise + status badge + % + catatan)
  - Jika 0 penilai: "Belum ada penilai yang menilai"
- **Panel Admin Finalisasi**:
  - Jika sudah final: banner "✔ Sudah difinalisasi oleh [admin] pada [tanggal]"
  - Jika belum final: tombol "[✔ Setujui Hasil & Finalisasi]"
    - Konfirmasi sebelum submit (modal/alert)
    - CATATAN: admin TIDAK bisa input nilai apa pun — hanya klik approve
  - Informasi: "Setelah difinalisasi, mahasiswa akan mendapat notifikasi dan tahap selanjutnya terbuka"
- **TIDAK ADA** slider / radio / catatan untuk admin

**finalizeAction($id)** — POST handler:
```php
public function finalizeAction($id)
{
    $service = new PmwPitchingAssessmentService();
    $service->finalizeAssessment((int) $id, user()->id);

    return redirect()->to('admin/pitching-desk')
        ->with('success', 'Hasil penilaian pitching berhasil difinalisasi');
}
```

### 7.3 UPDATE: `Mahasiswa\PitchingDeskController`

**submit()** — lock check:
- Existing isLocked check + `$service->countAssessments($proposalId) >= 1` → locked
- Error: "Tidak bisa edit — sudah ada penilai yang menilai"

**index()** — view data:
- Tambah section info penilaian:
  - "3/5 penilai sudah menilai · rata-rata 82%"
  - Jika sudah final: "📢 Hasil Final: LOLOS (telah difinalisasi)"
  - Jika sudah final & status rejected: "📢 Hasil Final: BELUM LOLOS"
  - Notifikasi tetap 1× saat final

### 7.4 UPDATE: Phase Gate Controllers (8 lokasi)

Semua controller yang saat ini cek `pitching_admin_status === 'approved'` untuk gate perlu update jadi:
```
status === 'approved' AND penilaian_final_at IS NOT NULL
```

| File | Line(s) | Gate Check Saat Ini |
|---|---|---|
| `Mahasiswa/ProposalController.php` | 52-53 | `pitching_admin_status === 'approved'` |
| `Mahasiswa/ProposalController.php` | 136-137 | `pitching_admin_status !== 'approved'` |
| `Mahasiswa/PerjanjianController.php` | 68 | `pitching_admin_status !== 'approved'` |
| `Admin/PerjanjianController.php` | 97 | `pitching_admin_status !== 'approved'` |
| `Admin/PerjanjianController.php` | 133 | `pitching_admin_status !== 'approved'` |
| `Admin/FinalizationController.php` | 127 | `status !== 'approved'` |
| `Admin/ValidationController.php` | 30 | `pitching_admin_status === 'approved'` |
| `Admin/ValidationController.php` | 34 | `pitching_admin_status === 'approved'` |

**Pola update**:
```php
// Sebelum:
$isEligible = $proposal && ($proposal['pitching_admin_status'] ?? '') === 'approved';

// Sesudah:
$isEligible = $proposal 
    && ($proposal['pitching_admin_status'] ?? '') === 'approved'
    && !empty($proposal['penilaian_final_at']);
```

### 7.5 UPDATE: `Dashboard`

**getPenilaiData()**:
- Total penilaian per penilai: `COUNT FROM pmw_pitching_assessments WHERE penilai_user_id = X`
- Dashboard subtitle: "5 tim terakhir yang dinilai" — tetap
- Stats: total penilai, total submission, total finalisasi

---

## 8. Views

### 8.1 UPDATE: `penilai/pitching/validation_detail.php`

**Perubahan**:
- Header: "Penilaian Pitching" (bukan "Validasi Final Admin")
- Banner di atas form:
  - Jika sudah submit: "✔ Anda sudah menilai: 85% (LOLOS). [Edit Nilai]"
  - Jika belum: "Anda belum menilai proposal ini"
- Form: slider + radio (Lolos/Belum Lolos) + catatan — **SAMA PERSIS** dengan sekarang
- Footer info: "Setelah submit, mahasiswa akan di-lock dan nilai masuk rata-rata. Admin akan finalisasi hasil."

### 8.2 REWRITE: `admin/pitching/validation_detail.php`

**Perubahan besar** — HAPUS form penilaian. Ganti jadi:

```
┌─ Detail Validasi Pitching (read-only) ─────────────────────┐
│                                                             │
│  [Info Card: tim, video, dokumen — SAMA dengan sekarang]    │
│                                                             │
│  ┌─ Penilaian Juri ──────────────────────────────────────┐ │
│  │ 3/5 sudah menilai · rata-rata 82.00%                   │ │
│  │                                                         │ │
│  │ [Penilai A] 85% ✔ Lolos    "Bagus, presentasi..."      │ │
│  │ [Penilai B] 90% ✔ Lolos    "Potensi pasar..."          │ │
│  │ [Penilai C] 65% ✘ Tdk Lolos "Cashflow kurang..."       │ │
│  └────────────────────────────────────────────────────────┘ │
│                                                             │
│  ┌─ Finalisasi Admin ────────────────────────────────────┐ │
│  │ Hasil auto: LOLOS (rata-rata 82.00% ≥ 80%)             │ │
│  │                                                         │ │
│  │ [✔ Setujui Hasil & Finalisasi] ← hanya jika belum      │ │
│  │                                                         │ │
│  │ atau:                                                    │ │
│  │ ✔ Sudah difinalisasi oleh Admin X pada 04/06/2026       │ │
│  └────────────────────────────────────────────────────────┘ │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

**Detail implementasi**:
- Hapus semua form elements (slider, radio, textarea, submit buttons)
- Ganti dengan aggregation panel + finalisasi panel
- Tombol "[Setujui Hasil & Finalisasi]" → POST ke `finalizeAction`
- Konfirmasi modal sebelum finalisasi

### 8.3 UPDATE: `admin/pitching/validation.php` (list view)

Tambah kolom **"Penilaian"** dan **"Finalisasi"**:

| Tim | Ketua | Kategori | Video | **Penilaian** | **Finalisasi** | Aksi |
|---|---|---|---|---|---|---|
| Usaha A | Andi | Pemula | ✔ | **3/5 · 82%** | ✅ Sudah | Detail |
| Usaha B | Budi | Berkembang | ✔ | **1/5 · 65%** | ⏳ Menunggu | Detail |
| Usaha C | Cici | Pemula | ✔ | **—** | ⏳ Menunggu | Detail |

Warna "Penilaian":
- emerald: avg ≥ 80
- rose: avg < 80
- slate: 0 submit

### 8.4 UPDATE: `penilai/pitching/validation.php` (list view)

Tambah kolom **"Nilai Anda"**:
- "✔ 85%" (emerald) jika sudah submit
- "— Belum" (slate) jika belum

### 8.5 UPDATE: `mahasiswa/pitching_desk.php`

Tambah info di sticky header atau section baru:
```
📊 Penilaian: 3/5 penilai sudah menilai · rata-rata 82.0%
📢 Hasil Final: LOLOS — Tahap selanjutnya terbuka!
```
(Tampil hanya setelah ada penilai submit. Sembunyikan jika masih pending.)

### 8.6 UPDATE: `penilai/dashboard.php`

- "Anda sudah menilai N proposal"
- Recent: nama proposal + nilai Anda
- CTA: "Lanjut menilai →"

---

## 9. Routes

### UPDATE: `app/Config/Routes.php`

```php
// Penilai — TETAP (sama seperti sekarang)
$routes->group('penilai', ['filter' => 'group:penilai'], function($routes) {
    $routes->get('/', 'Penilai\PitchingDeskController::index');
    $routes->get('pitching-desk', 'Penilai\PitchingDeskController::index');
    $routes->get('pitching-desk/(:num)', 'Penilai\PitchingDeskController::detail/$1');
    $routes->post('pitching-desk/(:num)/validate', 'Penilai\PitchingDeskController::validateAction/$1');
    $routes->get('pitching-desk/doc/(:num)', 'Penilai\PitchingDeskController::viewDoc/$1');
});

// Admin — TAMBAH 1 route (finalize), HAPUS override/reset
$routes->group('admin', ['filter' => 'group:admin'], function($routes) {
    // ... existing routes (tidak berubah) ...
    
    // HAPUS:
    // - pitching-desk/(:num)/override
    // - pitching-desk/(:num)/reset-override
    
    // TAMBAH:
    $routes->post('pitching-desk/(:num)/finalize', 'Admin\PitchingDeskController::finalizeAction/$1');
});
```

**Total perubahan route**: -1 route (admin override/reset dihapus) + 1 route (finalize) = **+0 perubahan net**

---

## 10. Business Rules & Edge Cases

| # | Skenario | Handling |
|---|---|---|
| 1 | 0 penilai submit | `status` tetap `pending`, `persentase_nilai` NULL, notif belum, lock belum |
| 2 | 1 penilai submit | AVG = nilai dia, status auto-set, lock aktif, tunggu admin approve |
| 3 | 5 penilai eligible, 3 submit | AVG dari 3, lock aktif |
| 4 | Penilai edit nilai sendiri | UPSERT row existing, recompute ulang |
| 5 | Admin approve (finalisasi) | `penilaian_final_at` set, notif dikirim, gate unlock |
| 6 | Admin approve di status rejected | Tetap approve (validasi final). Status = rejected, mahasiswa notif 'BELUM LOLOS', tidak unlock next stage |
| 7 | AVG = 80.00 (tepat) | `>= 80` PASS → LOLOS |
| 8 | AVG = 79.99 | FAIL → BELUM LOLOS |
| 9 | Penilai delete account | Existing assessment tetap (FK CASCADE). AVG exclude deleted |
| 10 | Race condition 2 submit | UNIQUE constraint. Recompute idempotent |
| 11 | Admin sudah approve, ada penilai baru submit | Approve sudah final. Status tetap. Assessment masuk tapi tidak affect final (`penilaian_final_at` not NULL). |
| 12 | Existing data legacy | `penilaian_final_at` NULL, dianggap "belum difinalisasi". Admin perlu finalize manual 1×. |
| 13 | Admin approve 2× (double click) | Guard: `if penilaian_final_at !== null return` di service |
| 14 | Mahasiswa coba edit setelah lock | "Tidak bisa edit — sudah ada penilai yang menilai" |
| 15 | Gate check tanpa `penilaian_final_at` | ProposalController, PerjanjianController, dll: tolak akses |
| 16 | Tidak ada penilai sama sekali | Submit admin final tetap bisa? Untuk v1: **tidak** — butuh min 1 penilai |

---

## 11. Out of Scope (v1)

- ❌ Soft delete penilai (hard delete cascade untuk v1)
- ❌ History/audit per perubahan nilai
- ❌ Assignment penilai per-proposal/kategori (semua eligible)
- ❌ Multi-kriteria penilaian (Inovasi, Pasar, Keuangan, Tim)
- ❌ Configurable threshold (masih hardcoded 80%)
- ❌ Notifikasi ke penilai "Anda belum menilai proposal X"
- ❌ Dashboard khusus rekap multi-penilai
- ❌ Weighted average (semua bobot sama)
- ❌ Time-based deadline untuk penilaian
- ❌ Visibility setting antar penilai
- ❌ Inter-penilai discussion thread
- ❌ Admin approve bulk (per proposal dulu)
- ❌ Report/export Excel hasil multi-penilai
- ❌ Migration data legacy (existing `pmw_selection_pitching` tetap apa adanya)

---

## 12. File yang Terdampak (Total: 4 NEW + 12 MODIFY + 8 GATE = 24 file)

### 🆕 NEW (4 file)
1. `app/Database/Migrations/2026-06-04-NNN_CreatePmwPitchingAssessments.php`
2. `app/Database/Migrations/2026-06-04-NNN_AddFinalizationToSelectionPitching.php`
3. `app/Models/PmwPitchingAssessmentModel.php`
4. `app/Services/PmwPitchingAssessmentService.php`

### ✏️ MODIFY (12 file — 4 controller + 4 model + 4 view)
5. `app/Config/Routes.php` — tambah 1 route (`finalize`)
6. `app/Models/Selection/PmwSelectionPitchingModel.php` — helper methods
7. `app/Models/Proposal/PmwProposalModel.php` — tambah aggregate query
8. `app/Models/NotificationModel.php` — method `createPitchingFinalizedNotification`
9. `app/Controllers/Penilai/PitchingDeskController.php` — rewrite validateAction
10. `app/Controllers/Admin/PitchingDeskController.php` — hapus override, add finalize
11. `app/Controllers/Mahasiswa/PitchingDeskController.php` — lock + info agregat
12. `app/Controllers/Dashboard.php` — update penilai data
13. `app/Views/admin/pitching/validation.php` — kolom Penilaian + Finalisasi
14. `app/Views/admin/pitching/validation_detail.php` — REWRITE (aggregation + approve)
15. `app/Views/penilai/pitching/validation.php` — kolom Nilai Anda
16. `app/Views/penilai/pitching/validation_detail.php` — banner Anda sudah menilai
17. `app/Views/mahasiswa/pitching_desk.php` — info agregat + lock
18. `app/Views/penilai/dashboard.php` — metrics

### ⛩️ GATE UPDATE (8 lokasi — cek `pitching_admin_status === 'approved'`)
19. `app/Controllers/Mahasiswa/ProposalController.php:52-53`
20. `app/Controllers/Mahasiswa/ProposalController.php:136-137`
21. `app/Controllers/Mahasiswa/PerjanjianController.php:68`
22. `app/Controllers/Admin/PerjanjianController.php:97`
23. `app/Controllers/Admin/PerjanjianController.php:133`
24. `app/Controllers/Admin/FinalizationController.php:127`
25. `app/Controllers/Admin/ValidationController.php:30`
26. `app/Controllers/Admin/ValidationController.php:34`

**Total**: 4 NEW + 12 MODIFY + 8 GATE = **26 file**

---

## 13. Implementation Phases

### Phase 1: Schema & Foundation
- 2 migrations (assessments table + finalization fields)
- `PmwPitchingAssessmentModel` (NEW)
- `PmwPitchingAssessmentService` (NEW, skeleton)
- Test: `php spark migrate`, insert assessment row manually

### Phase 2: Penilai Submission Flow
- `Penilai\PitchingDeskController::validateAction` — call service submitAssessment
- `PmwProposalModel::getProposalsForPenilai()` — new method
- `penilai/pitching/validation_detail.php` — banner + form
- `penilai/pitching/validation.php` — kolom "Nilai Anda"
- Test: submit sebagai penilai, row masuk ke `pmw_pitching_assessments`

### Phase 3: Auto-Recompute
- `PmwPitchingAssessmentService::recomputeAverage()` — full implementation
- `PmwProposalModel::getProposalsForAdminPitching()` — add aggregate query
- Test: submit penilai → auto-recompute → `pmw_selection_pitching` terupdate

### Phase 4: Admin Approval & Aggregation
- `Admin\PitchingDeskController` — detail view (read-only aggregation) + finalizeAction
- `admin/pitching/validation_detail.php` — REWRITE (aggregation panel + finalisasi button)
- `admin/pitching/validation.php` — kolom baru
- `Routes.php` — tambah route finalize
- Test: admin lihat aggregation, click approve, `penilaian_final_at` ter-set

### Phase 5: Lock, Notif & Gate Update
- `Mahasiswa\PitchingDeskController` — lock logic
- `mahasiswa/pitching_desk.php` — info agregat
- `PmwPitchingAssessmentService::finalizeAssessment()` — trigger notif
- `NotificationModel::createPitchingFinalizedNotification()` — new method
- **8 gate locations** — tambah `penilaian_final_at IS NOT NULL`
- Test: mahasiswa lock, notif terkirim, next stage unlock

### Phase 6: Polish & Dashboard
- `Dashboard::getPenilaiData()` — update
- `penilai/dashboard.php` — update metrics
- Edge case handling
- Final QA & manual test

---

## 14. Acceptance Criteria

1. ✅ Migration `pmw_pitching_assessments` + finalization fields sukses
2. ✅ Penilai bisa submit nilai (slider + radio + catatan), row masuk assessments
3. ✅ Auto-recompute: AVG tepat, status auto-update
4. ✅ Admin lihat aggregation (per-penilai + rata-rata) di detail view
5. ✅ Admin approve: `penilaian_final_at` ter-set, notif terkirim
6. ✅ Mahasiswa lock setelah ≥1 penilai submit
7. ✅ 8 gate locations update: next stage hanya jika `status='approved' AND penilaian_final_at IS NOT NULL`
8. ✅ Admin TIDAK punya form penilaian (tidak ada slider/radio/catatan)
9. ✅ PHP syntax check (`php -l`) pass semua file
10. ✅ `php spark migrate` sukses
11. ✅ Manual test 3 skenario: lolos-stream (avg ≥ 80), gagal-stream (avg < 80), empty-stream (0 submit)
12. ✅ Notifikasi final hanya 1×, berisi status + catatan

---

## 15. Risiko & Mitigasi

| Risiko | Dampak | Mitigasi |
|---|---|---|
| Migration fail di production | Data loss | Test di staging, backup DB |
| Threshold 80% berubah | Inkonsistensi | Hardcode v1, configurable v2 |
| AVG rounding issue (DECIMAL) | Status salah di boundary | Test 79.99, 80.00, 80.01 |
| Admin approve double-click | Duplicate notif | Guard di service `penilaian_final_at NOT NULL` |
| Gate belum update semua | Mahasiswa tembus akses | Checklist 8 lokasi, test tiap stage |
| Penilai tidak ada sama sekali | Stuck forever | Minimum 1 penilai required |
| Legacy data tanpa finalisasi | Tidak bisa next stage | Admin approve manual 1× per legacy |
| Race condition recompute | Data inconsistent | Query idempotent, UNIQUE constraint |

---

## 16. Open Questions (TBD saat eksekusi)

1. **Legacy data**: Admin perlu finalize semua existing proposal yang sudah approved? Atau kita set `penilaian_final_at = NOW()` untuk legacy via migration?
2. **Dashboard ordering**: Sort by avg desc? Tanggal? Status finalisasi?
3. **Bulk finalize**: Admin bisa finalize semua proposal sekaligus? Tidak untuk v1.
4. **Threshold visibility**: "Auto-set LOLOS karena avg 82% ≥ 80%" — ditampilkan di mana? List view badge + detail panel.
5. **Penilai count di list**: "3/5" — 5 dari mana? Apakah dari total user role `penilai` di sistem? Atau dari yang aktif? V1: total user role penilai.

---

## 17. Referensi

- `app/Config/AuthGroups.php` — role `penilai`, permission `data.pitching_verify`
- `app/Controllers/Admin/PitchingDeskController.php` — current single-admin (akan di-rewrite)
- `app/Controllers/Penilai/PitchingDeskController.php` — current single-penilai (akan jadi multi)
- `app/Database/Migrations/2026-04-17-110000_NormalizeProposalTables.php` — schema `pmw_selection_pitching`
- `app/Services/PmwPhaseAccessService.php` — phase gating pattern
- `app/Models/NotificationModel.php:166-206` — existing notif pattern
- Gate locations: `ProposalController`, `PerjanjianController`, `FinalizationController`, `ValidationController`, `TrainingController`

**Status**: PLAN READY (Update 2)
**Next step**: Eksekusi Phase 1 → Phase 6, masing-masing dengan `php -l` + test endpoint manual.
