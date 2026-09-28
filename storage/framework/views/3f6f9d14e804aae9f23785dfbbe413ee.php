<?php $__env->startSection('title', 'Pending Farmer Approvals | MarketLink Admin'); ?>
<?php $__env->startSection('page_title', 'Farmer Partner Applications'); ?>
<?php $__env->startSection('page_subtitle', $farmers->total() . ' application(s) awaiting verification'); ?>

<?php $__env->startSection('sidebar'); ?>
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <div class="content-card">
    <div class="content-card-header">
      <div>
        <h5 class="font-serif text-forest mb-0">Pending Stall Credentials</h5>
        <span class="small text-muted">Review grower details before enabling public selling rights</span>
      </div>
      <span class="badge bg-warning text-dark rounded-pill px-3 py-2 small">
        <i class="bi bi-clock-history me-1"></i> <?php echo e($farmers->total()); ?> Pending
      </span>
    </div>

    <div class="table-responsive">
      <table class="table table-custom align-middle mb-0">
        <thead>
          <tr>
            <th>Farm / Business</th>
            <th>Contact Person</th>
            <th>Email & Phone</th>
            <th>Location & Story</th>
            <th>Application Date</th>
            <th class="text-end">Verification Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $farmers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $farmer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td>
                <strong class="text-forest d-block"><?php echo e($farmer->farmerProfile->business_name ?? 'Farm Stall'); ?></strong>
                <span class="badge-status pending">Pending Approval</span>
              </td>
              <td class="fw-semibold"><?php echo e($farmer->name); ?></td>
              <td>
                <div><?php echo e($farmer->email); ?></div>
                <span class="small text-muted"><?php echo e($farmer->phone ?? 'No phone'); ?></span>
              </td>
              <td>
                <span class="small d-block text-forest fw-medium"><?php echo e($farmer->farmerProfile->location_name ?? 'Local Farm'); ?></span>
                <span class="small text-muted"><?php echo e(Str::limit($farmer->farmerProfile->description ?? '', 60)); ?></span>
              </td>
              <td><?php echo e($farmer->created_at->format('M d, Y')); ?></td>
              <td class="text-end">
                <div class="d-flex gap-2 justify-content-end">
                  <form method="POST" action="<?php echo e(route('admin.farmers.approve', $farmer)); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-sm btn-forest rounded-pill px-3">
                      <i class="bi bi-check-lg me-1"></i> Approve
                    </button>
                  </form>
                  <form method="POST" action="<?php echo e(route('admin.farmers.suspend', $farmer)); ?>" onsubmit="return confirm('Reject/suspend this application?');">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                      Reject
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="6" class="text-center py-5">
                <i class="bi bi-check-circle-fill text-success fs-2 mb-2 d-block"></i>
                <h6 class="font-serif text-forest mb-1">All Caught Up!</h6>
                <p class="small text-muted mb-0">No pending farmer applications. All farmers are currently vetted.</p>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php if($farmers->hasPages()): ?>
      <div class="p-3 border-top border-subtle">
        <?php echo e($farmers->links()); ?>

      </div>
    <?php endif; ?>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/admin/farmers/pending.blade.php ENDPATH**/ ?>