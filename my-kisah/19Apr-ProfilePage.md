# Halaman Pengaturan Akun (Profile) - 19 Apr 2026

## Ringkasan
Halaman profil/pengaturan akun yang memungkinkan user untuk mengelola informasi pribadi, mengganti password, mengubah foto profil, dan mengedit data tim (untuk mahasiswa).

---

## Fitur

### 1. Edit Profil
- **Nama Lengkap**: Update nama user
- **Nomor Telepon**: Update nomor HP/WhatsApp
- **Jurusan & Prodi** (Mahasiswa only): Dropdown dinamis dengan Alpine.js
- **Semester** (Mahasiswa only): Pilihan semester 1-8

### 2. Ganti Password
- **Password Saat Ini**: Verifikasi password lama (wajib)
- **Password Baru**: Minimal 8 karakter
- **Konfirmasi Password**: Harus sama dengan password baru
- **Password Strength Meter**: Visual indicator kekuatan password

### 3. Foto Profil
- **Upload Foto**: Drag & drop atau click to upload
- **Preview**: Preview foto sebelum upload
- **Hapus Foto**: Hapus foto profil yang sudah ada
- **Keamanan**: 
  - Mime type verification
  - Max size 2MB
  - Format: JPG, JPEG, PNG only
  - File disimpan di `WRITEPATH` dengan `.htaccess` protection

### 4. Data Tim (Mahasiswa Only)
- **Edit Ketua Tim**: Update data ketua (diri sendiri)
- **Edit Anggota**: Update data anggota tim
- **Tambah/Hapus Anggota**: Dinamis dengan Alpine.js
- **Validasi**: Maksimal 4 anggota (total 5 orang)

---

## Struktur File

```
app/
├── Controllers/
│   └── ProfileController.php          # Controller utama
├── Views/
│   └── profile/
│       └── index.php                  # View halaman profil
└── Config/
    └── Routes.php                     # Routes untuk profile
```

---

## Routes

| Method | Route | Deskripsi |
|--------|-------|-----------|
| GET | `profile` | Halaman profil utama |
| POST | `profile/update` | Update data profil |
| POST | `profile/password` | Update password |
| POST | `profile/foto` | Upload foto profil |
| POST | `profile/foto/delete` | Hapus foto profil |
| GET | `profile/foto/(:num)` | View foto profil (secure) |
| POST | `profile/team` | Update data tim |

---

## Keamanan

### 1. File Upload Security
- **Mime Type Check**: Validasi mime type sesuai extension
- **Folder Protection**: `.htaccess` dengan `deny from all`
- **Secure Path**: File disimpan di `WRITEPATH` (tidak accessible dari web)
- **Random Filename**: Nama file acak untuk mencegah guessing

### 2. Password Security
- **Current Password Verification**: Harus masukkan password lama
- **Shield Auth**: Menggunakan CodeIgniter Shield untuk update password
- **Min Length**: Password minimal 8 karakter

### 3. Access Control
- **Session Filter**: Semua route membutuhkan login
- **Proposal Ownership**: Hanya ketua tim yang bisa edit data tim
- **CSRF Protection**: Semua form dilindungi CSRF token

---

## Files yang Dibuat/Diedit

### File Baru
1. `app/Controllers/ProfileController.php` - Controller lengkap dengan 7 method
2. `app/Views/profile/index.php` - View dengan 4 tab (Profil, Password, Foto, Tim)

### File Diedit
1. `app/Config/Routes.php` - Menambahkan 7 routes untuk profile

---

## UI/UX Features

### Alpine.js Integration
- **Tab Navigation**: Switch tab tanpa reload
- **Password Toggle**: Show/hide password
- **Password Strength**: Real-time strength meter
- **Foto Preview**: Preview sebelum upload
- **Dynamic Team Form**: Tambah/hapus anggota tim dinamis
- **Jurusan/Prodi Cascade**: Dropdown dependent

### Styling
- **Consistent Design**: Menggunakan design system yang sama dengan aplikasi
- **Responsive**: Grid layout untuk desktop, stack untuk mobile
- **Color Coding**: 
  - Sky: Profil
  - Amber: Password
  - Emerald: Foto
  - Violet: Tim

---

## Testing Checklist

### Profil
- [ ] Update nama lengkap
- [ ] Update nomor telepon
- [ ] Update jurusan & prodi (mahasiswa)
- [ ] Update semester (mahasiswa)
- [ ] Data di-retain saat error

### Password
- [ ] Ganti password dengan current password benar
- [ ] Gagal ganti password jika current password salah
- [ ] Password strength meter berfungsi
- [ ] Show/hide password toggle berfungsi

### Foto
- [ ] Upload foto baru
- [ ] Preview foto sebelum upload
- [ ] Hapus foto profil
- [ ] Validasi format file (hanya gambar)
- [ ] Validasi ukuran file (max 2MB)

### Data Tim
- [ ] Edit data ketua tim
- [ ] Edit data anggota tim
- [ ] Tambah anggota baru
- [ ] Hapus anggota
- [ ] Validasi max 4 anggota

---

## Catatan
- Semua user (admin, dosen, mentor, reviewer, mahasiswa) bisa akses halaman profil
- Hanya mahasiswa yang memiliki tab "Data Tim"
- Foto profil di-handle secara aman dengan folder protection
- Password menggunakan sistem Shield Auth bawaan CI4
