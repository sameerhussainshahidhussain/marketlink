<?php $__env->startSection('title', 'Moderate Reviews | MarketLink Admin'); ?>
<?php $__env->startSection('page_title', 'Customer Review Moderation'); ?>
<?php $__env->startSection('page_subtitle', $reviews->total() . ' product & farm reviews submitted by shoppers'); ?>

<?php $__env->startSection('sidebar'); ?>
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('topbar_right'); ?>
  <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-outline-forest btn-sm rounded-pill px-3">
    <i class="bi bi-speedometer2 me-1"></i> Dashboard
  </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <div class="content-card">
    <div class="content-card-header">
      <div>
        <h5 class="font-serif text-forest mb-0">Platform Reviews Feed</h5>
        <span class="small text-muted">Approve, flag, or moderate community reviews</span>
      </div>
      <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-2 small">
        <i class="bi bi-star me-1"></i> <?php echo e($reviews->total()); ?> Reviews
      </span>
    </div>

    <div class="table-responsive">
      <table class="table table-custom align-middle mb-0">
        <thead>
          <tr>
            <th>Customer</th>
            <th>Farmer / Produce</th>
            <th>Rating</th>
            <th>Review Comments</th>
            <th>Status</th>
            <th class="text-end">Moderation</th>
          </tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><strong class="text-forest"><?php echo e($r->customer->name); ?></strong></td>
              <td><?php echo e($r->farmer->name ?? 'Producer'); ?></td>
              <td>
                <div class="text-gold d-inline-flex gap-1">
                  <?php for($i=1; $i<=5; $i++): ?>
                    <i class="bi bi-star<?php echo e($i <= $r->rating ? '-fill' : ''); ?>"></i>
                  <?php endfor; ?>
                </div>
              </td>
              <td>
                <span class="small"><?php echo e(Str::limit($r->comment, 90)); ?></span>
                <span class="text-muted d-block small mt-1"><?php echo e($r->created_at->format('M d, Y')); ?></span>
              </td>
              <td>
                <span class="badge-status <?php echo e($r->status === 'approved' ? 'ready' : ($r->status === 'pending' ? 'pending' : 'cancelled')); ?>">
                  <i class="bi bi-circle-fill" style="font-size:0.5rem;"></i>
                  <?php echo e(ucfirst($r->status)); ?>

                </span>
              </td>
              <td class="text-end">
                <div class="d-flex gap-1 justify-content-end">
                  <?php if($r->status !== 'approved'): ?>
                    <form method="POST" action="<?php echo e(route('admin.reviews.approve', $r)); ?>">
                      <?php echo csrf_field(); ?>
                      <button type="submit" class="btn btn-xs btn-forest rounded-pill px-3" title="Approve Review">
                        <i class="bi bi-check-lg me-1"></i> Approve
                      </button>
                    </form>
                  <?php endif; ?>
                  <?php if($r->status !== 'rejected'): ?>
                    <form method="POST" action="<?php echo e(route('admin.reviews.reject', $r)); ?>">
                      <?php echo csrf_field(); ?>
                      <button type="submit" class="btn btn-xs btn-outline-warning rounded-pill px-2" title="Reject Review">
                        Reject
                      </button>
                    </form>
                  <?php endif; ?>
                  <form method="POST" action="<?php echo e(route('admin.reviews.destroy', $r)); ?>" onsubmit="return confirm('Permanently remove review?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-xs btn-outline-danger rounded-pill px-2" title="Delete">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="6" class="text-center py-5 text-muted">
                <i class="bi bi-star fs-2 text-muted mb-2 d-block"></i>
                No shopper reviews submitted yet.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php if($reviews->hasPages()): ?>
      <div class="p-3 border-top border-subtle">
        <?php echo e($reviews->links()); ?>

      </div>
    <?php endif; ?>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/admin/reviews/index.blade.php ENDPATH**/ ?>