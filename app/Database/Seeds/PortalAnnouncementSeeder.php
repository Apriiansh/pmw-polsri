<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Files\File;

class PortalAnnouncementSeeder extends Seeder
{
    public function run()
    {
        // 1. Clean up old data
        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');
        $this->db->table('announcement_attachments')->truncate();
        $this->db->table('portal_announcements')->truncate();
        $this->db->query('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Clean up physical files
        $uploadDir = FCPATH . 'uploads/announcements/';
        if (is_dir($uploadDir)) {
            $this->deleteDirectory($uploadDir);
        }
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // 3. Prepare HTML Content (Quill compatible format)
        $content1 = '<h1>Panduan Pendaftaran PMW 2026</h1>' .
                    '<p>Selamat datang calon wirausahawan muda Polsri! Berikut adalah panduan singkat mengenai tata cara pendaftaran:</p>' .
                    '<ol>' .
                    '<li>Login menggunakan akun mahasiswa aktif.</li>' .
                    '<li>Pilih menu \'Pendaftaran\' di dashboard.</li>' .
                    '<li>Isi detail tim dan judul proposal.</li>' .
                    '<li>Unggah proposal dalam format PDF.</li>' .
                    '</ol>' .
                    '<p>Informasi lebih lanjut dapat dilihat pada buku panduan yang tersedia.</p>';

        $content2 = '<h1>PENGUMUMAN PENTING: Perubahan Jadwal</h1>' .
                    '<p><strong>Diberitahukan kepada seluruh peserta,</strong></p>' .
                    '<p>Terjadi perubahan jadwal sesi sosialisasi yang semula tanggal 25 April menjadi ' .
                    '<strong><em><u>27 April 2026</u></em></strong> pukul 09.00 WIB melalui Zoom Meeting.</p>' .
                    '<p>Link zoom akan dikirimkan melalui email masing-masing ketua tim.</p>';

        $data = [
            [
                'title'        => 'Panduan Pendaftaran PMW 2026',
                'slug'         => 'panduan-pendaftaran-pmw-2026',
                'category'     => 'Info',
                'type'         => 'normal',
                'content'      => $content1,
                'date'         => date('Y-m-d'),
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'title'        => 'PENGUMUMAN PENTING: Perubahan Jadwal Sosialisasi',
                'slug'         => 'perubahan-jadwal-sosialisasi',
                'category'     => 'Jadwal',
                'type'         => 'urgent',
                'content'      => $content2,
                'date'         => date('Y-m-d'),
                'is_published' => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]
        ];

        // 4. Insert fresh data
        $this->db->table('portal_announcements')->insertBatch($data);

        echo "Seeder Berhasil: Data dibersihkan dan diisi ulang dengan format HTML.\n";
    }

    private function deleteDirectory($dir) {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) return false;
        }
        return rmdir($dir);
    }
}
