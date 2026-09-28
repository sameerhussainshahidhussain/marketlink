<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Market;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['farmer.farmerProfile', 'category'])
                         ->active()
                         ->available();

        $search = $request->input('search');
        if ($search) {
            $query->search($search);
        }

        $category = $request->input('category');
        if ($category) {
            if (is_numeric($category)) {
                $query->where('category_id', $category);
            } else {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category)->orWhere('name', 'like', "%{$category}%");
                });
            }
        }

        $farmer = $request->input('farmer');
        if ($farmer) {
            $query->where('farmer_id', $farmer);
        }

        $marketId = $request->input('market');
        if ($marketId && $marketId !== 'all') {
            $query->whereHas('farmer', function ($q) use ($marketId) {
                $q->whereHas('markets', function ($q2) use ($marketId) {
                    if (is_numeric($marketId)) {
                        $q2->where('markets.id', $marketId);
                    } else {
                        $q2->where('markets.slug', $marketId);
                    }
                });
            });
        }

        $day = $request->input('day');
        if ($day) {
            $query->whereHas('farmer', function ($q) use ($day) {
                $q->whereHas('markets', function ($q2) use ($day) {
                    $q2->where('operating_days', 'like', "%{$day}%");
                });
            });
        }

        $minPrice = $request->input('min_price');
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }

        $maxPrice = $request->input('max_price');
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        $availability = $request->input('availability');
        if ($availability === 'available') {
            $query->where('stock_quantity', '>', 5);
        } elseif ($availability === 'low_stock') {
            $query->whereBetween('stock_quantity', [1, 5]);
        }

        $sortBy = $request->input('sort', 'newest');
        if ($sortBy === 'price_asc') {
            $query->orderBy('price');
        } elseif ($sortBy === 'price_desc') {
            $query->orderByDesc('price');
        } elseif ($sortBy === 'name') {
            $query->orderBy('name');
        } else {
            $query->latest();
        }

        $products = $query->paginate(16)->withQueryString();

        $categories = Category::where('status', 'active')->get();
        $markets    = Market::where('status', 'active')->orderBy('market_name')->get();

        $farmers = User::where('role', 'farmer')
                       ->where('status', 'active')
                       ->whereHas('farmerProfile', function ($q) {
                           $q->where('approval_status', 'approved');
                       })
                       ->with('farmerProfile')
                       ->orderBy('name')
                       ->get();

        return view('products.index', compact('products', 'categories', 'markets', 'farmers'));
    }

    public function show(Product $product)
    {
        abort_unless($product->status === 'active', 404);

        $product->load(['farmer.farmerProfile', 'farmer.markets', 'category', 'reviews.customer']);

        $related = Product::with(['farmer', 'category'])
                           ->active()
                           ->available()
                           ->where('category_id', $product->category_id)
                           ->where('id', '!=', $product->id)
                           ->take(4)
                           ->get();

        $avgRating   = $product->reviews()->where('status', 'approved')->avg('rating') ?: 5.0;
        $reviewCount = $product->reviews()->where('status', 'approved')->count();

        $isFavorited = false;
        if (auth()->check()) {
            $isFavorited = auth()->user()
                ->favoriteProducts()
                ->where('product_id', $product->id)
                ->exists();
        }

        return view('products.show', compact(
            'product', 'related', 'avgRating', 'reviewCount', 'isFavorited'
        ));
    }
}
