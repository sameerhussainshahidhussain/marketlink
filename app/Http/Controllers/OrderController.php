<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PickupSlot;
use App\Models\Product;
use App\Models\User;
use App\Notifications\OrderPlacedNotification;
use App\Notifications\OrderStatusUpdatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = Cart::where('customer_id', Auth::id())
                    ->with(['items.product.farmer', 'items.farmer.farmerProfile'])
                    ->firstOrFail();

        if ($cart->items->isEmpty()) {
            return redirect()->route('customer.cart')->with('error', 'Your cart is empty.');
        }

        $farmerGroups = $cart->items->groupBy('farmer_id');

        $slotsByFarmer = [];
        foreach ($farmerGroups->keys() as $farmerId) {
            $slotsByFarmer[$farmerId] = PickupSlot::available()
                ->where('farmer_id', $farmerId)
                ->where('pickup_date', '>=', now()->toDateString())
                ->with('market')
                ->orderBy('pickup_date')
                ->get();
        }

        return view('customer.checkout', compact('cart', 'farmerGroups', 'slotsByFarmer'));
    }

    public function store(PlaceOrderRequest $request)
    {
        $cart = Cart::where('customer_id', Auth::id())
                    ->with(['items.product.farmer'])
                    ->firstOrFail();

        if ($cart->items->isEmpty()) {
            abort(422, 'Your cart is empty.');
        }

        DB::transaction(function () use ($request, $cart) {
            $farmerGroups = $cart->items->groupBy('farmer_id');

            foreach ($farmerGroups as $farmerId => $items) {
                $slotId = $request->input("farmer_slots.{$farmerId}");
                $slot   = PickupSlot::lockForUpdate()->findOrFail($slotId);

                if (!$slot->isBookable()) {
                    abort(422, 'Selected pickup slot is no longer available or cutoff has passed.');
                }

                if ($slot->farmer_id !== (int) $farmerId) {
                    abort(403, 'Invalid farmer slot combination.');
                }

                foreach ($items as $cartItem) {
                    $product = Product::lockForUpdate()->findOrFail($cartItem->product_id);

                    if ($product->stock_quantity < $cartItem->quantity) {
                        abort(422, "Insufficient stock for '{$product->name}'. Available: {$product->stock_quantity}.");
                    }

                    if (!$product->isOrderable()) {
                        abort(422, "Product '{$product->name}' is currently unavailable.");
                    }
                }

                $subtotal = $items->sum(fn($i) => $i->price * $i->quantity);

                $order = Order::create([
                    'order_number'      => Order::generateOrderNumber(),
                    'customer_id'       => Auth::id(),
                    'farmer_id'         => $farmerId,
                    'market_id'         => $slot->market_id,
                    'pickup_slot_id'    => $slot->id,
                    'pickup_date'       => $slot->pickup_date,
                    'pickup_start_time' => $slot->start_time,
                    'pickup_end_time'   => $slot->end_time,
                    'cutoff_time'       => $slot->cutoff_time,
                    'subtotal'          => $subtotal,
                    'total_amount'      => $subtotal,
                    'payment_method'    => $request->payment_method ?? 'cash_on_pickup',
                    'order_status'      => Order::STATUS_PLACED,
                    'notes'             => $request->notes,
                ]);

                foreach ($items as $cartItem) {
                    $order->items()->create([
                        'product_id'   => $cartItem->product_id,
                        'product_name' => $cartItem->product->name,
                        'price'        => $cartItem->price,
                        'quantity'     => $cartItem->quantity,
                        'subtotal'     => $cartItem->price * $cartItem->quantity,
                    ]);

                    $cartItem->product->decrement('stock_quantity', $cartItem->quantity);
                }

                $slot->increment('current_orders');

                $farmerUser = User::find($farmerId);
                if ($farmerUser) {
                    $farmerUser->notify(new OrderPlacedNotification($order));
                }
            }

            $cart->items()->delete();
        });

        return redirect()
            ->route('customer.orders')
            ->with('success', 'Your pre-order has been placed successfully! Settle payment in person when picking up.');
    }

    public function customerIndex(Request $request)
    {
        $query = Order::forCustomer(Auth::id())
                      ->with(['farmer.farmerProfile', 'market', 'pickupSlot', 'items.product']);

        $status = $request->input('status');
        if ($status) {
            $query->where('order_status', $status);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        $statusCounts = Order::forCustomer(Auth::id())
            ->select('order_status', DB::raw('count(*) as count'))
            ->groupBy('order_status')
            ->pluck('count', 'order_status');

        return view('customer.orders.index', compact('orders', 'statusCounts'));
    }

    public function customerShow(Order $order)
    {
        abort_unless($order->customer_id === Auth::id(), 403);

        $order->load(['items.product', 'farmer.farmerProfile', 'market', 'pickupSlot', 'reviews']);

        return view('customer.orders.show', compact('order'));
    }

    public function cancel(Request $request, Order $order)
    {
        abort_unless($order->customer_id === Auth::id(), 403);
        abort_unless($order->isCancellable(), 422, 'Order cannot be cancelled at this stage or cutoff deadline has passed.');

        DB::transaction(function () use ($order) {
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stock_quantity', $item->quantity);
                }
            }

            if ($order->pickupSlot) {
                $order->pickupSlot->decrement('current_orders');
            }

            $order->update(['order_status' => Order::STATUS_CANCELLED]);

            if ($order->farmer) {
                $order->farmer->notify(
                    new OrderStatusUpdatedNotification($order, Order::STATUS_CANCELLED)
                );
            }
        });

        return back()->with('success', 'Order cancelled and produce stock restored.');
    }

    public function reorder(Order $order)
    {
        abort_unless($order->customer_id === Auth::id(), 403);

        $cart = Cart::firstOrCreate(['customer_id' => Auth::id()]);
        $addedCount = 0;

        foreach ($order->items as $item) {
            $product = Product::find($item->product_id);

            if (!$product || !$product->isOrderable() || $product->stock_quantity < $item->quantity) {
                continue;
            }

            $existing = $cart->items()->where('product_id', $product->id)->first();

            if ($existing) {
                $newQty = min($existing->quantity + $item->quantity, $product->stock_quantity);
                $existing->update(['quantity' => $newQty, 'price' => $product->price]);
            } else {
                $cart->items()->create([
                    'product_id' => $product->id,
                    'farmer_id'  => $product->farmer_id,
                    'quantity'   => $item->quantity,
                    'price'      => $product->price,
                ]);
            }

            $addedCount++;
        }

        if ($addedCount > 0) {
            return redirect()
                ->route('customer.cart')
                ->with('success', "{$addedCount} item(s) from order #{$order->order_number} re-added to your pickup basket!");
        }

        return back()->with('error', 'Items from this order are currently out of stock or unavailable.');
    }
}
