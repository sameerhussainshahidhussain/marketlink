<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $product->name }} | Product Details | Farmer Portal</title>
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
            <h5 class="font-serif mb-0">{{ $product->name }}</h5>
            <span class="small text-muted"><a href="{{ route('farmer.products.index') }}" class="text-muted text-decoration-none">Products</a> &rsaquo; Details</span>
          </div>
        </div>
        <div class="topbar-right d-flex gap-2">
          <a href="{{ route('farmer.products.edit', $product) }}" class="btn btn-sm btn-forest rounded-pill px-3"><i class="bi bi-pencil me-1"></i> Edit Product</a>
        </div>
      </header>

      <div class="dashboard-container">
        <div class="row g-4">
          <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-12 overflow-hidden">
              <img src="{{ $product->image_url }}" class="card-img-top" style="height: 320px; object-fit: cover;">
              <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="badge bg-sage text-forest">{{ $product->category->name ?? 'Uncategorized' }}</span>
                  <span class="badge {{ $product->status === 'active' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($product->status) }}</span>
                </div>
                <h4 class="font-serif text-forest mb-2">{{ $product->name }}</h4>
                <h5 class="text-forest mb-3">Rs. {{ number_format($product->price, 2) }} <span class="small text-muted fw-normal">/ {{ $product->unit }}</span></h5>
                <p class="text-muted mb-0">{{ $product->description ?? 'No description provided.' }}</p>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-12 mb-4">
              <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                <h6 class="font-serif mb-0">Inventory Details</h6>
              </div>
              <div class="card-body p-4">
                <div class="row g-3">
                  <div class="col-6">
                    <div class="p-3 bg-light rounded-8">
                      <span class="small text-muted d-block">Current Stock</span>
                      <strong class="fs-5 {{ $product->stock_quantity <= 5 ? 'text-danger' : 'text-forest' }}">{{ $product->stock_quantity }} {{ $product->unit }}</strong>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="p-3 bg-light rounded-8">
                      <span class="small text-muted d-block">Price / Unit</span>
                      <strong class="fs-5 text-forest">Rs. {{ number_format($product->price, 2) }}</strong>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card border-0 shadow-sm rounded-12">
              <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                <h6 class="font-serif mb-0">Quick Actions</h6>
              </div>
              <div class="card-body p-4 d-flex gap-2">
                <a href="{{ route('farmer.products.edit', $product) }}" class="btn btn-outline-forest"><i class="bi bi-pencil me-1"></i> Edit Details</a>
                <form action="{{ route('farmer.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash me-1"></i> Delete</button>
                </form>
              </div>
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
