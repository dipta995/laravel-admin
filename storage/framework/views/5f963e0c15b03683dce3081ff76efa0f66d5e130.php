<div class="row">
    <div class="col-12 col-md-6 order-md-1 order-last">
        <h3><?php echo e($pageHeader['title']); ?></h3>
        <p class="text-subtitle text-muted"><?php echo e($pageHeader['sub_title']); ?></p>
    </div>

    <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="btn btn-outline-info btn-sm" href="<?php echo e(route('home')); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php if(Route::is('admin.' . $pageHeader['plural_name'] . '.create') ||
                        Route::is('admin.' . $pageHeader['plural_name'] . '.edit')): ?>
                        <a class="btn btn-outline-info btn-sm"
                           href="<?php echo e(route($pageHeader['index_button'])); ?>"><?php echo e($pageHeader['title']); ?></a>
                    <?php else: ?>
                        <?php if(!Route::is('home')): ?>
                            <a class="btn btn-outline-info btn-sm"
                               href="<?php echo e(route($pageHeader['create_button'])); ?>">Create <?php echo e($pageHeader['title']); ?></a>
                        <?php else: ?>
                            <a class="btn btn-outline-info btn-sm"
                               href="<?php echo e(route($pageHeader['create_button'])); ?>"><?php echo e($pageHeader['title']); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>
            </ol>
        </nav>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\laravel-quickstart\resources\views/backend/layouts/partials/page-header.blade.php ENDPATH**/ ?>