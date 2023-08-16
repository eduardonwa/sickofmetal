import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            gridTemplateColumns: {
                'auto-fit-100': 'repeat(auto-fit, minmax(1fr, 1fr))',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                '1/3': '33.33333%',
                '2/3': '66.66667%',
                '1/6': '16.666667%',
                '2/6': '33.333333%',
                '4/6': '66.666667%',
                '5/6': '83.333333%',
                '1/12': '8.333333%',
                '2/12': '16.666667%',
                '4/12': '33.333333%',
                '5/12': '41.666667%',
                '7/12': '58.333333%',
                '8/12': '66.666667%',
                '10/12': '83.333333%',
                '11/12': '91.666667%',
            },
            colors: {
                'charcoal': '#212121',
                danger: colors.rose,
                primary: colors.yellow,
                success: colors.green,
                warning: colors.amber,
            },
            border: ['focus'],
        },
        screens: {
            macbook: '1280px',
            ...defaultTheme.screens,
          },
    },

    plugins: [forms],
    darkMode: 'class',
};
