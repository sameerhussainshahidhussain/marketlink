<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Market;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = User::where('role', 'customer')->count();
        $totalFarmers   = User::where('role', 'farmer')->count();

        $pendingFarmerCount = User::where('role', 'farmer')
                                  ->whereHas('farmerProfile', function ($q) {
                                      $q->where('approval_status', 'pending');
                                  })
                                  ->count();

        $revenueToday = Order::where('order_status', 'completed')
                             ->whereDate('updated_at', today())
                             ->sum('total_amount');

        $revenueMonth = Order::where('order_status', 'completed')
                             ->whereMonth('updated_at', now()->month)
                             ->sum('total_amount');

        $stats = [
            'total_customers' => $totalCustomers,
            'total_farmers'   => $totalFarmers,
            'pending_farmers' => $pendingFarmerCount,
            'total_markets'   => Market::count(),
            'total_products'  => Product::count(),
            'total_orders'    => Order::count(),
            'revenue_today'   => $revenueToday,
            'revenue_month'   => $revenueMonth,
            'pending_reviews' => Review::where('status', 'pending')->count(),
        ];

        $recentOrders = Order::with(['customer', 'farmer.farmerProfile', 'market'])
                              ->latest()
                              ->take(7)
                              ->get();

        $pendingFarmers = User::where('role', 'farmer')
                               ->where('status', 'pending')
                               ->with('farmerProfile')
                               ->take(5)
                               ->get();

        $orderTrend = Order::select(
                            DB::raw('DATE(created_at) as date'),
                            DB::raw('count(*) as total')
                        )
                        ->where('created_at', '>=', now()->subDays(30))
                        ->groupBy('date')
                        ->orderBy('date')
                        ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'pendingFarmers', 'orderTrend'));
    }
}
