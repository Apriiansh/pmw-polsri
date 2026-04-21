/**
 * Announcement Form Logic
 * Handling QuillJS initialization, Slug generation, and Form validation
 */
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const form = document.getElementById('announcementForm');
    const contentInput = document.getElementById('contentInput');

    // 1. Slug Logic (Automatic generation from title)
    if (titleInput && slugInput && !slugInput.readOnly === false) {
        titleInput.addEventListener('input', function() {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            slugInput.value = slug;
        });
    }

    // 2. QuillJS Initialization
    const quillEl = document.getElementById('quillEditor');
    if (quillEl) {
        const quill = new Quill('#quillEditor', {
            theme: 'snow',
            placeholder: 'Tulis detail pengumuman di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered' }],
                    ['link', 'blockquote', 'code-block'],
                    ['clean']
                ]
            }
        });

        // Helper to sync Quill content to hidden input
        const updatePreview = () => {
            const delta = quill.getContents();
            contentInput.value = JSON.stringify(delta);
        };

        // Sync on changes
        quill.on('text-change', updatePreview);

        // Initial sync (handling potential Alpine.js delay)
        if (window.Alpine) {
            updatePreview();
        } else {
            document.addEventListener('alpine:initialized', updatePreview);
        }
        setTimeout(updatePreview, 100);

        // 3. Form Submission & Validation
        if (form) {
            form.addEventListener('submit', function(e) {
                updatePreview();
                
                const delta = quill.getContents();
                const isBlank = delta.ops.length === 0 || 
                               (delta.ops.length === 1 && delta.ops[0].insert === '\n');
                
                if (isBlank) {
                    e.preventDefault();
                    if (window.Swal) {
                        Swal.fire({
                            title: 'Konten Kosong',
                            text: 'Isi pengumuman tidak boleh kosong!',
                            icon: 'error',
                            borderRadius: '1.5rem'
                        });
                    } else {
                        alert('Isi pengumuman tidak boleh kosong!');
                    }
                    return;
                }
            });
        }
    }
});
