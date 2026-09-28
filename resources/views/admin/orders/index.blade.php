@extends('layouts.dashboard')

@section('title', 'Platform Pre-Orders | MarketLink Admin')
@section('page_title', 'All Platform Pre-Orders')
@section('page_subtitle', $orders->total() . ' customer pre-order reservations recorded')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-forest btn-sm rounded-pill px-3">
    <i class="bi bi-speedometer2 me-1"></i> Dashboard
  </a>
@endsection

@section('content')

  <div class="content-card">
    <div class="content-card-header">
      <div>
        <h5 class="font-serif text-forest mb-0">Platform Orders Registry</h5>
        <span class="small text-muted">Real-time record of all farm-to-consumer pickups</span>
      </div>
      <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-2 small">
        <i class="bi bi-receipt me-1"></i> {{ $orders->total() }} Orders
      </span>
    </div>

    <div class="table-responsive">
      <table class="table table-custom align-middle mb-0">
        <thead>
          <tr>
            <th>Order #</th>
            <th>Customer</th>
            <th>Farmer Stall</th>
            <th>Market Location</th>
            <th>Pickup Date</th>
            <th>Total Amount</th>
            <th>Status</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($orders as $o)
            <tr>
              <td><strong>{{ $o->order_number }}</strong></td>
              <td>{{ $o->customer->name }}</td>
              <td>
                <span class="fw-medium text-forest">{{ $o->farmer->farmerProfile->business_name ?? $o->farmer->name }}</span>
              </td>
              <td>{{ $o->market->market_name }}</td>
              <td>{{ $o->pickup_date ? $o->pickup_date->format('M d, Y') : '—' }}</td>
              <td class="fw-bold text-forest">Rs. {{ number_format($o->total_amount, 2) }}</td>
              <td>
                @php
                  $statusMap = [
                    'placed'    => 'badge-status placed',
                    'accepted'  => 'badge-status accepted',
                    'ready'     => 'badge-status ready',
                    'completed' => 'badge-status completed',
                    'cancelled' => 'badge-status cancelled',
                    'pending'   => 'badge-status pending',
                  ];
                  $cls = $statusMap[$o->order_status] ?? 'badge bg-secondary rounded-pill';
                @endphp
                <span class="{{ $cls }}">
                  {{ ucwords(str_replace('_', ' ', $o->order_status)) }}
                </span>
              </td>
              <td class="text-end">
                <a href="{{ route('admin.orders.show', $o) }}" class="btn btn-xs btn-outline-forest rounded-pill px-3">
                  <i class="bi bi-eye me-1"></i> Details
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center py-5 text-muted">
                <i class="bi bi-receipt fs-2 text-muted mb-2 d-block"></i>
                No platform orders recorded yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($orders->hasPages())
      <div class="p-3 border-top border-subtle">
        {{ $orders->links() }}
      </div>
    @endif
  </div>

@endsection
