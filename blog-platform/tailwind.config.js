import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    safelist: [
        // Hero Section Gradients - First h1
        'bg-gradient-to-r',
        'from-blue-500',
        'to-purple-600',
        'from-yellow-400',
        'via-orange-500',
        'to-pink-500',
        'from-blue-500',
        'to-pink-400',

        // CTA Section Gradients - Second h2
        'from-yellow-300',
        'via-orange-400',
        'to-pink-400',

        // Text utilities
        'bg-clip-text',
        'text-transparent',
        'text-white',
        'text-white/90',
        'text-white/80',

        // All your existing safelist classes
        'gradient-text',
        'block',
        'mb-2',
        'mb-6',
        'text-4xl',
        'text-5xl',
        'text-6xl',
        'text-7xl',
        'md:text-5xl',
        'lg:text-6xl',
        'xl:text-7xl',
        'font-extrabold',
        'tracking-tight',
        'animate-slide-up',
        'max-w-3xl',
        'mx-auto',
        'leading-relaxed',
        'text-xl',
        'md:text-2xl',

        // Layout classes
        'relative',
        'max-w-5xl',
        'text-center',
        'px-4',
        'sm:px-6',
        'lg:px-8',
        'scroll-reveal',

        // All other gradient combinations you use throughout
        'from-pink-400',
        'from-pink-500',
        'from-pink-300',
        'via-pink-400',
        'via-pink-500',
        'to-orange-400',
        'to-orange-500',
        'from-orange-500',
        'from-cyan-300',
        'to-purple-300',
        'from-purple-500',
        'to-violet-500',
        'from-emerald-400',
        'from-indigo-500',
        'to-blue-600',
        'from-rose-500',
        'to-pink-600',
        'from-amber-500',
        'to-orange-600',
        'from-gray-800',
        'to-gray-900',
        'via-purple-500',
        'via-purple-600',
        'via-purple-800',

        // Navbar color classes
        'text-gray-700',
        'text-gray-900',
        'hover:text-gray-900',
        'hover:text-white',
        'from-blue-600',
        'via-purple-600',
        'to-pink-600',
        'bg-blue-600',
        'hover:bg-blue-700',
        'hover:bg-gray-100',

        // Initial state classes
        'hover:text-white',
        'hover:bg-white/10',
        'hover:backdrop-blur-sm',

        // All your existing classes...
        // (keep all the existing safelist items from your current config)
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
