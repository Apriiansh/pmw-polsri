<?= $this->extend('layouts/public') ?>

<?= $this->section('content') ?>

<style>
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 1.25rem;
        background: #f1f5f9;
        cursor: pointer;

        /* Semua item (small) punya fixed height */
        min-height: 200px;
    }

    /* Large item: 2x tingginya */
    .gallery-item.is-large {
        min-height: 412px; /* (200px * 2) + gap 12px */
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gallery-item:hover img {
        transform: scale(1.08) rotate(1deg);
    }

    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 23, 42, 0.88) 0%, rgba(15, 23, 42, 0.3) 55%, transparent 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1.25rem;
        opacity: 0;
        transition: opacity 0.35s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay .overlay-content {
        transform: translateY(12px);
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .gallery-item:hover .gallery-overlay .overlay-content {
        transform: translateY(0);
    }
</style>

<!-- Hero Section -->
<section id="section-galeri-hero" class="relative overflow-hidden hero-gradient hero-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 lg:py-28">
        <div class="text-center max-w-3xl mx-auto">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-4">
                <?= cms('galeri_hero_badge', 'Dokumentasi') ?>
            </p>
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-slate-900 mb-6">
                <?= cms('galeri_hero_title', 'Galeri <span class="text-gradient">Kegiatan</span>') ?>
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                <?= cms('galeri_hero_description', 'Momen-momen berkesan dari Program Mahasiswa Wirausaha Polsri. Lihat aktivitas mentoring, pitching, bazaar, dan awarding.') ?>
            </p>
        </div>
    </div>
</section>

<!-- Gallery Grid & Filter -->
<?php
$rawItems = cms('galeri_items_list', []);

if (empty($rawItems)) {
    $rawItems = [
        ['img' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80',  'badge' => 'Mentoring 2025', 'title' => 'Sesi Mentoring Intensif',     'desc' => 'Dosen dan mentor berbagi pengalaman.'],
        ['img' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=600&q=80',  'badge' => 'Pitching',       'title' => 'Pitching Desk 2025',         'desc' => 'Presentasi ide bisnis di depan reviewer.'],
        ['img' => 'https://images.unsplash.com/photo-1531058020387-3be344556be6?w=600&q=80','badge' => 'Awarding',       'title' => 'Awarding 2024',              'desc' => 'Malam penganugerahan bagi tim terbaik.'],
        ['img' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=600&q=80',  'badge' => 'Workshop',       'title' => 'Workshop Business Plan',     'desc' => 'Pelatihan menyusun strategi bisnis.'],
        ['img' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?w=600&q=80','badge' => 'Bazaar',         'title' => 'Bazaar Monev 2025',          'desc' => 'Pameran produk peserta PMW.'],
        ['img' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800&q=80','badge' => 'Mentoring',      'title' => 'Coaching Clinic 2025',       'desc' => 'Konsultasi teknis pengembangan produk.'],
        ['img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&q=80',  'badge' => 'Workshop',       'title' => 'Digital Marketing Class',    'desc' => 'Strategi pemasaran di era digital.'],
        ['img' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&q=80','badge' => 'Dokumentasi',    'title' => 'Kunjungan Industri',         'desc' => 'Melihat langsung proses produksi.'],
        ['img' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&q=80','badge' => 'Mentoring',      'title' => 'Team Building Session',      'desc' => 'Memperkuat kolaborasi internal tim.'],
        ['img' => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?w=800&q=80','badge' => 'Bazaar',         'title' => 'Expo Kewirausahaan 2024',    'desc' => 'Puncak acara pameran bisnis mahasiswa.'],
        ['img' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=600&q=80','badge' => 'Workshop',       'title' => 'Financial Literacy',         'desc' => 'Manajemen keuangan untuk UMKM.'],
        ['img' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=600&q=80','badge' => 'Pitching',       'title' => 'Internal Review Stage 1',    'desc' => 'Evaluasi awal proposal bisnis.'],
        ['img' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=600&q=80','badge' => 'Awarding',       'title' => 'Sertifikasi Peserta',        'desc' => 'Penyerahan sertifikat kelulusan program.'],
        ['img' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=600&q=80','badge' => 'Dokumentasi',    'title' => 'Rapat Koordinasi Mentor',    'desc' => 'Penyelarasan kurikulum pembinaan.'],
        ['img' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=800&q=80','badge' => 'Mentoring',      'title' => 'One-on-One Mentoring',       'desc' => 'Sesi privat dengan pakar bisnis.'],
        ['img' => 'https://images.unsplash.com/photo-1491975474562-1f4e30bc9468?w=600&q=80',  'badge' => 'Mentoring',      'title' => 'Legalitas Usaha',            'desc' => 'Pengurusan izin dan HAKI.'],
        ['img' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=800&q=80','badge' => 'Pitching',       'title' => 'Final Presentation',         'desc' => 'Penentuan pemenang hibah tahap 2.'],
        ['img' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&q=80','badge' => 'Awarding',       'title' => 'Penyaluran Dana Hibah',      'desc' => 'Simbolis penyerahan dana pengembangan.'],
    ];
}

// Resolve image URLs server-side (bukan di Alpine) supaya cms_img() bisa dipanggil
$items = array_map(function ($item) {
    $item['preview_img'] = cms_img($item['img']);
    // Buang field 'size' dari data lama — layout sekarang diatur Alpine
    unset($item['size']);
    return $item;
}, $rawItems);
?>

<section id="section-galeri-grid" class="py-12 lg:py-24"
    x-data='{
        activeFilter: "Semua",
        visibleCount: 10,
        items: <?= json_encode($items) ?>,

        get filteredItems() {
            if (this.activeFilter === "Semua") return this.items;
            return this.items.filter(item =>
                item.badge && item.badge.toLowerCase().includes(this.activeFilter.toLowerCase())
            );
        },

        get layoutItems() {
            return this.filteredItems.slice(0, this.visibleCount).map((item, i) => {
                const blockNum  = Math.floor(i / 5);
                const posInBlock = i % 5;
                // Genap → large di posisi 0, Ganjil → large di posisi 2
                const largeAt = blockNum % 2 === 0 ? 0 : 2;
                return { ...item, isLarge: posInBlock === largeAt };
            });
        },

        get hasMore() {
            return this.visibleCount < this.filteredItems.length;
        },

        changeFilter(f) {
            this.activeFilter = f;
            this.visibleCount = 10; // Reset ke default saat filter berubah
        }
    }'>

    <!-- Filter Buttons -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-10">
        <div class="flex flex-wrap justify-center gap-3">
            <template x-for="filter in ['Semua', 'Mentoring', 'Pitching', 'Bazaar', 'Awarding', 'Workshop', 'Dokumentasi']" :key="filter">
                <button @click="changeFilter(filter)"
                        :class="activeFilter === filter
                            ? 'bg-sky-500 text-white shadow-md shadow-sky-200'
                            : 'bg-white text-slate-600 border border-slate-200 hover:border-sky-300 hover:text-sky-600'"
                        class="px-5 py-2.5 rounded-full text-sm font-medium transition-all"
                        x-text="filter">
                </button>
            </template>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!--
            Grid 4 kolom, dense flow.
            Setiap item mendapat class col-span-2 row-span-2 kalau isLarge = true.
            Dense filling memastikan small item mengisi gap di samping large.
        -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 auto-rows-[200px] mb-12"
             style="grid-auto-flow: dense;">

            <template x-for="(item, index) in layoutItems" :key="index">
                <div class="gallery-item"
                     :class="item.isLarge ? 'col-span-2 row-span-2 is-large' : ''"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">

                    <img :src="item.preview_img" :alt="item.title" loading="lazy">

                    <div class="gallery-overlay">
                        <div class="overlay-content">
                            <span class="badge badge-sky mb-2 w-fit text-xs" x-text="item.badge"></span>
                            <p class="text-white font-semibold leading-snug"
                               :class="item.isLarge ? 'text-base' : 'text-sm'"
                               x-text="item.title"></p>
                            <template x-if="item.desc && item.isLarge">
                                <p class="text-slate-100 text-xs mt-1" x-text="item.desc"></p>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty State -->
        <template x-if="filteredItems.length === 0">
            <div class="text-center py-20 bg-slate-50 rounded-3xl border border-dashed border-slate-200 mt-4">
                <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <i class="fas fa-images text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">Tidak ada dokumentasi</h3>
                <p class="text-slate-500 text-sm">Belum ada foto untuk kategori ini.</p>
                <button @click="changeFilter('Semua')" class="mt-4 px-5 py-2 rounded-full bg-sky-100 text-sky-700 text-sm font-semibold hover:bg-sky-200 transition-all">
                    Lihat semua foto
                </button>
            </div>
        </template>

        <!-- Load More -->
        <div class="text-center mt-16" x-show="hasMore" x-transition>
            <button @click="visibleCount += 10" class="btn-outline">
                <i class="fas fa-plus-circle mr-2"></i>
                Muat Lebih Banyak
                <span class="ml-1 text-xs opacity-60" x-text="'(' + (filteredItems.length - visibleCount) + ' lagi)'"></span>
            </button>
        </div>
    </div>
</section>

<!-- Video Section -->
<section class="py-20 lg:py-32 bg-linear-to-b from-sky-50/30 to-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-12">
            <p class="text-sky-500 font-semibold text-sm uppercase tracking-wider mb-3">Video</p>
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-slate-900 mb-4">
                Dokumentasi <span class="text-gradient">Video</span>
            </h2>
            <p class="text-slate-600">
                Tonton video highlight dan testimonial dari program PMW.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            <?php
            $videos = [
                ['thumb' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=600&q=80', 'badge' => 'badge-sky',     'badge_label' => 'Highlight',    'title' => 'PMW 2024 Highlight',    'meta' => '3:45 menit • 1.2K views'],
                ['thumb' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=600&q=80', 'badge' => 'badge-yellow',  'badge_label' => 'Testimonial',  'title' => 'Cerita Sukses Alumni',  'meta' => '5:20 menit • 890 views'],
                ['thumb' => 'https://images.unsplash.com/photo-1531058020387-3be344556be6?w=600&q=80','badge' => 'badge-emerald', 'badge_label' => 'Tutorial',     'title' => 'Tips Menulis Proposal', 'meta' => '8:15 menit • 2.1K views'],
            ];
            ?>

            <?php foreach ($videos as $video): ?>
            <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-sky-100 group cursor-pointer hover:-translate-y-1 transition-all duration-300">
                <div class="relative aspect-video overflow-hidden">
                    <img src="<?= $video['thumb'] ?>" alt="<?= esc($video['title']) ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center group-hover:bg-black/40 transition-all">
                        <div class="w-14 h-14 rounded-full bg-white/90 backdrop-blur flex items-center justify-center group-hover:scale-110 transition-transform shadow-xl">
                            <i class="fas fa-play text-sky-500 text-lg ml-1"></i>
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <span class="badge <?= $video['badge'] ?> mb-2"><?= esc($video['badge_label']) ?></span>
                    <h3 class="font-display text-base font-bold text-slate-900 mb-1"><?= esc($video['title']) ?></h3>
                    <p class="text-xs text-slate-500"><?= esc($video['meta']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<?= $this->endSection() ?>