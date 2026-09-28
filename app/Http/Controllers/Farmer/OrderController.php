<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\OrderStatusUpdatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $farmer = Auth::user();
        $query  = Order::forFarmer($farmer->id)->with(['customer', 'market', 'pickupSlot']);

        $status = $request->input('status');
        if ($status) {
            $query->where('order_status', $status);
        }

        $date = $request->input('date');
        if ($date) {
            $query->whereDate('pickup_date', $date);
        }

        $orders = $query->latest()->paginate(15)->withQueryString();

        $statusCounts = Order::forFarmer($farmer->id)
            ->select('order_status', DB::raw('count(*) as count'))
            ->groupBy('order_status')
            ->pluck('count', 'order_status');

        return view('farmer.orders.index', compact('orders', 'statusCounts'));
    }

    public function show(Order $order)
    {
        if ($order->farmer_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['customer', 'market', 'pickupSlot', 'items.product']);

        return view('farmer.orders.show', compact('order'));
    }

    public function accept(Order $order)
    {
        $this->authorizeAndTransition($order, Order::STATUS_ACCEPTED);
        return back()->with('success', 'Order accepted successfully. Customer notified.');
    }

    public function decline(Request $request, Order $order)
    {
        $this->authorizeAndTransition($order, Order::STATUS_DECLINED);
        $this->restoreStock($order);
        return back()->with('success', 'Order declined and stock restored.');
    }

    public function markReady(Order $order)
    {
        $this->authorizeAndTransition($order, Order::STATUS_READY);
        return back()->with('success', 'Order marked ready for pickup. Customer notified.');
    }

    public function complete(Order $order)
    {
        $this->authorizeAndTransition($order, Order::STATUS_COMPLETED);
        return back()->with('success', 'Order marked as completed.');
    }

    protected function authorizeAndTransition(Order $order, string $newStatus): void
    {
        if ($order->farmer_id !== Auth::id()) {
            abort(403);
        }

        if (!$order->canTransitionTo($newStatus)) {
            abort(422, "Cannot transition from {$order->order_status} to {$newStatus}.");
        }

        $order->update(['order_status' => $newStatus]);

        if ($order->customer) {
            $order->customer->notify(new OrderStatusUpdatedNotification($order, $newStatus));
        }
    }

    protected function restoreStock(Order $order): void
    {
        foreach ($order->items as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $product->increment('stock_quantity', $item->quantity);
            }
        }

        if ($order->pickupSlot) {
            $order->pickupSlot->decrement('current_orders');
        }
    }
}
