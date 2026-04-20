<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section id="section-pengumuman-hero" class="relative overflow-hidden hero-gradient hero-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-4"><?= cms('pengumuman_hero_badge', 'Informasi') ?></p>
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-slate-900 mb-6">
                <?= cms('pengumuman_hero_title', 'Pengumuman <span class="text-gradient">Terbaru</span>') ?>
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                <?= cms('pengumuman_hero_description', 'Informasi terbaru seputar Program Mahasiswa Wirausaha Politeknik Negeri Sriwijaya. Pantau terus pengumuman penting dan jadwal kegiatan.') ?>
            </p>
        </div>
    </div>
</section>

<!-- Announcements Section -->
<section class="py-16 lg:py-24">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">
        
        <!-- Filter Tabs -->
        <div class="flex flex-wrap gap-3 mb-10">
            <?php 
            $categories = ['Semua', 'Penting', 'Info', 'Jadwal', 'Prestasi', 'Umum'];
            foreach ($categories as $cat):
                $isActive = $currentCategory === $cat;
            ?>
                <a href="<?= base_url('pengumuman' . ($cat === 'Semua' ? '' : '?category=' . $cat)) ?>" 
                   class="px-5 py-2.5 rounded-full text-sm font-medium transition-all <?= $isActive ? 'bg-sky-500 text-white shadow-md shadow-sky-200' : 'bg-white text-slate-600 border border-slate-200 hover:border-sky-300 hover:text-sky-600' ?>">
                    <?= $cat ?>
                </a>
            <?php endforeach; ?>
        </div>
        
        <!-- Announcements List -->
        <div class="space-y-6">
            <?php if (empty($announcements)): ?>
                <div class="bg-white rounded-[2rem] border border-slate-200 p-16 text-center shadow-xs">
                    <div class="w-20 h-20 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-6 text-slate-300">
                        <i class="fas fa-bullhorn text-3xl animate-pulse"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Pengumuman</h3>
                    <p class="text-slate-500 max-w-sm mx-auto">Saat ini belum ada pengumuman untuk kategori <strong><?= $currentCategory ?></strong>. Silakan cek kembali nanti.</p>
                </div>
            <?php else: ?>
                <?php foreach ($announcements as $ann): ?>
                    <div class="announcement-card <?= $ann['type'] === 'urgent' ? 'urgent' : ($ann['type'] === 'success' ? 'success' : ($ann['type'] === 'warning' ? 'warning' : '')) ?>">
                        <div class="flex flex-col md:flex-row md:items-start gap-6">
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center shrink-0 <?= 
                                $ann['type'] === 'urgent' ? 'bg-rose-100 text-rose-500' : (
                                $ann['type'] === 'success' ? 'bg-emerald-100 text-emerald-500' : (
                                $ann['type'] === 'warning' ? 'bg-amber-100 text-amber-500' : 'bg-sky-100 text-sky-500')) 
                            ?>">
                                <i class="fas <?= 
                                    $ann['type'] === 'urgent' ? 'fa-exclamation-circle' : (
                                    $ann['type'] === 'success' ? 'fa-trophy' : (
                                    $ann['type'] === 'warning' ? 'fa-calendar-check' : 'fa-info-circle')) 
                                ?> text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-3 mb-2">
                                    <span class="badge <?= 
                                        $ann['type'] === 'urgent' ? 'bg-rose-100 text-rose-700' : (
                                        $ann['type'] === 'success' ? 'badge-emerald' : (
                                        $ann['type'] === 'warning' ? 'badge-yellow' : 'badge-sky')) 
                                    ?>">
                                        <i class="fas <?= 
                                            $ann['type'] === 'urgent' ? 'fa-exclamation' : (
                                            $ann['type'] === 'success' ? 'fa-trophy' : (
                                            $ann['type'] === 'warning' ? 'fa-calendar' : 'fa-info')) 
                                        ?> mr-1.5"></i><?= $ann['category'] ?>
                                    </span>
                                    <span class="text-xs font-medium text-slate-400">
                                        <i class="far fa-calendar-alt mr-1.5"></i>
                                        <?= date('d F Y', strtotime($ann['date'])) ?>
                                    </span>
                                </div>
                                <a href="<?= base_url('pengumuman/' . $ann['slug']) ?>" class="group/title">
                                    <h3 class="font-display text-2xl font-bold text-slate-800 mb-3 leading-tight group-hover/title:text-sky-600 transition-colors"><?= $ann['title'] ?></h3>
                                </a>
                                <a href="<?= base_url('pengumuman/' . $ann['slug']) ?>" class="inline-flex items-center gap-2 text-xs font-black text-sky-500 uppercase tracking-widest hover:text-sky-600 transition-colors">
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Subscribe Section -->
<section id="section-pengumuman-subscribe" class="py-20 lg:py-32 bg-linear-to-b from-sky-50/30 to-white">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
        
        <div class="w-16 h-16 rounded-2xl bg-sky-100 flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-bell text-sky-500 text-2xl"></i>
        </div>
        
        <h2 class="font-display text-4xl font-bold text-slate-900 mb-4">
            <?= cms('pengumuman_subscribe_title', 'Dapatkan Notifikasi Pengumuman') ?>
        </h2>
        <p class="text-slate-600 mb-6 max-w-xl mx-auto">
            <?= cms('pengumuman_subscribe_description', 'Masukkan email Anda untuk mendapatkan notifikasi langsung ketika ada pengumuman baru dari PMW Polsri.') ?>
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
<section id="section-pengumuman-kontak" class="py-20 lg:py-24 bg-linear-to-b from-white to-sky-50 border-t border-sky-100 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative z-10">
        <h2 class="font-display text-3xl font-bold text-slate-900 mb-4">
            <?= cms('pengumuman_contact_title', 'Ada Pertanyaan?') ?>
        </h2>
        <p class="text-lg text-slate-600 mb-12">
            <?= cms('pengumuman_contact_description', 'Hubungi tim PMW Polsri untuk informasi lebih lanjut.') ?>
        </p>
        
        <div class="flex flex-wrap justify-center gap-8">
            <a href="mailto:pmw@polsri.ac.id" class="group flex items-center gap-4 p-4 rounded-2xl bg-white shadow-sm border border-slate-100 hover:border-sky-300 hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center group-hover:bg-sky-500 transition-colors">
                    <i class="fas fa-envelope text-xl text-sky-600 group-hover:text-white"></i>
                </div>
                <div class="text-left">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Email</p>
                    <p class="font-bold text-slate-900">pmw@polsri.ac.id</p>
                </div>
            </a>
            
            <a href="tel:0711353414" class="group flex items-center gap-4 p-4 rounded-2xl bg-white shadow-sm border border-slate-100 hover:border-sky-300 hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center group-hover:bg-sky-500 transition-colors">
                    <i class="fas fa-phone text-xl text-sky-600 group-hover:text-white"></i>
                </div>
                <div class="text-left">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Telepon</p>
                    <p class="font-bold text-slate-900">(0711) 353414</p>
                </div>
            </a>
            
            <div class="group flex items-center gap-4 p-4 rounded-2xl bg-white shadow-sm border border-slate-100">
                <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-xl text-amber-600"></i>
                </div>
                <div class="text-left">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Lokasi</p>
                    <p class="font-bold text-slate-900">Gedung Rektorat Lt. 1</p>
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
