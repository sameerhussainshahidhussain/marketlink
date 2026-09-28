@extends('layouts.dashboard')

@section('title', 'Manage Customers | Admin – MarketLink')
@section('page_title', 'Customer Accounts')
@section('page_subtitle', 'View and manage registered marketplace customers')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('content')
  
  <div class="card p-3 rounded-20 border-subtle shadow-xs bg-white mb-4">
    <form method="GET" action="{{ route('admin.customers.index') }}" class="row g-2 align-items-end">
      <div class="col-md-5">
        <input type="text" name="search" class="form-control rounded-12" placeholder="Search by name, email, or phone..." value="{{ request('search') }}">
      </div>
      <div class="col-md-3">
        <select name="status" class="form-select rounded-12">
          <option value="">All Statuses</option>
          <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
          <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
        </select>
      </div>
      <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-forest rounded-pill flex-fill">Filter</button>
        @if(request()->hasAny(['search','status']))
          <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary rounded-pill flex-fill">Reset</a>
        @endif
      </div>
    </form>
  </div>

  <div class="card rounded-24 border-subtle shadow-xs bg-white overflow-hidden">
    <div class="card-header bg-white border-bottom border-subtle py-3 px-4 d-flex justify-content-between align-items-center">
      <h6 class="font-serif mb-0"><i class="bi bi-person-badge text-forest me-2"></i>Registered Customers ({{ $customers->total() }})</h6>
    </div>

    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th class="ps-4">Customer</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Total Orders</th>
            <th>Joined</th>
            <th class="pe-4 text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($customers as $customer)
            <tr>
              <td class="ps-4">
                <div class="d-flex align-items-center gap-2">
                  <div class="rounded-circle bg-sage d-flex align-items-center justify-content-center text-forest fw-bold" style="width:38px;height:38px;font-size:1rem;flex-shrink:0;">
                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                  </div>
                  <div>
                    <div class="fw-semibold text-forest small">{{ $customer->name }}</div>
                    <div class="text-muted" style="font-size:0.75rem;">{{ $customer->email }}</div>
                  </div>
                </div>
              </td>
              <td class="small text-muted">{{ $customer->phone ?? '—' }}</td>
              <td>
                @if($customer->status === 'active')
                  <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1 small">Active</span>
                @else
                  <span class="badge bg-danger-subtle text-danger rounded-pill px-2 py-1 small">Suspended</span>
                @endif
              </td>
              <td>
                <span class="badge bg-sage text-forest rounded-pill px-2 py-1 small">{{ $customer->orders_count }} orders</span>
              </td>
              <td class="small text-muted">{{ $customer->created_at->format('M d, Y') }}</td>
              <td class="text-end pe-4">
                <div class="d-flex justify-content-end gap-2">
                  <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-xs btn-outline-forest rounded-pill px-2 py-1 small">
                    <i class="bi bi-eye"></i> View
                  </a>
                  <form method="POST" action="{{ route('admin.customers.toggle', $customer) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-xs {{ $customer->status === 'active' ? 'btn-outline-danger' : 'btn-outline-success' }} rounded-pill px-2 py-1 small"
                            onclick="return confirm('{{ $customer->status === 'active' ? 'Suspend' : 'Activate' }} this customer?')">
                      {{ $customer->status === 'active' ? 'Suspend' : 'Activate' }}
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-muted">
                <i class="bi bi-people fs-2 d-block mb-2"></i>
                No customers found matching your filters.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($customers->hasPages())
      <div class="card-footer bg-white border-top border-subtle py-3 px-4 d-flex justify-content-center">
        {{ $customers->links() }}
      </div>
    @endif
  </div>
@endsection
