<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortfolioGroup;
use App\Models\Partner;

class LandingController extends Controller
{
    public function index()
    {
        $portfolioGroups = PortfolioGroup::with('items')->get();
        $partners = Partner::all();
        return view('welcome', compact('portfolioGroups', 'partners'));
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function portfolio()
    {
        $portfolioGroups = PortfolioGroup::with('items')->get();
        return view('portfolio', compact('portfolioGroups'));
    }

    public function contact()
    {
        return view('contact');
    }
}
