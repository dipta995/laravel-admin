<div class="row">
    <div class="col-12 col-md-6 order-md-1 order-last">
        <h3><?php echo e($pageHeader['title']); ?></h3>
        <p class="text-subtitle text-muted"><?php echo e($pageHeader['sub_title']); ?></p>
    </div>
    <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($pageHeader['title']); ?></li>
            </ol>
        </nav>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-quickstart\resources\views/backend/layouts/partials/page-header.blade.php ENDPATH**/ ?>