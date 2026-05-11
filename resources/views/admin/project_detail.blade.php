@extends('layouts.app')

@section('title', 'Efisiensi Proyek - ' . $project->nama)

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8 reveal">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-navy-400 hover:text-gold-600 transition-all text-[10px] font-black uppercase tracking-widest group">
                <svg class="w-3 h-3 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Dashboard Admin
            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.projects.forecast', $project->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-r from-gold-400 to-gold-600 text-navy-950 text-[10px] font-black uppercase tracking-widest rounded-2xl hover:shadow-xl hover:shadow-gold-500/20 transition-all shadow-lg shadow-gold-500/10 group">
                    <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Forecasting AI
                </a>
                <span class="px-3 py-1 rounded-full bg-navy-950 text-gold-400 text-[10px] font-black uppercase tracking-widest border border-gold-500/20">
                    Mode Analisis Finansial
                </span>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left: Financial Analysis & Expenses -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Project Core Info -->
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 reveal">
                    <div class="flex items-center justify-between mb-10">
                        <div>
                            <span class="text-[10px] font-black text-gold-600 uppercase tracking-[0.2em] mb-2 block">{{ $project->service_type }}</span>
                            <h1 class="text-3xl font-black text-navy-950 leading-tight">{{ $project->nama }}</h1>
                            <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mt-1">{{ $project->kecamatan_pontianak }}</p>
                        </div>
                        <div class="text-right">
                            <div class="w-16 h-16 rounded-2xl bg-navy-50 flex flex-col items-center justify-center border border-navy-100 ml-auto">
                                <span class="text-xs font-black text-navy-900 leading-none">{{ $project->technical_progress }}%</span>
                                <span class="text-[8px] font-bold text-gray-400 uppercase tracking-tighter mt-1">Kemajuan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Efficiency Metrics Cards -->
                    <div class="grid sm:grid-cols-3 gap-6 mb-10">
                        <div class="p-6 rounded-3xl bg-gray-50 border border-gray-100">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Anggaran Awal</p>
                            <p class="text-lg font-black text-navy-950">Rp {{ number_format($project->budget_awal, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-6 rounded-3xl bg-gray-50 border border-gray-100">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Pengeluaran Riil</p>
                            <p class="text-lg font-black text-navy-950">Rp {{ number_format($project->total_expenses, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-6 rounded-3xl {{ $project->cost_variance >= 0 ? 'bg-green-50 border-green-100' : 'bg-red-50 border-red-100' }}">
                            <p class="text-[10px] font-black {{ $project->cost_variance >= 0 ? 'text-green-600' : 'text-red-600' }} uppercase tracking-widest mb-1">Varians Biaya</p>
                            <p class="text-lg font-black {{ $project->cost_variance >= 0 ? 'text-green-700' : 'text-red-700' }}">
                                {{ $project->cost_variance >= 0 ? '+' : '' }} Rp {{ number_format($project->cost_variance, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Expense Table -->
                    <div class="mb-12">
                        <h3 class="font-black text-navy-950 uppercase tracking-tight text-base mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Log Pengeluaran Riil
                        </h3>
                        @if($project->expenses->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="bg-gray-50/50">
                                            <th class="px-4 py-3 text-[10px] font-black uppercase text-gray-400 tracking-widest">Kategori</th>
                                            <th class="px-4 py-3 text-[10px] font-black uppercase text-gray-400 tracking-widest">Nominal</th>
                                            <th class="px-4 py-3 text-[10px] font-black uppercase text-gray-400 tracking-widest">Nota</th>
                                            <th class="px-4 py-3 text-[10px] font-black uppercase text-gray-400 tracking-widest">Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @foreach($project->expenses as $expense)
                                        <tr>
                                            <td class="px-4 py-4 text-sm font-bold text-navy-950">
                                                {{ $expense->kategori_biaya }}
                                                @if($expense->detail_material)
                                                    <span class="block text-base text-gray-700 font-medium mt-1 leading-relaxed">({{ $expense->detail_material }})</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 text-sm font-black text-navy-900">Rp {{ number_format($expense->jumlah_nominal, 0, ',', '.') }}</td>
                                            <td class="px-4 py-4">
                                                @if($expense->nota)
                                                    <a href="{{ asset('storage/' . $expense->nota) }}" target="_blank" class="block w-10 h-10 rounded-lg overflow-hidden border border-gray-100 hover:border-gold-500 transition-all">
                                                        <img src="{{ asset('storage/' . $expense->nota) }}" class="w-full h-full object-cover" alt="Nota">
                                                    </a>
                                                @else
                                                    <button 
                                                        onclick="openNotaModal('{{ route('admin.expenses.update-nota', $expense->id) }}')"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gold-50 text-gold-700 text-[9px] font-black uppercase tracking-widest rounded-lg hover:bg-gold-100 transition-all border border-gold-200/50">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                        Unggah Nota
                                                    </button>
                                                @endif
                                            </td>
                                            <td class="px-4 py-4 text-[10px] text-gray-400 font-medium uppercase">{{ $expense->created_at->format('d M Y') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="py-12 text-center bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Belum ada data pengeluaran.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Documentation Gallery -->
                    <div>
                        <h3 class="font-black text-navy-950 uppercase tracking-tight text-base mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Dokumentasi Lapangan
                        </h3>
                        @if($project->documentations->count() > 0)
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                @foreach($project->documentations as $doc)
                                    <div class="group relative aspect-square rounded-3xl overflow-hidden bg-gray-100 border border-gray-100">
                                        <img src="{{ Storage::url($doc->thumbnail_path ?? $doc->file_path) }}" alt="{{ $doc->caption }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        <div class="absolute inset-0 bg-gradient-to-t from-navy-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                            <p class="text-[10px] text-white font-bold leading-tight line-clamp-2">{{ $doc->caption ?? 'Tanpa keterangan' }}</p>
                                            <p class="text-[8px] text-gold-400 font-black uppercase tracking-widest mt-1">{{ $doc->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-12 text-center bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Belum ada dokumentasi lapangan.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Documentation Management Table -->
                    <div class="mt-12 pt-12 border-t border-gray-100">
                        <h3 class="font-black text-navy-950 uppercase tracking-tight text-base mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Kelola Dokumentasi
                        </h3>
                        @if($project->documentations->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead>
                                        <tr class="bg-gray-50/50">
                                            <th class="px-4 py-3 text-[10px] font-black uppercase text-gray-400 tracking-widest">Preview</th>
                                            <th class="px-4 py-3 text-[10px] font-black uppercase text-gray-400 tracking-widest">Keterangan</th>
                                            <th class="px-4 py-3 text-[10px] font-black uppercase text-gray-400 tracking-widest text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @foreach($project->documentations as $doc)
                                        <tr>
                                            <td class="px-4 py-4">
                                                <img src="{{ Storage::url($doc->thumbnail_path ?? $doc->file_path) }}" class="w-10 h-10 object-cover rounded-lg border border-gray-100">
                                            </td>
                                            <td class="px-4 py-4 text-[10px] font-bold text-navy-950 uppercase tracking-tight">{{ $doc->caption ?? '-' }}</td>
                                            <td class="px-4 py-4 text-right">
                                                <form action="{{ route('admin.documentations.destroy', $doc->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus foto ini dari dokumentasi?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="py-12 text-center bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                                <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">Belum ada data untuk dikelola</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Efficiency Summary & Admin Actions -->
            <div class="space-y-6 reveal">
                <!-- Efficiency Card -->
                <div class="bg-navy-950 p-8 rounded-[2.5rem] text-white shadow-xl shadow-navy-900/20 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gold-500/10 rounded-full blur-3xl -mr-16 -mt-16"></div>
                    <p class="text-[10px] font-black text-gold-400 uppercase tracking-[0.2em] mb-1">Skor Efisiensi</p>
                    <div class="flex items-end gap-2 mb-6">
                        <p class="text-5xl font-black">{{ round(100 - min(100, $project->efficiency_percentage), 1) }}%</p>
                        <p class="text-xs text-gold-400 font-bold uppercase pb-1">Margin Tersisa</p>
                    </div>
                    
                    <div class="h-2.5 bg-white/10 rounded-full overflow-hidden mb-4">
                        <div class="h-full bg-gold-500 transition-all duration-1000" style="width: {{ min(100, $project->efficiency_percentage) }}%"></div>
                    </div>
                    <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-tighter">
                        <span class="text-white/50">Anggaran Terpakai</span>
                        <span class="{{ $project->efficiency_percentage > 100 ? 'text-red-400' : 'text-gold-400' }}">
                            {{ round($project->efficiency_percentage, 1) }}%
                        </span>
                    </div>
                </div>

                <!-- Update Status Form -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                    <h4 class="font-black text-navy-950 text-sm uppercase tracking-widest mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        Update Kemajuan & K3
                    </h4>
                    <form action="{{ route('admin.projects.update-status', $project->id) }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Status Pengerjaan</label>
                            <select name="work_status" class="w-full bg-gray-50 border border-gray-100 rounded-xl py-3 px-4 text-xs font-bold text-navy-950 focus:ring-2 focus:ring-gold-500/20 focus:border-gold-500 outline-none transition-all">
                                <option value="Active" {{ $project->work_status === 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="On-Hold" {{ $project->work_status === 'On-Hold' ? 'selected' : '' }}>On-Hold</option>
                                <option value="Completed" {{ $project->work_status === 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Kemajuan Teknis (%)</label>
                            <input type="number" name="technical_progress" value="{{ $project->technical_progress }}" min="0" max="100" class="w-full bg-gray-50 border border-gray-100 rounded-xl py-3 px-4 text-xs font-bold text-navy-950 focus:ring-2 focus:ring-gold-500/20 focus:border-gold-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Status Keselamatan (Pertemuan Harian)</label>
                            <input type="text" name="daily_toolbox_status" value="{{ $project->daily_toolbox_status }}" placeholder="Contoh: Aman, Semua APD Lengkap" class="w-full bg-gray-50 border border-gray-100 rounded-xl py-3 px-4 text-xs font-bold text-navy-950 focus:ring-2 focus:ring-gold-500/20 focus:border-gold-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Kualifikasi K3</label>
                            <select name="status_k3" class="w-full bg-gray-50 border border-gray-100 rounded-xl py-3 px-4 text-xs font-bold text-navy-950 focus:ring-2 focus:ring-gold-500/20 focus:border-gold-500 outline-none transition-all">
                                <option value="Menunggu Survey" {{ $project->status_k3 === 'Menunggu Survey' ? 'selected' : '' }}>Menunggu Survey</option>
                                <option value="Kepatuhan K3 Terpenuhi" {{ $project->status_k3 === 'Kepatuhan K3 Terpenuhi' ? 'selected' : '' }}>Kepatuhan K3 Terpenuhi</option>
                                <option value="Waspada Area Risiko" {{ $project->status_k3 === 'Waspada Area Risiko' ? 'selected' : '' }}>Waspada Area Risiko</option>
                                <option value="Selesai Toolbox Meeting" {{ $project->status_k3 === 'Selesai Toolbox Meeting' ? 'selected' : '' }}>Selesai Toolbox Meeting</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full py-4 bg-navy-950 text-gold-400 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-navy-900 transition-all shadow-lg shadow-navy-900/10">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

                <!-- Expense Form -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                    <h4 class="font-black text-navy-950 text-sm uppercase tracking-widest mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Catat Pengeluaran Harian
                    </h4>
                    <form action="{{ route('admin.expenses.store', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Kategori Biaya</label>
                            <select name="kategori_biaya" id="pilihan-kategori" class="w-full bg-gray-50 border border-gray-100 rounded-xl py-3 px-4 text-xs font-bold text-navy-950 focus:ring-2 focus:ring-gold-500/20 focus:border-gold-500 outline-none transition-all">
                                <option value="Survei Lapangan">Survei Lapangan</option>
                                <option value="Layanan Instalasi">Layanan Instalasi</option>
                                <option value="Optimasi Jaringan">Optimasi Jaringan</option>
                                <option value="Solusi Daya">Solusi Daya</option>
                                <option value="Alat Pelindung Diri (K3)">Alat Pelindung Diri (K3)</option>
                                <option value="APD">APD</option>
                                <option value="Alat K3">Alat K3</option>
                                <option value="Transportasi">Transportasi</option>
                                <option value="Upah Teknisi">Upah Teknisi</option>
                                <option value="Material">Material</option>
                                <option value="Konsumsi">Konsumsi</option>
                            </select>
                        </div>
                        
                        <!-- Kolom Detail Material (Hidden by Default) -->
                        <div id="kolom-detail-material" class="hidden animate-fade-in">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Nama Material / Barang</label>
                            <input type="text" name="detail_material" placeholder="Ketik nama material/barang di sini..." class="w-full bg-gray-50 border border-gray-100 rounded-xl py-3 px-4 text-xs font-bold text-navy-950 focus:ring-2 focus:ring-gold-500/20 focus:border-gold-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Nominal (IDR)</label>
                            <input type="text" name="jumlah_nominal" id="jumlah_nominal" value="{{ old('jumlah_nominal') }}" placeholder="Contoh: 500.000" class="currency-input w-full bg-gray-50 border border-gray-100 rounded-xl py-3 px-4 text-xs font-bold text-navy-950 focus:ring-2 focus:ring-gold-500/20 focus:border-gold-500 outline-none transition-all" required>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Unggah Bukti Nota <span class="normal-case text-[9px] text-gray-400 italic">(Opsional)</span></label>
                            <input type="file" name="nota" accept=".jpg,.jpeg,.png" class="w-full text-xs text-gray-400 font-bold file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-gold-50 file:text-gold-700 hover:file:bg-gold-100 transition-all">
                        </div>
                        <button type="submit" class="w-full py-4 bg-navy-950 text-gold-400 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-navy-900 transition-all shadow-lg shadow-navy-900/10">
                            Catat Biaya
                        </button>
                    </form>
                </div>

                <!-- Documentation Form -->
                <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                    <h4 class="font-black text-navy-950 text-sm uppercase tracking-widest mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Multi-Upload Dokumentasi
                    </h4>
                    <form action="{{ route('admin.documentations.store', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div class="relative">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">Pilih Foto (Bisa Banyak)</label>
                            <input type="file" name="photos[]" id="documentation_photos" multiple accept=".jpg,.jpeg,.png" class="hidden">
                            <label for="documentation_photos" class="w-full flex flex-col items-center justify-center py-8 bg-gray-50 border-2 border-dashed border-gray-200 rounded-3xl cursor-pointer hover:bg-gray-100 hover:border-gold-300 transition-all group">
                                <svg class="w-8 h-8 text-gray-300 group-hover:text-gold-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Klik untuk pilih file</span>
                            </label>
                        </div>
                        
                        <div id="preview_container" class="space-y-4 hidden">
                            <p class="text-[10px] font-black text-navy-950 uppercase tracking-widest">Keterangan Foto</p>
                            <div id="photos_preview_list" class="space-y-3"></div>
                        </div>

                        <button type="submit" id="upload_btn" class="w-full py-4 bg-navy-950 text-gold-400 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-navy-900 transition-all shadow-lg shadow-navy-900/10 hidden">
                            Unggah Dokumentasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Unggah Nota Susulan -->
<div id="notaModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-navy-950/40 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="closeNotaModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-[2.5rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100 reveal">
            <div class="bg-white px-8 pt-8 pb-8">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-black text-navy-950 uppercase tracking-tight flex items-center gap-2" id="modal-title">
                        <div class="w-10 h-10 rounded-xl bg-gold-50 flex items-center justify-center">
                            <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        Unggah Nota Susulan
                    </h3>
                    <button onclick="closeNotaModal()" class="text-gray-400 hover:text-navy-950 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                
                <form id="formNota" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="p-6 bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 block text-center">Pilih File Nota (Gambar)</label>
                        <input type="file" name="nota" accept=".jpg,.jpeg,.png" class="w-full text-xs text-gray-400 font-bold file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-gold-50 file:text-gold-700 hover:file:bg-gold-100 transition-all cursor-pointer" required>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="closeNotaModal()" class="flex-1 py-4 bg-gray-100 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-gray-200 transition-all">
                            Batal
                        </button>
                        <button type="submit" class="flex-[2] py-4 bg-navy-950 text-gold-400 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-navy-900 transition-all shadow-lg shadow-navy-900/10">
                            Simpan Nota
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currencyInputs = document.querySelectorAll('.currency-input');
        
        currencyInputs.forEach(input => {
            if (input.value) {
                let value = input.value.replace(/\D/g, "");
                input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, "");
                e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            });
        });

        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                currencyInputs.forEach(input => {
                    input.value = input.value.replace(/\./g, '');
                });
            });
        });

        // Documentation Multi-Upload Logic
        const photoInput = document.getElementById('documentation_photos');
        const previewContainer = document.getElementById('preview_container');
        const previewList = document.getElementById('photos_preview_list');
        const uploadBtn = document.getElementById('upload_btn');

        if (photoInput) {
            photoInput.addEventListener('change', function() {
                previewList.innerHTML = '';
                if (this.files.length > 0) {
                    previewContainer.classList.remove('hidden');
                    uploadBtn.classList.remove('hidden');
                    
                    Array.from(this.files).forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const div = document.createElement('div');
                            div.className = 'flex gap-3 p-3 bg-gray-50 rounded-2xl border border-gray-100 items-center';
                            div.innerHTML = `
                                <img src="${e.target.result}" class="w-12 h-12 object-cover rounded-lg shadow-sm border border-white">
                                <div class="flex-1">
                                    <input type="text" name="captions[]" placeholder="Keterangan foto ${index + 1}..." class="w-full bg-white border border-gray-200 rounded-xl py-2 px-3 text-[10px] font-bold text-navy-950 focus:ring-2 focus:ring-gold-500/20 focus:border-gold-500 outline-none transition-all">
                                </div>
                            `;
                            previewList.appendChild(div);
                        }
                        reader.readAsDataURL(file);
                    });
                } else {
                    previewContainer.classList.add('hidden');
                    uploadBtn.classList.add('hidden');
                }
            });
        }

        // Logic for Material Detail Toggle
        const selectKategori = document.getElementById('pilihan-kategori');
        const kolomDetail = document.getElementById('kolom-detail-material');

        if (selectKategori && kolomDetail) {
            selectKategori.addEventListener('change', function() {
                if (this.value === 'Material') {
                    kolomDetail.classList.remove('hidden');
                } else {
                    kolomDetail.classList.add('hidden');
                }
            });
        }

        // Modal Functionality
        window.openNotaModal = function(actionUrl) {
            const modal = document.getElementById('notaModal');
            const form = document.getElementById('formNota');
            form.action = actionUrl;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        window.closeNotaModal = function() {
            const modal = document.getElementById('notaModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
</script>
@endpush
