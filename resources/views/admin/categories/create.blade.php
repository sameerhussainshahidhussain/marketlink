@extends('layouts.dashboard')

@section('title', 'Add Category | Admin | MarketLink')
@section('page_title', 'Create Produce Category')
@section('page_subtitle', 'Group products by department or seasonal harvest type')

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
            <h5 class="font-serif text-forest mb-0">Category Specifications</h5>
            <span class="small text-muted">Enter naming, description and thumbnail graphic</span>
          </div>
        </div>

        <div class="content-card-body">
          <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
              <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-12" placeholder="e.g. Fresh Fruits" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Description</label>
              <textarea name="description" class="form-control rounded-12" rows="3" placeholder="Brief description of the produce group...">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Featured Thumbnail Image</label>
              <input type="file" name="image" class="form-control rounded-12" accept="image/*">
              <span class="small text-muted mt-1 d-block">Recommended square image: JPEG, PNG, JPG, or WEBP (Max 2MB)</span>
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">Catalog Status <span class="text-danger">*</span></label>
              <select name="status" class="form-select rounded-12" required>
                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', 'inactive') == 'inactive' ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>

            <div class="d-flex gap-2 justify-content-end pt-3 border-top border-subtle">
              <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
              <button type="submit" class="btn btn-forest rounded-pill px-4">Save Category</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
