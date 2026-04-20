import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import Swal from 'sweetalert2';
import Quill from 'quill';
import 'quill/dist/quill.snow.css';

window.Alpine = Alpine;
window.Swal = Swal;
window.Quill = Quill;

// Register plugins
Alpine.plugin(collapse);

// Initialize Alpine
Alpine.start();

console.log('Alpine.js & Quill initialized via Vite/NPM');
