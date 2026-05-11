@extends('layouts.app')

@section('title', 'AI Forecasting - ' . $project->nama)

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
                    <svg class="w-8 h-8 text-[#f3b01c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <h1 class="text-3xl font-black tracking-tight leading-none text-white">Antigravity <span class="text-[#f3b01c]">AI</span></h1>
                    <p class="text-white/40 text-[10px] font-black uppercase tracking-[0.3em] mt-1">Advanced Project Forecasting</p>
                </div>
            </div>
            
            <!-- Bento Grid Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Info 1: Project Name -->
                <div class="col-span-1 md:col-span-3 p-6 bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 hover:border-[#f3b01c]/30 transition-all flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <p class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-1">Target Proyek</p>
                        <h2 class="text-xl font-bold text-white">{{ $project->nama }}</h2>
                    </div>
                    <div class="px-4 py-2 bg-[#f3b01c]/10 border border-[#f3b01c]/20 rounded-full">
                        <p class="text-[10px] font-black text-[#f3b01c] uppercase tracking-widest">{{ $project->service_type }}</p>
                    </div>
                </div>

                <!-- Info 2: Budget -->
                <div class="p-6 bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 hover:border-[#f3b01c]/30 transition-all">
                    <p class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-2 flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-[#f3b01c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Anggaran Total
                    </p>
                    <p class="text-xl font-black text-white">Rp {{ number_format($project->budget_awal, 0, ',', '.') }}</p>
                </div>

                <!-- Info 3: Realisasi -->
                <div class="p-6 bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 hover:border-[#f3b01c]/30 transition-all">
                    <p class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-2 flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-[#f3b01c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        Pengeluaran Riil
                    </p>
                    <p class="text-xl font-black text-white">Rp {{ number_format($project->total_expenses, 0, ',', '.') }}</p>
                </div>

                <!-- Info 4: Progress -->
                <div class="p-6 bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 hover:border-[#f3b01c]/30 transition-all flex flex-col justify-center">
                    <p class="text-[10px] font-black text-white/30 uppercase tracking-widest mb-2">Progres Lapangan</p>
                    <div class="flex items-center gap-4">
                        <div class="flex-1 h-2 bg-white/10 rounded-full overflow-hidden">
                            <div class="h-full bg-[#f3b01c] shadow-[0_0_10px_#f3b01c]" style="width: {{ $project->technical_progress }}%"></div>
                        </div>
                        <span class="text-xl font-black text-[#f3b01c]">{{ $project->technical_progress }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- AI Result Main Card -->
        <div class="reveal mt-12">
            <div class="bg-white/5 backdrop-blur-2xl rounded-[2.5rem] border border-[#f3b01c]/30 p-8 md:p-12 relative overflow-hidden group shadow-[0_0_30px_rgba(243,176,28,0.15)] hover:shadow-[0_0_40px_rgba(243,176,28,0.25)] transition-all duration-500">
                <!-- Inner Glow -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-[#f3b01c]/20 rounded-full blur-[80px]"></div>

                <div class="relative z-10">
                    @php
                        $isDelayed = str_contains(strtoupper($analysis), 'DELAY');
                        $daysRemaining = null;
                        $countdownText = 'Deadline belum ditentukan';
                        
                        if ($project->deadline) {
                            $daysRemaining = (int) now()->startOfDay()->diffInDays($project->deadline->startOfDay(), false);
                            if ($daysRemaining > 0) {
                                $countdownText = "Sisa {$daysRemaining} Hari menuju Deadline ({$project->deadline->format('d M Y')})";
                            } elseif ($daysRemaining === 0) {
                                $countdownText = "Deadline Hari Ini! ({$project->deadline->format('d M Y')})";
                            } else {
                                $countdownText = "Terlewat " . abs($daysRemaining) . " Hari dari Deadline ({$project->deadline->format('d M Y')})";
                            }
                        }
                    @endphp

                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 border-b border-white/10 pb-6">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 bg-[#f3b01c] rounded-full shadow-[0_0_8px_#f3b01c] animate-pulse"></span>
                            <h3 class="text-sm font-black uppercase tracking-[0.2em] text-[#f3b01c]">AI Strategic Report</h3>
                        </div>

                        <div class="flex items-center gap-3">
                            <!-- Countdown Badge -->
                            <div class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-full">
                                <span class="text-[10px] font-black uppercase tracking-widest text-white/70">{{ $countdownText }}</span>
                            </div>

                            <!-- AI Status Badge -->
                            @if($isDelayed)
                                <div class="px-4 py-1.5 bg-red-500/20 border border-red-500/50 rounded-full flex items-center gap-2 animate-pulse">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-red-400">Potential Delay</span>
                                </div>
                            @else
                                <div class="px-4 py-1.5 bg-green-500/10 border border-green-500/30 rounded-full flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-green-400">On Track</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Markdown Content -->
                    <div class="prose prose-invert max-w-none 
                        prose-p:text-white/80 prose-p:leading-relaxed 
                        prose-li:text-white/80 
                        prose-strong:text-[#f3b01c] prose-strong:font-black
                        prose-headings:text-white prose-headings:font-black prose-headings:tracking-tight
                        prose-a:text-[#f3b01c] hover:prose-a:text-white
                        prose-blockquote:border-[#f3b01c] prose-blockquote:bg-white/5 prose-blockquote:px-4 prose-blockquote:py-1 prose-blockquote:rounded-r-lg prose-blockquote:not-italic">
                        {!! Str::markdown($analysis) !!}
                    </div>
                </div>
            </div>

            <!-- Footer Action -->
            <div class="flex justify-center pt-10">
                <a href="{{ route('admin.dashboard') }}" class="px-8 py-4 bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] text-white/70 hover:text-[#f3b01c] hover:border-[#f3b01c]/50 transition-all flex items-center gap-3 group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
