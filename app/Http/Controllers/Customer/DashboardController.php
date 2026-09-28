<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $recentOrders = Order::forCustomer($user->id)
                              ->with(['farmer.farmerProfile', 'market'])
                              ->latest()
                              ->take(5)
                              ->get();

        $stats = [
            'total_orders'     => Order::forCustomer($user->id)->count(),
            'active_orders'    => Order::forCustomer($user->id)
                                       ->whereIn('order_status', ['placed', 'accepted', 'ready_for_pickup'])
                                       ->count(),
            'completed_orders' => Order::forCustomer($user->id)->where('order_status', 'completed')->count(),
            'favorite_farmers' => $user->favoriteFarmers()->count(),
        ];

        $favoriteFarmers = $user->favoriteFarmers()
                                 ->with('farmerProfile')
                                 ->where('status', 'active')
                                 ->take(4)
                                 ->get();

        $favoriteProducts = $user->favoriteProducts()
                                  ->with(['farmer.farmerProfile', 'category'])
                                  ->active()
                                  ->take(4)
                                  ->get();

        return view('customer.dashboard', compact(
            'recentOrders', 'stats', 'favoriteFarmers', 'favoriteProducts'
        ));
    }

    public function toggleFarmer(User $farmer)
    {
        abort_unless($farmer->role === 'farmer', 404);
        $user = Auth::user();

        $exists = $user->favoriteFarmers()->where('farmer_id', $farmer->id)->exists();

        if ($exists) {
            $user->favoriteFarmers()->detach($farmer->id);
            $message = 'Removed from favourites.';
        } else {
            $user->favoriteFarmers()->attach($farmer->id);
            $message = 'Added to favourites!';
        }

        return back()->with('success', $message);
    }

    public function toggleProduct(Product $product)
    {
        $user = Auth::user();

        $exists = $user->favoriteProducts()->where('product_id', $product->id)->exists();

        if ($exists) {
            $user->favoriteProducts()->detach($product->id);
            $message = 'Removed from favourites.';
        } else {
            $user->favoriteProducts()->attach($product->id);
            $message = 'Added to favourites!';
        }

        return back()->with('success', $message);
    }
}
