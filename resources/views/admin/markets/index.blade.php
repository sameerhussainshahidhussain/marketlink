@extends('layouts.dashboard')

@section('title', 'Farmers Markets | MarketLink Admin')
@section('page_title', 'Regional Farmers Markets')
@section('page_subtitle', $markets->total() . ' physical markets registered for pre-order collection')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.markets.create') }}" class="btn btn-forest btn-sm rounded-pill px-3">
    <i class="bi bi-plus-lg me-1"></i> Add New Market
  </a>
@endsection

@section('content')

  <div class="content-card">
    <div class="content-card-header">
      <div>
        <h5 class="font-serif text-forest mb-0">Active Locations Directory</h5>
        <span class="small text-muted">Weekly pop-up and fixed market schedules</span>
      </div>
      <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-2 small">
        <i class="bi bi-shop me-1"></i> {{ $markets->total() }} Markets
      </span>
    </div>

    <div class="table-responsive">
      <table class="table table-custom align-middle mb-0">
        <thead>
          <tr>
            <th>Market Name</th>
            <th>City & Address</th>
            <th>Operating Days</th>
            <th>Hours</th>
            <th>Registered Growers</th>
            <th>Status</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($markets as $market)
            <tr>
              <td>
                <strong class="text-forest d-block">{{ $market->market_name }}</strong>
                <span class="small text-muted">ID: #{{ $market->id }}</span>
              </td>
              <td>
                <span class="fw-semibold">{{ $market->city }}</span>
                <span class="small text-muted d-block">{{ $market->address }}</span>
              </td>
              <td>
                <span class="badge bg-light text-forest border rounded-pill px-3 py-1">{{ $market->operating_days }}</span>
              </td>
              <td class="small">{{ date('h:i A', strtotime($market->opening_time)) }} - {{ date('h:i A', strtotime($market->closing_time)) }}</td>
              <td>
                <strong class="text-forest">{{ $market->farmers_count }}</strong> <span class="text-muted small">stalls</span>
              </td>
              <td>
                <form method="POST" action="{{ route('admin.markets.toggle', $market) }}" class="d-inline">
                  @csrf
                  <button type="submit" class="badge-status {{ $market->status === 'active' ? 'ready' : 'cancelled' }} border-0" title="Click to toggle status">
                    <i class="bi bi-circle-fill" style="font-size:0.5rem;"></i>
                    {{ ucfirst($market->status) }}
                  </button>
                </form>
              </td>
              <td class="text-end">
                <div class="d-flex gap-1 justify-content-end align-items-center">
                  <a href="{{ route('admin.markets.show', $market) }}" class="btn btn-xs btn-outline-secondary rounded-pill px-2 py-1" title="View"><i class="bi bi-eye"></i></a>
                  <a href="{{ route('admin.markets.edit', $market) }}" class="btn btn-xs btn-outline-forest rounded-pill px-2 py-1" title="Edit"><i class="bi bi-pencil"></i></a>
                  <a href="{{ route('markets.show', $market) }}" class="btn btn-xs btn-outline-forest rounded-pill px-2 py-1" target="_blank" title="Public Page">
                    <i class="bi bi-box-arrow-up-right"></i>
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-5 text-muted">
                <i class="bi bi-shop fs-2 mb-2 d-block text-muted"></i>
                No farmers markets registered yet. Click "Add New Market" to create one.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($markets->hasPages())
      <div class="p-3 border-top border-subtle">
        {{ $markets->links() }}
      </div>
    @endif
  </div>

@endsection
