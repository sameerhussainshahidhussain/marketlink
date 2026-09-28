<?php $__env->startSection('title', 'My Reviews & Ratings | MarketLink'); ?>
<?php $__env->startSection('page_title', 'Producer Reviews & Feedback'); ?>
<?php $__env->startSection('page_subtitle', 'Feedback you have provided to local organic growers'); ?>

<?php $__env->startSection('sidebar'); ?>
  <?php echo $__env->make('partials.customer-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('topbar_right'); ?>
  <a href="<?php echo e(route('customer.orders')); ?>" class="btn btn-sm btn-forest rounded-pill px-3">
    <i class="bi bi-receipt me-1"></i> Review Completed Orders
  </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="card rounded-24 border-subtle shadow-xs bg-white overflow-hidden">
    <div class="card-header bg-white border-bottom border-subtle py-3 px-4 d-flex justify-content-between align-items-center">
      <h6 class="font-serif mb-0"><i class="bi bi-star-half text-forest me-2"></i>My Reviews (<?php echo e($reviews->total()); ?>)</h6>
      <span class="small text-muted">Helping community growers flourish</span>
    </div>

    <div class="card-body p-4">
      <div class="row g-4">
        <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="col-12">
            <div class="p-4 border rounded-20 bg-white shadow-xs">
              <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-2 mb-3">
                <div class="d-flex align-items-center gap-3">
                  <div class="rounded-circle p-2 bg-sage text-forest d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="bi bi-shop fs-5"></i>
                  </div>
                  <div>
                    <h6 class="font-serif mb-0">
                      <?php echo e($review->farmer->farmerProfile->business_name ?? $review->farmer->name); ?>

                    </h6>
                    <span class="small text-muted">
                      <?php if($review->product): ?>
                        Item: <a href="<?php echo e(route('products.show', $review->product)); ?>" class="text-forest text-decoration-none fw-semibold"><?php echo e($review->product->name); ?></a> &bull;
                      <?php endif; ?>
                      Order #<?php echo e($review->order->order_number ?? $review->order_id); ?>

                    </span>
                  </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                  <div class="text-gold fs-6">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                      <i class="bi <?php echo e($i <= $review->rating ? 'bi-star-fill' : 'bi-star'); ?>"></i>
                    <?php endfor; ?>
                  </div>
                  <?php if($review->status === 'approved'): ?>
                    <span class="badge bg-success-subtle text-success small rounded-pill px-2 py-1">Published</span>
                  <?php elseif($review->status === 'pending'): ?>
                    <span class="badge bg-warning-subtle text-warning small rounded-pill px-2 py-1">Under Review</span>
                  <?php else: ?>
                    <span class="badge bg-danger-subtle text-danger small rounded-pill px-2 py-1">Declined</span>
                  <?php endif; ?>
                </div>
              </div>

              <p class="text-dark mb-2 fs-6"><?php echo e($review->comment); ?></p>
              <div class="small text-muted mb-3"><i class="bi bi-clock me-1"></i>Reviewed <?php echo e($review->created_at->format('M d, Y')); ?></div>

              <?php if($review->farmer_reply): ?>
                <div class="p-3 rounded-16 bg-cream border-start border-forest border-3 mt-3">
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <span class="small fw-bold text-forest">
                      <i class="bi bi-reply-fill me-1"></i> Grower Reply &bull; <?php echo e($review->farmer->farmerProfile->business_name ?? $review->farmer->name); ?>

                    </span>
                    <?php if($review->replied_at): ?>
                      <span class="small text-muted"><?php echo e(\Carbon\Carbon::parse($review->replied_at)->format('M d, Y')); ?></span>
                    <?php endif; ?>
                  </div>
                  <p class="small text-muted mb-0"><?php echo e($review->farmer_reply); ?></p>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="col-12 py-5 text-center text-muted">
            <i class="bi bi-chat-square-quote fs-1 text-muted d-block mb-3"></i>
            <h6 class="font-serif text-muted">No reviews submitted yet</h6>
            <p class="small text-muted mb-3">After picking up your pre-orders, you can leave ratings and feedback for your farmers!</p>
            <a href="<?php echo e(route('customer.orders')); ?>" class="btn btn-sm btn-outline-forest rounded-pill px-4">View My Orders</a>
          </div>
        <?php endif; ?>
      </div>

      <?php if($reviews->hasPages()): ?>
        <div class="mt-4 d-flex justify-content-center">
          <?php echo e($reviews->links()); ?>

        </div>
      <?php endif; ?>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/customer/reviews.blade.php ENDPATH**/ ?>