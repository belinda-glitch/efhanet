@extends('layouts.app')

@section('title', 'Detail Klien - ' . $client->name)

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-start justify-between gap-8 reveal">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-3xl bg-navy-950 flex items-center justify-center font-black text-gold-400 text-3xl shadow-2xl shadow-navy-950/20">
                    {{ substr($client->nama_perusahaan ?? $client->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-3xl font-black text-navy-950 tracking-tight leading-none mb-2">{{ $client->nama_perusahaan ?? 'Personal Client' }}</h1>
                    <div class="flex items-center gap-2">
                        <p class="text-gray-500 font-bold uppercase tracking-widest text-xs">{{ $client->name }} • {{ $client->email }}</p>
                        @if($client->phone)
                            @php
                                $wa_phone = preg_replace('/[^0-9]/', '', $client->phone);
                                if (str_starts_with($wa_phone, '0')) {
                                    $wa_phone = '62' . substr($wa_phone, 1);
                                }
                                $wa_message = urlencode("Halo " . $client->name . ", kami dari tim EfhaNet ingin menginfokan mengenai progres proyek Anda.");
                            @endphp
                            <a href="https://wa.me/{{ $wa_phone }}?text={{ $wa_message }}" target="_blank" class="text-green-500 hover:text-green-600 transition-colors flex items-center gap-1" title="Chat via WhatsApp">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                                <span class="text-[10px] font-black uppercase tracking-widest">Chat WA</span>
                            </a>
                        @endif
                    </div>
                    <div class="flex items-center gap-2 mt-4">
                        <span class="px-3 py-1 rounded-full bg-gold-500/10 text-gold-600 text-[10px] font-black uppercase tracking-widest border border-gold-500/20">
                            Partner Sejak {{ $client->created_at->format('M Y') }}
                        </span>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.clients.index') }}" class="inline-flex items-center gap-2 px-6 py-4 bg-white border border-gray-100 text-navy-950 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-gray-50 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar
            </a>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Sidebar: Client Summary -->
            <div class="space-y-6 reveal">
                <div class="bg-navy-950 p-8 rounded-[2.5rem] text-white shadow-xl">
                    <p class="text-[10px] font-black text-gold-400 uppercase tracking-widest mb-6">Analisis Kerjasama</p>
                    <div class="space-y-6">
                        <div>
                            <p class="text-[9px] text-white/40 uppercase font-black tracking-widest mb-1">Total Proyek Dipercayakan</p>
                            <p class="text-3xl font-black">{{ $client->projects->count() }} <span class="text-xs text-gold-400 font-bold">PROYEK</span></p>
                        </div>
                        <div>
                            <p class="text-[9px] text-white/40 uppercase font-black tracking-widest mb-1">Total Anggaran Kontrak</p>
                            <p class="text-xl font-black text-gold-400">Rp {{ number_format($client->projects->sum('budget_awal'), 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main: Project History -->
            <div class="lg:col-span-2 space-y-6 reveal">
                <h3 class="font-black text-navy-950 uppercase tracking-tight text-lg flex items-center gap-3">
                    Riwayat Proyek & Pengeluaran
                    <span class="h-px flex-1 bg-gray-100"></span>
                </h3>

                @if($client->projects->count() > 0)
                    @foreach($client->projects as $project)
                    <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm group hover:border-gold-500/50 transition-all duration-300">
                        <div class="flex items-start justify-between mb-8">
                            <div>
                                <span class="text-[10px] font-black text-gold-600 uppercase tracking-widest block mb-1">{{ $project->service_type }}</span>
                                <h4 class="text-xl font-black text-navy-950 group-hover:text-gold-500 transition-colors">{{ $project->nama }}</h4>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">{{ $project->kecamatan_pontianak }}</p>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 rounded-full {{ $project->work_status === 'Completed' ? 'bg-green-50 text-green-600' : 'bg-blue-50 text-blue-600' }} text-[9px] font-black uppercase tracking-widest border border-current opacity-70">
                                    {{ $project->work_status }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 py-6 border-y border-gray-50">
                            <div>
                                <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mb-1">Anggaran</p>
                                <p class="text-sm font-black text-navy-950">Rp {{ number_format($project->budget_awal, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mb-1">Pengeluaran Riil</p>
                                <p class="text-sm font-black text-navy-950">Rp {{ number_format($project->total_expenses, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mb-1">Efisiensi</p>
                                <div class="flex items-center gap-2">
                                    <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-gold-500" style="width: {{ min(100, $project->efficiency_percentage) }}%"></div>
                                    </div>
                                    <span class="text-[10px] font-black text-navy-950">{{ round($project->efficiency_percentage, 1) }}%</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <p class="text-[10px] text-gray-400 font-bold uppercase">Dimulai pada {{ $project->created_at->format('d M Y') }}</p>
                            <a href="{{ route('projects.show', $project->id) }}" class="text-[10px] font-black text-navy-950 uppercase hover:text-gold-600 transition-colors flex items-center gap-1">
                                Kelola Finansial & K3
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="py-20 text-center bg-gray-50 rounded-[2.5rem] border border-dashed border-gray-200">
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Belum ada riwayat proyek untuk klien ini.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
