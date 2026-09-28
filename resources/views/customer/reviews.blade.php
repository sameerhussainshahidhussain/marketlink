@extends('layouts.dashboard')

@section('title', 'My Reviews & Ratings | MarketLink')
@section('page_title', 'Producer Reviews & Feedback')
@section('page_subtitle', 'Feedback you have provided to local organic growers')

@section('sidebar')
  @include('partials.customer-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('customer.orders') }}" class="btn btn-sm btn-forest rounded-pill px-3">
    <i class="bi bi-receipt me-1"></i> Review Completed Orders
  </a>
@endsection

@section('content')
  <div class="card rounded-24 border-subtle shadow-xs bg-white overflow-hidden">
    <div class="card-header bg-white border-bottom border-subtle py-3 px-4 d-flex justify-content-between align-items-center">
      <h6 class="font-serif mb-0"><i class="bi bi-star-half text-forest me-2"></i>My Reviews ({{ $reviews->total() }})</h6>
      <span class="small text-muted">Helping community growers flourish</span>
    </div>

    <div class="card-body p-4">
      <div class="row g-4">
        @forelse($reviews as $review)
          <div class="col-12">
            <div class="p-4 border rounded-20 bg-white shadow-xs">
              <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-2 mb-3">
                <div class="d-flex align-items-center gap-3">
                  <div class="rounded-circle p-2 bg-sage text-forest d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="bi bi-shop fs-5"></i>
                  </div>
                  <div>
                    <h6 class="font-serif mb-0">
                      {{ $review->farmer->farmerProfile->business_name ?? $review->farmer->name }}
                    </h6>
                    <span class="small text-muted">
                      @if($review->product)
                        Item: <a href="{{ route('products.show', $review->product) }}" class="text-forest text-decoration-none fw-semibold">{{ $review->product->name }}</a> &bull;
                      @endif
                      Order #{{ $review->order->order_number ?? $review->order_id }}
                    </span>
                  </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                  <div class="text-gold fs-6">
                    @for($i = 1; $i <= 5; $i++)
                      <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                    @endfor
                  </div>
                  @if($review->status === 'approved')
                    <span class="badge bg-success-subtle text-success small rounded-pill px-2 py-1">Published</span>
                  @elseif($review->status === 'pending')
                    <span class="badge bg-warning-subtle text-warning small rounded-pill px-2 py-1">Under Review</span>
                  @else
                    <span class="badge bg-danger-subtle text-danger small rounded-pill px-2 py-1">Declined</span>
                  @endif
                </div>
              </div>

              <p class="text-dark mb-2 fs-6">{{ $review->comment }}</p>
              <div class="small text-muted mb-3"><i class="bi bi-clock me-1"></i>Reviewed {{ $review->created_at->format('M d, Y') }}</div>

              @if($review->farmer_reply)
                <div class="p-3 rounded-16 bg-cream border-start border-forest border-3 mt-3">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <span class="small fw-bold text-forest">
                      <i class="bi bi-reply-fill me-1"></i> Grower Reply &bull; {{ $review->farmer->farmerProfile->business_name ?? $review->farmer->name }}
                    </span>
                    @if($review->replied_at)
                      <span class="small text-muted">{{ \Carbon\Carbon::parse($review->replied_at)->format('M d, Y') }}</span>
                    @endif
                  </div>
                  <p class="small text-muted mb-0">{{ $review->farmer_reply }}</p>
                </div>
              @endif
            </div>
          </div>
        @empty
          <div class="col-12 py-5 text-center text-muted">
            <i class="bi bi-chat-square-quote fs-1 text-muted d-block mb-3"></i>
            <h6 class="font-serif text-muted">No reviews submitted yet</h6>
            <p class="small text-muted mb-3">After picking up your pre-orders, you can leave ratings and feedback for your farmers!</p>
            <a href="{{ route('customer.orders') }}" class="btn btn-sm btn-outline-forest rounded-pill px-4">View My Orders</a>
          </div>
        @endforelse
      </div>

      @if($reviews->hasPages())
        <div class="mt-4 d-flex justify-content-center">
          {{ $reviews->links() }}
        </div>
      @endif
    </div>
  </div>
@endsection
