@extends('layouts.app')

@section('title', 'Browse Farm Fresh Produce | MarketLink')

@section('content')
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
      </nav>
      <div class="row align-items-center g-4">
        <div class="col-lg-7">
          <span class="section-tag"><i class="bi bi-basket"></i> Farm-to-Table Marketplace</span>
          <h1 class="display-6 font-serif">Harvest-Fresh Seasonal Organic Produce</h1>
          <p class="text-muted mb-0">Reserve crisp vegetables, orchard fruits, free-range eggs, and raw honey directly from local producers.</p>
        </div>
        <div class="col-lg-5">
          <form method="GET" action="{{ route('products.index') }}" class="card p-3 rounded-24 border-subtle shadow-sm bg-white">
            <div class="input-group">
              <span class="input-group-text bg-transparent border-0 text-muted"><i class="bi bi-search"></i></span>
              <input type="text" name="search" class="form-control border-0 shadow-none" value="{{ request('search') }}" placeholder="Search products, vegetables, fruits...">
              <button class="btn btn-forest rounded-pill px-4">Search</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      
      <div class="d-flex gap-2 overflow-auto pb-3 mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-sm {{ !request('category') ? 'btn-forest' : 'btn-outline-forest' }} rounded-pill text-nowrap">All Harvests</a>
        @foreach($categories as $cat)
          <a href="{{ route('products.index', ['category' => $cat->id]) }}" class="btn btn-sm {{ request('category') == $cat->id ? 'btn-forest' : 'btn-outline-forest' }} rounded-pill text-nowrap">{{ $cat->name }}</a>
        @endforeach
      </div>

      <div class="row g-4">
        @forelse($products as $product)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card p-3 rounded-24 border-subtle shadow-xs bg-white h-100 d-flex flex-column">
              <div class="position-relative mb-2">
                <img src="{{ $product->image_url }}" class="rounded-16 w-100 object-fit-cover" height="170" alt="{{ $product->name }}">
                <span class="badge bg-forest position-absolute top-0 end-0 m-2 rounded-pill shadow-xs">Rs. {{ $product->price }} / {{ $product->unit }}</span>
              </div>
              <span class="badge bg-sage text-forest rounded-pill align-self-start mb-1 px-2 py-1 small">{{ $product->category->name ?? 'Produce' }}</span>
              <h6 class="font-serif fs-6 mb-1"><a href="{{ route('products.show', $product) }}" class="text-forest text-decoration-none">{{ $product->name }}</a></h6>
              <p class="small text-muted mb-2"><i class="bi bi-shop me-1 text-emerald"></i>{{ $product->farmer->farmerProfile->business_name ?? $product->farmer->name }}</p>
              
              <div class="mt-auto pt-2 d-flex gap-2">
                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-forest flex-fill rounded-pill">Details</a>
                @auth
                  @if(auth()->user()->isCustomer())
                    <form method="POST" action="{{ route('customer.cart.add') }}" class="d-inline">
                      @csrf
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                      <input type="hidden" name="quantity" value="1">
                      <button type="submit" class="btn btn-sm btn-forest rounded-pill px-3" title="Add 1 to Cart"><i class="bi bi-cart-plus"></i></button>
                    </form>
                  @endif
                @endauth
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center py-5">
            <i class="bi bi-basket text-muted fs-1 mb-3 d-block"></i>
            <h5 class="font-serif text-muted">No products found matching your search</h5>
            <a href="{{ route('products.index') }}" class="btn btn-outline-forest rounded-pill mt-3">Reset Filters</a>
          </div>
        @endforelse
      </div>

      <div class="mt-5 d-flex justify-content-center">
        {{ $products->links() }}
      </div>
    </div>
  </section>
@endsection
