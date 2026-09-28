@extends('layouts.app')

@section('title', 'Order ' . $order->order_number . ' | MarketLink')

@section('content')
  <section class="py-5 bg-cream border-bottom border-subtle">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0 small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('customer.orders') }}">My Orders</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $order->order_number }}</li>
        </ol>
      </nav>
      <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
          <span class="badge bg-forest text-white rounded-pill px-3 py-1 mb-1">{{ $order->order_number }}</span>
          <h1 class="display-6 font-serif text-forest mb-0">Order Receipt & Pickup Pass</h1>
        </div>
        <div>
          <button class="btn btn-outline-forest rounded-pill btn-sm" onclick="window.print()"><i class="bi bi-printer me-1"></i> Print Receipt</button>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      @if(session('success'))
        <div class="alert alert-success py-2 rounded-12 small mb-4">{{ session('success') }}</div>
      @endif

      <div class="row g-4">
        <div class="col-lg-8">
          <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white mb-4">
            <h5 class="font-serif text-forest mb-3">Reserved Produce Items</h5>
            <div class="table-responsive">
              <table class="table align-middle">
                <thead>
                  <tr class="text-muted small">
                    <th>Produce</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th class="text-end">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($order->items as $item)
                    <tr>
                      <td>
                        <strong class="text-forest d-block">{{ $item->product_name }}</strong>
                      </td>
                      <td>Rs. {{ number_format($item->price, 2) }}</td>
                      <td>{{ $item->quantity }}</td>
                      <td class="text-end fw-bold text-forest">Rs. {{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3" class="text-end fw-bold">Total Amount Due at Pickup:</td>
                    <td class="text-end fw-bold text-forest fs-5">Rs. {{ number_format($order->total_amount, 2) }}</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>

          @if($order->isCancellable())
            <div class="card p-3 rounded-20 border-danger border-subtle bg-white">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h6 class="text-danger mb-0 font-serif">Need to cancel this reservation?</h6>
                  <span class="small text-muted">You can cancel free of charge prior to the cutoff window.</span>
                </div>
                <form method="POST" action="{{ route('customer.orders.cancel', $order) }}" onsubmit="return confirm('Confirm cancellation?');">
                  @csrf
                  <button type="submit" class="btn btn-outline-danger rounded-pill btn-sm px-3">Cancel Order</button>
                </form>
              </div>
            </div>
          @endif
        </div>

        <div class="col-lg-4">
          
          <div class="card p-4 rounded-24 border-subtle bg-forest text-white mb-4 shadow-sm">
            <span class="badge bg-gold text-dark rounded-pill px-3 py-1 align-self-start mb-2 small fw-bold">PICKUP PASS</span>
            <h4 class="font-serif mb-2">{{ $order->market->market_name }}</h4>
            <p class="small opacity-75 mb-3"><i class="bi bi-geo-alt me-1"></i>{{ $order->market->address }}</p>

            <div class="bg-white text-dark p-3 rounded-16 mb-3">
              <div class="small text-muted">Pickup Window:</div>
              <strong class="d-block text-forest fs-6">{{ $order->pickup_date->format('l, M d, Y') }}</strong>
              <span class="small text-muted">{{ date('h:i A', strtotime($order->pickup_start_time)) }} - {{ date('h:i A', strtotime($order->pickup_end_time)) }}</span>
            </div>

            <div class="small">
              <span class="opacity-75 d-block">Grower Stall:</span>
              <strong>{{ $order->farmer->farmerProfile->business_name ?? $order->farmer->name }}</strong>
            </div>
          </div>

          <div class="card p-4 rounded-24 border-subtle bg-cream shadow-xs">
            <h6 class="font-serif text-forest mb-2">Order Status</h6>
            <span class="badge bg-success rounded-pill px-3 py-2 text-uppercase mb-3">{{ str_replace('_', ' ', $order->order_status) }}</span>
            <p class="small text-muted mb-0">Show this pass or mention Order <strong>#{{ $order->order_number }}</strong> at the grower stall upon collection.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
