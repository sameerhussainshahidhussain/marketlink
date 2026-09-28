@extends('layouts.app')

@section('title', 'Select Pickup Slots & Confirm | MarketLink')

@section('content')
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('customer.cart') }}">Basket</a></li>
          <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
      </nav>
      <h1 class="display-6 font-serif text-forest mb-1">Schedule Market Pickup</h1>
      <p class="text-muted mb-0">Select your preferred collection time slot for each farmer stall and confirm your reservation.</p>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      @if(isset($errors) && $errors->any())
        <div class="alert alert-danger py-2 rounded-12 small mb-4">
          <ul class="mb-0 ps-3">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('customer.orders.store') }}">
        @csrf
        <div class="row g-4">
          <div class="col-lg-8">
            <h4 class="font-serif text-forest mb-3">Select Pickup Window by Farmer</h4>

            @foreach($farmerGroups as $farmerId => $items)
              @php 
                $firstItem = $items->first(); 
                $slots = $slotsByFarmer[$farmerId] ?? collect();
              @endphp

              <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                  <div>
                    <h5 class="font-serif text-forest mb-0">{{ $firstItem->farmer->farmerProfile->business_name ?? $firstItem->farmer->name }}</h5>
                    <span class="small text-muted">{{ $items->count() }} item(s) • Subtotal: Rs. {{ number_format($items->sum('subtotal'), 2) }}</span>
                  </div>
                </div>

                @if($slots->isEmpty())
                  <div class="alert alert-warning py-2 small rounded-12 mb-0">
                    <i class="bi bi-exclamation-triangle me-1"></i> This farmer does not have any active open pickup slots scheduled currently.
                  </div>
                @else
                  <label class="form-label small fw-bold mb-2">Available Pickup Slots & Markets:</label>
                  <div class="row g-2">
                    @foreach($slots as $slot)
                      <div class="col-md-6">
                        <label class="card p-3 rounded-16 border-subtle bg-light h-100 cursor-pointer hover-shadow slot-option">
                          <div class="d-flex align-items-start gap-2">
                            <input type="radio" name="farmer_slots[{{ $farmerId }}]" value="{{ $slot->id }}" class="form-check-input mt-1" required {{ $loop->first ? 'checked' : '' }}>
                            <div>
                              <strong class="d-block text-forest small">{{ $slot->market->market_name }}</strong>
                              <span class="small text-muted d-block">{{ $slot->pickup_date->format('l, M d, Y') }}</span>
                              <span class="small text-muted"><i class="bi bi-clock me-1 text-gold"></i>{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}</span>
                            </div>
                          </div>
                        </label>
                      </div>
                    @endforeach
                  </div>
                @endif
              </div>
            @endforeach

            <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white mb-4">
              <h5 class="font-serif text-forest mb-2">Collection Notes (Optional)</h5>
              <textarea name="notes" rows="3" class="form-control rounded-16" placeholder="Any special instructions for the farmer upon collection..."></textarea>
            </div>

            <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white">
              <h5 class="font-serif text-forest mb-3">Settlement Method</h5>
              <div class="card p-3 rounded-16 border-forest bg-sage-subtle">
                <div class="form-check d-flex align-items-center gap-2 mb-0">
                  <input class="form-check-input" type="radio" name="payment_method" id="payCash" value="cash_on_pickup" checked>
                  <label class="form-check-label text-forest fw-semibold" for="payCash">
                    <i class="bi bi-cash-coin me-1"></i> Cash / Direct Settlement on Market Pickup
                  </label>
                </div>
                <p class="small text-muted mb-0 ms-4 mt-1">Pay the grower directly at their stall when you inspect and collect your fresh harvest.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card p-4 rounded-28 border-subtle shadow-sm bg-cream sticky-top" style="top: 90px;">
              <h5 class="font-serif text-forest mb-3">Pre-Order Confirmation</h5>
              <div class="d-flex justify-content-between py-2 border-bottom border-subtle small">
                <span class="text-muted">Total Units</span>
                <strong>{{ $cart->item_count }}</strong>
              </div>
              <div class="d-flex justify-content-between py-2 border-bottom border-subtle small">
                <span class="text-muted">Stalls to Collect From</span>
                <strong>{{ $farmerGroups->count() }}</strong>
              </div>
              <div class="d-flex justify-content-between py-3 fs-5 font-serif text-forest">
                <span>Total Due on Pickup</span>
                <span class="fw-bold">Rs. {{ number_format($cart->subtotal, 2) }}</span>
              </div>

              <button type="submit" class="btn btn-forest w-100 py-3 rounded-pill fw-semibold shadow-sm">
                Confirm Pre-Order <i class="bi bi-check2-circle ms-2"></i>
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
@endsection
