@extends('layouts.dashboard')

@section('title', 'Customer Profile & Settings | MarketLink')
@section('page_title', 'Account Profile & Preferences')
@section('page_subtitle', 'Manage your contact details, pickup preferences, and security settings')

@section('sidebar')
  @include('partials.customer-sidebar')
@endsection

@section('content')
  <div class="row g-4">
    <div class="col-lg-7">
      <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white">
        <h5 class="font-serif text-forest mb-3"><i class="bi bi-person me-2"></i>Personal Information</h5>
        <form method="POST" action="{{ route('customer.profile.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label class="form-label small fw-bold">Full Name</label>
            <input type="text" name="name" class="form-control rounded-12" value="{{ old('name', $user->name) }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">Email Address</label>
            <input type="email" class="form-control rounded-12 bg-light" value="{{ $user->email }}" disabled>
            <span class="small text-muted">Email address cannot be changed</span>
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">Phone Number</label>
            <input type="tel" name="phone" class="form-control rounded-12" value="{{ old('phone', $user->phone) }}" placeholder="+92 300 1234567">
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">Default Delivery / Pickup Address</label>
            <input type="text" name="address" class="form-control rounded-12" value="{{ old('address', $user->address) }}" placeholder="Your address or district">
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">Profile Picture</label>
            @if($user->profile_image)
              <div class="mb-2">
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="rounded-circle object-fit-cover" style="width:50px;height:50px;">
              </div>
            @endif
            <input type="file" name="image" class="form-control rounded-12" accept="image/*">
          </div>

          <button type="submit" class="btn btn-forest rounded-pill px-4 py-2 mt-2">
            <i class="bi bi-check-lg me-1"></i> Update Profile
          </button>
        </form>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="card p-4 rounded-24 border-subtle shadow-xs bg-white">
        <h5 class="font-serif text-forest mb-3"><i class="bi bi-shield-lock me-2"></i>Change Password</h5>
        <form method="POST" action="{{ route('customer.profile.password') }}">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label class="form-label small fw-bold">Current Password</label>
            <input type="password" name="current_password" class="form-control rounded-12" required>
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">New Password</label>
            <input type="password" name="password" class="form-control rounded-12" placeholder="Min. 8 characters" required>
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control rounded-12" required>
          </div>

          <button type="submit" class="btn btn-outline-forest rounded-pill px-4 py-2 mt-2">
            <i class="bi bi-shield-lock me-1"></i> Change Password
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
