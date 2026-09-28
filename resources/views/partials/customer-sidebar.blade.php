<aside class="dashboard-sidebar customer-sidebar">
  <div class="sidebar-header">
    <a class="navbar-brand d-flex align-items-center bg-white p-2 px-3 rounded-16 shadow-xs" href="{{ url('/') }}">
      <img src="{{ asset('assets/images/logo.png') }}" alt="MarketLink" height="34" class="w-auto">
    </a>
    <span class="portal-badge customer-portal-badge">
      <i class="bi bi-basket2-fill"></i> Customer
    </span>
  </div>

  <ul class="sidebar-menu">
    <li class="sidebar-heading">Customer Portal</li>
    <li class="sidebar-item">
      <a href="{{ route('customer.dashboard') }}" class="sidebar-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="{{ route('customer.orders') }}" class="sidebar-link {{ request()->routeIs('customer.orders*') ? 'active' : '' }}">
        <i class="bi bi-receipt"></i>
        <span>My Pre-Orders</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="{{ route('customer.cart') }}" class="sidebar-link {{ request()->routeIs('customer.cart') ? 'active' : '' }}">
        <i class="bi bi-basket3"></i>
        <span>Pickup Basket</span>
        @php $cCount = auth()->user()->cart?->item_count ?? 0; @endphp
        @if($cCount > 0)
          <span class="sidebar-badge">{{ $cCount }}</span>
        @endif
      </a>
    </li>
    <li class="sidebar-item">
      <a href="{{ route('customer.favorites') }}" class="sidebar-link {{ request()->routeIs('customer.favorites') ? 'active' : '' }}">
        <i class="bi bi-heart"></i>
        <span>Saved Favorites</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="{{ route('customer.reviews') }}" class="sidebar-link {{ request()->routeIs('customer.reviews*') ? 'active' : '' }}">
        <i class="bi bi-star"></i>
        <span>My Reviews</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="{{ route('customer.notifications') }}" class="sidebar-link {{ request()->routeIs('customer.notifications') ? 'active' : '' }}">
        <i class="bi bi-bell"></i>
        <span>Notifications</span>
        @php $nUnread = auth()->user()->unreadNotifications()->count(); @endphp
        @if($nUnread > 0)
          <span class="sidebar-badge">{{ $nUnread }}</span>
        @endif
      </a>
    </li>
    <li class="sidebar-item">
      <a href="{{ route('customer.profile') }}" class="sidebar-link {{ request()->routeIs('customer.profile') ? 'active' : '' }}">
        <i class="bi bi-person-gear"></i>
        <span>Account & Profile</span>
      </a>
    </li>

    <li class="sidebar-heading mt-3">Marketplace</li>
    <li class="sidebar-item">
      <a href="{{ route('markets.index') }}" class="sidebar-link">
        <i class="bi bi-shop"></i>
        <span>Browse Markets</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="{{ route('farmers.index') }}" class="sidebar-link">
        <i class="bi bi-people"></i>
        <span>Browse Farmers</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="{{ route('products.index') }}" class="sidebar-link">
        <i class="bi bi-grid"></i>
        <span>Seasonal Produce</span>
      </a>
    </li>

    <li class="sidebar-heading mt-3">Account</li>
    <li class="sidebar-item">
      <form method="POST" action="{{ route('logout') }}" id="customerLogoutForm">
        @csrf
        <a href="javascript:void(0)" onclick="document.getElementById('customerLogoutForm').submit()" class="sidebar-link text-danger">
          <i class="bi bi-box-arrow-left text-danger"></i>
          <span>Sign Out</span>
        </a>
      </form>
    </li>
  </ul>

  <div class="sidebar-footer">
    <div class="user-snippet">
      <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80' }}" alt="{{ auth()->user()->name }}" class="user-avatar object-fit-cover">
      <div class="user-info">
        <h6 class="text-truncate" style="max-width: 140px;">{{ auth()->user()->name }}</h6>
        <span>Customer Account</span>
      </div>
    </div>
  </div>
</aside>
