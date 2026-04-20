<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PortalAnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // --- TAHUN 2025 ---
            [
                'title'        => 'Pembukaan PMW Polsri Tahun Anggaran 2025',
                'slug'         => 'pembukaan-pmw-polsri-2025',
                'category'     => 'Penting',
                'content'      => '<p>Selamat datang di periode baru PMW Polsri! Kami mengundang seluruh mahasiswa kreatif untuk bergabung dalam ekosistem wirausaha kampus terkini.</p>',
                'date'         => '2025-02-10',
                'type'         => 'urgent',
                'is_published' => 1,
            ],
            [
                'title'        => 'Workshop Strategi Bisnis Model Canvas (BMC)',
                'slug'         => 'workshop-bmc-2025',
                'category'     => 'Info',
                'content'      => '<p>Pertajam ide bisnis Anda dengan mengikuti workshop BMC bersama praktisi industri ternama. Wajib bagi calon pendaftar PMW.</p>',
                'date'         => '2025-03-05',
                'type'         => 'info',
                'is_published' => 1,
            ],
            [
                'title'        => 'Pengumuman Lolos Seleksi Administrasi Tahap I 2025',
                'slug'         => 'pengumuman-tahap-1-2025',
                'category'     => 'Jadwal',
                'content'      => '<p>Sebanyak 150 proposal dinyatakan lolos seleksi administrasi. Silakan cek dashboard masing-masing untuk jadwal pitching.</p>',
                'date'         => '2025-04-20',
                'type'         => 'warning',
                'is_published' => 1,
            ],
            [
                'title'        => 'Tim EcoPolsri Raih Juara di KMI Award 2025',
                'slug'         => 'prestasi-kmi-award-2025',
                'category'     => 'Prestasi',
                'content'      => '<p>Kabar gembira! Salah satu tim binaan PMW Polsri berhasil membawa pulang medali emas di ajang Kewirausahaan Mahasiswa Indonesia (KMI) Award.</p>',
                'date'         => '2025-08-15',
                'type'         => 'success',
                'is_published' => 1,
            ],
            [
                'title'        => 'Monev Akhir dan Persiapan Expo 2025',
                'slug'         => 'monev-akhir-expo-2025',
                'category'     => 'Jadwal',
                'content'      => '<p>Seluruh tenant PMW wajib mengikuti monitoring dan evaluasi akhir sebagai syarat pencairan dana tahap II.</p>',
                'date'         => '2025-10-10',
                'type'         => 'warning',
                'is_published' => 1,
            ],
            [
                'title'        => 'PMW Polsri Night: Malam Penganugerahan 2025',
                'slug'         => 'pmw-night-2025',
                'category'     => 'Umum',
                'content'      => '<p>Rayakan keberhasilan perjalanan satu tahun wirausaha mahasiswa Polsri dalam malam penganugerahan yang meriah.</p>',
                'date'         => '2025-12-20',
                'type'         => 'success',
                'is_published' => 1,
            ],

            // --- TAHUN 2026 ---
            [
                'title'        => 'Sosialisasi Program Mahasiswa Wirausaha 2026',
                'slug'         => 'sosialisasi-pmw-2026',
                'category'     => 'Info',
                'content'      => '<p>Persiapkan diri Anda untuk PMW 2026. Kami akan mengadakan sosialisasi daring mengenai aturan baru pendanaan tahun ini.</p>',
                'date'         => '2026-01-15',
                'type'         => 'info',
                'is_published' => 1,
            ],
            [
                'title'        => 'Template Proposal PMW 2026 Telah Dirilis',
                'slug'         => 'template-proposal-2026',
                'category'     => 'Umum',
                'content'      => '<p>Pastikan Anda menggunakan template terbaru untuk menghindari diskualifikasi administrasi. Unduh di menu Unduhan.</p>',
                'date'         => '2026-02-01',
                'type'         => 'info',
                'is_published' => 1,
            ],
            [
                'title'        => 'Pendaftaran PMW 2026 Resmi Dibuka!',
                'slug'         => 'pendaftaran-pmw-2026-dibuka',
                'category'     => 'Penting',
                'content'      => '<p>Inilah saat yang ditunggu-tunggu. Pendaftaran PMW 2026 resmi dibuka mulai hari ini hingga 30 Mei 2026.</p>',
                'date'         => '2026-04-14',
                'type'         => 'urgent',
                'is_published' => 1,
            ],
            [
                'title'        => 'FAQ: Pertanyaan Sering Diajukan Seputar Pendaftaran',
                'slug'         => 'faq-pendaftaran-2026',
                'category'     => 'Umum',
                'content'      => '<p>Masih bingung cara mendaftar? Kami telah merangkum 20 pertanyaan paling sering diajukan untuk membantu Anda.</p>',
                'date'         => '2026-04-18',
                'type'         => 'info',
                'is_published' => 1,
            ],
            [
                'title'        => 'Jadwal Workshop Penulisan Proposal 2026',
                'slug'         => 'jadwal-workshop-proposal-2026',
                'category'     => 'Jadwal',
                'content'      => '<p>Workshop akan dilaksanakan pada 25 April 2026 di Aula Rektorat. Pastikan tim Anda hadir membawa draft proposal.</p>',
                'date'         => '2026-04-20',
                'type'         => 'warning',
                'is_published' => 1,
            ],
        ];

        // Using query builder for insertion
        $this->db->table('portal_announcements')->truncate(); // Clear existing to prevent duplicates
        $this->db->table('portal_announcements')->insertBatch($data);
    }
}
