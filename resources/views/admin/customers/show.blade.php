@extends('layouts.dashboard')

@section('title', $customer->name . ' | Customer Details – MarketLink Admin')
@section('page_title', 'Customer Profile')
@section('page_subtitle', 'Review customer order history, reviews submitted, and favorites')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-outline-forest rounded-pill px-3">
    <i class="bi bi-arrow-left me-1"></i> Back to Customers
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
          {{ strtoupper(substr($customer->name, 0, 2)) }}
        </div>
        <div>
          <div class="d-flex align-items-center gap-2 flex-wrap">
            <h4 class="mb-0 fw-bold font-serif">{{ $customer->name }}</h4>
            @if($customer->status === 'active')
              <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Active</span>
            @else
              <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">Suspended</span>
            @endif
            <span class="badge bg-light text-forest border rounded-pill px-3">Customer</span>
          </div>
          <p class="text-muted small mb-0 mt-1">
            <i class="bi bi-envelope me-1"></i> {{ $customer->email }} &nbsp;|&nbsp;
            <i class="bi bi-telephone me-1"></i> {{ $customer->phone ?? 'No phone specified' }} &nbsp;|&nbsp;
            <i class="bi bi-calendar3 me-1"></i> Registered on {{ $customer->created_at->format('M d, Y') }}
          </p>
        </div>
      </div>

      <div>
        <form method="POST" action="{{ route('admin.customers.toggle', $customer->id) }}" onsubmit="return confirm('Change status for this customer?');">
          @csrf
          @if($customer->status === 'active')
            <button type="submit" class="btn btn-outline-danger rounded-pill px-3">
              <i class="bi bi-slash-circle me-1"></i> Suspend Account
            </button>
          @else
            <button type="submit" class="btn btn-outline-success rounded-pill px-3">
              <i class="bi bi-check2-circle me-1"></i> Reactivate Account
            </button>
          @endif
        </form>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      <div class="card rounded-20 border-subtle shadow-xs bg-white p-3 text-center">
        <div class="text-muted small text-uppercase fw-semibold mb-1">Total Orders Placed</div>
        <div class="h3 fw-bold text-forest mb-0">{{ $customer->orders->count() }}</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card rounded-20 border-subtle shadow-xs bg-white p-3 text-center">
        <div class="text-muted small text-uppercase fw-semibold mb-1">Total Spend</div>
        <div class="h3 fw-bold text-forest mb-0">
          ${{ number_format($customer->orders->where('status', '!=', 'cancelled')->sum('total_amount'), 2) }}
        </div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card rounded-20 border-subtle shadow-xs bg-white p-3 text-center">
        <div class="text-muted small text-uppercase fw-semibold mb-1">Reviews Written</div>
        <div class="h3 fw-bold text-forest mb-0">{{ $customer->reviews->count() }}</div>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="card rounded-20 border-subtle shadow-xs bg-white p-3 text-center">
        <div class="text-muted small text-uppercase fw-semibold mb-1">Saved Favorites</div>
        <div class="h3 fw-bold text-forest mb-0">{{ $customer->favoriteFarmers->count() + $customer->favoriteProducts->count() }}</div>
      </div>
    </div>
  </div>

  <div class="card rounded-24 border-subtle shadow-xs bg-white overflow-hidden mb-4">
    <div class="p-4 border-bottom d-flex align-items-center justify-content-between">
      <h5 class="fw-bold font-serif mb-0">Order History</h5>
      <span class="badge bg-forest text-gold rounded-pill px-3">{{ $customer->orders->count() }} orders</span>
    </div>
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="bg-light">
          <tr class="text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 0.05em;">
            <th class="ps-4">Order #</th>
            <th>Farmer / Stall</th>
            <th>Items</th>
            <th>Total Amount</th>
            <th>Payment Status</th>
            <th>Fulfillment Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @forelse($customer->orders as $ord)
            <tr>
              <td class="ps-4 fw-bold text-forest">#{{ $ord->order_number ?? $ord->id }}</td>
              <td>{{ $ord->farmer->farmerProfile->business_name ?? $ord->farmer->name ?? 'N/A' }}</td>
              <td>
                <span class="badge bg-light text-dark border rounded-pill">{{ $ord->items->count() }} produce items</span>
              </td>
              <td class="fw-bold text-forest">${{ number_format($ord->total_amount, 2) }}</td>
              <td>
                @if($ord->payment_status === 'paid')
                  <span class="badge bg-success-subtle text-success rounded-pill px-2">Paid at Pickup</span>
                @else
                  <span class="badge bg-warning-subtle text-warning rounded-pill px-2">Pending (Pay at Pickup)</span>
                @endif
              </td>
              <td>
                @if($ord->status === 'completed')
                  <span class="badge bg-success-subtle text-success rounded-pill px-2">Completed</span>
                @elseif($ord->status === 'ready_for_pickup')
                  <span class="badge bg-primary-subtle text-primary rounded-pill px-2">Ready for Pickup</span>
                @elseif($ord->status === 'confirmed')
                  <span class="badge bg-info-subtle text-info rounded-pill px-2">Confirmed</span>
                @elseif($ord->status === 'cancelled')
                  <span class="badge bg-danger-subtle text-danger rounded-pill px-2">Cancelled</span>
                @else
                  <span class="badge bg-warning-subtle text-warning rounded-pill px-2">{{ ucfirst($ord->status) }}</span>
                @endif
              </td>
              <td class="text-muted small">{{ $ord->created_at->format('M d, Y h:i A') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-4 text-muted">
                No orders placed by this customer yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="row g-4">
    
    <div class="col-lg-6">
      <div class="card rounded-24 border-subtle shadow-xs bg-white p-4 h-100">
        <h5 class="fw-bold font-serif mb-3 pb-2 border-bottom">Reviews Submitted</h5>
        <div class="d-flex flex-column gap-3">
          @forelse($customer->reviews as $rev)
            <div class="p-3 rounded-16 border bg-light">
              <div class="d-flex align-items-center justify-content-between mb-1">
                <span class="fw-bold text-forest">{{ $rev->product->name ?? 'Produce Item' }}</span>
                <span class="text-gold">
                  @for($i = 1; $i <= 5; $i++)
                    <i class="bi bi-star{{ $i <= $rev->rating ? '-fill' : '' }}"></i>
                  @endfor
                </span>
              </div>
              <p class="text-muted small mb-1">{{ $rev->comment }}</p>
              <div class="d-flex justify-content-between text-muted" style="font-size: 0.75rem;">
                <span>{{ $rev->created_at->format('M d, Y') }}</span>
                <span class="badge bg-{{ $rev->status === 'approved' ? 'success' : 'secondary' }}-subtle text-{{ $rev->status === 'approved' ? 'success' : 'secondary' }} rounded-pill">{{ ucfirst($rev->status) }}</span>
              </div>
            </div>
          @empty
            <p class="text-muted small mb-0">No reviews submitted yet.</p>
          @endforelse
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card rounded-24 border-subtle shadow-xs bg-white p-4 h-100">
        <h5 class="fw-bold font-serif mb-3 pb-2 border-bottom">Saved Favorites</h5>
        
        <h6 class="fw-semibold text-muted small text-uppercase mb-2">Favorite Growers ({{ $customer->favoriteFarmers->count() }})</h6>
        <div class="d-flex flex-wrap gap-2 mb-3">
          @forelse($customer->favoriteFarmers as $ff)
            <span class="badge bg-forest-subtle text-forest rounded-pill p-2 px-3">
              <i class="bi bi-person-heart me-1"></i> {{ $ff->farmerProfile->business_name ?? $ff->name }}
            </span>
          @empty
            <span class="text-muted small">No growers favorited yet.</span>
          @endforelse
        </div>

        <h6 class="fw-semibold text-muted small text-uppercase mb-2">Saved Produce Items ({{ $customer->favoriteProducts->count() }})</h6>
        <div class="d-flex flex-wrap gap-2">
          @forelse($customer->favoriteProducts as $fp)
            <span class="badge bg-light text-dark border rounded-pill p-2 px-3">
              <i class="bi bi-basket me-1 text-forest"></i> {{ $fp->name }} (${{ number_format($fp->price, 2) }})
            </span>
          @empty
            <span class="text-muted small">No items saved yet.</span>
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection
