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
                    '50': '#fbf6fe',
                    '100': '#f5ebfc',
                    '200': '#eddbf9',
                    '300': '#dfbef4',
                    '400': '#cb95eb',
                    '500': '#ba72e2',
                    '600': '#a34cd1',
                    '700': '#8c3ab6',
                    '800': '#763495',
                    '900': '#602b78',
                    '950': '#421457',
                },
                secondary: {
                    '50': '#f0f8ff',
                    '100': '#e0f1fe',
                    '200': '#bae3fd',
                    '300': '#86d1fd',
                    '400': '#37b4f9',
                    '500': '#0d9cea',
                    '600': '#017bc8',
                    '700': '#0261a2',
                    '800': '#065386',
                    '900': '#0b456f',
                    '950': '#082c49',
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
