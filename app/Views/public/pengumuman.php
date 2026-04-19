<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="relative overflow-hidden hero-gradient hero-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-4">Informasi</p>
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-slate-900 mb-6">
                Pengumuman <span class="text-gradient">Terbaru</span>
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Informasi terbaru seputar Program Mahasiswa Wirausaha Politeknik Negeri Sriwijaya. Pantau terus pengumuman penting dan jadwal kegiatan.
            </p>
        </div>
    </div>
</section>

<!-- Announcements Section -->
<section class="py-16 lg:py-24">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">
        
        <!-- Filter Tabs -->
        <div class="flex flex-wrap gap-3 mb-10">
            <button class="ann-filter active px-5 py-2.5 rounded-full text-sm font-medium transition-all bg-sky-500 text-white shadow-md shadow-sky-200">
                Semua
            </button>
            <button class="ann-filter px-5 py-2.5 rounded-full text-sm font-medium transition-all bg-white text-slate-600 border border-slate-200 hover:border-sky-300 hover:text-sky-600">
                Penting
            </button>
            <button class="ann-filter px-5 py-2.5 rounded-full text-sm font-medium transition-all bg-white text-slate-600 border border-slate-200 hover:border-sky-300 hover:text-sky-600">
                Jadwal
            </button>
            <button class="ann-filter px-5 py-2.5 rounded-full text-sm font-medium transition-all bg-white text-slate-600 border border-slate-200 hover:border-sky-300 hover:text-sky-600">
                Prestasi
            </button>
            <button class="ann-filter px-5 py-2.5 rounded-full text-sm font-medium transition-all bg-white text-slate-600 border border-slate-200 hover:border-sky-300 hover:text-sky-600">
                Umum
            </button>
        </div>
        
        <!-- Announcements List -->
        <div class="space-y-6">
            
            <!-- Urgent Announcement -->
            <div class="announcement-card urgent">
                <div class="flex flex-col md:flex-row md:items-start gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-rose-100 flex items-center justify-center shrink-0">
                        <i class="fas fa-exclamation-circle text-rose-500 text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <span class="badge bg-rose-100 text-rose-700">
                                <i class="fas fa-exclamation mr-1"></i>Penting
                            </span>
                            <span class="text-xs text-slate-400">
                                <i class="far fa-calendar-alt mr-1"></i>14 April 2026
                            </span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-slate-800 mb-2">Pendaftaran PMW 2026 Resmi Dibuka</h3>
                        <p class="text-slate-600 mb-4 leading-relaxed">
                            Pendaftaran Program Mahasiswa Wirausaha tahun 2026 resmi dibuka mulai hari ini. Seluruh mahasiswa aktif Politeknik Negeri Sriwijaya diundang untuk mendaftarkan tim dan mengajukan proposal usaha. Deadline pengumpulan proposal hingga <strong>30 Mei 2026</strong>.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="<?= base_url('register') ?>" class="btn-primary text-sm py-2 px-4">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Daftar Sekarang
                            </a>
                            <a href="#" class="btn-ghost text-sm py-2 px-4">
                                <i class="fas fa-download mr-2"></i>
                                Panduan Pendaftaran
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Info Announcement -->
            <div class="announcement-card">
                <div class="flex flex-col md:flex-row md:items-start gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-sky-100 flex items-center justify-center shrink-0">
                        <i class="fas fa-info-circle text-sky-500 text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <span class="badge badge-sky">
                                <i class="fas fa-info mr-1"></i>Info
                            </span>
                            <span class="text-xs text-slate-400">
                                <i class="far fa-calendar-alt mr-1"></i>12 April 2026
                            </span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-slate-800 mb-2">Workshop Penulisan Proposal Bisnis</h3>
                        <p class="text-slate-600 mb-4 leading-relaxed">
                            PMW Polsri mengadakan workshop gratis untuk mahasiswa yang ingin mempelajari cara menulis proposal bisnis yang efektif. Workshop akan dilaksanakan pada <strong>20 April 2026</strong> di Aula Rektorat lantai 2.
                        </p>
                        <div class="flex flex-wrap gap-2 text-sm">
                            <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full">
                                <i class="far fa-clock mr-1"></i>09:00 - 12:00 WIB
                            </span>
                            <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full">
                                <i class="fas fa-map-marker-alt mr-1"></i>Aula Rektorat
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Success/Prestasi Announcement -->
            <div class="announcement-card success">
                <div class="flex flex-col md:flex-row md:items-start gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center shrink-0">
                        <i class="fas fa-trophy text-emerald-500 text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <span class="badge badge-emerald">
                                <i class="fas fa-trophy mr-1"></i>Prestasi
                            </span>
                            <span class="text-xs text-slate-400">
                                <i class="far fa-calendar-alt mr-1"></i>5 April 2026
                            </span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-slate-800 mb-2">Tim PMW Raih Juara di Kompetisi Startup Nasional</h3>
                        <p class="text-slate-600 mb-4 leading-relaxed">
                            Selamat kepada tim <strong>EcoPrint</strong> yang meraih Juara 2 dalam Kompetisi Startup Lingkungan tingkat Nasional yang diselenggarakan di Jakarta. Tim berhasil mengembangkan solusi percetakan ramah lingkungan berbasis daur ulang kertas.
                        </p>
                        <div class="bg-emerald-50 rounded-xl p-4">
                            <p class="text-sm text-emerald-800">
                                <i class="fas fa-users mr-2"></i>
                                <strong>Tim EcoPrint:</strong> Ahmad Rizky (Ketua), Siti Aminah, Budi Santoso
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Schedule Announcement -->
            <div class="announcement-card warning">
                <div class="flex flex-col md:flex-row md:items-start gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-yellow-100 flex items-center justify-center shrink-0">
                        <i class="fas fa-calendar-check text-yellow-600 text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <span class="badge badge-yellow">
                                <i class="fas fa-calendar mr-1"></i>Jadwal
                            </span>
                            <span class="text-xs text-slate-400">
                                <i class="far fa-calendar-alt mr-1"></i>1 April 2026
                            </span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-slate-800 mb-2">Jadwal Pitching Desk PMW 2026</h3>
                        <p class="text-slate-600 mb-4 leading-relaxed">
                            Berikut jadwal pitching desk untuk seleksi proposal PMW 2026. Peserta wajib hadir 30 menit sebelum jadwal dengan membawa materi presentasi.
                        </p>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-slate-50">
                                    <tr>
                                        <th class="text-left p-3 rounded-tl-lg">Tanggal</th>
                                        <th class="text-left p-3">Waktu</th>
                                        <th class="text-left p-3">Lokasi</th>
                                        <th class="text-left p-3 rounded-tr-lg">Batch</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <tr>
                                        <td class="p-3">15 Juli 2026</td>
                                        <td class="p-3">09:00 - 12:00</td>
                                        <td class="p-3">Ruang Meeting 1</td>
                                        <td class="p-3"><span class="badge badge-sky">Batch A</span></td>
                                    </tr>
                                    <tr>
                                        <td class="p-3">16 Juli 2026</td>
                                        <td class="p-3">13:00 - 16:00</td>
                                        <td class="p-3">Ruang Meeting 2</td>
                                        <td class="p-3"><span class="badge badge-sky">Batch B</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- General Announcement -->
            <div class="announcement-card">
                <div class="flex flex-col md:flex-row md:items-start gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-sky-100 flex items-center justify-center shrink-0">
                        <i class="fas fa-file-alt text-sky-500 text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <span class="badge badge-sky">
                                <i class="fas fa-file mr-1"></i>Umum
                            </span>
                            <span class="text-xs text-slate-400">
                                <i class="far fa-calendar-alt mr-1"></i>28 Maret 2026
                            </span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-slate-800 mb-2">Template Proposal Bisnis PMW 2026</h3>
                        <p class="text-slate-600 mb-4 leading-relaxed">
                            Template terbaru untuk penulisan proposal bisnis PMW 2026 telah dirilis. Gunakan template ini untuk memastikan format proposal sesuai standar yang ditentukan.
                        </p>
                        <a href="#" class="btn-outline text-sm py-2 px-4 inline-flex">
                            <i class="fas fa-download mr-2"></i>
                            Download Template
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- More Info -->
            <div class="announcement-card">
                <div class="flex flex-col md:flex-row md:items-start gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center shrink-0">
                        <i class="fas fa-question-circle text-purple-500 text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <span class="badge bg-purple-100 text-purple-700">
                                <i class="fas fa-question mr-1"></i>FAQ
                            </span>
                            <span class="text-xs text-slate-400">
                                <i class="far fa-calendar-alt mr-1"></i>20 Maret 2026
                            </span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-slate-800 mb-2">FAQ PMW 2026: Pertanyaan yang Sering Diajukan</h3>
                        <p class="text-slate-600 mb-4 leading-relaxed">
                            Kami telah menyusun daftar pertanyaan yang sering diajukan seputar PMW 2026. Temukan jawaban untuk pertanyaan umum tentang pendaftaran, seleksi, dan program.
                        </p>
                        <a href="#" class="btn-ghost text-sm py-2 px-4 inline-flex">
                            <i class="fas fa-book-open mr-2"></i>
                            Baca FAQ
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
        
        <!-- Pagination -->
        <div class="flex justify-center items-center gap-2 mt-12">
            <button class="w-10 h-10 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:border-sky-300 hover:text-sky-600 transition-all">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="w-10 h-10 rounded-lg bg-sky-500 text-white flex items-center justify-center font-medium">1</button>
            <button class="w-10 h-10 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 hover:border-sky-300 hover:text-sky-600 transition-all">2</button>
            <button class="w-10 h-10 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 hover:border-sky-300 hover:text-sky-600 transition-all">3</button>
            <span class="text-slate-400">...</span>
            <button class="w-10 h-10 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 hover:border-sky-300 hover:text-sky-600 transition-all">8</button>
            <button class="w-10 h-10 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:border-sky-300 hover:text-sky-600 transition-all">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- Subscribe Section -->
