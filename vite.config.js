import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    build: {
        outDir: "public/build",
        manifest: true,
        rollupOptions: {
            input: {
                main: "resources/js/app.js",
            },
        },
        emptyOutDir: true, // Clears the build folder before building
    },
});
