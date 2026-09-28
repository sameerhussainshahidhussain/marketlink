<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Pickup Slot | MarketLink Farmer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body>
  <div class="dashboard-wrapper">
    <div class="sidebar-overlay"></div>
    @include('partials.farmer-sidebar')

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn"><i class="bi bi-list fs-5"></i></button>
          <h5 class="font-serif mb-0">Schedule New Pickup Slot</h5>
        </div>
        <div class="topbar-right">
          <a href="{{ route('farmer.pickup-slots.index') }}" class="btn btn-sm btn-outline-forest rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back
          </a>
        </div>
      </header>

      <div class="dashboard-container">
        @if(isset($errors) && $errors->any())
          <div class="alert alert-danger py-2 rounded-12 small mb-4">
            <ul class="mb-0 ps-3">
              @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="content-card max-w-700">
          <form method="POST" action="{{ route('farmer.pickup-slots.store') }}">
            @csrf

            <div class="row g-3">
              <div class="col-md-12">
                <label class="form-label small fw-bold">Select Farmers Market</label>
                <select name="market_id" class="form-select rounded-12" required>
                  <option value="">Choose Market Location</option>
                  @foreach($markets as $m)
                    <option value="{{ $m->id }}" {{ old('market_id') == $m->id ? 'selected' : '' }}>{{ $m->market_name }} ({{ $m->city }})</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label small fw-bold">Pickup Date</label>
                <input type="date" name="pickup_date" class="form-control rounded-12" value="{{ old('pickup_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
              </div>

              <div class="col-md-3">
                <label class="form-label small fw-bold">Start Time</label>
                <input type="time" name="start_time" class="form-control rounded-12" value="{{ old('start_time', '09:00') }}" required>
              </div>

              <div class="col-md-3">
                <label class="form-label small fw-bold">End Time</label>
                <input type="time" name="end_time" class="form-control rounded-12" value="{{ old('end_time', '12:00') }}" required>
              </div>

              <div class="col-md-6">
                <label class="form-label small fw-bold">Max Order Capacity</label>
                <input type="number" name="max_orders" class="form-control rounded-12" value="{{ old('max_orders', 25) }}" min="1" max="200" required>
                <span class="small text-muted">Maximum number of pre-orders you can fulfill in this window</span>
              </div>

              <div class="col-md-6">
                <label class="form-label small fw-bold">Order Cutoff Deadline</label>
                <input type="datetime-local" name="cutoff_time" class="form-control rounded-12" value="{{ old('cutoff_time') }}" required>
                <span class="small text-muted">Cutoff time after which customers cannot place new orders</span>
              </div>
            </div>

            <div class="mt-4 pt-3 border-top d-flex gap-2">
              <button type="submit" class="btn btn-forest rounded-pill px-4 py-2">
                <i class="bi bi-check-lg me-1"></i> Schedule Pickup Slot
              </button>
              <a href="{{ route('farmer.pickup-slots.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
