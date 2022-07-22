const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                kn_b: "#2f3437", //黒
                kn_w: "#f9fff9", //白
                kn_1: "#624464", //紫
                kn_2: "#4b8996", //青
                kn_3: "#8a8772", //灰色
                kn_poor: "#e2534a", //赤
                kn_good: "#339c76", //緑
                kn_excellent: "#33769c", //青                kn_bubble: "#1a1616",//灰色
                kn_bubble: "#f9fff9", //青                kn_bubble: "#1a1616",//灰色
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
