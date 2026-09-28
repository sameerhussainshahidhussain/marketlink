@extends('layouts.dashboard')

@section('title', 'Order #' . $order->order_number . ' | Admin | MarketLink')
@section('page_title', 'Order #' . $order->order_number)
@section('page_subtitle', 'Placed on ' . $order->created_at->format('M d, Y h:i A') . ' • Total: Rs. ' . number_format($order->total_amount, 2))

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-forest btn-sm rounded-pill px-3">
    <i class="bi bi-arrow-left me-1"></i> Back to Orders
  </a>
@endsection

@section('content')

  <div class="row g-4">
    
    <div class="col-lg-8">
      <div class="content-card mb-4">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">Pre-Order Line Items</h5>
            <span class="small text-muted">{{ $order->items->count() }} produce items in this order</span>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-custom align-middle mb-0">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th class="text-end">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->items as $item)
                <tr>
                  <td>
                    <strong class="text-forest d-block">{{ $item->product_name ?? ($item->product->name ?? 'Produce Item') }}</strong>
                    @if($item->unit)
                      <span class="small text-muted">per {{ $item->unit }}</span>
                    @endif
                  </td>
                  <td>Rs. {{ number_format($item->price, 2) }}</td>
                  <td><span class="badge bg-light text-forest border px-3 py-1 rounded-pill">{{ $item->quantity }}</span></td>
                  <td class="text-end fw-bold text-forest">Rs. {{ number_format($item->subtotal, 2) }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="text-end fw-bold pt-3">Total Amount:</td>
                <td class="text-end fw-bold text-forest fs-5 pt-3">Rs. {{ number_format($order->total_amount, 2) }}</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

      @if($order->notes)
        <div class="content-card mb-4">
          <div class="content-card-header">
            <h6 class="font-serif text-forest mb-0">Customer Pickup Notes</h6>
          </div>
          <div class="content-card-body">
            <p class="text-muted small mb-0">{{ $order->notes }}</p>
          </div>
        </div>
      @endif
    </div>

    <div class="col-lg-4">
      
      <div class="content-card mb-4">
        <div class="content-card-header">
          <h6 class="font-serif text-forest mb-0">Reservation Status</h6>
        </div>
        <div class="content-card-body">
          @php
            $statusMap = [
              'placed'    => 'badge-status placed',
              'accepted'  => 'badge-status accepted',
              'ready'     => 'badge-status ready',
              'completed' => 'badge-status completed',
              'cancelled' => 'badge-status cancelled',
              'pending'   => 'badge-status pending',
            ];
            $cls = $statusMap[$order->order_status] ?? 'badge bg-secondary rounded-pill';
          @endphp
          <div class="mb-3">
            <span class="{{ $cls }} fs-6 px-3 py-2">
              {{ ucwords(str_replace('_', ' ', $order->order_status)) }}
            </span>
          </div>

          <div class="d-flex justify-content-between py-2 border-bottom border-subtle small">
            <span class="text-muted">Payment:</span>
            <strong>{{ ucwords(str_replace('_', ' ', $order->payment_method)) }}</strong>
          </div>
          <div class="d-flex justify-content-between py-2 border-bottom border-subtle small">
            <span class="text-muted">Pickup Date:</span>
            <strong>{{ $order->pickup_date ? $order->pickup_date->format('M d, Y') : '—' }}</strong>
          </div>
          @if($order->pickupSlot)
            <div class="d-flex justify-content-between py-2 small">
              <span class="text-muted">Time Window:</span>
              <strong>{{ \Carbon\Carbon::parse($order->pickupSlot->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($order->pickupSlot->end_time)->format('h:i A') }}</strong>
            </div>
          @endif
        </div>
      </div>

      <div class="content-card mb-4">
        <div class="content-card-header">
          <h6 class="font-serif text-forest mb-0">Customer Details</h6>
        </div>
        <div class="content-card-body">
          <strong class="text-forest d-block">{{ $order->customer->name ?? 'Guest Buyer' }}</strong>
          <span class="text-muted small d-block">{{ $order->customer->email ?? '' }}</span>
          <span class="text-muted small d-block">{{ $order->customer->phone ?? 'No phone' }}</span>
        </div>
      </div>

      <div class="content-card">
        <div class="content-card-header">
          <h6 class="font-serif text-forest mb-0">Marketplace Destination</h6>
        </div>
        <div class="content-card-body">
          <span class="small text-muted d-block">Producer / Stall:</span>
          <strong class="text-forest d-block mb-2">{{ $order->farmer->farmerProfile->business_name ?? ($order->farmer->name ?? '—') }}</strong>

          <span class="small text-muted d-block">Collection Market:</span>
          <strong class="text-forest d-block">{{ $order->market->market_name ?? '—' }}</strong>
          <span class="text-muted small d-block">{{ $order->market->address ?? '' }}, {{ $order->market->city ?? '' }}</span>
        </div>
      </div>
    </div>
  </div>

@endsection
