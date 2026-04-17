<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="space-y-8 max-w-6xl mx-auto" x-data="{
    showLogbookModal: false,
    selectedSchedule: null,
    handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
        card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
    }
}">

    <!-- ================================================================
         1. PAGE HEADING
    ================================================================= -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-stagger">
        <div>
            <h2 class="section-title text-xl sm:text-2xl">
                Bimbingan & <span class="text-gradient">Mentoring</span>
            </h2>
            <p class="section-subtitle text-[10px] sm:text-[11px]">Tahap 7 - Pantau jadwal dan isi logbook aktivitas tim Anda</p>
        </div>
    </div>

    <!-- ================================================================
         2. TEAM INFO CARDS
    ================================================================= -->
    <div class="grid md:grid-cols-2 gap-6 animate-stagger delay-100">
        <!-- Dosen Info -->
        <div class="card-premium p-5 border-l-4 border-l-sky-500" @mousemove="handleMouseMove">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-sky-100 flex items-center justify-center shrink-0">
                    <i class="fas fa-chalkboard-user text-xl text-sky-600"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Dosen Pendamping</p>
                    <h4 class="text-sm font-bold text-slate-800 mt-0.5"><?= esc($proposal['dosen_nama'] ?? 'Belum ditugaskan') ?></h4>
                    <p class="text-[11px] text-slate-500 mt-1">Bertanggung jawab atas bimbingan akademik dan teknis.</p>
                </div>
            </div>
        </div>

        <!-- Mentor Info -->
        <div class="card-premium p-5 border-l-4 border-l-amber-500" @mousemove="handleMouseMove">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center shrink-0">
                    <i class="fas fa-user-tie text-xl text-amber-600"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Mentor Praktisi</p>
                    <h4 class="text-sm font-bold text-slate-800 mt-0.5"><?= esc($proposal['mentor_nama'] ?? 'Belum ditugaskan') ?></h4>
                    <p class="text-[11px] text-slate-500 mt-1">Memberikan panduan praktis dunia industri dan bisnis.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ================================================================
         3. SCHEDULES LIST
    ================================================================= -->
    <div class="card-premium overflow-hidden animate-stagger delay-300" @mousemove="handleMouseMove">
        <div class="px-6 py-4 border-b border-sky-50 flex items-center justify-between bg-white/60">
            <h3 class="font-display text-base font-bold text-(--text-heading)">Jadwal Aktivitas</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="pmw-table">
                <thead>
                    <tr>
                        <th>Tipe</th>
                        <th>Waktu & Topik</th>
                        <th class="text-center">Status Logbook</th>
                        <th class="text-center">Sesi</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($schedules)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="text-slate-400">
                                    <i class="fas fa-calendar-alt text-4xl mb-3 opacity-20"></i>
                                    <p class="text-sm italic">Belum ada jadwal yang ditetapkan oleh Dosen atau Mentor.</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($schedules as $s): ?>
                        <tr class="group">
                            <td>
                                <span class="pmw-status <?= $s->type === 'bimbingan' ? 'bg-sky-50 text-sky-600 border-sky-200' : 'bg-amber-50 text-amber-600 border-amber-200' ?> text-[10px]">
                                    <?= strtoupper($s->type) ?>
                                </span>
                            </td>
                            <td>
                                <div class="text-[13px] font-bold text-(--text-heading)"><?= date('d F Y', strtotime($s->schedule_date)) ?> - <?= $s->schedule_time ?></div>
                                <div class="text-[11px] text-slate-500 font-medium italic mt-0.5">"<?= esc($s->topic) ?>"</div>
                            </td>
                            <td class="text-center">
                                <?php if (!$s->logbook): ?>
                                    <span class="text-[11px] text-rose-400 font-black tracking-wider uppercase"><i class="fas fa-circle-exclamation mr-1"></i> Belum Isi</span>
                                <?php else: ?>
                                    <?php 
                                        $logStatusColors = [
                                            'pending'  => 'bg-blue-50 text-blue-600 border-blue-200',
                                            'approved' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                            'rejected' => 'bg-rose-50 text-rose-600 border-rose-200',
                                        ];
                                    ?>
                                    <span class="pmw-status <?= $logStatusColors[$s->logbook->status] ?>"><?= strtoupper($s->logbook->status) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php
                                $schedStatusColors = [
                                    'planned'   => 'bg-slate-100 text-slate-500',
                                    'ongoing'   => 'bg-blue-500 text-white',
                                    'completed' => 'bg-emerald-500 text-white',
                                ];
                                ?>
                                <span class="inline-flex h-2 w-2 rounded-full <?= $schedStatusColors[$s->status] ?> mr-1.5 animate-pulse"></span>
                                <span class="text-[11px] font-bold text-slate-600 uppercase"><?= $s->status ?></span>
                            </td>
                            <td class="text-right">
                                <?php if (!$s->logbook || $s->logbook->status === 'rejected'): ?>
                                    <button @click="selectedSchedule = <?= htmlspecialchars(json_encode($s)) ?>; showLogbookModal = true" 
                                            class="btn-primary btn-xs py-1.5 px-3 shadow-md transition-all hover:scale-105">
                                        <i class="fas fa-pen-to-square mr-1"></i> <?= $s->logbook ? 'Revisi Logbook' : 'Isi Logbook' ?>
                                    </button>
                                <?php else: ?>
                                    <button @click="selectedSchedule = <?= htmlspecialchars(json_encode($s)) ?>; showLogbookModal = true" 
                                            class="btn-outline btn-xs bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-500 hover:text-white transition-all">
                                        <i class="fas fa-eye mr-1"></i> Detail
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================================================================
         LOGBOOK MODAL
    ================================================================= -->
    <div x-show="showLogbookModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
        
        <div class="card-premium w-full max-w-4xl bg-white shadow-2xl animate-modal overflow-hidden max-h-[90vh] flex flex-col" @click.away="showLogbookModal = false">
            <div class="p-6 border-b border-sky-50 flex justify-between items-center bg-sky-50/30">
                <div>
                    <h3 class="font-display text-lg font-black text-sky-900 uppercase">Input Logbook Aktivitas</h3>
                    <p class="text-[11px] text-slate-500 font-semibold" x-text="selectedSchedule ? `${selectedSchedule.type.toUpperCase()} - ${selectedSchedule.topic}` : ''"></p>
                </div>
                <button @click="showLogbookModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div class="p-6 overflow-y-auto flex-1 custom-scrollbar">
                <form :action="selectedSchedule ? `<?= base_url('mahasiswa/guidance/logbook') ?>/${selectedSchedule.id}` : '#'" method="POST" enctype="multipart/form-data" class="space-y-8">
                    <?= csrf_field() ?>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Pillar: Information -->
                        <div class="space-y-6">
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Penjelasan Ringkas Materi <span class="text-rose-500">*</span></label>
                                <textarea name="material_explanation" rows="6" class="input-modern w-full" 
                                          placeholder="Jelaskan apa saja yang dibahas dan dipraktikkan selama bimbingan/mentoring..."
                                          :required="!selectedSchedule || !selectedSchedule.logbook"
                                          :disabled="selectedSchedule && selectedSchedule.logbook && selectedSchedule.logbook.status === 'approved'"
                                          x-text="selectedSchedule && selectedSchedule.logbook ? selectedSchedule.logbook.material_explanation : ''"></textarea>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Link Video Rekaman (Opsional)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-rose-500"><i class="fab fa-youtube"></i></span>
                                    <input type="url" name="video_url" class="input-modern w-full pl-12" 
                                           placeholder="https://youtube.com/watch?v=..."
                                           :disabled="selectedSchedule && selectedSchedule.logbook && selectedSchedule.logbook.status === 'approved'"
                                           :value="selectedSchedule && selectedSchedule.logbook ? selectedSchedule.logbook.video_url : ''">
                                </div>
                            </div>

                            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-100 space-y-3">
                                <label class="text-[10px] font-black text-emerald-600 uppercase tracking-widest flex items-center">
                                    <i class="fas fa-utensils mr-1.5"></i> Nota Konsumsi (Audit Finansial)
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Nominal (Rp)</p>
                                        <input type="number" name="nominal_konsumsi" class="input-modern w-full" placeholder="0"
                                               :disabled="selectedSchedule && selectedSchedule.logbook && selectedSchedule.logbook.status === 'approved'"
                                               :value="selectedSchedule && selectedSchedule.logbook ? selectedSchedule.logbook.nominal_konsumsi : ''">
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Upload Nota</p>
                                        <input type="file" name="nota_file" class="block w-full text-[10px] text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-semibold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200"
                                               :disabled="selectedSchedule && selectedSchedule.logbook && selectedSchedule.logbook.status === 'approved'">
                                    </div>
                                </div>
                                <div x-show="selectedSchedule && selectedSchedule.logbook && selectedSchedule.logbook.nota_file" class="mt-2 text-[10px]">
                                    <a :href="`<?= base_url('mahasiswa/guidance/file/nota') ?>/${selectedSchedule.logbook?.id}`" target="_blank" class="text-emerald-600 font-bold hover:underline">Lihat nota yang sudah diupload</a>
                                </div>
                            </div>
                        </div>

                        <!-- Right Pillar: Uploads -->
                        <div class="space-y-6">
                            <!-- Photo Activity -->
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Foto Kegiatan <span class="text-rose-500">*</span></label>
                                <div x-show="selectedSchedule && selectedSchedule.logbook && selectedSchedule.logbook.photo_activity" class="mb-3">
                                    <img :src="`<?= base_url('mahasiswa/guidance/file/photo') ?>/${selectedSchedule.logbook?.id}`" class="w-full h-32 object-cover rounded-xl border border-slate-200">
                                </div>
                                <div class="relative group" x-show="!selectedSchedule || !selectedSchedule.logbook || selectedSchedule.logbook.status !== 'approved'">
                                    <input type="file" name="photo_activity" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                           :required="!selectedSchedule || !selectedSchedule.logbook">
                                    <div class="flex flex-col items-center justify-center p-8 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50 group-hover:border-sky-400 group-hover:bg-sky-50 transition-all">
                                        <i class="fas fa-camera text-2xl text-slate-300 group-hover:text-sky-500 mb-2"></i>
                                        <p class="text-xs font-bold text-slate-500 group-hover:text-sky-700">Klik / Drop Foto Kegiatan</p>
                                        <p class="text-[10px] text-slate-400">JPG, PNG (Max 2MB)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Assignment File -->
                            <div class="space-y-1.5">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Berkas Output / Tugas (PDF)</label>
                                <div x-show="selectedSchedule && selectedSchedule.logbook && selectedSchedule.logbook.assignment_file" class="mb-3">
                                    <div class="p-3 rounded-lg border border-sky-100 bg-sky-50 flex items-center gap-3">
                                        <i class="fas fa-file-pdf text-rose-500 text-lg"></i>
                                        <span class="text-[11px] font-bold text-sky-700">Tugas Terlampir</span>
                                        <a :href="`<?= base_url('mahasiswa/guidance/file/assignment') ?>/${selectedSchedule.logbook?.id}`" target="_blank" class="ml-auto text-sky-500 hover:text-sky-700"><i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                                <div class="relative group" x-show="!selectedSchedule || !selectedSchedule.logbook || selectedSchedule.logbook.status !== 'approved'">
                                    <input type="file" name="assignment_file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50 group-hover:border-rose-400 group-hover:bg-rose-50 transition-all">
                                        <i class="fas fa-file-arrow-up text-2xl text-slate-300 group-hover:text-rose-500 mb-2"></i>
                                        <p class="text-xs font-bold text-slate-500 group-hover:text-rose-700">Upload Tugas / Output</p>
                                        <p class="text-[10px] text-slate-400">Hanya format PDF (Max 5MB)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Section -->
                    <div x-show="selectedSchedule && selectedSchedule.logbook && selectedSchedule.logbook.verification_note" class="p-4 rounded-xl bg-rose-50 border border-rose-100">
                        <p class="text-[10px] font-black text-rose-600 uppercase tracking-widest mb-1.5">Ganjalan / Catatan dari Verifikator:</p>
                        <p class="text-[12px] text-rose-800 italic" x-text="selectedSchedule.logbook.verification_note"></p>
                    </div>

                    <div class="flex gap-4 pt-4 border-t border-slate-50">
                        <button type="button" @click="showLogbookModal = false" class="btn-outline flex-1">Tutup</button>
                        <button type="submit" 
                                x-show="!selectedSchedule || !selectedSchedule.logbook || selectedSchedule.logbook.status === 'rejected'"
                                class="btn-primary flex-1 shadow-lg shadow-sky-500/30 font-black">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Logbook
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    .animate-stagger {
        animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }
    .delay-100 { animation-delay: 0.1s; }
    .delay-300 { animation-delay: 0.3s; }

    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes modalIn {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .animate-modal {
        animation: modalIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>

<?= $this->endSection() ?>
