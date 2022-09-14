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
                            <div class="form-group">
                                <label for="basicInput">Name</label>
                                <input type="text" name="name" class="form-control" id="basicInput" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">User Name</label>
                                <input type="text" name="username" class="form-control" id="basicInput" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Email</label>
                                <input type="email" name="email" class="form-control" id="basicInput" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Password</label>
                                <input type="text" name="password" class="form-control" id="basicInput" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Confirm Password</label>
                                <input type="text" name="password_confirmation" class="form-control" id="basicInput" placeholder="Enter Confirm Password">
                            </div>


                            <div class="form-group">
                                <select name="roles[]" class="choices form-select multiple-remove" multiple="multiple">

                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <option value="<?php echo e($role->name); ?>"><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                </select>
                            </div>


                              

                                <button type="submit" class="btn btn-outline-success">With Buttons</button>
                           </form>

                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\admin_laravel_nine\resources\views/backend/pages/admins/create.blade.php ENDPATH**/ ?>