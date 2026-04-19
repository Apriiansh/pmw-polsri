# Improvements Form User Admin - 19 Apr 2026

## Ringkasan Perubahan
Improvement pada halaman `admin/users/form` untuk mempermudah admin dalam mendaftarkan user baru.

---

## 1. Reorganisasi Urutan Form

**Struktur Baru:**
1. **STEP 1: Role Selection** - Pilih role user (Mahasiswa/Dosen/Mentor/Reviewer/Admin)
2. **STEP 2: Data Profil** - Isi data spesifik sesuai role yang dipilih
3. **STEP 3: Informasi Akun Login** - Username, Email, Password

**File:** `app/Views/admin/users/form.php`

---

## 2. Generate Password Otomatis

**Fitur:**
- Tombol **"Generate Otomatis"** di sebelah label Password
- Password generated: 12 karakter dengan kombinasi huruf besar, kecil, angka, dan simbol
- **Copy button** muncul saat ada password (dengan toast notification)
- **Password Strength Meter** dengan 4 level visual

**Validasi:**
- Password minimal 8 karakter (dihapus validasi `strong_password` yang ketat)

**Files:**
- `app/Views/admin/users/form.php` - UI generate password
- `app/Controllers/AdminController.php` - Hapus `strong_password` dari rules

---

## 3. Improve Generate Username

**Logika Baru:**
- Jika field **Nama** sudah diisi:
  - Username = nama depan + inisial nama tengah/belakang + 3 digit random
  - Contoh: `Budi Santoso` → `budis123`
- Jika nama kosong (fallback):
  - Role-based prefix: `mhs` (mahasiswa), `dsn` (dosen), `mtr` (mentor), `rvw` (reviewer), `adm` (admin)
  - Contoh: `mhs4821`

**File:** `app/Views/admin/users/form.php` (JavaScript `generateUsername()`)

---

## 4. Perbaikan Field Reviewer

**Masalah:** Field telepon duplikat untuk reviewer

**Solusi:**
- Hapus field `phone_reviewer` dari bagian reviewer fields
- Reviewer sekarang menggunakan field `phone` dari Common Fields (sama dengan role lain)

**Files:**
- `app/Views/admin/users/form.php` - Hapus duplikat phone field
- `app/Controllers/AdminController.php` - Update `createRoleProfile()` dan `updateRoleProfile()` untuk menggunakan `$data['phone']`

---

## Files yang Dimodifikasi

| File | Perubahan |
|------|-----------|
| `app/Views/admin/users/form.php` | Reorganisasi urutan form, tambah generate password, improve username generator, hapus phone_reviewer duplikat |
| `app/Controllers/AdminController.php` | Hapus validasi `strong_password`, update phone field untuk reviewer |
| `app/Models/ReviewerModel.php` | No changes (revert phone_secondary) |

---

## 5. Improvement Halaman Register Publik (auth/register)

**Masalah:**
- Form register terlalu ribet
- Tidak ada generate password
- Flash error kurang informatif
- Data tidak di-retain saat error validation
- Foto profil kurang user-friendly
- Validasi password ketat (`strong_password`)

**Solusi:**

### 5.1 Generate Password Otomatis
- Tombol **"Generate Otomatis"** di section Password
- Password 12 karakter dengan kombinasi huruf besar/kecil/angka/simbol
- Copy button dengan toast notification
- Password Strength Meter (4 level)

### 5.2 Flash Messages yang Lebih Baik
- Error message dengan styling yang lebih jelas
- Success message untuk feedback positif
- Auto-hide toast notifications

### 5.3 Data Retention (Old Value)
- Semua field mempertahankan nilai saat validation error
- Jurusan & Prodi yang pakai Alpine.js juga retain value
- Fix: `init()` function restore old values dari PHP `old()`

### 5.4 Foto Profil Preview
- Preview foto sebelum upload
- Tombol hapus foto dengan ikon X
- Tombol ganti foto
- Info keamanan: "File dienkripsi & dipindai untuk keamanan"
- Accept attribute: `image/jpeg,image/jpg,image/png`

### 5.5 Keamanan Upload File
**File:** `app/Controllers/AuthController.php`

- **Mime type verification:** Cek apakah mime type sesuai dengan extension
- **Folder auto-create:** Buat folder jika belum ada dengan permission 0755
- **.htaccess protection:** File `.htaccess` dengan `deny from all` untuk mencegah direct access
- **Random filename:** Menggunakan `getRandomName()` untuk nama file acak
- **Secure path:** File disimpan di `WRITEPATH` (tidak accessible dari web)

### 5.6 Validasi Password Lebih Sederhana
- Hapus validasi `strong_password` dari `attemptRegister()`
- Password minimal 8 karakter saja

**Files:**
- `app/Views/auth/register.php` - UI improvements
- `app/Controllers/AuthController.php` - Security & validation improvements

---

## Files yang Dimodifikasi (Final)

| File | Perubahan |
|------|-----------|
| `app/Views/admin/users/form.php` | Reorganisasi urutan form, generate password, improve username generator, hapus phone_reviewer duplikat |
| `app/Controllers/AdminController.php` | Hapus validasi `strong_password`, update phone field untuk reviewer |
| `app/Views/auth/register.php` | Generate password, strength meter, foto preview, flash messages, data retention |
| `app/Controllers/AuthController.php` | Hapus `strong_password`, keamanan upload file (mime check, .htaccess) |

---

## Testing Checklist

### Admin Form
- [ ] Generate username otomatis berdasarkan nama
- [ ] Generate password otomatis dengan copy button
- [ ] Password strength meter berfungsi
- [ ] Urutan form: Role → Data Profil → Akun Login
- [ ] Reviewer hanya memiliki 1 field telepon
- [ ] Password minimal 8 karakter (tidak wajib kombinasi kompleks)

### Register Publik
- [ ] Generate password otomatis
- [ ] Password strength meter di register
- [ ] Copy password ke clipboard
- [ ] Foto preview muncul sebelum upload
- [ ] Tombol hapus & ganti foto berfungsi
- [ ] Data form di-retain saat validation error
- [ ] Flash error message muncul dengan jelas
- [ ] Validasi file foto (type, size, extension)
- [ ] Folder uploads/profiles ter-proteksi .htaccess
