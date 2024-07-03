import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import { initFlowbite } from 'flowbite';

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
            },colors: {
                lilac: '#C8A2C8',
                peach: '#FFDAB9',
            },
            backdropBlur: {
                'none': 'none',
                'sm': '4px',
                'md': '10px',
                'lg': '20px',
                'xl': '40px',
            }
        },
    },

    plugins: [forms, typography],
};
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
    ],
    theme: {
      extend: {},
    },
    plugins: [
        require('flowbite/plugin')({
            charts: true,
        }),
    ],
  }
  
