@extends('layouts.app')

@section('title', 'Manajemen Layanan - Admin EfhaNet')

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-navy-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-black text-white tracking-tight">Manajemen <span class="text-gold-500">Layanan</span></h1>
                <p class="text-white/50 text-sm mt-1">Kelola daftar layanan infrastruktur telekomunikasi PT Efha Sejahtera Bersama.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-4 bg-white/5 p-2 rounded-2xl border border-white/10">
                    <div class="w-10 h-10 rounded-xl bg-gold-500 flex items-center justify-center text-navy-950">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div class="pr-4">
                        <p class="text-[10px] font-bold text-white/40 uppercase tracking-tight">Total Layanan</p>
                        <p class="text-xs font-black text-white">{{ $services->count() }} Item</p>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <p class="text-sm font-bold text-green-400">{{ session('success') }}</p>
        </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white/5 rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden mb-10">
            <div class="px-8 py-6 border-b border-white/10 bg-white/[0.02] flex items-center justify-between">
                <h3 class="font-black text-white uppercase tracking-tight text-lg">Daftar Layanan</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/[0.02]">
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-white/40 tracking-[0.1em] w-16">No</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-white/40 tracking-[0.1em] w-24">Ikon</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-white/40 tracking-[0.1em]">Judul Layanan</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-white/40 tracking-[0.1em] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($services as $index => $service)
                        <tr class="hover:bg-white/[0.02] transition-all duration-200">
                            <td class="px-8 py-6">
                                <span class="text-sm font-black text-white/30">{{ $index + 1 }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="w-12 h-12 rounded-xl bg-gold-500/10 border border-gold-500/20 flex items-center justify-center">
                                    <i class="{{ $service->icon }} text-gold-500 text-xl"></i>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-white mb-1">{{ $service->title }}</p>
                                <p class="text-[11px] text-white/40 line-clamp-1 max-w-md">{{ $service->description }}</p>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="w-9 h-9 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 hover:bg-blue-500 hover:text-white transition-all" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 rounded-lg bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400 hover:bg-red-500 hover:text-white transition-all" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-white/10 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2-2v7m16 0a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4a2 2 0 012-2m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                    <p class="text-white/30 font-bold uppercase tracking-widest text-xs">Belum ada layanan yang ditambahkan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white/5 rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden">
            <div class="px-8 py-6 border-b border-white/10 bg-white/[0.02]">
                <h3 class="font-black text-white uppercase tracking-tight text-lg">Tambah Layanan Baru</h3>
                <p class="text-white/40 text-xs mt-1">Lengkapi formulir di bawah untuk menambahkan layanan ke portofolio perusahaan.</p>
            </div>

            <form action="{{ route('admin.services.store') }}" method="POST" class="p-8">
                @csrf
                <div class="grid md:grid-cols-2 gap-8 mb-8">
                    <!-- Judul -->
                    <div class="space-y-2">
                        <label for="title" class="text-[10px] font-black text-gold-400 uppercase tracking-widest">Judul Layanan</label>
                        <input type="text" name="title" id="title" required
                            class="w-full bg-navy-900 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder-white/20 focus:outline-none focus:border-gold-500 transition-all shadow-sm"
                            placeholder="Contoh: Instalasi BTS 5G">
                    </div>
                    <!-- Ikon -->
                    <div class="space-y-2">
                        <label for="icon" class="text-[10px] font-black text-gold-400 uppercase tracking-widest">Nama Ikon (FontAwesome)</label>
                        <div class="relative">
                            <input type="text" name="icon" id="icon" required
                                class="w-full bg-navy-900 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder-white/20 focus:outline-none focus:border-gold-500 transition-all shadow-sm"
                                placeholder="Contoh: fas fa-broadcast-tower">
                            <div id="icon-preview" class="absolute right-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-lg bg-gold-500/10 flex items-center justify-center">
                                <i class="fas fa-search text-[10px] text-gold-500"></i>
                            </div>
                        </div>
                        
                        <!-- Icon Suggestions -->
                        <div class="mt-4 p-4 bg-navy-900/50 rounded-2xl border border-white/5">
                            <p class="text-[9px] text-white/30 mb-3 uppercase tracking-widest font-bold">Ikon Rekomendasi:</p>
                            <div class="grid grid-cols-6 sm:grid-cols-10 gap-2">
                                @php
                                    $recommendedIcons = [
                                        'fas fa-broadcast-tower', 'fas fa-satellite-dish', 'fas fa-network-wired', 
                                        'fas fa-tools', 'fas fa-map-location-dot', 'fas fa-chart-line', 
                                        'fas fa-bolt', 'fas fa-shield-halved', 'fas fa-microchip', 
                                        'fas fa-server', 'fas fa-tower-cell', 'fas fa-plug-circle-bolt',
                                        'fas fa-signal', 'fas fa-wifi', 'fas fa-globe', 'fas fa-gears',
                                        'fas fa-hard-drive', 'fas fa-screwdriver-wrench', 'fas fa-building', 'fas fa-headset'
                                    ];
                                @endphp
                                @foreach($recommendedIcons as $recIcon)
                                <button type="button" onclick="selectIcon('{{ $recIcon }}')" 
                                    class="w-10 h-10 rounded-lg bg-white/5 border border-white/5 flex items-center justify-center text-white/40 hover:text-gold-400 hover:border-gold-500/30 hover:bg-gold-500/5 transition-all"
                                    title="{{ $recIcon }}">
                                    <i class="{{ $recIcon }} text-sm"></i>
                                </button>
                                @endforeach
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <p class="text-[9px] text-white/30 italic">*Klik ikon untuk memilih</p>
                                <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" class="text-[9px] text-gold-500 hover:underline flex items-center gap-1 font-bold">
                                    Cari Ikon Lainnya
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function selectIcon(iconClass) {
                        const input = document.getElementById('icon');
                        const preview = document.getElementById('icon-preview');
                        input.value = iconClass;
                        preview.innerHTML = `<i class="${iconClass} text-sm text-gold-500"></i>`;
                        
                        // Small animation effect
                        input.classList.add('border-gold-500');
                        setTimeout(() => input.classList.remove('border-gold-500'), 500);
                    }

                    // Handle manual input preview
                    document.getElementById('icon').addEventListener('input', function(e) {
                        const preview = document.getElementById('icon-preview');
                        preview.innerHTML = `<i class="${e.target.value} text-sm text-gold-500"></i>`;
                    });
                </script>

                <!-- Deskripsi -->
                <div class="space-y-2 mb-10">
                    <label for="description" class="text-[10px] font-black text-gold-400 uppercase tracking-widest">Deskripsi Layanan</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full bg-navy-900 border border-white/10 rounded-2xl px-6 py-4 text-white placeholder-white/20 focus:outline-none focus:border-gold-500 transition-all shadow-sm resize-none"
                        placeholder="Jelaskan detail layanan secara mendalam..."></textarea>
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit" class="group relative px-10 py-5 bg-gradient-to-r from-gold-400 to-gold-600 text-navy-950 font-black uppercase tracking-widest text-xs rounded-2xl hover:from-gold-300 hover:to-gold-500 transition-all shadow-xl shadow-gold-500/20 hover:shadow-gold-500/40 active:scale-95 overflow-hidden">
                        <span class="relative z-10 flex items-center gap-2">
                            Simpan Layanan
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 12h16"/></svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 -translate-x-full group-hover:animate-btn-shimmer"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<style>
    @keyframes btn-shimmer {
        100% { transform: translateX(100%); }
    }
    .animate-btn-shimmer {
        animation: btn-shimmer 2s infinite;
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
