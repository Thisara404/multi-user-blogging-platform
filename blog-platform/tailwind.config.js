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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'float': 'float 6s ease-in-out infinite',
                'glow': 'glow 2s ease-in-out infinite alternate',
                'slide-up': 'slideUp 0.8s ease-out forwards',
                'fade-in': 'fadeIn 1s ease-out forwards',
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            },
            keyframes: {
                float: {
                    '0%, 100%': {
                        transform: 'translateY(0px) rotate(0deg)',
                    },
                    '50%': {
                        transform: 'translateY(-20px) rotate(3deg)',
                    },
                },
                glow: {
                    from: {
                        boxShadow: '0 0 20px rgba(102, 126, 234, 0.5)',
                    },
                    to: {
                        boxShadow: '0 0 30px rgba(102, 126, 234, 0.8), 0 0 40px rgba(118, 75, 162, 0.5)',
                    },
                },
                slideUp: {
                    from: {
                        opacity: '0',
                        transform: 'translateY(30px)',
                    },
                    to: {
                        opacity: '1',
                        transform: 'translateY(0)',
                    },
                },
                fadeIn: {
                    from: {
                        opacity: '0',
                    },
                    to: {
                        opacity: '1',
                    },
                },
            },
        },
    },

    plugins: [forms],
};
