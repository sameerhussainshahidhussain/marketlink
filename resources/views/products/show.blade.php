@extends('layouts.app')

@section('title', $product->name . ' | MarketLink')

@section('content')
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
      </nav>

      <div class="row g-5">
        
        <div class="col-lg-6">
          <div class="card p-2 rounded-32 border-subtle shadow-sm bg-white overflow-hidden">
            <img src="{{ $product->image_url }}" class="rounded-24 w-100 object-fit-cover" style="max-height: 420px;" alt="{{ $product->name }}">
          </div>
        </div>

        <div class="col-lg-6">
          <span class="badge bg-forest text-white rounded-pill px-3 py-2 mb-2">{{ $product->category->name ?? 'Organic Harvest' }}</span>
          <h1 class="display-6 font-serif text-forest mb-2">{{ $product->name }}</h1>
          <p class="text-muted mb-3">{{ $product->description ?? 'Cultivated according to strict organic and chemical-free agricultural practices. Freshly picked before market pickup.' }}</p>

          <div class="display-6 font-serif text-forest mb-4">
            Rs. {{ number_format($product->price, 2) }} <span class="fs-6 text-muted font-sans">/ {{ $product->unit }}</span>
          </div>

          <div class="card p-3 rounded-20 border-subtle bg-white mb-4">
            <div class="d-flex align-items-center gap-3">
              <i class="bi bi-shop text-forest fs-3"></i>
              <div>
                <strong class="d-block text-forest">{{ $product->farmer->farmerProfile->business_name ?? $product->farmer->name }}</strong>
                <span class="small text-muted">Stock Available: <strong>{{ $product->stock_quantity }} {{ $product->unit }}s</strong></span>
              </div>
              <a href="{{ route('farmers.show', $product->farmer) }}" class="btn btn-sm btn-outline-forest rounded-pill ms-auto">Farmer Profile</a>
            </div>
          </div>

          @if(session('success'))
            <div class="alert alert-success py-2 rounded-12 small mb-3">{{ session('success') }}</div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger py-2 rounded-12 small mb-3">{{ session('error') }}</div>
          @endif

          @auth
            @if(auth()->user()->isCustomer())
              <form method="POST" action="{{ route('customer.cart.add') }}" class="d-flex gap-3 align-items-center">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="input-group" style="width: 140px;">
                  <button type="button" class="btn btn-outline-secondary" onclick="let q = document.getElementById('qtyInput'); if(q.value > 1) q.value--;">-</button>
                  <input type="number" id="qtyInput" name="quantity" class="form-control text-center" value="1" min="1" max="{{ $product->stock_quantity }}">
                  <button type="button" class="btn btn-outline-secondary" onclick="let q = document.getElementById('qtyInput'); if(q.value < {{ $product->stock_quantity }}) q.value++;">+</button>
                </div>
                <button type="submit" class="btn btn-forest rounded-pill px-4 py-2 flex-grow-1 shadow-sm">
                  <i class="bi bi-basket3 me-2"></i>Add to Pickup Basket
                </button>
              </form>
            @else
              <div class="alert alert-info py-2 rounded-12 small">
                You are signed in as a {{ auth()->user()->role }}. Switch to a customer account to reserve produce.
              </div>
            @endif
          @else
            <a href="{{ route('login') }}" class="btn btn-forest rounded-pill px-4 py-3 w-100 shadow-sm">
              Sign In to Reserve / Add to Basket <i class="bi bi-arrow-right ms-2"></i>
            </a>
          @endauth

        </div>
      </div>
    </div>
  </section>

  @if($related->isNotEmpty())
    <section class="py-5">
      <div class="container">
        <h4 class="font-serif text-forest mb-4">Other Produce in {{ $product->category->name }}</h4>
        <div class="row g-3">
          @foreach($related as $rel)
            <div class="col-md-3">
              <div class="card p-3 rounded-20 border-subtle shadow-xs bg-white h-100">
                <img src="{{ $rel->image_url }}" class="rounded-16 w-100 object-fit-cover mb-2" height="140" alt="{{ $rel->name }}">
                <h6 class="font-serif mb-1"><a href="{{ route('products.show', $rel) }}" class="text-forest text-decoration-none">{{ $rel->name }}</a></h6>
                <p class="small text-forest fw-bold mb-2">Rs. {{ $rel->price }} / {{ $rel->unit }}</p>
                <a href="{{ route('products.show', $rel) }}" class="btn btn-sm btn-outline-forest rounded-pill w-100">View</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
@endsection
