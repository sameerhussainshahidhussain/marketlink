
<nav class="navbar navbar-expand-lg marketlink-navbar sticky-top bg-white border-bottom border-subtle">
  <div class="container">
    
    <a class="navbar-brand d-flex align-items-center" href="<?php echo e(url('/')); ?>">
      <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="MarketLink – Green Basket" height="46" class="d-inline-block">
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileNavOffcanvas" aria-controls="mobileNavOffcanvas" aria-label="Toggle navigation">
      <i class="bi bi-list fs-2 text-forest"></i>
    </button>

    <div class="collapse navbar-collapse justify-content-center d-none d-lg-flex" id="navbarNav">
      <ul class="navbar-nav gap-2">
        <li class="nav-item"><a class="nav-link <?php echo e(request()->is('/') ? 'active fw-bold' : ''); ?>" href="<?php echo e(url('/')); ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link <?php echo e(request()->is('markets*') ? 'active fw-bold' : ''); ?>" href="<?php echo e(route('markets.index')); ?>">Markets</a></li>
        <li class="nav-item"><a class="nav-link <?php echo e(request()->is('farmers*') ? 'active fw-bold' : ''); ?>" href="<?php echo e(route('farmers.index')); ?>">Farmers</a></li>
        <li class="nav-item"><a class="nav-link <?php echo e(request()->is('products*') ? 'active fw-bold' : ''); ?>" href="<?php echo e(route('products.index')); ?>">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo e(url('/about')); ?>">About</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php echo e(url('/contact')); ?>">Contact</a></li>
      </ul>
    </div>

    <div class="d-none d-lg-flex align-items-center gap-3">
      <a href="<?php echo e(route('products.index')); ?>" class="nav-action-btn" title="Search Products" aria-label="Search">
        <i class="bi bi-search"></i>
      </a>

      <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->isCustomer()): ?>
          <?php $cartCount = auth()->user()->cart?->item_count ?? 0; ?>
          <a href="<?php echo e(route('customer.cart')); ?>" class="nav-action-btn position-relative" title="My Basket" aria-label="Cart">
            <i class="bi bi-basket3"></i>
            <?php if($cartCount > 0): ?>
              <span class="badge-counter cart-badge-count"><?php echo e($cartCount); ?></span>
            <?php endif; ?>
          </a>
        <?php endif; ?>

        <div class="dropdown ms-1">
          <button class="btn btn-forest rounded-pill px-3 py-2 dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
            <span><?php echo e(Str::limit(auth()->user()->name, 14)); ?></span>
            <span class="badge bg-sage text-forest rounded-pill text-uppercase px-2" style="font-size:0.65rem;"><?php echo e(auth()->user()->role); ?></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow-premium border-0 rounded-16 p-2 mt-2">
            <li><span class="dropdown-header text-uppercase small text-muted">Signed in as <strong><?php echo e(auth()->user()->email); ?></strong></span></li>
            
            <?php if(auth()->user()->isCustomer()): ?>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('customer.dashboard')); ?>"><i class="bi bi-speedometer2 me-2 text-emerald"></i>Customer Dashboard</a></li>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('customer.orders')); ?>"><i class="bi bi-receipt me-2 text-emerald"></i>My Pre-Orders</a></li>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('customer.cart')); ?>"><i class="bi bi-basket3 me-2 text-emerald"></i>My Basket</a></li>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('customer.profile')); ?>"><i class="bi bi-person-gear me-2 text-emerald"></i>Account Profile</a></li>
            <?php elseif(auth()->user()->isFarmer()): ?>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('farmer.dashboard')); ?>"><i class="bi bi-speedometer2 me-2 text-gold"></i>Farmer Dashboard</a></li>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('farmer.products.index')); ?>"><i class="bi bi-calendar-week me-2 text-gold"></i>Manage Products</a></li>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('farmer.orders.index')); ?>"><i class="bi bi-receipt me-2 text-gold"></i>Pre-Orders</a></li>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('farmer.pickup-slots.index')); ?>"><i class="bi bi-clock-history me-2 text-gold"></i>Pickup Windows</a></li>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('farmer.profile')); ?>"><i class="bi bi-shop me-2 text-gold"></i>Stall Profile</a></li>
            <?php elseif(auth()->user()->isAdmin()): ?>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('admin.dashboard')); ?>"><i class="bi bi-speedometer2 me-2 text-danger"></i>Admin Dashboard</a></li>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('admin.farmers.pending')); ?>"><i class="bi bi-person-check me-2 text-danger"></i>Farmer Approvals</a></li>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('admin.users.index')); ?>"><i class="bi bi-people me-2 text-danger"></i>Manage Users</a></li>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('admin.markets.index')); ?>"><i class="bi bi-shop me-2 text-danger"></i>Markets</a></li>
              <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('admin.reports.index')); ?>"><i class="bi bi-bar-chart me-2 text-danger"></i>Platform Reports</a></li>
            <?php endif; ?>

            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="dropdown-item rounded-8 py-2 text-danger">
                  <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                </button>
              </form>
            </li>
          </ul>
        </div>
      <?php else: ?>
        
        <a href="<?php echo e(route('customer.cart')); ?>" class="nav-action-btn" title="My Basket" aria-label="Cart">
          <i class="bi bi-basket3"></i>
        </a>
        <div class="dropdown ms-1">
          <button class="btn btn-forest rounded-pill px-3 py-2 dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
            <span>Sign In</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow-premium border-0 rounded-16 p-2 mt-2">
            <li><a class="dropdown-item rounded-8 py-2" href="<?php echo e(route('login')); ?>"><i class="bi bi-box-arrow-in-right me-2 text-forest"></i>Sign In</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item rounded-8 py-2 text-success fw-bold" href="<?php echo e(route('register.customer')); ?>"><i class="bi bi-person-heart me-2"></i>Register as Customer</a></li>
            <li><a class="dropdown-item rounded-8 py-2 text-forest fw-semibold" href="<?php echo e(route('register.farmer')); ?>"><i class="bi bi-tree me-2"></i>Join as Farmer / Grower</a></li>
          </ul>
        </div>
      <?php endif; ?>

    </div>
  </div>
