<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PT Efha Sejahtera Bersama - Penyedia solusi infrastruktur telekomunikasi terpercaya di Indonesia. Survey, Instalasi, Optimasi, dan Power System.">
    <title>@yield('title', 'PT Efha Sejahtera Bersama') - Company Profile</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Smooth scroll behavior */
        html { scroll-behavior: smooth; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0a1628; }
        ::-webkit-scrollbar-thumb { background: #d4982a; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #e4b441; }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInLeft {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
        .animate-fade-in-left { animation: fadeInLeft 0.8s ease-out forwards; }
        .animate-fade-in-right { animation: fadeInRight 0.8s ease-out forwards; }
        .animate-scale-in { animation: scaleIn 0.6s ease-out forwards; }
        .animate-float { animation: float 3s ease-in-out infinite; }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }
        .delay-600 { animation-delay: 0.6s; }

        /* Gold gradient text */
        .gold-text {
            background: linear-gradient(135deg, #e4b441, #d4982a, #f2dda5, #d4982a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Gold shimmer line */
        .gold-line {
            height: 3px;
            background: linear-gradient(90deg, transparent, #d4982a, #e4b441, #d4982a, transparent);
            background-size: 200% 100%;
            animation: shimmer 3s infinite linear;
        }

        /* Glass effect */
        .glass-nav {
            background: rgba(10, 22, 40, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* Intersection Observer - Floating Entrance (No Blur) */
        .reveal {
            transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform, opacity;
        }

        /* Only hide if JS is active to prevent invisible content if JS fails */
        .js-active .reveal:not(.visible) {
            opacity: 0;
            transform: translateY(60px) scale(0.98);
        }
        
        .reveal.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Alpine.js cloak */
        [x-cloak] { display: none !important; }
    </style>
    <script>document.documentElement.classList.add('js-active');</script>
    @stack('styles')
</head>
<body class="font-sans antialiased bg-white text-navy-900" x-data="{ sidebarOpen: false }">

    <!-- Navigation -->
    <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 transform translate-y-0">
        <div id="nav-container" class="transition-all duration-500 border-b {{ Request::routeIs('home') ? 'border-transparent' : 'bg-navy-950/95 backdrop-blur-xl border-white/10 shadow-2xl' }}">
            <div class="max-w-[1600px] mx-auto px-6 lg:px-12">
                <div class="flex items-center justify-between h-20 lg:h-24 transition-all duration-500" id="nav-content">
                    <!-- Logo & Brand Name -->
                    <a href="#home" class="flex items-center gap-4 group shrink-0">
                        <div id="nav-logo-box" class="w-10 h-10 lg:w-12 lg:h-12 rounded-lg bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center shadow-lg shadow-gold-500/20 group-hover:shadow-gold-500/40 transition-all duration-500">
                            <span class="text-navy-950 font-black text-lg lg:text-xl">E</span>
                        </div>
                        <div class="hidden md:block transition-all duration-500" id="nav-logo-text">
                            <h1 class="text-white font-bold text-sm lg:text-base tracking-wide">
                                EfhaNet
                            </h1>
                        </div>
                    </a>

                    @auth
                        <!-- Left Menu Trigger for Desktop & Mobile -->
                        <div class="flex items-center ml-4 lg:ml-6">
                            <button @click="sidebarOpen = true" class="flex items-center gap-2 px-3 py-2 lg:px-4 lg:py-2 bg-white/5 hover:bg-white/10 rounded-full text-white transition-all border border-white/10 group">
                                <svg class="w-5 h-5 text-gold-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span class="hidden sm:inline text-xs lg:text-sm font-bold tracking-wider uppercase">Menu</span>
                            </button>
                        </div>
                    @endauth

                    <!-- Desktop Menu - Simplified & Smart -->
                    <div class="hidden lg:flex items-center justify-center flex-1 px-4 gap-1">
                        @guest
                            <a href="{{ route('home') }}#home" class="nav-link px-4 py-2 text-sm font-semibold text-white/80 hover:text-gold-400 transition-all relative group">
                                Beranda
                                <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                            </a>
                            <a href="{{ route('home') }}#about" class="nav-link px-4 py-2 text-sm font-semibold text-white/80 hover:text-gold-400 transition-all relative group">
                                Tentang Kami
                                <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                            </a>
                            <a href="{{ route('home') }}#services" class="nav-link px-4 py-2 text-sm font-semibold text-white/80 hover:text-gold-400 transition-all relative group">
                                Layanan
                                <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                            </a>
                            <a href="{{ route('home') }}#portfolio" class="nav-link px-4 py-2 text-sm font-semibold text-white/80 hover:text-gold-400 transition-all relative group">
                                Portofolio
                                <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                            </a>
                            <a href="{{ route('home') }}#contact" class="nav-link px-4 py-2 text-sm font-semibold text-white/80 hover:text-gold-400 transition-all relative group">
                                Kontak
                                <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                            </a>
                        @else
                            <div class="flex-1"></div>
                        @endguest

                        @if(Auth::check() && Auth::user()->role === 'admin')
                        <div class="w-px h-4 bg-white/10 mx-2"></div>
                        <a href="{{ route('admin.dashboard') }}" class="nav-link px-4 py-2 text-sm font-bold {{ Request::routeIs('admin.dashboard') ? 'text-gold-400' : 'text-white/80' }} hover:text-gold-300 transition-all relative group flex items-center gap-2">
                            Dashboard
                        </a>
                        @endif
                    </div>

                    <!-- Auth/Contact CTA -->
                    <div class="hidden lg:flex items-center gap-4 shrink-0">
                        @auth
                            <a href="{{ route('projects.index') }}" class="px-8 py-3 text-sm font-bold uppercase tracking-tighter text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500 rounded-full hover:from-gold-300 hover:to-gold-400 transition-all shadow-lg shadow-gold-500/25 hover:shadow-gold-500/40 hover:-translate-y-0.5">
                                Portal Proyek
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-white/80 hover:text-gold-400 text-sm font-bold uppercase tracking-wider transition-colors">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-8 py-3 text-sm font-bold uppercase tracking-tighter text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500 rounded-full hover:from-gold-300 hover:to-gold-400 transition-all shadow-lg shadow-gold-500/25 hover:shadow-gold-500/40 hover:-translate-y-0.5">
                                Register
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    @guest
                        <button id="mobile-menu-btn" class="lg:hidden p-2 text-white/80 hover:text-gold-400 transition-colors" aria-label="Toggle menu">
                            <svg id="menu-open-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg id="menu-close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    @endguest
                </div>
            </div>

            <!-- Guest Mobile Menu -->
            @guest
                <div id="mobile-menu" class="lg:hidden hidden border-t border-white/10 bg-navy-950/98 backdrop-blur-3xl h-screen overflow-y-auto">
                    <div class="px-6 py-8 space-y-2 text-center">
                        <a href="{{ route('home') }}#home" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Home</a>
                        <a href="{{ route('home') }}#about" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">About</a>
                        <a href="{{ route('home') }}#services" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Services</a>
                        <a href="{{ route('home') }}#portfolio" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Portfolio</a>
                        <a href="{{ route('home') }}#contact" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Contact</a>
                        
                        <div class="h-px bg-white/10 my-6"></div>
                        
                        <a href="{{ route('login') }}" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Login</a>
                        <a href="{{ route('register') }}" class="block px-4 py-4 text-lg font-black text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500 rounded-xl mt-6 uppercase tracking-wider">
                            Register
                        </a>
                    </div>
                </div>
            @endguest
        </div>
    </nav>

    <!-- Auth Sidebar -->
    @auth
    <div x-show="sidebarOpen" 
         class="fixed inset-0 z-[100]" 
         x-cloak>
        <!-- Overlay -->
        <div x-show="sidebarOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="absolute inset-0 bg-navy-950/80 backdrop-blur-md">
        </div>

        <!-- Sidebar Content -->
        <div x-show="sidebarOpen"
             x-transition:enter="transition ease-out duration-500 sm:duration-700"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="absolute top-0 left-0 h-full w-full max-w-xs bg-navy-950 shadow-2xl border-r border-white/10 flex flex-col">
            
            <!-- Sidebar Header -->
            <div class="p-6 flex items-center justify-between border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center">
                        <span class="text-navy-950 font-black text-sm">E</span>
                    </div>
                    <span class="text-white font-bold tracking-wider">EfhaNet</span>
                </div>
                <button @click="sidebarOpen = false" class="p-2 text-white/50 hover:text-gold-400 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <div class="flex-1 overflow-y-auto py-8 px-6 space-y-2">
                <p class="text-[10px] font-black text-white/30 uppercase tracking-[0.3em] mb-4 px-4">Navigasi Utama</p>
                
                <a href="{{ route('home') }}" @click="sidebarOpen = false" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('home') ? 'text-gold-400 bg-white/5' : 'text-white/70' }} hover:text-gold-400 hover:bg-white/5 rounded-2xl transition-all group">
                    <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-gold-400/10 transition-colors">
                        <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="font-bold">Beranda</span>
                </a>

                <a href="{{ route('about') }}" @click="sidebarOpen = false" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('about') ? 'text-gold-400 bg-white/5' : 'text-white/70' }} hover:text-gold-400 hover:bg-white/5 rounded-2xl transition-all group">
                    <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-gold-400/10 transition-colors">
                        <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="font-bold">Tentang Kami</span>
                </a>

                <a href="{{ route('services') }}" @click="sidebarOpen = false" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('services') ? 'text-gold-400 bg-white/5' : 'text-white/70' }} hover:text-gold-400 hover:bg-white/5 rounded-2xl transition-all group">
                    <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-gold-400/10 transition-colors">
                        <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-bold">Layanan</span>
                </a>

                <a href="{{ route('portfolio') }}" @click="sidebarOpen = false" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('portfolio') ? 'text-gold-400 bg-white/5' : 'text-white/70' }} hover:text-gold-400 hover:bg-white/5 rounded-2xl transition-all group">
                    <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-gold-400/10 transition-colors">
                        <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-bold">Portofolio</span>
                </a>

                <a href="{{ route('contact') }}" @click="sidebarOpen = false" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('contact') ? 'text-gold-400 bg-white/5' : 'text-white/70' }} hover:text-gold-400 hover:bg-white/5 rounded-2xl transition-all group">
                    <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-gold-400/10 transition-colors">
                        <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-bold">Kontak</span>
                </a>

                <div class="h-px bg-white/10 my-6 mx-4"></div>

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('admin.dashboard') ? 'text-gold-400 bg-white/5' : 'text-white/70' }} hover:text-gold-400 hover:bg-white/5 rounded-2xl transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-gold-400/10 transition-colors">
                            <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <span class="font-bold">Dashboard Admin</span>
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('admin.services.*') ? 'text-gold-400 bg-white/5' : 'text-white/70' }} hover:text-gold-400 hover:bg-white/5 rounded-2xl transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-gold-400/10 transition-colors">
                            <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="font-bold">Manajemen Layanan</span>
                    </a>
                    <a href="{{ route('admin.portfolio.index') }}" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('admin.portfolio.*') ? 'text-gold-400 bg-white/5' : 'text-white/70' }} hover:text-gold-400 hover:bg-white/5 rounded-2xl transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-gold-400/10 transition-colors">
                            <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <span class="font-bold">Manajemen Portofolio</span>
                    </a>
                    <a href="{{ route('admin.partners.index') }}" class="flex items-center gap-4 px-4 py-4 {{ Request::routeIs('admin.partners.*') ? 'text-gold-400 bg-white/5' : 'text-white/70' }} hover:text-gold-400 hover:bg-white/5 rounded-2xl transition-all group">
                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-gold-400/10 transition-colors">
                            <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <span class="font-bold">Manajemen Partner</span>
                    </a>
                @endif
            </div>

            <!-- Sidebar Footer -->
            <div class="p-6 border-t border-white/10 bg-white/5">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-gold-400/20 flex items-center justify-center border border-gold-400/30">
                        <span class="text-gold-400 font-bold text-lg">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white font-bold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-white/40 text-xs truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-2xl font-bold transition-all border border-red-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout Account
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endauth

    <!-- Main Content -->
    <main>
        <!-- Global Alerts -->
        @if(session('error'))
            <div class="fixed top-28 left-1/2 -translate-x-1/2 z-[60] w-full max-w-xl px-4 animate-fade-in-up">
                <div class="bg-red-500 text-white px-6 py-4 rounded-2xl shadow-2xl shadow-red-500/30 flex items-center justify-between border border-white/20">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 17c-.77 1.333.192 3 1.732 3z"/></svg>
                        <p class="text-[10px] font-bold uppercase tracking-widest">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-white/50 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-navy-950 text-white/70 border-t border-gold-600/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Company Info -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center">
                            <span class="text-navy-950 font-black text-xl">E</span>
                        </div>
                        <div>
                            <span class="text-white font-bold text-base tracking-wide block">PT EFHA SEJAHTERA BERSAMA</span>
                            <span class="text-gold-400 text-xs tracking-[0.2em] font-medium">TELECOMMUNICATIONS INFRASTRUCTURE</span>
                        </div>
                    </div>
                    <p class="text-white/50 text-sm leading-relaxed max-w-md mb-6">
                        Menyediakan solusi infrastruktur telekomunikasi yang andal dan inovatif untuk mendukung transformasi konektivitas digital Indonesia.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-6">Navigasi</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('about') }}" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('services') }}" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Layanan</a></li>
                        <li><a href="{{ route('portfolio') }}" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Portofolio</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-6">Kontak</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-gold-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span class="text-sm text-white/50 leading-relaxed">Jl. Sepakat 2 (Ayani), Gg Demokrasi, Pontianak, Kalimantan Barat.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-gold-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span class="text-sm text-white/50">project@efhasejahtera.co.id</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-gold-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span class="text-sm text-white/50">0812-9016-9014 / 0822-5599-9988</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="gold-line mt-12 mb-8"></div>
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-white/30">&copy; {{ date('Y') }} PT Efha Sejahtera Bersama. All rights reserved.</p>
                <p class="text-xs text-white/30">Infrastruktur Telekomunikasi Terpercaya</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuOpenIcon = document.getElementById('menu-open-icon');
        const menuCloseIcon = document.getElementById('menu-close-icon');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                if (menuOpenIcon) menuOpenIcon.classList.toggle('hidden');
                if (menuCloseIcon) menuCloseIcon.classList.toggle('hidden');
            });
        }

        // Navbar Scroll Logic
        const nav = document.getElementById('main-nav');
        const navContainer = document.getElementById('nav-container');
        const navContent = document.getElementById('nav-content');
        const navLogoBox = document.getElementById('nav-logo-box');
        const isHome = {{ Request::routeIs('home') ? 'true' : 'false' }};
        let lastScrollY = window.scrollY;
        
        const updateNavbar = () => {
            const currentScrollY = window.scrollY;

            // 1. Shrink Effect & Background
            if (currentScrollY > 50 || !isHome) {
                navContainer.classList.add('bg-navy-950/90', 'backdrop-blur-xl', 'border-white/10', 'shadow-2xl');
                navContainer.classList.remove('border-transparent');
                navContent.classList.replace('h-20', 'h-16');
                navContent.classList.replace('lg:h-24', 'lg:h-16');
                navLogoBox.classList.replace('w-10', 'w-8');
                navLogoBox.classList.replace('lg:w-12', 'lg:w-10');
            } else {
                navContainer.classList.remove('bg-navy-950/90', 'backdrop-blur-xl', 'border-white/10', 'shadow-2xl');
                navContainer.classList.add('border-transparent');
                navContent.classList.replace('h-16', 'h-20');
                navContent.classList.replace('lg:h-16', 'lg:h-24');
                navLogoBox.classList.replace('w-8', 'w-10');
                navLogoBox.classList.replace('lg:w-10', 'lg:w-12');
            }
        };

        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;
            updateNavbar();

            // 2. Hide/Show on Scroll Direction
            if (currentScrollY > lastScrollY && currentScrollY > 200) {
                // Scrolling down
                nav.classList.add('-translate-y-full');
            } else {
                // Scrolling up
                nav.classList.remove('-translate-y-full');
            }
            lastScrollY = currentScrollY;
        });

        // Initialize on load
        updateNavbar();

        // Intersection Observer for reveal animations (Enter & Exit)
        const observerOptions = {
            threshold: 0.15,
            rootMargin: "0px 0px -50px 0px"
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Ensure hash targets are revealed
        const revealFromHash = () => {
            const hash = window.location.hash;
            if (hash) {
                const target = document.querySelector(hash);
                if (target) {
                    target.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
                    target.classList.add('visible');
                }
            }
        };

        window.addEventListener('load', revealFromHash);
        window.addEventListener('hashchange', revealFromHash);

        // Active nav link highlighting with smooth indicator
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (window.scrollY >= sectionTop - 150) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                const linkTarget = link.getAttribute('href').substring(1);
                const indicator = link.querySelector('span');
                
                if (linkTarget === current) {
                    link.classList.add('text-gold-400');
                    link.classList.remove('text-white/80');
                    if (indicator) indicator.classList.replace('scale-x-0', 'scale-x-100');
                } else {
                    link.classList.remove('text-gold-400');
                    link.classList.add('text-white/80');
                    if (indicator) indicator.classList.replace('scale-x-100', 'scale-x-0');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
