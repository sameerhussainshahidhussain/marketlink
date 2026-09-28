<?php

namespace App\Http\Controllers;

use App\Models\Market;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Announcement;

class HomeController extends Controller
{
    public function index()
    {
        $allMarkets = Market::where('status', 'active')
                            ->orderBy('market_name')
                            ->get();

        $featuredMarkets = Market::where('status', 'active')
                                  ->latest()
                                  ->take(4)
                                  ->get();

        $featuredProducts = Product::with(['farmer.farmerProfile', 'category'])
                                    ->active()
                                    ->available()
                                    ->latest()
                                    ->take(8)
                                    ->get();

        $featuredFarmers = User::where('role', 'farmer')
                                ->where('status', 'active')
                                ->whereHas('farmerProfile', function ($q) {
                                    $q->where('approval_status', 'approved');
                                })
                                ->with('farmerProfile')
                                ->withCount(['products' => function ($q) {
                                    $q->active();
                                }])
                                ->take(4)
                                ->get();

        $categories = Category::where('status', 'active')
                               ->withCount(['products' => function ($q) {
                                   $q->active();
                               }])
                               ->take(8)
                               ->get();

        $announcements = Announcement::where('status', 'published')
                                     ->where('published_at', '<=', now())
                                     ->latest('published_at')
                                     ->take(3)
                                     ->get();

        $stats = [
            'markets'   => Market::where('status', 'active')->count(),
            'farmers'   => User::where('role', 'farmer')
                               ->whereHas('farmerProfile', function ($q) {
                                   $q->where('approval_status', 'approved');
                               })
                               ->count(),
            'products'  => Product::active()->count(),
            'customers' => User::where('role', 'customer')->where('status', 'active')->count(),
        ];

        return view('home', compact(
            'allMarkets',
            'featuredMarkets',
            'featuredProducts',
            'featuredFarmers',
            'categories',
            'announcements',
            'stats'
        ));
    }
}
