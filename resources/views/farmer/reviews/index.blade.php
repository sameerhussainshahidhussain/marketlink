@extends('layouts.dashboard')

@section('title', 'Customer Reviews | MarketLink Farmer')
@section('page_title', 'Customer Feedback & Reviews')
@section('page_subtitle', 'Verified reviews from customers who picked up fresh produce at your stall')

@section('sidebar')
  @include('partials.farmer-sidebar')
@endsection

@section('content')
  <div class="row g-4 mb-4">
    
    <div class="col-lg-4">
      <div class="card p-4 rounded-24 border-subtle bg-white text-center shadow-xs mb-4">
        <span class="badge bg-forest text-gold small rounded-pill px-3 py-2 mb-3">Overall Stall Rating</span>
        <div class="display-3 fw-bold text-forest mb-1">{{ number_format($avgRating ?? 5.0, 1) }}</div>
        <div class="text-gold mb-2 fs-5">
          @php $r = round($avgRating ?? 5.0); @endphp
          @for($i = 1; $i <= 5; $i++)
            <i class="bi bi-star{{ $i <= $r ? '-fill' : '' }}"></i>
          @endfor
        </div>
        <p class="small text-muted mb-0">{{ $reviews->total() }} Verified Customer Reviews</p>
      </div>

      <div class="card p-3 rounded-20 border-subtle bg-white shadow-xs">
        <h6 class="fw-bold font-serif mb-2 text-forest">Filter by Rating</h6>
        <div class="d-flex flex-wrap gap-2">
          <a href="{{ route('farmer.reviews.index') }}" class="btn btn-sm {{ !request('rating') ? 'btn-forest' : 'btn-outline-secondary' }} rounded-pill">All</a>
          @for($star = 5; $star >= 1; $star--)
            <a href="{{ route('farmer.reviews.index', ['rating' => $star]) }}" class="btn btn-sm {{ request('rating') == $star ? 'btn-forest' : 'btn-outline-secondary' }} rounded-pill">
              {{ $star }} ★
            </a>
          @endfor
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card rounded-24 border-subtle shadow-xs bg-white overflow-hidden">
        <div class="p-4 border-bottom d-flex align-items-center justify-content-between">
          <h5 class="font-serif mb-0 fw-bold">Recent Customer Feedback</h5>
          <span class="badge bg-light text-forest border rounded-pill px-3">{{ $reviews->total() }} total</span>
        </div>
        <div class="p-4">
          @forelse($reviews as $rev)
            <div class="p-4 border rounded-20 mb-3 bg-white shadow-xs">
              <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap gap-2">
                <div>
                  <strong class="d-block text-forest fs-6">{{ $rev->customer->name ?? 'Verified Customer' }}</strong>
                  <span class="small text-muted">
                    {{ $rev->product->name ?? 'Produce' }} &bull; {{ $rev->created_at->diffForHumans() }}
                  </span>
                </div>
                <div class="text-gold small">
                  @for($i = 1; $i <= 5; $i++)
                    <i class="bi bi-star{{ $i <= $rev->rating ? '-fill' : '' }}"></i>
                  @endfor
                </div>
              </div>

              <p class="text-muted small mb-3" style="line-height: 1.6;">"{{ $rev->comment }}"</p>

              @if($rev->farmer_reply)
                
                <div class="p-3 bg-light rounded-16 border-subtle small mb-2">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <strong class="text-forest"><i class="bi bi-reply-fill text-forest me-1"></i> Your Reply:</strong>
                    <span class="text-muted" style="font-size: 0.75rem;">{{ $rev->farmer_replied_at ? \Carbon\Carbon::parse($rev->farmer_replied_at)->format('M d, Y') : '' }}</span>
                  </div>
                  <span class="text-muted">{{ $rev->farmer_reply }}</span>
                </div>
              @else
                
                <div class="mt-2">
                  <button class="btn btn-sm btn-outline-forest rounded-pill px-3" type="button" data-bs-toggle="collapse" data-bs-target="#replyForm{{ $rev->id }}">
                    <i class="bi bi-reply me-1"></i> Respond to Review
                  </button>
                  <div class="collapse mt-3" id="replyForm{{ $rev->id }}">
                    <form method="POST" action="{{ route('farmer.reviews.reply', $rev->id) }}" class="card card-body rounded-16 border bg-light">
                      @csrf
                      <label class="form-label small fw-bold text-forest">Public Stall Reply</label>
                      <textarea name="farmer_reply" class="form-control rounded-12 mb-2" rows="2" placeholder="Thank the customer or address feedback..." required></textarea>
                      <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" data-bs-toggle="collapse" data-bs-target="#replyForm{{ $rev->id }}">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-forest rounded-pill px-3">Post Reply</button>
                      </div>
                    </form>
                  </div>
                </div>
              @endif
            </div>
          @empty
            <div class="text-center py-5 text-muted">
              <i class="bi bi-chat-heart display-4 text-forest-subtle d-block mb-3"></i>
              <h6>No reviews received yet</h6>
              <p class="small text-muted mb-0">Customer reviews will appear here once orders are picked up and completed.</p>
            </div>
          @endforelse

          @if($reviews->hasPages())
            <div class="mt-4 d-flex justify-content-center">
              {{ $reviews->links() }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
