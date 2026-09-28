<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $announcement->title }} | MarketLink Admin</title>
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
          <h5 class="font-serif mb-0">{{ $announcement->title }}</h5>
          <span class="small text-muted"><a href="{{ route('admin.announcements.index') }}" class="text-muted text-decoration-none">Announcements</a> &rsaquo; Details</span>
        </div>
      </div>
      <div class="topbar-right">
        <a href="{{ route('admin.announcements.edit', $announcement) }}" class="btn btn-forest btn-sm"><i class="bi bi-pencil me-1"></i> Edit</a>
      </div>
    </header>
    <div class="dashboard-container">
      <div class="card border-0 shadow-sm rounded-12" style="max-width: 800px;">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="badge bg-secondary text-uppercase">{{ $announcement->type }}</span>
            <span class="badge {{ $announcement->status === 'published' ? 'bg-success' : 'bg-warning text-dark' }}">{{ ucfirst($announcement->status) }}</span>
          </div>
          <h4 class="font-serif mb-3">{{ $announcement->title }}</h4>
          <p class="text-muted" style="white-space: pre-line;">{{ $announcement->message }}</p>
          <hr>
          <div class="d-flex justify-content-between text-muted small">
            <span>Posted by: {{ $announcement->creator->name ?? 'Admin' }}</span>
            <span>Date: {{ $announcement->created_at->format('M d, Y h:i A') }}</span>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
