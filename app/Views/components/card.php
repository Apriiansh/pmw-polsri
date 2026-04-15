<div class="card-premium <?= ($hover ?? true) ? 'group/card' : '' ?> <?= $class ?? '' ?>">
    <?php if (isset($title) || isset($subtitle)): ?>
    <div class="px-7 py-5 border-b border-slate-100/50 flex justify-between items-center bg-white/50">
        <div>
            <?php if (isset($title)): ?>
                <h4 class="text-slate-900 font-bold font-outfit leading-tight"><?= $title ?></h4>
            <?php endif; ?>
            <?php if (isset($subtitle)): ?>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mt-1"><?= $subtitle ?></p>
            <?php endif; ?>
        </div>
        <?php if (isset($headerAction)): ?>
            <?= $headerAction ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="p-7 <?= $bodyClass ?? '' ?>">
        <?= $slot ?? '' ?>
    </div>

    <?php if (isset($footer)): ?>
    <div class="px-7 py-4 border-t border-slate-100/50 bg-slate-50/30 <?= $footerClass ?? '' ?>">
        <?= $footer ?>
    </div>
    <?php endif; ?>
</div>
