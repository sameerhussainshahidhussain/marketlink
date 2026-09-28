@extends('layouts.dashboard')

@section('title', 'Edit Category: ' . $category->name . ' | Admin | MarketLink')
@section('page_title', 'Edit Category')
@section('page_subtitle', 'Modifying parameters for category #' . $category->id . ' (' . $category->name . ')')

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-forest btn-sm rounded-pill px-3">
    <i class="bi bi-arrow-left me-1"></i> Back to Categories
  </a>
@endsection

@section('content')

  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="content-card">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">Edit Category Details</h5>
            <span class="small text-muted">URL Slug: <code>{{ $category->slug }}</code></span>
          </div>
          <span class="badge-status {{ $category->status === 'active' ? 'ready' : 'cancelled' }}">
            {{ ucfirst($category->status) }}
          </span>
        </div>

        <div class="content-card-body">
          <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
              <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control rounded-12" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Description</label>
              <textarea name="description" class="form-control rounded-12" rows="3">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Category Thumbnail</label>
              @if($category->image)
                <div class="mb-2 d-flex align-items-center gap-3 p-2 bg-light rounded-12 border border-subtle">
                  <img src="{{ asset('storage/' . $category->image) }}" class="rounded-circle object-fit-cover" style="width: 54px; height: 54px;">
                  <span class="small text-muted">Current image. Upload below to replace.</span>
                </div>
              @endif
              <input type="file" name="image" class="form-control rounded-12" accept="image/*">
              <span class="small text-muted mt-1 d-block">Leave blank to retain current image.</span>
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
              <select name="status" class="form-select rounded-12" required>
                <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>

            <div class="d-flex gap-2 justify-content-end pt-3 border-top border-subtle">
              <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
              <button type="submit" class="btn btn-forest rounded-pill px-4">Update Category</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
