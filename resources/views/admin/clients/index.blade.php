@extends('layouts.app')

@section('title', 'Manajemen Klien - EfhaNet')

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-black text-navy-950 tracking-tight">Manajemen <span class="text-gold-500">Klien</span></h1>
                <p class="text-gray-500 text-sm mt-1">Daftar mitra strategis dan riwayat kerjasama PT Efha Sejahtera Bersama.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="px-6 py-4 bg-white rounded-2xl shadow-sm border border-gray-200">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Klien Terdaftar</p>
                    <p class="text-xl font-black text-navy-950">{{ $clients->count() }} Mitra</p>
                </div>
            </div>
        </div>

        <!-- Client List Table -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden reveal">
            <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                <h3 class="font-black text-navy-950 uppercase tracking-tight text-lg">Direktori Mitra Strategis</h3>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-navy-950"></span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Database Klien</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-gray-400 tracking-[0.1em]">Mitra / Perusahaan</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-gray-400 tracking-[0.1em]">Kontak Personal</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-gray-400 tracking-[0.1em] text-center">Total Proyek</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-gray-400 tracking-[0.1em] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($clients as $client)
                        <tr class="hover:bg-gray-50/30 transition-all duration-200">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-navy-950 flex items-center justify-center font-black text-gold-400 text-sm">
                                        {{ substr($client->nama_perusahaan ?? $client->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-navy-950 tracking-tight leading-none mb-1">
                                            {{ $client->nama_perusahaan ?? 'Instansi Belum Diatur' }}
                                        </p>
                                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Client Account</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-navy-950 mb-0.5">{{ $client->name }}</p>
                                <div class="flex items-center gap-2">
                                    <p class="text-[10px] text-gray-400 font-medium tracking-tight">{{ $client->email }}</p>
                                    @if($client->phone)
                                        @php
                                            $wa_phone = preg_replace('/[^0-9]/', '', $client->phone);
                                            if (str_starts_with($wa_phone, '0')) {
                                                $wa_phone = '62' . substr($wa_phone, 1);
                                            }
                                            $wa_message = urlencode("Halo " . $client->name . ", kami dari tim EfhaNet ingin menginfokan mengenai progres proyek Anda.");
                                        @endphp
                                        <a href="https://wa.me/{{ $wa_phone }}?text={{ $wa_message }}" target="_blank" class="text-green-500 hover:text-green-600 transition-colors" title="Chat via WhatsApp">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gold-500/10 text-gold-600 font-black text-xs">
                                    {{ $client->projects_count }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('admin.clients.show', $client->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-navy-50 text-navy-950 rounded-2xl text-[10px] font-black uppercase tracking-[0.1em] hover:bg-gold-500 hover:text-navy-950 transition-all group">
                                    Lihat Detail
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if($clients->count() === 0)
            <div class="mt-8 py-20 text-center bg-white rounded-[2.5rem] border border-dashed border-gray-200 reveal">
                <p class="text-gray-400 font-bold uppercase tracking-widest text-sm">Belum ada klien yang terdaftar di sistem.</p>
            </div>
        @endif
    </div>
</section>
@endsection
