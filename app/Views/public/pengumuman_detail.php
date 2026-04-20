<?= $this->extend('layouts/public') ?>

<?= $this->section('styles') ?>
<style>
    /* Fix Quill Alignment */
    .ql-align-center { text-align: center; }
    .ql-align-right { text-align: right; }
    .ql-align-justify { text-align: justify; }

    /* Custom Prose Adjustments */
    #announcement-content {
        text-align: justify;
        text-justify: inter-word;
    }
    
    #announcement-content img {
        margin-left: auto;
        margin-right: auto;
        border-radius: 1.5rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
    }

    #announcement-content blockquote p {
        text-align: left;
    }

    /* Lists Support */
    #announcement-content ul {
        list-style-type: none !important;
        padding-left: 1.5rem !important;
        margin-bottom: 1.25rem !important;
    }
    
    #announcement-content ol {
        list-style-type: decimal !important;
        padding-left: 1.5rem !important;
        margin-bottom: 1.25rem !important;
    }
    
    #announcement-content li {
        margin-bottom: 0.5rem !important;
        padding-left: 0.25rem !important;
        text-align: left !important;
    }

    /* Indentation Support (Quill classes) */
    #announcement-content .ql-indent-1 { padding-left: 3rem !important; }
    #announcement-content .ql-indent-2 { padding-left: 4.5rem !important; }
    #announcement-content .ql-indent-3 { padding-left: 6rem !important; }

    /* Code Block Styling */
    #announcement-content pre {
        background-color: #0f172a !important;
        color: #e2e8f0 !important;
        padding: 1.25rem !important;
        border-radius: 1rem !important;
        overflow-x: auto !important;
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace !important;
        font-size: 0.875rem !important;
        margin: 1.5rem 0 !important;
        line-height: 1.6;
    }

    /* Table Support */
    #announcement-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
        font-size: 0.875rem;
    }
    #announcement-content th, 
    #announcement-content td {
        border: 1px solid #e2e8f0;
        padding: 0.75rem;
        text-align: left;
    }
    #announcement-content th {
        background-color: #f8fafc;
        font-weight: 700;
        color: #1e293b;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto py-12 px-4">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest mb-8">
        <a href="<?= base_url() ?>" class="hover:text-sky-500 transition-colors">Beranda</a>
        <i class="fas fa-chevron-right text-[8px]"></i>
        <a href="<?= base_url('pengumuman') ?>" class="hover:text-sky-500 transition-colors">Pengumuman</a>
        <i class="fas fa-chevron-right text-[8px]"></i>
        <span class="text-slate-500">Detail</span>
    </nav>

    <!-- Header Section -->
    <header class="mb-10">
        <div class="flex items-center gap-3 mb-4">
            <span class="px-3 py-1 rounded-full bg-sky-50 text-sky-600 text-[10px] font-black uppercase tracking-widest border border-sky-100">
                <?= esc($announcement['category']) ?>
            </span>
            <span class="text-xs text-slate-400 font-medium">
                <i class="far fa-calendar-alt mr-1"></i>
                <?= date('d F Y', strtotime($announcement['date'])) ?>
            </span>
        </div>
        <h1 class="font-display text-3xl md:text-4xl font-bold text-slate-800 leading-tight tracking-tight mb-6">
            <?= esc($announcement['title']) ?>
        </h1>
        
        <!-- Decorative Line -->
        <div class="w-20 h-1.5 bg-linear-to-r from-sky-500 to-indigo-500 rounded-full"></div>
    </header>

    <!-- Main Content -->
    <article class="bg-white rounded-[2.5rem] border border-slate-100 p-8 md:p-12 shadow-xl shadow-slate-200/50 mb-8">
        <div id="announcement-content" class="prose prose-slate max-w-none text-justify hyphens-auto
                    prose-headings:font-display prose-headings:font-bold prose-headings:text-slate-800
                    prose-h1:text-3xl prose-h2:text-2xl prose-h3:text-xl
                    prose-p:text-slate-600 prose-p:leading-relaxed prose-p:text-sm md:prose-p:text-base prose-p:mb-4
                    prose-a:text-sky-600 prose-a:no-underline hover:prose-a:underline
                    prose-strong:text-slate-800 prose-strong:font-bold
                    prose-em:text-slate-700 prose-em:italic
                    prose-li:text-slate-600 prose-li:text-sm md:prose-li:text-base
                    prose-blockquote:border-l-4 prose-blockquote:border-sky-500 prose-blockquote:pl-4 prose-blockquote:italic prose-blockquote:text-slate-500">
            <?= $announcement['content'] ?>
        </div>
    </article>

    <!-- Attachments Section -->
    <?php if (!empty($attachments)): ?>
    <section class="mt-12">
        <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-6 flex items-center gap-3">
            <i class="fas fa-paperclip text-sky-500"></i>
            Lampiran Dokumen
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php foreach ($attachments as $file): ?>
            <a href="<?= $file->getUrl() ?>" 
               target="_blank"
               class="group flex items-center justify-between p-4 bg-white border border-slate-100 rounded-3xl hover:border-sky-400 hover:shadow-lg hover:shadow-sky-500/10 transition-all duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-sky-50 group-hover:text-sky-500 transition-colors">
                        <i class="fas <?= $file->getIcon() ?> text-xl"></i>
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-slate-700 truncate w-48 group-hover:text-sky-600 transition-colors">
                            <?= esc($file->file_name) ?>
                        </p>
                        <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold">
                            <?= number_format($file->file_size / 1024 / 1024, 2) ?> MB
                        </p>
                    </div>
                </div>
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-300 group-hover:bg-sky-500 group-hover:text-white transition-all">
                    <i class="fas fa-download text-[10px]"></i>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- Back Button Footer -->
    <div class="mt-16 flex justify-center">
        <a href="<?= base_url('pengumuman') ?>" class="inline-flex items-center gap-2 px-8 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold rounded-2xl transition-all active:scale-95">
            <i class="fas fa-arrow-left text-xs"></i>
            Kembali ke Pengumuman
        </a>
    </div>
</div>
<?= $this->endSection() ?>
