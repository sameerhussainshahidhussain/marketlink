<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In | MarketLink – eGreen Basket</title>
  <meta name="description" content="Sign in to your MarketLink customer, farmer, or administrator account.">

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
        <div class="col-md-8 col-lg-5">
          <div class="card p-4 p-md-5 rounded-32 border-subtle shadow-md bg-white">
            
            <div class="text-center mb-4">
              <h3 class="font-serif text-forest mb-1">Welcome Back</h3>
              <p class="text-muted small">Sign in to manage pre-orders, saved farmers, or stall stock.</p>
            </div>

            <div class="d-flex p-1 bg-light rounded-pill mb-4 border" id="roleSelector">
              <button class="btn btn-sm flex-fill rounded-pill py-2 active btn-forest" id="btnRoleCustomer" onclick="selectRole('customer')">Customer</button>
              <button class="btn btn-sm flex-fill rounded-pill py-2 btn-light" id="btnRoleFarmer" onclick="selectRole('farmer')">Farmer</button>
              <button class="btn btn-sm flex-fill rounded-pill py-2 btn-light" id="btnRoleAdmin" onclick="selectRole('admin')">Admin</button>
            </div>

            <form id="loginForm" onsubmit="handleLoginSubmit(event)">
              <div class="mb-3">
                <label class="form-label small fw-bold">Email Address</label>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                  <input type="email" id="loginEmail" class="form-control border-start-0 ps-0 rounded-end-12" value="customer@marketlink.org" required>
                </div>
              </div>

              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <label class="form-label small fw-bold mb-0">Password</label>
                  <a href="{{ url('/forgot-password') }}" class="small text-forest text-decoration-none">Forgot Password?</a>
                </div>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                  <input type="password" id="loginPassword" class="form-control border-start-0 border-end-0 ps-0" value="••••••••" required>
                  <button type="button" class="btn btn-outline-secondary border-start-0 rounded-end-12" onclick="togglePasswordVisibility()"><i class="bi bi-eye"></i></button>
                </div>
              </div>

              <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                <label class="form-check-label small text-muted" for="rememberMe">Remember me on this browser</label>
              </div>

              <div class="d-grid mb-3">
                <button type="submit" class="btn btn-forest rounded-pill py-3 fw-bold" id="loginSubmitBtn">
                  <i class="bi bi-box-arrow-in-right me-1"></i> Sign In to Account
                </button>
              </div>

              <div class="text-center">
                <span class="small text-muted">Don’t have a MarketLink account yet? </span>
                <a href="{{ url('/register') }}" class="small text-forest fw-bold text-decoration-none">Create Customer Account</a>
              </div>
            </form>

            <div class="pt-4 mt-4 border-top border-subtle text-center">
              <span class="small text-muted d-block mb-2">Want to sell your harvest?</span>
              <a href="{{ url('/farmer/register') }}" class="btn btn-sm btn-outline-forest rounded-pill px-4">
                <i class="bi bi-shop me-1"></i> Register as a Market Vendor
              </a>
            </div>

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
  <script>
    let currentRole = 'customer';

    function selectRole(role) {
      currentRole = role;
      document.querySelectorAll('#roleSelector button').forEach(btn => {
        btn.className = 'btn btn-sm flex-fill rounded-pill py-2 btn-light';
      });

      const emailInput = document.getElementById('loginEmail');
      const submitBtn = document.getElementById('loginSubmitBtn');

      if (role === 'customer') {
        document.getElementById('btnRoleCustomer').className = 'btn btn-sm flex-fill rounded-pill py-2 btn-forest active';
        emailInput.value = 'customer@marketlink.org';
        submitBtn.innerHTML = '<i class="bi bi-box-arrow-in-right me-1"></i> Sign In as Customer';
      } else if (role === 'farmer') {
        document.getElementById('btnRoleFarmer').className = 'btn btn-sm flex-fill rounded-pill py-2 btn-forest active';
        emailInput.value = 'farmer.vance@marketlink.org';
        submitBtn.innerHTML = '<i class="bi bi-shop me-1"></i> Sign In to Farmer Portal';
      } else if (role === 'admin') {
        document.getElementById('btnRoleAdmin').className = 'btn btn-sm flex-fill rounded-pill py-2 btn-forest active';
        emailInput.value = 'admin@marketlink.org';
        submitBtn.innerHTML = '<i class="bi bi-shield-check me-1"></i> Sign In to Admin Console';
      }
    }

    function togglePasswordVisibility() {
      const p = document.getElementById('loginPassword');
      p.type = p.type === 'password' ? 'text' : 'password';
    }

    function handleLoginSubmit(e) {
      e.preventDefault();
      showToast('Signing in...', 'success');
      setTimeout(() => {
        if (currentRole === 'customer') {
          window.location.href = '../customer/dashboard.html';
        } else if (currentRole === 'farmer') {
          window.location.href = '../farmer/dashboard.html';
        } else {
          window.location.href = '../admin/dashboard.html';
        }
      }, 700);
    }
  </script>
</body>
</html>
