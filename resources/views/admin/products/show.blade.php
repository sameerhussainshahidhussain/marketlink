@extends('layouts.dashboard')

@section('title', $product->name . ' | Product Moderation | Admin')
@section('page_title', $product->name)
@section('page_subtitle', 'Produce Item #' . $product->id . ' • ' . ($product->category->name ?? 'Produce'))

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <div class="d-flex gap-2">
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-forest btn-sm rounded-pill px-3">
      <i class="bi bi-arrow-left me-1"></i> Back to Catalog
    </a>
    <form method="POST" action="{{ route('admin.products.toggle', $product) }}" class="d-inline">
      @csrf
      <button type="submit" class="btn btn-sm {{ $product->status === 'active' ? 'btn-outline-warning' : 'btn-outline-success' }} rounded-pill px-3">
        <i class="bi {{ $product->status === 'active' ? 'bi-pause-circle' : 'bi-play-circle' }} me-1"></i>
        {{ $product->status === 'active' ? 'Deactivate Listing' : 'Activate Listing' }}
      </button>
    </form>
  </div>
@endsection

@section('content')

  <div class="row g-4">
    
    <div class="col-lg-5">
      <div class="content-card mb-4 overflow-hidden">
        <img src="{{ $product->image_url }}" class="w-100 object-fit-cover" style="height: 260px;">
        <div class="content-card-body p-4">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-1">{{ $product->category->name ?? 'Uncategorized' }}</span>
            <span class="badge-status {{ $product->status === 'active' ? 'ready' : 'cancelled' }}">
              {{ ucfirst($product->status) }}
            </span>
          </div>
          <h4 class="font-serif text-forest mb-2">{{ $product->name }}</h4>
          <h5 class="text-forest mb-3">Rs. {{ number_format($product->price, 2) }} <span class="small text-muted fw-normal">/ {{ $product->unit }}</span></h5>
          <p class="text-muted small mb-3">{{ $product->description ?? 'No detailed description provided by grower.' }}</p>

          <div class="p-3 bg-light rounded-12 border border-subtle">
            <span class="small text-muted d-block">Current Stock Available</span>
            <strong class="text-forest fs-5">{{ $product->stock_quantity }} {{ $product->unit }}</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-7">
      <div class="content-card mb-4">
        <div class="content-card-header">
          <div>
            <h6 class="font-serif text-forest mb-0">Producer / Grower Stall</h6>
            <span class="small text-muted">Owner of this produce listing</span>
          </div>
          <a href="{{ route('admin.users.show', $product->farmer) }}" class="btn btn-xs btn-outline-forest rounded-pill px-3">
            Farmer Profile
          </a>
        </div>
        <div class="content-card-body">
          <div class="row g-2">
            <div class="col-sm-6">
              <span class="small text-muted d-block">Farm Stall</span>
              <strong class="text-forest">{{ $product->farmer->farmerProfile->business_name ?? '—' }}</strong>
            </div>
            <div class="col-sm-6">
              <span class="small text-muted d-block">Contact Name</span>
              <span>{{ $product->farmer->name }}</span>
            </div>
            <div class="col-sm-6 mt-2">
              <span class="small text-muted d-block">Email</span>
              <span>{{ $product->farmer->email }}</span>
            </div>
            <div class="col-sm-6 mt-2">
              <span class="small text-muted d-block">Phone</span>
              <span>{{ $product->farmer->phone ?? 'Not provided' }}</span>
            </div>
          </div>
        </div>
      </div>

      <div class="content-card">
        <div class="content-card-header">
          <div>
            <h6 class="font-serif text-forest mb-0">Customer Feedback ({{ $product->reviews->count() }})</h6>
            <span class="small text-muted">Verified buyer ratings</span>
          </div>
        </div>
        <div class="content-card-body p-0">
          @forelse($product->reviews as $rev)
            <div class="p-3 border-bottom border-subtle">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <strong>{{ $rev->customer->name ?? 'Shopper' }}</strong>
                <div class="text-warning">
                  @for($i = 1; $i <= 5; $i++)
                    <i class="bi bi-star{{ $i <= $rev->rating ? '-fill' : '' }}"></i>
                  @endfor
                </div>
              </div>
              <p class="text-muted small mb-1">{{ $rev->comment }}</p>
              <span class="text-muted small">{{ $rev->created_at->format('M d, Y') }}</span>
            </div>
          @empty
            <div class="text-center py-5">
              <i class="bi bi-star fs-2 text-muted mb-2 d-block"></i>
              <p class="text-muted small mb-0">No customer reviews for this product yet.</p>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>

@endsection
