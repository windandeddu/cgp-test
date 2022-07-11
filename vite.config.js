import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    resolve:{
        alias:[
            {find: "~bootstrap", replacement: "bootstrap"},
            {find: "~admin-lte", replacement: "admin-lte"}
        ]
    },
    plugins: [
        laravel([
            'resources/sass/app.scss',
            'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
});
