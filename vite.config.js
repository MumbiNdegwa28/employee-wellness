import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/slideshow.css',
                'resources/js/slideshow.js',
            ],
            refresh: true,
            resolve: {
                alias: {
                  'laravel-echo': path.resolve(__dirname, 'node_modules/laravel-echo')
                }
            }    
        }),
    ],
});
