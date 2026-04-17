# Implementasi Bank Account Input untuk Phase 5

## Ringkasan
Menambahkan fitur input data rekening bank untuk ketua tim yang lolos Tahap I (wawancara approved). Fitur ini terintegrasi dengan halaman pengumuman Phase 5.

## Files Created/Modified

### 1. Database Migration
- `app/Database/Migrations/2026-04-17-001100_AlterBankAccountsToUseProposalId.php`
  - Tabel: `pmw_bank_accounts`
  - Fields: proposal_id, period_id, bank_name, account_holder_name, account_number, branch_office, bank_book_scan, description
  - Foreign key ke `pmw_proposals` dan `pmw_periods`

### 2. Entity
- `app/Entities/PmwBankAccount.php`
  - Properties untuk semua fields di tabel
  - Casting untuk integer fields

### 3. Model
- `app/Models/PmwBankAccountModel.php`
  - `findByProposal(int $proposalId)` - Cari data rekening berdasarkan proposal
  - `findByPeriod(int $periodId)` - Cari semua data rekening per periode

### 4. Service
- `app/Services/PmwBankAccountService.php`
  - `getOrCreate(int $proposalId, int $periodId)` - Ambil atau buat record baru
  - `save(int $proposalId, int $periodId, array $data)` - Simpan data rekening
  - `uploadBankBook(int $proposalId, $file)` - Upload scan buku rekening (PDF, max 5MB)
  - `hasCompleteData(int $proposalId)` - Cek apakah data sudah lengkap

### 5. Controller Updates
- `app/Controllers/Mahasiswa/AnnouncementController.php`
  - Updated `index()` - Menambahkan data bank account dan proposal ke view
  - Added `bankAccount()` - Menampilkan form input rekening
  - Added `saveBankAccount()` - Menyimpan data rekening dan upload file

### 6. Views
- `app/Views/mahasiswa/pengumuman/bank_account.php` - Form input data rekening
- Updated `app/Views/mahasiswa/pengumuman/index.php` - Menambahkan card status rekening dengan link ke form

### 7. Routes
- `mahasiswa/pengumuman/rekening` - GET (form)
- `mahasiswa/pengumuman/rekening/save` - POST (save)

## Fitur

### Untuk Mahasiswa (Ketua Tim yang Lolos):
1. **Card Status Rekening** di halaman pengumuman:
   - Status "Sudah Diisi" / "Belum Diisi"
   - Link ke form input rekening (hanya muncul saat Phase 5 open dan user lolos)

2. **Form Input Rekening**:
   - Nama Bank (required)
   - Kantor Cabang (required)
   - Nama Pemilik Rekening (required)
   - Nomor Rekening (required)
   - Scan/Foto Buku Rekening - Halaman Pertama (PDF, max 5MB, required)
   - Deskripsi/Keterangan (optional)

3. **Validasi**:
   - Hanya bisa diakses saat Phase 5 (Pengumuman) dibuka
   - Hanya untuk tim yang lolos Tahap I (wawancara_status = approved)
   - Semua field wajib diisi kecuali deskripsi
   - File harus PDF dan max 5MB

4. **Edit Capability**:
   - Data bisa diupdate selama Phase 5 masih terbuka
   - File baru akan menggantikan file lama

## Testing
- Migration berhasil dijalankan
- Routes terdaftar dengan benar
- PHP syntax valid

## Catatan
- File buku rekening disimpan di `writable/uploads/pmw/bank_accounts/{bank_account_id}/`
- Admin view untuk melihat data rekening belum diimplementasikan (sesuai request user)
