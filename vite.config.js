import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: 'bakeryku.test',
        port: 5173,
        hmr: {
            host: 'bakeryku.test',
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
