<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="relative overflow-hidden hero-gradient hero-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-4">Alur Program</p>
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-(--text-heading)] mb-6">
                Tahapan <span class="text-gradient">Program PMW</span>
            </h1>
            <p class="text-lg text-(--text-body)] leading-relaxed">
                Program Mahasiswa Wirausaha terdiri dari 11 tahapan yang harus dilalui peserta mulai dari pendaftaran hingga Awarding & Expo Kewirausahaan.
            </p>
        </div>
    </div>
</section>

<!-- Timeline Section -->
<section class="py-20 lg:py-32">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        
        <!-- Timeline -->
        <div class="relative">
            
            <!-- Step 1 -->
            <div class="timeline-item">
                <div class="timeline-dot active"></div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-sky">Tahap 1</span>
                        <span class="text-xs text-slate-400"><i class="far fa-calendar mr-1"></i>Mei - Juni</span>
                    </div>
                    <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Pendaftaran PMW</h3>
                    <p class="text-(--text-body)] mb-4">
                        Mahasiswa mendaftarkan tim melengkapi formulir pendaftaran dan mengunggah proposal bisnis yang telah disusun sesuai format panduan.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Formulir Pendaftaran</span>
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Proposal Bisnis</span>
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">CV Tim</span>
                    </div>
                </div>
            </div>
            
            <!-- Step 2 -->
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-sky">Tahap 2</span>
                        <span class="text-xs text-slate-400"><i class="far fa-calendar mr-1"></i>Juni</span>
                    </div>
                    <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Seleksi Administrasi</h3>
                    <p class="text-(--text-body)] mb-4">
                        Tim Admin PMW melakukan pemeriksaan kelengkapan dokumen dan syarat administrasi peserta. Peserta yang lolos lanjut ke tahap pitching.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Cek Kelengkapan</span>
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Verifikasi Status</span>
                    </div>
                </div>
            </div>
            
            <!-- Step 3 -->
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-sky">Tahap 3</span>
                        <span class="text-xs text-slate-400"><i class="far fa-calendar mr-1"></i>Juli</span>
                    </div>
                    <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Seleksi Pitching Desk</h3>
                    <p class="text-(--text-body)] mb-4">
                        Presentasi singkat 5-10 menit di depan panel reviewer. Peserta menjelaskan konsep bisnis, target pasar, dan keunggulan produk/jasa.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Presentasi 10 Menit</span>
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Q&A Session</span>
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Penilaian Awal</span>
                    </div>
                </div>
            </div>
            
            <!-- Step 4 -->
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-sky">Tahap 4</span>
                        <span class="text-xs text-slate-400"><i class="far fa-calendar mr-1"></i>Juli - Agustus</span>
                    </div>
                    <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Wawancara Perjanjian Implementasi</h3>
                    <p class="text-(--text-body)] mb-4">
                        Wawancara mendalam dengan Dosen dan Mentor. Pembahasan rencana implementasi bisnis, MoU pelaksanaan, dan penentuan tim pendamping.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Wawancara Detail</span>
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">MoU Digital</span>
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Penetapan Mentor</span>
                    </div>
                </div>
            </div>
            
            <!-- Step 5 -->
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-sky">Tahap 5</span>
                        <span class="text-xs text-slate-400"><i class="far fa-calendar mr-1"></i>Agustus</span>
                    </div>
                    <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Seleksi Substansi Proposal</h3>
                    <p class="text-(--text-body)] mb-4">
                        Review teknis dan substansi proposal oleh panel ahli. Penilaian mendalam aspek bisnis model, financial projection, dan feasibility study.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Review Teknis</span>
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Scoring Proposal</span>
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Revisi Jika Diperlukan</span>
                    </div>
                </div>
            </div>
            
            <!-- Step 6 -->
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-yellow">Tahap 6</span>
                        <span class="text-xs text-slate-400"><i class="far fa-calendar mr-1"></i>September</span>
                    </div>
                    <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Pengumuman Kelolosan Dana PMW Tahap I</h3>
                    <p class="text-(--text-body)] mb-4">
                        Pengumuman peserta yang lolos menerima dana tahap I. Pembekalan administrasi, penandatanganan perjanjian, dan proses pencairan dana.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full">Pengumuman Resmi</span>
                        <span class="text-xs bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full">Pencairan Dana I</span>
                    </div>
                </div>
            </div>
            
            <!-- Step 7 -->
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-sky">Tahap 7</span>
                        <span class="text-xs text-slate-400"><i class="far fa-calendar mr-1"></i>September - Desember</span>
                    </div>
                    <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Pembekalan, Mentoring, dan Pelatihan</h3>
                    <p class="text-(--text-body)] mb-4">
                        Pelatihan kewirausahaan, administrasi, dan keuangan bisnis. Sesi mentoring intensif dengan Dosen dan Mentor. Log bimbingan wajib minimal 4x per bulan.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Workshop Series</span>
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Mentoring Intensif</span>
                        <span class="text-xs bg-sky-50 text-sky-700 px-3 py-1 rounded-full">Log Bimbingan</span>
                    </div>
                </div>
            </div>
            
            <!-- Step 8 -->
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-emerald">Tahap 8</span>
                        <span class="text-xs text-slate-400"><i class="far fa-calendar mr-1"></i>Oktober</span>
                    </div>
                    <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Monitoring & Evaluasi Tahap I (Bazar Hasil Implementasi)</h3>
                    <p class="text-(--text-body)] mb-4">
                        Evaluasi awal pertengahan program melalui bazar publik. Peserta menampilkan produk/jasa, melakukan transaksi nyata, dan mengumpulkan feedback pasar.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full">Bazar Publik</span>
                        <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full">Laporan Awal</span>
                        <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full">Feedback Reviewer</span>
                    </div>
                </div>
            </div>
            
            <!-- Step 9 -->
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-emerald">Tahap 9</span>
                        <span class="text-xs text-slate-400"><i class="far fa-calendar mr-1"></i>November</span>
                    </div>
                    <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Monitoring & Evaluasi Tahap II (Kunjungan ke Lokasi Usaha)</h3>
                    <p class="text-(--text-body)] mb-4">
                        Evaluasi lapangan dengan kunjungan langsung ke lokasi usaha. Reviewer, Dosen, dan Mentor melihat operasional bisnis secara nyata.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full">Site Visit</span>
                        <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full">Checklist Lapangan</span>
                        <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full">Laporan Akhir</span>
                    </div>
                </div>
            </div>
            
            <!-- Step 10 -->
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-sky-100">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-yellow">Tahap 10</span>
                        <span class="text-xs text-slate-400"><i class="far fa-calendar mr-1"></i>Desember</span>
                    </div>
                    <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Pengumuman Kelolosan Dana PMW Tahap II</h3>
                    <p class="text-(--text-body)] mb-4">
                        Pengumuman final penerima dana tahap II. Evaluasi komprehensif seluruh progress, pengelolaan dana, dan capaian target yang telah ditetapkan.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full">Evaluasi Final</span>
                        <span class="text-xs bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full">Pencairan Dana II</span>
                    </div>
                </div>
            </div>
            
            <!-- Step 11 -->
            <div class="timeline-item">
                <div class="timeline-dot completed"></div>
                <div class="bg-linear-to-br from-sky-50 to-emerald-50 rounded-2xl p-6 shadow-sm border border-sky-200">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-emerald">Tahap 11</span>
                        <span class="text-xs text-slate-400"><i class="far fa-calendar mr-1"></i>Desember</span>
                    </div>
                    <h3 class="font-display text-xl font-bold text-(--text-heading)] mb-2">Awarding PMW & Expo Kewirausahaan</h3>
                    <p class="text-(--text-body)] mb-4">
                        Puncak program dengan penghargaan untuk tim terbaik dan pameran eksklusif hasil karya peserta PMW. Sertifikat penyelesaan program dan networking dengan stakeholder.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full">Awarding Ceremony</span>
                        <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full">Expo Peserta</span>
                        <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full">Sertifikat</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Registration Flow -->
