@extends('layouts.dashboard')

@section('title', ($farmer->farmerProfile->business_name ?? $farmer->name) . ' | Admin – MarketLink')
@section('page_title', 'Farmer Profile')
@section('page_subtitle', 'Review grower details, associated markets, inventory, and order activity')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.farmers.index') }}" class="btn btn-sm btn-outline-forest rounded-pill px-3">
    <i class="bi bi-arrow-left me-1"></i> Back to Farmers
  </a>
@endsection

@section('content')
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-16 mb-4" role="alert">
      <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="card rounded-24 border-subtle shadow-xs bg-white p-4 mb-4">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
      <div class="d-flex align-items-center gap-3">
        <div class="avatar-lg rounded-circle bg-forest text-gold d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 64px; height: 64px; font-size: 1.5rem;">
          {{ strtoupper(substr($farmer->name, 0, 2)) }}
        </div>
        <div>
          <div class="d-flex align-items-center gap-2 flex-wrap">
            <h4 class="mb-0 fw-bold font-serif">{{ $farmer->farmerProfile->business_name ?? $farmer->name }}</h4>
            @if($farmer->status === 'active')
              <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Active</span>
            @elseif($farmer->status === 'suspended')
              <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">Suspended</span>
            @else
              <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3">Pending</span>
            @endif

            @if(optional($farmer->farmerProfile)->approval_status === 'approved')
              <span class="badge bg-forest text-gold rounded-pill px-3"><i class="bi bi-patch-check-fill me-1"></i> Approved</span>
            @elseif(optional($farmer->farmerProfile)->approval_status === 'pending')
              <span class="badge bg-warning text-dark rounded-pill px-3"><i class="bi bi-clock-history me-1"></i> Awaiting Approval</span>
            @endif
          </div>
          <p class="text-muted small mb-0 mt-1">
            <i class="bi bi-person me-1"></i> {{ $farmer->name }} &nbsp;|&nbsp;
            <i class="bi bi-envelope me-1"></i> {{ $farmer->email }} &nbsp;|&nbsp;
            <i class="bi bi-calendar3 me-1"></i> Member since {{ $farmer->created_at->format('M d, Y') }}
          </p>
        </div>
      </div>

      <div class="d-flex align-items-center gap-2 flex-wrap">
        @if(optional($farmer->farmerProfile)->approval_status === 'pending' || $farmer->status === 'pending')
          <form method="POST" action="{{ route('admin.farmers.approve', $farmer->id) }}">
            @csrf
            <button type="submit" class="btn btn-forest rounded-pill px-3 shadow-xs">
              <i class="bi bi-check-lg me-1"></i> Approve Grower
            </button>
          </form>
        @endif

        @if($farmer->status === 'active')
          <form method="POST" action="{{ route('admin.farmers.suspend', $farmer->id) }}" onsubmit="return confirm('Suspend this farmer account?');">
            @csrf
            <button type="submit" class="btn btn-outline-danger rounded-pill px-3">
              <i class="bi bi-slash-circle me-1"></i> Suspend Account
            </button>
          </form>
        @else
          <form method="POST" action="{{ route('admin.farmers.activate', $farmer->id) }}">
            @csrf
            <button type="submit" class="btn btn-outline-success rounded-pill px-3">
              <i class="bi bi-arrow-repeat me-1"></i> Activate Account
            </button>
          </form>
        @endif
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      <div class="card rounded-20 border-subtle shadow-xs bg-white p-3 text-center">
        <div class="text-muted small text-uppercase fw-semibold mb-1">Products Listed</div>
        <div class="h3 fw-bold text-forest mb-0">{{ $farmer->products->count() }}</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card rounded-20 border-subtle shadow-xs bg-white p-3 text-center">
        <div class="text-muted small text-uppercase fw-semibold mb-1">Total Orders</div>
        <div class="h3 fw-bold text-forest mb-0">{{ $farmer->farmerOrders->count() }}</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card rounded-20 border-subtle shadow-xs bg-white p-3 text-center">
        <div class="text-muted small text-uppercase fw-semibold mb-1">Markets Linked</div>
        <div class="h3 fw-bold text-forest mb-0">{{ $farmer->markets->count() }}</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card rounded-20 border-subtle shadow-xs bg-white p-3 text-center">
        <div class="text-muted small text-uppercase fw-semibold mb-1">Pickup Schedules</div>
        <div class="h3 fw-bold text-forest mb-0">{{ $farmer->pickupSlots->count() }}</div>
      </div>
    </div>
  </div>

  <div class="row g-4 mb-4">
    
    <div class="col-lg-4">
      <div class="card rounded-24 border-subtle shadow-xs bg-white p-4 h-100">
        <h5 class="fw-bold font-serif mb-3 pb-2 border-bottom">Grower Information</h5>
        <div class="d-flex flex-column gap-3 small">
          <div>
            <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Business Name</div>
            <div class="fw-medium text-dark">{{ $farmer->farmerProfile->business_name ?? 'N/A' }}</div>
          </div>
          <div>
            <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Farm / Nursery Address</div>
            <div class="fw-medium text-dark">{{ $farmer->farmerProfile->address ?? 'Not specified' }}</div>
          </div>
          <div>
            <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Location Region</div>
            <div class="fw-medium text-dark">{{ $farmer->farmerProfile->location_name ?? 'Local Farm' }}</div>
          </div>
          <div>
            <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Direct Phone</div>
            <div class="fw-medium text-dark">{{ $farmer->phone ?? 'Not provided' }}</div>
          </div>
          <div>
            <div class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Farm Bio & Story</div>
            <p class="text-muted mb-0 mt-1" style="line-height: 1.5;">
              {{ $farmer->farmerProfile->description ?? 'No biography submitted yet.' }}
            </p>
          </div>
        </div>

        <h5 class="fw-bold font-serif mb-3 mt-4 pt-3 border-top">Associated Markets</h5>
        @forelse($farmer->markets as $mkt)
          <div class="p-2 px-3 rounded-12 bg-light mb-2 d-flex align-items-center justify-content-between">
            <div>
              <div class="fw-bold text-forest small">{{ $mkt->name }}</div>
              <div class="text-muted" style="font-size: 0.75rem;">{{ $mkt->city }}, {{ $mkt->state }}</div>
            </div>
            <span class="badge bg-forest-subtle text-forest rounded-pill">{{ $mkt->operating_days ?? 'Weekly' }}</span>
          </div>
        @empty
          <p class="text-muted small mb-0">No market locations affiliated yet.</p>
        @endforelse
      </div>
    </div>

    <div class="col-lg-8">
      <div class="card rounded-24 border-subtle shadow-xs bg-white overflow-hidden mb-4">
        <div class="p-4 border-bottom d-flex align-items-center justify-content-between">
          <h5 class="fw-bold font-serif mb-0">Produce & Inventory Catalog</h5>
          <span class="badge bg-forest text-gold rounded-pill px-3">{{ $farmer->products->count() }} items</span>
        </div>
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead class="bg-light">
              <tr class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                <th class="ps-4">Product</th>
                <th>Category</th>
                <th>Price / Unit</th>
                <th>Stock</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($farmer->products as $product)
                <tr>
                  <td class="ps-4">
                    <div class="d-flex align-items-center gap-3">
                      <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded-12 object-fit-cover shadow-xs" width="44" height="44">
                      <div>
                        <div class="fw-bold text-dark">{{ $product->name }}</div>
                        <div class="text-muted small">SKU: #PRD-{{ $product->id }}</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="badge bg-light text-forest border rounded-pill">{{ $product->category->name ?? 'Uncategorized' }}</span>
                  </td>
                  <td>
                    <span class="fw-bold text-forest">${{ number_format($product->price, 2) }}</span>
                    <span class="text-muted small">/ {{ $product->unit ?? 'unit' }}</span>
                  </td>
                  <td>
                    @if($product->stock_quantity <= 0)
                      <span class="badge bg-danger-subtle text-danger rounded-pill">Out of Stock</span>
                    @elseif($product->stock_quantity <= 5)
                      <span class="badge bg-warning-subtle text-warning rounded-pill">{{ $product->stock_quantity }} left</span>
                    @else
                      <span class="badge bg-success-subtle text-success rounded-pill">{{ $product->stock_quantity }} {{ $product->unit ?? 'units' }}</span>
                    @endif
                  </td>
                  <td>
                    @if($product->status === 'active')
                      <span class="badge bg-success text-white rounded-pill px-2">Active</span>
                    @else
                      <span class="badge bg-secondary text-white rounded-pill px-2">Archived</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-4 text-muted">
                    No products published by this grower yet.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <div class="card rounded-24 border-subtle shadow-xs bg-white overflow-hidden">
        <div class="p-4 border-bottom d-flex align-items-center justify-content-between">
          <h5 class="fw-bold font-serif mb-0">Recent Farmer Orders</h5>
          <span class="badge bg-light text-forest border rounded-pill px-3">{{ $farmer->farmerOrders->count() }} total</span>
        </div>
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead class="bg-light">
              <tr class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                <th class="ps-4">Order #</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @forelse($farmer->farmerOrders->take(10) as $ord)
                <tr>
                  <td class="ps-4 fw-bold text-forest">#{{ $ord->order_number ?? $ord->id }}</td>
                  <td>{{ $ord->customer->name ?? 'Guest/Customer' }}</td>
                  <td class="fw-bold">${{ number_format($ord->total_amount, 2) }}</td>
                  <td>
                    @if($ord->status === 'completed')
                      <span class="badge bg-success-subtle text-success rounded-pill px-2">Completed</span>
                    @elseif($ord->status === 'ready_for_pickup')
                      <span class="badge bg-primary-subtle text-primary rounded-pill px-2">Ready</span>
                    @elseif($ord->status === 'confirmed')
                      <span class="badge bg-info-subtle text-info rounded-pill px-2">Confirmed</span>
                    @elseif($ord->status === 'cancelled')
                      <span class="badge bg-danger-subtle text-danger rounded-pill px-2">Cancelled</span>
                    @else
                      <span class="badge bg-warning-subtle text-warning rounded-pill px-2">{{ ucfirst($ord->status) }}</span>
                    @endif
                  </td>
                  <td class="text-muted small">{{ $ord->created_at->format('M d, Y') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-4 text-muted">
                    No orders recorded for this grower yet.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
