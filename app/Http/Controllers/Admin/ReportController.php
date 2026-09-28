<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to', now()->toDateString());

        $revenueByFarmer = Order::where('order_status', 'completed')
            ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->select(
                'farmer_id',
                DB::raw('SUM(total_amount) as revenue'),
                DB::raw('COUNT(*) as orders')
            )
            ->groupBy('farmer_id')
            ->with('farmer.farmerProfile')
            ->orderByDesc('revenue')
            ->take(10)
            ->get();

        $ordersByStatus = Order::whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->select('order_status', DB::raw('COUNT(*) as total'))
            ->groupBy('order_status')
            ->pluck('total', 'order_status');

        $topProducts = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween(DB::raw('DATE(orders.created_at)'), [$from, $to])
            ->where('orders.order_status', 'completed')
            ->select(
                'order_items.product_name',
                DB::raw('SUM(order_items.quantity) as qty_sold'),
                DB::raw('SUM(order_items.subtotal) as revenue')
            )
            ->groupBy('order_items.product_id', 'order_items.product_name')
            ->orderByDesc('revenue')
            ->take(10)
            ->get();

        $dailyRevenue = Order::where('order_status', 'completed')
            ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as revenue')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.reports.index', compact(
            'revenueByFarmer',
            'ordersByStatus',
            'topProducts',
            'dailyRevenue',
            'from',
            'to'
        ));
    }

    public function export(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to', now()->toDateString());

        $orders = Order::with(['customer', 'farmer', 'market', 'items'])
            ->whereBetween(DB::raw('DATE(created_at)'), [$from, $to])
            ->where('order_status', 'completed')
            ->get();

        $csv = "Order Number,Customer,Farmer,Market,Pickup Date,Total,Status\n";

        foreach ($orders as $order) {
            $marketName  = $order->market ? $order->market->market_name : '';
            $csv .= "\"{$order->order_number}\",\"{$order->customer->name}\",\"{$order->farmer->name}\",\"{$marketName}\",\"{$order->pickup_date}\",\"{$order->total_amount}\",\"{$order->order_status}\"\n";
        }

        $filename = "orders-{$from}-to-{$to}.csv";

        return response($csv, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
