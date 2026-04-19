# Kisah: Perencanaan Fitur Laporan Kemajuan & Akhir (Milestone)

**Tanggal**: 19 April 2026
**Waktu**: 09:13 AM
**Status**: Planning

## Deskripsi Tugas
Menambahkan fitur pengumpulan Laporan Kemajuan dan Laporan Akhir pada sistem PMW Polsri. Fitur ini dirancang untuk memberikan fleksibilitas bagi Admin dalam mengatur jendela waktu pengumpulan (window submission) secara global.

## Keputusan Teknis (Finalized 19 Apr - 09:22 AM)
1.  **Arsitektur Database**:
    - Tabel `pmw_report_schedules` & `pmw_reports` (Strict consistent naming).
    - Constraint: 1 jadwal per tipe per periode.
2.  **Alur Verifikasi**:
    - **Modal-Based Approval**: Verifikasi dilakukan melalui modal di halaman yang sama (User-friendly).
3.  **Antarmuka Pengguna (UI/UX)**:
    - **Single File Hub**: Penamaan file view `laporan_pmw.php` (tanpa folder tambahan di dalam folder role).
    - **Two-Tab System**: Navigasi Kemajuan vs Akhir dalam satu halaman.

## Dampak Sistem
- Struktur folder lebih flat dan bersih.
- Proses verifikasi lebih cepat (no page reload).

## Langkah Selanjutnya
1.  Eksekusi Migration.
2.  Implementasi Backend & UI.
