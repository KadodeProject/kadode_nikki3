/** @type {import('tailwindcss').Config} */

module.exports = {
    mode: 'jit',
    purge: [
        '.src/pages/**/*.{js,ts,jsx,tsx}',
        '.src/layout/**/*.{js,ts,jsx,tsx}',
        '.src/components/**/*.{js,ts,jsx,tsx}',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            colors: {},
        },
        fontFamily: {},
    },
    variants: {
        extend: {},
    },
    plugins: [],
};
