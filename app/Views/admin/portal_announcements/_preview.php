<!-- Portal Announcement Detail Preview Mockup -->
<div class="bg-slate-50 rounded-[2.5rem] border border-slate-200 overflow-hidden shadow-sm">
    <!-- Header/Cover Placeholder -->
    <div class="h-32 bg-gradient-to-r from-sky-400/10 to-indigo-500/10 border-b border-slate-100 flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, #0ea5e9 1px, transparent 0); background-size: 24px 24px;"></div>
        <div class="relative z-10 px-6 py-2 bg-white/50 backdrop-blur-md rounded-full border border-white/20 text-[10px] font-black text-sky-600 uppercase tracking-[0.2em]">
            Live Preview Tata Letak Publik
        </div>
    </div>

    <div class="p-8 max-w-3xl mx-auto">
        <!-- Breadcrumb Mock -->
        <div class="flex items-center gap-2 text-[10px] font-bold text-slate-300 uppercase tracking-widest mb-6">
            <span>Beranda</span>
            <i class="fas fa-chevron-right text-[6px]"></i>
            <span>Pengumuman</span>
            <i class="fas fa-chevron-right text-[6px]"></i>
            <span class="text-slate-400">Detail</span>
        </div>

        <!-- Header Section Mock -->
        <header class="mb-8">
            <div class="flex items-center gap-3 mb-3">
                <span class="px-2.5 py-0.5 rounded-full bg-sky-50 text-sky-600 text-[9px] font-black uppercase tracking-widest border border-sky-100" x-text="previewCategory || 'Kategori'">
                </span>
                <span class="text-[10px] text-slate-400 font-medium italic">
                    <i class="far fa-calendar-alt mr-1"></i>
                    <span x-text="previewDate || '20 April 2026'"></span>
                </span>
            </div>
            <h1 class="font-display text-2xl font-bold text-slate-800 leading-tight mb-4" x-text="previewTitle || 'Judul Pengumuman Akan Muncul di Sini'">
            </h1>
            <div class="w-12 h-1 bg-gradient-to-r from-sky-500 to-indigo-500 rounded-full"></div>
        </header>

        <!-- Main Content Mock -->
        <article class="bg-white rounded-3xl border border-slate-100 p-6 md:p-8 shadow-sm mb-6">
            <style>
                .preview-prose ul { list-style-type: none !important; padding-left: 1.5rem !important; margin-bottom: 1rem; }
                .preview-prose ol { list-style-type: decimal !important; padding-left: 1.5rem !important; margin-bottom: 1rem; }
                .preview-prose li { text-align: left; margin-bottom: 0.25rem; }
                .preview-prose .ql-indent-1 { padding-left: 3rem !important; }
                .preview-prose .ql-indent-2 { padding-left: 4.5rem !important; }
                .preview-prose .ql-indent-3 { padding-left: 6rem !important; }
            </style>
            <div class="prose prose-slate prose-sm max-w-none text-justify hyphens-auto preview-prose prose-img:rounded-2xl prose-a:text-sky-500" x-html="previewContent || '<p class=\'text-slate-400 italic\'>Konten pengumuman akan tampil di sini...</p>'">
            </div>
        </article>

        <!-- Attachments Section Mock -->
        <section x-show="files.length > 0 || (typeof existingFiles !== 'undefined' && existingFiles.length > 0)">
            <h3 class="text-[10px] font-black text-slate-800 uppercase tracking-widest mb-4 flex items-center gap-2">
                <i class="fas fa-paperclip text-sky-500"></i>
                Lampiran Dokumen
            </h3>
            <div class="grid grid-cols-1 gap-3">
                <!-- Existing Files (Edit Mode) -->
                <template x-if="typeof existingFiles !== 'undefined'">
                    <template x-for="file in existingFiles" :key="file.id">
                        <div class="group flex items-center justify-between p-3 bg-white border border-slate-100 rounded-2xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-sky-500">
                                    <i class="fas fa-file-pdf text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-700" x-text="file.name"></p>
                                    <p class="text-[9px] text-slate-400 uppercase tracking-widest font-bold" x-text="file.size"></p>
                                </div>
                            </div>
                        </div>
                    </template>
                </template>

                <!-- New Files -->
                <template x-for="file in files" :key="file.name + file.size">
                    <div class="group flex items-center justify-between p-3 bg-white border border-slate-100 rounded-2xl border-dashed border-sky-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center text-sky-500">
                                <i class="fas fa-file-circle-plus text-lg"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-700" x-text="file.name"></p>
                                <p class="text-[9px] text-sky-400 uppercase tracking-widest font-bold">File Baru • <span x-text="(file.size / 1024 / 1024).toFixed(2) + ' MB'"></span></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </section>
    </div>

    <!-- Footer Action Mock -->
    <div class="bg-slate-100/50 p-6 flex justify-center border-t border-slate-200/50 mt-4">
        <div class="px-6 py-2 bg-white rounded-xl border border-slate-200 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
            Tombol Kembali ke Daftar
        </div>
    </div>
</div>
