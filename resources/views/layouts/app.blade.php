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
    </style>
    <script>document.documentElement.classList.add('js-active');</script>
</head>
<body class="font-sans antialiased bg-white text-navy-900">

    <!-- Navigation -->
    <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 transform translate-y-0">
        <div id="nav-container" class="transition-all duration-500 border-b border-transparent">
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

                    <!-- Desktop Menu - Subtle Style -->
                    <div class="hidden lg:flex items-center justify-center flex-1 px-4 gap-0.5">
                        <a href="#home" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-all relative group">
                            Home
                            <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                        </a>
                        <a href="#about" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-all relative group">
                            About Us
                            <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                        </a>
                        <a href="#vision-mission" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-all relative group">
                            Vision & Mission
                            <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                        </a>
                        <a href="#values" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-all relative group">
                            Our Values
                            <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                        </a>
                        <a href="#safety" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-all relative group">
                            Safety
                            <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                        </a>
                        <a href="#legality" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-all relative group">
                            Legality
                            <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                        </a>
                        <a href="#partners" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-all relative group">
                            Partners
                            <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                        </a>
                        <a href="#services" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-all relative group">
                            Services
                            <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                        </a>
                        <a href="#portfolio" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-all relative group">
                            Portfolio
                            <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></span>
                        </a>
                    </div>

                    <!-- Contact CTA -->
                    <div class="hidden lg:block shrink-0">
                        <a href="#contact" class="px-8 py-3 text-sm font-bold uppercase tracking-tighter text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500 rounded-full hover:from-gold-300 hover:to-gold-400 transition-all shadow-lg shadow-gold-500/25 hover:shadow-gold-500/40 hover:-translate-y-0.5">
                            Contact Us
                        </a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-btn" class="lg:hidden p-2 text-white/80 hover:text-gold-400 transition-colors" aria-label="Toggle menu">
                        <svg id="menu-open-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg id="menu-close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden hidden border-t border-white/10 bg-navy-950/98 backdrop-blur-3xl h-screen overflow-y-auto">
                <div class="px-6 py-8 space-y-2 text-center">
                    <a href="#home" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Home</a>
                    <a href="#about" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">About Us</a>
                    <a href="#vision-mission" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Vision & Mission</a>
                    <a href="#values" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Our Values</a>
                    <a href="#safety" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Safety</a>
                    <a href="#legality" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Legality</a>
                    <a href="#partners" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Partners</a>
                    <a href="#services" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Services</a>
                    <a href="#portfolio" class="mobile-nav-link block px-4 py-4 text-lg font-bold text-white/80 hover:text-gold-400 transition-all">Portfolio</a>
                    <a href="#contact" class="block px-4 py-4 text-lg font-black text-navy-950 bg-gradient-to-r from-gold-400 to-gold-500 rounded-xl mt-6">Contact Us</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
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
                        <li><a href="#home" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Home</a></li>
                        <li><a href="#about" class="text-sm text-white/50 hover:text-gold-400 transition-colors">About Us</a></li>
                        <li><a href="#vision-mission" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Vision & Mission</a></li>
                        <li><a href="#values" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Our Values</a></li>
                        <li><a href="#safety" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Safety</a></li>
                        <li><a href="#legality" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Legality</a></li>
                        <li><a href="#partners" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Partners</a></li>
                        <li><a href="#services" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Services</a></li>
                        <li><a href="#portfolio" class="text-sm text-white/50 hover:text-gold-400 transition-colors">Portfolio</a></li>
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

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            menuOpenIcon.classList.toggle('hidden');
            menuCloseIcon.classList.toggle('hidden');
        });

        // Navbar Scroll Logic
        const nav = document.getElementById('main-nav');
        const navContainer = document.getElementById('nav-container');
        const navContent = document.getElementById('nav-content');
        const navLogoBox = document.getElementById('nav-logo-box');
        let lastScrollY = window.scrollY;

        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;

            // 1. Shrink Effect
            if (currentScrollY > 50) {
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

        // Intersection Observer for reveal animations (Enter & Exit)
        const observerOptions = {
            threshold: 0.15,
            rootMargin: "0px 0px -50px 0px"
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                } else {
                    // Optional: remove this if you want it to only animate once
                    entry.target.classList.remove('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

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
</body>
</html>
