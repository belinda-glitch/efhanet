@php
    $dbServices = \App\Models\Service::all();
@endphp

{{-- ============================================ --}}
{{-- SECTION 3: SERVICES --}}
{{-- ============================================ --}}
<section id="services" class="relative py-24 lg:py-32 bg-navy-950 overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gold-400 to-transparent"></div>
    <div class="absolute top-20 right-0 w-96 h-96 bg-gold-500/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-navy-700/30 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Section Header -->
        <div class="text-center mb-16 reveal">
            <span class="inline-block px-4 py-1.5 rounded-full bg-gold-500/10 border border-gold-500/20 text-gold-400 text-xs font-semibold uppercase tracking-widest mb-4">Layanan Kami</span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white">Layanan <span class="gold-text">Kami</span></h2>
            <p class="text-white/50 mt-4 max-w-2xl mx-auto">Kami menyediakan layanan infrastruktur telekomunikasi yang komprehensif dan berkualitas tinggi.</p>
            <div class="gold-line w-20 mx-auto mt-6"></div>
        </div>

        <!-- Services Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($dbServices as $service)
            <div class="reveal group relative p-6 lg:p-8 rounded-2xl bg-white/5 border border-white/10 hover:border-gold-500/30 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-gold-500/10">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-gold-400 to-gold-500 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-gold-500/20">
                    <i class="{{ $service->icon }} text-navy-950 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-white mb-3">{{ $service->title }}</h3>
                <p class="text-sm text-white/50 leading-relaxed">{{ $service->description }}</p>
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-gold-400 to-gold-500 rounded-b-2xl scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
            </div>
            @empty
                <!-- Fallback if no services in DB -->
                <div class="col-span-full py-20 text-center">
                    <p class="text-white/30 italic">Layanan sedang diperbarui...</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
