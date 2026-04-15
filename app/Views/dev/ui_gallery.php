<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-12 pb-20">
    
    <!-- Section: Typography -->
    <section>
        <h5 class="text-primary font-black uppercase tracking-widest text-xs mb-6 border-b border-slate-100 pb-2">01. Typography & Colors</h5>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <h1 class="text-5xl font-black font-outfit text-slate-900 leading-tight">Outfit Extrabold 48px</h1>
                <h2 class="text-3xl font-bold font-outfit text-slate-800">Outfit Bold 30px</h2>
                <h3 class="text-xl font-semibold font-outfit text-slate-700">Outfit Semibold 20px</h3>
                <p class="text-slate-600 leading-relaxed">Inter Regular 16px. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Minimalist, clean, and professional for academic and business context.</p>
                <p class="text-slate-400 text-sm italic">Inter Italic 14px. Perfect for captions and secondary information.</p>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div class="aspect-square bg-primary rounded-pmw-md flex flex-col items-center justify-center text-white p-4 shadow-lg shadow-primary/20">
                    <span class="font-bold">Primary</span>
                    <span class="text-[10px] opacity-70">#003366</span>
                </div>
                <div class="aspect-square bg-accent rounded-pmw-md flex flex-col items-center justify-center text-primary p-4 shadow-lg shadow-accent/20">
                    <span class="font-bold">Accent</span>
                    <span class="text-[10px] opacity-70">#FFD700</span>
                </div>
                <div class="aspect-square bg-white border border-slate-100 rounded-pmw-md flex flex-col items-center justify-center text-slate-900 p-4 shadow-sm">
                    <span class="font-bold">Surface</span>
                    <span class="text-[10px] opacity-70">#FFFFFF</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Buttons -->
    <section>
        <h5 class="text-primary font-black uppercase tracking-widest text-xs mb-6 border-b border-slate-100 pb-2">02. Buttons (Reusable Partial)</h5>
        <div class="flex flex-wrap gap-4 items-center">
            <?= view('components/button', ['label' => 'Primary Action', 'variant' => 'primary', 'icon' => 'fas fa-rocket']) ?>
            <?= view('components/button', ['label' => 'Accent Gold', 'variant' => 'accent', 'icon' => 'fas fa-star']) ?>
            <?= view('components/button', ['label' => 'Secondary Outline', 'variant' => 'outline']) ?>
            <?= view('components/button', ['label' => 'Ghost Button', 'variant' => 'ghost']) ?>
        </div>
    </section>

    <!-- Section: Forms -->
    <section>
        <h5 class="text-primary font-black uppercase tracking-widest text-xs mb-6 border-b border-slate-100 pb-2">03. Form Elements (Reusable Partial)</h5>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl">
            <div class="space-y-6">
                <?= view('components/input', [
                    'label'       => 'Username',
                    'id'          => 'username',
                    'placeholder' => 'Contoh: masharuby01',
                    'icon'        => 'fas fa-user'
                ]) ?>
                
                <?= view('components/input', [
                    'label'       => 'Email Address',
                    'id'          => 'email',
                    'type'        => 'email',
                    'placeholder' => 'user@example.com',
                    'icon'        => 'fas fa-envelope'
                ]) ?>
            </div>
            <div class="space-y-6">
                <?= view('components/input', [
                    'label'       => 'Password',
                    'id'          => 'password',
                    'type'        => 'password',
                    'placeholder' => 'Enter password',
                    'icon'        => 'fas fa-lock'
                ]) ?>
                
                <?= view('components/input', [
                    'label'       => 'Field with Error',
                    'id'          => 'error_field',
                    'value'       => 'Invalid input',
                    'error'       => 'Format NIM tidak sesuai (harus 10 digit)',
                    'icon'        => 'fas fa-triangle-exclamation',
                    'inputClass'  => 'border-danger/30 bg-rose-50/50'
                ]) ?>
            </div>
        </div>
    </section>

    <!-- Section: Cards -->
    <section>
        <h5 class="text-primary font-black uppercase tracking-widest text-xs mb-6 border-b border-slate-100 pb-2">04. Cards & Badges</h5>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php $this->setVar('slot', 'Ini adalah konten utama dari kartu premium PMW. Layoutnya bersih dengan padding yang luas.'); ?>
            <?= view('components/card', [
                'title'    => 'Premium Card Header',
                'subtitle' => 'Kategori Pendanaan PMW 2026',
                'hover'    => true
            ]) ?>

            <?php $this->setVar('slot', '<div class="space-y-3">
                <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                    <span class="text-xs font-bold text-slate-700">Proposal Administrasi</span>
                    <span class="pmw-status pmw-status-success"><i class="fas fa-check-circle"></i> Lolos</span>
                </div>
                <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                    <span class="text-xs font-bold text-slate-700">Seleksi Pitching</span>
                    <span class="pmw-status pmw-status-warning"><i class="fas fa-clock"></i> Pending</span>
                </div>
                <div class="flex justify-between items-center bg-slate-50 p-3 rounded-xl">
                    <span class="text-xs font-bold text-slate-700">Laporan Akhir</span>
                    <span class="pmw-status pmw-status-danger"><i class="fas fa-times-circle"></i> Belum</span>
                </div>
            </div>'); ?>
            <?= view('components/card', [
                'title'    => 'Workflow Checklist',
                'subtitle' => 'Status pendaftaran akun mahasiswa'
            ]) ?>

            <?php $this->setVar('slot', '<p class="text-sm text-slate-600 mb-6">Kartu dengan footer standar untuk aksi tambahan.</p>'); ?>
            <?php $this->setVar('footer', '<div class="flex justify-end">' . view('components/button', ['label' => 'Explore More', 'variant' => 'outline', 'class' => 'py-1 px-4 text-xs']) . '</div>'); ?>
            <?= view('components/card', [
                'title' => 'Footer Example'
            ]) ?>
        </div>
    </section>

</div>

<?= $this->endSection() ?>
