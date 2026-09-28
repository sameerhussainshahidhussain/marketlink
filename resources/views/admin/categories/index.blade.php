@extends('layouts.dashboard')

@section('title', 'Produce Categories | MarketLink Admin')
@section('page_title', 'Produce Categories')
@section('page_subtitle', $categories->total() . ' product categories for platform catalogue')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.categories.create') }}" class="btn btn-forest btn-sm rounded-pill px-3">
    <i class="bi bi-plus-lg me-1"></i> Add Category
  </a>
@endsection

@section('content')

  <div class="content-card">
    <div class="content-card-header">
      <div>
        <h5 class="font-serif text-forest mb-0">Product Classification</h5>
        <span class="small text-muted">Manage tags, descriptions and produce grouping</span>
      </div>
      <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-2 small">
        <i class="bi bi-tags me-1"></i> {{ $categories->total() }} Categories
      </span>
    </div>

    <div class="table-responsive">
      <table class="table table-custom align-middle mb-0">
        <thead>
          <tr>
            <th>Category Name</th>
            <th>URL Slug</th>
            <th>Description</th>
            <th>Active Products</th>
            <th>Status</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($categories as $cat)
            <tr>
              <td>
                <div class="d-flex align-items-center gap-2">
                  @if($cat->image)
                    <img src="{{ asset('storage/' . $cat->image) }}" class="rounded-circle object-fit-cover" style="width:32px; height:32px;">
                  @else
                    <div class="stat-icon green rounded-circle" style="width:32px; height:32px; font-size:0.9rem;">
                      <i class="bi bi-tag"></i>
                    </div>
                  @endif
                  <strong class="text-forest">{{ $cat->name }}</strong>
                </div>
              </td>
              <td><code>{{ $cat->slug }}</code></td>
              <td><span class="text-muted small">{{ Str::limit($cat->description, 45) ?? '—' }}</span></td>
              <td><strong class="text-forest">{{ $cat->products_count }}</strong> <span class="text-muted small">items</span></td>
              <td>
                <span class="badge-status {{ $cat->status === 'active' ? 'ready' : 'cancelled' }}">
                  <i class="bi bi-circle-fill" style="font-size:0.5rem;"></i>
                  {{ ucfirst($cat->status) }}
                </span>
              </td>
              <td class="text-end">
                <div class="d-flex justify-content-end gap-1">
                  <a href="{{ route('admin.categories.show', $cat) }}" class="btn btn-xs btn-outline-secondary rounded-pill px-2 py-1" title="View"><i class="bi bi-eye"></i></a>
                  <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-xs btn-outline-forest rounded-pill px-2 py-1" title="Edit"><i class="bi bi-pencil"></i></a>
                  <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Delete this category?');" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-xs btn-outline-danger rounded-pill px-2 py-1" title="Delete"><i class="bi bi-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-muted">
                <i class="bi bi-tags fs-2 mb-2 d-block text-muted"></i>
                No categories found. Click "Add Category" to create one.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($categories->hasPages())
      <div class="p-3 border-top border-subtle">
        {{ $categories->links() }}
      </div>
    @endif
  </div>

@endsection
