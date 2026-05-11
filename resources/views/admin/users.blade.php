@extends('layouts.app')

@section('title', 'Daftar Klien - EfhaNet')

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-navy-400 hover:text-gold-600 transition-all text-[10px] font-black uppercase tracking-widest mb-2 group">
                    <svg class="w-3 h-3 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Dashboard
                </a>
                <h1 class="text-3xl font-black text-navy-950 tracking-tight">Daftar <span class="text-gold-500">Klien Terdaftar</span></h1>
                <p class="text-gray-500 text-sm mt-1">Total {{ $users->count() }} klien yang telah bergabung dengan platform EfhaNet.</p>
            </div>
            <div class="bg-white px-6 py-4 rounded-3xl shadow-sm border border-gray-200">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Status Keamanan</p>
                <p class="text-sm font-black text-green-600 uppercase">Database Verified</p>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400 tracking-widest">Informasi Dasar</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400 tracking-widest">Alamat Email</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400 tracking-widest text-center">Riwayat Konsultasi</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase text-gray-400 tracking-widest">Tanggal Registrasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50/30 transition-all duration-200">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-navy-50 to-navy-100 border border-navy-100 flex items-center justify-center font-black text-navy-900 shadow-inner">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-navy-950 tracking-tight text-base">{{ $user->name }}</p>
                                        <span class="text-[9px] font-black text-white bg-navy-950 px-2 py-0.5 rounded-md uppercase tracking-tighter">CLIENT ID #{{ 1000 + $user->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-navy-900">{{ $user->email }}</p>
                                <p class="text-[10px] text-gray-400 font-medium">Verified Account</p>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <div class="flex flex-col items-center">
                                    <span class="text-lg font-black text-navy-900 leading-none">{{ $user->projects->count() }}</span>
                                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-tighter">Proyek</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-xs font-bold text-navy-950">{{ $user->created_at->format('d M Y') }}</p>
                                <p class="text-[10px] text-gray-400 font-medium">{{ $user->created_at->format('H:i') }} WIB</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($users->isEmpty())
                <div class="py-24 text-center">
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-widest">Belum ada klien yang terdaftar</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
