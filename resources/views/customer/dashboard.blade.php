@extends('layouts.dashboard')

@section('title', 'Customer Dashboard | MarketLink')
@section('page_title', 'Welcome back, ' . auth()->user()->name . ' 🌿')
@section('page_subtitle', 'Customer Pre-Order Portal & Harvest Basket')
@section('wrapper_class', 'customer-dashboard-view')

@section('sidebar')
  @include('partials.customer-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('customer.cart') }}" class="nav-action-btn position-relative" title="Basket">
    <i class="bi bi-basket3"></i>
    @php $count = auth()->user()->cart?->item_count ?? 0; @endphp
    @if($count > 0)
      <span class="badge-counter cart-badge-count">{{ $count }}</span>
    @endif
  </a>
@endsection

@section('content')
  
  <div class="stats-grid mb-4">
    <div class="stat-card">
      <div class="stat-icon bg-forest-subtle text-forest"><i class="bi bi-receipt"></i></div>
      <div class="stat-details">
        <span class="stat-label">Total Pre-Orders</span>
        <h3 class="stat-value">{{ $stats['total_orders'] }}</h3>
        <span class="stat-trend positive small"><i class="bi bi-clock-history"></i> Lifetime reservations</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon bg-sage-subtle text-forest"><i class="bi bi-hourglass-split"></i></div>
      <div class="stat-details">
        <span class="stat-label">Active / Upcoming</span>
        <h3 class="stat-value">{{ $stats['active_orders'] }}</h3>
        <span class="stat-subtext text-muted small">Awaiting pickup</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon bg-mint-subtle text-forest"><i class="bi bi-check2-circle"></i></div>
      <div class="stat-details">
        <span class="stat-label">Completed Collections</span>
        <h3 class="stat-value">{{ $stats['completed_orders'] }}</h3>
        <span class="stat-subtext text-muted small">Successfully collected</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon bg-gold-subtle text-forest"><i class="bi bi-heart"></i></div>
      <div class="stat-details">
        <span class="stat-label">Favorite Growers</span>
        <h3 class="stat-value">{{ $stats['favorite_farmers'] }}</h3>
        <span class="stat-subtext text-muted small">Saved local farms</span>
      </div>
    </div>
  </div>

  <div class="row g-4">
    
    <div class="col-lg-8">
      <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="font-serif text-forest mb-0">Recent Pre-Orders</h5>
          <a href="{{ route('customer.orders') }}" class="btn btn-sm btn-outline-forest rounded-pill">View All Orders</a>
        </div>

        <div class="table-responsive">
          <table class="table table-custom align-middle">
            <thead>
              <tr>
                <th>Order #</th>
                <th>Grower / Farm</th>
                <th>Market Location</th>
                <th>Pickup Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentOrders as $order)
                <tr>
                  <td><strong>{{ $order->order_number }}</strong></td>
                  <td>{{ $order->farmer->farmerProfile->business_name ?? $order->farmer->name }}</td>
                  <td>{{ $order->market->market_name }}</td>
                  <td>{{ $order->pickup_date->format('M d, Y') }}</td>
                  <td class="fw-bold text-forest">Rs. {{ number_format($order->total_amount, 2) }}</td>
                  <td>
                    @php
                      $badge = match($order->order_status) {
                        'placed' => 'bg-warning text-dark',
                        'accepted' => 'bg-info text-dark',
                        'ready_for_pickup' => 'bg-primary text-white',
                        'completed' => 'bg-success text-white',
                        default => 'bg-danger text-white'
                      };
                    @endphp
                    <span class="badge {{ $badge }} rounded-pill px-2 py-1 text-uppercase small">{{ str_replace('_', ' ', $order->order_status) }}</span>
                  </td>
                  <td class="text-end">
                    <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-xs btn-outline-forest rounded-pill px-2">Pass</a>
                  </td>
                </tr>
              @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No orders placed yet. <a href="{{ route('products.index') }}">Start exploring fresh produce</a></td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white mb-4">
        <h5 class="font-serif text-forest mb-3">Saved Favorite Farms</h5>
        @forelse($favoriteFarmers as $f)
          <div class="d-flex align-items-center justify-content-between p-2 mb-2 bg-light rounded-12">
            <div class="d-flex align-items-center gap-2">
              <img src="{{ $f->profile_image ? asset('storage/' . $f->profile_image) : 'https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=100&auto=format&fit=crop&q=80' }}" width="35" height="35" class="rounded-circle object-fit-cover" alt="{{ $f->name }}">
              <div>
                <strong class="small d-block text-forest">{{ $f->farmerProfile->business_name ?? $f->name }}</strong>
                <span class="small text-muted">{{ $f->name }}</span>
              </div>
            </div>
            <a href="{{ route('farmers.show', $f) }}" class="btn btn-xs btn-outline-forest rounded-pill px-2">Visit</a>
          </div>
        @empty
          <p class="small text-muted mb-0">No favorite farms saved yet.</p>
        @endforelse
      </div>

      <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white">
        <h5 class="font-serif text-forest mb-3">Marketplace Actions</h5>
        <div class="d-grid gap-2">
          <a href="{{ route('products.index') }}" class="btn btn-forest rounded-pill text-start"><i class="bi bi-basket me-2"></i>Browse Seasonal Harvests</a>
          <a href="{{ route('markets.index') }}" class="btn btn-outline-forest rounded-pill text-start"><i class="bi bi-shop me-2"></i>Find Local Weekend Markets</a>
          <a href="{{ route('customer.cart') }}" class="btn btn-outline-forest rounded-pill text-start"><i class="bi bi-basket3 me-2"></i>View Pickup Basket</a>
        </div>
      </div>
    </div>
  </div>
@endsection
