<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $farmer = Auth::user();
        $query  = Review::where('farmer_id', $farmer->id)
                         ->with(['customer', 'product']);

        if ($rating = $request->input('rating')) {
            $query->where('rating', $rating);
        }

        $reviews    = $query->latest()->paginate(15)->withQueryString();
        $avgRating  = Review::where('farmer_id', $farmer->id)->where('status', 'approved')->avg('rating');

        return view('farmer.reviews.index', compact('reviews', 'avgRating'));
    }

    public function reply(Request $request, Review $review)
    {
        abort_unless($review->farmer_id === Auth::id(), 403);

        $data = $request->validate([
            'farmer_reply' => 'required|string|max:1000',
        ]);

        $review->update([
            'farmer_reply'      => $data['farmer_reply'],
            'farmer_replied_at' => now(),
        ]);

        return back()->with('success', 'Reply posted.');
    }
}
