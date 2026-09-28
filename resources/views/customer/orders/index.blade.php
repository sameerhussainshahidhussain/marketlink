@extends('layouts.app')

@section('title', 'My Pre-Orders | MarketLink')

@section('content')
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">My Orders</li>
        </ol>
      </nav>
      <h1 class="display-6 font-serif text-forest mb-1">My Pre-Orders</h1>
      <p class="text-muted mb-0">Track your reserved harvests, review pickup codes, and rate completed orders.</p>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      @if(session('success'))
        <div class="alert alert-success py-2 rounded-12 small mb-4">{{ session('success') }}</div>
      @endif

      @forelse($orders as $order)
        <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white mb-4">
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3 border-bottom pb-3">
            <div>
              <span class="badge bg-forest text-white rounded-pill px-3 py-1 mb-1">{{ $order->order_number }}</span>
              <h5 class="font-serif text-forest mb-0">{{ $order->farmer->farmerProfile->business_name ?? $order->farmer->name }}</h5>
              <span class="small text-muted">Placed on {{ $order->created_at->format('M d, Y h:i A') }}</span>
            </div>
            <div class="text-end">
              @php
                $statusBadge = match($order->order_status) {
                  'placed'           => 'bg-warning text-dark',
                  'accepted'         => 'bg-info text-dark',
                  'ready_for_pickup' => 'bg-primary text-white',
                  'completed'        => 'bg-success text-white',
                  'declined', 'cancelled' => 'bg-danger text-white',
                  default            => 'bg-secondary text-white'
                };
              @endphp
              <span class="badge {{ $statusBadge }} rounded-pill px-3 py-2 text-uppercase small">{{ str_replace('_', ' ', $order->order_status) }}</span>
              <div class="fs-5 fw-bold text-forest mt-1">Rs. {{ number_format($order->total_amount, 2) }}</div>
            </div>
          </div>

          <div class="row g-3 align-items-center">
            <div class="col-md-7">
              <div class="small text-forest mb-1">
                <i class="bi bi-geo-alt text-emerald me-1"></i> Pickup Market: <strong>{{ $order->market->market_name }}</strong>
              </div>
              <div class="small text-muted">
                <i class="bi bi-clock me-1 text-gold"></i> Pickup Date & Time: <strong>{{ $order->pickup_date->format('M d, Y') }}</strong> ({{ date('h:i A', strtotime($order->pickup_start_time)) }} - {{ date('h:i A', strtotime($order->pickup_end_time)) }})
              </div>
            </div>
            <div class="col-md-5 text-md-end d-flex justify-content-md-end gap-2 flex-wrap">
              <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-sm btn-outline-forest rounded-pill px-3">
                <i class="bi bi-receipt me-1"></i> Order Details
              </a>
              @if($order->isCancellable())
                <form method="POST" action="{{ route('customer.orders.cancel', $order) }}" onsubmit="return confirm('Cancel this pre-order?');" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">Cancel</button>
                </form>
              @endif
              @if($order->order_status === 'completed' && $order->reviews->isEmpty())
                <a href="{{ route('customer.reviews.create', $order) }}" class="btn btn-sm btn-forest rounded-pill px-3">
                  <i class="bi bi-star me-1"></i> Review Grower
                </a>
              @endif
            </div>
          </div>
        </div>
      @empty
        <div class="card p-5 rounded-32 border-subtle text-center bg-white shadow-sm">
          <i class="bi bi-receipt text-muted display-3 mb-3"></i>
          <h4 class="font-serif text-forest">No Pre-Orders Yet</h4>
          <p class="text-muted mb-4">When you reserve fresh items from markets, your order history will appear here.</p>
          <div>
            <a href="{{ route('products.index') }}" class="btn btn-forest rounded-pill px-4">Browse Produce</a>
          </div>
        </div>
      @endforelse

      <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
      </div>
    </div>
  </section>
@endsection
