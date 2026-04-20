<div class="grid grid-cols-1 lg:grid-cols-2 gap-4"
     x-data="{ 
        path: '<?= esc($content['content']) ?>', 
        previewUrl: '<?= cms_img($content['content']) ?>',
        status: 'idle',
        uploadImage(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            this.status = 'uploading';
            const formData = new FormData();
            formData.append('image', file);
            formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
            
            fetch('<?= base_url('admin/cms/upload-image') ?>', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(d => {
                if (d.success) {
                    this.path = d.path;
                    this.previewUrl = d.url;
                    this.status = 'idle';
                    $dispatch('change');
                } else {
                    this.status = 'error';
                    Swal.fire({
                        icon: 'error',
                        title: 'Upload Gagal',
                        text: d.message,
                        background: '#1e293b',
                        color: '#fff',
                        confirmButtonColor: '#0ea5e9'
                    });
                }
            })
            .catch(() => {
                this.status = 'error';
                Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
            });
        }
     }"
     x-init="$watch('path', val => {
        if (!val) { previewUrl = ''; return; }
        if (val.startsWith('http')) { previewUrl = val; return; }
        if (val.includes('/') && !previewUrl.includes(val.split('/').pop())) { 
            previewUrl = '<?= base_url('admin/cms/image') ?>/' + val.split('/').pop(); 
        }
     })">
    <div class="space-y-3">
        <div class="relative group">
            <i class="fas fa-link absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-[10px] group-focus-within:text-sky-500 transition-colors"></i>
            <input type="text" name="cms[<?= esc($content['key']) ?>]" x-model="path"
                   placeholder="https://... atau path lokal"
                   class="w-full pl-8 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-[11px] font-mono focus:bg-white focus:ring-4 focus:ring-sky-500/10 focus:border-sky-500 outline-none transition-all">
        </div>
        <div class="relative group/upload">
            <input type="file" @change="uploadImage($event)" accept="image/*"
                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
            <div class="flex items-center gap-2 p-2.5 rounded-xl border border-dashed border-slate-300 bg-slate-50 group-hover/upload:bg-sky-50 group-hover/upload:border-sky-300 transition-all text-center justify-center">
                <template x-if="status === 'uploading'">
                    <i class="fas fa-circle-notch fa-spin text-xs text-sky-500"></i>
                </template>
                <template x-if="status !== 'uploading'">
                    <i class="fas fa-cloud-arrow-up text-xs text-slate-400 group-hover/upload:text-sky-500"></i>
                </template>
                <span class="text-[10px] font-bold text-slate-500 group-hover/upload:text-sky-600 uppercase tracking-wider" x-text="status === 'uploading' ? 'Sedang mengunggah...' : 'Pilih Gambar Lokal'"></span>
            </div>
        </div>
    </div>
    <div class="relative aspect-video rounded-2xl border border-slate-100 bg-slate-50 overflow-hidden shadow-inner flex items-center justify-center group/img">
        <template x-if="path">
            <div class="w-full h-full">
                <img :src="previewUrl" class="w-full h-full object-cover transition-transform duration-700 group-hover/img:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover/img:opacity-100 transition-opacity flex flex-col justify-end p-3">
                    <span class="text-[9px] text-white/70 font-mono truncate" x-text="path"></span>
                </div>
            </div>
        </template>
        <template x-if="!path">
            <div class="flex flex-col items-center gap-2 text-slate-300">
                <i class="fas fa-image text-3xl opacity-20"></i>
                <span class="text-[10px] font-medium">Belum ada gambar</span>
            </div>
        </template>
    </div>
</div>
