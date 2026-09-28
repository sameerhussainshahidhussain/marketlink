<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Produce Inventory | MarketLink Farmer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body class="dashboard-body role-farmer">
  <div class="dashboard-wrapper dashboard-farmer-wrapper">
    <div class="sidebar-overlay"></div>
    @include('partials.farmer-sidebar')

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn"><i class="bi bi-list fs-5"></i></button>
          <h5 class="font-serif mb-0">Harvest Produce Inventory ({{ $products->total() }})</h5>
        </div>
        <div class="topbar-right">
          <a href="{{ route('farmer.products.create') }}" class="btn btn-sm btn-forest rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Add Produce Item
          </a>
        </div>
      </header>

      <div class="dashboard-container">
        @if(session('success'))
          <div class="alert alert-success py-2 rounded-12 small mb-4">{{ session('success') }}</div>
        @endif

        <div class="content-card">
          
          <form method="GET" action="{{ route('farmer.products.index') }}" class="row g-2 mb-4">
            <div class="col-md-5">
              <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-12" placeholder="Search by product name...">
            </div>
            <div class="col-md-3">
              <select name="category" class="form-select rounded-12">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <select name="status" class="form-select rounded-12">
                <option value="">All Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>
            <div class="col-md-2">
              <button class="btn btn-forest rounded-pill w-100">Filter</button>
            </div>
          </form>

          <div class="table-responsive">
            <table class="table table-custom align-middle">
              <thead>
                <tr>
                  <th>Produce Item</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Stock Available</th>
                  <th>Availability</th>
                  <th>Status</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($products as $prod)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-3">
                        <img src="{{ $prod->image_url }}" class="rounded-12 object-fit-cover" width="45" height="45" alt="{{ $prod->name }}">
                        <div>
                          <strong class="d-block text-forest">{{ $prod->name }}</strong>
                          <span class="small text-muted">{{ $prod->unit }}</span>
                        </div>
                      </div>
                    </td>
                    <td><span class="badge bg-light text-forest border rounded-pill">{{ $prod->category->name ?? 'Produce' }}</span></td>
                    <td class="fw-bold text-forest">Rs. {{ number_format($prod->price, 2) }}</td>
                    <td>
                      <span class="{{ $prod->stock_quantity <= 5 ? 'text-danger fw-bold' : '' }}">{{ $prod->stock_quantity }} {{ $prod->unit }}s</span>
                    </td>
                    <td>
                      @php
                        $avBadge = match($prod->availability) {
                          'available' => 'bg-success',
                          'low_stock' => 'bg-warning text-dark',
                          default => 'bg-danger'
                        };
                      @endphp
                      <span class="badge {{ $avBadge }} rounded-pill px-2 py-1 small">{{ str_replace('_', ' ', $prod->availability) }}</span>
                    </td>
                    <td>
                      <form method="POST" action="{{ route('farmer.products.toggle', $prod) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="badge {{ $prod->status === 'active' ? 'bg-success' : 'bg-secondary' }} border-0 rounded-pill px-2 py-1 cursor-pointer">
                          {{ $prod->status }}
                        </button>
                      </form>
                    </td>
                    <td class="text-end">
                      <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('farmer.products.edit', $prod) }}" class="btn btn-sm btn-outline-forest rounded-pill px-3" title="Edit">
                          <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('farmer.products.destroy', $prod) }}" onsubmit="return confirm('Delete this product?');" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Delete">
                            <i class="bi bi-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="7" class="text-center py-5 text-muted">No produce found. Click "Add Produce Item" to list your harvest.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-4">
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
