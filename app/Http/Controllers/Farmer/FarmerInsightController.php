<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PickupSlot;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FarmerInsightController extends Controller
{
    public function index()
    {
        $farmerId = Auth::id();

        $completedOrdersQuery = Order::where('farmer_id', $farmerId)->where('order_status', Order::STATUS_COMPLETED);
        $totalRevenue = (clone $completedOrdersQuery)->sum('total_amount');
        $totalCompleted = (clone $completedOrdersQuery)->count();
        $avgOrderValue = $totalCompleted > 0 ? ($totalRevenue / $totalCompleted) : 0;

        $stats = [
            'total_orders'    => Order::where('farmer_id', $farmerId)->count(),
            'pending_orders'  => Order::where('farmer_id', $farmerId)->where('order_status', Order::STATUS_PLACED)->count(),
            'ready_orders'    => Order::where('farmer_id', $farmerId)->where('order_status', Order::STATUS_READY)->count(),
            'total_revenue'   => $totalRevenue,
            'avg_order_value' => $avgOrderValue,
            'avg_rating'      => Review::where('farmer_id', $farmerId)->where('status', 'approved')->avg('rating') ?: 5.0,
        ];

        $bestSellers = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.farmer_id', $farmerId)
            ->where('orders.order_status', Order::STATUS_COMPLETED)
            ->select(
                'order_items.product_name',
                DB::raw('SUM(order_items.quantity) as total_qty'),
                DB::raw('SUM(order_items.subtotal) as total_sales')
            )
            ->groupBy('order_items.product_id', 'order_items.product_name')
            ->orderByDesc('total_sales')
            ->take(6)
            ->get();

        $monthlySales = DB::table('orders')
            ->where('farmer_id', $farmerId)
            ->where('order_status', Order::STATUS_COMPLETED)
            ->where('created_at', '>=', now()->subMonths(6)->startOfMonth())
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
                DB::raw('SUM(total_amount) as revenue'),
                DB::raw('COUNT(*) as orders_count')
            )
            ->groupBy('month')
            ->orderByRaw('MIN(created_at)')
            ->get();

        $upcomingSlots = PickupSlot::where('farmer_id', $farmerId)
            ->where('pickup_date', '>=', now()->toDateString())
            ->with('market')
            ->orderBy('pickup_date')
            ->take(5)
            ->get();

        return view('farmer.insights', compact('stats', 'bestSellers', 'monthlySales', 'upcomingSlots'));
    }
}
