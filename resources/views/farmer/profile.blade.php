@extends('layouts.dashboard')

@section('title', 'Farm Profile & Stall Info | MarketLink')
@section('page_title', 'Farm Profile & Stall Identity')
@section('page_subtitle', 'Manage your grower brand, contact details, bio, and farm coordinates')

@section('sidebar')
  @include('partials.farmer-sidebar')
@endsection

@section('content')
  <div class="row justify-content-center">
    <div class="col-lg-9">
      <div class="card rounded-24 border-subtle shadow-xs bg-white p-4">
        <form method="POST" action="{{ route('farmer.profile.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row g-4">
            <div class="col-12 d-flex align-items-center gap-4 pb-3 border-bottom">
              <div>
                @if($user->profile_image)
                  <img src="{{ asset('storage/' . $user->profile_image) }}" width="80" height="80" class="rounded-circle object-fit-cover shadow-sm border border-2 border-forest">
                @else
                  <div class="rounded-circle bg-forest text-gold d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 80px; height: 80px; font-size: 1.8rem;">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                  </div>
                @endif
              </div>
              <div>
                <h5 class="fw-bold font-serif mb-1">{{ $user->farmerProfile->business_name ?? $user->name }}</h5>
                <span class="badge {{ $user->farmerProfile?->approval_status === 'approved' ? 'bg-success' : 'bg-warning text-dark' }} rounded-pill text-uppercase px-3">
                  {{ $user->farmerProfile?->approval_status ?? 'Pending' }}
                </span>
                <p class="text-muted small mb-0 mt-1">Update your farm avatar or stall brand image below.</p>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-label small fw-bold text-forest">Primary Contact Name *</label>
              <input type="text" name="name" class="form-control rounded-12" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="col-md-6">
              <label class="form-label small fw-bold text-forest">Farm / Stall Brand Name *</label>
              <input type="text" name="business_name" class="form-control rounded-12" value="{{ old('business_name', $user->farmerProfile->business_name ?? '') }}" required>
            </div>

            <div class="col-md-6">
              <label class="form-label small fw-bold text-forest">Contact Phone</label>
              <input type="tel" name="phone" class="form-control rounded-12" value="{{ old('phone', $user->phone) }}" placeholder="+1 (555) 000-0000">
            </div>

            <div class="col-md-6">
              <label class="form-label small fw-bold text-forest">Region / City Name</label>
              <input type="text" name="location_name" class="form-control rounded-12" value="{{ old('location_name', $user->farmerProfile->location_name ?? '') }}" placeholder="e.g. Hudson Valley, NY">
            </div>

            <div class="col-12">
              <label class="form-label small fw-bold text-forest">Farm Physical Address</label>
              <input type="text" name="address" class="form-control rounded-12" value="{{ old('address', $user->farmerProfile->address ?? '') }}" placeholder="123 Orchard Lane, Green Valley">
            </div>

            <div class="col-md-6">
              <label class="form-label small fw-bold text-forest">Latitude (Optional)</label>
              <input type="number" step="any" name="latitude" class="form-control rounded-12" value="{{ old('latitude', $user->farmerProfile->latitude ?? '') }}" placeholder="e.g. 40.7128">
            </div>

            <div class="col-md-6">
              <label class="form-label small fw-bold text-forest">Longitude (Optional)</label>
              <input type="number" step="any" name="longitude" class="form-control rounded-12" value="{{ old('longitude', $user->farmerProfile->longitude ?? '') }}" placeholder="e.g. -74.0060">
            </div>

            <div class="col-12">
              <label class="form-label small fw-bold text-forest">Farm Story, Soil & Growing Practices</label>
              <textarea name="description" rows="4" class="form-control rounded-16" placeholder="Describe your organic cultivation methods, heritage varieties, and sustainable farming philosophy...">{{ old('description', $user->farmerProfile->description ?? '') }}</textarea>
            </div>

            <div class="col-12">
              <label class="form-label small fw-bold text-forest">Update Stall / Profile Image</label>
              <input type="file" name="image" class="form-control rounded-12" accept="image/*">
              <div class="form-text small">Accepted formats: JPG, PNG, WEBP (Max 2MB).</div>
            </div>
          </div>

          <div class="mt-4 pt-3 border-top d-flex justify-content-end">
            <button type="submit" class="btn btn-forest rounded-pill px-4 py-2 shadow-xs">
              <i class="bi bi-check-lg me-1"></i> Save Farm Profile
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
