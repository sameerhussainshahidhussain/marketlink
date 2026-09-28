@extends('layouts.dashboard')

@section('title', 'Farmer Vendor Portal | MarketLink')
@section('wrapper_class', 'farmer-dashboard-view')

@section('page_title')
  Farmer Portal • {{ auth()->user()->farmerProfile->business_name ?? auth()->user()->name }}
@endsection

@section('page_subtitle')
  Approval Status: 
  <span class="badge {{ auth()->user()->farmerProfile?->approval_status === 'approved' ? 'bg-success' : 'bg-warning text-dark' }} rounded-pill text-uppercase">
    {{ auth()->user()->farmerProfile?->approval_status ?? 'Pending' }}
  </span>
@endsection

@section('sidebar')
  @include('partials.farmer-sidebar')
@endsection

@section('topbar_right')
  @if(auth()->user()->farmerProfile?->approval_status === 'approved')
    <a href="{{ route('farmer.products.create') }}" class="btn btn-sm btn-forest rounded-pill px-3">
      <i class="bi bi-plus-lg me-1"></i> Add Produce Item
    </a>
  @else
    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-2">
      <i class="bi bi-info-circle me-1"></i> Awaiting Approval to List Produce
    </span>
  @endif
@endsection

@section('content')
  
  <div class="stats-grid mb-4">
    <div class="stat-card">
      <div class="stat-icon bg-forest-subtle text-forest"><i class="bi bi-currency-dollar"></i></div>
      <div class="stat-details">
        <span class="stat-label">Total Revenue</span>
        <h3 class="stat-value">${{ number_format($stats['total_revenue'], 2) }}</h3>
        <span class="stat-trend positive small"><i class="bi bi-check2-circle"></i> From completed orders</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon bg-sage-subtle text-forest"><i class="bi bi-receipt"></i></div>
      <div class="stat-details">
        <span class="stat-label">Total Pre-Orders</span>
        <h3 class="stat-value">{{ $stats['total_orders'] }}</h3>
        <span class="stat-trend small text-warning"><i class="bi bi-hourglass-split"></i> {{ $stats['pending_orders'] }} pending</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon bg-mint-subtle text-forest"><i class="bi bi-box-seam"></i></div>
      <div class="stat-details">
        <span class="stat-label">Active Produce</span>
        <h3 class="stat-value">{{ $stats['active_products'] }}</h3>
        <span class="stat-subtext text-muted small">{{ $stats['total_products'] }} total catalog items</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon bg-gold-subtle text-forest"><i class="bi bi-star"></i></div>
      <div class="stat-details">
        <span class="stat-label">Stall Rating</span>
        <h3 class="stat-value">{{ number_format($stats['avg_rating'] ?? 5.0, 1) }} ★</h3>
        <span class="stat-subtext text-muted small">From verified collections</span>
      </div>
    </div>
  </div>

  <div class="row g-4">
    
    <div class="col-lg-8">
      <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="font-serif text-forest mb-0">Recent Pre-Orders</h5>
          <a href="{{ route('farmer.orders.index') }}" class="btn btn-sm btn-outline-forest rounded-pill">View All</a>
        </div>

        <div class="table-responsive">
          <table class="table table-custom align-middle">
            <thead>
              <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Market</th>
                <th>Pickup Date</th>
                <th>Amount</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentOrders as $order)
                <tr>
                  <td><strong>#{{ $order->order_number ?? $order->id }}</strong></td>
                  <td>{{ $order->customer->name ?? 'Customer' }}</td>
                  <td>{{ $order->market->market_name ?? 'Market' }}</td>
                  <td>{{ $order->pickup_date ? $order->pickup_date->format('M d, Y') : 'Scheduled' }}</td>
                  <td class="fw-bold text-forest">${{ number_format($order->total_amount, 2) }}</td>
                  <td>
                    @php
                      $badge = match($order->order_status ?? $order->status) {
                        'placed' => 'bg-warning text-dark',
                        'accepted' => 'bg-info text-dark',
                        'ready_for_pickup' => 'bg-primary text-white',
                        'completed' => 'bg-success text-white',
                        'cancelled' => 'bg-danger text-white',
                        default => 'bg-secondary text-white'
                      };
                    @endphp
                    <span class="badge {{ $badge }} rounded-pill px-2 py-1 text-uppercase small">{{ str_replace('_', ' ', $order->order_status ?? $order->status) }}</span>
                  </td>
                </tr>
              @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">No orders received yet.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="content-card mb-4">
        <h5 class="font-serif text-forest mb-3"><i class="bi bi-exclamation-triangle text-warning me-2"></i>Low Stock Produce</h5>
        @forelse($lowStockProducts as $prod)
          <div class="d-flex align-items-center justify-content-between p-2 mb-2 bg-light rounded-12">
            <div>
              <strong class="small d-block text-forest">{{ $prod->name }}</strong>
              <span class="text-danger small">{{ $prod->stock_quantity }} {{ $prod->unit ?? 'unit' }}s left</span>
            </div>
            <a href="{{ route('farmer.products.edit', $prod) }}" class="btn btn-xs btn-outline-forest rounded-pill px-2">Update</a>
          </div>
        @empty
          <p class="small text-muted mb-0">All produce items have healthy stock levels.</p>
        @endforelse
      </div>

      <div class="content-card">
        <h5 class="font-serif text-forest mb-3">Quick Navigation</h5>
        <div class="d-grid gap-2">
          @if(auth()->user()->farmerProfile?->approval_status === 'approved')
            <a href="{{ route('farmer.products.create') }}" class="btn btn-forest rounded-pill text-start"><i class="bi bi-plus-circle me-2"></i>Add New Product</a>
          @endif
          <a href="{{ route('farmer.pickup-slots.create') }}" class="btn btn-outline-forest rounded-pill text-start"><i class="bi bi-clock-history me-2"></i>Schedule Pickup Slot</a>
          <a href="{{ route('farmer.insights') }}" class="btn btn-outline-forest rounded-pill text-start"><i class="bi bi-graph-up me-2"></i>Sales & Analytics Insights</a>
          <a href="{{ route('farmer.profile') }}" class="btn btn-outline-forest rounded-pill text-start"><i class="bi bi-shop me-2"></i>Edit Farm Bio & Location</a>
        </div>
      </div>
    </div>
  </div>
@endsection
