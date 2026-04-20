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
<section id="section-galeri-hero" class="relative overflow-hidden pt-32 pb-20 lg:pt-48 lg:pb-32">
    <!-- Premium Background Elements -->
    <div class="absolute inset-0 -z-10">
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-sky-500/10 rounded-full blur-[120px] animate-float"></div>
        <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-[120px] animate-float" style="animation-delay: -3s"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto reveal-blur">
            <p class="text-sky-500 font-bold text-sm uppercase tracking-[0.2em] mb-4">
                <?= cms('galeri_hero_badge', 'Dokumentasi') ?>
            </p>
            <h1 class="font-display text-5xl lg:text-7xl font-bold text-(--text-heading) mb-8 leading-tight">
                Galeri <span class="text-gradient text-shimmer">Kegiatan</span>
            </h1>
            <p class="text-xl text-(--text-body) leading-relaxed">
                <?= cms('galeri_hero_description', 'Momen-momen inspiratif dari perjalanan wirausaha mahasiswa Polsri. Dari ide kreatif hingga realisasi bisnis yang nyata.') ?>
            </p>
        </div>
    </div>
</section>

<!-- Gallery Grid & Filter -->
<?php
$items = [];

if (!empty($galleries)) {
    foreach ($galleries as $g) {
        $imgUrl = (filter_var($g['image_url'], FILTER_VALIDATE_URL)) 
                  ? $g['image_url'] 
                  : base_url($g['image_url']);
                  
        $items[] = [
            'img'   => $imgUrl,
            'badge' => $g['category'],
            'title' => $g['title'],
            'desc'  => $g['description']
        ];
    }
} else {
    // Fallback static items if DB is empty
    $items = [
        ['img' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800&q=80',  'badge' => 'Mentoring', 'title' => 'Sesi Mentoring Intensif',     'desc' => 'Dosen dan mentor berbagi pengalaman.'],
        ['img' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=600&q=80',  'badge' => 'Pitching',  'title' => 'Pitching Desk 2025',         'desc' => 'Presentasi ide bisnis di depan reviewer.'],
        ['img' => 'https://images.unsplash.com/photo-1531058020387-3be344556be6?w=600&q=80', 'badge' => 'Awarding',  'title' => 'Awarding 2024',              'desc' => 'Malam penganugerahan bagi tim terbaik.'],
    ];
}

// Map for preview
$items = array_map(function ($item) {
    $item['preview_img'] = $item['img'];
    return $item;
}, $items);
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
                const largeAt = blockNum % 2 === 0 ? 0 : 2;
                return { ...item, isLarge: posInBlock === largeAt };
            });
        },

        get hasMore() {
            return this.visibleCount < this.filteredItems.length;
        },

        changeFilter(f) {
            this.activeFilter = f;
            this.visibleCount = 10;
        }
    }'>

    <!-- Filter Buttons -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-16 reveal-blur">
        <div class="flex flex-wrap justify-center gap-3">
            <template x-for="filter in ['Semua', 'Mentoring', 'Pitching', 'Bazaar', 'Awarding', 'Workshop', 'Dokumentasi', 'Produk Binaan']" :key="filter">
                <button @click="changeFilter(filter)"
                        :class="activeFilter === filter
                            ? 'bg-sky-500 text-white shadow-xl shadow-sky-200'
                            : 'text-slate-600 bg-white border border-slate-100 hover:border-sky-300 hover:text-sky-600'"
                        class="px-8 py-3 rounded-full text-sm font-bold transition-all btn-magnetic"
                        x-text="filter">
                </button>
            </template>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Grid with Dense Flow -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 auto-rows-[220px] mb-16"
             style="grid-auto-flow: dense;">

            <template x-for="(item, i) in layoutItems" :key="i">
                <div class="gallery-item group relative overflow-hidden rounded-[2rem] bg-slate-100 cursor-pointer"
                     :class="item.isLarge ? 'col-span-2 row-span-2 is-large' : ''"
                     x-show="true"
                     x-transition:enter="transition-liquid duration-700"
                     x-transition:enter-start="opacity-0 scale-90 translate-y-10"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0">

                    <img :src="item.preview_img" 
                         :alt="item.title" 
                         loading="lazy"
                         class="w-full h-full object-cover transition-liquid group-hover:scale-110 group-hover:rotate-1">

                    <div class="gallery-overlay absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-liquid flex flex-col justify-end p-6 lg:p-8">
                        <div class="overlay-content translate-y-4 group-hover:translate-y-0 transition-liquid delay-75">
                            <span class="inline-block px-3 py-1 rounded-full bg-sky-500/20 border border-sky-400/30 backdrop-blur-md text-sky-300 text-[10px] font-bold uppercase tracking-wider mb-3" x-text="item.badge"></span>
                            <h3 class="!text-white font-display font-black leading-tight drop-shadow-md"
                               :class="item.isLarge ? 'text-2xl mb-2' : 'text-sm'"
                               x-text="item.title"></h3>
                            <template x-if="item.desc && item.isLarge">
                                <p class="text-slate-200 text-sm line-clamp-2 drop-shadow-sm" x-text="item.desc"></p>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty State -->
        <template x-if="filteredItems.length === 0">
            <div class="text-center py-32 bg-slate-50 rounded-[3rem] border border-dashed border-slate-200 mt-4 reveal-zoom">
                <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-300 shadow-sm">
                    <i class="fas fa-images text-3xl"></i>
                </div>
                <h3 class="text-2xl font-display font-bold text-slate-800 mb-2">Tidak ada dokumentasi</h3>
                <p class="text-slate-500 max-w-sm mx-auto mb-8">Belum ada foto untuk kategori ini. Kami akan segera memperbaruinya.</p>
                <button @click="changeFilter('Semua')" class="btn-ghost btn-magnetic">
                    Lihat semua foto
                </button>
            </div>
        </template>

        <!-- Load More -->
        <div class="text-center mt-16" x-show="hasMore" x-transition>
            <button @click="visibleCount += 8" class="btn-outline btn-magnetic px-10 py-4 group">
                <i class="fas fa-plus-circle mr-3 group-hover:rotate-180 transition-transform duration-700"></i>
                Muat Lebih Banyak
                <span class="ml-2 text-xs opacity-50" x-text="'(' + (filteredItems.length - visibleCount) + ' lagi)'"></span>
            </button>
        </div>
    </div>
</section>

<?= $this->endSection() ?>