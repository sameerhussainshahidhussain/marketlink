<?php

namespace App\Http\Controllers;

use App\Models\Market;
use App\Models\Product;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(Request $request)
    {
        $query = Market::where('status', 'active')
                        ->withCount('farmers');

        $search = $request->input('search');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('market_name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $city = $request->input('city');
        if ($city) {
            $query->where('city', $city);
        }

        $day = $request->input('day');
        if ($day) {
            $query->where('operating_days', 'like', "%{$day}%");
        }

        $markets = $query->latest()->paginate(12)->withQueryString();

        $cities = Market::where('status', 'active')
                         ->distinct()
                         ->pluck('city')
                         ->sort()
                         ->values();

        return view('markets.index', compact('markets', 'cities'));
    }

    public function show(Market $market)
    {
        if (!$market->isActive()) {
            abort(404);
        }

        $market->load([
            'farmers.farmerProfile',
            'farmers' => function ($q) {
                $q->where('status', 'active')
                  ->whereHas('farmerProfile', function ($q2) {
                      $q2->where('approval_status', 'approved');
                  });
            },
        ]);

        $products = Product::with(['farmer', 'category'])
            ->active()
            ->available()
            ->whereHas('farmer', function ($q) use ($market) {
                $q->whereHas('markets', function ($q2) use ($market) {
                    $q2->where('markets.id', $market->id);
                });
            })
            ->take(12)
            ->get();

        $upcomingSlots = $market->pickupSlots()
                                ->available()
                                ->where('pickup_date', '>=', now()->toDateString())
                                ->with('farmer.farmerProfile')
                                ->orderBy('pickup_date')
                                ->take(5)
                                ->get();

        return view('markets.show', compact('market', 'products', 'upcomingSlots'));
    }
}
