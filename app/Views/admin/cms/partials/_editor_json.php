<div class="bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden shadow-sm"
     x-data='{
        items: <?= json_encode(json_decode($content["content"], true) ?? []) ?>,
        mode: "visual",
        raw: "",
        status: {},
        init() {
            this.raw = JSON.stringify(this.items, null, 4);
            this.$watch("items", val => {
                this.raw = JSON.stringify(val, null, 4);
            }, { deep: true });
        },
        addItem() {
            if (this.items.length > 0) {
                let newItem = JSON.parse(JSON.stringify(this.items[0]));
                Object.keys(newItem).forEach(key => newItem[key] = "");
                this.items.push(newItem);
            } else {
                this.items.push({ label: "", value: "" });
            }
            this.$dispatch("change");
        },
        removeItem(index) {
            Swal.fire({
                title: "Hapus item?",
                text: "Item ini akan dihapus dari daftar.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Batal",
                background: "#1e293b",
                color: "#fff",
                confirmButtonColor: "#f43f5e",
                cancelButtonColor: "#64748b"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.items.splice(index, 1);
                    this.$dispatch("change");
                }
            });
        },
        syncRaw() {
            try { this.items = JSON.parse(this.raw); } catch(e) {}
        },
        isImageKey(key) {
            return ["img", "image", "src", "photo", "pic"].includes(key.toLowerCase());
        },
        isSelectKey(key) {
            return ["badge", "size", "color"].includes(key.toLowerCase());
        },
        getPreviewUrl(val) {
            if (!val) return "";
            if (val.startsWith("http")) return val;
            const filename = val.split("/").pop();
            return "<?= base_url('admin/cms/image') ?>/" + filename;
        },
        uploadImage(e, index, key) {
            const file = e.target.files[0];
            if (!file) return;
            
            const statusKey = `${index}-${key}`;
            this.status[statusKey] = "uploading";
            
            const formData = new FormData();
            formData.append("image", file);
            formData.append("<?= csrf_token() ?>", "<?= csrf_hash() ?>");
            
            fetch("<?= base_url('admin/cms/upload-image') ?>", {
                method: "POST",
                body: formData,
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
            .then(r => r.json())
            .then(d => {
                if (d.success) {
                    this.items[index][key] = d.path;
                    this.status[statusKey] = "idle";
                    this.$dispatch("change");
                } else {
                    this.status[statusKey] = "error";
                    Swal.fire("Error", d.message, "error");
                }
            })
            .catch(() => {
                this.status[statusKey] = "error";
                Swal.fire("Error", "Terjadi kesalahan sistem", "error");
            });
        }
     }'>
    <div class="bg-slate-100/50 backdrop-blur px-4 py-2 border-b border-slate-200 flex items-center justify-between">
        <div class="flex p-0.5 bg-slate-200 rounded-lg">
            <button type="button" @click="mode = 'visual'" 
                    :class="mode === 'visual' ? 'bg-white shadow-sm text-sky-600' : 'text-slate-500 hover:text-slate-700'" 
                    class="px-3 py-1 rounded-md text-[10px] font-black uppercase transition-all flex items-center gap-1.5">
                <i class="fas fa-list-ul"></i> Visual
            </button>
            <button type="button" @click="mode = 'raw'" 
                    :class="mode === 'raw' ? 'bg-white shadow-sm text-sky-600' : 'text-slate-500 hover:text-slate-700'" 
                    class="px-3 py-1 rounded-md text-[10px] font-black uppercase transition-all flex items-center gap-1.5">
                <i class="fas fa-code"></i> Raw
            </button>
        </div>
        <button type="button" x-show="mode === 'visual'" @click="addItem()" 
                class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-1 rounded-lg font-bold text-[10px] uppercase shadow-lg shadow-sky-500/20 transition-all active:scale-95 flex items-center gap-1.5">
            <i class="fas fa-plus"></i> Tambah
        </button>
    </div>

    <div x-show="mode === 'visual'" class="p-4 space-y-3 max-h-[500px] overflow-y-auto custom-scrollbar bg-slate-50/50">
        <template x-for="(item, index) in items" :key="index">
            <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm relative group/row transition-all hover:border-sky-200 hover:shadow-md">
                <button type="button" @click="removeItem(index)" 
                        class="absolute -right-2 -top-2 w-6 h-6 bg-rose-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover/row:opacity-100 transition-all z-20 shadow-lg hover:scale-110 active:scale-90">
                    <i class="fas fa-times text-[10px]"></i>
                </button>

                <div class="grid grid-cols-1 gap-4">
                    <template x-for="key in Object.keys(item)" :key="key">
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest block flex items-center gap-1.5">
                                <span class="w-1 h-1 rounded-full bg-sky-400"></span>
                                <span x-text="key"></span>
                            </label>
                            
                            <!-- Image Key Implementation -->
                            <template x-if="isImageKey(key)">
                                <div class="flex gap-4">
                                    <div class="flex-1 space-y-2">
                                        <div class="relative">
                                            <i class="fas fa-link absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-[10px]"></i>
                                            <input type="text" x-model="items[index][key]" @input="$dispatch('change')"
                                                   placeholder="URL atau Path"
                                                   class="w-full pl-8 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-[10px] font-mono focus:bg-white focus:border-sky-500 outline-none transition-all">
                                        </div>
                                        <div class="relative group/json-up">
                                            <input type="file" @change="uploadImage($event, index, key)" accept="image/*"
                                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                            <div class="flex items-center gap-2 p-1.5 rounded-xl border border-dashed border-slate-200 bg-slate-50 group-hover/json-up:bg-sky-50 group-hover/json-up:border-sky-300 transition-all text-center justify-center">
                                                <template x-if="status[`${index}-${key}`] === 'uploading'">
                                                    <i class="fas fa-circle-notch fa-spin text-xs text-sky-500"></i>
                                                </template>
                                                <template x-if="status[`${index}-${key}`] !== 'uploading'">
                                                    <i class="fas fa-upload text-[10px] text-slate-400"></i>
                                                </template>
                                                <span class="text-[9px] font-bold text-slate-500" x-text="status[`${index}-${key}`] === 'uploading' ? '...' : 'UNGGAH'"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-20 h-20 rounded-xl border border-slate-100 bg-slate-100 overflow-hidden flex-shrink-0 shadow-inner flex items-center justify-center group/preview">
                                        <template x-if="items[index][key]">
                                            <img :src="getPreviewUrl(items[index][key])" class="w-full h-full object-cover transition-transform group-hover/preview:scale-110">
                                        </template>
                                        <template x-if="!items[index][key]">
                                            <i class="fas fa-image text-slate-300 text-xl opacity-50"></i>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            <!-- Select Options implementation -->
                            <template x-if="key.toLowerCase() === 'badge'">
                                <input list="list-badge" x-model="items[index][key]" @input="$dispatch('change')"
                                       class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-[11px] font-bold focus:bg-white focus:border-sky-500 outline-none transition-all">
                            </template>
                            <template x-if="key.toLowerCase() === 'color'">
                                <input list="list-color" x-model="items[index][key]" @input="$dispatch('change')"
                                       class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-[11px] font-bold focus:bg-white focus:border-sky-500 outline-none transition-all">
                            </template>

                            <!-- Standard Input -->
                            <template x-if="!isImageKey(key) && !isSelectKey(key)">
                                <input type="text" x-model="items[index][key]" @input="$dispatch('change')"
                                       class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-[11px] font-bold text-slate-700 focus:bg-white focus:border-sky-500 outline-none transition-all shadow-inner">
                            </template>
                        </div>
                    </template>
                </div>
            </div>
        </template>
        
        <template x-if="items.length === 0">
            <div class="py-10 flex flex-col items-center justify-center text-slate-300 border-2 border-dashed border-slate-200 rounded-2xl">
                <i class="fas fa-box-open text-4xl mb-3 opacity-20"></i>
                <p class="text-xs font-bold uppercase tracking-widest">Daftar Kosong</p>
                <button type="button" @click="addItem()" class="mt-4 text-sky-500 font-black text-[10px] uppercase hover:underline">Tambah Item Pertama</button>
            </div>
        </template>
    </div>

    <div x-show="mode === 'raw'" class="bg-slate-900 relative">
        <textarea x-model="raw" @input="syncRaw(); $dispatch('change')" rows="10"
                  class="w-full bg-transparent border-none text-sky-400 font-mono text-[11px] focus:ring-0 resize-none leading-relaxed p-5 custom-scrollbar"></textarea>
        <div class="absolute top-3 right-3 text-[9px] font-mono text-white/20 uppercase">JSON Editor</div>
    </div>
    
    <input type="hidden" name="cms[<?= esc($content['key']) ?>]" :value="JSON.stringify(items)">
</div>
