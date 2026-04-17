# Refactor Phase 5 & 6: Pengumuman dan Pembekalan

**Tanggal:** 17 April 2026  
**Status:** ✅ Selesai

---

## Ringkasan Perubahan

Workflow Phase 5 dan 6 direfactor dari yang sebelumnya digabung menjadi terpisah dengan fungsi yang jelas:

### Sebelum (Salah)
- **Phase 5:** "Pengumuman Tahap I & Pembekalan" - Pengumuman + materi pembekalan dalam satu tempat
- Tidak ada Phase 6

### Sesudah (Benar)
- **Phase 5:** "Pengumuman Kelolosan Dana Tahap I" - Admin publish pengumuman, upload SK Direktur, input info pembekalan
- **Phase 6:** "Pembekalan" - Mahasiswa upload foto kegiatan dan ringkasan pembekalan

---

## File yang Dibuat

### 1. Database Migrations
| File | Deskripsi |
|------|-----------|
| `2026-04-17-002000_AddTrainingInfoToAnnouncements.php` | Menambah kolom: training_date, training_location, training_details, sk_file_path, sk_original_name |
| `2026-04-17-002100_CreatePmwTrainingReportsTable.php` | Tabel untuk menyimpan ringkasan pembekalan |
| `2026-04-17-002200_CreatePmwTrainingPhotosTable.php` | Tabel untuk menyimpan foto kegiatan pembekalan |

### 2. Entities
| File | Deskripsi |
|------|-----------|
| `app/Entities/PmwTrainingReport.php` | Entity untuk laporan pembekalan |
| `app/Entities/PmwTrainingPhoto.php` | Entity untuk foto pembekalan |

### 3. Models (namespace: App\Models\AnnouncementFunding)
| File | Deskripsi |
|------|-----------|
| `PmwTrainingReportModel.php` | Model untuk training reports |
| `PmwTrainingPhotoModel.php` | Model untuk training photos |

### 4. Services
| File | Deskripsi |
|------|-----------|
| `app/Services/PmwTrainingReportService.php` | Service untuk manage laporan dan foto pembekalan |

### 5. Controllers
| File | Method Baru |
|------|-------------|
| `app/Controllers/Mahasiswa/TrainingController.php` | `index()`, `save()`, `deletePhoto()`, `downloadPhoto()` |
| `app/Controllers/Admin/AnnouncementController.php` | `uploadSk()`, `deleteSk()`, `downloadSk()` |
| `app/Controllers/Mahasiswa/AnnouncementController.php` | `downloadSk()` |

### 6. Views
| File | Deskripsi |
|------|-----------|
| `app/Views/mahasiswa/pembekalan/index.php` | Form input foto dan ringkasan pembekalan |
| `app/Views/mahasiswa/pengumuman/index.php` | Update: tampilkan SK dan info pembekalan |
| `app/Views/admin/pengumuman/index.php` | Update: form upload SK dan input info pembekalan |

---

## File yang Diupdate

### Entities
- `app/Entities/PmwAnnouncement.php` - Tambah properties: trainingDate, trainingLocation, trainingDetails, skFilePath, skOriginalName

### Models
- `app/Models/AnnouncementFunding/PmwAnnouncementModel.php` - Update allowedFields dengan training info

### Services
- `app/Services/PmwAnnouncementService.php` - Hapus methods items (getItems, addLinkItem, addFileItem, deleteItem, getFileItemOrFail), tambah uploadSkFile(), deleteSkFile()

### Controllers
- `app/Controllers/Admin/AnnouncementController.php` - Hapus items methods, tambah SK methods
- `app/Controllers/Mahasiswa/AnnouncementController.php` - Hapus download items, tambah downloadSk()

### Routes
- `app/Config/Routes.php` - Update Phase 5 routes, tambah Phase 6 routes

### Workflow Documentation
- `.windsurf/workflows/pmw-workflow.md` - Update tabel tahapan: Phase 5 dan 6 terpisah

---

## File yang Dihapus

| File | Alasan |
|------|--------|
| `app/Entities/PmwAnnouncementItem.php` | Tidak digunakan lagi (items dihapus) |
| `app/Models/AnnouncementFunding/PmwAnnouncementItemModel.php` | Tidak digunakan lagi |
| `app/Database/Migrations/2026-04-16-170010_CreatePmwAnnouncementItemsTable.php` | Tidak digunakan lagi |
| `app/Models/PmwAnnouncementModel.php` | Dipindah ke AnnouncementFunding namespace |
| `app/Models/PmwAnnouncementItemModel.php` | Dipindah ke AnnouncementFunding namespace |
| `app/Models/PmwBankAccountModel.php` | Dipindah ke AnnouncementFunding namespace |

---

## Struktur URL

### Phase 5 - Pengumuman (Admin)
- `GET /admin/pengumuman` - Halaman admin
- `POST /admin/pengumuman/{id}/save` - Simpan pengumuman + info pembekalan
- `POST /admin/pengumuman/{id}/publish` - Publish pengumuman
- `POST /admin/pengumuman/{id}/upload-sk` - Upload file SK (AJAX)
- `POST /admin/pengumuman/{id}/delete-sk` - Hapus file SK (AJAX)
- `GET /admin/pengumuman/{id}/sk` - Download file SK

### Phase 5 - Pengumuman (Mahasiswa)
- `GET /mahasiswa/pengumuman` - Lihat pengumuman, SK, info pembekalan
- `GET /mahasiswa/pengumuman/sk` - Download SK
- `GET /mahasiswa/pengumuman/rekening` - Form input data rekening
- `POST /mahasiswa/pengumuman/rekening/save` - Simpan data rekening
- `GET /mahasiswa/pengumuman/rekening/download` - Download buku rekening

### Phase 6 - Pembekalan (Mahasiswa)
- `GET /mahasiswa/pembekalan` - Halaman input laporan
- `POST /mahasiswa/pembekalan/save` - Simpan ringkasan + upload foto
- `POST /mahasiswa/pembekalan/photo/{id}/delete` - Hapus foto (AJAX)
- `GET /mahasiswa/pembekalan/photo/{id}` - Download foto

---

## Database Schema

### pmw_announcements (kolom baru)
```sql
training_date DATETIME NULL
training_location VARCHAR(255) NULL
training_details TEXT NULL
sk_file_path VARCHAR(255) NULL
sk_original_name VARCHAR(255) NULL
```

### pmw_training_reports (tabel baru)
```sql
id INT PK
proposal_id INT FK -> pmw_proposals
period_id INT FK -> pmw_periods
summary TEXT
created_at DATETIME
updated_at DATETIME
```

### pmw_training_photos (tabel baru)
```sql
id INT PK
report_id INT FK -> pmw_training_reports
file_path VARCHAR(255)
original_name VARCHAR(255)
created_at DATETIME
```

---

## Notes

1. **SK File:** PDF only, max 5MB, disimpan di `writable/uploads/pmw/sk/`
2. **Training Photos:** JPG/PNG only, max 2MB per foto, max 5 foto, disimpan di `writable/uploads/pmw/training_photos/{report_id}/`
3. **Bank Account:** Sudah diimplementasikan sebelumnya (dokumentasi terpisah)
4. **Migration:** Semua migration berhasil dijalankan
