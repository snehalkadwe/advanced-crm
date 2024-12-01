import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    build: {
        manifest: true, // Generates manifest.json
        outDir: "dist",
        rollupOptions: {
            output: {
                assetFileNames: "[name].[hash].[ext]",
                chunkFileNames: "[name].[hash].js",
            },
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
