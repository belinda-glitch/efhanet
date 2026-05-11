<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Survei Lapangan',
                'icon' => 'fas fa-map-location-dot',
                'description' => 'Survei lokasi dan perencanaan jaringan telekomunikasi dengan teknologi terkini untuk hasil yang akurat dan efisien.'
            ],
            [
                'title' => 'Layanan Instalasi',
                'icon' => 'fas fa-tools',
                'description' => 'Pemasangan perangkat dan infrastruktur jaringan telekomunikasi dengan standar internasional dan keamanan terjamin.'
            ],
            [
                'title' => 'Optimasi Jaringan',
                'icon' => 'fas fa-chart-line',
                'description' => 'Optimalisasi kinerja jaringan telekomunikasi untuk memaksimalkan kapasitas, kecepatan, dan kualitas layanan.'
            ],
            [
                'title' => 'Solusi Daya',
                'icon' => 'fas fa-bolt',
                'description' => 'Penyediaan dan pemeliharaan sistem kelistrikan untuk BTS dan infrastruktur telekomunikasi yang handal 24/7.'
            ],
        ];

        foreach ($services as $service) {
            \App\Models\Service::create($service);
        }
    }
}
