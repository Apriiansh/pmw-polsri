---
description: 
---

# 📂 SKILL: PMW Data & Document Engine

> **⚠️ PERHATIAN**: Dokumen ini mendeskripsikan **Workflow Manual PMW Polsri** yang telah berjalan secara nyata di kampus _sebelum_ aplikasi ini dikembangkan. Aplikasi Sistem Informasi PMW dibuat untuk **mendigitalkan & memfasilitasi** workflow manual tersebut, bukan menciptakan proses baru.

---

## 🔄 WORKFLOW MANUAL PMW (Real-World Process)

Berikut adalah **10 tahapan** Program Mahasiswa Wirausaha Polsri yang dilaksanakan **secara manual/offline** setiap tahunnya:

| Tahap | Nama Kegiatan (Manual)                  | Pelaku (Offline)           | Bagaimana Aplikasi Membantu                                                                                                        |
| ----- | --------------------------------------- | -------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- |
| 1     | **Pendaftaran & Submit Proposal**       | Mahasiswa → UPAPKK (Admin) | Upload proposal digital, input tim mentah, tracking status                                                                         |
| 2     | **Seleksi Administrasi**                | UPAPKK (Admin) + Reviewer  | Checklist kelengkapan, flagging dokumen                                                                                            |
| 3     | **Pitching Desk**                       | Reviewer + Mahasiswa       | **2 Kategori:** Pemula (Pitching Deck → Approve Dosen → Approve UPAKKK) & Berkembang (Pitching Deck + Video Usaha → Approve Dosen) |
| 4     | **Wawancara Perjanjian**                | Dosen/Mentor + Mahasiswa   | Record hasil wawancara, MoU digital                                                                                                |
| 5     | **Pengumuman Tahap I & Pembekalan**     | Admin                      | Broadcast pengumuman, materi pembekalan                                                                                            |
| 6     | **Implementasi, Bimbingan & Mentoring** | Mahasiswa + Dosen + Mentor | Log bimbingan (Dosen) & Log mentoring (Praktisi), absensi digital, laporan progress                                                |
| 7     | **Monev Tahap 1 (Bazaar)**              | Reviewer + UPAPKK (Admin)  | Upload foto kegiatan, laporan awal                                                                                                 |
| 8     | **Monev Tahap 2 (Site Visit)**          | Dosen/Mentor + Reviewer    | Checklist kunjungan, laporan akhir                                                                                                 |
| 9     | **Pengumuman Tahap II**                 | UPAPKK (Admin)             | Notifikasi penerima dana tahap 2                                                                                                   |
| 10    | **Laporan Akhir & Penutupan**           | Mahasiswa                  | Submit dokumen final                                                                                                               |
| 11    | **Awarding & Expo**                     | Semua pihak                | Dokumentasi akhir, sertifikat digital                                                                                              |

---

## 🎯 TAHAP 3 DETAIL: PITCHING DESK WORKFLOW

Setelah seleksi administrasi, peserta memasuki **Tahap Pitching Desk** dengan pembagian **2 Kategori Wirausaha**:

### 📊 Alur Pitching Desk

```
┌─────────────────────┐
│ Seleksi Pitching    │
│ Desk (Tahap 3)      │
└─────────┬───────────┘
          │
          ▼
┌─────────────────────┐
│   Kategori          │
│   Wirausaha         │
└─────────┬───────────┘
          │
    ┌─────┴─────┐
    │           │
    ▼           ▼
┌─────────┐ ┌───────────┐
│ PEMULA  │ │BERKEMBANG │
└────┬────┘ └─────┬─────┘
     │            │
     ▼            ▼
┌─────────┐ ┌──────────────────────────┐
│Upload   │ │Upload Pitching Deck      │
│Pitching │ │+                         │
│Deck     │ │Upload Video Usaha        │
└────┬────┘ │+ Detail Keterangan Usaha │
     │      └─────────────┬────────────┘
     │                    │
     ▼                    ▼
┌──────────┐          ┌─────────────┐
│Approve   │          │Approve      │
│Dosen     │          │Dosen        │
│Pendamping│          │Pendamping   │
└────┬─────┘          └─────────────┘
     │                  │
     ▼                  ▼
┌──────────┐          ┌─────────────┐
│Approve   │          │Approve      │
│UPAKKK    │          │UPAKKK       │
└──────────┘          └─────────────┘
```

### 📋 Perbedaan Kategori

| Aspek               | **Pemula**                                    | **Berkembang**                                  |
| ------------------- | --------------------------------------------- | ----------------------------------------------- |
| **Definisi**        | Usaha baru yang belum berjalan atau < 1 tahun | Usaha yang sudah berjalan ≥ 1 tahun             |
| **Dokumen Wajib**   | Pitching Deck (PDF/PPT)                       | Pitching Deck + Video Usaha + Detail Keterangan |
| **Approval Flow**   | Dosen Pendamping → UPAKKK                     | Dosen Pendamping (1 level)                      |
| **Fokus Penilaian** | Konsep & Potensi                              | Performa & Pertumbuhan                          |

### 🔐 Digital Implementation

**Aplikasi mendukung dengan:**

- **Kategori Selection**: Mahasiswa memilih kategori saat submit pitching
- **Upload Management**: Upload deck (wajib) + video (khusus Berkembang)
- **Approval Tracking**: Status "Pending Review → Approved by Dosen → Approved by UPAKKK" (Pemula) atau "Pending → Approved" (Berkembang)
- **Reviewer Assignment**: Reviewer berbeda untuk tiap kategori

---

## 🎯 CORE PRINCIPLES (Digital Implementation)

Aplikasi ini dibangun berdasarkan prinsip:

