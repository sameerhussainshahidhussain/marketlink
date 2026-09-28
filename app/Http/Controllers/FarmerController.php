<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Market;
use App\Models\Review;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'farmer')
                      ->where('status', 'active')
                      ->whereHas('farmerProfile', function ($q) {
                          $q->where('approval_status', 'approved');
                      })
                      ->with(['farmerProfile', 'markets'])
                      ->withCount(['products' => function ($q) {
                          $q->active();
                      }]);

        $search = $request->input('search');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('farmerProfile', function ($q2) use ($search) {
                      $q2->where('business_name', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
                  });
            });
        }

        $market = $request->input('market');
        if ($market) {
            $query->whereHas('markets', function ($q) use ($market) {
                $q->where('markets.id', $market);
            });
        }

        $sortBy = $request->input('sort', 'newest');
        if ($sortBy === 'products') {
            $query->orderByDesc('products_count');
        } else {
            $query->latest();
        }

        $farmers = $query->paginate(12)->withQueryString();
        $markets = Market::where('status', 'active')->pluck('market_name', 'id');

        return view('farmers.index', compact('farmers', 'markets'));
    }

    public function show(User $farmer)
    {
        if ($farmer->role !== 'farmer' || $farmer->status !== 'active') {
            abort(404);
        }

        $farmer->load(['farmerProfile', 'markets']);

        $products = $farmer->products()
                           ->with('category')
                           ->active()
                           ->available()
                           ->paginate(12);

        $reviews = Review::where('farmer_id', $farmer->id)
                         ->where('status', 'approved')
                         ->with('customer')
                         ->latest()
                         ->take(6)
                         ->get();

        $avgRating   = $reviews->avg('rating') ?: 5.0;
        $reviewCount = Review::where('farmer_id', $farmer->id)
                             ->where('status', 'approved')
                             ->count();

        $upcomingSlots = $farmer->pickupSlots()
                                ->available()
                                ->where('pickup_date', '>=', now()->toDateString())
                                ->with('market')
                                ->orderBy('pickup_date')
                                ->take(5)
                                ->get();

        $isFavorited = false;
        if (auth()->check()) {
            $isFavorited = auth()->user()
                ->favoriteFarmers()
                ->where('farmer_id', $farmer->id)
                ->exists();
        }

        return view('farmers.show', compact(
            'farmer',
            'products',
            'reviews',
            'avgRating',
            'reviewCount',
            'upcomingSlots',
            'isFavorited'
        ));
    }
}
