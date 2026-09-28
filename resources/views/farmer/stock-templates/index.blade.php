<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weekly Stock Templates | Farmer Portal</title>
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
          <div>
            <h5 class="font-serif mb-0">Weekly Stock Templates</h5>
            <span class="small text-muted">Automate your regular weekly market supply inventory</span>
          </div>
        </div>
        <div class="topbar-right">
          <a href="{{ route('farmer.stock-templates.create') }}" class="btn btn-forest btn-sm rounded-pill"><i class="bi bi-plus-lg me-1"></i> New Template</a>
        </div>
      </header>

      <div class="dashboard-container">
        @if(session('success'))
          <div class="alert alert-success py-2 rounded-12 small mb-4">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm rounded-12">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th class="ps-4">Template Name</th>
                  <th>Day of Week</th>
                  <th>Configured Items</th>
                  <th>Status</th>
                  <th class="text-end pe-4">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($templates as $tmpl)
                  <tr>
                    <td class="ps-4">
                      <strong class="text-forest">{{ $tmpl->name }}</strong>
                    </td>
                    <td><span class="badge bg-sage text-forest">{{ $tmpl->day_of_week }}</span></td>
                    <td>{{ $tmpl->items->count() }} items</td>
                    <td>
                      <span class="badge {{ $tmpl->status === 'active' ? 'bg-success' : 'bg-secondary' }} rounded-pill px-2 py-1 small">{{ ucfirst($tmpl->status) }}</span>
                    </td>
                    <td class="text-end pe-4">
                      <div class="d-flex justify-content-end gap-1">
                        <a href="{{ route('farmer.stock-templates.show', $tmpl) }}" class="btn btn-sm btn-outline-secondary" title="View"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('farmer.stock-templates.edit', $tmpl) }}" class="btn btn-sm btn-outline-forest" title="Edit"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('farmer.stock-templates.destroy', $tmpl) }}" method="POST" onsubmit="return confirm('Delete this template?');" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                      <p class="mb-2">No weekly stock templates found.</p>
                      <a href="{{ route('farmer.stock-templates.create') }}" class="btn btn-sm btn-outline-forest">Create Your First Template</a>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="p-3 border-top">
            {{ $templates->links() }}
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
