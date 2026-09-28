@extends('layouts.dashboard')

@section('title', 'Manage Farmers | Admin – MarketLink')
@section('page_title', 'Farmer Management')
@section('page_subtitle', 'Review, approve, suspend and monitor all registered growers')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.farmers.pending') }}" class="btn btn-sm btn-warning rounded-pill px-3">
    <i class="bi bi-person-exclamation me-1"></i> Pending Approvals
  </a>
@endsection

@section('content')
  
  <div class="card p-3 rounded-20 border-subtle shadow-xs bg-white mb-4">
    <form method="GET" action="{{ route('admin.farmers.index') }}" class="row g-2 align-items-end">
      <div class="col-md-4">
        <input type="text" name="search" class="form-control rounded-12" placeholder="Search by name, email, business..." value="{{ request('search') }}">
      </div>
      <div class="col-md-3">
        <select name="status" class="form-select rounded-12">
          <option value="">All Statuses</option>
          <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
          <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
          <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        </select>
      </div>
      <div class="col-md-3">
        <select name="approval_status" class="form-select rounded-12">
          <option value="">All Approval Status</option>
          <option value="approved" {{ request('approval_status') === 'approved' ? 'selected' : '' }}>Approved</option>
          <option value="pending" {{ request('approval_status') === 'pending' ? 'selected' : '' }}>Awaiting Approval</option>
          <option value="suspended" {{ request('approval_status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>
      </div>
      <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-forest rounded-pill flex-fill">Filter</button>
        @if(request()->hasAny(['search','status','approval_status']))
          <a href="{{ route('admin.farmers.index') }}" class="btn btn-outline-secondary rounded-pill flex-fill">Reset</a>
        @endif
      </div>
    </form>
  </div>

  <div class="card rounded-24 border-subtle shadow-xs bg-white overflow-hidden">
    <div class="card-header bg-white border-bottom border-subtle py-3 px-4 d-flex justify-content-between align-items-center">
      <h6 class="font-serif mb-0"><i class="bi bi-people text-forest me-2"></i>Registered Growers ({{ $farmers->total() }})</h6>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th class="ps-4">Grower</th>
            <th>Business / Farm</th>
            <th>Status</th>
            <th>Approval</th>
            <th>Products</th>
            <th>Joined</th>
            <th class="pe-4 text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($farmers as $farmer)
            <tr>
              <td class="ps-4">
                <div class="d-flex align-items-center gap-2">
                  <img src="{{ $farmer->profile_image ? asset('storage/' . $farmer->profile_image) : 'https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=100&auto=format&fit=crop&q=80' }}" class="rounded-circle object-fit-cover" width="38" height="38" alt="{{ $farmer->name }}">
                  <div>
                    <div class="fw-semibold text-forest small">{{ $farmer->name }}</div>
                    <div class="text-muted" style="font-size:0.75rem;">{{ $farmer->email }}</div>
                  </div>
                </div>
              </td>
              <td>
                <div class="small fw-semibold">{{ $farmer->farmerProfile->business_name ?? '—' }}</div>
                <div class="text-muted" style="font-size:0.75rem;">{{ $farmer->farmerProfile->location_name ?? '' }}</div>
              </td>
              <td>
                @if($farmer->status === 'active')
                  <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1 small">Active</span>
                @elseif($farmer->status === 'suspended')
                  <span class="badge bg-danger-subtle text-danger rounded-pill px-2 py-1 small">Suspended</span>
                @else
                  <span class="badge bg-warning-subtle text-warning rounded-pill px-2 py-1 small">Pending</span>
                @endif
              </td>
              <td>
                @if($farmer->farmerProfile?->approval_status === 'approved')
                  <span class="badge bg-forest text-white rounded-pill px-2 py-1 small">Approved</span>
                @elseif($farmer->farmerProfile?->approval_status === 'pending')
                  <span class="badge bg-warning-subtle text-warning rounded-pill px-2 py-1 small">Awaiting</span>
                @elseif($farmer->farmerProfile?->approval_status === 'suspended')
                  <span class="badge bg-danger-subtle text-danger rounded-pill px-2 py-1 small">Suspended</span>
                @else
                  <span class="badge bg-secondary-subtle text-secondary rounded-pill px-2 py-1 small">—</span>
                @endif
              </td>
              <td>
                <span class="badge bg-sage text-forest rounded-pill px-2 py-1 small">{{ $farmer->products->count() }}</span>
              </td>
              <td class="small text-muted">{{ $farmer->created_at->format('M d, Y') }}</td>
              <td class="text-end pe-4">
                <div class="d-flex justify-content-end gap-2 flex-nowrap">
                  <a href="{{ route('admin.farmers.show', $farmer) }}" class="btn btn-xs btn-outline-forest rounded-pill px-2 py-1 small">
                    <i class="bi bi-eye"></i> View
                  </a>
                  @if($farmer->farmerProfile?->approval_status !== 'approved')
                    <form method="POST" action="{{ route('admin.farmers.approve', $farmer) }}" class="d-inline">
                      @csrf
                      <button type="submit" class="btn btn-xs btn-success rounded-pill px-2 py-1 small" onclick="return confirm('Approve this farmer?')">
                        Approve
                      </button>
                    </form>
                  @endif
                  @if($farmer->status === 'active')
                    <form method="POST" action="{{ route('admin.farmers.suspend', $farmer) }}" class="d-inline">
                      @csrf
                      <button type="submit" class="btn btn-xs btn-outline-danger rounded-pill px-2 py-1 small" onclick="return confirm('Suspend this farmer account?')">
                        Suspend
                      </button>
                    </form>
                  @elseif($farmer->status === 'suspended')
                    <form method="POST" action="{{ route('admin.farmers.activate', $farmer) }}" class="d-inline">
                      @csrf
                      <button type="submit" class="btn btn-xs btn-warning rounded-pill px-2 py-1 small" onclick="return confirm('Re-activate this farmer?')">
                        Activate
                      </button>
                    </form>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-5 text-muted">
                <i class="bi bi-person-x fs-2 d-block mb-2"></i>
                No farmers found matching your filters.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($farmers->hasPages())
      <div class="card-footer bg-white border-top border-subtle py-3 px-4 d-flex justify-content-center">
        {{ $farmers->links() }}
      </div>
    @endif
  </div>
@endsection
