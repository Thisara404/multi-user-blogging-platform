<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Multi-User Blogging Platform</title>
    <meta name="description"
        content="A powerful multi-user blogging platform built with Laravel. Create, share, and discover amazing content with our community-driven blog.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .feature-card {
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .hero-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(255, 255, 255, 0.15) 1px, transparent 0);
            background-size: 40px 40px;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Navigation Header -->
    <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                        </div>
                        <h1 class="text-xl font-bold text-white">BlogSphere</h1>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#features"
                            class="text-white/80 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">Features</a>
                        <a href="#about"
                            class="text-white/80 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">About</a>
                        <a href="{{ route('blog.index') }}"
                            class="text-white/80 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">Explore</a>
                        <a href="#pricing"
                            class="text-white/80 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300">Pricing</a>
                    </div>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="glass-effect text-white px-6 py-2 rounded-full text-sm font-medium transition duration-300 hover:bg-white/20">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-white/80 hover:text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-2 rounded-full text-sm font-semibold transition duration-300 shadow-lg">
                            Get Started Free
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen gradient-bg hero-pattern relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full animate-float"></div>
            <div class="absolute top-40 -left-20 w-60 h-60 bg-white/5 rounded-full animate-float"
                style="animation-delay: -2s;"></div>
            <div class="absolute bottom-20 right-20 w-40 h-40 bg-white/10 rounded-full animate-float"
                style="animation-delay: -4s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center min-h-screen">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <div class="mb-8">
                        <span
                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm">
                            🚀 Now with AI-powered writing assistance
                        </span>
                    </div>

                    <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl xl:text-7xl">
                        <span class="block">Create</span>
                        <span
                            class="block bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Amazing
                            Stories</span>
                        <span class="block">That Matter</span>
                    </h1>

                    <p
                        class="mt-6 text-lg text-white/90 sm:text-xl md:mt-8 md:text-2xl lg:text-xl xl:text-2xl max-w-3xl">
                        Join thousands of writers on the most powerful blogging platform. Share your thoughts, build
                        your
                        audience, and turn your passion into profit.
                    </p>

                    <div class="mt-10 sm:flex sm:justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('register') }}"
                            class="w-full sm:w-auto flex items-center justify-center px-8 py-4 border border-transparent text-lg font-semibold rounded-full text-blue-600 bg-white hover:bg-gray-50 transition duration-300 shadow-xl">
                            Start Writing Today
                            <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="{{ route('blog.index') }}"
                            class="w-full sm:w-auto flex items-center justify-center px-8 py-4 border-2 border-white text-lg font-semibold rounded-full text-white hover:bg-white hover:text-blue-600 transition duration-300">
                            Explore Stories
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="mt-12 grid grid-cols-3 gap-8 text-center lg:text-left">
                        <div>
                            <div class="text-3xl font-bold text-white">50K+</div>
                            <div class="text-white/70">Active Writers</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-white">1M+</div>
                            <div class="text-white/70">Stories Published</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-white">10M+</div>
                            <div class="text-white/70">Monthly Readers</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Image/Illustration -->
                <div class="mt-16 lg:mt-0 lg:col-span-6">
                    <div class="relative mx-auto w-full max-w-lg">
                        <div class="relative">
                            <!-- Modern Illustration -->
                            <div
                                class="w-full h-96 bg-white/10 rounded-3xl backdrop-blur-sm border border-white/20 p-8 shadow-2xl">
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-pink-500 to-red-500 rounded-full">
                                        </div>
                                        <div class="flex-1 space-y-2">
                                            <div class="h-3 bg-white/30 rounded w-3/4"></div>
                                            <div class="h-2 bg-white/20 rounded w-1/2"></div>
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="h-4 bg-white/40 rounded"></div>
                                        <div class="h-4 bg-white/30 rounded w-5/6"></div>
                                        <div class="h-4 bg-white/30 rounded w-4/6"></div>
                                        <div class="h-32 bg-white/20 rounded-lg"></div>
                                        <div class="flex space-x-2">
                                            <div class="h-6 bg-white/30 rounded-full w-16"></div>
                                            <div class="h-6 bg-white/30 rounded-full w-20"></div>
                                            <div class="h-6 bg-white/30 rounded-full w-14"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-16">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Everything you need to succeed
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Professional tools and features to help you create, manage, and monetize your content.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Rich Text Editor</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Professional writing tools with real-time collaboration, image uploads, and advanced formatting
                        options.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Community Driven</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Connect with like-minded writers, get feedback, and build meaningful relationships within our
                        community.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Analytics & Insights</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Track your performance with detailed analytics. Understand your audience and optimize your
                        content
                        strategy.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Secure & Reliable</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Your content is safe with enterprise-grade security, automatic backups, and 99.9% uptime
                        guarantee.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Monetization</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Turn your passion into profit with built-in monetization tools, subscriptions, and premium
                        content
                        features.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Customization</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Customize your blog with beautiful themes, custom domains, and advanced branding options.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-16">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Pricing</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Choose your plan
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Start free and upgrade as you grow. All plans include our core features.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Free Plan -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                    <div class="text-center">
                        <h3 class="text-2xl font-semibold text-gray-900">Starter</h3>
                        <div class="mt-4 flex items-baseline justify-center">
                            <span class="text-4xl font-extrabold text-gray-900">$0</span>
                            <span class="text-lg text-gray-500 ml-1">/month</span>
                        </div>
                        <p class="mt-4 text-gray-500">Perfect for getting started</p>
                    </div>
                    <ul class="mt-8 space-y-4">
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 text-gray-700">5 blog posts</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 text-gray-700">Basic analytics</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 text-gray-700">Community support</span>
                        </li>
                    </ul>
                    <div class="mt-8">
                        <a href="{{ route('register') }}"
                            class="w-full bg-gray-800 text-white py-3 px-6 rounded-lg font-semibold hover:bg-gray-700 transition duration-300 block text-center">
                            Get Started
                        </a>
                    </div>
                </div>

                <!-- Pro Plan -->
                <div class="bg-blue-600 rounded-2xl shadow-xl border-2 border-blue-600 p-8 relative">
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        <span class="bg-yellow-400 text-yellow-900 px-4 py-1 rounded-full text-sm font-semibold">Most
                            Popular</span>
                    </div>
                    <div class="text-center">
                        <h3 class="text-2xl font-semibold text-white">Professional</h3>
                        <div class="mt-4 flex items-baseline justify-center">
                            <span class="text-4xl font-extrabold text-white">$19</span>
                            <span class="text-lg text-blue-200 ml-1">/month</span>
                        </div>
                        <p class="mt-4 text-blue-200">For serious bloggers</p>
                    </div>
                    <ul class="mt-8 space-y-4">
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 text-white">Unlimited posts</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 text-white">Advanced analytics</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 text-white">Custom domain</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 text-white">Priority support</span>
                        </li>
                    </ul>
                    <div class="mt-8">
                        <a href="{{ route('register') }}"
                            class="w-full bg-white text-blue-600 py-3 px-6 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 block text-center">
                            Start Free Trial
                        </a>
                    </div>
                </div>

                <!-- Enterprise Plan -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8">
                    <div class="text-center">
                        <h3 class="text-2xl font-semibold text-gray-900">Enterprise</h3>
                        <div class="mt-4 flex items-baseline justify-center">
                            <span class="text-4xl font-extrabold text-gray-900">$99</span>
                            <span class="text-lg text-gray-500 ml-1">/month</span>
                        </div>
                        <p class="mt-4 text-gray-500">For large organizations</p>
                    </div>
                    <ul class="mt-8 space-y-4">
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 text-gray-700">Everything in Pro</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 text-gray-700">Multi-user management</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 text-gray-700">API access</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3 text-gray-700">24/7 phone support</span>
                        </li>
                    </ul>
                    <div class="mt-8">
                        <a href="{{ route('register') }}"
                            class="w-full bg-gray-800 text-white py-3 px-6 rounded-lg font-semibold hover:bg-gray-700 transition duration-300 block text-center">
                            Contact Sales
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg py-20">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                <span class="block">Ready to share your story?</span>
                <span class="block">Join thousands of creators today.</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-white/90">
                Start your blogging journey with the most powerful platform for creators.
            </p>
            <div class="mt-8 flex justify-center space-x-4">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-blue-600 bg-white hover:bg-gray-100 transition duration-300">
                    Start Writing for Free
                </a>
                <a href="{{ route('blog.index') }}"
                    class="inline-flex items-center justify-center px-8 py-3 border-2 border-white text-base font-medium rounded-full text-white hover:bg-white hover:text-blue-600 transition duration-300">
                    Explore Stories
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                        </div>
                        <h3 class="text-xl font-bold text-white">BlogSphere</h3>
                    </div>
                    <p class="text-gray-400 max-w-md">
                        The most powerful blogging platform for creators. Built with Laravel, powered by community.
                    </p>
                    <div class="flex space-x-6 mt-6">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase mb-4">Platform</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition duration-300">Features</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition duration-300">Pricing</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">API</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition duration-300">Status</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase mb-4">Support</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition duration-300">Documentation</a>
                        </li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Help
                                Center</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition duration-300">Contact</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition duration-300">Community</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-700 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} BlogSphere. All rights reserved. Built with ❤️ using Laravel.
                </p>
                <div class="mt-4 md:mt-0 flex space-x-6">
                    <a href="#"
                        class="text-gray-400 hover:text-white text-sm transition duration-300">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">Terms</a>
                    <a href="#"
                        class="text-gray-400 hover:text-white text-sm transition duration-300">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript for navbar scroll effect -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white', 'shadow-lg');
                navbar.classList.remove('bg-transparent');
                // Change text colors
                navbar.querySelectorAll('a, h1').forEach(el => {
                    if (el.classList.contains('text-white')) {
                        el.classList.remove('text-white');
                        el.classList.add('text-gray-900');
                    }
                    if (el.classList.contains('text-white/80')) {
                        el.classList.remove('text-white/80');
                        el.classList.add('text-gray-600');
                    }
                });
            } else {
                navbar.classList.remove('bg-white', 'shadow-lg');
                navbar.classList.add('bg-transparent');
                // Restore original colors
                navbar.querySelectorAll('a, h1').forEach(el => {
                    if (el.classList.contains('text-gray-900')) {
                        el.classList.remove('text-gray-900');
                        el.classList.add('text-white');
                    }
                    if (el.classList.contains('text-gray-600')) {
                        el.classList.remove('text-gray-600');
                        el.classList.add('text-white/80');
                    }
                });
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>
