# Plan: Admin Menilai Pitching Desk (Override 100% + Edit Penilai)

## Ringkasan Perubahan

Admin mendapat kemampuan **menilai langsung** (slider 0-100 + radio LOLOS/BELUM LOLOS + catatan), bukan cuma finalisasi. Nilai admin = **100%** langsung jadi final `persentase_nilai`, auto-finalize, dan mengunci penilai. Admin juga bisa **mengedit** nilai penilai yang sudah masuk.

---

## 1. Data Model

### Tabel `pmw_pitching_assessments` — tambah 2 kolom

| Kolom | Tipe | Default | Fungsi |
|-------|------|---------|--------|
| `is_admin_assessment` | TINYINT(1) | 0 | 1 = penilaian oleh admin, 0 = penilai |
| `edited_by_admin` | TINYINT(1) | 0 | 1 = row penilai pernah diedit oleh admin |

### Migration baru: `2026-06-04-100002_AddAdminAssessmentToPitchingAssessments.php`

```sql
ALTER TABLE `pmw_pitching_assessments`
  ADD `is_admin_assessment` TINYINT(1) NOT NULL DEFAULT 0 AFTER `penilai_user_id`,
  ADD `edited_by_admin` TINYINT(1) NOT NULL DEFAULT 0 AFTER `catatan`;
```

---

## 2. Logika Baru di Service (`PmwPitchingAssessmentService`)

### `submitAssessment()` — Penilai
- **Tidak berubah** dari skema saat ini. Insert/update assessment → recomputeAverage.

### `submitAdminAssessment()` — Method baru untuk admin
1. Insert/update row di `pmw_pitching_assessments` dengan:
   - `penilai_user_id` = admin_id
   - `is_admin_assessment` = 1
   - `status`, `catatan`, `persentase_nilai` dari form
2. Langsung update `pmw_selection_pitching`:
   - `persentase_nilai` = admin's score
   - `status` = `approved` (≥80) / `rejected` (<80)
   - `catatan` = catatan admin
   - `penilaian_final_at` = now()
   - `penilaian_final_by` = admin_id
3. Notifikasi mahasiswa (panggil `notifyFinal()`)
4. Return success

### `editPenilaiAssessment()` — Method baru untuk admin edit penilai
1. Update row penilai di `pmw_pitching_assessments`:
   - `persentase_nilai`, `status`, `catatan` dari form
   - `edited_by_admin` = 1
2. Panggil `recomputeAverage()` — hitung ulang rata-rata (kecuali admin sudah punya assessment sendiri)

### `computeFinalScore()` — Helper logic baru
Menentukan nilai final mana yang dipakai:

```
IF admin_has_assessment(proposal_id) THEN
    final_score = admin_assessment.persentase_nilai  // 100% — abaikan penilai
    final_status = admin_assessment.status
    final_catatan = admin_assessment.catatan
ELSE
    final_score = avg of penilai_assessments (where is_admin_assessment=0)
    final_status = berdasarkan threshold 80%
    final_catatan = auto-generated atau rata-rata
END IF
```

### `canPenilaiAssess()` — Method baru
```
IF admin_has_assessment(proposal_id) THEN
    return false  // penilai gak bisa akses
ELSE
    return true
END IF
```

---

## 3. Controller Changes

### `Admin/PitchingDeskController` — Ubah signifikan

**Detail view (`detail($id)`)** — 3 section baru:
1. **Aggregation panel** (existing) — tambah indikator "Ada penilaian admin" jika admin sudah nilai
2. **Daftar penilai** — tiap card penilai tambah tombol **"✏️ Edit"** yang buka modal edit (kecuali admin sudah punya assessment sendiri)
3. **Form "Penilaian Admin"** — baru, muncul hanya jika admin BELUM menilai:
   - Slider 0-100
   - Radio LOLOS / BELUM LOLOS
   - Textarea catatan (wajib)
   - Tombol **"Submit Penilaian Admin (100%)"**
   - Kalau admin sudah nilai → tampilkan card "Penilaian Admin Anda" dengan nilai + tombol edit

