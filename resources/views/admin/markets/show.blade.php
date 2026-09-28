@extends('layouts.dashboard')

@section('title', $market->market_name . ' | Admin | MarketLink')
@section('page_title', $market->market_name)
@section('page_subtitle', $market->city . ' • ' . $market->operating_days)

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <div class="d-flex gap-2">
    <a href="{{ route('admin.markets.index') }}" class="btn btn-outline-forest btn-sm rounded-pill px-3">
      <i class="bi bi-arrow-left me-1"></i> Back to Markets
    </a>
    <a href="{{ route('admin.markets.edit', $market) }}" class="btn btn-forest btn-sm rounded-pill px-3">
      <i class="bi bi-pencil me-1"></i> Edit Market
    </a>
  </div>
@endsection

@section('content')

  <div class="row g-4">
    
    <div class="col-lg-7">
      <div class="content-card mb-4">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">{{ $market->market_name }}</h5>
            <span class="small text-muted">{{ $market->address }}</span>
          </div>
          <span class="badge-status {{ $market->status === 'active' ? 'ready' : 'cancelled' }}">
            {{ ucfirst($market->status) }}
          </span>
        </div>

        <div class="content-card-body">
          <p class="text-muted mb-4">{{ $market->description ?? 'No description provided for this market location.' }}</p>

          <div class="row g-3">
            <div class="col-sm-6">
              <div class="p-3 bg-light rounded-12 border border-subtle">
                <span class="small text-muted d-block">City Location</span>
                <strong class="text-forest">{{ $market->city }}</strong>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="p-3 bg-light rounded-12 border border-subtle">
                <span class="small text-muted d-block">Operating Days</span>
                <strong class="text-forest">{{ $market->operating_days }}</strong>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="p-3 bg-light rounded-12 border border-subtle">
                <span class="small text-muted d-block">Operating Hours</span>
                <strong class="text-forest">
                  {{ $market->opening_time ? \Carbon\Carbon::parse($market->opening_time)->format('h:i A') : '' }} - 
                  {{ $market->closing_time ? \Carbon\Carbon::parse($market->closing_time)->format('h:i A') : '' }}
                </strong>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="p-3 bg-light rounded-12 border border-subtle">
                <span class="small text-muted d-block">Registered Stall Holders</span>
                <strong class="text-forest">{{ $market->farmers->count() }} Farms</strong>
              </div>
            </div>

            @if($market->latitude && $market->longitude)
              <div class="col-12">
                <div class="p-3 bg-light rounded-12 border border-subtle d-flex justify-content-between align-items-center">
                  <div>
                    <span class="small text-muted d-block">GPS Coordinates ({{ ucfirst($market->map_provider ?? 'OpenStreetMap') }})</span>
                    <code>{{ $market->latitude }}, {{ $market->longitude }}</code>
                  </div>
                  <a href="{{ route('map') }}?lat={{ $market->latitude }}&lng={{ $market->longitude }}" target="_blank" class="btn btn-xs btn-outline-forest rounded-pill px-3">
                    <i class="bi bi-geo-alt me-1"></i> View on Map
                  </a>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="content-card">
        <div class="content-card-header">
          <div>
            <h6 class="font-serif text-forest mb-0">Assigned Growers ({{ $market->farmers->count() }})</h6>
            <span class="small text-muted">Stalls registered at this market</span>
          </div>
        </div>

        <div class="content-card-body p-0">
          @forelse($market->farmers as $farmer)
            <div class="p-3 border-bottom border-subtle d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon green rounded-circle" style="width: 40px; height: 40px; font-size: 1.1rem;">
                  <i class="bi bi-shop"></i>
                </div>
                <div>
                  <strong class="text-forest d-block">{{ $farmer->farmerProfile->business_name ?? $farmer->name }}</strong>
                  <span class="small text-muted">{{ $farmer->email }}</span>
                </div>
              </div>
              <a href="{{ route('admin.users.show', $farmer) }}" class="btn btn-xs btn-outline-forest rounded-pill px-2 py-1">
                View
              </a>
            </div>
          @empty
            <div class="text-center py-5">
              <i class="bi bi-people fs-2 text-muted mb-2 d-block"></i>
              <p class="small text-muted mb-0">No farmers assigned to this market yet.</p>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>

@endsection
