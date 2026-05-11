@extends('layouts.app')

@section('title', 'Kelola Partner - Admin EfhaNet')

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-navy-950 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6 reveal">
            <div>
                <h1 class="text-3xl font-black tracking-tight">Kelola <span class="text-gold-500">Partner Strategis</span></h1>
                <p class="text-white/40 text-sm mt-1">Manajemen mitra dan partner bisnis PT Efha Sejahtera Bersama.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-[10px] font-black text-white/40 uppercase tracking-widest hover:text-gold-400 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Dashboard
            </a>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
        <div class="mb-8 p-4 bg-green-500/20 border border-green-500/50 rounded-2xl text-green-400 text-xs font-bold flex items-center gap-3 animate-fade-in-up">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <!-- Form Tambah Partner -->
        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] p-10 mb-10 reveal">
            <h2 class="text-xl font-black uppercase tracking-tight text-gold-400 mb-8 flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Partner Baru
            </h2>

            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @csrf
                <div>
                    <label class="text-[10px] font-black text-white/40 uppercase tracking-widest mb-3 block">Nama Partner</label>
                    <input type="text" name="name" required placeholder="Contoh: Telkom Indonesia" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-6 text-sm font-bold text-white focus:ring-2 focus:ring-gold-500/20 focus:border-gold-500 outline-none transition-all placeholder:text-white/20">
                    @error('name') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-[10px] font-black text-white/40 uppercase tracking-widest mb-3 block">Website Link (Opsional)</label>
                    <input type="url" name="link" placeholder="https://example.com" class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-6 text-sm font-bold text-white focus:ring-2 focus:ring-gold-500/20 focus:border-gold-500 outline-none transition-all placeholder:text-white/20">
                    @error('link') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-[10px] font-black text-white/40 uppercase tracking-widest mb-3 block">Upload Logo</label>
                    <input type="file" name="logo" required accept="image/*" class="w-full text-xs text-white/40 font-bold file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-gold-500 file:text-navy-950 hover:file:bg-gold-400 transition-all cursor-pointer">
                    <p class="text-[9px] text-white/20 mt-2 italic">Format: JPG, PNG, SVG (Max 2MB)</p>
                    @error('logo') <p class="text-red-400 text-[10px] mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-3 flex justify-end">
                    <button type="submit" class="px-10 py-4 bg-gold-500 text-navy-950 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-gold-400 transition-all shadow-lg shadow-gold-500/10">
                        Simpan Partner
                    </button>
                </div>
            </form>
        </div>

        <!-- Daftar Partner -->
        <div class="bg-white/5 border border-white/10 rounded-[2.5rem] overflow-hidden reveal">
            <div class="px-10 py-8 border-b border-white/10 flex items-center justify-between">
                <h3 class="text-xl font-black uppercase tracking-tight text-white">Partner Terdaftar</h3>
                <span class="text-[10px] font-bold text-white/30 uppercase tracking-widest">{{ $partners->count() }} Mitra Aktif</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/[0.02]">
                            <th class="px-10 py-5 text-[10px] font-black uppercase text-white/30 tracking-widest">Logo</th>
                            <th class="px-10 py-5 text-[10px] font-black uppercase text-white/30 tracking-widest">Nama Partner</th>
                            <th class="px-10 py-5 text-[10px] font-black uppercase text-white/30 tracking-widest">Link Website</th>
                            <th class="px-10 py-5 text-[10px] font-black uppercase text-white/30 tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($partners as $partner)
                            <tr class="hover:bg-white/[0.02] transition-all group">
                                <td class="px-10 py-6">
                                    <div class="w-16 h-16 bg-white rounded-2xl p-3 flex items-center justify-center border border-white/10 shadow-lg">
                                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="max-w-full max-h-full object-contain">
                                    </div>
                                </td>
                                <td class="px-10 py-6">
                                    <p class="font-black text-white text-lg tracking-tight">{{ $partner->name }}</p>
                                </td>
                                <td class="px-10 py-6">
                                    @if($partner->link)
                                        <a href="{{ $partner->link }}" target="_blank" class="text-xs font-bold text-gold-400 hover:text-gold-300 flex items-center gap-2">
                                            {{ $partner->link }}
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        </a>
                                    @else
                                        <span class="text-xs text-white/20 italic">Tidak ada link</span>
                                    @endif
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" onsubmit="return confirm('Hapus partner ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-4 bg-red-500/10 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all group-hover:scale-110 shadow-lg">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-10 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        <p class="text-white/30 font-black uppercase tracking-widest">Belum ada partner terdaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
