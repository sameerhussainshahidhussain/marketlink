<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $favoriteFarmers = $user->favoriteFarmers()
                                 ->with('farmerProfile')
                                 ->where('status', 'active')
                                 ->get();

        $favoriteProducts = $user->favoriteProducts()
                                  ->with(['farmer.farmerProfile', 'category'])
                                  ->where('status', 'active')
                                  ->get();

        return view('customer.favorites', compact('favoriteFarmers', 'favoriteProducts'));
    }

    public function toggleFarmer(User $farmer)
    {
        if ($farmer->role !== 'farmer') {
            abort(404);
        }

        $user = Auth::user();

        $isFav = $user->favoriteFarmers()->where('farmer_id', $farmer->id)->exists();

        if ($isFav) {
            $user->favoriteFarmers()->detach($farmer->id);
            $msg = 'Removed from favorite farmers';
        } else {
            $user->favoriteFarmers()->attach($farmer->id);
            $msg = 'Added to favorite farmers!';
        }

        if (request()->wantsJson()) {
            return response()->json([
                'success'      => true,
                'is_favorited' => !$isFav,
                'message'      => $msg,
            ]);
        }

        return back()->with('success', $msg);
    }

    public function toggleProduct(Product $product)
    {
        $user = Auth::user();

        $isFav = $user->favoriteProducts()->where('product_id', $product->id)->exists();

        if ($isFav) {
            $user->favoriteProducts()->detach($product->id);
            $msg = 'Removed from favorite products';
        } else {
            $user->favoriteProducts()->attach($product->id);
            $msg = 'Saved to your favorites!';
        }

        if (request()->wantsJson()) {
            return response()->json([
                'success'      => true,
                'is_favorited' => !$isFav,
                'message'      => $msg,
            ]);
        }

        return back()->with('success', $msg);
    }
}
