@extends('layouts.dashboard')

@section('title', 'Manage Platform Users | MarketLink Admin')
@section('page_title', 'Platform Users Directory')
@section('page_subtitle', $users->total() . ' registered users across customers, farmers & admins')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('content')

  <div class="content-card">
    <div class="content-card-header">
      <div>
        <h5 class="font-serif text-forest mb-0">Registered Accounts</h5>
        <span class="small text-muted">Filter and manage access permissions</span>
      </div>
      <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-2 small">
        <i class="bi bi-people me-1"></i> {{ $users->total() }} Users
      </span>
    </div>

    <div class="p-3 bg-light border-bottom border-subtle">
      <form method="GET" action="{{ route('admin.users.index') }}" class="row g-2 align-items-center">
        <div class="col-md-5">
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
            <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search by user name or email...">
          </div>
        </div>
        <div class="col-md-3">
          <select name="role" class="form-select">
            <option value="">All Roles</option>
            <option value="customer" {{ request('role') == 'customer' ? 'selected' : '' }}>Customer</option>
            <option value="farmer" {{ request('role') == 'farmer' ? 'selected' : '' }}>Farmer</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
          </select>
        </div>
        <div class="col-md-2">
          <select name="status" class="form-select">
            <option value="">All Statuses</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
          </select>
        </div>
        <div class="col-md-2">
          <button class="btn btn-forest rounded-pill w-100">
            <i class="bi bi-funnel me-1"></i> Filter
          </button>
        </div>
      </form>
    </div>

    <div class="table-responsive">
      <table class="table table-custom align-middle mb-0">
        <thead>
          <tr>
            <th>User</th>
            <th>Role</th>
            <th>Contact Info</th>
            <th>Status</th>
            <th>Joined Date</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
            <tr>
              <td>
                <strong class="d-block text-forest">{{ $user->name }}</strong>
                <span class="small text-muted">{{ $user->email }}</span>
              </td>
              <td>
                @php
                  $roleBadge = match($user->role) {
                    'admin' => 'bg-danger text-white',
                    'farmer' => 'bg-success text-white',
                    default => 'bg-forest-subtle text-forest'
                  };
                @endphp
                <span class="badge {{ $roleBadge }} rounded-pill px-3 py-1 text-uppercase small">{{ $user->role }}</span>
              </td>
              <td>{{ $user->phone ?? '—' }}</td>
              <td>
                <span class="badge-status {{ $user->status === 'active' ? 'ready' : 'cancelled' }}">
                  <i class="bi bi-circle-fill" style="font-size:0.5rem;"></i>
                  {{ ucfirst($user->status) }}
                </span>
              </td>
              <td>{{ $user->created_at->format('M d, Y') }}</td>
              <td class="text-end">
                <div class="d-flex gap-1 justify-content-end align-items-center">
                  <a href="{{ route('admin.users.show', $user) }}" class="btn btn-xs btn-outline-secondary rounded-pill px-2 py-1" title="View"><i class="bi bi-eye"></i></a>
                  <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-xs btn-outline-forest rounded-pill px-2 py-1" title="Edit"><i class="bi bi-pencil"></i></a>
                  <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-xs {{ $user->status === 'active' ? 'btn-outline-warning' : 'btn-outline-success' }} rounded-pill px-2 py-1">
                      {{ $user->status === 'active' ? 'Suspend' : 'Activate' }}
                    </button>
                  </form>
                  @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Delete this user?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-xs btn-outline-danger rounded-pill px-2 py-1" title="Delete">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-muted">
                <i class="bi bi-people fs-2 mb-2 d-block text-muted"></i>
                No users found matching current filters.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($users->hasPages())
      <div class="p-3 border-top border-subtle">
        {{ $users->links() }}
      </div>
    @endif
  </div>

@endsection
