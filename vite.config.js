import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),

    ],
    build: {
        outDir: 'dist', // diretório onde os arquivos serão gerados
        assetsDir: 'assets', // diretório para arquivos estáticos
        sourcemap: false, // desativa sourcemaps para produção
    },
});
