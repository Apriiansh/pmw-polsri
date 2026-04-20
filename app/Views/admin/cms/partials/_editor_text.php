<?php if ($content['type'] === 'rich_text'): ?>
    <div class="relative group" x-data="{ count: <?= strlen($content['content'] ?? '') ?> }">
        <textarea name="cms[<?= esc($content['key']) ?>]" rows="4"
                  @input="count = $el.value.length"
                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all shadow-inner leading-relaxed min-h-[120px]"><?= esc($content['content']) ?></textarea>
        <div class="absolute bottom-3 right-3 text-[9px] font-black text-slate-300 uppercase tracking-widest bg-white/80 backdrop-blur-sm px-2 py-0.5 rounded-full border border-slate-100">
            <span x-text="count"></span> Characters
        </div>
    </div>
<?php else: ?>
    <div class="relative group">
        <textarea name="cms[<?= esc($content['key']) ?>]" rows="2"
                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all resize-none shadow-inner leading-relaxed text-slate-700"><?= esc($content['content']) ?></textarea>
        <div class="absolute -right-2 -top-2 opacity-0 group-focus-within:opacity-100 transition-opacity">
            <div class="bg-sky-500 text-white p-1 rounded-lg shadow-lg shadow-sky-500/30">
                <i class="fas fa-pen-to-square text-[10px]"></i>
            </div>
        </div>
    </div>
<?php endif; ?>