<section class="py-20 lg:py-32 bg-linear-to-b from-white to-sky-50/30">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Alur Pendaftaran</p>
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading)] mb-4">
                Bagaimana Cara <span class="text-gradient">Mendaftar</span>
            </h2>
            <p class="text-(--text-muted)]">
                Ikuti langkah-langkah berikut untuk mendaftar Program Mahasiswa Wirausaha Polsri.
            </p>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="relative bg-white rounded-xl p-6 shadow-sm border border-sky-100">
                <div class="absolute -top-4 -left-2 w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center font-bold text-lg shadow-lg">1</div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2 mt-2">Registrasi Akun</h3>
                <p class="text-sm text-(--text-muted)]">
                    Buat akun di sistem PMW Polsri dengan email kampus. Verifikasi email untuk mengaktifkan akun.
                </p>
            </div>
            
            <div class="relative bg-white rounded-xl p-6 shadow-sm border border-sky-100">
                <div class="absolute -top-4 -left-2 w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center font-bold text-lg shadow-lg">2</div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2 mt-2">Pilih Kategori</h3>
                <p class="text-sm text-(--text-muted)]">
                    Tentukan kategori PMW sesuai kondisi usaha Anda: Usaha Pemula atau Usaha Berkembang.
                </p>
            </div>
            
            <div class="relative bg-white rounded-xl p-6 shadow-sm border border-sky-100">
                <div class="absolute -top-4 -left-2 w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center font-bold text-lg shadow-lg">3</div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2 mt-2">Lengkapi Data Tim</h3>
                <p class="text-sm text-(--text-muted)]">
                    Masukkan profil seluruh anggota tim beserta skill dan role masing-masing dalam usaha.
                </p>
            </div>
            
            <div class="relative bg-white rounded-xl p-6 shadow-sm border border-sky-100">
                <div class="absolute -top-4 -left-2 w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center font-bold text-lg shadow-lg">4</div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2 mt-2">Upload Proposal</h3>
                <p class="text-sm text-(--text-muted)]">
                    Unggah proposal usaha dalam format PDF sesuai template yang diberikan.
                </p>
            </div>
            
            <div class="relative bg-white rounded-xl p-6 shadow-sm border border-sky-100">
                <div class="absolute -top-4 -left-2 w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center font-bold text-lg shadow-lg">5</div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2 mt-2">Seleksi & Wawancara</h3>
                <p class="text-sm text-(--text-muted)]">
                    Tim akan dinilai dan diwawancarai. Ikuti seluruh tahapan seleksi dengan persiapan matang.
                </p>
            </div>
            
            <div class="relative bg-linear-to-br from-emerald-50 to-sky-50 rounded-xl p-6 shadow-sm border border-emerald-200">
                <div class="absolute -top-4 -left-2 w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-lg shadow-lg">6</div>
                <h3 class="font-display text-lg font-bold text-(--text-heading)] mb-2 mt-2">Implementasi & Evaluasi</h3>
                <p class="text-sm text-(--text-muted)]">
                    Peserta terpilih akan mengikuti seluruh program implementasi hingga evaluasi akhir.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Important Dates -->
