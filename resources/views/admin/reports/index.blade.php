@extends('layouts.dashboard')

@section('title', 'Sales & Performance Reports | MarketLink Admin')
@section('page_title', 'Platform Analytics & Settlement Reports')
@section('page_subtitle', 'Period: ' . \Carbon\Carbon::parse($from)->format('M d, Y') . ' to ' . \Carbon\Carbon::parse($to)->format('M d, Y'))

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.reports.export', ['from' => $from, 'to' => $to]) }}" class="btn btn-sm btn-forest rounded-pill px-3">
    <i class="bi bi-download me-1"></i> Export Orders CSV
  </a>
@endsection

@section('content')

  <div class="content-card mb-4">
    <div class="content-card-body p-3">
      <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-3 align-items-end">
        <div class="col-md-4">
          <label class="form-label small fw-bold text-muted">From Date</label>
          <input type="date" name="from" value="{{ $from }}" class="form-control rounded-12">
        </div>
        <div class="col-md-4">
          <label class="form-label small fw-bold text-muted">To Date</label>
          <input type="date" name="to" value="{{ $to }}" class="form-control rounded-12">
        </div>
        <div class="col-md-4">
          <button class="btn btn-forest rounded-pill w-100 py-2">
            <i class="bi bi-calendar-check me-1"></i> Apply Filter
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="row g-4">
    
    <div class="col-lg-6">
      <div class="content-card h-100 mb-0">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">Top Performing Growers</h5>
            <span class="small text-muted">Ranked by gross sales volume</span>
          </div>
          <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-1 small">
            Gross Volume
          </span>
        </div>
        <div class="table-responsive">
          <table class="table table-custom align-middle mb-0">
            <thead>
              <tr>
                <th>Grower / Farm</th>
                <th>Orders</th>
                <th class="text-end">Total Gross Revenue</th>
              </tr>
            </thead>
            <tbody>
              @forelse($revenueByFarmer as $row)
                <tr>
                  <td><strong class="text-forest">{{ $row->farmer->farmerProfile->business_name ?? $row->farmer->name }}</strong></td>
                  <td><span class="badge bg-light text-forest border rounded-pill px-3 py-1">{{ $row->orders }}</span></td>
                  <td class="text-end fw-bold text-forest">Rs. {{ number_format($row->revenue, 2) }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="text-center py-5 text-muted">
                    <i class="bi bi-bar-chart fs-2 text-muted mb-2 d-block"></i>
                    No completed orders found in this date window.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="content-card h-100 mb-0">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">Top Harvest Produce Sold</h5>
            <span class="small text-muted">Most popular items ordered by consumers</span>
          </div>
          <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-1 small">
            Sales Leaderboard
          </span>
        </div>
        <div class="table-responsive">
          <table class="table table-custom align-middle mb-0">
            <thead>
              <tr>
                <th>Produce Item</th>
                <th>Units Sold</th>
                <th class="text-end">Gross Sales</th>
              </tr>
            </thead>
            <tbody>
              @forelse($topProducts as $item)
                <tr>
                  <td><strong class="text-forest">{{ $item->product_name }}</strong></td>
                  <td><span class="badge bg-light text-forest border rounded-pill px-3 py-1">{{ $item->qty_sold }} units</span></td>
                  <td class="text-end fw-bold text-forest">Rs. {{ number_format($item->revenue, 2) }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="text-center py-5 text-muted">
                    <i class="bi bi-basket3 fs-2 text-muted mb-2 d-block"></i>
                    No produce sales recorded in this date window.
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
