<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'farmer.farmerProfile', 'market']);

        if ($status = $request->input('status')) {
            $query->where('order_status', $status);
        }
        if ($search = $request->input('search')) {
            $query->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', fn($q) => $q->where('name', 'like', "%{$search}%"));
        }
        if ($date = $request->input('date')) {
            $query->whereDate('pickup_date', $date);
        }

        $orders = $query->latest()->paginate(20)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'farmer.farmerProfile', 'market', 'pickupSlot', 'items.product', 'reviews.customer']);
        return view('admin.orders.show', compact('order'));
    }
}