**Hilangkan** tombol "Setujui Hasil & Finalisasi" yang sekarang — karena admin nilai sudah auto-finalize.

**Tambah method baru:**
- `submitAdminAssessment($id)` — POST handler untuk form admin
- `editPenilaiAssessment($id)` — POST handler untuk edit penilai

### `Penilai/PitchingDeskController`

**`detail($id)` dan `validateAction($id)`** — cek `canPenilaiAssess()`:
- Jika admin sudah menilai → redirect dengan flash message "Admin sudah menilai proposal ini. Anda tidak bisa lagi memberikan penilaian."
- Tampilkan banner "Terkunci — Admin sudah menilai" di halaman detail penilai (read-only).

---

## 4. View Changes

### `admin/pitching/validation_detail.php`
- **Before aggregation**: Banner status "Admin sudah menilai / Belum menilai"
- **Aggregation panel**: update logic — jika admin sudah nilai, tampilkan "Final: {admin_score}% (Admin)"
- **Edit penilai**: tiap card penilai ada ikon pensil → modal edit (slider + radio + catatan + save)
- **Form penilaian admin**: slider + radio + catatan + submit button (hidden jika admin sudah nilai)
- **Jika admin sudah nilai**: tampilkan card assessment admin dengan nilai + tombol edit

### `penilai/pitching/validation_detail.php`
- Jika admin sudah nilai: banner merah "Ditutup — Admin sudah finalisasi" + form dinonaktifkan

### `mahasiswa/pitching_desk.php`
- Sudah nampilin semua assessment (penilai + admin). Cukup tambah label "(Admin)" di assessment milik admin.

---

## 5. Data Display Rules

| Skenario | Tampilkan di Mahasiswa | Tampilkan di Admin Detail |
|----------|----------------------|--------------------------|
| Penilai nilai, admin belum | Card penilai + aggregation + "Menunggu Finalisasi" | Card penilai + aggregation + form admin |
| Admin sudah nilai | Card penilai + Card **Admin (100%)** + banner LOLOS/BELUM LOLOS + tanggal final | Card penilai + Card Admin + "Sudah Difinalisasi" |
| Admin edit penilai | Card penilai (tanpa label diedit) + aggregation | Card penilai + "Diedit Admin" badge + form admin + aggregation |

---

## 6. Gate Logic

Semua gate (`Admin/PerjanjianController`, `Admin/FinalizationController`, `Admin/ValidationController`, `Mahasiswa/ProposalController`, `Mahasiswa/PerjanjianController`) — **tidak perlu diubah**. Mereka sudah benar:
- Cek `sp.status = 'approved'` AND `sp.penilaian_final_at IS NOT NULL`
- Dengan system baru, admin submitting assessment = auto-finalize → `penilaian_final_at` terisi

---

## 7. Files yang Akan Diubah

- `app/Database/Migrations/2026-06-04-100002_AddAdminAssessmentToPitchingAssessments.php` — **BARU**
- `app/Services/PmwPitchingAssessmentService.php` — tambah `submitAdminAssessment()`, `editPenilaiAssessment()`, `computeFinalScore()`, `canPenilaiAssess()`
- `app/Controllers/Admin/PitchingDeskController.php` — rewrite detail view, tambah `submitAdminAssessment()`, `editPenilaiAssessment()`
- `app/Controllers/Penilai/PitchingDeskController.php` — tambah gate `canPenilaiAssess()`
- `app/Views/admin/pitching/validation_detail.php` — form admin + edit penilai modal
- `app/Views/admin/pitching/validation.php` — opsional: tambah "Admin" di tabel
- `app/Views/penilai/pitching/validation_detail.php` — read-only banner jika admin sudah nilai
- `app/Views/mahasiswa/pitching_desk.php` — label "(Admin)" di assessment admin

---

## 8. Urutan Implementasi

1. Migration baru (kolom `is_admin_assessment`, `edited_by_admin`)
2. Service — semua method baru
3. Admin controller — rewrite + method baru
4. Admin views — form + modal edit
5. Penilai controller — gate
6. Penilai view — read-only banner
7. Mahasiswa view — label admin
8. Uji sintaks + QA
