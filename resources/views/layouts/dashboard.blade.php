<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard | MarketLink')</title>
  <meta name="description" content="@yield('meta_description', 'MarketLink Dashboard')">

  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌿</text></svg>">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

  @yield('styles')
</head>
<body class="dashboard-body @yield('body_class') role-{{ auth()->user()->role ?? 'guest' }}">

  <div class="dashboard-wrapper dashboard-{{ auth()->user()->role ?? 'portal' }}-wrapper @yield('wrapper_class')">
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    @yield('sidebar')

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn">
            <i class="bi bi-list fs-5"></i>
          </button>
          <div>
            <h5 class="font-serif mb-0">@yield('page_title', 'Dashboard')</h5>
            <span class="small text-muted">@yield('page_subtitle', '')</span>
          </div>
        </div>
        <div class="topbar-right">
          @yield('topbar_right')
        </div>
      </header>

      <div class="dashboard-container">
        @if(session('success'))
          <div class="alert alert-success py-2 rounded-12 small mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill text-success"></i>
            {{ session('success') }}
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger py-2 rounded-12 small mb-4 d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-circle-fill text-danger"></i>
            {{ session('error') }}
          </div>
        @endif
        @if($errors->any())
          <div class="alert alert-danger py-2 rounded-12 small mb-4">
            <ul class="mb-0 ps-3">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @yield('content')
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>

  <script>
    const toggleBtn = document.getElementById('sidebarToggleBtn');
    const sidebar   = document.querySelector('.dashboard-sidebar');
    const overlay   = document.getElementById('sidebarOverlay');

    if (toggleBtn && sidebar && overlay) {
      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
      });
      overlay.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
      });
    }
  </script>

  @yield('scripts')
</body>
</html>
