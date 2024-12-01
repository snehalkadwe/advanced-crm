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
        // rollupOptions: {
        //     input: {
        //         app: "resources/js/app.js",
        //     },
        // },
        emptyOutDir: true, // Clears the build folder before building
    },
});
