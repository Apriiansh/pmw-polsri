<?php foreach ($items as $groupName => $groupItems): ?>
    <div x-show="isCardVisible('<?= esc($groupName, 'js') ?>')"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="group bg-white rounded-[2rem] border border-slate-200 p-8 hover:border-sky-400 hover:shadow-2xl hover:shadow-sky-500/10 transition-all duration-500 cursor-pointer relative overflow-hidden mb-6"
         @click="scrollToSection('<?= esc($groupName, 'js') ?>')">

        <!-- Visual Accent -->
        <div class="absolute right-0 top-0 w-32 h-32 bg-sky-500/5 rounded-bl-[5rem] -mr-10 -mt-10 group-hover:bg-sky-500/10 transition-colors duration-500"></div>

        <div class="flex items-start justify-between mb-8 relative z-10">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="px-3 py-1 rounded-full bg-sky-50 text-[10px] font-black text-sky-600 uppercase tracking-[0.1em]">
                        <?= esc($groupName) ?>
                    </span>
                    <span class="w-1.5 h-1.5 rounded-full bg-slate-200 group-hover:bg-sky-400 transition-colors"></span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                        <?= count($groupItems) ?> Sections
                    </span>
                </div>
                <h3 class="font-display text-xl font-black text-slate-800 group-hover:text-sky-600 transition-colors leading-tight">
                    <?= esc($groups[$groupName] ?? ucwords(str_replace(['home_', '_'], ['', ' '], $groupName))) ?>
                </h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-sky-500 group-hover:text-white group-hover:rotate-12 transition-all duration-500 shadow-sm">
                <i class="fas fa-layer-group text-lg"></i>
            </div>
        </div>

        <div class="space-y-10 relative z-10">
            <?php foreach ($groupItems as $content): ?>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                            <span class="w-4 h-[1px] bg-slate-200 group-hover:bg-sky-200 transition-colors"></span>
                            <?= esc($content['label']) ?>
                        </label>
                        <span class="text-[9px] font-mono font-bold text-slate-300 bg-slate-50 px-2 py-0.5 rounded border border-slate-100"><?= strtoupper(esc($content['type'])) ?></span>
                    </div>

                    <div class="pl-6 border-l-2 border-slate-50 group-hover:border-sky-100 transition-colors">
                        <?php 
                            if ($content['type'] === 'image') {
                                echo view('admin/cms/partials/_editor_image', ['content' => $content]);
                            } elseif ($content['type'] === 'json') {
                                echo view('admin/cms/partials/_editor_json', ['content' => $content]);
                            } else {
                                echo view('admin/cms/partials/_editor_text', ['content' => $content]);
                            }
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
