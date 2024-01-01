import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            hotFile: 'public/vendor/insyht/larvelous-shop/larvelous-shop.hot',
            buildDirectory: 'vendor/insyht/larvelous-shop',
            input: [
                'resources/js/app.js',
                'resources/sass/larvelous-shop.scss'
            ],
            refresh: true,
        }),
    ],
});
