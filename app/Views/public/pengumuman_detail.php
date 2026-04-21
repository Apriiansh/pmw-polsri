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
<!-- Header Section -->
<section class="relative overflow-hidden px-6 lg:px-8 pt-24 pb-20 lg:pt-28 relative z-10">
    <!-- Premium Background Elements -->
    <div class="absolute inset-0 -z-10">
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-sky-500/10 rounded-full blur-[120px] animate-float"></div>
        <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-[120px] animate-float" style="animation-delay: -3s"></div>
    </div>

    <div class="max-w-4xl mx-auto px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-3 text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-12 reveal-blur">
            <a href="<?= base_url() ?>" class="hover:text-sky-500 transition-liquid">Beranda</a>
            <i class="fas fa-chevron-right text-[8px] opacity-30"></i>
            <a href="<?= base_url('pengumuman') ?>" class="hover:text-sky-500 transition-liquid">Pengumuman</a>
            <i class="fas fa-chevron-right text-[8px] opacity-30"></i>
            <span class="text-sky-500/60">Detail</span>
        </nav>

        <div class="reveal-blur">
            <div class="flex items-center gap-4 mb-6">
                <span class="px-4 py-1.5 rounded-full bg-sky-500/10 text-sky-600 text-[10px] font-black uppercase tracking-[0.2em] border border-sky-100">
                    <?= esc($announcement['category']) ?>
                </span>
                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider flex items-center gap-2">
                    <i class="far fa-calendar-alt text-sky-400"></i>
                    <?= date('d F Y', strtotime($announcement['date'])) ?>
                </span>
            </div>
            <h1 class="font-display text-4xl lg:text-6xl font-bold text-(--text-heading) leading-[1.1] tracking-tight mb-8">
                <?= esc($announcement['title']) ?>
            </h1>
            
            <div class="w-24 h-2 bg-linear-to-r from-sky-500 to-indigo-500 rounded-full shadow-lg shadow-sky-200"></div>
        </div>
    </div>
</section>

<!-- Main Content Area -->
<section class="pb-20 lg:pb-32 px-6">
    <div class="max-w-4xl mx-auto">
        <!-- Main Article Body -->
        <article class="reveal-zoom bg-white rounded-[3rem] border border-slate-100 p-10 lg:p-20 shadow-2xl shadow-slate-200/40 mb-12">
            <div id="announcement-content" class="prose prose-slate lg:prose-lg max-w-none text-justify
                        prose-headings:font-display prose-headings:font-bold prose-headings:text-slate-800
                        prose-p:text-slate-600 prose-p:leading-relaxed
                        prose-a:text-sky-600 prose-a:font-bold prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-slate-900 prose-strong:font-bold
                        prose-blockquote:border-l-4 prose-blockquote:border-sky-500 prose-blockquote:bg-sky-50/50 prose-blockquote:p-6 prose-blockquote:rounded-r-2xl prose-blockquote:italic prose-blockquote:text-slate-500">
                <!-- Content fallback -->
                <div id="delta-fallback">
                    <?= $announcement['content'] ?>
                </div>
            </div>
        </article>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const contentDiv = document.getElementById('announcement-content');
                const rawContent = <?= json_encode($announcement['content']) ?>;
                
                if (rawContent && (rawContent.startsWith('{') || rawContent.startsWith('['))) {
                    try {
                        const delta = JSON.parse(rawContent);
                        const tempCont = document.createElement('div');
                        const tempQuill = new Quill(tempCont, { readOnly: true });
                        tempQuill.setContents(delta);
                        contentDiv.innerHTML = tempQuill.root.innerHTML;
                    } catch (e) {
                        console.error('Error parsing Delta:', e);
                    }
                }
            });
        </script>

        <!-- Attachments Section -->
        <?php if (!empty($attachments)): ?>
        <div class="reveal-on-scroll mt-20">
            <h3 class="text-xs font-black text-slate-800 uppercase tracking-[0.2em] mb-8 flex items-center gap-4">
                <span class="w-10 h-10 rounded-xl bg-sky-500/10 flex items-center justify-center text-sky-500">
                    <i class="fas fa-paperclip"></i>
                </span>
                Lampiran Dokumen
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($attachments as $index => $file): ?>
                <a href="<?= $file->getUrl() ?>" 
                   target="_blank"
                   class="group flex items-center justify-between p-6 bg-white border border-slate-100 rounded-[2rem] hover:border-sky-400 hover:shadow-2xl transition-liquid reveal-on-scroll stagger-<?= $index + 1 ?>">
                    <div class="flex items-center gap-5">
                        <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-sky-50 group-hover:text-sky-500 transition-liquid shadow-inner">
                            <i class="fas <?= $file->getIcon() ?> text-2xl"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-base font-bold text-slate-700 truncate w-48 group-hover:text-sky-600 transition-liquid">
                                <?= esc($file->file_name) ?>
                            </p>
                            <p class="text-[10px] text-slate-400 uppercase tracking-widest font-black mt-1">
                                Klik untuk mengunduh
                            </p>
                        </div>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-300 group-hover:bg-sky-500 group-hover:text-white transition-liquid group-hover:scale-110">
                        <i class="fas fa-download text-xs"></i>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Footer Actions -->
        <div class="mt-24 pt-12 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-8 reveal-on-scroll">
            <a href="<?= base_url('pengumuman') ?>" class="btn-ghost btn-magnetic group px-10 py-4 font-bold text-slate-600 border-slate-200">
                <i class="fas fa-arrow-left mr-3 group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Pengumuman
            </a>
            
            <div class="flex items-center gap-4">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Bagikan:</span>
                <button class="w-12 h-12 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-sky-500 hover:text-white hover:border-sky-500 transition-liquid">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button class="w-12 h-12 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-sky-400 hover:text-white hover:border-sky-400 transition-liquid">
                    <i class="fab fa-twitter"></i>
                </button>
                <button class="w-12 h-12 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-emerald-500 hover:text-white hover:border-emerald-500 transition-liquid">
                    <i class="fab fa-whatsapp"></i>
                </button>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
