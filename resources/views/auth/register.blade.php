@extends('layouts.app')

@section('title', 'Register')

@section('content')
<section class="relative min-h-screen flex items-center justify-center py-20 overflow-hidden bg-navy-950">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/hero-bg.png') }}" alt="Background" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-gradient-to-br from-navy-950 via-navy-900/80 to-navy-950"></div>
    </div>
    
    <!-- Decorative Blurs -->
    <div class="absolute top-1/4 -right-20 w-96 h-96 bg-gold-500/10 rounded-full blur-[120px] animate-float"></div>
    <div class="absolute bottom-1/4 -left-20 w-96 h-96 bg-navy-500/20 rounded-full blur-[120px]"></div>

    <div class="relative z-10 w-full max-w-md px-6">
        <div class="reveal">
            <!-- Card -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 lg:p-10 shadow-2xl">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-gold-400 to-gold-600 mb-6 shadow-lg shadow-gold-500/20">
                        <svg class="w-8 h-8 text-navy-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-white mb-2">Buat <span class="gold-text">Akun</span></h2>
                    <p class="text-white/50 text-sm">Daftar untuk akses fitur konsultasi eksklusif</p>
                </div>

                <!-- Form -->
                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="text-xs font-bold uppercase tracking-widest text-gold-400 ml-1">Nama Lengkap</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/30 group-focus-within:text-gold-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                                class="w-full bg-white/5 border border-white/10 rounded-xl py-4 pl-12 pr-4 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-gold-500/50 focus:border-gold-500 transition-all"
                                placeholder="John Doe">
                        </div>
                        @error('name')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Name -->
                    <div class="space-y-2">
                        <label for="nama_perusahaan" class="text-xs font-bold uppercase tracking-widest text-gold-400 ml-1">Nama Perusahaan / Instansi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/30 group-focus-within:text-gold-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" required 
                                class="w-full bg-white/5 border border-white/10 rounded-xl py-4 pl-12 pr-4 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-gold-500/50 focus:border-gold-500 transition-all"
                                placeholder="PT Telkom Indonesia">
                        </div>
                        @error('nama_perusahaan')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="space-y-2">
                        <label for="phone" class="text-xs font-bold uppercase tracking-widest text-gold-400 ml-1">Nomor WhatsApp/HP</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/30 group-focus-within:text-gold-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required 
                                class="w-full bg-white/5 border border-white/10 rounded-xl py-4 pl-12 pr-4 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-gold-500/50 focus:border-gold-500 transition-all"
                                placeholder="081234567890">
                        </div>
                        @error('phone')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="text-xs font-bold uppercase tracking-widest text-gold-400 ml-1">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/30 group-focus-within:text-gold-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/></svg>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                                class="w-full bg-white/5 border border-white/10 rounded-xl py-4 pl-12 pr-4 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-gold-500/50 focus:border-gold-500 transition-all"
                                placeholder="name@company.com">
                        </div>
                        @error('email')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-2">
                        <label for="password" class="text-xs font-bold uppercase tracking-widest text-gold-400 ml-1">Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/30 group-focus-within:text-gold-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input type="password" id="password" name="password" required 
                                class="w-full bg-white/5 border border-white/10 rounded-xl py-4 pl-12 pr-12 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-gold-500/50 focus:border-gold-500 transition-all"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password', 'eye-icon-1')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gold-400/60 hover:text-gold-400 transition-colors z-20">
                                <svg id="eye-icon-1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-400 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="text-xs font-bold uppercase tracking-widest text-gold-400 ml-1">Konfirmasi Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-white/30 group-focus-within:text-gold-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" required 
                                class="w-full bg-white/5 border border-white/10 rounded-xl py-4 pl-12 pr-12 text-white placeholder-white/20 focus:outline-none focus:ring-2 focus:ring-gold-500/50 focus:border-gold-500 transition-all"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-2')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gold-400/60 hover:text-gold-400 transition-colors z-20">
                                <svg id="eye-icon-2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path class="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    <path class="eye-closed hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <script>
                        function togglePassword(inputId, iconId) {
                            const input = document.getElementById(inputId);
                            const icon = document.getElementById(iconId);
                            const openPaths = icon.querySelectorAll('.eye-open');
                            const closedPath = icon.querySelector('.eye-closed');

                            if (input.type === 'password') {
                                input.type = 'text';
                                openPaths.forEach(p => p.classList.add('hidden'));
                                closedPath.classList.remove('hidden');
                            } else {
                                input.type = 'password';
                                openPaths.forEach(p => p.classList.remove('hidden'));
                                closedPath.classList.add('hidden');
                            }
                        }
                    </script>

                    <!-- Submit -->
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-gold-400 to-gold-600 text-navy-950 font-black rounded-xl hover:from-gold-300 hover:to-gold-500 transition-all shadow-xl shadow-gold-500/20 hover:shadow-gold-500/40 transform hover:-translate-y-1 mt-4">
                        DAFTAR SEKARANG
                    </button>
                </form>

                <!-- Footer -->
                <div class="mt-8 pt-8 border-t border-white/5 text-center">
                    <p class="text-white/50 text-sm">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-gold-400 font-bold hover:text-gold-300 transition-colors ml-1">Masuk</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
