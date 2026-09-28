<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Announcement | MarketLink Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>
<body>
<div class="dashboard-wrapper">
  <div class="sidebar-overlay"></div>
  @include('partials.admin-sidebar')
  <main class="dashboard-main">
    <header class="dashboard-topbar">
      <div class="topbar-left">
        <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn"><i class="bi bi-list fs-5"></i></button>
        <div>
          <h5 class="font-serif mb-0">Create Announcement</h5>
          <span class="small text-muted"><a href="{{ route('admin.announcements.index') }}" class="text-muted text-decoration-none">Announcements</a> &rsaquo; Create</span>
        </div>
      </div>
    </header>
    <div class="dashboard-container">
      @if($errors->any())
        <div class="alert alert-danger rounded-12 small mb-4">
          <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
      @endif

      <div class="card border-0 shadow-sm rounded-12" style="max-width: 700px;">
        <div class="card-body p-4">
          <form action="{{ route('admin.announcements.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label small fw-bold">Headline / Title <span class="text-danger">*</span></label>
              <input type="text" name="title" value="{{ old('title') }}" class="form-control rounded-12" required>
            </div>
            <div class="row g-2 mb-3">
              <div class="col-6">
                <label class="form-label small fw-bold">Type <span class="text-danger">*</span></label>
                <select name="type" class="form-select rounded-12" required>
                  <option value="info" {{ old('type') == 'info' ? 'selected' : '' }}>Info</option>
                  <option value="warning" {{ old('type') == 'warning' ? 'selected' : '' }}>Warning</option>
                  <option value="success" {{ old('type') == 'success' ? 'selected' : '' }}>Success</option>
                  <option value="danger" {{ old('type') == 'danger' ? 'selected' : '' }}>Danger</option>
                </select>
              </div>
              <div class="col-6">
                <label class="form-label small fw-bold">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select rounded-12" required>
                  <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Published</option>
                  <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
              </div>
            </div>
            <div class="mb-4">
              <label class="form-label small fw-bold">Message Details <span class="text-danger">*</span></label>
              <textarea name="message" class="form-control rounded-12" rows="5" required>{{ old('message') }}</textarea>
            </div>
            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-forest px-4">Create Announcement</button>
              <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
