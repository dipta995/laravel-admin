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

                
                <?php if(isset($view_data)): ?>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <?php $__currentLoopData = $show_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td><?php echo e($column['view_name']); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <th>Action</th>


                            </tr>
                        </thead>
                        <tbody>

                            <?php $__currentLoopData = $view_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                    <td><?php echo e($loop->index+1); ?></td>
                                    <?php $__currentLoopData = $show_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td><?php echo e($value->{$column['name']}); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <td>
                                        
                                        
                                        
                                            <a class="badge bg-danger" href="">Delete</a>
                                            
                                        </td>

                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
                


                
                <?php if(isset($insert_fields) || isset($update_fields)): ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?php echo e($route); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php if(isset($data)): ?>
                                <?php echo method_field('PUT'); ?>
                                <?php endif; ?>
                                <?php $__currentLoopData = $insert_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make("backend.pages.components._inputs._input_1",$input, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <button type="submit" class="btn btn-outline-success">With Buttons</button>
                            </form>

                        </div>

                    </div>
                </div>
                <?php endif; ?>
                


            </div>
        </section>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-quickstart\resources\views/backend/pages/_create.blade.php ENDPATH**/ ?>