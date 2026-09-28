<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produce Item | MarketLink Farmer</title>
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
          <h5 class="font-serif mb-0">Edit Produce • {{ $product->name }}</h5>
        </div>
        <div class="topbar-right">
          <a href="{{ route('farmer.products.index') }}" class="btn btn-sm btn-outline-forest rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Products
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
          <form method="POST" action="{{ route('farmer.products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
              <div class="col-md-8">
                <label class="form-label small fw-bold">Produce Name</label>
                <input type="text" name="name" class="form-control rounded-12" value="{{ old('name', $product->name) }}" required>
              </div>

              <div class="col-md-4">
                <label class="form-label small fw-bold">Category</label>
                <select name="category_id" class="form-select rounded-12" required>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-4">
                <label class="form-label small fw-bold">Price (Rs.)</label>
                <input type="number" step="0.01" name="price" class="form-control rounded-12" value="{{ old('price', $product->price) }}" required>
              </div>

              <div class="col-md-4">
                <label class="form-label small fw-bold">Unit</label>
                <select name="unit" class="form-select rounded-12" required>
                  <option value="kg" {{ old('unit', $product->unit) == 'kg' ? 'selected' : '' }}>kg (Kilogram)</option>
                  <option value="bunch" {{ old('unit', $product->unit) == 'bunch' ? 'selected' : '' }}>bunch</option>
                  <option value="head" {{ old('unit', $product->unit) == 'head' ? 'selected' : '' }}>head</option>
                  <option value="dozen" {{ old('unit', $product->unit) == 'dozen' ? 'selected' : '' }}>dozen</option>
                  <option value="jar" {{ old('unit', $product->unit) == 'jar' ? 'selected' : '' }}>jar</option>
                  <option value="litre" {{ old('unit', $product->unit) == 'litre' ? 'selected' : '' }}>litre</option>
                  <option value="packet" {{ old('unit', $product->unit) == 'packet' ? 'selected' : '' }}>packet</option>
                </select>
              </div>

              <div class="col-md-4">
                <label class="form-label small fw-bold">Stock Quantity</label>
                <input type="number" name="stock_quantity" class="form-control rounded-12" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0" required>
              </div>

              <div class="col-12">
                <label class="form-label small fw-bold">Description & Harvest Notes</label>
                <textarea name="description" rows="3" class="form-control rounded-16">{{ old('description', $product->description) }}</textarea>
              </div>

              <div class="col-md-6">
                <label class="form-label small fw-bold">Replace Image (Optional)</label>
                <input type="file" name="image" class="form-control rounded-12" accept="image/*">
                <div class="mt-2">
                  <img src="{{ $product->image_url }}" width="60" height="60" class="rounded-12 object-fit-cover">
                  <span class="small text-muted ms-2">Current Image</span>
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-label small fw-bold">Listing Status</label>
                <select name="status" class="form-select rounded-12" required>
                  <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                  <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
              </div>
            </div>

            <div class="mt-4 pt-3 border-top d-flex gap-2">
              <button type="submit" class="btn btn-forest rounded-pill px-4 py-2">
                <i class="bi bi-check-lg me-1"></i> Update Produce
              </button>
              <a href="{{ route('farmer.products.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
