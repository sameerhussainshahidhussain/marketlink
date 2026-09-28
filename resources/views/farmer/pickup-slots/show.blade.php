<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pickup Slot Details | Farmer Portal</title>
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
            <h5 class="font-serif mb-0">Pickup Slot Details</h5>
            <span class="small text-muted"><a href="{{ route('farmer.pickup-slots.index') }}" class="text-muted text-decoration-none">Slots</a> &rsaquo; Details</span>
          </div>
        </div>
        <div class="topbar-right d-flex gap-2">
          <a href="{{ route('farmer.pickup-slots.edit', $pickupSlot) }}" class="btn btn-sm btn-forest rounded-pill px-3"><i class="bi bi-pencil me-1"></i> Edit Slot</a>
        </div>
      </header>

      <div class="dashboard-container">
        <div class="row g-4">
          <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-12 mb-4">
              <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h6 class="font-serif mb-0 text-forest">{{ $pickupSlot->market->market_name ?? 'Market' }}</h6>
                  <span class="badge {{ $pickupSlot->status === 'active' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($pickupSlot->status) }}</span>
                </div>
                <div class="p-3 bg-light rounded-8 mb-3">
                  <span class="small text-muted d-block">Pickup Date</span>
                  <strong class="fs-5">{{ \Carbon\Carbon::parse($pickupSlot->pickup_date)->format('l, F j, Y') }}</strong>
                </div>
                <div class="p-3 bg-light rounded-8 mb-3">
                  <span class="small text-muted d-block">Pickup Time Window</span>
                  <strong>{{ \Carbon\Carbon::parse($pickupSlot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($pickupSlot->end_time)->format('h:i A') }}</strong>
                </div>
                <div class="p-3 bg-light rounded-8 mb-3">
                  <span class="small text-muted d-block">Capacity</span>
                  <strong>{{ $pickupSlot->current_orders }} / {{ $pickupSlot->max_orders }} orders booked</strong>
                </div>
                @if($pickupSlot->cutoff_time)
                  <div class="p-3 bg-light rounded-8">
                    <span class="small text-muted d-block">Cutoff Time</span>
                    <strong>{{ \Carbon\Carbon::parse($pickupSlot->cutoff_time)->format('M d, Y h:i A') }}</strong>
                  </div>
                @endif
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-12">
              <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                <h6 class="font-serif mb-0">Booked Orders ({{ $pickupSlot->orders->count() }})</h6>
              </div>
              <div class="card-body p-4">
                @forelse($pickupSlot->orders as $ord)
                  <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                    <div>
                      <strong><a href="{{ route('farmer.orders.show', $ord) }}" class="text-forest text-decoration-none">#{{ $ord->order_number }}</a></strong>
                      <span class="small text-muted d-block">{{ $ord->customer->name ?? 'Shopper' }} &bull; Rs. {{ number_format($ord->total_amount, 2) }}</span>
                    </div>
                    <span class="badge bg-secondary">{{ ucfirst($ord->order_status) }}</span>
                  </div>
                @empty
                  <p class="text-muted small mb-0">No orders booked for this slot yet.</p>
                @endforelse
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
