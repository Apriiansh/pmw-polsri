<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CmsContentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // --- HERO SECTION ---
            [
                'key'     => 'home_hero_badge',
                'content' => 'Program Tahun 2026',
                'type'    => 'text',
                'group'   => 'home_hero',
                'label'   => 'Hero Badge Text',
            ],
            [
                'key'     => 'home_hero_title_1',
                'content' => 'Program Mahasiswa',
                'type'    => 'text',
                'group'   => 'home_hero',
                'label'   => 'Hero Title (Line 1)',
            ],
            [
                'key'     => 'home_hero_title_2',
                'content' => 'Wirausaha',
                'type'    => 'text',
                'group'   => 'home_hero',
                'label'   => 'Hero Title (Line 2)',
            ],
            [
                'key'     => 'home_hero_description',
                'content' => 'Politeknik Negeri Sriwijaya memfasilitasi mahasiswa untuk mengembangkan ide bisnis menjadi usaha nyata melalui program pembinaan kewirausahaan.',
                'type'    => 'text',
                'group'   => 'home_hero',
                'label'   => 'Hero Description',
            ],
            [
                'key'     => 'home_hero_image',
                'content' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80',
                'type'    => 'image',
                'group'   => 'home_hero',
                'label'   => 'Hero Image',
            ],
            [
                'key'     => 'home_hero_stats',
                'content' => json_encode([
                    ['number' => '7+', 'label' => 'Tahun Berdiri'],
                    ['number' => '100+', 'label' => 'Tim Terbina'],
                    ['number' => '50+', 'label' => 'Usaha Aktif'],
                ]),
                'type'    => 'json',
                'group'   => 'home_hero',
                'label'   => 'Hero Statistics',
            ],

            // --- FEATURES SECTION ---
            [
                'key'     => 'home_features_badge',
                'content' => 'Mengapa PMW?',
                'type'    => 'text',
                'group'   => 'home_features',
                'label'   => 'Features Badge',
            ],
            [
                'key'     => 'home_features_title',
                'content' => 'Program Pembinaan Komprehensif',
                'type'    => 'text',
                'group'   => 'home_features',
                'label'   => 'Features Title',
            ],
            [
                'key'     => 'home_features_description',
                'content' => 'Program Mahasiswa Wirausaha dirancang untuk memberikan dukungan holistik dari ide hingga usaha yang berkelanjutan.',
                'type'    => 'text',
                'group'   => 'home_features',
                'label'   => 'Features Description',
            ],
            [
                'key'     => 'home_features_list',
                'content' => json_encode([
                    [
                        'icon'  => 'fa-route',
                        'color' => 'sky',
                        'title' => 'Proses Jelas',
                        'desc'  => 'Tahapan program yang terstruktur dari pendaftaran hingga awarding dengan milestone yang jelas.'
                    ],
                    [
                        'icon'  => 'fa-users',
                        'color' => 'yellow',
                        'title' => 'Tim Pendamping',
                        'desc'  => 'Didampingi oleh dosen dan mentor industri berpengalaman dalam setiap tahap pengembangan.'
                    ],
                    [
                        'icon'  => 'fa-coins',
                        'color' => 'sky',
                        'title' => 'Dana Ilham',
                        'desc'  => 'Akses pendanaan tahap 1 dan tahap 2 untuk mengakselerasi pertumbuhan usaha Anda.'
                    ],
                    [
                        'icon'  => 'fa-chart-line',
                        'color' => 'emerald',
                        'title' => 'Pengembangan Skill',
                        'desc'  => 'Pelatihan kewirausahaan, manajemen bisnis, dan pengembangan produk berkualitas.'
                    ],
                ]),
                'type'    => 'json',
                'group'   => 'home_features',
                'label'   => 'Features List',
            ],

            // --- WORKFLOW SECTION ---
            [
                'key'     => 'home_workflow_badge',
                'content' => 'Alur Program',
                'type'    => 'text',
                'group'   => 'home_workflow',
                'label'   => 'Workflow Badge',
            ],
            [
                'key'     => 'home_workflow_title',
                'content' => '11 Tahapan Menuju Wirausaha Mandiri',
                'type'    => 'text',
                'group'   => 'home_workflow',
                'label'   => 'Workflow Title',
            ],
            [
                'key'     => 'home_workflow_description',
                'content' => 'Program ini dirancang dengan pendekatan berbasis proses yang sistematis. Setiap tahap memiliki kriteria evaluasi yang jelas dan dukungan yang sesuai.',
                'type'    => 'text',
                'group'   => 'home_workflow',
                'label'   => 'Workflow Description',
            ],
            [
                'key'     => 'home_workflow_image',
                'content' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80',
                'type'    => 'image',
                'group'   => 'home_workflow',
                'label'   => 'Workflow Image',
            ],
            [
                'key'     => 'home_workflow_list',
                'content' => json_encode([
                    ['num' => '1', 'color' => 'sky', 'title' => 'Pendaftaran & Proposal', 'desc' => 'Submit ide bisnis Anda'],
                    ['num' => '2', 'color' => 'yellow', 'title' => 'Seleksi & Pitching', 'desc' => 'Presentasi di depan reviewer'],
                    ['num' => '3', 'color' => 'emerald', 'title' => 'Implementasi & Mentoring', 'desc' => 'Bimbingan intensif 4 bulan'],
                ]),
                'type'    => 'json',
                'group'   => 'home_workflow',
                'label'   => 'Workflow Preview List',
            ],

            // --- GALLERY SECTION ---
            [
                'key'     => 'home_gallery_badge',
                'content' => 'Dokumentasi',
                'type'    => 'text',
                'group'   => 'home_gallery',
                'label'   => 'Gallery Badge',
            ],
            [
                'key'     => 'home_gallery_title_1',
                'content' => 'Galeri',
                'type'    => 'text',
                'group'   => 'home_gallery',
                'label'   => 'Gallery Title (Part 1)',
            ],
            [
                'key'     => 'home_gallery_title_2',
                'content' => 'Kegiatan',
                'type'    => 'text',
                'group'   => 'home_gallery',
                'label'   => 'Gallery Title (Part 2)',
            ],

            // --- CTA SECTION ---
            [
                'key'     => 'home_cta_badge',
                'content' => 'Siap Memulai?',
                'type'    => 'text',
                'group'   => 'home_cta',
                'label'   => 'CTA Badge',
            ],
            [
                'key'     => 'home_cta_title',
                'content' => 'Bersiaplah untuk PMW Berikutnya',
                'type'    => 'text',
                'group'   => 'home_cta',
                'label'   => 'CTA Title',
            ],
            [
                'key'     => 'home_cta_description',
                'content' => 'Pelajari tahapan program dan persiapkan diri Anda untuk pendaftaran periode berikutnya. Tim kami siap membimbing Anda.',
                'type'    => 'text',
                'group'   => 'home_cta',
                'label'   => 'CTA Description',
            ],

            // --- TAHAPAN PAGE: HERO ---
            [
                'key'     => 'tahapan_hero_badge',
                'content' => 'Alur Program',
                'type'    => 'text',
                'group'   => 'tahapan_hero',
                'label'   => 'Hero Badge',
            ],
            [
                'key'     => 'tahapan_hero_title_1',
                'content' => 'Tahapan',
                'type'    => 'text',
                'group'   => 'tahapan_hero',
                'label'   => 'Hero Title (Part 1)',
            ],
            [
                'key'     => 'tahapan_hero_title_2',
                'content' => 'Program PMW',
                'type'    => 'text',
                'group'   => 'tahapan_hero',
                'label'   => 'Hero Title (Part 2)',
            ],
            [
                'key'     => 'tahapan_hero_description',
                'content' => 'Program Mahasiswa Wirausaha terdiri dari 11 tahapan yang harus dilalui peserta mulai dari pendaftaran hingga Awarding & Expo Kewirausahaan.',
                'type'    => 'text',
                'group'   => 'tahapan_hero',
                'label'   => 'Hero Description',
            ],

            // --- TAHAPAN PAGE: REGISTRATION FLOW ---
            [
                'key'     => 'tahapan_flow_badge',
                'content' => 'Alur Pendaftaran',
                'type'    => 'text',
                'group'   => 'tahapan_flow',
                'label'   => 'Flow Badge',
            ],
            [
                'key'     => 'tahapan_flow_title_1',
                'content' => 'Bagaimana Cara',
                'type'    => 'text',
                'group'   => 'tahapan_flow',
                'label'   => 'Flow Title (Part 1)',
            ],
            [
                'key'     => 'tahapan_flow_title_2',
                'content' => 'Mendaftar',
                'type'    => 'text',
                'group'   => 'tahapan_flow',
                'label'   => 'Flow Title (Part 2)',
            ],
            [
                'key'     => 'tahapan_flow_description',
                'content' => 'Ikuti langkah-langkah berikut untuk mendaftar Program Mahasiswa Wirausaha Polsri.',
                'type'    => 'text',
                'group'   => 'tahapan_flow',
                'label'   => 'Flow Description',
            ],
            [
                'key'     => 'tahapan_flow_steps',
                'content' => json_encode([
                    ['num' => '1', 'title' => 'Registrasi Akun', 'desc' => 'Buat akun di sistem PMW Polsri dengan email kampus.'],
                    ['num' => '2', 'title' => 'Pilih Kategori', 'desc' => 'Tentukan kategori PMW: Usaha Pemula atau Berkembang.'],
                    ['num' => '3', 'title' => 'Lengkapi Data Tim', 'desc' => 'Masukkan profil seluruh anggota tim beserta skill.'],
                    ['num' => '4', 'title' => 'Upload Proposal', 'desc' => 'Unggah proposal usaha dalam format PDF sesuai template.'],
                    ['num' => '5', 'seleksi' => 'Seleksi & Wawancara', 'desc' => 'Ikuti seluruh tahapan seleksi dengan persiapan matang.'],
                    ['num' => '6', 'title' => 'Implementasi', 'desc' => 'Peserta terpilih akan mengikuti program hingga evaluasi akhir.'],
                ]),
                'type'    => 'json',
                'group'   => 'tahapan_flow',
                'label'   => 'Registration Steps',
            ],

            // --- TAHAPAN PAGE: CTA ---
            [
                'key'     => 'tahapan_cta_title',
                'content' => 'Siap Mengikuti Tahapan PMW?',
                'type'    => 'text',
                'group'   => 'tahapan_cta',
                'label'   => 'CTA Title',
            ],
            [
                'key'     => 'tahapan_cta_description',
                'content' => 'Daftarkan tim Anda sekarang dan mulai perjalanan kewirausahaan.',
                'type'    => 'text',
                'group'   => 'tahapan_cta',
                'label'   => 'CTA Description',
            ],

            // --- TENTANG PAGE: HERO ---
            [
                'key'     => 'tentang_hero_badge',
                'content' => 'Tentang Program',
                'type'    => 'text',
                'group'   => 'tentang_hero',
                'label'   => 'Hero Badge',
            ],
            [
                'key'     => 'tentang_hero_title',
                'content' => 'Program Mahasiswa Wirausaha',
                'type'    => 'text',
                'group'   => 'tentang_hero',
                'label'   => 'Hero Title',
            ],
            [
                'key'     => 'tentang_hero_description',
                'content' => 'Program pembinaan kewirausahaan bagi mahasiswa Politeknik Negeri Sriwijaya untuk mengembangkan usaha berbasis inovasi dan kreativitas.',
                'type'    => 'text',
                'group'   => 'tentang_hero',
                'label'   => 'Hero Description',
            ],

            // --- TENTANG PAGE: VISION & MISSION ---
            [
                'key'     => 'tentang_vision_title',
                'content' => 'Mengembangkan Entrepreneur Muda',
                'type'    => 'text',
                'group'   => 'tentang_vision',
                'label'   => 'Vision Title',
            ],
            [
                'key'     => 'tentang_vision_content',
                'content' => 'Menjadikan Politeknik Negeri Sriwijaya sebagai pusat unggulan pengembangan kewirausahaan yang menghasilkan entrepreneur muda berdaya saing tinggi, inovatif, dan berkontribusi pada pertumbuhan ekonomi lokal maupun nasional.',
                'type'    => 'text',
                'group'   => 'tentang_vision',
                'label'   => 'Vision Text',
            ],
            [
                'key'     => 'tentang_mission_list',
                'content' => json_encode([
                    'Memfasilitasi mahasiswa dalam mengembangkan ide bisnis menjadi usaha nyata',
                    'Memberikan pendanaan dan akses permodalan untuk pengembangan usaha',
                    'Menyediakan mentoring dan pendampingan dari praktisi berpengalaman',
                    'Membangun ekosistem kewirausahaan yang kolaboratif dan berkelanjutan'
                ]),
                'type'    => 'json',
                'group'   => 'tentang_vision',
                'label'   => 'Mission List',
            ],
            [
                'key'     => 'tentang_vision_image',
                'content' => 'https://images.unsplash.com/photo-1553877522-43269d4ea984?w=800&q=80',
                'type'    => 'image',
                'group'   => 'tentang_vision',
                'label'   => 'Vision Image',
            ],

            // --- TENTANG PAGE: OBJECTIVES ---
            [
                'key'     => 'tentang_objectives_title',
                'content' => 'Apa yang Kami Capai',
                'type'    => 'text',
                'group'   => 'tentang_objectives',
                'label'   => 'Objectives Title',
            ],
            [
                'key'     => 'tentang_objectives_list',
                'content' => json_encode([
                    ['icon' => 'fa-lightbulb', 'color' => 'sky', 'title' => 'Inovasi & Kreativitas', 'desc' => 'Mendorong mahasiswa mengembangkan produk/jasa inovatif.'],
                    ['icon' => 'fa-hand-holding-usd', 'color' => 'yellow', 'title' => 'Kemandirian Ekonomi', 'desc' => 'Membantu mahasiswa membangun sumber penghasilan mandiri.'],
                    ['icon' => 'fa-network-wired', 'color' => 'emerald', 'title' => 'Networking Bisnis', 'desc' => 'Membangun jaringan dengan pelaku usaha dan investor.'],
                    ['icon' => 'fa-graduation-cap', 'color' => 'sky', 'title' => 'Skill Development', 'desc' => 'Pelatihan manajemen bisnis dan financial literacy.'],
                    ['icon' => 'fa-users', 'color' => 'yellow', 'title' => 'Job Creation', 'desc' => 'Menciptakan lapangan kerja melalui usaha berkelanjutan.'],
                    ['icon' => 'fa-globe-asia', 'color' => 'emerald', 'title' => 'Dampak Sosial', 'desc' => 'Mengembangkan usaha yang berdampak positif bagi masyarakat.'],
                ]),
                'type'    => 'json',
                'group'   => 'tentang_objectives',
                'label'   => 'Objectives List',
            ],

            // --- TENTANG PAGE: CTA ---
            [
                'key'     => 'tentang_cta_title',
                'content' => 'Siap Bergabung dengan PMW?',
                'type'    => 'text',
                'group'   => 'tentang_cta',
                'label'   => 'CTA Title',
            ],
            [
                'key'     => 'tentang_cta_description',
                'content' => 'Pelajari tahapan program selengkapnya dan persiapkan proposal terbaik Anda.',
                'type'    => 'text',
                'group'   => 'tentang_cta',
                'label'   => 'CTA Description',
            ],

            // --- GALERI PAGE: HERO ---
            [
                'key'     => 'galeri_hero_badge',
                'content' => 'Dokumentasi',
                'type'    => 'text',
                'group'   => 'galeri_hero',
                'label'   => 'Hero Badge',
            ],
            [
                'key'     => 'galeri_hero_title',
                'content' => 'Galeri <span class="text-gradient">Kegiatan</span>',
                'type'    => 'text',
                'group'   => 'galeri_hero',
                'label'   => 'Hero Title',
            ],
            [
                'key'     => 'galeri_hero_description',
                'content' => 'Momen-momen berkesan dari Program Mahasiswa Wirausaha Polsri. Lihat aktivitas mentoring, pitching, bazaar, dan awarding.',
                'type'    => 'text',
                'group'   => 'galeri_hero',
                'label'   => 'Hero Description',
            ],

            // --- GALERI PAGE: ITEMS ---
            [
                'key'     => 'galeri_items_list',
                'content' => json_encode([
                    ['img' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80', 'badge' => 'Mentoring 2025', 'title' => 'Sesi Mentoring Intensif', 'desc' => 'Dosen dan mentor berbagi pengalaman', 'size' => 'large'],
                    ['img' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=400&q=80', 'badge' => 'Pitching', 'title' => 'Pitching Desk 2025', 'desc' => '', 'size' => 'small'],
                    ['img' => 'https://images.unsplash.com/photo-1531058020387-3be344556be6?w=400&q=80', 'badge' => 'Awarding', 'title' => 'Awarding 2024', 'desc' => '', 'size' => 'small'],
                    ['img' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=400&q=80', 'badge' => 'Workshop', 'title' => 'Workshop Business Plan', 'desc' => '', 'size' => 'small'],
                    ['img' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=400&q=80', 'badge' => 'Bazaar', 'title' => 'Bazaar Monev 2025', 'desc' => '', 'size' => 'small'],
                ]),
                'type'    => 'json',
                'group'   => 'galeri_grid',
                'label'   => 'Gallery Items',
            ],

            // --- HOME PAGE: STATS ---
            [
                'key'     => 'home_stats_list',
                'content' => json_encode([
                    ['icon' => 'fa-users', 'val' => '500+', 'label' => 'Peserta Terdaftar', 'color' => 'sky'],
                    ['icon' => 'fa-store', 'val' => '120+', 'label' => 'Usaha Aktif', 'color' => 'yellow'],
                    ['icon' => 'fa-chalkboard-teacher', 'val' => '50+', 'label' => 'Mentor Berpengalaman', 'color' => 'emerald'],
                    ['icon' => 'fa-hand-holding-dollar', 'val' => '2.5M', 'label' => 'Total Dana Terdistribusi', 'color' => 'amber'],
                ]),
                'type'    => 'json',
                'group'   => 'home_stats',
                'label'   => 'Statistics Data',
            ],

            // --- PENGUMUMAN PAGE: HERO ---
            [
                'key'     => 'pengumuman_hero_badge',
                'content' => 'Informasi',
                'type'    => 'text',
                'group'   => 'pengumuman_hero',
                'label'   => 'Hero Badge',
            ],
            [
                'key'     => 'pengumuman_hero_title',
                'content' => 'Pengumuman <span class="text-gradient">Terbaru</span>',
                'type'    => 'text',
                'group'   => 'pengumuman_hero',
                'label'   => 'Hero Title',
            ],
            [
                'key'     => 'pengumuman_hero_description',
                'content' => 'Informasi terbaru seputar Program Mahasiswa Wirausaha Politeknik Negeri Sriwijaya. Pantau terus pengumuman penting dan jadwal kegiatan.',
                'type'    => 'text',
                'group'   => 'pengumuman_hero',
                'label'   => 'Hero Description',
            ],

            // --- PENGUMUMAN PAGE: SUBSCRIBE ---
            [
                'key'     => 'pengumuman_subscribe_title',
                'content' => 'Dapatkan Notifikasi Pengumuman',
                'type'    => 'text',
                'group'   => 'pengumuman_subscribe',
                'label'   => 'Subscribe Title',
            ],
            [
                'key'     => 'pengumuman_subscribe_description',
                'content' => 'Masukkan email Anda untuk mendapatkan notifikasi langsung ketika ada pengumuman baru dari PMW Polsri.',
                'type'    => 'text',
                'group'   => 'pengumuman_subscribe',
                'label'   => 'Subscribe Description',
            ],
        ];

        $this->db->table('cms_content')->ignore(true)->insertBatch($data);
    }
}
