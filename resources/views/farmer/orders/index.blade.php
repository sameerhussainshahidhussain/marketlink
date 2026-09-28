<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Pre-Orders | MarketLink Farmer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body class="dashboard-body role-farmer">
  <div class="dashboard-wrapper dashboard-farmer-wrapper">
    <div class="sidebar-overlay"></div>
    @include('partials.farmer-sidebar')

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn"><i class="bi bi-list fs-5"></i></button>
          <h5 class="font-serif mb-0">Customer Pre-Orders ({{ $orders->total() }})</h5>
        </div>
      </header>

      <div class="dashboard-container">
        @if(session('success'))
          <div class="alert alert-success py-2 rounded-12 small mb-4">{{ session('success') }}</div>
        @endif

        <div class="d-flex gap-2 overflow-auto pb-3 mb-4">
          <a href="{{ route('farmer.orders.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-forest' : 'btn-outline-forest' }} rounded-pill">All Orders ({{ $orders->total() }})</a>
          <a href="{{ route('farmer.orders.index', ['status' => 'placed']) }}" class="btn btn-sm {{ request('status') == 'placed' ? 'btn-warning text-dark' : 'btn-outline-forest' }} rounded-pill">New Placed</a>
          <a href="{{ route('farmer.orders.index', ['status' => 'accepted']) }}" class="btn btn-sm {{ request('status') == 'accepted' ? 'btn-info text-dark' : 'btn-outline-forest' }} rounded-pill">Accepted</a>
          <a href="{{ route('farmer.orders.index', ['status' => 'ready_for_pickup']) }}" class="btn btn-sm {{ request('status') == 'ready_for_pickup' ? 'btn-primary' : 'btn-outline-forest' }} rounded-pill">Ready for Pickup</a>
          <a href="{{ route('farmer.orders.index', ['status' => 'completed']) }}" class="btn btn-sm {{ request('status') == 'completed' ? 'btn-success' : 'btn-outline-forest' }} rounded-pill">Completed</a>
        </div>

        <div class="content-card">
          <div class="table-responsive">
            <table class="table table-custom align-middle">
              <thead>
                <tr>
                  <th>Order Details</th>
                  <th>Customer Info</th>
                  <th>Market Location</th>
                  <th>Pickup Slot</th>
                  <th>Total Amount</th>
                  <th>Status</th>
                  <th class="text-end">Lifecycle Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($orders as $order)
                  <tr>
                    <td>
                      <strong class="text-forest d-block">{{ $order->order_number }}</strong>
                      <span class="small text-muted">{{ $order->created_at->format('M d, Y h:i A') }}</span>
                    </td>
                    <td>
                      <strong>{{ $order->customer->name }}</strong>
                      <span class="small text-muted d-block">{{ $order->customer->phone ?? $order->customer->email }}</span>
                    </td>
                    <td>
                      <span class="small text-forest fw-semibold">{{ $order->market->market_name }}</span>
                    </td>
                    <td>
                      <span class="small d-block text-forest">{{ $order->pickup_date->format('M d, Y') }}</span>
                      <span class="small text-muted">{{ date('h:i A', strtotime($order->pickup_start_time)) }} - {{ date('h:i A', strtotime($order->pickup_end_time)) }}</span>
                    </td>
                    <td>
                      <strong class="text-forest">Rs. {{ number_format($order->total_amount, 2) }}</strong>
                    </td>
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
                      <div class="d-flex gap-1 justify-content-end align-items-center flex-wrap">
                        <a href="{{ route('farmer.orders.show', $order) }}" class="btn btn-xs btn-outline-secondary rounded-pill px-2 py-1 small me-1">View</a>
                        @if($order->order_status === 'placed')
                          <form method="POST" action="{{ route('farmer.orders.accept', $order) }}">
                            @csrf
                            <button type="submit" class="btn btn-xs btn-success rounded-pill px-2 py-1 small" title="Accept Pre-Order"><i class="bi bi-check-lg"></i> Accept</button>
                          </form>
                          <form method="POST" action="{{ route('farmer.orders.decline', $order) }}" onsubmit="return confirm('Decline order and restore stock?');">
                            @csrf
                            <button type="submit" class="btn btn-xs btn-outline-danger rounded-pill px-2 py-1 small" title="Decline"><i class="bi bi-x-lg"></i> Decline</button>
                          </form>
                        @elseif($order->order_status === 'accepted')
                          <form method="POST" action="{{ route('farmer.orders.ready', $order) }}">
                            @csrf
                            <button type="submit" class="btn btn-xs btn-primary rounded-pill px-2 py-1 small"><i class="bi bi-box-seam me-1"></i> Mark Ready</button>
                          </form>
                        @elseif($order->order_status === 'ready_for_pickup')
                          <form method="POST" action="{{ route('farmer.orders.complete', $order) }}" onsubmit="return confirm('Complete and confirm collection?');">
                            @csrf
                            <button type="submit" class="btn btn-xs btn-success rounded-pill px-2 py-1 small"><i class="bi bi-check-circle me-1"></i> Complete</button>
                          </form>
                        @endif
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="7" class="text-center py-5 text-muted">No pre-orders found.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-4">
            {{ $orders->links() }}
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
