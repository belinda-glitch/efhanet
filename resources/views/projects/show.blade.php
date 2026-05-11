@extends('layouts.app')

@section('title', 'Partner Monitoring Portal - ' . $project->nama)

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
@endpush

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-navy-950 text-white overflow-hidden relative">
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-navy-900/50 -skew-x-12 translate-x-1/4"></div>
    <div class="absolute top-40 left-10 w-96 h-96 bg-gold-500/5 rounded-full blur-[120px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        
        <!-- Header & Integrity Badge -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 mb-12 reveal">
            <div>
                <nav class="flex mb-4" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('projects.index') }}" class="text-[10px] font-black uppercase tracking-widest text-white/40 hover:text-gold-400 transition-colors">Portal Pemantauan</a>
                        </li>
                        <li>
                            <div class="flex items-center text-white/20">
                                <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-[10px] font-black uppercase tracking-widest text-gold-500/80">Detail Proyek</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-4xl lg:text-5xl font-black tracking-tight leading-none mb-2">
                    {{ $project->nama }}
                </h1>
                <p class="text-white/40 font-bold uppercase tracking-[0.2em] text-xs">
                    Wilayah: {{ $project->kecamatan_pontianak }} • Jasa: {{ $project->service_type }}
                </p>
                @if(Auth::user()->nama_perusahaan)
                    <p class="text-gold-500/60 font-black uppercase tracking-widest text-[9px] mt-2">Mitra Strategis: {{ Auth::user()->nama_perusahaan }}</p>
                @endif
            </div>

            <!-- Right Side: Actions & Integrity Badge -->
            <div class="flex flex-col items-end gap-4">

                <!-- Integrity Badge Section -->
                @php
                    $isHseVerified = ($project->updated_at->isToday() && $project->daily_toolbox_status) || $project->status_k3 === 'Kepatuhan K3 Terpenuhi';
                @endphp
                <div class="flex items-center gap-6 bg-white/5 p-4 pr-8 rounded-[2rem] border border-white/10 backdrop-blur-sm">
                    <div class="relative">
                        <div class="w-16 h-16 rounded-full {{ $isHseVerified ? 'bg-green-500 shadow-[0_0_30px_rgba(34,197,94,0.4)]' : 'bg-gray-600' }} flex items-center justify-center transition-all duration-500">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        @if($isHseVerified)
                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full animate-ping"></div>
                        @endif
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest {{ $isHseVerified ? 'text-green-400' : 'text-white/30' }}">Lencana Integritas</p>
                        <h4 class="text-sm font-black uppercase tracking-tight">
                            {{ $isHseVerified ? 'K3 Terverifikasi' : 'Verifikasi Tertunda' }}
                        </h4>
                        <p class="text-[9px] text-white/40 font-bold uppercase mt-0.5">Standar K3 PT Efha</p>
                    </div>
                </div>

                <!-- Concierge AI Button -->
                <a href="{{ route('projects.insight', $project->id) }}" class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-[#f3b01c] to-gold-600 rounded-full text-navy-950 font-black uppercase tracking-widest text-[10px] hover:-translate-y-0.5 shadow-[0_0_15px_rgba(243,176,28,0.3)] hover:shadow-[0_0_25px_rgba(243,176,28,0.5)] transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                    Cek Status Proyek via AI
                </a>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left: Progress Monitoring -->
            <div class="lg:col-span-2 space-y-8">
                
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Main Progress Card -->
                    <div class="bg-white/5 rounded-[2.5rem] border border-white/10 p-10 overflow-hidden relative reveal h-full">
                        <div class="absolute top-0 right-0 p-8">
                            <span class="text-6xl font-black text-white/5 leading-none">{{ $project->technical_progress }}%</span>
                        </div>
                        
                        <h3 class="text-xl font-black uppercase tracking-tight mb-8 flex items-center gap-3 text-gold-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Kemajuan Teknis
                        </h3>

                        <div class="space-y-12 relative z-10">
                            <div>
                                <div class="flex justify-between items-end mb-4">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-white/40">Status Lapangan</span>
                                    <span class="text-3xl font-black text-white">{{ $project->technical_progress }}%</span>
                                </div>
                                <div class="h-4 bg-navy-900 rounded-full p-1 border border-white/10">
                                    <div class="h-full bg-gradient-to-r from-gold-600 via-gold-400 to-gold-500 rounded-full shadow-[0_0_20px_rgba(212,152,42,0.3)]" style="width: {{ $project->technical_progress }}%"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-4 gap-2">
                                @php
                                    $milestones = [
                                        ['label' => 'Site Survey', 'threshold' => 25],
                                        ['label' => 'Design Ready', 'threshold' => 50],
                                        ['label' => 'Materials', 'threshold' => 75],
                                        ['label' => 'Completion', 'threshold' => 100],
                                    ];
                                @endphp
                                @foreach($milestones as $m)
                                    <div class="text-center">
                                        <div class="w-8 h-8 rounded-lg mx-auto mb-2 flex items-center justify-center {{ $project->technical_progress >= $m['threshold'] ? 'bg-gold-500 text-navy-950' : 'bg-white/5 text-white/10 border border-white/5' }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                        <p class="text-[7px] font-black uppercase tracking-widest {{ $project->technical_progress >= $m['threshold'] ? 'text-white' : 'text-white/20' }}">{{ $m['label'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Financial Summary (Client View) -->
                    <div class="bg-white/5 rounded-[2.5rem] border border-white/10 p-10 reveal h-full flex flex-col">
                        <h3 class="text-xl font-black uppercase tracking-tight mb-8 flex items-center gap-3 text-gold-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Ringkasan Anggaran Proyek
                        </h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 items-center flex-grow">
                            <!-- Chart Container -->
                            <div class="relative aspect-square max-w-[160px] mx-auto">
                                <canvas id="budgetChart"></canvas>
                                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                    <span class="text-2xl font-black text-white leading-none">
                                        {{ $total_anggaran > 0 ? round(($anggaran_terpakai / $total_anggaran) * 100) : 0 }}%
                                    </span>
                                    <span class="text-[8px] font-black uppercase tracking-widest text-white/30 mt-1">Terpakai</span>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="group">
                                    <p class="text-[9px] text-white/40 font-black uppercase tracking-widest mb-1">Total Anggaran Kontrak</p>
                                    <p class="text-sm font-black text-white">Rp {{ number_format($total_anggaran, 0, ',', '.') }}</p>
                                </div>
                                <div class="group">
                                    <p class="text-[9px] text-white/40 font-black uppercase tracking-widest mb-1">Anggaran Terpakai</p>
                                    <p class="text-sm font-black text-gold-500">Rp {{ number_format($anggaran_terpakai, 0, ',', '.') }}</p>
                                </div>
                                <div class="pt-4 border-t border-white/5 group">
                                    <p class="text-[9px] text-white/40 font-black uppercase tracking-widest mb-1">Sisa Dana Proyek</p>
                                    <p class="text-sm font-black text-green-400">Rp {{ number_format($sisa_anggaran, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Verified Transaction Details (New Transparency Section) -->
                    <div class="bg-navy-900/50 rounded-[2.5rem] border border-white/5 p-10 reveal mt-8">
                        <h3 class="text-xl font-black uppercase tracking-tight mb-8 flex items-center gap-3 text-gold-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Arsip Transaksi Terverifikasi
                        </h3>

                        @php
                            $verifiedExpenses = $project->expenses->whereNotNull('nota');
                        @endphp

                        @if($verifiedExpenses->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-separate border-spacing-y-3">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-3 text-[9px] font-black uppercase text-white/30 tracking-widest">Kategori & Detail</th>
                                            <th class="px-4 py-3 text-[9px] font-black uppercase text-white/30 tracking-widest text-right">Nominal</th>
                                            <th class="px-4 py-3 text-[9px] font-black uppercase text-white/30 tracking-widest text-center">Bukti Nota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($verifiedExpenses as $expense)
                                            <tr class="group">
                                                <td class="px-4 py-5 bg-white/5 rounded-l-[1.5rem] border-y border-l border-white/5 group-hover:bg-white/10 transition-all">
                                                    <p class="text-xs font-black text-white uppercase tracking-tight">{{ $expense->kategori_biaya }}</p>
                                                    @if($expense->detail_material)
                                                        <p class="text-[10px] text-white/40 font-bold italic mt-1">({{ $expense->detail_material }})</p>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-5 bg-white/5 border-y border-white/5 group-hover:bg-white/10 text-right transition-all">
                                                    <p class="text-xs font-black text-gold-500">Rp {{ number_format($expense->jumlah_nominal, 0, ',', '.') }}</p>
                                                    <p class="text-[8px] text-white/20 font-black uppercase mt-1">{{ $expense->created_at->format('d M Y') }}</p>
                                                </td>
                                                <td class="px-4 py-5 bg-white/5 rounded-r-[1.5rem] border-y border-r border-white/5 group-hover:bg-white/10 text-center transition-all">
                                                    <a href="{{ asset('storage/' . $expense->nota) }}" class="glightbox inline-flex items-center gap-2 px-3 py-1.5 bg-white/5 rounded-full border border-white/10 hover:border-gold-500/50 hover:bg-gold-500/10 transition-all group/btn" data-glightbox="title: Nota {{ $expense->kategori_biaya }}; description: {{ $expense->detail_material ?? 'Transaksi Terverifikasi EfhaNet' }}">
                                                        <svg class="w-3 h-3 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                        <span class="text-[8px] font-black uppercase text-white/60 group-hover/btn:text-white">Lihat Nota</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="py-12 text-center border border-dashed border-white/10 rounded-[2rem]">
                                <p class="text-[10px] font-black uppercase tracking-widest text-white/20">Belum ada rincian transaksi terverifikasi.</p>
                            </div>
                        @endif
                    </div>
                </div>

                    <!-- Field Documentation (Bento Grid) -->
                    <div class="bg-navy-950/40 rounded-[3rem] border border-white/5 p-10 reveal backdrop-blur-sm">
                        <div class="flex items-center justify-between mb-12">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-gold-500/10 flex items-center justify-center border border-gold-500/20">
                                    <svg class="w-6 h-6 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-black uppercase tracking-tight text-white">Dokumentasi Lapangan</h3>
                                    <p class="text-[9px] font-black text-gold-400 uppercase tracking-[0.3em]">Visualisasi Integritas Infrastruktur</p>
                                </div>
                            </div>
                            <div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10">
                                <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div>
                                <span class="text-[8px] font-black uppercase tracking-widest text-white/60">Live Repository</span>
                            </div>
                        </div>
                        
                        @if($project->documentations->count() > 0)
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 auto-rows-[160px] md:auto-rows-[200px]">
                                @foreach($project->documentations as $index => $doc)
                                    @php
                                        $spans = [
                                            0 => 'col-span-2 row-span-2', 
                                            1 => 'col-span-1 row-span-1',
                                            2 => 'col-span-1 row-span-1',
                                            3 => 'col-span-2 row-span-1',
                                            4 => 'col-span-1 row-span-2',
                                            5 => 'col-span-1 row-span-1',
                                        ];
                                        $spanClass = $spans[$index % count($spans)] ?? 'col-span-1 row-span-1';
                                    @endphp
                                    <a href="{{ Storage::url($doc->file_path) }}" class="glightbox {{ $spanClass }} group relative rounded-[2.5rem] overflow-hidden border border-white/5 bg-navy-900 shadow-2xl transition-all duration-700 hover:border-gold-500/30" data-glightbox="title: {{ $doc->caption ?? 'Dokumentasi EfhaNet' }}; description: Lokasi: {{ $project->kecamatan_pontianak }} • {{ $doc->created_at->format('d M Y') }}">
                                        <!-- Hover Zoom Thumbnail -->
                                        <img src="{{ Storage::url($doc->thumbnail_path ?? $doc->file_path) }}" alt="{{ $doc->caption }}" class="w-full h-full object-cover transition-transform duration-[1.5s] group-hover:scale-110 opacity-60 group-hover:opacity-100">
                                        
                                        <!-- Glassmorphism Overlay -->
                                        <div class="absolute bottom-4 left-4 right-4 p-5 rounded-[2rem] bg-navy-950/60 backdrop-blur-xl border border-white/10 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0 shadow-2xl">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="w-1 h-3 bg-gold-500 rounded-full"></span>
                                                <p class="text-[8px] font-black uppercase tracking-[0.2em] text-gold-400">Arsip Lapangan</p>
                                            </div>
                                            <p class="text-[11px] font-bold text-white leading-snug mb-4 line-clamp-2 uppercase tracking-tight">
                                                {{ $doc->caption ?? 'Dokumentasi Operasional EfhaNet' }}
                                            </p>
                                            <div class="flex items-center justify-between pt-3 border-t border-white/5">
                                                <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
                                                    <!-- Location Info -->
                                                    <div class="flex items-center gap-1.5">
                                                        <svg class="w-3 h-3 text-gold-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                                        <span class="text-[8px] font-black text-white/70 uppercase tracking-widest">{{ $project->kecamatan_pontianak }}</span>
                                                    </div>
                                                    <!-- Upload Date -->
                                                    <div class="flex items-center gap-1.5">
                                                        <svg class="w-3 h-3 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                        <span class="text-[8px] font-black text-white/40 uppercase tracking-widest">{{ $doc->created_at->format('d M Y') }}</span>
                                                    </div>
                                                </div>
                                                <div class="w-6 h-6 rounded-full bg-gold-500/10 flex items-center justify-center shrink-0">
                                                    <svg class="w-3 h-3 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Corner Icon -->
                                        <div class="absolute top-6 right-6 group-hover:opacity-0 transition-opacity duration-300">
                                            <div class="w-10 h-10 rounded-2xl bg-navy-950/80 backdrop-blur-md border border-white/10 flex items-center justify-center text-gold-500 shadow-xl">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="py-32 text-center border-2 border-dashed border-white/5 rounded-[3rem] bg-white/[0.01] relative overflow-hidden group">
                                <!-- Minimalist Illustration (Abstract Shapes) -->
                                <div class="relative w-32 h-32 mx-auto mb-10">
                                    <div class="absolute inset-0 bg-gold-500/5 rounded-full blur-2xl animate-pulse"></div>
                                    <div class="absolute inset-4 border border-white/5 rounded-3xl rotate-6 group-hover:rotate-12 transition-transform duration-700"></div>
                                    <div class="absolute inset-4 border border-gold-500/10 rounded-3xl -rotate-6 group-hover:-rotate-12 transition-transform duration-700"></div>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white/5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-white/30 text-xs font-black uppercase tracking-[0.3em] leading-relaxed max-w-xs mx-auto">
                                    Menunggu dokumentasi teknis dari tim lapangan...
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Safety & Integrity Info -->
            <div class="space-y-6 reveal">
                <!-- HSE Status Card -->
                <div class="bg-gradient-to-br from-navy-900 to-navy-950 p-8 rounded-[2.5rem] border border-white/10 shadow-2xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-orange-500/20 text-orange-500 flex items-center justify-center border border-orange-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <h4 class="font-black uppercase tracking-widest text-sm">Log Keamanan HSE</h4>
                    </div>

                    <div class="space-y-6">
                        <div class="p-5 bg-white/5 rounded-2xl border border-white/5">
                            <p class="text-[9px] font-black text-gold-400 uppercase tracking-widest mb-2">Status Pertemuan Keselamatan Harian</p>
                            <p class="text-xs font-bold text-white/70 leading-relaxed italic">
                                "{{ $project->daily_toolbox_status ?? 'Laporan operasional sedang diproses...' }}"
                            </p>
                        </div>

                        <div class="flex flex-col gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-1.5 h-1.5 rounded-full bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.8)]"></div>
                                <span class="text-[10px] font-black uppercase text-white/60">Status K3: {{ $project->status_k3 }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                                <span class="text-[10px] font-black uppercase text-white/60">Standar APD Terverifikasi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Strategic Message -->
                <div class="bg-gold-500 p-8 rounded-[2.5rem] text-navy-950 shadow-xl shadow-gold-500/20">
                    <h4 class="font-black text-xl mb-4 leading-tight">Komitmen Integritas Mitra</h4>
                    <p class="text-navy-950/70 text-xs font-bold leading-relaxed mb-6">PT Efha Sejahtera Bersama menjamin bahwa setiap langkah infrastruktur dikelola dengan integritas tinggi dan transparansi operasional bagi mitra strategis kami.</p>
                    <div class="h-px bg-navy-950/10 mb-6"></div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-navy-950 text-gold-400 flex items-center justify-center text-xs font-black">ES</div>
                        <div>
                            <p class="text-[10px] font-black uppercase">Pengawasan Proyek</p>
                            <p class="text-[9px] font-bold opacity-60">Divisi Teknik</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize GLightbox
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            zoomable: true
        });

        const ctx = document.getElementById('budgetChart').getContext('2d');
        const budgetChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Terpakai', 'Sisa'],
                datasets: [{
                    data: [{{ $anggaran_terpakai }}, {{ $sisa_anggaran > 0 ? $sisa_anggaran : 0 }}],
                    backgroundColor: ['#d4982a', 'rgba(255, 255, 255, 0.05)'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                cutout: '80%',
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
