@extends('layouts.dashboard')

@section('title', 'Admin Dashboard | MarketLink')
@section('page_title', 'Platform Administration HQ')
@section('page_subtitle', 'System Governance & Marketplace Overview')

@section('topbar_right')
  <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-outline-forest rounded-pill px-3">
    <i class="bi bi-globe me-1"></i> Public Marketplace
  </a>
@endsection

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('content')

  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="stat-card">
        <div>
          <div class="stat-value">{{ number_format($stats['total_customers']) }}</div>
          <div class="stat-label">Active Customers</div>
          <div class="stat-subtext text-muted small mt-1"><i class="bi bi-people me-1"></i>Registered buyers</div>
        </div>
        <div class="stat-icon blue">
          <i class="bi bi-people"></i>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="stat-card">
        <div>
          <div class="stat-value">{{ number_format($stats['total_farmers']) }}</div>
          <div class="stat-label">Approved Farmers</div>
          <div class="stat-subtext small mt-1 {{ $stats['pending_farmers'] > 0 ? 'text-danger fw-semibold' : 'text-muted' }}">
            <i class="bi bi-shop me-1"></i>{{ $stats['pending_farmers'] }} pending review
          </div>
        </div>
        <div class="stat-icon green">
          <i class="bi bi-person-badge"></i>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="stat-card">
        <div>
          <div class="stat-value">{{ number_format($stats['total_orders']) }}</div>
          <div class="stat-label">Total Pre-Orders</div>
          <div class="stat-subtext text-muted small mt-1"><i class="bi bi-receipt me-1"></i>Completed & active</div>
        </div>
        <div class="stat-icon green">
          <i class="bi bi-receipt"></i>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="stat-card">
        <div>
          <div class="stat-value" style="font-size:1.55rem;">Rs. {{ number_format($stats['revenue_month'], 0) }}</div>
          <div class="stat-label">Monthly Revenue</div>
          <div class="stat-subtext text-forest small mt-1"><i class="bi bi-arrow-up-right me-1"></i>Rs. {{ number_format($stats['revenue_today'], 0) }} today</div>
        </div>
        <div class="stat-icon gold">
          <i class="bi bi-currency-dollar"></i>
        </div>
      </div>
    </div>
  </div>

  @if($stats['pending_farmers'] > 0)
    <div class="alert alert-warning rounded-16 p-3 mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2 border-0 shadow-sm" style="background-color: #fff9e6; border-left: 4px solid var(--accent-gold) !important;">
      <div class="d-flex align-items-center gap-3">
        <div class="stat-icon gold" style="width:44px; height:44px; font-size:1.2rem;">
          <i class="bi bi-shield-exclamation"></i>
        </div>
        <div>
          <strong class="text-dark">{{ $stats['pending_farmers'] }} Farmer Application(s) Awaiting Review</strong>
          <p class="small mb-0 text-muted">New farm producers have registered and require verification before their stalls go live.</p>
        </div>
      </div>
      <a href="{{ route('admin.farmers.pending') }}" class="btn btn-warning rounded-pill px-4 fw-semibold text-dark btn-sm">
        Review Now
      </a>
    </div>
  @endif

  <div class="content-card mb-4">
    <div class="content-card-header">
      <div>
        <h5 class="font-serif text-forest mb-0">Platform Growth & Shopper Adoption</h5>
        <span class="small text-muted">Registered customers vs local family farmers over time</span>
      </div>
      <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-2 small">
        <i class="bi bi-graph-up me-1"></i> Monthly Metrics
      </span>
    </div>
    <div class="content-card-body">
      <canvas id="adminPlatformActivityChart" height="75"></canvas>
    </div>
  </div>

  <div class="row g-4">

    <div class="col-lg-8">
      <div class="content-card h-100 mb-0">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">Platform Pre-Orders Stream</h5>
            <span class="small text-muted">Latest customer pre-orders across markets</span>
          </div>
          <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-forest rounded-pill px-3">View All</a>
        </div>
        <div class="table-responsive">
          <table class="table table-custom align-middle mb-0">
            <thead>
              <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Farmer</th>
                <th>Market</th>
                <th>Amount</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentOrders as $o)
                <tr>
                  <td><strong>{{ $o->order_number }}</strong></td>
                  <td>{{ $o->customer->name }}</td>
                  <td>{{ $o->farmer->farmerProfile->business_name ?? $o->farmer->name }}</td>
                  <td>{{ $o->market->market_name }}</td>
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
                </tr>
              @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">No orders yet.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="content-card h-100 mb-0">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">Pending Growers</h5>
            <span class="small text-muted">Awaiting stall approvals</span>
          </div>
          <a href="{{ route('admin.farmers.pending') }}" class="btn btn-sm btn-outline-forest rounded-pill px-3">All</a>
        </div>
        <div class="content-card-body">
          @forelse($pendingFarmers as $f)
            <div class="p-3 rounded-16 border border-subtle bg-light mb-3">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                  <strong class="d-block text-forest small">{{ $f->farmerProfile->business_name ?? $f->name }}</strong>
                  <span class="small text-muted">{{ $f->email }}</span>
                </div>
                <span class="badge bg-warning text-dark rounded-pill small">Pending</span>
              </div>
              <form method="POST" action="{{ route('admin.farmers.approve', $f) }}">
                @csrf
                <button type="submit" class="btn btn-xs btn-forest rounded-pill w-100 py-1">
                  <i class="bi bi-check-circle me-1"></i> Approve Application
                </button>
              </form>
            </div>
          @empty
            <div class="text-center py-4">
              <i class="bi bi-check-circle-fill text-success fs-3 mb-2 d-block"></i>
              <p class="small text-muted mb-0">All farmer applications are currently reviewed and approved.</p>
            </div>
          @endforelse
        </div>
      </div>
    </div>

  </div>

@endsection
