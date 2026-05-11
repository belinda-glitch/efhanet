{{-- ============================================ --}}
{{-- SECTION: OUR PARTNERS --}}
{{-- ============================================ --}}
<section id="partners" class="relative py-20 bg-white border-t border-navy-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 reveal">
            <span class="inline-block px-4 py-1.5 rounded-full bg-navy-50 text-navy-600 text-xs font-semibold uppercase tracking-widest mb-4">Kolaborasi Strategis</span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-navy-900">Strategic <span class="gold-text">Partners</span></h2>
            <p class="text-navy-500 mt-4 max-w-2xl mx-auto">Kami bangga bekerja sama dengan para pemimpin industri telekomunikasi untuk membangun konektivitas Indonesia.</p>
            <div class="gold-line w-20 mx-auto mt-6"></div>
        </div>

        <!-- Partners Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4 lg:gap-8 reveal">
            <!-- Dynamic Partners (Dari Database Admin) -->
            @foreach($partners as $partner)
                <div class="group h-32 flex items-center justify-center p-8 rounded-2xl bg-white border border-navy-100 shadow-sm hover:border-gold-400 hover:shadow-lg transition-all duration-500 relative">
                    @if($partner->link)
                        <a href="{{ $partner->link }}" target="_blank" class="absolute inset-0 z-10"></a>
                    @endif
                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-500 grayscale group-hover:grayscale-0 opacity-60 group-hover:opacity-100">
                </div>
            @endforeach

            <!-- And More -->
            <div class="group h-32 flex items-center justify-center p-8 rounded-2xl bg-navy-50/50 border border-dashed border-navy-200 hover:bg-navy-100 transition-all">
                <span class="text-xs font-bold text-navy-600 uppercase tracking-widest">And More</span>
            </div>
        </div>
    </div>
</section>

