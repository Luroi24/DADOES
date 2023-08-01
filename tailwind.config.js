import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import daisyui from 'daisyui';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                scrollBar: '#D2DAFF',
                messageBubble: '#EEF1FF',
                responseBubble: '#B1B2FF',
                frame: '#AAC4FF',
            },
        },
    },

    plugins: [forms, typography, require('daisyui'), require('tailwind-scrollbar')({ nocompatible: true })],
};