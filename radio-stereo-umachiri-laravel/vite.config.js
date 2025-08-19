import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'public/css/admin.css',
                'public/css/login.css',
                'public/css/programs.css',
                'public/css/global.css',
            ],
            refresh: true,
        }),
    ],
    publicDir: 'public', // Asegurando que la carpeta pública se sirva correctamente
});
