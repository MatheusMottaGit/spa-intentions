import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // vite localhost do not work on Docker
        port: 5173,
        hmr: {
            host: 'localhost', // hot module replacement for my localhost
        },
    },
});