</nav>

<div class="offcanvas offcanvas-start border-0" tabindex="-1" id="mobileNavOffcanvas" aria-labelledby="mobileNavOffcanvasLabel">
  <div class="offcanvas-header bg-forest text-white py-3">
    <div class="bg-white p-1 px-2 rounded-12 shadow-xs d-flex align-items-center">
      <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="MarketLink" height="34">
    </div>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column p-4">
    <ul class="nav flex-column gap-2 mb-4">
      <li class="nav-item"><a class="nav-link fs-6" href="<?php echo e(url('/')); ?>"><i class="bi bi-house me-2"></i>Home</a></li>
      <li class="nav-item"><a class="nav-link fs-6" href="<?php echo e(route('markets.index')); ?>"><i class="bi bi-geo-alt me-2"></i>Browse Markets</a></li>
      <li class="nav-item"><a class="nav-link fs-6" href="<?php echo e(route('farmers.index')); ?>"><i class="bi bi-people me-2"></i>Browse Farmers</a></li>
      <li class="nav-item"><a class="nav-link fs-6" href="<?php echo e(route('products.index')); ?>"><i class="bi bi-grid me-2"></i>All Products</a></li>
      <li class="nav-item"><a class="nav-link fs-6" href="<?php echo e(url('/about')); ?>"><i class="bi bi-info-circle me-2"></i>About Us</a></li>
      <li class="nav-item"><a class="nav-link fs-6" href="<?php echo e(url('/contact')); ?>"><i class="bi bi-envelope me-2"></i>Contact</a></li>
    </ul>

    <hr class="my-3 border-subtle">

    <div class="d-flex flex-column gap-2 mb-auto">
      <?php if(auth()->guard()->check()): ?>
        <span class="small text-muted mb-1">Signed in as: <strong><?php echo e(auth()->user()->name); ?></strong></span>
        <?php if(auth()->user()->isCustomer()): ?>
          <a href="<?php echo e(route('customer.dashboard')); ?>" class="btn btn-forest"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
          <a href="<?php echo e(route('customer.orders')); ?>" class="btn btn-outline-forest"><i class="bi bi-receipt me-2"></i>My Orders</a>
          <a href="<?php echo e(route('customer.cart')); ?>" class="btn btn-sage"><i class="bi bi-basket3 me-2"></i>My Basket</a>
        <?php elseif(auth()->user()->isFarmer()): ?>
          <a href="<?php echo e(route('farmer.dashboard')); ?>" class="btn btn-forest"><i class="bi bi-speedometer2 me-2"></i>Farmer Portal</a>
          <a href="<?php echo e(route('farmer.products.index')); ?>" class="btn btn-outline-forest"><i class="bi bi-calendar-week me-2"></i>Products</a>
        <?php elseif(auth()->user()->isAdmin()): ?>
          <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-forest"><i class="bi bi-shield-check me-2"></i>Admin Portal</a>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-2">
          <?php echo csrf_field(); ?>
          <button type="submit" class="btn btn-outline-danger w-100">Sign Out</button>
        </form>
      <?php else: ?>
        <a href="<?php echo e(route('customer.cart')); ?>" class="btn btn-sage d-flex align-items-center justify-content-between">
          <span><i class="bi bi-basket3 me-2"></i>My Basket</span>
        </a>
        <a href="<?php echo e(route('login')); ?>" class="btn btn-forest">Sign In</a>
        <a href="<?php echo e(route('register.customer')); ?>" class="btn btn-outline-forest">Register as Customer</a>
        <a href="<?php echo e(route('register.farmer')); ?>" class="btn btn-outline-secondary">Join as Farmer</a>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/partials/navbar.blade.php ENDPATH**/ ?>