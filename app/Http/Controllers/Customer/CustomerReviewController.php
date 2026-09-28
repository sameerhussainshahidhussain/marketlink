<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Order;
use App\Models\Review;
use App\Notifications\NewReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::where('customer_id', Auth::id())
                         ->with(['product', 'farmer.farmerProfile', 'order'])
                         ->latest()
                         ->paginate(12);

        return view('customer.reviews', compact('reviews'));
    }

    public function create(Order $order)
    {
        abort_unless($order->customer_id === Auth::id(), 403);
        abort_unless($order->order_status === Order::STATUS_COMPLETED, 422, 'Can only review completed orders.');

        $order->load(['items.product', 'farmer.farmerProfile']);

        return view('customer.reviews.create', compact('order'));
    }

    public function store(StoreReviewRequest $request, Order $order)
    {
        abort_unless($order->customer_id === Auth::id(), 403);
        abort_unless($order->order_status === Order::STATUS_COMPLETED, 422, 'Can only review completed orders.');

        $alreadyReviewed = Review::where('order_id', $order->id)
                                 ->where('customer_id', Auth::id())
                                 ->where('product_id', $request->product_id)
                                 ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'You have already reviewed this item from this order.');
        }

        $review = Review::create([
            'customer_id' => Auth::id(),
            'farmer_id'   => $order->farmer_id,
            'product_id'  => $request->product_id,
            'order_id'    => $order->id,
            'rating'      => $request->rating,
            'comment'     => $request->comment,
            'status'      => 'pending',
        ]);

        if ($farmer = $order->farmer) {
            $farmer->notify(new NewReviewNotification($review));
        }

        return redirect()->route('customer.orders.show', $order)
                         ->with('success', 'Your review has been submitted for moderation.');
    }
}
