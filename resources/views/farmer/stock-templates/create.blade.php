<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Stock Template | Farmer Portal</title>
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
            <h5 class="font-serif mb-0">Create Stock Template</h5>
            <span class="small text-muted"><a href="{{ route('farmer.stock-templates.index') }}" class="text-muted text-decoration-none">Templates</a> &rsaquo; Create</span>
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
            <form action="{{ route('farmer.stock-templates.store') }}" method="POST">
              @csrf
              <div class="row g-3 mb-4">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Template Name <span class="text-danger">*</span></label>
                  <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="e.g. Weekend Stall Stock" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-semibold">Day of Week <span class="text-danger">*</span></label>
                  <select name="day_of_week" class="form-select" required>
                    <option value="">Select Day</option>
                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                      <option value="{{ $day }}" {{ old('day_of_week') == $day ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <h6 class="font-serif text-forest mb-3">Template Items <span class="text-danger">*</span></h6>
              <div id="itemsContainer">
                @if($products->count() > 0)
                  @foreach($products as $idx => $prod)
                    <div class="row g-2 align-items-center mb-3 p-3 bg-light rounded-8 item-row">
                      <div class="col-md-5">
                        <label class="form-label small fw-semibold">Product</label>
                        <select name="items[{{ $idx }}][product_id]" class="form-select product-select" required>
                          <option value="{{ $prod->id }}">{{ $prod->name }} (Rs. {{ number_format($prod->price, 2) }}/{{ $prod->unit }})</option>
                        </select>
                      </div>
                      <div class="col-md-3">
                        <label class="form-label small fw-semibold">Default Quantity ({{ $prod->unit }})</label>
                        <input type="number" name="items[{{ $idx }}][default_quantity]" value="10" min="1" class="form-control" required>
                      </div>
                      <div class="col-md-3">
                        <label class="form-label small fw-semibold">Default Price (Rs.)</label>
                        <input type="number" step="0.01" name="items[{{ $idx }}][default_price]" value="{{ $prod->price }}" min="0" class="form-control" required>
                      </div>
                      <div class="col-md-1 d-flex align-items-end pt-3">
                        <button type="button" class="btn btn-outline-danger btn-sm w-100 remove-item-btn" onclick="this.closest('.item-row').remove()"><i class="bi bi-x-lg"></i></button>
                      </div>
                    </div>
                  @endforeach
                @else
                  <div class="alert alert-warning">You do not have any active products to add to a template. Please add products first.</div>
                @endif
              </div>

              @if($products->count() > 0)
                <div class="d-flex gap-2 pt-3">
                  <button type="submit" class="btn btn-forest px-4">Save Template</button>
                  <a href="{{ route('farmer.stock-templates.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                </div>
              @endif
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
