@extends('layouts.dashboard')

@section('title', 'Pending Farmer Approvals | MarketLink Admin')
@section('page_title', 'Farmer Partner Applications')
@section('page_subtitle', $farmers->total() . ' application(s) awaiting verification')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('content')

  <div class="content-card">
    <div class="content-card-header">
      <div>
        <h5 class="font-serif text-forest mb-0">Pending Stall Credentials</h5>
        <span class="small text-muted">Review grower details before enabling public selling rights</span>
      </div>
      <span class="badge bg-warning text-dark rounded-pill px-3 py-2 small">
        <i class="bi bi-clock-history me-1"></i> {{ $farmers->total() }} Pending
      </span>
    </div>

    <div class="table-responsive">
      <table class="table table-custom align-middle mb-0">
        <thead>
          <tr>
            <th>Farm / Business</th>
            <th>Contact Person</th>
            <th>Email & Phone</th>
            <th>Location & Story</th>
            <th>Application Date</th>
            <th class="text-end">Verification Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($farmers as $farmer)
            <tr>
              <td>
                <strong class="text-forest d-block">{{ $farmer->farmerProfile->business_name ?? 'Farm Stall' }}</strong>
                <span class="badge-status pending">Pending Approval</span>
              </td>
              <td class="fw-semibold">{{ $farmer->name }}</td>
              <td>
                <div>{{ $farmer->email }}</div>
                <span class="small text-muted">{{ $farmer->phone ?? 'No phone' }}</span>
              </td>
              <td>
                <span class="small d-block text-forest fw-medium">{{ $farmer->farmerProfile->location_name ?? 'Local Farm' }}</span>
                <span class="small text-muted">{{ Str::limit($farmer->farmerProfile->description ?? '', 60) }}</span>
              </td>
              <td>{{ $farmer->created_at->format('M d, Y') }}</td>
              <td class="text-end">
                <div class="d-flex gap-2 justify-content-end">
                  <form method="POST" action="{{ route('admin.farmers.approve', $farmer) }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-forest rounded-pill px-3">
                      <i class="bi bi-check-lg me-1"></i> Approve
                    </button>
                  </form>
                  <form method="POST" action="{{ route('admin.farmers.suspend', $farmer) }}" onsubmit="return confirm('Reject/suspend this application?');">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                      Reject
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5">
                <i class="bi bi-check-circle-fill text-success fs-2 mb-2 d-block"></i>
                <h6 class="font-serif text-forest mb-1">All Caught Up!</h6>
                <p class="small text-muted mb-0">No pending farmer applications. All farmers are currently vetted.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($farmers->hasPages())
      <div class="p-3 border-top border-subtle">
        {{ $farmers->links() }}
      </div>
    @endif
  </div>

@endsection
