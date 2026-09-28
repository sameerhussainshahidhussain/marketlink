@extends('layouts.dashboard')

@section('title', 'Edit User: ' . $user->name . ' | Admin | MarketLink')
@section('page_title', 'Edit User Account')
@section('page_subtitle', 'Modifying credentials and platform permissions for ' . $user->name)

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.users.index') }}" class="btn btn-outline-forest btn-sm rounded-pill px-3">
    <i class="bi bi-arrow-left me-1"></i> Back to Users
  </a>
@endsection

@section('content')

  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="content-card">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">User Account Settings</h5>
            <span class="small text-muted">Update contact details, role type and account status</span>
          </div>
          <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }} rounded-pill px-3 py-1 small">
            {{ ucfirst($user->status) }}
          </span>
        </div>

        <div class="content-card-body">
          <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
              <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control rounded-12" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control rounded-12" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Phone Number</label>
              <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control rounded-12" placeholder="e.g. 0300-1234567">
            </div>

            <div class="row g-3 mb-4">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                <select name="role" class="form-select rounded-12" required>
                  <option value="customer" {{ old('role', $user->role) === 'customer' ? 'selected' : '' }}>Customer</option>
                  <option value="farmer" {{ old('role', $user->role) === 'farmer' ? 'selected' : '' }}>Farmer</option>
                  <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label fw-semibold">Account Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select rounded-12" required>
                  <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Active</option>
                  <option value="suspended" {{ old('status', $user->status) === 'suspended' ? 'selected' : '' }}>Suspended</option>
                  <option value="pending" {{ old('status', $user->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
              </div>
            </div>

            <div class="d-flex gap-2 justify-content-end pt-3 border-top border-subtle">
              <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
              <button type="submit" class="btn btn-forest rounded-pill px-4">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
