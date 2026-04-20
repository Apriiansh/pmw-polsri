<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PortalAnnouncementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title'        => 'Pendaftaran Program Mahasiswa Wirausaha (PMW) 2026 Resmi Dibuka',
                'slug'         => 'pendaftaran-pmw-2026-resmi-dibuka',
                'category'     => 'Info',
                'type'         => 'urgent',
                'content'      => json_encode([
                    'ops' => [
                        ['insert' => "Kabar gembira untuk seluruh mahasiswa Politeknik Negeri Sriwijaya!"],
                        ['attributes' => ['header' => 2], 'insert' => "\n"],
                        ['insert' => "Pendaftaran PMW 2026 telah resmi dibuka. Siapkan ide bisnis kreatif Anda dan bergabunglah bersama ratusan wirausaha muda lainnya.\n\n"],
                        ['attributes' => ['bold' => true], 'insert' => "Syarat Pendaftaran:"],
                        ['insert' => "\n"],
                        ['insert' => "Mahasiswa aktif semua jurusan"],
                        ['attributes' => ['list' => 'ordered'], 'insert' => "\n"],
                        ['insert' => "Memiliki tim minimal 3 orang"],
                        ['attributes' => ['list' => 'ordered'], 'insert' => "\n"],
                        ['insert' => "Proposal sesuai template terbaru"],
                        ['attributes' => ['list' => 'ordered'], 'insert' => "\n"],
                        ['insert' => "\nJangan sampai ketinggalan!"],
                        ['attributes' => ['italic' => true], 'insert' => "\n"]
                    ]
                ]),
                'date'         => '2026-01-15',
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Workshop Strategi Business Model Canvas (BMC)',
                'slug'         => 'workshop-strategi-bmc',
                'category'     => 'Agenda',
                'type'         => 'normal',
                'content'      => json_encode([
                    'ops' => [
                        ['insert' => "Workshop BMC"],
                        ['attributes' => ['header' => 2], 'insert' => "\n"],
                        ['insert' => "Ikuti workshop mendalam mengenai penyusunan model bisnis yang solid menggunakan framework BMC bersama narasumber ahli.\n\n"],
                        ['attributes' => ['bold' => true], 'insert' => "Waktu:"],
                        ['insert' => " 25 Januari 2026\n"],
                        ['attributes' => ['bold' => true], 'insert' => "Tempat:"],
                        ['insert' => " Aula KPA Lantai 2\n"],
                        ['insert' => "Wajib bagi seluruh calon pendaftar PMW."],
                        ['attributes' => ['blockquote' => true], 'insert' => "\n"]
                    ]
                ]),
                'date'         => '2026-01-20',
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Jadwal Presentasi (Pitching) Tahap 1',
                'slug'         => 'jadwal-pitching-tahap-1',
                'category'     => 'Agenda',
                'type'         => 'warning',
                'content'      => json_encode([
                    'ops' => [
                        ['insert' => "Sesi Pitching Tahap 1"],
                        ['attributes' => ['header' => 2], 'insert' => "\n"],
                        ['insert' => "Berikut adalah daftar tim yang diwajibkan hadir pada sesi presentasi ide bisnis di depan dewan juri.\n\n"],
                        ['insert' => "Siapkan materi presentasi maksimal 5 menit."],
                        ['attributes' => ['bold' => true], 'insert' => "\n"]
                    ]
                ]),
                'date'         => '2026-02-10',
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'PENGUMUMAN: Daftar Penerima Pendanaan PMW 2026',
                'slug'         => 'daftar-penerima-pendanaan-pmw-2026',
                'category'     => 'Info',
                'type'         => 'success',
                'content'      => json_encode([
                    'ops' => [
                        ['insert' => "Selamat kepada Tim Terpilih!"],
                        ['attributes' => ['header' => 2], 'insert' => "\n"],
                        ['insert' => "Berdasarkan hasil seleksi ketat, berikut adalah daftar tim yang berhak mendapatkan dana hibah pengembangan usaha PMW 2026.\n\n"],
                        ['insert' => "Silakan cek dashboard masing-masing untuk detail kontrak."],
                        ['attributes' => ['bold' => true], 'insert' => "\n"]
                    ]
                ]),
                'date'         => '2026-03-01',
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Pelatihan Digital Marketing & E-Commerce',
                'slug'         => 'pelatihan-digital-marketing-2026',
                'category'     => 'Agenda',
                'type'         => 'normal',
                'content'      => json_encode([
                    'ops' => [
                        ['insert' => "Optimalkan Penjualan Anda!"],
                        ['attributes' => ['header' => 2], 'insert' => "\n"],
                        ['insert' => "Pelatihan ini akan membahas cara menggunakan platform sosial media dan marketplace untuk meningkatkan traksi bisnis mahasiswa.\n\n"],
                        ['insert' => "Daftar hadir akan menjadi syarat pencairan dana tahap kedua."],
                        ['attributes' => ['italic' => true, 'bold' => true], 'insert' => "\n"]
                    ]
                ]),
                'date'         => '2026-04-15',
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Jadwal Monitoring & Evaluasi (Monev) Lapangan',
                'slug'         => 'jadwal-monev-lapangan-2026',
                'category'     => 'Agenda',
                'type'         => 'warning',
                'content'      => json_encode([
                    'ops' => [
                        ['insert' => "Persiapan Monev Lapangan"],
                        ['attributes' => ['header' => 2], 'insert' => "\n"],
                        ['insert' => "Tim reviewer akan mengunjungi lokasi usaha atau workshop masing-masing tim untuk melihat progres implementasi dana.\n\n"],
                        ['attributes' => ['bold' => true], 'insert' => "Pastikan:"],
                        ['insert' => "\n"],
                        ['insert' => "Produk sudah tersedia"],
                        ['attributes' => ['list' => 'ordered'], 'insert' => "\n"],
                        ['insert' => "Laporan keuangan sementara sudah siap"],
                        ['attributes' => ['list' => 'ordered'], 'insert' => "\n"]
                    ]
                ]),
                'date'         => '2026-06-20',
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Persiapan EXPO PMW Politeknik Negeri Sriwijaya',
                'slug'         => 'persiapan-expo-pmw-polsri-2026',
                'category'     => 'Agenda',
                'type'         => 'normal',
                'content'      => json_encode([
                    'ops' => [
                        ['insert' => "Pameran Produk Terbesar Mahasiswa"],
                        ['attributes' => ['header' => 2], 'insert' => "\n"],
                        ['insert' => "Segera siapkan booth dan packaging produk terbaik Anda untuk dipamerkan dalam ajang EXPO PMW di Graha Pendidikan.\n\n"],
                        ['insert' => "Akan ada juri eksternal dari kalangan industri."],
                        ['attributes' => ['bold' => true], 'insert' => "\n"]
                    ]
                ]),
                'date'         => '2026-08-10',
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Daftar Pemenang PMW Awarding Night 2026',
                'slug'         => 'pemenang-pmw-awarding-night-2026',
                'category'     => 'Berita',
                'type'         => 'success',
                'content'      => json_encode([
                    'ops' => [
                        ['insert' => "Malam Penganugerahan PMW 2026"],
                        ['attributes' => ['header' => 2], 'insert' => "\n"],
                        ['insert' => "Selamat kepada tim 'Eco-Tech' yang berhasil menyabet gelar Best Innovative Start-up tahun ini.\n\n"],
                        ['insert' => "Terima kasih kepada seluruh peserta yang telah berjuang keras mengembangkan usahanya."],
                        ['attributes' => ['italic' => true], 'insert' => "\n"]
                    ]
                ]),
                'date'         => '2026-09-05',
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Ketentuan Unggah Laporan Akhir & SPJ',
                'slug'         => 'ketentuan-laporan-akhir-pmw-2026',
                'category'     => 'Info',
                'type'         => 'urgent',
                'content'      => json_encode([
                    'ops' => [
                        ['insert' => "Batas Akhir Laporan"],
                        ['attributes' => ['header' => 2], 'insert' => "\n"],
                        ['insert' => "Diberitahukan kepada seluruh tim penerima dana untuk segera melengkapi laporan akhir dan Surat Pertanggungjawaban (SPJ).\n\n"],
                        ['insert' => "Keterlambatan akan berdampak pada nilai yudisium."],
                        ['attributes' => ['bold' => true, 'strike' => false], 'insert' => "\n"]
                    ]
                ]),
                'date'         => '2026-10-15',
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'Sesi Mentoring Eksklusif bersama CEO Startup Lokal',
                'slug'         => 'mentoring-eksklusif-ceo-startup',
                'category'     => 'Agenda',
                'type'         => 'normal',
                'content'      => json_encode([
                    'ops' => [
                        ['insert' => "Sharing Session & Mentoring"],
                        ['attributes' => ['header' => 2], 'insert' => "\n"],
                        ['insert' => "Dapatkan tips praktis mengenai 'Scaling Up' bisnis dari mereka yang sudah berhasil di industri.\n\n"],
                        ['insert' => "Kuota terbatas hanya untuk 20 tim tercepat."],
                        ['attributes' => ['underline' => true], 'insert' => "\n"]
                    ]
                ]),
                'date'         => '2026-05-20',
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('portal_announcements')->insertBatch($data);
    }
}
