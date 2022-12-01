/** @type {import('tailwindcss').Config} */

module.exports = {
    mode: 'jit',
    content: ['./src/**/*.{js,ts,jsx,tsx}'],
    darkMode: 'class', // or 'media' or 'class'
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
