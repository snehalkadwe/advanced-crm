import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    build: {
        outDir: path.resolve(__dirname, "public/build"), // Ensure output goes to public/build
        manifest: true, // Generate a manifest.json file
        rollupOptions: {
            input: {
                // Specify the entry points for your app (you may already have these)
                app: path.resolve(__dirname, "resources/js/app.js"),
                style: path.resolve(__dirname, "resources/css/app.css"),
            },
        },
        emptyOutDir: true, // Clears the build folder before building
    },
});
