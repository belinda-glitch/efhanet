<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Expense;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $projects = Project::with(['client', 'expenses'])->latest()->get();

        // 1. Statistik Finansial Strategis
        $totalBudget = Project::sum('budget_awal');
        $totalExpenses = Expense::sum('jumlah_nominal');
        $overallEfficiency = $totalBudget > 0 ? ($totalExpenses / $totalBudget) * 100 : 0;

        // 2. Proyek Kritis (>90% Budget di wilayah Pontianak)
        $criticalProjects = Project::where('kecamatan_pontianak', 'LIKE', '%Pontianak%')
            ->get()
            ->filter(function($project) {
                return $project->efficiency_percentage > 90;
            });

        // 3. Data Profitabilitas per Kecamatan untuk Chart
        $profitabilityData = Project::where('kecamatan_pontianak', 'LIKE', '%Pontianak%')
            ->select('kecamatan_pontianak', DB::raw('SUM(budget_awal) as total_budget'))
            ->groupBy('kecamatan_pontianak')
            ->get()
            ->map(function($item) {
                // Hitung pengeluaran per kecamatan
                $expenses = Project::where('kecamatan_pontianak', $item->kecamatan_pontianak)
                    ->with('expenses')
                    ->get()
                    ->sum(function($p) {
                        return $p->total_expenses;
                    });
                
                $profit = $item->total_budget - $expenses;
                
                return [
                    'kecamatan' => $item->kecamatan_pontianak,
                    'profit' => $profit,
                    'profit_percentage' => $item->total_budget > 0 ? ($profit / $item->total_budget) * 100 : 0
                ];
            });

        return view('admin.dashboard', compact(
            'projects', 
            'totalBudget', 
            'totalExpenses', 
            'overallEfficiency', 
            'criticalProjects',
            'profitabilityData'
        ));
    }

    public function clients()
    {
        $clients = \App\Models\User::where('role', 'client')
            ->withCount('projects')
            ->latest()
            ->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function clientShow($id)
    {
        $client = \App\Models\User::where('role', 'client')
            ->with(['projects.expenses'])
            ->findOrFail($id);
            
        return view('admin.clients.show', compact('client'));
    }

    public function servicesIndex()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function servicesStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Service::create($request->all());

        return redirect()->back()->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function servicesDestroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->back()->with('success', 'Layanan berhasil dihapus!');
    }
}
