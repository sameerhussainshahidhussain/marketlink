<aside class="dashboard-sidebar admin-sidebar">
  <div class="sidebar-header">
    <a class="navbar-brand d-flex align-items-center bg-white p-2 px-3 rounded-16 shadow-xs" href="<?php echo e(url('/')); ?>">
      <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="MarketLink" height="34" class="w-auto">
    </a>
    <span class="portal-badge admin-portal-badge">
      <i class="bi bi-shield-lock-fill"></i> Admin
    </span>
  </div>

  <ul class="sidebar-menu">
    <li class="sidebar-heading">Management</li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('admin.farmers.pending')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.farmers*') ? 'active' : ''); ?>">
        <i class="bi bi-person-check"></i>
        <span>Farmer Approvals</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('admin.users.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.users*') ? 'active' : ''); ?>">
        <i class="bi bi-people"></i>
        <span>Platform Users</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('admin.markets.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.markets*') ? 'active' : ''); ?>">
        <i class="bi bi-shop"></i>
        <span>Farmers Markets</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('admin.categories.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.categories*') ? 'active' : ''); ?>">
        <i class="bi bi-tags"></i>
        <span>Categories</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('admin.products.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.products*') ? 'active' : ''); ?>">
        <i class="bi bi-grid"></i>
        <span>All Products</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('admin.orders.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.orders*') ? 'active' : ''); ?>">
        <i class="bi bi-receipt"></i>
        <span>All Orders</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('admin.reviews.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.reviews*') ? 'active' : ''); ?>">
        <i class="bi bi-star"></i>
        <span>Review Moderation</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('admin.announcements.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.announcements*') ? 'active' : ''); ?>">
        <i class="bi bi-megaphone"></i>
        <span>Announcements</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?php echo e(route('admin.reports.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.reports*') ? 'active' : ''); ?>">
        <i class="bi bi-bar-chart"></i>
        <span>Sales & Reports</span>
      </a>
    </li>

    <li class="sidebar-heading mt-3">Account</li>
    <li class="sidebar-item">
      <a href="<?php echo e(url('/')); ?>" class="sidebar-link">
        <i class="bi bi-globe"></i>
        <span>View Marketplace</span>
      </a>
    </li>
    <li class="sidebar-item">
      <form method="POST" action="<?php echo e(route('logout')); ?>" id="adminLogoutForm">
        <?php echo csrf_field(); ?>
        <a href="javascript:void(0)" onclick="document.getElementById('adminLogoutForm').submit()" class="sidebar-link text-danger">
          <i class="bi bi-box-arrow-left text-danger"></i>
          <span>Sign Out</span>
        </a>
      </form>
    </li>
  </ul>

  <div class="sidebar-footer">
    <div class="user-snippet">
      <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&auto=format&fit=crop&q=80" alt="<?php echo e(auth()->user()->name); ?>" class="user-avatar object-fit-cover">
      <div class="user-info">
        <h6 class="text-truncate" style="max-width: 140px;"><?php echo e(auth()->user()->name); ?></h6>
        <span class="badge bg-danger rounded-pill px-2" style="font-size:0.65rem;">System Admin</span>
      </div>
    </div>
  </div>
</aside>
<?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/partials/admin-sidebar.blade.php ENDPATH**/ ?>