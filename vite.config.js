import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";
import { fileURLToPath } from "node:url";
export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.js", "resources/css/app.css", "resources/css/filament.css"],
            refresh: true
        }),
        react()
    ],
    define: { "process.env": {} },
    resolve: {
        alias: {
            "@": fileURLToPath(new URL("./resources/js", import.meta.url)),
            "@api": fileURLToPath(new URL("./resources/js/api", import.meta.url)),
            "@components": fileURLToPath(new URL("./resources/js/components", import.meta.url)),
            "@helpers": fileURLToPath(new URL("./resources/js/helpers", import.meta.url)),
            react: "preact/compat",
            "react-dom": "preact/compat"
        }
    }
});
