@extends('layouts.dashboard')

@section('title', 'Manage All Products | MarketLink Admin')
@section('page_title', 'Produce Catalog Moderation')
@section('page_subtitle', $products->total() . ' produce items listed across all farmer partners')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('products.index') }}" target="_blank" class="btn btn-outline-forest btn-sm rounded-pill px-3">
    <i class="bi bi-box-arrow-up-right me-1"></i> Public Catalog
  </a>
@endsection

@section('content')

  <div class="content-card">
    <div class="content-card-header">
      <div>
        <h5 class="font-serif text-forest mb-0">Produce Moderation Stream</h5>
        <span class="small text-muted">Toggle listing availability and inspect items</span>
      </div>
      <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-2 small">
        <i class="bi bi-grid me-1"></i> {{ $products->total() }} Products
      </span>
    </div>

    <div class="table-responsive">
      <table class="table table-custom align-middle mb-0">
        <thead>
          <tr>
            <th>Product</th>
            <th>Grower / Farm</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($products as $prod)
            <tr>
              <td>
                <div class="d-flex align-items-center gap-3">
                  <img src="{{ $prod->image_url }}" width="44" height="44" class="rounded-12 object-fit-cover shadow-xs">
                  <div>
                    <strong class="text-forest d-block">{{ $prod->name }}</strong>
                    <span class="small text-muted">ID: #{{ $prod->id }}</span>
                  </div>
                </div>
              </td>
              <td>
                <span class="fw-medium text-forest">{{ $prod->farmer->farmerProfile->business_name ?? $prod->farmer->name }}</span>
              </td>
              <td><span class="badge bg-light text-forest border rounded-pill px-3 py-1">{{ $prod->category->name }}</span></td>
              <td class="fw-bold text-forest">Rs. {{ number_format($prod->price, 2) }} <span class="small fw-normal text-muted">/ {{ $prod->unit }}</span></td>
              <td>{{ $prod->stock_quantity }} {{ $prod->unit }}</td>
              <td>
                <form method="POST" action="{{ route('admin.products.toggle', $prod) }}" class="d-inline">
                  @csrf
                  <button type="submit" class="badge-status {{ $prod->status === 'active' ? 'ready' : 'cancelled' }} border-0" title="Click to toggle status">
                    <i class="bi bi-circle-fill" style="font-size:0.5rem;"></i>
                    {{ ucfirst($prod->status) }}
                  </button>
                </form>
              </td>
              <td class="text-end">
                <a href="{{ route('admin.products.show', $prod) }}" class="btn btn-xs btn-outline-forest rounded-pill px-3">
                  <i class="bi bi-eye me-1"></i> Inspect
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-5 text-muted">
                <i class="bi bi-basket3 fs-2 text-muted mb-2 d-block"></i>
                No produce items found in the marketplace.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($products->hasPages())
      <div class="p-3 border-top border-subtle">
        {{ $products->links() }}
      </div>
    @endif
  </div>

@endsection
