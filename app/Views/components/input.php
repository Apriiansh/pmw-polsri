<div class="flex flex-col gap-2 <?= $class ?? '' ?>">
    <?php if (isset($label)): ?>
        <label for="<?= $id ?? '' ?>" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] pl-1"><?= $label ?></label>
    <?php endif; ?>

    <div class="relative group/input">
        <?php if (isset($icon)): ?>
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 transition-colors group-focus-within/input:text-primary">
                <i class="<?= $icon ?>"></i>
            </div>
        <?php endif; ?>

        <input 
            type="<?= $type ?? 'text' ?>" 
            id="<?= $id ?? '' ?>" 
            name="<?= $name ?? '' ?>"
            placeholder="<?= $placeholder ?? '' ?>"
            value="<?= $value ?? '' ?>"
            class="w-full px-5 py-3.5 rounded-xl bg-white border border-slate-200 text-sm font-medium transition-all focus:border-primary/40 focus:ring-4 focus:ring-primary/10 outline-none shadow-sm placeholder:text-slate-300 <?= isset($icon) ? 'pl-12' : '' ?> <?= $inputClass ?? '' ?>"
            <?= $attributes ?? '' ?>
        >
    </div>

    <?php if (isset($error)): ?>
        <span class="text-[10px] text-danger font-bold pl-1 animate-pulse"><?= $error ?></span>
    <?php endif; ?>
</div>
