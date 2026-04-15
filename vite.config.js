import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import path from 'path';

export default defineConfig({
  plugins: [
    tailwindcss(),
  ],
  build: {
    outDir: 'public/build',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        app: path.resolve(__dirname, 'app/Views/js/app.js'),
        style: path.resolve(__dirname, 'app/Views/css/input.css'),
      },
      output: {
        entryFileNames: '[name].js',
        chunkFileNames: '[name].js',
        assetFileNames: '[name].[ext]',
      },
    },
  },
  server: {
    origin: 'http://localhost:5173',
  },
});

