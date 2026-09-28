<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Pickup Slots | MarketLink Farmer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/dashboard.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>">
</head>
<body class="dashboard-body role-farmer">
  <div class="dashboard-wrapper dashboard-farmer-wrapper">
    <div class="sidebar-overlay"></div>
    <?php echo $__env->make('partials.farmer-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn"><i class="bi bi-list fs-5"></i></button>
          <h5 class="font-serif mb-0">Market Pickup Slots & Windows</h5>
        </div>
        <div class="topbar-right">
          <a href="<?php echo e(route('farmer.pickup-slots.create')); ?>" class="btn btn-sm btn-forest rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> New Pickup Slot
          </a>
        </div>
      </header>

      <div class="dashboard-container">
        <?php if(session('success')): ?>
          <div class="alert alert-success py-2 rounded-12 small mb-4"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="content-card">
          <div class="table-responsive">
            <table class="table table-custom align-middle">
              <thead>
                <tr>
                  <th>Market Location</th>
                  <th>Pickup Date</th>
                  <th>Time Window</th>
                  <th>Order Capacity</th>
                  <th>Cutoff Deadline</th>
                  <th>Status</th>
                  <th class="text-end">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td>
                      <strong class="text-forest"><?php echo e($slot->market->market_name); ?></strong>
                      <span class="small text-muted d-block"><?php echo e($slot->market->city); ?></span>
                    </td>
                    <td><strong class="text-forest"><?php echo e($slot->pickup_date->format('l, M d, Y')); ?></strong></td>
                    <td>
                      <span class="small"><i class="bi bi-clock me-1 text-gold"></i><?php echo e(date('h:i A', strtotime($slot->start_time))); ?> - <?php echo e(date('h:i A', strtotime($slot->end_time))); ?></span>
                    </td>
                    <td>
                      <span class="badge <?php echo e($slot->isFull() ? 'bg-danger' : 'bg-sage text-forest'); ?> rounded-pill">
                        <?php echo e($slot->current_orders); ?> / <?php echo e($slot->max_orders); ?> orders
                      </span>
                    </td>
                    <td><span class="small text-muted"><?php echo e($slot->cutoff_time->format('M d, h:i A')); ?></span></td>
                    <td>
                      <span class="badge <?php echo e($slot->status === 'available' ? 'bg-success' : 'bg-secondary'); ?> rounded-pill px-2 py-1 small">
                        <?php echo e($slot->status); ?>

                      </span>
                    </td>
                    <td class="text-end">
                      <div class="d-flex gap-2 justify-content-end">
                        <a href="<?php echo e(route('farmer.pickup-slots.edit', $slot)); ?>" class="btn btn-sm btn-outline-forest rounded-pill px-2 py-1">
                          <i class="bi bi-pencil"></i>
                        </a>
                        <?php if($slot->current_orders == 0): ?>
                          <form method="POST" action="<?php echo e(route('farmer.pickup-slots.destroy', $slot)); ?>" onsubmit="return confirm('Delete this pickup slot?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        <?php endif; ?>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr><td colspan="7" class="text-center py-5 text-muted">No pickup slots scheduled yet. Click "New Pickup Slot" to create one.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>

          <div class="mt-4">
            <?php echo e($slots->links()); ?>

          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
<?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/farmer/pickup-slots/index.blade.php ENDPATH**/ ?>