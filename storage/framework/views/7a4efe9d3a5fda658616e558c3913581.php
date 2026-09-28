<aside class="dashboard-sidebar farmer-sidebar">
  <div class="sidebar-header">
    <a class="navbar-brand d-flex align-items-center bg-white p-2 px-3 rounded-16 shadow-xs" href="<?php echo e(url('/')); ?>">
      <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="MarketLink" height="34" class="w-auto">
    </a>
    <span class="portal-badge farmer-portal-badge">
      <i class="bi bi-flower1"></i> Grower
    </span>
  </div>

  <ul class="sidebar-menu">
    <li class="sidebar-heading">Vendor Core</li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('farmer.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('farmer.dashboard') ? 'active' : ''); ?>">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('farmer.orders.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('farmer.orders*') ? 'active' : ''); ?>">
        <i class="bi bi-box2-heart"></i>
        <span>Pre-Orders</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('farmer.products.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('farmer.products*') ? 'active' : ''); ?>">
        <i class="bi bi-calendar-week"></i>
        <span>Manage Products</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('farmer.products.create')); ?>" class="sidebar-link <?php echo e(request()->routeIs('farmer.products.create') ? 'active' : ''); ?>">
        <i class="bi bi-plus-circle"></i>
        <span>Add Produce Item</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('farmer.pickup-slots.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('farmer.pickup-slots*') ? 'active' : ''); ?>">
        <i class="bi bi-clock-history"></i>
        <span>Pickup Slots</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('farmer.stock-templates.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('farmer.stock-templates*') ? 'active' : ''); ?>">
        <i class="bi bi-clipboard-check"></i>
        <span>Stock Templates</span>
      </a>
    </li>

    <li class="sidebar-heading mt-3">Feedback & Stall</li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('farmer.reviews.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('farmer.reviews*') ? 'active' : ''); ?>">
        <i class="bi bi-star"></i>
        <span>Customer Reviews</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('farmer.profile')); ?>" class="sidebar-link <?php echo e(request()->routeIs('farmer.profile') ? 'active' : ''); ?>">
        <i class="bi bi-shop"></i>
        <span>Farm / Stall Profile</span>
      </a>
    </li>

    <li class="sidebar-heading mt-3">Account</li>
    <li class="sidebar-item">
      <a href="<?php echo e(url('/')); ?>" class="sidebar-link">
        <i class="bi bi-globe"></i>
        <span>View Public Marketplace</span>
      </a>
    </li>
    <li class="sidebar-item">
      <form method="POST" action="<?php echo e(route('logout')); ?>" id="farmerLogoutForm">
        <?php echo csrf_field(); ?>
        <a href="javascript:void(0)" onclick="document.getElementById('farmerLogoutForm').submit()" class="sidebar-link text-danger">
          <i class="bi bi-box-arrow-left text-danger"></i>
          <span>Sign Out</span>
        </a>
      </form>
    </li>
  </ul>

  <div class="sidebar-footer">
    <div class="user-snippet">
      <img src="<?php echo e(auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : 'https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?w=100&auto=format&fit=crop&q=80'); ?>" alt="<?php echo e(auth()->user()->name); ?>" class="user-avatar object-fit-cover">
      <div class="user-info">
        <h6 class="text-truncate" style="max-width: 140px;"><?php echo e(auth()->user()->farmerProfile->business_name ?? auth()->user()->name); ?></h6>
        <span><?php echo e(auth()->user()->name); ?></span>
      </div>
    </div>
  </div>
</aside>
<?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/partials/farmer-sidebar.blade.php ENDPATH**/ ?>