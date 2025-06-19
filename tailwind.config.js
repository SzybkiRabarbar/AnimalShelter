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
            colors: {
                primary: '#6ab547',
                background: '#ffffff',
                dirtyBackground: '#f8fff5',
                text: '#000000',
                border: '#e5e7eb',
                accent: '#edd83d',
                danger: '#ef4444',
                success: '#6ab547',
            },
        },
    },

    plugins: [forms],
};
