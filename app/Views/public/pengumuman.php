<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section id="section-pengumuman-hero" class="relative overflow-hidden px-6 lg:px-8 pt-24 pb-20 lg:pt-28 relative z-10">
    <!-- Premium Background Elements -->
    <div class="absolute inset-0 -z-10">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-sky-500/10 rounded-full blur-[120px] animate-float"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-[120px] animate-float" style="animation-delay: -3s"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto reveal-blur">
            <p class="text-sky-500 font-bold text-sm uppercase tracking-[0.2em] mb-4"><?= cms('pengumuman_hero_badge', 'Pusat Informasi') ?></p>
            <h1 class="font-display text-5xl lg:text-7xl font-bold text-(--text-heading) mb-8 leading-tight text-shimmer">
                <?= cms_split('pengumuman_hero_title', 1, 'Pengumuman Terbaru') ?>
            </h1>
            <p class="text-xl text-(--text-body) leading-relaxed">
                <?= cms('pengumuman_hero_description', 'Pantau terus informasi strategis, jadwal kegiatan, dan prestasi gemilang dari ekosistem wirausaha Polsri.') ?>
            </p>
        </div>
    </div>
</section>

<!-- Announcements Section -->
<section class="py-16 lg:py-24">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">
        
        <!-- Filter Tabs -->
        <div class="flex flex-wrap justify-center gap-3 mb-16 reveal-blur">
            <?php 
            $categories = ['Semua', 'Penting', 'Info', 'Jadwal', 'Prestasi', 'Umum'];
            foreach ($categories as $cat):
                $isActive = $currentCategory === $cat;
            ?>
                <a href="<?= base_url('pengumuman' . ($cat === 'Semua' ? '' : '?category=' . $cat)) ?>" 
                   class="px-8 py-3 rounded-full text-sm font-bold transition-all btn-magnetic <?= $isActive ? 'bg-sky-500 text-white shadow-xl shadow-sky-200' : 'bg-white text-slate-600 border border-slate-100 hover:border-sky-300 hover:text-sky-600' ?>">
                    <?= $cat ?>
                </a>
            <?php endforeach; ?>
        </div>
        
        <!-- Announcements List -->
        <div class="space-y-8">
            <?php if (empty($announcements)): ?>
                <div class="bg-white rounded-[3rem] border border-dashed border-slate-200 p-20 text-center reveal-zoom">
                    <div class="w-24 h-24 rounded-3xl bg-slate-50 flex items-center justify-center mx-auto mb-8 text-slate-300 shadow-sm">
                        <i class="fas fa-bullhorn text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-display font-bold text-slate-800 mb-3">Belum Ada Pengumuman</h3>
                    <p class="text-slate-500 max-w-sm mx-auto">Saat ini belum ada pengumuman untuk kategori <strong><?= $currentCategory ?></strong>. Silakan cek kategori lainnya.</p>
                </div>
            <?php else: ?>
                <?php foreach ($announcements as $index => $ann): ?>
                    <div class="bg-white rounded-[2.5rem] p-8 lg:p-10 border border-slate-100 hover:border-sky-200 hover:shadow-2xl hover:shadow-sky-500/5 transition-liquid group reveal-on-scroll stagger-<?= ($index % 5) + 1 ?>">
                        <div class="flex flex-col md:flex-row md:items-center gap-8">
                            <div class="w-20 h-20 rounded-3xl flex items-center justify-center shrink-0 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-liquid <?= 
                                $ann['type'] === 'urgent' ? 'bg-linear-to-br from-rose-500 to-rose-600 text-white shadow-rose-200' : (
                                $ann['type'] === 'success' ? 'bg-linear-to-br from-emerald-500 to-emerald-600 text-white shadow-emerald-200' : (
                                $ann['type'] === 'warning' ? 'bg-linear-to-br from-amber-500 to-amber-600 text-white shadow-amber-200' : 'bg-linear-to-br from-sky-500 to-sky-600 text-white shadow-sky-200')) 
                            ?>">
                                <i class="fas <?= 
                                    $ann['type'] === 'urgent' ? 'fa-bolt' : (
                                    $ann['type'] === 'success' ? 'fa-award' : (
                                    $ann['type'] === 'warning' ? 'fa-calendar-alt' : 'fa-info-circle')) 
                                ?> text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-4 mb-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider <?= 
                                        $ann['type'] === 'urgent' ? 'bg-rose-50 text-rose-600 border border-rose-100' : (
                                        $ann['type'] === 'success' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : (
                                        $ann['type'] === 'warning' ? 'bg-amber-50 text-amber-600 border border-amber-100' : 'bg-sky-50 text-sky-600 border border-sky-100')) 
                                    ?>">
                                        <?= $ann['category'] ?>
                                    </span>
                                    <span class="text-xs font-semibold text-slate-400">
                                        <i class="far fa-calendar-alt mr-2"></i>
                                        <?= date('d M Y', strtotime($ann['date'])) ?>
                                    </span>
                                </div>
                                <a href="<?= base_url('pengumuman/' . $ann['slug']) ?>" class="block">
                                    <h3 class="font-display text-2xl lg:text-3xl font-bold text-(--text-heading) mb-4 leading-tight group-hover:text-sky-600 transition-colors"><?= $ann['title'] ?></h3>
                                </a>
                                <a href="<?= base_url('pengumuman/' . $ann['slug']) ?>" class="inline-flex items-center gap-3 text-xs font-black text-sky-500 uppercase tracking-widest hover:gap-5 transition-all">
                                    Selengkapnya
                                    <i class="fas fa-chevron-right"></i>
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
<section id="section-pengumuman-subscribe" class="py-20 lg:py-32 relative overflow-hidden">
    <!-- Blobs for depth -->
    <div class="absolute top-1/2 left-0 -translate-y-1/2 w-64 h-64 bg-sky-400/10 rounded-full blur-[100px]"></div>
    
    <div class="max-w-5xl mx-auto px-6 lg:px-8 text-center relative z-10">
        <div class="reveal-zoom glass-premium p-10 lg:p-20 rounded-[3rem] border-white/20 shadow-2xl backdrop-blur-2xl">
            <div class="w-20 h-20 rounded-3xl bg-sky-500/10 flex items-center justify-center mx-auto mb-8 shadow-inner">
                <i class="fas fa-paper-plane text-sky-500 text-3xl animate-float"></i>
            </div>
            
            <h2 class="font-display text-4xl lg:text-5xl font-bold text-(--text-heading) mb-6">
                <?= cms('pengumuman_subscribe_title', 'Update Informasi Langsung') ?>
            </h2>
            <p class="text-xl text-(--text-body) mb-10 max-w-2xl mx-auto leading-relaxed">
                <?= cms('pengumuman_subscribe_description', 'Dapatkan notifikasi pengumuman terbaru langsung di inbox Anda. Jadilah yang pertama tahu setiap perkembangan program.') ?>
            </p>
            
            <div x-data="pushNotification()" x-init="checkSubscription()" class="max-w-xl mx-auto">
                <!-- Status Notifikasi -->
                <div class="mb-10 flex items-center justify-center gap-4">
                    <template x-if="isSubscribed">
                        <div class="flex items-center gap-3 px-6 py-3 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 animate-fade-in">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                            </span>
                            <span class="text-sm font-bold uppercase tracking-widest">Notifikasi Aktif</span>
                        </div>
                    </template>
                    <template x-if="!isSubscribed && permission === 'granted'">
                        <div class="px-6 py-3 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-amber-600 animate-fade-in">
                            <span class="text-sm font-bold uppercase tracking-widest">Izin Diberikan, Belum Terdaftar</span>
                        </div>
                    </template>
                </div>

                <div class="flex flex-col gap-6 items-center">
                    <!-- Tombol Utama -->
                    <button 
                        @click="toggleSubscription"
                        :disabled="loading || !supported"
                        class="btn-primary btn-magnetic group relative px-12 py-5 text-xl shadow-2xl shadow-sky-500/20 disabled:opacity-50"
                        :class="isSubscribed ? 'bg-linear-to-r from-rose-500 to-pink-600 shadow-rose-500/20' : 'bg-linear-to-r from-sky-500 to-indigo-600 shadow-sky-500/20'"
                    >
                        <div class="flex items-center gap-4">
                            <i class="fas text-2xl" :class="loading ? 'fa-circle-notch animate-spin' : (isSubscribed ? 'fa-bell-slash' : 'fa-bell animate-float')"></i>
                            <span x-text="loading ? 'Memproses...' : (isSubscribed ? 'Matikan Notifikasi' : 'Aktifkan Notifikasi Perangkat')"></span>
                        </div>
                    </button>

                    <!-- Pesan Error/Unsupported -->
                    <p x-show="!supported" class="text-sm text-rose-500 font-bold bg-rose-50 px-4 py-2 rounded-xl">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Browser Anda tidak mendukung Web Push.
                    </p>
                </div>
            </div>

            <p class="text-sm text-slate-400 mt-10 font-medium">
                <i class="fas fa-shield-alt mr-2"></i>
                Privasi terjaga. Kami hanya mengirimkan informasi resmi program PMW.
            </p>
        </div>
    </div>
