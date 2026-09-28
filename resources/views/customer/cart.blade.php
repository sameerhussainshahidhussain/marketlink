@extends('layouts.app')

@section('title', 'Pre-Order Basket | MarketLink')

@section('content')
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Pickup Basket</li>
        </ol>
      </nav>
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
          <span class="section-tag"><i class="bi bi-basket3"></i> Market Pre-Order</span>
          <h1 class="display-6 font-serif text-forest mb-0">Your Pickup Basket</h1>
        </div>
        @if(!$cart->items->isEmpty())
          <form method="POST" action="{{ route('customer.cart.clear') }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill" onclick="return confirm('Clear entire basket?')">
              <i class="bi bi-trash me-1"></i> Clear Basket
            </button>
          </form>
        @endif
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      @if(session('success'))
        <div class="alert alert-success py-2 rounded-12 small mb-4">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger py-2 rounded-12 small mb-4">{{ session('error') }}</div>
      @endif

      @if($cart->items->isEmpty())
        <div class="card p-5 rounded-32 border-subtle text-center bg-white shadow-sm">
          <div class="mb-3"><i class="bi bi-basket3 text-muted display-3"></i></div>
          <h4 class="font-serif text-forest mb-2">Your Basket is Currently Empty</h4>
          <p class="text-muted mb-4">Explore fresh organic harvests from regional growers and add items for market day pickup.</p>
          <div>
            <a href="{{ route('products.index') }}" class="btn btn-forest rounded-pill px-4 py-2">
              <i class="bi bi-shop me-2"></i> Browse Produce
            </a>
          </div>
        </div>
      @else
        <div class="row g-4">
          <div class="col-lg-8">
            @foreach($farmerGroups as $farmerId => $items)
              @php $firstItem = $items->first(); @endphp
              <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white mb-4">
                <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                  <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-shop text-forest fs-4"></i>
                    <div>
                      <h6 class="font-serif text-forest mb-0">{{ $firstItem->farmer->farmerProfile->business_name ?? $firstItem->farmer->name }}</h6>
                      <span class="small text-muted">Grower: {{ $firstItem->farmer->name }}</span>
                    </div>
                  </div>
                  <span class="badge bg-sage text-forest rounded-pill px-3 py-1">{{ $items->count() }} item(s)</span>
                </div>

                <div class="table-responsive">
                  <table class="table align-middle mb-0">
                    <thead>
                      <tr class="text-muted small">
                        <th>Produce</th>
                        <th>Price</th>
                        <th style="width: 140px;">Quantity</th>
                        <th>Subtotal</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($items as $item)
                        <tr>
                          <td>
                            <div class="d-flex align-items-center gap-3">
                              <img src="{{ $item->product->image_url }}" class="rounded-12 object-fit-cover" width="50" height="50" alt="{{ $item->product->name }}">
                              <div>
                                <strong class="d-block text-forest">{{ $item->product->name }}</strong>
                                <span class="small text-muted">{{ $item->product->category->name ?? 'Harvest' }}</span>
                              </div>
                            </div>
                          </td>
                          <td class="text-forest">Rs. {{ number_format($item->price, 2) }}</td>
                          <td>
                            <form method="POST" action="{{ route('customer.cart.update', $item) }}" class="d-flex align-items-center gap-2">
                              @csrf
                              @method('PUT')
                              <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock_quantity }}" class="form-control form-control-sm text-center rounded-8" style="width: 65px;" onchange="this.form.submit()">
                              <span class="small text-muted">{{ $item->product->unit }}</span>
                            </form>
                          </td>
                          <td class="text-forest fw-bold">Rs. {{ number_format($item->subtotal, 2) }}</td>
                          <td class="text-end">
                            <form method="POST" action="{{ route('customer.cart.remove', $item) }}">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-link text-danger p-0" title="Remove Item"><i class="bi bi-x-circle fs-5"></i></button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            @endforeach
          </div>

          <div class="col-lg-4">
            <div class="card p-4 rounded-28 border-subtle shadow-sm bg-cream sticky-top" style="top: 90px;">
              <h5 class="font-serif text-forest mb-3">Order Summary</h5>
              <div class="d-flex justify-content-between py-2 border-bottom border-subtle small">
                <span class="text-muted">Total Items</span>
                <strong>{{ $cart->item_count }} units</strong>
              </div>
              <div class="d-flex justify-content-between py-2 border-bottom border-subtle small">
                <span class="text-muted">Participating Farmers</span>
                <strong>{{ $farmerGroups->count() }} grower(s)</strong>
              </div>
              <div class="d-flex justify-content-between py-2 border-bottom border-subtle small">
                <span class="text-muted">Collection & Booking Fee</span>
                <strong class="text-emerald">Free (Rs. 0)</strong>
              </div>
              <div class="d-flex justify-content-between py-3 fs-5 font-serif text-forest">
                <span>Estimated Total</span>
                <span class="fw-bold">Rs. {{ number_format($cart->subtotal, 2) }}</span>
              </div>

              <div class="alert alert-light border small rounded-16 p-2 mb-3">
                <i class="bi bi-info-circle text-forest me-1"></i> No online payment required! Payment is settled in cash or in-person upon pickup at the stall.
              </div>

              <a href="{{ route('customer.checkout') }}" class="btn btn-forest w-100 py-3 rounded-pill fw-semibold shadow-sm">
                Proceed to Slot Booking <i class="bi bi-arrow-right ms-2"></i>
              </a>
            </div>
          </div>
        </div>
      @endif
    </div>
  </section>
@endsection
