import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
// import react from '@vitejs/plugin-react';
// import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/common.js",
                "resources/js/topView.js",
                "resources/js/statistics/totalStatistics.js",
                "resources/js/statistics/shortStatistics.js",
                "resources/js/statistics/drawWordCloud.js",
                "resources/js/statistics/drawTimeline.js",
            ],
            refresh: ["resources/routes/**", "routes/**", "resources/views/**"],
        }),
    ],
});