<section class="py-20 lg:py-32 bg-linear-to-b from-sky-50/30 to-white">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
        
        <div class="w-16 h-16 rounded-2xl bg-sky-100 flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-bell text-sky-500 text-2xl"></i>
        </div>
        
        <h2 class="font-display text-4xl font-bold text-slate-900 mb-4">
            Dapatkan Notifikasi Pengumuman
        </h2>
        <p class="text-slate-600 mb-6 max-w-xl mx-auto">
            Masukkan email Anda untuk mendapatkan notifikasi langsung ketika ada pengumuman baru dari PMW Polsri.
        </p>
        
        <form class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
            <input 
                type="email" 
                placeholder="Alamat email Anda" 
                class="flex-1 px-5 py-3 rounded-xl border border-slate-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-100 outline-none transition-all"
            >
            <button type="submit" class="btn-primary whitespace-nowrap px-6 py-3">
                <i class="fas fa-bell mr-2"></i>
                Berlangganan
            </button>
        </form>
        
        <p class="text-xs text-slate-400 mt-4">
            Kami tidak akan mengirim spam. Anda dapat berhenti berlangganan kapan saja.
        </p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-20 lg:py-24 cta-gradient cta-pattern relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative z-10">
        <h2 class="font-display text-3xl font-bold text-white mb-4">
            Ada Pertanyaan?
        </h2>
        <p class="text-lg text-sky-100 mb-8">
            Hubungi tim PMW Polsri untuk informasi lebih lanjut.
        </p>
        
        <div class="flex flex-wrap justify-center gap-6">
            <a href="mailto:pmw@polsri.ac.id" class="flex items-center gap-3 text-white hover:text-yellow-300 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <i class="fas fa-envelope text-xl"></i>
                </div>
                <div class="text-left">
                    <p class="text-sm text-sky-200">Email</p>
                    <p class="font-medium">pmw@polsri.ac.id</p>
                </div>
            </a>
            
            <a href="tel:0711353414" class="flex items-center gap-3 text-white hover:text-yellow-300 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <i class="fas fa-phone text-xl"></i>
                </div>
                <div class="text-left">
                    <p class="text-sm text-sky-200">Telepon</p>
                    <p class="font-medium">(0711) 353414</p>
                </div>
            </a>
            
            <div class="flex items-center gap-3 text-white">
                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-xl"></i>
                </div>
                <div class="text-left">
                    <p class="text-sm text-sky-200">Lokasi</p>
                    <p class="font-medium">Gedung Rektorat Lt. 1</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Filter functionality
    document.querySelectorAll('.ann-filter').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.ann-filter').forEach(b => {
                b.classList.remove('active', 'bg-sky-500', 'text-white', 'shadow-md', 'shadow-sky-200');
                b.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            });
            
            this.classList.add('active', 'bg-sky-500', 'text-white', 'shadow-md', 'shadow-sky-200');
            this.classList.remove('bg-white', 'text-slate-600', 'border', 'border-slate-200');
        });
    });
</script>
<?= $this->endSection() ?>
