@extends('layouts.dashboard')

@section('title', 'Sales & Insights | MarketLink Farmer')
@section('page_title', 'Sales Analytics & Harvest Insights')
@section('page_subtitle', 'Track revenue, best sellers, and upcoming pickup windows')

@section('sidebar')
  @include('partials.farmer-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('farmer.products.create') }}" class="btn btn-sm btn-forest rounded-pill px-3">
    <i class="bi bi-plus-circle me-1"></i> Add Produce
  </a>
@endsection

@section('styles')
  <style>
    .insight-stat {
      background: var(--white, #fff);
      border: 1px solid var(--border-subtle, #e2e8f0);
      border-radius: 20px;
      padding: 1.25rem 1.5rem;
      box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    }
    .insight-stat .stat-val {
      font-size: 1.8rem;
      font-weight: 700;
      color: var(--primary-forest, #14351d);
      font-family: var(--font-serif);
      line-height: 1.1;
    }
    .insight-stat .stat-lbl { font-size: 0.8rem; color: #64748b; text-transform: uppercase; font-weight: 600; letter-spacing: 0.04em; }
    .insight-stat .stat-ico { font-size: 2rem; opacity: 0.15; }
  </style>
@endsection

@section('content')
  
  <div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
      <div class="insight-stat d-flex justify-content-between align-items-center">
        <div>
          <div class="stat-val">{{ $stats['total_orders'] }}</div>
          <div class="stat-lbl">Total Pre-Orders</div>
        </div>
        <div class="stat-ico text-forest"><i class="bi bi-box2-heart"></i></div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="insight-stat d-flex justify-content-between align-items-center">
        <div>
          <div class="stat-val">Rs. {{ number_format($stats['total_revenue'], 0) }}</div>
          <div class="stat-lbl">Total In-Person Revenue</div>
        </div>
        <div class="stat-ico text-warning"><i class="bi bi-cash-stack"></i></div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="insight-stat d-flex justify-content-between align-items-center">
        <div>
          <div class="stat-val">Rs. {{ number_format($stats['avg_order_value'], 0) }}</div>
          <div class="stat-lbl">Avg. Order Value</div>
        </div>
        <div class="stat-ico text-info"><i class="bi bi-basket"></i></div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="insight-stat d-flex justify-content-between align-items-center">
        <div>
          <div class="stat-val">{{ number_format($stats['avg_rating'], 1) }} ⭐</div>
          <div class="stat-lbl">Average Star Rating</div>
        </div>
        <div class="stat-ico text-warning"><i class="bi bi-star-fill"></i></div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    
    <div class="col-lg-7">
      <div class="card rounded-24 border-subtle shadow-xs bg-white p-4 h-100">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h6 class="font-serif mb-0 text-forest"><i class="bi bi-graph-up-arrow me-2"></i>6-Month Revenue Trend</h6>
          <span class="small text-muted">Completed pickups only</span>
        </div>
        <canvas id="salesChart" height="220"></canvas>
        @if($monthlySales->isEmpty())
          <div class="text-center py-4 text-muted small mt-2">
            <i class="bi bi-bar-chart fs-3 d-block mb-2"></i>
            No completed orders in the last 6 months yet.
          </div>
        @endif
      </div>
    </div>

    <div class="col-lg-5">
      <div class="card rounded-24 border-subtle shadow-xs bg-white p-4 h-100">
        <h6 class="font-serif mb-3 text-forest"><i class="bi bi-trophy me-2"></i>Best Selling Produce</h6>
        @forelse($bestSellers as $i => $item)
          <div class="d-flex align-items-center gap-3 p-3 rounded-16 {{ $i == 0 ? 'bg-sage-subtle border border-forest' : 'bg-light' }} mb-2">
            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-forest" style="width:34px;height:34px;background:{{ $i == 0 ? '#e8f5ed' : '#f8fafc' }};flex-shrink:0;">
              {{ $i + 1 }}
            </div>
            <div class="flex-grow-1 overflow-hidden">
              <div class="fw-semibold text-forest small text-truncate">{{ $item->product_name }}</div>
              <div class="text-muted" style="font-size:0.75rem;">{{ $item->total_qty }} units sold</div>
            </div>
            <div class="text-forest fw-bold small text-nowrap">Rs. {{ number_format($item->total_sales, 0) }}</div>
          </div>
        @empty
          <div class="text-center py-4 text-muted small">
            <i class="bi bi-basket fs-3 d-block mb-2"></i>
            No completed orders with items yet.
          </div>
        @endforelse
      </div>
    </div>

    <div class="col-12">
      <div class="card rounded-24 border-subtle shadow-xs bg-white p-4">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h6 class="font-serif mb-0 text-forest"><i class="bi bi-calendar-week me-2"></i>Upcoming Pickup Windows</h6>
          <a href="{{ route('farmer.pickup-slots.index') }}" class="btn btn-sm btn-outline-forest rounded-pill px-3 small">Manage Slots</a>
        </div>

        @forelse($upcomingSlots as $slot)
          <div class="d-flex align-items-center justify-content-between p-3 rounded-16 bg-light mb-2 flex-wrap gap-2">
            <div class="d-flex align-items-center gap-3">
              <div class="text-center rounded-12 bg-white shadow-xs px-3 py-2 border border-subtle" style="min-width:68px;">
                <div class="fw-bold text-forest fs-6">{{ \Carbon\Carbon::parse($slot->pickup_date)->format('d') }}</div>
                <div class="small text-muted">{{ \Carbon\Carbon::parse($slot->pickup_date)->format('M Y') }}</div>
              </div>
              <div>
                <div class="fw-semibold text-forest small">{{ $slot->market->market_name }}</div>
                <div class="text-muted" style="font-size:0.75rem;">
                  <i class="bi bi-clock me-1"></i>{{ date('h:i A', strtotime($slot->start_time)) }} – {{ date('h:i A', strtotime($slot->end_time)) }}
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center gap-2">
              <span class="badge {{ $slot->status === 'active' ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }} rounded-pill px-2 py-1 small">{{ ucfirst($slot->status) }}</span>
              <span class="badge bg-sage text-forest rounded-pill px-2 py-1 small">Capacity: {{ $slot->max_orders }}</span>
            </div>
          </div>
        @empty
          <div class="py-4 text-center text-muted small">
            <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
            No upcoming pickup slots found. <a href="{{ route('farmer.pickup-slots.create') }}" class="text-forest fw-semibold">Create a slot</a>
          </div>
        @endforelse
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  const monthlyData = @json($monthlySales);
  if (monthlyData.length > 0) {
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: monthlyData.map(d => d.month),
        datasets: [{
          label: 'Revenue (Rs.)',
          data: monthlyData.map(d => d.revenue),
          backgroundColor: 'rgba(20, 53, 29, 0.7)',
          borderColor: '#14351d',
          borderWidth: 2,
          borderRadius: 8,
          borderSkipped: false,
        }, {
          label: 'Orders',
          data: monthlyData.map(d => d.orders_count),
          backgroundColor: 'rgba(212, 175, 55, 0.5)',
          borderColor: '#d4af37',
          borderWidth: 2,
          type: 'line',
          yAxisID: 'y2',
          tension: 0.4,
          pointBackgroundColor: '#d4af37',
          pointRadius: 5,
        }]
      },
      options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
        plugins: {
          legend: { position: 'top', labels: { padding: 15, font: { size: 12 } } }
        },
        scales: {
          y: { type: 'linear', display: true, position: 'left', beginAtZero: true, ticks: { callback: v => 'Rs.' + v.toLocaleString() } },
          y2: { type: 'linear', display: true, position: 'right', beginAtZero: true, grid: { drawOnChartArea: false }, ticks: { stepSize: 1 } }
        }
      }
    });
  }
</script>
@endsection
