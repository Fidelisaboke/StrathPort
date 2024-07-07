import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

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
                montserrat: ['Montserrat', defaultTheme.fontFamily.sans],
            },
            keyframes: {
                'slide-in': {
                  '0%': { opacity: 0, transform: 'translateY(-20px)' },
                  '100%': { opacity: 1, transform: 'translateY(0)' },
                },
                'slide-out': {
                  '0%': { opacity: 1, transform: 'translateY(0)' },
                  '100%': { opacity: 0, transform: 'translateY(-20px)' },
                },
            },
            animation: {
                'slide-in': 'slide-in 0.5s ease-out',
                'slide-out': 'slide-out 0.5s ease-out',
            },
        },
    },

    plugins: [forms, typography],
};
