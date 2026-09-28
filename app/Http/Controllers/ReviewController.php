<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Order $order)
    {
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        if ($order->order_status !== 'completed') {
            abort(422, 'Only completed orders can be reviewed.');
        }

        $alreadyReviewed = $order->reviews()
                                  ->where('customer_id', Auth::id())
                                  ->exists();

        if ($alreadyReviewed) {
            return redirect()->route('customer.orders.show', $order)
                             ->with('error', 'You have already reviewed this order.');
        }

        $order->load(['items.product', 'farmer.farmerProfile']);

        return view('customer.reviews.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        if ($order->customer_id !== Auth::id()) {
            abort(403);
        }

        if ($order->order_status !== 'completed') {
            abort(422, 'Order must be completed to leave a review.');
        }

        $data = $request->validate([
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
            'product_id' => 'nullable|exists:products,id',
        ]);

        Review::create([
            'customer_id' => Auth::id(),
            'farmer_id'   => $order->farmer_id,
            'product_id'  => $data['product_id'] ?? null,
            'order_id'    => $order->id,
            'rating'      => $data['rating'],
            'comment'     => $data['comment'] ?? null,
            'status'      => 'pending',
        ]);

        return redirect()->route('customer.orders.show', $order)
                         ->with('success', 'Thank you! Your review was submitted for approval.');
    }
}
