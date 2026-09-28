<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password | MarketLink – eGreen Basket</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body class="bg-cream">

  <header class="py-4 bg-white border-bottom border-subtle">
    <div class="container text-center">
      <a class="navbar-brand justify-content-center" href="{{ url('/') }}">
        <div class="brand-icon"><i class="bi bi-flower1"></i></div>
        <div>
          <span class="brand-title">MarketLink</span>
          <span class="brand-subtitle">eGreen Basket</span>
        </div>
      </a>
    </div>
  </header>

  <section class="py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
          <div class="card p-4 p-md-5 rounded-32 border-subtle shadow-md bg-white">
            <div class="text-center mb-4">
              <div class="rounded-circle bg-sage p-3 text-forest d-inline-flex align-items-center justify-content-center mb-3" style="width:64px; height:64px;">
                <i class="bi bi-key-fill fs-3"></i>
              </div>
              <h3 class="font-serif text-forest mb-1">Recover Password</h3>
              <p class="text-muted small">Enter your registered email address and we'll send a password recovery reset link.</p>
            </div>

            <form onsubmit="event.preventDefault(); showToast('Reset instructions dispatched to your email!', 'success');">
              <div class="mb-4">
                <label class="form-label small fw-bold">Registered Email Address</label>
                <input type="email" class="form-control rounded-12" placeholder="name@example.com" required>
              </div>

              <div class="d-grid mb-3">
                <button type="submit" class="btn btn-forest rounded-pill py-3 fw-bold">
                  Send Recovery Link
                </button>
              </div>

              <div class="text-center">
                <a href="{{ url('/login') }}" class="small text-forest fw-semibold text-decoration-none">
                  <i class="bi bi-arrow-left me-1"></i> Return to Sign In
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="marketlink-footer py-4">
    <div class="container text-center">
      <p class="mb-1 text-white-50">&copy; 2026 MarketLink – Connecting local farmers with local communities.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
