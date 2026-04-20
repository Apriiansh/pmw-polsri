<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PortalGallerySeeder extends Seeder
{
    public function run()
    {
        // Bersihkan data lama
        $this->db->table('portal_galleries')->truncate();

        $data = [
            // --- PERIODE 2024 ---
            [
                'title'       => 'Peluncuran Startup Kopi Mahasiswa',
                'category'    => 'Produk Binaan',
                'description' => 'Produk kopi premium hasil olahan mahasiswa jurusan perkebunan periode 2024.',
                'image_url'   => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 1,
                'created_at'  => '2024-03-15 10:00:00',
            ],
            [
                'title'       => 'Workshop Strategi Ekspor',
                'category'    => 'Workshop',
                'description' => 'Membekali mahasiswa dengan pengetahuan logistik internasional tahun 2024.',
                'image_url'   => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 2,
                'created_at'  => '2024-05-10 13:00:00',
            ],
            [
                'title'       => 'Mentoring Bisnis Kuliner',
                'category'    => 'Mentoring',
                'description' => 'Sesi tatap muka dengan owner franchise ternama di Sumsel.',
                'image_url'   => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 3,
                'created_at'  => '2024-07-22 15:30:00',
            ],
            [
                'title'       => 'Malam Apresiasi PMW 2024',
                'category'    => 'Awarding',
                'description' => 'Penghargaan startup dengan pertumbuhan pengguna tercepat tahun 2024.',
                'image_url'   => 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 4,
                'created_at'  => '2024-12-05 19:00:00',
            ],

            // --- PERIODE 2025 ---
            [
                'title'       => 'Aplikasi Smart-Ternak',
                'category'    => 'Produk Binaan',
                'description' => 'Solusi teknologi IoT untuk pemantauan ternak hasil binaan tahun 2025.',
                'image_url'   => 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 5,
                'created_at'  => '2025-02-18 09:00:00',
            ],
            [
                'title'       => 'Bazaar Startup Teknologi',
                'category'    => 'Bazaar',
                'description' => 'Pameran inovasi digital mahasiswa Polsri periode genap 2025.',
                'image_url'   => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 6,
                'created_at'  => '2025-04-12 10:00:00',
            ],
            [
                'title'       => 'Pitching Day Semester Ganjil',
                'category'    => 'Pitching',
                'description' => 'Seleksi pendanaan tahap II untuk kelompok wirausaha terpilih.',
                'image_url'   => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 7,
                'created_at'  => '2025-08-30 14:00:00',
            ],
            [
                'title'       => 'Workshop Fotografi Produk',
                'category'    => 'Workshop',
                'description' => 'Pelatihan teknik pengambilan gambar untuk katalog marketing.',
                'image_url'   => 'https://images.unsplash.com/photo-1542744094-24638eff58bb?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 8,
                'created_at'  => '2025-10-15 11:00:00',
            ],

            // --- PERIODE 2026 ---
            [
                'title'       => 'Fashion Ramah Lingkungan',
                'category'    => 'Produk Binaan',
                'description' => 'Lini busana menggunakan serat alami dari kelompok binaan 2026.',
                'image_url'   => 'https://images.unsplash.com/photo-1523381210434-271e8be1f52b?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 9,
                'created_at'  => '2026-01-25 10:00:00',
            ],
            [
                'title'       => 'Bootcamp Startup Intensif',
                'category'    => 'Workshop',
                'description' => 'Pelatihan 3 hari 2 malam untuk akselerasi pertumbuhan bisnis.',
                'image_url'   => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 10,
                'created_at'  => '2026-03-05 08:30:00',
            ],
            [
                'title'       => 'Grand Launching PMW 2026',
                'category'    => 'Dokumentasi',
                'description' => 'Seremoni pembukaan program PMW dengan target 500 peserta baru.',
                'image_url'   => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 11,
                'created_at'  => '2026-04-10 09:00:00',
            ],
            [
                'title'       => 'Diskusi Panel Industri',
                'category'    => 'Mentoring',
                'description' => 'Pertemuan strategis mahasiswa dengan jajaran direksi BUMN.',
                'image_url'   => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?q=80&w=1000&auto=format&fit=crop',
                'is_published'=> 1,
                'sort_order'  => 12,
                'created_at'  => '2026-05-15 14:00:00',
            ],
        ];

        $this->db->table('portal_galleries')->insertBatch($data);
    }
}
