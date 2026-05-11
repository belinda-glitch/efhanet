<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|url',
        ]);

        $path = $request->file('logo')->store('partners', 'public');

        Partner::create([
            'name' => $request->name,
            'logo' => $path,
            'link' => $request->link,
        ]);

        return redirect()->back()->with('success', 'Partner berhasil ditambahkan!');
    }

    public function destroy(Partner $partner)
    {
        if (Storage::disk('public')->exists($partner->logo)) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()->back()->with('success', 'Partner berhasil dihapus!');
    }
}
