<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order #{{ $order->order_number }} | Farmer Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body>
  <div class="dashboard-wrapper">
    <div class="sidebar-overlay"></div>
    @include('partials.farmer-sidebar')

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn"><i class="bi bi-list fs-5"></i></button>
          <div>
            <h5 class="font-serif mb-0">Order Details: {{ $order->order_number }}</h5>
            <span class="small text-muted"><a href="{{ route('farmer.orders.index') }}" class="text-muted text-decoration-none">Orders</a> &rsaquo; Details</span>
          </div>
        </div>
        <div class="topbar-right d-flex gap-2">
          @if($order->order_status === 'placed')
            <form method="POST" action="{{ route('farmer.orders.accept', $order) }}">
              @csrf
              <button type="submit" class="btn btn-sm btn-success rounded-pill px-3"><i class="bi bi-check-lg me-1"></i> Accept Order</button>
            </form>
            <form method="POST" action="{{ route('farmer.orders.decline', $order) }}" onsubmit="return confirm('Decline order?');">
              @csrf
              <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-x-lg me-1"></i> Decline</button>
            </form>
          @elseif($order->order_status === 'accepted')
            <form method="POST" action="{{ route('farmer.orders.ready', $order) }}">
              @csrf
              <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3"><i class="bi bi-box-seam me-1"></i> Mark Ready</button>
            </form>
          @elseif($order->order_status === 'ready_for_pickup')
            <form method="POST" action="{{ route('farmer.orders.complete', $order) }}" onsubmit="return confirm('Complete collection?');">
              @csrf
              <button type="submit" class="btn btn-sm btn-success rounded-pill px-3"><i class="bi bi-check-circle me-1"></i> Complete Order</button>
            </form>
          @endif
        </div>
      </header>

      <div class="dashboard-container">
        @if(session('success'))
          <div class="alert alert-success py-2 rounded-12 small mb-4">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
          <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-12 mb-4">
              <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                <h6 class="font-serif mb-0">Ordered Produce Items</h6>
              </div>
              <div class="card-body p-4">
                <div class="table-responsive">
                  <table class="table align-middle mb-0">
                    <thead class="table-light">
                      <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th class="text-end">Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($order->items as $item)
                        <tr>
                          <td>
                            <strong>{{ $item->product_name ?? ($item->product->name ?? 'Product') }}</strong>
                            @if($item->unit)
                              <span class="small text-muted d-block">per {{ $item->unit }}</span>
                            @endif
                          </td>
                          <td>Rs. {{ number_format($item->price, 2) }}</td>
                          <td>{{ $item->quantity }}</td>
                          <td class="text-end fw-bold text-forest">Rs. {{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3" class="text-end fw-bold">Total:</td>
                        <td class="text-end fw-bold text-forest fs-5">Rs. {{ number_format($order->total_amount, 2) }}</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>

            @if($order->notes)
              <div class="card border-0 shadow-sm rounded-12 mb-4">
                <div class="card-body p-4">
                  <h6 class="font-serif mb-2">Customer Order Notes</h6>
                  <p class="text-muted mb-0">{{ $order->notes }}</p>
                </div>
              </div>
            @endif
          </div>

          <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-12 mb-4">
              <div class="card-body p-4">
                <h6 class="font-serif mb-3">Order Status</h6>
                @php
                  $badge = match($order->order_status) {
                    'placed' => 'bg-warning text-dark',
                    'accepted' => 'bg-info text-dark',
                    'ready_for_pickup' => 'bg-primary text-white',
                    'completed' => 'bg-success text-white',
                    default => 'bg-danger text-white'
                  };
                @endphp
                <div class="mb-3">
                  <span class="badge {{ $badge }} rounded-pill px-3 py-2 text-uppercase fs-12">{{ str_replace('_', ' ', $order->order_status) }}</span>
                </div>
                <div class="small mb-2"><strong>Payment Method:</strong> <span class="badge bg-secondary text-uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</span></div>
                <div class="small mb-2"><strong>Ordered:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</div>
                <div class="small mb-2"><strong>Pickup Date:</strong> {{ $order->pickup_date ? $order->pickup_date->format('M d, Y') : '—' }}</div>
                @if($order->pickupSlot)
                  <div class="small mb-0"><strong>Slot:</strong> {{ \Carbon\Carbon::parse($order->pickupSlot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($order->pickupSlot->end_time)->format('h:i A') }}</div>
                @endif
              </div>
            </div>

            <div class="card border-0 shadow-sm rounded-12 mb-4">
              <div class="card-body p-4">
                <h6 class="font-serif mb-3">Customer Information</h6>
                <p class="mb-1"><strong>{{ $order->customer->name ?? 'Shopper' }}</strong></p>
                <p class="text-muted small mb-1">{{ $order->customer->email ?? '' }}</p>
                <p class="text-muted small mb-0">{{ $order->customer->phone ?? 'No phone provided' }}</p>
              </div>
            </div>

            <div class="card border-0 shadow-sm rounded-12">
              <div class="card-body p-4">
                <h6 class="font-serif mb-3">Market Location</h6>
                <p class="mb-1"><strong>{{ $order->market->market_name ?? '—' }}</strong></p>
                <p class="text-muted small mb-0">{{ $order->market->address ?? '' }}, {{ $order->market->city ?? '' }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
