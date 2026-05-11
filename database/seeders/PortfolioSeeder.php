<?php

namespace Database\Seeders;

use App\Models\PortfolioGroup;
use App\Models\PortfolioItem;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ZTE PROJECTS
        $zte = PortfolioGroup::create(['name' => 'ZTE PROJECTS']);
        PortfolioItem::create([
            'portfolio_group_id' => $zte->id,
            'project_name' => 'Project I-CORE - 2024',
            'scope_of_work' => 'Survey and Installation equipment for I-CORE project.'
        ]);
        PortfolioItem::create([
            'portfolio_group_id' => $zte->id,
            'project_name' => 'Project Modernization ZTE - 2023',
            'scope_of_work' => 'Dismantle and Installation new BBU and RRU for modernization.'
        ]);

        // 2. HUAWEI PROJECTS
        $huawei = PortfolioGroup::create(['name' => 'HUAWEI PROJECTS']);
        PortfolioItem::create([
            'portfolio_group_id' => $huawei->id,
            'project_name' => 'Project Telkomsel G9 - 2024',
            'scope_of_work' => 'Installation and Commissioning for Telkomsel G9 expansion.'
        ]);
        PortfolioItem::create([
            'portfolio_group_id' => $huawei->id,
            'project_name' => 'Project Indosat Ooredoo Hutchison',
            'scope_of_work' => 'Maintenance and Corrective site for IOH Region Kalimantan.'
        ]);
    }
}
