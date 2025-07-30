<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BlogSphere - Multi-User Blogging Platform</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    <meta name="description"
        content="A powerful multi-user blogging platform built with Laravel. Create, share, and discover amazing content with our community-driven blog.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes glow {
            0%,
            100% {
                box-shadow: 0 0 20px rgba(102, 126, 234, 0.5);
            }

            50% {
                box-shadow: 0 0 30px rgba(102, 126, 234, 0.8), 0 0 40px rgba(118, 75, 162, 0.5);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }

            100% {
                background-position: calc(200px + 100%) 0;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(3deg);
            }
        }

        .animate-glow {
            animation: glow 3s ease-in-out infinite;
        }

        .animate-shimmer {
            animation: shimmer 2s ease-in-out infinite;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>

<body class="font-sans antialiased bg-white">
    <!-- Navigation Header -->
    <nav class="fixed w-full z-50 transition-all duration-500 bg-transparent" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-blue-500 via-purple-600 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold text-white tracking-tight">BlogSphere</h1>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="{{ route('blog.index') }}"
                            class="nav-link text-white/90 hover:text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white/10 hover:backdrop-blur-sm">All Posts</a>
                        @auth
                            <a href="{{ route('posts.create') }}"
                                class="nav-link text-white/80 hover:text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-purple-500/20 hover:backdrop-blur-sm">Write</a>
                            <a href="{{ route('dashboard') }}"
                                class="nav-link text-white/80 hover:text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-purple-500/20 hover:backdrop-blur-sm">Dashboard</a>
                            @hasrole('admin')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="nav-link text-white/90 hover:text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white/10 hover:backdrop-blur-sm">Admin</a>
                            @endhasrole
                        @else
                            <a href="#features"
                                class="nav-link text-white/90 hover:text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white/10 hover:backdrop-blur-sm">Features</a>
                            <a href="#pricing"
                                class="nav-link text-white/90 hover:text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white/10 hover:backdrop-blur-sm">Pricing</a>
                        @endauth
                    </div>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="nav-link text-white/90 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white/10">
                            My Account
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="nav-link text-white/90 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white/10">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            Get Started Free
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen gradient-bg hero-pattern relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-white/10 rounded-full animate-float blob"></div>
            <div class="absolute top-40 -left-32 w-80 h-80 bg-white/5 rounded-full animate-float blob"
                style="animation-delay: -2s;"></div>
            <div class="absolute bottom-20 right-20 w-60 h-60 bg-white/10 rounded-full animate-float blob"
                style="animation-delay: -4s;"></div>
            <div
                class="absolute top-1/2 left-1/4 w-40 h-40 bg-gradient-to-r from-pink-400/20 to-purple-400/20 rounded-full animate-pulse-slow">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">
            <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center min-h-screen">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <div class="mb-8 animate-slide-up">
                        <span
                            class="inline-flex items-center px-6 py-3 rounded-full text-sm font-medium glass-effect text-pink-400 backdrop-blur-sm border border-white/20 shadow-xl">
                            <span class=" animate-pulse mr-2">🚀</span>
                            Now with AI-powered writing assistance
                        </span>
                    </div>

                    <h1 class="text-4xl tracking-tight font-extrabold sm:text-5xl md:text-6xl xl:text-7xl animate-slide-up">
                        <span class="block mb-2 hero-gradient-1">Create</span>
                        <span class="block hero-gradient-2 mb-2">
                            Amazing Stories
                        </span>
                        <span class="block mb-2 hero-gradient-3">That Matter</span>
                    </h1>

                    <p
                        class="mt-8 text-lg bg-gradient-to-r from-blue-400 via-purple-800 to-purple-600 bg-clip-text text-transparent sm:text-xl md:text-2xl lg:text-xl xl:text-2xl max-w-3xl leading-relaxed animate-fade-in">
                        Join thousands of writers on the most powerful blogging platform. Share your thoughts, build
                        your audience, and turn your passion into profit with our cutting-edge tools.
                    </p>

                    <div
                        class="mt-12 sm:flex sm:justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-6 animate-slide-up">
                        @auth
                            <a href="{{ route('posts.create') }}"
                                class="group w-full sm:w-auto flex items-center justify-center px-10 py-4 border border-transparent text-lg font-semibold rounded-full text-blue-600 bg-white hover:bg-gray-50 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105">
                                Start Writing Today
                                <svg class="ml-3 w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                                class="group w-full sm:w-auto flex items-center justify-center px-10 py-4 border border-transparent text-lg font-semibold rounded-full text-blue-600 bg-white hover:bg-gray-50 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105">
                                Start Writing Today
                                <svg class="ml-3 w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endauth
                        <a href="{{ route('blog.index') }}"
                            class="group w-full sm:w-auto flex items-center justify-center px-10 py-4 border-2 border-blue-200/80 text-lg font-semibold rounded-full bg-gradient-to-r from-blue-400 via-pink-400 to-orange-400 bg-clip-text text-transparent hover:from-blue-300 hover:via-pink-300 hover:to-orange-300 hover:bg-gradient-to-r hover:bg-blue-500/20 transition-all duration-300 backdrop-blur-sm hover:border-pink-200 shadow-lg hover:shadow-pink-500/25">
                            <svg class="mr-3 w-5 h-5 text-blue-300 group-hover:text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Explore Posts
                        </a>
                    </div>

                    <!-- Enhanced Stats -->
                    <div class="mt-16 grid grid-cols-3 gap-8 animate-fade-in">
                        <div class="text-center lg:text-left">
                            <div
                                class="text-4xl font-bold bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent mb-1">
                                50K+</div>
                            <div class="text-blue-200 text-sm font-medium">Active Writers</div>
                            <div class="w-full bg-white/20 h-1 rounded-full mt-2">
                                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 h-1 rounded-full w-3/4">
                                </div>
                            </div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div
                                class="text-4xl font-bold bg-gradient-to-r from-pink-500 to-purple-600 bg-clip-text text-transparent mb-1">
                                1M+</div>
                            <div class="text-purple-300 text-sm font-medium">Stories Published</div>
                            <div class="w-full bg-white/20 h-1 rounded-full mt-2">
                                <div class="bg-gradient-to-r from-pink-400 to-purple-500 h-1 rounded-full w-4/5"></div>
                            </div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div
                                class="text-4xl font-bold bg-gradient-to-r from-blue-500 to-cyan-500 bg-clip-text text-transparent mb-1">
                                10M+</div>
                            <div class="text-cyan-300 text-sm font-medium">Monthly Readers</div>
                            <div class="w-full bg-white/20 h-1 rounded-full mt-2">
                                <div class="bg-gradient-to-r from-blue-400 to-cyan-500 h-1 rounded-full w-full"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Hero Illustration -->
                <div class="mt-16 lg:mt-0 lg:col-span-6">
                    <div class="relative mx-auto w-full max-w-lg">
                        <div class="relative">
                            <!-- Modern Blog Post Preview -->
                            <div
                                class="w-full bg-white/10 rounded-3xl backdrop-blur-xl border border-white/20 p-8 shadow-2xl transform hover:scale-105 transition-all duration-500 animate-glow animate-float">
                                <div class="space-y-6">
                                    <!-- Header -->
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-12 h-12 bg-gradient-to-r from-pink-500 to-violet-500 rounded-full flex items-center justify-center shadow-lg">
                                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80"
                                                alt="Author" class="w-10 h-10 rounded-full object-cover">
                                        </div>
                                        <div class="flex-1 space-y-2">
                                            <div class="text-cyan-300 font-semibold text-sm">Sarah Chen</div>
                                            <div class="text-purple-300 text-xs">AI & Tech Writer • 5 min read</div>
                                        </div>
                                        <div class="flex space-x-1">
                                            <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                                            <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"
                                                style="animation-delay: 0.2s;"></div>
                                            <div class="w-2 h-2 bg-pink-400 rounded-full animate-pulse"
                                                style="animation-delay: 0.4s;"></div>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="space-y-4">
                                        <!-- Main title -->
                                        <h2
                                            class="text-xl font-bold bg-gradient-to-r from-cyan-300 to-purple-300 bg-clip-text text-transparent leading-tight">
                                            The Future of AI: How Machine Learning is Transforming Creative Industries
                                        </h2>

                                        <!-- Subtitle lines -->
                                        <p class="text-slate-300 text-sm leading-relaxed">
                                            Discover how artificial intelligence is revolutionizing design, writing, and
                                            content creation.
                                            From automated workflows to enhanced creativity, explore the tools shaping
                                            tomorrow's digital landscape.
                                        </p>

                                        <!-- Hero Image -->
                                        <div
                                            class="relative h-40 bg-gradient-to-r from-purple-500/20 to-blue-500/20 rounded-xl overflow-hidden group">
                                            <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                                                alt="AI and creativity visualization"
                                                class="w-full h-full object-cover rounded-xl opacity-90 group-hover:opacity-100 group-hover:scale-110 transition-all duration-500">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-purple-900/30 to-transparent">
                                            </div>
                                            <div class="absolute bottom-3 left-3 right-3">
                                                <div class="text-cyan-200 text-xs font-medium">Featured: Neural
                                                    networks creating digital art</div>
                                            </div>
                                        </div>

                                        <!-- Key Points -->
                                        <div class="space-y-2">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></div>
                                                <span class="text-slate-300 text-sm">AI-powered design tools increasing
                                                    productivity by 300%</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <div class="w-1.5 h-1.5 bg-purple-400 rounded-full"></div>
                                                <span class="text-slate-300 text-sm">Creative professionals adapting to
                                                    new workflows</span>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <div class="w-1.5 h-1.5 bg-pink-400 rounded-full"></div>
                                                <span class="text-slate-300 text-sm">Ethical considerations in
                                                    AI-generated content</span>
                                            </div>
                                        </div>

                                        <!-- Tags -->
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="px-3 py-1 bg-gradient-to-r from-blue-500/30 to-cyan-500/30 text-cyan-200 text-xs rounded-full border border-cyan-400/30">
                                                #AI
                                            </span>
                                            <span
                                                class="px-3 py-1 bg-gradient-to-r from-purple-500/30 to-pink-500/30 text-purple-200 text-xs rounded-full border border-purple-400/30">
                                                #CreativeTech
                                            </span>
                                            <span
                                                class="px-3 py-1 bg-gradient-to-r from-emerald-500/30 to-teal-500/30 text-emerald-200 text-xs rounded-full border border-emerald-400/30">
                                                #Innovation
                                            </span>
                                            <span
                                                class="px-3 py-1 bg-gradient-to-r from-orange-500/30 to-red-500/30 text-orange-200 text-xs rounded-full border border-orange-400/30">
                                                #Future
                                            </span>
                                        </div>

                                        <!-- Engagement -->
                                        <div class="flex items-center justify-between pt-4 border-t border-white/20">
                                            <div class="flex space-x-6">
                                                <div class="flex items-center space-x-2 group cursor-pointer">
                                                    <div
                                                        class="p-1.5 rounded-full bg-gradient-to-r from-red-500/20 to-pink-500/20 group-hover:from-red-500/40 group-hover:to-pink-500/40 transition-all duration-300">
                                                        <svg class="w-4 h-4 text-red-400 group-hover:text-red-300"
                                                            fill="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                                        </svg>
                                                    </div>
                                                    <span class="text-slate-300 text-sm font-medium">1.2k</span>
                                                </div>
                                                <div class="flex items-center space-x-2 group cursor-pointer">
                                                    <div
                                                        class="p-1.5 rounded-full bg-gradient-to-r from-blue-500/20 to-cyan-500/20 group-hover:from-blue-500/40 group-hover:to-cyan-500/40 transition-all duration-300">
                                                        <svg class="w-4 h-4 text-blue-400 group-hover:text-blue-300"
                                                            fill="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M21 6h-2l-9-4-9 4H-1v3h2l9 4 9-4h2V6zM12 4.2L18.8 7 12 9.8 5.2 7 12 4.2z" />
                                                        </svg>
                                                    </div>
                                                    <span class="text-slate-300 text-sm font-medium">347</span>
                                                </div>
                                                <div class="flex items-center space-x-2 group cursor-pointer">
                                                    <div
                                                        class="p-1.5 rounded-full bg-gradient-to-r from-emerald-500/20 to-teal-500/20 group-hover:from-emerald-500/40 group-hover:to-teal-500/40 transition-all duration-300">
                                                        <svg class="w-4 h-4 text-emerald-400 group-hover:text-emerald-300"
                                                            fill="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z" />
                                                        </svg>
                                                    </div>
                                                    <span class="text-slate-300 text-sm font-medium">89</span>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <div
                                                    class="w-2 h-2 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full animate-pulse">
                                                </div>
                                                <span class="text-purple-300 text-xs">Trending now</span>
                                            </div>
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
    <section id="features" class="py-24 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-50/50 to-purple-50/50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 scroll-reveal">
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-6">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M9.5 3A6.5 6.5 0 0 1 16 9.5c0 1.61-.59 3.09-1.56 4.23l.27.27h.79l5 5-1.5 1.5-5-5v-.79l-.27-.27A6.516 6.516 0 0 1 9.5 16 6.5 6.5 0 0 1 3 9.5 6.5 6.5 0 0 1 9.5 3m0 2C7 5 5 7 5 9.5S7 14 9.5 14 14 12 14 9.5 12 5 9.5 5z" />
                    </svg>
                    Powerful Features
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">
                    Everything you need to
                    <span class="gradient-text">succeed</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Professional tools and features designed to help you create, manage, and monetize your content like
                    never before.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card rounded-3xl p-8 shadow-lg border border-gray-100 scroll-reveal group">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Advanced Analytics</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Track your performance with detailed analytics and insights. Understand your audience and
                        optimize your content strategy with data-driven decisions.
                    </p>
                    <div class="flex items-center text-purple-600 text-sm font-semibold">
                        View analytics
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card rounded-3xl p-8 shadow-lg border border-gray-100 scroll-reveal group">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Enterprise Security</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Your content is protected with enterprise-grade security, automatic backups, and 99.9% uptime
                        guarantee for peace of mind.
                    </p>
                    <div class="flex items-center text-orange-600 text-sm font-semibold">
                        Security details
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card rounded-3xl p-8 shadow-lg border border-gray-100 scroll-reveal group">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-rose-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Smart Monetization</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Turn your passion into profit with built-in monetization tools, subscription management, and
                        premium content features.
                    </p>
                    <div class="flex items-center text-pink-600 text-sm font-semibold">
                        Start earning
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card rounded-3xl p-8 shadow-lg border border-gray-100 scroll-reveal group">
                    <div
                        class="w-14 h-14 bg-gradient-to-r from-indigo-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Ultimate Customization</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Customize your blog with beautiful themes, custom domains, advanced branding options, and
                        complete design control.
                    </p>
                    <div class="flex items-center text-indigo-600 text-sm font-semibold">
                        Customize now
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-24 bg-white relative overflow-hidden">
        <div class="absolute inset-0">
            <div
                class="absolute top-0 left-1/4 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float">
            </div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float"
                style="animation-delay: -2s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 scroll-reveal">
                <div
                    class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 text-sm font-semibold mb-6">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z" />
                    </svg>
                    Simple Pricing
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">
                    Choose your perfect
                    <span class="gradient-text">plan</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Start free and scale as you grow. All plans include our core features with no hidden fees.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                <!-- Starter Plan -->
                <div class="pricing-card bg-white rounded-3xl shadow-xl border border-gray-200 p-8 scroll-reveal">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-2xl mb-4">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Starter</h3>
                        <div class="flex items-baseline justify-center mb-2">
                            <span class="text-5xl font-extrabold text-gray-900">$0</span>
                            <span class="text-lg text-gray-500 ml-2">/month</span>
                        </div>
                        <p class="text-gray-600">Perfect for getting started</p>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                            </div>
                            <span class="text-gray-700">Up to 5 blog posts</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                            </div>
                            <span class="text-gray-700">Basic analytics dashboard</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                            </div>
                            <span class="text-gray-700">Community support</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                            </div>
                            <span class="text-gray-700">Mobile-responsive themes</span>
                        </li>
                    </ul>

                    <a href="#register"
                        class="w-full bg-gray-900 text-white py-4 px-6 rounded-2xl font-semibold hover:bg-gray-800 transition-all duration-300 block text-center transform hover:scale-105">
                        Get Started Free
                    </a>
                </div>

                <!-- Professional Plan - Featured -->
                <div
                    class="pricing-card gradient-border rounded-3xl shadow-2xl p-8 relative transform scale-105 scroll-reveal">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span
                            class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-full text-sm font-bold shadow-lg">
                            Most Popular
                        </span>
                    </div>

                    <div class="text-center mb-8 pt-4">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Professional</h3>
                        <div class="flex items-baseline justify-center mb-2">
                            <span
                                class="text-5xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">$19</span>
                            <span class="text-lg text-gray-500 ml-2">/month</span>
                        </div>
                        <p class="text-gray-600">For serious content creators</p>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                            </div>
                            <span class="text-gray-700 font-medium">Unlimited blog posts</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                            </div>
                            <span class="text-gray-700 font-medium">Advanced analytics & insights</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                            </div>
                            <span class="text-gray-700 font-medium">Custom domain & branding</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                            </div>
                            <span class="text-gray-700 font-medium">Priority email support</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                            </div>
                            <span class="text-gray-700 font-medium">Monetization tools</span>
                        </li>
                    </ul>

                    <a href="#register"
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 px-6 rounded-2xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 block text-center transform hover:scale-105 shadow-lg">
                        Start 14-Day Free Trial
                    </a>
                </div>

                <!-- Enterprise Plan -->
                <div class="pricing-card bg-white rounded-3xl shadow-xl border border-gray-200 p-8 scroll-reveal">
                    <div class="text-center mb-8">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Enterprise</h3>
                    <div class="flex items-baseline justify-center mb-2">
                        <span class="text-5xl font-extrabold text-gray-900">$99</span>
                        <span class="text-lg text-gray-500 ml-2">/month</span>
                    </div>
                    <p class="text-gray-600">For large organizations</p>
                </div>

                <ul class="space-y-4 mb-8">
                    <li class="flex items-center">
                        <div class="w-5 h-5 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                        </div>
                        <span class="text-gray-700">Everything in Professional</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                        </div>
                        <span class="text-gray-700">Multi-author collaboration</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                        </div>
                        <span class="text-gray-700">Advanced security features</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                        </div>
                        <span class="text-gray-700">Dedicated account manager</span>
                    </li>
                    <li class="flex items-center">
                        <div class="w-5 h-5 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                        </div>
                        <span class="text-gray-700">24/7 phone & chat support</span>
                    </li>
                </ul>

                <a href="#contact"
                    class="w-full bg-gray-900 text-white py-4 px-6 rounded-2xl font-semibold hover:bg-gray-800 transition-all duration-300 block text-center transform hover:scale-105">
                    Contact Sales Team
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 gradient-bg relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-white/10 rounded-full animate-float blob"></div>
            <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-white/5 rounded-full animate-float blob"
                style="animation-delay: -3s;"></div>
        </div>

        <div class="relative max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="scroll-reveal">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6">
                    Ready to share your
                    <span class="block cta-gradient">
                        amazing story?
                    </span>
                </h2>
                <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-3xl mx-auto leading-relaxed">
                    Join thousands of creators who are already building their audience and growing their impact with
                    BlogSphere.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                    <a href="#register"
                        class="group w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 bg-white text-blue-600 text-lg font-bold rounded-full hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105">
                        <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Start Writing for Free
                        <svg class="ml-3 w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#explore"
                        class="group w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 border-2 border-white/30 text-lg font-bold rounded-full text-white hover:bg-white/10 transition-all duration-300 backdrop-blur-sm">
                        <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Explore Stories
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-white/80">
                    <div class="flex items-center justify-center space-x-3">
                        <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">99.9% Uptime</span>
                    </div>
                    <div class="flex items-center justify-center space-x-3">
                        <svg class="w-6 h-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">GDPR Compliant</span>
                    </div>
                    <div class="flex items-center justify-center space-x-3">
                        <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="font-medium">5-Star Support</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Company Info -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-blue-500 via-purple-600 to-pink-500 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold">BlogSphere</h3>
                    </div>
                    <p class="text-gray-400 text-lg leading-relaxed max-w-md mb-8">
                        The most powerful blogging platform for creators. Built with Laravel, powered by community,
                        designed for success.
                    </p>

                    <!-- Social Links -->
                    <div class="flex space-x-5">
                        <!-- Twitter -->
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:text-white hover:bg-gray-700 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>

                        <!-- GitHub -->
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:text-white hover:bg-gray-700 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                        </a>

                        <!-- LinkedIn -->
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:text-white hover:bg-gray-700 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"/>
                            </svg>
                        </a>

                        <!-- Pinterest -->
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:text-white hover:bg-gray-700 transition-all duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.347-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.167-1.507-.7-2.448-2.78-2.448-4.958 0-3.771 2.737-7.229 7.892-7.229 4.144 0 7.365 2.953 7.365 6.899 0 4.117-2.595 7.431-6.199 7.431-1.211 0-2.348-.63-2.738-1.378 0 0-.599 2.282-.744 2.84-.282 1.084-1.064 2.456-1.549 3.235C9.584 23.815 10.77 24.001 12.017 24.001c6.624 0 11.99-5.367 11.99-12.014C24.007 5.367 18.641.001 12.017.001z"/>
                        </svg>
                        </a>
                    </div>
                </div>

                <!-- Platform Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Platform</h4>
                    <ul class="space-y-4">
                        <li><a href="#features"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Features</a></li>
                        <li><a href="#pricing"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Pricing</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">API Documentation</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">System Status</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Changelog</a></li>
                    </ul>
                </div>

                <!-- Support Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Support</h4>
                    <ul class="space-y-4">
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Help Center</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Community Forum</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Contact Support</a></li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Tutorials</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Blog</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    &copy; 2024 BlogSphere. All rights reserved. Built with ❤️ using Laravel.
                </p>
                <div class="mt-4 md:mt-0 flex space-x-8">
                    <a href="#"
                        class="text-gray-400 hover:text-white text-sm transition-colors duration-300">Privacy Policy</a>
                    <a href="#"
                        class="text-gray-400 hover:text-white text-sm transition-colors duration-300">Terms of Service</a>
                    <a href="#"
                        class="text-gray-400 hover:text-white text-sm transition-colors duration-300">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Navbar scroll effect with improved performance
        let lastScrollY = 0;
        const navbar = document.getElementById('navbar');
{{-- 
        function updateNavbar() {
            const currentScrollY = window.scrollY;

            if (currentScrollY > 50) {
                navbar.classList.add('bg-white/95', 'backdrop-blur-md', 'shadow-xl');
                navbar.classList.remove('bg-transparent');

                // Apply gradient text ONLY to navbar elements
                navbar.querySelectorAll('.nav-link').forEach(el => {
                    el.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'bg-clip-text', 'text-transparent');
                    el.classList.remove('text-white', 'text-white/80');
                });

                // Handle navbar logo separately
                const navbarLogo = navbar.querySelector('h1');
                if (navbarLogo) {
                    navbarLogo.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'bg-clip-text', 'text-transparent');
                    navbarLogo.classList.remove('text-white', 'text-white/80');
                }
            } else {
                navbar.classList.remove('bg-white/95', 'backdrop-blur-md', 'shadow-xl');
                navbar.classList.add('bg-transparent');

                // Restore original navbar colors ONLY
                navbar.querySelectorAll('.nav-link').forEach(el => {
                    el.classList.add('text-white/80');
                    el.classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'bg-clip-text', 'text-transparent');
                });

                // Handle navbar logo separately
                const navbarLogo = navbar.querySelector('h1');
                if (navbarLogo) {
                    navbarLogo.classList.add('text-gray-900');
                    navbarLogo.classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'bg-clip-text', 'text-transparent');
                }
            }

            lastScrollY = currentScrollY;
        } --}}

        // Throttle scroll events for better performance
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    updateNavbar();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Scroll reveal animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                }
            });
        }, observerOptions);

        // Observe all scroll-reveal elements
        document.querySelectorAll('.scroll-reveal').forEach(el => {
            observer.observe(el);
        });

        // Add some interactive hover effects
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.background = 'linear-gradient(145deg, #ffffff 0%, #f0f9ff 100%)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.background = 'linear-gradient(145deg, #ffffff 0%, #f8fafc 100%)';
            });
        });

        // Animate stats on scroll
        const animateStats = () => {
            const statsElements = document.querySelectorAll('.mt-16.grid.grid-cols-3 .text-4xl.font-bold');
            statsElements.forEach(stat => {
                const rect = stat.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    const finalValue = stat.textContent;
                    const numericValue = parseInt(finalValue.replace(/\D/g, ''));
                    const suffix = finalValue.replace(/[\d,]/g, '');

                    let currentValue = 0;
                    const increment = numericValue / 30;
                    const counter = setInterval(() => {
                        currentValue += increment;
                        if (currentValue >= numericValue) {
                            stat.textContent = finalValue;
                            clearInterval(counter);
                        } else {
                            stat.textContent = Math.floor(currentValue) + suffix;
                        }
                    }, 50);
                }
            });
        };

        // Run stats animation once when in view
        let statsAnimated = false;
        window.addEventListener('scroll', () => {
            if (!statsAnimated) {
                const statsSection = document.querySelector('.mt-16.grid.grid-cols-3');
                if (statsSection) {
                    const rect = statsSection.getBoundingClientRect();
                    if (rect.top < window.innerHeight) {
                        animateStats();
                        statsAnimated = true;
                    }
                }
            }
        });
    </script>
</body>

</html>
