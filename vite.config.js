import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            hotFile: 'public/vendor/insyht/larvelous-shop/larvelous-shop.hot',
            buildDirectory: 'vendor/insyht/larvelous-shop',
            input: [
                'node_modules/bootstrap/dist/js/bootstrap.js',
                'resources/js/app.js',
                'resources/sass/app.scss'
            ],
            refresh: true,
        }),
    ],
});
