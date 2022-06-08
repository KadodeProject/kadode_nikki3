const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                kn_b: "#2f3437", //黒
                kn_w: "#f9fff9", //白
                kn_1: "#c7ffc4", //紫
                kn_2: "#ccaa8f", //青
                kn_3: "#1a1616", //灰色
                kn_poor: "#1a1616", //赤
                kn_good: "#1a1616", //緑
                kn_excellent: "#1a1616", //青                kn_bubble: "#1a1616",//灰色
                kn_bubble: "#f9fff9", //青                kn_bubble: "#1a1616",//灰色
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