</section>

<script>
    function pushNotification() {
        return {
            supported: ('serviceWorker' in navigator) && ('PushManager' in window),
            isSubscribed: false,
            permission: Notification.permission,
            loading: false,
            registration: null,
            publicKey: 'BEndsLB-_vstDfHVtshcVgxse9AaI2ELIxYohO0BOEZcTn_pWy8EXcpiM7kUFRyqF1D1AKmQlER5mEhtIcreML4',

            async checkSubscription() {
                if (!this.supported) return;

                this.registration = await navigator.serviceWorker.register('/sw.js');
                const subscription = await this.registration.pushManager.getSubscription();
                this.isSubscribed = !!subscription;
                this.permission = Notification.permission;
            },

            async toggleSubscription() {
                this.loading = true;
                try {
                    if (this.isSubscribed) {
                        await this.unsubscribeUser();
                    } else {
                        await this.subscribeUser();
                    }
                } catch (error) {
                    console.error('Push Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat memproses notifikasi.'
                    });
                } finally {
                    this.loading = false;
                }
            },

            async subscribeUser() {
                const permission = await Notification.requestPermission();
                this.permission = permission;

                if (permission !== 'granted') {
                    throw new Error('Permission not granted');
                }

                const subscription = await this.registration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: this.urlBase64ToUint8Array(this.publicKey)
                });

                const response = await fetch('/api/push-subscribe', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(subscription)
                });

                if (response.ok) {
                    this.isSubscribed = true;
                    Swal.fire({
                        icon: 'success',
                        title: 'Notifikasi Aktif!',
                        text: 'Anda akan menerima pengumuman terbaru langsung di perangkat ini.',
                        confirmButtonText: 'Keren!',
                        customClass: { confirmButton: 'btn-primary px-8 py-3 rounded-xl' }
                    });
                }
            },

            async unsubscribeUser() {
                const subscription = await this.registration.pushManager.getSubscription();
                if (subscription) {
                    await subscription.unsubscribe();
                    
                    await fetch('/api/push-unsubscribe', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(subscription)
                    });

                    this.isSubscribed = false;
                    Swal.fire({
                        icon: 'info',
                        title: 'Notifikasi Dimatikan',
                        text: 'Anda tidak akan lagi menerima notifikasi di perangkat ini.'
                    });
                }
            },

            urlBase64ToUint8Array(base64String) {
                const padding = '='.repeat((4 - base64String.length % 4) % 4);
                const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
                const rawData = window.atob(base64);
                const outputArray = new Uint8Array(rawData.length);
                for (let i = 0; i < rawData.length; ++i) {
                    outputArray[i] = rawData.charCodeAt(i);
                }
                return outputArray;
            }
        }
    }
