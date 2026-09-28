<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmer Partner Application | MarketLink – eGreen Basket</title>
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
        <div class="col-md-9 col-lg-7">
          <div class="card p-4 p-md-5 rounded-32 border-subtle shadow-md bg-white">
            
            <div class="text-center mb-4">
              <span class="badge bg-sage-subtle text-forest rounded-pill px-3 py-2 mb-2"><i class="bi bi-tree me-1"></i> Farmer Producer Portal</span>
              <h3 class="font-serif text-forest mb-1">Apply as a Farmer / Grower</h3>
              <p class="text-muted small">Showcase your farm harvests, connect with market stalls, and manage pre-orders.</p>
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

            <form method="POST" action="{{ route('register.farmer.submit') }}">
              @csrf

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label small fw-bold">Primary Contact Name</label>
                  <input type="text" name="name" class="form-control rounded-12" value="{{ old('name') }}" placeholder="e.g. Tariq Mehmood" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label small fw-bold">Farm / Business Name</label>
                  <input type="text" name="business_name" class="form-control rounded-12" value="{{ old('business_name') }}" placeholder="e.g. Mehmood Organics" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold">Email Address</label>
                  <input type="email" name="email" class="form-control rounded-12" value="{{ old('email') }}" placeholder="tariq@mehmoodfarms.com" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label small fw-bold">Phone / WhatsApp</label>
                  <input type="tel" name="phone" class="form-control rounded-12" value="{{ old('phone') }}" placeholder="+92 321 9876543">
                </div>

                <div class="col-12">
                  <label class="form-label small fw-bold">Farm / Production Address</label>
                  <input type="text" name="address" class="form-control rounded-12" value="{{ old('address') }}" placeholder="Village Chak 45, Bedian Road, Lahore">
                </div>

                <div class="col-12">
                  <label class="form-label small fw-bold">Farm Story & Specialities</label>
                  <textarea name="description" rows="3" class="form-control rounded-16" placeholder="Briefly describe what produce or organic crops you cultivate...">{{ old('description') }}</textarea>
                </div>

                <div class="col-md-6">
                  <label class="form-label small fw-bold">Password</label>
                  <input type="password" name="password" class="form-control rounded-12" placeholder="Minimum 8 characters" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label small fw-bold">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control rounded-12" placeholder="Confirm password" required>
                </div>
              </div>

              <div class="alert alert-info py-2 small rounded-12 mt-4">
                <i class="bi bi-info-circle me-1"></i> Farmer accounts are verified and approved by the market administration before listings go live.
              </div>

              <button type="submit" class="btn btn-forest w-100 py-3 rounded-pill fw-semibold shadow-sm mb-3">
                Submit Farmer Application <i class="bi bi-arrow-right ms-2"></i>
              </button>

              <div class="text-center">
                <span class="text-muted small">Already a registered farmer? </span>
                <a href="{{ route('login') }}" class="text-forest fw-semibold small text-decoration-none">Sign In</a>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </section>

</body>
</html>
