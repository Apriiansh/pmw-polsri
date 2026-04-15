<?php

/**
 * PMW Helper - Shared data for Jurusan and Prodi
 */

if (!function_exists('getJurusanList')) {
    /**
     * Get list of jurusan
     * @return array
     */
    function getJurusanList(): array
    {
        return [
            'Teknik Sipil',
            'Teknik Mesin',
            'Teknik Elektro',
            'Teknik Kimia',
            'Akuntansi',
            'Administrasi Bisnis',
            'Teknik Komputer',
            'Manajemen Informatika',
            'Bahasa dan Pariwisata',
            'Rekayasa Teknologi dan Bisnis Pertanian',
        ];
    }
}

if (!function_exists('getProdiList')) {
    /**
     * Get mapping of jurusan to prodi list
     * @return array
     */
    function getProdiList(): array
    {
        return [
            'Teknik Sipil' => [
                'D-III Teknik Sipil',
                'D-IV Perancangan Jalan dan Jembatan',
                'D-IV Perancangan Jalan dan Jembatan PSDKU OKU',
                'D-IV Arsitektur Bangunan Gedung'
            ],
            'Teknik Mesin' => [
                'D-III Teknik Mesin',
                'D-III Pemeliharaan Alat Berat',
                'D-IV Teknik Mesin Produksi dan Perawatan',
                'D-IV Teknik Mesin Produksi dan Perawatan PSDKU Kab. Siak Prov. Riau'
            ],
            'Teknik Elektro' => [
                'D-III Teknik Listrik',
                'D-III Teknik Elektronika',
                'D-III Teknik Telekomunikasi',
                'D-IV Teknik Elektro',
                'D-IV Teknik Telekomunikasi',
                'D-IV Teknologi Rekayasa Instalasi Listrik'
            ],
            'Teknik Kimia' => [
                'D-III Teknik Kimia',
                'D-III Teknik Kimia PSDKU Kab. Siak Prov. Riau',
                'D-IV Teknologi Kimia Industri',
                'D-IV Teknik Energi',
                'S2 Terapan/Magister Terapan: Teknik Energi Terbarukan'
            ],
            'Akuntansi' => [
                'D-III Akuntansi',
                'D-IV Akuntansi Sektor Publik',
                'D-IV Akuntansi Sektor Publik PSDKU OKU Baturaja',
                'D-IV Akuntansi Sektor Publik Kab. Siak Prov. Riau'
            ],
            'Administrasi Bisnis' => [
                'D-III Administrasi Bisnis',
                'D-III Administrasi Bisnis PSDKU OKU Baturaja',
                'D-IV Manajemen Bisnis',
                'D-IV Bisnis Digital',
                'D-IV Usaha Perjalanan Wisata',
                'S2 Pemasaran, Inovasi, dan Teknologi'
            ],
            'Teknik Komputer' => [
                'D-III Teknik Komputer',
                'D-IV Teknologi Informatika Multimedia Digital'
            ],
            'Manajemen Informatika' => [
                'D-III Manajemen Informatika',
                'D-IV Manajemen Informatika'
            ],
            'Bahasa dan Pariwisata' => [
                'D-III Bahasa Inggris',
                'D-IV Bahasa Inggris untuk Komunikasi Bisnis dan Profesional'
            ],
            'Rekayasa Teknologi dan Bisnis Pertanian' => [
                'D-III Teknologi Pangan Kampus Banyuasin',
                'D-IV Teknologi Produksi Tanaman Perkebunan',
                'D-IV Agribisnis Pangan Kampus Banyuasin',
                'D-IV Manajemen Agribisnis Kampus Banyuasin',
                'D-IV Teknologi Akuakultur',
                'D-IV Teknologi Rekayasa Pangan'
            ]
        ];
    }
}

if (!function_exists('getProdiByJurusan')) {
    /**
     * Get prodi list for specific jurusan
     * @param string $jurusan
     * @return array
     */
    function getProdiByJurusan(string $jurusan): array
    {
        $prodiList = getProdiList();
        return $prodiList[$jurusan] ?? [];
    }
}