<section class="py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            
            <div>
                <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Timeline Penting</p>
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-(--text-heading)] mb-6">
                    Jadwal Program <span class="text-gradient">2026</span>
                </h2>
                <p class="text-(--text-body)] mb-8 leading-relaxed">
                    Pastikan Anda mencatat tanggal-tanggal penting dalam program PMW 2026. Setiap tahapan memiliki deadline yang harus dipatuhi.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-4 bg-rose-50 rounded-xl border border-rose-100">
                        <div class="w-14 h-14 rounded-xl bg-rose-100 flex items-center justify-center shrink-0">
                            <span class="text-rose-600 font-bold text-sm text-center">MEI<br>15</span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Dibuka Pendaftaran</p>
                            <p class="text-sm text-slate-500">Registrasi dan upload proposal dimulai</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4 p-4 bg-yellow-50 rounded-xl border border-yellow-100">
                        <div class="w-14 h-14 rounded-xl bg-yellow-100 flex items-center justify-center shrink-0">
                            <span class="text-yellow-700 font-bold text-sm text-center">MEI<br>30</span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Deadline Pendaftaran</p>
                            <p class="text-sm text-slate-500">Tutup pendaftaran batch tahun 2026</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4 p-4 bg-sky-50 rounded-xl border border-sky-100">
                        <div class="w-14 h-14 rounded-xl bg-sky-100 flex items-center justify-center shrink-0">
                            <span class="text-sky-600 font-bold text-sm text-center">JUL<br>15</span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Pitching Desk</p>
                            <p class="text-sm text-slate-500">Presentasi di depan panel reviewer</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4 p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                        <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                            <span class="text-emerald-600 font-bold text-sm text-center">DES<br>20</span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">Awarding & Expo</p>
                            <p class="text-sm text-slate-500">Puncak program dan penghargaan</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <div class="rounded-2xl overflow-hidden shadow-xl">
                    <img 
                        src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&q=80" 
                        alt="Calendar planning" 
                        class="w-full h-auto object-cover aspect-4/3"
                    >
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 lg:py-24 cta-gradient cta-pattern relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative z-10">
        <h2 class="font-display text-3xl lg:text-4xl font-bold text-white mb-6">
            Siap Mengikuti Tahapan PMW?
        </h2>
        <p class="text-lg text-sky-100 mb-8">
            Daftarkan tim Anda sekarang dan mulai perjalanan kewirausahaan.
        </p>
        <a href="<?= base_url('daftar') ?>" class="btn-accent text-base px-8 py-4">
            <i class="fas fa-paper-plane mr-2"></i>
            Daftar Sekarang
        </a>
    </div>
</section>

<?= $this->endSection() ?>
