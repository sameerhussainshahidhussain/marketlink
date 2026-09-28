@extends('layouts.dashboard')

@section('title', $category->name . ' | Admin | MarketLink')
@section('page_title', $category->name)
@section('page_subtitle', 'Produce Category • ' . $category->products->count() . ' items listed')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <div class="d-flex gap-2">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-forest btn-sm rounded-pill px-3">
      <i class="bi bi-arrow-left me-1"></i> Back to Categories
    </a>
    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-forest btn-sm rounded-pill px-3">
      <i class="bi bi-pencil me-1"></i> Edit Category
    </a>
  </div>
@endsection

@section('content')

  <div class="content-card mb-4">
    <div class="content-card-body p-4">
      <div class="d-flex align-items-center gap-3 mb-3">
        @if($category->image)
          <img src="{{ asset('storage/' . $category->image) }}" class="rounded-circle object-fit-cover shadow-sm" style="width: 64px; height: 64px;">
        @else
          <div class="stat-icon green rounded-circle" style="width: 64px; height: 64px; font-size: 1.8rem;">
            <i class="bi bi-tags"></i>
          </div>
        @endif
        <div>
          <h4 class="font-serif text-forest mb-1">{{ $category->name }}</h4>
          <div class="d-flex align-items-center gap-2">
            <span class="badge-status {{ $category->status === 'active' ? 'ready' : 'cancelled' }}">
              {{ ucfirst($category->status) }}
            </span>
            <span class="text-muted small">Slug: <code>{{ $category->slug }}</code></span>
          </div>
        </div>
      </div>
      <p class="text-muted mb-0">{{ $category->description ?? 'No description provided for this produce category.' }}</p>
    </div>
  </div>

  <div class="content-card">
    <div class="content-card-header">
      <div>
        <h5 class="font-serif text-forest mb-0">Products in this Category</h5>
        <span class="small text-muted">{{ $category->products->count() }} produce items currently listed</span>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-custom align-middle mb-0">
        <thead>
          <tr>
            <th>Product</th>
            <th>Farmer</th>
            <th>Price</th>
            <th>Stock Available</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($category->products as $prod)
            <tr>
              <td><strong class="text-forest">{{ $prod->name }}</strong></td>
              <td>{{ $prod->farmer->farmerProfile->business_name ?? $prod->farmer->name ?? '—' }}</td>
              <td class="fw-bold text-forest">Rs. {{ number_format($prod->price, 2) }} <span class="small fw-normal text-muted">/ {{ $prod->unit }}</span></td>
              <td>{{ $prod->stock_quantity }} {{ $prod->unit }}</td>
              <td>
                <span class="badge-status {{ $prod->status === 'active' ? 'ready' : 'cancelled' }}">
                  {{ ucfirst($prod->status) }}
                </span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center py-5 text-muted">
                <i class="bi bi-basket3 fs-2 text-muted mb-2 d-block"></i>
                No produce items found in this category.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection
