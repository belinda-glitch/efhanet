@extends('layouts.app')

@section('title', 'Strategic Admin Dashboard - EfhaNet')

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Welcome Header -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-black text-navy-950 tracking-tight">Analitik <span class="text-gold-500">Finansial</span></h1>
                <p class="text-gray-500 text-sm mt-1">Ringkasan finansial strategis dan profitabilitas operasional PT Efha Sejahtera Bersama.</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.projects.create') }}" class="px-6 py-4 bg-navy-950 text-gold-400 text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-navy-900 transition-all shadow-lg shadow-navy-900/10 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Proyek
                </a>
                <div class="flex items-center gap-4 bg-white p-2 rounded-2xl shadow-sm border border-gray-200">
                    <div class="w-10 h-10 rounded-xl bg-navy-950 flex items-center justify-center text-gold-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div class="pr-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tight">Login Sebagai</p>
                        <p class="text-xs font-black text-navy-950">{{ Auth::user()->name }} (Admin)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Strategic Financial Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Stat 1: Total Budget vs Realisasi -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-full -mr-16 -mt-16 transition-all group-hover:scale-110"></div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Total Anggaran Terkelola</p>
                <p class="text-3xl font-black text-navy-950 mb-4">Rp {{ number_format($totalBudget, 0, ',', '.') }}</p>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md uppercase">Modal Dasar</span>
                </div>
            </div>
            
            <!-- Stat 2: Total Realisasi Pengeluaran -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500/5 rounded-full -mr-16 -mt-16 transition-all group-hover:scale-110"></div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Total Pengeluaran Riil</p>
                <p class="text-3xl font-black text-navy-950 mb-4">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</p>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold {{ $overallEfficiency > 90 ? 'text-red-600 bg-red-50' : 'text-orange-600 bg-orange-50' }} px-2 py-0.5 rounded-md uppercase">
                        {{ round($overallEfficiency, 1) }}% Anggaran Terpakai
                    </span>
                </div>
            </div>

            <!-- Stat 3: Est. Profitability Margin -->
            <div class="bg-navy-950 p-8 rounded-[2.5rem] shadow-xl border border-navy-800 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gold-500/10 rounded-full -mr-16 -mt-16 transition-all group-hover:scale-110"></div>
                <p class="text-[10px] font-black text-gold-400 uppercase tracking-widest mb-2">Estimasi Margin Keuntungan</p>
                <p class="text-3xl font-black text-white mb-4">Rp {{ number_format($totalBudget - $totalExpenses, 0, ',', '.') }}</p>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold text-gold-400 bg-gold-400/10 px-2 py-0.5 rounded-md uppercase tracking-widest">
                        Surplus Strategis
                    </span>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 mb-10">
            <!-- Peringatan Proyek Over-Budget (>90%) -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-red-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-red-50 bg-red-50/30 flex items-center justify-between">
                    <h3 class="font-black text-red-900 uppercase tracking-tight text-sm flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Peringatan: Proyek Berisiko Tinggi (Pontianak)
                    </h3>
                </div>
                <div class="p-6">
                    @if($criticalProjects->count() > 0)
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                    <th class="pb-4">Nama Proyek</th>
                                    <th class="pb-4 text-center">Efisiensi</th>
                                    <th class="pb-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($criticalProjects as $cp)
                                <tr>
                                    <td class="py-4">
                                        <p class="text-xs font-bold text-navy-950">{{ $cp->nama }}</p>
                                        <p class="text-[9px] text-gray-400">{{ $cp->kecamatan_pontianak }}</p>
                                    </td>
                                    <td class="py-4 text-center">
                                        <span class="text-xs font-black text-red-600">{{ round($cp->efficiency_percentage, 1) }}%</span>
                                    </td>
                                    <td class="py-4 text-right">
                                        <a href="{{ route('projects.show', $cp->id) }}" class="text-[10px] font-black text-navy-900 uppercase hover:text-gold-600 transition-colors">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="py-10 text-center">
                            <p class="text-xs text-gray-400 font-bold uppercase">Semua proyek di Pontianak dalam batas aman anggaran.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Grafik Profitabilitas per Kecamatan -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8">
                <h3 class="font-black text-navy-950 uppercase tracking-tight text-sm mb-6">Analisis Profitabilitas Per Kecamatan (Pontianak)</h3>
                <div class="h-64">
                    <canvas id="profitabilityChart"></canvas>
                </div>
            </div>
        </div>

        <!-- General Project List (Old but updated layout) -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                <h3 class="font-black text-navy-950 uppercase tracking-tight text-lg">Daftar Proyek Aktif</h3>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Monitoring Aktif</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-gray-400 tracking-[0.1em]">Klien</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-gray-400 tracking-[0.1em]">Nama Proyek & Lokasi</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-gray-400 tracking-[0.1em]">Anggaran Awal</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-gray-400 tracking-[0.1em] text-center">Status K3</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-gray-400 tracking-[0.1em]">Waktu Dibuat</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase text-gray-400 tracking-[0.1em] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($projects as $item)
                        <tr class="hover:bg-gray-50/30 transition-all duration-200">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-navy-50 border border-navy-100 flex items-center justify-center font-black text-navy-900 text-sm">
                                        {{ substr($item->client->nama_perusahaan ?? $item->client->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-navy-950 tracking-tight leading-none mb-1">
                                            {{ $item->client->nama_perusahaan ?? 'Personal Client' }}
                                        </p>
                                        <div class="flex items-center gap-2">
                                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">{{ $item->client->email }}</p>
                                            @if($item->client->phone)
                                                @php
                                                    $wa_phone = preg_replace('/[^0-9]/', '', $item->client->phone);
                                                    if (str_starts_with($wa_phone, '0')) {
                                                        $wa_phone = '62' . substr($wa_phone, 1);
                                                    }
                                                    $wa_message = urlencode("Halo " . $item->client->name . ", kami dari tim EfhaNet ingin menginfokan mengenai progres proyek Anda.");
                                                @endphp
                                                <a href="https://wa.me/{{ $wa_phone }}?text={{ $wa_message }}" target="_blank" class="text-green-500 hover:text-green-600 transition-colors" title="Chat via WhatsApp">
                                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-navy-950 mb-1">{{ $item->nama }}</p>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">{{ $item->kecamatan_pontianak }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-black text-navy-950">Rp {{ number_format($item->budget_awal, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-navy-50 text-navy-700 text-[9px] font-black uppercase tracking-tighter border border-navy-200">
                                    {{ $item->status_k3 }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-xs font-bold text-navy-950">{{ $item->created_at->format('d M Y') }}</p>
                                <p class="text-[10px] text-gray-400 font-medium">{{ $item->created_at->format('H:i') }} WIB</p>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <a href="{{ route('projects.show', $item->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-navy-950 text-gold-400 rounded-2xl text-[10px] font-black uppercase tracking-[0.1em] hover:bg-navy-900 transition-all shadow-lg shadow-navy-900/10 group">
                                    Detail
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('profitabilityChart').getContext('2d');
        
        const labels = {!! json_encode($profitabilityData->pluck('kecamatan')) !!};
        const profitData = {!! json_encode($profitabilityData->pluck('profit')) !!};
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Estimasi Profit (Rp)',
                    data: profitData,
                    backgroundColor: 'rgba(212, 152, 42, 0.2)',
                    borderColor: 'rgba(212, 152, 42, 1)',
                    borderWidth: 2,
                    borderRadius: 12,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 10,
                                weight: 'bold'
                            },
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 9,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
