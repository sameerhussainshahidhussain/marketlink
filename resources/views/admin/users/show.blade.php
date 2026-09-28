@extends('layouts.dashboard')

@section('title', 'User: ' . $user->name . ' | Admin | MarketLink')
@section('page_title', 'User Profile: ' . $user->name)
@section('page_subtitle', 'Role: ' . ucfirst($user->role) . ' • Joined ' . $user->created_at->format('M Y'))

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <div class="d-flex gap-2">
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-forest btn-sm rounded-pill px-3">
      <i class="bi bi-arrow-left me-1"></i> Back to Users
    </a>
    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-forest btn-sm rounded-pill px-3">
      <i class="bi bi-pencil me-1"></i> Edit User
    </a>
  </div>
@endsection

@section('content')

  <div class="row g-4">
    
    <div class="col-lg-5">
      <div class="content-card">
        <div class="content-card-body text-center p-4">
          <div class="stat-icon bg-forest-subtle text-forest rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 76px; height: 76px; font-size: 2.2rem;">
            <i class="bi bi-person-circle"></i>
          </div>
          <h4 class="font-serif text-forest mb-1">{{ $user->name }}</h4>
          <p class="text-muted small mb-3">{{ $user->email }}</p>
          <div class="d-flex justify-content-center gap-2 mb-4">
            <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : ($user->role === 'farmer' ? 'bg-success' : 'bg-forest-subtle text-forest') }} rounded-pill px-3 py-1 text-uppercase small">
              {{ $user->role }}
            </span>
            <span class="badge-status {{ $user->status === 'active' ? 'ready' : 'cancelled' }}">
              {{ ucfirst($user->status) }}
            </span>
          </div>
          
          <div class="text-start border-top border-subtle pt-3">
            <div class="d-flex justify-content-between py-2 border-bottom border-subtle">
              <span class="text-muted small">Phone</span>
              <strong class="small">{{ $user->phone ?? 'Not provided' }}</strong>
            </div>
            <div class="d-flex justify-content-between py-2 border-bottom border-subtle">
              <span class="text-muted small">Address</span>
              <strong class="small">{{ $user->address ?? 'Not provided' }}</strong>
            </div>
            <div class="d-flex justify-content-between py-2 border-bottom border-subtle">
              <span class="text-muted small">Account ID</span>
              <strong class="small">#{{ $user->id }}</strong>
            </div>
            <div class="d-flex justify-content-between py-2">
              <span class="text-muted small">Member Since</span>
              <strong class="small">{{ $user->created_at->format('M d, Y') }}</strong>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-7">
      @if($user->role === 'farmer' && $user->farmerProfile)
        <div class="content-card mb-4">
          <div class="content-card-header">
            <h6 class="font-serif text-forest mb-0">Farmer Profile Details</h6>
            <span class="badge {{ $user->farmerProfile->approval_status === 'approved' ? 'bg-success' : 'bg-warning text-dark' }} rounded-pill px-3 py-1 small">
              {{ ucfirst($user->farmerProfile->approval_status) }}
            </span>
          </div>
          <div class="content-card-body">
            <div class="mb-3">
              <span class="text-muted small d-block">Stall / Business Name</span>
              <strong class="text-forest fs-6">{{ $user->farmerProfile->business_name }}</strong>
            </div>
            <div class="mb-3">
              <span class="text-muted small d-block">Farm Location</span>
              <span>{{ $user->farmerProfile->location_name ?? $user->farmerProfile->address ?? 'Not specified' }}</span>
            </div>
            @if($user->farmerProfile->description)
              <div>
                <span class="text-muted small d-block">Farm Description</span>
                <p class="text-muted small mb-0 mt-1">{{ $user->farmerProfile->description }}</p>
              </div>
            @endif
          </div>
        </div>

        <div class="content-card">
          <div class="content-card-header">
            <h6 class="font-serif text-forest mb-0">Listed Produce Items ({{ $user->products->count() }})</h6>
          </div>
          <div class="content-card-body p-0">
            @forelse($user->products as $prod)
              <div class="d-flex justify-content-between align-items-center p-3 border-bottom border-subtle">
                <div>
                  <strong class="text-forest d-block">{{ $prod->name }}</strong>
                  <span class="small text-muted">Rs. {{ number_format($prod->price, 2) }} / {{ $prod->unit }} • Stock: {{ $prod->stock_quantity }}</span>
                </div>
                <span class="badge-status {{ $prod->status === 'active' ? 'ready' : 'cancelled' }}">
                  {{ ucfirst($prod->status) }}
                </span>
              </div>
            @empty
              <p class="text-muted small p-4 text-center mb-0">No produce items listed yet.</p>
            @endforelse
          </div>
        </div>
      @else
        <div class="content-card">
          <div class="content-card-header">
            <h6 class="font-serif text-forest mb-0">Recent Orders ({{ $user->orders->count() }})</h6>
          </div>
          <div class="content-card-body p-0">
            @forelse($user->orders->take(10) as $ord)
              <div class="d-flex justify-content-between align-items-center p-3 border-bottom border-subtle">
                <div>
                  <strong class="text-forest d-block">Order #{{ $ord->order_number ?? $ord->id }}</strong>
                  <span class="small text-muted">{{ $ord->created_at->format('M d, Y') }} • Rs. {{ number_format($ord->total_amount, 2) }}</span>
                </div>
                <span class="badge-status {{ $ord->order_status === 'completed' ? 'completed' : ($ord->order_status === 'cancelled' ? 'cancelled' : 'placed') }}">
                  {{ ucfirst($ord->order_status) }}
                </span>
              </div>
            @empty
              <p class="text-muted small p-4 text-center mb-0">No pre-orders placed yet.</p>
            @endforelse
          </div>
        </div>
      @endif
    </div>
  </div>

@endsection
