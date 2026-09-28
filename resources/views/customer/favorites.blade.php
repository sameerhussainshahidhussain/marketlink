@extends('layouts.dashboard')

@section('title', 'Saved Favorites | MarketLink')
@section('page_title', 'Saved Favorites')
@section('page_subtitle', 'Your favorite local growers and fresh harvest items')

@section('sidebar')
  @include('partials.customer-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('products.index') }}" class="btn btn-sm btn-forest rounded-pill px-3">
    <i class="bi bi-search me-1"></i> Browse Marketplace
  </a>
@endsection

@section('content')
  
  <div class="mb-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <div>
        <h5 class="font-serif mb-1"><i class="bi bi-people text-forest me-2"></i>Favorite Growers & Farms</h5>
        <span class="text-muted small">Local producers you follow</span>
      </div>
      <span class="badge bg-sage text-forest rounded-pill px-3 py-2">{{ $favoriteFarmers->count() }} Saved</span>
    </div>

    <div class="row g-4">
      @forelse($favoriteFarmers as $farmer)
        <div class="col-md-6 col-xl-4">
          <div class="card p-3 rounded-20 border-subtle shadow-xs h-100 bg-white d-flex flex-column">
            <div class="d-flex align-items-center gap-3 mb-3">
              <img src="{{ $farmer->profile_image ? asset('storage/' . $farmer->profile_image) : 'https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=200&auto=format&fit=crop&q=80' }}" class="rounded-circle object-fit-cover" style="width:60px; height:60px;" alt="{{ $farmer->name }}">
              <div class="overflow-hidden">
                <h6 class="mb-0 fs-6 text-truncate font-serif">{{ $farmer->farmerProfile->business_name ?? $farmer->name }}</h6>
                <span class="small text-muted d-block text-truncate">{{ $farmer->farmerProfile->location_name ?? 'Local Farm' }}</span>
                <div class="text-gold small"><i class="bi bi-star-fill"></i> 5.0 Verified Organic</div>
              </div>
            </div>
            <p class="small text-muted mb-3 flex-grow-1">
              {{ Str::limit($farmer->farmerProfile->bio ?? 'Dedicated organic farmer committed to sustainable practices.', 90) }}
            </p>
            <div class="mt-auto d-flex gap-2 pt-2 border-top">
              <a href="{{ route('farmers.show', $farmer) }}" class="btn btn-sm btn-forest rounded-pill flex-fill">View Stall & Stock</a>
              <form method="POST" action="{{ route('customer.favorites.farmer', $farmer) }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Remove from favorites"><i class="bi bi-trash"></i></button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="card p-4 rounded-20 border-dashed text-center text-muted bg-white">
            <i class="bi bi-people fs-2 mb-2 text-muted d-block"></i>
            <p class="mb-2">You haven't favorited any farmers yet.</p>
            <a href="{{ route('farmers.index') }}" class="btn btn-sm btn-outline-forest rounded-pill px-4 align-self-center">Explore Farmers</a>
          </div>
        </div>
      @endforelse
    </div>
  </div>

  <div>
    <div class="d-flex align-items-center justify-content-between mb-3">
      <div>
        <h5 class="font-serif mb-1"><i class="bi bi-basket text-forest me-2"></i>Favorite Produce & Goods</h5>
        <span class="text-muted small">Items saved for quick re-ordering</span>
      </div>
      <span class="badge bg-sage text-forest rounded-pill px-3 py-2">{{ $favoriteProducts->count() }} Saved</span>
    </div>

    <div class="row g-4">
      @forelse($favoriteProducts as $product)
        <div class="col-md-6 col-xl-4">
          <div class="card p-3 rounded-20 border-subtle shadow-xs h-100 bg-white d-flex flex-column">
            <div class="d-flex align-items-center gap-3 mb-3">
              <img src="{{ $product->image_url }}" class="rounded-12 object-fit-cover" style="width:60px; height:60px;" alt="{{ $product->name }}">
              <div class="overflow-hidden">
                <h6 class="mb-0 fs-6 text-truncate font-serif">
                  <a href="{{ route('products.show', $product) }}" class="text-forest text-decoration-none">{{ $product->name }}</a>
                </h6>
                <span class="small text-muted fw-semibold">Rs. {{ number_format($product->price, 2) }} / {{ $product->unit }}</span>
                <div>
                  @if($product->stock_quantity > 0)
                    <span class="badge bg-success-subtle text-success small py-0 px-2">In Stock ({{ $product->stock_quantity }})</span>
                  @else
                    <span class="badge bg-danger-subtle text-danger small py-0 px-2">Sold Out</span>
                  @endif
                </div>
              </div>
            </div>
            <p class="small text-muted mb-3 flex-grow-1">
              <i class="bi bi-shop me-1 text-emerald"></i>{{ $product->farmer->farmerProfile->business_name ?? $product->farmer->name }}
            </p>
            <div class="mt-auto d-flex gap-2 pt-2 border-top">
              @if($product->stock_quantity > 0)
                <form method="POST" action="{{ route('customer.cart.add') }}" class="d-inline flex-fill">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="btn btn-sm btn-forest rounded-pill w-100">Add to Basket</button>
                </form>
              @else
                <button class="btn btn-sm btn-secondary rounded-pill flex-fill" disabled>Sold Out</button>
              @endif
              <form method="POST" action="{{ route('customer.favorites.product', $product) }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Remove from favorites"><i class="bi bi-trash"></i></button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="card p-4 rounded-20 border-dashed text-center text-muted bg-white">
            <i class="bi bi-basket fs-2 mb-2 text-muted d-block"></i>
            <p class="mb-2">You haven't saved any products yet.</p>
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-forest rounded-pill px-4 align-self-center">Browse Produce</a>
          </div>
        </div>
      @endforelse
    </div>
  </div>
@endsection
