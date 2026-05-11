@extends('layouts.app')

@section('title', 'PT Efha Sejahtera Bersama')

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
                Solusi Infrastruktur
                <span class="block mt-2 gold-text">Telekomunikasi Terpercaya</span>
            </h1>
            <p class="text-base sm:text-lg text-white/60 leading-relaxed max-w-2xl mx-auto mb-10 animate-fade-in-up delay-100">
                PT Efha Sejahtera Bersama hadir sebagai mitra strategis dalam pembangunan, instalasi, dan optimasi jaringan telekomunikasi di seluruh Indonesia.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up delay-200">
                <a href="#services" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-gold-400 to-gold-500 text-navy-950 font-bold rounded-xl hover:from-gold-300 hover:to-gold-400 transition-all shadow-xl shadow-gold-500/25 hover:shadow-gold-500/40 hover:-translate-y-1">
                    Lihat Layanan
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="#about" class="inline-flex items-center justify-center gap-2 px-8 py-4 border-2 border-white/20 text-white font-semibold rounded-xl hover:bg-white/10 hover:border-white/30 transition-all">
                    Pelajari Tentang Kami
                </a>
            </div>
        </div>
    </div>
</section>

@include('sections.about')
@include('sections.vision_mission')
@include('sections.values')
@include('sections.safety')
@include('sections.legal')
@include('sections.partners')
@include('sections.services')
@include('sections.portfolio')
@include('sections.contact')

@endsection
