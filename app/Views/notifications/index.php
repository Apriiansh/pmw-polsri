<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-slate-800">Semua Notifikasi</h2>
            <p class="text-sm text-slate-500">Kelola notifikasi sistem</p>
        </div>
        <?php if (!empty($notifications)): ?>
            <button onclick="markAllAsRead()" class="btn-outline text-sm">
                <i class="fas fa-check-double mr-2"></i>
                Tandai Semua Dibaca
            </button>
        <?php endif; ?>
    </div>

    <!-- Notification List -->
    <div class="card-premium p-0 overflow-hidden">
        <?php if (empty($notifications)): ?>
            <div class="p-12 text-center">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bell-slash text-2xl text-slate-400"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-700 mb-1">Tidak Ada Notifikasi</h3>
                <p class="text-sm text-slate-500">Belum ada notifikasi untuk ditampilkan</p>
            </div>
        <?php else: ?>
            <div class="divide-y divide-slate-100">
                <?php foreach ($notifications as $notif): ?>
                    <div class="notification-row flex items-start gap-4 p-4 hover:bg-slate-50 transition-colors <?= !$notif['is_read'] ? 'unread bg-sky-50/30' : '' ?>">
                        <!-- Icon -->
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0
                            <?= match($notif['type']) {
                                'proposal_submitted' => 'bg-emerald-100 text-emerald-600',
                                'proposal_approved' => 'bg-emerald-100 text-emerald-600',
                                'proposal_rejected' => 'bg-rose-100 text-rose-600',
                                'proposal_revision' => 'bg-amber-100 text-amber-600',
                                default => 'bg-sky-100 text-sky-600'
                            } ?>">
                            <i class="fas <?= match($notif['type']) {
                                'proposal_submitted' => 'fa-file-import',
                                'proposal_approved' => 'fa-check-circle',
                                'proposal_rejected' => 'fa-times-circle',
                                'proposal_revision' => 'fa-edit',
                                default => 'fa-info'
                            } ?>"></i>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="font-bold text-slate-800 <?= !$notif['is_read'] ? 'text-sky-700' : '' ?>">
                                        <?= esc($notif['title']) ?>
                                    </p>
                                    <p class="text-sm text-slate-600 mt-1 leading-relaxed">
                                        <?= esc($notif['message']) ?>
                                    </p>
                                    <p class="text-xs text-slate-400 mt-2">
                                        <i class="far fa-clock mr-1"></i>
                                        <?= time_elapsed_string($notif['created_at']) ?>
                                    </p>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center gap-2 shrink-0">
                                    <?php if (!$notif['is_read']): ?>
                                        <button onclick="markAsRead(<?= $notif['id'] ?>, this)"
                                            class="p-2 text-sky-600 hover:bg-sky-100 rounded-lg transition-colors"
                                            title="Tandai dibaca">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    <?php endif; ?>
                                    <?php if ($notif['link']): ?>
                                        <a href="<?= base_url($notif['link']) ?>"
                                            class="p-2 text-slate-400 hover:text-sky-600 hover:bg-sky-100 rounded-lg transition-colors"
                                            title="Buka">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<script>
async function markAsRead(id, btn) {
    try {
        const response = await fetch(`<?= base_url('notifications/mark-read/') ?>${id}`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
            }
        });
        const result = await response.json();

        if (result.success) {
            const row = btn.closest('.notification-row');
            if (row) {
                row.classList.remove('unread', 'bg-sky-50/30');
                const title = row.querySelector('.font-bold');
                if (title) title.classList.remove('text-sky-700');
            }
            btn.remove();
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

async function markAllAsRead() {
    if (!confirm('Tandai semua notifikasi sebagai dibaca?')) return;

    try {
        const response = await fetch('<?= base_url('notifications/mark-all-read') ?>', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
            }
        });
        const result = await response.json();

        if (result.success) {
            document.querySelectorAll('.notification-row.unread').forEach(row => {
                row.classList.remove('unread', 'bg-sky-50/30');
                const title = row.querySelector('.font-bold');
                if (title) title.classList.remove('text-sky-700');
                const btn = row.querySelector('button[onclick^="markAsRead"]');
                if (btn) btn.remove();
            });
        }
    } catch (error) {
        console.error('Error:', error);
    }
}
</script>

<?= $this->endSection() ?>
