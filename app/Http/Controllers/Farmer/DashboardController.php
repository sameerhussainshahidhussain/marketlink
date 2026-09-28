<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $farmer = Auth::user();

        $recentOrders = Order::forFarmer($farmer->id)
                              ->with(['customer', 'market', 'pickupSlot'])
                              ->latest()
                              ->take(5)
                              ->get();

        $stats = [
            'total_orders'    => Order::forFarmer($farmer->id)->count(),
            'pending_orders'  => Order::forFarmer($farmer->id)->where('order_status', 'placed')->count(),
            'total_products'  => $farmer->products()->count(),
            'active_products' => $farmer->products()->where('status', 'active')->count(),
            'total_revenue'   => Order::forFarmer($farmer->id)->where('order_status', 'completed')->sum('total_amount'),
            'avg_rating'      => Review::where('farmer_id', $farmer->id)->where('status', 'approved')->avg('rating'),
        ];

        $lowStockProducts = $farmer->products()
                                    ->where('status', 'active')
                                    ->where('stock_quantity', '<=', 5)
                                    ->orderBy('stock_quantity')
                                    ->take(5)
                                    ->get();

        return view('farmer.dashboard', compact('recentOrders', 'stats', 'lowStockProducts'));
    }
}
