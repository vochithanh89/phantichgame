import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            // setup primary-secondary color, example: https://flowbite.com/docs/customize/colors
            colors: {
                primary: {
                    '50': '#f3f4fa',
                    '100': '#e9ebf6',
                    '200': '#d7d9ee',
                    '300': '#bfc1e2',
                    '400': '#a5a4d5',
                    '500': '#938dc7',
                    '600': '#7569b0',
                    '700': '#6e639f',
                    '800': '#5a5281',
                    '900': '#4c4669',
                    '950': '#2c293d',
                },
                transparent: 'transparent',
                current: 'currentColor',
            },
            boxShadow: {
                'card': '0 2px 20px 0px rgb(0 0 0 / 4%)',
            },
            animation: {
                'slow-bounce': 'bounce 5s linear infinite',
                'ring': 'ring 1s infinite'
            }
        },
    },

    plugins: [forms],
};
