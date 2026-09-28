<?php $__env->startSection('title', 'Farmer Vendor Portal | MarketLink'); ?>
<?php $__env->startSection('wrapper_class', 'farmer-dashboard-view'); ?>

<?php $__env->startSection('page_title'); ?>
  Farmer Portal • <?php echo e(auth()->user()->farmerProfile->business_name ?? auth()->user()->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_subtitle'); ?>
  Approval Status: 
  <span class="badge <?php echo e(auth()->user()->farmerProfile?->approval_status === 'approved' ? 'bg-success' : 'bg-warning text-dark'); ?> rounded-pill text-uppercase">
    <?php echo e(auth()->user()->farmerProfile?->approval_status ?? 'Pending'); ?>

  </span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('sidebar'); ?>
  <?php echo $__env->make('partials.farmer-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('topbar_right'); ?>
  <?php if(auth()->user()->farmerProfile?->approval_status === 'approved'): ?>
    <a href="<?php echo e(route('farmer.products.create')); ?>" class="btn btn-sm btn-forest rounded-pill px-3">
      <i class="bi bi-plus-lg me-1"></i> Add Produce Item
    </a>
  <?php else: ?>
    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-2">
      <i class="bi bi-info-circle me-1"></i> Awaiting Approval to List Produce
    </span>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  
  <div class="stats-grid mb-4">
    <div class="stat-card">
      <div class="stat-icon bg-forest-subtle text-forest"><i class="bi bi-currency-dollar"></i></div>
      <div class="stat-details">
        <span class="stat-label">Total Revenue</span>
        <h3 class="stat-value">$<?php echo e(number_format($stats['total_revenue'], 2)); ?></h3>
        <span class="stat-trend positive small"><i class="bi bi-check2-circle"></i> From completed orders</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon bg-sage-subtle text-forest"><i class="bi bi-receipt"></i></div>
      <div class="stat-details">
        <span class="stat-label">Total Pre-Orders</span>
        <h3 class="stat-value"><?php echo e($stats['total_orders']); ?></h3>
        <span class="stat-trend small text-warning"><i class="bi bi-hourglass-split"></i> <?php echo e($stats['pending_orders']); ?> pending</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon bg-mint-subtle text-forest"><i class="bi bi-box-seam"></i></div>
      <div class="stat-details">
        <span class="stat-label">Active Produce</span>
        <h3 class="stat-value"><?php echo e($stats['active_products']); ?></h3>
        <span class="stat-subtext text-muted small"><?php echo e($stats['total_products']); ?> total catalog items</span>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-icon bg-gold-subtle text-forest"><i class="bi bi-star"></i></div>
      <div class="stat-details">
        <span class="stat-label">Stall Rating</span>
        <h3 class="stat-value"><?php echo e(number_format($stats['avg_rating'] ?? 5.0, 1)); ?> ★</h3>
        <span class="stat-subtext text-muted small">From verified collections</span>
      </div>
    </div>
  </div>

  <div class="row g-4">
    
    <div class="col-lg-8">
      <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="font-serif text-forest mb-0">Recent Pre-Orders</h5>
          <a href="<?php echo e(route('farmer.orders.index')); ?>" class="btn btn-sm btn-outline-forest rounded-pill">View All</a>
        </div>

        <div class="table-responsive">
          <table class="table table-custom align-middle">
            <thead>
              <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Market</th>
                <th>Pickup Date</th>
                <th>Amount</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                  <td><strong>#<?php echo e($order->order_number ?? $order->id); ?></strong></td>
                  <td><?php echo e($order->customer->name ?? 'Customer'); ?></td>
                  <td><?php echo e($order->market->market_name ?? 'Market'); ?></td>
                  <td><?php echo e($order->pickup_date ? $order->pickup_date->format('M d, Y') : 'Scheduled'); ?></td>
                  <td class="fw-bold text-forest">$<?php echo e(number_format($order->total_amount, 2)); ?></td>
                  <td>
                    <?php
                      $badge = match($order->order_status ?? $order->status) {
                        'placed' => 'bg-warning text-dark',
                        'accepted' => 'bg-info text-dark',
                        'ready_for_pickup' => 'bg-primary text-white',
                        'completed' => 'bg-success text-white',
                        'cancelled' => 'bg-danger text-white',
                        default => 'bg-secondary text-white'
                      };
                    ?>
                    <span class="badge <?php echo e($badge); ?> rounded-pill px-2 py-1 text-uppercase small"><?php echo e(str_replace('_', ' ', $order->order_status ?? $order->status)); ?></span>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center py-4 text-muted">No orders received yet.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="content-card mb-4">
        <h5 class="font-serif text-forest mb-3"><i class="bi bi-exclamation-triangle text-warning me-2"></i>Low Stock Produce</h5>
        <?php $__empty_1 = true; $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="d-flex align-items-center justify-content-between p-2 mb-2 bg-light rounded-12">
            <div>
              <strong class="small d-block text-forest"><?php echo e($prod->name); ?></strong>
              <span class="text-danger small"><?php echo e($prod->stock_quantity); ?> <?php echo e($prod->unit ?? 'unit'); ?>s left</span>
            </div>
            <a href="<?php echo e(route('farmer.products.edit', $prod)); ?>" class="btn btn-xs btn-outline-forest rounded-pill px-2">Update</a>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <p class="small text-muted mb-0">All produce items have healthy stock levels.</p>
        <?php endif; ?>
      </div>

      <div class="content-card">
        <h5 class="font-serif text-forest mb-3">Quick Navigation</h5>
        <div class="d-grid gap-2">
          <?php if(auth()->user()->farmerProfile?->approval_status === 'approved'): ?>
            <a href="<?php echo e(route('farmer.products.create')); ?>" class="btn btn-forest rounded-pill text-start"><i class="bi bi-plus-circle me-2"></i>Add New Product</a>
          <?php endif; ?>
          <a href="<?php echo e(route('farmer.pickup-slots.create')); ?>" class="btn btn-outline-forest rounded-pill text-start"><i class="bi bi-clock-history me-2"></i>Schedule Pickup Slot</a>
          <a href="<?php echo e(route('farmer.insights')); ?>" class="btn btn-outline-forest rounded-pill text-start"><i class="bi bi-graph-up me-2"></i>Sales & Analytics Insights</a>
          <a href="<?php echo e(route('farmer.profile')); ?>" class="btn btn-outline-forest rounded-pill text-start"><i class="bi bi-shop me-2"></i>Edit Farm Bio & Location</a>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/farmer/dashboard.blade.php ENDPATH**/ ?>