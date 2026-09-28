<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Stock Template | Farmer Portal</title>
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
          <div>
            <h5 class="font-serif mb-0">Edit Template: {{ $stockTemplate->name }}</h5>
            <span class="small text-muted"><a href="{{ route('farmer.stock-templates.index') }}" class="text-muted text-decoration-none">Templates</a> &rsaquo; Edit</span>
          </div>
        </div>
      </header>

      <div class="dashboard-container">
        @if($errors->any())
          <div class="alert alert-danger rounded-12 small mb-4">
            <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
          </div>
        @endif

        <div class="card border-0 shadow-sm rounded-12">
          <div class="card-body p-4">
            <form action="{{ route('farmer.stock-templates.update', $stockTemplate) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="row g-3 mb-4">
                <div class="col-md-5">
                  <label class="form-label fw-semibold">Template Name <span class="text-danger">*</span></label>
                  <input type="text" name="name" value="{{ old('name', $stockTemplate->name) }}" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label fw-semibold">Day of Week <span class="text-danger">*</span></label>
                  <select name="day_of_week" class="form-select" required>
                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                      <option value="{{ $day }}" {{ old('day_of_week', $stockTemplate->day_of_week) == $day ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-select" required>
                    <option value="active" {{ old('status', $stockTemplate->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $stockTemplate->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                  </select>
                </div>
              </div>

              <h6 class="font-serif text-forest mb-3">Template Items <span class="text-danger">*</span></h6>
              <div id="itemsContainer">
                @foreach($stockTemplate->items as $idx => $item)
                  <div class="row g-2 align-items-center mb-3 p-3 bg-light rounded-8 item-row">
                    <div class="col-md-5">
                      <label class="form-label small fw-semibold">Product</label>
                      <select name="items[{{ $idx }}][product_id]" class="form-select" required>
                        @foreach($products as $prod)
                          <option value="{{ $prod->id }}" {{ $item->product_id == $prod->id ? 'selected' : '' }}>
                            {{ $prod->name }} (Rs. {{ number_format($prod->price, 2) }}/{{ $prod->unit }})
                          </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label class="form-label small fw-semibold">Default Quantity</label>
                      <input type="number" name="items[{{ $idx }}][default_quantity]" value="{{ $item->default_quantity }}" min="1" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                      <label class="form-label small fw-semibold">Default Price (Rs.)</label>
                      <input type="number" step="0.01" name="items[{{ $idx }}][default_price]" value="{{ $item->default_price }}" min="0" class="form-control" required>
                    </div>
                    <div class="col-md-1 d-flex align-items-end pt-3">
                      <button type="button" class="btn btn-outline-danger btn-sm w-100 remove-item-btn" onclick="this.closest('.item-row').remove()"><i class="bi bi-x-lg"></i></button>
                    </div>
                  </div>
                @endforeach
              </div>

              <div class="d-flex gap-2 pt-3">
                <button type="submit" class="btn btn-forest px-4">Update Template</button>
                <a href="{{ route('farmer.stock-templates.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
