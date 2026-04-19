<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-8" x-data="{
    showTeamModal: false,
    selectedMember: null,
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        card.style.setProperty('--mouse-x', `${x}px`);
        card.style.setProperty('--mouse-y', `${y}px`);
    }
}">
    <!-- Header with Back Button (Consolidated into Partial) -->
    <?= $this->include('shared/_monitoring_team', [
        'backUrl'      => base_url('dosen/monitoring'),
        'headerBadge'  => 'Monitoring Tim',
    ]) ?>
</div>

<style>
.card-premium {
    background: white;
    border-radius: 2rem;
    border: 1px solid rgba(226, 232, 240, 0.8);
    position: relative;
    overflow: hidden;
}

.card-premium::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(
        800px circle at var(--mouse-x) var(--mouse-y),
        rgba(14, 165, 233, 0.06),
        transparent 40%
    );
    z-index: 0;
    pointer-events: none;
}
</style>
<?= $this->endSection() ?>
