<?php $__env->startSection('title'); ?>
    <?php echo e($pageHeader['title']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin-content'); ?>
    <?php echo $__env->make('backend.layouts.partials.page-header', $pageHeader, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="page-content">
  <!-- Basic Tables start -->
  <section class="section">
    <div class="card">
        <div class="card-header">
            Jquery Datatable
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td><?php echo e($loop->index+1); ?></td>
                            <td><?php echo e($role->name); ?></td>
                            <td>
                                <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-success"><?php echo e($item->name); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td>
                                <?php if( Auth::guard('admin')->user()->can('role.edit')): ?>
                                <a class="badge bg-info" href="<?php echo e(route('admin.roles.edit',$role->id)); ?>">Edit</a>
                                <?php endif; ?>
                                <?php if( Auth::guard('admin')->user()->can('role.delete')): ?>
                                <a class="badge bg-danger" href="">Delete</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>







                </tbody>
            </table>
        </div>
    </div>

</section>
<!-- Basic Tables end -->
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_laravel_nine\resources\views/backend/pages/roles/index.blade.php ENDPATH**/ ?>