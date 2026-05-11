@extends('layouts.app')

@section('title', 'Concierge Insight - ' . $project->nama)

@section('content')
<section class="min-h-screen pt-32 pb-20 bg-slate-50 text-slate-800 overflow-hidden relative">
    <!-- Background Decor -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-[#0d9488]/5 -skew-x-12 translate-x-1/4"></div>
    <div class="absolute top-40 left-10 w-96 h-96 bg-[#0d9488]/10 rounded-full blur-[100px] animate-pulse"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header -->
        <div class="mb-10 text-center reveal">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight leading-none text-slate-900 mb-2">
                Antigravity <span class="text-[#0d9488]">Concierge</span>
            </h1>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.2em]">Laporan Status Eksekutif</p>
        </div>

        <!-- Progress & Summary Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12 reveal">
            <!-- Progress Ring -->
            <div class="md:col-span-1 flex flex-col items-center justify-center bg-white p-8 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100">
                <div class="relative w-40 h-40 flex items-center justify-center">
                    <!-- Background Circle -->
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 160 160">
                        <circle cx="80" cy="80" r="70" stroke="currentColor" stroke-width="12" fill="transparent" class="text-slate-100" />
                        <!-- Progress Circle -->
                        @php
                            $circumference = 2 * pi() * 70;
                            $offset = $circumference - ($project->technical_progress / 100) * $circumference;
                        @endphp
                        <circle cx="80" cy="80" r="70" stroke="currentColor" stroke-width="12" fill="transparent" 
                            class="text-[#0d9488] transition-all duration-1000 ease-out"
                            stroke-dasharray="{{ $circumference }}" 
                            stroke-dashoffset="{{ $offset }}" 
                            stroke-linecap="round" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-3xl font-black text-slate-800">{{ $project->technical_progress }}%</span>
                        <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400">Progres</span>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="md:col-span-2 flex flex-col justify-center gap-4">
                <div class="bg-white/60 backdrop-blur-md p-6 rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Target Proyek</p>
                    <h2 class="text-xl font-bold text-slate-800">{{ $project->nama }}</h2>
                </div>
                
                <div class="bg-white/60 backdrop-blur-md p-6 rounded-3xl border border-slate-100 shadow-lg shadow-slate-200/40 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Estimasi Penyelesaian</p>
                        <p class="text-lg font-bold text-slate-700">
                            {{ $project->deadline ? $project->deadline->format('d M Y') : 'Dalam Konfirmasi' }}
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-[#0d9488]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#0d9488]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transparency Chart -->
        <div class="reveal relative max-w-3xl mx-auto mb-12">
            <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50 border border-slate-100">
                <div class="flex items-center justify-between mb-8 border-b border-slate-100 pb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Transparansi Alokasi Dana</h3>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-1">Status Penggunaan Anggaran Terkini</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#0d9488]/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#0d9488]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                    </div>
                </div>
                <div id="transparencyChart" class="w-full flex justify-center"></div>
            </div>
        </div>

        <!-- AI Speech Bubble -->
        <div class="reveal relative max-w-3xl mx-auto">
            <!-- Avatar -->
            <div class="flex items-end gap-4 mb-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#0d9488] to-teal-600 flex items-center justify-center shadow-lg shadow-teal-500/30 flex-shrink-0 relative z-10">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div class="pb-2">
                    <span class="text-xs font-black uppercase tracking-widest text-slate-500">Antigravity Concierge</span>
                    <span class="flex items-center gap-1 text-[9px] font-bold text-[#0d9488] mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#0d9488] animate-pulse"></span>
                        Online
                    </span>
                </div>
            </div>

            <!-- Chat Bubble -->
            <div class="bg-white rounded-3xl rounded-tl-none p-8 md:p-10 shadow-2xl shadow-slate-200/50 border border-slate-100 relative">
                <!-- Tail pointer -->
                <div class="absolute -left-3 top-0 w-6 h-6 bg-white border-l border-t border-slate-100 transform -skew-x-[30deg] z-0"></div>
                
                <div class="relative z-10 prose prose-slate max-w-none
                    prose-headings:text-slate-800 prose-headings:font-bold
                    prose-p:text-slate-600 prose-p:leading-relaxed
                    prose-strong:text-[#0d9488] prose-strong:font-black
                    prose-li:text-slate-600 prose-li:marker:text-[#0d9488]
                    prose-blockquote:border-[#0d9488] prose-blockquote:bg-slate-50 prose-blockquote:not-italic prose-blockquote:py-1">
                    {!! Str::markdown($insight) !!}
                </div>
            </div>

            <!-- Footer Action -->
            <div class="flex justify-center pt-12">
                <a href="{{ route('projects.show', $project->id) }}" class="px-8 py-4 bg-white hover:bg-slate-50 shadow-lg shadow-slate-200/50 border border-slate-100 rounded-full text-xs font-bold uppercase tracking-widest text-slate-600 hover:text-[#0d9488] transition-all flex items-center gap-3 group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Detail Proyek
                </a>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var usedFunds = {{ $project->expenses_sum_jumlah_nominal ?? 0 }};
        var totalBudget = {{ $project->budget_awal ?? 0 }};
        var remainingFunds = totalBudget - usedFunds;
        if(remainingFunds < 0) remainingFunds = 0;

        var options = {
            series: [usedFunds, remainingFunds],
            chart: {
                type: 'donut',
                height: 380,
                fontFamily: 'Inter, sans-serif',
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }
            },
            labels: ['Dana Digunakan', 'Sisa Alokasi'],
            colors: ['#0d9488', '#e2e8f0'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '12px',
                                fontFamily: 'Inter, sans-serif',
                                fontWeight: 700,
                                color: '#94a3b8',
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '24px',
                                fontFamily: 'Inter, sans-serif',
                                fontWeight: 900,
                                color: '#0f172a',
                                offsetY: 5,
                                formatter: function (val) {
                                    return "Rp " + new Intl.NumberFormat('id-ID').format(val);
                                }
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: 'TOTAL ANGGARAN',
                                fontSize: '10px',
                                fontWeight: 800,
                                color: '#94a3b8',
                                formatter: function (w) {
                                    return "Rp " + new Intl.NumberFormat('id-ID').format(totalBudget);
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                colors: 'transparent',
                width: 0
            },
            tooltip: {
                enabled: true,
                theme: 'light',
                y: {
                    formatter: function(value) {
                        return "Rp " + new Intl.NumberFormat('id-ID').format(value);
                    }
                }
            },
            legend: {
                position: 'bottom',
                markers: {
                    radius: 12
                },
                itemMargin: {
                    horizontal: 15,
                    vertical: 8
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#transparencyChart"), options);
        chart.render();
    });
</script>
@endpush
@endsection
