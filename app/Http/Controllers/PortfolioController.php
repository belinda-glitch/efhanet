<?php

namespace App\Http\Controllers;

use App\Models\PortfolioGroup;
use App\Models\PortfolioItem;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $groups = PortfolioGroup::with('items')->latest()->get();
        return view('admin.portfolio.index', compact('groups'));
    }

    public function storeGroup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        PortfolioGroup::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Grup Portofolio berhasil ditambahkan!');
    }

    public function storeItem(Request $request)
    {
        $request->validate([
            'portfolio_group_id' => 'required|exists:portfolio_groups,id',
            'project_name' => 'required|string|max:255',
            'scope_of_work' => 'required|string',
        ]);

        PortfolioItem::create($request->all());

        return redirect()->back()->with('success', 'Item Proyek berhasil ditambahkan!');
    }

    public function destroyGroup($id)
    {
        $group = PortfolioGroup::findOrFail($id);
        $group->delete();

        return redirect()->back()->with('success', 'Grup Portofolio beserta itemnya berhasil dihapus!');
    }

    public function destroyItem($id)
    {
        $item = PortfolioItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item Proyek berhasil dihapus!');
    }
}
