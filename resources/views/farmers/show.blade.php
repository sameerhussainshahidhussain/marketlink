@extends('layouts.app')

@section('title', ($farmer->farmerProfile->business_name ?? $farmer->name) . ' | MarketLink')

@section('content')
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('farmers.index') }}">Farmers</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $farmer->farmerProfile->business_name ?? $farmer->name }}</li>
        </ol>
      </nav>

      <div class="row align-items-center g-4">
        <div class="col-lg-8 d-flex align-items-center gap-4">
          <img src="{{ $farmer->profile_image ? asset('storage/' . $farmer->profile_image) : 'https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=300&auto=format&fit=crop&q=80' }}" class="rounded-circle object-fit-cover shadow-sm border border-3 border-white" width="100" height="100" alt="{{ $farmer->name }}">
          <div>
            <div class="d-flex align-items-center gap-2 mb-1">
              <h1 class="display-6 font-serif text-forest mb-0">{{ $farmer->farmerProfile->business_name ?? $farmer->name }}</h1>
              <span class="badge bg-forest text-white rounded-pill px-3 py-1 small"><i class="bi bi-patch-check-fill text-gold me-1"></i>Verified Grower</span>
            </div>
            <p class="text-muted mb-2">Grower: <strong>{{ $farmer->name }}</strong> • {{ $farmer->farmerProfile->location_name ?? 'Local Farm' }}</p>
            <div class="d-flex gap-3 small text-muted">
              <span><i class="bi bi-star-fill text-gold me-1"></i>{{ number_format($avgRating ?? 5.0, 1) }} ({{ $reviewCount }} reviews)</span>
              <span><i class="bi bi-basket me-1 text-forest"></i>{{ $products->total() }} Products Listed</span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 text-lg-end">
          @auth
            @if(auth()->user()->isCustomer())
              <form method="POST" action="{{ route('customer.favorites.farmer', $farmer) }}" class="d-inline">
                @csrf
                <button type="submit" class="btn {{ $isFavorited ? 'btn-danger' : 'btn-outline-forest' }} rounded-pill px-4">
                  <i class="bi {{ $isFavorited ? 'bi-heart-fill' : 'bi-heart' }} me-2"></i>{{ $isFavorited ? 'Saved in Favorites' : 'Save Favorite' }}
                </button>
              </form>
            @endif
          @endauth
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8">
          <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white mb-4">
            <h5 class="font-serif text-forest mb-2">About Our Farm & Methods</h5>
            <p class="text-muted mb-0">{{ $farmer->farmerProfile->description ?? 'We are dedicated to sustainable agriculture, offering farm-fresh produce harvested at peak flavor and nutritional value.' }}</p>
          </div>

          <h4 class="font-serif text-forest mb-4">Produce by {{ $farmer->farmerProfile->business_name ?? $farmer->name }}</h4>
          <div class="row g-3 mb-5">
            @forelse($products as $product)
              <div class="col-md-6 col-lg-4">
                <div class="card p-2 rounded-20 border-subtle shadow-xs bg-white h-100 d-flex flex-column">
                  <img src="{{ $product->image_url }}" class="rounded-16 w-100 object-fit-cover mb-2" height="150" alt="{{ $product->name }}">
                  <h6 class="font-serif mb-1"><a href="{{ route('products.show', $product) }}" class="text-forest text-decoration-none">{{ $product->name }}</a></h6>
                  <p class="small text-forest fw-bold mb-2">Rs. {{ $product->price }} / {{ $product->unit }}</p>
                  <div class="mt-auto">
                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-forest rounded-pill w-100">View Details</a>
                  </div>
                </div>
              </div>
            @empty
              <p class="text-muted">No produce listed right now.</p>
            @endforelse
          </div>

          <div class="d-flex justify-content-center">
            {{ $products->links() }}
          </div>

          <div class="mt-5">
            <h4 class="font-serif text-forest mb-3">Customer Reviews ({{ $reviewCount }})</h4>
            @forelse($reviews as $review)
              <div class="card p-3 rounded-20 border-subtle shadow-xs bg-white mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <strong>{{ $review->customer->name }}</strong>
                  <div class="text-gold small">
                    @for($i = 1; $i <= 5; $i++)
                      <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                    @endfor
                  </div>
                </div>
                <p class="small text-muted mb-1">{{ $review->comment }}</p>
                @if($review->farmer_reply)
                  <div class="bg-light p-2 rounded-12 mt-2 border-start border-3 border-forest">
                    <strong class="small text-forest">Farmer Reply:</strong>
                    <p class="small text-muted mb-0">{{ $review->farmer_reply }}</p>
                  </div>
                @endif
              </div>
            @empty
              <p class="small text-muted">No reviews yet for this farmer.</p>
            @endforelse
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card p-4 rounded-24 border-subtle bg-cream sticky-top" style="top:90px;">
            <h5 class="font-serif text-forest mb-3"><i class="bi bi-calendar-check me-2 text-emerald"></i>Pickup Locations & Slots</h5>
            @forelse($upcomingSlots as $slot)
              <div class="card p-3 rounded-16 border-subtle bg-white mb-3 shadow-xs">
                <strong class="text-forest small">{{ $slot->market->market_name }}</strong>
                <p class="small text-muted mb-1"><i class="bi bi-geo-alt me-1"></i>{{ $slot->market->address }}</p>
                <div class="small text-forest mb-1">
                  <i class="bi bi-clock me-1 text-gold"></i>{{ $slot->pickup_date->format('M d, Y') }} ({{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }})
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                  <span class="badge bg-sage text-forest">{{ $slot->max_orders - $slot->current_orders }} orders left</span>
                </div>
              </div>
            @empty
              <p class="small text-muted">No active slots scheduled.</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
