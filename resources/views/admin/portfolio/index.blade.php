@extends('layouts.app')

@section('title', 'Manajemen Portofolio - Admin EfhaNet')

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-navy-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-black text-white tracking-tight">Manajemen <span class="text-gold-500">Portofolio</span></h1>
                <p class="text-white/50 text-sm mt-1">Kelola grup proyek dan daftar rincian pekerjaan portofolio EfhaNet.</p>
            </div>
            <div class="flex items-center gap-4 bg-white/5 p-2 rounded-2xl border border-white/10">
                <div class="w-10 h-10 rounded-xl bg-gold-500 flex items-center justify-center text-navy-950">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div class="pr-4">
                    <p class="text-[10px] font-bold text-white/40 uppercase tracking-tight">Total Grup</p>
                    <p class="text-xs font-black text-white">{{ $groups->count() }} Kategori</p>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <p class="text-sm font-bold text-green-400">{{ session('success') }}</p>
        </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-10">
            
            <!-- LEFT COLUMN: GROUPS -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Group Table Card -->
                <div class="bg-white/5 rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden">
                    <div class="px-8 py-6 border-b border-white/10 bg-white/[0.02]">
                        <h3 class="font-black text-white uppercase tracking-tight text-lg">Grup Proyek</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-white/[0.02]">
                                    <th class="px-6 py-4 text-[10px] font-black uppercase text-white/40 tracking-widest">Nama Grup</th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase text-white/40 tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($groups as $group)
                                <tr class="hover:bg-white/[0.01] transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-white">{{ $group->name }}</p>
                                        <p class="text-[9px] text-gold-500 font-bold uppercase">{{ $group->items->count() }} Proyek</p>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('admin.portfolio.group.destroy', $group->id) }}" method="POST" onsubmit="return confirm('Hapus grup ini beserta semua item di dalamnya?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400 p-2 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-white/20 text-xs italic">Belum ada grup</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Add Group Form Card -->
                <div class="bg-white/5 rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden">
                    <div class="px-8 py-6 border-b border-white/10 bg-white/[0.02]">
                        <h3 class="font-black text-white uppercase tracking-tight text-sm">Tambah Grup Baru</h3>
                    </div>
                    <form action="{{ route('admin.portfolio.group.store') }}" method="POST" class="p-8 space-y-4">
                        @csrf
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gold-400 uppercase tracking-widest">Nama Grup</label>
                            <input type="text" name="name" required class="w-full bg-navy-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-500 transition-all text-sm" placeholder="Contoh: ZTE Projects">
                        </div>
                        <button type="submit" class="w-full py-3 bg-gold-500 text-navy-950 font-black uppercase tracking-widest text-[10px] rounded-xl hover:bg-gold-400 transition-all">Simpan Grup</button>
                    </form>
                </div>
            </div>

            <!-- RIGHT COLUMN: ITEMS -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Item Table Card -->
                <div class="bg-white/5 rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden">
                    <div class="px-8 py-6 border-b border-white/10 bg-white/[0.02]">
                        <h3 class="font-black text-white uppercase tracking-tight text-lg">Daftar Item Proyek</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-white/[0.02]">
                                    <th class="px-8 py-4 text-[10px] font-black uppercase text-white/40 tracking-widest">Grup</th>
                                    <th class="px-8 py-4 text-[10px] font-black uppercase text-white/40 tracking-widest">Project Name</th>
                                    <th class="px-8 py-4 text-[10px] font-black uppercase text-white/40 tracking-widest">Scope of Work</th>
                                    <th class="px-8 py-4 text-[10px] font-black uppercase text-white/40 tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($groups as $group)
                                    @foreach($group->items as $item)
                                    <tr class="hover:bg-white/[0.01] transition-colors">
                                        <td class="px-8 py-6">
                                            <span class="px-2 py-1 bg-white/5 border border-white/10 rounded text-[9px] font-bold text-gold-400 uppercase">{{ $group->name }}</span>
                                        </td>
                                        <td class="px-8 py-6">
                                            <p class="text-sm font-bold text-white leading-tight">{{ $item->project_name }}</p>
                                        </td>
                                        <td class="px-8 py-6">
                                            <p class="text-[11px] text-white/50 leading-relaxed max-w-xs">{{ $item->scope_of_work }}</p>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <form action="{{ route('admin.portfolio.item.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item proyek ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500/50 hover:text-red-500 p-2 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center">
                                        <p class="text-white/20 text-sm italic font-bold uppercase tracking-widest">Belum ada item proyek</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Add Item Form Card -->
                <div class="bg-white/5 rounded-[2.5rem] shadow-2xl border border-white/10 overflow-hidden">
                    <div class="px-8 py-6 border-b border-white/10 bg-white/[0.02]">
                        <h3 class="font-black text-white uppercase tracking-tight text-sm">Tambah Item Proyek Baru</h3>
                    </div>
                    <form action="{{ route('admin.portfolio.item.store') }}" method="POST" class="p-8 space-y-6">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gold-400 uppercase tracking-widest">Pilih Grup</label>
                                <select name="portfolio_group_id" required class="w-full bg-navy-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-500 transition-all text-sm appearance-none">
                                    <option value="" disabled selected>Pilih Grup Proyek...</option>
                                    @foreach($groups as $g)
                                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gold-400 uppercase tracking-widest">Project Name</label>
                                <input type="text" name="project_name" required class="w-full bg-navy-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-500 transition-all text-sm" placeholder="Contoh: Modernization ZTE 2024">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gold-400 uppercase tracking-widest">Scope of Work</label>
                            <textarea name="scope_of_work" rows="3" required class="w-full bg-navy-900 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-gold-500 transition-all text-sm resize-none" placeholder="Jelaskan rincian pekerjaan..."></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-10 py-4 bg-gradient-to-r from-gold-400 to-gold-600 text-navy-950 font-black uppercase tracking-widest text-[10px] rounded-xl hover:shadow-xl hover:shadow-gold-500/20 transition-all active:scale-95">Simpan Item Proyek</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .animate-fade-in { animation: fadeIn 0.5s ease-out; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23d4982a' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 1rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
    }
</style>
@endsection
