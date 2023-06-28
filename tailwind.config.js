import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                '1/3': '33.33333%',
                '2/3': '66.66667%'
            },
            colors: {
                'charcoal': '#212121',
            },
            border: ['focus'],
        },
    },

    plugins: [forms],
    darkMode: 'class',
};