</script>

<!-- Contact Section -->
<section id="section-pengumuman-kontak" class="py-20 lg:py-32 bg-linear-to-b from-white to-sky-50/50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center relative z-10">
        <div class="reveal-on-scroll">
            <h2 class="font-display text-4xl lg:text-5xl font-bold text-(--text-heading) mb-6">
                <?= cms('pengumuman_contact_title', 'Ada Pertanyaan Spesifik?') ?>
            </h2>
            <p class="text-xl text-(--text-muted) mb-16 max-w-2xl mx-auto">
                <?= cms('pengumuman_contact_description', 'Tim sekretariat PMW Polsri siap membantu Anda memberikan informasi yang Anda butuhkan.') ?>
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="reveal-on-scroll stagger-1">
                <a href="mailto:pmw@polsri.ac.id" class="group flex flex-col items-center p-10 rounded-[2.5rem] bg-white shadow-sm border border-slate-100 hover:border-sky-300 hover:shadow-2xl transition-liquid">
                    <div class="w-20 h-20 rounded-3xl bg-sky-50 flex items-center justify-center mb-6 group-hover:bg-sky-500 transition-liquid shadow-inner">
                        <i class="fas fa-envelope text-3xl text-sky-600 group-hover:text-white transition-liquid"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-2">Hubungi Melalui Email</p>
                    <p class="text-xl font-bold text-slate-900">pmw@polsri.ac.id</p>
                </a>
            </div>
            
            <div class="reveal-on-scroll stagger-2">
                <a href="https://www.instagram.com/entrepreneurpolsri/" target="_blank" rel="noopener noreferrer" class="group flex flex-col items-center p-10 rounded-[2.5rem] bg-white shadow-sm border border-slate-100 hover:border-sky-300 hover:shadow-2xl transition-liquid">
                    <div class="w-20 h-20 rounded-3xl bg-pink-50 flex items-center justify-center mb-6 group-hover:bg-pink-500 transition-liquid shadow-inner">
                        <i class="fab fa-instagram text-3xl text-pink-600 group-hover:text-white transition-liquid"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-2">Ikuti Instagram</p>
                    <p class="text-xl font-bold text-slate-900">@entrepreneurpolsri</p>
                </a>
            </div>
            
            <div class="reveal-on-scroll stagger-3">
                <div class="group flex flex-col items-center p-10 rounded-[2.5rem] bg-white shadow-sm border border-slate-100 hover:border-sky-300 hover:shadow-2xl transition-liquid">
                    <div class="w-20 h-20 rounded-3xl bg-amber-50 flex items-center justify-center mb-6 group-hover:bg-amber-500 transition-liquid shadow-inner">
                        <i class="fas fa-map-marker-alt text-3xl text-amber-600 group-hover:text-white transition-liquid"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-2">UPAPKK POLSRI</p>
                    <p class="text-xl font-bold text-slate-900">Gedung KPA Lt. 1</p>
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
