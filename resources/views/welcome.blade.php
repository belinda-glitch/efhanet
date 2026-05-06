@extends('layouts.app')

@section('content')

{{-- ============================================ --}}
{{-- SECTION 1: HOME / HERO --}}
{{-- ============================================ --}}
<section id="home" class="relative min-h-screen flex items-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-bg.png') }}" alt="Telecom Infrastructure" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-navy-950/80 via-navy-900/60 to-navy-950/40"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-navy-950/90 via-transparent to-transparent"></div>
    </div>
    <!-- Decorative Elements -->
    <div class="absolute top-20 right-10 w-72 h-72 bg-gold-500/10 rounded-full blur-3xl animate-float"></div>
    <div class="absolute bottom-20 left-10 w-96 h-96 bg-navy-500/20 rounded-full blur-3xl"></div>
    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 flex flex-col items-center justify-center text-center">
        <div class="max-w-4xl">
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black text-white leading-[1.1] mb-6 animate-fade-in-up">
                Company Profile
                <span class="block mt-2 gold-text">PT Efha Sejahtera Bersama</span>
            </h1>
            <p class="text-base sm:text-lg text-white/80 leading-relaxed max-w-2xl mx-auto mb-10 animate-fade-in-up delay-100">
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up delay-200">
                <a href="#services" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-gold-400 to-gold-500 text-navy-950 font-bold rounded-xl hover:from-gold-300 hover:to-gold-400 transition-all shadow-xl shadow-gold-500/25 hover:shadow-gold-500/40 hover:-translate-y-1">
                    Layanan Kami
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="#about" class="inline-flex items-center justify-center gap-2 px-8 py-4 border-2 border-white/20 text-white font-semibold rounded-xl hover:bg-white/10 hover:border-white/30 transition-all">
                    Tentang Kami
                </a>
            </div>
        </div>
    </div>
    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce">
        <span class="text-white/30 text-xs tracking-widest uppercase">Scroll</span>
        <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</section>

{{-- ============================================ --}}
{{-- SECTION 2: ABOUT US --}}
{{-- ============================================ --}}
<section id="about" class="relative py-24 lg:py-32 bg-white overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gold-400 to-transparent"></div>
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-gold-100/50 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-navy-100/30 rounded-full blur-3xl"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Section Header -->
        <div class="text-center mb-16 reveal">
            <span class="inline-block px-4 py-1.5 rounded-full bg-navy-50 text-navy-600 text-xs font-semibold uppercase tracking-widest mb-4">Tentang Kami</span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-navy-900">About <span class="gold-text">Us</span></h2>
            <div class="gold-line w-20 mx-auto mt-6"></div>
        </div>
        <!-- Content Grid -->
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Left: Image -->
            <div class="reveal">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-gold-200/50 group">
                        <img src="{{ asset('images/about-team.png') }}" alt="Tim PT Efha Sejahtera Bersama" class="w-full h-[550px] object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-950/40 via-transparent to-transparent"></div>
                    </div>
            </div>
            <!-- Right: Text -->
            <div class="reveal">
                <h3 class="text-2xl lg:text-3xl font-bold text-navy-900 mb-6">
                    Membangun Infrastruktur Jasa Telekomunikasi
                </h3>
                <p class="text-navy-600/80 leading-relaxed mb-6 text-justify">
                    PT EFHA SEJAHTERA BERSAMA adalah perusahaan profesional yang berfokus pada penyediaan jasa infrastruktur telekomunikasi, mulai dari instalasi dan modernisasi hingga optimasi jaringan. Berpengalaman dalam menangani berbagai proyek strategis, kami telah memantapkan posisi sebagai mitra terpercaya bagi operator dan vendor telekomunikasi terkemuka di Indonesia.
                </p>
                <p class="text-navy-600/80 leading-relaxed mb-6 text-justify">
                    Operasional kami didukung oleh tenaga ahli bersertifikasi nasional dengan standar kompetensi tinggi. Saat ini, cangkupan layanan kami telah menjangkau wilayah Pulau Jawa, Kalimantan, hingga Bali, yang membuktikan kapasitas perusahaan dalam mengelola proyek berskala luas dengan manajemen teknis yang terorganisasi secara presisi.
                </p>
                <p class="text-navy-600/80 leading-relaxed text-justify">
                    Kami mengutamakan kualitas hasil kerja dan kepercayaan mitra melalui adopsi teknologi terbaru serta kepatuhan ketat pada standar operator. Dengan pendekatan sistematis dan respons yang cepat, PT EFHA SEJAHTERA BERSAMA siap menjadi solusi andalan bagi pembangunan infrastruktur komunikasi yang berkelanjutan dimasa depan.
                </p>
            </div>
        </div>
    </div>
</section>

@include('sections.vision_mission')

@include('sections.values')

@include('sections.safety')

@include('sections.legal')

@include('sections.partners')

@include('sections.services')
@include('sections.portfolio')
@include('sections.contact')

@endsection
