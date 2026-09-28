<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Registration | MarketLink – eGreen Basket</title>
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
              <span class="badge bg-sage-subtle text-forest rounded-pill px-3 py-2 mb-2"><i class="bi bi-person-heart me-1"></i> Customer Account</span>
              <h3 class="font-serif text-forest mb-1">Create Customer Account</h3>
              <p class="text-muted small">Reserve harvest-fresh produce directly from local markets and growers.</p>
            </div>

            @if(isset($errors) && $errors->any())
              <div class="alert alert-danger py-2 small rounded-12">
                <ul class="mb-0 ps-3">
                  @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('register.customer.submit') }}">
              @csrf

              <div class="mb-3">
                <label class="form-label small fw-bold">Full Name</label>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-person"></i></span>
                  <input type="text" name="name" class="form-control border-start-0 ps-0 rounded-end-12" value="{{ old('name') }}" placeholder="e.g. Ayesha Tariq" required autofocus>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold">Email Address</label>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                  <input type="email" name="email" class="form-control border-start-0 ps-0 rounded-end-12" value="{{ old('email') }}" placeholder="ayesha@example.com" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold">Phone Number</label>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-telephone"></i></span>
                  <input type="tel" name="phone" class="form-control border-start-0 ps-0 rounded-end-12" value="{{ old('phone') }}" placeholder="+92 300 1234567">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold">Residential Address</label>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-geo-alt"></i></span>
                  <input type="text" name="address" class="form-control border-start-0 ps-0 rounded-end-12" value="{{ old('address') }}" placeholder="Street, Area, City">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label small fw-bold">Password</label>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-shield-lock"></i></span>
                  <input type="password" name="password" class="form-control border-start-0 ps-0 rounded-end-12" placeholder="Minimum 8 characters" required>
                </div>
              </div>

              <div class="mb-4">
                <label class="form-label small fw-bold">Confirm Password</label>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-shield-check"></i></span>
                  <input type="password" name="password_confirmation" class="form-control border-start-0 ps-0 rounded-end-12" placeholder="Re-type password" required>
                </div>
              </div>

              <button type="submit" class="btn btn-forest w-100 py-3 rounded-pill fw-semibold shadow-sm mb-3">
                Register as Customer <i class="bi bi-arrow-right ms-2"></i>
              </button>

              <div class="text-center">
                <span class="text-muted small">Already have an account? </span>
                <a href="{{ route('login') }}" class="text-forest fw-semibold small text-decoration-none">Sign In</a>
                <span class="text-muted small"> | </span>
                <a href="{{ route('register.farmer') }}" class="text-sage fw-semibold small text-decoration-none">Are you a Farmer?</a>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>

</body>
</html>
