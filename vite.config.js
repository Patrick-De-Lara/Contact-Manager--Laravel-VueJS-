import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { glob } from 'glob';

// Get all module Vite configs
const moduleConfigs = glob.sync('Modules/*/vite.config.js');

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'Modules/CrudTest/resources/assets/js/app.js' // Add module
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
