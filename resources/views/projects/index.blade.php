@extends('layouts.app')

@section('title', 'Partner Portal - PT Efha Sejahtera Bersama')

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-navy-950 text-white overflow-hidden relative">
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-navy-900/50 -skew-x-12 translate-x-1/4"></div>
    <div class="absolute top-40 left-10 w-96 h-96 bg-gold-500/5 rounded-full blur-[120px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16 reveal">
            <div>
                <span class="inline-block px-4 py-1.5 rounded-full bg-gold-500/10 border border-gold-500/20 text-gold-400 text-[10px] font-black uppercase tracking-[0.3em] mb-4">Kemitraan Strategis</span>
                <h1 class="text-4xl lg:text-6xl font-black tracking-tight leading-none">
                    Pemantauan <span class="text-gold-500">Infrastruktur</span>
                </h1>
                <p class="text-white/40 mt-6 max-w-2xl text-sm font-bold uppercase tracking-widest leading-relaxed">
                    Selamat datang di portal khusus mitra. Pantau setiap inci kemajuan infrastruktur telekomunikasi Anda di Pontianak secara transparan dan aman.
                </p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-[10px] font-black text-white/30 uppercase tracking-widest">Active Partner</p>
                    <p class="text-sm font-black text-white uppercase">{{ Auth::user()->name }}</p>
                    @if(Auth::user()->nama_perusahaan)
                        <p class="text-[9px] font-bold text-gold-500 uppercase tracking-tighter mt-0.5">{{ Auth::user()->nama_perusahaan }}</p>
                    @endif
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center text-navy-950 font-black shadow-xl shadow-gold-500/20">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>

        <!-- Filter & Project List -->
        <div class="grid lg:grid-cols-4 gap-12">
            
            <!-- Sidebar: Analytics Snapshot -->
            <div class="space-y-8 reveal">
                <div class="bg-white/5 p-8 rounded-[2.5rem] border border-white/10 backdrop-blur-sm">
                    <h4 class="text-[10px] font-black uppercase tracking-widest text-gold-400 mb-6">Wilayah Pontianak</h4>
                    <div class="space-y-4">
                        <a href="{{ route('projects.index') }}" class="flex items-center justify-between p-4 rounded-2xl transition-all {{ !request('wilayah') ? 'bg-gold-500 text-navy-950 shadow-lg' : 'hover:bg-white/5 text-white/60' }}">
                            <span class="text-xs font-black uppercase">Semua Wilayah</span>
                            <span class="text-[10px] font-black opacity-50">{{ $projects->count() }}</span>
                        </a>
                        <a href="{{ route('projects.index', ['wilayah' => 'pontianak']) }}" class="flex items-center justify-between p-4 rounded-2xl transition-all {{ request('wilayah') === 'pontianak' ? 'bg-gold-500 text-navy-950 shadow-lg' : 'hover:bg-white/5 text-white/60' }}">
                            <span class="text-xs font-black uppercase">Hanya Pontianak</span>
                            <span class="text-[10px] font-black opacity-50">{{ $projects->where('kecamatan_pontianak', 'LIKE', '%Pontianak%')->count() }}</span>
                        </a>
                    </div>
                </div>

                <div class="p-8 bg-gradient-to-br from-navy-900 to-navy-950 rounded-[2.5rem] border border-white/5">
                    <p class="text-[9px] font-black text-white/30 uppercase tracking-widest mb-4">Kualitas & Keselamatan</p>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.8)]"></div>
                        <span class="text-[10px] font-bold text-white/60 uppercase">Pembaruan K3 Real-time</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.8)]"></div>
                        <span class="text-[10px] font-bold text-white/60 uppercase">Log Bukti Foto</span>
                    </div>
                </div>
            </div>

            <!-- Main Content: Project Grid -->
            <div class="lg:col-span-3 space-y-8">
                @if($projects->count() > 0)
                    <div class="grid sm:grid-cols-2 gap-6 reveal">
                        @foreach($projects as $item)
                        <a href="{{ route('projects.show', $item->id) }}" class="group bg-white/5 rounded-[2.5rem] border border-white/10 p-8 hover:border-gold-500/50 hover:bg-white/[0.07] transition-all duration-500 relative overflow-hidden flex flex-col justify-between">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gold-500/5 rounded-full blur-3xl -mr-16 -mt-16 group-hover:bg-gold-500/10 transition-all"></div>
                            
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <span class="text-[9px] font-black text-gold-400 uppercase tracking-widest">{{ $item->service_type }}</span>
                                    <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/5 text-[8px] font-black uppercase text-white/40">
                                        {{ $item->work_status }}
                                    </div>
                                </div>
                                <h3 class="text-xl font-black text-white group-hover:text-gold-400 transition-colors mb-2">{{ $item->nama }}</h3>
                                <p class="text-xs text-white/40 font-bold uppercase tracking-widest mb-8">{{ $item->kecamatan_pontianak }}</p>
                            </div>

                            <div class="space-y-4">
                                <div class="flex justify-between items-end mb-2">
                                    <span class="text-[9px] font-black text-white/30 uppercase tracking-widest">Kemajuan</span>
                                    <span class="text-lg font-black text-white">{{ $item->technical_progress }}%</span>
                                </div>
                                <div class="h-1.5 bg-navy-900 rounded-full overflow-hidden">
                                    <div class="h-full bg-gold-500 transition-all duration-1000 group-hover:shadow-[0_0_15px_rgba(212,152,42,0.5)]" style="width: {{ $item->technical_progress }}%"></div>
                                </div>
                                <div class="flex justify-between items-center mt-6">
                                    <div class="flex -space-x-2">
                                        @foreach($item->expenses->whereNotNull('bukti_foto')->take(3) as $photo)
                                            <div class="w-8 h-8 rounded-lg border border-navy-950 bg-navy-800 overflow-hidden">
                                                <img src="{{ Storage::url($photo->bukti_foto) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all">
                                            </div>
                                        @endforeach
                                        @if($item->expenses->whereNotNull('bukti_foto')->count() > 3)
                                            <div class="w-8 h-8 rounded-lg border border-navy-950 bg-navy-800 flex items-center justify-center text-[8px] font-black text-white/40">
                                                +{{ $item->expenses->whereNotNull('bukti_foto')->count() - 3 }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-[9px] font-black uppercase tracking-widest text-gold-400 opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all">Lihat Detail →</div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                @else
                    <div class="py-32 text-center bg-white/5 rounded-[3rem] border border-dashed border-white/10 reveal">
                        <div class="w-20 h-20 bg-white/5 rounded-3xl mx-auto mb-6 flex items-center justify-center text-white/20">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <p class="text-white/40 font-bold uppercase tracking-widest text-sm">No infrastructure projects associated with your account yet.</p>
                        <p class="text-[10px] text-white/20 mt-2 uppercase">Please contact our administration for activation.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
