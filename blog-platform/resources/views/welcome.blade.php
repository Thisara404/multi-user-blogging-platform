<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BlogSphere - Multi-User Blogging Platform</title>
    <meta name="description" content="A powerful multi-user blogging platform built with Laravel. Create, share, and discover amazing content with our community-driven blog.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'slide-up': 'slideUp 0.8s ease-out forwards',
                        'fade-in': 'fadeIn 1s ease-out forwards',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-pattern {
            background-image:
                radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 2px, transparent 2px);
            background-size: 60px 60px;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        }

        .feature-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .pricing-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .pricing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
        }

        .blob {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(3deg); }
        }

        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(102, 126, 234, 0.5); }
            to { box-shadow: 0 0 30px rgba(102, 126, 234, 0.8), 0 0 40px rgba(118, 75, 162, 0.5); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .gradient-border {
            position: relative;
            background: linear-gradient(145deg, #ffffff, #f8fafc);
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            inset: 0;
            padding: 2px;
            background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
            border-radius: inherit;
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
        }

        .typing-animation::after {
            content: '|';
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }
    </style>
</head>

<body class="font-sans antialiased bg-white">
    <!-- Navigation Header -->
    <nav class="fixed w-full z-50 transition-all duration-500" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 via-purple-600 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold text-white tracking-tight">BlogSphere</h1>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#features" class="nav-link text-white/80 hover:text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white/10">Features</a>
                        <a href="#about" class="nav-link text-white/80 hover:text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white/10">About</a>
                        <a href="#explore" class="nav-link text-white/80 hover:text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white/10">Explore</a>
                        <a href="#pricing" class="nav-link text-white/80 hover:text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white/10">Pricing</a>
                    </div>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    <a href="#login" class="text-white/80 hover:text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:bg-white/10">
                        Sign In
                    </a>
                    <a href="#register" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        Get Started Free
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="min-h-screen gradient-bg hero-pattern relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-white/10 rounded-full animate-float blob"></div>
            <div class="absolute top-40 -left-32 w-80 h-80 bg-white/5 rounded-full animate-float blob" style="animation-delay: -2s;"></div>
            <div class="absolute bottom-20 right-20 w-60 h-60 bg-white/10 rounded-full animate-float blob" style="animation-delay: -4s;"></div>
            <div class="absolute top-1/2 left-1/4 w-40 h-40 bg-gradient-to-r from-pink-400/20 to-purple-400/20 rounded-full animate-pulse-slow"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20">
            <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center min-h-screen">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <div class="mb-8 animate-slide-up">
                        <span class="inline-flex items-center px-6 py-3 rounded-full text-sm font-medium glass-effect text-white backdrop-blur-sm border border-white/20 shadow-xl">
                            <span class="animate-pulse mr-2">🚀</span>
                            Now with AI-powered writing assistance
                        </span>
                    </div>

                    <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl xl:text-7xl animate-slide-up">
                        <span class="block mb-2">Create</span>
                        <span class="block gradient-text bg-gradient-to-r from-yellow-300 via-orange-400 to-pink-400 bg-clip-text text-transparent mb-2">
                            Amazing Stories
                        </span>
                        <span class="block">That Matter</span>
                    </h1>

                    <p class="mt-8 text-lg text-white/90 sm:text-xl md:text-2xl lg:text-xl xl:text-2xl max-w-3xl leading-relaxed animate-fade-in">
                        Join thousands of writers on the most powerful blogging platform. Share your thoughts, build your audience, and turn your passion into profit with our cutting-edge tools.
                    </p>

                    <div class="mt-12 sm:flex sm:justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-6 animate-slide-up">
                        <a href="#register" class="group w-full sm:w-auto flex items-center justify-center px-10 py-4 border border-transparent text-lg font-semibold rounded-full text-blue-600 bg-white hover:bg-gray-50 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105">
                            Start Writing Today
                            <svg class="ml-3 w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#explore" class="group w-full sm:w-auto flex items-center justify-center px-10 py-4 border-2 border-white/30 text-lg font-semibold rounded-full text-white hover:bg-white/10 transition-all duration-300 backdrop-blur-sm">
                            <svg class="mr-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Explore Stories
                        </a>
                    </div>

                    <!-- Enhanced Stats -->
                    <div class="mt-16 grid grid-cols-3 gap-8 animate-fade-in">
                        <div class="text-center lg:text-left">
                            <div class="text-4xl font-bold text-white mb-1">50K+</div>
                            <div class="text-white/70 text-sm font-medium">Active Writers</div>
                            <div class="w-full bg-white/20 h-1 rounded-full mt-2">
                                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 h-1 rounded-full w-3/4"></div>
                            </div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="text-4xl font-bold text-white mb-1">1M+</div>
                            <div class="text-white/70 text-sm font-medium">Stories Published</div>
                            <div class="w-full bg-white/20 h-1 rounded-full mt-2">
                                <div class="bg-gradient-to-r from-pink-400 to-purple-500 h-1 rounded-full w-4/5"></div>
                            </div>
                        </div>
                        <div class="text-center lg:text-left">
                            <div class="text-4xl font-bold text-white mb-1">10M+</div>
                            <div class="text-white/70 text-sm font-medium">Monthly Readers</div>
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
                            <div class="w-full bg-white/10 rounded-3xl backdrop-blur-xl border border-white/20 p-8 shadow-2xl transform hover:scale-105 transition-all duration-500 animate-glow">
                                <div class="space-y-6">
                                    <!-- Header -->
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-pink-500 to-violet-500 rounded-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1 space-y-2">
                                            <div class="h-3 bg-white/40 rounded-full w-3/4 animate-pulse"></div>
                                            <div class="h-2 bg-white/20 rounded-full w-1/2"></div>
                                        </div>
                                        <div class="flex space-x-1">
                                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                            <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                                            <div class="w-2 h-2 bg-red-400 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="space-y-4">
                                        <div class="h-5 bg-white/50 rounded-full animate-pulse"></div>
                                        <div class="h-4 bg-white/40 rounded-full w-5/6 animate-pulse" style="animation-delay: 0.1s;"></div>
                                        <div class="h-4 bg-white/30 rounded-full w-4/6 animate-pulse" style="animation-delay: 0.2s;"></div>

                                        <!-- Image placeholder -->
                                        <div class="h-32 bg-gradient-to-r from-white/20 to-white/10 rounded-xl flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>

                                        <!-- Tags -->
                                        <div class="flex space-x-2">
                                            <div class="h-6 bg-blue-400/30 rounded-full w-16 animate-pulse"></div>
                                            <div class="h-6 bg-purple-400/30 rounded-full w-20 animate-pulse" style="animation-delay: 0.1s;"></div>
                                            <div class="h-6 bg-pink-400/30 rounded-full w-14 animate-pulse" style="animation-delay: 0.2s;"></div>
                                        </div>

                                        <!-- Engagement -->
                                        <div class="flex items-center justify-between pt-4 border-t border-white/20">
                                            <div class="flex space-x-4">
                                                <div class="flex items-center space-x-1">
                                                    <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                    </svg>
                                                    <span class="text-white/60 text-xs">247</span>
                                                </div>
                                                <div class="flex items-center space-x-1">
                                                    <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M21 6h-2l-9-4-9 4H-1v3h2l9 4 9-4h2V6zM12 4.2L18.8 7 12 9.8 5.2 7 12 4.2z"/>
                                                    </svg>
                                                    <span class="text-white/60 text-xs">89</span>
                                                </div>
                                            </div>
                                            <div class="text-white/40 text-xs">2 min read</div>
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
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-800 text-sm font-semibold mb-6">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.5 3A6.5 6.5 0 0 1 16 9.5c0 1.61-.59 3.09-1.56 4.23l.27.27h.79l5 5-1.5 1.5-5-5v-.79l-.27-.27A6.516 6.516 0 0 1 9.5 16 6.5 6.5 0 0 1 3 9.5 6.5 6.5 0 0 1 9.5 3m0 2C7 5 5 7 5 9.5S7 14 9.5 14 14 12 14 9.5 12 5 9.5 5z"/>
                    </svg>
                    Powerful Features
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">
                    Everything you need to
                    <span class="gradient-text">succeed</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Professional tools and features designed to help you create, manage, and monetize your content like never before.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card rounded-3xl p-8 shadow-lg border border-gray-100 scroll-reveal group">
                    <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Advanced Analytics</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Track your performance with detailed analytics and insights. Understand your audience and optimize your content strategy with data-driven decisions.
                    </p>
                    <div class="flex items-center text-purple-600 text-sm font-semibold">
                        View analytics
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card rounded-3xl p-8 shadow-lg border border-gray-100 scroll-reveal group">
                    <div class="w-14 h-14 bg-gradient-to-r from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Enterprise Security</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Your content is protected with enterprise-grade security, automatic backups, and 99.9% uptime guarantee for peace of mind.
                    </p>
                    <div class="flex items-center text-orange-600 text-sm font-semibold">
                        Security details
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card rounded-3xl p-8 shadow-lg border border-gray-100 scroll-reveal group">
                    <div class="w-14 h-14 bg-gradient-to-r from-rose-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Smart Monetization</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Turn your passion into profit with built-in monetization tools, subscription management, and premium content features.
                    </p>
                    <div class="flex items-center text-pink-600 text-sm font-semibold">
                        Start earning
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card rounded-3xl p-8 shadow-lg border border-gray-100 scroll-reveal group">
                    <div class="w-14 h-14 bg-gradient-to-r from-indigo-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Ultimate Customization</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Customize your blog with beautiful themes, custom domains, advanced branding options, and complete design control.
                    </p>
                    <div class="flex items-center text-indigo-600 text-sm font-semibold">
                        Customize now
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-24 bg-white relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-float" style="animation-delay: -2s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 scroll-reveal">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 text-sm font-semibold mb-6">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
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
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
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
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Up to 5 blog posts</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Basic analytics dashboard</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Community support</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Mobile-responsive themes</span>
                        </li>
                    </ul>

                    <a href="#register" class="w-full bg-gray-900 text-white py-4 px-6 rounded-2xl font-semibold hover:bg-gray-800 transition-all duration-300 block text-center transform hover:scale-105">
                        Get Started Free
                    </a>
                </div>

                <!-- Professional Plan - Featured -->
                <div class="pricing-card gradient-border rounded-3xl shadow-2xl p-8 relative transform scale-105 scroll-reveal">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-full text-sm font-bold shadow-lg">
                            Most Popular
                        </span>
                    </div>

                    <div class="text-center mb-8 pt-4">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Professional</h3>
                        <div class="flex items-baseline justify-center mb-2">
                            <span class="text-5xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">$19</span>
                            <span class="text-lg text-gray-500 ml-2">/month</span>
                        </div>
                        <p class="text-gray-600">For serious content creators</p>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">Unlimited blog posts</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">Advanced analytics & insights</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">Custom domain & branding</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">Priority email support</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">Monetization tools</span>
                        </li>
                    </ul>

                    <a href="#register" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 px-6 rounded-2xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 block text-center transform hover:scale-105 shadow-lg">
                        Start 14-Day Free Trial
                    </a>
                </div>

                <!-- Enterprise Plan -->
                <div class="pricing-card bg-white rounded-3xl shadow-xl border border-gray-200 p-8 scroll-reveal">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
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
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Everything in Professional</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Multi-author collaboration</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Advanced security features</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700">Dedicated account manager</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-5 h-5 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="text-gray-700">24/7 phone & chat support</span>
                        </li>
                    </ul>

                    <a href="#contact" class="w-full bg-gray-900 text-white py-4 px-6 rounded-2xl font-semibold hover:bg-gray-800 transition-all duration-300 block text-center transform hover:scale-105">
                        Contact Sales Team
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 gradient-bg relative overflow-hidden">
        <div class="absolute inset-0 hero-pattern"></div>
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-white/10 rounded-full animate-float blob"></div>
            <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-white/5 rounded-full animate-float blob" style="animation-delay: -3s;"></div>
        </div>

        <div class="relative max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="scroll-reveal">
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6">
                    Ready to share your
                    <span class="block gradient-text bg-gradient-to-r from-yellow-300 via-orange-400 to-pink-400 bg-clip-text text-transparent">
                        amazing story?
                    </span>
                </h2>
                <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-3xl mx-auto leading-relaxed">
                    Join thousands of creators who are already building their audience and growing their impact with BlogSphere.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                    <a href="#register" class="group w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 bg-white text-blue-600 text-lg font-bold rounded-full hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:d text-gray-900 mb-4">AI-Powered Editor</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Professional writing tools with AI assistance, real-time collaboration, and advanced formatting options that make writing effortless.
                    </p>
                    <div class="flex items-center text-blue-600 text-sm font-semibold">
                        Learn more
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card rounded-3xl p-8 shadow-lg border border-gray-100 scroll-reveal group">
                    <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Vibrant Community</h3>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Connect with like-minded writers, get feedback, and build meaningful relationships within our thriving community ecosystem.
                    </p>
                    <div class="flex items-center text-green-600 text-sm font-semibold">
                        Join community
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card rounded-3xl p-8 shadow-lg border border-gray-100 scroll-reveal group">
                    <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-violet-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bol
