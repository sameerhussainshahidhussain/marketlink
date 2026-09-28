@extends('layouts.dashboard')

@section('title', 'Edit Announcement | MarketLink Admin')
@section('page_title', 'Edit Announcement')
@section('page_subtitle', 'Modifying broadcast bulletin #' . $announcement->id)

@section('sidebar')
  @include('partials.admin-sidebar')
@endsection

@section('topbar_right')
  <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline-forest btn-sm rounded-pill px-3">
    <i class="bi bi-arrow-left me-1"></i> Back to Announcements
  </a>
@endsection

@section('content')

  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="content-card">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">Edit Bulletin Content</h5>
            <span class="small text-muted">Update headline, priority type, or status</span>
          </div>
          <span class="badge-status {{ $announcement->status === 'published' ? 'ready' : 'cancelled' }}">
            {{ ucfirst($announcement->status) }}
          </span>
        </div>

        <div class="content-card-body">
          <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label small fw-bold">Headline / Title <span class="text-danger">*</span></label>
              <input type="text" name="title" value="{{ old('title', $announcement->title) }}" class="form-control rounded-12" required>
            </div>

            <div class="row g-2 mb-3">
              <div class="col-6">
                <label class="form-label small fw-bold">Type <span class="text-danger">*</span></label>
                <select name="type" class="form-select rounded-12" required>
                  <option value="info" {{ old('type', $announcement->type) == 'info' ? 'selected' : '' }}>Info</option>
                  <option value="warning" {{ old('type', $announcement->type) == 'warning' ? 'selected' : '' }}>Warning</option>
                  <option value="success" {{ old('type', $announcement->type) == 'success' ? 'selected' : '' }}>Success</option>
                  <option value="danger" {{ old('type', $announcement->type) == 'danger' ? 'selected' : '' }}>Urgent</option>
                </select>
              </div>

              <div class="col-6">
                <label class="form-label small fw-bold">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select rounded-12" required>
                  <option value="published" {{ old('status', $announcement->status) == 'published' ? 'selected' : '' }}>Published</option>
                  <option value="draft" {{ old('status', $announcement->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label small fw-bold">Message Details <span class="text-danger">*</span></label>
              <textarea name="message" class="form-control rounded-12" rows="5" required>{{ old('message', $announcement->message) }}</textarea>
            </div>

            <div class="d-flex gap-2 justify-content-end pt-3 border-top border-subtle">
              <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
              <button type="submit" class="btn btn-forest rounded-pill px-4">Update Announcement</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
