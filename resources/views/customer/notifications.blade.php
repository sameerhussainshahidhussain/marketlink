@extends('layouts.dashboard')

@section('title', 'Notifications | MarketLink')
@section('page_title', 'Notification Center')
@section('page_subtitle', 'Stay updated on your pre-orders, market alerts, and fresh restocks')

@section('sidebar')
  @include('partials.customer-sidebar')
@endsection

@section('topbar_right')
  @if($unreadCount > 0)
    <form method="POST" action="{{ route('customer.notifications.markAllRead') }}" class="d-inline">
      @csrf
      <button type="submit" class="btn btn-sm btn-outline-forest rounded-pill px-3">
        <i class="bi bi-check2-all me-1"></i> Mark All as Read ({{ $unreadCount }})
      </button>
    </form>
  @endif
@endsection

@section('content')
  <div class="card rounded-24 border-subtle shadow-xs bg-white overflow-hidden">
    <div class="card-header bg-white border-bottom border-subtle py-3 px-4 d-flex justify-content-between align-items-center">
      <h6 class="font-serif mb-0"><i class="bi bi-bell text-forest me-2"></i>Recent Notifications</h6>
      <span class="badge bg-sage text-forest rounded-pill px-3 py-1">{{ $unreadCount }} Unread</span>
    </div>

    <div class="list-group list-group-flush">
      @forelse($notifications as $notification)
        @php
          $isUnread = $notification->unread();
          $data = $notification->data;
          $message = $data['message'] ?? 'Notification update received.';
          $link = $data['link'] ?? null;
          $type = $notification->type;
          
          $icon = 'bi-bell-fill text-forest';
          if (str_contains($type, 'Order')) {
            $icon = 'bi-box-seam-fill text-forest';
          } elseif (str_contains($type, 'Restock')) {
            $icon = 'bi-basket-fill text-gold';
          } elseif (str_contains($type, 'Review')) {
            $icon = 'bi-star-fill text-warning';
          }
        @endphp

        <div class="list-group-item p-4 {{ $isUnread ? 'bg-sage-subtle' : '' }} border-subtle transition-all">
          <div class="d-flex align-items-start gap-3">
            <div class="rounded-circle p-2 d-flex align-items-center justify-content-center bg-white shadow-xs border border-subtle" style="width:44px; height:44px; flex-shrink:0;">
              <i class="bi {{ $icon }} fs-5"></i>
            </div>
            
            <div class="flex-grow-1">
              <div class="d-flex align-items-center justify-content-between mb-1">
                <span class="small fw-bold text-forest">
                  @if($isUnread)
                    <span class="badge bg-forest text-white rounded-pill px-2 py-0 me-1" style="font-size:0.65rem;">NEW</span>
                  @endif
                  {{ class_basename($notification->type) == 'OrderStatusUpdatedNotification' ? 'Order Status Update' : (class_basename($notification->type) == 'RestockAlertNotification' ? 'Restock Alert' : 'System Notification') }}
                </span>
                <span class="text-muted small"><i class="bi bi-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}</span>
              </div>

              <p class="mb-2 text-dark fs-6">{{ $message }}</p>

              <div class="d-flex align-items-center gap-2">
                @if($link)
                  <a href="{{ $link }}" class="btn btn-xs btn-forest rounded-pill px-3 py-1 small" style="font-size:0.8rem;">
                    View Details <i class="bi bi-arrow-right ms-1"></i>
                  </a>
                @endif

                @if($isUnread)
                  <form method="POST" action="{{ route('customer.notifications.read', $notification->id) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-xs btn-outline-forest rounded-pill px-3 py-1 small" style="font-size:0.8rem;">
                      <i class="bi bi-check2"></i> Mark as Read
                    </button>
                  </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="p-5 text-center text-muted">
          <i class="bi bi-bell-slash fs-1 text-muted d-block mb-3"></i>
          <h6 class="font-serif text-muted">No notifications right now</h6>
          <p class="small text-muted mb-0">When your pre-orders update or favorite products restock, you'll see alerts here.</p>
        </div>
      @endforelse
    </div>

    @if($notifications->hasPages())
      <div class="card-footer bg-white border-top border-subtle py-3 px-4 d-flex justify-content-center">
        {{ $notifications->links() }}
      </div>
    @endif
  </div>
@endsection
