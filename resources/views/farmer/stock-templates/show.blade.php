<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $stockTemplate->name }} | Farmer Portal</title>
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
            <h5 class="font-serif mb-0">Template: {{ $stockTemplate->name }}</h5>
            <span class="small text-muted"><a href="{{ route('farmer.stock-templates.index') }}" class="text-muted text-decoration-none">Templates</a> &rsaquo; Details</span>
          </div>
        </div>
        <div class="topbar-right d-flex gap-2">
          <a href="{{ route('farmer.stock-templates.edit', $stockTemplate) }}" class="btn btn-forest btn-sm rounded-pill"><i class="bi bi-pencil me-1"></i> Edit Template</a>
        </div>
      </header>

      <div class="dashboard-container">
        <div class="card border-0 shadow-sm rounded-12 mb-4">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h5 class="font-serif mb-1">{{ $stockTemplate->name }}</h5>
                <span class="badge bg-sage text-forest">{{ $stockTemplate->day_of_week }}</span>
                <span class="badge {{ $stockTemplate->status === 'active' ? 'bg-success' : 'bg-secondary' }} ms-1">{{ ucfirst($stockTemplate->status) }}</span>
              </div>
            </div>
          </div>
        </div>

        <div class="card border-0 shadow-sm rounded-12">
          <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
            <h6 class="font-serif mb-0">Scheduled Stock Items</h6>
          </div>
          <div class="card-body p-4">
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead class="table-light">
                  <tr>
                    <th>Product</th>
                    <th>Default Quantity</th>
                    <th>Default Price</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($stockTemplate->items as $item)
                    <tr>
                      <td>
                        <strong>{{ $item->product->name ?? 'Deleted Product' }}</strong>
                      </td>
                      <td>{{ $item->default_quantity }} {{ $item->product->unit ?? 'units' }}</td>
                      <td class="text-forest fw-bold">Rs. {{ number_format($item->default_price, 2) }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
