<?php $__env->startSection('title'); ?>
    <?php echo e($pageHeader['title']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin-content'); ?>
    <?php echo $__env->make('backend.layouts.partials.page-header', $pageHeader, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic Inputs</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?php echo e(route('admin.admins.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php $__currentLoopData = $insert_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make("backend.pages.components._inputs._input_1",$input, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <button type="submit" class="btn btn-outline-success">With Buttons</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_laravel_nine\resources\views/backend/pages/_create.blade.php ENDPATH**/ ?>