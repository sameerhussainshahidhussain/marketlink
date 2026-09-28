<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Produce Item | MarketLink Farmer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/dashboard.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/responsive.css')); ?>">
</head>
<body>
  <div class="dashboard-wrapper">
    <div class="sidebar-overlay"></div>
    <?php echo $__env->make('partials.farmer-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main class="dashboard-main">
      <header class="dashboard-topbar">
        <div class="topbar-left">
          <button class="btn btn-outline-forest btn-sm rounded-circle d-lg-none" id="sidebarToggleBtn"><i class="bi bi-list fs-5"></i></button>
          <h5 class="font-serif mb-0">Add New Harvest Produce</h5>
        </div>
        <div class="topbar-right">
          <a href="<?php echo e(route('farmer.products.index')); ?>" class="btn btn-sm btn-outline-forest rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Products
          </a>
        </div>
      </header>

      <div class="dashboard-container">
        <?php if(isset($errors) && $errors->any()): ?>
          <div class="alert alert-danger py-2 rounded-12 small mb-4">
            <ul class="mb-0 ps-3">
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($err); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>

        <div class="content-card max-w-700">
          <form method="POST" action="<?php echo e(route('farmer.products.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="row g-3">
              <div class="col-md-8">
                <label class="form-label small fw-bold">Produce Name</label>
                <input type="text" name="name" class="form-control rounded-12" value="<?php echo e(old('name')); ?>" placeholder="e.g. Heirloom Organic Tomatoes" required>
              </div>

              <div class="col-md-4">
                <label class="form-label small fw-bold">Category</label>
                <select name="category_id" class="form-select rounded-12" required>
                  <option value="">Select Category</option>
                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php echo e(old('category_id') == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>

              <div class="col-md-4">
                <label class="form-label small fw-bold">Price (Rs.)</label>
                <input type="number" step="0.01" name="price" class="form-control rounded-12" value="<?php echo e(old('price')); ?>" placeholder="e.g. 150.00" required>
              </div>

              <div class="col-md-4">
                <label class="form-label small fw-bold">Unit</label>
                <select name="unit" class="form-select rounded-12" required>
                  <option value="kg" <?php echo e(old('unit') == 'kg' ? 'selected' : ''); ?>>kg (Kilogram)</option>
                  <option value="bunch" <?php echo e(old('unit') == 'bunch' ? 'selected' : ''); ?>>bunch</option>
                  <option value="head" <?php echo e(old('unit') == 'head' ? 'selected' : ''); ?>>head</option>
                  <option value="dozen" <?php echo e(old('unit') == 'dozen' ? 'selected' : ''); ?>>dozen</option>
                  <option value="jar" <?php echo e(old('unit') == 'jar' ? 'selected' : ''); ?>>jar</option>
                  <option value="litre" <?php echo e(old('unit') == 'litre' ? 'selected' : ''); ?>>litre</option>
                  <option value="packet" <?php echo e(old('unit') == 'packet' ? 'selected' : ''); ?>>packet</option>
                </select>
              </div>

              <div class="col-md-4">
                <label class="form-label small fw-bold">Initial Stock</label>
                <input type="number" name="stock_quantity" class="form-control rounded-12" value="<?php echo e(old('stock_quantity', 25)); ?>" min="0" required>
              </div>

              <div class="col-12">
                <label class="form-label small fw-bold">Description & Harvest Notes</label>
                <textarea name="description" rows="3" class="form-control rounded-16" placeholder="Describe flavor notes, harvest date, organic certification details..."><?php echo e(old('description')); ?></textarea>
              </div>

              <div class="col-md-6">
                <label class="form-label small fw-bold">Product Image</label>
                <input type="file" name="image" class="form-control rounded-12" accept="image/*">
                <span class="small text-muted">JPEG, PNG, WebP up to 3MB</span>
              </div>

              <div class="col-md-6">
                <label class="form-label small fw-bold">Listing Status</label>
                <select name="status" class="form-select rounded-12" required>
                  <option value="active" <?php echo e(old('status') == 'active' ? 'selected' : ''); ?>>Active (Visible on Marketplace)</option>
                  <option value="inactive" <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?>>Inactive (Draft)</option>
                </select>
              </div>
            </div>

            <div class="mt-4 pt-3 border-top d-flex gap-2">
              <button type="submit" class="btn btn-forest rounded-pill px-4 py-2">
                <i class="bi bi-check-lg me-1"></i> Save Produce Item
              </button>
              <a href="<?php echo e(route('farmer.products.index')); ?>" class="btn btn-outline-secondary rounded-pill px-4">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
<?php /**PATH C:\Users\AM BUSINESS 99\Desktop\techwiz sameer\resources\views/farmer/products/create.blade.php ENDPATH**/ ?>