1. **Document-Centric Access**: Hanya role yang berhak yang dapat akses dokumen tertentu (Reviewer → Proposal, Admin → Semua Nota)
2. **Contextual Submission**: Mahasiswa hanya bisa upload dokumen tertentu sesuai fase saat ini (tidak bisa upload Laporan Akhir di tahap awal)
3. **Presence & Mentoring**: Sistem "Double-Verification" — Mahasiswa catat bimbingan, Dosen/Mentor verifikasi/absen
4. **Data Privacy**: Dokumen keuangan (Nota) di-isolate, hanya Admin yang bisa akses untuk audit

---

## 👥 ROLE-BASED DATA MATRIX (Digital Permissions)

Berikut pemetaan **hak akses dalam aplikasi** berdasarkan workflow manual di atas:

| Role                   | Upload                                                            | View                                  | Verify                            |
| ---------------------- | ----------------------------------------------------------------- | ------------------------------------- | --------------------------------- |
| **Mahasiswa**          | Proposal, Laporan (Awal/Akhir), Dokumen Mentoring, Nota Pendanaan | Status & Panduan                      | —                                 |
| **Admin**              | Buku Panduan, Pengumuman, Jadwal                                  | Seluruh Laporan & Nota (audit)        | Validasi Administrasi             |
| **Reviewer**           | —                                                                 | Uploadan Mahasiswa (Proposal/Laporan) | **Nilai Kelayakan** (Layak/Tidak) |
| **Mentor** (Eksternal) | —                                                                 | Uploadan Mahasiswa, Data Dosen        | **Validasi Mentoring**            |
| **Dosen** (Internal)   | —                                                                 | Progres Mahasiswa Bimbingannya        | **Validasi Bimbingan**            |

> **Note**: **Bimbingan** dilakukan oleh Dosen Pendamping (Internal Polsri), sedangkan **Mentoring** dilakukan oleh Mentor/Praktisi (Eksternal). Keduanya memiliki log terpisah di sidebar Mahasiswa.
> **Admin**: UPAPKK bertindak sebagai Admin dengan otoritas penuh dan akses verifikasi administrasi.

## IMPLEMENTATION PATTERNS

### 1. Document Secure Serving

All documents in `writable/uploads/` are served via `DocumentController::download($id)` which checks:

- Is the user the owner (Mahasiswa)?
- Is the user an Admin/Reviewer/Mentor assigned to this student?

### 2. Bimbingan Presence Logic

`MentoringService` handles the "Absensi" logic where Mentor/Dosen records presence which then updates the Mahasiswa's mentoring documentation status.

### 3. Reviewer Decision Flow

Reviewers don't just "move a status", they provide a `ScoringEntity` that linked to a specific Proposal version, providing auditability on WHY a student was deemed "Layak".

---

## 📋 DIGITAL vs MANUAL MAPPING

Berikut detail fitur aplikasi yang menggantikan/mendukung proses manual:

### Tahap 1-2: Pendaftaran & Administrasi

| Manual (Sebelumnya)                | Digital (Aplikasi Ini)                                                    |
| ---------------------------------- | ------------------------------------------------------------------------- |
| Mahasiswa antri ke sekretariat PMW | Upload proposal & Registrasi Profil Lengkap (Nama, NIM, Semester, Gender) |
| Admin cek kelengkapan berkas fisik | Dashboard cek kelengkapan digital & Validasi Data Profil                  |
| Stempel & tanda tangan manual      | Status tracking real-time & Digital Records                               |

### Tahap 3: Pitching Desk (2 Kategori)

| Manual (Sebelumnya)                | Digital (Aplikasi Ini)                                    |
| ---------------------------------- | --------------------------------------------------------- |
| Pitching: Presentasi di ruangan    | Jadwal pitching, upload pitching deck                     |
| **Pemula**: Pitching deck saja     | Form upload deck, approval Dosen → UPAKKK                 |
| **Berkembang**: Deck + video usaha | Upload deck + video + detail keterangan, 1-level approval |
| Penilaian: Kertas scoring manual   | Form scoring digital dengan rubrik per kategori           |
| Feedback: Lisan/catatan kertas     | Komentar tertulis terstruktur                             |

### Tahap 7: Mentoring (Fase Terpanjang)

| Manual (Sebelumnya)                | Digital (Aplikasi Ini)              |
| ---------------------------------- | ----------------------------------- |
| Mahasiswa catat pertemuan di buku  | Log bimbingan digital               |
| Dosen/Mentor tanda tangan buku     | Verifikasi digital dengan timestamp |
| Cek progress: Tanya via WA/telepon | Dashboard progres real-time         |

### Tahap 8-9: Monitoring & Evaluasi

| Manual (Sebelumnya)          | Digital (Aplikasi Ini)                 |
| ---------------------------- | -------------------------------------- |
| Bazaar: Foto + laporan fisik | Upload foto kegiatan + laporan PDF     |
| Site visit: Checklist kertas | Checklist digital dengan GPS/timestamp |
| Monev: Rapat evaluator       | Scoring terpusat dengan history        |

### Tahap 10-11: Penyelesaian

| Manual (Sebelumnya)                 | Digital (Aplikasi Ini)    |
| ----------------------------------- | ------------------------- |
| Pengumuman: Papan pengumuman kampus | Notifikasi in-app + email |
| Sertifikat: Cetak fisik             | Download sertifikat PDF   |
| Dokumentasi: Arsip kertas           | Arsip digital terstruktur |

---

> **💡 Inti Aplikasi**: Aplikasi ini **bukan** menciptakan workflow baru, melainkan **mendigitalkan 11 tahapan yang sudah ada** agar lebih efisien, transparan, dan teraudit.
