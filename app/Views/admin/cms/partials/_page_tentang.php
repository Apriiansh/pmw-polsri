<!-- CMS Tentang Page Wrapper -->
<div class="space-y-6">
    <div class="bg-gradient-to-r from-rose-600 to-pink-700 rounded-3xl p-8 mb-8 text-white relative overflow-hidden shadow-xl shadow-rose-500/20">
        <div class="relative z-10">
            <h2 class="text-2xl font-black mb-2">Profil & Visi Misi</h2>
            <p class="text-rose-100 text-xs font-medium max-w-md leading-relaxed opacity-90">Perbarui informasi latar belakang, tujuan, dan visi misi program PMW Polsri.</p>
        </div>
        <i class="fas fa-info-circle absolute right-8 top-1/2 -translate-y-1/2 text-8xl text-white/10 rotate-6"></i>
    </div>

    <?= $this->include('admin/cms/partials/_content_list', ['items' => $items]) ?>
</div>
