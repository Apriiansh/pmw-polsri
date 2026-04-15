# 📚 Panduan Deployment PMW Polsri ke cPanel (Manual)

Panduan ini ditujukan untuk deployment manual pada akun cPanel **opsimpmw** (simpmw.polsri.ac.id).

## 🏗️ Struktur Deployment di cPanel

```
/home/opsimpmw/                  ← Home Directory cPanel
│
├── pmw-app/                     ← Folder aplikasi (DI LUAR public_html)
│   ├── app/
│   ├── vendor/
│   ├── writable/
│   ├── .env                     ← Konfigurasi Produksi
│   └── .htaccess                ← Melindungi akses folder ini
│
└── public_html/                 ← Document Root (simpmw.polsri.ac.id)
    ├── build/                   ← Hasil build Vite (JS/CSS Alpine.js & Tailwind)
    ├── .htaccess
    ├── index.php                ← Modified front controller
    └── ... file publik lainnya
```

---

## 🚀 Langkah-Langkah Deployment

### 1. Persiapan Lokal
1.  Pastikan Anda telah mengisi kredensial database produksi di `deploy/pmw-app/.env`.
2.  Buka terminal di project lokal Anda.
3.  Jalankan script generator:
    ```bash
    bash create_deploy_zip.sh
    ```
4.  Script akan otomatis:
    *   Menjalankan `npm run build` (memproses Alpine.js & Tailwind via Vite).
    *   Membuat file `deploy_pmw-app.zip` (berisi aplikasi & .env produksi).
    *   Membuat file `deploy_public_html.zip` (berisi file publik & folder build/).

### 2. Upload ke cPanel
1.  **Upload `deploy_pmw-app.zip`**:
    *   Masuk ke File Manager cPanel.
    *   Upload ke Root Directory (`/home/opsimpmw/`).
    *   Extract file tersebut. Sekarang Anda punya folder `pmw-app` sejajar dengan `public_html`.
2.  **Upload `deploy_public_html.zip`**:
    *   Masuk ke folder `public_html`.
    *   Upload file zip ke sana.
    *   Extract file tersebut.

### 3. Konfigurasi Akhir
1.  **Database**:
    *   Buat database di cPanel (misal: `opsimpmw_pmw`).
    *   Import file SQL (jika ada) via phpMyAdmin.
    *   Update password di `/home/opsimpmw/pmw-app/.env` jika berbeda dengan template.
2.  **Permission**:
    *   Pastikan folder `pmw-app/writable` memiliki permission **755** agar CodeIgniter bisa menulis log/session.

---

## 🔧 Troubleshooting Vite & Alpine.js

Jika di server nanti CSS/JS tidak muncul atau Alpine.js tidak jalan:
1.  **Cek Folder Build**: Pastikan folder `public_html/build/` ada di server dan berisi file `.js` dan `.css`.
2.  **Base URL**: Pastikan `app.baseURL` di `.env` sudah menggunakan `https://simpmw.polsri.ac.id/`.
3.  **Mix-up**: Karena kita menggunakan `npm run build` di lokal, jangan lupa menjalankan script generator setiap kali Anda mengubah file CSS atau JS sebelum melakukan upload ulang.

---

**Notes:** Anda tidak perlu menginstal Node.js di server cPanel. Semua proses kompilasi sudah ditangani di lokal oleh script `create_deploy_zip.sh`.

