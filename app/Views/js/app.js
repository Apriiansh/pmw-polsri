import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
window.Swal = Swal;

// Register plugins
Alpine.plugin(collapse);

// Initialize Alpine
Alpine.start();

console.log('Alpine.js initialized via Vite/NPM');
