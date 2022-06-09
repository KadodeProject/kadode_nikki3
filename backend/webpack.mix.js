const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/common.js", "public/js")
    .js("resources/js/topView.js", "public/js")
    .js("resources/js/statistics/totalStatistics.js", "public/js")
    .js("resources/js/statistics/shortStatistics.js", "public/js")
    .js("resources/js/statistics/drawWordCloud.js", "public/js")
    .js("resources/js/statistics/drawTimeline.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        require("postcss-import"),
        require("tailwindcss"),
    ])
    .version();
mix.browserSync({
    proxy: "localhost:80",
    files: [
        "resources/views/**/*.blade.php",
        "public/css/*.css",
        "public/js/*.js",
    ],
    open: true,
    reloadOnRestart: true,
});

if (mix.inProduction()) {
    mix.version();
}
