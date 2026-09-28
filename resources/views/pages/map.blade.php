@extends('layouts.app')

@section('title', 'Nearby Farmers Markets Map | MarketLink')
@section('meta_description', 'Locate nearby farmers markets, verified vendor stalls, and pre-order pickup points with real-time GPS coordinates.')

@section('styles')
  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <style>
    #marketLinkMap {
      height: 640px;
      width: 100%;
      border-radius: var(--radius-lg);
      border: 1px solid var(--border-subtle);
      z-index: 10;
    }
    .market-sidebar-item {
      cursor: pointer;
      transition: all var(--transition-fast);
      border: 1px solid var(--border-subtle);
    }
    .market-sidebar-item:hover {
      background-color: var(--accent-sage);
      border-color: var(--primary-mint);
      transform: translateX(4px);
    }
  </style>
@endsection

@section('content')
  
  <section class="py-4 bg-cream border-bottom border-subtle">
    <div class="container">
      <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div>
          <span class="section-tag"><i class="bi bi-geo-alt"></i> Location Explorer</span>
          <h1 class="display-6 font-serif mb-1">Nearby Farmers Markets & Stall Locations</h1>
          <p class="text-muted small mb-0">Click any market on the map or side panel to see operating days, vendor count, and pickup directions.</p>
        </div>
        <div class="d-flex gap-2">
          <a href="{{ route('markets.index') }}" class="btn btn-outline-forest rounded-pill px-3 py-2"><i class="bi bi-list-ul me-1"></i> Directory View</a>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        
        <div class="col-lg-8">
          <div id="marketLinkMap" class="shadow-premium"></div>
          <div class="d-flex align-items-center justify-content-between mt-2 px-2 small text-muted">
            <div><i class="bi bi-info-circle me-1"></i> Click on green markers to inspect stalls and get instant directions.</div>
            <div class="text-forest fw-semibold"><i class="bi bi-shield-check text-emerald me-1"></i> Verified Locations ({{ $markets->count() }})</div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white h-100">
            <h5 class="font-serif mb-3 d-flex align-items-center justify-content-between">
              <span>Markets Near You</span>
              <span class="badge bg-sage text-forest small rounded-pill">{{ $markets->count() }} Locations</span>
            </h5>
            
            <div class="d-flex flex-column gap-3 overflow-y-auto" style="max-height: 540px;">
              @forelse($markets as $market)
                <div class="market-sidebar-item card p-3 rounded-16 shadow-none" data-lat="{{ $market->latitude }}" data-lng="{{ $market->longitude }}">
                  <div class="d-flex justify-content-between align-items-start mb-1">
                    <h6 class="font-serif fs-6 mb-0 text-forest">{{ $market->market_name }}</h6>
                    <span class="badge bg-gold-subtle text-dark small">{{ $market->city }}</span>
                  </div>
                  <p class="small text-muted mb-2"><i class="bi bi-geo-alt me-1 text-emerald"></i>{{ $market->address }}</p>
                  <div class="small fw-semibold text-emerald mb-2">
                    <i class="bi bi-calendar3 me-1"></i>{{ $market->operating_days }} ({{ date('h:i A', strtotime($market->opening_time)) }} - {{ date('h:i A', strtotime($market->closing_time)) }})
                  </div>
                  <div class="d-flex gap-2 mt-auto">
                    <a href="{{ route('markets.show', $market) }}" class="btn btn-xs btn-forest rounded-pill py-1 px-3 small" style="font-size: 0.8rem;">View Details</a>
                    <a href="https://www.google.com/maps/dir/?api=1&destination={{ $market->latitude }},{{ $market->longitude }}" target="_blank" class="btn btn-xs btn-outline-forest rounded-pill py-1 px-3 small" style="font-size: 0.8rem;">Directions</a>
                  </div>
                </div>
              @empty
                <div class="p-4 text-center text-muted">
                  <i class="bi bi-geo-alt fs-2 d-block mb-2 text-muted"></i>
                  No active markets with map coordinates found.
                </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('scripts')
  
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script>
    window.dbMarketLocations = @json($mapLocations);
  </script>
  <script src="{{ asset('assets/js/map.js') }}"></script>
@endsection
