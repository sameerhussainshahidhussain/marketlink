@extends('layouts.app')

@section('title', $market->market_name . ' | MarketLink')

@section('content')
  
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('markets.index') }}">Markets</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $market->market_name }}</li>
        </ol>
      </nav>

      <div class="row align-items-center g-4">
        <div class="col-lg-8">
          <span class="badge bg-forest text-white rounded-pill px-3 py-2 mb-2"><i class="bi bi-check-circle me-1"></i> Certified Farmers Market</span>
          <h1 class="display-5 font-serif text-forest mb-2">{{ $market->market_name }}</h1>
          <p class="text-muted lead mb-3">{{ $market->description }}</p>
          <div class="d-flex flex-wrap gap-4 text-forest small">
            <div><i class="bi bi-geo-alt-fill text-emerald me-1"></i> {{ $market->address }}, {{ $market->city }}</div>
            <div><i class="bi bi-calendar-event-fill text-emerald me-1"></i> Days: {{ $market->operating_days }}</div>
            <div><i class="bi bi-clock-fill text-gold me-1"></i> {{ date('h:i A', strtotime($market->opening_time)) }} - {{ date('h:i A', strtotime($market->closing_time)) }}</div>
          </div>
        </div>
        <div class="col-lg-4 text-lg-end">
          <div class="card p-3 rounded-24 border-subtle shadow-sm bg-white text-center">
            <h6 class="font-serif text-forest mb-1">Pickups Available</h6>
            <p class="small text-muted mb-3">{{ $upcomingSlots->count() }} active farmer pickup slots upcoming</p>
            <a href="#pickupSlots" class="btn btn-forest rounded-pill w-100">Browse Pickup Slots</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        
        <div class="col-lg-8">
          <h3 class="font-serif text-forest mb-4">Farmers At This Market ({{ $market->farmers->count() }})</h3>
          <div class="row g-3 mb-5">
            @forelse($market->farmers as $farmer)
              <div class="col-md-6">
                <div class="card p-3 rounded-20 border-subtle shadow-xs bg-white h-100">
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ $farmer->profile_image ? asset('storage/' . $farmer->profile_image) : 'https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=200&auto=format&fit=crop&q=80' }}" class="rounded-circle object-fit-cover" width="60" height="60" alt="{{ $farmer->name }}">
                    <div>
                      <h6 class="font-serif mb-0"><a href="{{ route('farmers.show', $farmer) }}" class="text-forest text-decoration-none">{{ $farmer->farmerProfile->business_name ?? $farmer->name }}</a></h6>
                      <span class="small text-muted">{{ $farmer->name }}</span>
                      <p class="small text-muted mb-0 mt-1">{{ Str::limit($farmer->farmerProfile->description ?? 'Organic grower', 60) }}</p>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <p class="text-muted">No registered farmers assigned yet.</p>
            @endforelse
          </div>

          <h3 class="font-serif text-forest mb-4">Available Produce from this Market</h3>
          <div class="row g-3">
            @forelse($products as $product)
              <div class="col-md-4">
                <div class="product-card h-100 d-flex flex-column border rounded-20 p-2 bg-white">
                  <div class="position-relative mb-2">
                    <img src="{{ $product->image_url }}" class="rounded-16 w-100 object-fit-cover" height="150" alt="{{ $product->name }}">
                    <span class="badge bg-forest position-absolute top-0 end-0 m-2 rounded-pill">Rs. {{ $product->price }} / {{ $product->unit }}</span>
                  </div>
                  <h6 class="font-serif fs-6 mb-1"><a href="{{ route('products.show', $product) }}" class="text-forest text-decoration-none">{{ $product->name }}</a></h6>
                  <p class="small text-muted mb-2">{{ $product->farmer->farmerProfile->business_name ?? $product->farmer->name }}</p>
                  <div class="mt-auto">
                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-forest w-100 rounded-pill">View Harvest</a>
                  </div>
                </div>
              </div>
            @empty
              <p class="text-muted">No active produce listed for this market right now.</p>
            @endforelse
          </div>
        </div>

        <div class="col-lg-4" id="pickupSlots">
          <div class="card p-4 rounded-24 border-subtle shadow-xs bg-cream sticky-top" style="top: 90px;">
            <h5 class="font-serif text-forest mb-3"><i class="bi bi-clock-history me-2 text-gold"></i>Upcoming Pickup Slots</h5>
            @forelse($upcomingSlots as $slot)
              <div class="card p-3 rounded-16 border-subtle bg-white mb-3 shadow-xs">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <strong class="text-forest small">{{ $slot->farmer->farmerProfile->business_name ?? $slot->farmer->name }}</strong>
                  <span class="badge bg-sage text-forest rounded-pill">{{ $slot->pickup_date->format('M d, Y') }}</span>
                </div>
                <div class="small text-muted mb-2">
                  <i class="bi bi-clock me-1"></i> {{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}
                </div>
                <div class="d-flex justify-content-between align-items-center small">
                  <span class="text-emerald"><i class="bi bi-check-circle me-1"></i>{{ $slot->max_orders - $slot->current_orders }} spots left</span>
                  <a href="{{ route('products.index', ['farmer' => $slot->farmer_id]) }}" class="btn btn-xs btn-forest rounded-pill px-3 py-1">Order for Slot</a>
                </div>
              </div>
            @empty
              <p class="small text-muted">No upcoming pickup slots open at this moment.</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
