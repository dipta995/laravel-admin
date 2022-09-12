<?php $__env->startSection('title'); ?>
    Create User
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
                        <div class="col-md-6">
                           <form action="<?php echo e(route('admin.roles.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="basicInput">Role</label>
                                <input type="text" name="name" class="form-control" id="basicInput" placeholder="Enter role">
                            </div>


                            <?php $__currentLoopData = $permission_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row">
                                    <?php  $i = 1;  ?>
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input value="" class="form-check-input" name="group[]" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo e($group->name); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <?php
                                        // $permissions = DB::('permissions')->getpermissionsByGroupName($group->name);
                                            $j=1;
                                        ?>
                                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($permission->group_name == $group->name): ?>
                                            <div class="form-check form-switch">
                                            <input value="<?php echo e($permission->id); ?>" class="form-check-input" name="permissions[]" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo e($permission->name); ?></label>
                                        </div>

                                        <?php endif; ?>


                                        <?php
                                        $j++;
                                    ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <hr>
                                    </div>

                                </div>
                                <?php
                                $i++;
                            ?>
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

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-quickstart\resources\views/backend/pages/roles/create.blade.php ENDPATH**/ ?>