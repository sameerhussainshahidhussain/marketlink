<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vine-Ripened Heirloom Tomatoes | MarketLink</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body>

  <nav class="navbar navbar-expand-lg marketlink-navbar sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <div class="brand-icon"><i class="bi bi-flower1"></i></div>
        <div>
          <span class="brand-title">MarketLink</span>
          <span class="brand-subtitle">eGreen Basket</span>
        </div>
      </a>

      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileNavOffcanvas">
        <i class="bi bi-list fs-1 text-forest"></i>
      </button>

      <div class="collapse navbar-collapse justify-content-center d-none d-lg-flex">
        <ul class="navbar-nav gap-1">
          <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/markets') }}">Markets</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/farmers') }}">Farmers</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{ url('/products') }}">Products</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/map') }}">Map</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
        </ul>
      </div>

      <div class="d-none d-lg-flex align-items-center gap-3">
        <a href="{{ url('/favorites') }}" class="nav-action-btn" title="Favorites"><i class="bi bi-heart"></i><span class="badge-counter fav-badge-count" style="display:none;">0</span></a>
        <a href="{{ url('/cart') }}" class="nav-action-btn" title="Basket"><i class="bi bi-basket3"></i><span class="badge-counter cart-badge-count" style="display:none;">0</span></a>
        <a href="{{ url('/map') }}" class="btn btn-forest"><i class="bi bi-geo-alt-fill text-gold"></i> Find Fresh Near You</a>
      </div>
    </div>
  </nav>

  <section class="py-5">
    <div class="container">
      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb small">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/products') }}">Products</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/products') }}?category=vegetables">Vegetables</a></li>
          <li class="breadcrumb-item active" aria-current="page">Vine-Ripened Heirloom Tomatoes</li>
        </ol>
      </nav>

      <div class="row g-5">
        
        <div class="col-lg-6">
          <div class="card p-3 rounded-24 border-subtle shadow-sm bg-white mb-3">
            <img id="mainProductImage" src="https://images.unsplash.com/photo-1592924357228-91a4daadcfea?w=800&auto=format&fit=crop&q=80" alt="Heirloom Tomatoes" class="img-fluid rounded-16 object-fit-cover" style="height: 420px; width: 100%;">
          </div>
          <div class="d-flex gap-3">
            <img src="https://images.unsplash.com/photo-1592924357228-91a4daadcfea?w=200&auto=format&fit=crop&q=80" class="img-thumbnail rounded-12 cursor-pointer border-forest" style="width: 80px; height: 80px; object-fit: cover;" onclick="document.getElementById('mainProductImage').src = this.src">
            <img src="https://images.unsplash.com/photo-1546470427-0d4db154ceb7?w=200&auto=format&fit=crop&q=80" class="img-thumbnail rounded-12 cursor-pointer" style="width: 80px; height: 80px; object-fit: cover;" onclick="document.getElementById('mainProductImage').src = this.src">
            <img src="https://images.unsplash.com/photo-1561136594-7f68413baa99?w=200&auto=format&fit=crop&q=80" class="img-thumbnail rounded-12 cursor-pointer" style="width: 80px; height: 80px; object-fit: cover;" onclick="document.getElementById('mainProductImage').src = this.src">
          </div>
        </div>

        <div class="col-lg-6">
          <div class="d-flex align-items-center gap-2 mb-2">
            <span class="badge bg-sage text-forest px-3 py-1 rounded-pill small">Vegetables</span>
            <span class="stock-badge stock-in"><i class="bi bi-circle-fill"></i> In Stock (35 lbs Available)</span>
          </div>

          <h1 class="display-6 font-serif mb-2">Vine-Ripened Heirloom Tomatoes</h1>
          
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="text-gold">
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <i class="bi bi-star-fill"></i>
              <strong class="text-dark ms-1">4.9</strong>
              <span class="text-muted small">(42 reviews)</span>
            </div>
            <span class="text-muted">&bull;</span>
            <div class="text-forest fw-semibold">
              <i class="bi bi-shop me-1 text-emerald"></i>
              <a href="{{ url('/farmer-profile') }}?id=f1" class="text-forest text-decoration-none">Vance Heritage Organic Farm</a>
            </div>
          </div>

          <div class="py-3 border-top border-bottom border-subtle mb-4">
            <div class="d-flex align-items-baseline gap-2">
              <span class="display-6 fw-bold text-forest">$4.50</span>
              <span class="text-muted fs-5">/ per pound (lb)</span>
            </div>
            <p class="small text-muted mb-0 mt-1"><i class="bi bi-info-circle me-1"></i> Pre-order online for free &bull; Settle payment directly at stall pickup</p>
          </div>

          <p class="text-muted mb-4 leading-relaxed">
            Multi-colored heirloom varieties (Cherokee Purple, Green Zebra, and Brandywine) hand-harvested on Friday evening for optimal sweetness and moisture. Grown without synthetic fertilizers or chemical pesticides.
          </p>

          <div class="d-flex align-items-center gap-3 mb-4">
            <div class="d-flex align-items-center border rounded-pill p-1 justify-content-between" style="width: 140px; background: #fff;">
              <button class="btn btn-sm btn-icon" onclick="let q = document.getElementById('productQty'); if(parseInt(q.value) > 1) q.value = parseInt(q.value) - 1;">
                <i class="bi bi-dash"></i>
              </button>
              <input type="number" id="productQty" value="1" min="1" max="35" class="form-control form-control-sm text-center border-0 fw-bold shadow-none" style="width: 50px;">
              <button class="btn btn-sm btn-icon" onclick="let q = document.getElementById('productQty'); if(parseInt(q.value) < 35) q.value = parseInt(q.value) + 1;">
                <i class="bi bi-plus"></i>
              </button>
            </div>

            <button class="btn btn-forest rounded-pill px-4 py-2 flex-grow-1" onclick="CartService.addItem({ id: 'p1', name: 'Vine-Ripened Heirloom Tomatoes', price: 4.50, unit: 'lb', farmer: 'Vance Heritage Farm', market: 'Valley Green Market', image: 'https://images.unsplash.com/photo-1592924357228-91a4daadcfea?w=500&auto=format&fit=crop&q=80', qty: parseInt(document.getElementById('productQty').value) })">
              <i class="bi bi-basket me-2"></i> Add to Pre-Order Basket
            </button>

            <button class="btn btn-outline-forest btn-icon rounded-circle favorite-btn" data-id="p1" data-name="Vine-Ripened Heirloom Tomatoes" data-type="product" style="position:static; width:44px; height:44px;">
              <i class="bi bi-heart"></i>
            </button>
          </div>

          <div class="card p-4 rounded-20 bg-cream border-subtle">
            <h6 class="font-serif mb-3"><i class="bi bi-calendar2-week text-emerald me-2"></i>Market Pickup Details</h6>
            <div class="row g-3 small">
              <div class="col-6">
                <span class="text-muted d-block">Designated Market:</span>
                <strong class="text-forest">Valley Green Community Market</strong>
              </div>
              <div class="col-6">
                <span class="text-muted d-block">Stall Location:</span>
                <strong class="text-forest">Stall #04 (Central Aisle)</strong>
              </div>
              <div class="col-6">
                <span class="text-muted d-block">Operating Days:</span>
                <strong class="text-forest">Saturday & Sunday</strong>
              </div>
              <div class="col-6">
                <span class="text-muted d-block">Pickup Window:</span>
                <strong class="text-forest">08:00 AM - 01:30 PM</strong>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-white border-top border-subtle">
    <div class="container">
      <div class="row g-5">
        <div class="col-lg-5">
          <div class="card p-4 rounded-24 border-subtle bg-cream shadow-xs">
            <h5 class="font-serif mb-3">About The Grower</h5>
            <div class="d-flex align-items-center gap-3 mb-3">
              <img src="https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=200&auto=format&fit=crop&q=80" alt="Thomas Vance" class="rounded-circle" style="width:64px; height:64px; object-fit:cover;">
              <div>
                <h6 class="mb-0">Thomas & Eleanor Vance</h6>
                <span class="small text-muted">Vance Heritage Organic Farm</span>
                <div class="text-gold small mt-1"><i class="bi bi-patch-check-fill text-emerald me-1"></i> Certified Organic</div>
              </div>
            </div>
            <p class="text-muted small mb-3">
              Family-owned 18-acre vegetable farm located in Green Valley. Dedicated to living soil, non-GMO seed heritage, and chemical-free stewardship.
            </p>
            <a href="{{ url('/farmer-profile') }}?id=f1" class="btn btn-outline-forest rounded-pill btn-sm w-100">
              View All Products from Vance Farm
            </a>
          </div>
        </div>

        <div class="col-lg-7">
          <h5 class="font-serif mb-3">Customer Reviews for This Produce</h5>
          <div class="card p-3 rounded-16 border-subtle shadow-xs mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <strong class="small">Sarah M.</strong>
              <div class="text-gold small"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
            </div>
            <p class="small text-muted mb-0">These are the sweetest tomatoes I have ever tasted! They made our caprese salad extraordinary. Very easy to grab at Stall #04.</p>
          </div>
          <div class="card p-3 rounded-16 border-subtle shadow-xs">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <strong class="small">David P.</strong>
              <div class="text-gold small"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
            </div>
            <p class="small text-muted mb-0">So glad I pre-ordered because by 10 AM on Saturday all tomatoes on the counter were sold out! My box was neatly packed waiting for me.</p>
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
  <script src="{{ asset('assets/js/cart.js') }}"></script>
  <script src="{{ asset('assets/js/ai-assistant.js') }}"></script>
</body>
</html>
