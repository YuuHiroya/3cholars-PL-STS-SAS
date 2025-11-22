import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // server: {
    //     host: '3cholars-pl-sts-sas.test',
    //     port: 5173,
    //     hmr: {
    //         host: '3cholars-pl-sts-sas.test',
    //     },
    // },
    // // NOTE FOR MONICA, UNCOMMENT DULU INI
    server: {
        host: 'aplikasi_beasiswa_project_sas.test',
        port: 5173,
        hmr: {
            host: 'aplikasi_beasiswa_project_sas.test',
        },
    },
});
