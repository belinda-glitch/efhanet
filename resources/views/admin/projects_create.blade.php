@extends('layouts.app')

@section('title', 'Buat Proyek Baru - PT Efha Sejahtera Bersama')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        background-color: #f9fafb;
        border: 1px solid #f3f4f6;
        border-radius: 1rem;
        height: 56px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #0a1628;
        font-weight: 700;
        font-size: 0.875rem;
        padding-left: 8px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 54px;
        right: 15px;
    }
    .select2-dropdown {
        border: 1px solid #f3f4f6;
        border-radius: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .select2-results__option {
        padding: 12px 16px;
        font-size: 0.875rem;
        font-weight: 600;
    }
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #d4982a;
    }
    .select2-search--dropdown .select2-search__field {
        border-radius: 0.5rem;
        padding: 8px 12px;
    }
</style>
@endpush
<section class="min-h-screen pt-32 pb-20 bg-[#f8fafc]">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 text-navy-400 hover:text-gold-600 transition-all text-[10px] font-black uppercase tracking-widest group mb-4">
                <svg class="w-3 h-3 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Dashboard
            </a>
            <h1 class="text-3xl font-black text-navy-950 tracking-tight">Manajemen <span class="text-gold-500">Proyek Baru</span></h1>
            <p class="text-gray-500 text-sm mt-1">Inisialisasi kontrak proyek telekomunikasi baru untuk klien PT Efha.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 reveal">
            <form action="{{ route('admin.projects.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <!-- Project Name -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Nama Proyek</label>
                    <input type="text" name="nama" placeholder="Contoh: Pemasangan Tower BTS Cluster Pontianak" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-bold text-navy-950 focus:ring-4 focus:ring-gold-500/10 focus:border-gold-500 outline-none transition-all" required>
                </div>

                <div class="grid sm:grid-cols-2 gap-6">
                    <!-- Client Selection -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Pilih Klien</label>
                        <select name="user_id" id="user_id" class="select2-client w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-bold text-navy-950 focus:ring-4 focus:ring-gold-500/10 focus:border-gold-500 outline-none transition-all" required>
                            <option value="">-- Cari Nomor HP / Nama Klien --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">
                                    [{{ $client->phone ?? 'N/A' }}] - {{ $client->name }} {{ $client->nama_perusahaan ? '(' . $client->nama_perusahaan . ')' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Service Type -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Jenis Jasa Utama</label>
                        <select name="service_type" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-bold text-navy-950 focus:ring-4 focus:ring-gold-500/10 focus:border-gold-500 outline-none transition-all" required>
                            <option value="Survey & Design">Survei Lapangan</option>
                            <option value="Installation Services">Layanan Instalasi</option>
                            <option value="Network Optimization">Optimasi Jaringan</option>
                            <option value="Power Solutions">Solusi Daya</option>
                        </select>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-6">
                    <!-- Kecamatan -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Wilayah (Pontianak)</label>
                        <select name="kecamatan_pontianak" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-bold text-navy-950 focus:ring-4 focus:ring-gold-500/10 focus:border-gold-500 outline-none transition-all" required>
                            <option value="Pontianak Kota">Kota</option>
                            <option value="Pontianak Barat">Barat</option>
                            <option value="Pontianak Selatan">Selatan</option>
                            <option value="Pontianak Tenggara">Tenggara</option>
                            <option value="Pontianak Timur">Timur</option>
                            <option value="Pontianak Utara">Utara</option>
                        </select>
                    </div>

                    <!-- Budget -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Anggaran Awal (IDR)</label>
                        <input type="text" name="budget_awal" id="budget_awal" value="{{ old('budget_awal') }}" placeholder="Contoh: 150.000.000" class="currency-input w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-bold text-navy-950 focus:ring-4 focus:ring-gold-500/10 focus:border-gold-500 outline-none transition-all" required>
                    </div>
                </div>

                <!-- Deadline -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">
                        Target Deadline
                    </label>
                    <div class="relative">
                        <input type="date" name="deadline" id="deadline" value="{{ old('deadline', isset($project) ? ($project->deadline ? $project->deadline->format('Y-m-d') : '') : '') }}" 
                            class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-bold text-navy-950 focus:ring-4 focus:ring-gold-500/10 focus:border-gold-500 outline-none transition-all cursor-pointer">
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-5 bg-navy-950 text-gold-400 text-xs font-black uppercase tracking-[0.2em] rounded-[2rem] hover:bg-navy-900 transition-all shadow-xl shadow-navy-950/20 flex items-center justify-center gap-3 group">
                        Inisialisasi Proyek Baru
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 p-6 bg-gold-400/10 rounded-3xl border border-gold-400/20 text-center">
            <p class="text-[10px] font-bold text-navy-900/60 uppercase tracking-widest leading-relaxed">Seluruh data yang dimasukkan akan secara otomatis terintegrasi dengan Dashboard Strategis Admin dan Portal Proyek Klien guna menjamin transparansi operasional.</p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-client').select2({
            placeholder: "-- Cari Nomor HP / Nama Klien --",
            allowClear: true,
            width: '100%'
        });

        const currencyInputs = document.querySelectorAll('.currency-input');
        
        currencyInputs.forEach(input => {
            // Format on load
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
    });
</script>
@endpush
