@extends('layouts.app')

@section('title', 'Review Farmer | MarketLink')

@section('content')
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('customer.orders') }}">My Orders</a></li>
          <li class="breadcrumb-item active" aria-current="page">Review</li>
        </ol>
      </nav>
      <h1 class="display-6 font-serif text-forest mb-1">Review Your Experience</h1>
      <p class="text-muted mb-0">Share feedback on produce freshness, pickup ease, and quality from {{ $order->farmer->farmerProfile->business_name ?? $order->farmer->name }}.</p>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
          <div class="card p-4 p-md-5 rounded-32 border-subtle shadow-sm bg-white">
            <form method="POST" action="{{ route('customer.reviews.store', $order) }}">
              @csrf

              <div class="text-center mb-4">
                <label class="form-label small fw-bold d-block mb-2">Rate Your Experience</label>
                <div class="d-flex justify-content-center gap-3 fs-3 text-gold">
                  @for($i = 1; $i <= 5; $i++)
                    <label class="cursor-pointer">
                      <input type="radio" name="rating" value="{{ $i }}" class="d-none" required {{ $i == 5 ? 'checked' : '' }} onchange="updateStars(this.value)">
                      <i class="bi bi-star-fill star-icon" data-value="{{ $i }}"></i>
                    </label>
                  @endfor
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold">Review Specific Produce (Optional)</label>
                <select name="product_id" class="form-select rounded-12">
                  <option value="">Whole Order Experience</option>
                  @foreach($order->items as $item)
                    <option value="{{ $item->product_id }}">{{ $item->product_name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-4">
                <label class="form-label small fw-bold">Your Review & Comments</label>
                <textarea name="comment" rows="4" class="form-control rounded-16" placeholder="How fresh was the produce? Was pickup smooth and friendly?"></textarea>
              </div>

              <button type="submit" class="btn btn-forest w-100 py-3 rounded-pill fw-semibold shadow-sm">
                Submit Review <i class="bi bi-arrow-right ms-2"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    function updateStars(val) {
      document.querySelectorAll('.star-icon').forEach(icon => {
        const itemVal = parseInt(icon.getAttribute('data-value'));
        if (itemVal <= val) {
          icon.className = 'bi bi-star-fill star-icon text-gold';
        } else {
          icon.className = 'bi bi-star star-icon text-muted';
        }
      });
    }
  </script>
@endsection
