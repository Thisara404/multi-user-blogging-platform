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
        // Complete gradient system
        'bg-gradient-to-r',
        'bg-gradient-to-l',
        'bg-gradient-to-t',
        'bg-gradient-to-b',
        'bg-gradient-to-br',
        'bg-gradient-to-bl',
        'bg-gradient-to-tr',
        'bg-gradient-to-tl',
        
        // All color combinations you use
        'from-yellow-300',
        'from-yellow-400',
        'from-yellow-500',
        'via-orange-400',
        'via-orange-500',
        'to-pink-400',
        'to-pink-500',
        'to-pink-300',
        'from-blue-500',
        'from-blue-400',
        'from-blue-600',
        'to-purple-600',
        'to-purple-500',
        'via-purple-500',
        'via-purple-600',
        'via-purple-800',
        'from-pink-400',
        'from-pink-500',
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
        
        // Text utilities
        'bg-clip-text',
        'text-transparent',
        'text-white',
        'text-white/90',
        'text-white/80',
        'text-gray-900',
        'text-gray-800',
        'text-gray-700',
        'text-gray-600',
        'text-gray-500',
        'text-blue-600',
        'text-purple-600',
        'text-pink-600',
        
        // Background colors
        'bg-white',
        'bg-gray-50',
        'bg-gray-100',
        'bg-gray-900',
        'bg-blue-100',
        'bg-purple-100',
        'bg-transparent',
        
        // Layout and spacing
        'min-h-screen',
        'max-w-7xl',
        'max-w-5xl',
        'max-w-3xl',
        'mx-auto',
        'px-4',
        'px-6',
        'px-8',
        'py-2',
        'py-4',
        'py-6',
        'py-8',
        'py-12',
        'py-16',
        'py-20',
        'py-24',
        
        // Flexbox and grid
        'flex',
        'grid',
        'items-center',
        'justify-center',
        'justify-between',
        'space-x-2',
        'space-x-4',
        'space-x-6',
        'space-x-8',
        'space-y-4',
        'space-y-6',
        'space-y-8',
        'gap-6',
        'gap-8',
        'gap-12',
        
        // Typography
        'text-xs',
        'text-sm',
        'text-lg',
        'text-xl',
        'text-2xl',
        'text-3xl',
        'text-4xl',
        'text-5xl',
        'text-6xl',
        'text-7xl',
        'font-medium',
        'font-semibold',
        'font-bold',
        'font-extrabold',
        'leading-tight',
        'leading-relaxed',
        'tracking-tight',
        
        // Border and radius
        'rounded-full',
        'rounded-lg',
        'rounded-xl',
        'rounded-2xl',
        'rounded-3xl',
        'border',
        'border-2',
        'border-white',
        'border-gray-200',
        'border-blue-200',
        
        // Shadows and effects
        'shadow-sm',
        'shadow-lg',
        'shadow-xl',
        'shadow-2xl',
        'backdrop-blur-sm',
        'backdrop-blur-md',
        'backdrop-blur-xl',
        
        // Animation classes
        'animate-pulse',
        'animate-float',
        'animate-glow',
        'animate-slide-up',
        'animate-fade-in',
        'animate-pulse-slow',
        
        // Transitions
        'transition-all',
        'transition-colors',
        'transition-transform',
        'duration-300',
        'duration-500',
        'ease-in-out',
        'ease-out',
        
        // Hover states
        'hover:bg-gray-50',
        'hover:bg-gray-100',
        'hover:bg-blue-700',
        'hover:text-white',
        'hover:text-blue-600',
        'hover:scale-105',
        'hover:scale-110',
        'hover:translate-x-1',
        'hover:shadow-xl',
        'hover:shadow-2xl',
        
        // Responsive classes
        'sm:text-xl',
        'md:text-2xl',
        'lg:text-xl',
        'xl:text-2xl',
        'sm:text-5xl',
        'md:text-6xl',
        'xl:text-7xl',
        'sm:px-6',
        'lg:px-8',
        'md:grid-cols-2',
        'lg:grid-cols-3',
        'lg:col-span-6',
        'sm:rounded-lg',
        'sm:max-w-md',
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
