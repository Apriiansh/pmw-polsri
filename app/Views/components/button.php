<?php
    $variant = $variant ?? 'primary'; // primary, accent, outline
    $type    = $type ?? 'button';
    $attr    = $attributes ?? '';
?>

<button type="<?= $type ?>" class="pmw-btn pmw-btn-<?= $variant ?> group/btn <?= $class ?? '' ?>" <?= $attr ?>>
    <?php if (isset($icon)): ?>
        <i class="<?= $icon ?> transition-transform duration-500 group-hover/btn:scale-110 group-hover/btn:rotate-6"></i>
    <?php endif; ?>
    <span class="whitespace-nowrap"><?= $label ?? 'Button' ?></span>
</button>
