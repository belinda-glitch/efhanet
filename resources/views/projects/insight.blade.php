@extends('layouts.app')

@section('title', 'Concierge Insight - ' . $project->nama)

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-[#0b0f19] text-white overflow-hidden relative">
    <!-- Background Decor -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-[#f3b01c]/5 -skew-x-12 translate-x-1/4"></div>
    <div class="absolute top-40 left-10 w-96 h-96 bg-[#f3b01c]/10 rounded-full blur-[120px] animate-pulse"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header -->
        <div class="mb-10 reveal">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 rounded-2xl bg-[#f3b01c]/20 border border-[#f3b01c]/50 flex items-center justify-center shadow-[0_0_20px_rgba(243,176,28,0.3)]">
                    <svg class="w-8 h-8 text-[#f3b01c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight leading-none text-white">Antigravity <span class="text-[#f3b01c]">Concierge</span></h1>
                    <p class="text-white/40 text-[10px] font-black uppercase tracking-[0.3em] mt-1">Laporan Status Transparan untuk Anda</p>
                </div>
            </div>
            
            <!-- Bento Grid Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-6 bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 hover:border-[#f3b01c]/30 transition-all flex flex-col justify-center">
                    <p class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-2">Progres Pekerjaan</p>
                    <div class="flex items-center gap-4">
                        <div class="flex-1 h-2 bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-[#f3b01c] shadow-[0_0_10px_#f3b01c]" style="width: {{ $project->technical_progress }}%"></div>
                        </div>
                        <span class="text-xl font-black text-[#f3b01c]">{{ $project->technical_progress }}%</span>
                    </div>
                </div>

                <div class="p-6 bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 hover:border-[#f3b01c]/30 transition-all">
                    <p class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-2 flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-[#f3b01c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Dana Teralokasikan
                    </p>
                    <p class="text-xl font-black text-white">Rp {{ number_format($project->total_expenses, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- AI Result Main Card -->
        <div class="reveal mt-12">
            <div class="bg-white/5 backdrop-blur-2xl rounded-[2.5rem] border border-[#f3b01c]/30 p-8 md:p-12 relative overflow-hidden group shadow-[0_0_30px_rgba(243,176,28,0.15)] hover:shadow-[0_0_40px_rgba(243,176,28,0.25)] transition-all duration-500">
                <!-- Inner Glow -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-[#f3b01c]/20 rounded-full blur-[80px]"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-8 border-b border-white/10 pb-6">
                        <span class="w-2 h-2 bg-[#f3b01c] rounded-full shadow-[0_0_8px_#f3b01c] animate-pulse"></span>
                        <h3 class="text-sm font-black uppercase tracking-[0.2em] text-[#f3b01c]">Pesan dari Tim Lapangan</h3>
                    </div>

                    <!-- Markdown Content -->
                    <div class="prose prose-invert max-w-none 
                        prose-p:text-white/80 prose-p:leading-relaxed 
                        prose-li:text-white/80 
                        prose-strong:text-[#f3b01c] prose-strong:font-black
                        prose-headings:text-white prose-headings:font-black prose-headings:tracking-tight
                        prose-a:text-[#f3b01c] hover:prose-a:text-white
                        prose-blockquote:border-[#f3b01c] prose-blockquote:bg-white/5 prose-blockquote:px-4 prose-blockquote:py-1 prose-blockquote:rounded-r-lg prose-blockquote:not-italic">
                        {!! Str::markdown($insight) !!}
                    </div>
                </div>
            </div>

            <!-- Footer Action -->
            <div class="flex justify-center pt-10">
                <a href="{{ route('projects.show', $project->id) }}" class="px-8 py-4 bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] text-white/70 hover:text-[#f3b01c] hover:border-[#f3b01c]/50 transition-all flex items-center gap-3 group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Proyek
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
