@extends('layouts.dashboard')

@section('title', 'Edit Market: ' . $market->market_name . ' | Admin | MarketLink')
@section('page_title', 'Edit Farmers Market')
@section('page_subtitle', 'Modifying parameters for ' . $market->market_name . ' in ' . $market->city)

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.markets.index') }}" class="btn btn-outline-forest btn-sm rounded-pill px-3">
    <i class="bi bi-arrow-left me-1"></i> Back to Markets
  </a>
@endsection

@section('content')

  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="content-card">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">Update Market Details</h5>
            <span class="small text-muted">ID: #{{ $market->id }} • {{ $market->city }}</span>
          </div>
          <span class="badge-status {{ $market->status === 'active' ? 'ready' : 'cancelled' }}">
            {{ ucfirst($market->status) }}
          </span>
        </div>

        <div class="content-card-body">
          <form action="{{ route('admin.markets.update', $market) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
              <div class="col-md-8">
                <label class="form-label fw-semibold">Market Name <span class="text-danger">*</span></label>
                <input type="text" name="market_name" value="{{ old('market_name', $market->market_name) }}" class="form-control rounded-12" required>
              </div>

              <div class="col-md-4">
                <label class="form-label fw-semibold">City <span class="text-danger">*</span></label>
                <input type="text" name="city" value="{{ old('city', $market->city) }}" class="form-control rounded-12" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-semibold">Physical Address <span class="text-danger">*</span></label>
                <input type="text" name="address" value="{{ old('address', $market->address) }}" class="form-control rounded-12" required>
              </div>

              <div class="col-12">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control rounded-12" rows="3">{{ old('description', $market->description) }}</textarea>
              </div>

              <div class="col-md-4">
                <label class="form-label fw-semibold">Operating Days <span class="text-danger">*</span></label>
                <input type="text" name="operating_days" value="{{ old('operating_days', $market->operating_days) }}" class="form-control rounded-12" placeholder="e.g. Saturday, Sunday" required>
              </div>

              <div class="col-md-4">
                <label class="form-label fw-semibold">Opening Time <span class="text-danger">*</span></label>
                <input type="time" name="opening_time" value="{{ old('opening_time', $market->opening_time ? \Carbon\Carbon::parse($market->opening_time)->format('H:i') : '') }}" class="form-control rounded-12" required>
              </div>

              <div class="col-md-4">
                <label class="form-label fw-semibold">Closing Time <span class="text-danger">*</span></label>
                <input type="time" name="closing_time" value="{{ old('closing_time', $market->closing_time ? \Carbon\Carbon::parse($market->closing_time)->format('H:i') : '') }}" class="form-control rounded-12" required>
              </div>

              <div class="col-md-3">
                <label class="form-label fw-semibold">Latitude</label>
                <input type="text" name="latitude" value="{{ old('latitude', $market->latitude) }}" class="form-control rounded-12" placeholder="e.g. 31.5204">
              </div>

              <div class="col-md-3">
                <label class="form-label fw-semibold">Longitude</label>
                <input type="text" name="longitude" value="{{ old('longitude', $market->longitude) }}" class="form-control rounded-12" placeholder="e.g. 74.3587">
              </div>

              <div class="col-md-3">
                <label class="form-label fw-semibold">Map Provider</label>
                <select name="map_provider" class="form-select rounded-12">
                  <option value="openstreetmap" {{ old('map_provider', $market->map_provider) == 'openstreetmap' ? 'selected' : '' }}>OpenStreetMap</option>
                  <option value="google" {{ old('map_provider', $market->map_provider) == 'google' ? 'selected' : '' }}>Google Maps</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select rounded-12" required>
                  <option value="active" {{ old('status', $market->status) == 'active' ? 'selected' : '' }}>Active</option>
                  <option value="inactive" {{ old('status', $market->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
              </div>

              <div class="col-12 d-flex gap-2 justify-content-end pt-3 border-top border-subtle mt-4">
                <a href="{{ route('admin.markets.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
                <button type="submit" class="btn btn-forest rounded-pill px-4">Update Market</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
