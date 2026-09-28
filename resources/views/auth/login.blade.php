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
        <img src="{{ asset('assets/images/logo.png') }}" alt="MarketLink" height="52">
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

            @if(session('error'))
              <div class="alert alert-danger py-2 small rounded-12">{{ session('error') }}</div>
            @endif
            @if(session('success'))
              <div class="alert alert-success py-2 small rounded-12">{{ session('success') }}</div>
            @endif
            @if(isset($errors) && $errors->any())
              <div class="alert alert-danger py-2 small rounded-12">
                <ul class="mb-0 ps-3">
                  @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="d-flex p-1 bg-light rounded-pill mb-4 border" id="roleSelector">
              <button type="button" class="btn btn-sm flex-fill rounded-pill py-2 active btn-forest" id="btnRoleCustomer" onclick="fillCreds('customer@gmail.com', '1234567890', this)">Customer</button>
              <button type="button" class="btn btn-sm flex-fill rounded-pill py-2 btn-light" id="btnRoleFarmer" onclick="fillCreds('ahmed@gmail.com', '1234567890', this)">Farmer</button>
            </div>

            <form method="POST" action="{{ route('login.submit') }}">
              @csrf

              <div class="mb-3">
                <label class="form-label small fw-bold">Email Address</label>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                  <input type="email" name="email" id="loginEmail" class="form-control border-start-0 ps-0 rounded-end-12" value="{{ old('email', 'sameer@gmail.com') }}" required autofocus>
                </div>
              </div>

              <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <label class="form-label small fw-bold mb-0">Password</label>
                  <a href="#" class="text-sage text-decoration-none small">Forgot?</a>
                </div>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-shield-lock"></i></span>
                  <input type="password" name="password" id="loginPassword" class="form-control border-start-0 ps-0 border-end-0" value="1234567890" required>
                  <button type="button" class="btn btn-outline-secondary border-start-0 border-subtle bg-white text-muted rounded-end-12" onclick="togglePass()">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                  </button>
                </div>
              </div>

              <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                <label class="form-check-label small text-muted" for="rememberMe">
                  Stay signed in on this device
                </label>
              </div>

              <button type="submit" class="btn btn-forest w-100 py-3 rounded-pill fw-semibold shadow-sm mb-3">
                Sign In <i class="bi bi-arrow-right ms-2"></i>
              </button>

              <div class="text-center">
                <span class="text-muted small">Don't have an account? </span>
                <a href="{{ route('register.customer') }}" class="text-forest fw-semibold small text-decoration-none">Sign Up as Customer</a>
                <span class="text-muted small"> or </span>
                <a href="{{ route('register.farmer') }}" class="text-forest fw-semibold small text-decoration-none">Join as Farmer</a>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    function fillCreds(email, pass, btn) {
      document.getElementById('loginEmail').value = email;
      document.getElementById('loginPassword').value = pass;
      document.querySelectorAll('#roleSelector button').forEach(b => {
        b.className = 'btn btn-sm flex-fill rounded-pill py-2 btn-light';
      });
      btn.className = 'btn btn-sm flex-fill rounded-pill py-2 active btn-forest';
    }

    function togglePass() {
      const p = document.getElementById('loginPassword');
      const icon = document.getElementById('eyeIcon');
      if (p.type === 'password') {
        p.type = 'text';
        icon.className = 'bi bi-eye-slash';
      } else {
        p.type = 'password';
        icon.className = 'bi bi-eye';
      }
    }
  </script>
</body>
</html>
