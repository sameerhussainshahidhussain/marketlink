<?php $__env->startSection('title', 'Announcements & Bulletins | MarketLink Admin'); ?>
<?php $__env->startSection('page_title', 'Platform Announcements & Bulletins'); ?>
<?php $__env->startSection('page_subtitle', $announcements->total() . ' broadcast messages published across the marketplace'); ?>

<?php $__env->startSection('sidebar'); ?>
  <?php echo $__env->make('partials.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <div class="row g-4">
    
    <div class="col-lg-5">
      <div class="content-card">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">Post New Bulletin</h5>
            <span class="small text-muted">Broadcast operational updates to shoppers and growers</span>
          </div>
        </div>

        <div class="content-card-body">
          <form action="<?php echo e(route('admin.announcements.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
              <label class="form-label small fw-bold">Headline / Title <span class="text-danger">*</span></label>
              <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control rounded-12" placeholder="e.g. Weather Advisory: Extended Covered Canopies" required>
            </div>

            <div class="row g-2 mb-3">
              <div class="col-6">
                <label class="form-label small fw-bold">Bulletin Type <span class="text-danger">*</span></label>
                <select name="type" class="form-select rounded-12" required>
                  <option value="info" <?php echo e(old('type') == 'info' ? 'selected' : ''); ?>>Info</option>
                  <option value="warning" <?php echo e(old('type') == 'warning' ? 'selected' : ''); ?>>Warning</option>
                  <option value="success" <?php echo e(old('type') == 'success' ? 'selected' : ''); ?>>Success</option>
                  <option value="danger" <?php echo e(old('type') == 'danger' ? 'selected' : ''); ?>>Urgent</option>
                </select>
              </div>

              <div class="col-6">
                <label class="form-label small fw-bold">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select rounded-12" required>
                  <option value="published" <?php echo e(old('status', 'published') == 'published' ? 'selected' : ''); ?>>Published</option>
                  <option value="draft" <?php echo e(old('status') == 'draft' ? 'selected' : ''); ?>>Draft</option>
                </select>
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label small fw-bold">Message Content <span class="text-danger">*</span></label>
              <textarea name="message" class="form-control rounded-12" rows="4" placeholder="Detail any schedule shifts, parking notices, or market announcements..." required><?php echo e(old('message')); ?></textarea>
            </div>

            <button type="submit" class="btn btn-forest rounded-pill px-4 py-2 w-100">
              <i class="bi bi-broadcast me-1"></i> Broadcast Announcement
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-7">
      <div class="content-card">
        <div class="content-card-header">
          <div>
            <h5 class="font-serif text-forest mb-0">Active Announcements</h5>
            <span class="small text-muted"><?php echo e($announcements->total()); ?> recorded broadcasts</span>
          </div>
          <span class="badge bg-forest-subtle text-forest rounded-pill px-3 py-1 small">
            Live Feed
          </span>
        </div>

        <div class="content-card-body p-3">
          <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ann): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-3 border border-subtle rounded-16 bg-white mb-3 shadow-xs">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <strong class="text-forest"><?php echo e($ann->title); ?></strong>
                <div>
                  <?php
                    $typeBadge = match($ann->type) {
                      'warning' => 'bg-warning text-dark',
                      'danger' => 'bg-danger text-white',
                      'success' => 'bg-success text-white',
                      default => 'bg-info text-white'
                    };
                  ?>
                  <span class="badge <?php echo e($typeBadge); ?> rounded-pill small me-1"><?php echo e(ucfirst($ann->type)); ?></span>
                  <span class="badge-status <?php echo e($ann->status === 'published' ? 'ready' : 'cancelled'); ?>">
                    <?php echo e(ucfirst($ann->status)); ?>

                  </span>
                </div>
              </div>
              <p class="small text-muted mb-2"><?php echo e($ann->message); ?></p>
              <div class="d-flex justify-content-between align-items-center pt-2 border-top border-subtle">
                <span class="small text-muted">
                  <i class="bi bi-clock me-1"></i> <?php echo e($ann->created_at->diffForHumans()); ?> by <?php echo e($ann->creator->name ?? 'Admin'); ?>

                </span>
                <div class="d-flex gap-2">
                  <a href="<?php echo e(route('admin.announcements.edit', $ann)); ?>" class="btn btn-xs btn-outline-forest rounded-pill px-3">
                    <i class="bi bi-pencil me-1"></i> Edit
                  </a>
                  <form action="<?php echo e(route('admin.announcements.destroy', $ann)); ?>" method="POST" onsubmit="return confirm('Delete announcement?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-xs btn-outline-danger rounded-pill px-2">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-5">
              <i class="bi bi-megaphone fs-2 text-muted mb-2 d-block"></i>
              <p class="text-muted small mb-0">No announcements posted yet.</p>
            </div>
          <?php endif; ?>

          <?php if($announcements->hasPages()): ?>
            <div class="mt-3">
              <?php echo e($announcements->links()); ?>

            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/admin/announcements/index.blade.php ENDPATH**/ ?>