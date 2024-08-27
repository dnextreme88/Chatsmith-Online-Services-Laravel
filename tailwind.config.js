import preset from './vendor/filament/support/tailwind.config.preset'
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    darkMode: 'selector',
    content: [
        './app/Filament/**/*.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms],
};
