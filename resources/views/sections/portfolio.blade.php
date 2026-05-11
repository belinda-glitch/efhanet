{{-- ============================================ --}}
{{-- SECTION 4: PORTFOLIO (Dynamic Text-Based) --}}
{{-- ============================================ --}}
<section id="portfolio" class="relative py-24 lg:py-32 bg-[#050b14] overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute top-0 right-0 w-1/3 h-full bg-navy-900/20 skew-x-12 transform translate-x-1/2"></div>
    <div class="absolute bottom-20 left-10 w-72 h-72 bg-gold-500/5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="mb-20 reveal">
            <span class="inline-block px-4 py-1.5 rounded-full bg-gold-500/10 border border-gold-500/20 text-gold-400 text-xs font-semibold uppercase tracking-widest mb-4">Pengalaman Kerja</span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white">Project <span class="gold-text">Portfolio</span></h2>
            <p class="text-white/40 mt-4 max-w-2xl leading-relaxed italic">"Our track record of excellence in delivering mission-critical telecommunications infrastructure."</p>
            <div class="gold-line w-20 mt-6"></div>
        </div>

        <div class="space-y-20">
            @forelse($portfolioGroups as $group)
            <div class="reveal">
                <!-- Group Title with Orange Vertical Line -->
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-1.5 h-10 bg-gradient-to-b from-gold-400 to-gold-600 rounded-full shadow-lg shadow-gold-500/20"></div>
                    <h3 class="text-2xl font-black text-white uppercase tracking-wider tracking-widest">
                        {{ $group->name }}
                    </h3>
                </div>

                <!-- Projects Table -->
                <div class="overflow-hidden rounded-2xl border border-white/5 bg-white/[0.02] backdrop-blur-sm shadow-2xl">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-white/10 bg-white/[0.03]">
                                <th class="px-6 py-5 text-[11px] font-black uppercase text-gold-400 tracking-[0.2em] w-1/3">Project Name</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase text-gold-400 tracking-[0.2em]">Scope of Work</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($group->items as $item)
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="px-6 py-6 align-top">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-gold-500 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                                        <p class="text-sm font-bold text-white/90 group-hover:text-white transition-colors leading-tight">
                                            {{ $item->project_name }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-6 align-top">
                                    <p class="text-sm text-white/40 group-hover:text-white/60 transition-colors leading-relaxed">
                                        {{ $item->scope_of_work }}
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @empty
            <div class="py-20 text-center border-2 border-dashed border-white/5 rounded-[2.5rem]">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6 text-white/10">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <p class="text-white/20 font-black uppercase tracking-[0.2em] text-sm">Portfolio data is currently being updated</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
